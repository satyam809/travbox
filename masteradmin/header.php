 <?php  ?>
<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark fixed-top">
		<div class="navbar-brand wmin-0">
			<a href="<?php echo $fullurl; ?>" class="d-inline-block">
				<img src="<?php echo $fullurl; ?>upload/<?php echo $logoquery['companyLogo']; ?>" alt="<?php echo stripslashes($LoginUserCompanyDetails['companyName']); ?>">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
			<?php /* ?>
				<li class="nav-item">
					<a href="<?php echo $fullurl; ?>" class="navbar-nav-link">
						<i class="fa fa-home" aria-hidden="true"></i>
					</a>  
				</li>
			<?php */ ?>
				
				
	<?php /* if((in_array("offlineflightbooking", $permissionView)) || in_array("flightbooking", $permissionView) || in_array("offlinehotelBookings", $permissionView) || in_array("packageBookings", $permissionView) || $LoginUserDetails["userType"]=="admin"){ ?>
				<li class="nav-item dropdown dropdown-user">
				<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Bookings</span>
				</a>
				
				<div class="dropdown-menu dropdown-menu-right"> 
				<?php if((in_array("offlineflightbooking", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
			<!--	<a href="<?php echo $fullurl; ?>display.html?ga=offlineflightbooking" class="dropdown-item">&nbsp;Offline Flight Bookings</a>-->
				<?php } ?>
				<?php if((in_array("flightbooking", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<a href="<?php echo $fullurl; ?>display.html?ga=flightbooking" class="dropdown-item">&nbsp;Flight Online Bookings</a> 
				<a href="<?php echo $fullurl; ?>display.html?ga=offlineflightbooking" class="dropdown-item">&nbsp;Flight Offline Bookings</a> 
				<?php } ?>
				<?php if((in_array("offlinehotelBookings", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>		
				<a href="<?php echo $fullurl; ?>display.html?ga=hotelBookings" class="dropdown-item">&nbsp;Hotel Bookings</a>
				<a href="<?php echo $fullurl; ?>display.html?ga=hotelenquiry" class="dropdown-item">&nbsp;Hotel Enquiry</a>
				<?php } ?>
				
				<?php if((in_array("cabbooking", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<a href="<?php echo $fullurl; ?>display.html?ga=busbooking" class="dropdown-item">&nbsp;Bus Bookings</a> 
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=cabbooking" class="dropdown-item">&nbsp;Cab Bookings</a>  -->
				<?php } ?>
				
				<?php if((in_array("hotelBookings", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>	
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=hotelBookings" class="dropdown-item">&nbsp;Online Hotel Bookings</a>
				<?php } ?>
				<?php if((in_array("packageBookings", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<a href="<?php echo $fullurl; ?>display.html?ga=packageBookings" class="dropdown-item">&nbsp;Package Enquiry</a> 
				<?php } ?>
				<?php if((in_array("busBookings", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=busBookings" class="dropdown-item">&nbsp;Bus Bookings</a>  -->
				<?php } ?>
				</div>
				</li>
	<?php } */ ?>

				<?php /* if((in_array("itinerary", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<li class="nav-item">
					<a href="<?php echo $fullurl; ?>display.html?ga=itinerary" class="navbar-nav-link">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>  &nbsp;Itinerary 
					</a>  
				</li>
				<?php } */ ?>
				
				<?php /* if((in_array("query", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
					<li class="nav-item" style="display:none;">
					<a href="<?php echo $fullurl; ?>display.html?ga=query" class="navbar-nav-link">
						<i class="fa fa-list-alt" aria-hidden="true"></i>  &nbsp;Query
					</a>  
					</li>
				<?php } */ ?>
				
				<?php /* if((in_array("invoice", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<li class="nav-item dropdown dropdown-user">
				<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;Invoice</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right"> 
					<a href="<?php echo $fullurl; ?>display.html?ga=invoice" class="dropdown-item">&nbsp;Flight Invoice</a> 
					<a href="<?php echo $fullurl; ?>display.html?ga=hotelinvoice" class="dropdown-item">&nbsp;Hotel Invoice</a> 
					<a href="<?php echo $fullurl; ?>display.html?ga=businvoicelist" class="dropdown-item">&nbsp;Bus Invoice</a> 
				</div>
				</li>
				<?php } */ ?>


<?php if((in_array("agents", $permissionView)) || in_array("gstreport", $permissionView) || in_array("topupoffline", $permissionView) || in_array("webquery", $permissionView) || in_array("flightSearchLogs", $permissionView) || $LoginUserDetails["userType"]=="admin"){ ?>

					 
				<li class="nav-item dropdown dropdown-user">
				<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Agents</span>
				</a>
				
				<div class="dropdown-menu dropdown-menu-right"> 
				<?php if((in_array("agents", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<a href="<?php echo $fullurl; ?>display.html?ga=agents" class="dropdown-item">&nbsp;Agents Master</a> 
				<?php } ?>

 	
				<?php if((in_array("agents", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=subagents" class="dropdown-item">&nbsp;Sub Agents Master</a> -->
				<?php } ?>
				<?php if((in_array("gstreport", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
		<!--		<a href="<?php echo $fullurl; ?>display.html?ga=gstreport" class="dropdown-item">&nbsp;Flight GST Report</a>
				<a href="<?php echo $fullurl; ?>display.html?ga=hotelgstreport" class="dropdown-item">&nbsp;Hotel GST Report</a>-->
				<?php } ?>				
				<?php if((in_array("topupoffline", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=topupoffline" class="dropdown-item">&nbsp;Topup Request</a>  -->
				<!-- <a href="<?php echo $fullurl; ?>display.html?ga=agentstatement" class="dropdown-item">&nbsp;Agent Statement</a>  -->
				<a href="<?php echo $fullurl; ?>display.html?ga=distributors_balancesheet" class="dropdown-item">&nbsp;Admin Balance Sheet</a> 
				<!-- <a href="<?php echo $fullurl; ?>display.html?ga=adminbalancesheet" class="dropdown-item">&nbsp;Admin Balance Sheet</a> 
				<a href="<?php echo $fullurl; ?>display.html?ga=agentcreditdebit" class="dropdown-item">&nbsp;Agent Credit/Debit</a>   -->
				<?php } ?>
				 
				<?php if((in_array("webquery", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--
				<a href="<?php echo $fullurl; ?>display.html?ga=webquery" class="dropdown-item">&nbsp;Web Query</a>   
				-->
				<?php } ?>
				
				<?php if((in_array("flightSearchLogs", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=flightsearchhistory" class="dropdown-item">&nbsp;Flight Search Log</a> 
				<a href="<?php echo $fullurl; ?>display.html?ga=userlog" class="dropdown-item">&nbsp;System Log</a> 
				<!--
				<a href="<?php echo $fullurl; ?>display.html?ga=flight-error-log" class="dropdown-item">&nbsp;Flight Booking Error Log</a> 
				-->
				<?php } ?>
				
 			
				
				</div>
				</li>
				
<?php } ?>				
				
				<?php /* if((in_array("clients", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<li class="nav-item">
					<a href="<?php echo $fullurl; ?>display.html?ga=clients" class="navbar-nav-link">
						<i class="fa fa-user-o" aria-hidden="true"></i>  &nbsp;Clients 
					</a>  
				</li>
				<?php } */ ?>
				<?php /* if((in_array("suppliers", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<li class="nav-item">
					<a href="<?php echo $fullurl; ?>display.html?ga=suppliers" class="navbar-nav-link">
						<i class="fa fa-user-plus" aria-hidden="true"></i>  &nbsp;Suppliers 
					</a>  
				</li>
				<?php } */ ?>
				
				
				<?php /* if((in_array("topUpBalance", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<li class="nav-item">
					<a href="<?php echo $fullurl; ?>display.html?ga=topUpBalance" class="navbar-nav-link">
						<i class="fa fa-google-wallet" aria-hidden="true"></i>  &nbsp;Top Up 
					</a>  
				</li>
				<?php } */ ?>
				
				
				<?php /* if((in_array("callbackrequest", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--<li class="nav-item">
					<a href="<?php echo $fullurl; ?>display.html?ga=callbackrequest" class="navbar-nav-link">
						<i class="fa fa-envelope" aria-hidden="true"></i>  &nbsp;Call Back Request 
					</a>  
				</li>-->
				<?php } */ ?>

<?php /*

				<li class="nav-item dropdown dropdown-user">
				<a href="<?php echo $fullurl; ?>display.html?ga=ticketcancelrequest" class="navbar-nav-link"  ><span><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;Flight Cancellation</span></a>
				<div class="dropdown-menu dropdown-menu-right" style="display:none;"> 
				<?php if((in_array("ticketcancelrequest", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<a href="<?php echo $fullurl; ?>display.html?ga=ticketcancelrequest" class="dropdown-item">&nbsp;Flight Cancellation Request</a> 
				<?php } ?>
				<?php if((in_array("ticketcancelrequest", $permissionView)) || $LoginUserDetails["userType"]=="admin"){ ?>
				<!--<a href="<?php echo $fullurl; ?>display.html?ga=hotelcancelrequest" class="dropdown-item">&nbsp;Hotel Cancel Request</a> -->
				<?php } ?>
				</div>
				</li>
				
<?php */ ?>				

<?php /*
				<li class="nav-item dropdown dropdown-user" style="display:none;">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;Marketing</span></a>
					<div class="dropdown-menu dropdown-menu-right"> 
						<a href="<?php echo $fullurl; ?>display.html?ga=marketingcategory" class="dropdown-item">&nbsp;Category</a>
						<a href="<?php echo $fullurl; ?>display.html?ga=marketingbanner" class="dropdown-item">&nbsp;Banner</a>
					</div>
				</li>
					 
<?php */ ?>
				  
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
			 
			</span>
<?php
// $rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$_SESSION['userid'].'" and bookingId=0 and paymentType="Credit" and offlineAgent=0 
// '); // sonam comment;
//$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','addedBy="'.$_SESSION['userid'].'" and paymentType="Credit" and offlineAgent=0 '); // sonam comment;
// $rs8=GetPageRecord('SUM(amount) as totalcreditAmt' ,'sys_balanceSheet',  'agentId in (select id from sys_userMaster where id="'.$_SESSION['userid'].'") and bookingId=0 and paymentType=Credit'); // sonam comment;
// function GetPageRecord1($select,$tablename,$where){		

// 	$sql="select ".$select." from ".$tablename." where ".$where."";
// 	echo $sql; exit;
	
// 	$rs=mysqli_query(db(),$sql) or die(mysqli_error());
	
// 	return $rs;
	
// 	}
$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_transfer_balance','to_agent_id="'.$_SESSION['userid'].'"');

$agentCreditAmt=mysqli_fetch_array($rs8); 
//print_r($agentCreditAmt);
//echo $_SESSION['userid'];
//echo  "Credit amount".$agentCreditAmt['totalcreditAmt'];
// $rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$_SESSION['userid'].'" and paymentType="Debit" and offlineAgent=0 '); // sonam comment;

// $rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$_SESSION['userid'].'" and  bookingId=0 and paymentType="Debit" and offlineAgent=0 ');
// $agentDebitAmt=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_transfer_balance','from_agent_id="'.$_SESSION['userid'].'"');
$agentDebitAmt=mysqli_fetch_array($rs8); 
//echo "Debit Amount"  .$agentDebitAmt['totaldebitAmt'];

$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
?>
			<ul class="navbar-nav">
				 	<li class="nav-item">
					<a href="display.html?ga=adminbalancesheet" class="navbar-nav-link">
						Balance: <strong><?php echo round($totalwalletBalance); ?></strong>
					</a>  
				</li>

				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown"> 
						<span><i class="fa fa-user"></i> &nbsp; <?php echo stripslashes($LoginUserDetails['companyName']); ?> <strong style="color:#FF3300;">(<?php echo stripslashes($getcommitypename['name']); ?>)</strong></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
				  
						<a href="display.html?ga=generalsettings" class="dropdown-item"><i class="icon-cog5"></i> Settings</a>
		 
					<a onClick="window.open('online-recharge?type=recharge', '_blank', 'location=yes,height=600,width=1000,scrollbars=yes,status=yes');" class="dropdown-item"><i class="fa fa-file-text-o" aria-hidden="true"></i> Top Up Balance</a>

					
					
					<a href="display.html?ga=topupOffline" class="dropdown-item"><i class="fa fa-file-text-o"></i> Upload Payment Request</a>
					<a href="display.html?ga=myprofile" class="dropdown-item"><i class="fa fa-user"></i> My Profile</a>
					<a href="<?php echo $fullurl; ?>logout.html" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Secondary navbar -->
	<div class="navbar navbar-expand-md navbar-light">
		<div class="text-center d-md-none w-100">
			<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
				<i class="icon-unfold mr-2"></i>
				Navigation
			</button>
		</div>

		 
	</div>
	<!-- /secondary navbar -->
<?php if($_REQUEST['save']==1 || $_REQUEST['delete']==1 || $_REQUEST['added']==1 || $_REQUEST['mailsent']==1){ ?>

 <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible" style="margin-bottom: 0px; border-radius: 0px; padding: 6px 20px; position: fixed; left: 0px; top: 50px; width: 100%; z-index: 9999;">
									<button type="button" class="close" data-dismiss="alert" style="padding: 7px 15px;">&times;</button>
									<?php if($_REQUEST['save']==1){ echo 'Changes have been successfully saved.'; } if($_REQUEST['delete']==1){ echo 'Successfully deleted.'; }  if($_REQUEST['added']==1){ echo 'Entry have been successfully added.'; } if($_REQUEST['mailsent']==1){ echo 'The mail has been sent successfully'; } ?>
</div>
<?php } ?>