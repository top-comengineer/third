<?php

  class Entity extends Controller{

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
   
    $data = [
    ];

    $this->view('entity/university', $data);
  }
  
 }