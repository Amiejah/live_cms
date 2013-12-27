<?php
    class User_M extends MY_Model{

        protected $_table_name = 'users';
        protected $_order_by = 'name';

        public $rules = array(
            'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|xss_clean',
            ),
            'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
        );

        public $rules_admin = array(

            'name' => array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|xss_clean',
            ),
            'email' => array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean
                |xss_clean',
            ),
            'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim'
            ),
            'password_confirm' => array(
                'field' => 'password confirm',
                'label' => 'Confirm password',
                'rules' => 'trim|matches[password]'
            ),
        );

        function __construct(){
            parent::__construct();
        }

        public function login(){

            $user = $this->get_by( array(
                'email' => $this->input->post( 'email' ),
                'password' => $this->hash( $this->input->post( 'password' ) )
            ), TRUE );

            if( count( $user ) ){
                // log in user
                $data = array(
                    'name' => $user->name,
                    'email' => $user->email,
                    'id' => $user->id,
                    'loggedin' => TRUE
                );

                $this->session->set_userdata($data);
            }
        }

        public function logout(){
            $this->session->sess_destroy();
        }


        public function get_new(){
            $user = new stdClass();
            $user->name = '';
            $user->email = '';
            $user->password = '';
            return $user;
        }

        public function loggedin(){
            return (bool) $this->session->userdata( 'loggedin' );
        }

        public function hash( $string ){
            return hash( 'sha512', $string . config_item( 'encryption' ) );
        }

        public function _unique_email( $str ){

            $id = $this->uri->segment( 4 );
            $this->db->where('email', $this->input->post( 'mail' ));

            !$id || $this->db->where( 'id !=', $id );
            $user = $this->user_m->get();

            if( count( $user ) ){
                $this->form_validation->set_message( 'unique_email', '%s should be unique' );
                return false;
            }

            return true;

        }

        // Check by mail if a user exists.
        // return false if no e-mail is found
        public function getUserByMail($email, $userAccountObject = FALSE ) {
            $userObject = $this->get_by( array( 'email' => $email ) );

            if(!empty($userObject)){
                $userAccountObject = new ArrayObject();
                $userAccountObject->email = $userObject[0]->email;
                $userAccountObject->id= $userObject[0]->id;
            }

            return $userAccountObject;
        }

        // Reset the current password with a new one
        public function resetUserPass( $id  ){

            $newPass = new stdClass();
            $newPass->user_pass = random_string('alnum', 8);
            $newPass->hash_pass = $this->hash($newPass->user_pass);

            // Update the user first
            $this->user_m->save( array( 'password' => $newPass->hash_pass ), $id );

            // Return the password to the user
            // We will be using the controller to send an e-mail
            return $newPass;
        }
    }