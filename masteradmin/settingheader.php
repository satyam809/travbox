<div class="page-header">
<?php if($_REQUEST['ga']=='settings'){ ?>	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Settings</h4> 
			</div> 
		</div>
		
		<?php } else {
		$rs4=GetPageRecord('*','sys_moduleMaster',' pageUrl="'.$_REQUEST['ga'].'" '); 
		$moduleDataName=mysqli_fetch_array($rs4);
		
		?>
		
				<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>display.html?ga=settings"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Settings</span></a> - <?php echo stripslashes($moduleDataName['name']); ?></h4> 
			</div> 
		</div>
		
		
		 
		<?php } ?>
		
	</div>