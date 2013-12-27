<?php
class Migration_add_meta_type_column extends CI_Migration {

    public function up()
    {
        $fields = array(
            'meta_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
                'default' => 'page'
            )
        );
        $this->dbforge->add_column('search_meta', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('search_meta', 'use_custom_meta');
    }

}

