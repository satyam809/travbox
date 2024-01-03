<?php
include "inc.php";
include "config/logincheck.php";
// $page = 'hotels';

// $agentid = $_SESSION['parentAgentId'];

// $roomCount = $_REQUEST['empcount'];
// $adultCount = $_REQUEST['ad'];
// $childCount = $_REQUEST['cd'];

// $bl = GetPageRecord('*', 'taxMaster', 'id=2 ');
// $taxData = mysqli_fetch_array($bl);

// // echo "<pre>";
// // print_r($_SESSION);die;

// if (trim($_POST['action']) == 'roompostaction') {

// 	$HotelSearchDetails = trim($_POST['HotelSearchDetails']);
// 	$HotelSearchArr = json_decode($HotelSearchDetails);





// 	$hotelJsonData = trim($_POST['hotelJsonData']);
// 	$hotelArr = json_decode($hotelJsonData);

// 	$RoomDetails = trim($_POST['RoomDetails']);
// 	$RoomArr = json_decode($RoomDetails);

// 	$uniqueId = trim($hotelArr->id);
// 	$HotelName = trim($hotelArr->name);
// 	$HotelCode = trim($hotelArr->id);
// 	$Rating = trim($hotelArr->rt);
// 	$Address = trim($hotelArr->ad->adr);
// 	$Destination = trim($HotelSearchArr->Destination);
// 	$CheckIn = date('Y-m-d', strtotime($HotelSearchArr->CheckIn));
// 	$CheckOut = date('Y-m-d', strtotime($HotelSearchArr->CheckOut));
// 	$status = "1";


// 	$jsonPost = '{
// 		"hotelId":"' . trim($uniqueId) . '",
// 		"optionId":"' . trim($RoomArr->id) . '"
// 	}';

// 	/*echo '<pre>';
// 	  print_r($jsonPost);
// 	  echo '</pre>';*/

// 	$url = "" . $tripjackhotelurl . "hms/v1/hotel-review"; // URL To Hit
// 	$result = getHotelApiData($url, $jsonPost, $hotelApiKey);
// 	$updatedPriceArr = json_decode($result);
// 	/* echo '<pre>';
// 	  print_r($result);
// 	  echo '</pre>';*/

// 	foreach ($updatedPriceArr->hInfo->ops{
// 		0}->ris as $updatedPriceData) {
// 		$RoomType = trim($updatedPriceData->rt);
// 		$BaseFare += trim($updatedPriceData->tfcs->BF);
// 		$TotalFare += trim($updatedPriceData->tfcs->TF);
// 		$NetFare += trim($updatedPriceData->tfcs->NF);
// 		$TAX += trim($updatedPriceData->tfcs->TAF);
// 		$Inclusion = trim($updatedPriceData->mb);
// 		$ServiceTax = "";
// 		$SvTax = "";
// 		$DisTax = "";
// 		$ExTax = "";
// 	}

// 	$CancellationPolicy = $updatedPriceArr->hInfo->ops{
// 		0}->cnp->pd;
// 	$CancellationPolicy = htmlentities(json_encode($CancellationPolicy, true));
// 	$RoomTypeCode = trim($RoomArr->id);


// 	$hotelCost = calculatehotelcost(encode($agentid), stripslashes($_REQUEST['hotelName']), round($BaseFare), '0');
// 	$baseFare = $BaseFare;
// 	$TotalFareForApi = $TotalFare;
// 	$BookingNote = $updatedPriceArr->hInfo->ops{
// 		0}->inst{
// 		0}->msg;


// 	$Commission = getHotelAgentCommission($BaseFare, stripslashes($_REQUEST['hotelName']));



// 	if ($taxData['applicableType'] == 'commission') {
// 		$agentFinalGST = (($Commission * $taxData['valuePerc']) / 100);
// 	}

// 	if ($taxData['applicableType'] == 'totalfare') {
// 		$agentFinalGST = (($BaseFare * $taxData['valuePerc']) / 100);
// 	}

// 	$clientTax = ($TAX + ($hotelCost[1]));



// 	$rsa = GetPageRecord('*', 'hotelBookingMaster', 'uniqueId="' . $uniqueId . '"');
// 	$checkdupli = mysqli_fetch_array($rsa);

// 	if ($checkdupli['uniqueId'] != $uniqueId) {

// 		$namevalue = 'uniqueId="' . $uniqueId . '",HotelName="' . $HotelName . '",HotelCode="' . $HotelCode . '",Rating="' . $Rating . '",Address="' . $Address . '",RoomType="' . $RoomType . '",RoomTypeCode="' . $RoomTypeCode . '",TaxCode="' . $TAX . '",Amount="' . round($BaseFare) . '",CancellationPolicy="' . $CancellationPolicy . '",ServiceTax="' . $ServiceTax . '",SvTax="' . $SvTax . '",DisTax="' . $DisTax . '",ExTax="' . $ExTax . '",status="' . $status . '",Destination="' . $Destination . '",CheckIn="' . $CheckIn . '",CheckOutDate="' . $CheckOut . '",agentId="' . $agentid . '",addDate="' . date('Y-m-d H:i:s') . '",addBy="' . $_SESSION['userid'] . '",Inclusion="' . $Inclusion . '",BookingNote="' . $BookingNote . '",baseFare="' . $BaseFare . '",tax="' . $TAX . '",totalFare="' . $TotalFare . '",agentBaseFare="' . ($hotelCost[2] - $hotelCost[3]) . '",agentTax="' . ($TAX + ($hotelCost[1] - $hotelCost[3])) . '",agentTotalFare="' . (($hotelCost[2] - $hotelCost[3]) + $TAX) . '",clientBaseFare="' . ($hotelCost[2]) . '",clientTax="' . $clientTax . '",clientTotalFare="' . (($hotelCost[2]) + $TAX) . '",markup="' . $hotelCost[4] . '",agentMarkup="' . $hotelCost[3] . '",agentCommision="' . $Commission . '",agentFinalGST="' . $agentFinalGST . '",taxApplicableType="' . $taxData['applicableType'] . '",taxValuePerc="' . $taxData['valuePerc'] . '",taxApplicableOn="' . $taxData['applicableOn'] . '",TotalRoom="' . trim($HotelSearchArr->TotalRoom) . '",detailArray="' . addslashes(serialize($result)) . '"';
// 		$bookinglastId = addlistinggetlastid('hotelBookingMaster', $namevalue);
// 		$_SESSION['bookinglastId'] = $bookinglastId;
// 	}



// 	$baseFare = $BaseFare;
// 	$TotalFare = (($hotelCost[2]) + $TAX);
// 	$TAX = $clientTax;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title>Hotel Review - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
   <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
   <link href="css/main.css" rel="stylesheet" type="text/css">
   <link href="css/seat_map.css" rel="stylesheet" type="text/css">
   <link href="js/jquery-ui.css" rel="stylesheet" type="text/css">
   <link href="//code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="css/minimal.css">
   <link rel="icon" type="image/x-icon" href="images/favicon.png">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <style>
      #cancelationpolicy table tr td {
         padding: 10px !important;
      }
   </style>
   <style>
      .showonlyaftercheck {
         display: none;
      }
   </style>
</head>

<body>
   <style>
      .img-class::before {
         content: "";
         display: block;
         position: absolute;
         top: 0;
         bottom: 0;
         left: 0;
         right: 0;
         background: rgba(0, 0, 0, 0.5);
         /* Adjust the last value (alpha) for transparency */
         z-index: 1;
         /* Place the overlay on top of the image */
      }

      #header #menu a span {
         color: #666;
         /* width:unset; */
         display: inline-block;
         /* Makes the element behave like an inline element */
         background-color: unset;
         border-radius: 0px;
         /* Example background color */
         /* Example padding */
         /* Example border */
      }

      #header #menu a:hover {
         background-color: unset;
         border: unset;
      }

      #header #menu a {
         border: 0px
      }

      .icon_span {
         display: block !important;
         margin-bottom: -48px;
         margin-left: -32px;
         font-weight: 500;
         font-size: 13px;
         color: #666;
      }

      .image-container {
         display: inline-block;
         /* Ensures the span acts as an inline element */
         transition: filter 0.3s ease;
         /* Smooth transition effect for filter property */
      }

      .image-container:hover img {
         filter: grayscale(100%) brightness(50%) hue-rotate(240deg);
         /* Change the hue-rotate value to get different colors */
      }

      #header {
         height: 62px;
      }

      #header #menu a {
         margin-right: 30px;
      }

      #leftsidemenu .inlist .companyinfobox {
         margin-top: 15px;
      }

      .bodysect {
         margin-top: 20px;
      }

      #header #menu .active {
         background-color: unset;
         border: 0px;
      }

      #header #menu .active {
         border-bottom: 3px solid #3168e8 !important;
         color: #3168e8 !important;
      }

      #header #menu a:hover {
         color: #3168e8;
      }

      .show {}

      #header #logo img {
         height: 50px !important;
      }

      #header #menu a span {
         font-weight: bold;
      }
   </style>
   <div id="header">
      <div id="logo"><a href="<?php echo $fullurl; ?>">
            <img src="<?php //echo $imgurl; 
                        ?><?php echo $LoginUserDetails['companyLogo']; ?>" styel=""></a>
      </div>
      <div id="menu">
         <a style="margin-left:47px;" href="<?php echo $fullurl; ?>">
            <!-- <span><i class="fa fa-th-large" aria-hidden="true"></i></span> -->
            <span><img src="images/icon/5.png" class="img-class" width="25"></span>
            <span class="icon_span  <?php if ($selectedpage == 'dashboard') { ?>active<?php } ?>">Dashbaord</span>
         </a>
         <a href="<?php echo $fullurl; ?>flights">
            <!-- <span><i class="fa fa-plane" aria-hidden="true"></i></span> -->
            <span><img src="images/icon/2.png" class="img-class" width="25"></span>
            <span class="icon_span <?php if ($selectedpage == 'flights') { ?>active<?php } ?>">Flights</span>
         </a>
         <a href="<?php echo $fullurl; ?>hotels">
            <!-- <span><i class="fa fa-hotel"></i></span> -->
            <span><img src="images/icon/10.png" width="25"></span>
            <span class="icon_span <?php if ($selectedpage == 'hotels') { ?>active<?php } ?>">Hotels</span>
         </a>
         <div class="dropdown dropbuton" style="margin-right:10px; float:left;">
            <a href="<?php echo $fullurl; ?>holidays" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <!-- <span><i class="fa fa-umbrella-beach" aria-hidden="true"></i></span> -->
               <span><img src="images/icon/11.png" width="25"></span>
               <span class="icon_span <?php if ($selectedpage == 'holidays') { ?>active<?php } ?>">Holidays</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
               <a class="dropdown-item" href="domestic-holidays">Domestic</a>
               <a class="dropdown-item" href="international-holidays">International</a>
            </div>
         </div>
         <a href="<?php echo $fullurl; ?>forex">
            <!-- <span><i class="fa fa-exchange" aria-hidden="true"></i></span> -->
            <span><img src="images/icon/13.png" width="25"></span>
            <span class="icon_span <?php if ($selectedpage == 'forex') { ?>active<?php } ?>">Forex</span>
         </a>
         <a href="<?php echo $fullurl; ?>cruise">
            <!-- <span><i class="fa fa-ship" aria-hidden="true"></i></span> -->
            <!-- <span class="demo-icon icon-cruise"></span> -->
            <span class="image-container"><img src="images/icon/14.png" width="25"></span>
            <span class="icon_span <?php if ($selectedpage == 'cruise') { ?>active<?php } ?>">Cruise</span>
         </a>
         <div class="dropdown dropbuton" style="margin-right:10px; float:left;">
            <a href="<?php echo $fullurl; ?>services" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <!-- <span><i class="fa fa-globe" aria-hidden="true"></i></span> -->
               <span><img src="images/icon/15.png" width="25"></span>
               <span class="icon_span <?php if ($selectedpage == 'services') { ?>active<?php } ?>">Services</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
               <a href="<?php echo $fullurl; ?>#" <?php if ($selectedpage == 'visa') { ?>class="active" <?php } ?>><span><i class="fa fa-bus" aria-hidden="true"></i></span>Bus<span< /a>
                     <a href="<?php echo $fullurl; ?>visa" <?php if ($selectedpage == 'visa') { ?>class="active" <?php } ?>><span><i class="fa fa-cc-visa" aria-hidden="true"></i></span>Visa</a>
                     <a href="<?php echo $fullurl; ?>int-simcard" <?php if ($selectedpage == 'visa') { ?>class="active" <?php } ?>>
                        <span>
                           <svg style="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sim" viewBox="0 0 16 16">
                              <path d="M2 1.5A1.5 1.5 0 0 1 3.5 0h7.086a1.5 1.5 0 0 1 1.06.44l1.915 1.914A1.5 1.5 0 0 1 14 3.414V14.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-13zM3.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V3.414a.5.5 0 0 0-.146-.353l-1.915-1.915A.5.5 0 0 0 10.586 1H3.5z" fill=""></path>
                              <path d="M5.5 4a.5.5 0 0 0-.5.5V6h2.5V4h-2zm3 0v2H11V4.5a.5.5 0 0 0-.5-.5h-2zM11 7H5v2h6V7zm0 3H8.5v2h2a.5.5 0 0 0 .5-.5V10zm-3.5 2v-2H5v1.5a.5.5 0 0 0 .5.5h2zM4 4.5A1.5 1.5 0 0 1 5.5 3h5A1.5 1.5 0 0 1 12 4.5v7a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 11.5v-7z" fill=""></path>
                           </svg>
                        </span>
                        Int'l SIM
                     </a>
            </div>
         </div>
      </div>
      <div id="rightmenu">
         <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle mainbutton" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span><i class="fa fa-user" aria-hidden="true"></i>
               </span>Account
            </button>
            <button style="display: none;" class="btn btn-secondary dropdown-toggle menubtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
               <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet" style="background-color: #00000080 !important; color: #fff;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Balance: &#8377;<?php echo round($totalwalletBalance); ?></a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-id-card-o" aria-hidden="true"></i> Agent Id: <?php echo makeAgentId($LoginUserDetails['agentId']); ?></a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings"><i class="fa fa-list" aria-hidden="true"></i> Bookings</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings-invoice"><i class="fa fa-file" aria-hidden="true"></i> Invoices</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet"><i class="fa fa-money" aria-hidden="true"></i> Balance Sheet</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>online-recharge"><i class="fa fa-retweet" aria-hidden="true"></i> Online Recharge</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>topup-request"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Top Up Request</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>my-customer"><i class="fa fa-users" aria-hidden="true"></i> Customers</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>settings"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
               <a class="dropdown-item" href="<?php echo $fullurl; ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </div>
         </div>
      </div>
   </div>
   <div class="container" style="margin-top:80px; margin-bottom:20px;">
      <div class="row" id="bookingdatainfo">
         <div class="col-9" style="min-height: 500px;">
            <div class="row">
               <div class="col-12" style="position: relative; margin-bottom: 20px; display: block !important;" id="steponeflightdetails">
                  <h2>Review your Booking</h2>
                  <div class="card cardresult" style="width: 100%;">
                     <div class="card-header">Hotel Information</div>
                     <div class="card-body">
                        <div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="row multiflightbox">
                                    <div class="col-12">
                                       <h4 style="font-size: 20px;">
                                          <strong><span id="address"></span>
                                             <span class="starcatht" style="font-size: 16px; color: #FF9900;" id="category">
                                             </span>
                                          </strong>
                                       </h4>
                                       <div style="font-size: 12px; margin-bottom: 20px;"></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body" style="background-color: #F8F8F8; padding: 10px 15px;">
                                 <table border="0" cellpadding="5" cellspacing="0" style="font-size: 12px; font-weight: 600;">
                                    <tbody>
                                       <tr>
                                          <td colspan="5" align="left" valign="top" style="font-size: 16px; font-weight: 700; color: #FF0000; padding-bottom: 10px;" id="roomType"></td>
                                       </tr>
                                       <tr>
                                          <td align="left" valign="top">
                                             <div style="font-size: 12px; color: #999999;">CHECK IN</div>
                                             <div style="font-size: 16px; color: #000000; font-weight: 800;" id="checkindate"></div>
                                             <div style="font-size: 12px; color: #999999;" id="checkinday"></div>
                                          </td>
                                          <td align="left" valign="middle" style="padding: 0px 20px;">
                                             <div style="padding: 4px 10px; font-size: 12px; border: 1px solid #ddd; background-color: #fff; border-radius: 22px;" id="totalStay"></div>
                                          </td>
                                          <td align="left" valign="top">
                                             <div style="font-size: 12px; color: #999999;">CHECK OUT</div>
                                             <div style="font-size: 16px; color: #000000; font-weight: 800;" id="checkoutdate"></div>
                                             <div style="font-size: 12px; color: #999999;" id="checkoutday"></div>
                                          </td>
                                          <td align="left" valign="top" style="padding: 0px 30px;">&nbsp;</td>
                                          <td align="left" valign="middle" style="font-size: 16px;"><strong id="no-of-adult"></strong>&nbsp;Adults | <span id="no-of-child"></span> Childs&nbsp;|&nbsp;<span id="no-of-room"></span> Rooms</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div style="margin-top: 10px;" id="cancelationDate">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <form onsubmit="proceedToPay(event)" id="proceedToPay">
                     <input type="hidden" name="proceed_to_pay" value="1">
                     <input type="hidden" name="search_id" value="">
                     <input type="hidden" name="hotel_code" value="">
                     <input type="hidden" name="city_code" value="">
                     <input type="hidden" name="group_code" value="">
                     <input type="hidden" name="checkout" value="">
                     <input type="hidden" name="checkin" value="">
                     <input type="hidden" name="payment_type" value="AT_WEB">
                     <div class="card cardresult" style="width: 100%; margin-top: 20px;">
                        <div class="card-header">PAX Details</div>

                        <div class="card-body">
                           <!-- Contacts Form -->
                           <div class="row">
                              <!-- Input -->

                              <div id="totalRooms">
                              </div>
                           </div>
                           <!-- End Contacts Form -->
                        </div>

                     </div>
                     <br>
                     <button type="submit" class="btn btn-primary">Book</button>
                  </form>
               </div>
            </div>
            <div class="col-12" style="position: relative; margin-bottom: 20px; display: none;" id="stepfourpayments">
               <h2>Payments</h2>
               <div class="card cardresult" style="width: 100%;">
                  <div class="card-header">Pay By Wallet</div>
                  <div class="row">
                     <div class="col-4">
                        <div style="padding: 40px 0px; text-align: center; font-size: 30px; border-bottom-left-radius: 5px; border-right: 2px solid #41e0d2; background-color: #e4f8ff; color: #02C4B0;">
                           <div style="font-weight: 600;">₹942</div>
                           <div style="font-size: 14px; color: #000000;"><strong>Your Wallet Balance</strong></div>
                        </div>
                     </div>
                     <div class="col-8">
                        <div class="card-body">
                           <div style="padding-top: 10px; padding-bottom: 10px; font-size: 14px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; By placing this order, you agree to our Terms Of Use and Privacy Policy</div>
                           <input name="termsofuse" type="checkbox" value="1" checked="" disabled="disabled"> I accept <a href="http://localhost/travbox/terms-conditions" target="_blank" style="text-decoration: underline;">terms &amp; conditions</a>
                           <div style="font-size: 14px; margin-bottom: 10px; margin-top: 15px;">
                              <button type="button" class="btn btn-danger" onclick="payandbooknow();">Pay Now ₹560</button>
                           </div>
                           <input name="flightbooking" id="flightbooking" type="hidden" value="0">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-3">
            <div class="card">
               <div class="card-header">
                  Fare Summary
               </div>
               <div class="card-body">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; color:#000000;">
                     <tbody>
                        <tr>
                           <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Supplier Price</td>
                           <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;" id="SupplierFee"></td>
                        </tr>
                        <tr>
                           <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Service Fee</td>
                           <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;" id="ServiceFee"></td>
                        </tr>
                        <tr>
                           <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">GST</td>
                           <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;" id="GstFee"></td>
                        </tr>
                        <tr>
                           <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Total</td>
                           <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;"><span id="Total"></span></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Bootstrap Modal -->
   <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="paymentModalLabel">Confirm Payment</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" style="margin-top: 10px;">
               <h1 class="text-center" style="margin:0px 18%">Do you want to pay ₹<span id="totalAmount"></span>?</h1>
            </div>
            <div class="modal-footer text-center" style="display:block;border-top:none;">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="button" class="btn btn-primary" id="confirmPaymentBtn">Confirm Payment</button>
            </div>
         </div>
      </div>
   </div>
   <script>
      let supplierFee = 0;
      let serviceFee = 0;
      let gstFee = 0;
      let totalPrice = 0;

      function showRoomAndPassenger() {
         var data = JSON.parse(localStorage.getItem('selectedHotelRates'));
         //console.log(JSON.stringify(data));
         var checkin = covertDate(data.checkin);
         var checkout = covertDate(data.checkout);

         // Update HTML elements
         $("#checkindate").append(checkin[0]);
         $("#checkinday").append(checkin[1]);
         $("#checkoutdate").append(checkout[0]);
         $("#checkoutday").append(checkout[1]);
         $("#totalStay").append(data.no_of_rooms + ' Nights');
         $("#no-of-adult").append(data.no_of_adults);
         $("#no-of-child").append(data.no_of_children);
         $("#no-of-room").append(data.no_of_rooms);

         // Update input values
         $("input[name=group_code]").val(data.hotel.rates[0].group_code);
         $("input[name=hotel_code]").val(data.hotel.hotel_code);
         $("input[name=city_code]").val(data.hotel.city_code);
         $("input[name=search_id]").val(data.search_id);
         $("input[name=checkin]").val(data.checkin);
         $("input[name=checkout]").val(data.checkout);

         $("#address").text(data.hotel.address);

         var category = `<i class="fa fa-star" aria-hidden="true"></i>`.repeat(data.hotel.category);
         $("#category").append(category);
         cancellationPolicy(data);

         var html = '';
         var totalAdult = 0;
         var totalChild = 0;

         for (let l = 0; l < data.hotel.rates.length; l++) {
            html += `<p> Booking Item: ${l + 1}</p>`;
            html += `<input type="hidden" name="room_code_BookingItem${l + 1}" value="${data.hotel.rates[l].room_code}">
                        <input type="hidden" name="rate_key_BookingItem${l + 1}" value="${data.hotel.rates[l].rate_key}">`;
            for (var i = 0; i < data.hotel.rates[l].rooms.length; i++) {
               var room = data.hotel.rates[l].rooms[i];
               html += `<input type="hidden" class="BookingItem${l + 1}Room">`;
               html += `<input type="hidden" name="room_reference_BookingItem${l + 1}Room${i + 1}" value="${room.room_reference}">
                        <input type="hidden" name="room_type_BookingItem${l + 1}Room${i + 1}" value="${room.room_type}">
                        <p>Room ${i + 1}</p>
                        <p>Adults</p>`;

               for (var j = 0; j < room.no_of_adults; j++) {
                  totalAdult += room.no_of_adults;
                  html += `<div class="row">
         						<div class="col-sm-2 mb-2">
         							<div class="js-form-message">
         								<label for="title">Title</label>
         								<select class="form-control validate1" name="title_BookingItem${l + 1}Room${i + 1}">
         									<option value="">Select</option>
         									<option value="Mr.">Mr.</option>
         									<option value="Mrs.">Mrs</option>
         									<option value="Ms.">Ms.</option>
         								</select>
         							</div>
         						</div>
         						<div class="col-sm-4 mb-4">
         							<div class="js-form-message">
         								<label for="fullname">Full Name</label>
         								<input type="text" class="form-control validate1" name="name_BookingItem${l + 1}Room${i + 1}" id="fullname" placeholder="" aria-label="" required="" data-msg="Please enter your full name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
         							</div>
         						</div>
         						<div class="col-sm-4 mb-4">
         							<div class="js-form-message">
         								<label for="surname">Surname</label>
         								<input type="text" class="form-control validate1" id="surname" name="surname_BookingItem${l + 1}Room${i + 1}" required="" data-msg="Please enter your surname." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
         								<input type="hidden" name="type_BookingItem${l + 1}Room${i + 1}" value="AD">
         							</div>
         						</div>
         						<div class="w-100"></div>
         					</div>`;
               }

               if (room.no_of_children !== 0) {
                  html += `<h5>Children</h5><br>`;
                  for (var k = 0; k < room.no_of_children; k++) {
                     totalChild += room.no_of_children;
                     html += `<div class="row">
         						<div class="col-sm-2 mb-2">
         							<div class="js-form-message">
         								<label for="title">Title</label>
         								<select class="form-control validate1" name="title_BookingItem${l + 1}Room${i + 1}" id="title">
         									<option value="">Select</option>
         									<option value="Mr.">Mr.</option>
         									<option value="Mrs.">Mrs</option>
         									<option value="Ms.">Ms.</option>
         								</select>
         							</div>
         						</div>
         						<div class="col-sm-4 mb-4">
         							<div class="js-form-message">
         								<label for="fullname">Full Name</label>
         								<input type="text" class="form-control validate1" name="name_BookingItem${l + 1}Room${i + 1}" id="fullname" placeholder="" aria-label="" required="" data-msg="Please enter your full name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
         							</div>
         						</div>
         						<div class="col-sm-4 mb-4">
         							<div class="js-form-message">
         								<label for="surname">Surname</label>
         								<input type="text" class="form-control validate1" id="surname" name="surname_BookingItem${l + 1}Room${i + 1}" required="" data-msg="Please enter your surname." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
         								<input type="hidden" name="type_BookingItem${l + 1}Room${i + 1}" value="CH">
         							</div>
         						</div>
         						<div class="col-sm-2 mb-2">
         							<div class="js-form-message">
         								<label for="age">Age</label>
         								<input type="number" class="form-control validate1" name="age_BookingItem${l + 1}Room${i + 1}" required="" data-msg="Please enter child age." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
         							</div>
         						</div>
         						<div class="w-100"></div>
         					</div>`;
                  }
               }
            }

         }

         $("#totalRooms").html(html);
      }

      function showPriceDetails() {
         var data = JSON.parse(localStorage.getItem('selectedHotelRates'));

         for (let i = 0; i < data.hotel.rates.length; i++) {
            $.ajax({
               url: 'test_search_hotel.php',
               method: 'POST',
               data: {
                  action: 'recheck',
                  group_code: data.hotel.rates[i].group_code,
                  rate_key: data.hotel.rates[i].rate_key,
                  search_id: data.search_id
               },
               dataType: "json", // Change 'dataTypes' to 'dataType'
               success: function(response) {
                  console.log(response.hotel.rate);
                  gstFee += response.hotel.rate.price_details.GST[0].amount;
                  supplierFee += response.hotel.rate.price_details.net[0].amount;
                  serviceFee += response.hotel.rate.price_details.net[1].amount;
                  totalPrice += response.hotel.rate.price;
                  $("#Total").text(`${totalPrice.toFixed(2)}₹`);
                  $("#GstFee").html(`${gstFee.toFixed(2)}₹`);
                  $("#ServiceFee").html(`${serviceFee.toFixed(2)}₹`);
                  $("#SupplierFee").html(`${supplierFee.toFixed(2)}₹`);
               },
               error: function(xhr, status, error) {
                  console.error(error); // Log any errors
               }
            });
         }
      }


      function proceedToPay(event) {
         event.preventDefault();
         var data = JSON.parse(localStorage.getItem('selectedHotelRates'));
         //console.log(data);die;
         let booking_details = {
            "search_id": data.search_id,
            "hotel_code": data.hotel.hotel_code,
            "city_code": data.hotel.city_code,
            "checkout": data.checkout,
            "checkin": data.checkin,
            "payment_type": "AT_WEB",
            "group_code": data.hotel.rates[0].group_code,
            "total_amount": totalPrice,
            "booking_items": []
         };
         //alert(data.hotel.rates.length);
         for (var i = 0; i < data.hotel.rates.length; i++) {
            //console.log(i)
            var room_code = $(`input[name='room_code_BookingItem${i + 1}']`).val();

            var rate_key = $(`input[name='rate_key_BookingItem${i + 1}']`).val();

            var total_rooms = $(`.BookingItem${i + 1}Room`).map(function() {
               return $(this).val();
            }).get();

            var items = {
               room_code: room_code,
               rate_key: rate_key,
               rooms: []
            };
            for (var j = 0; j < total_rooms.length; j++) {
               var room_reference = $(`input[name='room_reference_BookingItem${i + 1}Room${j + 1}']`).val();
               var room_type = $(`input[name='room_type_BookingItem${i + 1}Room${j + 1}']`).val();
               var titles = $(`select[name='title_BookingItem${i + 1}Room${j + 1}']`).map(function() {
                  return $(this).val();
               }).get();
               var names = $(`input[name='name_BookingItem${i + 1}Room${j + 1}']`).map(function() {
                  return $(this).val();
               }).get();
               var surnames = $(`input[name='surname_BookingItem${i + 1}Room${j + 1}']`).map(function() {
                  return $(this).val();
               }).get();
               var types = $(`input[name='type_BookingItem${i + 1}Room${j + 1}']`).map(function() {
                  return $(this).val();
               }).get();
               var ages = [];
               var ages = $(`input[name='age_BookingItem${i + 1}Room${j + 1}']`).map(function() {
                  return $(this).val();
               }).get();
               var room = {
                  "room_reference": room_reference,
                  "room_type": room_type,
                  "paxes": [] // Initialize paxes array for each room
               };
               //console.log(names);die;
               for (var k = 0; k < titles.length; k++) {
                  if (types[k] === 'CH') {
                     var childAge = ages.splice(0, 1);
                     var pax = {
                        "title": titles[k],
                        "name": names[k],
                        "surname": surnames[k],
                        "type": types[k],
                        "age": childAge[0]
                     }
                  } else {
                     var pax = {
                        "title": titles[k],
                        "name": names[k],
                        "surname": surnames[k],
                        "type": types[k]
                     }
                  }
                  room.paxes.push(pax); // Push pax object into paxes array for each room
               }

               items.rooms.push(room);
               //console.log(items);die;
               //booking_details.booking_items.push(items);
            }
            booking_details.booking_items.push(items);
         }
         //console.log(JSON.stringify(booking_details));
         //die;
         $('#paymentModal').modal('show');
         //if (confirm(`Do you want to pay ₹${Math.round(supplierFee + serviceFee + gstFee)}`)) {
         $("#totalAmount").text(Math.round(supplierFee + serviceFee + gstFee))
         $('#confirmPaymentBtn').click(function() {
            $.ajax({
               url: 'test_search_hotel.php',
               method: 'POST',
               data: {
                  'proceed_to_pay': 1,
                  'data': booking_details
               },
               dataType: 'JSON',
               success: function(data) {
                  console.log(data);
                  //die;
                  if (data.status == 'confirmed') {
                     window.location.href = `test-hotel-booked-invoice.php?booking_reference=${data.booking_reference}`;
                  }else {
                     alert(data.message);
                  }
               }

            });
         });
         // }

      }


      function cancellationPolicy(data) {
         var cancelationhtml = `<h3 style="font-size: 14px; font-weight: 800;">Cancellation Policy</h3>
        <div style="padding-top: 10px;">
            <div id="cancelationpolicy">
                <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="font-size: 13px; font-weight: 600;">
                    <thead>
                        <tr>
                            <td bgcolor="#F4F4F4"><strong>From Date</strong></td>
                            <td bgcolor="#F4F4F4"><strong>To Date</strong></td>
                            <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>
                        </tr>
                    </thead>
                    <tbody>`;

         for (var j = 0; j < data.length; j++) {
            if (data[j].cancellation_policy != undefined) {
               cancelationhtml += `<tr>
                <td style="border-bottom: 1px solid #ddd;">${data[j].cancellation_policy.details[j].from}</td>
                <td style="border-bottom: 1px solid #ddd;">${data[j].cancellation_policy.cancel_by_date != undefined ? data[j].cancellation_policy.cancel_by_date : ''}</td>
                <td style="border-bottom: 1px solid #ddd;">₹${data[j].cancellation_policy.details[j].flat_fee}</td>
            </tr>`;
            }
         }

         cancelationhtml += `</tbody>
                </table>
            </div>
        </div>`;

         $("#cancelationDate").append(cancelationhtml);
      }

      function covertDate(inputDate) {
         const dateObj = new Date(inputDate);
         const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
         const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
         const day = dateObj.getDate();
         const month = dateObj.getMonth();
         const year = dateObj.getFullYear();
         const dayOfWeek = dateObj.getDay();
         const formattedDate = `${day} ${monthNames[month]} ${year}`;
         const formattedDayOfWeek = dayNames[dayOfWeek];
         const result = [formattedDate, formattedDayOfWeek];
         return result;
      }
      setTimeout(function() {
         window.location.href = 'hotelsearch.php';
      }, 60000);

      showRoomAndPassenger();
      showPriceDetails();
   </script>
   <?php include "footer.php"; ?>