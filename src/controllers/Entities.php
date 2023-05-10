<?php

  class Entities extends Controller{

   public function __construct(){
     $this->entityModel = $this->model('Entity');
     $this->userModel   = $this->model('User');
   }

  // the entity index-method
  public function index(){
    $entities = $this->entityModel->getEntities();
    $data = [
      "entities" => $entities
    ];
    $this->view('entity/index', $data);
  }
  
  public function university(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
      $data = [
        'name'      => trim($_POST['addData'][0]),
        'price'     => trim($_POST['addData'][1]),
        'user_id'   => trim($_SESSION['user_id']),
        'category'  => 1
      ];
      if($this->entityModel->addEntity($data)){
        flash('post_message', 'You just added data!');
        redirect('entities/university');
      }
    }
    $uniEntities = $this->entityModel->getEntitiesByCat(1);

    $data = [
      "uni_entities" => $uniEntities
    ];
    $this->view('entity/university', $data);
  }
  
 }