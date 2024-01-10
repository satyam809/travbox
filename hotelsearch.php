<?php

include "inc.php";

include "config/logincheck.php";

$page = 'hotels';

$selectedpage = 'hotels';

function gethotelimgna($imgname)
{

    if (strpos($imgname, 'HotelNA.jpg') !== false) {

        return 'images/nohotelimage.png';
    } else {

        return $imgname;
    }
}

$agentid = $_SESSION['agentUserid'];


?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



    <title>Hotel Search - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>

    <?php include "headerinc.php"; ?>





    <style>
        .col-2 .card:first-child {
            margin-top: 0px;
        }

        .col-9 .card:first-child {
            margin-top: 0px;
        }
    </style>



</head>



<body class="greybluebg">



    <?php include "header.php"; ?>

    <div class="top_bg_ofr_sb top_bg_ofr_sb2other homeflightsearchouterbox hotelmainbg" style="margin-bottom: 90px;padding: 50px 0px;">





        <div class="container mobilecontainer" style="padding:0px 20px;">

            <div class="flightsearchwihite hotelsearchwhite">



                <script>
                    $(document).mouseup(function(e)

                        {

                            var container = $("#fromflightdestination");

                            if (!container.is(e.target) && container.has(e.target).length === 0)

                            {

                                $('#searchcitylistsfromCity').hide();

                            } else {



                                $('#searchcitylistsfromCity2').hide();

                            }



                            var container = $("#toflightdestination");

                            if (!container.is(e.target) && container.has(e.target).length === 0)

                            {

                                $('#searchcitylistsfromCity2').hide();

                            } else {



                                $('#searchcitylistsfromCity').hide();

                            }

                        });
                </script>

                <div class="searchboxouter flightsearchhomebox hotelboxouter">

                    <form method="post" id="hotelSearch" onSubmit="hotelSearch(event)">
                        <input type="hidden" name="hotel-list" value='1'>

                        <div class="tableborder hoteltableborder">

                            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                                <tbody>
                                    <tr>

                                        <td width="20%" align="left" valign="top" id="fromflightdestination">

                                            <div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity3"></div>

                                            <div class="lable" id="fromlabel"><span class="cityspan">Enter city name,</span> Location</div>

                                            <label>

                                                <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>

                                                <input type="text" class="textfield" requered="" onKeyUp="getSearchHotel(event)" name="searchDestination" autocomplete="nope" value="">

                                                <input type="hidden" name="hotel_codes" value="">
                                            </label>

                                            <div class="swapbtn hotelswapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
                                        </td>

                                        <td width="15%" align="left" valign="top" class="form-group">
                                            <label>
                                                <div class="lable">CHECK IN</div>
                                            </label>
                                            <div style="margin: 11px 0px;">
                                                <input type="date" name="checkInDate" class="form-control" style="border: none !important;" onChange="validateCheckOut(this.value)">
                                            </div>
                                        </td>

                                        <td width="15%" align="left" valign="top" class="form-group">

                                            <label>
                                                <div class="lable">CHECK OUT</div>
                                            </label>
                                            <div style="margin: 11px 0px;">
                                                <input type="date" name="checkOutDate" class="form-control" style="border: none !important;">
                                            </div>
                                        </td>



                                        <td width="20%" align="left" valign="top">

                                            <div class="lable" id="roomAndGuest" onclick="$('#basicDropdownClick').show()">Rooms &amp; Guests</div>
                                            <input type="text" name="travellers" class="textfield" value="1 Room - 1 Guest" autocomplete="nope" readonly="readonly" onclick="$('#basicDropdownClick').show();">
                                            <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="width: max-content; padding: 10px; right: 0px; display: none;">
                                                <div class=" " style="margin-bottom: 10px; width:100%; position:relative;">
                                                    <strong>Guests</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onclick="$('#basicDropdownClick').hide();"></i>
                                                </div>
                                                <div class="row" style="margin-right: 0px; margin-left: 1px;" id="addGuest<?php static $i = 1;
                                                                                                                            echo $i; ?>">
                                                    <div class="roomguestblockdiv">
                                                        <div class="form-group">
                                                            <div style="font-weight: 500; margin-top:27px;" class="romonecalendar">Room - <?php echo $i; ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="roomguestblockdiv">
                                                        <div class="form-group"> <label>Adult</label>
                                                            <select class="form-control select2 pax" name="adults">
                                                                <option value="1" selected>1 Adult</option>
                                                                <option value="2">2 Adults</option>
                                                                <option value="3">3 Adults</option>
                                                                <option value="4">4 Adults</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="roomguestblockdiv">
                                                        <div class="form-group"><label>Child</label>
                                                            <select class="form-control select2 pax" name="childs" onchange="childAge(this.value,<?php echo $i; ?>)">
                                                                <option value="0" selected="selected">0 Child</option>
                                                                <option value="1">1 Child</option>
                                                                <option value="2">2 Childs</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="addGuestChilds<?php echo $i; ?>" style="width:auto"></div>
                                                    <div class="roomguestblockdiv" style="display:flex;justify-content:center;align-items:center;">
                                                        <div class="form-group">
                                                            <i class="fa fa-plus" aria-hidden="true" style="margin-top: 29px; cursor: pointer; background-color: #000; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;" onclick="addGuest();"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>



                                        <td width="15%" align="left" valign="top">

                                            <div class="lable" id="travellable">Hotel&nbsp;Category</div>

                                            <input type="text" id="starcategory" class="textfield" value="3,4 star" autocomplete="nope" readonly="readonly" onClick="$('#basicDropdownClickstar').show();">

                                            <input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch mobileshow">
                                            <div id="basicDropdownClickstar" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker">
                                                <div class=" " style="margin-bottom: 10px; width:100%; position:relative;">
                                                    <strong>Star Category</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClickstar').hide();"></i>
                                                </div>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;">
                                                    <tr>
                                                        <td><label><input name="category" type="checkbox" value="3" style="width: 20px; height: 16px; float: left; margin-right: 3px;" checked /> 3 Star</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label><input name="category" type="checkbox" value="4" style="width: 20px; height: 16px; float: left; margin-right: 3px;" checked /> 4 Star</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label><input name="category" type="checkbox" value="5" style="width: 20px; height: 16px; float: left; margin-right: 3px;" /> 5 Star</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label><input name="category" type="checkbox" value="6" style="width: 20px; height: 16px; float: left; margin-right: 3px;" /> 6 Star</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label><input name="category" type="checkbox" value="7" style="width: 20px; height: 16px; float: left; margin-right: 3px;" /> 7 Star</label></td>
                                                    </tr>
                                                </table>

                                            </div>

                                        </td>
                                        <td width="15%" align="left" valign="top">
                                            <div class="lable">Nationality</div>
                                            <select id="starcategory" class="textfield" name="client_nationality">
                                                <option value="IN">Indian</option>
                                                <option value="US">United States</option>
                                                <option value="AU">Australia</option>
                                                <option value="CN">China</option>
                                                <option value="TH">Thailand</option>
                                                <option value="ES">Spain</option>
                                            </select>
                                        </td>

                                       





                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="flightsearchbtn hotelsearchbtn">
                            <button type="submit" name="Submit" class="redbuttonsearch hotelseachbtn" id="addLoading">Search Hotels</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>











    <div class="container" style="margin-top:20px; margin-bottom:20px;">
        <div class="row" style="display:none;" id="hotelFilterList">
            <div class="col-lg-3 filtersidebar hotelfilter">
                <div class="card">
                    <div class="card-header"> Enter Hotel Name, Location </div>
                    <div class="card-body">
                        <input type="text" id="search" class="form-control" placeholder="Enter Keyword">
                    </div>
                    <div class="card-header"> Price Range </div>
                    <div class="card-body">
                        <div class="">
                            <p class="range-value">
                                <input type="text" id="amountfilter" readonly="" style="border: 0px;">
                            </p>
                            <div id="slider-ranges" class="range-bar ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-header"> Star Rating </div>
                    <div class="card-body" id="allFilterDiv">
                        <div class="arranddep">
                            <label id="1star" style="display:none;">
                                <input type="checkbox" value="1star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 1 Star </label>
                            <label id="2star" style="display:none;">
                                <input type="checkbox" value="2star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 2 Star </label>
                            <label id="3star" style="display:none;">
                                <input type="checkbox" value="3star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 3 Star </label>
                            <label id="4star" style="">
                                <input type="checkbox" value="4star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 4 Star </label>
                            <label id="5star" style="">
                                <input type="checkbox" value="5star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 5 Star </label>
                        </div>
                    </div>
                    <div class="card-header"> Property Type </div>
                    <div class="card-body" id="allFilterDiv3">
                        <div class="arranddep" style="max-height:250px; overflow-y: auto;">
                            <label id="hoteltypeaparthotel" style="display:none;">
                                <input type="checkbox" value="hoteltypeaparthotel" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Aparthotel </label>
                            <label id="hoteltypeapartment" style="">
                                <input type="checkbox" value="hoteltypeapartment" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Apartment </label>
                            <label id="hoteltypebungalow" style="display:none;">
                                <input type="checkbox" value="hoteltypebungalow" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Bungalow </label>
                            <label id="hoteltypecabin" style="display:none;">
                                <input type="checkbox" value="hoteltypecabin" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Cabin </label>
                            <label id="hoteltypechalet" style="display:none;">
                                <input type="checkbox" value="hoteltypechalet" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Chalet </label>
                            <label id="hoteltypecondo" style="display:none;">
                                <input type="checkbox" value="hoteltypecondo" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Condo </label>
                            <label id="hoteltypecottage" style="display:none;">
                                <input type="checkbox" value="hoteltypecottage" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Cottage </label>
                            <label id="hoteltypeentire-apartment" style="display:none;">
                                <input type="checkbox" value="hoteltypeentire-apartment" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Entire apartment </label>
                            <label id="hoteltypefarm-house" style="display:none;">
                                <input type="checkbox" value="hoteltypefarm-house" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Farm House </label>
                            <label id="hoteltypeguest-accommodation" style="display:none;">
                                <input type="checkbox" value="hoteltypeguest-accommodation" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Guest Accommodation </label>
                            <label id="hoteltypeguest-house" style="display:none;">
                                <input type="checkbox" value="hoteltypeguest-house" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Guest House </label>
                            <label id="hoteltypehomes" style="display:none;">
                                <input type="checkbox" value="hoteltypehomes" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Homes </label>
                            <label id="hoteltypehomestay" style="display:none;">
                                <input type="checkbox" value="hoteltypehomestay" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Homestay </label>
                            <label id="hoteltypehomestays" style="display:none;">
                                <input type="checkbox" value="hoteltypehomestays" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Homestays </label>
                            <label id="hoteltypehostel" style="display:none;">
                                <input type="checkbox" value="hoteltypehostel" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Hostel </label>
                            <label id="hoteltypehotel" style="">
                                <input type="checkbox" value="hoteltypehotel" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Hotel </label>
                            <label id="hoteltypehouse" style="">
                                <input type="checkbox" value="hoteltypehouse" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> House </label>
                            <label id="hoteltypeinn" style="">
                                <input type="checkbox" value="hoteltypeinn" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Inn </label>
                            <label id="hoteltypelodge" style="display:none;">
                                <input type="checkbox" value="hoteltypelodge" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Lodge </label>
                            <label id="hoteltypelove-hotel" style="display:none;">
                                <input type="checkbox" value="hoteltypelove-hotel" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Love hotel </label>
                            <label id="hoteltypemotel" style="display:none;">
                                <input type="checkbox" value="hoteltypemotel" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Motel </label>
                            <label id="hoteltypeoyo-rooms" style="display:none;">
                                <input type="checkbox" value="hoteltypeoyo-rooms" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Oyo Rooms </label>
                            <label id="hoteltypeoyoxdesign" style="display:none;">
                                <input type="checkbox" value="hoteltypeoyoxdesign" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> OYOxDesign </label>
                            <label id="hoteltypepalace" style="">
                                <input type="checkbox" value="hoteltypepalace" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Palace </label>
                            <label id="hoteltypepalette" style="display:none;">
                                <input type="checkbox" value="hoteltypepalette" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Palette </label>
                            <label id="hoteltypepremium" style="display:none;">
                                <input type="checkbox" value="hoteltypepremium" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Premium </label>
                            <label id="hoteltyperesidence" style="display:none;">
                                <input type="checkbox" value="hoteltyperesidence" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Residence </label>
                            <label id="hoteltyperesort" style="">
                                <input type="checkbox" value="hoteltyperesort" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Resort </label>
                            <label id="hoteltyperiad" style="display:none;">
                                <input type="checkbox" value="hoteltyperiad" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Riad </label>
                            <label id="hoteltypeserviced-apartment" style="display:none;">
                                <input type="checkbox" value="hoteltypeserviced-apartment" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Serviced apartment </label>
                            <label id="hoteltypesilverkey" style="display:none;">
                                <input type="checkbox" value="hoteltypesilverkey" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Silverkey </label>
                            <label id="hoteltypetourist" style="display:none;">
                                <input type="checkbox" value="hoteltypetourist" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Tourist </label>
                            <label id="hoteltypevillas" style="display:none;">
                                <input type="checkbox" value="hoteltypevillas" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> Villas </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9" id="hotelResult"></div>
        </div>
        <div class="row offerrow" id="hotelOffer">
            <div class="offerheading">
                <h3>Exclusive Hotels Deals</h3>
            </div>
            <div class="col-lg-3">
                <div class="offersection">
                    <a onclick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&amp;id=202565583" style="cursor:pointer;">
                        <div class="offerimg">
                            <img src="https://ofc.travbox.travel/upload/16770098992067123421675195499.jpg" alt="Enjoy Assured Stays in Clean Rooms with AC, TV &amp; Free Wi-Fi">
                        </div>
                    </a>

                    <h4 class="mt-2">Enjoy Assured Stays in Clean Rooms with AC, TV &amp; Free Wi-Fi</h4>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="offersection">
                    <a onclick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&amp;id=202565580" style="cursor:pointer;">
                        <div class="offerimg">
                            <img src="https://ofc.travbox.travel/upload/16770094202512181651675195020.jpg" alt="Grab Up to Rs. 8000 OFF* on International Hotels.">
                        </div>
                    </a>

                    <h4 class="mt-2">Grab Up to Rs. 8000 OFF* on International Hotels.</h4>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="offersection">
                    <a onclick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&amp;id=202565579" style="cursor:pointer;">
                        <div class="offerimg">
                            <img src="https://ofc.travbox.travel/upload/16770093952702588181675194995.webp" alt="Get up to 15% instant discount*">
                        </div>
                    </a>

                    <h4 class="mt-2">Get up to 15% instant discount*</h4>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="offersection">
                    <a onclick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&amp;id=202565584" style="cursor:pointer;">
                        <div class="offerimg">
                            <img src="https://ofc.travbox.travel/upload/16770099301543219401675195530.jpeg" alt="Book your Stay for a minimum 3 nights and pay for just 2!">
                        </div>
                    </a>

                    <h4 class="mt-2">Book your Stay for a minimum 3 nights and pay for just 2!</h4>

                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>


    <script>
        const today = new Date().toISOString().split('T')[0];
        $("input[name='checkInDate']").val(today);

        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1); // Using 'tomorrow' instead of 'today' here
        const tomorrowFormatted = tomorrow.toISOString().split('T')[0];
        $("input[name='checkOutDate']").val(tomorrowFormatted);

        const checkboxes = document.querySelectorAll('input[name="category"]');
        const starCategoryInput = $("#starcategory");

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const checkedCheckboxes = document.querySelectorAll('input[name="category"]:checked');

                if (checkedCheckboxes.length > 2) {
                    this.checked = false; // Uncheck the current checkbox
                }

                if (checkedCheckboxes.length <= 2) {
                    const starCategoryString = Array.from(checkedCheckboxes)
                        .map(checkbox => checkbox.value)
                        .join(', ') + ' Star';

                    starCategoryInput.val(starCategoryString);
                }
            });
        });



        function childAge(value, childId) {
            $(`#addGuestChilds${childId}`).empty();
            var html = ``;
            // console.log(childId);
            for (var i = 0; i < value; i++) {
                html += `<div class="roomguestblockdiv">
					<div class="form-group">${ childId == 1 ? '<label>Child Age</label>' : '<label></label>'}  
					<select class="form-control" name="age"> 
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
						<option value="10">10</option>
						<option value="11">11</option>
					</select> 
					</div>
					</div>`;
            }
            $(`#addGuestChilds${childId}`).append(html);
        }
        var guestId = 1;

        function addGuest() {
            guestId++;
            var html = `
        <div class="row" style="margin-right: 0px; margin-left: 1px;" id="addGuest${guestId}">
            <div class="roomguestblockdiv">
				<div class="form-group">   
					<div style="font-weight: 500; margin-top:27px;" class="romonecalendar">Room - ${guestId}</div>
				</div>
			</div>
            <div class="roomguestblockdiv">
                <div class="form-group">
                <label></label>
                    <select class="form-control select2 pax" name="adults">
                        <option value="1" selected>1 Adult</option>
                        <option value="2">2 Adults</option>
                        <option value="3">3 Adults</option>
                        <option value="4">4 Adults</option>
                    </select>
                </div>
            </div>
            <div class="roomguestblockdiv">
                <div class="form-group">
                <label></label>
                    <select class="form-control select2 pax" name="childs" onchange="childAge(this.value, ${guestId})">
                        <option value="0" selected="selected">0 Child</option>
                        <option value="1">1 Child</option>
                        <option value="2">2 Childs</option>
                    </select>
                </div>
            </div>
            <div id="addGuestChilds${guestId}" style="width:auto"></div>
            <div class="roomguestblockdiv" style="display:flex;justify-content:center;align-items:center;">
                <div class="form-group">
                    <i class="fa fa-trash" aria-hidden="true" style="margin-top:6px; cursor: pointer; background-color: #f1646c; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px; margin-left: 2px;" onclick="removeGuest(${guestId});"></i>
                </div>
            </div>
        </div>`;
            $("#basicDropdownClick").append(html);
        }


        function removeGuest(guestId) {
            $(`#addGuest${guestId}`).remove();
        }


        let timer;

        function debounce(func, delay) {
            clearTimeout(timer);
            timer = setTimeout(func, delay);
        }

        function getSearchHotel(e) {
            debounce(function() {
                $.ajax({
                    url: "test_search_hotel.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        search_hotel: e.target.value
                    },
                    success: function(result) {
                        let html = `<div class="searchdestinationboxclass">`;
                        for (let i = 0; i < result.length; i++) {
                            html += `<div class="list" onClick="setSearchDestination('${result[i].address}',${result[i].hotel_codes})">${result[i].address}<div style="font-size:11px; color:#666666;">${result[i].city_name}</div></div>`;
                        }
                        html += `</div>`;
                        $("#searchcitylistsfromCity3").empty().append(html);
                    }
                });
            }, 300); // Adjust the delay (in milliseconds) as needed
        }



        function setSearchDestination(search, hotel_codes) {
            $("input[name=searchDestination]").val(search);
            $("input[name=hotel_codes]").val(hotel_codes)
            $("#searchcitylistsfromCity3").hide();
        }

        function hotelSearch(event) {
            event.preventDefault();
            var checkin = new Date($("input[name=checkInDate]").val());
            var checkout = new Date($("input[name=checkOutDate]").val());
            var data = {
                rates: "comprehensive",
                currency: "INR",
                client_nationality: $("select[name=client_nationality]").val(),
                checkin: formatDateToYearMonthDay(checkin),
                checkout: formatDateToYearMonthDay(checkout),
                hotel_category: $("input[name='category']:checked").map(function() {
                    return $(this).val();
                }).get(),
                hotel_codes: [],
                rooms: [],
                cutoff_time: 25000
            };

            // var hotelCategoryInput = $("input[name=hotel_category]").val();
            // data.hotel_category = hotelCategoryInput.split(",").map(category => category.trim());
            //data.hotel_codes.push($("input[name=hotel_codes]").val());
            // const hotel_code_list = ["1226107", "1226007", "1226039", "1226037", "1226021", "1226091", "1226098"];
            data.hotel_codes.push("1848138", "1226107", "1226007", "1226039", "1226037", "1226021", "1226091", "1226098");
            var adults = $("select[name='adults']").map(function() {
                return $(this).val();
            }).get();
            var childs = $("select[name='childs']").map(function() {
                return $(this).val();
            }).get();
            var childrenAge = $("select[name='age']").map(function() {
                return $(this).val();
            }).get();
            for (var i = 0; i < adults.length; i++) {
                data.rooms.push({
                    adults: adults[i],
                    children_ages: childrenAge.splice(0, childs[i])
                });
            }
            // console.log(JSON.stringify(data));
            // die;

            $.ajax({
                url: 'test_search_hotel.php',
                method: 'POST',
                data: {
                    'data': data,
                    'hotel-list': 1
                }, // Use an object to send the data
                dataType: 'JSON',
                beforeSend: function() {
                    $("#addLoading").html(`<span class="spinner-border spinner-border-sm"></span>
                    Loading..`)
                },
                success: function(data) {
                    console.log(data);
                    $("#hotelResult").empty();
                    $("#hotelFilterList").show();
                    var guest = data.no_of_children != undefined ? data.no_of_children : 0;
                    $("input[name=travellers]").val(`${data.no_of_rooms} Rooms - ${data.no_of_adults + guest} Guests`)
                    $("#addLoading").html(`Search Hotels`);
                    renderHotelResults(data.hotels, data.search_id);

                }
            });
        }


        function renderHotelResults(hotels, search_id) {
            var hotelElements = [];
            var hotelElement = `<h1 class="hotelseachheading" style="position:relative;">Showing Hotels in Delhi <select name="filterbyprice" id="filterbyprice" onchange="getSortedPrice();" style="position: absolute; right: 0px; font-size: 13px; font-weight: 700; padding: 5px; border: 1px solid #ddd; border-radius: 5px; outline: 0px;">

            <option value="1" selected="selected">Price Low to High</option>

            <option value="2">Price High to Low</option>

            </select></h1>`;
            var hotelList = "";
            for (var i = 0; i < hotels.length; i++) {
                //var hotel = hotels[i];
                var facilities = hotels[i].facilities.split(";");
                var category = hotels[i].category;
                var min_price = hotels[i].rates.map(rate => rate.price);

                var facilityItems = facilities.slice(0, 6).map(facility => `<div class="tbl"><i class="fa fa-user-circle-o" aria-hidden="true"></i> ${facility.trim()}</div>`).join('');

                var stars = Array(Math.round(category)).fill('<i class="fa fa-star" aria-hidden="true"></i>').join('');

                hotelList += `
                <div class="row bookrow hotelbookrow hotelsearchlist hotelboxx">
                    <div class="col-lg-9">
                    <div class="hotelbooking">
                        <div class="hotelimg">
                        <img src="${hotels[i].images.url}" onerror="this.onerror=null;this.src='images/nohotelimage.png';" data-src="https://fastui.cltpstatic.com/image/upload/hotels/places/hotels/cms/3986/3986252/images/image_3986252_5d614046-bd07-4e4e-816d-5fde42379558_tn.jpeg">
                        </div>
                        <div class="hoteltext">
                        <h5>${hotels[i].name}</h5>
                        <div class="reviewsection">
                            <p class="threeblue">HOTEL</p> 
                            <span class="starcatht">${stars}</span>
                        </div>
                        <p class="relocation"><i class="fa fa-map-marker" aria-hidden="true"></i>${hotels[i].address}</p>
                        <div class="Deluxe">${facilityItems}</div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="bookbtn">
                        <h4>₹${Math.min(...min_price)}</h4>
                        <div class="blackbox">
                        <h5>Start From</h5>
                        </div>
                        <a href="test-view-hotel.php?searchId=${search_id}&hcode=${hotels[i].hotel_code}" class="btn btn-danger" style="width:100%;">View Room</a>
                    </div>
                    </div>
                </div>
                `;



            }
            //console.log(hotelElements);

            $("#hotelOffer").remove();
            //console.log(JSON.stringify(hotelElements));
            $("#hotelResult").append(hotelElements += hotelList);
        }







        function formatDateToYearMonthDay(date) {
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }


        function formatDateToYearMonthDay(date) {
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is 0-based, so add 1
            const day = date.getDate().toString().padStart(2, '0');

            return `${year}-${month}-${day}`;
        }

        function validateCheckOut(checkIn) {
            // Get the elements
            const checkInDateInput = new Date(checkIn);
            const checkOutDateInput = $("input[name='checkOutDate']").val();
            const checkOutDate = new Date(checkOutDateInput);

            // Update the min attribute of check-out date input to the check-in date + 1 day
            const nextDay = new Date(checkInDateInput);
            nextDay.setDate(checkInDateInput.getDate() + 1); // Adding one day
            const nextDayFormatted = nextDay.toISOString().split('T')[0]; // Formatting date to YYYY-MM-DD
            $("input[name='checkOutDate']").attr('min', nextDayFormatted);

            // If the check-out date is already selected and is before the updated min date, reset it
            if (checkOutDate < nextDay) {
                $("input[name='checkOutDate']").val(nextDayFormatted);
            }
        }
    </script>

</body>

</html>