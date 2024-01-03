<?php
include './config/database.php';

if (!empty($_POST['search_hotel'])) {
    $search_term = $_POST['search_hotel'];
    $search_term = mysqli_real_escape_string(db(), $search_term);

    $cacheFile = 'cache/' . md5($search_term) . '.json';

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
        // Cache exists and is valid for 1 hour (3600 seconds)
        $jsonData = file_get_contents($cacheFile);
        echo $jsonData;
    } else {
        $sql = "SELECT hotels.address, hotelcity.name as city_name 
                FROM hotels 
                INNER JOIN hotelcity ON hotels.city_code = hotelcity.code 
                WHERE hotels.address LIKE '" . $search_term . "%' OR hotelcity.name LIKE '" . $search_term . "%'
                LIMIT 10"; // Adjust the LIMIT as per pagination requirements
        //echo $sql;die;
        $result = mysqli_query(db(), $sql);

        if ($result) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            $jsonData = json_encode($data);
            file_put_contents($cacheFile, $jsonData);

            echo $jsonData;
        } else {
            echo json_encode([]); // Return empty array or appropriate error response
        }
    }
}







if (isset($_POST['hotel-list'])) {
    $curl = curl_init();
    $payload = json_encode($_POST['data']);
    //echo $payload;die;
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sandbox.grnconnect.com//api/v3/hotels/availability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

if (!empty($_GET['hotel-facilities'])) {
    $sql = "SELECT * from hotelFacilities";
    $result = mysqli_query(db(), $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if (!empty($_GET['searchId']) && !empty($_GET['hcode'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sandbox.grnconnect.com/api/v3/hotels/availability/' . $_GET["searchId"] . '?hcode=' . $_GET["hcode"],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        // Handle cURL error
        echo json_encode(array("error" => "cURL request failed"));
    } else {
        // Decode the JSON response from the external API
        $decodedResponse = json_decode($response, true);

        if ($decodedResponse !== null) {
            // Send the decoded JSON response as JSON
            echo json_encode($decodedResponse);
        } else {
            // Handle invalid JSON response
            echo json_encode(array("error" => "Invalid JSON response from external API"));
        }
    }

    curl_close($curl);
}
if (!empty($_GET['group_code']) && !empty($_GET['rate_key']) && !empty($_GET['searchId'])) {
    $curl = curl_init();
    $searchId = str_replace('"', '', $_GET['searchId']);
    $group_code = str_replace('"', '', $_GET['group_code']);
    $rate_key = str_replace('"', '', $_GET['rate_key']);

    $url = 'https://api-sandbox.grnconnect.com/api/v3/hotels/availability/' . $searchId . '/rates/?action=recheck';

    $data = array(
        "group_code" => $group_code,
        "rate_key" => $rate_key
    );

    $payload = json_encode($data);
    //echo $payload;die;

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

if (!empty($_POST['action']) && $_POST['action'] == 'recheck') {
    $payload = [
        "group_code" => $_POST['group_code'],
        "rate_key" => $_POST['rate_key']
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sandbox.grnconnect.com//api/v3/hotels/availability/' . $_POST['search_id'] . '/rates/?action=' . $_POST['action'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}



if (isset($_POST['proceed_to_pay'])) {
    //print_r($_SESSION);die;
    $holder = [];
    $agentUserId = $_SESSION['agentUserid'];
    $connection = db();

    $stmt = mysqli_prepare($connection, "SELECT name, lastName, email, phone FROM `sys_userMaster` WHERE `id` = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $agentUserId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $holder['title'] = 'Mr.';
                $holder['name'] = $row['name'];
                $holder['surname'] = $row['lastName'];
                $holder['email'] = $row['email'];
                $holder['phone'] = $row['phone'];
                $holder['client_nationality'] = "IN";
                $holder['pan_number'] = "AXXXX0000A";
            } else {
                echo "No data found for the given user ID.";
            }
        } else {
            echo "Error fetching result: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($connection);
    }

    $curl = curl_init();
    $_POST['data']['holder'] = $holder;
    $_POST['data']['booking_name'] = $agentUserId . '-' . date('Y-m-d H:i:s');
    $payload = json_encode($_POST['data']);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sandbox.grnconnect.com/api/v3/hotels/bookings',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        echo "cURL Error: " . curl_error($curl);
    } else {
        $newResponse = json_decode($response, true);
        //print_r($newResponse);
        if ($newResponse && $newResponse['status'] == 'confirmed') {
            saveBooking($response);
            echo $response;

            // if ($status === true) {
            //     echo $response;
            // }
        } else if ($newResponse && $newResponse['status'] == 'pending') {
            $booking_ref = $newResponse['booking_reference'];
            sleep(60);
            $result = checkPaymentStatus($booking_ref);
            $new_result = json_decode($result, true);
            if ($new_result['status'] == 'confirmed') {
                saveBooking($result);
                echo $result;
            }else{
                echo Json_encode(['message' => 'Network Error']);
            }
        } else {
            print_r($newResponse);
        }
    }
    curl_close($curl);
}


function saveBooking($bookingData)
{
    //print_r($bookingData);die;
    $conn = db();
    $user_id = $_SESSION['agentUserid'];
    // Assuming $bookingData holds the decoded JSON data
    $data = json_decode($bookingData, true);
    // print_r($data);
    // die;
    $non_refundable = isset($data['non_refundable']) ? mysqli_real_escape_string($conn, $data['non_refundable']) : '';
    $covid_safe_to_stay = isset($data['hotel']['safe2stay']['covid_19_safe_to_stay']) ? $data['hotel']['safe2stay']['covid_19_safe_to_stay'] : '';
    $covid_safety_protocol = isset($data['hotel']['safe2stay']['covid_19_safety_protocol']) ? $data['hotel']['safe2stay']['covid_19_safety_protocol'] : '';

    $sql = "INSERT INTO test_bookings (
    user_id, booking_id, booking_reference, booking_date, checkin, checkout, currency, client_nationality, hotel_address, category, city_code, city_name, country_code, country_name, hotel_description, latitude, longitude, hotel_code, hotel_name, covid_safe_to_stay, covid_safety_protocol, non_refundable, payment_status, payment_type, status, supports_amendment, supports_cancellation, search_id, total_price
) VALUES (
    '" . $user_id . "', '" . $data['booking_id'] . "', '" . $data['booking_reference'] . "', '" . $data['booking_date'] . "', '" . $data['checkin'] . "', '" . $data['checkout'] . "', '" . $data['currency'] . "', '" . $data['holder']['client_nationality'] . "', '" . $data['hotel']['address'] . "', '" . $data['hotel']['category'] . "', '" . $data['hotel']['city_code'] . "', '" . $data['hotel']['city_name'] . "', '" . $data['hotel']['country_code'] . "', '" . $data['hotel']['country_name'] . "', '" . mysqli_real_escape_string($conn, $data['hotel']['description']) . "', '" . $data['hotel']['geolocation']['latitude'] . "', '" . $data['hotel']['geolocation']['longitude'] . "', '" . $data['hotel']['hotel_code'] . "', '" . $data['hotel']['name'] . "', '" . $covid_safe_to_stay . "', '" . $covid_safety_protocol . "', '" . $non_refundable . "', '" . $data['payment_status'] . "', '" . $data['payment_type'] . "', '" . $data['status'] . "', '" . $data['supports_amendment'] . "', '" . $data['supports_cancellation'] . "', '" . $data['search_id'] . "','" . $data['price']['total'] . "')";

    //echo $sql;
    if ($conn->query($sql) === TRUE) {
        $last_inserted_id = $conn->insert_id;

        foreach ($data['hotel']['booking_items'] as $item) {
            //$comments = isset($data['non_refundable']) ? mysqli_real_escape_string($conn,$item['rate_comments']['comments']) : '';
            $comments = isset($data['non_refundable']) ? mysqli_real_escape_string($conn, $item['rate_comments']['comments'] ?? '') : '';

            $sql1 = "INSERT INTO test_booking_items (booking_id, boarding_detail, currency, includes_boarding, non_refundable, price, rate_comments, rate_key, room_code, description, no_of_adults, no_of_children, no_of_rooms, pax_ids, room_type)
                VALUES ('$last_inserted_id', '" . $item['boarding_details'][0] . "', '" . $item['currency'] . "', '" . $item['includes_boarding'] . "', '" . $item['non_refundable'] . "', '" . $item['price'] . "', '" . $comments . "', '" . $item['rate_key'] . "', '" . $item['room_code'] . "', '" . $item['rooms'][0]['description'] . "', '" . $item['rooms'][0]['no_of_adults'] . "', '" . $item['rooms'][0]['no_of_children'] . "', '" . $item['rooms'][0]['no_of_rooms'] . "', '" . json_encode($item['rooms'][0]['pax_ids']) . "', '" . $item['rooms'][0]['room_type'] . "')";

            if ($conn->query($sql1) === TRUE) {
                $last_inserted_item_id = $conn->insert_id;
                // Perform any additional operations related to this booking item if needed
            } else {
                echo "Error in booking items: " . $conn->error;
            }
        }
        foreach ($data['hotel']['paxes'] as $pax) {
            $sql2 = "INSERT INTO test_paxes (booking_id, pax_name, pax_surname, pax_title, pax_type) VALUES ('$last_inserted_id', '{$pax['name']}', '{$pax['surname']}', '{$pax['title']}', '{$pax['type']}')";

            if ($conn->query($sql2) === TRUE) {
                // Handle success if needed
            } else {
                echo "Error in test_paxes: " . $conn->error;
            }
        }
        // Insert price breakdown for GST
        foreach ($data['price']['breakdown']['GST'] as $GST) {
            $sql_gst = "INSERT INTO test_price_breakdown (booking_id, amount, currency, name)
         VALUES ({$last_inserted_id}, {$GST['amount']}, '{$GST['currency']}', 'gst')";

            if ($conn->query($sql_gst) === TRUE) {
                // Handle success if needed
            } else {
                echo "Error in GST price breakdown: " . $conn->error;
            }
        }

        // Insert price breakdown for NET amounts
        foreach ($data['price']['breakdown']['net'] as $net) {
            if ($net['name'] !== "Total") {
                $sql_net = "INSERT INTO test_price_breakdown (booking_id, amount, currency, name)
             VALUES ('{$last_inserted_id}', '{$net['amount']}', '{$net['currency']}', '{$net['name']}')";

                if ($conn->query($sql_net) === TRUE) {
                    // Handle success if needed
                } else {
                    echo "Error in NET price breakdown: " . $conn->error;
                }
            }
        }
        $now = new DateTime();
        $formattedDate = $now->format('Y-m-d H:i:s');
        $balanceQuery = "INSERT INTO `sys_balanceSheet` (agentId, amount, paymentType, bookingId, bookingType, addDate, billType) VALUES ('" . $_SESSION['agentUserid'] . "', '" . $data['price']['total'] . "', 'Debit', '" . $last_inserted_id . "', 'hotel', '" . $formattedDate . "', 'hotel')";

        $success = mysqli_query($conn, $balanceQuery);
        if (!$success) {
            echo "Error: " . mysqli_error($conn);
            return;
        }
        //mysqli_close($conn);
    } else {
        echo "Error in main booking: " . $conn->error;
    }

    // $conn->close();
}

if (!empty($_GET['hotel-invoice'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sandbox.grnconnect.com//api/v3/hotels/bookings/' . $_GET['hotel-invoice'] . '?type=value',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}


if (!empty($_GET['booked-hotels']) && $_GET['booked-hotels'] == 1) {
    header('Content-Type: application/json');
    $user_id = $_SESSION['agentUserid'];

    // Start building the response array expected by DataTables
    $response = array(
        "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
        "recordsTotal" => 0, // Total records (before filtering)
        "recordsFiltered" => 0, // Total records after filtering
        "data" => array() // Data to be displayed
    );

    // Count total records
    $countSQL = "SELECT COUNT(*) AS total FROM test_bookings WHERE user_id = ?";
    $stmtTotal = mysqli_prepare(db(), $countSQL);
    mysqli_stmt_bind_param($stmtTotal, "i", $user_id);
    mysqli_stmt_execute($stmtTotal);
    $resultTotal = mysqli_stmt_get_result($stmtTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $response['recordsTotal'] = $rowTotal['total'];

    // Apply LIMIT and OFFSET for pagination
    $limit = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $page = isset($_GET['start']) ? intval($_GET['start']) / $limit : 0; // Calculate current page

    $offset = $page * $limit; // Calculate offset

    $dataSQL = "SELECT * FROM test_bookings WHERE user_id = ? order by id desc LIMIT ?, ?";
    $stmtData = mysqli_prepare(db(), $dataSQL);
    mysqli_stmt_bind_param($stmtData, "iii", $user_id, $offset, $limit);
    mysqli_stmt_execute($stmtData);
    $resultData = mysqli_stmt_get_result($stmtData);

    // Fetch the filtered data along with booking items
    $data = array();
    while ($row = mysqli_fetch_assoc($resultData)) {
        $row['booking_items'] = array();
        $row['cancel_item'] = array();

        // Fetch booking items
        $sql1 = "SELECT * FROM test_booking_items WHERE booking_id = ?";
        $stmt1 = mysqli_prepare(db(), $sql1);
        mysqli_stmt_bind_param($stmt1, "i", $row['id']);
        mysqli_stmt_execute($stmt1);
        $result1 = mysqli_stmt_get_result($stmt1);
        while ($item = mysqli_fetch_assoc($result1)) {
            $row['booking_items'][] = $item;
        }

        // Fetch cancellation items
        $sql2 = "SELECT * FROM test_hotel_cancel WHERE hotel_booking_id = ? AND booking_reference = ?";
        $stmt2 = mysqli_prepare(db(), $sql2);
        mysqli_stmt_bind_param($stmt2, "is", $row['id'], $row['booking_reference']);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        while ($cancelItem = mysqli_fetch_assoc($result2)) {
            $row['cancel_item'][] = $cancelItem;
        }
        $data[] = $row;
    }

    $response['recordsFiltered'] = $response['recordsTotal']; // Assuming no filtering
    $response['data'] = $data;

    echo json_encode($response);
}






if (!empty($_POST['cancel_booking']) && $_POST['cancel_booking'] == 1 && !empty($_POST['book_ref']) && !empty($_POST['id'])) {
    $apiUrl = 'https://api-sandbox.grnconnect.com//api/v3/hotels/bookings/' . $_POST['book_ref'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS => json_encode(array(
            "comments" => "cancellation comments",
            "reason" => 5
        )),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $newResponse = json_decode($response, true);

    if ($newResponse && $newResponse['status'] == 'confirmed') {
        $result = cancelBooking($_POST['id'], $response);
        if ($result['status'] == true) {
            echo json_encode(['status' => 'confirmed']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error in database operation']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Cancellation status not confirmed']);
    }
}

function cancelBooking($hotel_booking_id, $cancelData)
{
    $conn = db();
    $data = json_decode($cancelData, true);

    $hotel_booking_id = mysqli_real_escape_string($conn, $hotel_booking_id);
    $status = mysqli_real_escape_string($conn, $data['status']);
    $cancellation_reference = mysqli_real_escape_string($conn, $data['cancellation_reference']);
    $cancellation_comments = mysqli_real_escape_string($conn, $data['cancellation_comments']);
    $currency = mysqli_real_escape_string($conn, $data['cancellation_charges']['currency']);
    $amount = mysqli_real_escape_string($conn, $data['cancellation_charges']['amount']);
    $booking_reference = mysqli_real_escape_string($conn, $data['booking_reference']);
    $booking_price_currency = mysqli_real_escape_string($conn, $data['booking_price']['currency']);
    $booking_price_amount = mysqli_real_escape_string($conn, $data['booking_price']['amount']);
    $booking_id = mysqli_real_escape_string($conn, $data['booking_id']);

    $sql = "INSERT INTO test_hotel_cancel (hotel_booking_id, status, cancellation_reference, cancellation_comments, cancellation_charges_currency, cancellation_charges_amount, booking_reference, booking_price_currency, booking_price_amount, booking_id, add_date)
        VALUES ('$hotel_booking_id', '$status', '$cancellation_reference', '$cancellation_comments', '$currency', '$amount', '$booking_reference', '$booking_price_currency', '$booking_price_amount', '$booking_id', '" . date('Y-m-d H:i:s') . "')";

    if ($conn->query($sql) === TRUE) {
        $formattedDate = date('Y-m-d H:i:s');
        $agentId = mysqli_real_escape_string($conn, $_SESSION['agentUserid']);
        $balanceQuery = "INSERT INTO `sys_balanceSheet` (agentId, amount, paymentType, bookingId, bookingType, addDate, billType) VALUES ('$agentId', '$amount', 'Credit', '$hotel_booking_id', 'hotel', '$formattedDate', 'hotel')";

        if ($conn->query($balanceQuery) === TRUE) {
            $conn->close();
            return ['status' => true];
        } else {
            $conn->close();
            return ['status' => false];
        }
    } else {
        $conn->close();
        return ['status' => false];
    }
}

function checkPaymentStatus($book_ref)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sandbox.grnconnect.com//api/v3/hotels/bookings/' + $book_ref + '?type=value',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'api-key: 81a9f0deae0793b24e317d00db04814e',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
