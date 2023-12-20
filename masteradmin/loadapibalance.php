<?php  
include "inc.php";  
include "config/logincheck.php";  


$jsonAuth = '{
   "TYPE":"AUTH",
   "NAME":"GET_AUTH_TOKEN",
   "STR":[
      {
         "A_ID":"'.$A_ID.'",
         "U_ID":"'.$U_ID.'",
         "PWD":"'.$PWD.'",
         "MODULE":"'.$MODULE.'",
         "HS":"'.$hitSource.'"
      }
   ]
}';



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$TokenUrl);
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

$tokenId = trim($responseAuthArr->RESULT);


$jsonPost = '{
"TYPE": "DC",
"NAME": "AGENT_BALANCE",
"STR": [
{
"TOKEN": "'.$tokenId.'"
}
]
}';



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$FlightSearchUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$responseAuth = curl_exec($ch); 
curl_close($ch);
$responseAuthArr = json_decode($responseAuth);

echo '&#8377;'.trim($responseAuthArr->BALANCE);

?>
