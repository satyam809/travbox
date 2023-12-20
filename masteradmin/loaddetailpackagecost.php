<?php 
include "inc.php"; 
include "config/logincheck.php";   
 
$b=GetPageRecord('*','quotationMaster','  id="'.decode($_REQUEST['id']).'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

$a=GetPageRecord('*','queryMaster','   id="'.$quotationDetail['queryId'].'" order by id asc '); 
$rest=mysqli_fetch_array($a);


$ab=GetPageRecord('*','sys_branchMaster','   id="'.$LoginUserDetails['branchId'].'" order by id asc '); 
$branchData=mysqli_fetch_array($ab);

 

$ab=GetPageRecord('*','sys_quickPackageOptions','  quotationId="'.$quotationDetail['id'].'" and  id="'.decode($_REQUEST['optionid']).'" order by id asc '); 
$optiondata=mysqli_fetch_array($ab);
?>
	
	<div style="padding: 5px 15px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="66%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;">Per Adult Price:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($optiondata['perAdult']); ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
  
   <tr>
    <td width="66%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;">Per Child Price:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($optiondata['perChild']); ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
  
 
   
</table>

	</div> 