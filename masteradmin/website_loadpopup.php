<?php
include "websiteinc.php"; 

$a=GetPageRecord('*','quotationMaster','  id="'.$_REQUEST['id'].'"'); 
$quotationInfo=mysqli_fetch_array($a);  
?>

<?php
$a=GetPageRecord('*','quotationEvents','  quotationId="'.$quotationInfo['id'].'" and eventType="hotel"  order by checkInDate asc');
while($listhotel=mysqli_fetch_array($a)){
?>
<div style="border:1px solid #ddd; background-color:#F2F2F2; padding:10px;">asdf</div>
<?php } ?>