<?php

include 'blogpost.php';

function getBlogposts($inID=null, $inTagID=null) 
{
	$db = new database();

  if(!empty($inID)) 
	{
    $query = "SELECT * FROM blog_posts WHERE id = ? ORDER BY id DESC"; 
		
		$params = array($inID);
		$rows = $db->select($query, $params);
  }
  else if(!empty($inTagID)) 
	{
    $query = "SELECT blog_posts.* FROM blog_post_tags LEFT JOIN (blog_posts) ON (blog_post_tags.postID = blog_posts.id) WHERE blog_post_tags.tagID = ? ORDER BY blog_posts.id DESC";
		
		$params = array($tagID);
		$rows = $db->select($query, $params);
  }
  else 
	{
		$query = "SELECT * FROM blog_posts ORDER BY id DESC";
		$rows = $db->select($query);
  }
	
	$postArray = array();
	
	if(!$rows) {
		echo '0 results ';
		echo 'Whole query: ' . $query; 
		}
	else {
		foreach($rows as $row)
		{
			$myPost = new BlogPost($row['id'], $row['title'], $row['title_slug'], $row['subtitle'], 
														$row['post'],	$row['author_id'], $row['date_posted']);
														
			array_push($postArray, $myPost);
		}
	}
	
	return $postArray;
}

function getLatestBlogpost()
{
	$db = new Database();
	
	$query = "SELECT * "
    . "FROM `blog_posts` "
    . "ORDER BY id DESC "
    . "LIMIT 1";
		
	$row = $db->select($query);
	
	$post = new BlogPost($row[0]['id'], $row[0]['title'], $row[0]['title_slug'], $row[0]['subtitle'], 
											$row[0]['post'], $row[0]['author_id'], $row[0]['date_posted']);
	
	return $post;
}

function getLatestBlogpostID() {
	$db = new Database();
	
	$query = "SELECT id FROM blog_posts ORDER BY id DESC LIMIT 1";
	$row = $db->select($query);
	
	return $row[0]['id'];
}

function getEarliestBlogpostID() {
	$db = new Database();
	
	$query = "SELECT id FROM blog_posts ORDER BY id LIMIT 1";
	$row = $db->select($query);
	
	return $row[0]['id'];
}

function getPreviousPostID($postID) {
	
	$db = new Database();
	$earliestPostID = getEarliestBlogpostID();
	
	if(!empty($postID) && ($postID > $earliestPostID))
	{
		$query = "SELECT id FROM blog_posts WHERE id < $postID ORDER BY id DESC LIMIT 1";
		$row = $db->select($query);
		
		return $row[0]['id'];
	}
	
	return null;
}

function getNextPostID($postID) {

	$db = new Database();
	$latestPostID = getLatestBlogpostID();

	if(!empty($postID) && ($postID < $latestPostID))
	{
		$query = "SELECT id FROM blog_posts WHERE id > $postID ORDER BY id LIMIT 1";
		$row = $db->select($query);
		
		return $row[0]['id'];
	}
	
	return null;
}

function getBlogpostFromSlug($inSlug) {
	$db = new Database();
	
	if(!empty($inSlug))
	{
		$query = 'SELECT * FROM blog_posts WHERE title_slug=?';
		
		$params = array($inSlug);
		$row = $db->select($query, $params);
	
		$post = new BlogPost($row[0]['id'], $row[0]['title'], $row[0]['title_slug'], $row[0]['subtitle'], 
												$row[0]['post'], $row[0]['author_id'], $row[0]['date_posted']);
		
		return $post;
	}
	
	return null;
}

function slug($text){ 

  // replace non letter or digits by -
  $text = preg_replace('~[^pLd]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}
?>
