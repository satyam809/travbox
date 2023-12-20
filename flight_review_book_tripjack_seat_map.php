<?php
session_start();
include './tripjackAPI/APIConstants.php';

include './tripjackAPI/RestApiCaller.php';
$ResultIndex=$_GET['ResultIndex'];
include_once 'tripjackAPI/SeatMap.php';
?>
<script>
	let seatmapResult=$('.seatMapResult').attr('data-req');
				if(seatmapResult == 0){
					alert('Seat Map Is Not Avilable');
				}
	
	var seat_selected_amtarr=[];
	var flight_id=[];
	var seatpos=[];
	var select_passenger_inx=0;
	var seat_selected_noarr=[];
	

		function seatSSrInfo(id){
		var seat_selected_arr=[];
		var seatdetils=[];
		var seatprice=[];
		var flightinfo=[];
		var segmentkey=[];
		var seatpostion=[];


   	 	var seat_selected=1;
		

		$(document).on('click','.seat_empty'+id,function(event){

			let pasengers =$(this).attr('data-count');
			

		if(pasengers == 1 ){
			event.target.src="assets/images/seat_selected.png";
			event.target.classList.add("seat_selected"+id);
			event.target.classList.remove("seat_empty"+id);
			seatprice.push(event.target.dataset['seatamt']);
			seatdetils.push(event.target.dataset['seatno']);
			flightinfo.push(event.target.dataset['skey']);
			segmentkey.push(event.target.dataset['segment']);
			// console.log(event.target.dataset['skey']);
			seatpostion.push(event.target.dataset['seatpos']);
			$('#SeatPriceInn').val(parseFloat($('#SeatPriceInn').val())+parseFloat(event.target.dataset['seatamt']));
			

			$('.seat_selected'+id).each(function(idx,el){ 

			el.classList.remove("seat_selected"+id);
			el.classList.add("seat_empty"+id);
			seatprice.pop(el.dataset['seatamt']);
			seatdetils.pop(el.dataset['seatno']);
			seatpostion.pop(el.dataset['seatpos']);
			flightinfo.pop(el.dataset['skey']);
			segmentkey.pop(el.dataset['segment']);
			$('#SeatPriceInn').val(parseFloat($('#SeatPriceInn').val())-parseFloat(el.dataset['seatamt']));

			el.src="assets/images/seat_empty.png";

			});

			event.target.src="assets/images/seat_selected.png";
			event.target.classList.add("seat_selected"+id);
			event.target.classList.remove("seat_empty"+id);
			seatprice.push(event.target.dataset['seatamt']);
			seatdetils.push(event.target.dataset['seatno']);
			seatpostion.push(event.target.dataset['seatpos']);
			flightinfo.push(event.target.dataset['skey']);
			segmentkey.push(event.target.dataset['segment']);

			$('#SeatPriceInn').val(parseFloat($('#SeatPriceInn').val())+parseFloat(event.target.dataset['seatamt']));

			seat_selected=1;
		}
		else {
			if(seat_selected <= pasengers){
				// console.log('select' + seat_selected);

					seat_selected_arr.push(this);
					seatdetils.push(event.target.dataset['seatno']);
					seatpostion.push(event.target.dataset['seatpos']);
					seatprice.push(parseFloat(event.target.dataset['seatamt']));
					flightinfo.push(event.target.dataset['skey']);
					segmentkey.push(event.target.dataset['segment']);
					
					event.target.classList.add("seat_selected"+id);
					event.target.classList.remove("seat_empty"+id);
					event.target.src="assets/images/seat_selected.png";

					$('#SeatPriceInn').val(parseFloat($('#SeatPriceInn').val())+parseFloat(event.target.dataset['seatamt']));

					if(seat_selected >= pasengers){
						select_passenger_inx=pasengers.length-1;
						
					}else{
						select_passenger_inx++;
					}

					seat_selected++;
					
					// console.log(seat_selected);
				
			}
			else {
				// console.log(seat_selected);
				
				seat_selected_arr[select_passenger_inx].src="assets/images/seat_empty.png";
				seat_selected_arr[select_passenger_inx].classList.add('seat_empty'+id);
				seat_selected_arr[select_passenger_inx].classList.remove('seat_selected'+id);
				seat_selected_arr[select_passenger_inx]=event.target;
				event.target.src="assets/images/seat_selected.png";
				event.target.classList.add("seat_selected"+id);
				event.target.classList.remove("seat_empty"+id);
				let cal_seat_amt = (parseFloat($('#SeatPriceInn').val())- seatprice[select_passenger_inx])+parseFloat(event.target.dataset['seatamt']);
				$('#SeatPriceInn').val(cal_seat_amt);
				// console.log(cal_seat_amt);

				seatprice[select_passenger_inx]=parseFloat(event.target.dataset['seatamt']);
				seatdetils[select_passenger_inx]=event.target.dataset['seatno'];
				seatpostion[select_passenger_inx]=event.target.dataset['seatpos'];
				flightinfo[select_passenger_inx]=event.target.dataset['skey'];
				segmentkey[select_passenger_inx]=event.target.dataset['segment'];

			}
		}

		
		$('#SeatNoInn'+id).val(seatdetils);
		$('#segmentKey'+id).val(flightinfo);
		$('#SeatPricearr'+id).val(seatprice);
		$('#segmentid'+id).val(segmentkey);

		//$('.seatamount').text(seat_selected_noarr + '-' + seatpos + '- ₹' + seat_selected_amtarr)
		
		 allCalCulatedPrice();
		 seatfare();
	
			

		})
	
		$(document).on('click','.seat_selected'+id,function(){
			let pasengers =$(this).attr('data-count');
			if(pasengers == 1){
				this.src="assets/images/seat_empty.png";
				this.classList.remove('seat_selected'+id);
				this.classList.add('seat_empty'+id);
				seatprice.pop(this.dataset['seatamt']);
        		seatdetils.pop(this.dataset['seatno']);
				flightinfo.pop(this.dataset['skey']);
				segmentkey.pop(this.dataset['segment']);
				seatpostion.pop(this.dataset['seatpos']);
        	let calseatamt = (parseFloat($('#SeatPriceInn').val())- this.dataset['seatamt']);
				$('#SeatPriceInn').val(calseatamt);

			}else{
				// seat_selected=seat_selected-1;
				if(this == seat_selected_arr[select_passenger_inx]){
					seat_selected_arr[select_passenger_inx].src="assets/images/seat_empty.png";
				seat_selected_arr[select_passenger_inx]=this;
				this.classList.remove('seat_selected'+id);
				this.classList.add('seat_empty'+id);
				seatprice[select_passenger_inx]='';
				seatdetils[select_passenger_inx]='';
				seatpostion[select_passenger_inx]='';
				flightinfo[select_passenger_inx]='';
				segmentkey[select_passenger_inx]='';
				let cal_seat_amt = (parseFloat($('#SeatPriceInn').val())- this.dataset['seatamt']);
				$('#SeatPriceInn').val(cal_seat_amt);
				seat_selected-2;
				
				}else{
					alert('Seat is already occupied');
				}
			}
			
			 seatfare();
			$('#SeatNoInn'+id).val(seatSelectedAr(seatdetils,select_passenger_inx));
			$('#SeatPricearr'+id).val(seatSelectedAr(seatprice,select_passenger_inx));
			$('#segmentKey'+id).val(flightinfo);
			$('#segmentid'+id).val(segmentkey);
		
		//$('.seatamount').text(seat_selected_noarr + '-' + seatpos + '- ₹' + seat_selected_amtarr)
		
		 allCalCulatedPrice();
			if(seatdetils == ''){
				 $('.seat_fare').hide();
			}
			$('#segmentKey'+id).val(flightinfo);
		}); 

		$('.select_passengers').on('change', function(){
			select_passenger_inx=$(this).val();
		});
		// if(seatdetils != ''){
		seat_selected_noarr.push(seatdetils);
		seat_selected_amtarr.push(seatprice);
		flight_id.push(flightinfo);
		seatpos.push(seatpostion);


		// }
}
 function seatSelectedAr(seatdetils,select_passenger_inx){
	let seatnumb=[];
	
		for(let i=0; i<=seatdetils.length; i++){
			if(seatdetils[i] != ''){
				seatnumb.push(seatdetils[i]);
			}
		}
	return seatnumb;
 }
 function seatSelectedAr(seatprice,select_passenger_inx){
	let seatAmt=[];
	
		for(let i=0; i<=seatprice.length; i++){
			if(seatprice[i] != ''){
				seatAmt.push(seatprice[i]);
			}
		}
	return seatAmt;
 }

</script>	
<?php

$reviewSSRResult=$_SESSION['reviewSSRResult'];
$s = 0;
if (count($reviewSSRResult['tripInfos']['0']['sI']) > 0) {

  foreach ($reviewSSRResult['tripInfos']['0']['sI'] as $flightSegmentResults) {
	
	$review_id = $_SESSION['fistSegmentKey'];
	$Sid=$reviewSSRResult['tripInfos'][0]['sI'][$s]['id'];
	$depcity = $flightSegmentResults['da']['code'];
	$arrcity = $flightSegmentResults['aa']['code'];

	if(!empty($seatMapResult['tripSeatMap']['tripSeat'][$Sid]['sData'])){
	
?>

 <div class="seatMapResult seatdetailscontent<?php echo $_REQUEST['id']; ?> " id="seatMapResponse<?= $reviewSSRResult['tripInfos']['0']['sI'][$s]['id']; ?>" style="display: none" data-req="<?= !empty($seatMapResult['tripSeatMap'])? 1 : 0 ?>">
 <div class="row">
				<div class="col-5"  style="text-align: center">
				<div class="row">
				<div class="col-4">
					<h1>A</h1>
				</div>
				<div class="col-4">
					<h1>B</h1>
				</div>
				<div class="col-4">
					<h1>C</h1>
				</div>
				</div>
				</div>
				<div class="col-2">
				</div>
				<div class="col-5">
				<div class="row">
				<div class="col-4">
					<h1>D</h1>
				</div>
				<div class="col-4">
					<h1>E</h1>
				</div>
				<div class="col-4">
					<h1>F</h1>
				</div>
				</div>
				</div>
				</div>
                <?php 
		
				
				 if(!empty($seatMapResult['tripSeatMap'])){
					try{
                //   $seatData = $seatMapResult['tripSeatMap']['tripSeat'][$review_id];

			 $seatData = $seatMapResult['tripSeatMap']['tripSeat'][$Sid];
				// $reviewSSRResult['tripInfos'][0]['sI'][0]['id'];
				// print_r($seatData);
				// die;
				$adult=$_SESSION['ADT'];
				$child=$_SESSION['CHD'];
				$infant=$_SESSION['INF'];
				$total_passenger=$adult+$child;
                  $count = 0;
                  $rowCounter = 1;
						$exitloop=false;
                  for($i =1; $i <= $seatData['sData']['row']; $i++ )
                  {
						if($exitloop)
							break;
                    for($j = 1; $j <= 7; $j++)
                    {
						if($seatData['sInfo'][$count]['seatNo'] == '')
						{
							$exitloop=true;
							break;
						 }

						if($j == 4){
							?>
							<div class="seat_map">
							</div>
							<?php
							continue;
						}else{
							$seat_no= $seatData['sInfo'][$count]['seatNo'];
							$seat_postion= preg_split('/(?<=[0-9])(?=[a-z]+)/i',$seat_no);
						   switch ($seat_postion[1]) {
							case "A":
								$seat_postion='Window Seat';
							  break;
							case "B":
								$seat_postion="Middel Seat";
							  break;
							case "C":
								$seat_postion="Aisle Seat";
							  break;
							  case "D":
								$seat_postion="Aisle Seat";
							  break;
							  case "E":
								$seat_postion='Middel Seat';
							  break;
							  case "F":
								$seat_postion='Window Seat';
							  break;
							default:
							$seat_postion='No postion';
						  }
						   if($seatData['sInfo'][$count]['amount'] != ''){
							$seat_amount = $seatData['sInfo'][$count]['amount'];
						   }else{
							$seat_amount = 0;
						   }
                      ?> 
                        <div class="seat seat_map" title="<?= $seatData['sInfo'][$count]['isBooked'] == '1' ? 'Seat Already Booked' : $seatData['sInfo'][$count]['seatNo'] . ' - amount: ' . $seat_amount ?>">
							 <?php
							 echo $seatData['sInfo'][$count]['isBooked'] == '1' ? '<img src="assets/images/seat_booked.png" style="width: inherit; height: inherit">' : '<img data-count="'.$total_passenger.'" data-sKey="'.$depcity.'-'.$arrcity.'" data-segment="'.$reviewSSRResult['tripInfos']['0']['sI'][$s]['id'].'" data-indx="'.$count.'"  data-seatpos="'.$seat_postion.'" data-seatno="'.$seatData['sInfo'][$count]['seatNo'].'" data-seatamt="'.$seat_amount.'" src="assets/images/seat_empty.png" style="width: inherit; height: inherit" class="seat_empty'.$s.'">';
							 
							?>
						</div>
						
                        <?php
						// echo $count;
						}
                        $count++;
                    }
					echo '<br>';
                    $rowCounter++;
                  }
                  $rowCounter = 1;
				
				}catch(Exception $e){
					$result=false;
						echo $result;
		
					}
				}else{
					echo '</br>';
					$errmsg="Seat Map Is Not Avilable.";
					echo $errmsg;
				}
			// die;
			
        ?>
		</div>
		<?php
			}else{
				?>
				 <div class="seatMapResult seatdetailscontent<?php echo $_REQUEST['id']; ?> " id="seatMapResponse<?= $reviewSSRResult['tripInfos']['0']['sI'][$s]['id']; ?>" style="display: none" data-req="<?= !empty($seatMapResult['tripSeatMap'])? 1 : 0 ?>">

				<?= $seatMapResult['tripSeatMap']['tripSeat'][$Sid]['nt'];	?>
			</div>
			<?php } ?>
<script>
	seatSSrInfo(<?= $s; ?>);

</script>
		<?php	$s++;
		}
	  } ?>
					
