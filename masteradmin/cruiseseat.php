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
<span onclick="loadpop('Add Cruise Seat',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcruiseseatlibrary" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add Cruise Seat</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-align-center" aria-hidden="true"></i> Cruise Seat Category</span>
</div>


<div style="padding:10px; width:100%; border-bottom:1px solid #ddd;">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>" style="width:200px;"></td>
    <td style="padding:0px 5px;"> 
      <input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>" /></td>
    <td><button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></td>
  </tr>
</table>

</div>


<div class="nocsstable">
<table class="table">
							<thead>
								<tr>
									<th width="20%"style="padding-left:20px !important;">Name</th>
									<th width="30%"><div align="center">Status</div></th>
									<th width="15%"><div align="center">Update</div></th>
									<th width="10%"><div align="center">Edit</div></th>
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
$rs=GetRecordList('*','sys_CruiseSeatMaster',' where parentId="'.$LoginUserDetails['parentId'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
?>
								<tr>
									<td width="20%" style="padding-left:20px !important;"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td width="30%"><div align="center">
									  <?php if($rest['status']==1){ ?>
									  <span class="badge bg-blue" style="background-color:#0cb5b5;">Active</span>
									  <?php } else { ?>
									  <span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span>
									  <?php } ?>
								    </div></td>
									<td width="15%">									 <div align="center">
									<strong><?php echo getUserName($rest['editBy']); ?></strong><br />

									<?php if($rest['editDate']!='' && $rest['editDate']!='0'){ echo date('d-m-Y h:i A',$rest['editDate']); } else { echo '-'; } ?></div></td>
									
									<td width="10%"><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Cruise Seat',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcruiseseatlibrary&id=<?php echo encode($rest['id']); ?>">
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

 