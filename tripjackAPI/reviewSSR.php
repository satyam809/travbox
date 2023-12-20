<?php
#
 $priceids = implode(',',$_SESSION['price_id']);
 $postdataSSR='
 {
   "priceIds" : ["'.$ResultIndex.'"]
 }';

/*$postdataSSR= [
    "priceIds" => [$ResultIndex]
];*/

//$postdataSSR = json_encode($postdataSSR);

try
{
//echo $postdataSSR;
//die;
file_put_contents("tripjackAPIJson/ReviewRequestjson.json",$postdataSSR);


$restCaller = new RestApiCaller();
$flightResSSR = $restCaller->getTripJackResponse(_REVIEW_SSR_, $postdataSSR);
file_put_contents("tripjackAPIJson/ReviewResponse.json",$flightResSSR);

$reviewSSRResult = json_decode($flightResSSR,true);

if($flightResSSR == 400){
  $reviewSSRResult=$flightResSSR;
}else{
$_SESSION['reviewSSRResult']=$reviewSSRResult;

}

}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}





