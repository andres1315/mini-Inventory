<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('userModel');
  }

  
  public function index(){


    //restrict users to go back to login if session has been set
    if($this->session->userdata('user')){
      redirect('_home');
    }else{
      $info['title']='Login minInventory';
      $info['view']='login/index';
      $info['css'][]=[
        'node_modules/bootstrap/dist/css/bootstrap.min.css'

      ];

      $info['js'][]=[
        'node_modules/axios/dist/axios.min.js',
        'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',



      ];
      $info['custom_js'][]=[
        'assets/js/api.js',
        'assets/js/loginPage.js'
      ];
      $this->load->view('layout/basicLayout',$info);
		}


  }


  private function _home(){

    
    //restrict users to go to home if not logged in
    if($this->session->userdata('user')){
      $this->load->view('home');
    }
    else{
      redirect('/');
    }
  }

  public function initLogin(){

    $user = $this->input->post('user');
    $password=$this->input->post("password");
		$data = $this->userModel->userLogin($user, $password);
    
    $result=[];
		if($data){
			$this->session->set_userdata('user', $data);
      $result = array(
        'status'=>'success',
        'message'=>'ok',
        'data'=>$data
      );
      $this->output->set_status_header(200);

		}
		else{
      $result=array(
        'status'=>'error',
        'message'=>'Usuario o contraseña incorrectos',
        'data'=>$this->input->post()
      );
      $this->output->set_status_header(400);

		}
    return $this->output->set_content_type('application/json')->set_output(json_encode($result));
  }
}
?>