<?php 
session_start();
require_once 'config.php';
error_reporting(10);
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<head>
<link rel="stylesheet" href="cars.css" type="text/css">  
<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<header>
    <nav>
      <ul>
        <li><a href="http://localhost/VehicleRental/newpage.php">Home</a></li>
        <li><a href="http://localhost/VehicleRental/logout.php">Logout</a></li>
        
      </ul>
    </nav>
  </header>

<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo"> <img src="images/carlogo.webp" alt="image">
      </div>

      <div class="dealer_info">
        <h2><?php echo htmlentities($result->FullName);?></h2>
        <p><?php echo htmlentities($result->Address);?><br>
          <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country); }}?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       
      <?php include('sidebar.php');?> 


      <div class="col-md-8 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">My Bookings </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
<?php 
$useremail=$_SESSION['login'];
 $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblvehicles.PricePerDay,DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totaldays,tblbooking.BookingNumber  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail order by tblbooking.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>
    <h4 style="color:red">Booking No #<?php echo htmlentities($result->BookingNumber);?></h4>
                <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="images/<?php echo htmlentities($result->Vimage1);?>" alt="image" ></a> </div>
                <div class="vehicle_title">

                <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"> <span style="font-size: 1.8em; font-weight: bold;"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></span></a></h6>
                  <p><b>From </b> <?php echo htmlentities($result->FromDate);?> <b>To </b> <?php echo htmlentities($result->ToDate);?></p>
                  <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result->message);?> </p></div>
                </div>
                <?php if($result->Status==1)
                { ?>
                <div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                           <div class="clearfix"></div>
        </div>

              <?php } else if($result->Status==2) { ?>
 <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
            <div class="clearfix"></div>
        </div>
             


                <?php } else { ?>
 <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
            <div class="clearfix"></div>
        </div>
                <?php } ?>
       
              <li>
                
              <h2 style="color:blue">Invoice</h2>
<table>
  <tr>
    <th>Car Name</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Total Days</th>
    <th>Rent / Day</th>
  </tr>
  <tr>
    <td><?php echo htmlentities($result->VehiclesTitle);?>, <?php echo htmlentities($result->BrandName);?></td>
     <td><?php echo htmlentities($result->FromDate);?></td>
      <td> <?php echo htmlentities($result->ToDate);?></td>
       <td><?php echo htmlentities($tds=$result->totaldays);?></td>
        <td> <?php echo htmlentities($ppd=$result->PricePerDay);?></td>
  </tr>
  <tr>
    <th colspan="4" style="text-align:center;"> Grand Total</th>
    <th><?php echo htmlentities($tds*$ppd);?></th>
  </tr>
</table>
<hr />

              <?php }}  else { ?>
                <h5 align="center" style="color:red">No booking yet</h5>
              <?php } ?>
             
         
            </ul>
          </div>
        </div>
      </div>
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