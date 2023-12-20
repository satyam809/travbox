<?php 
include "inc.php";
 
  

		$pnrRetreiveJson = '{
						"TYPE": "DC",
						"NAME": "PNR_RETRIVE",
						"STR": [
							{
							"BOOKINGID": "API2212211637PM53700103268",
							"CLIENT_SESSIONID": "",
							"MODULE": "B2B",
							"HS": "D"
							}
						]
					}';

 
	
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL,$PnrCreateUrl);
	curl_setopt($ch1, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch1, CURLOPT_POST,1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $pnrRetreiveJson);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$pnrRetResponse = curl_exec($ch1); 
	echo '<pre>';
	print_r($pnrRetResponse);
	curl_close($ch1);
	$pnrRetData = json_decode($pnrRetResponse);
	 
 
	
	$flightTerminal = $pnrRetData->FLIGHT{0}->ORG_TRML;
	$fareClass = $pnrRetData->FLIGHT{0}->FARE_CLASS;
	$gpnr = $pnrRetData->PAX{0}->gpnr;
	$apnr = $pnrRetData->PAX{0}->apnr;
	$ticketNo = $pnrRetData->PAX{0}->tktno;
	$receivestatus = $pnrRetData->PAX{0}->status;
	
	if($gpnr==''){
	$gpnr=$apnr;
	}
	
	if($receivestatus=="Failed"){
		$status = 3;
	}else if($receivestatus=="Confirmed"){
	if($gpnr!=''){
		$status = 2;
		} else { 
		$status = 1; 
		}
	}else{
		$status = 1;
	}
	
	 
	 
	 
 

?> 