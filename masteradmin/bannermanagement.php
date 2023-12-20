<?php  
include "settingheader.php";  
?>


<div class="page-content pt-0" > 
		
<?php  
include "settingleft.php"; 
?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php echo stripslashes($moduleDataName['name']); ?></h5>
						<div class="header-elements">
							<div style="text-align:right;"><a style="cursor:pointer;" onclick="loadpop('Add Banner',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addbannerb2c"><button type="button" class="btn btn-primary btn-sm">Add Banner</button></a></div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
									<th width="5%">Banner </th>
									<th><div align="left">Title</div></th>
									<th><div align="center">URL</div></th>
									<th><div align="center">Type</div></th>
									<th><div align="center">Sequence</div></th>
									<th><div align="center">Status </div></th>
									<th align="right"><div align="center">Date</div></th>
								<th align="right">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','agentBannerMaster','where agentId=0 order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){

if($rest['bannerType']=="flight"){
	$banner="Search Box Bottom Flight";
}else if($rest['bannerType']=="hotel"){
	$banner="Search Box Bottom Hotel";
}else if($rest['bannerType']=="package"){
	$banner="Search Box Bottom Package";
}else if($rest['bannerType']=="weekend_gateway"){
	$banner="Weekend Gateway";
}else if($rest['bannerType']=="bus"){
	$banner="Search Box Bottom Bus";
}else if($rest['bannerType']=="home"){
	$banner="Home Banner";
}else if($rest['bannerType']=="topup"){
	$banner="Top Up Banner";
}else if($rest['bannerType']=="home_popup"){
	$banner="Home Pop Up Banner";
}else if($rest['bannerType']=="login_popup"){
	$banner="Login/Signup Banner";
}
?>
						
<tr>
<td width="5%" align="left" valign="top"><img src="upload/<?php echo $rest['bannerImage']; ?>" style="width:100px; " /></td>
<td align="left" valign="top"><div align="left"><?php echo strip($rest['bannerTitle']); ?></div></td>
<td align="left" valign="top"><div align="center"><a href="<?php echo $rest['bannerURL']; ?>" target="_blank">View</a></div></td>
<td align="left" valign="top"><div align="center"><?php echo $banner; ?></div></td>
<td align="left" valign="top"><div align="center"><?php echo strip($rest['sequence']); ?></div></td>
<td align="left" valign="top">
<div align="center">
  <?php if($rest['status']==1){ ?>
  <span class="badge badge-success">Active</span>
  <?php }else{ ?>
  <span class="badge badge-secondary">Inactive</span>
  <?php } ?>
</div>
</td>

<td align="right" valign="top"><div align="center"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></div></td>

<td align="right" valign="top"><a style="cursor:pointer;" onclick="loadpop('Edit Banner',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addbannerb2c&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
									

								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>	
					 <div class="card-footer text-right">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
			  </div>
					
					
				</div>
			<!-- Icons alignment -->

			 
				</div>
			
</div>




   