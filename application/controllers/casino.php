<?php
    class Casino extends Frontend_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('article_m');
            $this->load->model('top_widget');

            $this->data['recent_news'] = $this->article_m->get_recent();
            $this->data['top_widget'] = $this->top_widget->get_widgets();
        }

        public function index( $id, $slug ){

            // Get the data based on the slug
            $this->data['widget_content'] = $this->top_widget->get($id);
            // Return 404 if not found
            count( $this->data['widget_content']) || show_404(uri_string());

            // redirect if slug was incorrect
            $requested_slug = $this->uri->segment(3);
            $set_slug = $this->data['widget_content']->widget_slug;

            if ($requested_slug != $set_slug) {
                redirect('casino/' . $this->data['widget_content']->widget_id . '/' . $this->data['widget_content']->widget_slug, 'location', '301');
            }

            $this->data['subview'] = 'widget';
            $this->load->view('_main_layout', $this->data );
        }
    }
?>