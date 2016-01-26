<?php

  require_once 'includes/functions.php';
  
  $dates = getArchiveDates();
  $tags = getAllTags();
?>

<h1 class="font-decorative"><b>Tags</b></h1>
<ul class="list-inline">
  <?php foreach($tags as $tag) : ?>
    <li>
      <b><a class="font-decorative" href="/test/blog/tags/<?php echo $tag['tag_slug']; ?> ">
      <?php echo $tag['tag_name']; ?></a></b>
    </li>
  <?php endforeach; ?>
</ul>

<h1 class="font-decorative"><b>Archives</b></h1>
<ol class="list-unstyled">
  <?php 
  if(!empty($dates)) :
    foreach($dates as $date) :
      $dateObj = DateTime::createFromFormat('!m', $date['postMonth']);
      $month = $dateObj->format('F');
      $year = $date['postYear'];
                        
      $slug = "/test/blog/archives/" . $date['postMonth'] . "-" . $date['postYear'];
  ?>
  <li class="font-decorative">
    <a href="<?php echo $slug; ?>"><b><?php echo $month . " " . $year; ?></b></a>
  </li>
  <?php endforeach; endif; ?> 
</ol>