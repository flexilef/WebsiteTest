<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
	include 'include.php';
	
	$blogpost = getLatestBlogpost();
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog | Felix Lee</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="site.css" rel="stylesheet" type="text/css">
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
            <a class="navbar-brand" href="index.php">BLOG NAME</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="blog.html">Blog</a></li>
              <li><a href="projects.html">Projects</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1><?php echo $blogpost->title?> <small><?php echo $blogpost->subtitle?></small></h1>
          <p class="lead">Written by <?php echo $blogpost->author . " on "?><small><?php echo $blogpost->datePosted?></small></p>
        </div>
        <div class="page-content">
          <div class="row">
            <div class="col-md-8 col-md-offset-1">
              <div class="blog-content">
								<p>
									<?php echo $blogpost->post;?>
              </div>
              <ul class="pager">
                <li><a href="#">Previous</a></li>
                <li><a href="#">Next</a></li>
              </ul>
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
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>