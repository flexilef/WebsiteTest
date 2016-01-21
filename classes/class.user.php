<?php 
require_once(realpath(__DIR__ . '/../includes/config.php'));

class User {
  
  public function is_logged_in() {
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      return true;
    }
  }
  
  public function login($username, $password) {
    
    $hashed = $this->get_user_hash($username);
    
    if($this->verify_hash($password, $hashed) == 1) {
      
      $_SESSION['loggedin'] = true;
      return true;
    }
  }
  
  public function logout() {
    session_destroy();
  }
  
  public function create_hash($value) {
    return $hash = crypt($value, '$2a$12'.substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22));
  }

  private function verify_hash($password, $hash) {
    return $hash == crypt($password, $hash);
  } 
  
  private function get_user_hash($username) {
    try {
      
      $db = new Database();
      
      $query = 'SELECT password '
      . 'FROM blog_members '
      . 'WHERE username = ?';
      
      $params = array($username);
      $row = $db->select($query, $params);
      
      return $row[0]['password'];
    }
    catch(PDOException $e) {
      echo '<p>' .$e->getMessage() .'</p>';
    }
  }
}

?>