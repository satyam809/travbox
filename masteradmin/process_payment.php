<?php
    
include "inc.php";    
include_once('easebuzz-lib/easebuzz_payment_gateway.php');
include_once('easebuzz-lib/payment.php');


$merchant_key = '2PBP7IABZ2';
$salt_key = 'DAH88E3UWQ';
$env ='test';



$easebuzzObj  = new Easebuzz($merchant_key, $salt_key,$env);

$amount=addslashes($_REQUEST['amount']);
$note=addslashes($_REQUEST['notes']);
$token=rand(89898,543132113).strtotime(date('YmdHis'));
$booking_payment_type=addslashes($_REQUEST['booking_payment_type']);




$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 
if(mysqli_num_rows($chkrow)==0){

$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",bookingType="'.$_REQUEST["booking_payment_type"].'",serviceId="'.$_SESSION['serviceId'].'",merchant_param1="'.$_REQUEST["booking_payment_type"].'",merchant_param2="'.$token.'",merchant_param3="'.$_SESSION['agentUserid'].'",merchant_param4="'.$_SESSION['parentAgentId'].'",merchant_param5="'.$_SESSION['parentid'].'",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'" ';
$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);
$floatValue = number_format((float)$amount, 2, '.', '');  // return float


$_SESSION["txnID"]=$txnID;
$_SESSION["amount"]=$amount;
$_SESSION["first_name"]=strip($LoginUserDetails['name']);
$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);
$_SESSION["phone"]=strip($LoginUserDetails['phone']);
$_SESSION["user_email"]=strip($LoginUserDetails['email']);
$_SESSION["order_id"]=encode($txnID);
$_SESSION["token"]=$token;
$udf2 =  $_SESSION['agentUserid'];


$postData = array ( 
    "txnid" => $txnID, 
    "amount" => $amount.'.00', 
    "firstname" => strip($LoginUserDetails['name']),
    "email" => strip($LoginUserDetails['email']),
    "phone" => strip($LoginUserDetails['phone']),
    "productinfo" => "Flight booking", 
    "surl" => "http://localhost/travbox/masteradmin/success.php", 
    "furl" => "http://localhost/easebuzz/failed.php", 
    "udf6" => $token,
    "udf2" => $udf2,
    "udf1" => $amount

);

//print_r($postData); exit;


// $easebuzzObj->initiatePaymentAPI($postData);    
//$response = $easebuzzObj->initiatePaymentAPI($postData); 

$response =_payment($postData,false,$merchant_key,$salt_key,$env);

echo json_encode($response);

// print_r($response); exit;
//$response = $easebuzz->createPayment($payment_data);

// if ($response['status'] === 'SUCCESS') {
//     // Send a response back to the client
//     echo json_encode(['status' => 'SUCCESS', 'url' => $response['url']]);
// } else {
//     // Handle the error
//     echo json_encode(['status' => 'ERROR', 'message' => 'Payment request failed: ' . $response['error']]);
// }

}
?>
