<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_table_users extends CI_Migration
{

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null'=>FALSE
      ),
      'user'=> array(
        'type'=>'VARCHAR',
        'constraint' => '100',
        'unique'=>TRUE,
        'null'=>FALSE
      ),
      'email'=>array(
        'type'=>'VARCHAR',
        'constraint'=>'255',
        'unique'=>TRUE,
        'null'=>FALSE

      ),
      'password'=>array(
        'type'=>'VARCHAR',
        'constraint'=>'255',
        'null'=>FALSE,
      ),
      'state'=>array(
        'type'=>'INT',
        'contraint'=>5,
        'null'=>FALSE,
        'default'=>1
      ),
      'created_at datetime default current_timestamp',
      'updated_at datetime default current_timestamp on update current_timestamp',
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users');
  }

  public function down()
  {
    $this->dbforge->drop_table('users');
  }
}
