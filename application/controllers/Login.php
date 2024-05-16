<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url'));
  }

  
  public function index(){
    $info['title']='Login';
    $this->load->view('login/index',$info);
    
  }
}

?>