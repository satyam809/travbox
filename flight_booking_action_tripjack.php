<?php  
include "inc.php";  
include "config/logincheck.php"; 

ini_set('precision', 10);

ini_set('serialize_precision', 10);

include 'tripjackAPI/APIConstants.php';

include 'tripjackAPI/RestApiCaller.php';


	//counter to handel seat for passengers

$seat_count=0;
$seat_count2=0;
$seat_pax_count=0;
$seat_pax_count2=0;

$roundtripid=mt_rand(10000000,99999999);

// $SeatPricearr=$_POST['SeatPricearr'];
// $seatNoData=explode(",",$SeatPricearr);
// print_r($seatNoData);
// die;
/*if($_SESSION['randval']!=($_REQUEST['coid']-$_REQUEST['totalAmountToPay']))

{

   ?>

<script>

alert('Something Went Wrong. Please Try Again.');

window.parent.location.href = "<?php echo $fullurl; ?>"; 

</script>   

   <?php

   exit();

}*/
// $adultmain=$_SESSION['ADT'];
// $seat_pax_count=0;

// for ($adult = 1; $adult <= $adultmain; $adult++) { 

 

// 	if($_REQUEST['adtPassEx'.$adult]==''){
   
// 	$adtPassEx='1970-01-01';
   
// 	} else{
   
// 	$adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));
   
// 	}
   
   
//    $totalflights=$_POST['totalflight'];
//    $ssrSeatInfosArr=array();
   
//    $flightcount=0;
//    for($i=1; $i<=$totalflights; $i++){
   
   
// 	   if(!empty($_POST['SeatNoInn'.$flightcount]) || !empty($_POST['SeatPricearr'.$flightcount])){
// 	   $SeatNoInn=$_POST['SeatNoInn'.$flightcount];
// 	   $SeatPricearr=$_POST['SeatPricearr'.$flightcount];
	 
// 	   $seatNoData=explode(",",$SeatNoInn);
// 	   $seatPriceData=explode(",",$SeatPricearr);

// 		$segmentarr=$_POST['segmentid'.$flightcount];
// 		$segmentdata=explode(",",$segmentarr);
   
					  
// 		if(!empty($seatNoData[$seat_pax_count])){
// 			$ssrSeatInfosArr["key"]=$segmentdata[$seat_pax_count];

// 			$ssrSeatInfosArr["code"]=$seatNoData[$seat_pax_count];
		   
// 	   }
	   
   
// 		   $flightcount++;
	  
// 	 }
   
//    }
//    $seat_pax_count++;
//    print_r(json_encode($ssrSeatInfosArr));
// }
//    die;

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/

// $stuff = explode(',',$_POST['segmentKey']);

// $result = array_count_values($stuff);

// print_r(count($result));

// // print_r(explode(',',$_POST['segmentKey']));
// die;

$uniqueSessionId=base64_encode(time());

 

$pnrResponse1="";

$pnrResponse2="";



$basefareret=0; 

$passengerDetailArr=array();



$randbookingid='OFF-'.rand(11111111,99999999);



$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flighttwo'])).'" and agentId="'.$_SESSION['agentUserid'].'"'); 
$resret=mysqli_fetch_array($ab);



$retrunflightoffline=offlineflight($_SESSION['agentUserid'],$resret['FLIGHT_NAME'],$resret['PCC']);





if($resret['id']!=''){



$str_arr = explode (",", $resret['agfare']);   

$basefareret = explode ("=", $str_arr[2]); 

$basefareret = $basefareret[1];

}



$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flightone'])).'" and agentId="'.$_SESSION['agentUserid'].'"');

$res=mysqli_fetch_array($a);



$onewayflightoffline=offlineflight($_SESSION['agentUserid'],$res['FLIGHT_NAME'],$res['PCC']);





$str_arr = explode (",", $res['agfare']);   

$basefare = explode ("=", $str_arr[2]);





$discountPrice=0;

$cashbackPrice=0;



if($res['discountType']==1 && $res["couponType"]==1){

$discountPrice=$res['discount'];

}



if($res['discountType']==2 && $res["couponType"]==1){

$discountPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);

}



if($res['discountType']==1 && $res["couponType"]==2){

$cashbackPrice=$res['discount'];

}



if($res['discountType']==2 && $res["couponType"]==2){

$cashbackPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);

}



$totalPayableAmount=($basefare[1]+$basefareret)-$discountPrice;





if($_POST['flightone']!='' && $res['id']>0 && $res['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$totalPayableAmount  && $age == false){

	

if($totalPayableAmount<900){

	exit();

}



$bookingpro=1;

   



		#################################### Meal Baggage SSR #############################################



        	$ssr_result= $_SESSION['SSR']; 

        	$mealpref= $ssr_result['Response']['MealDynamic']['0'];  

        	$baggagepref= $ssr_result['Response']['Baggage']['0'];

        	$seatref= $ssr_result['Response']['SeatDynamic']['0']['SegmentSeat']['0']['RowSeats'];



		#################################### Meal Baggage SSR #############################################

	

	

   

/*  foreach((array) unserialize(stripslashes($res['PARAM_DATA'])) as $layoverFlight){

  

 $adultmain=$layoverFlight->adt;

 $childmain=$layoverFlight->chd;

 $infantmain=$layoverFlight->inf;

  }*/

 

 $adultmain=$_SESSION['ADT'];

 $childmain=$_SESSION['CHD'];

 $infantmain=$_SESSION['INF']; 




$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 

$AgentWebsiteData=mysqli_fetch_array($rs);  





$bl=GetPageRecord('*','taxMaster','id=1 '); 

$taxData=mysqli_fetch_array($bl);



$source=$res['ORG_NAME'].'-'.$res['ORG_CODE'];

$destination=$res['DES_NAME'].'-'.$res['DES_CODE'];

$journeyDate=$res['DEP_DATE'];

$sector=$res['sector'];

$bookingDate=date('Y-m-d H:i:s');

$agentId=$_SESSION['agentUserid'];

$PCC=$res['PCC'];

$flightName=$res['FLIGHT_NAME'];

$flightNo=$res['FLIGHT_NO'];

$flightCode=$res['FLIGHT_CODE'];

$refundtype=$res['refundyes'];

$arrivalTime=$res['ARRV_TIME'];

$arrivalDate=$res['ARRV_DATE'];

$departureTime=$res['DEP_TIME'];

$clientBaseFare=$res['DEP_TIME'];

$markup = '0';

$agentMarkup = '0';

$bookingType = '0'; 

if($res['F_CLASS']=='ECONOMY'){ $flightClass='Economy'; } else { $flightClass='Business'; } 

$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO);

$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2])));

$flightStop=$res['STOP'];

$agentCommision=$res['acom'];





	$clientFareOW = json_decode(taxBreakupFunc($res['clfare']));

	$bareFare = $clientFareOW->bareFare;

	$tax = $clientFareOW->tax;

	$totalFare = $clientFareOW->totalFare;

	

	//Price of admin fare onward flight

	$adminFareOW = json_decode(taxBreakupFunc($res['adfare']));

	$adminBaseFareOW = $adminFareOW->bareFare;

	$adminTaxOW = $adminFareOW->tax;

	$adminTotalOW = $adminFareOW->totalFare;

	

	//Price of agent fare onward flight

	$agentFareOW = json_decode(taxBreakupFunc($res['agfare']));

	$agentBaseFareOW = $agentFareOW->bareFare;

	$agentTaxOW = $agentFareOW->tax;

	$agentTotalOW = $agentFareOW->totalFare;

	

	

		if($taxData['applicableType']=='commission'){

		$agentFinalGST=(($_REQUEST['acom']*$taxData['valuePerc'])/100);

	}

	

	if($taxData['applicableType']=='totalfare'){

		// $agentFinalGST=(($adminBaseFareOW*$taxData['valuePerc'])/100);
		$TotalGST=$_POST['TotalBaseFare'];
		$agentFinalGST=(($TotalGST*$taxData['valuePerc'])/100);

	}


//hidden field for basic fare , tax, commission
  
$TotalBaseFare=$_POST['TotalBaseFare'];
$TotalTax=$_POST['TotalTax'];
$TotalBaseTax=$TotalBaseFare+$TotalTax;
$TotalCommission=$_POST['TotalCommission'];

 // hidden field for baggage meal and seat dynamic 

$baseFareInn=$_REQUEST['baseFareInn'];

$TaxAndFeeInn=$_REQUEST['TaxAndFeeInn'];
$earnedcommission=$_REQUEST['earnedcommission'];
$totalcommissiongstdisplay=$_REQUEST['totalcommissiongstdisplay'];
$totaltdsdisplay=$_REQUEST['totaltdsdisplay'];
// add child meal to all meals
$BaggageFeeInn=$_REQUEST['BaggageFeeInn'];
$BaggageFeeInnC=$_REQUEST['BaggageFeeInnC'];
$BaggageFeeInn = $BaggageFeeInn + $BaggageFeeInnC;

$MealFeeInn=$_REQUEST['MealFeeInn'];
$MealFeeInnC=$_REQUEST['MealFeeInnC'];
$MealFeeInn = $MealFeeInn + $MealFeeInnC;

$SeatFeeInn=$_REQUEST['SeatFeeInn'];

$SeatPriceInn=$_REQUEST['SeatPriceInn'];

$SeatNoInn=$_REQUEST['SeatNoInn'];



$asector=$_REQUEST['asector'];

$abaggage=$_REQUEST['abaggage'];

$ameal=$_REQUEST['ameal'];


$othercharges=round($BaggageFeeInn+$MealFeeInn+$SeatPriceInn);
// $total_fare=($baseFareInn+$TaxAndFeeInn+$totalcommissiongstdisplay+$totaltdsdisplay)-$earnedcommission;
$total_fare=($baseFareInn+$TaxAndFeeInn);



// For Return Flight

$TotalBaseFare2=$_POST['TotalBaseFare2'];
$TotalTax2=$_POST['TotalTax2'];
$TotalBaseTax2=$TotalBaseFare2+$TotalTax2;
$TotalCommission2=$_POST['TotalCommission2'];

$BaggageFeeInn2=$_REQUEST['BaggageFeeInn2'];
$BaggageFeeInnC2=$_REQUEST['BaggageFeeInnC2'];
$BaggageFeeInn2=$BaggageFeeInn2+$BaggageFeeInnC2;
$MealFeeInn2=$_REQUEST['MealFeeInn2'];
$MealFeeInnC2=$_REQUEST['MealFeeInnC2'];

$MealFeeInn2=$MealFeeInn2+$MealFeeInnC2;

$SeatFeeInn2=$_REQUEST['SeatFeeInn2'];

$SeatPriceInn2=$_REQUEST['SeatPriceInn2'];

$SeatNoInn2=$_REQUEST['SeatNoInn2'];



$asector2=$_REQUEST['asector2'];

$abaggage2=$_REQUEST['abaggage2'];

$ameal2=$_REQUEST['ameal2'];





$totalAmountToPay=$_REQUEST['totalAmountToPay'];

  

  

  

  

//-------------------Booking Entry-------------------------  

  

$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",source="'.$source.'",apiType="tripjack",status=1,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",flightNo="'.$flightNo.'",flightCode="'.$flightCode.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",cancellationMarkup="'.$_POST['cancellationmarkup'].'",refundyes="'.$refundtype.'",departureTime="'.$departureTime.'",clientBaseFare="'.$TotalBaseFare.'",clientTax="'.$TotalTax.'",clientTotalFare="'.$TotalBaseTax.'",baseFare="'.$TotalBaseFare.'",tax="'.$TotalTax.'",totalFare="'.$TotalBaseTax.'",agentBaseFare="'.$TotalBaseFare.'",agentTax="'.$TotalTax.'",agentTotalFare="'.$TotalBaseTax.'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$TotalCommission.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($res['searchJson']).'",couponCode="'.$res['couponCode'].'",discountType="'.$res['discountType'].'",couponValue="'.$res['couponValue'].'",seatPrice="'.$SeatPriceInn.'",extraBaggagePrice="'.$BaggageFeeInn.'",mealPrice="'.$MealFeeInn.'",fareClass="'.$res['F_CLASS'].'",couponType="'.$res['couponType'].'",agentFixedMakup="'.$res['agentFixedMakup'].'",roundTripId="'.$roundtripid.'"';  

$bookinglastId = addlistinggetlastid('flightBookingMaster',$namevalue);

 



if($res["couponType"]==2){

$a11 ='agentId="'.$_SESSION['agentUserid'].'",amount="'.$cashbackPrice.'",remarks="Cashback offer",paymentMethod="Online",transactionId="'.encode($bookinglastId).'", paymentType="Credit",bookingId="'.encode($bookinglastId).'",bookingType="Flight",addedBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a11);

}



 // insert SSR Details 

 

  $namevalueSRR ='BookingId="'.$bookinglastId.'",baseFareInn="'.$baseFareInn.'",TaxAndFeeInn="'.$TaxAndFeeInn.'",BaggageFeeInn="'.$BaggageFeeInn.'",MealFeeInn="'.$MealFeeInn.'",SeatFeeInn="'.$SeatFeeInn.'",SeatPriceInn="'.$SeatPriceInn.'",SeatNoInn="'.$SeatNoInn.'",asector="'.$asector.'",abaggage="'.$_POST['abaggage1'].'",ameal="'.$_POST['ameal1'].'",BaggageFeeInn2="'.$BaggageFeeInn2.'",MealFeeInn2="'.$MealFeeInn2.'",SeatFeeInn2="'.$SeatFeeInn2.'",SeatPriceInn2="'.$SeatPriceInn2.'",SeatNoInn2="'.$SeatNoInn2.'",asector2="'.$asector2.'",abaggage2="'.$_POST['abaggage21'].'",ameal2="'.$_POST['ameal21'].'",totalAmountToPay="'.$totalAmountToPay.'"';  



$flghtSSRLastId = addlistinggetlastid('flight_booking_ssr_details',$namevalueSRR); 

  

  

    

//-------------------Booking Entry End-------------------------  

  

  

  

 

for ($adult = 1; $adult <= $adultmain; $adult++){  

$guestnametitle=addslashes($_POST['titleAdt'.$adult]);
$guestname=addslashes($_POST['firstNameAdt'.$adult]);
$lastguestname=addslashes($_POST['lastNameAdt'.$adult]);

}





$guestname = trim($guestname);

$email = trim($_POST['email']);

$phone = trim($_POST['phone']);

$companyName = trim($_POST['companyName']);

$gstNo = trim($_POST['gstNo']);

$gstEmail = trim($_POST['gstEmail']);

$address = addslashes($_POST['address']);



$ab=GetPageRecord('*','sys_branchMaster',' id=1'); 
$branchdatamain=mysqli_fetch_array($ab);


if($guestname=='')

{

	$guestname=$branchdatamain['contactPerson'];

}

if($email=='')

{

	$email=$branchdatamain['email'];

}

if($phone=='')

{

	$phone=$branchdatamain['phone'];

}



if($companyName=='')

{

	$companyName=$branchdatamain['companyName'];

}



if($gstNo=='')

{

	$gstNo=$branchdatamain['taxId'];

}



if($address=='') 
{

	$address=$branchdatamain['address'];

}







if($guestname!='' && $email!=''){

$rs5=GetPageRecord('*','clientMaster',' email="'.$email.'"'); 

$count=mysqli_num_rows($rs5);

$editresult=mysqli_fetch_array($rs5);

if($count>0){

$clientId = $editresult['id'];

}else{


 


$namevalue ='clientType="1",nameHead="'.$guestnametitle.'",name="'.$guestname.'",lastName="'.$lastguestname.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d h:i:s').'"';  

$clientId = addlistinggetlastid('clientMaster',$namevalue);  

}

}	











//-------------Adult-----------------

 

for ($adult = 1; $adult <= $adultmain; $adult++) { 

 

 if($_REQUEST['adtPassEx'.$adult]==''){

 $adtPassEx='1970-01-01';

 } else{

 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));

 }

 $totalflights=$_POST['totalflight'];
 $seat_price=array();
 $seat_no=array();
 $flight_code=array();
 
 $flightcount=0;
 for($i=1; $i<=$totalflights; $i++){
 
 
	 if(!empty($_POST['SeatNoInn'.$flightcount]) || !empty($_POST['SeatPricearr'.$flightcount])){
	 $SeatNoInn=$_POST['SeatNoInn'.$flightcount];
	 $SeatPricearr=$_POST['SeatPricearr'.$flightcount];
   
	 $seatNoData=explode(",",$SeatNoInn);
	 $seatPriceData=explode(",",$SeatPricearr);

	  $segmentarr=$_POST['segmentKey'.$flightcount];
	  $segmentdata=explode(",",$segmentarr);
 
					 $seat_price[]=$seatPriceData[$seat_pax_count];
 
					 $seat_no[]=$seatNoData[$seat_pax_count];
					 $flight_code[]=$segmentdata[$seat_pax_count];
	 }
	 
 
		 $flightcount++;
	
   }
   $seat_pax_count++;

		$seatprice='';
		$seatno='';
		$flightcode='';
		foreach ($seat_no as $value ) {
		$seatno.=$value.',';
		}
		foreach ($seat_price as $value ) {
			$seatprice.=$value.',';	
		}
		foreach ($flight_code as $value ) {
			$flightcode.=$value.',';
		}
   
  $namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",documentId="'.trim($_POST['docId'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult",sector="'.trim($_POST['asector'.$adult]).'",baggage="'.trim($_POST['abaggage'.$adult]).'",meal="'.trim($_POST['ameal'.$adult]).'",flightCode="'.$flightcode.'",seatAdultCode="'.$seatno.'",seatAdultPrice="'.$seatprice.'", roundTripId="'.$roundtripid.'",agentId="'.$_SESSION['agentUserid'].'"';


addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 









}





//-------------Child-----------------





for ($child = 1; $child <= $childmain; $child++) { 



 if($_REQUEST['adtPassEx'.$child]==''){

 $adtPassEx='1970-01-01';

 } else {

 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$child]));

 }
 $totalflights=$_POST['totalflight'];
 $seatprice_chd=array();
 $seatno_chd=array();
 $flightcode_chd=array();
 
 $flightcount=0;
 for($i=1; $i<=$totalflights; $i++){
 
 
	 if(!empty($_POST['SeatNoInn'.$flightcount]) || !empty($_POST['SeatPricearr'.$flightcount])){
	 $SeatNoInn=$_POST['SeatNoInn'.$flightcount];
	 $SeatPricearr=$_POST['SeatPricearr'.$flightcount];
   
	 $seatNoData=explode(",",$SeatNoInn);
	 $seatPriceData=explode(",",$SeatPricearr);

	  $segmentarr=$_POST['segmentKey'.$flightcount];
	  $segmentdata=explode(",",$segmentarr);
 
					 $seatprice_chd[]=$seatPriceData[$seat_pax_count];
 
					 $seatno_chd[]=$seatNoData[$seat_pax_count];
					 $flightcode_chd[]=$segmentdata[$seat_pax_count];
	 }
	 
 
		 $flightcount++;
	
   }
   $seat_pax_count++;

		$seatpricechd='';
		$seatnochd='';
		$flightcodechd='';
		foreach ($seatno_chd as $value ) {
		$seatnochd.=$value.',';
		}
		foreach ($seatprice_chd as $value ) {
			$seatpricechd.=$value.',';	
		}
		foreach ($flightcode_chd as $value ) {
			$flightcodechd.=$value.',';
		}

  $namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child",sector="'.trim($_POST['csector'.$child]).'",baggage="'.trim($_POST['cbaggage'.$child]).'",meal="'.trim($_POST['cmeal'.$child]).'",seatAdultCode="'.$seatnochd.'",flightCode="'.$flightcodechd.'" ,seatAdultPrice="'.$seatpricechd.'" , roundTripId="'.$roundtripid.'",agentId="'.$_SESSION['agentUserid'].'"';

addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 



 

}









//-------------Infant-----------------







for($infant = 1; $infant <= $infantmain; $infant++) { 





 if($_REQUEST['adtPassEx'.$infant]==''){

 $adtPassEx='1970-01-01';

 } else {

 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$infant]));

 }

 









$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant",roundTripId="'.$roundtripid.'",agentId="'.$_SESSION['agentUserid'].'" ';

addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 



}



















$insuranceAmount=0;

   if($_REQUEST['addInsurance']==1){

   $insurance=addslashes(trim($_REQUEST['insurance']));

   $insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));

   $insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));

   }

   $donateAmount=0;

   if($_REQUEST['donate']==1){

	$donateDetails=addslashes(trim($_REQUEST['donateDetails']));

	$donateAmount=addslashes(trim($_REQUEST['donateAmount']));

	}

  

  $finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);

  



$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 

$actCost=mysqli_fetch_array($bl);

  

$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);

$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);





$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 

$lastInv=mysqli_fetch_array($inv); 

$invoiceId=($lastInv['invoiceId']+1);





/*   echo "<br>Adult";

   print_r($adultmain);

   

  echo "<br>**********<br>";*/

  

  /********* Farebreak down ****************/

  $reviewSSRResult=$_SESSION['reviewSSRResult'];

//   print_r($reviewSSRResult);
//   die;
  $ssrInfoArr=$reviewSSRResult['tripInfos']['0']['sI'][0]['ssrInfo'];



	$totalSSRPriceForAPI=0;

	

 	for($adult=1; $adult<=$adultmain; $adult++){

	

		$adultArrTripJack=array();

		

		$adultArrTripJack['ti']=trim($_POST['titleAdt'.$adult]);

		$adultArrTripJack['fN']=trim($_POST['firstNameAdt'.$adult]);

		$adultArrTripJack['lN']=trim($_POST['lastNameAdt'.$adult]);

		$adultArrTripJack['pt']='ADULT';

		if($PCC=='STUDENT'|| $PCC=='SENIOR_CITIZEN'){
		
			$adultArrTripJack['di']=trim($_POST['docId'.$adult]);
		
		}
		
		if($_SESSION['isdomestic']=='No')

		{



			$DateOfBirth = date("Y-m-d", strtotime(trim($_POST['dobAdt'.$adult])));

			$adultArrTripJack['dob']=$DateOfBirth;	

				

			$adultArrTripJack['pNat']=trim($_POST['nationalityAdt'.$adult]);

			$adultArrTripJack['pNum']=trim($_POST['passportNumberAdt'.$adult]);

			$adultArrTripJack['pid']=trim($_POST['passportIssueDateAdt'.$adult]);

			$adultArrTripJack['eD']=trim($_POST['passportExpiryAdt'.$adult]);

		}
		elseif($PCC=='SENIOR_CITIZEN')
			{
			$DateOfBirth = date("Y-m-d", strtotime(trim($_POST['dobAdt'.$adult])));
	
			echo $adultArrTripJack['dob']=$DateOfBirth;	
	
			}	

	

				// Only for one Segment

		$baggage="";		

		$baggage = trim($_POST['abaggage'.$adult]);

		if($baggage!="" && isset($_POST['abaggage'.$adult]) && count($ssrInfoArr['BAGGAGE'])>0 )

		{

			$baggageData=explode("-",$baggage);

			$baggageDataInfo=trim($baggageData[0]);

			

				foreach($ssrInfoArr['BAGGAGE'] as $baagageDataValue)

				{

					if($baggageDataInfo==$baagageDataValue['code'])

					{

						 // Baggage infor

						 $baggageInfoArr=array(

							"key"=>$_SESSION['fistSegmentKey'],

							"code"=>$baggageDataInfo

						 );

						 $totalSSRPriceForAPI=$totalSSRPriceForAPI+$baagageDataValue['amount'];

						 $adultArrTripJack["ssrBaggageInfos"][]=$baggageInfoArr;

					 }	 

				}

					

		}

		

					 

		 // Meals infor

		 $ameal='';

		 $ameal = trim($_POST['ameal'.$adult]);

		if($ameal!="" && isset($_POST['ameal'.$adult]) && count($ssrInfoArr['MEAL'])>0 )

		{		 

			 

			$mealData=explode("-",$ameal);

			$mealDataDataInfo=trim($mealData[0]);

			

				foreach($ssrInfoArr['MEAL'] as $mealsDataValue)

				{

					if($mealDataDataInfo==$mealsDataValue['code'])

					{			 

						 $ssrMealInfosArr=array(

							"key"=>$_SESSION['fistSegmentKey'],

							"code"=>$mealDataDataInfo

						 );	

						 

						$totalSSRPriceForAPI=$totalSSRPriceForAPI+$mealsDataValue['amount'];

						$adultArrTripJack["ssrMealInfos"][]=$ssrMealInfosArr;	 

					}

				}		 

			 

		}	 	

		// if(!empty($_POST['SeatNoInn']) || !empty($_POST['SeatPricearr'])){
		//  $aseat='';

		// 	$SeatNoInn=$_POST['SeatNoInn'];

		// 	$SeatPricearr=$_POST['SeatPricearr'];
		// 	$seatNoData=explode(",",$SeatNoInn);
		// 	$seatPriceData=explode(",",$SeatPricearr);

		// 				if(!empty($seatNoData[$seat_count])){
		// 				 $ssrSeatInfosArr=array(

		// 					"key"=>$_SESSION['fistSegmentKey'],

		// 					"code"=>$seatNoData[$seat_count]

		// 				 );	
						
						 

		// 				$totalSSRPriceForAPI=$totalSSRPriceForAPI+$seatPriceData[$seat_count];

		// 				$adultArrTripJack["ssrSeatInfos"][]=$ssrSeatInfosArr;
		// 		}						

		// 		$seat_count++;
		   



		// }
		$totalflights=$_POST['totalflight'];
		$ssrSeatInfosArr=array();
		
		$flightcount=0;
		for($i=1; $i<=$totalflights; $i++){
		
		
			if(!empty($_POST['SeatNoInn'.$flightcount]) || !empty($_POST['SeatPricearr'.$flightcount])){
			$SeatNoInn=$_POST['SeatNoInn'.$flightcount];
			$SeatPricearr=$_POST['SeatPricearr'.$flightcount];
		  
			$seatNoData=explode(",",$SeatNoInn);
			$seatPriceData=explode(",",$SeatPricearr);
	 
			 $segmentarr=$_POST['segmentid'.$flightcount];
			 $segmentdata=explode(",",$segmentarr);
		
						   
			 if(!empty($seatNoData[$seat_count])){

				 $ssrSeatInfosArr["key"]=$segmentdata[$seat_count];
	 
				 $ssrSeatInfosArr["code"]=$seatNoData[$seat_count];
				
			}
			
			$totalSSRPriceForAPI=$totalSSRPriceForAPI+$seatPriceData[$seat_count];
			$adultArrTripJack["ssrSeatInfos"][]=$ssrSeatInfosArr;
			

				$flightcount++;
		   
		  }
		  
		
		}
		$seat_count++;

		
		if(($_SESSION['tripType']==2))
		{
			$totalflights2=$_POST['totalflight2'];
			$ssrSeatInfosArr2=array();
			
			$flightcount2=0;
			for($i=1; $i<=$totalflights2; $i++){
			
			
				if(!empty($_POST['SeatNoInn2'.$flightcount2]) || !empty($_POST['SeatPricearr2'.$flightcount2])){
				$SeatNoInn2=$_POST['SeatNoInn2'.$flightcount2];
				$SeatPricearr2=$_POST['SeatPricearr2'.$flightcount2];
			  
				$seatNoData2=explode(",",$SeatNoInn2);
				$seatPriceData2=explode(",",$SeatPricearr2);
		 
				 $segmentarr2=$_POST['segmentid2'.$flightcount2];
				 $segmentdata2=explode(",",$segmentarr2);
			
							   
				 if(!empty($seatNoData2[$seat_count2])){
					 $ssrSeatInfosArr2["key"]=$segmentdata2[$seat_count2];
		 
					 $ssrSeatInfosArr2["code"]=$seatNoData2[$seat_count2];
					
				}
				
				$totalSSRPriceForAPI=$totalSSRPriceForAPI+$seatPriceData2[$seat_count2];
   				 $adultArrTripJack["ssrSeatInfos"][]=$ssrSeatInfosArr2;	 
				
	
					$flightcount2++;
			   
			  }
			  
			
			}
				   $seat_count2++;
			  
   
   
   
		}
		







	    $passengerDetailArr[]=$adultArrTripJack;

	  

	}

		

	for($child=1; $child<=$childmain; $child++){

	

		$childArrForTripjack=array();

		if(trim($_POST['titleChd'.$child]) != ''){

		$childArrForTripjack['ti']=trim($_POST['titleChd'.$child]);

		$childArrForTripjack['fN']=trim($_POST['firstNameChd'.$child]);

		$childArrForTripjack['lN']=trim($_POST['lastNameChd'.$child]);

		$childArrForTripjack['pt']='CHILD';



		$DateOfBirth = date("Y-m-d", strtotime(trim($_POST['dobChd'.$child])));

		$childArrForTripjack['dob']= $DateOfBirth;	

		

		if($_SESSION['isdomestic']=='No')

		{

			$childArrForTripjack['pNat']=trim($_POST['nationalityChd'.$child]);

			$childArrForTripjack['pNum']=trim($_POST['passportNumberChd'.$child]);

			$childArrForTripjack['pid']=trim($_POST['passportIssueDateChd'.$child]);

			$childArrForTripjack['eD']=trim($_POST['passportExpiryChd'.$child]);

			

			

		}			

			

				// Only for one Segment

		$baggage="";		

		$baggage = trim($_POST['cbaggage'.$child]);

		if($baggage!="" && isset($_POST['cbaggage'.$child]) && count($ssrInfoArr['BAGGAGE'])>0 )

		{

			$baggageData=explode("-",$baggage);

			$baggageDataInfo=trim($baggageData[0]);

			

				foreach($ssrInfoArr['BAGGAGE'] as $baagageDataValue)

				{

					if($baggageDataInfo==$baagageDataValue['code'])

					{

						 // Baggage infor

						 $baggageInfoArr=array(

							"key"=>$_SESSION['fistSegmentKey'],

							"code"=>$baggageDataInfo

						 );

						 $totalSSRPriceForAPI=$totalSSRPriceForAPI+$baagageDataValue['amount'];

						 $childArrForTripjack["ssrBaggageInfos"][]=$baggageInfoArr;

					 }	 

				}

					

		}

			

		 

		 // Meals infor

		 $ameal='';

		 $ameal = trim($_POST['cmeal'.$child]);

		if($ameal!="" && isset($_POST['cmeal'.$child]) && count($ssrInfoArr['MEAL'])>0 )

		{		 

			 

			$mealData=explode("-",$ameal);

			$mealDataDataInfo=trim($mealData[0]);

			

				foreach($ssrInfoArr['MEAL'] as $mealsDataValue)

				{

					if($mealDataDataInfo==$mealsDataValue['code'])

					{			 

						 $ssrMealInfosArr=array(

							"key"=>$_SESSION['fistSegmentKey'],

							"code"=>$mealDataDataInfo

						 );	

						 

						$totalSSRPriceForAPI=$totalSSRPriceForAPI+$mealsDataValue['amount'];

						$childArrForTripjack["ssrMealInfos"][]=$ssrMealInfosArr;	 

					}

				}		 

			 

		}	

		$totalflights=$_POST['totalflight'];
		$ssrSeatInfosArr=array();
		
		$flightcount=0;
		for($i=1; $i<=$totalflights; $i++){
		
		
			if(!empty($_POST['SeatNoInn'.$flightcount]) || !empty($_POST['SeatPricearr'.$flightcount])){
			$SeatNoInn=$_POST['SeatNoInn'.$flightcount];
			$SeatPricearr=$_POST['SeatPricearr'.$flightcount];
		  
			$seatNoData=explode(",",$SeatNoInn);
			$seatPriceData=explode(",",$SeatPricearr);
	 
			 $segmentarr=$_POST['segmentid'.$flightcount];
			 $segmentdata=explode(",",$segmentarr);
		
						   
			 if(!empty($seatNoData[$seat_count])){
				 $ssrSeatInfosArr["key"]=$segmentdata[$seat_count];
	 
				 $ssrSeatInfosArr["code"]=$seatNoData[$seat_count];


				 $totalSSRPriceForAPI=$totalSSRPriceForAPI+$seatPriceData[$seat_count];
	 
				 $childArrForTripjack["ssrSeatInfos"][]=$ssrSeatInfosArr;	
				
			}
			
		 
			

				$flightcount++;
		   
		  }
		  
		
		}
		$seat_count++;

	if(($_SESSION['tripType']==2))
	{
		$totalflights2=$_POST['totalflight2'];
		$ssrSeatInfosArr2=array();
		
		$flightcount2=0;
		for($i=1; $i<=$totalflights2; $i++){
		
		
			if(!empty($_POST['SeatNoInn2'.$flightcount2]) || !empty($_POST['SeatPricearr2'.$flightcount2])){
			$SeatNoInn2=$_POST['SeatNoInn2'.$flightcount2];
			$SeatPricearr2=$_POST['SeatPricearr2'.$flightcount2];
		  
			$seatNoData2=explode(",",$SeatNoInn2);
			$seatPriceData2=explode(",",$SeatPricearr2);
	 
			 $segmentarr2=$_POST['segmentid2'.$flightcount2];
			 $segmentdata2=explode(",",$segmentarr2);
		
						   
			 if(!empty($seatNoData2[$seat_count2])){
				 $ssrSeatInfosArr2["key"]=$segmentdata2[$seat_count2];
	 
				 $ssrSeatInfosArr2["code"]=$seatNoData2[$seat_count2];
				
			}

			$totalSSRPriceForAPI=$totalSSRPriceForAPI+$seatPriceData2[$seat_count2];
			$childArrForTripjack["ssrSeatInfos"][]=$ssrSeatInfosArr2;	
			

				$flightcount2++;
		   
		  }
		  
		
		}
			   $seat_count2++;
		  


	   }
	
/*		if($_SESSION['isdomestic']=='No')

		{

			$childArrForTripjack['PassportNo']=trim($_POST['passportNumberChd'.$child]);

			$childArrForTripjack['PassportExpiry']=trim($_POST['passportExpiryChd'.$child])."T00:00:00";

		}	*/	



		$passengerDetailArr[]=$childArrForTripjack;

	}

	}

	

	

	for($infant=1; $infant<=$infantmain; $infant++){

	

		$infantArrForTripJack=array();

		if($_POST['firstNameInf'.$infant] != ''){

		$infantArrForTripJack['ti']='Master';

		$infantArrForTripJack['fN']=trim($_POST['firstNameInf'.$infant]);

		$infantArrForTripJack['lN']=trim($_POST['lastNameInf'.$infant]);

		$infantArrForTripJack['pt']='INFANT';

		$DateOfBirth = date("Y-m-d", strtotime(trim($_POST['dobInf'.$infant])));

		

		$infantArrForTripJack['dob']= $DateOfBirth;

					



		if($_SESSION['isdomestic']=='No')

		{

			$infantArrForTripJack['pNat']=trim($_POST['nationalityInf'.$infant]);

			$infantArrForTripJack['pNum']=trim($_POST['passportNumberInf'.$infant]);

			$infantArrForTripJack['pid']=trim($_POST['passportIssueDateInf'.$infant]);

			$infantArrForTripJack['eD']=trim($_POST['passportExpiryInf'.$infant]);

		}	



	  $passengerDetailArr[]=$infantArrForTripJack;

	}

	}

 

 //echo '<pre>';



	

/*

echo "<br>**************************************<br>";

print_r($passengerDetailArr);



echo "<br>**************************************<br>";*/





//$ResultIndex=$res['ResultIndex'];



/*echo "<pre>";

print_r($passengerDetailArr);

die;*/







//echo "<b>***********Booking Request ***************</b>";



   

	$gsInfoArr=array(

			//"gstNumber"=>$gstNo,

			"email"=>$email,

			"registeredName"=>$companyName,

			"mobile"=>$phone,

			"address"=>$address,

	);

	

	$deliveryInfo=array(

		"emails"=>array($email),

		"contacts"=>array($phone),

	

	);	

	

	$tfAmount="".$_SESSION['totalFareAmountBooking']+$totalSSRPriceForAPI."";
	
	$amountToRequest=array("amount"=>$tfAmount);

	$arrayToRequest = array( 

						"bookingId" => $_SESSION['bookingIdReviewAPI'],

						"paymentInfos" => array($amountToRequest),

						"travellerInfo" => $passengerDetailArr,

						"gstInfo" => $gsInfoArr,

						"deliveryInfo" => $deliveryInfo,

					);

//print_r($arrayToRequest);





 

 

 

 

/*echo "<pre>";

print_r($arrayToRequest); 



echo "<br>**********<br>";*/



$postDataBooking= json_encode($arrayToRequest);









$errorStatus=0;

$ErrorMessage='';

$PNR='';

$BookingId='';

$IsPriceChanged='';

$IsTimeChanged='';

$bookingResultJson='';

$Status=0;





//-------------Make Offline------------

 if($onewayflightoffline==0){

 

 

// API Calls for booking //



try

{
	// echo '<pre>';
	// print_r($postDataBooking);
	//  die;
	file_put_contents("tripjackAPIJson/BookRequest.json",$postDataBooking);

	

	$restCaller = new RestApiCaller();

	$flightResBooking = $restCaller->getTripJackResponse(_BOOKING_CONFIRM_URL_, $postDataBooking);

	file_put_contents("tripjackAPIJson/BookResponse.json",$flightResBooking);

	
	// print_r($flightResBooking);
	$bookingResult = json_decode($flightResBooking,true);
	// print_r($bookingResult);
	// die;

	if($bookingResult['status']['success']===true)

	{

		$Status=2;

		$confirmBookingId=$bookingResult['bookingId'];

		$BookingId=$confirmBookingId;

		

		// getbooking details for PNR

		$PostdataBookingDatail='{

  				"bookingId": "'.$confirmBookingId.'"

				}';

		



		file_put_contents("tripjackAPIJson/BookingDetailRequest.json",$PostdataBookingDatail);

		$flightResBookingdetail = $restCaller->getTripJackResponse(_BOOKING_DETAILS_URL_, $PostdataBookingDatail);

		file_put_contents("tripjackAPIJson/BookingDetailResponse.json",$flightResBookingdetail);

		

		$bookingDetailResult = json_decode($flightResBookingdetail,true);
		// 		echo '<pre>';
		// print_r($bookingDetailResult);
		// die;

		if($bookingDetailResult['status']['success']==true)

		{

			$pnrDetailsArr=$bookingDetailResult['itemInfos']['AIR']['travellerInfos'][0]['pnrDetails'];

			foreach($pnrDetailsArr as $destKey=>$pnvrValue)

			{

				$PNR=$pnvrValue;
			

			}
			$ticketNoArr=$bookingDetailResult['itemInfos']['AIR']['travellerInfos'][0]['ticketNumberDetails'];

			foreach($ticketNoArr as $destKey=>$ticketNoValue)

			{

				 $ticketNo=$ticketNoValue;
			}
			

		}

		

		

		sendtickettomail($fullurl,encode($bookinglastId));
		
		sendinvoicetomail($fullurl,encode($bookinglastId));

		

	

	

	}else{

		$subject="Booking Unsuccessfull";
		$mailbody="<strong>Sorry, Something went wrong in your booking!</strong><br>
		Thanks & Regards<br>
		Team Tripjack";

		sendmainmail($email,$subject,$mailbody);
	}

	

	

	//echo "<br>******Result*********<br>";

	//print_r($bookingResult);





}

catch(Exception $e)

{

    $errhdng="Technical Error !!";

    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";

	$ErrorMessage=$errmsg;

   // include dirname(dirname(__FILE__)).'/error.php';

   // exit;

}



 

//die;

  

  if(trim($ErrorMessage)!=''){

    $Status=1;

  }

  



    $namevalue2 ='bookingNumber="'.$BookingId.'",pnrNo="'.$PNR.'",ticketNo="'.$ticketNo.'",ErrorMessage="'.$ErrorMessage.'",status="'.$Status.'",tboBookingId="'.$BookingId.'"'; 

	$where='id="'.$bookinglastId.'" and tripType="1"';

	updatelisting('flightBookingMaster',$namevalue2,$where); 

 


	// update ticket number for adult 

		$k=0;



	 	for($adult=1; $adult<=$adultmain; $adult++){

		  

				$firstName=trim($_POST['firstNameAdt'.$adult]);	

				$namevalue ='ticketNo="'.$ticketNo.'", tboBookingId="'.$BookingId.'" '; 

				$where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="adult" ';

				updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

				$k++;

					

			}	

				



	// update ticket number for child 

		$k=0;



	 	for($child=1; $child<=$childmain; $child++){

		  

			$firstName=trim($_POST['firstNameChd'.$child]);

			$namevalue ='ticketNo="'.$ticketNo.'",tboBookingId="'.$BookingId.'" '; 

			$where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="child" ';

			updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

			$k++;

			

		}




	// update ticket number for infant 

		$k=0;



	 	for($infant=1; $infant<=$infantmain; $infant++){

		  

				$firstName=trim($_POST['firstNameInf'.$infant]);

				$namevalue ='ticketNo="'.$ticketNo.'", tboBookingId="'.$BookingId.'" '; 

				$where='BookingId="'.$bookinglastId.'" and firstName="'.$firstName.'" and paxType="infant" ';

				updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

				 $k++;		 

		 

		}



}



 //----------------------Booking Prosess-------------------------

 

 

    

// $data = unserialize(stripslashes($res['flightCheckData']));

  

 

 

 //logger('INSIDE bookinglastIdRet NULL CONDITION');

// echo "<pre>";

	$bookingNumber=$BookingId;

		 

		 

        if($bookingNumber==''){

		$bookingNumber=$randbookingid;

		}

		

	if(trim($bookingNumber)!=''){	

			

			if($bookingNumber==1){

			$bookingNumber='';

			}

			

			

				if($_SESSION['tripType']==1){

					

					$companyName = trim($_POST['companyName']);

					

	 				//$status = 1;

					

					$insuranceAmount=0;

					$donateAmount=0;

					if($_REQUEST['addInsurance']==1){

					$insurance=addslashes(trim($_REQUEST['insurance']));

					$insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));

					$insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));

					}

					if($_REQUEST['donate']==1){

					$donateDetails=addslashes(trim($_REQUEST['donateDetails']));

					$donateAmount=addslashes(trim($_REQUEST['donateAmount']));

					}

					

					$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 

					$actCost=mysqli_fetch_array($bl);

					

					

					if(round($totalwalletBalance)>$actCost['clientTotalFare']){

					

					

					

					$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);

					$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);

					

					

					$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 

					$lastInv=mysqli_fetch_array($inv); 

					$invoiceId=($lastInv['invoiceId']+1);

					

					



					

					$namevalue ='bookingNumber="'.$bookingNumber.'",clientId="'.$clientId.'",ticketNo="'.$ticketNo.'",companyName="'.$companyName.'",gstNo="'.$gstNo.'",gstEmail="'.$gstEmail.'",insurance="'.$insurance.'",insuranceAmount="'.$insuranceAmount.'",donateAmount="'.$donateAmount.'",donateDetails="'.$donateDetails.'",invoiceId="'.$invoiceId.'",markup="'.$admarkup.'",agentMarkup="'.$agmarkup.'",insuranceDetails="'.$insuranceDetails.'"'; 

					

					$where='id="'.$bookinglastId.'" and tripType="1"';

					updatelisting('flightBookingMaster',$namevalue,$where); 

					

					updatelisting('flightBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'",ticketNo="'.$ticketNo.'" ','BookingId="'.$bookinglastId.'"'); 

		

		

$finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);	





$balnceSheetAmt=($admarkup+$donateAmount+$insuranceAmount+$actCost['agentTotalFare'])-($actCost['agentTotalFare']-$actCost['totalFare']);



$a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['id'].'",amount="'.($total_fare+$othercharges).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a); 

sendbalanceinfotomail(encode($bookinglastId));
	

					if($actCost['agentCommision']>0){   
			

			$finalComm=($actCost['agentCommision']*18/100); 
		 $a ='bookingId="'.$bookinglastId.'",agentId="'.$AgentWebsiteData['id'].'",commission="'.$actCost['agentCommision'].'",gst="'.$finalComm.'"'; 
		addlistinggetlastid('servicesGST',$a); 

		 

		 //-----------------------------------------

			

			//  $a ='bookingId="'.($bookinglastId).'",bookingType="flight_commision",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($actCost['agentCommision']-$finalComm).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
			 $a ='bookingId="'.($bookinglastId).'",bookingType="flight_commision",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($actCost['agentCommision']).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		addlistinggetlastid('sys_balanceSheet',$a);

		

		  

		

		//-----------------------------------------

		

		 

		$agentFinalTDS=($actCost['agentCommision']-$finalComm); 

		$agentFinalTDS=round($agentFinalTDS*$actCost['taxValuePerc']/100); 

		

		 $a ='bookingId="'.($bookinglastId).'",bookingType="flight_GST",agentId="'.$AgentWebsiteData['id'].'",amount="'.$agentFinalTDS.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		addlistinggetlastid('sys_balanceSheet',$a);

		 
		 

		 	//-----------------------------------------
 
		

			$tds=round($actCost['agentCommision']*5/100); 
				

		 $a ='bookingId="'.($bookinglastId).'",bookingType="TDS",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($tds).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		addlistinggetlastid('sys_balanceSheet',$a);

		

		 

		

			}

			

			

 

 

if(offlineflightifagentoffline($_SESSION['agentUserid'],$finalFlightname,$finalFareTypename)==0){

		

     

  

 // $a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.($actCost['agentTotalFare']+$totalAllSsrPrice).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

//addlistinggetlastid('sys_balanceSheet',$a); 

//  $a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.($actCost['agentTotalFare']+$totalAllSsrPrice).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

// addlistinggetlastid('sys_balanceSheet',$a);

  

  if($actCost['agentCommision']>0){  

  

  

			

			$finalComm=($actCost['agentCommision']*18/100); 

		

		 $a ='bookingId="'.$bookinglastId.'",agentId="'.$AgentWebsiteData['parentId'].'",commission="'.$actCost['agentCommision'].'",gst="'.$finalComm.'"';

		addlistinggetlastid('servicesGST',$a);

		  

		  

			

		// 	 $a ='bookingId="'.($bookinglastId).'",bookingType="flight_commision",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($actCost['agentCommision']-$finalComm).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		

		

		//-----------------------------------------

		

		 

		$agentFinalTDS=($actCost['agentCommision']-$finalComm); 

		$agentFinalTDS=round($agentFinalTDS*$actCost['taxValuePerc']/100);  

		

		 

		

		//  $a ='bookingId="'.($bookinglastId).'",bookingType="flight_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.$agentFinalTDS.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		 

		 

		 

		 	//-----------------------------------------

		 

		

			$tds=round($actCost['agentCommision']*5/100); 

		


		

		//  $a ='bookingId="'.($bookinglastId).'",bookingType="TDS",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($tds).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		

		 

		



		

		 

			}

  

  		//-----------Markup to masteradmin--------------

		



		//  $a ='bookingId="'.($bookinglastId).'",bookingType="Markup",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($finalAgentTax).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);



} else {











$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating",agentId="'.$AgentWebsiteData['parentId'].'",amount="10",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a); 



$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="1.80",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a); 





}





			

			

			

			

			

			

			

			

			

			

			

			

			

			

 



						} 



				}

				

			

			 

		

	
	 

			

			}

		

		

		

		 

		

		

		

		

}













//----------------------Return Flight----------------------





$discountPrice=0;

$cashbackPrice=0;



if($resret['discountType']==1 && $resret["couponType"]==1){

$discountPrice=$resret['discount'];

}



if($resret['discountType']==2 && $resret["couponType"]==1){

$discountPrice=trim(($resret['discount']*($basefare[1]+$basefareret))/100);

}



if($resret['discountType']==1 && $resret["couponType"]==2){

$cashbackPrice=$resret['discount'];

}



if($resret['discountType']==2 && $resret["couponType"]==2){

$cashbackPrice=trim(($resret['discount']*($basefare[1]+$basefareret))/100);

}



$totalPayableAmount=($basefare[1]+$basefareret)-$discountPrice;









$passengerDetailArr2=array();




	



if($_POST['flighttwo']!='' && $resret['id']>0 && $resret['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$totalPayableAmount && $age == false){

$bookingpro=1;



#################################### Meal Baggage SSR #############################################



	$ssr_result= $_SESSION['SSR2']; 

	$mealpref= $ssr_result['Response']['MealDynamic']['0'];  

	$baggagepref= $ssr_result['Response']['Baggage']['0'];

	$seatref= $ssr_result['Response']['SeatDynamic']['0']['SegmentSeat']['0']['RowSeats'];



#################################### Meal Baggage SSR #############################################

  



$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flighttwo'])).'" and agentId="'.$_SESSION['agentUserid'].'"');

$res=mysqli_fetch_array($ab);  

  

   

/*  foreach((array) unserialize(stripslashes($res['PARAM_DATA'])) as $layoverFlight){

  

 $adultmain=$layoverFlight->adt;

 $childmain=$layoverFlight->chd;

 $infantmain=$layoverFlight->inf;

  }*/

  

 

 $adultmain=$_SESSION['ADT'];

 $childmain=$_SESSION['CHD'];

 $infantmain=$_SESSION['INF'];   

   





$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 

$AgentWebsiteData=mysqli_fetch_array($rs);  





$bl=GetPageRecord('*','taxMaster','id=1 '); 

$taxData=mysqli_fetch_array($bl);



$source=$resret['ORG_NAME'].'-'.$resret['ORG_CODE'];

$destination=$resret['DES_NAME'].'-'.$resret['DES_CODE'];

$journeyDate=$resret['DEP_DATE'];

$sector=$res['sector'];

$bookingDate=date('Y-m-d H:i:s');

$agentId=$_SESSION['agentUserid'];

$PCC=$resret['PCC'];

$flightName=$resret['FLIGHT_NAME'];

$flightNo=$resret['FLIGHT_NO'];
$refundyes=$resret['refundtype'];
$flightCode=$resret['FLIGHT_CODE'];

$arrivalTime=$resret['ARRV_TIME'];

$arrivalDate=$resret['ARRV_DATE'];

$departureTime=$resret['DEP_TIME'];

$clientBaseFare=$resret['DEP_TIME'];

$markup = '0';

$agentMarkup = '0';

$bookingType = '0'; 

if($res['F_CLASS']=='ECONOMY'){ $flightClass='Economy'; } else { $flightClass='Business'; } 

$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO);

$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2])));

$flightStop=$res['STOP'];

$agentCommision=$res['acom'];





	$clientFareOW = json_decode(taxBreakupFunc($resret['clfare']));

	$bareFare = $clientFareOW->bareFare;

	$tax = $clientFareOW->tax;

	$totalFare = $clientFareOW->totalFare;

	

	//Price of admin fare onward flight

	$adminFareOW = json_decode(taxBreakupFunc($resret['adfare']));

	$adminBaseFareOW = $adminFareOW->bareFare;

	$adminTaxOW = $adminFareOW->tax;

	$adminTotalOW = $adminFareOW->totalFare;

	

	//Price of agent fare onward flight

	$agentFareOW = json_decode(taxBreakupFunc($resret['agfare']));

	$agentBaseFareOW = $agentFareOW->bareFare;

	$agentTaxOW = $agentFareOW->tax;

	$agentTotalOW = $agentFareOW->totalFare;

	

	

		if($taxData['applicableType']=='commission'){

		$agentFinalGST=(($_REQUEST['acom']*$taxData['valuePerc'])/100);

	}

	

	if($taxData['applicableType']=='totalfare'){

		// $agentFinalGST=(($adminBaseFareOW*$taxData['valuePerc'])/100);
		$TotalGST2=$_POST['TotalBaseFare2'];
		$agentFinalGST=(($TotalGST2*$taxData['valuePerc'])/100);

	}



  

//-------------------Booking Entry-------------------------  

  		



$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",source="'.$source.'",apiType="tbo",status=0,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",cancellationMarkup="'.$_POST['cancellationmarkup2'].'",refundyes="'.$refundtype.'",flightNo="'.$flightNo.'",flightCode="'.$flightCode.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",departureTime="'.$departureTime.'",clientBaseFare="'.$TotalBaseFare2.'",clientTax="'.$TotalTax2.'",clientTotalFare="'.$TotalBaseTax2.'",baseFare="'.$TotalBaseFare2.'",tax="'.$TotalTax2.'",totalFare="'.$TotalBaseTax2.'",agentBaseFare="'.$TotalBaseFare2.'",agentTax="'.$TotalTax2.'",agentTotalFare="'.$TotalBaseTax2.'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$agentCommision2.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($resret['searchJson']).'",couponCode="'.$resret['couponCode'].'",discountType="'.$resret['discountType'].'",couponValue="'.$resret['couponValue'].'",seatPrice="'.$SeatPriceInn2.'",extraBaggagePrice="'.$BaggageFeeInn2.'",mealPrice="'.$MealFeeInn2.'",fareClass="'.$resret['F_CLASS'].'",couponType="'.$resret['couponType'].'",agentFixedMakup="'.$resret['agentFixedMakup'].'",roundTripId="'.$roundtripid.'"';  

$bookinglastId2 = addlistinggetlastid('flightBookingMaster',$namevalue);

  

  $bookinglastIdret=$bookinglastId2;

if($resret["couponType"]==2){

$a11 ='agentId="'.$_SESSION['agentUserid'].'",amount="'.$cashbackPrice.'",remarks="Cashback offer",paymentMethod="Online",transactionId="'.encode($bookinglastId2).'", paymentType="Credit",bookingId="'.encode($bookinglastId2).'",bookingType="Flight",addedBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a11);

}


//-------------------Booking Entry End-------------------------  

 

 // hidden field for baggage meal and seat dynamic 

$baseFareInn=$_REQUEST['baseFareInn'];

$TaxAndFeeInn=$_REQUEST['TaxAndFeeInn'];

$BaggageFeeInn=$_REQUEST['BaggageFeeInn'];
$BaggageFeeInnC=$_REQUEST['BaggageFeeInnC'];
$BaggageFeeInn=$BaggageFeeInn+$BaggageFeeInnC;
$MealFeeInn=$_REQUEST['MealFeeInn'];
$MealFeeInnC=$_REQUEST['MealFeeInnC'];
$MealFeeInn=$MealFeeInn+$MealFeeInnC;
$SeatFeeInn=$_REQUEST['SeatFeeInn'];

$SeatPriceInn=$_REQUEST['SeatPriceInn'];

$SeatNoInn=$_REQUEST['SeatNoInn'];



$asector=$_REQUEST['asector'];

$abaggage=$_REQUEST['abaggage'];

$ameal=$_REQUEST['ameal'];







// For Return Flight

$BaggageFeeInn2=$_REQUEST['BaggageFeeInn2'];
$BaggageFeeInnC2=$_REQUEST['BaggageFeeInnC2'];

$BaggageFeeInn2=$BaggageFeeInn2+$BaggageFeeInnC2;

$MealFeeInn2=$_REQUEST['MealFeeInn2'];
$MealFeeInnC2=$_REQUEST['MealFeeInnC2'];

$MealFeeInn2=$MealFeeInn2+$MealFeeInnC2;

$SeatFeeInn2=$_REQUEST['SeatFeeInn2'];

$SeatPriceInn2=$_REQUEST['SeatPriceInn2'];

$SeatNoInn2=$_REQUEST['SeatNoInn2'];
 
$othercharges=round($BaggageFeeInn2+$MealFeeInn2+$SeatPriceInn2);

$asector2=isset($_REQUEST['asector2'])?$_REQUEST['asector2']:"";

$abaggage2=isset($_REQUEST['abaggage2'])?$_REQUEST['abaggage2']:"";

$ameal2=isset($_REQUEST['ameal2'])?$_REQUEST['ameal2']:"";

$totalAmountToPay=$_REQUEST['totalAmountToPay'];



$otherPrices=$BaggageFeeInn+$BaggageFeeInn2+$MealFeeInn+$MealFeeInn2+$SeatPriceInn+$SeatPriceInn2;
// $total_fare=($baseFareInn+$TaxAndFeeInn+$totalcommissiongstdisplay+$totaltdsdisplay)-$earnedcommission;
$total_fare=($baseFareInn+$TaxAndFeeInn);


 // insert SSR Details 

 

$namevalueSRR ='BookingId="'.$bookinglastId2.'",baseFareInn="'.$baseFareInn.'",TaxAndFeeInn="'.$TaxAndFeeInn.'",BaggageFeeInn="'.$BaggageFeeInn.'",MealFeeInn="'.$MealFeeInn.'",SeatFeeInn="'.$SeatFeeInn.'",SeatPriceInn="'.$SeatPriceInn.'",SeatNoInn="'.$SeatNoInn.'",asector="'.$asector.'",abaggage="'.$_POST['abaggage1'].'",ameal="'.$_POST['ameal1'].'",BaggageFeeInn2="'.$BaggageFeeInn2.'",MealFeeInn2="'.$MealFeeInn2.'",SeatFeeInn2="'.$SeatFeeInn2.'",SeatPriceInn2="'.$SeatPriceInn2.'",SeatNoInn2="'.$SeatNoInn2.'",asector2="'.$asector2.'",abaggage2="'.$_POST['abaggage21'].'",ameal2="'.$_POST['ameal21'].'",totalAmountToPay="'.$totalAmountToPay.'"';  



$flghtSSRLastId = addlistinggetlastid('flight_booking_ssr_details',$namevalueSRR); 



 

 

  

  

  

 

for ($adult = 0; $adult <= $adultmain; $adult++){  

$guestname=addslashes($_POST['firstNameAdt'.$adult]);

}





$guestname = trim($guestname);

$email = trim($_POST['email']);

$phone = trim($_POST['phone']);

$companyName = trim($_POST['companyName']);

$gstNo = trim($_POST['gstNo']);

$gstEmail = trim($_POST['gstEmail']);

$address = addslashes($_POST['address']);



 
$ab=GetPageRecord('*','sys_branchMaster',' id=1'); 
$branchdatamain=mysqli_fetch_array($ab);


if($guestname=='')

{

	$guestname=$branchdatamain['contactPerson'];

}

if($email=='')

{

	$email=$branchdatamain['email'];

}

if($phone=='')

{

	$phone=$branchdatamain['phone'];

}



if($companyName=='')

{

	$companyName=$branchdatamain['companyName'];

}



if($gstNo=='')

{

	$gstNo=$branchdatamain['taxId'];

}



if($address=='') 
{

	$address=$branchdatamain['address'];

}








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











//-------------Adult-----------------

 

for ($adult = 1; $adult <= $adultmain; $adult++) { 

 

 if($_REQUEST['adtPassEx'.$adult]==''){

 $adtPassEx='1970-01-01';

 } else {

 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));

 }
 $totalflights2=$_POST['totalflight2'];
 $seat_price2=array();
 $seat_no2=array();
 $flight_code2=array();
 
 $flightcount2=0;
 for($i=1; $i<=$totalflights2; $i++){
 
 
	 if(!empty($_POST['SeatNoInn2'.$flightcount2]) || !empty($_POST['SeatPricearr2'.$flightcount2])){
	 $SeatNoInn2=$_POST['SeatNoInn2'.$flightcount2];
	 $SeatPricearr2=$_POST['SeatPricearr2'.$flightcount2];
   
	 $seatNoData2=explode(",",$SeatNoInn2);
	 $seatPriceData2=explode(",",$SeatPricearr2);

	  $segmentarr2=$_POST['segmentKey2'.$flightcount2];
	  $segmentdata2=explode(",",$segmentarr2);
 
					 $seat_price2[]=$seatPriceData2[$seat_pax_count2];
 
					 $seat_no2[]=$seatNoData2[$seat_pax_count2];
					 $flight_code2[]=$segmentdata2[$seat_pax_count2];
	 }
	 
 
		 $flightcount2++;
	
   }
				 $seatprice2='';
				 $seatno2='';
				 $flightcode2='';
				 foreach ($seat_no2 as $value ) {
					$seatno2.=$value.',';
				  //echo count($selectedPax);
					
				 }
				 foreach ($seat_price2 as $value ) {
					 $seatprice2.=$value.',';
				   //echo count($selectedPax);
					 
				  }
				  foreach ($flight_code2 as $value ) {
					 $flightcode2.=$value.',';
				   //echo count($selectedPax);
					 
				  }
 
				  $seat_pax_count2++;
 

$namevalue ='BookingId="'.$bookinglastId2.'",ticketNo="'.$ticketNo.'",bookingNumber="'.$bookinglastId2.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",documentId="'.trim($_POST['docId'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult",sector="'.trim($_POST['asector2'.$adult]).'",baggage="'.trim($_POST['abaggage2'.$adult]).'",meal="'.trim($_POST['ameal2'.$adult]).'",flightCode="'.$flightcode2.'",seatAdultCode="'.$seatno2.'",seatAdultPrice="'.$seatprice2.'"  ,roundTripId="'.$roundtripid.'",agentId="'.$_SESSION['agentUserid'].'"';

addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 





}





//-------------Child-----------------





for ($child = 1; $child <= $childmain; $child++) { 



 if($_REQUEST['adtPassEx'.$child]==''){

 $adtPassEx='1970-01-01';

 } else {

 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$child]));

 }
 $totalflights2=$_POST['totalflight2'];
 $seat_price2=array();
 $seat_no2=array();
 $flight_code2=array();
 
 $flightcount2=0;
 for($i=1; $i<=$totalflights2; $i++){
 
 
	 if(!empty($_POST['SeatNoInn2'.$flightcount2]) || !empty($_POST['SeatPricearr2'.$flightcount2])){
	 $SeatNoInn2=$_POST['SeatNoInn2'.$flightcount2];
	 $SeatPricearr2=$_POST['SeatPricearr2'.$flightcount2];
   
	 $seatNoData2=explode(",",$SeatNoInn2);
	 $seatPriceData2=explode(",",$SeatPricearr2);

	  $segmentarr2=$_POST['segmentKey2'.$flightcount2];
	  $segmentdata2=explode(",",$segmentarr2);
 
					 $seat_price2[]=$seatPriceData2[$seat_pax_count2];
 
					 $seat_no2[]=$seatNoData2[$seat_pax_count2];
					 $flight_code2[]=$segmentdata2[$seat_pax_count2];
	 }
	 
 
		 $flightcount2++;
	
   }
				 $seatprice2='';
				 $seatno2='';
				 $flightcode2='';
				 foreach ($seat_no2 as $value ) {
					$seatno2.=$value.',';
				  //echo count($selectedPax);
					
				 }
				 foreach ($seat_price2 as $value ) {
					 $seatprice2.=$value.',';
				   //echo count($selectedPax);
					 
				  }
				  foreach ($flight_code2 as $value ) {
					 $flightcode2.=$value.',';
				   //echo count($selectedPax);
					 
				  }
 
				  $seat_pax_count2++;

$namevalue ='BookingId="'.$bookinglastId2.'",ticketNo="'.$ticketNo.'",bookingNumber="'.$bookinglastId2.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child" ,sector="'.trim($_POST['csector2'.$child]).'",baggage="'.trim($_POST['cbaggage2'.$child]).'",meal="'.trim($_POST['cmeal2'.$child]).'",seatAdultCode="'.$seatno2.'",flightCode="'.$flightcode2.'",seatAdultPrice="'.$seatprice2.'" ,roundTripId="'.$roundtripid.'",agentId="'.$_SESSION['agentUserid'].'" ';

addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 



 

}









//-------------Infant-----------------







for($infant = 1; $infant <= $infantmain; $infant++) { 





 if($_REQUEST['adtPassEx'.$infant]==''){

 $adtPassEx='1970-01-01';

 } else {

 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$infant]));

 }

 









$namevalue ='BookingId="'.$bookinglastId2.'",ticketNo="'.$ticketNo.'",bookingNumber="'.$bookinglastId2.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant",roundTripId="'.$roundtripid.'",agentId="'.$_SESSION['agentUserid'].'"';

addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 



}



















$insuranceAmount=0;

   if($_REQUEST['addInsurance']==1){

   $insurance=addslashes(trim($_REQUEST['insurance']));

   $insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));

   $insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));

   }

   $donateAmount=0;

   if($_REQUEST['donate']==1){

	$donateDetails=addslashes(trim($_REQUEST['donateDetails']));

	$donateAmount=addslashes(trim($_REQUEST['donateAmount']));

	}

  

  $finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);

  



$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId2.'" '); 

$actCost=mysqli_fetch_array($bl);

  

$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);

$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);





$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 

$lastInv=mysqli_fetch_array($inv); 

$invoiceId=($lastInv['invoiceId']+1);



			

		



$errorStatus=0;

$ErrorMessage='';

$PNR2='';

//$BookingId='';

$IsPriceChanged='';

$IsTimeChanged='';

$bookingResultJson='';

//$Status=0;







 $randbookingid='OFF-'.rand(11111111,99999999);



//-------------Make Offline------------

 if($retrunflightoffline==0){





    $namevalue2 ='bookingNumber="'.$BookingId.'",pnrNo="'.$PNR.'",IsLCC="'.$IsLCC.'",ticketNo="'.$ticketNo.'",ErrorMessage="'.$ErrorMessage.'",status="'.$Status.'",tboBookingId="'.$BookingId.'"'; 

	$where='id="'.$bookinglastId2.'" and tripType="1"';

	updatelisting('flightBookingMaster',$namevalue2,$where); 







	// update ticket number for adult 

		$k=0;



	 	for($adult=1; $adult<=$adultmain; $adult++){

		  

			$firstName=trim($_POST['firstNameAdt'.$adult]);

			$namevalue ='ticketNo="'.$ticketNo.'",tboBookingId="'.$BookingId.'" '; 

			$where='BookingId="'.$bookinglastId2.'" and firstName="'.$firstName.'" and paxType="adult" ';

			updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

			$k++;				 

		}







	// update ticket number for child 

		$k=0;



	 	for($child=1; $child<=$childmain; $child++){

		  

			$firstName=trim($_POST['firstNameChd'.$child]);

			$namevalue ='ticketNo="'.$ticketNo.'", tboBookingId="'.$BookingId.'" '; 

			$where='BookingId="'.$bookinglastId2.'" and firstName="'.$firstName.'" and paxType="child" ';

			updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

			$k++;



		}





	// update ticket number for infant 

		$k=0;



	 	for($infant=1; $infant<=$infantmain; $infant++){

		  

				$firstName=trim($_POST['firstNameInf'.$infant]);

				$namevalue ='ticketNo="'.$ticketNo.'",tboBookingId="'.$BookingId.'" '; 

				$where='BookingId="'.$bookinglastId2.'" and firstName="'.$firstName.'" and paxType="infant" ';

				updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

				$k++;

					

		}

		



}



		



		$bookingNumber=$BookingId;

		//$bookingNumber=1;

		//$bookingNumber = $bookingdata->RESULT{0}->BOOKINGID;

		

	  if($bookingNumber==''){

		$bookingNumber=$randbookingid;

		}

		

 

		

	if(trim($bookingNumber)!=''){	

			

			if($bookingNumber==1){

			$bookingNumber='';

			}

			

			

				if($_SESSION['tripType']==2){

					

					$companyName = trim($_POST['companyName']);

					

	 				$status = 1;

					

					$insuranceAmount=0;

					$donateAmount=0;

					if($_REQUEST['addInsurance']==1){

					$insurance=addslashes(trim($_REQUEST['insurance']));

					$insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));

					$insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));

					}

					if($_REQUEST['donate']==1){

					$donateDetails=addslashes(trim($_REQUEST['donateDetails']));

					$donateAmount=addslashes(trim($_REQUEST['donateAmount']));

					}

					

					$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId2.'" '); 

					$actCost=mysqli_fetch_array($bl);

					

					

					if(round($totalwalletBalance)>$actCost['clientTotalFare']){

					

					

					

					$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);

					$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);

					

					

					$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 

					$lastInv=mysqli_fetch_array($inv); 

					$invoiceId=($lastInv['invoiceId']+1);

					

					



					

					$namevalue ='bookingNumber="'.$bookingNumber.'",clientId="'.$clientId.'",companyName="'.$companyName.'",gstNo="'.$gstNo.'",gstEmail="'.$gstEmail.'",insurance="'.$insurance.'",insuranceAmount="'.$insuranceAmount.'",donateAmount="'.$donateAmount.'",donateDetails="'.$donateDetails.'",invoiceId="'.$invoiceId.'",markup="'.$admarkup.'",agentMarkup="'.$agmarkup.'",insuranceDetails="'.$insuranceDetails.'"'; 

					

					$where='id="'.$bookinglastId2.'" and tripType="1"';

					updatelisting('flightBookingMaster',$namevalue,$where); 

					updatelisting('flightBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','BookingId="'.$bookinglastId2.'"'); 

		

		

$finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);	





$balnceSheetAmt=($admarkup+$donateAmount+$insuranceAmount+$actCost['agentTotalFare'])-($actCost['agentTotalFare']-$actCost['totalFare']);






$a ='bookingId="'.$bookinglastId2.'",bookingType="flight",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($total_fare+$otherPrices).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a); 

 

	




if($actCost['agentCommision']>0){   
			

			$finalComm=($actCost['agentCommision']*18/100); 
		 $a ='bookingId="'.$bookinglastIdret.'",agentId="'.$AgentWebsiteData['id'].'",commission="'.$actCost['agentCommision'].'",gst="'.$finalComm.'"'; 
		addlistinggetlastid('servicesGST',$a); 
  
		 //-----------------------------------------
 

			 $a ='bookingId="'.($bookinglastIdret).'",bookingType="flight_commision",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($actCost['agentCommision']-$finalComm).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"'; 
			addlistinggetlastid('sys_balanceSheet',$a);
 
		

		//----------------------------------------- 

		$agentFinalTDS=($actCost['agentCommision']-$finalComm); 

		$agentFinalTDS=round($agentFinalTDS*$actCost['taxValuePerc']/100);  
		 $a ='bookingId="'.($bookinglastIdret).'",bookingType="flight_GST",agentId="'.$AgentWebsiteData['id'].'",amount="'.$agentFinalTDS.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"'; 
		addlistinggetlastid('sys_balanceSheet',$a);  

		 	//----------------------------------------- 
		

			$tds=round($actCost['agentCommision']*5/100); 

		 $a ='bookingId="'.($bookinglastIdret).'",bookingType="TDS",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($tds).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		addlistinggetlastid('sys_balanceSheet',$a);
 

			}

			

			

 

 

if(offlineflightifagentoffline($_SESSION['agentUserid'],$finalFlightname,$finalFareTypename)==0){

		



	      

  

// $a ='bookingId="'.$bookinglastIdret.'",bookingType="flight",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.($actCost['agentTotalFare']+$totalAllSsrPrice).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

// addlistinggetlastid('sys_balanceSheet',$a); 

		

  

  if($actCost['agentCommision']>0){   

			

			$finalComm=($actCost['agentCommision']*18/100); 

		

		//  $a ='bookingId="'.$bookinglastIdret.'",agentId="'.$AgentWebsiteData['parentId'].'",commission="'.$actCost['agentCommision'].'",gst="'.$finalComm.'"';

		// addlistinggetlastid('servicesGST',$a);

		  

		  

			

		// 	 $a ='bookingId="'.($bookinglastIdret).'",bookingType="flight_commision",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($actCost['agentCommision']-$finalComm).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		

		

		//-----------------------------------------

		

		 

		$agentFinalTDS=($actCost['agentCommision']-$finalComm); 

		$agentFinalTDS=round($agentFinalTDS*$actCost['taxValuePerc']/100);  

		

		 

		

		//  $a ='bookingId="'.($bookinglastIdret).'",bookingType="flight_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.$agentFinalTDS.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		 

		 

		 

		 	//-----------------------------------------

		 

		

			$tds=round($actCost['agentCommision']*5/100); 

		

		

		//  $a ='bookingId="'.($bookinglastIdret).'",bookingType="TDS",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($tds).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		

		 

	

		



		

			}

  

  	

		//-----------Markup to masteradmin--------------

		

		

		//  $a ='bookingId="'.($bookinglastIdret).'",bookingType="Markup",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($finalAgentTax).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

		// addlistinggetlastid('sys_balanceSheet',$a);

		



} else {











$a ='bookingId="'.$bookinglastIdret.'",bookingType="Facilitating",agentId="'.$AgentWebsiteData['parentId'].'",amount="10",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a); 



$a ='bookingId="'.$bookinglastIdret.'",bookingType="Facilitating_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="1.80",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('sys_balanceSheet',$a); 





}



 



} 



				}

				

			

			 

		

			

 

			

			}

		

		

		

		 

		

		

		

		

}


	

			

deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"');



if($bookingpro!=1){ ?>



<script>

alert('Something Went Wrong. Please Try Again.');

window.parent.location.href = "<?php echo $fullurl; ?>"; 

</script>





<?php exit(); }

if($age == false){
?>
<script>

alert('Something Went Wrong. Please Try Again.');

window.parent.location.href = "<?php echo $fullurl; ?>"; 

</script>
<?php
}
// die;
header("Location:".$fullurl.'flight-bookings');


 ?>





