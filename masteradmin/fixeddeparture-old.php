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
<span onclick="loadpop('Add Fixed Departure',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfixeddeparture" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;">Add Fixed Departure</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-plane" aria-hidden="true"></i> Fixed Departures</span>
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
								  <th width="2%">Photo</th>
									<th>Name</th>
									<th>Date</th>
									<th>Departure</th>
									<th>Duration</th>
									<th>Arrival</th>
									<th>Base Fare</th>
									<th>Taxes</th>
									<th>Baggage</th>
									<th>Check-in</th>
									<th>Cabin</th>
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
$rs=GetRecordList('*','fixedDepartureMaster',' where addBy="'.$LoginUserDetails['id'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
								<tr>
<td width="2%"><div style="width:40px; height:40px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($rest['img']!=''){ echo 'upload/'.stripslashes($rest['img']); } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td>
<td><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?> [<?php echo stripslashes($rest['flightNo']); ?>]<div style="margin-top:2px; font-size:12px; font-weight:400;"><?php if($rest['flightType']=="D"){ echo 'Domestic'; } if($rest['flightType']=="I"){ echo 'International'; } ?></div></div></td>

<td><span style="font-weight:500;">From:<?php echo date("m-d-Y",strtotime($rest['fromDate'])); ?><div style="margin-top:2px; font-weight:500; font-size:12px;">To:<?php echo date("m-d-Y",strtotime($rest['toDate'])); ?></div></span></td>

									<td><span style="font-weight:500;"><?php echo stripslashes($rest['departure']); ?><div style="margin-top:2px; font-weight:400; font-size:12px;"><?php echo stripslashes($rest['departureTime']); ?></div></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['duration']); ?><div style="margin-top:2px; font-weight:400; font-size:12px;"><?php echo stripslashes($rest['stops']); ?></div></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['arrival']); ?><div style="margin-top:2px; font-weight:400; font-size:12px;"><?php echo stripslashes($rest['arrivalTime']); ?></div></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['baseFare']); ?> INR</span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['surchargesTaxes']); ?> INR </span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['baggage']); ?></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['checkin']); ?></span></td>
									<td><span style="font-weight:500;"><?php echo stripslashes($rest['cabin']); ?></span></td>
									<td><div align="center"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#0cb5b5;">Active</span><?php } else { ?><span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span><?php } ?></div></td>
									<td><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Fixed Departure',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfixeddeparture&id=<?php echo encode($rest['id']); ?>">
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

 