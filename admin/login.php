<?php 
require_once(realpath(__DIR__ . '/../includes/config.php'));

if(!$user->is_logged_in()) {
  //header('Location: login.php');
}

var_dump($user->create_hash('flex'));
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Admin Login</title>
  </head>
  
  <body>
    <div id="login">
  
  <?php
  
  if(isset($_POST['submit'])) {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if($user->login($username, $password)) {
      
      //logged in return to index page
      header('Location: index.php');
      exit;
    }
    else {
      $message = '<p>Wrong username or password</p>';
    }
  }
  
  if(isset($message)) {
      echo $message;
  }
  ?>
  
      <form action="" method="post">
        <p><label>Username</label><input type="text" name="username" value="" /></p>
        <p><label>Password</label><input type="text" name="password" value="" /></p>
        <p><label></label><input type="submit" name="submit" value="login" /></p>
      </form>
    </div>
  </body>
</html>
  


