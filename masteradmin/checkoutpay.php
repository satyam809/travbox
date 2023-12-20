<?php

include "inc.php";    
include_once('easebuzz-lib/easebuzz_payment_gateway.php');
include_once('easebuzz-lib/payment.php');
$easepayid = $_POST['pid'];
$txnid = $_POST['txnid'];
$status = $_POST['status'];
$net_amount_debit = $_POST['net_amount_debit'];
$deduction_percentage = $_POST['deduction_percentage'];
$payment_source =$_POST['payment_source'];
$udf6 =$_POST['udf6'];
$udf2 =$_POST['udf2'];
$udf1 =$_POST['udf1'];
$credittoDate =date("Y-m-d H:i:s");
$creditFromDate = date("Y-m-d H:i:s");
// print_r($_POST); exit;

if($status=='success' && $easepayid!='' && $txnid!=''){

     //Update Payment Status
     $namevalue ='status="success",net_amount_debit="'.$net_amount_debit.'",payment_source="'.$payment_source.'",easepayid="'.$easepayid.'",deduction_percentage="'.$deduction_percentage.'"';
     $where='id="'.$id.'"';
     updatelisting('onlineRechargeRequest',$namevalue,$where);

     $chkrow=GetPageRecord('*','sys_balanceSheet','token="'.$udf6.'"'); 
     if(mysqli_num_rows($chkrow)==0){
     
     //Insert data in balancesheet table
     $namevalue1='agentId="'.$udf2.'",SubAgentId="0",amount="'.$udf1.'",remarks="recharge", paymentMethod="Online",transactionId="'.$easepayid.'",paymentType="Credit",addedBy="'.$udf2.'",addDate="'.date("Y-m-d H:i:s").'",offlineAgent="0",token="'.$udf6.'"';
     addlistinggetlastid('sys_balanceSheet',$namevalue1);

     $namevalue2 ='to_agent_id="'.$_SESSION['userid'].'",from_agent_id="1",amount="'.$udf1.'",creditFromDate="'.$creditFromDate.'",credittoDate="'.$credittoDate.'",remarks="recharge",addDate="'.date('Y-m-d H:i:s').'"'; 
     //echo $namevalue1; exit;

     addlistinggetlastid('sys_transfer_balance',$namevalue2); 
     echo 1;

     }


}
else
{
     echo 0;
}
?>




?>