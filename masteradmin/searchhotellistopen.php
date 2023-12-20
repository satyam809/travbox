<?php
include "inc.php";  
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div id="hotelsearchlistbox" style=" display:none; padding: 10px; background-color: #fff; width: 100%; border: 2px solid #cacaca; position: absolute; left: 0px; top: 34px; font-size: 12px; z-index: 99999; box-shadow: 2px 2px 4px #00000057;">

<?php

$rs=GetPageRecord('*','hotelMaster','cityId="'.$_REQUEST['pickupCityfromCity'].'" and category="'.$_REQUEST['hotelCategory'].'" and (name like "%'.trim(strip($_REQUEST['keyword'])).'%") order by name asc limit 0,10'); 
while($resListing=mysqli_fetch_array($rs)){ 
 $no=1;  
?>
<div style="padding:8px 8px; border-bottom:1px solid #ddd; color:#333333; cursor:pointer;" onclick="triggerhoteladdbutton('<?php echo strip($resListing['id']); ?>');"><?php echo strip($resListing['name']); ?></div>
<?php } ?>
<?php if($no==1){ ?>
 <script>
 $('#hotelsearchlistbox').show();
 </script>
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();
 </script>
 <?php } ?>
 
 <script>
 function triggerhoteladdbutton(id){
 var editid = $('#editid').val(); 
 if(editid!=''){ 
 var popaction = $('#hoteladdbtn'+editid).attr('popaction'); 
 $('#popcontent').load('loadpopup.php?'+popaction+'&filledhotelid='+id+'&cityIds=<?php echo $_REQUEST['citysearchfield']; ?>');
 
 } else { 
  var popaction = $('#hoteladdnewbtn').attr('popaction'); 
  $('#popcontent').load('loadpopup.php?'+popaction+'&filledhotelid='+id+'&cityIds=<?php echo $_REQUEST['citysearchfield']; ?>');
 } 
 }
 </script>