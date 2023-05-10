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
    
    // when add new item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addData']) === true){
      //anitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'      => trim($_POST['addData'][0]),
        'price'     => trim($_POST['addData'][1]),
        'user_id'   => trim($_SESSION['user_id']),
        'category'  => 1
      ];
      if($this->entityModel->addEntity($data)){
        flash('post_message', 'You just added data!');
      }
    }

    // when delete selected item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) === true){
      //anitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if($this->entityModel->deleteEntity($_POST['id'])){
        flash('post_message', 'You just deleted data!');
      }
    }

    // when update selected item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateData']) === true){
      //anitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'      => trim($_POST['updateData'][1]),
        'price'     => trim($_POST['updateData'][2]),
        'category'  => 1,
        'id'        => $_POST['entId']
      ];
      if($this->entityModel->updateEntitty($data)){
        flash('post_message', 'You just updated data!');
      }
    }

    $uniEntities = $this->entityModel->getEntitiesByCat(1);

    $data = [
      "uni_entities" => $uniEntities
    ];
    $this->view('entity/university', $data);
  }
  

  public function monthly(){
    
    // when add new item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addData']) === true){
      //sanitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'      => trim($_POST['addData'][0]),
        'price'     => trim($_POST['addData'][1]),
        'user_id'   => trim($_SESSION['user_id']),
        'category'  => 2
      ];
      if($this->entityModel->addEntity($data)){
        flash('post_message', 'You just added data!');
      }
    }

    // when delete selected item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) === true){
      //sanitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if($this->entityModel->deleteEntity($_POST['id'])){
        flash('post_message', 'You just deleted data!');
      }
    }

    // when update selected item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateData']) === true){
      //sanitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'      => trim($_POST['updateData'][1]),
        'price'     => trim($_POST['updateData'][2]),
        'category'  => 2,
        'id'        => $_POST['entId']
      ];
      if($this->entityModel->updateEntitty($data)){
        flash('post_message', 'You just updated data!');
      }
    }

    $monEntities = $this->entityModel->getEntitiesByCat(2);

    $data = [
      "mon_entities" => $monEntities
    ];
    $this->view('entity/monthly', $data);
  }

  public function household(){
    
    // when add new item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addData']) === true){
      //sanitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'      => trim($_POST['addData'][0]),
        'price'     => trim($_POST['addData'][1]),
        'user_id'   => trim($_SESSION['user_id']),
        'category'  => 3
      ];
      if($this->entityModel->addEntity($data)){
        flash('post_message', 'You just added data!');
      }
    }

    // when delete selected item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) === true){
      //sanitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if($this->entityModel->deleteEntity($_POST['id'])){
        flash('post_message', 'You just deleted data!');
      }
    }

    // when update selected item from entity table
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateData']) === true){
      //sanitize inputed data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name'      => trim($_POST['updateData'][1]),
        'price'     => trim($_POST['updateData'][2]),
        'category'  => 3,
        'id'        => $_POST['entId']
      ];
      if($this->entityModel->updateEntitty($data)){
        flash('post_message', 'You just updated data!');
      }
    }

    $monEntities = $this->entityModel->getEntitiesByCat(3);

    $data = [
      "house_entities" => $monEntities
    ];
    $this->view('entity/household', $data);
  }
 }