<?php
class Migration_add_slug_to_widget extends CI_Migration {

    public function up()
    {
        $fields = array(
            'widget_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            )
        );
        $this->dbforge->add_column('top_widget', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('top_widget', 'widget_slug');
    }

}
