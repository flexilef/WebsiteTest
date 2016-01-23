<?php 
require_once realpath(__DIR__ . '/../includes/config.php');

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
    <div id="wrap">
      <div class="container">
  
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
        
        <h1> Bleepingbugs Admin Login</h1>

        <form class="form-horizontal" action="" method="post">
          <div class="form-group">
            <label class="control-label col-md-1">Username</label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="username" value="" />
             </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-1">Password</label>
            <div class="col-md-4">
              <input class="form-control" type="password" name="password" value="" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-1 col-md-offset-1">
              <button class="btn btn-default" type="submit" name="submit">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
  


