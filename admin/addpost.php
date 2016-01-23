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
    <?php require 'menu.php'; ?>
    
    <h2>Add Post</h2>
    
    <form action='' method='post'>
      <p><label>Title</label><br />
      <input type='text' name='postTitle' value='<?php if(isset($error)) { echo $_POST['postTitle'];} ?>'></p>
      
      <p><label>Subtitle</label><br />
      <input type='text' name='postSubtitle' value='<?php if(isset($error)) { echo $_POST['postSubtitle'];} ?>'></p>
      
      <p><label>Content</label><br />
      <textarea name='postContent' cols='60' rows='10'><?php if(isset($error)) { echo $_POST['postContent'];} ?></textarea></p>
      
      <p><input type='submit' name='submit' value='Submit'></p>
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
  </body>
</html>

