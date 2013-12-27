<?php
class Migration_Create_casino extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(array(
            'widget_id' => array(
                'type' => 'INT',
                'constraint' => 6,
                'auto_increment' => true
            ),
            'widget_status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'default' => 1
            ),
            'widget_type' => array(
                'type' => 'INT',
                'constraint' => 4,
                'default' => 1
            ),
            'widget_order' => array(
                'type' => 'INT'
            ),
            'widget_image_upload' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'widget_data_upload' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'widget_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'widget_description' => array(
                'type' => 'TEXT'
            )
		));
		$this->dbforge->add_key('widget_id');
		$this->dbforge->create_table('top_widget');
	}

	public function down()
	{
		$this->dbforge->drop_table('top_widget');
	}
}