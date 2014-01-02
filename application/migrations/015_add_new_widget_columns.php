<?php
class Migration_add_new_widget_columns extends CI_Migration {

    public function up()
    {
        $fields = array(
            'widget_ratings' => array(
                'type' => 'VARCHAR',
                'constraint' => 6,
                'default' => '1'
            ),
            'widget_bonus' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'widget_external_url' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        );

        $this->dbforge->add_column('top_widget', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('top_widget', 'widget_ratings');
    }

}
