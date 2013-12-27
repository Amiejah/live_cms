<?php
class Migration_Add_use_custom_meta_widget extends CI_Migration {

    public function up()
    {
        $fields = array(
            'use_custom_meta' => array(
                'type' => 'VARCHAR',
                'constraint' => 6,
                'default' => 'true'
            )
        );
        $this->dbforge->add_column('top_widget', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('top_widget', 'use_custom_meta');
    }

}