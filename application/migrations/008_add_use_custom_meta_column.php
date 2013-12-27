<?php
class Migration_Add_use_custom_meta_column extends CI_Migration {

    public function up()
    {
        $fields = array(
            'use_custom_meta' => array(
                'type' => 'VARCHAR',
                'constraint' => 6
            )
        );
        $this->dbforge->add_column('pages', $fields);
        $this->dbforge->add_column('articles', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('pages', 'use_custom_meta');
        $this->dbforge->drop_column('articles', 'use_custom_meta');
    }

}
