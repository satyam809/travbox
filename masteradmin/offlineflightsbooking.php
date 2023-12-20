 <?php
 $a=GetPageRecord('*','sys_commissionType',' id="'.decode($_REQUEST['typeid']).'"  ');  
$editresult=mysqli_fetch_array($a); 
?>
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
<span onclick="loadpop('Add Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addofflineflightsbooking&typeid=<?php echo $_REQUEST['typeid']; ?>" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add Flight</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><a href="display.html?ga=commissiontype" style="color:#000000;">Agent Type</a> - <span style="color:#e52b30; font-weight:800;"><?php echo stripslashes($editresult['name']); ?></span> - <i class="fa fa-plane" aria-hidden="true"></i> Offline Flights </span></div>


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
								  <th width="1%"><div align="center">Sr&nbsp;</div></th>
									<th width="15%">Group</th>
									<th width="15%">Name</th>
									<th><div align="center">Fare Type</div></th>
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
$rs=GetRecordList('*','offlineflightsbookingMaster',' where parentId="'.$_SESSION['userid'].'"  and agentTypeGroupId="'.decode($_REQUEST['typeid']).'"  '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
								<tr>
								  <td width="1%"><div align="center"><?php echo $sNo; ?>.</div></td>
								  <td width="15%"><div align="left"><strong><?php echo stripslashes($editresult['name']); ?></strong></div></td>
									<td width="15%"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td style="text-align:center;"> 
									<div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>"  >
											<?php
											$roomslist='';
											$a=GetPageRecord('*','fareTypeofflineflightsbookingMaster',' flightId="'.$rest['id'].'" and parentId="'.$_SESSION['userid'].'" order by id desc');
											if(mysqli_num_rows($a)>0){ while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).'</div>'; }  echo $roomslist; } ?> 
									</div> </td>
									
									<td><div align="center">
									
									<button type="button" class="btn btn-primary btn-icon btn-sm"  onclick="loadpop('Add Fare Type',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretypeofflineflightsbooking&id=<?php echo encode($rest['id']); ?>&typeid=<?php echo $_REQUEST['typeid']; ?>&typeid=<?php echo $_REQUEST['typeid']; ?>&name=<?php echo str_replace(' ','%20',stripslashes($rest['name'])); ?>"> <i class="fa fa-plus" aria-hidden="true"></i> Add Fare Type </button>
									
									<a  style="cursor:pointer;"   onclick="loadpop('Edit Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addofflineflightsbooking&id=<?php echo encode($rest['id']); ?>&typeid=<?php echo $_REQUEST['typeid']; ?>" >
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a></div></td>
								</tr> 
								<?php $sNo++; } ?>
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

 