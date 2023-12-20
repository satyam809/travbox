<?php
/*  ini_set('display_errors', '1');
 ini_set('display_startup_errors', '1');
 error_reporting(E_ALL); */

include "inc.php";
include "config/logincheck.php";

include 'tripjackAPI/APIConstants.php';

include 'tripjackAPI/RestApiCaller.php';


$a = GetPageRecord('*', 'wig_flight_json_bkp', ' id="' .decode($_REQUEST['i']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');
$res = mysqli_fetch_array($a);
//print_r($res);
//die;
if ($_REQUEST['r'] != '') {
	
  $ab = GetPageRecord('*', 'wig_flight_json_bkp', ' id="' . decode($_REQUEST['r']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');

  $resret = mysqli_fetch_array($ab);
  
}
if ($_REQUEST['r'] != '') {
	$postdataSSR='
	{
	  "priceIds" : ["'.$resret['ResultIndex'].'", "'.$resret['ResultIndex2'].'"]
	}';
}else{
	 $postdataSSR='
	 {
	   "priceIds" : ["'.$res['ResultIndex'].'"]
	 }';
}
try
{

file_put_contents("tripjackAPIJson/ReviewRequestjson.json",$postdataSSR);


$restCaller = new RestApiCaller();
$flightResSSR = $restCaller->getTripJackResponse(_REVIEW_SSR_, $postdataSSR);
file_put_contents("tripjackAPIJson/ReviewResponse.json",$flightResSSR);

$ReviewSSRResultOnConfirmation = json_decode($flightResSSR,true);

if($flightResSSR == 1000){
	
  $ReviewSSRResultOnConfirmation=$flightResSSR;
  
}else{
	
$_SESSION['ReviewSSRResultOnConfirmation']=$ReviewSSRResultOnConfirmation;

}
//print_r($ReviewSSRResultOnConfirmation);
}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}
if($reviewSSRResult == 400 ){

  ?>
  <script>
    alert("This flight has been sold out. Please search again");
    window.location.href='<?= $fullurl ?>flights';
  </script>

  <?php }

$reviewSSRResult=$_SESSION['reviewSSRResult'];

$Basic_fare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['BF']);
$Total_fare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TF']);
$TotalTax_fare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['TAF']);
$Total_netfare=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['NF']);
$Total_com=round($reviewSSRResult['totalPriceInfo']['totalFareDetail']['fC']['NCM']);

$Basic_fare1=round($ReviewSSRResultOnConfirmation['totalPriceInfo']['totalFareDetail']['fC']['BF']);
$Total_fare1=round($ReviewSSRResultOnConfirmation['totalPriceInfo']['totalFareDetail']['fC']['TF']);
$TotalTax_fare1=round($ReviewSSRResultOnConfirmation['totalPriceInfo']['totalFareDetail']['fC']['TAF']);
$Total_netfare1=round($ReviewSSRResultOnConfirmation['totalPriceInfo']['totalFareDetail']['fC']['NF']);
$Total_com1=round($ReviewSSRResultOnConfirmation['totalPriceInfo']['totalFareDetail']['fC']['NCM']);

$newfare= $ReviewSSRResultOnConfirmation['alerts'][0]['newFare'];
$oldfare= $ReviewSSRResultOnConfirmation['alerts'][0]['oldFare'];


if($Basic_fare == $Basic_fare1 && $Total_fare == $Total_fare1 && $TotalTax_fare == $TotalTax_fare1 && $Total_netfare == $Total_netfare1 && $Total_com == $Total_com1) {
	
  $total=0; 
  
}else{
	 $total= round($ReviewSSRResultOnConfirmation['totalPriceInfo']['totalFareDetail']['fC']['TF']);

}

$sec=$ReviewSSRResultOnConfirmation['conditions']['st'];
$sec= (int)$sec * 1000; 
?>
<span class="pricechange" style="display: none;" data-toggle="modal" data-mode="edit"  data-target="#pricechange"></span>

<div class="modal fade" style="pointer-events: none;" id="pricechange">

   <div class="modal-dialog modal-dialog-centered modal-md" role="document">

      <div class="modal-content">

            <div class="modal-header">

               <h4 class="modal-title" id="modal-title">Price confirmation</h4>

            </div>

            <div class="modal-body">   
			
					<div class="">  
					<div class="" style="text-align: center; margin: 16px;"> 
						 Price has been changed <span><strong><?= $oldfare; ?></strong></span> to <span><strong><?= $newfare; ?></strong></span> 
					</div>
					</div>
<script>

	$('.backonsearch').on('click', function(){
	var referrer =  document.referrer;
	window.location.href=referrer;
	});

	$('.continuebtn').on('click', function(){
		
		window.location.reload();
		
	})

</script>

            </div>

            <div class="modal-footer">

            <button  class="btn btn-primary backonsearch" type="button">Back on search</button>
					<button style="float: right;" class="btn btn-primary continuebtn" type="button">Continue</button>

            </div>


      </div>

   </div>

</div>
<script>
let total=<?= $total; ?>;
if(total != 0){
$('.pricechange').trigger('click');
}
$('.pace').removeClass('pace-active');
$('.pace').addClass('pace-inactive');

//cofirmationprice(<?php echo $TF; ?>);

cofirmationpriceonpay();

var referrer =  document.referrer;
  const sec =<?php echo $sec; ?>;
  //console.log(second);
  setTimeout(function(){
  window.location.href=referrer;
  }, sec);
  
</script>


