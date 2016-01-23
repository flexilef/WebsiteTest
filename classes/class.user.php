<?php 
require_once(realpath(__DIR__ . '/../includes/config.php'));

class User {
  
  public function isLoggedIn() {
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      return true;
    }
  }
  
  public function login($username, $password) {
    
    $passwordHash = $this->getUserHash($username);
    
    if($this->verifyHash($password, $passwordHash) == 1) {
      
      $_SESSION['loggedin'] = true;
      return true;
    }
  }
  
  public function logout() {
    session_destroy();
  }
  
  public function createHash($value) {
    
    return $hash = password_hash($value, PASSWORD_DEFAULT);
    //return $hash = crypt($value, '$2a$12'.substr(str_replace('+', '.', //base64_encode(sha1(microtime(true), true))), 0, 22));
  }

  private function verifyHash($password, $hash) {
    return password_verify($password, $hash);
  } 
  
  private function getUserHash($username) {
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