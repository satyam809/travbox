 <?php 
include "inc.php"; 
//include "config/logincheck.php";  
//$cookie_value=$_SESSION;
//setcookie('flyshopkafila', $cookie_value, time() + (86400 * 30), "/");
//file_put_contents("usersession/".$_SESSION['agentUserid'].".txt",json_encode($_SESSION));


?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Online Recharge - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>

	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<style>

#searchform .form-control { font-size: 12px !important; height: 33px; border-radius: 4px !important; }

#searchform .col-xl-3 { padding-left: 5px !important; padding-right: 5px !important; }
html{background-color:#ededed;}
body{background-color: transparent;}
</style>

</head>


<?php
if($_REQUEST['type']!='' && $_REQUEST['type']=='recharge'){
	
	$payment_confirm=1;
?>


<body id="bookingpage">

	 

	<div class="sections" style="max-width: 100%; margin: auto; margin-top: 14%;">

		<div class="container"> 

			<div class="row">

				<div class="col-lg-12">

					<div class="card">

					<div class="row">

						<div class="col-lg-12">

							<div class="card-body" style="padding:15px;">

<div class="row">

	<div class="col-xl-12 col-lg-12 col-md-12"> 
	<h2>Online Recharge</h2>
<?php
/*
if($_REQUEST['type']!='' && $_REQUEST['type']=='recharge')
{
	*/
	//$payment_confirm=1;
$bookingServiceType="recharge";
$_SESSION['serviceId']=rand().strtotime("Ymdhsi");	
?>
		<!-- <form method="post" action="<?php echo $fullurl; ?>frmaction.html">  -->
    <form id="paymentForm">

		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="recharge">
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">

		

			<div class="row"> 

				<div class="col-xl-3 col-lg-3 col-md-12">

					<div class="form-group">

						<label>Recharge Amount<span style="color:#FF0000;">*</span></label>

						<input name="amount" id="amount" required="required" type="number" class="form-control" value="<?php if($_REQUEST['type']!='') { echo decode($_REQUEST['bamount']); } ?>">

					</div>

				</div>

			</div>



			<div class="row"> 

				<div class="col-xl-12 col-lg-12 col-md-12">

					<div class="form-group">

						<label>Note</label>

						<textarea name="notes" cols="5" class="form-control"></textarea>

					</div>

				</div>

				<div style="text-align: right; width: 100%; margin-top: 10px; margin-right: 10px;"><button type="submit" class="btn btn-danger">Recharge</button></div>

			</div>

	</form>
<?php //} ?>
</div>





</div>







 









</div>



</div>





 

</div>





 

</div>







</div>







			</div>

</div>

</div>
 



<?php 
}


if($_REQUEST["b"]=="1" && $_REQUEST["bamount"]>0){
$payment_confirm=1;
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<style>
html{background-color:#FFFFFF;}
body{background-color:#FFFFFF !important; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:0px; margin:0px;}
</style>
<div style="padding:30px 15%; ">
<form method="post" id="bookingForm" action="<?php echo $fullurl; ?>frmaction.html"> 
<table width="100%" border="0" cellpadding="10" cellspacing="0" style="display:none;">
  <tr>
    <td colspan="3" align="center" style="font-size:20px; font-weight:600;">Select Payment Mode</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#B7FFEB" style="font-size:13px;">
      <tr style="font-weight:500;">
        <td width="4%" align="left" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="10%" align="center" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="22%" align="left" valign="middle" bgcolor="#E0FEF9">MODE</td>
        <td width="19%" align="left" valign="middle" bgcolor="#E0FEF9"><div align="center">CHARGES</div></td>
        <td width="45%" align="right" valign="middle" bgcolor="#E0FEF9">AMOUNT</td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="4%" align="left" valign="middle"><input name="pg_name" type="radio" value="DC"> </td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Debit Card </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>1%</strong></div></td>
        <td align="right" valign="middle" style="font-size:16px; font-weight:500;">₹<?php echo round($_REQUEST["bamount"])+round($_REQUEST["bamount"]*1/100); ?></td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="CC"></td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Credit Card </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>1.9%</strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo round($_REQUEST["bamount"])+round($_REQUEST["bamount"]*1.9/100); ?></td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="NB"></td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-university" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Net Banking </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>₹20 </strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo trim($_REQUEST["bamount"]+20); ?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="UPI" checked></td>
        <td width="10%" align="center" valign="middle"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACaklEQVR4nO2Xu49NURTGf94SIRidRzTeCTMejVehGFFIKLRKxRQoKBRcGgohhMZ/IKYyU00hJnGRUFCMR6cYIhKRmAwJgytb1o6TNWefdfYZEZL1JTvnfud+37fOvmeffdcBh8PhcDgcDofD4fh30A10MsZ18W0S/tTI17oyvrvmtc4A+lJfnsycyEXxnVA8Ba0r4yPATCNnLtBfVW9IgvcaQVoXeW9NX6/B+yoyFgPtqnphlp+AL8C8iqA5ohsFZssYr+HTuhTvAB+AJSUZK4GXoknW25OxpCaAfQ18YdxRPs076vmL2Ay8LcmZhAsZFzNe+DXOZ07klPJpPiTHb8BG+S4soTEZD5RvEh6LYBvVeCS6Zcq31fBpXRUflM/DwGHgK/AO2GLV6wK+y9oM21oKi+SXirroew9Mr/BpncXXyMXHu/gKWF2n3qHM5dGvfLeMu6F1Fg+4JudGCnffrHcjYxJvCssv+o6kghM6iyO71m1gIb9Rt57jv8Co3M6lhu610kVeZ4SHuSxnGnBAzh+cyiTWSegzQ7de6SKvO54ncjZIO7IWeDiViRyV4CuG7lhNXSr/aoIfB34Al+X8KhpiQAL2/yGd5RtQfLDQEoXj6QZz+NVKf5SQBRm6yOsuK+2bqMh50WQiO8V8L1MXeZ0ROtiW8rWF7yrRX2oykbNiPmPozomupXythvVaKje2KjeNNiiJ+xKwPVMXX3p2ZNZrK1/ocu9Kkzos70HZmK+aNmuE9npWwRd5br2xQs4TYLkcQ7PaCCsKb2vW+CzbL7LbdGT3yYH29cgfYnehYXQ4HA6Hw+Fw8PfxEyWmf5sEmp4DAAAAAElFTkSuQmCC" style="height:32px;"></td>
        <td align="left" valign="middle">UPI</td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong style="color:#09b598;">FREE</strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo trim($_REQUEST["bamount"]); ?></td>
      </tr>
      
    </table></td>
  </tr>
</table>

		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="booking">
		<input name="token" type="hidden" value="<?php echo rand(89898,543132113).strtotime(date('YmdHis')); ?>" />
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">
		<input type="hidden" name="amount" value="<?php echo trim($_REQUEST["bamount"]); ?>">
			<div   style="text-align:center; width:100%;"> 

				 <input type="submit" value="Continue Payment" style="padding:10px 20px; background-color:#09b598; color:#FFFFFF; font-size:14px; font-size:15px; font-weight:600; border:0px; outline:0px;border-radius:5px;">

			</div>
	</form>
</div>
<script>
$('#bookingForm').submit();
</script>

<?php
}



if($_REQUEST["c"]=="1" && $_REQUEST["camount"]>0){
$payment_confirm=1;
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<style>
html{background-color:#FFFFFF;}
body{background-color:#FFFFFF !important; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:0px; margin:0px;}
</style>
<div style="padding:30px 15%; ">
<form   method="post" id="bookingForm" action="<?php echo $fullurl; ?>frmaction.html"> 
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td colspan="3" align="center" style="font-size:20px; font-weight:600;">Select Payment Mode</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#B7FFEB" style="font-size:13px;">
      <tr style="font-weight:500;">
        <td width="4%" align="left" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="10%" align="center" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="22%" align="left" valign="middle" bgcolor="#E0FEF9">MODE</td>
        <td width="19%" align="left" valign="middle" bgcolor="#E0FEF9"><div align="center">CHARGES</div></td>
        <td width="45%" align="right" valign="middle" bgcolor="#E0FEF9">AMOUNT</td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="4%" align="left" valign="middle"><input name="pg_name" type="radio" value="DC"> </td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Debit Card </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>1%</strong></div></td>
        <td align="right" valign="middle" style="font-size:16px; font-weight:500;">₹<?php echo round($_REQUEST["camount"])+round($_REQUEST["camount"]*1/100); ?></td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="CC"></td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Credit Card </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>1.9%</strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo round($_REQUEST["camount"])+round($_REQUEST["camount"]*1.9/100); ?></td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="NB"></td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-university" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Net Banking </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>₹20 </strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo trim($_REQUEST["camount"]+20); ?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="UPI" checked></td>
        <td width="10%" align="center" valign="middle"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACaklEQVR4nO2Xu49NURTGf94SIRidRzTeCTMejVehGFFIKLRKxRQoKBRcGgohhMZ/IKYyU00hJnGRUFCMR6cYIhKRmAwJgytb1o6TNWefdfYZEZL1JTvnfud+37fOvmeffdcBh8PhcDgcDofD4fh30A10MsZ18W0S/tTI17oyvrvmtc4A+lJfnsycyEXxnVA8Ba0r4yPATCNnLtBfVW9IgvcaQVoXeW9NX6/B+yoyFgPtqnphlp+AL8C8iqA5ohsFZssYr+HTuhTvAB+AJSUZK4GXoknW25OxpCaAfQ18YdxRPs076vmL2Ay8LcmZhAsZFzNe+DXOZ07klPJpPiTHb8BG+S4soTEZD5RvEh6LYBvVeCS6Zcq31fBpXRUflM/DwGHgK/AO2GLV6wK+y9oM21oKi+SXirroew9Mr/BpncXXyMXHu/gKWF2n3qHM5dGvfLeMu6F1Fg+4JudGCnffrHcjYxJvCssv+o6kghM6iyO71m1gIb9Rt57jv8Co3M6lhu610kVeZ4SHuSxnGnBAzh+cyiTWSegzQ7de6SKvO54ncjZIO7IWeDiViRyV4CuG7lhNXSr/aoIfB34Al+X8KhpiQAL2/yGd5RtQfLDQEoXj6QZz+NVKf5SQBRm6yOsuK+2bqMh50WQiO8V8L1MXeZ0ROtiW8rWF7yrRX2oykbNiPmPozomupXythvVaKje2KjeNNiiJ+xKwPVMXX3p2ZNZrK1/ocu9Kkzos70HZmK+aNmuE9npWwRd5br2xQs4TYLkcQ7PaCCsKb2vW+CzbL7LbdGT3yYH29cgfYnehYXQ4HA6Hw+Fw8PfxEyWmf5sEmp4DAAAAAElFTkSuQmCC" style="height:32px;"></td>
        <td align="left" valign="middle">UPI</td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong style="color:#09b598;">FREE</strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo trim($_REQUEST["camount"]); ?></td>
      </tr>
      
    </table></td>
  </tr>
</table>

		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="recharge">
		<input name="token" type="hidden" value="<?php echo rand(89898,543132113).strtotime(date('YmdHis')); ?>" />
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">
		<input type="hidden" name="amount" value="<?php echo trim($_REQUEST["camount"]); ?>">
			<div style="text-align:center; width:100%;"> 
				 <input type="submit" value="Continue Payment" style="padding:10px 20px; background-color:#09b598; color:#FFFFFF; font-size:14px; font-size:15px; font-weight:600; border:0px; outline:0px;border-radius:5px;">
			</div>
	</form>
</div>

<script>
$('#bookingForm').submit();
</script>

<?php
}







if($payment_confirm<1){ ?>

<body>
	<h2 style="text-align:center;">Something went wrong, please try again!!</h2>
</body>

<?php
	
	
}
 ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js"></script>
<script>
$(document).ready(function() {
    $("#paymentForm").submit(function(event) {
        //alert('test');
        // Prevent the form from submitting traditionally
        event.preventDefault();

        // Collect form data
        var formData = $(this).serialize();

        // Send a POST request to your server for processing
        $.ajax({
            type: "POST",
            url: "process_payment.php", // Replace with the actual URL to your processing script
            data: formData,
            success: function(response) {
                console.log(response);

                var easebuzzCheckout = new EasebuzzCheckout('GN9JR3ZDZQ', 'test')
                // document.getElementById('ebz-checkout-btn').onclick = function(e){
                    console.log(JSON.parse(response));
                    var access_key = JSON.parse(response).data;
                    
                    var options = {
                        access_key: access_key, // access key received via Initiate Payment
                        onResponse: (response) => {
                          console.log(response);
                          var pid =  response.easepayid;
                          var txnid = response.txnid;
                          var surl  = response.surl;
                          var deduction_percentage  =  response.deduction_percentage;
                          var card_type    = response.card_type;
                          var net_amount_debit  = response.net_amount_debit;
                          var status = response.status;
                          var udf2 = response.udf2;
                          var udf6 = response.udf6;
                          var udf1 = response.udf1;

                          
                          $.ajax({
                             
                             url: "checkoutpay.php",
                             type: "post",
                             data: {pid:pid,txnid:txnid,surl:surl,deduction_percentage:deduction_percentage,card_type:card_type,net_amount_debit:net_amount_debit,status:status,udf2:udf2,udf6:udf6,udf1:udf1},
                             success:function(data){
                                
                                if(data == 1)
                                {
                                    // window.location.href = surl;
                                    function closeWindow() { 
                                          self.close();
                                      }
                                  
                                  setTimeout(function() { 
                                  closeWindow();
                                  }, 3000);

                                    window.location.href = 'https://travbox.travel//masteradmin/display.html?ga=distributors_balancesheet';
                                }
                                else
                                {
                                    alert('something went wrong');
                                }
                               
                             }
                          })
                            console.log(response);
                        },
                        theme: "#123456" // color hex
                    }
                    easebuzzCheckout.initiatePayment(options);
                // }
                // Handle the response from the server
                // Typically, you would redirect the user to the payment gateway or show a success message
                // You can also handle errors here
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
            }
        });
    });
});
</script>


</body>
</html>

