<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';
include 'tripjackAPI/APIConstants.php';
include 'tripjackAPI/RestApiCaller.php';

function gethotelimgna($imgname){
if(strpos($imgname, 'HotelNA.jpg') !== false){
    return 'images/nohotelimage.png';
} else {
return $imgname;
}
}


$agentid=$_SESSION['agentUserid'];

$category='';

if(!empty($_REQUEST['category'])) {
    foreach($_REQUEST['category'] as $check) {
        $category.=$check.','; 
    }
}
$starcategory=$_REQUEST['starcategory'];
 
$travellers='1 Room - 1 Guest';
if($_REQUEST['travellers']!=''){
$travellers=$_REQUEST['travellers'];
}

$starcategory='3, 4 Star';
if($_REQUEST['starcategory']!=''){
$starcategory=$_REQUEST['starcategory'];
}
$checkInDate=date('d-m-Y', strtotime('+1 days'));
if($_REQUEST['checkInDate']!=''){
$checkInDate=$_REQUEST['checkInDate'];
}
  
$checkOutDate=date('d-m-Y', strtotime('+2 days'));
if($_REQUEST['checkOutDate']!=''){
$checkOutDate=$_REQUEST['checkOutDate'];
}
 
$destinationHotel='130443,IN'; 
if($_REQUEST['destinationHotel']!=''){
$destinationHotel=$_REQUEST['destinationHotel'];
}
 
$citydestination='Delhi,India'; 
if($_REQUEST['citydestination']!=''){
$citydestination=$_REQUEST['citydestination'];
}





////////=============Online=======================================






$category='';

if(!empty($_REQUEST['category'])) {
    foreach($_REQUEST['category'] as $check) {
        $category.=$check.','; 
    }
}
 $category=rtrim($category,', '); 

if($_GET['citydestination']!=""){ 

if(strpos(strtoupper($_GET['citydestination']), 'INDIA')){
    $domesticInternational = 'Yes';
}else{
    $domesticInternational = 'No';
}

 


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



$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';


}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

if($childTotal>0)
{
	$norooms.='{
					"numberOfAdults": '.$adultTotal.',
					"numberOfChild": '.$childTotal.',
					"childAge": ['.rtrim($childAge,',').']	
			   },';
	
	$roomJson.= '{
					"Adult": ['.rtrim($adultJson,',').'],
					"Child": ['.rtrim($childJson,',').']
				},';
				
}
else
{
		$norooms.='{
					"numberOfAdults": "'.$adultTotal.'"	
			   },';

}			

$n++; 

}

 $hotelBasicJson = '{
	"Destination":"'.$_GET['citydestination'].'",
	"CheckIn":"'.$checkInDateapi.'",
	"CheckOut":"'.$checkOutDateapi.'",
	"TotalRoom":"'.$_GET['empcount'].'",
	"TotalAdult":"'.$adultCount.'",
	"TotalChild":"'.$childCount.'",
	"Domestic":"'.$domesticInternational.'",
	"RoomDetails":['.rtrim($roomJson,',').']
}';

 $jsonPost = '{
    "searchQuery": {
        "checkinDate": "'.$checkInDateapi.'",
        "checkoutDate": "'.$checkOutDateapi.'",
        "roomInfo": ['.rtrim($norooms,',').'],
        "searchCriteria": {
            "city": "'.$city.'",
            "nationality": "106",
            "currency": "INR"
        },
        "searchPreferences": {
            "ratings": ['.$category.'],
            "fsc": true
        }
    },
    "sync": false
}';

// $jsonPost = '{"searchQuery":{"checkinDate":"2023-01-05","checkoutDate":"2023-01-06","roomInfo":[{"numberOfAdults":"1"}],"searchCriteria":{"city":"725862","nationality":"106","currency":"INR"},"searchPreferences":{"ratings":[1,2,3,4,5],"fsc":"true"}},"sync":"false"}';

$_SESSION['hotelBasicJson']= $hotelBasicJson;

$api=GetPageRecord('*','sys_companyMaster',' id=1'); 
$apiData=mysqli_fetch_array($api); 
/*echo '<pre>';
print_r($jsonPost);
echo '</pre>';*/
//$url = stripslashes($apiData['hotelApiKey']); // URL To Hit
$url = $hotelsearchquerylist; // URL To Hit
 
 
echo $jsonPost;
  echo "<br><br><br>"; 
 echo $url;
 echo "<br>";
 echo $hotelApiKey;
 
 
$restCaller = new RestApiCaller();
$result = $restCaller->getTripJackResponse($url, $jsonPost);
//$result=file_put_contents("tripjackAPIJson/".$agentId."_SearchResult.txt","$flightRes");

 
//$result = getHotelApiData($url,$jsonPost,$hotelApiKey);

//print_r($result);
$resultArr = json_decode($result);
// echo "<br>";
//print_r($resultArr);



$searchId = $resultArr->searchIds{0};

$urlsecond = $hotelsearch; // URL To Hit
$searchPostJosn = '{ "searchId":"'.$searchId.'" }';

echo "*************<br>";
echo $hotelsearch;
echo "*************<br>";
echo $searchPostJosn;

$listJson=$restCaller->getTripJackResponse($hotelsearch, $searchPostJosn);
$hotelData = json_decode($listJson);


//print_r($listJson);

/*echo '<pre>'; print_r($result);
echo '<br /><br /><br />
<br />
';
 print_r($listJson);
echo '</pre>';*/
}
$datetime1 = date_create($checkInDateapi);
$datetime2 = date_create($checkOutDateapi);
$interval = date_diff($datetime1, $datetime2);
$days = $interval->format('%a');




 $destination = explode(',',$_GET['citydestination']);
		  $citydestination = $destination[0];
		  
		  $values = $hotelData->searchResult->his;
		  foreach($values as $hotelList){
		  
		  $count++;
		
		
		$source=$hotelList->img{0}->tns;
    $contents=file_get_contents( $source );
	
	 $source=$hotelList->img{0}->tns;
	
	}






////////=============Offline=======================================












$norooms='';
$roomJson= '';
$n=1;
$adultTotal=0;
$childTotal=0;


$childAge='';
$childJson='';
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

 




$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';


}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

 

$n++; 

}

 


  

if(strpos(strtoupper($_GET['citydestination']), 'INDIA')){
    $domesticInternational = 'Yes';
}else{
    $domesticInternational = 'No';
}

 


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
$adultCount=0;
$childCount=0;


$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
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
	"Domestic":"'.$domesticInternational.'",
	"RoomDetails":['.rtrim($roomJson,',').']
}';

  $jsonPost = '{
    "searchQuery": {
        "checkinDate": "'.$checkInDateapi.'",
        "checkoutDate": "'.$checkOutDateapi.'",
        "roomInfo": ['.rtrim($norooms,',').'],
        "searchCriteria": {
            "city": "'.$city.'",
            "nationality": "106",
            "currency": "INR"
        },
        "searchPreferences": {
            "ratings": ['.$category.'],
            "fsc": true
        }
    },
    "sync": false
}';


//echo $jsonPost;

$api=GetPageRecord('*','sys_companyMaster',' id=1'); 
$apiData=mysqli_fetch_array($api); 
/*echo '<pre>';
print_r($jsonPost);
echo '</pre>';*/
//$url = stripslashes($apiData['hotelApiKey']); // URL To Hit
$url = "https://tripjack.com/hms/v1/hotel-searchquery-list"; // URL To Hit
 
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$resultArr = json_decode($result);
$searchId = $resultArr->searchIds{0};

$urlsecond = "https://apitest.tripjack.com/hms/v1/hotel-search"; // URL To Hit
$searchPostJosn = '{ "searchId":"'.$searchId.'" }';
//$listJson = getHotelApiData($urlsecond,$searchPostJosn,$hotelApiKey);

//echo $urlsecond.'<br>';
//echo $searchPostJosn.'<br>';


$crl = curl_init($urlsecond);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $searchPostJosn);
    
    // Set HTTP Header for POST request 
    curl_setopt($crl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'APIkey: ' . $hotelApiKey));
    
    // Submit the POST request
   // return $result = curl_exec($crl);
	$result = curl_exec($crl);
 $listJson = $result;
//echo ($result).'--------------';

 
//print_r(json_decode($result));

$hotelData = json_decode($listJson);
//echo $searchPostJosn;


 //print_r($listJson);

 print_r($result);
 print_r($hotelData);
 echo '</pre>';

/*echo '<pre>'; print_r($result);
echo '<br /><br /><br />
<br />
';
print_r($listJson);
echo '</pre>';*/
 
$datetime1 = date_create($checkInDateapi);
$datetime2 = date_create($checkOutDateapi);
$interval = date_diff($datetime1, $datetime2);
$days = $interval->format('%a');
?>






<div class="col-2 filtersidebar hotelfilter">

<div class="card">
<div class="card-header">
    Price Range
  </div>
<div class="card-body">
		<div class=""> 
			<p class="range-value">
			<input type="text" id="amountfilter" readonly style="border: 0px;">
			</p>
		<div id="slider-ranges" class="range-bar"></div> 
		</div>
</div>

<div class="card-header">
    Star Rating
  </div>
<div class="card-body" id="allFilterDiv">
<div class="arranddep">
 <label id="1star" style="display:none;"><input  type="checkbox" value="1star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 1 Star</label>
 <label id="2star"  style="display:none;"><input type="checkbox" value="2star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 2 Star</label>
 <label id="3star" style="display:none;" ><input  type="checkbox" value="3star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 3 Star</label>
 <label id="4star" style="display:none;"><input  type="checkbox" value="4star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 4 Star</label>
 <label id="5star" style="display:none;"><input  type="checkbox" value="5star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 5 Star</label>

</div> 
</div>

 <div class="card-header">
    Amenities
  </div>
<div class="card-body" id="allFilterDiv2">
<div class="arranddep" style="max-height:250px; overflow-y: auto;">
<?php 
							  						    
$rs=GetPageRecord('*','sys_hotelAmenities',' status=1 order by name asc'); 
while($rest=mysqli_fetch_array($rs)){ 

?>
 <label id="amt<?php echo stripslashes($rest['id']); ?>" style="display:none;"><input  type="checkbox" value="amt<?php echo stripslashes($rest['id']); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($rest['name']); ?></label> 
 <?php } ?>

</div> 
</div>


  <div class="card-header">
    Property Type
  </div>
<div class="card-body"  id="allFilterDiv3">
<div class="arranddep" style="max-height:250px; overflow-y: auto;">
<?php 
							  						    
$rs=GetPageRecord('*','sys_hotelType',' status=1 order by name asc'); 
while($rest=mysqli_fetch_array($rs)){ 

?>
 <label id="hoteltype<?php echo str_replace(' ','-',$rest['name']); ?>" style="display:none;"><input  type="checkbox" value="hoteltype<?php echo str_replace(' ','-',$rest['name']); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($rest['name']); ?></label> 
 <?php } ?>

</div> 
</div>

 
</div>

 

 

 
</div>


<div class="col-9 cardresult">
 


<div id="flightresult" class="listouter">
<div class="sortingouter" style="display:none;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture();"><strong>Sort By:</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture();">Departure <i class="fa fa-arrow-down" id="departurefa" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration();">Duration <i class="fa fa-arrow-down" id="durationfa" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival();">Arrival <i class="fa fa-arrow-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-arrow-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>



                           <input name="pricefilterid" type="hidden" id="pricefilterid" value="0">



                        </td> 

                      </tr>



                    </tbody></table>
</div>





 <?php 
 $date1 = new DateTime($checkInDate);
			$date2 = new DateTime($checkOutDate); 
			$numberOfNights= $date2->diff($date1)->format("%a");
			if($numberOfNights==0){ $numberOfNights=1; }
 
 $minprice=0;
 	//echo "<pre>";
	//print_r($json_arr['HotelSearchResult']);
 
			  $n=1;
			   $destination = explode(',',$_GET['citydestination']);
		  $citydestination = $destination[0];
		  
		   
		  
		  $values = $hotelData->searchResult->his;
		  foreach($values as $hotelList){
		  
		  $count++;
		
		 $hotelCost=calculatehotelcost(encode($agentid),stripslashes($hotelList->name),$hotelList->pops{0}->tpc,'0');
		 
		 
		 		if($hotelCost[2]<$minprice || $minprice==0){
			 $minprice=$hotelCost[2];
			}
			
			if($hotelCost[2]>$maxprice){
			 $maxprice=$hotelCost[2];
			}
			  ?>
			  
			  
			  <script>
 	 
			 $('#<?php echo $hotelList->rt; ?>star').show();
			 $('#hoteltype<?php echo str_replace(' ','-','Hotel'); ?>').show();
			 </script>

<div class="card hotelsearchlist" data-price="<?php echo $hotelCost[2]; ?>" data-category="<?php echo $hotelList->rt; ?>star amt3 amt10 amt14 amt7 amt19 hoteltype<?php echo str_replace(' ','-','Hotel'); ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="left" valign="top"><div class="imgboxhotel">
	<div class="httype">Hotel</div>
	<img src="<?php echo $hotelList->img{0}->tns; ?>" onerror="this.onerror=null;this.src='images/nohotelimage.png';" data-src="<?php echo $hotelList->img{0}->tns; ?>" ></div></td>
    <td align="left" valign="top" style="padding-right:20px; border-right:1px solid #f1f1f1;">
<div class="card-body">

 <div class="htname"><?php echo $hotelList->name; ?> <span class="starcatht"><?php $i=1;while($i<=$hotelList->rt) { ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php $i++; } ?></span></div>
						   
						   
						   <div class="htaddress"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($hotelList->ad->adr); ?></div>
						   
						   <div class="htamnt">
						   
						   <?php
$amn=1;
$categories = '';
$cats = explode(",", '24 hour front desk,AC,Bathroom,Breakfast,Breakfast Buffet,Internet Access');
foreach($cats as $cat) { 
if($amn<10){  

$abs=GetPageRecord('amenitiesIcon','sys_hotelAmenities',' name="'.$cat.'"'); 
$resticon=mysqli_fetch_array($abs); 

$cat = trim($cat);?>
<div class="tbl"><?php echo $resticon['amenitiesIcon']; ?> <?php echo $cat; ?></div>

<?php } $amn++; } ?>
						   

						   
						   
						   </div>
						   
						   

</div>
</td>
    <td width="20%" align="right" valign="bottom">
	<div class="card-body" style="padding:20px;">
	<div style="margin-bottom:10px;"> </div>
	<div class="htprice">&#8377;<?php echo $hotelCost[2]; ?></div>
	<div class="htpriceperperson">Start From</div>
		<form name="hotelform" id="hotelform<?php echo $count; ?>" method="post"  action="<?php echo $fullurl; ?>hotel-view2" target="_blank">
		  <input type="hidden" name="action" value="hotelchoosepost" />
		   <input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($hotelBasicJson); ?>" />
		   <input type="hidden" name="hotelJsonData" id="hotelJsonData<?php echo $count; ?>" value="<?php echo htmlentities(json_encode($hotelList,true)); ?>" >
		   <input type="hidden" name="countrynamedesti" value="<?php echo $_REQUEST['citydestination']; ?>" /> 
		  <input type="hidden" name="nights" value="<?php echo $numberOfNights; ?>" /> 
		   <input type="hidden" name="ad" value="<?php echo $adultCount; ?>" /> 
		   <input type="hidden" name="cd" value="<?php echo $childCount; ?>" /> 
		   <input type="hidden" name="empcount" value="<?php echo $_REQUEST['empcount']; ?>" /> 
		    
		 
	  <button type="button" class="btn btn-danger" style="width:100%;" onClick="$('#hotelform<?php echo $count; ?>').submit();">View Room</button>
	  </form>
	 
	
	</div>
	</td>
  </tr>
</table>


 



</div>

	  <?php $n++; } ?>














<?php   
		  	$count = 0;   
			$print=explode(',', $citydestination);  
			$HotelSearchArr = json_decode($hotelBasicJson);  
			
			$date1 = new DateTime($checkInDate);
			$date2 = new DateTime($checkOutDate); 
			$numberOfNights= $date2->diff($date1)->format("%a");
			if($numberOfNights==0){ $numberOfNights=1; }
			 
			$a=GetPageRecord('*','hotelMaster',' agentId in(0,'.$agentid.') and hotelPhoto!="" and cityName="'.trim($print[0]).'" order by id desc'); 
			while($rest=mysqli_fetch_array($a)){
			$count++;
			 
			$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'" and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
			$hotelPrice=mysqli_fetch_array($rs); 
		 
			
			$baseFare=0;
			$adultCost=0;
			$childCost=0;
			if($adultCount>0){
			$adultCost=($hotelPrice['adultCost']*$adultCount);
			}
			if($childCount>0){
			$childCost=($hotelPrice['childCost']*$childCount);
			}  
			    $baseFare=((($adultCost+$childCost)*trim($_REQUEST['empcount']))*$numberOfNights); 
			$hotelCost=calculatehotelcost(encode($agentid),stripslashes($rest['name']),$baseFare,'0');
			
			if($hotelCost[2]<$minprice || $minprice==0){
			$minprice=$hotelCost[2];
			}
			
			if($hotelCost[2]>$maxprice){
			$maxprice=$hotelCost[2];
			}
			?> 
			
			
			
			 <script>
<?php 

$categories = '';
$allamt='';
$cats = explode(",", $rest['hotelAmenities']);
foreach($cats as $cat) { 

$abs=GetPageRecord('id','sys_hotelAmenities',' name="'.$cat.'"'); 
$resticon=mysqli_fetch_array($abs); 

$cat = trim($cat);
$allamt.='amt'.$resticon['id'].' '; ?>

$('#amt<?php echo $resticon['id']; ?>').show();
 <?php } ?>
			 
			 $('#<?php echo $rest['category']; ?>star').show();
			 $('#hoteltype<?php echo str_replace(' ','-',$rest['hotelType']); ?>').show();
			 </script>
			<div class="card hotelsearchlist" data-price="<?php echo $hotelCost[2]; ?>" data-category="<?php echo $rest['category']; ?>star <?php echo $allamt; ?> hoteltype<?php echo str_replace(' ','-',$rest['hotelType']); ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" align="left" valign="top"><div class="imgboxhotel">
	<div class="httype"><?php echo $rest['hotelType']; ?></div>
	<img src="<?php  echo $imgurl.$rest['hotelPhoto'];  ?>" onerror="this.onerror=null;this.src='images/nohotelimage.png';" data-src="<?php  echo $imgurl.$rest['hotelPhoto'];  ?>" ></div></td>
    <td align="left" valign="top" style="padding-right:20px; border-right:1px solid #f1f1f1;">
<div class="card-body">

 <div class="htname"><?php echo stripslashes($rest['name']); ?> <span class="starcatht"><?php for($i=1; $i<=$rest['category']; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?></span></div>
						   
						   
						   <div class="htaddress"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $rest['address']; ?>, <?php echo $rest['cityName']; ?> </div>
						   
						   <div class="htamnt">
<?php
$amn=1;
$categories = '';
$cats = explode(",", $rest['hotelAmenities']);
foreach($cats as $cat) { 
if($amn<10){  

$abs=GetPageRecord('amenitiesIcon','sys_hotelAmenities',' name="'.$cat.'"'); 
$resticon=mysqli_fetch_array($abs); 

$cat = trim($cat);?>
<div class="tbl"><?php echo $resticon['amenitiesIcon']; ?> <?php echo $cat; ?></div>

<?php } $amn++; } ?>
						   
						   
						   </div>
						   
						   

</div>
</td>
    <td width="20%" align="right" valign="bottom">
	<div class="card-body" style="padding:20px;">
	<div class="htprice">&#8377;<?php  echo $hotelCost[2]; $allprice.=$hotelCost[2].','; ?></div>
	<div class="htpriceperperson">Start From</div>
		<form name="hotelform" id="hotelform<?php echo $count; ?>" method="get"  action="<?php echo $fullurl; ?>hotel-view" target="_blank">
		  <input type="hidden" name="action" value="hotelmanual" />
		  <input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($hotelBasicJson); ?>" />
		   <input type="hidden" name="hotelSearchId" value="<?php echo encode($rest['id']); ?>" /> 
		   <input type="hidden" name="checkInDate" value="<?php echo $checkInDate; ?>" /> 
		   <input type="hidden" name="empcount" value="<?php echo $_REQUEST['empcount']; ?>" /> 
		   <input type="hidden" name="checkOutDate" value="<?php echo $checkOutDate; ?>" /> 
		   <input type="hidden" name="nights" value="<?php echo $numberOfNights; ?>" /> 
		   <input type="hidden" name="ad" value="<?php echo $adultCount; ?>" /> 
		   <input type="hidden" name="cd" value="<?php echo $childCount; ?>" /> 
		   <input type="hidden" name="countrynamedesti" value="<?php echo $_REQUEST['citydestination']; ?>" />
	  <button type="submit" class="btn btn-danger" style="width:100%;">View Room</button>
	  </form>
	<div class="cancellationtbht"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $rest['cancellationType']; ?></div>
	
	</div>
	</td>
  </tr>
</table>


 



</div>
			<?php $count++; $n++; }	 ?>

  

</div>
 
 
 
 

 
 
 

 

</div>








<div style=" margin:20px 0px 40px; display:none; width:100%; min-height:400px;" id="nohotel"> 
<div style="text-align:center; font-size:30px;">
No Hotel Found
</div>

<div class="sections">
<div class="container" >
<h2 style="text-align:center; font-size:22px;">Book Hotels at Popular Destinations</h2>

<div class="row offerboxes"> 

<?php
$a=GetPageRecord('*','hotelMaster',' status=1 and cityName in (select name from cityMaster) group by cityName order by rand() limit 0,6');
while($spdeals=mysqli_fetch_array($a)){ 

$ab=GetPageRecord('*','cityMaster','name="'.$spdeals['cityName'].'"'); 
$destinationimage=mysqli_fetch_array($ab);

$bb=GetPageRecord('*','hotelDestinationMaster','name like "'.$destinationimage['name'].'%"  order by name asc limit 0,1'); 
$destiname=mysqli_fetch_array($bb);
?>
<div class="col-lg-2 d-flex align-items-stretch" style="cursor:pointer;" >
<a href="hotel-search?Submit=SEARCH&citydestination=<?php echo  ($destiname['name']); ?>,<?php echo  ($destiname['countryName']); ?>&destinationHotel=8543%2C106&checkInDate=<?php echo trim($checkInDate); ?>&checkOutDate=<?php echo trim($checkOutDate); ?>&travellers=1+Room+-+1+Guest&noadults1=1&nochilds1=0&age11=0&age21=0&empcount=1&totalpax=1&starcategory=3%2C+4+Star&category%5B%5D=3&category%5B%5D=4&action=flightpostaction&changesearch=0">
<div class="card" style="overflow: hidden; border-radius: 10px;">
<div class="offerphotobox">
 <img src="<?php echo $imgurl; ?><?php echo $destinationimage['thumbImage']; ?>">
</div>
<div class="card-body" style="text-align:center;">
<?php echo stripslashes($spdeals['cityName']); ?>
</div>
</div>
</a>
</div> 
<?php } ?>

</div>


</div>
</div>


</div>



 
<script>

 

  
function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}
 
 

$(document).ready(function () {
    $("#dt1").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#dt2');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            //difference in days. 86400 seconds in day, 1000 ms in second
            var dateDiff = (dt2Date - minDate)/(86400 * 1000);

            //dt2 not set or dt1 date is greater than dt2 date
            if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', minDate);
            }
            //dt1 date is 30 days under dt2 date
            else if (dateDiff > 30){
                    dt2.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#dt2').datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,onSelect: function () { 
        }
    });
	
});
 
 
  
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



function combinecheckbox(){
var combinecheck ='';
var output = jQuery.map($(':checkbox[name=category\\[\\]]:checked'), function (n, i) {
    combinecheck = combinecheck+n.value+',';
}).join(',');

$('#starcategory').val(rtrim(combinecheck)+' Star');
}

function rtrim(str){
    return str.replace(/\s+$/, '');
}


  
gettotalpax();





	$(function() {

					var maxprice = Number($('#maxprice').val()); 

					var minprice = Number($('#minprice').val());

						$( "#slider-ranges" ).slider({
						  range: true,
						  min: minprice,
						  max: maxprice,
						  values: [ minprice, maxprice ],
						  slide: function( event, ui ) {
							$( "#amountfilter" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
							
							showProducts(ui.values[ 0 ], ui.values[ 1 ]);
						  }
						});
						$( "#amountfilter" ).val( "" + $( "#slider-ranges" ).slider( "values", 0 ) +
						  " - " + $( "#slider-ranges" ).slider( "values", 1 ) );
						  
					});

					function showProducts(minPrice, maxPrice) {
					  $(".hotelsearchlist").hide().filter(function() {
						var price = parseInt($(this).data("price"), 10);
						return price >= minPrice && price <= maxPrice;
					  }).show();
					}
					
					
					
					
					
					


var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');
$filterCheckboxes.on('change', function() {
  var selectedFilters = {};
  $filterCheckboxes.filter(':checked').each(function() {
    if (!selectedFilters.hasOwnProperty(this.name)) {

      selectedFilters[this.name] = [];

    }
    selectedFilters[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});











 var $filterCheckboxes2 = $('#allFilterDiv2 input[type="checkbox"]');
$filterCheckboxes2.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes2.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters2, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});







 var $filterCheckboxes3 = $('#allFilterDiv3 input[type="checkbox"]');
$filterCheckboxes3.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes3.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters2, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});

		
		
		
function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('#flightresult'); 
$('#pricefa').show();$wrap.find('.hotelsearchlist').sort(function(a, b) 
{if(pricefilterid==1){$('#pricefilterid').val('0'); 
$('#pricefa').removeClass('fa-caret-down');
$('#pricefa').addClass('fa-caret-up');return + a.getAttribute('data-price') - 
+b.getAttribute('data-price'); 
}else{$('#pricefilterid').val('1'); 
$('#pricefa').removeClass('fa-caret-up');
$('#pricefa').addClass('fa-caret-down');return + b.getAttribute('data-price') - 
+a.getAttribute('data-price');
}})
.appendTo($wrap); 
}
 getSortedPrice();	
 getSortedPrice();	
 <?php if($n>1){ ?>
 $('.totalhotel').text('<?php echo $n; ?>');
 <?php }   ?>
 
 
 
</script>


<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">