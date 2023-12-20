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
<?php include "cabsettingsleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">

<form action="" method="get" enctype="multipart/form-data" name="addeditfrm"  > 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span  class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;"   onclick="loadpop('Add Destination',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcabDestination">Add New</span>

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-list" aria-hidden="true"></i> Destination</span></div>


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
<table class="table table-hover mb-0">



                                            <thead>

                                                <tr>

													<th>Name</th>

                                                  <th>Status</th>

                                                  <th width="20%">Last Update </th>

                                                  <th width="10%">&nbsp;</th>

                                                </tr>

                                            </thead>

                                            <tbody>

<?php

 

$where4='';

if($_REQUEST['keyword']!=''){

$where4=' and name like "%'.$_REQUEST['keyword'].'%" ';

}





$totalno='1';

$select='';

$where='';

$rs=''; 

$select='*'; 

$wheremain=''; 

$where=' where 1 '.$where4.'  order by id desc'; 

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 

$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 

$rs=GetRecordList('*','destination',' '.$where.' ','25',$page,$targetpage);



$totalentry=$rs[1];

$paging=$rs[2];

while($rest=mysqli_fetch_array($rs[0])){ 



$rs33=GetPageRecord($select,'sys_userMaster','id="'.$rest['addedBy'].'" '); 

$packagecreator=mysqli_fetch_array($rs33);



?>



<tr>

  

  <td><a class="dropdown-item" style="cursor:pointer; font-weight:600; background-color:transparent;" <?php if ($LoginUserDetails["id"]==1 || (strpos($LoginUserDetails["permissionAddEdit"], 'destination')) !== false) { ?> onclick="loadpop('Update Destination',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcabDestination&id=<?php echo encode($rest['id']); ?>" <?php } ?>><?php echo stripslashes($rest['name']); ?></a></td>



	<td><?php if($rest['status']==1){ ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Inactive</span><?php } ?></td>



	<td width="20%"><?php echo stripslashes($packagecreator['firstName']); ?> <?php echo stripslashes($packagecreator['lastName']); ?>
	  <div style="margin-top:4px; color:#666666; font-size:12px;"><?php echo date('d/m/Y h:i A',strtotime($rest['dateAdded'])); ?></div></td>

	

	<td width="10%">

	<?php if ($LoginUserDetails["id"]==1 || (strpos($LoginUserDetails["permissionAddEdit"], 'destination')) !== false){ ?>

		<a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop('Edit Destination',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcabDestination&id=<?php echo encode($rest['id']); ?>">
		<button type="button" class="btn btn-secondary btn-sm" >Edit</button></a>

	<?php }else{echo "**"; } ?>

	</td>



</tr>



<?php $totalno++; } ?>

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

 