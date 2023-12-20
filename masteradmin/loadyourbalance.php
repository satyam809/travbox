<?php  
include "inc.php";  
include "config/logincheck.php";  



$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','1 and agentId="'.$_SESSION['userid'].'" and paymentType="Credit"  '); 

$agentCreditAmt=mysqli_fetch_array($rs8); 



$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','1 and  agentId="'.$_SESSION['userid'].'" and paymentType="Debit"  '); 

$agentDebitAmt=mysqli_fetch_array($rs8); 



$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);



echo '&#8377;'.number_format($totalwalletBalance,2);



?>

