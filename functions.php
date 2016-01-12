<?php
require_once('classes/class.blogpost.php');

/*
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
    $query = "SELECT blog_posts.* FROM blog_post_tags "
    . "LEFT JOIN (blog_posts) ON (blog_post_tags.blog_post_id = blog_posts.id) "
    . "WHERE blog_post_tags.tag_id = ? ORDER BY blog_posts.id DESC";
		
		$params = array($tagID);
		$rows = $db->select($query, $params);
  }
  else 
	{
		$query = "SELECT * FROM blog_posts ORDER BY id DESC";
		$rows = $db->select($query);
  }
	
	$postArray = array();
	
	foreach($rows as $row)
	{
			$myPost = new blogpost($row['id'], $row['title'], $row['title_slug'], $row['subtitle'], 
														$row['post'],	$row['author_id'], $row['date_posted']);
														
			array_push($postArray, $myPost);
	}
	
	return $postArray;
}
*/
function getBlogpostsRange($limitStart, $limitEnd) {
	$db = new Database();
	
	$query = "SELECT * FROM blog_posts ORDER BY id DESC LIMIT $limitStart, $limitEnd";
	
	$rows = $db->select($query);
	
	$postArray = array();
	
	foreach($rows as $row) {
		$myPost = new blogpost($row['id'], $row['title'], $row['title_slug'], $row['subtitle'], 
														$row['post'],	$row['author_id'], $row['date_posted']);
														
		array_push($postArray, $myPost);
	}
	
	return $postArray;
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
/******************************************/

function getBlogpostByID($id) {
	
	$db = new Database();
	
	if(!empty($id)) {
		$query = "SELECT * FROM blog_posts WHERE id = ?";
		
		$params = array($id);
		$rows = $db->select($query, $params);
		
		if(!empty($rows)) {
			$post = new Blogpost($rows[0]['id'], $rows[0]['title'], $rows[0]['title_slug'],
														$rows[0]['subtitle'], $rows[0]['post'], $rows[0]['author_id'], 
														$rows[0]['date_posted']);
		}
		else
			return null;
	}
	
	return $post;
}

/*
*$startDate is a DATETIME
*$endDate is a DATETIME
*Returns array of Blogposts within $startDate and $endDate inclusive. 
*Returns empty array if no Blogposts are within the two dates
*/
function getBlogpostsByDateRange($startDate, $endDate) {
	$db = new Database();
	
	$query = "SELECT * FROM blog_posts WHERE date_posted BETWEEN ? AND ?";
	
	$params = array($startDate, $endDate);
	$rows = $db->select($query, $params);
	
	$postArray = array();
	
	if(!empty($rows)) {
		foreach($rows as $row) {
			$post = new Blogpost($row[0]['id'], $row[0]['title'], $row[0]['title_slug'],
														$row[0]['subtitle'], $row[0]['post'], $row[0]['author_id'], 
														$row[0]['date_posted']);
			
			array_push($postArray, $post);
		}
	}
	
	return $postArray;
}

function getLatestBlogpost() {
	$db = new Database();
	
	$query = "SELECT * FROM blog_posts ORDER BY date_posted DESC LIMIT 1";
	$rows = $db->select($query);
	
	if(!empty($row)) {
		$post = new Blogpost($rows[0]['id'], $rows[0]['title'], $rows[0]['title_slug'],
														$rows[0]['subtitle'], $rows[0]['post'], $rows[0]['author_id'], 
														$rows[0]['date_posted']);
	}
	else {
		return null;
	}
	
	return $post;
}

function getEarliestBlogpost() {
	$db = new Database();
	
	$query = "SELECT * FROM blog_posts ORDER BY date_posted LIMIT 1";
	$rows = $db->select($query);
	
	if(!empty($row)) {
		$post = new Blogpost($rows[0]['id'], $rows[0]['title'], $rows[0]['title_slug'],
														$rows[0]['subtitle'], $rows[0]['post'], $rows[0]['author_id'], 
														$rows[0]['date_posted']);
	}
	else {
		return null;
	}
	
	return $post;
}

function getPreviousBlogpost($currentID) {
	$db = new Database();
	
	if(!empty($currentID))
	{	
		$currentPost = getBlogpostByID($currentID);
		$currentPostDate = $currentPost->getDatePosted();
		
		$query = "SELECT * FROM blog_posts WHERE date_posted < ? ORDER BY date_posted DESC LIMIT 1";
		
		$params = array($currentPostDate);
		$rows = $db->select($query, $params);
		
		if(!empty($rows)) {
			$previousPost = new Blogpost($rows[0]['id'], $rows[0]['title'], $rows[0]['title_slug'],
														$rows[0]['subtitle'], $rows[0]['post'], $rows[0]['author_id'], 
														$rows[0]['date_posted']);
		}
		else 
			return null;
	}

	return $previousPost;
}

function getNextBlogpost($currentID) {
	$db = new Database();
	
	if(!empty($currentID))
	{	
		$currentPost = getBlogpostByID($currentID);
		$currentPostDate = $currentPost->getDatePosted();
		
		$query = "SELECT * FROM blog_posts WHERE date_posted > ? ORDER BY date_posted LIMIT 1";
		
		$params = array($currentPostDate);
		$rows = $db->select($query, $params);
		
		if(!empty($rows)) {
			$nextPost = new Blogpost($rows[0]['id'], $rows[0]['title'], $rows[0]['title_slug'],
														$rows[0]['subtitle'], $rows[0]['post'], $rows[0]['author_id'], 
														$rows[0]['date_posted']);
		}
		else
			return null;
	}
	
	return $nextPost;
}

function getTotalBlogpostsCount() {
	$db = new Database();
	
	$row = $db->select("SELECT COUNT(*) as totalPosts FROM blog_posts");
	
	return intval($row[0]['totalPosts']);
}

/*
returns a string (stripped of markup) of $wordLength from a blogpost with $postID
*/
function getPostExcerpt($postID, $wordLength) {
	
	$excerpt = "";
	
	if(!empty($postID)) {
		$post = getBlogpostByID($postID);
	}
	
	$excerpt = strip_tags($post->getPost());
	
	if(str_word_count($excerpt) > $wordLength)
		$excerpt = implode(' ', array_slice(explode(' ', $excerpt), 0, $wordLength));
	
	return $excerpt;
}
?>
