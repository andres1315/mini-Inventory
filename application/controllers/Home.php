<?php

class Home extends CI_Controller{

  public function index(){
    redirect('/login');
  }

  public function login(){
    $_POST = json_decode(file_get_contents("php://input"), true); 
    var_dump($this->input->post());
  }
}