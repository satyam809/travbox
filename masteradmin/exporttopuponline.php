<?php 
include "inc.php"; 
include "config/logincheck.php"; 

header('Content-type: application/excel');
$filename = 'online_topup_'.mt_rand().'.xls';
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
					<th>Date of Recharge</th>
					<th>Agent Id</th>
					<th>Agency Name</th>
					<th>Agent Mobile Number</th>
					<th>Mode of Payment</th>
					<th>Amount</th>
					<th>Deduction Charges%</th>
					<th>Payment Source</th>
					<th>Pay ID</th>
					<th>Status</th>
				</tr>';
				
$search='';
$sn=1;

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and DATE(dateAdded)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(dateAdded)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agentId']!=''){
$search.=' and agentId="'.$_REQUEST['agentId'].'" ';
}

if($_REQUEST['paymentMode']!=''){
$search.=' and show_payment_mode="'.$_REQUEST['paymentMode'].'" ';
}

if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['requestedAmount']!=''){
$search.=' and requestedAmount="'.$_REQUEST['requestedAmount'].'" ';
}

$query=GetPageRecord('*','onlineRechargeRequest','1 '.$search.' order by id desc'); 
while($row=mysqli_fetch_array($query)){

//Agent Info
$agent=GetPageRecord('*','sys_userMaster','id="'.$row['agentId'].'" order by id asc');
$agentInfo=mysqli_fetch_array($agent);

		$data .= '<tr>
					<td>'.$sn.'</td>
					<td>'.date('d-m-Y',strtotime($row['dateAdded'])).'</td>
					<td>'.makeAgentId($row['agentId']).'</td>
					<td>'.$agentInfo["companyName"].'</td>
					<td>'.$agentInfo["phone"].'</td>
					<td>'.$row["show_payment_mode"].'</td>
					<td>'.$row["net_amount_debit"].'</td>
					<td>'.$row["deduction_percentage"].'</td>
					<td>'.$row["payment_source"].'</td>
					<td>'.$row["easepayid"].'</td>
					<td style="text-transform:uppercase;">'.$row["status"].'</td>
				</tr>';
$sn++;
}

		$data .= '
			</table>
</body>
</html>';
echo $data;

?>