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
<span  class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" ><a href="display.html?ga=cabpackage&add=1" style="color:#FFFFFF;">Add New </a> </span>

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-car" aria-hidden="true"></i> Cab Packages</span></div>


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

			<th>Package Info</th>

            <th>  Category</th>

            <th>Location</th>

            <th>Km/Day</th>

            <th>Hrs/Day</th>

            <th>Fare</th>

            <th>Other Info</th>

            <th>Status</th>

            <th>Last Update </th>

            <th>&nbsp;</th>

		</tr>

	</thead>

    <tbody>

<?php



$where4='';



if($_REQUEST['keyword']!=''){

$where4.=' and location like "%'.$_REQUEST['keyword'].'%" ';

}



if($_REQUEST['package_category']!=''){

$where4.=' and package_category="'.$_REQUEST['package_category'].'" ';

}



if($_REQUEST['available_for']!=''){

$where4.=' and available_for="'.$_REQUEST['available_for'].'" ';

}



if($_REQUEST['cab_category']!=''){

$where4.=' and cab_category="'.$_REQUEST['cab_category'].'" ';

}



if($_REQUEST['status']!=''){

$where4.=' and status="'.$_REQUEST['status'].'" ';

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

$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&package_category='.$_REQUEST['package_category'].'&available_for='.$_REQUEST['available_for'].'&cab_category='.$_REQUEST['cab_category'].'&status='.$_REQUEST['status'].'&'; 

$rs=GetRecordList('*','cab_packages',' '.$where.' ','25',$page,$targetpage);



$totalentry=$rs[1];

$paging=$rs[2];

while($rest=mysqli_fetch_array($rs[0])){ 



$rs33=GetPageRecord($select,'sys_userMaster','id="'.$rest['addedBy'].'" '); 

$packagecreator=mysqli_fetch_array($rs33);





$rs1=GetPageRecord('*','vehicle_category','id="'.$rest['cab_category'].'"');   

$cabcategory=mysqli_fetch_array($rs1); 

?>



<tr>

  

<td><a <?php if ($LoginUserDetails["id"]==1 || (strpos($LoginUserDetails["permissionAddEdit"], 'cab_packages')) !== false) { ?> href="display.html?ga=cab_packages&add=1&id=<?php echo encode($rest['id']); ?>" <?php } ?>>Category:<?php if($rest['package_category']==1){echo "Local";} if($rest['package_category']==2){echo "Airport Transfer";} if($rest['package_category']==3){echo "Out Station";} ?><br />(<?php if($rest['available_for']==1){echo "One-way";} if($rest['available_for']==2){echo "Round-trip";} if($rest['available_for']==3){echo "Both";} ?>)</a></td>

  

	<td><?php echo $cabcategory['name']; ?></td>

	

	<td><?php echo $rest['location']; ?></td>

	<td><?php echo $rest['min_klm_per_day']; ?></td>

	<td><?php echo $rest['min_hrs_per_day']; ?></td>

	<td><strong>&#8377;<?php echo $rest['tariff_cost']; ?></strong> / Day</td>

	

	<td>Per Extra Kms Charges: <?php echo $rest['extra_per_klm_charges']; ?><br />Per Extra Hrs Charges: <?php echo $rest['extra_charges_per_hrs']; ?><br />Night Allowance: <?php echo $rest['night_shift_allowence']; ?><br />Driver Allowance: <?php echo $rest['driver_allowance']; ?></td>



	<td><?php if($rest['status']==1){ ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Inactive</span><?php } ?></td>



	<td><?php echo stripslashes($packagecreator['firstName']); ?> <?php echo stripslashes($packagecreator['lastName']); ?><div style="margin-top:4px; color:#666666; font-size:12px;"><?php echo date('d/m/Y h:i A',strtotime($rest['dateAdded'])); ?></div></td>

	

	<td>

	<?php if ($LoginUserDetails["id"]==1 || (strpos($LoginUserDetails["permissionAddEdit"], 'cab_packages')) !== false) { ?>

	 <a class="dropdown-item" href="display.html?ga=cabpackage&add=1&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-secondary btn-sm" >Edit</button></a>

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

 