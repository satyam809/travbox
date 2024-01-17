<?php

include "inc.php";

include "config/logincheck.php";

$page = 'hotels';

if (decode($_REQUEST['i']) > 0) {
  $a = GetPageRecord('*', 'flightBookingMaster', ' id="' . decode($_REQUEST['i']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');

  $rest = mysqli_fetch_array($a);
}
if ($_REQUEST['r'] != '') {

  $ab = GetPageRecord('*', 'flightBookingMaster', ' id="' . decode($_REQUEST['r']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');

  $resreturn = mysqli_fetch_array($ab);
}

if ($rest['id'] != '') {

  $a = GetPageRecord('*', 'flightBookingMaster', ' id="' . $rest['id'] . '" ');

  $editresult = mysqli_fetch_array($a);
}
$a = GetPageRecord('*', 'flightBookingMaster', ' id="' . decode($_REQUEST['i']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');

$restone = mysqli_fetch_array($a);
$ab = GetPageRecord('*', 'flightBookingMaster', ' id="' . decode($_REQUEST['r']) . '" and agentId="' . $_SESSION['agentUserid'] . '"');

$restreturntwo = mysqli_fetch_array($ab);
?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Flight Voucher - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>

  <?php include "headerinc.php"; ?>

  <style>
    .showonlyaftercheck {
      display: none;
    }

    #DivIdToPrint {
      width: 958px;
      margin: auto;
      padding: 10px;
      border: 1px solid #ddd;
    }

    #DivIdToPrint2 {
      width: 958px;
      margin: auto;
      padding: 10px;
      border: 1px solid #ddd;
    }

    .container table tr td {
      padding: 5px !important;
    }
  </style>

</head>

<body>
  <?php include "header.php"; ?>
  <div class="container" style="margin-top:20px; margin-bottom:20px;">
    <h2>Confirm Hotel Booking</h2>
    <div class="row">

      <div class="col-12">

        <div class="card">

          <div class="card-body">
            <div id="DivIdToPrint">
              <table width="100%" border="0" cellspacing="0" cellpadding="5" style=" ">
                <tbody>
                  <tr>
                    <td width="50%" align="left" valign="top" style="border-bottom:1px solid #ddd;" class="hcompanyinfo"><img src="https://ofc.travbox.travel/upload/" height="55"></td>
                    <td width="50%" style="border-bottom:1px solid #ddd;" class="hcompanyinfo">
                      <strong>Tripzygo International</strong> <br>
                      <strong>Phone:</strong><span id="phone"></span> <br>
                      <strong>Email:</strong><span id="email"></span> <br>
                      <strong>Address:</strong><span id="address"></span>
                    </td>
                  </tr>
                  <tr>
                    <td width="50%" style="border-bottom:1px solid #ddd;">
                      <br><strong>Booking ID:</strong><span id="bookingId"></span>
                    </td>
                    <td width="50%" style="border-bottom:1px solid #ddd;">Confirmation No.: <br>
                      Confirmed By: </td>
                  </tr>
                  <tr>
                    <td width="50%"><strong></strong> <br>
                    </td>
                    <td width="50%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tbody>
                          <tr>
                            <td colspan="4" bgcolor="#BBE8F7"><strong></strong></td>
                          </tr>
                          <tr>
                            <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Check In<br>
                              <strong id="checkIn"></strong>
                            </td>
                            <td width="25%" bgcolor="#E4F7FC" style="background-color:#D3F0FA;">Check Out<br>
                              <strong id="checkOut"></strong>
                            </td>
                            <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Total Rooms<br>
                              <strong id="totalRooms"></strong>
                            </td>
                            <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Total stay<br>
                              <strong id="totalStay"></strong>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr id="paxDetails">
                    <td width="50%" style="border-bottom:1px solid #ddd;">
                      <strong>Pax Details</strong>
                    </td>
                    <td width="50%" align="center" style="border-bottom:1px solid #ddd;">&nbsp; </td>
                  </tr>

                  <tr>
                    <td width="50%" style="border-bottom:1px solid #ddd;"><strong>Contact Details</strong> <br>
                      Email : <span id="contactEmail"></span><br>
                      Mobile : <span id="contactMobile"></span></td>
                    <td width="50%" style="border-bottom:1px solid #ddd;">&nbsp;</td>
                  </tr>


                </tbody>
              </table>
              <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                  <tr>
                    <td colspan="2" style="border-bottom:1px solid #ddd;"><strong>Cancellation Policy</strong><br>
                      <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" font-size:13px; font-weight:600;">
                        <tbody>
                          <tr id="cancellationPolicy">
                            <td bgcolor="#F4F4F4"><strong>From Date</strong></td>
                            <td bgcolor="#F4F4F4"><strong>To Date</strong></td>
                            <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>
                          </tr>

                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border-bottom:1px solid #ddd;"><strong>Booking Notes</strong><br><br>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border-bottom:1px solid #ddd;"><strong>General Terms &amp; Conditions</strong><br>
                      1. Each country/state may have its own set of COVID-19 guidelines and restrictions. Please check with the
                      hotel or visit the country's/state's website for the same.<br>
                      2. Your booking is confirmed. However, your name will be listed in the hotel's reservation system closer to
                      your arrival date.<br>
                      3. Guest Photo Id must be presented at the time of check-in.<br>
                      4. Credit card or cash deposit may be required for extra services at the time of check-in.<br>
                      5. All extra charges will be borne by the guest directly prior to departure.<br>
                      6. In case of the guest arrival delayed or postponed due to any unforeseen occurrences, additional charges
                      will be borne by the guest.<br>
                      7. In case of incorrect residency and nationality chosen by the user at the time of booking, additional
                      charges may be applicable which will be borne by the guest and paid to the hotel at the time of
                      checkin/check-out.<br>
                      8. Any special requests are all subject to availability at the time of check-in and are not guaranteed at
                      the
                      time of booking (bed type, smoking room, early check-in, late check-out etc.).<br>
                      9. Full cancellation charges are applicable on early check-out unless otherwise specified.<br>
                      10. Hotels do not permit unmarried or unrelated couples and it is at the hotel management's discretion to
                      allow or cancel the booking. In such case no refund is applicable if the hotel disallows check-in.<br>
                      11. City tax and resort fee (if any) are to be paid directly to the hotel.<br>
                      12. If your booking offers complimentary car transfer you need to inform the hotel of your travel details 24
                      hours prior to check-in.<br>
                      13. Additional GST Payment (if any) to be paid to the hotel directly by the guest.<br></td>
                  </tr>

                  <tr>
                    <td width="89%" style="font-size:15px; text-align:right" class="withoutfare">

                      <strong>FARE SUMMARY</strong>
                    </td>
                    <td width="11%" align="right" style="font-size:16px;" class="withoutfare">₹<span id="displayhtotalamount"></span></td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div style="width: 100%; text-align: center; margin-top: 10px;">
              <button type="button" class="btn btn-secondary btn-sm" onclick="printDiv();">Print / Download</button>
            </div>

          </div>

        </div>

      </div>

    </div>

  </div>



  </div>
  <script>
    function printDiv() {

      var divToPrint = document.getElementById('DivIdToPrint');
      var newWin = window.open('', 'Print-Window');
      newWin.document.open();
      newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
      newWin.document.close();

    }

    function hotelInvoice() {
      var booking_reference = '<?php echo $_GET['booking_reference']; ?>';
      $.ajax({
        url: `test_search_hotel.php?hotel-invoice=${booking_reference}`,
        method: 'GET',
        dataType: 'JSON',
        success: function(data) {
          console.log(data);

          // Cache jQuery objects
          const $phone = $("#phone");
          const $email = $("#email");
          const $address = $("#address");
          const $bookingId = $("#bookingId");
          const $checkIn = $("#checkIn");
          const $checkOut = $("#checkOut");
          const $totalRooms = $("#totalRooms");
          const $displayhtotalamount = $("#displayhtotalamount");
          const $contactEmail = $("#contactEmail");
          const $contactMobile = $("#contactMobile");
          const $paxDetails = $("#paxDetails");
          const $cancellationPolicy = $("#cancellationPolicy");
          const $totalStay = $("#totalStay");

          // Append data to elements
          $phone.append(data.holder.phone_number);
          $email.append(data.holder.email);
          $address.append(data.hotel.address);
          $bookingId.append(data.booking_id);
          $checkIn.append(data.checkin);
          $checkOut.append(data.checkout);
          $totalRooms.append(data.hotel.booking_items.length); // Not sure what you intended here
          $displayhtotalamount.append(data.price.total);
          $contactEmail.append(data.holder.email);
          $contactMobile.append(data.holder.phone_number);
          $totalStay.append(calculateNumberOfNights(data.checkin, data.checkout)+' Nights')

          // Pax details table
          const paxesDetail = data.hotel.paxes;
          const paxDetailsHtml = paxesDetail.map(pax => `
        <tr>
          <td width="50%" style="border-bottom:1px solid #ddd;">
            <span>${pax.title}&nbsp;${pax.name}&nbsp;${pax.surname} (${pax.type})</span>
          </td>
          <td width="50%" align="center" style="border-bottom:1px solid #ddd;">&nbsp; </td>
        </tr>`).join('');

          $paxDetails.after(paxDetailsHtml);

          // Cancellation policy table
          const cancellationPolicyHtml = data.hotel.booking_items.flatMap(item =>
            item.cancellation_policy.details.map(detail => `
          <tr>
            <td bgcolor="#F4F4F4"><strong>${detail.from}</strong></td>
            <td bgcolor="#F4F4F4"><strong>${item.cancellation_policy.cancel_by_date != undefined ? item.cancellation_policy.cancel_by_date : ''}</strong></td>
            <td bgcolor="#F4F4F4"><strong>₹${detail.flat_fee}</strong></td>
          </tr>`)).join('');

          $cancellationPolicy.after(cancellationPolicyHtml);
        }
      });
    }
    hotelInvoice();

    function calculateNumberOfNights(checkInDate, checkOutDate) {
      // Parse the input strings as Date objects
      const checkIn = new Date(checkInDate);
      const checkOut = new Date(checkOutDate);

      // Calculate the time difference in milliseconds
      const timeDifference = checkOut - checkIn;

      // Convert milliseconds to days
      const nights = timeDifference / (1000 * 3600 * 24);

      // Return the number of nights (rounded to the nearest whole number)
      return Math.round(`${nights}`);
    }
  </script>
  <?php
  //sendhoteltickettomail($fullurl, $_REQUEST['booking_reference']);
  ?>
  <?php include "footer.php";  ?>

</body>

</html>