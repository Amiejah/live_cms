<?php
class Migration_add_new_page_type extends CI_Migration {

    public function up()
    {
        $fields = array(
            'page_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'page'
            )
        );
        $this->dbforge->add_column('pages', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('pages', 'page_type');
    }

}
