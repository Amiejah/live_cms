<?php
    class Page extends Frontend_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('article_m');
            $this->load->model('top_widget');

            $this->data['recent_news'] = $this->article_m->get_recent();
            $this->data['top_widget'] = $this->top_widget->get_widgets();

        }
        public function index(){

            // Fetch the page template
            $this->data[ 'page' ] = $this->page_m->get_by(  array( 'slug' => (string) $this->uri->segment(1) ), true );
            count( $this->data['page'] ) || show_404( current_url() );

            $this->data['output_metadata'] = $this->meta_model->get_meta($this->data['page']->id);

            // Fetch the page data
            // And use the set template
            $method = '_' . $this->data['page']->template;

            if( !empty( $_POST['contactme']) && $_POST['contactme'] == 'true' ){
                $this->_validate($_POST);
            }

            // check if method exists
            // if not log and show the error
            if( method_exists( $this, $method )){
                $this->$method();
            } else {
                log_message( 'error', 'Could not load template' . $method . ' in file ' . __FILE__ . ' at line ' . __LINE );
                show_error( 'Could not load template ' . $method );
            }
            $this->data['subview'] = $this->data['page']->template;

            $this->load->view('_main_layout', $this->data);
        }

        private function _homepage(){
            $this->article_m->set_published();
            $this->db->limit( 6 );

            $this->data['articles'] = $this->article_m->get();
        }

        private function _page(){
            $this->data['recent_news'] = $this->article_m->get_recent();
        }

        private function _news_archive(){
            $this->data['recent_news'] = $this->article_m->get_recent();

            // Count all articles
            $this->article_m->set_published();
            $count = $this->db->count_all_results( 'articles' );

            // set up pagination
            $perpage = 4;

            if( $count > $perpage ){
                $this->load->library( 'pagination' );

                $config['base_url'] = site_url( $this->uri->segment(1) . '/' );
                $config['total_rows'] = $count;
                $config['per_page'] = $perpage;
                $config['uri_segment'] = 2;

                $this->pagination->initialize( $config );
                $this->data['pagination'] = $this->pagination->create_links();
                $offset = $this->uri->segment( 2 );
            } else {
                $this->data['pagination'] = '';
                $offset = 0;
            }

            // fetch articles
            $this->article_m->set_published();
            $this->db->limit( $perpage, $offset );

            $this->data['articles'] = $this->article_m->get();
        }

        private function _contact(){
        }

        private function _validate( $data = array() ) {
            // Set the rules first
            $rules = array(
                'userMail' => array(
                    'field' => 'userMail',
                    'label' => 'userMail',
                    'rules' => 'trim|required|max_length(100)|xss_clean',
                ),
                'userName' => array(
                    'field' => 'userName',
                    'label' => 'userName',
                    'rules' => 'trim|required|xss_clean',
                ),
                'userQuestion' => array(
                    'field' => 'userQuestion',
                    'label' => 'userQuestion',
                    'rules' => 'trim|required',
                ),
            );


            // Set the validation rules
            $this->form_validation->set_rules( $rules );
            if( $this->form_validation->run() == TRUE ){

                // If everything checked out
                // Load the mail library
                $this->load->library('email');
                $this->email->from($this->input->post('userMail'), $this->input->post('userName'));
                $this->email->to('info@humpff.com'); //@TODO create a default email account
                $this->email->subject('Contact form');

                $this->email->message($this->input->post('userQuestion'));
                $this->email->send();

                redirect('contact/success');
            }
        }
    }
?>