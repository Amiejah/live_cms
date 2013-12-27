<?php
    class Forgot_pass extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->library('session');
        }

        public function index() {
            $this->load->view('forgot_pass/index', $this->data);
        }

        public function doforget() {

            $userObject = $this->user_m->getUserByMail($_POST['email']);
            if($userObject){
                // reset password
                $sendPassMail = $this->user_m->resetUserPass($this->user_m->get($userObject->id)->id);
                $sendPassMail->mail = $userObject->email;
                $this->session->set_flashdata('status', 'success');
            } else {
                // @TODO fix a more sensible error message
                $sendPassMail = false;
                $this->session->set_flashdata('status', 'error');
            }

            if($sendPassMail){
                // Load the email helper/class
                $this->load->library('email');

                $this->email->from('info@humpff.com', 'Amir Swaleh');
                $this->email->to($sendPassMail->mail);
                //$this->email->cc('another@another-example.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject('Password reset');
                $this->email->message('Your new password: ' . $sendPassMail->user_pass);

                $this->email->send();
            }

            redirect('admin/user/login');

        }
    }
?>