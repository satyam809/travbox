

<div id="header">

    <div id="logo"><a href="<?php echo $fullurl; ?>"><img src="<?php echo $imgurl; ?><?php echo $LoginUserDetails['companyLogo']; ?>"></a></div>

    <div id="menu">

    <a href="<?php echo $fullurl; ?>" <?php if($selectedpage=='dashboard'){ ?>class="active"<?php } ?>><span><i class="fa fa-th-large" aria-hidden="true"></i></span>Dashbaord</a>

    <a href="<?php echo $fullurl; ?>flights" <?php if($selectedpage=='flights'){ ?>class="active"<?php } ?>><span><i class="fa fa-plane" aria-hidden="true"></i></span>Flights</a>

    <a href="<?php echo $fullurl; ?>hotels" <?php if($selectedpage=='hotels'){ ?>class="active"<?php } ?>><span><i class="fa fa-building" aria-hidden="true"></i></span>Hotels</a>

   

  <div class="dropdown dropbuton" style="margin-right:10px; float:left;">  <a href="<?php echo $fullurl; ?>holidays" class="<?php if($selectedpage=='holidays'){ ?>active<?php } ?> dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="fa fa-suitcase" aria-hidden="true"></i></span>Holidays</a>

  

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

    <a class="dropdown-item" href="domestic-holidays">Domestic</a>

    <a class="dropdown-item" href="international-holidays">International</a>

   

  </div>

  

  </div>

  <div class="dropdown dropbuton" style="margin-right:10px; float:left;">  <a href="<?php echo $fullurl; ?>intdmc" class="<?php if($selectedpage=='intdmc'){ ?>active<?php } ?> dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="fa fa-globe" aria-hidden="true"></i></span>Int DMC</a>

  

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

  <?php $category=GetPageRecord('*','categoryMaster',' status=1 order by id asc '); 
while($categoryData=mysqli_fetch_array($category)){  ?>
    <a class="dropdown-item" href="intdmc.php?intId=<?php echo encode($categoryData['id']); ?>"><?php echo $categoryData['name'] ?></a>

    <?php } ?>

    

   

  </div>

  </div>

	

	<a href="<?php echo $fullurl; ?>forex" <?php if($selectedpage=='visa'){ ?>class="active"<?php } ?>><span><i class="fa fa-exchange" aria-hidden="true"></i></span>Forex</a>

	

	<a href="<?php echo $fullurl; ?>cruise" <?php if($selectedpage=='visa'){ ?>class="active"<?php } ?>><span><i class="fa fa-ship" aria-hidden="true"></i></span>Cruise</a>

	

	

	

	 	  <div class="dropdown dropbuton" style="margin-right:10px; float:left;">  <a href="<?php echo $fullurl; ?>services" class="<?php if($selectedpage=='services'){ ?>active<?php } ?> dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="fa fa-globe" aria-hidden="true"></i></span>Services</a>

  

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

    <a href="<?php echo $fullurl; ?>#" <?php if($selectedpage=='visa'){ ?>class="active"<?php } ?>><span><i class="fa fa-bus" aria-hidden="true"></i></span>Bus<span</a>

    <a href="<?php echo $fullurl; ?>visa" <?php if($selectedpage=='visa'){ ?>class="active"<?php } ?>><span><i class="fa fa-cc-visa" aria-hidden="true"></i></span>Visa</a>

    <a href="<?php echo $fullurl; ?>int-simcard" <?php if($selectedpage=='visa'){ ?>class="active"<?php } ?>><span><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sim" viewBox="0 0 16 16"> <path d="M2 1.5A1.5 1.5 0 0 1 3.5 0h7.086a1.5 1.5 0 0 1 1.06.44l1.915 1.914A1.5 1.5 0 0 1 14 3.414V14.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-13zM3.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V3.414a.5.5 0 0 0-.146-.353l-1.915-1.915A.5.5 0 0 0 10.586 1H3.5z" fill="white"></path> <path d="M5.5 4a.5.5 0 0 0-.5.5V6h2.5V4h-2zm3 0v2H11V4.5a.5.5 0 0 0-.5-.5h-2zM11 7H5v2h6V7zm0 3H8.5v2h2a.5.5 0 0 0 .5-.5V10zm-3.5 2v-2H5v1.5a.5.5 0 0 0 .5.5h2zM4 4.5A1.5 1.5 0 0 1 5.5 3h5A1.5 1.5 0 0 1 12 4.5v7a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 11.5v-7z" fill="white"></path> </svg></span>Int'l SIM</a>

    

    

    

   

  </div>

  </div>



    </div>

    

    

    <div id="rightmenu">

	

    <div class="dropdown">

      <button class="btn btn-secondary dropdown-toggle mainbutton" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <span><i class="fa fa-user" aria-hidden="true"></i>

        </span>Account

      </button>

      <button style="display: none;" class="btn btn-secondary dropdown-toggle menubtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <i class="fa fa-bars" aria-hidden="true"></i>

      

      </button>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

         <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet" style="background-color: #00000080 !important; color: #fff;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Balance: &#8377;<?php echo round($totalwalletBalance); ?></a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-id-card-o" aria-hidden="true"></i> Agent Id: <?php echo makeAgentId($LoginUserDetails['agentId']); ?></a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings"><i class="fa fa-list" aria-hidden="true"></i> Bookings</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings-invoice"><i class="fa fa-file" aria-hidden="true"></i> Invoices</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet"><i class="fa fa-money" aria-hidden="true"></i> Balance Sheet</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>online-recharge"><i class="fa fa-retweet" aria-hidden="true"></i> Online Recharge</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>topup-request"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Top Up Request</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-customer"><i class="fa fa-users" aria-hidden="true"></i> Customers</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>settings"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

      </div>

    </div>

</div>

</div>

