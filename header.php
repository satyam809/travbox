<style>
  .img-class::before {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.5);
    /* Adjust the last value (alpha) for transparency */
    z-index: 1;
    /* Place the overlay on top of the image */
  }

  #header #menu a span {

    color: #666;
    /* width:unset; */
    display: inline-block;
    /* Makes the element behave like an inline element */
    background-color: unset;
    border-radius: 0px;
    /* Example background color */
    /* Example padding */
    /* Example border */
  }

  #header #menu a:hover {
    background-color: unset;
    border: unset;
  }

  #header #menu a {
    border: 0px
  }

  .icon_span {
    display: block !important;
    margin-bottom: -48px;
    margin-left: -32px;
    font-weight: 500;
    font-size: 13px;
    color: #666;
  }

  .image-container {
    display: inline-block;
    /* Ensures the span acts as an inline element */
    transition: filter 0.3s ease;
    /* Smooth transition effect for filter property */
  }

  .image-container:hover img {
    filter: grayscale(100%) brightness(50%) hue-rotate(240deg);
    /* Change the hue-rotate value to get different colors */
  }

  #header {
    height: 62px;
  }

  #header #menu a {
    margin-right: 30px;
  }

  #leftsidemenu .inlist .companyinfobox {
    margin-top: 15px;
  }

  .bodysect {
    margin-top: 20px;
  }

  #header #menu .active {
    background-color: unset;
    border: 0px;
  }

  #header #menu .active {
    border-bottom: 3px solid #3168e8 !important;
    color: #3168e8 !important;
  }

  #header #menu a:hover {
    color: #3168e8;
  }

  .show {}

  #header #logo img {
    height: 50px !important;
  }

  #header #menu a span {
    font-weight: bold;
  }
</style>

<div id="header">

  <div id="logo"><a href="<?php echo $fullurl; ?>">
      <img src="<?php echo $imgurl; ?><?php echo $LoginUserDetails['companyLogo']; ?>" styel=""></a></div>

  <div id="menu">

    <a style="margin-left:47px;" href="<?php echo $fullurl; ?>">
      <!-- <span><i class="fa fa-th-large" aria-hidden="true"></i></span> -->
      <span><img src="images/icon/5.png" class="img-class" width="25"></span>
      <span class="icon_span  <?php if ($selectedpage == 'dashboard') { ?>active<?php } ?>">Dashbaord</span>
    </a>

    <a href="<?php echo $fullurl; ?>flights">
      <!-- <span><i class="fa fa-plane" aria-hidden="true"></i></span> -->
      <span><img src="images/icon/2.png" class="img-class" width="25"></span>
      <span class="icon_span <?php if ($selectedpage == 'flights') { ?>active<?php } ?>">Flights</span>
    </a>

    <!-- <a href="<?php //echo $fullurl; ?>hotels"> -->
    <a href="hotelsearch.php">
      <!-- <span><i class="fa fa-hotel"></i></span> -->
      <span><img src="images/icon/10.png" width="25"></span>
      <span class="icon_span <?php if ($selectedpage == 'hotels') { ?>active<?php } ?>">Hotels</span>
    </a>



    <div class="dropdown dropbuton" style="margin-right:10px; float:left;"> <a href="<?php echo $fullurl; ?>holidays" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <!-- <span><i class="fa fa-umbrella-beach" aria-hidden="true"></i></span> -->
        <span><img src="images/icon/11.png" width="25"></span>
        <span class="icon_span <?php if ($selectedpage == 'holidays') { ?>active<?php } ?>">Holidays</span>
      </a>



      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

        <a class="dropdown-item" href="domestic-holidays">Domestic</a>

        <a class="dropdown-item" href="international-holidays">International</a>



      </div>



    </div>

    <!-- <div class="dropdown dropbuton" style="margin-right:10px; float:left;">  <a href="<?php echo $fullurl; ?>services" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
    <!-- <span><i class="fa fa-globe" aria-hidden="true"></i></span> -->
    <!-- <span>
      <img src="images/icon/12.png" width="25"></span>
      <span class="icon_span <?php //if($selectedpage=='services'){ 
                              ?>active<?php //} 
                                                                            ?>"> Int DMC</span>
    </a> -->



    <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

  <?php  //$category=GetPageRecord('*','categoryMaster',' status=1 order by id asc '); 
  //while($categoryData=mysqli_fetch_array($category)){  
  ?>
    <a class="dropdown-item" href="intdmc.php?intId=<?php //echo encode($categoryData['id']); 
                                                    ?>"><?php //echo $categoryData['name'] 
                                                                                                  ?></a>

    <?php //} 
    ?>
    

    

   

  </div>

  </div> -->



    <a href="<?php echo $fullurl; ?>forex">
      <!-- <span><i class="fa fa-exchange" aria-hidden="true"></i></span> -->
      <span><img src="images/icon/13.png" width="25"></span>
      <span class="icon_span <?php if ($selectedpage == 'forex') { ?>active<?php } ?>">Forex</span>
    </a>




    <a href="<?php echo $fullurl; ?>cruise">
      <!-- <span><i class="fa fa-ship" aria-hidden="true"></i></span> -->
      <!-- <span class="demo-icon icon-cruise"></span> -->
      <span class="image-container"><img src="images/icon/14.png" width="25"></span>
      <span class="icon_span <?php if ($selectedpage == 'cruise') { ?>active<?php } ?>">Cruise</span>

    </a>







    <div class="dropdown dropbuton" style="margin-right:10px; float:left;"> <a href="<?php echo $fullurl; ?>services" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!-- <span><i class="fa fa-globe" aria-hidden="true"></i></span> -->
        <span><img src="images/icon/15.png" width="25"></span>
        <span class="icon_span <?php if ($selectedpage == 'services') { ?>active<?php } ?>">Services</span>
      </a>



      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

        <a href="<?php echo $fullurl; ?>#" <?php if ($selectedpage == 'visa') { ?>class="active" <?php } ?>><span><i class="fa fa-bus" aria-hidden="true"></i></span>Bus<span< /a>

            <a href="<?php echo $fullurl; ?>visa" <?php if ($selectedpage == 'visa') { ?>class="active" <?php } ?>><span><i class="fa fa-cc-visa" aria-hidden="true"></i></span>Visa</a>

            <a href="<?php echo $fullurl; ?>int-simcard" <?php if ($selectedpage == 'visa') { ?>class="active" <?php } ?>><span><svg style="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sim" viewBox="0 0 16 16">
                  <path d="M2 1.5A1.5 1.5 0 0 1 3.5 0h7.086a1.5 1.5 0 0 1 1.06.44l1.915 1.914A1.5 1.5 0 0 1 14 3.414V14.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-13zM3.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V3.414a.5.5 0 0 0-.146-.353l-1.915-1.915A.5.5 0 0 0 10.586 1H3.5z" fill=""></path>
                  <path d="M5.5 4a.5.5 0 0 0-.5.5V6h2.5V4h-2zm3 0v2H11V4.5a.5.5 0 0 0-.5-.5h-2zM11 7H5v2h6V7zm0 3H8.5v2h2a.5.5 0 0 0 .5-.5V10zm-3.5 2v-2H5v1.5a.5.5 0 0 0 .5.5h2zM4 4.5A1.5 1.5 0 0 1 5.5 3h5A1.5 1.5 0 0 1 12 4.5v7a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 11.5v-7z" fill=""></path>
                </svg></span>Int'l SIM</a>









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