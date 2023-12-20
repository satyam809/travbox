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
							<div class="list-icons">
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add New</button></a>
		                	</div>
	                	</div>
			  </div>
				<div class="card-body">
				<div style="border: 1px dashed #ddd; background-color: #f9f9f9; padding: 20px; margin-bottom:30px;">
							<h5 class="card-title" id="scrollspy">Tips</h5>
							You can specify the <strong>bold color</strong> text replace values dynamically. Example, If you use #Customer Name# in email template (left hand side box) then it will be replaced by the customer name automatically.<br />
<br />
<strong>#customer_name#</strong> - Customer Name, <strong>#booking_id#</strong> - Booking ID / Invoice ID, <strong>#travel_location#</strong> - Travel Location, <strong>#travel_date#</strong> - Travel Date				</div>
				<?php  
				$no=1;
				$rs=GetPageRecord('*','sys_bookingSetting','  parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
				while($rest=mysqli_fetch_array($rs)){ 
				?> 
				<div class="card" style="margin-bottom:30px;">
					<div class="card-body" style="padding-top:30px;">
					<h5 class="card-title" style="background-color: #e27f05; color: #fff; font-size: 14px; font-weight: 600; padding: 4px; width: 90px; text-align: center; text-transform: uppercase; position: absolute; top: -14px; border-radius: 4px;">Stage <?php echo $no; ?></h5>
					
					
					<a onclick="loadpop('Edit task for stage <?php echo $no; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editbookingtask&id=<?php echo encode($rest['id']); ?>" style="position:absolute; right:10px; top:10px;cursor:pointer;"><button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
					
					<div class="row">
						 <div class="col-md-2">
						
						 <div class="form-group">
									<label>Status</label>
								<div><?php echo getsectionstatus($rest['status']); ?></div>
						   </div>
						 
						 </div>
						  <div class="col-md-2">
						  <div class="form-group">
									<label>Stage <?php echo $no; ?> Name</label>
								<div><strong><?php echo stripslashes($rest['stageName']); ?></strong></div>
						   </div>
						 </div>
						 
						 
						  <div class="col-md-6">
						  <div class="form-group">
									<label>Update</label>
								<div><strong><?php if($rest['editBy']>0){  echo getUserName($rest['editBy']); ?> - <span style="font-size:11px; margin-top:2px; color:#666666;"><?php if($rest['editDate']>0){  echo date('d/m/Y - h:i A',$rest['editDate']); } ?></span><?php } ?></strong></div>
						   </div>
						 </div>
						 
						 <div class="col-md-12" style="color:#FF0000; margin-bottom:20px;">
						 Following tasks will be created AUTOMATICALLY while moving booking to this stage
						 </div>
					 
						  <div class="col-md-4">
						  <div class="form-group">
									<label>Task Name</label>
								<div><strong><?php echo stripslashes($rest['taskName']); ?></strong></div>
						   </div>
						 </div>
						 
						 <div class="col-md-3">
						  <div class="form-group">
									<label>To be completed in</label>
								<div><strong><?php echo stripslashes($rest['taskDateAfter']); ?> hour(s)</strong></div>
						   </div>
						 </div>
						 
						 <div class="col-md-4">
						  <div class="form-group">
									<label>Assign task to</label>
								<div><strong><?php if(getUserName($rest['assignTo'])==''){ echo 'Booking Owner'; } else { echo getUserName($rest['assignTo']); } ?></strong></div>
						   </div>
						 </div>
						 </div>
						 
					</div>
				</div>
				<?php $no++; } ?>
	
				</div>
					

			 
				 
						 	
					  
			  </div>
					
					
		  </div>
			<!-- Icons alignment -->

			 
  </div>
			
</div>




   