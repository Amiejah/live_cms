<?php
    class Article_m extends MY_Model {

        protected $_table_name      = 'articles';
        protected $_order_by        = 'pub_date desc, id desc';
        protected $_timestamps      = true;
        public $rules = array(
            'pubdate' => array(
                'field' => 'pubdate',
                'label' => 'Publication date',
                'rules' => 'trim|require|exact_length[10]|xss_clean',
            ),
            'title' => array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'trim|required|max_length(100)|xss_clean',
            ),
            'slug' => array(
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|max_length(100)|url_title|xss_clean',
            ),
            'body' => array(
                'field' => 'body',
                'label' => 'Body',
                'rules' => 'trim|required',
            ),
        );


        public function get_new ()
        {
            $article = new stdClass();
            $article->title = '';
            $article->slug = '';
            $article->body = '';
            $article->pub_date = date( 'Y-m-d' );
            $article->use_custom_meta = '';
            return $article;
        }

        public function set_published(){
            $this->db->where('pub_date <=', date('Y-m-d'));
        }

        public function get_recent($limit = 3){
            $limit = (int)$limit;
            $this->set_published();
            $this->db->limit($limit);

            return parent::get();
        }

    }
?>