<?php 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

 $fromdate=$_REQUEST['fromdate'];
 $todate=$_REQUEST['todate'];

} else {
// $fromdate=date('d-m-Y', strtotime("-30 days"));
// $todate=date('d-m-Y'); 
}

?>
<style>
.roomratelist{font-size: 11px;
    font-weight: 500;
    text-align: center;
    padding: 2px;
    background-color: #f1f1f1; margin-bottom:1px;
	}
	
	
</style>
	
<?php include "libraryheader.php"; ?>

<div class="page-content pt-0">
<?php include "libraryleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">

<form action="" method="get" enctype="multipart/form-data" name="addeditfrm"  > 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span onclick="loadpop('Add Sightseeing',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeinglibrary" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add Sightseeing</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-picture-o" aria-hidden="true"></i> Sightseeing</span>
</div>


<div style="padding:10px; width:100%; border-bottom:1px solid #ddd;">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>" style="width:200px;"></td>
    <td style="padding:0px 5px;"><select class="form-control" name="destination" id="destination"  style="width:200px;">
						<option value="">All Destinations</option>				
					<?php  
				$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');
					
					while($rest=mysqli_fetch_array($rs)){ 
					if(trim($rest['name'])!=''){ 
					?> 
					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($_REQUEST['destination']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>
					<?php }} ?>
					
									</select>
      <input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>" /></td>
    <td><button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></td>
  </tr>
</table>

</div>


<div class="nocsstable">
<table class="table">
							<thead>
								<tr>
									<th width="2%">Photo</th>
									<th width="30%">Name</th>
									<th>Destination</th>
									<th><div align="center">Cost</div></th>
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
if($_REQUEST['destination']!=''){
$search.=' and cityId="'.$_REQUEST['destination'].'" ';
}


$search.='';

 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&destination='.$_REQUEST['destination'].'&'; 
$rs=GetRecordList('*','sightseeingMaster',' where parentId="'.$LoginUserDetails['parentId'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
?>
								<tr>
									<td width="2%"><div style="width:90px; height:65px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($rest['sectionPhoto']!=''){ echo 'upload/'.stripslashes($rest['sectionPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td>
									<td width="30%"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td><?php echo getdestinationnamewithlocation($rest['cityId']); ?></td>
									
									
									<td>
									 
									
									<div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('Add Sightseeing',this,'1300px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeinglibrarycost&id=<?php echo encode($rest['id']); ?>">
											<?php
											$roomslist='';
											$a=GetPageRecord('*','sys_vehicleCost',' sightseeingId="'.$rest['id'].'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'" group by vehicleId order by id desc');
											while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.vehiclename($roomlist['vehicleId']).' - '.vehiclenamepax($roomlist['vehicleId']).' '.' ('.$roomlist['adultCost'].' '.currencyname($roomlist['currencyId']).')'.'</div>'; }  echo $roomslist; ?> 
									</div>
									
									
									
									<div align="center"><span class="badge bg-blue" style="background-color:#2196f3; cursor:pointer;" onclick="loadpop('Add Sightseeing Cost',this,'1300px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeinglibrarycost&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add</span></div></td>
									
									<td><div align="center"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#0cb5b5;">Active</span><?php } else { ?><span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span><?php } ?></div></td>
									<td><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Sightseeing',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addsightseeinglibrary&id=<?php echo encode($rest['id']); ?>">
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

 