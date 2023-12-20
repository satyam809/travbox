<div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

			<!-- Sidebar content -->
			<div class="sidebar-content">
				<div class="card card-sidebar-mobile">
  
					<!-- Main navigation -->
					<div class="card-body p-0" style="">
		  
						<div class="card-footer d-flex justify-content-between"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;">Flight Settings</span>
</div>



<ul class="nav nav-sidebar nav-sidebar-bordered" data-nav-type="accordion"> 
<li class="nav-item"><a href="display.html?ga=fixeddeparture" class="nav-link <?php if($_REQUEST['ga']=='fixeddeparture'){ ?> active<?php } ?>"><i class="fa fa-plane" aria-hidden="true"></i> <span>Fixed Departure</span></a></li>
	<li  class="nav-item"><a href="display.html?ga=manualflights" class="nav-link <?php if($_REQUEST['ga']=='manualflights'){ ?> active<?php } ?>"><i class="fa fa-plane" aria-hidden="true"></i> <span>Manual Flights</span></a></li>
 

<?php if((in_array("fixeddeparture", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
						<li style="display:none;" class="nav-item"><a href="display.html?ga=fixeddeparture" class="nav-link <?php if($_REQUEST['ga']=='fixeddeparture'){ ?> active<?php } ?>"><i class="fa fa-plane" aria-hidden="true"></i> <span>Fixed Departure</span></a></li>
<?php } ?>

<?php if((in_array("offlineflightsbooking", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>	
						<li class="nav-item" style="display:none;"><a href="display.html?ga=offlineflightsbooking" class="nav-link <?php if($_REQUEST['ga']=='offlineflightsbooking'){ ?> active<?php } ?>"><i class="fa fa-plane" aria-hidden="true"></i><span>Offline Flight Booking</span></a></li> 
<?php } ?>
<?php if((in_array("domesticflightsmarkup", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
						<li class="nav-item"><a href="display.html?ga=domesticflightsmarkup" class="nav-link <?php if($_REQUEST['ga']=='domesticflightsmarkup'){ ?> active<?php } ?>" style="display:none;"><i class="fa fa-percent" aria-hidden="true"></i> <span>Markup</span></a></li>
<?php } ?>	 
<?php if((in_array("domesticflightscommission", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>			
 <li class="nav-item"><a href="display.html?ga=domesticflightscommission" style="display:none;" class="nav-link <?php if($_REQUEST['ga']=='domesticflightscommission'){ ?> active<?php } ?>"><i class="fa fa-percent" aria-hidden="true"></i><span>Agent Commission</span></a></li> 
<?php } ?>

<?php if((in_array("blockflights", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
						<li class="nav-item" style="display:none;"><a href="display.html?ga=blockflights" class="nav-link <?php if($_REQUEST['ga']=='blockflights'){ ?> active<?php } ?>"><i class="fa fa-ban" aria-hidden="true"></i> <span>Block Flights</span></a></li>
<?php } ?>

<?php if((in_array("commissiontype", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>			
 <li class="nav-item"><a href="display.html?ga=commissiontype" class="nav-link <?php if($_REQUEST['ga']=='commissiontype'){ ?> active<?php } ?>"><i class="fa fa-th-large" aria-hidden="true"></i><span> Agent Group</span></a></li> 
<?php } ?>
						   

<?php if((in_array("faretype", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
						<li class="nav-item"><a href="display.html?ga=faretype" class="nav-link <?php if($_REQUEST['ga']=='faretype'){ ?> active<?php } ?>"><i class="fa fa-plane" aria-hidden="true"></i><span>Fare Type</span></a></li> 
<?php } ?>
<?php if((in_array("flightsname", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
						<li style="display:none;" class="nav-item"><a href="display.html?ga=flightsname" class="nav-link <?php if($_REQUEST['ga']=='flightsname'){ ?> active<?php } ?>"><i class="fa fa-plane" aria-hidden="true"></i><span>Flight Logo</span></a></li>
						
						<li style="display:none;" class="nav-item"><a href="display.html?ga=flightapisetting" class="nav-link <?php if($_REQUEST['ga']=='flightapisetting'){ ?> active<?php } ?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Flight API Setting</span></a></li>
<?php } ?>
						</ul>
					</div>
					
					
					
					
					<!-- /main navigation -->

				</div>
				
				
			</div>
			 
			<!-- /sidebar content -->
			
		</div>