<?php 
include "inc.php"; 

try
{
	$date = date("Y-m-d", strtotime("+1 day"));
	$lastId=0;
	$a=GetPageRecord('*','flightBookingMaster',' journeyDate="'.$date.'" and status=2 '); 

	while($editresult=mysqli_fetch_array($a)){

		$agentId=$editresult['agentId'];

		$b=GetPageRecord('*','sys_userMaster',' id="'.$agentId.'" '); 
		$LoginParentId=mysqli_fetch_array($b);
		
		$subject = 'Only one day left of your journey';
		
		 $mailbody='Hello <strong>'.$LoginParentId['name'].' ' .$LoginParentId['lastName'].'</strong><br><br>
		 		You have booked flight on <strong>'.date("d-m-Y", strtotime($editresult['bookingDate'])).'</strong> from <strong>'.$editresult['source'].'</strong> to <strong>'.$editresult['destination'].'.</strong>
				<br>Your flight number is '.$editresult['flightNo']. ' and Journey date is  '. date("d-m-Y", strtotime($editresult['bookingDate'])). '. Your Dparture time is '.$editresult['departureTime'].'.<br><br>
				Thank you <br><br>
				Have a great Journey!';
		
			
		$email=$LoginParentId['email'];
		
		if(sendmainmail($email,$subject,$mailbody)){

			$namevalue ='bookingId="'.$editresult['id'].'",email="'.$LoginParentId['email'].'",date="'.date('Y-m-d H:i:s').'",status="true", mailType="reminder mail" ';

			addlistinggetlastid('mailLogs',$namevalue); 

		}else{
			$namevalue ='bookingId="'.$editresult['id'].'",email="'.$LoginParentId['email'].'",date="'.date('Y-m-d H:i:s').'",status="false", mailType="reminder mail" ';

			addlistinggetlastid('mailLogs',$namevalue);	
		}

		$lastId=$editresult['id'];
	}


}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue.";
	$subject="cron log error";
	$mailbody="You have an error in your code . <br> Last Booking id is ".$lastId;
	$email="ajay@technoarray.com";

	sendmainmail($email,$subject,$mailbody);
}
?>