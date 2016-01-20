<?php
require_once('classes/class.database.php');

class Blogpost
{
  private $id;
  private $title;
  private $titleSlug;
  private $subtitle;
  private $post;
  private $author;
  private $datePosted;
  private $tags = array();

  private $connection;

  function __construct($inID=null, $inTitle=null, $inSlug=null, $inSubtitle=null, 
                        $inPost=null, $inAuthorID=null, $inDatePosted=null)
  {
    $db = new Database();

    if(!empty($inID)) {
      $this->id = $inID;
      
      //setup tags
      $query = "SELECT name FROM tags WHERE id IN (
        SELECT tag_id
        FROM blog_post_tags
        WHERE blog_post_id = $inID);";
        
      $rows = $db->select($query);

      if(!empty($rows)) {
        foreach($rows as $row) {
          array_push($this->tags, $row['name']);
        }
      }
    }
  
    if(!empty($inTitle)) { 
      $this->title = $inTitle;
    }
      
    if(!empty($inSlug)) { 
      $this->titleSlug = $inSlug;
    }
    
    if(!empty($inSubtitle)) {
      $this->subtitle = $inSubtitle;
    }

    if(!empty($inPost)) {
      $this->post = $inPost;
    }

    if(!empty($inAuthorID))
    {     
      $query = "SELECT first_name, last_name FROM people WHERE id = ?";
      
      $params = array($inAuthorID);
      $row = $db->select($query, $params);
      
      $this->author = $row[0]['first_name'] . " " . $row[0]['last_name'];
    }

    if(!empty($inDatePosted)) {
      $this->datePosted = $inDatePosted;
    }
  }
  
  function getID() {
    return $this->id;
  }
  
  function getTitle() {
    return $this->title;
  }
  
  function getTitleSlug() {
    return $this->titleSlug;
  }
  
  function getSubtitle() {
    return $this->subtitle;
  }
  
  function getPost() {
    return $this->post;
  }
  
  function getAuthor() {
    return $this->author;
  }
  
  function getTags() {
    return $this->tags;
  }
  
  function getDatePosted() {
    return $this->datePosted;
  }
}
?>
