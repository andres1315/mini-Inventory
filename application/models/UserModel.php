<?php
class UserModel extends CI_Model{
  public function __construct()
  { 
    parent::__construct();
    $this->load->database();
    

  }


  public function userLogin($user,$password)
  {
    $query = $this->db->get_where('users', array('user'=>$user, 'password'=>$password));
		return $query->row_array();
  }

  public function getAll(){
    $query = $this->db->get_where('users',array('state',1));
    return $query->result_array();
  }
}
