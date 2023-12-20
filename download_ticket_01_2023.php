<?php 
include "inc.php"; 

if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($a); 

$detailArray = json_decode(stripslashes(unserialize($editresult['detailArray'])));

$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
} 

 if($editresult['bookingType'] == 0)
 {
	$rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(seatPrice) as totalseatPrice, SUM(agentCommision) as totalagentCommision, SUM(agentBaseFare) as totalagentBaseFare, SUM(agentFixedMakup) as totalagentFixedMakup, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice, SUM(agentTax) as totaltax','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'"  '); 
}
else
{

	$rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(seatPrice) as totalseatPrice, SUM(agentCommision) as totalagentCommision, SUM(agentBaseFare) as totalagentBaseFare, SUM(agentFixedMakup) as totalagentFixedMakup, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice, SUM(tax) as totaltax','flightBookingMaster','  id="'.decode($_REQUEST['id']).'"   '); 
}
$totalcostings=mysqli_fetch_array($rto);


$reslt=GetPageRecord('SUM(cancellationCharges) as totalamendmentcharges','ticketCancelRequest',' flightBookingId="'.$editresult['id'].'"  '); 
$amendmentcharges=mysqli_fetch_array($reslt);

// print_r($totalcostings);die;
?>

<div id="DivIdToPrint" style="max-width: 890px; margin: auto; background-color:#F8F8F8;">
<div style="width:100%; background-color:#FFFFFF;">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page { margin: 0; }
.multiflightbox{padding:10px; border:1px solid #000; margin-left:0px; margin-right:0px; margin-bottom:10px;}
</style>
 


<table width="100%" border="1" cellpadding="20" cellspacing="0" bordercolor="#CCCCCC">
   
	<tr>
		<td colspan="3" style="border-bottom:1px solid #ddd;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">  
				<tr>
					<td style="font-size:20px; font-weight:500;">
						<img src="<?php echo $imgurl; ?><?php echo !empty($agentData['companyLogo']) ? $agentData['companyLogo'] : "travbox_logo.webp" ; ?>" height="55">	
					</td>
					<td width="50%" align="right">
						<?php if($_REQUEST['ta']!=3){ ?>
						<strong style="font-size:18px;"><?php echo stripslashes($agentData['companyName']); ?></strong><br>
						<strong> </strong> <?php echo stripslashes($agentData['phone']); ?><br>
						<strong> </strong> <?php echo stripslashes($agentData['email']); ?><br />
						</strong> <?php echo stripslashes($agentData['address']); ?><?php } ?> 
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000">
				<tr>
					<td colspan="2" align="left" valign="center" style="border-right:1px solid #000;">
			
						Booking Status: <strong> <?php if($editresult['status']==1 || $editresult['status']==0){ ?>
						Pending
						<?php } ?>
						
				<?php
				 $currentYear = date("y"); // Get the last two digits of the current year
				 $nextYear = $currentYear + 1; // Calculate the next year
				 $year_range = "$currentYear-$nextYear";


				$rescancel=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$_REQUEST['psid'].'"'); 

				$canceldata=mysqli_fetch_array($rescancel);
				if($canceldata['status'] == 3){
				echo "Cancellation Request";
				}elseif($canceldata['status'] == 5){
				echo "Cancelled";
				}else{
				if($editresult['status']==2){
				echo "Confirmed";
				} 
				if($editresult['status']==3){ 
				echo "Cancelled";
				} 
				}
				?></strong>  <br />

Booking Id: <strong><?php echo 'TB/'.$year_range.'/F/'.encode($editresult['id']); ?></strong>  <br />
          Booking Type: <strong><?php if($editresult['refundyes']==1){ echo 'Refundable'; } else { echo 'Non-Refundable'; } ?></strong>  <br />
          Booking Time: <?php echo date('D, j M Y', strtotime($editresult['bookingDate'])); ?></td>
				<td width="50%" align="center" valign="center">
					<table width="100%" border="0" cellpadding="10" cellspacing="0">
					<?php 
					$flightway=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'"  order by id asc '); 
					while($flightwayres=mysqli_fetch_array($flightway)){
					 if($flightwayres['bookingType']==0 && !empty($flightwayres['detailArray'])){

					$data=(array) unserialize(stripslashes($flightwayres['detailArray']));
					$index=0;
					for($i=1; $i <= count($data['sI']); $i++){
					?>
						  <tr>
								<td colspan="2" align="center"><img src="<?php echo $imgurl.getflightlogo(stripslashes($data['sI'][ $index]['fD']['aI']['name'])); ?>" height="45"></td>
								<td colspan="2" align="center"><?php echo $data['sI'][$index]['fD']['aI']['name']; ?></td>

								<td width="50%" align="center">
									<div style="font-size:18px; color:#000; text-transform:uppercase;"><?php echo $editresult['pnrNo']; ?></div>
									<div style="font-size:11px; color:#666666; text-transform:uppercase;">Airline PNR</div>
								</td>
						  </tr>
					  <?php  $index++; } 
					  			} else { ?>
									<tr>
										<td colspan="2" align="center"><img src="<?php echo $imgurl.getflightlogo(stripslashes($flightwayres['flightName'])); ?>" height="45"></td>
										<td colspan="2" align="center"><?php echo stripslashes($flightwayres['flightName']); ?></td>
										<td width="50%" align="center">
										<div style="font-size:18px; color:#000; text-transform:uppercase;"><?php echo $flightwayres['pnrNo']; ?></div>
										<div style="font-size:11px; color:#666666; text-transform:uppercase;">Airline PNR</div></td>
									</tr>
							<?php } 
						} ?>
			
					</table>
				</td>

				
			</tr>
		  
		</table>
	
	
	
	<?php if($editresult['searchArrey']!='' && $editresult['flightStop']>0){ ?>
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Flight Details</div>
	<?php if($editresult['apiType']=='kafila' && $editresult['searchArrey']!=''){

	foreach((array) unserialize(stripslashes($editresult['detailArray'])) as $layoverFlight){

	if($layoverFlight->FLIGHT_NAME!=''){
	?>
	<div class="row multiflightbox">
		<div class="col-3">
		 <table border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td colspan="2" style="padding-right:10px;"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
			<td>
			<div class="flightname"><?php echo $layoverFlight->FLIGHT_NAME; ?> </div>
			<div class="flightnumber"><?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?></div>
			
			</td>
		  </tr>
		</table>

		</div>

		<div class="col-9">
		 <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="33%" align="center">
					<div class="coltime">
					<?php echo $layoverFlight->DEP_TIME; ?></div>
					<div class="graysmalltext">
					<?php echo $layoverFlight->ORG_NAME; ?></div>
				</td>
				<td width="33%" align="center"><div class="nostops"><?php echo $layoverFlight->DURATION; ?></div> </td>
				<td width="33%" align="center"><div class="coltime">
					<?php echo $layoverFlight->ARRV_TIME; ?></div>
					<div class="graysmalltext">
					<?php echo $layoverFlight->DES_NAME; ?></div>
				</td>
			  </tr>
		</table>

		</div>

	<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
	  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
	<?php } ?>
	</div>
	  <?php  $j++; } }
	  	  
	  
	  } ?>
	  
	   <?php  if($editresult['apiType']=='tbo' && $editresult['searchArrey']!=''){ 
		
		$segmentsDataArr=(array) unserialize(stripslashes($editresult['searchArrey']));
		
		$numberOfStop=count($segmentsDataArr['Segments'][0]);
		if(count($numberOfStop)>0)
		{
		
			foreach($segmentsDataArr['Segments'][0] as $segmentsDataArrValue)
			{
			
			
		?>
		
		<div class="row multiflightbox">
			<div class="col-3">
				 <table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td colspan="2" style="padding-right:10px;"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
						<td>
							<div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
							<div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
						
						</td>
					  </tr>
				</table>

			</div>

			<div class="col-9">
			 <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="33%" align="center">
				<div class="coltime">
				<?php echo date('d-m-Y H:i A',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?></div>
				<div class="graysmalltext">
				<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?></div>
				</td>
				<td width="33%" align="center"><div class="nostops"><?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?></div> </td>
				<td width="33%" align="center"><div class="coltime">
				<?php echo date('d-m-Y H:i A',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
				<div class="graysmalltext">
				<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?></div></td>
			  </tr>
			</table>

			</div>

<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>
			
		<?php
		
		$j++; }
		}
	
	  } ?>
	
	
		 <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
		  <tr>
			<td width="50%" bgcolor="#E9E9E9">Baggage / Cabin</td>
			<td width="50%" bgcolor="#E9E9E9">Class</td>
		  </tr>
		  <tr>
			<td width="50%" align="left" valign="top"><?php echo $editresult['totalBaggage']; ?></td>
			<td width="50%" align="left" valign="top"><strong><?php echo $editresult['fareClass']; ?></strong></td>
		  </tr>
		</table>
	
	<?php } else { 
     $idex=0;
     $flight_heading="Flight Departure Details";
     $flight_heading2="Flight Return Details";
     $flightway=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'"  order by id asc '); 
       while($flightwayres=mysqli_fetch_array($flightway)){ ?>
         <div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;"><strong><?php if($idex == 0){ echo $flight_heading; }else{ echo $flight_heading2; }?></strong></div>

       <?php $data=(array) unserialize(stripslashes($flightwayres['detailArray']));
        $index=0;
        for($i=1; $i <= count($data['sI']); $i++){
          $departureDateArr = explode('T', $data['sI'][$index]['dt']);

          $depdate = $departureDateArr[0];
          $deptime = $departureDateArr[1];
          
          $arrDateArr = explode('T',$data['sI'][$index]['at']);

          $arrtime = $arrDateArr[1];

          $arrDate = $arrDateArr[0];
          
          $journeytime = $data['sI'][$index]['duration'];

          $fdurhour = floor($journeytime / 60);

          $fdurmint = $journeytime % 60;

       ?>
		<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" style="margin-bottom:10px;">
			 <tr>
			   <td bgcolor="#E9E9E9">Flight</td>
			   <td bgcolor="#E9E9E9">FareType</td>
			   <td bgcolor="#E9E9E9">Class</td>
			   <td bgcolor="#E9E9E9">Type</td>
			   <td bgcolor="#E9E9E9">Departure</td>
			   <td bgcolor="#E9E9E9">Arrival</td>
			   <td bgcolor="#E9E9E9"> Duration </td>
			   
			 </tr>
			 <tr>
			   <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $data['sI'][$index]['fD']['aI']['code']; ?> -<?= $data['sI'][$index]['fD']['fN']; ?> </div>
				<?php echo $data['sI'][$index]['fD']['aI']['name']; ?></td>
				<td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;">  <?php echo $flightwayres['pcc']; ?></td>
				<td align="left" valign="top"><strong><?php echo $flightwayres['fareClass']; ?></strong></td>

				<td align="left" valign="top"><strong><?= $flightwayres['refundyes'] == 1 ? "Refundable" : "Non-Refundable"; ?></strong></td>

				   <td align="left" valign="top">
				<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($depdate)); ?>, <?php echo $deptime; ?></div>
				<?php echo $data['sI'][$index]['da']['city']; ?>,<?= $data['sI'][$index]['da']['terminal']; ?><br/><?= $data['sI'][$index]['da']['name']; ?></td>
				   <td align="left" valign="top">
				<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($arrDate)); ?>, <?php echo $arrtime; ?></div>
				<?php echo $data['sI'][$index]['aa']['city']; ?>,<?= $data['sI'][$index]['aa']['terminal']; ?><br/><?= $data['sI'][$index]['aa']['name']; ?></td>
				 <td align="left" valign="top"><?php echo $fdurhour . 'H , ' . $fdurmint . 'M'; ?></td>
			 </tr>
		</table>
     <?php $index++; } 
    
	  if($_REQUEST['psid'] != '' && $idex == 0){
          ?>
      <div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Traveller's Details for departure</div>
      
      <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="5%" align="center" bgcolor="#E9E9E9"><strong>Sr.</strong></td>
            <td bgcolor="#E9E9E9"><strong>Type</strong></td>
            <td colspan="2" bgcolor="#E9E9E9"><strong>Passenger&nbsp;Name</strong></td>
            <td colspan="2" bgcolor="#E9E9E9"><strong>Sector</strong></td>
            <td bgcolor="#E9E9E9"><strong>PNR & Ticket No</strong></td>
            <td bgcolor="#E9E9E9"><strong>Seat</strong></td>
            <td bgcolor="#E9E9E9"><strong>Meal</strong></td>
            <td bgcolor="#E9E9E9"><strong>Baggage<br/><span style="font-size: 10px;">Check-in | Cabin</span></strong></td>
          </tr>
        <?php 

        $ns=1;
        $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and id="'.$_REQUEST['psid'].'" and firstName!="" '); 
        while($paxData=mysqli_fetch_array($rs6)){

          $rs8=GetPageRecord('*','flightBookingMaster',' id="'.$paxData['BookingId'].'" '); 
          $bookingdata=mysqli_fetch_array($rs8);
          //echo '<pre>';
          $bookingdetail=(array) unserialize(stripslashes($bookingdata['detailArray']));
          $totalPriceListarr = count($bookingdetail['totalPriceList']);
          for($i =0; $i <= $totalPriceListarr; $i++){
          $fareIdentifier=$bookingdetail['totalPriceList'][$i]['fareIdentifier'];
        
          $pcc=$bookingdata['pcc'];
          if($fareIdentifier == $pcc){
            $paxtype=strtoupper($paxData['paxType']);

          $basic_fare=round((float)$bookingdetail['totalPriceList'][$i]['fd'][$paxtype]['fC']['BF']);
          $tax_Fare=round((float)$bookingdetail['totalPriceList'][$i]['fd'][$paxtype]['fC']['TAF']);
          }
          }
    //$rs5=GetPageRecord('SUM(seatAdultPrice) as totalseatPrice2','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'"  '); 
    //$totalcostings2=mysqli_fetch_array($rs5);
          //print_r($totalcostings2['totalseatPrice2']);die;
          $ind_baggage = $paxData["baggage"];
          $ind_baggage_price = explode(',',$ind_baggage)[1];
          $ind_extra_baggage_price = explode('INR',$ind_baggage_price)[1];
          $ind_seat_price= $paxData['seatAdultPrice'];
        ?>
          <tr>
            <td width="5%" align="center"><?php echo $ns; ?></td>
            <td><?php echo ucfirst($paxData['paxType']); ?></td>
            <td colspan="2" style="text-transform:uppercase;"><strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong></td>
            <td colspan="2" style="text-transform:uppercase;">
            <?php $data=(array) unserialize(stripslashes($bookingdata['detailArray']));
            $index=0;
            for($i=1; $i <= count($data['sI']); $i++){   
            echo $data['sI'][$index]['da']['code']; ?>-<?php echo $data['sI'][$index]['aa']['code']; ?><br/>
            <?php $index++; } ?>     
            </td>
            <td><?php echo $editresult['pnrNo']; ?> <?php if($paxData['ticketNo']!=''){ echo '<br/>'; ?><?php echo $paxData['ticketNo']; } ?></td>
            <td><?php 
				$seatNo=explode(',',$paxData['seatAdultCode']);
				$flightCode=explode(',',$paxData['flightCode']);
				$key=0;
				for($i=1; $i <= count($flightCode); $i++){
					if(!empty($flightCode[$key])){
						echo '('.$flightCode[$key]. ')' .$seatNo[$key]. '<br/>';
					}
					$key++;
				}
            ?></td>
            <td><?php  $meal=explode(",",stripslashes($paxData['meal'])); echo $meal[0].', '.$meal[1];
            $mealprice=(float)explode('INR',$meal[1])[1];
          
            ?></td>
            <td><?php  $baggages=explode(',',stripslashes($paxData['baggage'])); 
            $data=(array) unserialize(stripslashes($bookingdata['detailArray']));

              $ib=$data['totalPriceList'][0]['fd'][strtoupper($paxData['paxType'])]['bI']['iB'];
              $cb=$data['totalPriceList'][0]['fd'][strtoupper($paxData['paxType'])]['bI']['cB'];

             
              if(!empty($ib)){
                echo $ib.' | '.$cb.'<br/>';
              }

              echo $paxData['baggage'];
             ?></td>
          </tr>
        <?php $ns++; } ?>
        </table>
      <?php } 
        elseif($_REQUEST['psidret'] != '' && $idex == 1){
          ?>
        <div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Traveller's Details for return</div>
        
        <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
            <tr>
              <td width="5%" align="center" bgcolor="#E9E9E9"><strong>Sr.</strong></td>
              <td bgcolor="#E9E9E9"><strong>Type</strong></td>
              <td colspan="2" bgcolor="#E9E9E9"><strong>Passenger&nbsp;Name</strong></td>
              <td colspan="2" bgcolor="#E9E9E9"><strong>Sector</strong></td>
              <td bgcolor="#E9E9E9"><strong>PNR & Ticket No</strong></td>
              <td bgcolor="#E9E9E9"><strong>Seat</strong></td>
              <td bgcolor="#E9E9E9"><strong>Meal</strong></td>
              <td bgcolor="#E9E9E9"><strong>Baggage<br/><span style="font-size: 10px;">Check-in | Cabin</span></strong></td>
            </tr>
          <?php 
        
          $ns2=1;
          $rs7=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$_REQUEST['psidret'].'" and firstName!="" '); 
          while($paxData2=mysqli_fetch_array($rs7)){
            $id2=$paxData2['BookingId'];
            $rs9=GetPageRecord('*','flightBookingMaster',' id="'.$paxData2['BookingId'].'" '); 
          $bookingdata2=mysqli_fetch_array($rs9);
          //echo '<pre>';
          $bookingdetail2=(array) unserialize(stripslashes($bookingdata2['detailArray']));
          $totalPriceListarr2 = count($bookingdetail2['totalPriceList']);
          for($j =0; $j <= $totalPriceListarr2; $j++){
          $fareIdentifier2=$bookingdetail2['totalPriceList'][$j]['fareIdentifier'];
        
          $pcc2=$bookingdata2['pcc'];
          if($fareIdentifier2 == $pcc2){
            $paxtype2=strtoupper($paxData2['paxType']);

          $basic_fare2=round((float)$bookingdetail2['totalPriceList'][$j]['fd'][$paxtype2]['fC']['BF']);
          $tax_Fare2=round((float)$bookingdetail2['totalPriceList'][$j]['fd'][$paxtype2]['fC']['TAF']);
          }
          }
            $ind_baggage2 = $paxData2["baggage"];
            $ind_baggage_price2 = explode(',',$ind_baggage2)[1];
            $ind_extra_baggage_price2 = explode('INR',$ind_baggage_price2)[1];
            $ind_seat_price2= $paxData2['seatAdultPrice'];
          ?>
            <tr>
              <td width="5%" align="center"><?php echo $ns2; ?></td>
              <td><?php echo ucfirst($paxData2['paxType']); ?></td>
              <td colspan="2" style="text-transform:uppercase;"><strong><?php echo $paxData2['title']; ?>&nbsp;<?php echo $paxData2['firstName']; ?>&nbsp;<?php echo $paxData2['lastName']; ?></strong></td>
              <td colspan="2" style="text-transform:uppercase;">
				<?php $data=(array) unserialize(stripslashes($bookingdata2['detailArray']));
				$index=0;
				for($i=1; $i <= count($data['sI']); $i++){   
				echo $data['sI'][$index]['da']['code']; ?>-<?php echo $data['sI'][$index]['aa']['code']; ?><br/>
				<?php $index++; } ?>     
				</td>
				  <td><?php echo $editresult['pnrNo']; ?> <?php if($paxData2['ticketNo']!=''){ echo '<br/>'; ?><?php echo $paxData2['ticketNo']; } ?></td>
				  <td><?php      
				  $seatNo=explode(',',$paxData2['seatAdultCode']);
				$flightCode=explode(',',$paxData2['flightCode']);
				$key=0;
				for($i=1; $i <= count($flightCode); $i++){
				  if(!empty($flightCode[$key])){
				echo '('.$flightCode[$key]. ')' .$seatNo[$key]. '<br/>';
				  }
				  $key++;
				} 
				?></td>
              <td><?php  $meal2=explode(",",stripslashes($paxData2['meal'])); echo $meal2[0].', '.$meal2[1];
				$mealprice2= (float)explode('INR',$meal2[1])[1];
				  ?></td>
				  <td><?php  $baggages=explode(',',stripslashes($paxData2['baggage']));
					$data=(array) unserialize(stripslashes($bookingdata2['detailArray']));
					$ib=$data['totalPriceList'][0]['fd'][strtoupper($paxData2['paxType'])]['bI']['iB'];
					$cb=$data['totalPriceList'][0]['fd'][strtoupper($paxData2['paxType'])]['bI']['cB'];
				  if(!empty($ib)){
					echo $ib.' | '.$cb.'<br/>';
				  }

				 echo $paxData2['baggage']; 

				?>
				</td>
            </tr>
          <?php $ns2++; } ?>
          </table>
        <?php

        }
      
     else{
          //  $idx=0;
           $heading="Traveller's Details for departure";
           $heading2="Traveller's Details for return";
          
           ?>
           <div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;"><strong><?php if($idex == 0){ echo $heading; }else{ echo $heading2; }?></strong></div>
     
       <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" style="margin-bottom: 10px;">
           <tr>
             <td width="5%" align="center" bgcolor="#E9E9E9"><strong>Sr.</strong></td>
             <td bgcolor="#E9E9E9"><strong>Type</strong></td>
             <td colspan="2" bgcolor="#E9E9E9"><strong>Passenger&nbsp;Name</strong></td>
             <td colspan="2" width="12%" bgcolor="#E9E9E9"><strong>Sector</strong></td>
             <td bgcolor="#E9E9E9"><strong>PNR & Ticket No</strong></td>
             <td width="12%" bgcolor="#E9E9E9"><strong>Seat</strong></td>
             <td bgcolor="#E9E9E9"><strong>Meal</strong></td>
             <td bgcolor="#E9E9E9"><strong>Baggage<br/></strong><span style="font-size: 10px;">Check-in | Cabin</span></td>
           </tr>
         <?php 
         $ns=1;
         $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$flightwayres['id'].'" and firstName!="" '); 
         while($paxData=mysqli_fetch_array($rs6)){
         ?>
           <tr>
             <td width="5%" align="center"><?php echo $ns; ?></td>
             <td><?php echo ucfirst($paxData['paxType']); ?></td>
             <td colspan="2" style="text-transform:uppercase;"><strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong></td>
           
             <td colspan="2" style="text-transform:uppercase;">
             <?php $data=(array) unserialize(stripslashes($flightwayres['detailArray']));
             $index=0;
             for($i=1; $i <= count($data['sI']); $i++){   
             echo $data['sI'][$index]['da']['code']; ?>-<?php echo $data['sI'][$index]['aa']['code']; ?><br/>
             <?php $index++; } ?>     
             </td>
             <td><?php if($paxData['status']==5){ echo '<span style="color: red; font-weight: 600;">Cancelled</span>';}else{ echo $editresult['pnrNo']; ?> <?php if($paxData['ticketNo']!=''){ echo '<br/>'; ?><?php echo $paxData['ticketNo']; }} ?></td>
     
             <td><?php 
             
              $seatNo=explode(',',$paxData['seatAdultCode']);
              $flightCode=explode(',',$paxData['flightCode']);
             //  print_r($seatNo);
             //  die;
              $key=0;
              for($i=1; $i <= count($flightCode); $i++){
               if(!empty($flightCode[$key])){
              echo '('.$flightCode[$key]. ')' .$seatNo[$key]. '<br/>';
               }
               $key++;
              }
     
              ?></td>
     
             <td><?php  $meal=explode(",",stripslashes($paxData['meal'])); echo $meal[0].', '.$meal[1];
             ?></td>
             <td><?php  $baggages=explode(',',stripslashes($paxData['baggage']));
               $data=(array) unserialize(stripslashes($flightwayres['detailArray']));
              //  echo '<pre>';
              //  print_r($data);
              //  die;
               $ib=$data['totalPriceList'][0]['fd'][strtoupper($paxData['paxType'])]['bI']['iB'];
               $cb=$data['totalPriceList'][0]['fd'][strtoupper($paxData['paxType'])]['bI']['cB'];
              
                if(!empty($ib)){ 
                  echo $ib.' | ' .$cb.'<br/>';
                }
             echo $paxData['baggage'];
             ?></td>
           </tr>
         <?php $ns++; } ?>
         </table>
	   <?php //$idx++; }
	   }

     $idex++; } ?>
     
     
     <?php
    }
  
  ?>
	<?php  if($_REQUEST['ta']!=2){ ?>
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Fare Details </div>
	<?php  if($_REQUEST['psid']!=''){?>
    <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
			<td width="25%"><strong>Basic Fare</strong></td>
			<td colspan="2">Rs.<?php
			 // $totalcost =  round($totalcostings['totalagentBaseFare']);
			 // $totalcost =  round($totalcostings['totalagentBaseFare']/$_REQUEST['tp']+$totalcostings['totalagentFixedMakup']/$_REQUEST['tp']);
			$totalcost =  round($basic_fare+$basic_fare2);

			 echo number_format($totalcost);
			?>
			</td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php 
	   // $tex =  round((($totalcostings['totaltax']/$_REQUEST['tp'])+$totalcostings['totalagentMarkup']/$_REQUEST['tp'])+($_REQUEST['markup']));
			$tex =  round($tax_Fare+$tax_Fare2);
			   echo number_format($tex);  
			  ?>
	  </td>

      </tr>
		 <?php if($ind_seat_price > 0 || $ind_seat_price2 > 0){ ?> 
		 <tr>
			<td><strong>Seat Charges </strong></td>
			<td colspan="2">Rs.<?php echo number_format($ind_seat_price+$ind_seat_price2); ?></td>
		  </tr>
		<?php } ?>
	     <?php if($mealprice > 0 || $mealprice2 > 0){ ?> 
		  <tr>
			<td><strong>Meal Charges </strong></td>
			<td colspan="2">Rs.<?php 
			echo number_format($mealprice+$mealprice2);
			/*echo number_format($totalcostings['totalmealPrice']);*/ ?></td>
		  </tr>
			<?php } ?>
				<?php if($ind_extra_baggage_price > 0 || $ind_extra_baggage_price2 > 0){ ?> 
		  <tr>
			<td><strong>Extra Baggage Charges </strong></td>
			<td colspan="2">Rs.<?php 
			
			echo number_format($ind_extra_baggage_price+$ind_extra_baggage_price2);
			/*echo number_format($totalcostings['totalextraBaggagePrice']);*/ ?></td>
		  </tr>
			  <?php } ?>
		  <tr>
			<td width="25%"><strong>Total Fare </strong></td>
			<td colspan="2">Rs.<?php 
			echo number_format(round($totalcost+$tex+$ind_extra_baggage_price+$mealprice+$mealprice2+$ind_seat_price+$ind_seat_price2+$ind_extra_baggage_price2));
			// echo number_format(round(round(($totalcostings['totalagentTotalFare']
			// +number_format($ind_extra_baggage_price)
			// +$totalcostings['totalagentFixedMakup'])/$_REQUEST['tp'])+($_REQUEST['markup'])));
			
				// echo number_format((($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup'])+
				// $totalcostings['totaltax']+$totalcostings['totalagentMarkup']+($_REQUEST['markup']) +
				// ($totalcostings['totalseatPrice'])+ ($totalcostings['totalmealPrice'])+
				// (number_format($ind_extra_baggage_price))
				// ))
			?>
			 
			</td>
		  </tr>
    </table>
	<?php } else { ?>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="25%"><strong>Basic Fare</strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup']); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totaltax']+$totalcostings['totalagentMarkup']+($_REQUEST['markup'])); ?></td>
      </tr>
     <?php if($totalcostings['totalseatPrice'] > 0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalseatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($totalcostings['totalmealPrice'] > 0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalmealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($totalcostings['totalextraBaggagePrice'] > 0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalextraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php 
          echo number_format($totalcostings['totalagentTotalFare']+$totalcostings['totalagentFixedMakup']+($_REQUEST['markup']+$totalcostings['totalmealPrice']+$totalcostings['totalseatPrice']+$totalcostings['totalextraBaggagePrice']));            // echo number_format((($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup'])+
            // $totalcostings['totaltax']+$totalcostings['totalagentMarkup']+($_REQUEST['markup']) +
            // ($totalcostings['totalseatPrice'])+ ($totalcostings['totalmealPrice'])+
            // ($totalcostings['totalextraBaggagePrice'])
            // ))
        ?></td>
        </tr>
        <?php if(!empty($amendmentcharges['totalamendmentcharges'])){ ?>
        <tr>
             <td width="25%"><strong>Amendment Fees </strong></td>
        <td colspan="2">Rs.<?php 
        echo number_format($amendmentcharges['totalamendmentcharges']);
        ?></td>
       
      </tr>
      <?php } ?>
    </table>
	
	<?php } ?>
	
	
	<?php } ?>
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Important Information</div>
	1). For departure terminal please check with the airline first.<br />
2). You must download & register on the Aarogya Setu App and carry a valid ID.<br />
3). It is mandatory to wear a mask and carry other protective gear.<br />
4). Use the Airline PNR for all Correspondence directly with the Airline.<br />
5). You must web check-in on the airline website and obtain a boarding pass.<br />
6). Date & Time is calculated based on the local time of the city/destination.<br />
7). For rescheduling/cancellation within 4 hours of the departure time contact the airline directly.<br />
8). Your ability to travel is at the sole discretion of the airport authorities and we shall not be held responsible.<br />
9). Reach the terminal at least 2 hours prior to the departure for domestic flight and 4 hours prior to the departure
of international flight	</td>
  </tr>
</table>
</div>
</div>

<?php if($_REQUEST['mail']!=1){ ?>
<?php if($_REQUEST['sm']==''){ ?>
<div style="text-align: right; width: 100%; overflow:hidden; margin-top:20px;">

<button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();' style="float:right;">Print / Download</button>

</div>
<?php } ?>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint'); 
  var newWin=window.open('','Print-Window'); 
  newWin.document.open(); 
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>'); 
  newWin.document.close(); 

}
</script>
<?php } ?>