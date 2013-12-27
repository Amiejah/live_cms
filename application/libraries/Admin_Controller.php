<?php

    class Admin_Controller extends My_Controller{
        function __construct(){
            parent::__construct();

            $this->data[ 'meta_title' ] = 'My Awesome CMS';
            $this->load->helper( 'form' );
            $this->load->library( 'form_validation' );
            $this->load->library( 'session' );

            $this->load->model( 'user_m' );

            $exception_uris = array(
                'admin/user/login',
                'admin/user/logout',
                'forgot_pass/index',
                'forgot_pass/doforget'
            );

//            if( in_array( uri_string(),  $exception_uris ) == FALSE ){
//                if( $this->user_m->loggedin() == FALSE ){
//                    redirect( 'admin/user/login' );
//                }
//            }

        }



    }

