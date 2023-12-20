<?php 
include "inc.php"; 
include "config/logincheck.php"; 

header('Content-type: application/excel');
$filename = 'invoice_'.mt_rand().'.xls';
header('Content-Disposition: attachment; filename='.$filename);
?>


<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="table">
							<thead>
								<tr>
								  <th width="33">Date</th>
								  <th width="40">Agent</th>
								  <th width="49">GSTIN</th>
								  <th width="25">Pan</th>
								  <?php if($_SESSION['agentUserid']==1){ ?>
								  <?php } ?>
								  <th width="88">Booking No. </th>
								  <th width="85">Hotel Name </th>
								  <th width="40"><div align="center">Room</div></th>
								  <th width="36"><div align="center">Adult</div></th>
								  <th width="35"><div align="center">Child</div></th>
								  <th width="71">Invoice ID</th>
									<th width="81" align="center"><div align="center">Commission</div></th>
									 
								  <th width="31" align="center" style="text-align:center;"><div align="center">GST</div></th>
						 
								    <th width="31" align="center"><div align="center">TDS</div></th>
								    <th width="58" align="center"><div align="center">Inv&nbsp;Amt </div></th>
							    </tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agent']!=''){
$search.=' and agentId="'.$_REQUEST['agent'].'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentId in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','hotelBookingMaster',' where   status=2  and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.'  order by id desc  ','250000',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

 
 

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$ag=GetPageRecord('COUNT(id) as totaladult','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="adult" '); 
$totalbookungpax_adult=mysqli_fetch_array($ag);


$ag=GetPageRecord('COUNT(id) as totalchild','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="child" '); 
$totalbookungpax_child=mysqli_fetch_array($ag);
 
$ag=GetPageRecord('roomNo','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'"  order by roomNo desc '); 
$totalbookungpax_room=mysqli_fetch_array($ag);
 


$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotel_GST"'); 
$balanceSheetData=mysqli_fetch_array($c); 

$cd=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotelTDS"'); 
$balanceSheetDataTDS=mysqli_fetch_array($cd); 


$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
?>							
								<tr>
								  <td align="left" valign="top"><div style="color:#999999; font-size:12px;"><?php echo date('d-m-Y', strtotime($rest['addDate'])); ?></div></td>
								  <td align="left" valign="top"><?php echo strip($agentData['companyName']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['gstin']); ?></td>
								  <td align="left" valign="top"><?php echo strip($agentData['pan']); ?></td>
								  <?php if($_SESSION['agentUserid']==1){ ?>
<?php } ?>
								  <td align="left" valign="top"><?php echo  ($rest['BookingNumber']); ?></td>
								  <td align="left" valign="top"><?php echo  stripslashes($rest['HotelName']); ?></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_room['roomNo']); ?></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_child['totalchild']); ?></div></td>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?></a></td>
									<td align="center" valign="top"><?php echo round($rest['agentCommision']); ?></td>
									
									
 
<td align="center" valign="top"> 

<?php echo round($rest['agentCommision']*18/100); $totalgst=($totalgst+round($rest['agentCommision']*18/100)); ?></td>							  
 
									
									
									
								    <td align="center" valign="top"><?php echo  round($rest['agentCommision']*5/100); ?></td>
								    <td align="left" valign="top"><div align="center"><?php echo round($rest['agentTotalFare']-$rest['agentMarukup']); ?></div></td>
							    </tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
