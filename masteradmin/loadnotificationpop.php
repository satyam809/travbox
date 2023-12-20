<?php
include "inc.php";  

$n=0;
$rs8=GetPageRecord('*','hotelBookingMaster',' 1 and BookingNumber!="" and agentBookingType=0 and bookingType=1 and status!=0 and notifyStatus=0 order by id desc ');  
while($rest=mysqli_fetch_array($rs8)){
 ?>

<div style=" position:relative;padding:10px; background-color:#333333; color:#fff; box-sizing:border-box; border-radius:3px; margin-bottom:10px; font-size:12px;" id="h<?php echo encode($rest['id']); ?>">New Hotel Booked - Reference Id <strong>#<?php echo encode($rest['id']); ?></strong><div style="position:absolute; right:5px; top:2px;"><i class="fa fa-times" aria-hidden="true" onclick="$('#h<?php echo encode($rest['id']); ?>').hide();hidenotpop('<?php echo encode($rest['id']); ?>','hotel');" style="cursor:pointer;"></i></div></div>

<?php $n=1; }




$rs9=GetPageRecord('*','flightBookingMaster',' 1 and agentBookingType=0 and (bookingType=1 or bookingType=0) and status!=0 and notifyStatus=0 order by id desc ');  
while($rest1=mysqli_fetch_array($rs9)){
 ?>

<div style=" position:relative;padding:10px; background-color:#333333; color:#fff; box-sizing:border-box; border-radius:3px; margin-bottom:10px; font-size:12px;" id="f<?php echo encode($rest['id']); ?>">New Flight Booked - Reference Id <strong>#<?php echo encode($rest1['id']); ?></strong><div style="position:absolute; right:5px; top:2px;"><i class="fa fa-times" aria-hidden="true" onclick="$('#f<?php echo encode($rest1['id']); ?>').hide();hidenotpop('<?php echo encode($rest1['id']); ?>','flight');" style="cursor:pointer;"></i></div></div>

<?php $n=1;} ?>

<?php if($n==1){
?>
<script> playSound(); </script>
<?php
} ?>
 