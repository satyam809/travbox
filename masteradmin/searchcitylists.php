<?php
include "inc.php";  
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div style="padding: 10px; background-color: #fff; width: 100%; border: 2px solid #cacaca; position: absolute; left: 0px; top: 34px; font-size: 12px; z-index: 99999; box-shadow: 2px 2px 4px #00000057;">

<?php

$rs=GetPageRecord('*','cityMaster','name like "%'.trim(strip($_REQUEST['keyword'])).'%" order by name asc limit 0,10'); 
while($resListing=mysqli_fetch_array($rs)){ 
 $no=1;  
?>
<div style="padding:8px 8px; border-bottom:1px solid #ddd; color:#333333; cursor:pointer;" onclick="$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['id']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['name']); ?>');$('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();"><?php echo strip($resListing['name']); ?></div>
<?php } ?>
<?php if($no!=1){ ?>
<div style="padding:8px 8px; border-bottom:1px solid #ddd; color:#333333; text-align:center; color:#999999;" >No City Found</div>
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();
 </script>
 <?php } ?>