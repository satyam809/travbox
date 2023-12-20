<?php 
include "inc.php"; 

if($_REQUEST['i']!=''){
$rs5=GetPageRecord('*','quotationMaster','  id="'.decode($_REQUEST['i']).'"'); 
$quotationInfo=mysqli_fetch_array($rs5);
}
?>