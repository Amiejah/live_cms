<?php

    class Frontend_Controller extends My_Controller{
        function __construct(){
            parent::__construct();

            // Get pages
            $this->load->model('page_m');
            $this->load->model('article_m');
            $this->load->model('meta_model');

            // Fetch navigation
            $this->data['menu'] = $this->page_m->get_nested();
            $this->data['news_archive_link'] = $this->page_m->get_archive_link();
            $this->data['meta_title'] = config_item('site_name');

        }
    }