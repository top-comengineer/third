<?php

  class Entity extends Controller{

   public function __construct(){
     
   }

  public function index(){

    $data = [
      'title' => 'Welcome to Personal Expense Tracking System',  
      'description'=>'Welcome to Your Personal Expense Tracking System'
    ];


    $this->view('entity/index', $data);
  }

  
  public function about(){
   
    $data = [
      'title' => 'About Us',
      'description'=>' App to Share post with other Users'
    ];

    $this->view('pages/about', $data);
  }

  public function login(){

    $this->view('pages/login');
  }



  
 }