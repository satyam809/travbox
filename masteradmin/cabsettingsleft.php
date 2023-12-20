<div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

			<!-- Sidebar mobile toggler -->
			 
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">
				<div class="card card-sidebar-mobile">
  
					<!-- Main navigation -->
					<div class="card-body p-0" style="">
		  
						<div class="card-footer d-flex justify-content-between"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;">Cab Settings</span></div>



                        <ul class="nav nav-sidebar nav-sidebar-bordered" data-nav-type="accordion"> 

<?php if($LoginUserDetails["userType"]=="admin"){ ?>
 <li class="nav-item"><a href="display.html?ga=cabpackage" class="nav-link <?php if($_REQUEST['ga']=='cabpackage'){ ?> active<?php } ?>"><i class="fa fa-car" aria-hidden="true"></i> <span>Cab Packages</span></a></li>
 
  
  <li class="nav-item"><a href="display.html?ga=cab_vehicle" class="nav-link <?php if($_REQUEST['ga']=='cab_vehicle'){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>Cab   vehicle</span></a></li>
 
  <li class="nav-item"><a href="display.html?ga=cab_route" class="nav-link <?php if($_REQUEST['ga']=='cab_route'){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>Cab  Route</span></a></li>
 
 <li class="nav-item"><a href="display.html?ga=cabinclusionexclusion" class="nav-link <?php if($_REQUEST['ga']=='manualflights'){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>Inclusion & Exclusion</span></a></li> 
 <li class="nav-item"><a href="display.html?ga=cabdestination" class="nav-link <?php if($_REQUEST['ga']=='cabdestination'){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>Destination</span></a></li>
 
 
 
  <li class="nav-item"><a href="display.html?ga=vehicle_category" class="nav-link <?php if($_REQUEST['ga']=='vehicle_category'){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>Vehicle Category</span></a></li>
  <li class="nav-item"><a href="display.html?ga=cab_content" class="nav-link <?php if($_REQUEST['ga']=='cab_content'){ ?> active<?php } ?>"><i class="fa fa-list" aria-hidden="true"></i> <span>Cab Display Content</span></a></li>
   
  <?php } ?>
 
					  </ul>
					</div>
					
					
					
					
					<!-- /main navigation -->

				</div>
				
				
			</div>
			 
			<!-- /sidebar content -->
			
		</div>