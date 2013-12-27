<?php
class Article extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model( 'article_m' );
        $this->load->model( 'meta_model' );
    }


    public function index(){
        $this->data['articles'] = $this->article_m->get();
        $this->data['subview'] = 'admin/article/index';
        $this->load->view( 'admin/_layout_main', $this->data );
    }

    public function edit( $id = NULL ){

        if ($id) {
            $this->data['article'] = $this->article_m->get($id);
            $this->data['meta'] = $this->meta_model->get_meta($id, 'article');
            count($this->data['article']) || $this->data['errors'][] = 'article could not be found';
        } else {
            $this->data['article'] = $this->article_m->get_new();
            $this->data['meta'] = $this->meta_model->get_new_meta();
        }

        $rules = $this->article_m->rules;

        $this->form_validation->set_rules( $rules );
        if( $this->form_validation->run() == TRUE ){

            $data = $this->article_m->array_from_post( array( 'title', 'slug', 'body' , 'pub_date', 'use_custom_meta') );
            $last_set_id = $this->article_m->save( $data, $id );

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
                    $meta['meta_type'] = 'article';
                    $meta['meta_title'] = $this->input->post('meta_title');
                    $meta['meta_description'] = $this->input->post('meta_description');
                    $meta['meta_keywords'] = $this->input->post('meta_keywords');
                }

                $this->meta_model->save_meta( $meta );

            }

            redirect( 'admin/article' );
        }

        $this->data['subview'] = 'admin/article/edit';
        $this->load->view( 'admin/_layout_main', $this->data);
    }

    public function delete( $id ){
        $this->article_m->delete( $id );
        redirect( 'admin/article' );
    }
}