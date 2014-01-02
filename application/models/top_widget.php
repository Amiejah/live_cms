<?php
    class Top_widget extends MY_Model{
        protected $_table_name      = 'top_widget';
        protected $_primary_key     = 'widget_id';
        protected $_order_by        = 'widget_id, widget_order';

        var $upload_path;

        function __construct() {
            parent::__construct();
            $this->upload_path = realpath(APPPATH . '../images');
        }

        public $rules = array(
            'widget_id' => array(
                'field' => 'widget_id',
                'label' => 'Widget ID',
                'rules' => 'trim|intval',
            ),
            'widget_title' => array(
                'field' => 'widget_title',
                'label' => 'Title',
                'rules' => 'trim|required|xss_clean|unique_title',
            ),
            'widget_slug' => array(
                'field' => 'widget_slug',
                'label' => 'Slug',
                'rules' => 'trim|required|max_length(100)|url_title|unique_title|callback__unique_slug|xss_clean',
            ),
            'widget_description' => array(
                'field' => 'widget_description',
                'label' => 'Title',
                'rules' => 'trim|required',
            ),
            'widget_image_upload' => array(
                'field' => 'widget_image_upload',
                'label' => 'Logo',
                'rules' => 'trim',
            ),
            'widget_data_upload' => array(
                'field' => 'widget_data_upload',
                'label' => 'Download',
                'rules' => 'trim|xss_clean',
            ),
            'widget_status' => array(
                'field' => 'widget_status',
                'label' => 'Status',
                'rules' => 'trim|max_length(20)|xss_clean',
            ),
            'widget_order' => array(
                'field' => 'widget_order',
                'label' => 'Order',
                'rules' => 'trim|xss_clean',
            ),
        );

        public function get_new() {
            $widget = new stdClass();
            $widget->widget_title = '';
            $widget->widget_description = '';
            $widget->widget_image_upload = ''; // Image/logo
            $widget->widget_data_upload = '';  // Data/Download
            $widget->widget_status = 0;
            $widget->widget_order = 0;
            $widget->widget_ratings = '1';
            $widget->widget_bonus = '';
            $widget->widget_external_url = '';
            $widget->widget_slug = '';
            $widget->use_custom_meta = true;
            return $widget;
        }

        public function get_widgets($limit = 5) {
            // Get all data
            $limit = (int)$limit;
            $this->db->limit($limit);
            return parent::get_by(array('widget_status' => 1));
        }

        // Handle the upload
        public function do_upload() {

            $config['upload_path'] = $this->upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']	= '4500';
            $config['max_width']  = '3500';
            $config['max_height']  = '4500';

            $this->load->library('upload', $config);
            $this->upload->do_upload('widget_image_upload');

            $image_data = $this->upload->data();

            $config = array(
                'source_image' => $image_data['full_path'],
                'new_image' => $this->upload_path . '/thumbs',
                'maintain_ration' => true,
                'width' => 150,
                'height' => 100
            );

            $this->load->library('image_lib', $config);
            // Take the original image
            // Save as thumb in thumbs
            $this->image_lib->resize();

            return $image_data['file_name'];
        }


    }