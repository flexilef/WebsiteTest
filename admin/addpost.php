<?php 
  require_once '../includes/config.php';
  
  if(!$user->isLoggedIn()) {
    header('Location: login.php');
  }
  
  $db = new Database();
  $conn = $db->connect();
  
  if(isset($_POST['submit'])) {
    $_POST = array_map( 'stripslashes', $_POST);
    
    extract($_POST);
    
    if($postTitle == '') {
      $error[] = 'Please enter the title';
    }
    
    if($postContent == '') {
      $error[] = 'Please enter the content';
    }
    
    if(!isset($error)) {
      //add to database
    }
    
    if(isset($error)) {
      foreach($error as $e) {
        echo '<p class="text-danger">' . $e .'</p>';
      }
    }
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
        <?php require 'menu.php'; ?>
        
        <h2 class="text-center">Add Post</h2>
        <form class="form-horizontal" action='' method='post'>
          <div class="form-group">
            <label class="control-label" for="postTitle">Title</label>
            <input class="form-control" type='text' name='postTitle' id="postTitle" value='<?php if(isset($error)) { echo $_POST['postTitle'];} ?>'>
          </div>
          <div class="form-group">
            <label class="control-label" for="postSubtitle">Subtitle</label>
            <input class="form-control" type='text' name='postSubtitle' id="postSubtitle" value='<?php if(isset($error)) { echo $_POST['postSubtitle'];} ?>'>
          </div>
          <div class="form-group">
            <label class="control-label" for="postSubtitle">Content</label>
            <textarea class="form-control" name='postContent' cols='60' rows='10'><?php if(isset($error)) { echo $_POST['postContent'];} ?></textarea>
          </div>
          <div class="form-group">
            <div class="col-md-1">
              <button class="btn btn-default" type='submit' name='submit'>Submit</button>
            </div>
          </div>
        </form>
        
        <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
        </script>
      </div>
    </div>
  </body>
</html>

