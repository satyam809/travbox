<?php include "inc.php"; ?>
<div class="finalsharewhatsapp">
<!-- <div><?php //echo stripslashes($LoginUserDetails['companyName']); ?></div><br /> -->
<?php $string = preg_replace('/\.$/', '', $_REQUEST['checkval']);
$array = explode(',', $string);
$artname='';
foreach($array as $value){
$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.$value.'" and ORG_CODE="'.$_REQUEST['formcitydst'].'" and DES_CODE="'.$_REQUEST['tocitydst'].'" '); 
while($res=mysqli_fetch_array($a)){
$str_arr = explode (",", $res['agfare']);   
	$basefares = explode ("=", $str_arr[2]);

	$dd=unserialize(stripslashes($res['searchJson']));
	// echo '<pre>';
	//  print_r( $dd);
	//  die;
	if(!empty($dd['sI'][count($dd['sI'])-1]['aa']['name']) && !empty($artname)){
		$artname=$dd['sI'][count($dd['sI'])-1]['aa']['name'];
	 print_r($artname);
		// die;
	}
	$bagg=explode (",", $res['FLIGHT_INFO']);
	$iB=$bagg[1];
	$cB=$bagg[0];
?>
<div><?php echo stripslashes($res['ORG_NAME']); ?> - <?php echo stripslashes($res['DES_NAME']); ?> - <?php echo (!empty($dd['sI'][count($dd['sI'])-1]['aa']['name'])) ? $dd['sI'][count($dd['sI'])-1]['aa']['name'] : $artname ?></div>
<div><?php echo $_SESSION['ADT'] + $_SESSION['CHD'] + $_SESSION['INF']; ?> Passenger</div>
<div><?php $pcc = strtolower($res['PCC']); echo ucfirst($pcc); ?></div><br />  

<div>Below mentioned prices are the total price(s) inclusive of taxes:</div>
<div>----------------------------------------------------------------</div>
<div>1. <i class="fa fa-plane mx-2" aria-hidden="true" style="transform: rotate(45deg);"></i> <?php echo $res['FLIGHT_NAME'] ?> (<?php echo $res['FLIGHT_CODE']; ?>-<?php echo $res['FLIGHT_NO']; ?>) : <?php echo $res['ORG_CODE']; ?> - <?php echo $res['DES_CODE']; ?></div>

<div>Departure: <?php echo date('j F Y',strtotime($res['DEP_DATE'])); ?> , <?php echo stripslashes($res['DEP_TIME']); ?></div>
<div>Arrival: <?php echo date('j F Y',strtotime($res['ARRV_DATE'])); ?> , <?php echo stripslashes($res['ARRV_TIME']); ?></div>
<div>Duration: <?php echo $res['DUR']; ?> / <?php if($res['STOP']==0){ ?>Non Stop<?php  }else{ ?><?php echo $res['STOP'].' Stop '; ?><?php } ?></div>
<div>Baggage <?php echo $iB; ?> | <?php echo $cB; ?></div>
<div>Price - ₹<strong  contenteditable="true"><?php echo $basefares[1]+$res['agentFixedMakup']; ?>/-</strong></div>
<div>-----------------------------------------------------------------</div>
<div>Thank you for choosing <?php echo stripslashes($LoginUserDetails['companyName']); ?>.</div>
<div>In case of any support :<br /><?php echo stripslashes($LoginUserDetails['companyName']); ?></div>
<div><i class="fa fa-phone" aria-hidden="true"></i> Contact : <?php echo stripslashes($LoginUserDetails['phone']); ?></div>
<div><i class="fa fa-envelope-o" aria-hidden="true"></i> Email : <?php echo stripslashes($LoginUserDetails['email']); ?></div><br /><br />
<?php } }  ?>
</div>