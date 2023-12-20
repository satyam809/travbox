<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
//include "inc.php";
//include "config/logincheck.php";
session_start();
include './tripjackAPI/APIConstants.php';

include './tripjackAPI/RestApiCaller.php';
$ResultIndex=$_GET['ResultIndex'];
include_once 'tripjackAPI/SeatMap.php';

?>

 <div class="row seatMapResult" data-req="<?= !empty($seatMapResult['tripSeatMap'])? 1 : 0 ?>">
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
			
			   
				
				$reviewSSRResult=$_SESSION['reviewSSRResult'];
				
                 $review_id = $_SESSION['fistSegmentKey'];//$reviewSSRResult['tripInfos'][0]['sI'][0]['id'];
				 if(!empty($seatMapResult['tripSeatMap'])){
					try{
                  $seatData = $seatMapResult['tripSeatMap']['tripSeat'][$review_id];
				// $seatData = $seatMapResult['tripSeatMap']['tripSeat'];
				// $reviewSSRResult['tripInfos'][0]['sI'][0]['id'];
				// print_r($reviewSSRResult);
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
							 echo $seatData['sInfo'][$count]['isBooked'] == '1' ? '<img src="assets/images/seat_booked.png" style="width: inherit; height: inherit">' : '<img data-count="'.$total_passenger.'"  data-seatpos="'.$seat_postion.'" data-seatno="'.$seatData['sInfo'][$count]['seatNo'].'" data-seatamt="'.$seat_amount.'" src="assets/images/seat_empty.png" style="width: inherit; height: inherit" class="seat_empty">';
							 
							?>
						</div>
						
                        <?php
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
			
                ?>
					
<script>
	let seatMapResult=$('.seatMapResult').attr('data-req');
				if(seatMapResult == 0){
					alert('Seat Map Is Not Avilable');
					$('.pay_btn').click();

				}
	var seat_selected_arr=[];
	var seat_selected_amtarr=[];
	var seat_selected_noarr=[];
	var select_passenger_inx=0;
	var seatno='';
	var seatpos=[];
	let seat_selected=1;
	let seatamt1='';
	var seatpricevaluse = 0;
		$('.seat_empty').on('click',function(event){
			let pasengers =$(this).attr('data-count');
			

		if(pasengers == 1 ){
				event.target.src="assets/images/seat_selected.png";
				event.target.classList.add("seat_selected");
				seatamt1=event.target.dataset['seatamt'];
				seat_selected_amtarr[0]=event.target.dataset['seatamt'];
				seat_selected_noarr[0]=event.target.dataset['seatno'];
				$('#SeatPriceInn').val(event.target.dataset['seatamt']);
				$('.seat_selected').each(function(idx,el){ 
					
				seatno =event.target.dataset['seatno'];
				seatpos[0]=event.target.dataset['seatpos'];
				el.src="assets/images/seat_empty.png"
			
				});
				
			event.target.src="assets/images/seat_selected.png";
			seat_selected=1;
		}
		else {
			if(seat_selected <= pasengers){
			seat_selected_arr.push(this);
			seatamt1=event.target.dataset['seatamt'];
			seat_selected_noarr.push(event.target.dataset['seatno']);
			seatpos.push(event.target.dataset['seatpos']);
			seat_selected_amtarr.push(parseFloat(event.target.dataset['seatamt']));
			
			event.target.src="assets/images/seat_selected.png";
			$('#SeatPriceInn').val(parseFloat($('#SeatPriceInn').val())+parseFloat(event.target.dataset['seatamt']));
			//console.log(parseFloat($('#SeatPriceInn').val())+parseFloat(event.target.dataset['seatamt']));
			event.target.classList.add("seat_selected");
			event.target.classList.remove("seat_empty");
			let id =$('.select_passengers').val()
			//console.log(seat_selected_arr,seat_selected);
				seat_selected++;
			}
			else {
			if(seat_selected_arr[select_passenger_inx] === event.target)
			{
				console.log('unselecting...')
				this.src="assets/images/seat_empty.png";
				this.classList.remove('seat_selected');
				this.classList.add('seat_empty');
				seat_selected--;
			}
			seat_selected_arr[select_passenger_inx].src="assets/images/seat_empty.png";
			
			seat_selected_arr[select_passenger_inx].classList.toggle('seat_empty');
			seat_selected_arr[select_passenger_inx].classList.toggle('seat_selected');
			seat_selected_arr[select_passenger_inx]=event.target;
			event.target.src="assets/images/seat_selected.png";
			event.target.classList.add("seat_selected");
			event.target.classList.remove("seat_empty");
			let cal_seat_amt = (parseFloat($('#SeatPriceInn').val())- seat_selected_amtarr[select_passenger_inx])+parseFloat(event.target.dataset['seatamt']);
			$('#SeatPriceInn').val(cal_seat_amt);
			seat_selected_amtarr[select_passenger_inx]=parseFloat(event.target.dataset['seatamt']);
			seat_selected_noarr[select_passenger_inx]=event.target.dataset['seatno'];
			seatpos[select_passenger_inx]=event.target.dataset['seatpos'];
			}
		}

		$('#SeatNoInn').val(seat_selected_noarr)
		$('#SeatPricearr').val(seat_selected_amtarr)
		
		//$('.seatamount').text(seat_selected_noarr + '-' + seatpos + '- ₹' + seat_selected_amtarr)
		
		 allCalCulatedPrice();
		 seatfare();
		//  $(document).on('click','.seat_selected',function(){
		// 	this.src="assets/images/seat_empty.png";
		// 	let pasengers =$(this).attr('data-count');
		// 	if(pasengers == 1){
		// 		this.classList.toggle('seat_selected');
		// 		this.classList.toggle('seat_empty');
		// 	}else{
		// 		this.src="assets/images/seat_empty.png";
		// 		this.classList.remove('seat_selected');
		// 		this.classList.add('seat_empty');
		// 		seat_selected--;
		// 		console.log('seat');
		// 	}
		// });
		})
		
	

 $('.select_passengers').on('change', function(){
	select_passenger_inx=$(this).val();
 })

</script>