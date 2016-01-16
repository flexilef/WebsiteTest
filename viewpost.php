<?php
/*
  This page is used to display individual blogposts. .htaccess file
  rewrites links of blogposts to this page. .htaccess also feeds 
  the get parameter to be used to get the selected blogpost.
*/

  require_once('functions.php');
  
  if(!empty($_GET['id'])) {
    
    $currentPostID = $_GET['id'];
    $blogpost = getBlogpostByID($currentPostID);

    if(!is_null($blogpost)) {
      $blogpostID = $blogpost->getID();
      $blogpostTitle = $blogpost->getTitle();
      $blogpostSubtitle = $blogpost->getSubtitle();
      $blogpostSlug = $blogpost->getTitleSlug();
      $blogpostAuthor = $blogpost->getAuthor();
      $blogpostPost = $blogpost->getPost();     
      $blogpostDate = date('M jS Y - H:i:s', strtotime($blogpost->getDatePosted()));
      
      $prevPost = getPreviousBlogpost($currentPostID);
      $nextPost = getNextBlogpost($currentPostID);
  
      if(!is_null($prevPost)) {
        $prevPostID = $prevPost->getID();
        $prevPostSlug = $prevPost->getTitleSlug();
        $prevPostTitle = $prevPost->getTitle();
      }
      
      if(!is_null($nextPost)) {
        $nextPostID = $nextPost->getID();
        $nextPostSlug = $nextPost->getTitleSlug();
        $nextPostTitle = $nextPost->getTitle();
      }
    }
    else {
       header('HTTP/1.0 400 Bad Request', true, 400);
       include('error400.html');
       exit();
    }
  }
  else {
    header('HTTP/1.0 404 Not Found', true, 404);
    include('error404.html');
    exit();
  }
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

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1><b><?php echo $blogpostTitle ?> <small><?php echo $blogpostSubtitle ?></small></b></h1>
          <h2>By <b><?php echo $blogpostAuthor?></b></h2>
            <h2>On <b><?php echo $blogpostDate ?></b></h2>
        </div>
        <div class="page-content">
          <div class="row">
            <div class="col-md-8 col-md-offset-1">
              <div class="blog-content">
                <p>
                  <?php echo $blogpostPost . " postID: " . $currentPostID ;?>
                </p>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <?php
                      if(!is_null($prevPostID)) : ?>
                    <p class="text-right"><b>Previous</b></p>                  
                  <p class="text-right font-decorative"><b>
                    <?php echo '<a href=/test/blog/' . $prevPostID . "/" . $prevPostSlug . '>';?><!--Previous:--><?php echo $prevPostTitle ?><br></a></b>
                    <?php endif; ?>
                  </p>
                </div>
                <div class="cold-md-6">
                    <?php 
                      if(!is_null($nextPostID)) : ?>
                    <p class="text-left"><b>Next</b></p>                  
                  <p class="text-left font-decorative"><b>
                    <?php echo '<a href=/test/blog/' . $nextPostID . "/" . $nextPostSlug . '>';?><!--Next:--> <?php echo $nextPostTitle ?><br></a></b>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-md-offset-1">
              <div class="blog-side text-center">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                  <li>January <span class="badge">#</span></li>
                  <li>February <span class="badge">#</span></li>
                  <li>March <span class="badge">#</span></li>
                  <li>April <span class="badge">#</span></li>
                  <li>May <span class="badge">#</span></li>
                  <li>June <span class="badge">#</span></li>
                  <li>July <span class="badge">#</span></li>
                  <li>August <span class="badge">#</span></li>
                  <li>September <span class="badge">#</span></li>
                  <li>November <span class="badge">#</span></li>
                  <li>December <span class="badge">#</span></li>
                </ol>
              </div>
            </div>
          </div> <!-- End row -->
          <div class="row">
            <div class="col-md-8 col-md-offset-1">
              <div id="disqus_loader">
                <button class="btn btn-default show-comments" type="button"
                        onclick='$.ajaxSetup({cache: true});
          $.getScript("http://flexilef.disqus.com/embed.js");
          $.ajaxSetup({cache: false});
          $("#disqus_loader").remove();'>
                  Display Discussion
                  <span class="glyphicon glyphicon-chevron-down glyph-center"></span>
                </button>
              </div>
              <div id="disqus_thread"></div> <!--Insert this to open Disqus -->
            </div>

            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
          </div>
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
  </body>
</html>
