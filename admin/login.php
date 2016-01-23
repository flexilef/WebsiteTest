<?php 
require_once(realpath(__DIR__ . '/../includes/config.php'));

if(!$user->isLoggedIn()) {
  //header('Location: login.php');
}

?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | BleepingBugs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/test/site.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
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
        <p><label>Password</label><input type="password" name="password" value="" /></p>
        <p><label></label><input type="submit" name="submit" value="login" /></p>
      </form>
    </div>
  </body>
</html>
  


