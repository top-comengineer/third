<?php

use app\config\Application; 

require_once './vendor/autoload.php';
require_once './src/config/Index.php';
require_once './src/config/Router.php';
require_once './src/config/Session.php';

// Autoload Core Libraries
spl_autoload_register(function($className){
  require_once './src/config/' . $className . '.php';
});
  
$init = new Application();