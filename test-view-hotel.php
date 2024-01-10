<?php

include "inc.php";
include "config/logincheck.php";
$page = 'hotels';
$selectedpage = 'hotels';

$agentid = $_SESSION['agentUserid'];

if (isset($_POST['action']) && $_POST['action'] == "hotelchoosepost") {
    $hotelArr = json_decode($_POST['hotelJsonData']);

    $jsonPost = '{
	"id": "' . $hotelArr->id . '"
}';


    /*echo '<pre>';
print_r($jsonPost);
echo '</pre>';*/

    $url = "" . $tripjackhotelurl . "hms/v1/hotelDetail-search"; // URL To Hit
    $result = getHotelApiData($url, $jsonPost, $hotelApiKey);
    $hotelArr = json_decode($result);
    $hotelDetail = $hotelArr->hotel;
    /*echo '<pre>';
print_r($result);
echo '</pre>';*/
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title> Hotel - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
    <?php include "headerinc.php"; ?>

    <link rel="stylesheet" href="dist/css/lightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body {
            background-color: #f3f7fa !important;
        }
    </style>
</head>

<body class="greybluebg">

    <?php include "header.php"; ?>


    <section class="hotelgallery phonehotelgallery">
        <div class="container phonehoteldetailcontainer">
            <div class="text-center">
                <img src="" class="img-fluid" id="hotelImage">
            </div>
            <div class="card descriptioncard">
                <div class="card-body">
                    <div class="description">
                        <h1>Stay <span>Details</span></h1>
                        <p id="hotelDescription"></p>
                    </div>
                    <div class="stayamentites">
                        <h1>Stay <span>Amentities</span></h1>
                        <div class="row" id="hotelFacilities">

                        </div>
                    </div>
                </div>
            </div>


            <div class="roomtable" id="pricelist" style="box-shadow: none !important;">
                <!-- <table class="firstrtable">
                    <tbody>
                        <tr>
                            <td>Room</td>
                            <td>Options</td>
                            <td>Guest &amp; Rooms</td>
                            <td>Price</td>
                            <td>Rate Comment</td>
                        </tr>
                    </tbody>
                </table> -->
                <form method="post" onSubmit="proceedToBook(event)">
                    <table class="table table-bordered" style="background: white;border-radius: 15px;border-collapse: unset">
                        <thead>
                            <tr>
                                <th scope="col" style="width:10%" class="text-center">Room</th>
                                <th scope="col" style="width:50%" class="text-center">Rate Comment</th>
                                <th scope="col" style="width:15%" class="text-center">Options</th>
                                <th scope="col" style="width:15%" class="text-center">Guest &amp; Rooms</th>
                                <th scope="col" style="width:10%" class="text-center">Price</th>

                            </tr>
                        </thead>
                        <tbody id="pricelistbody">

                        </tbody>
                    </table>
                    <br>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Proceed to book</button>
                    </div>
                </form>
            </div>


        </div>
        <!-- Modal -->
        <div class="modal fade" id="cancellationPoliciy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="poptitle">Cancellation Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="popcontent">
                        <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" font-size:13px; font-weight:600;">
                            <thead>
                                <tr>
                                    <td bgcolor="#F4F4F4"><strong>From Date</strong></td>
                                    <td bgcolor="#F4F4F4"><strong>To Date</strong></td>
                                    <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>
                                </tr>
                            </thead>
                            <tbody id="appendCancellation">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <?php include "footerinc.php"; ?>
    <?php include "footer.php"; ?>

    <script>
        const hcode = '<?php echo $_GET['hcode']; ?>';
        const searchId = '<?php echo $_GET['searchId']; ?>';
        let hotel_data;

        function fetchHotelDetail() {
            $.ajax({
                url: `test_search_hotel.php/?searchId=${searchId}&hcode=${hcode}`,
                method: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    $("#hotelImage").attr('src', data.hotel.images.url);
                    $("#hotelDescription").html(data.hotel.description);
                    var html = "";
                    var facilities = data.hotel.facilities.split(';');
                    for (var i = 0; i < facilities.length; i++) {
                        if (i == 5) {
                            break;
                        } {
                            html += `<div class="col-md-2"><div class="text-center"><img src="assets/icons/${facilities[i].trim()}.png" style="height:25px;"/></div><div class="text-center">${facilities[i].trim()}</div></div>`;
                        }
                    }
                    $("#hotelFacilities").append(html + `<div class="col" style="display:flex;align-items:center;"><div class="text-center"><button class="btn btn-primary" onClick="showMorefacilities('${facilities}')">Read More</button></div>`);
                    showHotelRates(data);


                }
            });
        }

        function showMorefacilities(facilities) {
            $("#hotelFacilities").empty();
            var facilities = facilities.split(',');
            var html = "";
            for (var i = 0; i < facilities.length; i++) {

                html += `<div class="col-md-2"><div class="text-center"><img src="assets/icons/${facilities[i].trim()}.png" style="height:25px;"/></div><div class="text-center">${facilities[i].trim()}</div></div>`;
            }
            $("#hotelFacilities").append(html + `<div class="col" style="display:flex;align-items:center;"><div class="text-center"><button class="btn btn-primary" onClick="showLessfacilities('${facilities}')">Read Less</button></div>`);
        }

        function showLessfacilities(facilities) {
            $("#hotelFacilities").empty();
            var facilities = facilities.split(',');
            var html = "";
            for (var i = 0; i < facilities.length; i++) {
                if (i == 5)
                    break;
                html += `<div class="col-md-2"><div class="text-center"><img src="assets/icons/${facilities[i].trim()}.png" style="height:25px;"/></div><div class="text-center">${facilities[i].trim()}</div></div>`;
            }
            $("#hotelFacilities").append(html + `<div class="col" style="display:flex;align-items:center;"><div class="text-center"><button class="btn btn-primary" onClick="showMorefacilities('${facilities}')">Read More</button></div>`);
        }

        function showHotelRates(data) {
            hotel_data = data;
            have_to_select = data.no_of_rooms;
            let html = ``;
            for (let i = 0; i < data.hotel.rates.length; i++) {
                let total_adult = 0;
                let total_children = 0;
                for (let j = 0; j < data.hotel.rates[i].rooms.length; j++) {
                    total_adult += data.hotel.rates[i].rooms[j].no_of_adults;
                    total_children += data.hotel.rates[i].rooms[j].no_of_children;
                }
                const refundableIcon = data.hotel.rates[i].non_refundable === true ?
                    '<i class="fa fa-check" aria-hidden="true" style="border:1px solid var(--blue);padding: 3px 3.5px;color: var(--blue);border-radius: 50px;"></i>&nbsp;NON Refundable' :
                    '';

                //cancellationPolicy(data.hotel.rates[i].cancellation_policy);
                var cancellationPolicy = JSON.stringify(data.hotel.rates[i].cancellation_policy);
                console.log(cancellationPolicy);
                html += `<tr>
                    <td class="text-center"> 
                        <div class="Premium">
                            <h1>${data.hotel.rates[i].rooms[0].description}</h1>
                            <div class="rebox">
                                <p style="cursor:pointer;" data-toggle="modal" data-target="#cancellationPoliciy" data-policy=${cancellationPolicy} onclick="handleCancellationPolicy(this)">Cancellation Policy</p>
                            </div>
                            
                        </div>
                    </td>
                    <td class="text-center">
                        <div style="height: 100px;overflow: auto;">
                            <p>${data.hotel.rates[i].rate_comments.comments != undefined ? data.hotel.rates[i].rate_comments.comments:''}</p>
                            <p>${data.hotel.rates[i].rate_comments.pax_comments != undefined ? data.hotel.rates[i].rate_comments.pax_comments:''}</p>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="recomd">
                            <p style="cursor:pointer;">
                                ${refundableIcon}</p>
                            <div>
                                <i class="fa fa-check" aria-hidden="true"></i> ROOM ONLY
                                <p class="hotels_amenities moreaminities" style="display: none;">
                                    <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #ffc107; margin-right:2px;"></i> Room Mirror
                                </p>
                                <!-- Other amenities -->
                                <p class="hotels_amenities showless" style="padding-left: 15px; cursor: pointer; font-weight: 700; color: rgb(0, 0, 0) !important; display: none;" onclick="$('.moreaminities').hide();$('.loadmore').show();$('.showless').hide();">Less...</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <i class="fa fa-building" aria-hidden="true"></i> Rooms ${data.hotel.rates[i].no_of_rooms}
                        <i class="fa fa-user" aria-hidden="true"></i> Adults ${total_adult}
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Child ${total_children}
                    </td>
                    <td class="text-center">
                    <div style="color:#666666;">Total Price</div><div style="font-size:24px; color:#000000; font-weight:700; margin-bottom:5px;">₹${data.hotel.rates[i].price}&nbsp;<input type="checkbox" name="selectedRates" value='${JSON.stringify(data.hotel.rates[i])}'/></td></div>
                    
                </tr>`;
            }
            $("#pricelistbody").append(html);
        }

        function proceedToBook(event) {
            event.preventDefault();
            let totalSelectedRooms = 0;
            let selected_items = [];
            const checkboxes = document.querySelectorAll('input[name="selectedRates"]:checked');
            const checkedValues = Array.from(checkboxes).map(checkbox => {
                try {
                    return JSON.parse(checkbox.value);
                } catch (error) {
                    console.error('Error parsing checkbox value:', error);
                    return null; // or handle the error accordingly
                }
            }).filter(Boolean);

            checkedValues.forEach(room => {
                selected_items.push(room);
                totalSelectedRooms += room.no_of_rooms;
            });

            if (totalSelectedRooms === have_to_select) {
                hotel_data.hotel.rates = []; // Clear existing rates
                hotel_data.hotel.rates.push(...selected_items); // Push selected_items into rates array

                // Storing in localStorage
                localStorage.removeItem('selectedHotelRates');
                localStorage.setItem('selectedHotelRates', JSON.stringify(hotel_data));
                window.location.href = 'test_hotel_review.php';
            } else {
                toastr.success(`You have to select ${have_to_select} rooms!`, 'Success', {
                    closeButton: true,
                    progressBar: true
                });
            }
        }

        function handleCancellationPolicy(element) {
            $("#appendCancellation").empty();
            let data = JSON.parse(element.getAttribute('data-policy'));
            let cancelationhtml = '';
            for (var j = 0; j < data.details.length; j++) {
                cancelationhtml += `<tr>
                            <td style="border-bottom: 1px solid #ddd;">${localTimeZone(data.details[j].from)}</td>
                            <td style="border-bottom: 1px solid #ddd;">${data.details[j].cancel_by_date !== undefined ? localTimeZone(data.details[j].cancel_by_date) : ''}</td>
                            <td style="border-bottom: 1px solid #ddd;">₹${data.details[j].flat_fee}</td>
                         </tr>`;

                if (data.no_show_fee !== undefined) {
                    cancelationhtml += `<tr><td>No show fee</td><td></td><td>₹${data.no_show_fee.flat_fee}</td></tr>`;
                }
            }

            $("#appendCancellation").append(cancelationhtml);
        }



        function localTimeZone(data) {
            const date = new Date(data + 'Z'); // Appending 'Z' indicates UTC time

            const ISTTime = date.toLocaleString('en-US', {
                timeZone: 'Asia/Kolkata'
            });
            return ISTTime;
        }

        fetchHotelDetail();
    </script>

    <script src="dist/js/lightbox-plus-jquery.min.js"></script>


</body>

</html>