<?php include "settingheader.php"; ?>


<div class="page-content pt-0">


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
 <div class="card">
				
				<div class="card-body">
 <div class="row">
 
			<?php 
$permissionView = explode(',',$LoginUserDetails["permissionView"]);
			$rs=GetPageRecord('*','sys_moduleMaster',' parentId=13  order by srNo asc'); 
			while($moduleData=mysqli_fetch_array($rs)){
			?>
					 
					<div class="col-xl-3">
 
				<div class="sidebar sidebar-light sidebar-component position-static w-100 d-block mb-md-3">
				<div class="card-header bg-white header-elements-inline">
								<h6 class="card-title"><?php echo stripslashes($moduleData['pageIcon']); ?> &nbsp;<?php echo stripslashes($moduleData['name']); ?></h6> 
							</div>
				<div class="card-body" style="min-height: 325px;">
				
				<ul class="nav nav-sidebar" data-nav-type="accordion"> 
											
				<?php 
			
			$rs3=GetPageRecord('*','sys_moduleMaster',' parentId="'.$moduleData['id'].'"  order by srNo asc'); 
			while($moduleDataUnder=mysqli_fetch_array($rs3)){
			?>
			
<?php if((in_array($moduleDataUnder["id"], $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
			<li class="nav-item">
			<a href="<?php echo $fullurl; ?>display.html?ga=<?php echo strip($moduleDataUnder['pageUrl']); ?>" class="nav-link">
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i>
			<?php echo stripslashes($moduleDataUnder['name']); ?>
			</a>
			</li>
<?php } ?>

			
			<?php } ?>
			
			</ul>
				</div>
				
</div>
						
						</div>
				 <?php } ?>
			 
						</div>

</div></div>

</div></div>

</div>