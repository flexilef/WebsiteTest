<!DOCTYPE html>

<?php

require_once('functions.php');
require_once('classes/class.paginator.php');

  $postsPerPage = 5;
  $GETParamName = 'p';
  $totalPosts = getTotalBlogpostsCount();

  $pages = new Paginator($postsPerPage, $GETParamName);
  $pages->setTotalItems($totalPosts);

  $offset = $pages->getItemsOffset();
  $blogposts = getRecentBlogposts($offset, $postsPerPage);

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog | BleepingBugs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/test/site.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-inverse navbar-static-top">
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
              <li class="active"><a href="/test/blog">Blog</a></li>
              <li><a href="/test/projects.html">Projects</a></li>
              <li><a href="/test/about.html">About</a></li>
              <li><a href="/test/contact.html">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
      
      <!-- Web Banner -->
      <div class="container-fluid blog-banner text-center">
      </div>       
      <!-- Begin page content -->
      <div class="container">
        <div class="page-content">
          <div class="row">
            <div class="col-md-8 col-md-offset-1">
             <div class="blog-content">
                <?php 
                if(!empty($blogposts)) :
                  foreach($blogposts as $post) : 
                    $postID = $post->getID();
                    $postTitle = $post->getTitle();
                    $postSubtitle = $post->getSubtitle();
                    $postSlug = $post->getTitleSlug();
                    $postAuthor = $post->getAuthor();
                    $postTags = $post->getTags();
                    $postDate = date('M jS Y - H:i:s', strtotime($post->getDatePosted()));
                    $postExcerpt = getPostExcerpt($postID, 45);
                ?>
                  <h1 class="font-decorative"> <!-- title/subtitle -->
                    <a href="<?php echo "/test/blog/" . $postID . "/" . $postSlug ?>">
                      <b><?php echo $postTitle ?> <small><?php echo $postSubtitle ?></small>
                    </a></b>
                  </h1>
                  <p> <!-- date posted/author name -->
                    <span class="glyphicon glyphicon-calendar"></span>
                    <?php echo $postDate ?>
                    <span class="glyphicon glyphicon-user"></span>
                    <?php echo $postAuthor ?>
                    <?php if(!empty($postTags)) : ?>
                    <span class="glyphicon glyphicon-tags"></span>
                    <?php foreach($postTags as $tag) :
                      echo $tag . " "; endforeach; endif; ?>
                  </p>
                  <p> <!-- post description -->
                    <?php echo $postExcerpt . '...'; ?> 
                  </p>
                  <p> <!-- Read more button-->
                    <a class="btn btn-primary" href="<?php echo "/test/blog/" . $postID . "/" . 
                    $postSlug ?>">Read More</a>
                  </p>
                  <hr>
                <?php endforeach; 
                  else : ?>
                  <h1>No Blogposts Found!</h1>
                <?php endif; ?>
              </div>
              <div class="text-center">
                <?php echo $pages->createLinks('blog?', 2, 2); ?>
              </div>
            </div>
            <div class="col-md-3 col-md-offset">
              <div class="blog-side text-center">
                <?php require('sidebar.php'); ?>
              </div>
            </div>
          </div> <!-- End row -->
        </div>
      </div>
    </div>

    <div id="footer">
      <div class="container">
        <ul class="list-inline list-unstyled">
          <li><a class="facebook expand" href="#"></a></li>
          <li><a class="twitter expand" href="#"></a></li>                    
          <li><a class="github expand" href="#"></a></li>
        </ul>
        <p class="text-muted">Copyright &copy 2015 Felix Lee </p>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="site.js"></script>
  </body>
</html>
