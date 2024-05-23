<?php

defined('BASEPATH') or exit('No Redirect script access allowed');
class Migration_table_menu extends CI_Migration{
  public function up(){
    $this->dbforge->add_field(array(
      'id'=> array(
        'type'=> 'INT',
        'constraint'=>10,
        'unsigned'=>TRUE,
        'auto_increment'=>TRUE
      ),
      'name'=>array(
        'type'=>'VARCHAR',
        'constraint'=> 255,
        'null'=>FALSE,
        'unique'=>TRUE
      ),
      'description'=>array(
        'type'=>'VARCHAR',
        'constraint'=>255,
        'null'=>TRUE,
      ),
      'label'=>array(
        'type'=>'VARCHAR',
        'constraint'=>255,
        'null'=>FALSE
      ),
      'path_icon'=>array(
        'type'=>'VARCHAR',
        'constraint'=>255,
        'null'=>FALSE,
      ),
      'name_icon'=>array(
        'type'=>'VARCHAR',
        'constraint'=>100,
        'null'=>FALSE,
        'unique'=>TRUE
      ),
      'state'=>array(
        'type'=>'INT',
        'constraint'=>10,
        'null'=>FALSE,
        'default'=>1
      ),
      'url'=>array(
        'type'=>'VARCHAR',
        'constraint'=>255,
        'null'=>false
      ),
      'parent_menu'=>array(
        'type'=>'INT',
        'constraint'=>11,
        'null'=>TRUE
      ),
      'created_at datetime default current_timestamp',
      'updated_at datetime default current_timestamp on update current_timestamp',
    ));
    $this->dbforge->add_key('id',true);
    $this->dbforge->create_table('menu');
  }

  public function down(){
    $this->dbforge->drop_table('menu');
  }
}