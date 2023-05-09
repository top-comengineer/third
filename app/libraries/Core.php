<?php

 /**
  * App Core Class
  * Create URL & Load Core Controller . 
  * URL format -  /controller/methods/params
  */

   class Core {
    
    protected $currentController = "Home";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct(){
   
      
        $url =  $this->getUrl();
        // print_r($url);

      // Look in controller for first value:
        if(file_exists('../app/controllers/'. ucwords($url[0]).'.php')){
            
            // if exsists, set as controller:
            $this->currentController = ucwords($url[0]);
            //unsert 0 index
            unset($url[0]);

        }

        

        //Require the controller 
        require_once '../app/controllers/'. $this->currentController .'.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;


        //Check for second part of url:
        if(isset($url[1])){
            //check to see if method exists in controller
            if(method_exists($this->currentController, $url[1] )){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }

            //! Customize here to redirect : error-handler-page if method is invalid:
           
        }

       // Get params
       $this->params = $url ?  array_values($url) : [];

       // Call a callback with array of params
       call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

      
    }

    public function getUrl(){
         
        if(isset($_GET['url'])){
            
            $url = rtrim($_GET['url'], '/'); //remove whitespace in the url
            $url = filter_var($url, FILTER_SANITIZE_URL); //removes any character disallowed within url context:
            $url = explode('/', $url); //split the url by slash and return it as array

            return $url;
        }

    }

    
   















   }//end of class