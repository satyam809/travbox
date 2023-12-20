<?php 
include "inc.php"; 
include "config/logincheck.php";  

if($_REQUEST['phone']!='' || $_REQUEST['email']!=''){

$a=GetPageRecord('*','clientMaster',' parentId="'.$LoginUserDetails['parentId'].'" and (phone="'.$_REQUEST['phone'].'" or email="'.$_REQUEST['email'].'")'); 
$res=mysqli_fetch_array($a);
if($res['id']>0){
?>
<script>
$('#contactNumber').val('<?php echo stripslashes($res['phone']); ?>');
$('#contactEmail').val('<?php echo stripslashes($res['email']); ?>');
$('#companyName').val('<?php echo stripslashes($res['companyName']); ?>');
$('#contactPerson').val('<?php echo stripslashes($res['name']); ?>');
$('#nameHead').val('<?php echo stripslashes($res['nameHead']); ?>');
$('#country').val('<?php echo stripslashes($res['clientCountry']); ?>');
</script>

<?php } } ?>


asdfasf