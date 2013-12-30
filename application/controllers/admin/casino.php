<?php
class Casino extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('top_widget');
        $this->load->model('meta_model');

    }


    public function index(){
        $this->data['widgets'] = $this->top_widget->get();
        $this->data['subview'] = 'admin/casino/index';
        $this->load->view( 'admin/_layout_main', $this->data );

    }

    public function edit( $widget_id = NULL ){

        if ($widget_id) {
            $this->data['widget'] = $this->top_widget->get($widget_id);
            $this->data['meta'] = $this->meta_model->get_meta($widget_id, 'widget');
            count($this->data['widget']) || $this->data['errors'][] = 'page could not be found';
        } else {
            $this->data['widget'] = $this->top_widget->get_new();
            $this->data['meta'] = $this->meta_model->get_new_meta();
        }

        $rules = $this->top_widget->rules;
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == TRUE ) {

            $data = $this->top_widget->array_from_post( array(
                'widget_title',
                'widget_description',
                'widget_status',
                'widget_order',
                'use_custom_meta',
                'widget_slug'
            ));
            $data['widget_image_upload'] = '';

            if( $_FILES['widget_image_upload']['error'] == 0 ){
                
                $data['widget_image_upload'] = $this->top_widget->do_upload($_FILES['widget_image_upload']);
            }

            $last_set_id = $this->top_widget->save( $data, $widget_id ); // Get the inserted id for later use


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
                    $meta['meta_type'] = 'widget';
                    $meta['meta_title'] = $this->input->post('meta_title');
                    $meta['meta_description'] = $this->input->post('meta_description');
                    $meta['meta_keywords'] = $this->input->post('meta_keywords');
                }

                $this->meta_model->save_meta( $meta );

            }
            redirect( 'admin/casino' );

        }

        $this->data['subview'] = 'admin/casino/edit';
        $this->load->view( 'admin/_layout_main', $this->data );
    }
    public function delete( $widget_id ){
        $this->top_widget->delete( $widget_id );
        redirect( 'admin/casino' );
    }

    // Use this function for (ajax) calling/getting the data
    public function retrieve_data(){
        $this->output->set_content_type('application/json');
        $this->data['json'] = $this->top_widget->get();

        if(!$this->data['json']) show_404();

        $this->load->view('admin/casino/json_view', $this->data);
    }
}