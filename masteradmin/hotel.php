<?php

$travellers='1 Room - 1 Guest';
if($_REQUEST['travellers']!=''){
$travellers=$_REQUEST['travellers'];
}

$checkInDate=date('d-m-Y', strtotime('+1 days'));
if($_REQUEST['checkInDate']!=''){
$checkInDate=$_REQUEST['checkInDate'];
}
  
$checkOutDate=date('d-m-Y', strtotime('+2 days'));
if($_REQUEST['checkOutDate']!=''){
$checkOutDate=$_REQUEST['checkOutDate'];
}
 
$destinationHotel='8367,106'; 
if($_REQUEST['destinationHotel']!=''){
$destinationHotel=$_REQUEST['destinationHotel'];
}
 
$citydestination='NEW DELHI,India'; 
if($_REQUEST['citydestination']!=''){
$citydestination=$_REQUEST['citydestination'];
}







if($_GET['action']=="hotelpostaction"){ 
$destExplode = explode(',',$_GET['destinationHotel']);
$city = $destExplode[0]; 
$country = $destExplode[1];

$checkInDateapi =  date('Y-m-d',strtotime($checkInDate));
 
$checkOutDateapi = date('Y-m-d',strtotime($checkOutDate));

$norooms='';
$roomJson= '';
$n=1;
$adultTotal=0;
$childTotal=0;
//$adultCount=0;
//$childCount=0;
$childAge='';
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

$adultJson='';
for ($j = 1; $j <= $_GET['noadults'.$n]; $j++) {
//$adultTotal=$adultTotal+$j;
$adultTotal = $_GET['noadults'.$n];
$adultJson.='{"PaxType":"AD"},';

}


$childJson='';

for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
if($k==1){
	$cage = 5;
}else{
	$cage = 2;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';

}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

$norooms.='{
				"numberOfAdults": '.$adultTotal.',
				"numberOfChild": '.$childTotal.',
				"childAge": ['.rtrim($childAge,',').']	
		   },';

$roomJson.= '{
				"Adult": ['.rtrim($adultJson,',').'],
				"Child": ['.rtrim($childJson,',').']
			},';

$n++; 

}

$hotelBasicJson = '{
	"Destination":"'.$_GET['citydestination'].'",
	"CheckIn":"'.$checkInDateapi.'",
	"CheckOut":"'.$checkOutDateapi.'",
	"TotalRoom":"'.$_GET['empcount'].'",
	"TotalAdult":"'.$adultCount.'",
	"TotalChild":"'.$childCount.'",
	"RoomDetails":['.rtrim($roomJson,',').']
}';

$jsonPost = '{
    "searchQuery": {
        "checkinDate": "'.$checkInDateapi.'",
        "checkoutDate": "'.$checkOutDateapi.'",
        "roomInfo": ['.rtrim($norooms,',').'],
        "searchCriteria": {
            "city": "'.$city.'",
            "nationality": "'.$country.'",
            "currency": "INR"
        },
        "searchPreferences": {
            "ratings": [3,4,5],
            "fsc": true
        }
    },
    "sync": false
}';

$url = "https://apitest.tripjack.com/hms/v1/hotel-searchquery-list"; // URL To Hit
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$resultArr = json_decode($result);
$searchId = $resultArr->searchIds{0};

$urlsecond = "https://apitest.tripjack.com/hms/v1/hotel-search"; // URL To Hit
$searchPostJosn = '{ "searchId":"'.$searchId.'" }';
$listJson = getHotelApiData($urlsecond,$searchPostJosn,$hotelApiKey);
$hotelData = json_decode($listJson);
//echo '<pre>'; print_r($resultArr);

}

?>
<script>
function imgError(image) {
    image.onerror = "";
    image.src = "assets/nohotelimg.png";
    return true;
}
</script>
 
 
<div class="searchboxblue" style="background-image:url(assets/hotelbanner.png);padding: 69px 20px !important;margin-top: -20px;">
<div class="mid">
<div class="content"> 
 
<div class="card" style="margin-bottom: 0px; margin-top: -2px;">
<div class="card-body">
   <form method="GET" action="display.html">
				 
				  <div class="row">
				  
				  <div class="col-lg-2">
<div class="form-group">
<label>Destination</label> 
  <div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity3"></div>
                       <input type="text" onClick="$('#pickupCitySearchfromCity3').select();" class="form-control" requered="" onKeyUp="getSearchCityHotel('pickupCitySearchfromCity3','destinationHotel','searchcitylistsfromCity3');" id="pickupCitySearchfromCity3" name="citydestination" value="<?php echo $citydestination; ?>" autocomplete="nope" >
				<input name="destinationHotel" id="destinationHotel" type="hidden" value="<?php echo $destinationHotel; ?>" autocomplete="nope">
				<input name="ga" id="ga" type="hidden" value="hotel" >
</div>
</div>



<div class="col-lg-2">
<div class="form-group">
<label>Check-In</label> 
 <input type="text" id="dt1" name="checkInDate" class="form-control"  value="<?php echo trim($checkInDate); ?>" autocomplete="nope"  >
</div>
</div>


<div class="col-lg-2">
<div class="form-group"  onclick="selecttb(2);">
<label>Check-Out</label> 
 <input type="text" id="dt2" name="checkOutDate" class="form-control"  value="<?php echo trim($checkOutDate); ?>" autocomplete="nope" >
</div>
</div>
				<div class="col-lg-3">
<div class="form-group">
<label>Rooms and Guests</label> 
 <input type="text" id="travellersshow" name="travellers"  class="form-control"  value="<?php echo trim($travellers); ?>" autocomplete="nope" readonly="readonly" onclick="$('#basicDropdownClick').show();"  >
 
  <script>
  $('#basicDropdownClick').click(function(event){
  event.stopPropagation();
});
  </script>
 
 
 <style>
 #basicDropdownClick .form-group{margin-right:10px;margin-bottom: 10px !important;}
 
 </style>
 <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="max-width: 510px; width:510px; padding:10px;">
                   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Guests</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onclick="$('#basicDropdownClick').hide();"></i>
					  </div>
					  
					<?php 
					$empno=1;
					for($empno=1; $empno<=$_GET['empcount']; $empno++){
					
					?> 
					<div class="row" id="empInfoId<?php echo $empno; ?>" style="margin-right: 0px; margin-left: 1px;">
					
					<div class="">
					<div class="form-group"> <?php if($empno==1){ ?><label for="subject">Rooms</label><?php } ?>
						<div style="font-weight: 500; margin-top: 8px">Room - <?php echo $empno; ?></div>
					</div>
					</div>
					<div class="">
					<div class="form-group"> <?php if($empno==1){ ?><label for="subject">Adult</label><?php } ?>
					
					<select class="form-control select2 pax" id="noadults<?php echo $empno; ?>" name="noadults<?php echo $empno; ?>" onchange="gettotalpax();"> 
												<option value="1" <?php if($_GET['noadults'.$empno]=='1'){ echo 'selected'; }?> >1 Adult</option>
												<option value="2" <?php if($_GET['noadults'.$empno]=='2'){ echo 'selected'; }?>>2 Adults</option>
												<option value="3" <?php if($_GET['noadults'.$empno]=='3'){ echo 'selected'; }?>>3 Adults</option> 
												</select> 
					</div>
					</div>
					<div class="">
					<div class="form-group"><?php if($empno==1){ ?><label for="subject">Child</label><?php } ?>
					
					<select class="form-control select2 pax" id="nochilds<?php echo $empno; ?>" name="nochilds<?php echo $empno; ?>" onChange="showAgeColumn<?php echo $empno; ?>(this.value);gettotalpax();"> 
						<option value="0" <?php if($_GET['nochilds'.$empno]=='0'){ echo 'selected'; }?>>0 Child</option>
						<option value="1" <?php if($_GET['nochilds'.$empno]=='1'){ echo 'selected'; }?>>1 Child</option>
						<option value="2" <?php if($_GET['nochilds'.$empno]=='2'){ echo 'selected'; }?>>2 Childs</option> 
					</select> 
					</div>
					</div>
					<script>
					function showAgeColumn<?php echo $empno; ?>(numChild){
					//var numChild = ().val();
					if(numChild==1){
						$('#childAgediv1<?php echo $empno; ?>').show();
						$('#childAgediv2<?php echo $empno; ?>').hide();
					}
					if(numChild==2){
						$('#childAgediv1<?php echo $empno; ?>').show();
						$('#childAgediv2<?php echo $empno; ?>').show();
					}
					if(numChild==0){
						$('#childAgediv1<?php echo $empno; ?>').hide();
						$('#childAgediv2<?php echo $empno; ?>').hide();
					}
					}
					showAgeColumn<?php echo $empno; ?>(<?php echo $_GET['nochilds'.$empno]; ?>);
					</script>
					
					<div class="" id="childAgediv1<?php echo $empno; ?>" >
					<div class="form-group"><?php if($empno==1){ ?><label for="subject">Child Age</label><?php } ?>
					<select class="form-control" id="age1<?php echo $empno; ?>" name="age1<?php echo $empno; ?>"> 
						<option value="0" <?php if($_GET['age1'.$empno]=='0'){ echo 'selected'; }?>>0</option>
						<option value="1" <?php if($_GET['age1'.$empno]=='1'){ echo 'selected'; }?>>1</option>
						<option value="2" <?php if($_GET['age1'.$empno]=='2'){ echo 'selected'; }?>>2</option> 
						<option value="3" <?php if($_GET['age1'.$empno]=='3'){ echo 'selected'; }?>>3</option>
						<option value="4" <?php if($_GET['age1'.$empno]=='4'){ echo 'selected'; }?>>4</option>
						<option value="5" <?php if($_GET['age1'.$empno]=='5'){ echo 'selected'; }?>>5</option>
						<option value="6" <?php if($_GET['age1'.$empno]=='6'){ echo 'selected'; }?>>6</option>
						<option value="7" <?php if($_GET['age1'.$empno]=='7'){ echo 'selected'; }?>>7</option>
						<option value="8" <?php if($_GET['age1'.$empno]=='8'){ echo 'selected'; }?>>8</option>
						<option value="9" <?php if($_GET['age1'.$empno]=='9'){ echo 'selected'; }?>>9</option>
					</select> 
					</div>
					</div>
					<div class="" id="childAgediv2<?php echo $empno; ?>" >
					<div class="form-group"><?php if($empno==1){ ?><label for="subject">Child Age</label><?php } ?>
					<select class="form-control" id="age2<?php echo $empno; ?>" name="age2<?php echo $empno; ?>"> 
						<option value="0" <?php if($_GET['age2'.$empno]=='0'){ echo 'selected'; }?>>0</option>
						<option value="1" <?php if($_GET['age2'.$empno]=='1'){ echo 'selected'; }?>>1</option>
						<option value="2" <?php if($_GET['age2'.$empno]=='2'){ echo 'selected'; }?>>2</option> 
						<option value="3" <?php if($_GET['age2'.$empno]=='3'){ echo 'selected'; }?>>3</option>
						<option value="4" <?php if($_GET['age2'.$empno]=='4'){ echo 'selected'; }?>>4</option>
						<option value="5" <?php if($_GET['age2'.$empno]=='5'){ echo 'selected'; }?>>5</option>
						<option value="6" <?php if($_GET['age2'.$empno]=='6'){ echo 'selected'; }?>>6</option>
						<option value="7" <?php if($_GET['age2'.$empno]=='7'){ echo 'selected'; }?>>7</option>
						<option value="8" <?php if($_GET['age2'.$empno]=='8'){ echo 'selected'; }?>>8</option>
						<option value="9" <?php if($_GET['age2'.$empno]=='9'){ echo 'selected'; }?>>9</option>
					</select> 
					</div>
					</div>
					
					<div class="">
					<div class="form-group"> 
					<?php if($empno==1){ ?>
					<i class="fa fa-plus" aria-hidden="true" style="margin-top: 29px; cursor: pointer; background-color: #000; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;" onClick="addEmpInfo();"></i>
					<?php }else{ ?>
					<i class="fa fa-trash" aria-hidden="true" style="margin-top:6px; cursor: pointer; background-color: #f1646c; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;"  onclick="removeEmpInfo(<?php echo $empno; ?>);"></i>
					<?php } ?>
					</div>
					</div>
					
					</div>
					<?php 
					  }
					
					if($empno==1){
					?> 
					<div class="row" id="empInfoId1" style="margin-right: 0px; margin-left: 1px;">
					
					<div class="">
					<div class="form-group"><label for="subject">Rooms</label>  
						<div style="font-weight: 500; margin-top: 8px">Room - 1</div>
					</div>
					</div>
					<div class="">
					<div class="form-group"><label for="subject">Adult</label>  
					
					<select class="form-control select2 pax" id="noadults1" name="noadults1" onchange="gettotalpax();"> 
												<option value="1" selected="selected">1 Adult</option>
												<option value="2">2 Adults</option>
												<option value="3">3 Adults</option> 
												</select> 
					</div>
					</div>
					<div class="">
					<div class="form-group"><label for="subject">Child</label>  
					
					<select class="form-control select2 pax" id="nochilds1" name="nochilds1" onChange="showAgeColumn1(this.value);gettotalpax();"> 
						<option value="0" selected="selected">0 Child</option>
						<option value="1">1 Child</option>
						<option value="2">2 Childs</option> 
					</select> 
					</div>
					</div>
					<script>
					function showAgeColumn1(numChild){
						if(numChild==1){
							$('#childAgediv11').show();
							$('#childAgediv21').hide();
						}
						if(numChild==2){
							$('#childAgediv11').show();
							$('#childAgediv21').show();
						}
						if(numChild==0){
							$('#childAgediv11').hide();
							$('#childAgediv21').hide();
						}
					}
					showAgeColumn1('0');
					</script>
					
					<div class="" id="childAgediv11" style="display:none;">
					<div class="form-group"><label for="subject">Child Age</label>  
					<select class="form-control" id="age11" name="age11"> 
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option> 
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
					</select> 
					</div>
					</div>
					<div class="" id="childAgediv21" style="display:none;">
					<div class="form-group"><label for="subject">Child Age</label>  
					<select class="form-control" id="age21" name="age21"> 
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option> 
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
					</select> 
					</div>
					</div>
					
					<div class="">
					<div class="form-group"> 
					<i class="fa fa-plus" aria-hidden="true" style="margin-top: 29px; cursor: pointer; background-color: #000; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;" onClick="addEmpInfo();"></i>
					</div>
					</div>
					
					</div>
					<?php 
					 } 
					?> 
					<input name="empcount" type="hidden" id="empcount" value="<?php if($empno==1){ echo '1'; } else { echo $empno-1; } ?>" />
					<input name="totalpax" type="hidden" id="totalpax" value="<?php if($_REQUEST['totalpax']==''){ echo '1'; } else { echo $_REQUEST['totalpax']; } ?>" />
					 
		 
					 
					<div class="form-group"  id="loademployee">
					
					</div>
                    </div>
</div>
</div>

<div class="col-lg-2">
<div class="form-group">
<label>Star Category</label> 
 <select id="category" name="category" class="form-control">
	<option value="1">1 Star</option>
						<option value="2">2 Star</option> 
						<option value="3">3 Star</option>
						<option value="4">4 Star</option>
						<option value="5">5 Star</option>
 </select>
</div>
</div>
                     
                     
					 
					 <div class="col-lg-1">
<div class="form-group" >
<label style="    width: 100%; height:14px;"> </label> 
<button type="submit" class="btn btn-primary">Search &nbsp; <i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</div> 
                     
                  </div>
				   <input type="hidden" name="action" value="hotelpostaction" >
				  </form>
</div>
</div>

</div>
</div>
</div>
<div class="page-content pt-3" >  
<?php if($_REQUEST['checkInDate']!='' && $_REQUEST['checkOutDate']!=''){ ?>

			<!-- Content area -->
			<div class="content"> 
			<div class="row">
 <div class="col-xl-3">
  <div class="card">
 <div class="sidenav border border-color-8 rounded-xs">
                <!-- Accordiaon -->
                <div id="RatingAccordion" class="accordion rounded shadow-none border-bottom">
                  <div class="card-collapse" id="shopRatingHeadingOne">
                    <h3 class="mb-0">
                      <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#shopRatingOne" aria-expanded="false" aria-controls="shopRatingOne"> <span class="row align-items-center"> <span class="col-9"> <span class="font-weight-bold font-size-17 text-dark mb-3">Star Rating</span> </span> <span class="col-3 text-right"> <span class="card-btn-arrow"> <span class="fas fa-chevron-down small"></span> </span> </span> </span> </button>
                    </h3>
                  </div>
                  <div id="shopRatingOne" class="collapse show" aria-labelledby="shopRatingHeadingOne" data-parent="#RatingAccordion">
                    <div class="card-body pt-0 mt-1 px-5">
                      <!-- Checkboxes -->
                      <div class="form-group font-size-14 text-lh-md text-secondary mb-3">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="brandAdidas">
                          <label class="custom-control-label text-lh-inherit text-color-1" for="brandAdidas">
                          <div class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary">
                            <div class="green-lighter ml-1 letter-spacing-2"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                          </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group font-size-14 text-lh-md text-secondary mb-3">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="brandNewBalance">
                          <label class="custom-control-label text-lh-inherit text-color-1" for="brandNewBalance">
                          <div class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary">
                            <div class="green-lighter ml-1 letter-spacing-2"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                          </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group font-size-14 text-lh-md text-secondary mb-3">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="brandNike">
                          <label class="custom-control-label text-lh-inherit text-color-1" for="brandNike">
                          <div class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary">
                            <div class="green-lighter ml-1 letter-spacing-2"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                          </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group font-size-14 text-lh-md text-secondary mb-3">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="brandFredPerry">
                          <label class="custom-control-label text-lh-inherit text-color-1" for="brandFredPerry">
                          <div class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary">
                            <div class="green-lighter ml-1 letter-spacing-2"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                          </div>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="shopCartAccordion" class="accordion rounded shadow-none">
                  <div class="border-0">
                    <div class="card-collapse" id="shopCardHeadingOne">
                      <h3 class="mb-0">
                        <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#shopCardOne" aria-expanded="false" aria-controls="shopCardOne"> <span class="row align-items-center"> <span class="col-9"> <span class="d-block font-size-lg-15 font-size-17 font-weight-bold text-dark">Price Range ($)</span> </span> <span class="col-3 text-right"> <span class="card-btn-arrow"> <span class="fas fa-chevron-down small"></span> </span> </span> </span> </button>
                      </h3>
                    </div>
                    <div id="shopCardOne" class="collapse show" aria-labelledby="shopCardHeadingOne" data-parent="#shopCartAccordion">
                      <div class="card-body pt-0 px-5">
                        <div class="pb-3 mb-1 d-flex text-lh-1"> <span>£</span> <span id="rangeSliderExample3MinResult" class=""></span> <span class="mx-0dot5"> — </span> <span>£</span> <span id="rangeSliderExample3MaxResult" class=""></span> </div>
                        <input class="js-range-slider" type="text"
                                                        data-extra-classes="u-range-slider height-35"
                                                        data-type="double"
                                                        data-grid="false"
                                                        data-hide-from-to="true"
                                                        data-min="0"
                                                        data-max="3456"
                                                        data-from="200"
                                                        data-to="3456"
                                                        data-prefix="$"
                                                        data-result-min="#rangeSliderExample3MinResult"
                                                        data-result-max="#rangeSliderExample3MaxResult">
                      </div>
                    </div>
                  </div>
                </div>
                <div id="shopCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                    <div class="card-collapse" id="shopCategoryHeadingOne">
                      <h3 class="mb-0">
                        <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#shopCategoryOne" aria-expanded="false" aria-controls="shopCategoryOne"> <span class="row align-items-center"> <span class="col-9"> <span class="font-weight-bold font-size-17 text-dark mb-3">Meals</span> </span> <span class="col-3 text-right"> <span class="card-btn-arrow"> <span class="fas fa-chevron-down small"></span> </span> </span> </span> </button>
                      </h3>
                    </div>
                    <div id="shopCategoryOne" class="collapse show" aria-labelledby="shopCategoryHeadingOne" data-parent="#shopCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-4">
                        <!-- Checkboxes -->
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="1">
                            <label class="custom-control-label" for="1">Breakfast Included</label>
                          </div>
                          <span>749</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="2">
                            <label class="custom-control-label" for="2">All-inclusive</label>
                          </div>
                          <span>630</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3">
                            <label class="custom-control-label" for="3">Breakfast & dinner included</label>
                          </div>
                          <span>58</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="4">
                            <label class="custom-control-label" for="4">Kitchen facilities</label>
                          </div>
                          <span>29</span> </div>
                        <!-- End Checkboxes -->
                      </div>
                    </div>
                  </div>
                </div>
                <div id="facilityCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                    <div class="card-collapse" id="facilityCategoryHeadingOne">
                      <h3 class="mb-0">
                        <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#facilityCategoryOne" aria-expanded="false" aria-controls="facilityCategoryOne"> <span class="row align-items-center"> <span class="col-9"> <span class="font-weight-bold font-size-17 text-dark mb-3">Facilities</span> </span> <span class="col-3 text-right"> <span class="card-btn-arrow"> <span class="fas fa-chevron-down small"></span> </span> </span> </span> </button>
                      </h3>
                    </div>
                    <div id="facilityCategoryOne" class="collapse show" aria-labelledby="facilityCategoryHeadingOne" data-parent="#facilityCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-4">
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="Adidas">
                            <label class="custom-control-label" for="Adidas">Parking</label>
                          </div>
                          <span>749</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="NewBalance">
                            <label class="custom-control-label" for="NewBalance">Restaurant</label>
                          </div>
                          <span>630</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="Nike">
                            <label class="custom-control-label" for="Nike">Pet friendly</label>
                          </div>
                          <span>58</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="FredPerry">
                            <label class="custom-control-label" for="FredPerry">Room service</label>
                          </div>
                          <span>29</span> </div>
                        <!-- End Checkboxes -->
                        <!-- View More - Collapse -->
                        <div class="collapse" id="collapseBrand1">
                          <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="brandGucci">
                              <label class="custom-control-label" for="brandGucci">Gucci</label>
                            </div>
                            <span>5</span> </div>
                          <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-3">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="brandMango">
                              <label class="custom-control-label" for="brandMango">Mango</label>
                            </div>
                            <span>1</span> </div>
                        </div>
                        <!-- End View More - Collapse -->
                        <!-- Link -->
                        <a class="link link-collapse small font-size-1" data-toggle="collapse" href="#collapseBrand1" role="button" aria-expanded="false" aria-controls="collapseBrand1"> <span class="link-collapse__default font-size-14">Show all 13</span> <span class="link-collapse__active font-size-14">Show less</span> </a>
                        <!-- End Link -->
                      </div>
                    </div>
                  </div>
                </div>
                <div id="propertyCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                    <div class="card-collapse" id="propertyCategoryHeadingOne">
                      <h3 class="mb-0">
                        <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#propertyCategoryOne" aria-expanded="false" aria-controls="propertyCategoryOne"> <span class="row align-items-center"> <span class="col-9"> <span class="font-weight-bold font-size-17 text-dark mb-3">Property Type</span> </span> <span class="col-3 text-right"> <span class="card-btn-arrow"> <span class="fas fa-chevron-down small"></span> </span> </span> </span> </button>
                      </h3>
                    </div>
                    <div id="propertyCategoryOne" class="collapse show" aria-labelledby="propertyCategoryHeadingOne" data-parent="#propertyCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-4">
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandhotel">
                            <label class="custom-control-label" for="brandhotel">Hotels</label>
                          </div>
                          <span>749</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandapartmet">
                            <label class="custom-control-label" for="brandapartmet">Apartments</label>
                          </div>
                          <span>630</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandbed">
                            <label class="custom-control-label" for="brandbed">Bed and Breakfasts</label>
                          </div>
                          <span>58</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandresorts">
                            <label class="custom-control-label" for="brandresorts">Resorts</label>
                          </div>
                          <span>29</span> </div>
                        <!-- End Checkboxes -->
                        <!-- View More - Collapse -->
                        <div class="collapse" id="collapseBrand2">
                          <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="Gucci">
                              <label class="custom-control-label" for="Gucci">Gucci</label>
                            </div>
                            <span>5</span> </div>
                          <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-3">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="Mango">
                              <label class="custom-control-label" for="Mango">Mango</label>
                            </div>
                            <span>1</span> </div>
                        </div>
                        <!-- End View More - Collapse -->
                        <!-- Link -->
                        <a class="link link-collapse small font-size-1" data-toggle="collapse" href="#collapseBrand2" role="button" aria-expanded="false" aria-controls="collapseBrand2"> <span class="link-collapse__default font-size-14">Show all 39</span> <span class="link-collapse__active font-size-14">Show less</span> </a>
                        <!-- End Link -->
                      </div>
                    </div>
                  </div>
                </div>
                <div id="cityCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                    <div class="card-collapse" id="cityCategoryHeadingOne">
                      <h3 class="mb-0">
                        <button type="button" class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed" data-toggle="collapse" data-target="#cityCategoryOne" aria-expanded="false" aria-controls="cityCategoryOne"> <span class="row align-items-center"> <span class="col-9"> <span class="font-weight-bold font-size-17 text-dark mb-3">City</span> </span> <span class="col-3 text-right"> <span class="card-btn-arrow"> <span class="fas fa-chevron-down small"></span> </span> </span> </span> </button>
                      </h3>
                    </div>
                    <div id="cityCategoryOne" class="collapse show" aria-labelledby="cityCategoryHeadingOne" data-parent="#cityCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-4">
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandamsterdam">
                            <label class="custom-control-label" for="brandamsterdam">Amsterdam</label>
                          </div>
                          <span>749</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandrotterdam">
                            <label class="custom-control-label" for="brandrotterdam">Rotterdam</label>
                          </div>
                          <span>630</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandvalkenburg">
                            <label class="custom-control-label" for="brandvalkenburg">Valkenburg</label>
                          </div>
                          <span>58</span> </div>
                        <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="brandeindhoven">
                            <label class="custom-control-label" for="brandeindhoven">Eindhoven</label>
                          </div>
                          <span>29</span> </div>
                        <!-- End Checkboxes -->
                        <!-- View More - Collapse -->
                        <div class="collapse" id="collapseBrand3">
                          <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="gucci">
                              <label class="custom-control-label" for="gucci">Gucci</label>
                            </div>
                            <span>5</span> </div>
                          <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-3">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="mango">
                              <label class="custom-control-label" for="mango">Mango</label>
                            </div>
                            <span>1</span> </div>
                        </div>
                        <!-- End View More - Collapse -->
                        <!-- Link -->
                        <a class="link link-collapse small font-size-1" data-toggle="collapse" href="#collapseBrand3" role="button" aria-expanded="false" aria-controls="collapseBrand3"> <span class="link-collapse__default font-size-14">Show all 25</span> <span class="link-collapse__active font-size-14">Show less</span> </a>
                        <!-- End Link -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Accordion -->
              </div>
			  </div>
 </div>
 
 <div class="col-lg-8 col-xl-9 order-md-1 order-lg-2 pb-5 pb-lg-0">
        <!-- Shop-control-bar Title -->
         
		
		<div class="card" style="background-color: #fff; padding: 10px !important; margin-bottom:20px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td align="left" style="font-size:16px; font-weight:500;"><?php echo $citydestination; ?>&nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<strong>Check-In:</strong> <?php echo $checkInDate; ?> &nbsp;|&nbsp; <strong>Check-Out: <?php echo $checkOutDate; ?></strong>   </td>
			</tr>
			<tr>
			<td align="left" style=" padding-top:2px; font-size:12px;"><span id="totalhotelcount">0</span> results found.</td>
			</tr>
			</table>
		</div>
		
		
         
        <!-- End shop-control-bar Title -->
        <!-- Slick Tab carousel -->
        <div class="u-slick__tab">
          <!-- Nav Links -->
          <!-- End Nav Links -->
          <!-- Tab Content -->
		  <?php
		  $destination = explode(',',$_GET['citydestination']);
		  $citydestination = $destination[0];
		  $count = 0; 
		  $values = $hotelData->searchResult->his;
		  foreach($values as $hotelList){
		  $count++;
		  
		$datetime1 = date_create($checkInDateapi);
		$datetime2 = date_create($checkOutDateapi);
		$interval = date_diff($datetime1, $datetime2);
		$days = $interval->format('%a');
		
		
		  ?>
		  <form name="hotelform" id="hotelform<?php echo $count; ?>" method="post"  action="display.html?ga=hoteldetails">
		  <input type="hidden" name="action" value="hotelchoosepost" />
		   <input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($hotelBasicJson); ?>" />
		   <input type="hidden" name="hotelJsonData" id="hotelJsonData<?php echo $count; ?>" value="<?php echo htmlentities(json_encode($hotelList,true)); ?>" >
          <div class="tab-content" id="pills-tabContent<?php echo $count; ?>">
            <div class="card" id="pills-three-example<?php echo $count; ?>" role="tabpanel" aria-labelledby="pills-three-example1-tab" data-target-group="groups">
               <div class="row">
					
                      <div class="col-md-5 col-xl-4">
                        <div class="hotelimagelist"><img src="assets/nohotelimg.png" onerror="imgError(this);" data-src="<?php echo $hotelList->img{0}->tns; ?>" class="listimg"></div>
                      </div>
                      <div class="col-md-5 col-xl-5" style="margin-top:20px;">
                        <div class="w-100 position-relative m-4 m-md-0">
                          <div class="mb-1 pb-1"> <span class="badge badge-dark text-white rounded-xs font-size-13 py-1 p-xl-2"><?php echo $hotelList->pt; ?></span> <span class="green-lighter ml-2">
						  <?php for($sc=1; $sc<=$hotelList->rt; $sc++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?>
						  </span> </div>
                          <span class="font-weight-bold font-size-17"><?php echo $hotelList->name; ?></span>  
                         <div class="haddress"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $hotelList->ad->adr; ?> </div>
						 <div class="box">
						 <i class="fa fa-car" aria-hidden="true" title="Car Parking"></i>
						 <i class="fa fa-wifi" aria-hidden="true" title="Internet / Wifi"></i> 
						 <i class="fa fa-cutlery" aria-hidden="true" title="Restaurant"></i>

						 
						 
						 </div> 
                        </div>
                      </div>
					  
                      <div class="col col-xl-3  align-self-center">
                        <div class="d-xl-flex flex-wrap ml-4 ml-xl-0 pr-xl-3 pr-wd-5 text-xl-right justify-content-xl-end ml-xl-10">
                          <div class="d-flex align-items-center justify-content-xl-end"> <span class="font-weight-bold font-size-22">&#8377;<?php echo round($hotelList->pops{0}->tpc); ?></span></div>
                          <div class="hotpricesub">For <?php echo ($adultCount+$childCount); ?> Guest & <?php echo $days; ?> nights</div> 
 <button type="submit" class="btn btn-outline-primary fullwbtn">Select Room</button> 
                        </div>
                      </div>
                    </div>
            </div>
          </div>
		  </form>
		 <?php }  ?> 
		 <script>
		 $('#totalhotelcount').text('<?php echo $count; ?>');
		 </script> 
       
          <!-- End Tab Content -->
        </div>
        <!-- Slick Tab carousel -->
      </div>
 
 
</div> 
			 
 </div>
			

 <?php } ?>
 </div>
 
 <script>
 
 
function gettotalpax(){

var totalpax=0;
$('.pax').each(function(i, obj) {
    totalpax=Number(totalpax+Number($(obj).val())); 
}); 
$('#totalpax').val(totalpax);
 
 
var empcount = $('#empcount').val(); 
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest'); 
}
 
 
function addEmpInfo(){
var empcount = $('#empcount').val();

empcount=Number(empcount)+1;  
$.get("loadchild.php?id="+empcount, function (data) { 
$("#loademployee").append(data); 
}); 

var totalpax = $('#totalpax').val();
$('#empcount').val(empcount); 
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest'); 
}



function removeEmpInfo(id){
$('#empInfoId'+id).remove();
var empcount = $('#empcount').val();
empcount=Number(empcount)-1;  
var totalpax = $('#totalpax').val();
$('#empcount').val(empcount);
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest');
}

document.addEventListener('DOMContentLoaded', function() {
$('.listimg').each(function(i, obj) {
 
var datasrc = $(obj).attr('data-src');
$(obj).attr('src',datasrc); 
});
}, false);

 </script>