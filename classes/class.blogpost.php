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
  private $tags;
  private $datePosted;
  
  private $connection;

  function __construct($inID=null, $inTitle=null, $inSlug=null, $inSubtitle=null, 
                        $inPost=null, $inAuthorID=null, $inDatePosted=null)
  {
    $db = new Database();

    if(!empty($inID))
    {
      $this->id = $inID;
    } 
  
    if(!empty($inTitle))
    { 
      $this->title = $inTitle;
    }
      
    if(!empty($inSlug))
    { 
      $this->titleSlug = $inSlug;
    }
    
    if(!empty($inSubtitle))
    {
      $this->subtitle = $inSubtitle;
    }

    if(!empty($inPost))
    {
      $this->post = $inPost;
    }

    if(!empty($inAuthorID))
    {     
      $query = "SELECT first_name, last_name FROM people WHERE id = ?";
      
      $params = array($inAuthorID);
      $row = $db->select($query, $params);
      
      //$row[0][] because we know we only return one row (unique author id)
      $this->author = $row[0]['first_name'] . " " . $row[0]['last_name'];
    }

    if(!empty($inDatePosted))  
    {
      //$splitDate = explode("-", $inDatePosted);
      //$this->datePosted = $splitDate[1] . "/" . $splitDate[2] . "/" . $splitDate[0];
      $this->datePosted = $inDatePosted;
    }
    
    //fix the following to use prepared statements
    $postTags = "No Tags";
    if(!empty($inId))
    { 
      $tagArray = array();
      $tagIDArray = array();

      $query = "SELECT tags.*
       FROM blog_post_tags
       LEFT JOIN (tags)
       ON (blog_post_tags.tag_id = tags.id) 
       WHERE blog_post_tags.blog_post_id = " . $inId;
      
      $rows = $db->select($query);
      
      if($rows) {
        foreach($rows as $row)
        {
          array_push($tagArray, $row["name"]);
          array_push($tagIDArray, $row["id"]);
        }
      }
      
      if(sizeof($tagArray) > 0)
      {
        foreach($tagArray as $tag)
        {
          if($postTags == "No Tags")
          {
            $postTags = $tag;
          }
          else
          {
            $postTags = $postTags . "," . $tag;
          }
        }
      }
      $this->tags = $postTags;
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
