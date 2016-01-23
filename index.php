<!DOCTYPE html>

<?php

require_once 'includes/functions.php';

$posts = getRecentBlogposts(0, 1);

if(!empty($posts)) {
  $latestPost = $posts[0];
  
  $latestPostID = $latestPost->getID();
  $latestPostTitle = $latestPost->getTitle();
  $latestPostSubtitle = $latestPost->getSubtitle();
  $latestPostSlug = $latestPost->getTitleSlug();
  $latestPostAuthor = $latestPost->getAuthor();
  $latestPostDate = date('M jS Y | H:i:s', strtotime($latestPost->getDatePosted()));
  $latestPostExcerpt = getPostExcerpt($latestPostID, 45);
}
?>

<html>
  <head>  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | BleepingBugs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/test/site.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <!-- Wrap all page content here -->
    <div id="wrap" class="bgcover">

      <!-- Fixed navbar -->
      <div class="navbar navbar-inverse navbar-static-top translucent">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/test">BleepingBugs</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="/test/blog">Blog</a></li>
              <li><a href="/test/projects.html">Projects</a></li>
              <li><a href="/test/about.html">About</a></li>
              <li><a href="/test/contact.html">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-content">
          <div class="jumbotron">
            <h3 class="text-center">Featured Post by <span class="light-emphasis"><?php echo $latestPostAuthor ?></span></h3>
            <h2 class="text-center"><?php echo $latestPostTitle ?> <small><?php echo $latestPostSubtitle ?></small>
            <br><small><?php echo $latestPostDate ?></small>
            </h2>
            <h4 class="text-center">
              <?php echo '"' . $latestPostExcerpt . '..."'; ?>
            </h4>
              <div class="text-center">
                <a class="btn btn-primary " href="<?php echo "/test/blog/" . $latestPostID . "/" . $latestPostSlug;?>">Read More</a>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div id="footer" class="translucent">
      <div class="container">
        <ul class="list-inline list-unstyled">
          <li><a class="facebook expand" href="#"></a></li>
          <li><a class="twitter expand" href="#"></a></li>                    
          <li><a class="github expand" href="#"></a></li>
        </ul>
        <!--<p class="text-muted">Copyright &copy 2015 Felix Lee </p>-->
        <span class="text-muted">Copyright &copy 2015 Felix Lee </span>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/test/js/bootstrap.min.js"></script>
  </body>
</html>