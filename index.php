<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shubham";

// Create a database connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Handle form submission
if(isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password']; 

  // Find user in the database
  $stmt = $pdo->prepare("SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:email");
  $stmt->execute(['email' => $email]);
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    
  // Verify the password
  if(count($results) > 0 && password_verify($password, $results[0]->Password))
  {
    $_SESSION['login'] = $email;
    $_SESSION['fname'] = $results[0]->FullName;
    header('Location: newpage.php');
    exit;
  } 
  else {
    $error = "Invalid Details";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Best Car Rental</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      </ul>
    </nav>
  </header>

  <section class="login-section">
    <div class="container">
      <h1>Login</h1>
      <?php if (isset($error)): ?>
      <div class="alert alert-danger">
        <?= $error ?>
      </div>
      <?php endif; ?>
      <form method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" name="login" value="Login">
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 Best Car Rental. All rights reserved.</p>
  </footer>
</body>
</html>
