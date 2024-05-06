<?php
require_once 'config.php';


// Retrieve the users from the database
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Users - Best Car Rental</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="admin.php">Admin Home</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="admin-section">
    <div class="container">
      <h1>Users</h1>
      <?php if (empty($users)): ?>
        <p>No users found.</p>
      <?php else: ?>
        <table>
          <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
          </tr>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user['id'] ?></td>
              <td><?= $user['username'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= $user['registration_date'] ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 Best Car Rental. All rights reserved.</p>
  </footer>
</body>
</html>
