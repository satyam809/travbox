<?php include "inc.php"; 

$rs=GetPageRecord('bookingNumber,uniqueSessionId','flightBookingMaster',' 1 '); 
while($rest=mysqli_fetch_array($rs)){ 
 
 	 $pnrRetreiveJson = '{
							"TYPE": "DC",
							"NAME": "PNR_RETRIVE",
							"STR": [
								{
								"BOOKINGID": "'.$rest['bookingNumber'].'",
								"CLIENT_SESSIONID": "",
								"MODULE": "B2B",
								"HS": "D"
								}
							]
						}';
	
	//logger('JSON POST FOR Flight PNR RETREIVE(PNR_RETREIVE): '.$pnrRetreiveJson);
	
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL,$PnrCreateUrl);
	curl_setopt($ch1, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch1, CURLOPT_POST,1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $pnrRetreiveJson);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$pnrRetResponse = curl_exec($ch1); 
	curl_close($ch1);
	$pnrRetData = json_decode($pnrRetResponse);
	
	
	print_r($pnrRetResponse);
	//logger('JSON RESPONSE FROM FLIGHT PNR RETREIVE(PNR_RETREIVE): '.$pnrRetResponse);
	
	$flightTerminal = $pnrRetData->FLIGHT{0}->ORG_TRML;
	$fareClass = $pnrRetData->FLIGHT{0}->FARE_CLASS;
	$gpnr = $pnrRetData->PAX{0}->gpnr;
	$apnr = $pnrRetData->PAX{0}->apnr;
	$ticketNo = $pnrRetData->PAX{0}->tktno;
	$receivestatus = $pnrRetData->PAX{0}->status;
	
	if($receivestatus=="Failed"){
		$status = 3;
	}else if($receivestatus=="Confirmed"){
	
	if($apnr!=''){
		$status = 2;
		} else {
		$status = 1;
		}
		
	}else{
		$status = 1;
	}
	
	
	if($apnr==''){
	$apnr=$gpnr;
	}else{
	$apnr=$apnr;
	}
	
	
	
	$namevalue ='status="'.$status.'",flightTerminal="'.$flightTerminal.'",fareClass="'.$fareClass.'",pnrNo="'.$apnr.'",ticketNo="'.$ticketNo.'"'; 
	$where='bookingNumber="'.$rest['bookingNumber'].'"'; 
	updatelisting('flightBookingMaster',$namevalue,$where); 
	
}

?>

<script>
 parent.location.reload();
</script>