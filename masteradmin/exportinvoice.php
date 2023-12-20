<?php 
include "inc.php"; 
include "config/logincheck.php"; 

header('Content-type: application/excel');
$filename = 'invoice_'.mt_rand().'.xls';
header('Content-Disposition: attachment; filename='.$filename);
$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>

<body>	
			<table>
				<tr>
					<th>SN</th>
					<th>Date</th>
					<th>Agent</th>
					<th>GSTIN</th>';
					if($_SESSION['userid']==1){
					$data.='<th>Pan</th>';
					}
					$data.='<th>Booking No. </th>
							<th>Inoice ID</th>
							<th>Airline</th>
							<th>Departure</th>
							<th>Arrival</th>
							<th>PNR</th>
							<th>Commission</th>';
					if($_SESSION['userid']==1){
					$data.='<th>GST%</th>';
					}
				$data.='<th>TDS</th>
						<th>Inv&nbsp;Amt </th>
					</tr>';
$sn=1;
$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agent']!=''){
$search.=' and agentId="'.$_REQUEST['agent'].'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentId in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) )';
}

$query=GetPageRecord('*','flightBookingMaster','1 and invoiceId>0 and pnrNo!="" and agentBookingType=0 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") and status!=0 '.$search.' order by id desc'); 
while($rest=mysqli_fetch_array($query)){

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
$balanceSheetData=mysqli_fetch_array($c); 

if($cont>1){ 
$ddd='<br /><span class="badge bg-blue" style="background-color: #5d5d5e;">Round Trip</span>';
}
if($rest['fixedDeparture']==1){
$ddd='<br /><span class="badge bg-blue" >Fixed Departure</span>';
}

if($balanceSheetData['bookingId']>0 && $balanceSheetData['bookingType']=='flight_GST'){ 
if($balanceSheetData['paymentType']=='Debit'){ $balanceAmount=number_format($balanceSheetData['amount']); } } 

		$data .= '<tr>
					<td>'.$sn.'</td>
					<td>'.date('d-m-Y', strtotime($rest['bookingDate'])).'</td>
					<td>'.strip($agentData['companyName']).'</td>
					<td>'.strip($agentData['gstin']).'</td>';
					if($_SESSION['userid']==1){
						$data.='<td>'.strip($agentData['pan']).'</td>';
					}
					$data .= '<td>'.encode($rest['id']).$ddd.'</td>
					<td>'.encode($rest['invoiceId']).'</td>
					<td>'.stripslashes($rest['flightName']).' ('.stripslashes($rest['flightNo']).')<br>'.stripslashes($rest['pcc']).'</td>
					<td>'.stripslashes($rest['source']).'</td>
					<td>'.stripslashes($rest['destination']).'</td>
					<td>'.stripslashes($rest['pnrNo']).'</td>
					<td>'.stripslashes($rest['agentCommision']).'</td>';
					
					if($_SESSION['userid']==1){
					$data.='<td>18</td>';
					}
					
					$data .= '<td>'.$balanceAmount.'</td>
					<td>'.stripslashes($rest['agentTotalFare']).'</td>
				</tr>';
$sn++;
}

		$data .= '
			</table>
</body>
</html>';
echo $data;

?>