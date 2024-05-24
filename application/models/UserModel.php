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

  public function create($user){
    $this->db->trans_start();
    $this->db->insert('users',$user);
    if ($this->db->trans_status() === FALSE) {
      $db_error = $this->db->error();

       if (!empty($db_error['code'])) {
        if ($db_error['code'] == 1062) { // Código de error para entrada duplicada
          throw new Exception('El nombre de usuario ya existe. Por favor, elija otro.');
        } else {
          throw new Exception('Error de base de datos: ' . $db_error['message']);
        }
      }
    }
    $this->db->trans_complete();
  }

  public function getAll(){
    $query = $this->db->get_where('users',array('state',1));
    return $query->result_array();
  }
}
