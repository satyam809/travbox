<style>
.roomratelist{font-size: 11px;
    font-weight: 500;
    text-align: center;
    padding: 2px;
    background-color: #f1f1f1; margin-bottom:1px;
	}
	
	
</style>
	
<?php include "flightsettingsheader.php"; ?>

<div class="page-content pt-0">
<?php include "flightsettingsleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">

<form action="" method="get" enctype="multipart/form-data" name="addeditfrm"  > 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span onclick="loadpop('Add Manual Flights',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmanualflights" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add Manual Flights</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-plane" aria-hidden="true"></i> Manual Flights</span>
</div>


<div style="padding:10px; width:100%; border-bottom:1px solid #ddd;">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>" style="width:200px;"><input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>" /></td>
    <td><button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></td>
  </tr>
</table>

</div>


<div class="nocsstable">
<table class="table">
							<thead>
								<tr>
								  <th>Name</th>
									<th>Departure</th>
									<th>Arrival</th>
									<th>Base Fare</th>
									<th>Taxes</th>
									<th>From</th>
									<th>To</th>
									<th><div align="center">Seat</div></th>
									<th>Supplier</th>
									<th><div align="center">Status</div></th>
									<th><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

if($_REQUEST['keyword']!=''){
$search.=' and name like "%'.$_REQUEST['keyword'].'%" ';
} 

$search.='';

 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','manualFlightMaster',' where 1 '.$search.' and addBy="'.$_SESSION['userid'].'" order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
								<tr>
								  <td><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?> [<?php echo stripslashes($rest['flightCode']); ?> <?php echo stripslashes($rest['flightNo']); ?>]<div style="margin-top:2px; font-size:12px; font-weight:400;"><?php if($rest['flightType']=="D"){ echo 'Domestic'; } if($rest['flightType']=="I"){ echo 'International'; } ?></div></div>																		</td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['departure']); ?><div style="margin-top:2px; font-weight:400; font-size:12px;"><?php echo stripslashes($rest['departureTime']); ?></div></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['arrival']); ?><div style="margin-top:2px; font-weight:400; font-size:12px;"><?php echo stripslashes($rest['arrivalTime']); ?></div></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['baseFare']); ?> INR</span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['surchargesTaxes']); ?> INR </span></td>
									<td><span style="font-weight:500;"><?php if($rest['fromDate']!="" && $rest['fromDate']!="1970-01-01"){ echo date('d-m-Y', strtotime($rest['fromDate'])); } ?></span></td>
									<td><span style="font-weight:500;"><?php if($rest['toDate']!="" && $rest['toDate']!="1970-01-01"){ echo date('d-m-Y', strtotime($rest['toDate'])); } ?></span></td>
									<td><div align="center"><?php echo stripslashes($rest['seat']); ?></div></td>
									<td><span style="font-weight:500;"><?php 
										$supplier=GetPageRecord('*','sys_userMaster',' id="'.$rest['supplierId'].'" and userType="suppliers" order by id asc'); 
										$supplierData=mysqli_fetch_array($supplier);
										echo $supplierData['companyName'];
									 ?></span></td>
									<td><div align="center"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#0cb5b5;">Active</span><?php } else { ?><span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span><?php } ?></div></td>
									<td><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Manual Flights',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmanualflights&id=<?php echo encode($rest['id']); ?>">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a></div></td>
								</tr> 
								<?php } ?>
							</tbody>
						</table>
						
						<div class="card-footer text-right" style="overflow:hidden;">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
			  </div>
</div>



</div>
</form>
</div>

</div>

 