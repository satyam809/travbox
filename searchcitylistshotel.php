<?php
include "inc.php";  
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div class="searchdestinationboxclass">

<?php

// $rs=GetPageRecord('*','hotelDestinationMaster','name like "%'.trim(strip($_REQUEST['keyword'])).'%"  group by cityId,countryCode order by name desc limit 0,10'); 
$sql='select * from hotelDestinationMaster where name="'.trim(strip($_REQUEST['keyword'])).'" group by cityId,countryCode UNION ';
$sql.='select * from hotelDestinationMaster where name like "%'.trim(strip($_REQUEST['keyword'])).'%"  group by cityId,countryCode limit 0,10';
$rs=mysqli_query(db(),$sql);
while($resListing=mysqli_fetch_array($rs)){ 
$no=1;  
?>
<div class="list" onclick="$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['cityId']); ?>,<?php echo strip($resListing['countryCode']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['name']); ?>,<?php echo strip($resListing['countryName']); ?>');$('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();"><?php echo strip($resListing['name']); ?>,<?php echo strip($resListing['countryName']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['name']); ?></div></div>
<?php } ?>
<?php if($no!=1){ ?> 
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('.searchdestinationboxclass').hide();
 </script>
 <?php } ?>