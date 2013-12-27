<?php
    // @Todo Create a global meta_model function
    class meta_model extends MY_Model {
        protected  $_table_name = 'search_meta';
        protected  $_order_by   = 'id';

        // @Todo Make the meta rules global
        public $meta_rules = array(
            'meta_title'=> array(
                'field' => 'meta_title',
                'label' => 'Meta Title',
                'rules' => 'trim|required|max_length(100)|xss_clean',
            ),
            'meta_description' => array(
                'field' => 'meta_description',
                'label' => 'Meta description',
                'rules' => 'trim|required',
            ),
            'meta_keywords' => array(
                'field' => 'meta_keywords',
                'label' => 'Meta Keywords',
                'rules' => 'trim|required|max_length(120)',
            ),
        );

        // Set the default meta values
        public function get_new_meta() {
            $meta = new stdClass();
            $meta->meta_title = '';
            $meta->meta_description = '';
            $meta->meta_keywords = '';
            return $meta;
        }

        // Create a custom save method for meta
        public function save_meta( $meta, $id = NULL) {
            // @todo Create a meta tag overview
            // Check if the data is new
            // If it's not, insert it!

            $post_article_id = $meta['post_article_id'];
            $get_meta = $this->db->get_where( $this->_table_name, array( 'post_article_id' => "$post_article_id" ), 1 );

            // If user already set meta
            // Get that id and update default id(NULL)
            if( $get_meta->num_rows()){
                // Fetch the meta id
                $id = $get_meta->result()[0]->id;
            }

            $this->save( $meta, $id );
        }
 
        // Get the meta data
        public function get_meta( $search_meta_id = NULL, $meta_type = 'page') {
            $id = $search_meta_id;
            $get_meta = $this->get_by( array('post_article_id' => $id, 'meta_type' => $meta_type ), true );
            if(!count($get_meta)) {
                return $this->get_new_meta();
            } else {
                return $get_meta;
            }
        }


    }