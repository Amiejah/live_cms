<?php
class Page extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model( 'page_m');
        $this->load->model( 'meta_model' );
    }


    public function index(){
        $this->data['pages'] = $this->page_m->get_with_parent();
        $this->data['subview'] = 'admin/page/index';
        $this->load->view( 'admin/_layout_main', $this->data );
    }

    public function order(){
        $this->data['sortable'] = true;
        $this->data['subview']  = 'admin/page/order';
        $this->load->view( 'admin/_layout_main', $this->data );
    }
    public function order_ajax(){

        if( isset( $_POST['sortable']) ){
            $this->page_m->save_order( $_POST['sortable'] );
        }
        $this->data['pages'] = $this->page_m->get_nested();

        $this->load->view( 'admin/page/order_ajax', $this->data );
    }

    public function edit( $id = NULL ){

        if ($id) {
            $this->data['page'] = $this->page_m->get($id);
            $this->data['meta'] = $this->meta_model->get_meta($id);
            count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
        } else {
            $this->data['page'] = $this->page_m->get_new();
            $this->data['meta'] = $this->meta_model->get_new_meta();
        }

        $this->data['pages_no_parent'] = $this->page_m->get_no_parents();
        // Get the post rules
        $rules = $this->page_m->rules;

        $this->form_validation->set_rules( $rules );
        if( $this->form_validation->run() == TRUE ){

            $data = $this->page_m->array_from_post( array(
                'title',
                'slug',
                'body',
                'parent_id',
                'template',
                'use_custom_meta'
            ));

            $last_set_id = $this->page_m->save( $data, $id ); // Get the inserted id for later use

            // Check if the user is using custom meta
            // If so get the last inserted id and use it as reference
            if($data['use_custom_meta']){
                // Get the meta_data rules
                // Set the rules
                // Check if the rules are met
                // If so add the meta title
                $meta = '';
                $rules = $this->meta_model->meta_rules;
                $this->form_validation->set_rules($rules);

                if($this->form_validation->run() == TRUE) {
                    $meta['post_article_id'] = $last_set_id;
                    $meta['meta_title'] = $this->input->post('meta_title');
                    $meta['meta_description'] = $this->input->post('meta_description');
                    $meta['meta_keywords'] = $this->input->post('meta_keywords');
                }

                $this->meta_model->save_meta( $meta );

            }


            redirect( 'admin/page' );
        }

        $this->data['subview'] = 'admin/page/edit';
        $this->load->view( 'admin/_layout_main', $this->data);
    }

    public function delete( $id ){
        $this->page_m->delete( $id );
        redirect( 'admin/page' );
    }

    public function _unique_slug( $str ){

        $id = $this->uri->segment( 4 );
        $this->db->where('slug', $this->input->post( 'slug' ));

        !$id || $this->db->where( 'id !=', $id );
        $page = $this->page_m->get();



        if( count( $page ) ){
            $this->form_validation->set_message( '_unique_slug', '%s should be unique' );
            return false;
        }

        return true;

    }
}
