

<!DOCTYPE html>
<html>
<head>
  <title>Vroom Vroom Cars</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
<body>


  <header>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="http://localhost/VehicleRental/logout.php">Logout</a></li>
        <li><a href="http://localhost/VehicleRental/my-booking.php">My Bookings</a></li>
        
      </ul>
    </nav>
  </header>

  <section class="pickup-section">
    <div class="container">
    <h1>The Perfect Car is just around the corner</h1>
            <h1>Book your drive now!</h1>
      <form action="#featured-vehicles" method="GET">
        <label for="pickup-location">Pickup Location</label>
        <input type="text" name="pickup-location" id="pickup-location" placeholder="Enter pickup location" required>
       
       
        <label for="pickup-date">Pickup Date</label>
        <input type="date" name="pickup-date" id="pickup-date" required>

        <label for="dropoff-date">Drop-off Date</label>
        <input type="date" name="dropoff-date" id="dropoff-date" required>

        <input type="submit" value="Search">
      </form>
    </div>
  </section>

  <section class="featured-vehicles" id="featured-vehicles">
    <div class="container">
      <h2>Featured Vehicles</h2>
      <div class="vehicle-list">
        <?php
        require_once 'config.php';
          $featuredVehicles = array(
            array("Car", "images/swift.webp", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "carspg.php"),
            array("SUV", "bgimg.jpg", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "carspgsuv.php"),
            array("Traveller", "trav.jpg", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "carspgtrav.php"),
            array("Bikes", "images/bullet.jpg", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "carspgbike.php"),
            array("Scooty", "images/ntorq.jpg", "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", "carspgscooty.php")
          );

          foreach ($featuredVehicles as $vehicle) {
            echo '<div class="vehicle">';
            echo '<div class="vehicle-image" style="background-image: url(' . $vehicle[1] . ');"></div>';
            echo '<h3>' . $vehicle[0] . '</h3>';
            echo '<p>' . $vehicle[2] . '</p>';
            echo '<a href="' . $vehicle[3] . '" class="browse-link">Browse</a>';
            echo '</div>';
          }
        ?>
      </div>
    </div>
  </section>


  <div class="about-us">
    <div class="container">
      <h2>About Us</h2>
      <p style="color:white;font-size: 15px;">With Vroom Vroom cars, you can experience the convenience of online booking. The cars listed on our platform come with all-India permits that include vehicle insurance. It is extremely easy to pick up the car from the host location. You can drive unlimited KMs, with 100% Free Cancellation up to 6 hours before the trip start,. Car rent per KM starts as low as Rs. 49/hour. From short road trips to quick in-city drives for groceries, meeting friends and family, doctor visits, business trips, we have the cheapest car rental options for all your needs! A hatchback for daily commute, SUV for hills,traveller for a big family vacation,bikes and scooty for short trip with your loved ones..</p>     
      <h1> Why vroom  vroom cars?</h1>
    <h2 class="footer-new-info-description-block-sub-header">
      Unlimited KMs
    </h2>
    <p>You must never stop exploring! That's why you get unlimited KMs with every booking!</p>
    <h2>  Transperant Pricing
    </h2>
    <p> Why to hesitate while booking?
    Come and book a vehicle with us at a rate which is set especailly for you</p> 
  </div>
  </div>

  <section class="customer-support">
  <div class="container">
    <h2>Customer Support</h2>
    <p style="color:white;font-size: 18px;">If you have any questions or need assistance, please email us at <a href="mailto:shubhamsonone88@gmail.com">vroomvroomcars@gmail.com</a>.</p>
  </div>
</section>

<footer>
    <p>&copy; 2023 Best Car Rental. All rights reserved.</p>
  </footer>


  
</body>
</html>
  

