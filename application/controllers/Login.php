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
      try{
       
        $info =[
          'title'=>'Home minInventory',
          'view'=> 'home',
        ];

        $loadResource = $this->loadResource($info['view']);
        $info = array_merge($info,$loadResource);
        $this->load->view('layout/appLayout',$info);
      }catch(Exception  $e){
        echo 'Error [Controller/Login/index]: ',  $e->getMessage(), "\n";
      }
    }else{
      $info =[
        'title'=>'Login minInventory',
        'view'=> 'login/index'
      ];

      $loadResource = $this->loadResource($info['view']);
      $info = array_merge($info,$loadResource);
      $this->load->view('layout/basicLayout',$info);
		}


  }



  public function initLogin(){

    /* $_POST=json_decode(file_get_contents('php://input'),true);

    var_dump($this->input->post()); */

    $user = $this->input->post('user');
    $password=$this->input->post("password");
		$data = $this->userModel->userLogin($user, $password);
    
    $result=[];
		if($data){
			$this->session->set_userdata($data);
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
        'data'=>$_POST
      );
      $this->output->set_status_header(400);

		}
    return $this->output->set_content_type('application/json')->set_output(json_encode($result));
  }

  private function findOnMenu($menu,$prop,$valueFind){
    $elements = array_column($menu,$prop);
    $isInArray = in_array($valueFind,$elements);
    return $isInArray;
  }
  private function loadResource($view =''){
    //general
    $info=[];
    $info['css'][]=[
      'node_modules/admin-lte/dist/css/adminlte.min.css',
      'node_modules/bootstrap/dist/css/bootstrap.min.css'
    ];
    $info['js'][]=[
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/admin-lte/dist/js/adminlte.min.js',
      'node_modules/axios/dist/axios.min.js',
      'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    ];
    if($view === 'home'){
      /* LOAD MENU */
      $this->load->model('menuModel');
      $menu = $this->menuModel->getAllMenu();

      /*SORT MENU WITH  PARENTS  */
      $newMenu =[];
      foreach ($menu as $key => $prop) {
        if(!$prop['parent_menu']){
          $exist = $this->findOnMenu($newMenu,'id',$prop['id']);
          if(!$exist){
            $newMenu[$prop['id']]=$prop;
            $newMenu[$prop['id']]['children']=[];
          }
        }else{
          $newMenu[$prop['parent_menu']]['children'][]=$prop;
        }
      }

      /*  */
      $info['menu']=array_values($newMenu);
    }else if($view === 'login/index'){
      $info['custom_js'][]=[
        'assets/js/api.js',
        'assets/js/loginPage.js'
      ];
    }
    return $info;
  }
}
?>