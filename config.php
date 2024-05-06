<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'shubham';

try {
  // Create a new PDO instance
  $dbh = new PDO("mysql:host=$host;dbname=$database", $username, $password);

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 
catch (PDOException $e) {
  // Handle connection errors
  echo "Connection failed: " . $e->getMessage();
  exit;
}


?>



