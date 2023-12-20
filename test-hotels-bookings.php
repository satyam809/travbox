<?php
include "inc.php";

include "config/logincheck.php";

$selectedpage = '';

$selectleft = 'bookings';

$selectintab = 'hotel';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Bookings - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
    <?php include "headerinc.php"; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body class="greyouter">
    <?php include "header.php"; ?>
    <!--------------Left Menu---------------->
    <?php include "left.php"; ?>
    <!--------------Mid Body---------------->
    <section class="profile">
        <div class="listcontent">
            <div class="card">
                <div class="card-body">
                    <div class="bodysection bodypricesection">
                        <h1>Bookings</h1>
                        <?php include "bookingtabs.php"; ?>
                        <div class="tbtabcontent">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row newinputbookrow">
                                        <div class="col-lg-12">
                                            <div style="float: left; margin-top: 0px; margin-bottom: 20px;">
                                                <form method="get" id="searchform">
                                                    <div class="row">
                                                        <input name="stage" type="hidden" value="">
                                                        <div class="col-xl-3" style="padding-right: 0px;">
                                                            <div class="input-group">
                                                                <input type="text" id="fromdate" name="fromdate" class="form-control hasDatepicker" placeholder="From Date" value="" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3" style="padding-right: 0px;padding-left:7px;">
                                                            <div class="input-group">
                                                                <input type="text" id="todate" name="todate" class="form-control hasDatepicker" placeholder="To Date" value="" readonly="">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6" style="padding-right: 0px;padding-left:7px;">
                                                            <div class="input-group">
                                                                <input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="">
                                                                <span class="input-group-append">
                                                                    <button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px; width:100%;border-top-right-radius:6px;border-bottom-right-radius:6px;border-bottom-left-radius:0px;border-top-left-radius: 0px; margin-left: 7px;height:37px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="bookedHotels">
                                    <thead>
                                        <tr style="background-color: #f6f6f6;">
                                            <th>Booking ID </th>
                                            <th>Hotel</th>
                                            <th>Date</th>
                                            <th>Room Type</th>
                                            <th>Pax</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HTML -->
    <?php include "footerinc.php"; ?>
    <script>
        var dataTable = '';
        document.addEventListener("DOMContentLoaded", () => {
            dataTable = $('#bookedHotels').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ordering": false,
                "ajax": {
                    "url": "test_search_hotel.php?booked-hotels=1",
                    "type": "GET",
                    "data": function(d) {
                        d.draw = d.draw || 0;
                        d.start = d.start || 0;
                        d.length = d.length || 10;
                    }
                },
                "columns": [{
                        "data": 'booking_id',
                        "render": function(data, type, row) {
                            return `<strong>${data}</strong><div style="font-size:11px; color:#666666;">Ref. ${row.booking_reference}</div>
                            <div style="width:140px; font-size:11px;">${row.booking_date}</div>`;
                        }
                    },
                    {
                        "data": 'hotel_name',
                        "render": function(data, type, row) {
                            var html = `<div>`;
                            for (var i = 0; i < row.category; i++) {
                                html += `<i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>`;
                            }
                            html += `</div><strong>${data}</strong></div><br>City: <strong>${row.city_name},${row.country_name}</strong>`;
                            return `${html}`;
                        }
                    },
                    {
                        "data": 'booking_date',
                        "render": function(data, type, row) {
                            return `<div style="width:130px;"><strong>Checkin:<strong>${row.checkin}<br><strong>Checkout: </strong>${row.checkout}</div>`;
                        }
                    },
                    {
                        "render": function(data, type, row) {
                            var html = `<ul>`;
                            row.booking_items.map((ele) => {
                                html += `<li>${ele.room_type}</li>`;
                            })
                            html += `</ul>`;
                            return html;
                        }
                    },
                    {
                        "render": function(data, type, row) {
                            var totalAdult = 0;
                            var totalChild = 0;
                            row.booking_items.map((ele) => {
                                totalAdult += parseInt(ele.no_of_adults);
                                totalChild += parseInt(ele.no_of_children);
                            });
                            return `<div style="width:60px;"><strong>Room: </strong>${row.booking_items.length}<br><strong>Adult: </strong>${totalAdult}<br><strong>Child: </strong>${totalChild}</div>`;
                        }
                    },
                    {
                        "data": 'total_price'
                    },
                    {
                        "data": "booking_reference",
                        "render": function(data, type, row) {
                            const status = row.status;
                            if (status === 'confirmed') {
                                if (row.cancel_item.length > 0) {
                                    return `<span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span>`;
                                } else {
                                    return `<span class="badge bg-blue" style="background-color:#46cd93;" onClick="CancelBooking(${row.id},'${data}')">${status}</span>`;
                                }
                            } else if (status === 'failed' || status === 'rejected' || status === 'pending') {
                                return `<span class="badge bg-blue" style="background-color:#46cd93;" onClick="CancelBooking(${row.id},'${data}')">${status}</span>`;
                            }
                        }
                    }
                ]
            });
        });

        function CancelBooking(id, bookRef) {
            if (confirm('Do you want to cancel this booking ?')) {
                $.ajax({
                    url: `test_search_hotel.php`,
                    method: "POST",
                    data: {
                        cancel_booking: 1,
                        id: id,
                        book_ref: bookRef
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == 'confirmed') {
                            alert('Your booking is now cancelled')
                            dataTable.ajax.reload();
                        } else {
                            alert(data.errors[0].messages[0]);
                            dataTable.ajax.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error cancelling booking: " + error);
                        dataTable.ajax.reload();
                    }
                });
            }
        }
    </script>
    <!-- ... -->

</body>

</html>