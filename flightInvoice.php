<?php 

include "inc.php";



$_SESSION['agentUserid']=$_REQUEST['ag'];

 



if($_REQUEST['id']!=''){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'"'); 

$rest=mysqli_fetch_array($a); 



if(!empty($rest['roundTripId'])){
  $rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(seatPrice) as totalseatPrice, SUM(agentCommision) as totalagentCommision, SUM(agentBaseFare) as totalagentBaseFare, SUM(agentFixedMakup) as totalagentFixedMakup, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice, SUM(tax) as totaltax','flightBookingMaster',' roundTripId="'.$rest['roundTripId'].'"  '); 
  }else{
    $rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(seatPrice) as totalseatPrice, SUM(agentCommision) as totalagentCommision, SUM(agentBaseFare) as totalagentBaseFare, SUM(agentFixedMakup) as totalagentFixedMakup, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice, SUM(tax) as totaltax','flightBookingMaster',' id="'.$rest['id'].'"  '); 
  }

$totalcostings=mysqli_fetch_array($rto);



if($rest['id']==''){

echo 'Something went wrong. Please try again.';

exit();

}



$b=GetPageRecord('*','sys_userMaster',' id in (select parentId from sys_userMaster where id="'.$rest['agentId'].'")  '); 

$adminData=mysqli_fetch_array($b); 





$urs=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 

$agentData=mysqli_fetch_array($urs); 

} 





?> 



<div style="margin:auto; padding:10px;" id="DivIdToPrint">

<style>

table { font-size:12px; color:#000000; }

</style>

<style>

@media print {

body{padding:0px;}

table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }

}



@page {

    size: auto;   /* auto is the initial value */

    margin: 0;  /* this affects the margin in the printer settings */

}

</style>

<table width="100%" border="0" cellpadding="5" style="font-size:12px; ">

  <tr>

    <td width="34%" align="left"><img src="<?php echo $imgurl; ?><?php echo !empty($adminData['companyLogo']) ? $adminData['companyLogo'] : "travbox_logo.webp"; ?>" style="width:200px; "></td>

    <td width="33%">&nbsp;</td>

    <td width="33%" align="right" valign="middle"><div style="font-size:24px; text-decoration:underline; font-weight:600">Invoice</div></td>

  </tr>

  <tr>

    <td width="34%" valign="top"><table width="100%" border="0" cellpadding="0">

      <tr>

        <td><strong><?php echo strtoupper($adminData['companyName']); ?></strong></td>

      </tr>

      <tr>

        <td><?php echo stripslashes($adminData['address']); ?></td>

      </tr>

      <tr>

        <td>Tel: <?php echo stripslashes($adminData['phone']); ?> </td>

      </tr>

      <tr>

        <td>Email: <?php echo stripslashes($adminData['email']); ?> </td>

      </tr>

      <tr>

        <td><?php echo stripslashes($adminData['taxId']); ?></td>

      </tr>

      

    </table></td>

    <td width="33%">&nbsp;</td>

    <td width="33%" align="right" valign="top"><table width="100%" border="0" cellpadding="0">

      <tr>

        <td align="right"><strong><?php echo stripslashes($agentData['companyName']); ?></strong></td>

      </tr>

      <tr>

        <td align="right"><?php echo stripslashes($agentData['address']); ?></td>

      </tr>

      

      <tr>

        <td align="right">Mobile No: <?php echo stripslashes($agentData['phone']); ?></td>

      </tr>

      <tr>

        <td align="right">Email: <?php echo stripslashes($agentData['email']); ?></td>

      </tr>

      <tr>

        <td align="right">GSTIN: <?php echo stripslashes($agentData['gstin']); ?></td>

      </tr>

      <tr>

        <td align="right">Pan No: <?php echo stripslashes($agentData['pan']); ?></td>

      </tr>

    </table></td>

  </tr> 

  <tr>

    <td colspan="3"><hr /></td>

    </tr> 

  <tr>

    <td colspan="3"><table width="100%" border="0" cellpadding="0" style="border:1px solid #ddd;">

      <tr>

        <td width="39%"><div>Invoice no:</div>

		<div style="font-size:13px; font-weight:600;"><?php echo encode($rest['id']); ?></div>		</td>

        <td width="28%"><div>Booking Date:</div>

		<div style="font-size:13px; font-weight:600;"><?php echo date('d M Y, H:i A', strtotime($rest['bookingDate'])); ?></div></td>

        <td width="18%"><div>Pnr:</div>

		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($rest['pnrNo']); ?></div>		</td>

        <td width="15%" align="center"><div>Booked By:</div>

		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($agentData['companyName']); ?></div>

		</td>

      </tr>

    </table></td>

    </tr> 

  <br>

  <tr>

    <td colspan="3">

   <?php

    $idex=0;

    $flight_heading="Oneword";

    $flight_heading2="Return";

    if(!empty($rest['roundTripId'])){
      $rt2=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$rest['roundTripId'].'"  order by id asc '); 
       }else{
         $rt2=GetPageRecord('*','flightBookingMaster',' id="'.$rest['id'].'"  order by id asc '); 
       }

		while($flightwayret=mysqli_fetch_array($rt2))

    {

    ?>

    <table width="100%" border="0" cellpadding="3" cellspacing="0">

      <tr>

        <td colspan="3" style="border-bottom:1px solid #FF6633;"><?php if($idex == 0){ echo $flight_heading; }else{ echo $flight_heading2; }?>: <span style="font-size:13px; font-weight:600;"><?php echo $flightwayret['source']; ?>-<?php echo $flightwayret['destination']; ?> , <?php echo $flightwayret['flightName']; ?> <?php echo $flightwayret['flightNo']; ?></span></td>

        <td colspan="4" align="right" style="border-bottom:1px solid #FF6633;">Travel Date: <span style="font-size:13px; font-weight:600;"><?php echo date('d M Y', strtotime($flightwayret['journeyDate'])); ?></span></td>

        </tr>

      <tr>

        <td width="31%" align="left" style="border-bottom:1px solid #FF6633;">Name</td>

        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;">Type</td>

        <td width="14%" align="center" style="border-bottom:1px solid #FF6633;">Class</td>

        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Basic</td>

        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;">YQ</td>

        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Taxes</td>

        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Total</td>

      </tr>

	  <?php 

		// $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 

		// $paxData=mysqli_fetch_array($rs6);

    $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$flightwayret['id'].'" and firstName!="" '); 

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

	  ?>

      <tr>

        <td align="left" style="border-bottom:1px solid #ddd;"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> 

        <?php //if(mysqli_num_rows($rs6)>1){ ?><?php //echo (mysqli_num_rows($rs6)-1); } ?>

      </td>

        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($paxData['paxType']); ?></td>

        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($rest['fareClass']); ?></td>

        <td align="center" style="border-bottom:1px solid #ddd;"><?php

        // $totalamount=number_format($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup']);

        //echo $totalamount;

        echo number_format($basic_fare);

        ?></td>

        <td align="center" style="border-bottom:1px solid #ddd;">0</td>

        <td align="center" style="border-bottom:1px solid #ddd;"><?php 

        //echo number_format($totalcostings['totaltax']+$totalcostings['totalagentMarkup']);

        echo number_format($tax_Fare);

        ?></td>

        <td align="center" style="border-bottom:1px solid #ddd;"><?php 

        // number_format($rest['agentTotalFare']-$rest['totalWithSSRAmount']);

       // echo number_format($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup']+$totalcostings['totaltax']+$totalcostings['totalagentMarkup']);

       echo number_format($basic_fare+$tax_Fare);

       ?></td>

      </tr> 

      <?php

    } ?>

    </table><br />

  <?php

  $idex++;

} ?>

  </td>

    </tr> 

	<?php 

		$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 

		$balanceSheetData=mysqli_fetch_array($c);

		 

		$ct=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 

		$balanceSheetDataTDS=mysqli_fetch_array($ct); 

		

		$totalAmt=0;

	  ?>

  <tr>

    <td width="34%">&nbsp;</td>

    <td width="33%">&nbsp;</td>

    <td width="33%" align="right"><table width="100%" border="0" cellpadding="0">

      <tr>

        <td width="50%" align="right">Basic</td>

        <td width="6%" align="center">:</td>

        <td width="44%" align="right"><?php 

        // number_format($rest['baseFare']); $totalAmt+=$rest['agentBaseFare'];

        

        echo number_format($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup']); $totalAmt+=$rest['agentBaseFare'];

        ?> INR</td>

      </tr>

      

      <tr>

        <td align="right">Taxes</td>

        <td align="center">:</td>

        <td align="right"><?php echo number_format($totalcostings['totaltax']+$totalcostings['totalagentMarkup']); ?> INR</td>

      </tr>

     <?php if($rest['seatPrice']>0){ ?> <tr>

        <td align="right">Seat Charges</td>

        <td align="center">:</td>

        <td align="right"><?php echo number_format($totalcostings['totalseatPrice']); ?> INR</td>

      </tr>

	  <?php } ?>

       <?php if($rest['mealPrice']>0){ ?> <tr>

        <td align="right">Meal Charges</td>

        <td align="center">:</td>

        <td align="right"><?php echo number_format($totalcostings['totalmealPrice']); ?> INR</td>

      </tr><?php } ?>

	  <?php if($rest['extraBaggagePrice']>0){ ?>

      <tr>

        <td align="right">Extra Baggage Charges</td>

        <td align="center">:</td>

        <td align="right"><?php echo number_format($totalcostings['totalextraBaggagePrice']); ?> INR</td>

      </tr>

	  <?php } ?>

      <tr>

        <td align="right">TDS </td>

        <td align="center">:</td>

        <td align="right"><?php echo number_format($balanceSheetDataTDS['amount']); ?>  INR</td>

      </tr>

      <tr>

        <td align="right">Commission</td>

        <td align="center">:</td>

        <td align="right">-(<?php echo number_format(abs($totalcostings['totalagentCommision']));  ?> INR)</td>

      </tr>

      

      <tr>

        <td align="right"><strong>Grand Total</strong></td>

        <td align="center"><strong>:</strong></td>

        <td align="right"><strong><?php 

        // number_format(($rest['agentTotalFare']+$rest['mealPrice']+$rest['extraBaggagePrice']+$balanceSheetDataTDS['amount'])-($rest['agentCommision']));

        echo number_format($totalcostings['totalagentTotalFare']+$totalcostings['totalagentFixedMakup']+($_REQUEST['markup']+$totalcostings['totalmealPrice']+$totalcostings['totalseatPrice']+$totalcostings['totalextraBaggagePrice']));

        ?> INR</strong></td>

      </tr>

    </table></td>

  </tr> 

  <tr>

    <td colspan="3"><table width="100%" border="0" cellpadding="0">

      <tr>

        <td width="53%">

		<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #ddd;">

  <tr>

    <td><div style=" font-weight:600; text-decoration: underline; padding:10px;">Terms & Condition</div>

		<div  style=" padding:10px;"><?php echo nl2br(stripslashes($adminData['termsCondition'])); ?></div> </td>

  </tr>

</table>

		</td>

        <td width="47%" align="center"><div style=" font-weight:600;">For <?php echo strtoupper($adminData['companyName']); ?>.</div>

		<div>Computer Generated Report, Requires No Signature</div>		</td>

      </tr>

    </table></td>

    </tr>

</table>





</div>

 

 

<?php if($_REQUEST['mail']!=1){ ?>

 

<button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();' style="float:right;">Print / Download</button>





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