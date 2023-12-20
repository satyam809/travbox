<?php 

include "inc.php"; 



try

{

	$lastId=0;

	

	$date = date("Y-m-d", strtotime("+2 day"));



	deleteRecord('mailLogs','Date(date)="'.$date.'"'); 

		

	$a=GetPageRecord('*','sys_userMaster','userType!="agent" '); 



		while($userdata=mysqli_fetch_array($a)){

			// echo '<pre>';

			// print_r($userdata);



			$c=GetPageRecord('SUM(amount) as totalamount','sys_balanceSheet','paymentType="Debit"  and bookingType="flight" and Date(addDate)="'.date("Y-m-d").'"'); 

			$totalflightcosting=mysqli_fetch_array($c);





			$d=GetPageRecord('SUM(amount) as totalamount','sys_balanceSheet','paymentType="Debit"  and bookingType="hotel" and Date(addDate)="'.date("Y-m-d").'"'); 

			$totalhotelcosting=mysqli_fetch_array($d);



			$e=GetPageRecord('COUNT(id) as totalnewusers','sys_userMaster','Date(addDate)="'.date("Y-m-d").'"'); 

			$newusers=mysqli_fetch_array($e);



			$f=GetPageRecord('COUNT(id) as total','flightBookingMaster','status=2 and Date(bookingDate)="'.date("Y-m-d").'"'); 

			$totalflightbooking=mysqli_fetch_array($f);



			$g=GetPageRecord('COUNT(id) as total','hotelBookingMaster','status=2 and Date(addDate)="'.date("Y-m-d").'"'); 

			$totalhotelbooking=mysqli_fetch_array($g);



			if(!empty($totalhotelcosting['totalamount']) && !empty($totalhotelbooking['total'])){

				 $amount=$totalhotelcosting['totalamount'];

				$total=$totalhotelbooking['total'];

			}else{

				$amount="-";

				$total="-";

			}

			if(!empty($totalflightcosting['totalamount']) && !empty($totalflightbooking['total'])){

				$amount2=$totalflightcosting['totalamount'];

				$total2=$totalflightbooking['total'];

			}else{

				$amount2="-";

				$total2="-";

			}

			$subject="Bussiness";

			$mailbody='Dear '.$userdata['name'].' '.$userdata['lastName'].'<br><br> Total business: '.round($totalflightcosting['totalamount']+$totalhotelcosting['totalamount']).'<br>

			New Users : '.$newusers['totalnewusers'].'<br><br>

			<table border="1"  cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">

				<tr>

					<td align="center" colspan="4" bgcolor="#F5F5F5"><strong>Bussiness</strong> </td>

				</tr>

				<tr>

					<td align="center"><strong>Type</strong></td>

					<td><strong>:</strong></td>

					<td align="center">Bookings</td>

					<td align="center">Bussiness</td>

				</tr>

				<tr>

					<td align="center"><strong>Hotel</strong></td>

					<td align="center"><strong>:</strong></td>

					<td align="center">'.$amount.'</td>

					<td align="center">'.$total.'</td>

				</tr>

				<tr>

					<td align="center"><strong>Flight</strong></td>

					<td align="center"><strong>:</strong></td>

					<td align="center">'.$total2.'</td>

					<td align="center">'.$amount2.'</td>

				</tr> </table><br>

				Thanks & Regards<br>';



			if(sendmainmail($userdata['email'],$subject,$mailbody)){



				$namevalue ='email="'.$userdata['email'].'",date="'.date('Y-m-d H:i:s').'",status="true", mailType="team mail" ';

	

				addlistinggetlastid('mailLogs',$namevalue); 

	

			}else{

				$namevalue ='email="'.$userdata['email'].'",date="'.date('Y-m-d H:i:s').'",status="false", mailType="team mail" ';

	

				addlistinggetlastid('mailLogs',$namevalue);	

			}



			$lastId=$userdata['id'];

			



		}

		

	



}

catch(Exception $e)

{

    $errhdng="Technical Error !!";

    $errmsg="Sorry Due To Some Technical Issue.";

	$subject="cron log error";

	$mailbody="You have an error in your code . <br> Last user id is ".$lastId;

	$email="ajay@technoarray.com";



	sendmainmail($email,$subject,$mailbody);

}

?>