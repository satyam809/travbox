<?php 
include "inc.php"; 
include "config/logincheck.php"; 

header('Content-type: application/excel');
$filename = 'agent_master_'.mt_rand().'.xls';
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
					<th>Date of Register</th>
					<th>Agent Type</th>
					<th>Agent Id</th>
					<th>Agency Name</th>
					<th>Agent Name</th>
					<th>Mobile&nbsp;Number </th>
					<th>Email</th>
					<th>State</th>
					<th>Wallet</th>
					<th>Total Sale</th>
					<th>Status</th>
				</tr>';
				
$search='';
$sn=1;

if($_REQUEST['agentCategory']!=''){
$search.=' and  agentCategory="'.$_REQUEST['agentCategory'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (companyName like "%'.$_REQUEST['keyword'].'%" or  name like "%'.$_REQUEST['keyword'].'%" or  phone like "%'.$_REQUEST['keyword'].'%" or  email like "%'.$_REQUEST['keyword'].'%") ';
}


$query=GetPageRecord('*','sys_userMaster','userType="agent" '.$search.' order by id desc'); 
while($row=mysqli_fetch_array($query)){
	
$totalSale=0;
$totalwalletBalance=0;
	
$onlineFlightBooking=GetPageRecord('SUM(clientTotalFare) as TotalSale','flightBookingMaster','agentBookingType=0 and status="2" and agentId="'.$row['id'].'"'); 
$onlineFlightBookingData=mysqli_fetch_array($onlineFlightBooking);

$onlineHotelBooking=GetPageRecord('SUM(Amount) as TotalSale','hotelBookingMaster','agentId="'.$row['id'].'" and BookingNumber!="" and agentBookingType=0 and bookingType=0 and status=2'); 
$onlineHotelBookingData=mysqli_fetch_array($onlineHotelBooking);


$totalSale=$onlineFlightBookingData['TotalSale']+$onlineHotelBookingData['TotalSale'];


$a=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$row['id'].'" and paymentType="Credit" and offlineAgent=0 '); 
$agentCreditAmt=mysqli_fetch_array($a); 
									
$b=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$row['id'].'" and paymentType="Debit" and offlineAgent=0 '); 
$agentDebitAmt=mysqli_fetch_array($b); 
$totalwalletBalance=round($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);

		$data .= '<tr>
					<td>'.$sn.'</td>
					<td>'.date('d-m-Y',strtotime($row['addDate'])).'</td>
					<td>'.$row["agentType"].'</td>
					<td>'.makeAgentId($row['agentId']).'</td>
					<td>'.$row["companyName"].'</td>
					<td>'.$row["name"].'</td>
					<td>'.$row["phone"].'</td>
					<td>'.$row["email"].'</td>
					<td>'.getStateName($row['state']).'</td>
					<td>'.$totalwalletBalance.'</td>
					<td>'.$totalSale.'</td>
					<td>'.getsectionstatus($row['status']).'</td>
				</tr>';
$sn++;
}

		$data .= '
			</table>
</body>
</html>';
echo $data;

?>