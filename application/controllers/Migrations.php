<?php

class Migrations extends CI_Controller{
  public function index(){
    $this->load->library('migration');
    if($this->migration->current()===FALSE){
      show_error($this->migration->error_string());
    }else{
      echo "Migrations completed Succesfull";
    }
  }
}