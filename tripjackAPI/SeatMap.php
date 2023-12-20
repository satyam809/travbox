<?php
#
// $priceids = implode(',',$_SESSION['price_id']);
// $postdataSSR='
// {
//   "priceIds" : ["'.$ResultIndex.'"]
// }';

$postdataSeatMap= '{
    "bookingId" : "'.$_SESSION['bookingIdReviewAPI'].'"
}';
 //$bookingIdReviewAPI
// $postdataSSR = json_encode($postdataSSR);
try
{
//  print_r($postdataSeatMap); //die;
// file_put_contents("tripjackAPIJson/ReviewRequestjson.json",$postdataSSR);


$restCaller = new RestApiCaller();
$flightResSSR = $restCaller->getTripJackResponse(_SEAT_MAP_, $postdataSeatMap);
// file_put_contents("tripjackAPIJson/ReviewResponse.json",$flightResSSR);

$seatMapResult = json_decode($flightResSSR,true);
// echo '<pre>';
// print_r($flightResSSR);die;

$_SESSION['seatMapResult']=$seatMapResult;

}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}





