<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
	include 'functions.php';
	
	$blogposts = getBlogposts();
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog | Felix Lee</title>
    <link href="/test/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/test/site.css" rel="stylesheet" type="text/css">
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
								<?php foreach($blogposts as $post) : ?>
									<h2> <!-- title/subtitle -->
										<a href="<?php echo "/test/blog/" . $post->getID() . "/" . $post->getTitleSlug(); ?>">
											<?php echo $post->getTitle(); ?> <small><?php echo $post->getSubtitle(); ?></small>
										</a>
									</h2>
									<p> <!-- date posted/author name -->
										<span class="glyphicon glyphicon-calendar"></span>
										<?php echo $post->getDatePosted(); ?>
										<span class="glyphicon glyphicon-user"></span>
										<?php echo $post->getAuthor(); ?>
									</p>
									<p> <!-- post description -->
										<?php echo getPostExcerpt($post->getID(), 45) . '...'; ?> 
									</p>
									<br>
									<p> <!-- Read more button-->
										<a class="btn btn-primary" href="<?php echo "/test/blog/" . $post->getID() . "/" . 
										$post->getTitleSlug(); ?>">Read More</a>
									</p>
									<hr>
								<?php endforeach; ?>
              </div>
							<ul class="pagination">
								<li><a href="#">Previous</a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">Net</a></li>
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
    <script src="test/js/bootstrap.min.js"></script>
  </body>
</html>
