<?php
require_once 'config.php';



// Retrieve the bookings from the database
$stmt = $pdo->query("SELECT bookings.*, users.username, vehicles.model FROM bookings
                    JOIN users ON bookings.user_id = users.id
                    JOIN vehicles ON bookings.vehicle_id = vehicles.id
                    ORDER BY bookings.booking_date DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Bookings - Best Car Rental</title>
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
      <h1>Bookings</h1>
      <?php if (empty($bookings)): ?>
        <p>No bookings found.</p>
      <?php else: ?>
        <table>
          <tr>
            <th>Booking ID</th>
            <th>User</th>
            <th>Vehicle Model</th>
            <th>Booking Date</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
          <?php foreach ($bookings as $booking): ?>
            <tr>
              <td><?= $booking['id'] ?></td>
              <td><?= $booking['username'] ?></td>
              <td><?= $booking['model'] ?></td>
              <td><?= $booking['booking_date'] ?></td>
              <td><?= $booking['start_date'] ?></td>
              <td><?= $booking['end_date'] ?></td>
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
