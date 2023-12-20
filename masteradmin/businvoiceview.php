<?php 
include "inc.php";  

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','busbookingMaster',' id="'.decode($_REQUEST['id']).'"  '); 
$rest=mysqli_fetch_array($a); 


if($rest['id']==''){
echo 'Something went wrong. Please try again.';
exit();
}

$b=GetPageRecord('*','sys_branchMaster',' id=1 '); 
$adminData=mysqli_fetch_array($b); 


$urs=GetPageRecord('*','sys_userMaster',' id="'.$_SESSION['userid'].'"  '); 
$agentData=mysqli_fetch_array($urs); 
} 


?> 

<div style="margin:auto; padding:10px;">
<style>
table { font-size:12px; color:#000000; }
</style>
<style>
@media print {
body{padding:0px;}
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<table width="100%" border="0" cellpadding="5" style="font-size:12px; ">
  <tr>
    <td width="34%" align="left"><img src="<?php echo $imgurl; ?><?php echo $adminData['companyLogo']; ?>" style="width:200px; "></td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right" valign="middle"><div style="font-size:24px; text-decoration:underline; font-weight:600">Invoice</div></td>
  </tr>
  <tr>
    <td width="34%" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td><strong><?php echo strtoupper($adminData['companyName']); ?></strong></td>
      </tr>
      <tr>
        <td><?php echo stripslashes($adminData['address']); ?></td>
      </tr>
      <tr>
        <td>Tel: <?php echo stripslashes($adminData['phone']); ?> </td>
      </tr>
      <tr>
        <td>Email: <?php echo stripslashes($adminData['email']); ?> </td>
      </tr>
      <tr>
        <td><?php echo stripslashes($adminData['taxId']); ?></td>
      </tr>
      
    </table></td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td align="right"><strong><?php echo stripslashes($agentData['companyName']); ?></strong></td>
      </tr>
      <tr>
        <td align="right"><?php echo stripslashes($agentData['address']); ?></td>
      </tr>
      
      <tr>
        <td align="right">Mobile No: <?php echo stripslashes($agentData['phone']); ?></td>
      </tr>
      <tr>
        <td align="right">Email: <?php echo stripslashes($agentData['email']); ?></td>
      </tr>
      <tr>
        <td align="right">GSTIN: <?php echo stripslashes($agentData['gstin']); ?></td>
      </tr>
      <tr>
        <td align="right">Pan No: <?php echo stripslashes($agentData['pan']); ?></td>
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><hr /></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" style="border:1px solid #ddd;">
      <tr>
        <td width="39%"><div>Invoice no:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo encode($rest['id']); ?></div>		</td>
        <td width="28%"><div>Booking Date:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo date('d M Y, H:i A', strtotime($rest['addDate'])); ?></div></td>
        <td width="18%"><div>Ticket  . :</div>
		  <div style="font-size:13px; font-weight:600;"><?php echo  ($rest['ticket_no']); ?></div>		</td>
        <td width="15%" align="center"><div>Booked By:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($agentData['companyName']); ?></div>
		</td>
      </tr>
    </table></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0">
      <tr>
        <td width="22%" colspan="3" style="border-bottom:1px solid #FF6633;"><div style="width:130px;"><?php echo  $rest['t_agency_name']; ?><br>
Bus: <strong><?php echo stripslashes($rest['fare1']); ?></strong></div></td>
        <td width="47%" align="right" style="border-bottom:1px solid #FF6633;">From: <strong><?php echo $rest['from_city']; ?></strong><br>
To: <strong><?php echo $rest['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($rest['booking_date'])); ?></strong></td>
        </tr>
 
      <tr>
        <td width="31%" align="left" >
		

		
		
		</td>
      </tr> 
    </table>
	
	<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#000000">
 <tr>
    <td style="border-bottom:1px solid #ddd;"> 
      <strong>Pax Details</strong> </td>
    </tr>
	<?php 
		$rs6=GetPageRecord('*','bus_passenger_info',' order_id="'.$rest['tripid'].'" and name!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
  <tr>
    <td style="border-bottom:1px solid #ddd;"> 
      Name : <?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['name']; ?> &nbsp;(<?php echo $paxData['age']; ?>) | &nbsp;Seat : <?php echo $paxData['seat']; ?> </td>
    </tr>
	<?php } ?>
</table>
	</td>
    </tr> 
 
  <tr>
    <td width="34%">&nbsp;</td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="50%" align="right">Basic</td>
        <td width="6%" align="center">:</td>
        <td width="44%" align="right"><?php echo number_format($rest['totalFare']-($rest['agentMarukup']+$rest['adminMarukup'])); ?> INR</td>
      </tr>
      
      <tr>
        <td align="right">Service Charges </td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['adminMarukup']); ?> INR</td>
      </tr>
      <tr>
        <td align="right"><strong>Grand Total</strong></td>
        <td align="center"><strong>:</strong></td>
        <td align="right"><strong><?php echo number_format($rest['totalFare']-$rest['agentMarukup']); ?> INR</strong></td>
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="53%">
		<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #ddd;">
  <tr>
    <td><div style=" font-weight:600; text-decoration: underline; padding:10px;">Terms & Condition</div>
		<div  style=" padding:10px;"><?php echo nl2br(stripslashes($adminData['termsCondition'])); ?></div> </td>
  </tr>
</table>
		</td>
        <td width="47%" align="center"><div style=" font-weight:600;">For <?php echo strtoupper($adminData['companyName']); ?>.</div>
		<div>Computer Generated Report, Requires No Signature</div>		</td>
      </tr>
    </table></td>
    </tr>
</table>


</div>
<script> window.print(); </script>