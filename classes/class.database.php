<?php

class Database {

  protected static $connection;
  private $host;
  private $username;
  private $password;
  private $dbname;
  
  public function connect() {
      
    if(!isset(self::$connection)) {
      $config = parse_ini_file('/home/bleeping/config.ini');
      
      $host = 'localhost';
      $username = $config['username'];
      $password = $config['password'];
      $dbname = $config['dbname'];
      
      $dsn = "mysql:host=localhost;dbname=" . $dbname . ";charset=utf8";
      $opt = array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        
      
      self::$connection = new PDO($dsn, $username, $password, $opt);
    }
    
    return self::$connection;
  }
  
  //$params is an array of bounded values to the prepared query
  //@return false if query failed else array of results (empty array if no results)
  public function select($query, $params=null) {
  
    $connection = $this->connect();
    
    $stmt = $connection->prepare($query);
    
    if($params == null)
      $stmt->execute();
    else
      $stmt->execute(func_get_arg(1));
    
    $result = $stmt->fetchAll();
    
    return $result;
  }
}
?>