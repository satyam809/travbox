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
	
<?php include "flightsettingsheader.php"; ?>

<div class="page-content pt-0">
<?php include "flightsettingsleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">

<form action="" method="get" enctype="multipart/form-data" name="addeditfrm"  > 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span onclick="loadpop('Agent Type',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcommissiontype" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add Type</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-th-large" aria-hidden="true"></i> Agent Group</span>
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
								  <th style="padding-left:20px !important;">Name</th>
								  <th><div align="center">Markup </div></th>
								  <th><div align="center">Block Flights </div></th>
								  <th><div align="center">Offline Flight </div></th>
									<th>Update Date</th>
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
$rs=GetRecordList('*','sys_commissionType',' where parentId="'.$_SESSION['userid'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
 $a=GetPageRecord('count(id) as totalflightsgroup','fareTypedomesticFlightsMarkupMaster',' agentTypeGroupId="'.($rest['id']).'"  ');  
$editresultgroup=mysqli_fetch_array($a); 

 $a=GetPageRecord('count(id) as totalflightsgroupblock','fareTypeblockFlightMaster',' agentTypeGroupId="'.($rest['id']).'"  ');  
$editresultgroup2=mysqli_fetch_array($a); 

 $abc=GetPageRecord('count(id) as totalflightsgroup','fareTypeofflineflightsbookingMaster',' agentTypeGroupId="'.($rest['id']).'"  ');  
$editresultgroup3=mysqli_fetch_array($abc); 
 
?>
								<tr>
								  <td style="padding-left:20px !important;"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td>									 <div align="center">									  

								  <a href="display.html?ga=domesticflightsmarkup&typeid=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-light btn-sm" style="  background-color: #0cb5b5; color:#fff; font-weight:700;"> &nbsp;<i class="fa fa-list" aria-hidden="true"></i> Markup Group (<?php echo $editresultgroup['totalflightsgroup']; ?>)</button></a> </div></td>
									
									<td>									  
									  
									  <div align="center"><a href="display.html?ga=blockflights&typeid=<?php echo encode($rest['id']); ?>">
								      <button type="button" class="btn btn-light btn-sm" style="  background-color:#CC0033; color:#fff; font-weight:700;"> &nbsp;<i class="fa fa-list" aria-hidden="true"></i> Block Group (<?php echo $editresultgroup2['totalflightsgroupblock']; ?>)</button>
							      </a> </div></td>
									<td>
									
									  <div align="center"><a href="display.html?ga=offlineflightsbooking&typeid=<?php echo encode($rest['id']); ?>">
									    <button type="button" class="btn btn-light btn-sm" style="  background-color:#0099CC; color:#fff; font-weight:700;"> &nbsp;<i class="fa fa-list" aria-hidden="true"></i> Offline Group (<?php echo $editresultgroup3['totalflightsgroup']; ?>)</button>
							      </a> </div></td>
									<td><?php if($rest['editDate']!='' && $rest['editDate']!='0'){ echo date('d-m-Y h:i A',strtotime($rest['editDate'])); } else { echo '-'; } ?></td>
									<td><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Agent Type',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcommissiontype&id=<?php echo encode($rest['id']); ?>">
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

 