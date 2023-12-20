<?php 
include "inc.php";  
$page='about-us';

$rsa=GetPageRecord('*','sys_contentPages','id=1'); 
$pagecontent=mysqli_fetch_array($rsa); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo stripslashes($pagecontent['title']); ?> - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

</head>

<body>


 <?php if($_SESSION['agentUserid']>0){ ?>
<?php include "header.php"; ?>
<?php  } else { ?>
<?php include "loginheader.php"; ?>
<?php } ?>


 
<div class="innpagebanner">
<img src="<?php echo $imgurl; ?><?php echo $pagecontent['image']; ?>">
<div class="container" > <h2><?php echo stripslashes($pagecontent['title']); ?></h2></div><!-- container -->
<div class="discoverheading">
    <h1>disco<span>ver the</span> <br> exper<span>ience</span></h1>
</div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-6">
            <div class="aboutimg">
                <img src="https://partner.tripzygo.travel/images/about1.jpg" alt="">
            </div> <!-- col-lg-6 -->
           
        </div>
        <div class="col-lg-6">
            <div class="aboutheading">
                <h1>About Us</h1>
                <p>When in doubt, step out so you can explore the world around!
                    Trips are indeed the most amazing ways to explore everything
                    that's around you and you can just see yourself moving forward
                    and away from everything that's been stopping you, your stress,
                    your doubts, or anything else that has held you back.</p>
                    <p>When you step out, have a change of the surroundings, you're
                    open to the newness and are busy taking that in which offers
                    you newer moments and memories.
                    </p>
                    <p>We are a business with a team that has deep passion and
                    commitment towards travelling. We're not just any other travel
                    company that you'll find around the corner. Instead, we are your
                    travel partners, travel buddies, if you may call, who help you with
                    the most experiential travel experiences that you will cherish for
                    a lifetime</p>
            </div>
        </div><!-- col-lg-6 -->
       
    </div> <!-- row -->

   
</div><!-- container -->

<section class="vision mt-5">
    <div class="container">
       <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="visionheading">Vision & Mission</h1>
        </div>
       
       </div><!-- rw -->
       <div class="visionbox">
        <p>TripzyGo International is built with the
mission and vision to offer you these

experiences and memories of a lifetime

with travel services, products and
packages that are fully customised to

your specific needs
with travel services, products and
packages that are fully customised to

your specific needs</p>
<div class="line"></div>
       </div>
    </div> <!-- container -->
</section>




<div class="container" class="mt-5">
<div class="row" style="margin:30px;">
    <div class="col-lg-12 text-center">
        <h1 class="ourheading" style="margin-bottom:5px;font-weight:700;font-size:35px;color:#1d2656;">Our Service</h1>
        <p>Our focus is to make sure that you have to do nothing but travel and make <br>
memories. Rest everything, well, we are there to take care of it.</p>
    </div>
    <div class="col-lg-4" style="padding-right:0px;">
    <div class="card text-center">
  <div class="card-body" style="background-color:#1d2656;color:#fff;height:285px;">
  <i style="font-size:44px;margin:12px 0px;" class="fa fa-bed" aria-hidden="true"></i>

    <h5 class="card-title">Hotel Booking</h5>
    
    <p class="card-text" style="font-size:13px;margin-top:12px;">
    We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
    </p>
    
  </div>
</div>
    </div><!-- col-lg-4 -->
    <div class="col-lg-4" style="padding-right:0px;">
    <div class="card text-center">
  <div class="card-body" style="background-color:#1d2656;color:#fff;height:285px;">
  <i class="fa fa-plane" style="font-size:44px;margin:12px 0px;" aria-hidden="true"></i>


    <h5 class="card-title">Flight Booking</h5>
    
    <p class="card-text" style="font-size:13px;margin-top:12px;">
    We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
    </p>
    
  </div>
</div>
    </div><!-- col-lg-4 -->
    <div class="col-lg-4">
    <div class="card text-center">
  <div class="card-body" style="background-color:#1d2656;color:#fff;height:285px;">
  <i class="fa fa-car" style="font-size:44px;margin:12px 0px;" aria-hidden="true"></i>


    <h5 class="card-title">Holiday Package</h5>
    
    <p class="card-text" style="font-size:13px;margin-top:12px;">
    We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
    </p>
    
  </div>
</div>
    </div><!-- col-lg-4 -->
</div><!-- row -->

</div><!-- container -->

<section class="visa">
    <div class="bg">

    </div>
    <div class="visaimg">
        <div class="container">
            <div class="row" style="margin:30px;margin-top:-40px;">
            <div class="col-lg-4" style="margin-top:-66px;padding-right:0px;">
    <div class="card text-center" style="box-shadow:none;">
  <div class="card-body" style="background-color:#fff;color:#000000;height:285px;">
  <i class="fa fa-id-card-o"  style="font-size:44px;margin:12px 0px;"  aria-hidden="true"></i>



    <h5 class="card-title">Visa Assistance</h5>
    
    <p class="card-text" style="font-size:13px;margin-top:12px;">
    We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
    </p>
    
  </div>
</div>
    </div><!-- col-lg-4 -->
    
    <div class="col-lg-4" style="margin-top:-66px;padding-right:0px;">
    <div class="card text-center" style="box-shadow:none;">
  <div class="card-body" style="background-color:#fff;color:#000000;height:285px;">
  <i class="fa fa-handshake-o" style="font-size:44px;margin:12px 0px;" aria-hidden="true"></i>



    <h5 class="card-title">
Cooperate Travel</h5>
    
    <p class="card-text" style="font-size:13px;margin-top:12px;">
    We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
    </p>
    
  </div>
</div>
    </div><!-- col-lg-4 -->
    <div class="col-lg-4" style="margin-top:-66px;">
    <div class="card text-center" style="box-shadow:none;">
  <div class="card-body" style="background-color:#fff;color:#000000;height:285px;">
  <i class="fa fa-users" style="font-size:44px;margin:12px 0px;" aria-hidden="true"></i>



    <h5 class="card-title">
Events</h5>
    
    <p class="card-text" style="font-size:13px;margin-top:12px;">
    We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
We book your stays in the best
locations where you'll be
comfortable and have a good
rest during the trips so that you
can enjoy them to the fullest.
    </p>
    
  </div>
</div>
    </div><!-- col-lg-4 -->
            </div><!-- row -->
        </div><!-- container -->
    </div>
</section>

<section class="reason mt-5">
<div class="container">
 <div class="row mt-3">
        
        <div class="col-lg-6">
            <div class="aboutheading">
                <h1>Reasons to Travel <br>With TripzyGo</h1>
                <p>When in doubt, step out so you can explore the world around!
                    Trips are indeed the most amazing ways to explore everything
                    that's around you and you can just see yourself moving forward
                    and away from everything that's been stopping you, your stress,
                    your doubts, or anything else that has held you back.</p>
                    <p>When you step out, have a change of the surroundings, you're
                    open to the newness and are busy taking that in which offers
                    you newer moments and memories.
                    </p>
                    <p>We are a business with a team that has deep passion and
                    commitment towards travelling. We're not just any other travel
                    company that you'll find around the corner. Instead, we are your
                    travel partners, travel buddies, if you may call, who help you with
                    the most experiential travel experiences that you will cherish for
                    a lifetime</p>
            </div>
        </div><!-- col-lg-6 -->
        <div class="col-lg-6">
            <div class="aboutimg">
                <img src="https://partner.tripzygo.travel/images/about4.jpg" alt="">
            </div> <!-- col-lg-6 -->
           
        </div>
    </div> <!-- row -->
    </div>   <!-- container -->
</section>


<section class="customizedpackage mt-5">
    <div class="container">
        
        <div class="row" style="margin:0px 20px;">
            <div class="col-lg-2 text-center">
                <div class="customicon">
                <i class="fa fa-plane" aria-hidden="true"></i>

                </div>
                <p style="color:#fff;font-size:13px;">Customised <br> Packages</p>
            </div>  <!-- col-lg-4 -->

            <div class="col-lg-2 text-center">
                <div class="customicon">
                <i class="fa fa-camera" aria-hidden="true"></i>


                </div>
                <p style="color:#fff;font-size:13px;">Budgeted <br> Tours</p>
            </div>  <!-- col-lg-4 -->

            <div class="col-lg-2 text-center">
                <div class="customicon">
                <i class="fa fa-volume-control-phone" aria-hidden="true"></i>


                </div>
                <p style="color:#fff;font-size:13px;">24/7 Support & <br> Assitance</p>
            </div>  <!-- col-lg-4 -->

            <div class="col-lg-2 text-center">
                <div class="customicon">
                <i class="fa fa-volume-control-phone" aria-hidden="true"></i>


                </div>
                <p style="color:#fff;font-size:13px;">A Dedicated <br> Travel Executive</p>
            </div>  <!-- col-lg-4 -->

            <div class="col-lg-2 text-center">
                <div class="customicon">
                <i class="fa fa-globe" aria-hidden="true"></i>



                </div>
                <p style="color:#fff;font-size:13px;">World Wide <br> Touring</p>
            </div>  <!-- col-lg-4 -->
          
        </div><!-- row -->
    </div><!-- container -->
</section>


<section class="trip mt-5">
    <div class="container">
    <div class="row mt-3">
        
        <div class="col-lg-5">
            <div class="aboutheading">
                <h1>Trip Packages</h1>
                <p>You can count on us for all your travel
                        needs including personal & business
                        travel. Let us customize your package
                        based on your budget and needs.</p>
                    <p>We are with you right from thought of
                        travel here and there to back to home
                        after memorable trip in India, South
                        east asia, and Europe to have
                        wonderful travel memories in your life
                    </p>
                    <p>TripzyGo is the idea and initiative of two travel enthusiasts who want to offer brilliant travel experiences
to everyone around the world. With new ideas for travel, this leadership is dedicated towards making
travel an inevitable and most cherishable part of peoplée’s lives.</p>
                   
            </div>
        </div><!-- col-lg-6 -->


        <div class="col-lg-7">
            <div class="row">
                <div class="col-lg-6" style="padding-right:0px;">
                    <div class="tripimg">
                    <img src="https://partner.tripzygo.travel/images/about5.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tripimg">
                <img src="https://partner.tripzygo.travel/images/about6.jpg" class="w-100" alt="">
                </div>
                </div>
                <div class="col-lg-12 my-3">

                <div class="tripimg">
                    <img src="https://partner.tripzygo.travel/images/about7.jpg" class="w-100"  alt="">
                    </div>
                </div>
                <div class="col-lg-6"style="padding-right:0px;">
                <div class="tripimg">
                    <img src="https://partner.tripzygo.travel/images/about5.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="tripimg">
                <img src="https://partner.tripzygo.travel/images/about6.jpg" class="w-100" alt="">
                </div>
                </div>
            </div>
        </div><!-- col-lg-6 -->
        
    </div> <!-- row -->
    </div> <!-- container -->
</section>


<section class="ourleadership mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="leaderheading" style="color:#fff;">
                    <h1 style="font-size:37px;font-weight:700;margin-top:25px;">Our Leadership</h1>
                    <p>TripzyGo is the idea and initiative of two travel enthusiasts who want to offer brilliant travel experiences <br>
                        to everyone around the world. With new ideas for travel, this leadership is dedicated towards making <br>
                        travel an inevitable and most cherishable part of peoplée’s lives.
                        </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="leaderone">
                    <div class="leadimg">
                        <img src="https://partner.tripzygo.travel/images/leadertwo.avif" class="w-100" alt="">
                    </div>
                    <p></p>
                </div>
            </div>
            <div class="col-lg-6">

            </div>
        </div><!-- row -->
        
       
    </div> <!-- container -->
</section>














</div>
<?php include "footer.php"; ?>
</body>
</html>
