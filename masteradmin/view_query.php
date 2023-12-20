<?php 
if($_REQUEST['id']!=''){
$rs5=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 
$rest=mysqli_fetch_array($rs5);
}


$rs7=GetPageRecord('*','sys_queryStageMaster',' parentId="'.$LoginUserDetails['parentId'].'" order by id asc '); 
$queryStageres=mysqli_fetch_array($rs7);


$a=GetPageRecord('count(id) as totalquotation','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and queryId="'.$rest['id'].'"  and archiveStatus=0'); 
$totalquotation=mysqli_fetch_array($a);

$ab=GetPageRecord('count(id) as totalarchivequotation','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and queryId="'.$rest['id'].'"  and archiveStatus=1'); 
$totalarchivequotation=mysqli_fetch_array($ab);
?>
  <style>
  .querystagestag{padding:10px 5px; text-align:center; color:#333333; font-size:12px; font-weight:500;border-radius: 100px;} 
  .querystagestag:hover{background-color:#F7F7F7;}
  </style>
	<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4 style="font-weight:500;"><a href="<?php echo $fullurl; ?>display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">All Queries</span></a> - #<?php echo encode($rest['id']); ?></h4> 
			</div>  
	  </div>
</div>

 <div class="page-content pt-0">
<?php include "queryleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">
 
			<!-- Content area -->
			<div class="content">
			<div class="row">
			
	<div class="col-md-9">		
 <div class="card">
				 
				<div class="card-body"  style="padding-bottom:0px;">
 
					 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="middle"><div style=" width:80px; height:80px; overflow:hidden; margin-right:20px;border-radius: 100%;"><img src="assets/<?php if($rest['queryType']==1){ ?>b2cuser.png<?php } else { ?>b2bcuser.png<?php } ?>" style="width:100%; height:100%; min-height:100%;" /></div></td>
    <td width="95%" align="left" valign="middle" style="position:relative;">
	<div class="btn-group" style="position:absolute; right:0px; top:0px;">
									<a href="#"><button type="button" class="btn btn-light" data-toggle="tooltip" data-html="true" title="Add Task"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></button></a>
									<a href="https://api.whatsapp.com/send?text=Hi&phone=91<?php echo stripslashes($rest['contactNumber']); ?>" target="_blank"><button type="button" class="btn btn-light"  data-toggle="tooltip" data-html="true" title="WhatsApp"><i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 16px;"></i></button></a>
									<a href="#"><button type="button" class="btn btn-light"  data-toggle="tooltip" data-html="true" title="Send Mail"><i class="fa fa-envelope-o" aria-hidden="true"></i></button></a>
									
									<a href="display.html?ga=query&add=1&id=<?php echo $_REQUEST['id']; ?>"><button type="button" class="btn btn-light"  data-toggle="tooltip" data-html="true" title="Edit Query"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
					</div>
	
	<h5 style="font-weight:500; padding-bottom: 0px;margin-bottom: 0px;"><?php if($rest['queryType']==1){ echo stripslashes($rest['nameHead'].' '.$rest['contactPerson']);  } else { echo stripslashes($rest['companyName']); } ?> - <span style="font-size:12px;color:#999999;"><?php echo getquerytypename($rest['queryType']); ?></span></h5>
	
	<?php  if($rest['queryType']!=1){ ?><div style="font-size:13px; font-weight:400; margin-bottom:1px;"><span style="color:#999999;">Contact Person:</span> <?php echo stripslashes($rest['nameHead'].' '.$rest['contactPerson']); ?></div><?php } ?>
	<div style="font-size:13px; font-weight:400; margin-bottom:1px;"><span style="color:#999999;"><i class="fa fa-phone" aria-hidden="true"></i></span> &nbsp;<?php echo stripslashes($rest['contactNumber']); ?></div>
	<div style="font-size:13px; font-weight:400; margin-bottom:1px;"><span style="color:#999999;"><i class="fa fa-envelope" aria-hidden="true"></i></span> &nbsp;<?php echo stripslashes($rest['contactEmail']); ?></div>
	<div style="padding-top:5px; margin-top:5px; border-top:1px solid #eaeaea;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span>&nbsp;<?php echo getCityName($rest['contactCity']); ?>, <?php echo getStateName($rest['contactState']); ?>, <?php echo getCountryName($rest['contactCountry']); ?></div>
	 
	</td>
  </tr>
</table>
	 
						 
		</div>
		
		<hr />
	
		
		<div class="row">
		<?php if($rest['closureReasons']>0){ ?>
		<div class="card-body" style="padding-top:0px; width:100%;">
			<div class="alert bg-danger text-white alert-styled-left alert-dismissible"> 
									<?php  echo getquerycloserReasons($rest['closureReasons']); ?>
							    </div>
		</div>
		<?php } ?>
		
		<div class="col-md-6">	
		
		
		<div class="card-body" style="padding-top:0px;padding-bottom:0px;">
		
		
		
		
		<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">From City</td>
    <td align="left" style=" padding-bottom:10px; font-weight:500;"><?php echo getDestination($rest['travelFromCity']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:20px; padding-bottom:10px;color:#999999;">Travel Location</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getDestination($rest['travelLocation']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Start Date</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo date('d-m-Y', strtotime($rest['startDate'])); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">End Date</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Travellers</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo stripslashes($rest['adult']); ?> <span style="color:#7d7d7d; font-size:11px;">Adult</span> <?php echo stripslashes($rest['child']); ?> <span style="color:#7d7d7d; font-size:11px;">Clild</span> <?php echo stripslashes($rest['infant']); ?> <span style="color:#7d7d7d; font-size:11px;">Infant</span></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Query Source</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getquerysourcename($rest['querySource']); ?></td>
  </tr>
</table>

		</div>
		</div>
		<div class="col-md-6">	
		<div class="card-body" style="padding-top:0px;padding-bottom:0px;">
		<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" style="padding-right:20px; padding-bottom:10px;color:#999999;">Query ID</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500; color:#2196f3;">#<?php echo encode($rest['id']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:20px; padding-bottom:10px;color:#999999;">Query Priority</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><span class="badge bg-blue" <?php if($rest['queryPriority']==1){ ?>style=" background-color:#dc0808;"<?php } ?>><?php if($rest['queryPriority']==1){ echo 'Hot Query'; } else { echo 'General Query'; } ?></span></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Assign To</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getUserName($rest['assignTo']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:20px; padding-bottom:10px;color:#999999;">Requirement</td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><div class="blueicons">
<?php if($rest['typePackage'] ==1){ ?><i class="fa fa-suitcase" aria-hidden="true" title="Package"></i><?php } ?>
<?php if($rest['typeFlight'] ==1){ ?><i class="fa fa-plane" aria-hidden="true" title="Flight"></i><?php } ?>
<?php if($rest['typeTransfer'] ==1){ ?><i class="fa fa-car" aria-hidden="true" title="Transfer"></i><?php } ?>
<?php if($rest['typeHotel'] ==1){ ?><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i><?php } ?> 
<?php if($rest['typeSightseeing'] ==1){ ?><i class="fa fa-picture-o" aria-hidden="true" title="Sightseeing"></i><?php } ?> 
<?php if($rest['typeMiscellaneous'] ==1){ ?><i class="fa fa-cubes" aria-hidden="true" title="Miscellaneous"></i><?php } ?>
 </div></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Created By </td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo getUserName($rest['addBy']); ?></td>
  </tr>
  <tr>
    <td align="left" style="padding-right:10px; padding-bottom:10px;color:#999999;">Created Date </td>
    <td align="left" style="padding-bottom:10px;  font-weight:500;"><?php echo showdatetimesimple($rest['addDate']); ?></td>
  </tr>
</table>
		</div>
		</div>
		</div>
		 	
		
		<hr />
		
				<div class="card-body" style="padding-top:0px;padding-bottom:0px;">
				<i class="fa fa-clock-o" aria-hidden="true" style="color:#999999;"></i> <?php if($rest['editBy']>0){ ?>&nbsp; This query last updated by <?php echo getUserName($rest['editBy']); ?> - <?php if($rest['editDate']!='' && $rest['editDate']!='0000-00-00 00:00:00'){ echo showdatetimesimple($rest['editDate']); } else { echo '-'; } ?><?php } else { ?>&nbsp;This query don't have any updation till now<?php } ?>
				</div>
				<hr style="margin-bottom: 10px;" />
				
				<div class="card-body" style="padding-top:0px; padding:10px; margin-bottom:10px;">
				<div style=" border: 3px solid #eaeaea; border-radius: 100px; overflow:hidden;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>

    <?php  
		$rs=GetPageRecord('*','sys_queryStageMaster',' parentId="'.$LoginUserDetails['parentId'].'"  order by id asc'); 
		while($querystages=mysqli_fetch_array($rs)){ 
		?>
		<td><div class="querystagestag" <?php if($querystages['id']!=$rest['status']){ ?> onclick="loadpop('Change Query Status To (<?php echo stripslashes($querystages['updatedName']); ?>)',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=changequerystatus&id=<?php echo encode($rest['id']); ?>&status=<?php echo encode($querystages['id']); ?>&statusname=<?php echo str_replace(' ','%20',stripslashes($querystages['updatedName'])); ?>&statusname2=<?php echo str_replace(' ','%20',stripslashes($querystages['name'])); ?>"<?php } ?> 
		
		style=" <?php if($querystages['id']==$rest['status']){ ?> background-color:<?php echo $querystages['bgColor']; ?>; color:#fff;<?php } else { ?> cursor:pointer;<?php } ?>"><?php echo stripslashes($querystages['updatedName']); ?></div></td>
		<?php } ?>
  </tr>
</table>

				</div>
				</div>
				
				
				
		
		</div>
		
		
		
		
		 <div class="card">
				 <div class="card-footer d-flex justify-content-between">
							<span class="text-muted" style="font-weight:500; color:#000000 !important;">Quotation</span>

								<ul class="list-inline mb-0">
									<li class="list-inline-item" style="cursor: pointer; position: absolute; top: 8px; right: 8px;"><a style="cursor:pointer;" onclick="loadpop('Select Quotation Type',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addquotation&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-primary btn-icon btn-sm" style="background-color:#26a69a;">+ Add Quotation</button></a></li> 
								</ul>
			</div>
			<div class="card-body">
								<ul class="nav nav-tabs nav-tabs-highlight mb-0">
									<li class="nav-item"><a href="#bordered-tab1" class="nav-link active show" data-toggle="tab">Active <span class="badge badge-success badge-pill mr-2"><?php echo $totalquotation['totalquotation']; ?></span></a></li>
									<li class="nav-item"><a href="#bordered-tab2" class="nav-link" data-toggle="tab">Archive <span class="badge bg-slate badge-pill"><?php echo $totalarchivequotation['totalarchivequotation']; ?></span></a></li>
									 
								</ul>

								<div class="tab-content card card-body border-top-0 rounded-top-0 mb-0" style="padding: 5px; padding-top: 15px;">
									<div class="tab-pane fade active show" id="bordered-tab1">
									<?php  
									$d=1; 
									$ha=GetPageRecord('*','quotationMaster','  queryId="'.$rest['id'].'" and parentId="'.$LoginUserDetails['parentId'].'" and archiveStatus=0 order by id desc');
									while($listdata=mysqli_fetch_array($ha)){ 
									?>
										 <div style="border-bottom:1px solid #ddd;">
										 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%" style="padding:5px;"><div style="width:100px; height:70px; overflow:hidden; border:1px solid #fff; border-radius: 4px;"><img src="<?php if($listdata['bannerImg']!=''){ echo 'upload/'.stripslashes($listdata['bannerImg']); } else { ?>assets/nobannerblue.png<?php } ?>"  style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td width="5%" style="padding:5px;"><div style="font-size:14px; width:250px; font-weight:500; margin-bottom:2px;"><a href="#" onclick="loadpop('View Quotation - #QT<?php echo encode($listdata['id']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo encode($listdata['id']); ?>"><?php if($listdata['name']!=''){ echo stripslashes($listdata['name']); } else { echo 'Untitled'; } ?></a></div>
	  <div style="color:#666666; font-size:12px;">ID: <span style="color:#333333; font-weight:500;">#QT<?php echo encode($listdata['id']); ?></span></div>
	  
	  <div style="color:#666666; font-size:11px;"><span style="color:#333333; font-weight:500;"><?php echo showdatetimesimple($listdata['addDate']); ?></span></div>	</td>
    <td style="padding:5px;">
 <?php if($listdata['quotationType']=='Quick Package' || $listdata['quotationType']=='Detailed Package'){?>
	 <div style="  width:120px;">
			<?php 
			$kk=1;  
			$option=GetPageRecord('*','sys_quickPackageOptions','  quotationId="'.$listdata['id'].'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
			while($listdataoption=mysqli_fetch_array($option)){ 
			?>
	 
	 <div style="font-size: 11px; margin-top: 2px; font-weight: 500; border: 1px solid #ddd; padding: 1px 5px; border-radius: 4px; margin-right: 4px; background-color: #f5f5f5;"><span style="font-size:11px; color:#666666;">OPT. <?php echo $kk; ?>:</span> <?php echo $listdataoption['quotationCostWithTax']; ?> <?php echo currencyname($listdataoption['currencyId']); ?></div>
	 
	 <?php $kk++; }  ?>
	 </div>
		 <?php  } else { ?>
		 
		 <div style="  width:120px;"> 
			<?php 
			$kk=1;  
			$option=GetPageRecord('*','quotationEvents','  quotationId="'.$listdata['id'].'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
			while($listdataoption=mysqli_fetch_array($option)){ 
			?>
	 
	 <div style="font-size: 11px; margin-top: 2px; font-weight: 500; border: 1px solid #ddd; padding: 1px 5px; border-radius: 4px; margin-right: 4px; background-color: #f5f5f5;"><span style="font-size:11px; color:#666666;">OPT. <?php echo $kk; ?>:</span> <?php echo $listdataoption['quotationCostWithTax']; ?> <?php echo currencyname($listdataoption['currencyId']); ?></div>
	 
	 <?php $kk++; }  ?>
	 </div>
		 <?php } ?>
		 	</td>
    <td width="20%" align="center" style="padding:5px;">
	<?php if($listdata['status']==1){?><span class="badge badge-primary">Created</span><?php } ?>
	<?php if($listdata['status']==2){?><span class="badge badge-warning">Sent</span><?php } ?>
	<?php if($listdata['status']==3){?><span class="badge badge-success">Confirmed</span><?php } ?>
	<div style="color:#666666; margin-top:2px; font-size:11px;"><?php echo  $listdata['quotationType']; ?></div>	</td>
    <td width="5%" align="right" style="padding:5px;"><div class="list-icons">
							<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">
															
<a style="cursor:pointer;"  class="dropdown-item"  onclick="loadpop('View Quotation - #QT<?php echo encode($listdata['id']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo encode($listdata['id']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
									 

<a target="_blank" href="https://v2.api2pdf.com/chrome/pdf/url?url=<?php echo $fullurl; ?>quotationpreview/<?php echo encode($listdata['id']); ?>/<?php echo seo_friendly_url($listdata['name']); ?>/pdf&apikey=e196cd2c-d5d2-467b-b99b-3ad60f24c20e" class="dropdown-item"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
															
							<a href="display.html?ga=quotation&add=1&id=<?php echo  encode($listdata['id']); ?>" class="dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
															<a  style="cursor:pointer; "onclick="loadpop('Send Quotation - #QT<?php echo encode($listdata['id']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendquotation&id=<?php echo encode($listdata['id']); ?>" class="dropdown-item"><i class="fa fa-envelope" aria-hidden="true"></i> Send Quotation</a>
															
															<a href="https://wa.me/<?php if($rest['countryCode']==''){ echo '+91'; } else { echo $rest['countryCode']; } ?><?php echo stripslashes($rest['contactNumber']); ?>?text=Hi <?php if($rest['queryType']==1){ echo stripslashes($rest['nameHead'].' '.$rest['contactPerson']);  } else { echo stripslashes($rest['companyName']); } ?>, 
															
															<?php if($listdata['quotationType']=='Quick Package'){ ?>Please click the link to view your itinerary.<?php } else { ?>Please click the link to view quotation.<?php } ?> <?php echo $fullurl.'quotationpreview/'.encode($listdata['id']).'/'.seo_friendly_url($listdata['name']); ?>" target="_blank" class="dropdown-item"><i class="fa fa-whatsapp" aria-hidden="true"></i> Share By WhatsApp</a>
															
												 
															<a href="actionpage.php?action=movetoArchive&id=<?php echo  encode($listdata['id']); ?>&qid=<?php echo $_REQUEST['id']; ?>" class="dropdown-item" target="actoinfrm"><i class="fa fa-archive" aria-hidden="true"></i> Archive </a>
													 
															
															 
							  </div>
													</div>
						</div></td>
    </tr>
</table>
										</div>	
									<?php $d++; } ?>
							<?php if($d==1){ ?>
							<div style="text-align:center; font-size:14px; color:#666666; padding:30px 0px;">No Quotation</div>
							<?php } ?>
									</div>

									<div class="tab-pane fade" id="bordered-tab2">
												<?php  $d=1;  
									$ha=GetPageRecord('*','quotationMaster','  queryId="'.$rest['id'].'" and parentId="'.$LoginUserDetails['parentId'].'"  and archiveStatus=1 order by id desc');
									while($listdata=mysqli_fetch_array($ha)){ 
									?>
										 <div style="border-bottom:1px solid #ddd;">
										 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%" style="padding:5px;"><div style="width:100px; height:70px; overflow:hidden; border:1px solid #fff;"><img src="<?php if($listdata['bannerImg']!=''){ echo 'upload/'.stripslashes($listdata['bannerImg']); } else { ?>assets/nobannerblue.png<?php } ?>"  style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td style="padding:5px;"><div style="font-size:14px; font-weight:500; margin-bottom:2px;"><a  style="cursor:pointer;" onclick="loadpop('View Quotation - #QT<?php echo encode($listdata['id']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo encode($listdata['id']); ?>"><?php if($listdata['name']!=''){ echo stripslashes($listdata['name']); } else { echo 'Untitled'; } ?></a></div>
	  <div style="color:#666666; font-size:12px;">ID: <span style="color:#333333; font-weight:500;">#QT<?php echo encode($listdata['id']); ?></span></div>
	  
	  <div style="color:#666666; font-size:11px;"><span style="color:#333333; font-weight:500;"><?php echo showdatetimesimple($listdata['addDate']); ?></span></div>	</td>
    <td style="padding:5px;">
	 <?php if($listdata['quotationType']=='Quick Package' || $listdata['quotationType']=='Detailed Package'){?>
	 <div style="  width:120px;">
			<?php 
			$kk=1;  
			$option=GetPageRecord('*','sys_quickPackageOptions','  quotationId="'.$listdata['id'].'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
			while($listdataoption=mysqli_fetch_array($option)){ 
			?>
	 
	 <div style="font-size: 11px; margin-top: 2px; font-weight: 500; border: 1px solid #ddd; padding: 1px 5px; border-radius: 4px; margin-right: 4px; background-color: #f5f5f5;"><span style="font-size:11px; color:#666666;">OPT. <?php echo $kk; ?>:</span> <?php echo $listdataoption['quotationCostWithTax']; ?> <?php echo currencyname($listdataoption['currencyId']); ?></div>
	 
	 <?php $kk++; }  ?>
	 </div>
		 <?php  } else { ?>
		 
		 <div style="  width:120px;"> 
			<?php 
			$kk=1;  
			$option=GetPageRecord('*','quotationEvents','  quotationId="'.$listdata['id'].'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
			while($listdataoption=mysqli_fetch_array($option)){ 
			?>
	 
	 <div style="font-size: 11px; margin-top: 2px; font-weight: 500; border: 1px solid #ddd; padding: 1px 5px; border-radius: 4px; margin-right: 4px; background-color: #f5f5f5;"><span style="font-size:11px; color:#666666;">OPT. <?php echo $kk; ?>:</span> <?php echo $listdataoption['quotationCostWithTax']; ?> <?php echo currencyname($listdataoption['currencyId']); ?></div>
	 
	 <?php $kk++; }  ?>
	 </div>
		 <?php } ?>
		 
		 
		 
		 	</td>
    <td align="center" style="padding:5px;">
	<?php if($listdata['status']==1){?><span class="badge badge-primary">Created</span><?php } ?>
	<?php if($listdata['status']==2){?><span class="badge badge-warning">Sent</span><?php } ?>
	<?php if($listdata['status']==3){?><span class="badge badge-success">Confirmed</span><?php } ?>
	<div style="color:#666666; margin-top:2px; font-size:11px;"><?php echo  $listdata['quotationType']; ?></div>	</td>
    <td style="padding:5px;"><div style="color:#666666; font-size:11px;">Update: <span style="color:#333333; font-weight:500;"><?php if($rest['editDate']!='' && $rest['editDate']!='0000-00-00 00:00:00'){ echo showdatetimesimple($rest['editDate']); } else { echo '-'; } ?></span></div></td>
    <td align="right" style="padding:5px;"><div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">
															
															<a href="#" class="dropdown-item" onclick="loadpop('View Quotation - #QT<?php echo encode($listdata['id']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo encode($listdata['id']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
									 
															
															<a href="actionpage.php?action=movetoUnarchive&id=<?php echo  encode($listdata['id']); ?>&qid=<?php echo $_REQUEST['id']; ?>" class="dropdown-item" target="actoinfrm"><i class="fa fa-archive" aria-hidden="true"></i>Unarchiver </a>
														 
									 
														</div>
													</div>
												</div></td>
    </tr>
</table>
										</div>
									<?php $d++; } ?>
									<?php if($d==1){ ?>
									<div style="text-align:center; font-size:14px; color:#666666; padding:30px 0px;">No Quotation</div>
									<?php } ?>
									</div>

									 

									 
								</div>
							</div>
				
		</div>
		
		 
		</div>
		
		<div class="col-md-3">	
		
		<div class="card">
				 <div class="card-footer d-flex justify-content-between">
							<span class="text-muted" style="font-weight:500; color:#000000 !important;">Notes</span>

								<ul class="list-inline mb-0">
									<li class="list-inline-item"><a style="cursor:pointer;" onclick="loadpop('Add Note',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addquerynote&id=<?php echo encode($rest['id']); ?>">+ Add Note</a></li> 
								</ul>
			</div>
				<div class="card-body">
 
					<div style="max-height:300px; overflow:auto;">
					<?php 
					$nc=1; 
			$a=GetPageRecord('*','queryNote',' parentId="'.$LoginUserDetails['parentId'].'" and queryId="'.$rest['id'].'"  order by id desc'); 
			while($listlogs=mysqli_fetch_array($a)){ 
			?>
<div style="padding:10px; background-color: #fff; border: 1px solid #ececec; margin-bottom: 5px; font-size:12px; margin-top: 2px; border-radius: 4px;"><i class="fa fa-sticky-note" aria-hidden="true" style="color:#ffa500;"></i> &nbsp;&nbsp;<?php echo stripslashes($listlogs['comment']); ?><div style="color:#999999; font-size:11px; margin:2px 0px 0px 18px;"><?php echo getUserName($listlogs['addBy']); ?> - <?php echo date('d/m/Y h:i A',strtotime($listlogs['addDate'])); ?></div></div>


<?php $nc++;} ?>
<?php if($nc==1){ ?>
<div style="text-align:center; color:#999999;">No Note</div>
<?php } ?>
					</div>	 
						
			 
		</div> 	
		
		</div>
		
		
		<div class="card">
				 <div class="card-footer d-flex justify-content-between">
								<span class="text-muted" style="font-weight:500; color:#000000 !important;">Timeline</span>

								 
							</div>
				<div class="card-body">
 
					<div style="max-height:300px; overflow:auto;">
					<?php  
			$a=GetPageRecord('*','sys_userLogs',' parentId="'.$LoginUserDetails['parentId'].'" and sectionId="'.$rest['id'].'"  order by id desc'); 
			while($listlogs=mysqli_fetch_array($a)){ 
			?>
<div style="margin-bottom:5px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" style="font-size:12px;"><i class="fa fa-arrow-up" aria-hidden="true" style="font-size:15px; color:#03a9f4;"></i></td>
    <td width="90%" style="font-size:12px; padding-bottom:3px; border-bottom:1px dashed #ddd;"><?php echo stripslashes($listlogs['details']); ?>
	<?php if($listlogs['comment']!=''){ ?>
	<div style="padding: 5px; background-color: #fafafa; border: 1px solid #ececec; margin-bottom: 5px; font-size: 12px; margin-top: 2px; border-radius: 4px; color: #7d7d7d;"><i class="fa fa-comment" aria-hidden="true" style="color:#FF6600;"></i> &nbsp;<?php echo stripslashes($listlogs['comment']); ?></div>
	<?php } ?>
	
	<div style="color:#999999; font-size:11px; margin:2px 0px 5px;"><?php echo getUserName($listlogs['userId']); ?> - <?php echo date('d/m/Y h:i A',$listlogs['addDate']); ?></div></td>
  </tr>
</table>
</div>

<?php } ?>
					</div>	 
						
			 
		</div> 	
		
		</div>
		 
		 

</div>





</div>

</div></div>

 
</div>
     
	
 
 
 