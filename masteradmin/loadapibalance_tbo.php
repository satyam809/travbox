<?php  
include "inc.php";  
include "config/logincheck.php";  

$jsonAuth = '{
  "ClientId": "tboprod",
  "UserName": "DELP906",
  "Password": "Tr@vel@#989&",
  "EndUserIp": "'.$_SERVER['REMOTE_ADDR'].'"
}';

$TBOAuthUrl='https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$TBOAuthUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonAuth);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$responseAuth = curl_exec($ch); 
curl_close($ch);
$responseAuthArr = json_decode($responseAuth);

//print_r($responseAuthArr);

$tboToken=$responseAuthArr->TokenId;

$MemberId=$responseAuthArr->Member->MemberId;
$AgencyId=$responseAuthArr->Member->AgencyId;


$jsonPost = '{
  "ClientId": "tboprod",
  "TokenAgencyId": "'.$AgencyId.'",
  "TokenMemberId": "'.$MemberId.'",
  "EndUserIp": "'.$_SERVER['REMOTE_ADDR'].'",
  "TokenId": "'.$tboToken.'"
}';

$tboCallAgencyBalancUrl='http://api.tektravels.com/SharedServices/SharedData.svc/rest/GetAgencyBalance';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$tboCallAgencyBalancUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$responseAgencyBalance = curl_exec($ch); 
curl_close($ch);
$responseAgencyBalanceArr = json_decode($responseAgencyBalance,true);

$responseAgencyBalanceArr['CashBalance'];

//print_r($responseAgencyBalanceArr);

echo '&#8377;'.trim($responseAgencyBalanceArr['CashBalance']);

?>
