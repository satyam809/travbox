<?php
include "config/database.php";
include "config/function.php";
include "config/setting.php";

require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
	$orderId=$_SESSION['razorpay_order_id'];
    /*
	$html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
	*/

$namevalue ='status="success",payment_source="Razorpay",easepayid="'.$_POST['razorpay_payment_id'].'"';
$where=' id="'.$orderId.'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);
	

$onlineRch=GetPageRecord('*','onlineRechargeRequest','id="'.$orderId.'"'); 
$onlineRchData=mysqli_fetch_array($onlineRch);

$chkrow=GetPageRecord('*','sys_balanceSheet','token="'.$onlineRchData["merchant_param2"].'"'); 
if(mysqli_num_rows($chkrow)==0){
$namevalue ='agentId="'.$onlineRchData["merchant_param3"].'",amount="'.$onlineRchData["requestedAmount"].'",paymentType="Credit",paymentMethod="Online",transactionId="'.$tracking_id.'",token="'.$onlineRchData["merchant_param2"].'",remarks="Online Recharge",addedBy="'.$onlineRchData["merchant_param3"].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$namevalue);
$bookingType=$onlineRchData["merchant_param1"];
}	
?>

<script>
	function closeWindow() { 
        let new_window =
            open(location, '_self');
       
        new_window.close();
      
        return false;
    }
 
setTimeout(function() { 
closeWindow();
}, 3000);

</script>
Wait Please...

<?php
exit();
}
else
{
$namevalue ='status="failed",payment_source="Cashfree",easepayid="'.$_SESSION['razorpay_payment_id'].'"';
$where=' id="'.$_SESSION['razorpay_order_id'].'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);
	
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
			 
exit();
			 
}

?>