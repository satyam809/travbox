<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
session_start();
include './tripjackAPI/APIConstants.php';

include './tripjackAPI/RestApiCaller.php';
$ResultIndex=$_GET['ResultIndex'];
$ResultIndex2=$_GET['ResultIndex2'];

include_once 'tripjackAPI/SeatMap.php';
?>
<script>
		let seatMapResult2=$('.seatMapResult2').attr('data-req2');
				if(seatMapResult2 == 0){
					alert('Seat Map Is Not Avilable');
					$('.pay_btn').click();

				}

var select_passenger_inx2=0;
var seatdetils2=[];
var seatprice2=[];
var flightinfo2=[];
var seatpostion2=[];

	function seatSSrInfo2(id){

		var seat_selected_arr2=[];
		var seat_selected_amtarr2=[];
		var seat_selected_noarr2=[];
		var flight_id2=[];
		var seatpos2=[];
		var segmentkey2=[];

		let seat_selected2=1;
	$(document).on('click','.seat_empty2'+id,function(){
			let pasengers2 =$(this).attr('data-count2');
			
		if(pasengers2 == 1 ){
				event.target.src="assets/images/seat_selected.png";
				event.target.classList.add("seat_selected2"+id);
				event.target.classList.remove("seat_empty2"+id);
				seat_selected_amtarr2.push(event.target.dataset['seatamt2']);
				seat_selected_noarr2.push(event.target.dataset['seatno2']);
				seatpos2.push(event.target.dataset['seatpos2']);
				flight_id2.push(event.target.dataset['skey2']);
				segmentkey2.push(event.target.dataset['segment2']);
				$('#SeatPriceInn2').val(parseFloat($('#SeatPriceInn2').val())+parseFloat(event.target.dataset['seatamt2']));

				$('.seat_selected2'+id).each(function(idx,el){ 

				el.src="assets/images/seat_empty.png";

				el.classList.remove("seat_selected2"+id);
				el.classList.add("seat_empty2"+id);
				// seatno2 =event.target.dataset['seatno2'];
				// seatpos2[0]=event.target.dataset['seatpos2'];
				seat_selected_amtarr2.pop(el.dataset['seatamt2']);
				seat_selected_noarr2.pop(el.dataset['seatno2']);
				seatpos2.pop(el.dataset['seatpos2']);
				flight_id2.pop(el.dataset['skey2']);
				segmentkey2.pop(el.dataset['segment2']);
				$('#SeatPriceInn2').val(parseFloat($('#SeatPriceInn2').val())-parseFloat(el.dataset['seatamt2']));

				});
				event.target.classList.add("seat_selected2"+id);
				event.target.classList.remove("seat_empty2"+id);
			// seatpos[0]=event.target.dataset['seatpos'];
			seat_selected_amtarr2.push(event.target.dataset['seatamt2']);
			seat_selected_noarr2.push(event.target.dataset['seatno2']);
			seatpos2.push(event.target.dataset['seatpos2']);
			flight_id2.push(event.target.dataset['skey2']);
			segmentkey2.push(event.target.dataset['segment2']);

			$('#SeatPriceInn2').val(parseFloat($('#SeatPriceInn2').val())+parseFloat(event.target.dataset['seatamt2']));
			event.target.src="assets/images/seat_selected.png";
	
		}
		else {
			if(seat_selected2 <= pasengers2){
			seat_selected_arr2.push(this);
			seat_selected_noarr2.push(event.target.dataset['seatno2']);
			seatpos2.push(event.target.dataset['seatpos2']);
			seat_selected_amtarr2.push(parseFloat(event.target.dataset['seatamt2']));
			flight_id2.push(event.target.dataset['skey2']);
			segmentkey2.push(event.target.dataset['segment2']);
			event.target.classList.add('seat_selected2'+id);
			event.target.classList.remove('seat_empty2'+id);
			event.target.src="assets/images/seat_selected.png";

			$('#SeatPriceInn2').val(parseFloat($('#SeatPriceInn2').val())+parseFloat(event.target.dataset['seatamt2']));
			//console.log(parseFloat($('#SeatPriceInn2').val())+parseFloat(event.target.dataset['seatamt2']));
			// let id =$('.select_passengers2').val();
				if(seat_selected2 >= pasengers2){
						select_passenger_inx2=pasengers2.length-1;
						
					}else{
						select_passenger_inx2++;
					}
					$('.select_passengers2').val(select_passenger_inx2);
					seat_selected2++;
			}
			else {
			seat_selected_arr2[select_passenger_inx2].src="assets/images/seat_empty.png";
			seat_selected_arr2[select_passenger_inx2].classList.add('seat_empty2'+id);
			seat_selected_arr2[select_passenger_inx2].classList.remove('seat_selected2'+id);
			seat_selected_arr2[select_passenger_inx2]=event.target;
			event.target.src="assets/images/seat_selected.png";
			event.target.classList.add("seat_selected2"+id);
			let cal_seat_amt2 = (parseFloat($('#SeatPriceInn2').val())- seat_selected_amtarr2[select_passenger_inx2])+parseFloat(event.target.dataset['seatamt2']);
			$('#SeatPriceInn2').val(cal_seat_amt2);
			seat_selected_amtarr2[select_passenger_inx2]=parseFloat(event.target.dataset['seatamt2']);
			seat_selected_noarr2[select_passenger_inx2]=event.target.dataset['seatno2'];
			//console.log(seat_selected_noarr2);
			seatpos2[select_passenger_inx2]=event.target.dataset['seatpos2'];
			flight_id2[select_passenger_inx2]=event.target.dataset['skey2'];
			segmentkey2[select_passenger_inx2]=event.target.dataset['segment2'];
			}
		}

		$('#SeatNoInn2'+id).val(seat_selected_noarr2);
		$('#segmentKey2'+id).val(flight_id2);
		$('#SeatPricearr2'+id).val(seat_selected_amtarr2);
		$('#segmentid2'+id).val(segmentkey2);
		
		//$('.seatamount2').text(seatno2 + '-' + seat_postion2 + '- ₹' + seatamt2)
		
		 allCalCulatedPrice();
		 seatfare2();
			
		})
	$(document).on('click','.seat_selected2'+id,function(){
			let pasengers2 =$(this).attr('data-count2');
			if(pasengers2 == 1){
				this.src="assets/images/seat_empty.png";
				this.classList.remove('seat_selected2'+id);
				this.classList.add('seat_empty2'+id);
				seat_selected_amtarr2.pop(this.dataset['seatamt2']);
        		seat_selected_noarr2.pop(this.dataset['seatno2']);
				flight_id2.pop(this.dataset['skey2']);
				seatpos2.pop(this.dataset['seatpos2']);
        	let calseatamt2 = (parseFloat($('#SeatPriceInn2').val())- this.dataset['seatamt2']);
				$('#SeatPriceInn').val(calseatamt2);
			}else{

				if(this == seat_selected_arr2[select_passenger_inx2]){
					seat_selected_arr2[select_passenger_inx2].src="assets/images/seat_empty.png";
				seat_selected_arr2[select_passenger_inx2]=this;
				this.classList.remove('seat_selected2'+id);
				this.classList.add('seat_empty2'+id);
				seat_selected_amtarr2[select_passenger_inx2]='';
				seat_selected_noarr2[select_passenger_inx2]='';
				seatpos2[select_passenger_inx2]='';
				flight_id2[select_passenger_inx2]='';
				let cal_seat_amt2 = (parseFloat($('#SeatPriceInn2').val())- this.dataset['seatamt2']);
				$('#SeatPriceInn2').val(cal_seat_amt2);
				seat_selected2-2;
				
				}else{
					alert('Seat is already occupied');
				}
			
			}
			
			 seatfare2();
			$('#SeatNoInn2'+id).val(seatSelectedAr2(seat_selected_noarr2,select_passenger_inx2));
			$('#SeatPricearr2'+id).val(seatSelectedAr2(seat_selected_amtarr2,select_passenger_inx2));
			$('#segmentKey2'+id).val(flight_id2);
			$('#segmentid2'+id).val(segmentkey2);
		
		//$('.seatamount').text(seat_selected_noarr + '-' + seatpos + '- ₹' + seat_selected_amtarr)
		
		 allCalCulatedPrice();
			if(seat_selected_noarr2 == ''){
				 $('.seat_fare2').hide();
			}
			$('#segmentKey2').val(flight_id2);
		});

		$('.select_passengers').on('change', function(){
			select_passenger_inx2=$(this).val();

		});

		seatdetils2.push(seat_selected_noarr2);
		seatprice2.push(seat_selected_amtarr2);
		flightinfo2.push(flight_id2);
		seatpostion2.push(seatpos2);
}
function seatSelectedAr2(seat_selected_noarr2,select_passenger_inx2){
	let seatnumb2=[];
	
		for(let i=0; i<=seat_selected_noarr2.length; i++){
			if(seat_selected_noarr2[i] != ''){
				seatnumb2.push(seat_selected_noarr2[i]);
			}
		}
	return seatnumb2;
 }
 function seatSelectedAr2(seat_selected_amtarr2,select_passenger_inx2){
	let seatAmt2=[];
	
		for(let i=0; i<=seat_selected_amtarr2.length; i++){
			if(seat_selected_amtarr2[i] != ''){
				seatAmt2.push(seat_selected_amtarr2[i]);
			}
		}
	return seatAmt2;
 }
 function seatfare2(){

let seatsno2='';
let seatposition2='';
let seatamount2='';
let output2='';
let count2=0;
for(i=1; i <= seatdetils2.length; i++){
  if(seatdetils2[i] === 'undefined')
    continue;
    for(j=0; j <= seatdetils2[count2].length-1; j++){
		seatsno2 = seatdetils2[count2][j];
		seatposition2 = seatpostion2[count2][j];
		seatamount2 = seatprice2[count2][j];
		flightcode2 = flightinfo2[count2][j];
			
		if(seatsno2 != '' || seatposition2 != ''){
		output2 += '(' + flightcode2 + ')' +  seatsno2 + '-' + seatposition2 + '- ₹' + seatamount2 + '<br>'
		}
	}
count2++;
}
//console.log(output);
 if(seatdetils2 != ''){
$('.seat_fare2').show();
$('.return_fare').show();
$('.seatamount2').html(output2);
 }else{
	$('.seat_fare2').hide();
$('.return_fare').hide(); 
 }

}
</script>
<?php

$reviewSSRResult=$_SESSION['reviewSSRResult'];
$s2 = 0;
if (count($reviewSSRResult['tripInfos']['1']['sI']) > 0) {

  foreach ($reviewSSRResult['tripInfos']['1']['sI'] as $flightSegmentResults) {
	
	$review_id = $_SESSION['fistSegmentKey'];
	$Sid2=$reviewSSRResult['tripInfos'][1]['sI'][$s2]['id'];
	$depcity2 = $flightSegmentResults['da']['code'];
	$arrcity2 = $flightSegmentResults['aa']['code'];

	if(!empty($seatMapResult['tripSeatMap']['tripSeat'][$Sid2]['sData'])){
	
?>

 <div class="seatMapResult seatdetailscontent2<?php echo $_REQUEST['id']; ?> " id="seatMapResponse2<?= $reviewSSRResult['tripInfos']['1']['sI'][$s2]['id']; ?>" style="display: none" data-req="<?= !empty($seatMapResult['tripSeatMap'])? 1 : 0 ?>">
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
				
				
				//  $reviewSSRResult=$_SESSION['reviewSSRResult'];
            	// $review_id = $_SESSION['fistSegmentKey2'];//$reviewSSRResult['tripInfos'][0]['sI'][0]['id'];
				if(!empty($seatMapResult['tripSeatMap'])){
                $seatData = $seatMapResult['tripSeatMap']['tripSeat'][$Sid2];
				
				$adult=$_SESSION['ADT'];
				$child=$_SESSION['CHD'];
				$infant=$_SESSION['INF'];
				$total_passenger=$adult+$child;
                  $count = 0;
                  $rowCounter = 1;
				  $exitloop2=false;
                  for($i =1; $i <= $seatData['sData']['row']; $i++ )
                  {
						if($exitloop2)
							break;
                    for($j = 1; $j <= 7; $j++)
                    {
						if($seatData['sInfo'][$count]['seatNo'] == '')
						{
							$exitloop2=true;
							break;
						 }
					$seat_no= $seatData['sInfo'][$count]['seatNo'];
					$seat_postion= preg_split('/(?<=[0-9])(?=[a-z]+)/i',$seat_no);
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
									$seat_postion2='Window Seat';
								  break;
								case "B":
									$seat_postion2="Middel Seat";
								  break;
								case "C":
									$seat_postion2="Aisle Seat";
								  break;
								  case "D":
									$seat_postion2="Aisle Seat";
								  break;
								  case "E":
									$seat_postion2='Middel Seat';
								  break;
								  case "F":
									$seat_postion2='Window Seat';
								  break;
								default:
								$seat_postion2='No postion';
								  }
						   if($seatData['sInfo'][$count]['amount'] != ''){
							$seat_amount2 = $seatData['sInfo'][$count]['amount'];
						   }else{
							$seat_amount2 = 0;
						   }
                      ?> 
                        <div class="seat seat_map" title="<?= $seatData['sInfo'][$count]['isBooked'] == '1' ? 'Seat Already Booked' : $seatData['sInfo'][$count]['seatNo'] . ' - amount: ' . $seat_amount2  ?>">
							 <?php
							 echo $seatData['sInfo'][$count]['isBooked'] == '1' ? '<img src="assets/images/seat_booked.png" style="width: inherit; height: inherit">' : '<img data-count2="'.$total_passenger.'" data-segment2="'.$reviewSSRResult['tripInfos']['1']['sI'][$s2]['id'].'"  data-skey2="'.$depcity2.'-'.$arrcity2.'" data-indx="'.$count.'"  data-seatpos2="'.$seat_postion2.'" data-seatno2="'.$seatData['sInfo'][$count]['seatNo'].'" data-seatamt2="'.$seat_amount2.'" src="assets/images/seat_empty.png" style="width: inherit; height: inherit" class="seat_empty2'.$s2.'">';
							 
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
				}else{
					echo '</br>';
					$errmsg="Seat Map Is Not Avilable.";
					echo $errmsg;
				}
                ?>
				</div>
		<?php
			}else{
				?>
		 <div class="seatMapResult seatdetailscontent2<?php echo $_REQUEST['id']; ?> " id="seatMapResponse2<?= $reviewSSRResult['tripInfos']['1']['sI'][$s2]['id']; ?>" style="display: none" data-req="<?= !empty($seatMapResult['tripSeatMap'])? 1 : 0 ?>">

				<?= $seatMapResult['tripSeatMap']['tripSeat'][$Sid2]['nt'];	?>
			</div>
			<?php } ?>
<script>
	seatSSrInfo2(<?= $s2; ?>);
	
</script>
		<?php	$s2++;
		}
	  } ?>
					
