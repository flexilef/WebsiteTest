<?php

include 'database.php';

class BlogPost 
{
  public $id;
  public $title;
	public $subtitle;
  public $post;
  public $author;
  public $tags;
  public $datePosted;
	
	private $connection;

	function __construct($inId=null, $inTitle=null, $inSubtitle=null, $inPost=null,
						$inAuthorId=null, $inDatePosted=null)
	{
		$db = new Database();

		if(!empty($inId))
		{
			$this->id = $inId;
		} 
  
		if(!empty($inTitle))
		{ 
			$this->title = $inTitle;
		}
		
		if(!empty($inSubtitle))
		{
			$this->subtitle = $inSubtitle;
		}

		if(!empty($inPost))
		{
			$this->post = $inPost;
		}

		if(!empty($inAuthorId))
		{			
			$query = "SELECT first_name, last_name FROM people WHERE id = " . $inAuthorId;
			
			$row = $db->select($query);
			
			//$row[0][] because we know we only return one row (unique author id)
			$this->author = $row[0]['first_name'] . " " . $row[0]['last_name'];
		}

		if(!empty($inDatePosted))  
		{
			$splitDate = explode("-", $inDatePosted);
			$this->datePosted = $splitDate[1] . "/" . $splitDate[2] . "/" . $splitDate[0];
		}

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
}

?>   
