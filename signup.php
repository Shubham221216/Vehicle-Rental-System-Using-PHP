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

if(isset($_POST['submit']))
{
    $fname = $_POST['name'];
    $email = $_POST['email']; 
    $mobile = $_POST['mobileno'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    
    // Check if the user already exists
    $stmt = $pdo->prepare("SELECT * FROM tblusers WHERE EmailId = :email");
    $stmt->execute(array(':email' => $email));
    
    if ($stmt->rowCount() == 0) {
        // User does not exist, insert new user
        $sql = "INSERT INTO tblusers(FullName, EmailId, ContactNo, Password) VALUES(:fname, :email, :mobile, :password)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        
        if ($query->execute()) {
            $lastInsertId = $pdo->lastInsertId();
            if($lastInsertId) {
                $_SESSION['user_id'] = $lastInsertId;
                header('Location: index.php');
                exit;
            } else {
                $errorMessage = "Something went wrong. Please try again.";
            }
        } else {
            $errorMessage = "An error occurred. Please try again.";
        }
    } else {
        // Account already exists
        $errorMessage = "An account with this email already exists. Please use a different email.";
    }
}
?> 


<!DOCTYPE html>
<html>
<head>
  <title>Sign Up - Best Car Rental</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="http://localhost/VehicleRental/index.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <section class="signup-section">
    <div class="container">
      <h1>Sign Up</h1>
      <?php if (isset($errorMessage)) : ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
      <?php endif; ?>
      <form action="" method="POST">
        <label for="name">FullName</label>
        <input type="text" name="name" id="name" required>

        <label for="mobileno">Mobile Number</label>
        <input type="text" name="mobileno" id="mobileno" required>

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" name="submit" value="Sign Up">
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 Best Car Rental. All rights reserved.</p>
      </footer>
      </body>
      </html>