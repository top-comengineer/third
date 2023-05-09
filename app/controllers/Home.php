<?php

  class Home extends Controller{

   public function __construct(){
     
   }

  public function index(){

    $data = [
      'title' => 'welcome index',  
      'description'=>'Simple social network built on the A.Ol Inc Mvc Framework'
    ];


    $this->view('pages/index', $data);
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