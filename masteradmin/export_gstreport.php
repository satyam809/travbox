<?php include "inc.php"; 
$file="GST-Report.xls"; 
header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
header("Content-Disposition: attachment; filename=$file");
 
?>
 



   <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="table">
							<thead>
								<tr>
								  <th>Invoice Date </th>
								  <th>Invoice No. </th>
								  <th>Booking ID</th>
								  <th>Agent</th>
								  <th>GSTN</th>
								  <th><div align="center">Commission</div></th>
								  <th><div align="center">Amount</div></th>
									<th><div align="center">GST</div></th>
									<th><div align="center">GST Amount </div></th>
									<th><div align="center">TDS</div></th>
								    <th><div align="center">Invoice&nbsp;Amount </div></th>
								</tr>
							</thead>
							<tbody>
								<?php 
$totalgst=0;
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_balanceSheet',' where 1 and amount>0 and bookingId in (select id from flightBookingMaster where status=2) and billType="flight" and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'")   group by bookingId  order by id desc  ','250000',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','flightBookingMaster',' id="'.$rest['bookingId'].'" '); 
$bookingdata=mysqli_fetch_array($rs6);
 
$ag=GetPageRecord('*','sys_userMaster',' id="'.$bookingdata['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$rs6=GetPageRecord('*','flightBookingMaster',' id="'.$rest['bookingId'].'" '); 
$bookingdata=mysqli_fetch_array($rs6);

$rs7=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['bookingId'].'" and bookingType="Facilitating"'); 
$totalamountres=mysqli_fetch_array($rs7);

if($totalamountres['amount']<1){

$rs7=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['bookingId'].'" and bookingType="flight"'); 
$totalamountres=mysqli_fetch_array($rs7);

}
$totalpriceofgst=$totalamountres['amount'];


?>
								
								<tr>
								  <td align="left" valign="top"><?php echo date('d-m-Y', strtotime($bookingdata['bookingDate'])); ?></td>
								  <td align="left" valign="top"><?php echo encode($bookingdata['invoiceId']); ?></td>
								  <td align="left" valign="top"><?php echo encode($bookingdata['id']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['companyName']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['gstin']); ?></td>
								  <td align="left" valign="top"><div align="center"><?php echo  ($bookingdata['agentCommision']); $gstamount=round($bookingdata['agentCommision']*18/100); $tds=round($bookingdata['agentCommision']*5/100); ?></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo stripslashes($totalpriceofgst); ?></div></td>
									<td align="left" valign="top"><div align="center">18%</div></td>
									<td align="left" valign="top"><div align="center"><?php if($bookingdata['agentCommision']==0){ echo stripslashes($rest['amount']); } else { echo $gstamount; }?></div></td>
									<td align="left" valign="top">
									  <div align="center"><?php echo $tds; ?></div></td>
								    <td align="left" valign="top"><div align="center"><?php echo (round($bookingdata['agentTotalFare']+$gstamount+$tds)-$bookingdata['agentCommision']); ?></div></td>
								</tr>
								
								 <?php $sNo++; } ?>
							</tbody>
</table>