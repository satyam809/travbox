<?php include "websiteinc.php";
//print_r($_POST);
if(trim($_POST['action'])=='paxdetailaction'){ 
$HotelSearchDetails = trim($_POST['HotelSearchDetails']);
$HotelSearchArr = json_decode($HotelSearchDetails); 
//print_r($HotelSearchArr);

/*$hotelJsonData = trim($_POST['hotelJsonData']);
$hotelArr = json_decode($hotelJsonData); 

$RoomDetails = trim($_POST['RoomDetails']);
$RoomArr = json_decode($RoomDetails); 
*/

$guestname = trim($_POST['guestname']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$address = addslashes($_POST['address']);

if($guestname!='' && $email!=''){
$rs5=GetPageRecord('*','clientMaster',' email="'.$email.'"'); 
$count=mysqli_num_rows($rs5);
$editresult=mysqli_fetch_array($rs5);
if($count>0){
$clientId = $editresult['id'];
}else{
$namevalue ='clientType="1",name="'.$guestname.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",addDate="'.date('Y-m-d h:i:s').'"';  
$clientId = addlistinggetlastid('clientMaster',$namevalue);  
}
}

	$n=1;
	foreach($HotelSearchArr->RoomDetails as $roomData){
		$adult = 1;
		foreach($roomData->Adult as $adultData){
		$namevalue ='bookingTableId="'.$_POST['bookinglastId'].'",title="'.trim($_POST['titleAdt'.$n.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$n.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$n.$adult]).'",paxType="AD",roomNo="'.$n.'"';
		addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
		$adult++;
		}
		
		$child = 1;
		foreach($roomData->Child as $childData){
		$namevalue ='bookingTableId="'.$_POST['bookinglastId'].'",title="'.trim($_POST['titleChd'.$n.$child]).'",firstName="'.trim($_POST['firstNameChd'.$n.$child]).'",lastName="'.trim($_POST['lastNameChd'.$n.$child]).'",paxType="CH",roomNo="'.$n.'",ageChild="'.trim($_POST['ageChild'.$n.$child]).'"';
		addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
		$child++;
		}
	$n++; 
	}
	
	//logger('This is offline booking for hotel: ');
	$status = 1;
	$bookingNumber = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
	$bookingNumber = strtoupper($bookingNumber);
updatelisting('hotelBookingMaster','BookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",agentId="'.$agentid.'"','id="'.$_POST['bookinglastId'].'"'); 
	updatelisting('hotelBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','bookingTableId="'.$_POST['bookinglastId'].'"'); 

}
 ?>
<!-- ========== MAIN CONTENT ========== -->
<main id="content">
	   <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                         <div class="mb-5 shadow-soft bg-white rounded-sm">
                            <div class="py-6 px-5 border-bottom">
								
                                <div class="flex-horizontal-center">
                                    <div class="height-50 width-50 flex-shrink-0 flex-content-center bg-primary rounded-circle">
                                        <i class="flaticon-tick text-white font-size-24"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="font-size-18 font-weight-bold text-dark mb-0 text-lh-sm">Booking Succesfull</h3>
                                        <p class="mb-0"></p>
									</div>
                                </div>
                            </div>
                            <div class="pt-4 pb-5 px-5 border-bottom">
                                <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
                                    Booking Information
                                </h5>
                                <!-- Fact List -->
                                <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                    <li class="d-flex justify-content-between py-2">
                                        <span class="font-weight-medium">Booking number</span>
                                        <span class="text-secondary text-right"><?php echo $bookingNumber; ?></span>
                                    </li>
	
	
									<li class="d-flex justify-content-between py-2">
                                        <span class="font-weight-medium">Name</span>
                                        <span class="text-secondary text-right"><?php echo $guestname; ?></span>
                                    </li>
                                    
                                    <li class="d-flex justify-content-between py-2">
                                        <span class="font-weight-medium">E-mail address</span>
                                        <span class="text-secondary text-right"><?php echo trim($_POST['email']); ?></span>
                                    </li>

                                    <li class="d-flex justify-content-between py-2">
                                        <span class="font-weight-medium">Mobile</span>
                                        <span class="text-secondary text-right"><?php echo trim($_POST['phone']); ?></span>
                                    </li>

                                </ul>
                                <!-- End Fact List -->
                            </div>
                            <div class="pt-4 pb-5 px-5 border-bottom">
                                <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-3">
                                    Payment
                                </h5>
                                <p class="">
                                    Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque. Nulla tempor nec lorem eu suscipit. Donec dignissim lectus a nunc molestie consectetur. Nulla eu urna in nisi adipiscing placerat. Nam vel scelerisque magna. Donec justo urna,  posuere ut dictum quis.
                                </p>

                                <a href="#" class="text-underline text-primary">Payment is made by Credit Card Via Paypal.</a>
                            </div>
                            <div class="pt-4 pb-5 px-5">
                                <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-3">
                                    View Booking Details
                                </h5>
                                <p class="">
                                    Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque. Nulla tempor nec lorem eu suscipit. Donec dignissim lectus a nunc molestie consectetur. Nulla eu urna in nisi adipiscing placerat. Nam vel scelerisque magna. Donec justo urna,  posuere ut dictum quis.
                                </p>

                                <a href="#" class="text-underline text-primary">https://www.mytravel.com/booking-details/?=f4acb19f-9542-4a5c-b8ee</a>
                            </div>
                        </div>
                    </div>
                       
                </div>
            </div>
</main>
