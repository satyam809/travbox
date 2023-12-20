<?php

if($_POST['action']=="hotelchoosepost"){
$hotelArr = json_decode($_POST['hotelJsonData']);

$jsonPost = '{
	"id": "'.$hotelArr->id.'"
}';

$url = "https://apitest.tripjack.com/hms/v1/hotelDetail-search"; // URL To Hit
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$hotelArr = json_decode($result);
$hotelDetail = $hotelArr->hotel;
//print_r($hotelDetail);
}

?>
<link href="light-carousel.css" rel="stylesheet" type="text/css">
<style>
.ami .box{float:left; padding:2px 5px; color:#666666; font-size:12px;}
.ami{overflow:hidden;}
	
 .btn-outline-primary-custom {
padding: 3px 10px !important;
    min-height: 34px;
    max-width: 130px;
    margin: auto;
    margin-right: 0px;
}

</style>

<?php

if($_POST['action']=="hotelchoosepost"){
$hotelArr = json_decode($_POST['hotelJsonData']);

$jsonPost = '{
	"id": "'.$hotelArr->id.'"
}';

$url = "https://apitest.tripjack.com/hms/v1/hotelDetail-search"; // URL To Hit
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$hotelArr = json_decode($result);
$hotelDetail = $hotelArr->hotel;
//print_r($hotelDetail);
}

?>

<style>
.ami .box{float:left; padding:2px 5px; color:#666666; font-size:12px;}
.ami{overflow:hidden;}
	
 .btn-outline-primary-custom {
padding: 3px 10px !important;
    min-height: 34px;
    max-width: 130px;
    margin: auto;
    margin-right: 0px;
}

</style>

<main id="content">
            <div class="container">
			             <div class="row">
						<div class="col-lg-6 col-xl-6">
						   <div class="card">
						   <div class="card-body">  
						   <div class="sample1">
    <div class="carousel" style="height: 369px !important;">
      <ul>
	    <?php foreach ($hotelDetail->img as $value) { ?>
        <li> <img src="<?php  echo $value->tns; ?>"  > </li>
		<?php } ?>
      </ul>
      <div class="controls">
        <div class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
        <div class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
      </div>
    </div>
    <div class="thumbnails">
      <ul>
	   <?php foreach ($hotelDetail->img as $value) { ?>
        <li> <img src="<?php  echo $value->tns; ?>" > </li> 
		<?php } ?>
      </ul>
    </div>
  </div>
  
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="jquery.light-carousel.js"></script> 
  <script>
$('.sample1').lightCarousel();
</script> 
<style>
.current .caption, .current .caption span { 
    display: none !important;
}


.prev .fa{font-size: 22px; color: #fff; background-color: #000; padding: 6px; border-radius: 3px;}
.next .fa{font-size: 22px; color: #fff; background-color: #000; padding: 6px; border-radius: 3px;}
.prev:before { display:none;}
.next:before { display:none;}

.thumbnails li {
    width: 18%; 
}
.carousel img{ 
    max-height: 370px !important; min-height: 370px !important;
}
.carousel li { 
    max-height: 370px !important; min-height: 370px !important;
}
.thumbnails li { 
    max-height: 90px !important;min-height: 90px !important;
}
.thumbnails li img{    max-height:80px !important;min-height:80px !important;} 
</style>						  

						   </div>
						   </div> 
						   </div>
						
						
						   <div class="col-lg-6 col-xl-6">
						   <div class="card">
						   <div class="card-body"> 
						   <div class="green-lighter" style="margin-bottom:8px;">	  
							 
							 <span class="badge badge-dark text-white rounded-xs font-size-13 py-1 p-xl-2"><?=$hotelDetail->pt;?></span>
							    <?php for($sc=1; $sc<=$hotelDetail->rt; $sc++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?></div>
						   
						   <span class="font-weight-bold font-size-22"><?=$hotelDetail->name;?></span> 
						    <div class="haddress" style="margin-bottom:0px;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?=$hotelDetail->ad->adr;?>, <?=$hotelDetail->ad->city->name;?></div>
						   
						   </div>
						   </div> 
						   
						   
						    <div class="card">
						   <div class="card-body"> 
						   <div class="font-weight-bold font-size-17">Hotel Description</div> 
						   <div  style=" height:278px; overflow:auto;"><?=$hotelDetail->des;?></div>
						
						   </div>
						   </div>
						   
						   
						   </div>
						   
						   
						   
						   
						   
						 </div>
			
			<div class="row">
						<div class="col-lg-12 col-xl-12">
						   <div class="card">
						   <div class="card-body">  
						          <h5 id="scroll-amenities" class="font-size-21 font-weight-bold text-dark mb-1">
                                Amenities
                            </h5>
                            <ul class="list-group list-group-borderless list-group-horizontal list-group-flush no-gutters row">
                                     <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Wifi</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Wake-up call</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Bathrobes</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Fitness center</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Telephone</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Dry cleaning</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Mini bar</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Hair dryer</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> High chair</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Restaurant</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Air Conditioning</li>
                                <li class="col-md-3 list-group-item"><i class="fa fa-check" aria-hidden="true"></i> Slippers</li>
                            </ul>
							
						   </div>
						   </div>
						   </div>
						   </div>
			
			  <div class="row">
			  <div class="col-lg-12 col-xl-12">
						   <div class="card">
						   <div class="card-body"> 
						     <h5 id="scroll-amenities" class="font-size-21 font-weight-bold text-dark mb-2">
                                Room & Rates 
                            </h5>
						   <div style="margin-bottom:4px;">
						   	<?php 
	$roomCount = 1;
	foreach($hotelDetail->ops as $roomList){
	$roomData = $roomList->ris{0};
	$roomCount++;
	?>
		<form name="hotelform" id="hotelform<?php echo $roomCount; ?>" method="post" action="display.html?ga=hotelbooking">
	<input type="hidden" name="action" value="roompostaction" />
	<input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($_POST['HotelSearchDetails']); ?>" />
	<input type="hidden" name="hotelJsonData" value="<?php echo htmlentities($_POST['hotelJsonData']); ?>" >
	<input type="hidden" name="RoomDetails" value="<?php echo htmlentities(json_encode($roomList,true)); ?>" />
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
 
	<tr style="border-bottom:1px solid #ddd;">
	<td width="25%" style="padding-bottom:10px; padding-top:10px;"><div style=" width:350px; font-size:14px; font-weight:500;"><?=$roomData->rt?></div></td>
	<td width="25%" style="padding-bottom:10px; padding-top:10px;"><div style="font-size:12px; padding-left:50px;"><i class="fa fa-check" aria-hidden="true"></i> <?=$roomData->mb?></div></td>
	<td  width="10%"  style="padding-bottom:10px; padding-top:10px; font-size:18px; font-weight:500;">&#8377;<?= round($roomData->tp); ?> &nbsp;<i class="fa fa-info-circle" aria-hidden="true" style="color:#b5b5b5;"></i></td>
	<td align="right"style="padding-bottom:10px; padding-top:10px;"><div style="background-color: #333333; color: #fff; display: inline-block; padding: 4px 8px; border-radius: 4px;"><i class="fa fa-file-text-o" aria-hidden="true" onclick="loadpop('Cancellation Policy',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=cancellationPolicy&hotelid=<?php echo $hotelDetail->id; ?>&roomid=<?php echo $roomList->id; ?>"></i></div></td>
	<td style="padding-bottom:10px; padding-top:10px; text-align:right;"><button type="submit" class="btn btn-outline-primary border-radius-3 border-width-2 px-4 font-weight-bold min-width-200 py-2 text-lh-lg">Book Now</button></td>
	</tr> 
</table>
	
	</form>
 
			<?php } ?>			   
						   </div>
						   

						   
						   </div>
						   </div>
						   </div>
			  </div>
			
                 
 
            </div>
 

