<?php
include "inc.php";
include "config/logincheck.php";

include 'tripjackAPI/APIConstants.php';

include 'tripjackAPI/RestApiCaller.php';



/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);


error_reporting(E_ALL);*/








$randval = rand('000000', '999999');

$_SESSION['randval'] = $randval;



$fromDestinationFlightArr = explode("-", $_SESSION['fromDestinationFlight']);

$toDestinationFlightArr = $_SESSION['toDestinationFlight'];

$totalcommission = 0;



$a = GetPageRecord('*', 'wig_flight_json_bkp', ' id="' . decode($_REQUEST['i']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');
$res = mysqli_fetch_array($a);


$searchJosn = unserialize(stripslashes($res));
// echo '<pre>';
// print_r($searchJosn)
$price_ids = [];
array_push($price_ids, $searchJosn['totalPriceList'][0]['id']);
// $_SESSION['price_id'] = [$price_id_1];



$bookingServiceType = "flight";
$_SESSION['serviceId'] = $res["id"];


if ($_REQUEST['r'] != '') {



  $ab = GetPageRecord('*', 'wig_flight_json_bkp', ' id="' . decode($_REQUEST['r']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');

  $resret = mysqli_fetch_array($ab);



  $str_arr = explode(",", $resret['agfare']);

  $basefare = explode("=", $str_arr[0]);

  $basefareret = $basefare[1];





  $bst = explode("=", $str_arr[1]);

  $basetaxret = $bst[1];



  $bsf = explode("=", $str_arr[2]);

  $totalfareret = $bsf[1];
}




$totalcommission = ($res['acom'] + $resret['acom']);

if ($res['id'] == "" || $res['id'] < 1) {

  echo "Something went wrong...<br>Please back to search page.";

  exit();
}



$ResultIndex = $res['ResultIndex'];
// echo $ResultIndex;

$_SESSION['ResultIndex'] = $ResultIndex;



$ResultIndex2 = $resret['ResultIndex'];


$_SESSION['ResultIndex2'] = $ResultIndex2;





//echo $res['ResultIndex'];







// Inboud and and out bound



if ($_SESSION['tripType'] == 1 || $_SESSION['isRoundTripInt'] == 1) {



  include_once 'tripjackAPI/fareRule.php';


  include_once 'tripjackAPI/reviewSSR.php';

  //print_r($reviewSSRResult);die;	 



} else {







  // For Round Trip	



  // include_once 'tripjackAPI/fareRule.php';

  // include_once 'tripjackAPI/reviewSSR.php';	  



  include_once 'tripjackAPI/fareRuleReturn.php';

  include_once 'tripjackAPI/reviewSSR_Return.php';
}

$fareType=$reviewSSRResult['tripInfos']['0']['totalPriceList'][0]['fareIdentifier'];

if($reviewSSRResult == 400 ){

  ?>
  
  <!-- <div onLoad="loadpop('sold',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=soldout" class=""></div> -->
  
  <script>
    alert("This flight has been sold out. Please search again");
    window.location.href='<?= $fullurl ?>flights';
  </script>
  
  <?php } 

/*

echo  "trip type ".$_SESSION['tripType'];



echo "<pre>";





print_r($fareRuleResult);



echo "<br>*******************<br>";

print_r($reviewSSRResult);

die;

*/



// echo "<pre>";

// print_r($reviewSSRResult);

// die;

$_SESSION['reviewSSRResult'] = $reviewSSRResult;

//settimeout
$second=$reviewSSRResult['conditions']['st'];
//echo '<pre>';
//echo (int)$second * 1000;
$second= (int)$second * 1000;
?>
  <script>
  const second =<?php echo $second; ?>;
  //console.log(second);
  setTimeout(function(){
  window.location.href='<?= $fullurl; ?>flights';
  }, second);
  </script>
<?php


$ssrInfoArr = array();

if (count($reviewSSRResult['tripInfos']['0']['sI']) > 0) {

  $ssrInfoArr = $reviewSSRResult['tripInfos']['0']['sI'][0]['ssrInfo'];

  $_SESSION['fistSegmentKey'] = $reviewSSRResult['tripInfos']['0']['sI'][0]['id'];


}
// die;
// for round

if (count($reviewSSRResult['tripInfos']['1']['sI']) > 0) {

  $ssrInfoArr2 = $reviewSSRResult['tripInfos']['1']['sI'][0]['ssrInfo'];

  $_SESSION['fistSegmentKey2'] = $reviewSSRResult['tripInfos']['1']['sI'][0]['id'];

}

$AdtBf1=round($reviewSSRResult['tripInfos']['0']['totalPriceList'][0]['fd']['ADULT']['fC']['BF']);
$ChdBf1=round($reviewSSRResult['tripInfos']['0']['totalPriceList'][0]['fd']['CHILD']['fC']['BF']);
$InfBF1=round($reviewSSRResult['tripInfos']['0']['totalPriceList'][0]['fd']['INFANT']['fC']['BF']);
$Basic_fare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['BF']);
$Total_fare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF']);
$TotalTax_fare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TAF']);


// For return flight
if ($resret['id'] > 0) {
  $AdtBf2=round($reviewSSRResult['tripInfos']['1']['totalPriceList'][0]['fd']['ADULT']['fC']['BF']);
  $ChdBf2=round($reviewSSRResult['tripInfos']['1']['totalPriceList'][0]['fd']['CHILD']['fC']['BF']);
  $InfBF2=round($reviewSSRResult['tripInfos']['1']['totalPriceList'][0]['fd']['INFANT']['fC']['BF']);
}else{
  $AdtBf2=0;
  $ChdBf2=0;
  $InfBF2=0;
}
$AdtBf=$AdtBf1+$AdtBf2;
$ChdBf=$ChdBf1+$ChdBf2;
$InfBF=$InfBF1+$InfBF2;


$newfare= $reviewSSRResult['alerts'][0]['newFare'];

  // echo  $reviewSSRResult['alerts'][0]['oldFare'];

$bookingIdReviewAPI = $reviewSSRResult['bookingId'];

$_SESSION['bookingIdReviewAPI'] = $bookingIdReviewAPI;



//$totalPriceListArr=$reviewSSRResult['tripInfos']['0']['totalPriceList'][0];

//$AdultFareAmount=$totalPriceListArr['fd']['ADULT']['fC']['TF'];

$totalFareAmountBooking = $reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF'];

$_SESSION['totalFareAmountBooking'] = $totalFareAmountBooking;

$ress=(array) unserialize(stripslashes($res['searchJson']));
$totalPriceListarr = count($ress['totalPriceList']);
for($i =0; $i <= $totalPriceListarr; $i++){
$fareIdentifier=$ress['totalPriceList'][$i]['fareIdentifier'];
$pcc=$res['PCC'];
if($fareIdentifier == $pcc){
$basefareadt=round((float)$ress['totalPriceList'][$i]['fd']['ADULT']['fC']['BF']);
$basefarechd=round((float)$ress['totalPriceList'][$i]['fd']['CHILD']['fC']['BF']);
$basefareinf=round((float)$ress['totalPriceList'][$i]['fd']['INFANT']['fC']['BF']);
//print_r($ress['totalPriceList'][$i]);
}
}

// round trip basefare

if($_REQUEST['r'] != ''){
$ressret=(array) unserialize(stripslashes($resret['searchJson']));
$totalPriceListarr2 = count($ressret['totalPriceList']);
for($i =0; $i <= $totalPriceListarr2; $i++){
$fareIdentifier2=$ressret['totalPriceList'][$i]['fareIdentifier'];
$pcc2=$resret['PCC'];
if($fareIdentifier2 == $pcc2){
$basefareadt2=round((float)$ressret['totalPriceList'][$i]['fd']['ADULT']['fC']['BF']);
$basefarechd2=round((float)$ressret['totalPriceList'][$i]['fd']['CHILD']['fC']['BF']);
$basefareinf2=round((float)$ressret['totalPriceList'][$i]['fd']['INFANT']['fC']['BF']);

}
}
}
// if($newfare != ''){
//   echo $BaseFare1= $Basic_fare;
// }else{
$str_arr = explode(",", $res['agfare']);
$basefare = explode("=", $str_arr[0]);
 $BaseFare1 = ($basefare[1] + $basefareret);
// }           
// if($newfare != ''){
//   echo $Tax1= $TotalTax_fare;
// }else{
  $basefare = explode("=", $str_arr[1]);
   $Tax1 = ($basefare[1] + $basetaxret);
// }
 

 $TotalFare=$BaseFare1 + $Tax1;
//echo '<pre>';

if($newfare != ''){
  $TF= round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF']);
}else{
  $TF=0;  
}
$NCM= round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['NCM']['OT']);
// echo $TF;
// die;
?>
<p class="agentUserId">
  <?php
 
  for($i=1; $i<=1000; $i++){
    echo makeAgentId($LoginUserDetails['agentId']).' ';
  }
 
   ?>
</p>

<div class="confirmation"></div>
<div class="top_bg_ofr_sb2 flightreview flightbooking" style="top: 45px;">

  <div class="container">

    <table border="0" align="left" cellpadding="0" cellspacing="0" class="">

      <tr>

        <td>



          <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox active" id="strp1" onClick="$('#steponeflightdetails').show();$('#steptwopassengerdetails').hide();$('.flightreviewbox').removeClass('active');$('#strp1').addClass('active');$('.hidefooter').show();">

            <tr>

              <td colspan="2">
                <div class="iconfa"><i class="fa fa-plane" aria-hidden="true"></i></div>
              </td>

              <td>
                <div class="steptext">FIRST STEP</div>Flight Itinerary
              </td>

            </tr>

          </table>
        </td>



        <td class="showonlyaftercheck">



          <div class="midline"></div>
        </td>



        <td class="showonlyaftercheck">



          <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox" id="strp2">

            <tr>

              <td colspan="2">
                <div class="iconfa"><i class="fa fa-user" aria-hidden="true"></i></div>
              </td>

              <td>
                <div class="steptext">SECOND STEP</div>Passenger Details
              </td>

            </tr>

          </table>
        </td>

        <td class="showonlyaftercheck">
          <div class="midline"></div>
        </td>

        <td class="showonlyaftercheck">
          <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox" id="strp3" onClick="checkInputs();">

            <tr>

              <td colspan="2">
                <div class="iconfa"><i class="fa fa-file-text-o" aria-hidden="true"></i></div>
              </td>

              <td>
                <div class="steptext">THIRD STEP</div>Review
              </td>

            </tr>

          </table>
        </td>

        <td class="showonlyaftercheck">
          <div class="midline"></div>
        </td>

        <td class="showonlyaftercheck">
          <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox" id="strp4">

            <tr>

              <td colspan="2">
                <div class="iconfa"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></div>
              </td>

              <td>
                <div class="steptext">FINISH STEP</div>Payments
              </td>

            </tr>

          </table>
        </td>

      </tr>

    </table>



  </div>

</div>











<div class="container">

  <form id="flightbookingsubmit" method="post" action="flight-booking-tripjack-action">

    <div class="row" id="bookingdatainfo">

      <div class="col-lg-8 col-sm-12 mobilemin" style="min-height:500px;">



        <input name="coid" id="coid" type="hidden" value="0">



        <div class="row">

          <div class="col-12" style="position:relative; margin-bottom:20px; dis" id="steponeflightdetails"></div>
          <div class="col-12" style="position:relative; margin-bottom:20px;" id="steponeflightdetails__">

            <h2>Flight Details </h2>


            <div class="card cardresult" style="width:100%;">
              <div class="card-header"><?php if ($_SESSION['isRoundTripInt'] == 1) {  ?>International Departure and Return<?php } else { ?>Departure<?php } ?></div>
              <div class="card-body" id="loadonewaytrip">
                <div style="text-align:center; padding:100px 0px; text-align:center;"><img src="images/loadinggif.gif" width="40" style="margin:auto;"></div>
              </div>
              <div class="card-footer confirmfooter departfooter">
              <button type="button" class="btn btn-danger btn-sm float-left" id="backbtn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>  
              <button type="button" class="btn btn-primary confirmpricebtn" style="float: right; cursor: no-drop;">Confirm Price<img style="margin-left:10px" width="24" src="images/loadinggif.gif" ></button></div>
            <div onClick="loadpop('Confirm Price',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmPrice" class="pricechagepopup"></div>
            </div>
            <script>
               $('#loadonewaytrip').load('flightdetailsbox.php?id=<?php echo $res['id']; ?>&preview=1;');
                setTimeout(function() {
                cofirmationprice(<?php echo $TF; ?>);
                }, 1000);

  
                      
            </script>

            <?php 
           
            
            if ($resret['id'] > 0) { ?>
              <div class="card cardresult" style="width:100%;">
                <div class="card-header">Return</div>
                <div class="card-body" id="loadonewaytripreturn">
                  <div style="text-align:center; padding:100px 0px; text-align:center;"><img src="images/loadinggif.gif" width="40" style="margin:auto;"></div>
                </div>
                <div class="card-footer confirmfooter">
              <button type="button" class="btn btn-danger btn-sm float-left" id="backbtn"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>  
              <button type="button" class="btn btn-primary confirmpricebtn" style="float: right; cursor: no-drop;">Confirm Price<img style="margin-left:10px" width="24" src="images/loadinggif.gif" ></button></div>
            <div onClick="loadpop('Confirm Price',this,'500px')" data-toggle="modal" style="pointer-events: none;" data-target=".bs-example-modal-center" popaction="action=confirmPrice" class="pricechagepopup"></div>
              </div>
              
              <script>
                $('.departfooter').hide();
                $('#loadonewaytripreturn').load('flightdetailsbox.php?id=<?php echo $resret['id']; ?>&preview=1;');
              </script>
            <?php } ?>

            <div class="card cardresult" style="width:100%; display:none;">

              <div class="card-header">
                <?php if ($_SESSION['isRoundTripInt'] == 1) { ?>

                  <?php echo stripslashes($res['ORG_CODE']); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo stripslashes($res['DES_CODE']); ?> <span>on <?php echo date('D, M d Y', strtotime($res['DEP_DATE'])); ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $res['DUR']; ?></span>

                <?php } else { ?>

                  <?php echo stripslashes($res['ORG_NAME']); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo stripslashes($res['DES_NAME']); ?> <span>on <?php echo date('D, M d Y', strtotime($res['DEP_DATE'])); ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $res['DUR']; ?></span>
                <?php } ?>

              </div>

              <div class="card-body">

                <div class="detailscontent">

                  <div class="row">

                    <div class="col-12">

                      <?php

                      $j = 0;

                      if (count($reviewSSRResult['tripInfos']['0']['sI']) > 0) {



                        $totalPriceListArr = $reviewSSRResult['tripInfos']['0']['totalPriceList'];



                        $NoOfSeatAvailable = $totalPriceListArr[0]['fd']['ADULT']['sR'];

                        $Baggage = $totalPriceListArr[0]['fd']['ADULT']['bI']['iB'];

                        $CabinBaggage = $totalPriceListArr[0]['fd']['ADULT']['bI']['cB'];



                        foreach ($reviewSSRResult['tripInfos']['0']['sI'] as $flightSegmentResults) {

                          //echo '<pre>';print nl2br(print_r($outbound, true));echo '</pre>';

                          //print_r($flightSegmentResults);





                          $journeytime = $flightSegmentResults['duration'];

                          $fdurhour = floor($journeytime / 60);

                          $fdurmint = $journeytime % 60;



                          $departureDateArr = explode('T', $flightSegmentResults['dt']);

                          $depdate = $departureDateArr[0];

                          $deptime = $departureDateArr[1];





                          $depcity = $flightSegmentResults['da']['city'] . ", " . $flightSegmentResults['da']['country'] . "(" . $flightSegmentResults['da']['code'] . ")";



                          $depcityy = $flightSegmentResults['da']['city'];

                          $depTerminal = $flightSegmentResults['da']['name'] . " " . $flightSegmentResults['da']['terminal'];



                          $tm1 = $deptime;

                          $dtms1 = date('D, d M', strtotime($depdate));

                          $dt1 = date('D, d M Y', strtotime($depdate));







                          $arrDateArr = explode('T', $flightSegmentResults['at']);

                          $arrtime = $arrDateArr[1];

                          $arrDate = $arrDateArr[0];





                          $arrcity = $flightSegmentResults['aa']['city'] . ", " . $flightSegmentResults['aa']['country'] . "(" . $flightSegmentResults['aa']['code'] . ")";



                          $arrcityy = $flightSegmentResults['aa']['city'];

                          $arrTerminal = $flightSegmentResults['aa']['name'] . " " . $flightSegmentResults['da']['terminal'];



                          $tm2 = $arrtime;

                          $dt2 = date('D, d M Y', strtotime($arrDate));



                          $AirlineCode = $flightSegmentResults['fD']['aI']['code'];

                          $airline = $flightSegmentResults['fD']['aI']['name'];

                          $airlinenum = $AirlineCode . "-" . $flightSegmentResults['fD']['fN'] . " " . $flightSegmentResults['fD']['eT'];

                          $FlightNumber = $flightSegmentResults['fD']['fN'];



                          //$ssrSeatFlight1=$obound['Origin']['Airport']['AirportCode']."-".$obound['Destination']['Airport']['AirportCode']." : ".$AirlineCode." ".$FlightNumber;



                      ?>
                          <div class="row multiflightbox">

                            <div class="col-3">

                              <table border="0" cellpadding="0" cellspacing="0">

                                <tr>

                                  <td colspan="2"><img src="<?php echo $imgurl . getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>

                                  <td>

                                    <div class="flightname"><?php echo $airline; ?> </div>

                                    <div class="flightnumber"><?php echo $AirlineCode; ?> <?php echo $FlightNumber; ?></div>



                                  </td>

                                </tr>

                              </table>



                            </div>



                            <div class="col-9">

                              <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size: 12px;">

                                <tr>

                                  <td width="33%" align="center">

                                    <div class="coltime">

                                      <?php echo $dt1; ?> <?php echo $tm1; ?></div>

                                    <div class="graysmalltext">

                                      <?php echo  $depcity; ?></div>

                                  </td>

                                  <td width="33%" align="center">
                                    <div class="nostops"><?php echo $fdurhour . 'H , ' . $fdurmint . 'M'; ?></div>
                                    <div style="margin-top:2px;">Non-Stop</div>
                                  </td>

                                  <td width="33%" align="center">
                                    <div class="coltime">

                                      <?php echo $dt2; ?> <?php echo $tm2; ?></div>

                                    <div class="graysmalltext">

                                      <?php echo $arrcity; ?><br>

                                    </div>
                                  </td>

                                </tr>

                              </table>



                            </div>



                            <?php



                            if ($Baggage != "") {

                            ?>

                              <div style="margin:0px 0px;" class="displaybaggflightdetails"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo 'Baggage:' . $Baggage . ", Cabin Baggage: " . $CabinBaggage; ?>

                              </div>

                            <?php

                            }

                            ?>





                            <?php if ($flightSegmentResults['cT'] > 0) { ?>
                              <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600;   margin-top:20px;margin-bottom: 20px;margin: 15px 0px;">Layover time: <?php echo $hours = intdiv($flightSegmentResults['cT'], 60) . ':' . ($flightSegmentResults['cT'] % 60); ?> hours</div>
                            <?php } ?>

                          </div>



                      <?php $j++;
                        }
                      }


                      ?>



                      <?php if ($j == 0) { ?>

                        <div class="row multiflightbox">

                          <div class="col-4">

                            <table border="0" cellpadding="0" cellspacing="0">

                              <tr>

                                <td colspan="2"><img src="<?php echo $imgurl . getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>

                                <td>

                                  <div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>

                                  <div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>



                                </td>

                              </tr>

                            </table>



                          </div>



                          <div class="col-8">

                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size: 12px;">

                              <tr>

                                <td width="33%" align="center">

                                  <div class="coltime">

                                    <?php echo date('D, M d Y', strtotime(unserialize(stripslashes($res['searchJson']))->D_DATE)); ?> <?php echo stripslashes($res['DEP_TIME']); ?></div>

                                  <div class="graysmalltext">

                                    <?php echo stripslashes($res['ORG_NAME']); ?></div>

                                </td>

                                <td width="33%" align="center">
                                  <div class="nostops"><?php echo $res['DUR']; ?></div>
                                  <div class="graysmalltext"><?php if ($res['STOP'] == 0) { ?>

                                      Non Stop<?php  } else { ?><span style="color:#bf0000 !important;"><?php echo $res['STOP'] . ' Stop '; ?></span><?php } ?></div>
                                </td>

                                <td width="33%" align="center">
                                  <div class="coltime">

                                    <?php echo date('D, M d Y', strtotime(unserialize(stripslashes($res['searchJson']))->A_DATE)); ?><?php echo stripslashes($res['ARRV_TIME']); ?></div>

                                  <div class="graysmalltext">

                                    <?php echo stripslashes($res['DES_NAME']); ?></div>
                                </td>

                              </tr>

                            </table>



                          </div>

                        </div>



                      <?php }  ?>









                      <div class="col-12" style="margin-top:10px;">

                        <button type="button" class="btn btn-outline-secondary btn-sm farerulebtn" onClick="showfarerule('<?php echo encode($res['id']); ?>');">Show Fare Rules</button>

                      </div>

                      <div style=" display:none;" id="showfarerule"></div>



                    </div>

                  </div>



                </div>

              </div>





              <?php if ($resret['id'] > 0 && date('Y', strtotime(unserialize(stripslashes($res['searchJson']))->A_DATE)) > 1970) { ?>


                <div class="card-header">

                  <?php echo stripslashes($resret['ORG_NAME']); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo stripslashes($resret['DES_NAME']); ?> <span>on <?php echo date('D, M d Y', strtotime($resret['DEP_DATE'])); ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $resret['DUR']; ?></span>

                </div>

                <div class="card-body">

                  <div class="detailscontent">

                    <div class="row">

                      <div class="col-12">



                        <?php

                        $j = 0;







                        if (count($reviewSSRResult['tripInfos']['1']['sI']) > 0) {



                          $totalPriceListArr = $reviewSSRResult['tripInfos']['1']['totalPriceList'];



                          $NoOfSeatAvailable = $totalPriceListArr[0]['fd']['ADULT']['sR'];

                          $Baggage = $totalPriceListArr[0]['fd']['ADULT']['bI']['iB'];

                          $CabinBaggage = $totalPriceListArr[0]['fd']['ADULT']['bI']['cB'];



                          foreach ($reviewSSRResult['tripInfos']['1']['sI'] as $flightSegmentResults) {

                            //echo '<pre>';print nl2br(print_r($outbound, true));echo '</pre>';







                            $journeytime = $flightSegmentResults['duration'];

                            $fdurhour = floor($journeytime / 60);

                            $fdurmint = $journeytime % 60;



                            $departureDateArr = explode('T', $flightSegmentResults['dt']);

                            $depdate = $departureDateArr[0];

                            $deptime = $departureDateArr[1];





                            $depcity = $flightSegmentResults['da']['city'] . ", " . $flightSegmentResults['da']['country'] . "(" . $flightSegmentResults['da']['code'] . ")";




                            $depcityy = $flightSegmentResults['da']['city'];

                            $depTerminal = $flightSegmentResults['da']['name'] . " " . $flightSegmentResults['da']['terminal'];



                            $tm1 = $deptime;

                            $dtms1 = date('D, d M', strtotime($depdate));

                            $dt1 = date('D, d M Y', strtotime($depdate));







                            $arrDateArr = explode('T', $flightSegmentResults['at']);

                            $arrtime = $arrDateArr[1];

                            $arrDate = $arrDateArr[0];





                            $arrcity = $flightSegmentResults['aa']['city'] . ", " . $flightSegmentResults['aa']['country'] . "(" . $flightSegmentResults['aa']['code'] . ")";



                            $arrcityy = $flightSegmentResults['aa']['city'];

                            $arrTerminal = $flightSegmentResults['aa']['name'] . " " . $flightSegmentResults['da']['terminal'];



                            $tm2 = $arrtime;

                            $dt2 = date('D, d M Y', strtotime($arrDate));



                            $AirlineCode = $flightSegmentResults['fD']['aI']['code'];

                            $airline = $flightSegmentResults['fD']['aI']['name'];

                            $airlinenum = $AirlineCode . "-" . $flightSegmentResults['fD']['fN'] . " " . $flightSegmentResults['fD']['eT'];

                            $FlightNumber = $flightSegmentResults['fD']['fN'];



                            //$ssrSeatFlight1=$obound['Origin']['Airport']['AirportCode']."-".$obound['Destination']['Airport']['AirportCode']." : ".$AirlineCode." ".$FlightNumber;



                        ?>



                            <div class="row multiflightbox">

                              <div class="col-3">

                                <table border="0" cellpadding="0" cellspacing="0">

                                  <tr>

                                    <td colspan="2"><img src="<?php echo $imgurl . getflightlogo(stripslashes($resret['FLIGHT_NAME'])); ?>" width="32" height="32"></td>

                                    <td>

                                      <div class="flightname"><?php echo $airline; ?> </div>

                                      <div class="flightnumber"><?php echo $airlinecode; ?> <?php echo $FlightNumber; ?></div>



                                    </td>

                                  </tr>

                                </table>



                              </div>



                              <div class="col-9">

                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size: 12px;">

                                  <tr>

                                    <td width="33%" align="center">

                                      <div class="coltime">

                                        <?php echo $dt1; ?> <?php echo $tm1; ?></div>

                                      <div class="graysmalltext">

                                        <?php echo  $depcity; ?></div>

                                    </td>

                                    <td width="33%" align="center">
                                      <div class="nostops"><?php echo $fdurhour . 'H , ' . $fdurmint . 'M'; ?></div>
                                      <div style="margin-top:2px;">Non-Stop</div>
                                    </td>

                                    <td width="33%" align="center">
                                      <div class="coltime">

                                        <?php echo $dt2; ?> <?php echo $tm2; ?></div>

                                      <div class="graysmalltext">

                                        <?php echo $arrcity; ?><br>

                                      </div>
                                    </td>

                                  </tr>

                                </table>



                              </div>



                              <?php



                              if ($Baggage != "") {

                              ?>

                                <div style="margin:0px 0px;" class="displaybaggflightdetails"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo 'Baggage:' . $Baggage . ", Cabin Baggage: " . $CabinBaggage; ?>

                                </div>

                              <?php

                              }

                              ?>






                              <?php if ($flightSegmentResults['cT'] > 0) { ?>
                                <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600;   margin-top:20px;margin-bottom: 20px;">Layover time: <?php echo $hours = intdiv($flightSegmentResults['cT'], 60) . ':' . ($flightSegmentResults['cT'] % 60); ?> hours</div>
                              <?php } ?>

                            </div>



                        <?php $j++;
                          }
                        }  ?>





                        <?php if ($j == 0) { ?>



                          <div class="row multiflightbox">

                            <div class="col-4">

                              <table border="0" cellpadding="0" cellspacing="0">

                                <tr>

                                  <td colspan="2"><img src="<?php echo $imgurl . getflightlogo(stripslashes($resret['FLIGHT_NAME'])); ?>" width="32" height="32"></td>

                                  <td>

                                    <div class="flightname"><?php echo stripslashes($resret['FLIGHT_NAME']); ?></div>

                                    <div class="flightnumber"><?php echo stripslashes($resret['FLIGHT_CODE']); ?>-<?php echo stripslashes($resret['FLIGHT_NO']); ?></div>



                                  </td>

                                </tr>

                              </table>



                            </div>



                            <div class="col-8">

                              <table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size: 12px;">

                                <tr>

                                  <td width="33%" align="center">

                                    <div class="coltime">

                                      <?php echo date('D, M d Y', strtotime(unserialize(stripslashes($resret['searchJson']))->D_DATE)); ?> <?php echo stripslashes($resret['DEP_TIME']); ?></div>

                                    <div class="graysmalltext">

                                      <?php echo stripslashes($resret['ORG_NAME']); ?></div>

                                  </td>

                                  <td width="33%" align="center">
                                    <div class="nostops"><?php echo $resret['DUR']; ?></div>
                                    <div class="graysmalltext"><?php if ($resret['STOP'] == 0) { ?>

                                        Non Stop<?php  } else { ?><span style="color:#bf0000 !important;"><?php echo $resret['STOP'] . ' Stop '; ?></span><?php } ?></div>
                                  </td>

                                  <td width="33%" align="center">
                                    <div class="coltime">

                                      <?php echo date('D, M d Y', strtotime(unserialize(stripslashes($resret['searchJson']))->A_DATE)); ?><?php echo stripslashes($resret['ARRV_TIME']); ?></div>

                                    <div class="graysmalltext">

                                      <?php echo stripslashes($resret['DES_NAME']); ?></div>
                                  </td>

                                </tr>

                              </table>



                            </div>

                          </div>


                        <?php } ?>









                        <div class="col-12" style="margin-top:20px;">

                          <button type="button" class="btn btn-outline-secondary btn-sm farerulebtn2" onClick="showfarerule2('<?php echo encode($resret['id']); ?>');">Show Fare Rules</button>

                        </div>

                        <div style=" display:none;" id="showfarerule2"></div>



                      </div>

                    </div>



                  </div>

                </div>

              <?php } ?>





            </div>



          </div>





          <div class="col-12" style="position:relative; display:none;" id="steptwopassengerdetails">

            <h2>Passenger Details<script>
                function clearfield() {
                  $('#steptwopassengerdetails input').val('');
                  $('#steptwopassengerdetails select').val('');
                }
              </script>

              <button type="button" class="btn btn-danger btn-sm float-left tpbtn" style="position: absolute; right: 80px; background-color:#CC3300;border:1px solid #CC3300;" onClick="clearfield();">Clear</button><button type="button" class="btn btn-danger btn-sm float-left tpbtn" style="position: absolute; right: 0px;" onClick="loadpop('Import Customer',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=importcustomertobooking">Import</button>
            </h2>

            <div class="card cardresult cardresult_detail" style="width:100%;">







              <!-- Input -->

              <?php //$param_arr = unserialize(stripslashes($res['PARAM_DATA'])); 
              ?>





              <?php for ($adult = 1; $adult <= $_SESSION['ADT']; $adult++) { ?>



                <div class="card-header">Adult <?php echo $adult; ?> (12 + yrs)</div>



                <div class="card-body">

                  <div class="row">

                    <div class="col-sm-2 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                          Title<span style="color:red;">*</span>

                        </label>

                        <select class="form-control validate1" name="titleAdt<?php echo $adult; ?>" id="titleAdt<?php echo $adult; ?>">

                          <option value="">Select</option>
                        	<option value="Mr">Mr.</option> 
													<option value="Mrs">Mrs</option> 
													
													<option value="Ms">Ms.</option> 
													<!--<option value="Ms">Ms.</option> 
													<option value="Mx">Mx.</option> 
													<option value="Dr">Dr.</option>  
													<option value="Brig Gen">Brig Gen</option> 
													<option value="Prof">Prof</option>
													<option value="Rev">Rev</option> 
													<option value="Sqr. Leader">Sqr. Leader</option>-->

                        </select>
                        <div class="error-message titleAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>

                      </div>

                    </div>



                    <div class="col-sm-4 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        First Name<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="firstNameAdt<?php echo $adult; ?>" id="firstNameAdt<?php echo $adult; ?>" placeholder="" aria-label="" required data-msg="Please enter your first name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message firstNameAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>

                      </div>

                    </div>

                    <!-- End Input -->



                    <!-- Input -->

                    <div class="col-sm-3 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        Last name<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="lastNameAdt<?php echo $adult; ?>" id="lastNameAdt<?php echo $adult; ?>" required data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message lastNameAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>
                    <?php if ($_SESSION['isdomestic'] == 'No') { if($fareType == "SENIOR_CITIZEN"){ ?>
                      <div class="col-sm-3 mb-4" style="display:block;">

                        <div class="js-form-message">

                          <label class="form-label typeadt" data-type="adult">

                          DOB<span style="color:red;">*</span>

                          </label >

                          <!-- <div id="datepickerWrapperFromadt<?php //echo $adult; ?>" class="u-datepicker input-group"> -->

                            <!-- <div class="input-group-prepend"> <span class="d-flex align-items-center mr-2"> <i class="flaticon-calendar text-primary font-weight-semi-bold"></i> </span> </div> -->

                            <input class="form-control validate1 datepickerfieldadt dobAdt" id="dobAdt<?php echo $adult; ?>" data-countadt="<?php echo $adult; ?>" name="dobAdt<?php echo $adult; ?>" readonly="readonly" value="">
                            <div class="error-message dobAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>

                            <div class="error-message  agealertAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Age must be less than 60 years<div class="ixi-icon-error"></div></div>




                          <!-- </div> -->

                        </div>

                        </div>
                        <?php }else{ ?>
                        <div class="col-sm-3 mb-4" style="display:block;">

                          <div class="js-form-message">

                            <label class="form-label">

                            DOB<span style="color:red;">*</span>

                            </label>

                            <div id="datepickerWrapperFromadt<?php echo $adult; ?>" class="u-datepicker input-group">

                              <div class="input-group-prepend"> <span class="d-flex align-items-center mr-2"> <i class="flaticon-calendar text-primary font-weight-semi-bold"></i> </span> </div>

                              <input class="font-size-lg-16 form-control validate1 border-1 datepickerfield" id="dobAdt<?php echo $adult; ?>" name="dobAdt<?php echo $adult; ?>" readonly="readonly" value="">
                              <div class="error-message dobAdt<?php echo $adult; ?>" style="color: red; display: none; color: red; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>




                            </div>

                          </div>

                        </div>



                  <?php } }
                  elseif($fareType == "SENIOR_CITIZEN"){ ?>

                    <div class="col-sm-3 mb-4" style="display:block;">

                    <div class="js-form-message">

                      <label class="form-label typeadt" data-type="adult">

                      DOB<span style="color:red;">*</span>

                      </label >

                        <input class="form-control validate1 datepickerfieldadt dobAdt" id="dobAdt<?php echo $adult; ?>" data-countadt="<?php echo $adult; ?>" name="dobAdt<?php echo $adult; ?>" readonly="readonly" value="">
                        <div class="error-message dobAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>

                        <div class="error-message  agealertAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Age must be less than 60 years<div class="ixi-icon-error"></div></div>

                    </div>

                    </div>

                 <?php } ?>

                    <?php if ($fareType == "STUDENT" || $fareType == "SENIOR_CITIZEN") { ?>

                    <div class="col-sm-3 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        Valid ID Number<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="docId<?php echo $adult; ?>" id="docId<?php echo $adult; ?>" required data-msg="Please enter document id name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message docId<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>

                    <?php } ?>

                    <!-- End Input -->



                    <div class="w-100"></div>



                    <!-- Input -->



                    <!-- End Input -->

                    <?php if ($_SESSION['isdomestic'] == 'No') { ?>

                      <!-- Input -->

                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Provided Country<span style="color:red;">*</span>

                          </label>

                          <select class="form-control validate1 js-select selectpicker dropdown-select" id="nationalityAdt<?php echo $adult; ?>" name="nationalityAdt<?php echo $adult; ?>" data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success" data-live-search="true" data-style="form-control validate1 font-size-16 border-width-2 border-gray font-weight-normal">

                            <option value="">Select country</option>

                            <option value="AF">Afghanistan</option>

                            <option value="AX">Åland Islands</option>

                            <option value="AL">Albania</option>

                            <option value="DZ">Algeria</option>

                            <option value="AS">American Samoa</option>

                            <option value="AD">Andorra</option>

                            <option value="AO">Angola</option>

                            <option value="AI">Anguilla</option>

                            <option value="AQ">Antarctica</option>

                            <option value="AG">Antigua and Barbuda</option>

                            <option value="AR">Argentina</option>

                            <option value="AM">Armenia</option>

                            <option value="AW">Aruba</option>

                            <option value="AU">Australia</option>

                            <option value="AT">Austria</option>

                            <option value="AZ">Azerbaijan</option>

                            <option value="BS">Bahamas</option>

                            <option value="BH">Bahrain</option>

                            <option value="BD">Bangladesh</option>

                            <option value="BB">Barbados</option>

                            <option value="BY">Belarus</option>

                            <option value="BE">Belgium</option>

                            <option value="BZ">Belize</option>

                            <option value="BJ">Benin</option>

                            <option value="BM">Bermuda</option>



                            <option value="BT">Bhutan</option>

                            <option value="BO">Bolivia, Plurinational State of</option>

                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>

                            <option value="BA">Bosnia and Herzegovina</option>

                            <option value="BW">Botswana</option>

                            <option value="BV">Bouvet Island</option>

                            <option value="BR">Brazil</option>

                            <option value="IO">British Indian Ocean Territory</option>

                            <option value="BN">Brunei Darussalam</option>

                            <option value="BG">Bulgaria</option>

                            <option value="BF">Burkina Faso</option>

                            <option value="BI">Burundi</option>

                            <option value="KH">Cambodia</option>

                            <option value="CM">Cameroon</option>

                            <option value="CA">Canada</option>

                            <option value="CV">Cape Verde</option>

                            <option value="KY">Cayman Islands</option>

                            <option value="CF">Central African Republic</option>

                            <option value="TD">Chad</option>

                            <option value="CL">Chile</option>

                            <option value="CN">China</option>

                            <option value="CX">Christmas Island</option>

                            <option value="CC">Cocos (Keeling) Islands</option>

                            <option value="CO">Colombia</option>

                            <option value="KM">Comoros</option>

                            <option value="CG">Congo</option>

                            <option value="CD">Congo, the Democratic Republic of the</option>

                            <option value="CK">Cook Islands</option>

                            <option value="CR">Costa Rica</option>

                            <option value="CI">Côte d'Ivoire</option>

                            <option value="HR">Croatia</option>

                            <option value="CU">Cuba</option>

                            <option value="CW">Curaçao</option>

                            <option value="CY">Cyprus</option>

                            <option value="CZ">Czech Republic</option>

                            <option value="DK">Denmark</option>

                            <option value="DJ">Djibouti</option>

                            <option value="DM">Dominica</option>

                            <option value="DO">Dominican Republic</option>

                            <option value="EC">Ecuador</option>

                            <option value="EG">Egypt</option>

                            <option value="SV">El Salvador</option>

                            <option value="GQ">Equatorial Guinea</option>

                            <option value="ER">Eritrea</option>

                            <option value="EE">Estonia</option>

                            <option value="ET">Ethiopia</option>

                            <option value="FK">Falkland Islands (Malvinas)</option>

                            <option value="FO">Faroe Islands</option>

                            <option value="FJ">Fiji</option>

                            <option value="FI">Finland</option>

                            <option value="FR">France</option>

                            <option value="GF">French Guiana</option>

                            <option value="PF">French Polynesia</option>

                            <option value="TF">French Southern Territories</option>

                            <option value="GA">Gabon</option>

                            <option value="GM">Gambia</option>

                            <option value="GE">Georgia</option>

                            <option value="DE">Germany</option>

                            <option value="GH">Ghana</option>

                            <option value="GI">Gibraltar</option>

                            <option value="GR">Greece</option>

                            <option value="GL">Greenland</option>

                            <option value="GD">Grenada</option>

                            <option value="GP">Guadeloupe</option>

                            <option value="GU">Guam</option>

                            <option value="GT">Guatemala</option>

                            <option value="GG">Guernsey</option>

                            <option value="GN">Guinea</option>

                            <option value="GW">Guinea-Bissau</option>

                            <option value="GY">Guyana</option>

                            <option value="HT">Haiti</option>

                            <option value="HM">Heard Island and McDonald Islands</option>

                            <option value="VA">Holy See (Vatican City State)</option>

                            <option value="HN">Honduras</option>

                            <option value="HK">Hong Kong</option>

                            <option value="HU">Hungary</option>

                            <option value="IS">Iceland</option>

                            <option value="IN" selected="selected">India</option>

                            <option value="ID">Indonesia</option>

                            <option value="IR">Iran, Islamic Republic of</option>

                            <option value="IQ">Iraq</option>

                            <option value="IE">Ireland</option>

                            <option value="IM">Isle of Man</option>

                            <option value="IL">Israel</option>

                            <option value="IT">Italy</option>

                            <option value="JM">Jamaica</option>

                            <option value="JP">Japan</option>

                            <option value="JE">Jersey</option>

                            <option value="JO">Jordan</option>

                            <option value="KZ">Kazakhstan</option>

                            <option value="KE">Kenya</option>

                            <option value="KI">Kiribati</option>

                            <option value="KP">Korea, Democratic People's Republic of</option>

                            <option value="KR">Korea, Republic of</option>

                            <option value="KW">Kuwait</option>

                            <option value="KG">Kyrgyzstan</option>

                            <option value="LA">Lao People's Democratic Republic</option>

                            <option value="LV">Latvia</option>

                            <option value="LB">Lebanon</option>

                            <option value="LS">Lesotho</option>

                            <option value="LR">Liberia</option>

                            <option value="LY">Libya</option>

                            <option value="LI">Liechtenstein</option>

                            <option value="LT">Lithuania</option>

                            <option value="LU">Luxembourg</option>

                            <option value="MO">Macao</option>

                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>

                            <option value="MG">Madagascar</option>

                            <option value="MW">Malawi</option>

                            <option value="MY">Malaysia</option>

                            <option value="MV">Maldives</option>

                            <option value="ML">Mali</option>

                            <option value="MT">Malta</option>

                            <option value="MH">Marshall Islands</option>

                            <option value="MQ">Martinique</option>

                            <option value="MR">Mauritania</option>

                            <option value="MU">Mauritius</option>

                            <option value="YT">Mayotte</option>

                            <option value="MX">Mexico</option>

                            <option value="FM">Micronesia, Federated States of</option>

                            <option value="MD">Moldova, Republic of</option>

                            <option value="MC">Monaco</option>

                            <option value="MN">Mongolia</option>

                            <option value="ME">Montenegro</option>

                            <option value="MS">Montserrat</option>

                            <option value="MA">Morocco</option>

                            <option value="MZ">Mozambique</option>

                            <option value="MM">Myanmar</option>

                            <option value="NA">Namibia</option>

                            <option value="NR">Nauru</option>

                            <option value="NP">Nepal</option>

                            <option value="NL">Netherlands</option>

                            <option value="NC">New Caledonia</option>

                            <option value="NZ">New Zealand</option>

                            <option value="NI">Nicaragua</option>

                            <option value="NE">Niger</option>

                            <option value="NG">Nigeria</option>

                            <option value="NU">Niue</option>

                            <option value="NF">Norfolk Island</option>

                            <option value="MP">Northern Mariana Islands</option>

                            <option value="NO">Norway</option>

                            <option value="OM">Oman</option>

                            <option value="PK">Pakistan</option>

                            <option value="PW">Palau</option>

                            <option value="PS">Palestinian Territory, Occupied</option>

                            <option value="PA">Panama</option>

                            <option value="PG">Papua New Guinea</option>

                            <option value="PY">Paraguay</option>

                            <option value="PE">Peru</option>

                            <option value="PH">Philippines</option>

                            <option value="PN">Pitcairn</option>

                            <option value="PL">Poland</option>

                            <option value="PT">Portugal</option>

                            <option value="PR">Puerto Rico</option>

                            <option value="QA">Qatar</option>

                            <option value="RE">Réunion</option>

                            <option value="RO">Romania</option>

                            <option value="RU">Russian Federation</option>

                            <option value="RW">Rwanda</option>

                            <option value="BL">Saint Barthélemy</option>

                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>

                            <option value="KN">Saint Kitts and Nevis</option>

                            <option value="LC">Saint Lucia</option>

                            <option value="MF">Saint Martin (French part)</option>

                            <option value="PM">Saint Pierre and Miquelon</option>

                            <option value="VC">Saint Vincent and the Grenadines</option>

                            <option value="WS">Samoa</option>

                            <option value="SM">San Marino</option>

                            <option value="ST">Sao Tome and Principe</option>

                            <option value="SA">Saudi Arabia</option>

                            <option value="SN">Senegal</option>

                            <option value="RS">Serbia</option>

                            <option value="SC">Seychelles</option>

                            <option value="SL">Sierra Leone</option>

                            <option value="SG">Singapore</option>

                            <option value="SX">Sint Maarten (Dutch part)</option>

                            <option value="SK">Slovakia</option>

                            <option value="SI">Slovenia</option>

                            <option value="SB">Solomon Islands</option>

                            <option value="SO">Somalia</option>

                            <option value="ZA">South Africa</option>

                            <option value="GS">South Georgia and the South Sandwich Islands</option>

                            <option value="SS">South Sudan</option>

                            <option value="ES">Spain</option>

                            <option value="LK">Sri Lanka</option>

                            <option value="SD">Sudan</option>

                            <option value="SR">Suriname</option>

                            <option value="SJ">Svalbard and Jan Mayen</option>

                            <option value="SZ">Swaziland</option>

                            <option value="SE">Sweden</option>

                            <option value="CH">Switzerland</option>

                            <option value="SY">Syrian Arab Republic</option>

                            <option value="TW">Taiwan, Province of China</option>

                            <option value="TJ">Tajikistan</option>

                            <option value="TZ">Tanzania, United Republic of</option>

                            <option value="TH">Thailand</option>

                            <option value="TL">Timor-Leste</option>

                            <option value="TG">Togo</option>

                            <option value="TK">Tokelau</option>

                            <option value="TO">Tonga</option>

                            <option value="TT">Trinidad and Tobago</option>

                            <option value="TN">Tunisia</option>

                            <option value="TR">Turkey</option>

                            <option value="TM">Turkmenistan</option>

                            <option value="TC">Turks and Caicos Islands</option>

                            <option value="TV">Tuvalu</option>

                            <option value="UG">Uganda</option>

                            <option value="UA">Ukraine</option>

                            <option value="AE">United Arab Emirates</option>

                            <option value="GB">United Kingdom</option>

                            <option value="US">United States</option>

                            <option value="UM">United States Minor Outlying Islands</option>

                            <option value="UY">Uruguay</option>

                            <option value="UZ">Uzbekistan</option>

                            <option value="VU">Vanuatu</option>

                            <option value="VE">Venezuela, Bolivarian Republic of</option>

                            <option value="VN">Viet Nam</option>

                            <option value="VG">Virgin Islands, British</option>

                            <option value="VI">Virgin Islands, U.S.</option>

                            <option value="WF">Wallis and Futuna</option>

                            <option value="EH">Western Sahara</option>

                            <option value="YE">Yemen</option>

                            <option value="ZM">Zambia</option>

                            <option value="ZW">Zimbabwe</option>

                          </select>
                          <div class="error-message nationalityAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>





                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Number<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1" name="passportNumberAdt<?php echo $adult; ?>" id="passportNumberAdt<?php echo $adult; ?>" placeholder="" aria-label="" data-msg="Please enter passport number" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportNumberAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>



                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Issue Date<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1 datepickerfieldIssueDate" name="passportIssueDateAdt<?php echo $adult; ?>" id="passportIssueDateAdt<?php echo $adult; ?>" placeholder="" aria-label="" data-msg="Please enter expiry Date" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportIssueDateAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>



                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Expiry<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1 datepickerfieldexpiry" name="passportExpiryAdt<?php echo $adult; ?>" id="passportExpiryAdt<?php echo $adult; ?>" placeholder="" aria-label="" data-msg="Please enter expiry Date" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportExpiryAdt<?php echo $adult; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>

                      <!-- End Input -->

                    <?php } ?>

                  </div>

                </div>



                <input name="totaladult" type="hidden" value="<?php echo $adult; ?>">



                <!---- SSR Detail ---->

                <div style="padding: 10px 20px; background-color: #f4f4f4; font-weight: 700;display:none; ssroptional">Onward - SSR Details (Optional) </div>



                <div class="card-body">

                  <div class="row sliderpaxbox openpaxtabadult<?php echo $adult; ?>">





                    <?php if (count($ssrInfoArr['BAGGAGE']) > 0) { ?>



                      <div class="<?php if ($adults == '1') {
                                    echo "col-sm-3";
                                  } else {
                                    echo "col-sm-4";
                                  } ?> mb-4">



                        <div class="js-form-message bselect<?php echo $adult; ?>">



                          <label class="form-label"> Select Excess Baggage </label>



                          <select name="abaggage<?php echo $adult; ?>" class="form-control baggages adhendle adltbag adultbag<?php echo $adult; ?>" style="-moz-appearance: none;" tabindex="16" id="adltbag">



                            <option value="INR 0">---Select Baggage---</option>



                            <?php foreach ($ssrInfoArr['BAGGAGE'] as $msBag) { ?>



                              <option value="<?php echo $msBag['code'] . " - " . $msBag['desc'] . ' , INR ' . $msBag['amount']; ?>"><?php echo $msBag['desc'] . ' , INR ' . $msBag['amount']; ?></option>



                            <?php } ?>



                          </select>



                        </div>



                      </div>



                    <?php } ?>



                    <?php if (count($ssrInfoArr['MEAL']) > 0) { ?>



                      <div class="<?php if ($adults == '1') {
                                    echo "col-sm-3";
                                  } else {
                                    echo "col-sm-4";
                                  } ?> mb-4">



                        <div class="js-form-message Mselect<?php echo $adult; ?>">



                          <label class="form-label"> Meal Preferences </label>



                          <select name="ameal<?php echo $adult; ?>" class="form-control adhendle adltmeal adultmeal<?php echo $adult; ?> meals" style="-moz-appearance: none;" tabindex="" id="adltmeal">



                            <option value="INR 0">---Meal Preferences---</option>



                            <?php foreach ($ssrInfoArr['MEAL'] as $msmeal) { ?>



                              <option value="<?php echo $msmeal['code'] . " - " . $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?>"><?php echo $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?></option>



                            <?php } ?>



                          </select>



                        </div>



                      </div>

                    <?php } ?>

			

                   <?php 
				   //print_r($SeatDynamic);
				   if (count($SeatDynamic) > 0) { ?>



                      <div class="col-sm-3 mb-4">



                        <div class="js-form-message">



                          <label class="form-label"> Seat </label>



                          <a style="line-height: 1.0; max-width:200px;" class="btn btn-danger border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 popup-ajax" href="#new-card-dialog" data-effect="mfp-zoom-out" data-id="" data-passenger="seatAdult_<?php echo $adult; ?>">View Seat</a>
                        </div>



                      </div>



                    <?php } ?>
					
                  </div>

                </div>


				
                <input type="hidden" id="seatdetail" name="seatdetail" value="" />
                <input type="hidden" id="seatAdultPrice<?php echo $adult; ?>" name="seatAdultPrice<?php echo $adult; ?>" value="" />

                <input type="hidden" id="seatAdultCode<?php echo $adult; ?>" name="seatAdultCode<?php echo $adult; ?>" value="" />



                <!--- End SSR details --->



                <!--- Return SSR details --->

                <?php

                if ($_SESSION['tripType'] == 2  && count($ssrInfoArr2['MEAL']) > 0 || count($ssrInfoArr2['MEAL']) > 0) {



                ?>

                  <div style="padding: 10px 20px; background-color: #f4f4f4; font-weight: 700;" class="adtreturnDetail">Return - SSR Details (Optional) </div>

                  <div class="card-body">

                    <div class="row sliderpaxbox openpaxtabadult<?php echo $adult; ?>">







                      <?php if (count($ssrInfoArr2['BAGGAGE']) > 0) { ?>



                        <div class="<?php if ($adults == '1') {
                                      echo "col-sm-3";
                                    } else {
                                      echo "col-sm-4";
                                    } ?> mb-4">



                          <div class="js-form-message bselect2<?php echo $adult; ?>">



                            <label class="form-label"> Select Excess Baggage </label>



                            <select name="abaggage2<?php echo $adult; ?>" class="form-control adhendle baggages2 adltbag2 adltbag2<?php echo $adult; ?>" style="-moz-appearance: none;" tabindex="16" id="adltbag2">





                              <option value="INR 0">---Select Baggage---</option>



                              <?php foreach ($ssrInfoArr2['BAGGAGE'] as $msBag) { ?>



                                <option value="<?php echo $msBag['code'] . " - " . $msBag['desc'] . ' , INR ' . $msBag['amount']; ?>"><?php echo $msBag['desc'] . ' , INR ' . $msBag['amount']; ?></option>

                              <?php } ?>



                            </select>



                          </div>



                        </div>



                      <?php } ?>



                      <?php if (count($ssrInfoArr2['MEAL']) > 0) { ?>

                        <div class="<?php if ($adults == '1') {
                                      echo "col-sm-3";
                                    } else {
                                      echo "col-sm-4";
                                    } ?> mb-4">



                          <div class="js-form-message Mselect2<?php echo $adult; ?>">



                            <label class="form-label"> Meal Preferences </label>



                            <select name="ameal2<?php echo $adult; ?>" class="form-control adhendle meals2 adltmeal2 adltmeal2<?php echo $adult; ?>" style="-moz-appearance: none;" tabindex="" id="adltmeal2">



                              <option value="INR 0">---Meal Preferences---</option>



                              <?php foreach ($ssrInfoArr2['MEAL'] as $msmeal) { ?>



                                <option value="<?php echo $msmeal['code'] . " - " . $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?>"><?php echo $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?></option>



                              <?php } ?>

                            </select>



                          </div>



                        </div>



                      <?php } ?>



                      <?php if (count($SeatDynamic2) > 0) { ?>



                        <div class="col-sm-3 mb-4">



                          <div class="js-form-message">



                            <label class="form-label"> Seat </label>



                            <a style="line-height: 1.0; max-width:200px;" class="btn btn-danger border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 popup-ajax2" href="#new-card-dialog"   data-effect="mfp-zoom-out" data-id="" data-passenger="seatAdult2_<?php echo $adult; ?>">View Seat</a>
                          </div>



                        </div>



                      <?php } ?>
						
						

                    </div>

                  </div>



                  <input type="hidden" id="seatAdultPrice2<?php echo $adult; ?>" name="seatAdultPrice2<?php echo $adult; ?>" value="" />

                  <input type="hidden" id="seatAdultCode2<?php echo $adult; ?>" name="seatAdultCode2<?php echo $adult; ?>" value="" />



                <?php } ?>

                <!--- Return End SSR details --->









              <?php }

              $totaladultcount = $adult;
              
              ?>
            
             

              <?php

              for ($child = 1; $child <= $_SESSION['CHD']; $child++) {

              ?>



                <div class="card-header">Child <?php echo $child; ?> (2 + yrs)</div>



                <div class="card-body">


                  <div class="row">



                    <div class="col-sm-2 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        Title<span style="color:red;">*</span>

                        </label>

                        <select class="form-control validate1" name="titleChd<?php echo $child; ?>" id="titleChd<?php echo $child; ?>">

                          <option value="">Select</option>
                      <option value="Master">Master</option> 
													<!--<option value="Mrs">Mrs</option> -->
													<!--<option value="Ms">Ms.</option> -->
													<option value="Ms">Ms</option> 

                        </select>
                        <div class="error-message titleChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>



                    <div class="col-sm-4 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        First Name<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="firstNameChd<?php echo $child; ?>" id="firstNameChd<?php echo $child; ?>" placeholder="" aria-label="" required data-msg="Please enter your first name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message firstNameChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>

                    <!-- End Input -->



                    <!-- Input -->

                    <div class="col-sm-3 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        Last name<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="lastNameChd<?php echo $child; ?>" id="lastNameChd<?php echo $child; ?>" required data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message lastNameChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>



                    <div class="col-sm-3 mb-4">

                      <div class="js-form-message">

                        <label class="form-label typechd" data-type="child">

                        DOB<span style="color:red;">*</span>

                        </label>

                        <input class="form-control validate1 datepickerfieldchd dobChd" id="dobChd<?php echo $child; ?>" data-countchd="<?php echo $child; ?>" name="dobChd<?php echo $child; ?>" max="" min="" readonly="readonly">
                        <div class="error-message dobalert agealert<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Age must be between 2-12 years<div class="ixi-icon-error"></div></div>
                        <div class="error-message dobChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>



                    <?php if ($_SESSION['isdomestic'] == 'No') { ?>

                      <!-- Input -->

                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Provided Country<span style="color:red;">*</span>

                          </label>

                          <select class="form-control js-select selectpicker dropdown-select" id="nationalityChd<?php echo $child; ?>" name="nationalityChd<?php echo $child; ?>" data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success" data-live-search="true" data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal">

                            <option value="">Select country</option>

                            <option value="AF">Afghanistan</option>

                            <option value="AX">Åland Islands</option>

                            <option value="AL">Albania</option>

                            <option value="DZ">Algeria</option>

                            <option value="AS">American Samoa</option>

                            <option value="AD">Andorra</option>

                            <option value="AO">Angola</option>

                            <option value="AI">Anguilla</option>

                            <option value="AQ">Antarctica</option>

                            <option value="AG">Antigua and Barbuda</option>

                            <option value="AR">Argentina</option>

                            <option value="AM">Armenia</option>

                            <option value="AW">Aruba</option>

                            <option value="AU">Australia</option>

                            <option value="AT">Austria</option>

                            <option value="AZ">Azerbaijan</option>

                            <option value="BS">Bahamas</option>

                            <option value="BH">Bahrain</option>

                            <option value="BD">Bangladesh</option>

                            <option value="BB">Barbados</option>

                            <option value="BY">Belarus</option>

                            <option value="BE">Belgium</option>

                            <option value="BZ">Belize</option>

                            <option value="BJ">Benin</option>

                            <option value="BM">Bermuda</option>

                            <option value="BT">Bhutan</option>

                            <option value="BO">Bolivia, Plurinational State of</option>

                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>

                            <option value="BA">Bosnia and Herzegovina</option>

                            <option value="BW">Botswana</option>

                            <option value="BV">Bouvet Island</option>

                            <option value="BR">Brazil</option>

                            <option value="IO">British Indian Ocean Territory</option>

                            <option value="BN">Brunei Darussalam</option>

                            <option value="BG">Bulgaria</option>

                            <option value="BF">Burkina Faso</option>

                            <option value="BI">Burundi</option>

                            <option value="KH">Cambodia</option>

                            <option value="CM">Cameroon</option>

                            <option value="CA">Canada</option>

                            <option value="CV">Cape Verde</option>

                            <option value="KY">Cayman Islands</option>

                            <option value="CF">Central African Republic</option>

                            <option value="TD">Chad</option>

                            <option value="CL">Chile</option>

                            <option value="CN">China</option>

                            <option value="CX">Christmas Island</option>

                            <option value="CC">Cocos (Keeling) Islands</option>

                            <option value="CO">Colombia</option>

                            <option value="KM">Comoros</option>

                            <option value="CG">Congo</option>

                            <option value="CD">Congo, the Democratic Republic of the</option>

                            <option value="CK">Cook Islands</option>

                            <option value="CR">Costa Rica</option>

                            <option value="CI">Côte d'Ivoire</option>

                            <option value="HR">Croatia</option>

                            <option value="CU">Cuba</option>

                            <option value="CW">Curaçao</option>

                            <option value="CY">Cyprus</option>

                            <option value="CZ">Czech Republic</option>

                            <option value="DK">Denmark</option>

                            <option value="DJ">Djibouti</option>

                            <option value="DM">Dominica</option>

                            <option value="DO">Dominican Republic</option>

                            <option value="EC">Ecuador</option>

                            <option value="EG">Egypt</option>

                            <option value="SV">El Salvador</option>

                            <option value="GQ">Equatorial Guinea</option>

                            <option value="ER">Eritrea</option>

                            <option value="EE">Estonia</option>

                            <option value="ET">Ethiopia</option>

                            <option value="FK">Falkland Islands (Malvinas)</option>

                            <option value="FO">Faroe Islands</option>

                            <option value="FJ">Fiji</option>

                            <option value="FI">Finland</option>

                            <option value="FR">France</option>

                            <option value="GF">French Guiana</option>



                            <option value="PF">French Polynesia</option>

                            <option value="TF">French Southern Territories</option>

                            <option value="GA">Gabon</option>

                            <option value="GM">Gambia</option>

                            <option value="GE">Georgia</option>

                            <option value="DE">Germany</option>

                            <option value="GH">Ghana</option>

                            <option value="GI">Gibraltar</option>

                            <option value="GR">Greece</option>

                            <option value="GL">Greenland</option>

                            <option value="GD">Grenada</option>

                            <option value="GP">Guadeloupe</option>

                            <option value="GU">Guam</option>

                            <option value="GT">Guatemala</option>

                            <option value="GG">Guernsey</option>

                            <option value="GN">Guinea</option>

                            <option value="GW">Guinea-Bissau</option>

                            <option value="GY">Guyana</option>

                            <option value="HT">Haiti</option>

                            <option value="HM">Heard Island and McDonald Islands</option>

                            <option value="VA">Holy See (Vatican City State)</option>

                            <option value="HN">Honduras</option>

                            <option value="HK">Hong Kong</option>

                            <option value="HU">Hungary</option>

                            <option value="IS">Iceland</option>

                            <option value="IN" selected="selected">India</option>

                            <option value="ID">Indonesia</option>

                            <option value="IR">Iran, Islamic Republic of</option>

                            <option value="IQ">Iraq</option>

                            <option value="IE">Ireland</option>

                            <option value="IM">Isle of Man</option>

                            <option value="IL">Israel</option>

                            <option value="IT">Italy</option>

                            <option value="JM">Jamaica</option>

                            <option value="JP">Japan</option>

                            <option value="JE">Jersey</option>

                            <option value="JO">Jordan</option>

                            <option value="KZ">Kazakhstan</option>

                            <option value="KE">Kenya</option>

                            <option value="KI">Kiribati</option>

                            <option value="KP">Korea, Democratic People's Republic of</option>

                            <option value="KR">Korea, Republic of</option>

                            <option value="KW">Kuwait</option>

                            <option value="KG">Kyrgyzstan</option>

                            <option value="LA">Lao People's Democratic Republic</option>

                            <option value="LV">Latvia</option>

                            <option value="LB">Lebanon</option>

                            <option value="LS">Lesotho</option>

                            <option value="LR">Liberia</option>

                            <option value="LY">Libya</option>

                            <option value="LI">Liechtenstein</option>

                            <option value="LT">Lithuania</option>

                            <option value="LU">Luxembourg</option>

                            <option value="MO">Macao</option>

                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>

                            <option value="MG">Madagascar</option>

                            <option value="MW">Malawi</option>

                            <option value="MY">Malaysia</option>

                            <option value="MV">Maldives</option>

                            <option value="ML">Mali</option>

                            <option value="MT">Malta</option>

                            <option value="MH">Marshall Islands</option>

                            <option value="MQ">Martinique</option>

                            <option value="MR">Mauritania</option>

                            <option value="MU">Mauritius</option>

                            <option value="YT">Mayotte</option>

                            <option value="MX">Mexico</option>

                            <option value="FM">Micronesia, Federated States of</option>

                            <option value="MD">Moldova, Republic of</option>

                            <option value="MC">Monaco</option>

                            <option value="MN">Mongolia</option>

                            <option value="ME">Montenegro</option>

                            <option value="MS">Montserrat</option>

                            <option value="MA">Morocco</option>

                            <option value="MZ">Mozambique</option>

                            <option value="MM">Myanmar</option>

                            <option value="NA">Namibia</option>

                            <option value="NR">Nauru</option>

                            <option value="NP">Nepal</option>

                            <option value="NL">Netherlands</option>

                            <option value="NC">New Caledonia</option>

                            <option value="NZ">New Zealand</option>

                            <option value="NI">Nicaragua</option>

                            <option value="NE">Niger</option>

                            <option value="NG">Nigeria</option>

                            <option value="NU">Niue</option>

                            <option value="NF">Norfolk Island</option>

                            <option value="MP">Northern Mariana Islands</option>

                            <option value="NO">Norway</option>

                            <option value="OM">Oman</option>

                            <option value="PK">Pakistan</option>

                            <option value="PW">Palau</option>

                            <option value="PS">Palestinian Territory, Occupied</option>

                            <option value="PA">Panama</option>

                            <option value="PG">Papua New Guinea</option>

                            <option value="PY">Paraguay</option>

                            <option value="PE">Peru</option>

                            <option value="PH">Philippines</option>

                            <option value="PN">Pitcairn</option>

                            <option value="PL">Poland</option>

                            <option value="PT">Portugal</option>

                            <option value="PR">Puerto Rico</option>

                            <option value="QA">Qatar</option>

                            <option value="RE">Réunion</option>

                            <option value="RO">Romania</option>

                            <option value="RU">Russian Federation</option>

                            <option value="RW">Rwanda</option>

                            <option value="BL">Saint Barthélemy</option>

                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>

                            <option value="KN">Saint Kitts and Nevis</option>

                            <option value="LC">Saint Lucia</option>

                            <option value="MF">Saint Martin (French part)</option>

                            <option value="PM">Saint Pierre and Miquelon</option>

                            <option value="VC">Saint Vincent and the Grenadines</option>

                            <option value="WS">Samoa</option>

                            <option value="SM">San Marino</option>

                            <option value="ST">Sao Tome and Principe</option>

                            <option value="SA">Saudi Arabia</option>

                            <option value="SN">Senegal</option>

                            <option value="RS">Serbia</option>

                            <option value="SC">Seychelles</option>

                            <option value="SL">Sierra Leone</option>

                            <option value="SG">Singapore</option>

                            <option value="SX">Sint Maarten (Dutch part)</option>

                            <option value="SK">Slovakia</option>

                            <option value="SI">Slovenia</option>

                            <option value="SB">Solomon Islands</option>

                            <option value="SO">Somalia</option>

                            <option value="ZA">South Africa</option>

                            <option value="GS">South Georgia and the South Sandwich Islands</option>

                            <option value="SS">South Sudan</option>

                            <option value="ES">Spain</option>

                            <option value="LK">Sri Lanka</option>

                            <option value="SD">Sudan</option>

                            <option value="SR">Suriname</option>

                            <option value="SJ">Svalbard and Jan Mayen</option>

                            <option value="SZ">Swaziland</option>

                            <option value="SE">Sweden</option>

                            <option value="CH">Switzerland</option>

                            <option value="SY">Syrian Arab Republic</option>

                            <option value="TW">Taiwan, Province of China</option>

                            <option value="TJ">Tajikistan</option>

                            <option value="TZ">Tanzania, United Republic of</option>

                            <option value="TH">Thailand</option>

                            <option value="TL">Timor-Leste</option>

                            <option value="TG">Togo</option>

                            <option value="TK">Tokelau</option>

                            <option value="TO">Tonga</option>

                            <option value="TT">Trinidad and Tobago</option>

                            <option value="TN">Tunisia</option>

                            <option value="TR">Turkey</option>

                            <option value="TM">Turkmenistan</option>

                            <option value="TC">Turks and Caicos Islands</option>

                            <option value="TV">Tuvalu</option>

                            <option value="UG">Uganda</option>

                            <option value="UA">Ukraine</option>

                            <option value="AE">United Arab Emirates</option>

                            <option value="GB">United Kingdom</option>

                            <option value="US">United States</option>

                            <option value="UM">United States Minor Outlying Islands</option>

                            <option value="UY">Uruguay</option>

                            <option value="UZ">Uzbekistan</option>

                            <option value="VU">Vanuatu</option>

                            <option value="VE">Venezuela, Bolivarian Republic of</option>

                            <option value="VN">Viet Nam</option>

                            <option value="VG">Virgin Islands, British</option>

                            <option value="VI">Virgin Islands, U.S.</option>

                            <option value="WF">Wallis and Futuna</option>

                            <option value="EH">Western Sahara</option>

                            <option value="YE">Yemen</option>

                            <option value="ZM">Zambia</option>

                            <option value="ZW">Zimbabwe</option>

                          </select>
                          <div class="error-message nationalityChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>

                        </div>

                      </div>



                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Number<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control" name="passportNumberChd<?php echo $child; ?>" id="passportNumberChd<?php echo $child; ?>" placeholder="" aria-label="" data-msg="Please enter passport number" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportNumberChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>

                      <!-- End Input -->



                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Issue Date<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1 datepickerfieldIssueDate" name="passportIssueDateChd<?php echo $child; ?>" id="passportIssueDateChd<?php echo $child; ?>" placeholder="" aria-label="" data-msg="Please enter expiry Date" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportIssueDateChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>





                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Expiry<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control datepickerfieldexpiry" name="passportExpiryChd<?php echo $child; ?>" id="passportExpiryChd<?php echo $child; ?>" placeholder="" aria-label="" data-msg="Please enter expiry Date" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportExpiryChd<?php echo $child; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>



                    <?php } ?>





                  </div>



                </div>

                <input name="totalchild" type="hidden" value="<?php echo $child; ?>">





                <!---- SSR Detail ---->

                <div class="chdssroptional">Onward - SSR Details (Optional) </div>





                <div class="card-body">

                  <div class="row sliderpaxbox openpaxtabadult<?php echo $child; ?>">





                    <?php if (count($ssrInfoArr['BAGGAGE']) > 0) { ?>



                      <div class="<?php if ($adults == '1') {
                                    echo "col-sm-3";
                                  } else {
                                    echo "col-sm-4";
                                  } ?> mb-4">



                        <div class="js-form-message chdbselect<?php echo $child; ?>">



                          <label class="form-label"> Select Excess Baggage </label>



                          <select name="cbaggage<?php echo $child; ?>" class="form-control adhendle childbag childbag<?php echo $child; ?> baggages" style="-moz-appearance: none;" tabindex="16" id="childbag">



                            <option value="INR 0">---Select Baggage---</option>



                            <?php foreach ($ssrInfoArr['BAGGAGE'] as $msBag) { ?>



                              <option value="<?php echo $msBag['code'] . " - " . $msBag['desc'] . ' , INR ' . $msBag['amount']; ?>"><?php echo $msBag['desc'] . ' , INR ' . $msBag['amount']; ?></option>



                            <?php } ?>



                          </select>



                        </div>



                      </div>



                    <?php } ?>



                    <?php if (count($ssrInfoArr['MEAL']) > 0) { ?>



                      <div class="<?php if ($adults == '1') {
                                    echo "col-sm-3";
                                  } else {
                                    echo "col-sm-4";
                                  } ?> mb-4">





                        <div class="js-form-message chdMselect<?php echo $child; ?>">



                          <label class="form-label"> Meal Preferences </label>



                          <select name="cmeal<?php echo $child; ?>" class="form-control adhendle childmeal childmeal<?php echo $child; ?> meals" style="-moz-appearance: none;" tabindex="" id="childmeal">



                            <option value="INR 0">---Meal Preferences---</option>



                            <?php foreach ($ssrInfoArr['MEAL'] as $msmeal) { ?>



                              <option value="<?php echo $msmeal['code'] . " - " . $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?>"><?php echo $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?></option>



                            <?php } ?>



                          </select>



                        </div>



                      </div>

                    <?php } ?>





                    <?php if (count($SeatDynamic) > 0) { ?>



                      <div class="col-sm-3 mb-4">



                        <div class="js-form-message ">



                          <label class="form-label"> Seat </label>



                          <a style="line-height: 1.0; max-width:200px;" class="btn btn-danger border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 popup-ajax" href="#new-card-dialog" data-effect="mfp-zoom-out" data-id="" data-passenger="seatChild_<?php echo $child; ?>">View Seat</a>
                        </div>



                      </div>



                    <?php } ?>



                  </div>

                </div>





                <input type="hidden" id="seatChildPrice<?php echo $child; ?>" name="seatChildPrice<?php echo $child; ?>" value="" />

                <input type="hidden" id="seatChildCode<?php echo $child; ?>" name="seatChildCode<?php echo $child; ?>" value="" />



                <!--- End SSR details --->



                <!--- Return SSR details --->

                <?php

                if ($_SESSION['tripType'] == 2  && count($ssrInfoArr2['MEAL']) > 0 || count($ssrInfoArr2['MEAL']) > 0) {



                ?>

                  <div style="padding: 10px 20px; background-color: #f4f4f4; font-weight: 700; " class="chdreturnDetail">Return - SSR Details (Optional) </div>

                  <div class="card-body">

                    <div class="row sliderpaxbox openpaxtabadult<?php echo $child; ?>">





                      <?php if (count($ssrInfoArr2['BAGGAGE']) > 0) { ?>



                        <div class="<?php if ($adults == '1') {
                                      echo "col-sm-3";
                                    } else {
                                      echo "col-sm-4";
                                    } ?> mb-4">



                          <div class="js-form-message chdbselect2<?php echo $child; ?>">



                            <label class="form-label "> Select Excess Baggage </label>



                            <select name="cbaggage2<?php echo $child; ?>" class="form-control childbag2<?php echo $child; ?> adhendle childbag2 baggages2" style="-moz-appearance: none;" tabindex="16" id="childbag2">



                              <option value="INR 0">---Select Baggage---</option>



                              <?php foreach ($ssrInfoArr2['BAGGAGE'] as $msBag) { ?>



                                <option value="<?php echo $msBag['code'] . " - " . $msBag['desc'] . ' , INR ' . $msBag['amount']; ?>"><?php echo $msBag['desc'] . ' , INR ' . $msBag['amount']; ?></option>



                              <?php } ?>



                            </select>



                          </div>



                        </div>



                      <?php } ?>



                      <?php if (count($ssrInfoArr2['MEAL']) > 0) { ?>



                        <div class="<?php if ($adults == '1') {
                                      echo "col-sm-3";
                                    } else {
                                      echo "col-sm-4";
                                    } ?> mb-4">





                          <div class="js-form-message chdMselect2<?php echo $child; ?>">



                            <label class="form-label"> Meal Preferences </label>



                            <select name="cmeal2<?php echo $child; ?>" class="form-control adhendle childmeal2<?php echo $child; ?> childmeal2 meals2" style="-moz-appearance: none;" tabindex="" id="childmeal2">



                              <option value="INR 0">---Meal Preferences---</option>



                              <?php foreach ($ssrInfoArr2['MEAL'] as $msmeal) { ?>



                                <option value="<?php echo $msmeal['code'] . " - " . $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?>"><?php echo $msmeal['desc'] . ' , INR ' . $msmeal['amount']; ?></option>



                              <?php } ?>



                            </select>



                          </div>



                        </div>

                      <?php } ?>





                      <?php if (count($SeatDynamic) > 0) { ?>



                        <div class="col-sm-3 mb-4">



                          <div class="js-form-message">



                            <label class="form-label"> Seat </label>



                            <a style="line-height: 1.0;" class="btn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 popup-ajax" href="#new-card-dialog" data-effect="mfp-zoom-out" data-id="" data-passenger="seatChild2_<?php echo $child; ?>">View Seat</a>
                          </div>



                        </div>



                      <?php } ?>



                    </div>

                  </div>



                  <input type="hidden" id="seatChildPrice2<?php echo $child; ?>" name="seatChildPrice2<?php echo $child; ?>" value="" />

                  <input type="hidden" id="seatChildCode2<?php echo $child; ?>" name="seatChildCode2<?php echo $child; ?>" value="" />



                <?php } ?>

                <!--- Return End SSR details --->















              <?php }

              $totalchildcount = $child;

              ?>







              <?php

              for ($infant = 1; $infant <= $_SESSION['INF']; $infant++) {

              ?>

                <div class="card-header">Infant <?php echo $infant; ?> (0 - 2 yrs)</div>



                <div class="card-body">



                  <div class="row">



                    <div class="col-sm-2 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        Title<span style="color:red;">*</span>

                        </label>

                        <select class="form-control validate1" name="titleInf<?php echo $infant; ?>" id="titleInf<?php echo $infant; ?>">

                          <option value="">Select</option>
                         <option value="Master">Master</option> 
													<!--<option value="Mrs">Mrs</option> -->
													<!--<option value="Ms">Ms.</option> -->
													<option value="Ms">Ms</option> 
                        </select>
                        <div class="error-message titleInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>



                    <div class="col-sm-4 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        First Name<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="firstNameInf<?php echo $infant; ?>" id="firstNameInf<?php echo $infant; ?>" required data-msg="Please enter your first name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message firstNameInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>

                    <!-- End Input -->



                    <!-- Input -->

                    <div class="col-sm-3 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        Last name<span style="color:red;">*</span>

                        </label>



                        <input type="text" class="form-control validate1" name="lastNameInf<?php echo $infant; ?>" id="lastNameInf<?php echo $infant; ?>" required data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope">
                        <div class="error-message lastNameInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>



                    <div class="col-sm-3 mb-4">

                      <div class="js-form-message">

                        <label class="form-label">

                        DOB<span style="color:red;">*</span>

                        </label>

                        <input class="form-control validate1 datepickerfieldinf dobInf" id="dobInf<?php echo $infant; ?>" data-countinf="<?php echo $infant; ?>" name="dobInf<?php echo $infant; ?>" readonly="readonly">
                        
                        <div class="error-message dobalert agealertinf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Age must be less than 2 years<div class="ixi-icon-error"></div></div>
                        <div class="error-message dobInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                      </div>

                    </div>

                    <!-- End Input -->

                    <?php if ($_SESSION['isdomestic'] == 'No') { ?>

                      <!-- Input -->

                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passwort Provided Country<span style="color:red;">*</span>

                          </label>

                          <select class="form-control js-select selectpicker dropdown-select validate1" id="nationalityInf<?php echo $infant; ?>" name="nationalityInf<?php echo $infant; ?>" data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success" data-live-search="true" data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal">

                            <option value="">Select country</option>

                            <option value="AF">Afghanistan</option>

                            <option value="AX">Åland Islands</option>

                            <option value="AL">Albania</option>

                            <option value="DZ">Algeria</option>

                            <option value="AS">American Samoa</option>

                            <option value="AD">Andorra</option>

                            <option value="AO">Angola</option>

                            <option value="AI">Anguilla</option>

                            <option value="AQ">Antarctica</option>

                            <option value="AG">Antigua and Barbuda</option>

                            <option value="AR">Argentina</option>

                            <option value="AM">Armenia</option>

                            <option value="AW">Aruba</option>

                            <option value="AU">Australia</option>

                            <option value="AT">Austria</option>

                            <option value="AZ">Azerbaijan</option>

                            <option value="BS">Bahamas</option>

                            <option value="BH">Bahrain</option>

                            <option value="BD">Bangladesh</option>

                            <option value="BB">Barbados</option>

                            <option value="BY">Belarus</option>

                            <option value="BE">Belgium</option>

                            <option value="BZ">Belize</option>

                            <option value="BJ">Benin</option>

                            <option value="BM">Bermuda</option>

                            <option value="BT">Bhutan</option>

                            <option value="BO">Bolivia, Plurinational State of</option>

                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>

                            <option value="BA">Bosnia and Herzegovina</option>

                            <option value="BW">Botswana</option>

                            <option value="BV">Bouvet Island</option>

                            <option value="BR">Brazil</option>

                            <option value="IO">British Indian Ocean Territory</option>

                            <option value="BN">Brunei Darussalam</option>

                            <option value="BG">Bulgaria</option>

                            <option value="BF">Burkina Faso</option>

                            <option value="BI">Burundi</option>

                            <option value="KH">Cambodia</option>

                            <option value="CM">Cameroon</option>

                            <option value="CA">Canada</option>

                            <option value="CV">Cape Verde</option>

                            <option value="KY">Cayman Islands</option>

                            <option value="CF">Central African Republic</option>

                            <option value="TD">Chad</option>

                            <option value="CL">Chile</option>

                            <option value="CN">China</option>

                            <option value="CX">Christmas Island</option>

                            <option value="CC">Cocos (Keeling) Islands</option>

                            <option value="CO">Colombia</option>

                            <option value="KM">Comoros</option>

                            <option value="CG">Congo</option>

                            <option value="CD">Congo, the Democratic Republic of the</option>

                            <option value="CK">Cook Islands</option>

                            <option value="CR">Costa Rica</option>

                            <option value="CI">Côte d'Ivoire</option>

                            <option value="HR">Croatia</option>

                            <option value="CU">Cuba</option>

                            <option value="CW">Curaçao</option>

                            <option value="CY">Cyprus</option>

                            <option value="CZ">Czech Republic</option>

                            <option value="DK">Denmark</option>

                            <option value="DJ">Djibouti</option>

                            <option value="DM">Dominica</option>

                            <option value="DO">Dominican Republic</option>

                            <option value="EC">Ecuador</option>

                            <option value="EG">Egypt</option>

                            <option value="SV">El Salvador</option>

                            <option value="GQ">Equatorial Guinea</option>

                            <option value="ER">Eritrea</option>

                            <option value="EE">Estonia</option>

                            <option value="ET">Ethiopia</option>

                            <option value="FK">Falkland Islands (Malvinas)</option>

                            <option value="FO">Faroe Islands</option>

                            <option value="FJ">Fiji</option>

                            <option value="FI">Finland</option>

                            <option value="FR">France</option>

                            <option value="GF">French Guiana</option>



                            <option value="PF">French Polynesia</option>

                            <option value="TF">French Southern Territories</option>

                            <option value="GA">Gabon</option>

                            <option value="GM">Gambia</option>

                            <option value="GE">Georgia</option>

                            <option value="DE">Germany</option>

                            <option value="GH">Ghana</option>

                            <option value="GI">Gibraltar</option>

                            <option value="GR">Greece</option>

                            <option value="GL">Greenland</option>

                            <option value="GD">Grenada</option>

                            <option value="GP">Guadeloupe</option>

                            <option value="GU">Guam</option>

                            <option value="GT">Guatemala</option>

                            <option value="GG">Guernsey</option>

                            <option value="GN">Guinea</option>

                            <option value="GW">Guinea-Bissau</option>

                            <option value="GY">Guyana</option>

                            <option value="HT">Haiti</option>

                            <option value="HM">Heard Island and McDonald Islands</option>

                            <option value="VA">Holy See (Vatican City State)</option>

                            <option value="HN">Honduras</option>

                            <option value="HK">Hong Kong</option>

                            <option value="HU">Hungary</option>

                            <option value="IS">Iceland</option>

                            <option value="IN" selected="selected">India</option>

                            <option value="ID">Indonesia</option>

                            <option value="IR">Iran, Islamic Republic of</option>

                            <option value="IQ">Iraq</option>

                            <option value="IE">Ireland</option>

                            <option value="IM">Isle of Man</option>

                            <option value="IL">Israel</option>

                            <option value="IT">Italy</option>

                            <option value="JM">Jamaica</option>

                            <option value="JP">Japan</option>

                            <option value="JE">Jersey</option>

                            <option value="JO">Jordan</option>

                            <option value="KZ">Kazakhstan</option>

                            <option value="KE">Kenya</option>

                            <option value="KI">Kiribati</option>

                            <option value="KP">Korea, Democratic People's Republic of</option>

                            <option value="KR">Korea, Republic of</option>

                            <option value="KW">Kuwait</option>

                            <option value="KG">Kyrgyzstan</option>

                            <option value="LA">Lao People's Democratic Republic</option>

                            <option value="LV">Latvia</option>

                            <option value="LB">Lebanon</option>

                            <option value="LS">Lesotho</option>

                            <option value="LR">Liberia</option>

                            <option value="LY">Libya</option>

                            <option value="LI">Liechtenstein</option>

                            <option value="LT">Lithuania</option>

                            <option value="LU">Luxembourg</option>

                            <option value="MO">Macao</option>

                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>

                            <option value="MG">Madagascar</option>

                            <option value="MW">Malawi</option>

                            <option value="MY">Malaysia</option>

                            <option value="MV">Maldives</option>

                            <option value="ML">Mali</option>

                            <option value="MT">Malta</option>

                            <option value="MH">Marshall Islands</option>

                            <option value="MQ">Martinique</option>

                            <option value="MR">Mauritania</option>

                            <option value="MU">Mauritius</option>

                            <option value="YT">Mayotte</option>

                            <option value="MX">Mexico</option>

                            <option value="FM">Micronesia, Federated States of</option>

                            <option value="MD">Moldova, Republic of</option>

                            <option value="MC">Monaco</option>

                            <option value="MN">Mongolia</option>

                            <option value="ME">Montenegro</option>

                            <option value="MS">Montserrat</option>

                            <option value="MA">Morocco</option>

                            <option value="MZ">Mozambique</option>

                            <option value="MM">Myanmar</option>

                            <option value="NA">Namibia</option>

                            <option value="NR">Nauru</option>

                            <option value="NP">Nepal</option>

                            <option value="NL">Netherlands</option>

                            <option value="NC">New Caledonia</option>

                            <option value="NZ">New Zealand</option>

                            <option value="NI">Nicaragua</option>

                            <option value="NE">Niger</option>

                            <option value="NG">Nigeria</option>

                            <option value="NU">Niue</option>

                            <option value="NF">Norfolk Island</option>

                            <option value="MP">Northern Mariana Islands</option>

                            <option value="NO">Norway</option>

                            <option value="OM">Oman</option>

                            <option value="PK">Pakistan</option>

                            <option value="PW">Palau</option>

                            <option value="PS">Palestinian Territory, Occupied</option>

                            <option value="PA">Panama</option>

                            <option value="PG">Papua New Guinea</option>

                            <option value="PY">Paraguay</option>

                            <option value="PE">Peru</option>

                            <option value="PH">Philippines</option>

                            <option value="PN">Pitcairn</option>

                            <option value="PL">Poland</option>

                            <option value="PT">Portugal</option>

                            <option value="PR">Puerto Rico</option>

                            <option value="QA">Qatar</option>

                            <option value="RE">Réunion</option>

                            <option value="RO">Romania</option>

                            <option value="RU">Russian Federation</option>

                            <option value="RW">Rwanda</option>

                            <option value="BL">Saint Barthélemy</option>

                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>

                            <option value="KN">Saint Kitts and Nevis</option>

                            <option value="LC">Saint Lucia</option>

                            <option value="MF">Saint Martin (French part)</option>

                            <option value="PM">Saint Pierre and Miquelon</option>

                            <option value="VC">Saint Vincent and the Grenadines</option>

                            <option value="WS">Samoa</option>

                            <option value="SM">San Marino</option>

                            <option value="ST">Sao Tome and Principe</option>

                            <option value="SA">Saudi Arabia</option>

                            <option value="SN">Senegal</option>

                            <option value="RS">Serbia</option>

                            <option value="SC">Seychelles</option>

                            <option value="SL">Sierra Leone</option>

                            <option value="SG">Singapore</option>

                            <option value="SX">Sint Maarten (Dutch part)</option>

                            <option value="SK">Slovakia</option>

                            <option value="SI">Slovenia</option>

                            <option value="SB">Solomon Islands</option>

                            <option value="SO">Somalia</option>

                            <option value="ZA">South Africa</option>

                            <option value="GS">South Georgia and the South Sandwich Islands</option>

                            <option value="SS">South Sudan</option>

                            <option value="ES">Spain</option>

                            <option value="LK">Sri Lanka</option>

                            <option value="SD">Sudan</option>

                            <option value="SR">Suriname</option>

                            <option value="SJ">Svalbard and Jan Mayen</option>

                            <option value="SZ">Swaziland</option>

                            <option value="SE">Sweden</option>

                            <option value="CH">Switzerland</option>

                            <option value="SY">Syrian Arab Republic</option>

                            <option value="TW">Taiwan, Province of China</option>

                            <option value="TJ">Tajikistan</option>

                            <option value="TZ">Tanzania, United Republic of</option>

                            <option value="TH">Thailand</option>

                            <option value="TL">Timor-Leste</option>

                            <option value="TG">Togo</option>

                            <option value="TK">Tokelau</option>

                            <option value="TO">Tonga</option>

                            <option value="TT">Trinidad and Tobago</option>

                            <option value="TN">Tunisia</option>

                            <option value="TR">Turkey</option>

                            <option value="TM">Turkmenistan</option>

                            <option value="TC">Turks and Caicos Islands</option>

                            <option value="TV">Tuvalu</option>

                            <option value="UG">Uganda</option>

                            <option value="UA">Ukraine</option>

                            <option value="AE">United Arab Emirates</option>





                            <option value="GB">United Kingdom</option>

                            <option value="US">United States</option>

                            <option value="UM">United States Minor Outlying Islands</option>

                            <option value="UY">Uruguay</option>

                            <option value="UZ">Uzbekistan</option>

                            <option value="VU">Vanuatu</option>

                            <option value="VE">Venezuela, Bolivarian Republic of</option>

                            <option value="VN">Viet Nam</option>

                            <option value="VG">Virgin Islands, British</option>

                            <option value="VI">Virgin Islands, U.S.</option>

                            <option value="WF">Wallis and Futuna</option>

                            <option value="EH">Western Sahara</option>

                            <option value="YE">Yemen</option>

                            <option value="ZM">Zambia</option>

                            <option value="ZW">Zimbabwe</option>

                          </select>
                          <div class="error-message nationalityInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>



                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Number<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1" name="passportNumberInf<?php echo $infant; ?>" id="passportNumberInf<?php echo $infant; ?>" placeholder="" aria-label="" data-msg="Please enter passport number" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportNumberInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>



                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Issue Date<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1 datepickerfieldIssueDate" name="passportIssueDateInf<?php echo $infant; ?>" id="passportIssueDateInf<?php echo $infant; ?>" placeholder="" aria-label="" data-msg="Please enter expiry Date" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportIssueDateInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>





                      <!-- End Input -->

                      <div class="col-sm-4 mb-4">

                        <div class="js-form-message">

                          <label class="form-label">

                          Passport Expiry<span style="color:red;">*</span>

                          </label>

                          <input type="text" class="form-control validate1 datepickerfieldexpiry" name="passportExpiryInf<?php echo $infant; ?>" id="passportExpiryInf<?php echo $infant; ?>" placeholder="" aria-label="" data-msg="Please enter expiry Date" data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" required>
                          <div class="error-message passportExpiryInf<?php echo $infant; ?>" style="color: red; display: none; line-height: 14px; width: 100%; color: #D50000; font-size: 12px; padding: 5px 5px 5px 22px; background-color: rgba(255,0,0,.1); border-radius: 3px; margin-top: 6px;">Please fill out this filed<div class="ixi-icon-error"></div></div>
                        </div>

                      </div>



                    <?php } ?>



                  </div>



                </div>

                <input name="totalinfant" type="hidden" value="<?php echo $infant; ?>">

              <?php }

              $totalinfantcount = $infant;

              ?>









            </div>
	  
          <div class="card cardresult seatselectioncard " style="width:100%;" data-tripinf2="<?= $_REQUEST['r'] != '' ?>">
            <div class="card-header">Select Seats (Optional)

            </div>
              <div class="card-body" id="" Style="font-size: 14px; font-weight: 600; ">
              <div class="col-sm-12 mb-4 seat_selection" style="display: none">
              <div style="float: right;">
                <select class="form-control select_passengers">
              <?php

              $total_adult=$_SESSION['ADT'];
               $total_child=$_SESSION['CHD'];
             
              $infant=$_SESSION['INF'];
              $total_passenger=$adult+$child; 
              $a_count=0;
              for($i=0; $i < $total_adult; $i++)
              {
              ?>
              <option value="<?= $i; ?>">Adult-<?= $i+1 ?></option>
              <?php 
               $a_count++;
              }
               $c_count=$a_count;
              for($j=0; $j < $total_child; $j++)
              {
              ?>
              <option value="<?= $c_count; ?>">Child-<?= $j+1 ?></option>
              <?php 
              $c_count++;
              }
              ?>
              </select>
              </div>
              <div class="seatdetailsboxtabs<?php echo $res['id']; ?> tabs<?= $f; ?>" style="position:relative;">
                 <?php

                  $f = 0;

                  if (count($reviewSSRResult['tripInfos']['0']['sI']) > 0) {
                    foreach ($reviewSSRResult['tripInfos']['0']['sI'] as $flightSegmentResults) {
            
                      $departureDateArr = explode('T', $flightSegmentResults['dt']);

                      $depdate = $departureDateArr[0];

                      $deptime = $departureDateArr[1];

                      $depcity = $flightSegmentResults['da']['code'];
                      $dtms1 = date('D, d M', strtotime($depdate));

                      $dt1 = date('D, d M Y', strtotime($depdate));

                      $arrDateArr = explode('T', $flightSegmentResults['at']);

                      $arrtime = $arrDateArr[1];

                      $arrDate = $arrDateArr[0];

                      $arrcity = $flightSegmentResults['aa']['code'];
                      $tm2 = $arrtime;

                      $dt2 = date('D, d M Y', strtotime($arrDate));

                      $AirlineCode = $flightSegmentResults['fD']['aI']['code'];

                      $airline = $flightSegmentResults['fD']['aI']['name'];

                      $airlinenum = $AirlineCode . "-" . $flightSegmentResults['fD']['fN'] . " " . $flightSegmentResults['fD']['eT'];

                      $FlightNumber = $flightSegmentResults['fD']['fN'];

                  ?>

                <a id="" class="Stab<?= $f; ?>" onClick="seatMapShow(<?= $f; ?>,<?= $reviewSSRResult['tripInfos']['0']['sI'][$f]['id']; ?>)"><?php echo $depcity; ?>-- <?php echo $arrcity; ?></a>
                <input name="SeatNoInn<?= $f; ?>" id="SeatNoInn<?= $f; ?>" type="hidden" value="">
                <input name="SeatPricearr<?= $f; ?>" id="SeatPricearr<?= $f; ?>" type="hidden" value="">
                <input name="segmentKey<?= $f; ?>" id="segmentKey<?= $f; ?>" type="hidden" value="">

                <input name="segmentid<?= $f; ?>" id="segmentid<?= $f; ?>" type="hidden" value="">

                  <?php $f++;
                    }
                  }


                  ?>
                <input name="totalflight" id="totalflight" type="hidden" value="<?= $f; ?>">
                </div>     

                  <?php if ($f == 0) { ?>
                <a id="" class="Stab<?= $f; ?>" onClick="seatMapShow(<?= $f; ?>,<?= $reviewSSRResult['tripInfos']['0']['sI'][$f]['id']; ?>)"><?php echo $depcity; ?>-- <?php echo $arrcity; ?></a>
                <input name="SeatNoInn<?= $f; ?>" id="SeatNoInn<?= $f; ?>" type="hidden" value="">
                <input name="SeatPricearr<?= $f; ?>" id="SeatPricearr<?= $f; ?>" type="hidden" value="">
                <input name="segmentKey<?= $f; ?>" id="segmentKey<?= $f; ?>" type="hidden" value="">
                <input name="segmentid<?= $f; ?>" id="segmentid<?= $f; ?>" type="hidden" value="">
        

                  <?php }  ?>
                    <div class="seatmapload" style="width:100%; margin-top:20px; height: 550px; overflow: auto"> 
                    </div>
                    <button type="button" class="btn btn-danger btn-sm float-left mt-2" onClick="$('.seat_selection').hide(); $('.viewseatmap').show()"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>
                  </div>

                  <div class="col-sm-12 mb-4 seat_selection2" style="display: none">
              <div class="seatdetailsboxtabs2<?php echo $res['id']; ?> tabs2<?= $f; ?>" style="position:relative;">
                <div style="float: right;">
                    <select class="form-control select_passengers">
                      <?php

                      $adult=$_SESSION['ADT'];
                      $child=$_SESSION['CHD'];
                      $infant=$_SESSION['INF'];
                      $total_passenger=$adult+$child; 
                      
                      for($i=0; $i < $total_passenger; $i++)
                      {
                      ?>
                      <option value="<?= $i; ?>">Passenger-<?= $i+1 ?></option>
                      <?php 
                      }
                      ?>
                  </select>
                </div>
                  <?php if ($resret['id'] > 0) { 

                    $f2 = 0;
                    if (count($reviewSSRResult['tripInfos']['1']['sI']) > 0) {
                      foreach ($reviewSSRResult['tripInfos']['1']['sI'] as $flightSegmentResults) {

                        $departureDateArr = explode('T', $flightSegmentResults['dt']);

                        $depdate = $departureDateArr[0];

                        $depcity = $flightSegmentResults['da']['code'];
                        $tm1 = $deptime;

                        $dtms1 = date('D, d M', strtotime($depdate));

                        $dt1 = date('D, d M Y', strtotime($depdate));

                        $arrDateArr = explode('T', $flightSegmentResults['at']);

                        $arrtime = $arrDateArr[1];

                        $arrDate = $arrDateArr[0];

                        $arrcity = $flightSegmentResults['aa']['code'];

                        $tm2 = $arrtime;

                        $dt2 = date('D, d M Y', strtotime($arrDate));
                        $airlinenum = $AirlineCode . "-" . $flightSegmentResults['fD']['fN'] . " " . $flightSegmentResults['fD']['eT'];

                        $FlightNumber = $flightSegmentResults['fD']['fN'];

                    ?>
                  
                  <a id="" class="Stab2<?= $f2; ?>" onClick="seatMapShow2(<?= $f2; ?>,<?= $reviewSSRResult['tripInfos']['1']['sI'][$f2]['id']; ?>)"><?php echo $depcity; ?>-- <?php echo $arrcity; ?></a>
                  <input name="SeatNoInn2<?= $f2; ?>" id="SeatNoInn2<?= $f2; ?>" type="hidden" value="">
                  <input name="SeatPricearr2<?= $f2; ?>" id="SeatPricearr2<?= $f2; ?>" type="hidden" value="">
                  <input name="segmentKey2<?= $f2; ?>" id="segmentKey2<?= $f2; ?>" type="hidden" value="">
                  <input name="segmentid2<?= $f2; ?>" id="segmentid2<?= $f2; ?>" type="hidden" value="">
        
        
                      <?php $f2++;
                      }
                    }  ?>
                   <input name="totalflight2" id="totalflight2" type="hidden" value="<?= $f2; ?>">

                    <?php if ($f2 == 0) { ?>
                      <div class="row mb-3">
                    <div class="col-8">
                  <?php echo stripslashes($resret['ORG_NAME']); ?>
                  <span>---------</span>
                  <?php echo stripslashes($resret['DES_NAME']); ?>
                  </div>
                  <div class="col-4">
                  <div class="js-form-message" style="float: right">
                  <a style="line-height: 1.0; max-width:200px;" class="btn btn-danger border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 seatview" data-passenger="seatAdult_<?php echo $adult; ?>">View Seat</a>
                  <input name="SeatNoInn2<?= $f2; ?>" id="SeatNoInn2<?= $f2; ?>" type="hidden" value="">
                <input name="SeatPricearr2<?= $f2; ?>" id="SeatPricearr2<?= $f2; ?>" type="hidden" value="">
                <input name="segmentKey2<?= $f2; ?>" id="segmentKey2<?= $f2; ?>" type="hidden" value="">
                <input name="segmentid2<?= $f2; ?>" id="segmentid2<?= $f2; ?>" type="hidden" value="">
        
                </div>

                    </div>
                    </div>
                    <?php } }?>

                    

                    <div class="seatmapload2" style="width:100%; margin-top:20px; height: 550px; overflow: auto"> 
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm float-left mt-2" onClick="$('.seat_selection2').hide(); $('.viewseatmap').show()"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>

                  </div>
                  
                  <div class="viewseatmap">
                        <div class="row mb-3">
                        <div class="col-8">
                      <?php echo stripslashes($res['ORG_NAME']); ?>
                      <span>---------</span>
                      <?php echo stripslashes($res['DES_NAME']); ?>
                      </div>
                        <div class="col-4">
                        <a style="line-height: 1.0; max-width:200px;" class="btn btn-danger border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 seatview" data-passenger="seatAdult_<?php echo $adult; ?>">View Seat</a>
                        </div></div>
                        <?php if($resret['id'] > 0){ ?>
                        <div class="row mb-3">
                        <div class="col-8">
                      <?php echo stripslashes($resret['ORG_NAME']); ?>
                      <span>---------</span>
                      <?php echo stripslashes($resret['DES_NAME']); ?>
                      </div>
                        <div class="col-4">
                        <a style="line-height: 1.0; max-width:200px;" class="btn btn-danger border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 seatview2" data-passenger="seatAdult_<?php echo $adult; ?>">View Seat</a>
                        </div></div> <?php } ?>
                      </div>
              </div>
            </div>
              
             
<script>
  $('.seatview').on('click', function() {
  $('.viewseatmap').hide();
  $('.seat_selection').show();
  $('.Stab0').addClass('active');
  $('#seatMapResponse<?= $reviewSSRResult['tripInfos']['0']['sI'][0]['id']; ?>').show();
});

$('.seatview2').on('click', function() {
  $('.viewseatmap').hide();
  $('.seat_selection2').show();
  $('.Stab20').addClass('active');
  $('#seatMapResponse2<?= $reviewSSRResult['tripInfos']['1']['sI'][0]['id']; ?>').show();
});

  //  $('.seatdetailsboxtabs<?php echo $res['id']; ?> a').addClass('active');
  function seatMapShow(c,id){
  
    $('.seatdetailsboxtabs<?php echo $res['id']; ?> a').removeClass('active');
    $('.seatdetailscontent<?php echo $res['id']; ?>').hide();
    $('.select_passengers2<?php echo $res['id']; ?>').hide();

    $('#seatMapResponse'+id).show();
    $('.Stab'+c).addClass('active');
    $('#select_passengers'+c).show();
  
  }

  function seatMapShow2(c,id){
  
  $('.seatdetailsboxtabs2<?php echo $res['id']; ?> a').removeClass('active');
  $('.seatdetailscontent2<?php echo $res['id']; ?>').hide();
  $('.select_passengers2<?php echo $resret['id']; ?>').hide();

  $('#seatMapResponse2'+id).show();
  $('.Stab2'+c).addClass('active');
  $('#select_passengers'+c).show();

}

function triptype2(){
  $('.trip2').addClass('active');
	$('.trip1').removeClass('active');
	$('.seatmapload2').show();
	$('.seatmapload').hide();
 
}
function triptype1(){
  $('.trip2').removeClass('active');
	$('.trip1').addClass('active');
	$('.seatmapload').show();
	$('.seatmapload2').hide();

}


$('.seatmapload').load("flight_review_book_tripjack_seat_map.php?ResultIndex=<?= $_REQUEST['ResultIndex'] ?>&id=<?php echo $res['id']; ?>");
	let triptype = $('.seatselectioncard').attr('data-tripinf2');
	if(triptype != ''){
$('.seatmapload2').load("flight_review_book_tripjack_roundtrip_seat_map.php?ResultIndex=<?= $_REQUEST['ResultIndex'] ?>&id=<?php echo $res['id']; ?>");
  }
function seatfare(){

let seatsno='';
let seatposition='';
let seatamount='';
let output='';
let count=0;

for(i=1; i <= seat_selected_noarr.length; i++){
  if(seat_selected_noarr[i] === 'undefined')
    continue;
    for(j=0; j <= seat_selected_noarr[count].length-1; j++){
      seatsno = seat_selected_noarr[count][j];
      seatposition = seatpos[count][j];
    seatamount = seat_selected_amtarr[count][j];
    flightcode = flight_id[count][j];
    if(seatsno != '' || seatposition != ''){

      
    output += '(' + flightcode + ')' + seatsno + '-' + seatposition + '- ₹' + seatamount + '<br>'
    }
  }

 
	//seatfare+=el.value + '<br>';
	

 count++;
}
//console.log(output);

 if(seat_selected_noarr != ''){
$('.seat_fare').show();
$('.seatamount').html(output);
 }else{
	 $('.seat_fare').hide();
 }
}

</script>


            <div class="card cardresult" style="width:100%; margin-top:20px;">

              <div class="card-header">Contact Details</div>



              <div class="card-body">



                <div class="row"> <!-- Input -->





                  <div class="col-sm-6 mb-4">

                    <div class="js-form-message">

                      <label class="form-label">

                        Email

                      </label>



                      <input type="email" class="form-control validate1" name="email" placeholder="" aria-label="" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" value="<?php echo $LoginUserDetails['email']; ?>">

                    </div>

                  </div>

                  <!-- End Input -->



                  <!-- Input -->

                  <div class="col-sm-6 mb-4">

                    <div class="js-form-message">

                      <label class="form-label">

                        Phone

                      </label>



                      <input type="number" class="form-control validate1" name="phone" placeholder="" aria-label="" required data-msg="Please enter a valid phone number." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="nope" value="<?php echo $LoginUserDetails['phone']; ?>">

                    </div>

                  </div>

                  <!-- End Input -->



                  <!-- Input -->



                  <!-- End Input -->

                </div>



                <div class="row" style="position:relative;">

                  <label style="padding-left: 37px; width: 100%; margin-bottom: 30px;"><input name="gst" type="checkbox" value="1" onClick="ifgst();" class="checkbox_check" style="width: 16px; height: 16px; position: absolute; left: 14px; top: 3px;"> I have a GST number (Optional)</label>

                  <div class="col-sm-4 mb-4 showgst">

                    <div class="js-form-message">

                      <label class="form-label">

                        Company Name

                      </label>



                      <input type="text" class="form-control" name="companyName" placeholder="" autocomplete="nope">

                    </div>

                  </div>



                  <div class="col-sm-4 mb-4 showgst">

                    <div class="js-form-message">

                      <label class="form-label">

                        GST No

                      </label>



                      <input type="test" class="form-control" name="gstNo" placeholder="" autocomplete="nope">

                    </div>

                  </div>



                  <div class="col-sm-4 mb-4 showgst">

                    <div class="js-form-message">

                      <label class="form-label">

                        Email

                      </label>



                      <input type="test" class="form-control" name="gstEmail" placeholder="" autocomplete="nope">

                    </div>

                  </div>







                </div>





              </div>

              <div class="card-footer text-muted hidefooter">



                <button type="button" class="btn btn-danger btn-sm float-left" onClick="$('#steponeflightdetails').show();$('#steptwopassengerdetails').hide();$('.flightreviewbox').removeClass('active');$('#strp1').addClass('active');$('#showfooterpay').hide();"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>
                
                <button type="button" class="btn btn-danger btn-sm" style="float:right;" id="reviewbtn" onClick="checkInputs();">Proceed To Review</button>





              </div>







              <div class="card-footer text-muted" id="showfooterpay" style="display:none;">



                <button type="button" class="btn btn-danger btn-sm float-left backondetail"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>

                <button type="button" class="btn btn-danger btn-sm pay_btn proceedtopaybtn" style="float:right;">Proceed To Pay</button>





              </div>

            </div>



          </div>







          <?php $str_arr = explode(",", $res['agfare']);

          $basefare = explode("=", $str_arr[2]);

          ?>

          <div class="col-12" style="position:relative; margin-bottom:20px; display:none;" id="stepfourpayments">

            <h2>Payments</h2>



            <div class="card cardresult" style="width:100%;">

              <div class="card-header">

                Pay By Wallet

              </div>



              <div class="row">



                <div class="col-4">



                  <div style="padding: 40px 0px; text-align: center;  font-size: 30px; border-bottom-left-radius: 5px; <?php if ($totalwalletBalance >= $basefare[1]) { ?>border-right: 2px solid #41e0d2; background-color: #e4f8ff; color:#02C4B0;<?php } else { ?>border-right: 2px solid #e04159; background-color: #ffe4e4;color:#c4021e;<?php } ?>">

                    <div style="font-weight:600; ">₹<?php echo round($totalwalletBalance); ?></div>

                    <div style="font-size:14px; color:#000000; "><strong>Your Wallet Balance</strong></div>

                  </div>



                </div>





                <div class="col-8">

                  <div class="card-body">

                    <?php //if($totalwalletBalance>=($basefare[1]+$totalfareret)){
                    ?>

                    <div style="padding-top:10px; padding-bottom:10px; font-size:14px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; By placing this order, you agree to our Terms Of Use and Privacy Policy</div>



                    <input name="termsofuse" type="checkbox" value="1"> I accept <a href="<?php echo $fullurl; ?>terms-conditions" target="_blank" style="text-decoration:underline;">terms & conditions</a>



                    <input name="flightbooking" id="flightbooking" type="hidden" value="1">

                    <input name="bookingMethod" id="bookingMethod" type="hidden" value="0">





                    <div style=" font-size:14px; margin-bottom:10px; margin-top:15px;">

                      <?php if ($totalwalletBalance >= ($finaltotalpay)) { ?>

                        <button type="button" class="btn btn-danger" onClick="payandbooknow();" id="paywalletbtn">Confirm Price <img style="margin-left:10px" width="24" src="images/loadinggif.gif" ></button>


                      <?php } ?>

                      <a id="payonlinelink"><button type="button" class="btn btn-danger payonlinebtnmain" id="payonlinebtn">Pay Online ₹<?php echo ($finaltotalpay); ?></button></a>






                    </div>





                    <?php /*} else { ?>



<div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>

<?php } */ ?>

                  </div>





                </div>





              </div>







            </div>



          </div>



        </div>



      </div>

      <div class="col-lg-4 col-sm-12 faresummrybox" style="display: none; position: sticky;">

        <div class="card flightbooking" style="background-color: #ffffff63 !important; top: 136px">
          <div class="card-header">
            Fare Summary
          </div>

          <div class="card-body">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; color:#000000;">
              <tr>
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;"><strong>Base fare<span class="openclosebaseprice" onClick="openclosebase();">+</span></strong></td>
                <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;"><strong>₹<?php
                                                                                                                       
                                                                                                                        echo $BaseFare= $Basic_fare;
                                                                                                                      
                                                                                                                        // $str_arr = explode(",", $res['agfare']);
                                                                                                                        // $basefare = explode("=", $str_arr[0]);
                                                                                                                        // echo $BaseFare = ($basefare[1] + $basefareret);
                                                                                                                         
                                                                                                                         ?><strong></td>
              </tr>
              <?php
              if(!empty($_SESSION['ADT'])){
              ?>
              <tr class="hidecommall">
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Adult X <?= $_SESSION['ADT'] ?></td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php 
                                                                                                        echo $AdtBf * $_SESSION['ADT'];
                                                                                                          // $totalbasefareadt= $basefareadt + $basefareadt2; 
                                                                                                          // echo $totalbasefareadt * $_SESSION['ADT'];
                                                                                                              ?></td>
              </tr>
              <?php
              }
              if(!empty($_SESSION['CHD'])){
              ?>
              <tr class="hidecommall">
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Child X <?= $_SESSION['CHD'] ?></td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php  
                                           
                                                      echo $ChdBf * $_SESSION['CHD'];
                                                
																											// $totalbasefarechd =  $basefarechd + $basefarechd2;
                                                      // echo $totalbasefarechd * $_SESSION['CHD'];
                                                                                                         ?></td>
              </tr>
              <?php
              }
              if(!empty($_SESSION['INF'])){
              ?>
              <tr class="hidecommall">
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Infant X <?= $_SESSION['INF'] ?></td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php
                                                                                                      
                                                                                                          echo $InfBF * $_SESSION['INF'];
                                                                                                       
                                                                                                            //  $totalbasefareinf = $basefareinf +$basefareinf2;
                                                                                                            //  echo $totalbasefareinf * $_SESSION['INF'];
                                                                                                        
                                                                                                             ?></td>
              </tr>
              <?php
              }
              ?>
              <tr>
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Taxes and fees</td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php
                                                                                                          
                                                                                                            echo $Tax= $TotalTax_fare;
                                                                                                        
                                                                                                            // $basefare = explode("=", $str_arr[1]);
                                                                                                            // echo $Tax = ($basefare[1] + $basetaxret);
                                                                                                          
                                                                                                           ?></td>
                                                                                                            
            </tr>
              <tr class="baggage_fare" style="display: none">
                <td  align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Baggage Fee:</td>
                <td colspan="2" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:0.9em;"><span class="font-weight-medium" id="baggval"></span></td>
              </tr>
              <tr class="meal_fare" style="display: none">
                <td  align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Meal Fee:</td>
                <td colspan="2" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:0.9em;"><span class="font-weight-medium" id="mealval"></span></td>
              </tr>
              <tr class="seat_fare" style="display: none">
                <td colspan="1" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Seat: </td>
                <td colspan="3" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:0.9em;">
				<!--<span class="font-weight-medium seatval" style="display: inline-block;margin-right: 68%;"> </span>-->
				<span class="font-weight-medium seatvalamt seatamount"></span></td>
              </tr>

              <?php
              if ($_SESSION['tripType'] == 2 ) {
              ?>
                <tr class="return_fare" style="display: none">
                  <td colspan="4" align="center" style="padding:10px 0px; border-bottom:1px solid #ddd;">Return Flight</td>
                </tr>
                <tr class="baggage_fare2" style="display: none">
                  <td  align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Baggage Fee:</td>
                  <td colspan="2" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:0.9em;"><span class="font-weight-medium" id="baggval2"></span></td>
                </tr>
                <tr class="meal_fare2" style="display: none">
                  <td  align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Meal Fee:</td>
                  <td colspan="2" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:0.9em;"><span class="font-weight-medium" id="mealval2"></span></td>
                </tr>
                <tr class="seat_fare2" style="display: none">
                  <td colspan="1" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Seat: </td>
                  <td colspan="3"  align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:0.9em;">
				  <!--<span class="font-weight-medium seatval2" style="display: inline-block;margin-right: 68%;"> </span>-->
				  <span class="font-weight-medium seatvalamt2 seatamount2"></span></td>
                </tr>





              <?php } ?>





              <tr style="display:none;" id="discountAmtDiv">

                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Discount Amount</td>

                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">- ₹<span id="discountAmt"></span></td>
              </tr>





              <tr>
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;"><strong>Total Fare <span class="opencloseprice" onClick="openclose();">+</span></strong></td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;"><strong><?php  
                                                                                                            echo ($BaseFare + $Tax); ?></strong></td>
              </tr>
              <tr class="hidecomm">
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Commission (-)</td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php 
           
                  echo $totalcommission=abs($NCM);
        
                  // $totalcommission=abs($totalcommission);
                  // echo $totalcommission;
                 ?></td>
              </tr>
              <tr class="hidecomm">
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">GST</td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo $totalcommissiongstdisplay = round($totalcommission * 18 / 100); //round((($BaseFare+$Tax) * 18)/100); 
                                                                                                            ?></td>
              </tr>
              <tr class="hidecomm">
                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">TDS</td>
                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo $totaltdsdisplay = round($totalcommission * 5 / 100); ?></td>
              </tr>
              <tr>

                <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;"><strong>Net Price</strong></td>

                <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;"><strong>₹

                    <span id="totalamountpaybox"><?php
                                                
                                                    echo $finaltotalpay=round(($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['NF']+$res['agentFixedMakup'] + $resret['agentFixedMakup'] + $totaltdsdisplay + $totalcommissiongstdisplay) - $totalcommission);
                                                 
                                                  // $basefare = explode("=", $str_arr[2]);

                                                  // echo $finaltotalpay = (
                                                  //   $res['agentFixedMakup'] + $resret['agentFixedMakup'] + $basefare[1] + $totalfareret + $totalcommissiondisplay + $totaltdsdisplay + $totalcommissiongstdisplay) - $totalcommission;
                                                  
                                                  ?></span>
                  </strong></td>
              </tr>
            </table>

            <?php if ($totalwalletBalance >= ($basefare[1] + $totalfareret)) {
            } else { ?>

              <div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>

            <?php } ?>

          </div>

        </div>

        <br>


        <br>




        <?php
        $totalFare = round($basefare[1] + $totalfareret);
        ?>

      </div>





      <?php

      $arq = ($totalFare - $wallet30PercBalance);

      $arq = $arq + 202565517 + 202565517;
  
      // echo round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF']);
      // die;
      $TotalFare2=$BaseFare + $Tax;
      $Total= round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF']);
      if($TotalFare2 != $Total){
    $TF2= round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF']);
    }else{
      $TF2=0;

    }
      ?>

      <input name="flightone" type="hidden" value="<?php echo encode($_REQUEST['i']); ?>">

      <input name="flighttwo" type="hidden" value="<?php echo encode($_REQUEST['r']); ?>">

      <input type="hidden" name="arq" id="arq" value="<?php echo $arq; ?>">

      <input name="baseFareInn" id="baseFareInn" type="hidden" value="<?php echo $BaseFare; ?>">

      <input name="TaxAndFeeInn" id="TaxAndFeeInn" type="hidden" value="<?php echo $Tax; ?>">



      <input name="BaggageFeeInn" id="BaggageFeeInn" type="hidden" value="0">

      <input name="MealFeeInn" id="MealFeeInn" type="hidden" value="0">

      <input name="SeatFeeInn" id="SeatFeeInn" type="hidden" value="0">
      <input name="BaggageFeeInnC2" id="BaggageFeeInnC2" type="hidden" value="0">
      <input name="BaggageFeeInnC" id="BaggageFeeInnC" type="hidden" value="0">
      <input name="MealFeeInnC" id="MealFeeInnC" type="hidden" value="0">
      <input name="MealFeeInnC2" id="MealFeeInnC2" type="hidden" value="0">
      <input name="SeatFeeInnC" id="SeatFeeInnC" type="hidden" value="0">
      <input name="agentmarkup" id="agentmarkup" type="hidden" value="<?= $res['agentFixedMakup'] ?>">


      <input name="BaggageFeeInn2" id="BaggageFeeInn2" type="hidden" value="0">

      <input name="MealFeeInn2" id="MealFeeInn2" type="hidden" value="0">

      <input name="SeatFeeInn2" id="SeatFeeInn2" type="hidden" value="0">
      <!-- <input name="segmentKey" id="segmentKey" type="hidden" value="0"> -->
      <!-- <input name="segmentKey2" id="segmentKey" type="hidden" value="0"> -->


      <input name="SeatPriceInn" id="SeatPriceInn" type="hidden" value="0">
      <!-- <input name="SeatPricearr" id="SeatPricearr" type="hidden" value="0"> -->
      <!-- <input name="SeatPricearr2" id="SeatPricearr2" type="hidden" value="0"> -->
      <input name="SeatPriceInn2" id="SeatPriceInn2" type="hidden" value="0">
      <input name="agentmarkup2" id="agentmarkup2" type="hidden" value="<?= $_REQUEST['r'] != '' &&  !empty($resret['agentFixedMakup'])? (float)$resret['agentFixedMakup'] : 0 ?>">


      <!-- <input name="SeatNoInn" id="SeatNoInn" type="hidden" value=""> -->

      <!-- <input name="SeatNoInn2" id="SeatNoInn2" type="hidden" value=""> -->





      <input name="totalAmountToPay" id="totalAmountToPay" type="hidden" value="<?php echo ($finaltotalpay); ?>">
      <input name="earnedcommission" id="earnedcommission" type="hidden" value="<?php echo $totalcommission; ?>">
      <input name="totalcommissiongstdisplay" id="totalcommissiongstdisplay" type="hidden" value="<?php echo $totalcommissiongstdisplay; ?>">
      <input name="totaltdsdisplay" id="totaltdsdisplay" type="hidden" value="<?php echo $totaltdsdisplay; ?>">

<?php 
 $totalPriceList=$reviewSSRResult['tripInfos']['0']['totalPriceList'][0]['fd'];
 $totalPriceList2=$reviewSSRResult['tripInfos']['1']['totalPriceList'][0]['fd'];
 $AdtCount=$_SESSION['ADT'];
 $ChdCount=$_SESSION['CHD'];
 $InfCount=$_SESSION['INF'];

 $AdtBaseFare=round($totalPriceList['ADULT']['fC']['BF']*$AdtCount);
 $ChdBaseFare=round($totalPriceList['CHILD']['fC']['BF']*$ChdCount);
 $InfantBaseFare=round($totalPriceList['INFANT']['fC']['BF']*$InfCount);

 $AdtNetFare=round($totalPriceList['ADULT']['fC']['NF']*$AdtCount);
 $ChdNetFare=round($totalPriceList['CHILD']['fC']['NF']*$ChdCount);
 $InfNetFare=round($totalPriceList['INFANT']['fC']['NF']*$InfCount);

 $AdtTax=round($totalPriceList['ADULT']['fC']['TAF']*$AdtCount);
 $ChdTax=round($totalPriceList['CHILD']['fC']['TAF']*$ChdCount);
 $InfTax=round($totalPriceList['INFANT']['fC']['TAF']*$InfCount);

 $AdtCommission=round($totalPriceList['ADULT']['fC']['NCM']*$AdtCount);
 $ChdCommission=round($totalPriceList['CHILD']['fC']['NCM']*$ChdCount);
 $InfCommission=round($totalPriceList['INFANT']['fC']['NCM']*$InfCount);


$TotalBaseFare=round($AdtBaseFare+ $ChdBaseFare+ $InfantBaseFare);
$TotalNetFare=round($AdtNetFare+ $ChdNetFare+ $InfNetFare);
$TotalTax=round($AdtTax+ $ChdTax+ $InfTax);
$TotalCommission=round($AdtCommission+ $ChdCommission+ $InfCommission);
if($TotalCommission==''){
  $TotalCommission=0; 
}
if ($resret['id'] > 0) {
  $AdtBaseFare2=round($totalPriceList2['ADULT']['fC']['BF']*$AdtCount);
  $ChdBaseFare2=round($totalPriceList2['CHILD']['fC']['BF']*$ChdCount);
  $InfantBaseFare2=round($totalPriceList2['INFANT']['fC']['BF']*$InfCount);

  $AdtNetFare2=round($totalPriceList2['ADULT']['fC']['NF']*$AdtCount);
  $ChdNetFare2=round($totalPriceList2['CHILD']['fC']['NF']*$ChdCount);
  $InfNetFare2=round($totalPriceList2['INFANT']['fC']['NF']*$InfCount);
 
  $AdtTax2=round($totalPriceList2['ADULT']['fC']['TAF']*$AdtCount);
  $ChdTax2=round($totalPriceList2['CHILD']['fC']['TAF']*$ChdCount);
  $InfTax2=round($totalPriceList2['INFANT']['fC']['TAF']*$InfCount);

  $AdtCommission2=round($totalPriceList2['ADULT']['fC']['NCM']*$AdtCount);
  $ChdCommission2=round($totalPriceList2['fC']['NCM']*$ChdCount);
  $InfCommission2=round($totalPriceList2['fC']['NCM']*$InfCount);
  
  $TotalCommission2=round($AdtCommission2+ $ChdCommission2+ $InfCommission2);
  $TotalBaseFare2=round($AdtBaseFare2+ $ChdBaseFare2+ $InfantBaseFare2);
   $TotalNetFare2=round($AdtNetFare2+ $ChdNetFare2+ $InfNetFare2);
   $TotalTax2=round($AdtTax2+ $ChdTax2+ $InfTax2);
   if($TotalCommission2==''){
    $TotalCommission2=0; 
  }

}else{
 $TotalBaseFare2=0;
$TotalNetFare2=0;
$TotalTax2=0;
$TotalCommission2=0;
} ?>

      <input name="TotalBaseFare" id="TotalBaseFare" type="hidden" value="<?php echo $TotalBaseFare; ?>">

      <input name="TotalNetFare" id="TotalNetFare" type="hidden" value="<?php echo $TotalNetFare; ?>">

      <input name="TotalTax" id="TotalTax" type="hidden" value="<?php echo $TotalTax; ?>">

      <input name="TotalCommission" id="TotalCommission" type="hidden" value="<?php echo $TotalCommission; ?>">

     <input name="TotalBaseFare2" id="TotalBaseFare2" type="hidden" value="<?php echo $TotalBaseFare2; ?>">

      <input name="TotalNetFare2" id="TotalNetFare2" type="hidden" value="<?php echo $TotalNetFare2; ?>">

      <input name="TotalTax2" id="TotalTax2" type="hidden" value="<?php echo $TotalTax2; ?>">

      <input name="TotalCommission2" id="TotalCommission2" type="hidden" value="<?php echo $TotalCommission2; ?>">



  </form>


  <script>
   
 


    function fillbtnpay() {
      var totalAmountToPay = $('#totalAmountToPay').val();
      // $('#paywalletbtn').text('Pay Now ₹' + totalAmountToPay + '');
      $('#payonlinebtn').text('Pay Online ₹' + totalAmountToPay + '');
      $('#payonlinelink').attr('onClick', "window.open('onlinerecharge?b=1&bamount=" + totalAmountToPay + "&z=<?php echo encode($_SESSION['agentUserid']); ?>&type=<?php echo $bookingServiceType; ?>&bType=<?php echo $_SESSION['serviceId']; ?>', '_blank', 'location=yes,height=600,width=1000,scrollbars=yes,status=yes')");

    }

    fillbtnpay();

    function gettotalamountpay() {

      var totalAmountToPay = $('#totalAmountToPay').val();
      $('#totalamountpaybox').text(totalAmountToPay);
    }


    setInterval(function() {
      gettotalamountpay()
    }, 500);
  </script>

</div>









<div class="row" id="bookingloading" style="display:none;">

  <div class="col-12" style=" text-align:center;">



    <div class="card">

      <div class="card-body">



        <div style="text-align:center; font-size:30px; padding:80px 0px;">

          <div style="text-align:center; "><img src="images/loadinggif.gif" width="40"></div>

          Wait Please Processing...
        </div>



      </div>

    </div>

  </div>

</div>





</div>

<div class="timer-btm mt-3" style="color: white; text-align: center; background: #000;position: fixed; bottom: 0; width: 100%; left: 0; z-index: 9; padding: 8px 10px 9px;" >
<div class="container starttimer">
  <?php 
   $seconds=$reviewSSRResult['conditions']['st'];
  $secs = $seconds % 60;
  $hrs = $seconds / 60;
  $mins = $hrs % 60;
  
  $hrs = $hrs / 60;
  ?>
Your Session will expire in
<span id="mins"><?= (int)$mins; ?> </span> mins:
<span id="seconds"><?= (int)$secs; ?></span> sec
</div>

</div>


<script>

$(document).ready(function () {

var mins = $('#mins').text();
var seconds = $('#seconds').text();
// $(".starttimer").click(function () {
startTimer();
// });
function startTimer() {
timex = setTimeout(function () {
seconds++;
if (seconds > 59) {
seconds = 0;
mins--;
if (mins < 10) {
$("#mins").text("0" + mins);
} else $("#mins").text(mins);
}
if (seconds < 10) {
$("#seconds").text("0" + seconds);
} else {
$("#seconds").text(seconds);
}
startTimer();
}, 1000);
}
});

  // if ( $('.dobalert').css('display') == 'none')
  //   {
  //     $('#reviewbtn').show();

  //   }else{
  //     $('#reviewbtn').hide();
  //   }
   
  $(".dobAdt").change(function() {

  let typeadt=$('.typeadt').attr('data-type');
  let dobAlert=$(this).attr('data-countadt');
  let dobAdt = $(this).val();
  let dd= dobAdt.split("-");

  const adtdob=dd[2] + '-' + dd[1] + '-' + dd[0];

  let aa =calculate_age(new Date(adtdob));
  console.log(aa);
  if(aa >=60 && typeadt == 'adult'){

    $('.agealertAdt'+ dobAlert).hide();

  }else{
    $('.agealertAdt'+ dobAlert).show();
  }
  });

  $(".dobChd").change(function() {

    let typechd=$('.typechd').attr('data-type');
    let dobalert=$(this).attr('data-countchd');
    let dobChd = $(this).val();
    let d= dobChd.split("-");

    const chddob=d[2] + '-' + d[1] + '-' + d[0];

    let a =calculate_age(new Date(chddob));
    console.log(a);
    if(a > 2 && a <= 12 && typechd == 'child'){

      $('.agealert'+ dobalert).hide();
    
    }else{
      $('.agealert'+ dobalert).show();
    }
});

$(".dobInf").change(function() {

    let dobinf = $(this).val();
    let dobalert2=$(this).attr('data-countinf');

    let dateinf= dobinf.split("-");

    const infdob=dateinf[2] + '-' + dateinf[1] + '-' + dateinf[0];

    let b =calculate_age(new Date(infdob));
    console.log(b);
    if(b <= 2){

    $('.agealertinf'+ dobalert2).hide();

    }else{
    $('.agealertinf'+ dobalert2).show();
    }
});

function calculate_age(dob) { 
    var diff_ms = Date.now() - dob.getTime();
    var age_dt = new Date(diff_ms); 
  
    return Math.abs(age_dt.getUTCFullYear() - 1970);
}

  function ssrfare(){

  let bag_fare='';

  const selects = document.querySelectorAll('.baggages');

  selects.forEach(function(el){
  if(el.value != 'INR 0'){
    bag_fare+=el.value + '<br>';
  }else{
    bag_fare+='';
    }
  });
  if(bag_fare != ''){
    $('.baggage_fare').show();
  }else{
    $('.baggage_fare').hide();
  }
  $("#baggval").html(bag_fare);
  
  }


  function mealsfare(){

  let meals_fare='';

  const selectmeal = document.querySelectorAll('.meals');
  
  selectmeal.forEach(function(el){
    if(el.value != 'INR 0'){
    meals_fare+=el.value + '<br>';
    //console.log(el.value);
    }else{
      meals_fare+='';
    }
  });
if(meals_fare != ''){
  $('.meal_fare').show();

}else{
  
  $('.meal_fare').hide();
}
  $("#mealval").html(meals_fare);
  
  }

function bagfareret(){

let bag_fare2='';

const bagselect = document.querySelectorAll('.baggages2');

bagselect.forEach(function(el){
if(el.value != 'INR 0'){
  bag_fare2 += el.value + '<br>';
}else{
  bag_fare2+='';
    }
});
if(bag_fare2 != ''){
  $('.return_fare').show();
  $('.baggage_fare2').show();
  
  }else{
    $('.return_fare').hide();
    $('.baggage_fare2').hide();
  
  }

$("#baggval2").html(bag_fare2);

}

function mealsfare2(){

let meals_fare2='';

const selectmeal2 = document.querySelectorAll('.meals2');

selectmeal2.forEach(function(el){
if(el.value != 'INR 0'){
  meals_fare2 += el.value + '<br>';
}else{
  meals_fare2+='';
    }

});
if(meals_fare2 != ''){
  $('.return_fare').show();
  $('.meal_fare2').show();

}else{
  $('.return_fare').hide();
  $('.meal_fare2').hide();

}
$("#mealval2").html(meals_fare2);

}

  function checkInputs() {
	
    var e = '';

    var flag = 0;

    
  

    $('.validate1').each(function() {
      let id = $(this).attr("id");

      if ($(this).val() == '') {

        $('.form-control').removeClass('redborderfiled');

        $(this).addClass('redborderfiled');

        $(this).focus();

        $('.'+id).show();

        e = 1;

        return false;

      }else{
        $('.'+id).hide();
      }

    });



    if (e == 1) {

      // alert('Please fill mandatory fields');

      // console.log('Please fill mandatory fields');

    }



    if (e != 1) {
      $('#reviewloadbox').addClass('makeReview');
      $('.form-control').removeClass('redborderfiled');
      reviewSsrDetail();

  $('#steponeflightdetails').show();$('#steptwopassengerdetails').show();$('.flightreviewbox').removeClass('active');$('#strp3').addClass('active');$(window).scrollTop(0);$('.hidefooter').hide();$('#showfooterpay').show();$('#stepfourpayments').hide();
	$('.seatselectioncard').hide();
    }
	$('.faresummrybox').show();
	$('.faresummrybox').css('margin-top','102px')

  }
function reviewSsrDetail(){
  
      
  let pcount=<?= $_SESSION['ADT'] != 0 ? $_SESSION['ADT']:0 ; ?>;
      for(let i=1; i<=pcount; i++){
        let adt_B=$('.adultbag'+i).val();
        let adt_M=$('.adultmeal'+i).val();
        let adt_B2=$('.adltbag2'+i).val();
        let adt_M2=$('.adltmeal2'+i).val();
          if(adt_B == "INR 0"){
          $('.bselect'+i).hide();
          $('.ssroptional').hide();
          }
          if(adt_M == "INR 0"){
            $('.Mselect'+i).hide();
            $('.ssroptional').hide();
          }
          if(adt_B2 == "INR 0"){
          $('.bselect2'+i).hide();
          $('.ssroptional').hide();
          }
          if(adt_M2 == "INR 0"){
            $('.Mselect2'+i).hide();
            $('.ssroptional').hide();
          }
        }
      let chdcount=<?= $_SESSION['CHD'] != 0 ? $_SESSION['CHD']:0; ?>;
      for(let i=1; i<=chdcount; i++){
        let chd_B=$('.childbag'+i).val();
        let chd_M=$('.childmeal'+i).val();
        let chd_B2=$('.childbag2'+i).val();
        let chd_M2=$('.childmeal2'+i).val();
          if(chd_B == "INR 0"){
          $('.chdbselect'+i).hide();
          $('.chdssroptional').hide();
          }
          if(chd_M == "INR 0"){
            $('.chdMselect'+i).hide();
            $('.chdssroptional').hide();
          }
          if(chd_B2 == "INR 0"){
          $('.chdbselect2'+i).hide();
          $('.chdssroptional').hide();
          }
          if(chd_M2 == "INR 0"){
            $('.chdMselect2'+i).hide();
            $('.chdssroptional').hide();
          }
      }
   
}




  function showfarerule(id) {

    var farerulebtn = $('.farerulebtn').text();

    if (farerulebtn == 'Show Fare Rules') {

      $('.farerulebtn').html('Hide Fare Rules');

      $('#showfarerule').slideDown();

    } else {

      $('.farerulebtn').html('Show Fare Rules');

      $('#showfarerule').slideUp();

    }



    if (farerulebtn == 'Show Fare Rules') {

      $('#showfarerule').html('Loading...');

      $('#showfarerule').load('showflightfarerule.php?id=' + id);

    }

  }





  function showfarerule2(id) {

    var farerulebtn = $('.farerulebtn2').text();

    if (farerulebtn == 'Show Fare Rules') {

      $('.farerulebtn2').html('Hide Fare Rules');

      $('#showfarerule2').slideDown();

    } else {

      $('.farerulebtn2').html('Show Fare Rules');

      $('#showfarerule2').slideUp();

    }



    if (farerulebtn == 'Show Fare Rules') {

      $('#showfarerule2').html('Loading...');

      $('#showfarerule2').load('showflightfarerule.php?id=' + id);

    }

  }





  $(function() {

    $(".datepickerfield").datepicker(

      {

        changeMonth: true,

        changeYear: true,

        yearRange: '-100:+0',

        dateFormat: 'dd-mm-yy',

        maxDate: new Date(),

        //minDate: '31-12-2022'


      }



    );

  });

  $(function() {
const current1 = new Date();
const yyyy1 = current1.getFullYear()-60;
const yy = current1.getFullYear()-100;

let mm1 = current1.getMonth() + 1; // Months start at 0!
let dd1 = current1.getDate();

if (dd1 < 10) dd1 = '0' + dd;
if (mm1 < 10) mm1 = '0' + mm;


$(".datepickerfieldadt").datepicker(

  {

    changeMonth: true,

    changeYear: true,

    // yearRange: '60:+0',

    dateFormat: 'dd-mm-yy',
  
    // maxDate: new Date(),

    maxDate: dd1 + '-' + mm1 + '-' + yyyy1,
    minDate: dd1 + '-' + mm1 + '-' + yy,

  }



);

});

$(function() {
const current = new Date();
const yyyy = current.getFullYear()-12;

let mm = current.getMonth() + 1; // Months start at 0!
let dd = current.getDate();

if (dd < 10) dd = '0' + dd;
if (mm < 10) mm = '0' + mm;


$(".datepickerfieldchd").datepicker(

  {

    changeMonth: true,

    changeYear: true,

    yearRange: '-12:+0',

    dateFormat: 'dd-mm-yy',

    maxDate: new Date(),

    minDate: dd + '-' + mm + '-' + yyyy,


  }



);

});
$(function() {
  const current2 = new Date();
const yyyy2 = current2.getFullYear()-2;

let mm2 = current2.getMonth() + 1; // Months start at 0!
let dd2 = current2.getDate();

if (dd2 < 10) dd2 = '0' + dd2;
if (mm2 < 10) mm2 = '0' + mm2;

$(".datepickerfieldinf").datepicker(

  {

    changeMonth: true,

    changeYear: true,

    yearRange: '-2:+0',

    dateFormat: 'dd-mm-yy',

    maxDate: new Date(),

    minDate: dd2 + '-' + mm2 + '-' + yyyy2,


  }



);

});
  $(function() {

    $(".datepickerfieldexpiry").datepicker(

      {

        changeMonth: true,

        changeYear: true,

        yearRange: '-100:+50',

        dateFormat: 'yy-mm-dd',

        minDate: 0



      }



    );

  });





  $(function() {

    $(".datepickerfieldIssueDate").datepicker(

      {

        changeMonth: true,

        changeYear: true,

        yearRange: '-100:+50',

        dateFormat: 'yy-mm-dd',

        maxDate: 0



      }



    );

  });
</script>



<script>
  $('#showfarerule').load('showflightfarerule.php?id=<?php echo encode($res['id']); ?>&checkingflightfare=1');

  <?php if ($resret['id'] != '') { ?>

    $('#showfarerule2').load('showflightfarerule.php?id=<?php echo encode($resret['id']); ?>&checkingflightfare=1');

  <?php } ?>



  function payandbooknow() {

    $('#flightbooking').val('1');

    $('#flightbookingsubmit').submit();

    $('#bookingloading').show();

    $('#bookingdatainfo').hide();

    $('.flightreview').hide();

  }
</script>



<iframe id="bookingframe" name="bookingframe" style="display:none;"></iframe>




<script type="text/javascript">
  $(document).ready(function() {



    $('.popup-ajax').magnificPopup({



      removalDelay: 500,



      closeBtnInside: true,



      callbacks: {



        beforeOpen: function() {



          $("#view-seats").html('<div style="font-size:20px;text-align:center;line-height:120px;width:100%;">Wait Please...</div>');



          var myvalue = this.st.el.attr('data-id');

          //console.log('myvalue ' + myvalue);



          var dataPassenger = this.st.el.attr('data-passenger');

          console.log('dataPassenger ' + dataPassenger);



          var res = myvalue.split("|"); //alert(res);



          var n = res[0];



          var trid = 'seatlayout' + res[0];



          var sdd = "<?php echo base64_encode($sid); ?>";



          tripid = res[1];
          trvnm = res[2];
          bloc = res[3];
          btime = res[4];
          dloc = res[5];
          dtime = res[6];
          fare = res[7];
          busdesc = res[8];
          dur = res[9];



          $.ajax({
            url: "ajax_seat_layout.php?tnm=" + trvnm + "&bl=" + bloc + "&bt=" + btime + "&dl=" + dloc + "&dt=" + dtime + "&f=" + fare + "&bdesc=" + busdesc + "&dur1=" + dur + "&tid=" + tripid + "&tripid=" + tripid + "&j=" + n + "&dataPassenger=" + dataPassenger,
            success: function(result) {



              $("#view-seats").html(result);



            }



          });



          this.st.mainClass = this.st.el.attr('data-effect');



        }



      },



      midClick: true







    });







    $(".popclose").click(function() {



      $(".mfp-close").click();



    });



    /*********** Return Fligh *********/



    $('.popup-ajax2').magnificPopup({



      removalDelay: 500,



      closeBtnInside: true,



      callbacks: {



        beforeOpen: function() {



          $("#view-seats").html('<div style="font-size:20px;text-align:center;line-height:120px;width:100%;">Please Wait...<i class="fa fa-spinner user-profile-statictics-icon"></i></div>');



          var myvalue = this.st.el.attr('data-id');

          var dataPassenger = this.st.el.attr('data-passenger');

          //console.log('dataPassenger ' + dataPassenger);



          var res = myvalue.split("|"); //alert(res);



          var n = res[0];



          var trid = 'seatlayout' + res[0];



          var sdd = "<?php echo base64_encode($sid); ?>";



          tripid = res[1];
          trvnm = res[2];
          bloc = res[3];
          btime = res[4];
          dloc = res[5];
          dtime = res[6];
          fare = res[7];
          busdesc = res[8];
          dur = res[9];



          $.ajax({
            url: "ajax_seat_layout2.php?tnm=" + trvnm + "&bl=" + bloc + "&bt=" + btime + "&dl=" + dloc + "&dt=" + dtime + "&f=" + fare + "&bdesc=" + busdesc + "&dur1=" + dur + "&tid=" + tripid + "&tripid=" + tripid + "&j=" + n + "&dataPassenger=" + dataPassenger,
            success: function(result) {



              $("#view-seats").html(result);



            }



          });



          this.st.mainClass = this.st.el.attr('data-effect');



        }



      },



      midClick: true







    });











  });
</script>





<script type="text/javascript">
  //var hide = 0;







  var sum = 0;

  var arr_seat = new Array();

  function change_icon2(ac, n, am, dataPassenger) {



    //alert(dataPassenger);

    var totalAdult = '<?php echo $_SESSION['ADT']; ?>';

    var totalChild = '<?php echo $_SESSION['CHD']; ?>';

    //alert(dataPassenger);



    var dataPassArr = dataPassenger.split("_");

    var passenterType = dataPassArr[0];

    var passenterValue = dataPassArr[1];





    var seat = 'sl' + ac + 'seat' + am + 'amt' + n; //  alert(seat);  

    $('#SeatPriceInn2').val(n);

    $('#SeatNoInn2').val(ac);



    // set seat adult wise 

    if (passenterType == 'seatAdult2' && passenterValue != '')

    {

      for (i = 1; i <= totalAdult; i++)

      {

        if (passenterValue == i)

        {

          $('#seatAdultPrice2' + i).val(n);

          $('#seatAdultCode2' + i).val(ac);

        }



      }



    }



    // set seat adult wise 

    if (passenterType == 'seatChild2' && passenterValue != '')

    {

      for (i = 1; i <= totalChild; i++)

      {

        if (passenterValue == i)

        {

          $('#seatChildPrice2' + i).val(n);

          $('#seatChildCode2' + i).val(ac);

        }



      }



    }



    allCalCulatedPrice();

    calculate_fare2(ac, n, am);

  }





  function change_icon(ac, n, am, dataPassenger) {



    var totalAdult = '<?php echo $_SESSION['ADT']; ?>';

    var totalChild = '<?php echo $_SESSION['CHD']; ?>';



    var dataPassArr = dataPassenger.split("_");

    var passenterType = dataPassArr[0];

    var passenterValue = dataPassArr[1];



    var seat = 'sl' + ac + 'seat' + am + 'amt' + n; //  alert(seat); 

    //alert(ac+' '+n+' '+am); 

    $('#SeatPriceInn').val(n);

    $('#SeatNoInn2').val(ac);



    //console.log('dataPassenger '+dataPassenger+' Total Adult '+'<?php echo $_SESSION['ADT']; ?>');



    // set seat adult wise 

    if (passenterType == 'seatAdult' && passenterValue != '')

    {

      for (i = 1; i <= totalAdult; i++)

      {

        if (passenterValue == i)

        {

          $('#seatAdultPrice' + i).val(n);

          $('#seatAdultCode' + i).val(ac);

        }



      }



    }





    // set seat adult wise 

    if (passenterType == 'seatChild' && passenterValue != '')

    {

      for (i = 1; i <= totalChild; i++)

      {

        if (passenterValue == i)

        {

          $('#seatChildPrice' + i).val(n);

          $('#seatChildCode' + i).val(ac);

        }



      }



    }





    allCalCulatedPrice();

    calculate_fare(ac, n, am);

  }







  function calculate_fare(ac, n, am) {



    var st = 'st' + ac;

    var hid_st = 'hid_st' + am;

    var amt = 'amt' + n;

    var hid_amt = 'hid_amt' + n;

    var splits = st.split("st");

    var splitss = splits[1].split(",");

    var hid_amt = hid_amt.split("hid_amt");



    var hid_amts = hid_amt[1].split(",");



    $(".seatval").html(splitss);

    $(".seatvalamt").html(hid_amts);

    $('#seatval').val(splitss);

    $('#seatvalamt').val(hid_amts);







  }







  function calculate_fare2(ac, n, am) {



    var st = 'st' + ac;

    var hid_st = 'hid_st' + am;

    var amt = 'amt' + n;

    var hid_amt = 'hid_amt' + n;

    var splits = st.split("st");

    var splitss = splits[1].split(",");

    var hid_amt = hid_amt.split("hid_amt");



    var hid_amts = hid_amt[1].split(",");



    $(".seatval2").html(splitss);

    $(".seatvalamt2").html(hid_amts);

    $('#seatval2').val(splitss);

    $('#seatvalamt2').val(hid_amts);







  }





  function allCalCulatedPrice()

  {

    var baseFarePrice = parseInt($('#baseFareInn').val());

    var TaxAndFee = parseInt($('#TaxAndFeeInn').val());



    var BaggageFeeInn = parseInt($('#BaggageFeeInn').val());

    var MealFeeInn = parseInt($('#MealFeeInn').val());

    var SeatPriceInn = parseInt($('#SeatPriceInn').val());


    var BaggageFeeInnC = parseInt($('#BaggageFeeInnC').val());
    var BaggageFeeInnC2 = parseInt($('#BaggageFeeInnC2').val());
    var MealFeeInnC = parseInt($('#MealFeeInnC').val());
    var MealFeeInnC2 = parseInt($('#MealFeeInnC2').val());

    var SeatPriceInnC = parseInt($('#SeatPriceInnC').val());

    var agentmarkup = parseInt($('#agentmarkup').val());

    var BaggageFeeInn2 = parseInt($('#BaggageFeeInn2').val());

    var MealFeeInn2 = parseInt($('#MealFeeInn2').val());

    var SeatPriceInn2 = parseInt($('#SeatPriceInn2').val());
    var agentmarkup2 = parseInt($('#agentmarkup2').val());
	//console.log(agentmarkup2)
    var earnedcommission = parseInt($('#earnedcommission').val());
    var totaltdsdisplay = parseInt($('#totaltdsdisplay').val());
    var totalcommissiongstdisplay = parseInt($('#totalcommissiongstdisplay').val());



    // var totalPricePay=(baseFarePrice+TaxAndFee+BaggageFeeInn+MealFeeInn+BaggageFeeInn2+MealFeeInn2+SeatPriceInn+SeatPriceInn2+totaltdsdisplay+totalcommissiongstdisplay)-earnedcommission;
    var totalPricePay = (baseFarePrice + TaxAndFee + BaggageFeeInn + BaggageFeeInnC + BaggageFeeInnC2 + MealFeeInn + MealFeeInnC + MealFeeInnC2 + BaggageFeeInn2 + MealFeeInn2 + SeatPriceInn + agentmarkup + SeatPriceInn2 + agentmarkup2 + totaltdsdisplay + totalcommissiongstdisplay) - earnedcommission;
	// console.log(typeof totalPricePay);
    $('#totalAmountToPay').val(totalPricePay);

    $('#coid').val(Number(totalPricePay + <?php echo $randval; ?>));

    $('#totalpayAmt').html(totalPricePay);

    fillbtnpay();

  }
</script>



<script>
  $(document).ready(function() { //alert("ghvh");



    $(".ret").click(function() {



      $(".shd").toggle(300);



    });



  });



  $(document).ready(function() { //alert("ghvh");



    $(".msshdd").click(function() {



      $(".msshd").toggle(300);



    });



  });
</script>



<script type="text/javascript">
  $(document).ready(function($) {



    /*$("#adltmeal").change(function() {



        var adltmeal = $(this).val(); 



        var splits = adltmeal.split(","); 



        var mlamt = splits[2]; 



        var splitss = mlamt.split("INR");



        var mlamount = splitss[1].trim();  



        $("#mealval").html(adltmeal);



       var finalclientcost = Number($('#finalclientcost').val()); 



 



      if(mlamount >0){ 



          var finalclientcost = parseInt(finalclientcost);



          var mlamnt= parseInt(mlamount); 



          $('#displayprice').text(Number(finalclientcost+mlamnt)); 



          $('#finalclientcost').val(Number(finalclientcost+mlamnt)); 



      }



  });*/



    $(document).ready(function($) {


      $(".adltmeal").change(function() {

        

        var adltmeal = $(this).val(); //alert(search_id); exit;



        $(".admealbtn").show();



        //$("#mealval").html(adltmeal);



        var adltbagvaluse = 0;
        $('.adltmeal').each(function() {

          adltmeal = $(this).val();

          adltmealArr = adltmeal.split("INR");

          var adltmeal = Number(adltmealArr[1].trim());

          adltbagvaluse = Number(adltbagvaluse + adltmeal);

          $('#MealFeeInn').val(adltbagvaluse);
       
        });
       



        allCalCulatedPrice();

        mealsfare();





      });



      /* return flight */

      $(".adltmeal2").change(function() {



        var adltmeal2 = $(this).val(); //alert(search_id); exit;



        $(".admealbtn2").show();



        //$("#mealval").html(adltmeal2);

        var adltmealvaluse2 = 0;
        $('.adltmeal2').each(function() {

          adltmeal2 = $(this).val();

          adltmealArr2 = adltmeal2.split("INR");

          var adltmeal2 = Number(adltmealArr2[1].trim());

          adltmealvaluse2 = Number(adltmealvaluse2 + adltmeal2);

          $('#MealFeeInn2').val(adltmealvaluse2);

        });

        allCalCulatedPrice();


        mealsfare2();




      });





    });



    $(".childmeal").change(function() {

      $('.meal_fare').show();

      var childmeal = $(this).val(); //alert(search_id); exit;


      $("#mealchildval").html(childmeal);

      var childbagvaluse = 0;
      $('.childmeal').each(function() {

        childmeal = $(this).val();

        childmealArr = childmeal.split("INR");

        var childmeal = Number(childmealArr[1].trim());

        childbagvaluse = Number(childbagvaluse + childmeal);

        $('#MealFeeInnC').val(childbagvaluse);
     
      });


      $("#cdmealbtn").show();


      allCalCulatedPrice();
      mealsfare();
    });



    /* return flight */

    $(".childmeal2").change(function() {



     
      var childmeal2 = $(this).val(); //alert(search_id); exit;

      //$("#mealchildval2").html(childmeal2);

      var childmealvaluse2 = 0;
      $('.childmeal2').each(function() {

        childmeal2 = $(this).val();

        childmealArr2 = childmeal2.split("INR");

        var childmeal2 = Number(childmealArr2[1].trim());

        childmealvaluse2 = Number(childmealvaluse2 + childmeal2);

        $('#MealFeeInnC2').val(childmealvaluse2);
     
      });
  

      $("#cdmealbtn2").show();


      allCalCulatedPrice();
      mealsfare2();
    });

  });

  $(document).ready(function($) {


    $(".adltbag").change(function() {
   

      var adltbag = $(this).val(); //alert(search_id); exit;

     

      //$("#baggval").html(adltbag);

      $(".adbagbtn").show();

      var adltbagvaluse = 0;
      $('.adltbag').each(function() {

        adltbag = $(this).val();

        adltbagArr = adltbag.split("INR");
        console.log(adltbagArr)
        var adltbag = Number(adltbagArr[1].trim());

        adltbagvaluse = Number(adltbagvaluse + adltbag);

        $('#BaggageFeeInn').val(adltbagvaluse);


      });



      allCalCulatedPrice();
      ssrfare();

    });



    $(".childbag").change(function() {

     // console.log('changed')

      var childbag = $(this).val(); //alert(search_id); exit;

     

      //$("#baggval").html(childbag);
      var childbagvaluse = 0;
      $('.childbag').each(function() {

        childbag = $(this).val();

        childbagArr = childbag.split("INR");
        console.log(childbagArr)

        var childbag = Number(childbagArr[1].trim());

        childbagvaluse = Number(childbagvaluse + childbag);

        $('#BaggageFeeInnC').val(childbagvaluse);


      });


      $("#cdbagbtn").show();
      allCalCulatedPrice();
      ssrfare();


    });





    /* return flight round */




    $(".adltbag2").change(function() {



      var adltbag2 = $(this).val();
      console.log(adltbag2)
       //alert(search_id); exit;

     

      //$("#baggval2").html(adltbag2);
    
      // $(".adbagbtn").show();



      // if (adltbag2.indexOf('INR') != -1) {



      //   adltbagArr = adltbag2.split("INR");

      //   var adltbag2 = adltbagArr[1].trim();

      //   $('#BaggageFeeInn2').val(adltbag2);

      // }

      // allCalCulatedPrice();
      $(".adbagbtn").show();

      var adltbagvaluse2 = 0;

      $('.adltbag2').each(function() {
        
        adltbag2 = $(this).val();

        adltbagArr2 = adltbag2.split("INR");

        console.log('str',adltbagArr2);

        var adltbag2 = Number(adltbagArr2[1]);

        adltbagvaluse2 = Number(adltbagvaluse2 + adltbag2);

        $('#BaggageFeeInn2').val(adltbagvaluse2);


      });



      allCalCulatedPrice();
      bagfareret();

    });



    $(".childbag2").change(function() {



       var childbag2 = $(this).val(); //alert(search_id); exit;



      // //$("#baggchildval2").html(childbag2);



      // $("#cdbagbtn2").show();
      var childbagvaluse2 = 0;
      $('.childbag2').each(function() {

        childbag2 = $(this).val();

        childbagArr2 = childbag2.split("INR");
        console.log(childbagArr2)

        var childbag2 = Number(childbagArr2[1].trim());

        childbagvaluse2 = Number(childbagvaluse2 + childbag2);

        $('#BaggageFeeInnC2').val(childbagvaluse2);

    });

    $("#cdbagbtn2").show();
      allCalCulatedPrice();
     
      bagfareret();

  });





  });
  
  function cofirmationpriceonpay() {

    var totalAmountToPay = $('#totalAmountToPay').val();

      $('#paywalletbtn').text('Pay Now ₹' + totalAmountToPay + '');
  } 

  $('.proceedtopaybtn').on('click', function(){

    $('#steponeflightdetails').hide();
    $('#steptwopassengerdetails').hide();
    $('#stepfourpayments').show();
    $('.flightreviewbox').removeClass('active');
    $('#strp4').addClass('active');
    $('.hidefooter').show();
    $('#showfooterpay').hide();
    var totalAmountToPay = $('#totalAmountToPay').val();
      $('.confirmation').load('confirmation.php?i=<?= $_REQUEST['i'] ?>');

  })

$('.backondetail').on('click', function(){
  $('#steponeflightdetails').hide();
  $('#steptwopassengerdetails').show();
  $('.flightreviewbox').removeClass('active');
  $('#strp2').addClass('active');
  $('.hidefooter').show();
  $('#showfooterpay').hide();
  $('#reviewloadbox').removeClass('makeReview');
  $('.form-control').addClass('redborderfiled');
  $('.seatselectioncard').show();
  let pcount=<?= $_SESSION['ADT']; ?>;
      for(let i=1; i<=pcount; i++){
        $('.bselect'+i).show();
        $('.Mselect'+i).show();
        $('.bselect2'+i).show();
        $('.Mselect2'+i).show();
       
        }
        let chdcount=<?= $_SESSION['CHD'] != 0 ? $_SESSION['CHD']:0; ?>;
      for(let i=1; i<=chdcount; i++){
        $('.chdbselect'+i).show();
        $('.chdMselect'+i).show();
        $('.chdbselect2'+i).show();
        $('.chdMselect2'+i).show();
        
        }
        $('.ssroptional').show();
        $('.chdssroptional').show();
 
})
  $(document).ready(function() {

    // var referrer =  document.referrer;
    $('#backbtn').on('click', function(){
      window.location.href='<?= $fullurl; ?>flights';
    })
  
});

  function allBookingSubmit() {
    $('#bookingMethod').val('0');
    $("#flightbookingsubmit").submit();
  }


  /*$(document).bind("contextmenu",function(e) {
   e.preventDefault();
  });

  $(document).keydown(function(e){
      if(e.which === 123){
         return false;
      }
  });*/
  function openclosebase(){
    var openclosebaseprice = $('.openclosebaseprice').text();

    if (openclosebaseprice == '+') {
      $('.openclosebaseprice').text('-');
      $('.hidecommall').show();
    } else {
      $('.openclosebaseprice').text('+');
      $('.hidecommall').hide();
    }
  }
  function cofirmationprice(TF) {
                let cprice=TF;
                if(cprice != 0){
             
                 $('.pricechagepopup').trigger('click');
                 $('.confirm').show();
                 $('.faresummrybox').hide();
                }else{
                  $('.faresummrybox').show();
                  $('.confirmpricebtn').addClass('addpassengerbtn');
                  $('.confirmpricebtn').text('Add passengers');
                  $('.addpassengerbtn').css('cursor','pointer');
                  $('.addpassengerbtn').on('click', function(){

                    $('#steptwopassengerdetails').show();
                    $('.confirmfooter').hide();

                    steps();

                  })
                }
              }
  function openclose() {
    var opencloseprice = $('.opencloseprice').text();

    if (opencloseprice == '+') {
      $('.opencloseprice').text('-');
      $('.hidecomm').show();
    } else {
      $('.opencloseprice').text('+');
      $('.hidecomm').hide();
    }


  }
  $('.backonsearch').on('click', function(){
    var referrer =  document.referrer;
       window.location.href='<?= $fullurl; ?>flights';
  })
  $('.continuebtn').on('click', function(){
    $('.faresummrybox').show();
	$('.confirmpricebtn').text('Add Passengers');
    steps();
  })

  function steps(){
    $('#strp2').on('click', function(){
                  $('#steponeflightdetails').hide();
                  $('#steptwopassengerdetails').show();
                  $('.flightreviewbox').removeClass('active');
                  $('#strp2').addClass('active');
                  $('.hidefooter').show();
                  $('#showfooterpay').hide();
                  $('#stepfourpayments').hide();
                  $('.confirmfooter').hide();
                 })
  }


  $('#steponeflightdetails').hide();
  // $('#steptwopassengerdetails').show();
  // $('.flightreviewbox').removeClass('active');
  // $('#strp2').addClass('active');
  $('.hidefooter').show();
  $('#showfooterpay').hide();
  $('#stepfourpayments').hide();

</script>

<style>
  .makeReview .flightreview {
    display: none;
  }

  .makeReview .faresummrybox {
    display: none;
  }

  .makeReview .col-lg-8 {
    margin: auto;
    margin-top: 40px;
  }

  .makeReview .tpbtn {
    display: none;
  }

  .makeReview .form-control {
    pointer-events: none !important;
    padding: 0px !important;
    border: 0px !important;
  }
  .seatdetailscontent<?php echo $res['id']; ?> { padding: 10px; border: 1px solid #ddd; display: none; }
  .seatdetailsboxtabs<?php echo $res['id']; ?> { width: 100%; border-bottom: 1px solid #ddd; overflow: hidden; padding-left: 0px; }
  .seatdetailsboxtabs<?php echo $res['id']; ?> a { padding: 5px 10px; margin-right: 5px; float: left; color: #000; padding: 10px 20px; border-radius: 12px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important; font-weight: 600; }
  .seatdetailsboxtabs<?php echo $res['id']; ?> .active { background-color: var(--blue); color: #fff; }
   
  .seatdetailscontent2<?php echo $res['id']; ?> { padding: 10px; border: 1px solid #ddd; display: none; }
  .seatdetailsboxtabs2<?php echo $res['id']; ?> { width: 100%; border-bottom: 1px solid #ddd; overflow: hidden; padding-left: 0px; }
  .seatdetailsboxtabs2<?php echo $res['id']; ?> a { padding: 5px 10px; margin-right: 5px; float: left; color: #000; padding: 10px 20px; border-radius: 12px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important; font-weight: 600; }
  .seatdetailsboxtabs2<?php echo $res['id']; ?> .active { background-color: var(--blue); color: #fff; }
  .agentUserId {
    color: rgb(24 94 227 / 21%);
    height: 100%;
    left: 0;
    line-height: 8;
    margin: 0;
    position: fixed;
    top: 0;
    transform: rotate(-30deg);
    transform-origin: 0 100%;
    width: 200%;
    font-size: 12px;
    z-index: 1;
    word-spacing: 40px;
    -webkit-touch-callout: none;
    /* iOS Safari */
    -webkit-user-select: none;
    /* Safari */
    -khtml-user-select: none;
    /* Konqueror HTML */
    -moz-user-select: none;
    /* Old versions of Firefox */
    -ms-user-select: none;
    /* Internet Explorer/Edge */
    user-select: none;
    /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
    pointer-events: none;
}
.flightbooking{
  position: sticky;
    z-index: 3;
}
</style>