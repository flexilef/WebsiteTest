<?php
require_once realpath(__DIR__ . '/../classes/class.blogpost.php');

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
/*************GET BLOGPOSTS FUNCTIONS****************/

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

function getBlogpostsByTag($tagName) {
  $db = new Database();
  
  $query = "SELECT blog_posts.* FROM blog_posts "
    . "JOIN blog_post_tags "
    . "ON blog_posts.id = blog_post_id "
    . "WHERE blog_post_tags.tag_id IN "
    . " (SELECT tags.id "
    . " FROM tags"
    . " WHERE tags.name_slug = ?)";
    
  $params = array($tagName);
  $rows = $db->select($query, $params);
  
  $postArray = array();
  if(!empty($rows)) {
    foreach($rows as $row) {
      $post = new Blogpost($row['id'], $row['title'], $row['title_slug'],
                            $row['subtitle'], $row['post'], $row['author_id'], 
                            $row['date_posted']);
                            
      array_push($postArray, $post);
    }
  }
  
  return $postArray;
}

/*
*$startDate is a DATETIME
*$endDate is a DATETIME
*Returns array of Blogposts within $startDate and $endDate inclusive. 
*Returns empty array if no Blogposts are within the two dates
*/
function getBlogpostsByDateRange($startDate, $endDate) {
  $db = new Database();

  $query = "SELECT * FROM blog_posts WHERE date_posted BETWEEN ? AND ? ORDER BY date_posted";
  
  $params = array($startDate, $endDate);
  $rows = $db->select($query, $params);
  
  $postArray = array();

  if(!empty($rows)) {
    foreach($rows as $row) {
      $post = new Blogpost($row['id'], $row['title'], $row['title_slug'],
                            $row['subtitle'], $row['post'], $row['author_id'], 
                            $row['date_posted']);
      
      array_push($postArray, $post);
    }
  }
  
  return $postArray;
}

/*
$offset is the number of posts to skip
$count is the number of posts starting from offset to select
Returns an array of most recent blogposts
*/
function getRecentBlogposts($offset, $count) {
  $db = new Database();
  $conn = $db->connect();

  $query = "SELECT * FROM blog_posts ORDER BY date_posted DESC LIMIT :offset , :count";
  
  $stmt = $conn->prepare($query);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); 
  $stmt->bindValue(':count', $count, PDO::PARAM_INT); 
  $stmt->execute();
  
  $rows = $stmt->fetchAll();
  
  $postArray = array();
  
  if(!empty($rows)) {
    foreach($rows as $row) {
      $post = new Blogpost($row['id'], $row['title'], $row['title_slug'],
                            $row['subtitle'], $row['post'], $row['author_id'], 
                            $row['date_posted']);
      
      array_push($postArray, $post);      
    }
  }
  
  return $postArray;
}

/*
Returns the blogpost written (By DATETIME) before the blogpost with $currentID
*/
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

/*
Returns the blogpost written (By DATETIME) after the blogpost with $currentID
*/
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

/*********SIDEBAR FUNCTIONS**************/

function getArchiveDates() {
  $db = new Database();
  
  $query = "SELECT DISTINCT MONTH( date_posted ) AS "
    . "postMonth , YEAR( date_posted ) AS postYear "
    . "FROM blog_posts "
    . "ORDER BY date_posted DESC";
    
  $dates = $db->select($query);
  
  return $dates;
}

function getAllTags() {
  $db = new Database();
  
  $query = "SELECT tags.name, tags.name_slug FROM tags";
  $tags = $db->select($query);

  return $tags;
}

/************HELPER FUNCTIONS***********************/

/*
returns a string (stripped of markup) of $wordLength from a blogpost with $postID
*/
function getPostExcerpt($postID, $wordLength) {
  
  $excerpt = "";
  
  if(!empty($postID)) {
    $post = getBlogpostByID($postID);
  
    $excerpt = strip_tags($post->getPost());
  }
  
  if(str_word_count($excerpt) > $wordLength)
    $excerpt = implode(' ', array_slice(explode(' ', $excerpt), 0, $wordLength));
  
  return $excerpt;
}
?>
