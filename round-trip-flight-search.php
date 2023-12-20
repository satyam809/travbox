<?php 

include "inc.php"; 

include "config/logincheck.php";





deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" ');



if($_SESSION['uniqueId']==''){

	$_SESSION['uniqueId'] = uniqid();

}
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);

$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);



$fromdestexp = explode('-',$fromDestinationFlight);

$todestexp = explode('-',$toDestinationFlight);


$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getapistatus=mysqli_fetch_array($rs); 






$rs=GetPageRecord('*','sys_userMaster','id=1'); 

$getapistatus=mysqli_fetch_array($rs); 



$undercons=0;

 



$flightResultDisplayfile='flight_result_display_round_trip.php';

 





 

	

	if($_SESSION['isRoundTripInt']==1)

	{

		include "tripjack-round-way-int.php"; 

		$flightResultDisplayfile='flight_result_display_round_trip_tripjack_int.php';	

	}

	else

	{

		include "tripjack-round-way.php"; 

		

	} 	

    $undercons=1;	





 

 		

?>





<script>

parent.$('#flightresult').load('<?php echo $flightResultDisplayfile; ?>?undercons=<?php echo $undercons; ?>'+'&formcitydst=<?= $fromdestexp[0]; ?>'+'&tocitydst=<?= $todestexp[0]; ?>');

</script>