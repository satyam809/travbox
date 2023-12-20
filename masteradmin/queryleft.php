<div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

			<!-- Sidebar mobile toggler -->
			 
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">
				<div class="card card-sidebar-mobile">
  
					<!-- Main navigation -->
					<div class="card-body p-0" style="">
						<ul class="nav nav-sidebar nav-sidebar-bordered" data-nav-type="accordion">
						<?php if($_REQUEST['add']!=1){ ?><li ><a href="<?php echo $fullurl.'display.html?ga='.$_REQUEST['ga']; ?>&add=1" style="background-color:#26a69a; color:#fff;margin: 5px; border-radius:3px;" class="nav-link  <?php if($_REQUEST['status']==''){ ?> active<?php } ?>"><i class="fa fa-plus" aria-hidden="true" style="color:#fff;margin-top: 5px;"></i> <span style="font-weight: 500;">Create New Query</span></a></li><?php } ?>
						
						<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Query Dashboard</span></a></li>
						 
				<?php
						$rs8=GetPageRecord(' COUNT(id) as totalstatusquery ','queryMaster','   parentId="'.$LoginUserDetails['parentId'].'" '); 
$totalquerylist=mysqli_fetch_array($rs8);
?>
						<li class="nav-item" style="position:relative;"><a href="<?php echo $fullurl.'display.html?ga='.$_REQUEST['ga']; ?>" class="nav-link  <?php if($_REQUEST['status']=='' && $_REQUEST['view']=='' && $_REQUEST['add']==''){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>All Queries</span></a> <span class="badge bg-blue" style="background-color:<?php echo stripslashes($leadstages['bgColor']); ?>;position: absolute; top: 13px; right: 12px;"><?php echo $totalquerylist['totalstatusquery']; ?></span></li>
					
<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">By Query Stages</div> <i class="icon-menu" title="Layout options"></i></li>
							<!-- Main -->
							 
							 <?php 
			
			$rs=GetPageRecord('*','sys_queryStageMaster',' parentId="'.$LoginUserDetails['parentId'].'"  order by id asc'); 
			while($leadstages=mysqli_fetch_array($rs)){
 
			$rs8=GetPageRecord(' COUNT(id) as totalstatusquery ','queryMaster',' status="'.$leadstages['id'].'" and parentId="'.$LoginUserDetails['parentId'].'" '); 
$totalquerylist=mysqli_fetch_array($rs8);
			?>
							<li class="nav-item" style="position:relative;"><a href="<?php echo $fullurl.'display.html?ga='.$_REQUEST['ga']; ?>&status=<?php echo stripslashes($leadstages['id']); ?>&fromdate=<?php echo $fromdate; ?>&todate=<?php echo $todate; ?>&user=<?php echo $_REQUEST['user']; ?>&destination=<?php echo $_REQUEST['destination']; ?>&querysource=<?php echo $_REQUEST['querysource']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" class="nav-link <?php if($_REQUEST['status']==$leadstages['id']){ ?> active<?php } ?>"  style="border-left: 4px solid <?php echo stripslashes($leadstages['bgColor']); ?>;"><span><?php echo stripslashes($leadstages['updatedName']); ?></span></a> <span class="badge bg-blue" style="background-color:<?php echo stripslashes($leadstages['bgColor']); ?>;position: absolute; top: 13px; right: 12px;"><?php echo $totalquerylist['totalstatusquery']; ?></span></li>
							 <?php } ?>
			 
											<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-upload" aria-hidden="true"></i> <span>Import Bulk Queries</span></a></li>
						<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-download" aria-hidden="true"></i> <span>Export Queries</span></a></li>
						</ul>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /sidebar content -->
			
		</div>