<?php
  require_once '../includes/config.php';
  require_once '../includes/functions.php';

  $db = new Database();
  $conn = $db->connect();
  
  if(!$user->isLoggedIn()) {
    header('Location: login.php');
  }
  
  if(isset($_GET['delpost'])) {
    $query = 'DELETE FROM blog_posts '
    . 'WHERE id = ?';
    
    $stmt = $conn->prepare($query);
    $params = array($_GET['delpost']);
    $stmt->execute($params);
    
    header('Location: index.php?action=deleted');
    exit;
  }
  
  if(isset($_GET['action'])) {
    echo '<h3>Post ' .$_GET['action'] .'</h3>';
  }
?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | BleepingBugs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/test/site.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div id="wrap">
      <div class="container">
        <?php require 'menu.php'; ?>
        
        <p class="text-right"><a href='addpost.php'><span class="glyphicon glyphicon-plus"></span>Add Post</a></p>
        <table class="table table-striped table-bordered">
        <tr>
          <th>Title</th>
          <th>Date</th>
          <th>Action</th>
        </tr>

        <?php
          try {
            $postsPerPage = 25;
            $GETParamName = 'p';
            $totalPosts = getTotalBlogpostsCount();

            $pages = new Paginator($postsPerPage, $GETParamName);
            $pages->setTotalItems($totalPosts);

            $offset = $pages->getItemsOffset();
            
            $query = 'SELECT id, title, date_posted '
            . 'FROM blog_posts '
            . 'ORDER BY date_posted DESC '
            . 'LIMIT :offset, :count';
            
            $params = array($offset, $postsPerPage);
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':count', $postsPerPage, PDO::PARAM_INT);
            $stmt->execute();
            
            $rows = $stmt->fetchAll();
            
            foreach($rows as $row) :
              echo '<tr>';
              echo '<td>' . mb_strimwidth($row['title'], 0, 45, "...") .'</td>';
              echo '<td>' .date('M jS Y | H:i:s', strtotime($row['date_posted']));
              ?>
              
            <td>
              <a href="editpost.php?id=<?php echo $row['id'];?>">Edit</a> |
              <a href="javascript:delpost('<?php echo $row['id'];?>','<?php echo $row['title'];?>')">Delete</a>
            </td>
            
            <?php
              echo '</tr>';
              endforeach;
          }
          catch(PDOException $e) {
            echo $e->getMessage();
          } ?>
        </table>
        
        <?php echo $pages->createLinks('./?', 2, 2); ?>
      </div>
    </div>
    <script language="Javascrip" type="text/javascript">
    function delpost(id, title) {
      if(confirm("Are you sure you want to delete '" + title + "'")) {
        window.location.href = 'index.php?delpost=' + id;
      }
    }
    </script>  
  </body>
</html>