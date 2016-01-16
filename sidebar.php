<?php
  $dates = getArchiveDates();
?>

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