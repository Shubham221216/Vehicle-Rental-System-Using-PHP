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
        <li><a href="newpage.php">Home</a></li>
        
      </ul>
    </nav>
  </header>

  <section class="login-section">
    <div class="container">
      <h1>Login</h1>

      <?php
require_once 'config.php';


        

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Database connection details
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'shubham';


          // Validate form inputs
          $email = $_POST['email'];
          $password = $_POST['password'];
          $errors = array();
          if (empty($email)) {
            $errors[] = "Email is required";
          }
          if (empty($password)) {
            $errors[] = "Password is required";
          }

          // Check if the user exists in the database
          if (empty($errors)) { 
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            
            if ($user && password_verify($password, $user['password'])) {
              $_SESSION['user_id'] = $user['id'];
              header("Location: newpage.php");
            } else {
              $errors[] = "Invalid username or password";
            }
          }

          // Show errors if there are any
          if (!empty($errors)) {
            echo '<div class="alert alert-danger">';
            echo '<ul>';
            foreach ($errors as $error) {
              echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
            echo '</div>';
          }
        }

     



      ?>
      <form method="POST">
      <label for="email">Email</label>
  <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Login">
      </form>
      <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 Best Car Rental. All rights reserved.</p>
  </footer>
</body>
</html>
