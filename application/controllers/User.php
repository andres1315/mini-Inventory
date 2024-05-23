<?php

class User extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('userModel');
  }

  public function index(){
    try{
      $info=[
        'title'=>'Lista Usuarios',
        'view'=>'users/index'
      ];
      $resource = $this->loadResource($info['view']);
      $info=array_merge($info,$resource);
      $this->load->view('layout/appLayout',$info);

    }catch(Execption $e){
      echo 'Error [Controller/User/index]: ',  $e->getMessage(), "\n";

    }
  }

  public function listUsers(){
    try{

      $dataUsers = $this->userModel->getAll();
      $result=[];
      if($dataUsers){
        $result=[
          'status'=>'success',
          'message'=>'ok list users',
          'data'=>$dataUsers
        ];
        $this->output->set_status_header(200);
      }
    return $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }catch(Execption $e){
      echo 'Error [Controller/User/listUser]: ',  $e->getMessage(), "\n";

    }
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
      'node_modules/bootstrap/dist/css/bootstrap.min.css',
      'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
      'node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'
      
    ];
    $info['js'][]=[
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/admin-lte/dist/js/adminlte.min.js',
      'node_modules/axios/dist/axios.min.js',
      'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
      'node_modules/datatables.net/js/jquery.dataTables.min.js',
      'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js'
      ,'node_modules/datatables.net-buttons/js/dataTables.buttons.min.js'
      ,'node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'
      ,'node_modules/datatables.net-buttons/js/buttons.html5.min.js'
      ,'node_modules/datatables.net-buttons/js/buttons.print.min.js'
      ,'node_modules/datatables.net-scroller/js/dataTables.scroller.min.js'
      ,'node_modules/datatables.net-select/js/dataTables.select.min.js'

    ];
    $info['custom_js'][]=[
      'assets/js/api.js',
    ];

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
    if($view === 'users/index'){
      $info['custom_js'][]=[
        'assets/js/users/index.js'
      ];
    }
    return $info;
  }
}