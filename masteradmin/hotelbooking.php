<style>
.form-control {
    border-radius: 0.3125rem;
    font-size: 0.875rem;
    padding: 10px;
    height: auto;
}
.rightstiky{position: fixed !important; min-width: 410px; margin-top:90px; z-index:2;}
.showgst{display:none;}
</style>
<!-- ========== MAIN CONTENT ========== -->
<?php 
if(trim($_POST['action'])=='roompostaction'){
	$HotelSearchDetails = trim($_POST['HotelSearchDetails']);
	$HotelSearchArr = json_decode($HotelSearchDetails); 
	//print_r($HotelSearchArr);
	
	$hotelJsonData = trim($_POST['hotelJsonData']);
	$hotelArr = json_decode($hotelJsonData); 
	
	$RoomDetails = trim($_POST['RoomDetails']);
	$RoomArr = json_decode($RoomDetails); 
	
	$uniqueId = trim($hotelArr->id);
	$HotelName = trim($hotelArr->name);
	$HotelCode = trim($hotelArr->id);
	$Rating = trim($hotelArr->rt);
	$Address = trim($hotelArr->ad->adr);
	$Destination = trim($HotelSearchArr->Destination);
	$CheckIn = date('Y-m-d',strtotime($HotelSearchArr->CheckIn));
	$CheckOut = date('Y-m-d',strtotime($HotelSearchArr->CheckOut));
	$status = "1";
	
	
	$jsonPost = '{
		"hotelId":"'.trim($uniqueId).'",
		"optionId":"'.trim($RoomArr->id).'"
	}';

	$url = "https://apitest.tripjack.com/hms/v1/hotel-review"; // URL To Hit
	$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
	$updatedPriceArr = json_decode($result);
	//print_r($updatedPriceArr->hInfo->ops);
	foreach($updatedPriceArr->hInfo->ops{0}->ris as $updatedPriceData){
	$RoomType = trim($updatedPriceData->rt);
	$Amount+= trim($updatedPriceData->tfcs->BF);
	$TaxCode+= trim($updatedPriceData->tfcs->TAF);
	$CancellationPolicy = "";
	$ServiceTax = "";
	$SvTax = "";
	$DisTax = "";
	$ExTax = "";
	
	
	}
	$RoomTypeCode = trim($RoomArr->id);
	$bareFare = $Amount;
	$tax = $TaxCode;
	$totalFare = $bareFare+$tax;
	
	
	
	
	$namevalue ='uniqueId="'.$uniqueId.'",HotelName="'.$HotelName.'",HotelCode="'.$HotelCode.'",Rating="'.$Rating.'",Address="'.$Address.'",RoomType="'.$RoomType.'",RoomTypeCode="'.$RoomTypeCode.'",TaxCode="'.$TaxCode.'",Amount="'.round($Amount).'",CancellationPolicy="'.$CancellationPolicy.'",ServiceTax="'.$ServiceTax.'",SvTax="'.$SvTax.'",DisTax="'.$DisTax.'",ExTax="'.$ExTax.'",status="'.$status.'",Destination="'.$Destination.'",CheckIn="'.$CheckIn.'",CheckOutDate="'.$CheckOut.'",agentId="'.$agentid.'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'"';  
	$bookinglastId = addlistinggetlastid('hotelBookingMaster',$namevalue);   
	
	
	
}
?>
<main id="content">
<form class="js-validate" method="POST" action="display.html?ga=hotelbookingstatus" id="bookingform">
  <input name="bookinglastId" type="hidden" value="<?php echo $bookinglastId; ?>">
  <!--<input type="hidden" name="hotelJsonData" value="<?php echo htmlentities($_POST['hotelJsonData']); ?>" >
  <input type="hidden" name="RoomDetails" value="<?php echo htmlentities($_POST['RoomDetails']); ?>" />-->
  <input name="HotelSearchDetails" type="hidden" value="<?php echo htmlentities($_POST['HotelSearchDetails']); ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-xl-8">
        <div class="mb-3 shadow-soft bg-white rounded-sm">
          <div class="pt-4 pb-5 px-5">
            <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4"> PAX Details </h5>
            <!-- Contacts Form -->
            <input type="hidden" name="action" value="paxdetailaction" >
            <input type="hidden" name="bookinglastId" value="<?php echo $bookinglastId; ?>" >
            <div class="row">
              <!-- Input -->
            <?php
			$n=1;
			//$room = $HotelSearchArr->TotalRoom;
			//$TotalAdult = $HotelSearchArr->RoomDetails{0}->TotalAdult;
			//$TotalChild = $HotelSearchArr->RoomDetails{0}->TotalChild;
			
			//for($x = 1; $x<=$room; $x++){
			//for($adult=1; $adult<=$TotalAdult; $adult++){
			foreach($HotelSearchArr->RoomDetails as $roomData){
			?>
              <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4" style="font-size: 14px; width: 100%; padding: 6px 18px; background-color: #f0f6fb;">Room - <?php echo $n; ?></h5>
			<?php
			$adult = 1;
			foreach($roomData->Adult as $adultData){
			?>
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Adult Title </label>
                  <select class="form-control" name="titleAdt<?php echo $n.$adult; ?>" id="titleAdt<?php echo $n.$adult; ?>">
                    <option value="">Select</option>
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms.</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> First Name </label>
                  <input type="text" class="form-control" name="firstNameAdt<?php echo $n.$adult; ?>" id="firstNameAdt<?php echo $n.$adult; ?>" placeholder="" aria-label="" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div>
              <!-- End Input -->
              <!-- Input -->
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Last name </label>
                  <input type="text" class="form-control" name="lastNameAdt<?php echo $n.$adult; ?>" id="lastNameAdt<?php echo $n.$adult; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                  <input type="hidden" name="adtpaxType<?php echo $adult; ?>" id="adtpaxType<?php echo $adult; ?>" value="<?php echo $adultData->PaxType; ?>" >
                </div>
              </div>
              <!-- End Input -->
              <div class="w-100"></div>
              <!-- Input -->
              <!-- End Input -->
              <?php $adult++; }  ?>
              <?php
										$child = 1;
										foreach($roomData->Child as $childData){
										?>
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Child Title </label>
                  <select class="form-control" name="titleChd<?php echo $n.$child; ?>" id="titleChd<?php echo $n.$child; ?>">
                    <option value="">Select</option>
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms.</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> First Name </label>
                  <input type="text" class="form-control" name="firstNameChd<?php echo $n.$child; ?>" id="firstNameChd<?php echo $n.$child; ?>" placeholder="" aria-label="" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div>
              <!-- End Input -->
              <!-- Input -->
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Last name </label>
                  <input type="text" class="form-control" name="lastNameChd<?php echo $n.$child; ?>" id="lastNameChd<?php echo $n.$child; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                  <input type="hidden" name="ageChild<?php echo $n.$child; ?>" id="ageChild<?php echo $n.$child; ?>" value="<?php echo $childData->Age; ?>" >
                  <input type="hidden" name="childpaxType<?php echo $n.$child; ?>" id="childpaxType<?php echo $n.$child; ?>" value="<?php echo $childData->PaxType; ?>" >
                </div>
              </div>
              <?php $child++; } $n++; } ?>
            </div>
            <!-- End Contacts Form -->
          </div>
        </div>
        <div class="mb-5 shadow-soft bg-white rounded-sm">
          <div class="pt-4 pb-5 px-5">
            <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4"> Contact Information </h5>
            <div class="row">
              <!-- Input -->
              <div class="col-sm-6 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Name </label>
                  <input type="text" class="form-control" name="guestname" placeholder="" aria-label="" required
                                                data-msg="Please enter a name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div>
              <div class="col-sm-6 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Email </label>
                  <input type="email" class="form-control" name="email" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid email address."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div>
              <!-- End Input -->
              <!-- Input -->
              <div class="col-sm-6 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Phone </label>
                  <input type="number" class="form-control" name="phone" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid phone number."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div>
              <!-- End Input -->
              <!-- Input -->
              <div class="col-sm-6 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Address </label>
                  <input type="text" class="form-control" name="address" placeholder="" aria-label="" required
                                                data-msg="Please enter a address"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div>
              <!-- End Input -->
            </div>
            <div class="w-100"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-xl-4">
        <div class="shadow-soft bg-white rounded-sm sticky-right">
          <!-- Basics Accordion -->
          <div id="basicsAccordion">
            <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
              <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingFour">
                <h5 class="mb-0">
                  <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                                data-toggle="collapse"
                                                data-target="#basicsCollapseFour"
                                                aria-expanded="false"
                                                aria-controls="basicsCollapseFour"> Price Summary <span class="card-btn-arrow font-size-14 text-dark"> <i class="fas fa-chevron-down"></i> </span> </button>
                </h5>
              </div>
              <hr>
              <div style="text-align:center;">Adult: <strong><?php echo $HotelSearchArr->TotalAdult; ?></strong> &nbsp;&nbsp;Child: <strong><?php echo $HotelSearchArr->TotalChild; ?></strong></div>
              <hr>
              <div id="basicsCollapseFour" class="collapse show"
                                        aria-labelledby="basicsHeadingFour"
                                        data-parent="#basicsAccordion">
                <div class="card-body px-4 pt-0">
                  <!-- Fact List -->
                  <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                    <li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Basic Fare</span> <span class="text-secondary"> &#8377;<?php echo round($bareFare); ?></span> </li>
                    <li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Taxes & Fee</span> <span class="text-secondary"> &#8377;<?php echo round($tax); ?></span> </li>
                    <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold"> <span class="font-weight-bold">Grand Total</span> <span class=""> <span id="displayprice">&#8377;<?php echo round($totalFare); ?></span></span> </li>
                  </ul>
                  <!-- End Fact List -->
                  <button type="submit" class="btn btn-primary btn-wide rounded-sm transition-3d-hover font-size-16 font-weight-bold py-3" style="width: 100%; margin-top: 20px;">Continue Booking</button>
                </div>
              </div>
            </div>
            <!-- End Card -->
          </div>
          <!-- End Basics Accordion -->
        </div>
      </div>
    </div>
  </div>
  <input name="finalclientcost" id="finalclientcost" type="hidden" value="<?php echo round($totalFare); ?>">
</form>
</main>
<!-- ========== END MAIN CONTENT ========== -->
<!-- ========== END MAIN CONTENT ========== -->
<!-- ========== FOOTER ========== -->
<style>
 .hiderightlist{display:none !important;}
 .hiderightlistpolicy{display:none !important;}
 </style>
