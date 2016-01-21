<?php
  ob_start();
  session_start();
  
  spl_autoload_register(function ($class_name) {
    
    $class = strtolower($class_name);
    
    //if call from within assets adjust the path
    $classpath = 'classes/class.' .$class . '.php';
    if(file_exists($classpath)) {
      require_once $classpath;
    }
    
    $classpath = '../classes/class.' .$class . '.php';
    if(file_exists($classpath)) {
      require_once $classpath;
    }
    
    //if call from within admin adjust the path
    $classpath = '../../classes/class.'.$class . '.php';
    if ( file_exists($classpath)) {
      require_once $classpath;
    }
  });
  
  $user = new User();
?>