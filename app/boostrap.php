<?php
 
 //Load config file:
  require_once 'config/config.php';
  require_once 'helpers/redirect.php';
  require_once 'helpers/session_helper.php';
  require_once 'helpers/auth.php';

 //Autoloader Core Libs
  spl_autoload_register(function($className){
    
    require_once "libraries/".$className .'.php';

  });


 

?>