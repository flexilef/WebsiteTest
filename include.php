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
			$myPost = new BlogPost($row['id'], $row['title'], $row['subtitle'], $row['post'],
									$row['author_id'], $row['date_posted']);
				
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
	
	$post = new BlogPost($row[0]['id'], $row[0]['title'], $row[0]['subtitle'], $row[0]['post'],
									$row[0]['author_id'], $row[0]['date_posted']);
	
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

	$query = "SELECT id FROM blog_posts WHERE id < $postID ORDER BY id DESC Limit 1";
	$row = $db->select($query);
	
	return $row[0]['id'];
}

function getNextPostID($postID) {

	$db = new Database();

	$query = "SELECT id FROM blog_posts WHERE id > $postID ORDER BY id Limit 1";
	$row = $db->select($query);
	
	return $row[0]['id'];
}
?>
