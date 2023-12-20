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
								  <th width="65">Agent</th>
								  <?php if($_SESSION['agentUserid']==1){ ?>
								  <?php } ?>
								  <th width="75">Ticket No. </th>
								  <th width="57">Source </th>
								  <th width="130"><div align="left">Bus Agency</div></th>
								  <th width="25"><div align="center">Pax</div></th>
								  <th width="71">Invoice ID</th>
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
$search.=' and  DATE(booking_date)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(booking_date)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agent']!=''){
$search.=' and agentUserid="'.$_REQUEST['agent'].'" ';
}


if($_REQUEST['keyword']!=''){
//$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentUserid in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','busbookingMaster',' where   status=2  and agentUserid  in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.'  order by id desc  ','2500000',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

 
 

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$ag=GetPageRecord('COUNT(id) as totaladult','bus_passenger_info',' order_id="'.$rest['tripid'].'"'); 
$totalbookungpax_adult=mysqli_fetch_array($ag);



$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentUserid'].'" '); 
$agentData=mysqli_fetch_array($ag);
 
?>							
								<tr>
								  <td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['addDate'])); ?></td>
								  <td align="left" valign="top"><strong><?php echo strip($agentData['companyName']); ?></strong><br />
GSTN: <?php echo strip($agentData['gstin']); ?><br />
Pan: <?php echo strip($agentData['pan']); ?></td>
								  <?php if($_SESSION['agentUserid']==1){ ?>
<?php } ?>
								  <td align="left" valign="top"><?php echo  ($rest['ticket_no']); ?></td>
								  <td align="left" valign="top">From: <strong><?php echo $rest['from_city']; ?></strong><br>
To: <strong><?php echo $rest['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($rest['booking_date'])); ?></strong></td>
								  <td align="left" valign="top"><div style="width:130px;"><?php echo  $rest['t_agency_name']; ?><br>
Bus: <strong><?php echo stripslashes($rest['fare1']); ?></strong></div></td>
								  <td align="left" valign="top"><div align="center"><?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?></div></td>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?></td>
									<td align="left" valign="top" ><div align="center"><strong><?php echo stripslashes($rest['totalFare']-$rest['agentMarukup']); ?></strong></div></td>
							    </tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
