<?php
class Migration_Change_image_column extends CI_Migration {

    public function up()
    {
        $fields = array(
            'widget_image_upload' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => '',
                'null' => TRUE
            )
        );
        $this->dbforge->modify_column('top_widget', $fields);
    }

    public function down()
    {

    }

}
