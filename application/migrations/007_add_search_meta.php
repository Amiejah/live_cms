<?php
class Migration_Add_search_meta extends CI_Migration {

    public function up()
    {

        $this->dbforge->add_field( array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 25,
                'auto_increment' => TRUE
            ),
            'post_article_id' => array(
                'type' => 'INT',
                'constraint' => 25,
            ),
            'meta_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'meta_description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'meta_keywords' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('search_meta');
    }

    public function down()
    {
        $this->dbforge->drop_table('search_meta');
    }

}
