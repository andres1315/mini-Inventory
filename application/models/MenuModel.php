<?php

class MenuModel extends CI_Model{

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function getAllMenu(){
    $query = $this->db->get_where('menu',array('state',1));
    return $query->row_array();
  }
}