<?php 
session_start();
require_once 'config.php';
error_reporting(10);


if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$bookingno=mt_rand(100000000, 999999999);
$ret="SELECT * FROM tblbooking where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid";
$query1 = $dbh -> prepare($ret);
$query1->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query1->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query1->bindParam(':todate',$todate,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

if($query1->rowCount()==0)
{

$sql="INSERT INTO  tblbooking(BookingNumber,userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:bookingno,:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingno',$bookingno,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
} }  else{
 echo "<script>alert('Car already booked for these days');</script>"; 
 echo "<script type='text/javascript'> document.location = 'newpage.php'; </script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental | Vehicle Details</title>
<!--Bootstrap -->
<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="car.css" type="text/css">

<link rel="stylesheet" type="text/css" href="imgslider.css">

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


<body>
<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>

<section id="listing_img_slider">

  <div><img src="images/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="images/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="images/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="images/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
  <?php if($result->Vimage5=="")
{

} else {
  ?>
  <div><img src="images/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php } ?>
</section>


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
        <p><strong><h2>₹<?php echo htmlentities($result->PricePerDay);?> </h2></strong>Per Day</p>
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
            <div style="display: flex; align-items: center;">
  <h2 style="margin-right: 10px;">Reg.Year:</h2>
  <h2><strong><?php echo htmlentities($result->ModelYear);?></strong></h2>

</div>
</li>


            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
            <div style="display: flex; align-items: center;">
            <h2 style="margin-right: 10px;">Fuel Type:</h2>  
            <h2><strong><?php echo htmlentities($result->FuelType);?></strong></h2>
</div>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
            <div style="display: flex; align-items: center;">
            <h2 style="margin-right: 10px;">Seats:</h2>  
            <h2><strong><?php echo htmlentities($result->SeatingCapacity);?></strong></h2>
</div>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
          
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo htmlentities($result->VehiclesOverview);?></p>
              </div>
              
              

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
<?php }} ?>

</div>




<!--Side-Bar-->
<aside class="col-md-3">
      
      
      <div class="sidebar_widget">
        <div class="widget_heading">
          <h2><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h2>
        </div>
        <form method="post">
          <div class="form-group">
            <label>From Date:</label>
            <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
          </div>
          <div class="form-group">
            <label>To Date:</label>
            <input type="date" class="form-control" name="todate" placeholder="To Date" required>
          </div>
          <div class="form-group">
            <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
          </div>
        <?php if(isset ($_SESSION['login']))
            {?>
            <div class="form-group">
              <input type="submit" class="btn"  name="submit" value="Book Now">
            </div>
            <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

            <?php } ?>
        </form>
      </div>
    </aside>
    <!--/Side-Bar--> 
  </div>
  