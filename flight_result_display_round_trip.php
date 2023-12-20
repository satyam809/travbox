<?php 
include "inc.php"; 
include "config/logincheck.php";
?>
<div class="row roundtripbox" style="margin-bottom:70px;">

<div class="col-6 listouter">
<div class="sortingouter nav">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture();"><strong>Sort By:</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture();">Departure <i class="fa fa-caret-down" id="departurefa" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration();">Duration <i class="fa fa-caret-down" id="durationfa" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival();">Arrival <i class="fa fa-caret-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-caret-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>
 
                           <input name="pricefilterid" type="hidden" id="pricefilterid" value="1">



                        </td> 

                      </tr>



                    </tbody></table>
</div>




<?php
$rto=GetPageRecord('MIN(AMT) as lowest, MAX(AMT) as highest','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"order by AMT asc'); 
while($rest=mysqli_fetch_array($rto)){
 $min_price=$rest['lowest']; 
 $max_price=$rest['highest']; 
}
//$minprice=0;
$relt=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and roundTripFlight=0 group by FLIGHT_NAME,FLIGHT_NO,DEP_TIME order by AMT asc');
$totalflights=mysqli_num_rows($relt);

$mainlistcount=1;
$flightinfo=null;
$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and roundTripFlight=0 group by uniqueId order by DEP_TIME asc,AMT asc');
while($res=mysqli_fetch_array($a)){
  if(is_null($flightinfo)){
    $flightinfo=array("flightno" => $res['FLIGHT_NO'],"flightcode" => $res['FLIGHT_CODE'],"deptime" => $res['DEP_TIME'],"arrtime" => $res['ARRV_TIME']);
  }else{
    if($res['FLIGHT_NO'] == $flightinfo['flightno'] && $res['FLIGHT_CODE'] == $flightinfo['flightcode']  && $res['DEP_TIME'] == $flightinfo['deptime']  && $res['ARRV_TIME'] == $flightinfo['arrtime']){
      
      continue;
      
    }
    $flightinfo=array("flightno" => $res['FLIGHT_NO'],"flightcode" => $res['FLIGHT_CODE'],"deptime" => $res['DEP_TIME'],"arrtime" => $res['ARRV_TIME']);

  }

  $b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and ARRV_TIME="'.$res['ARRV_TIME'].'" and FLIGHT_CODE="'.$res['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);


$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];
$deptime=date('hi',strtotime($deptime));

$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];
$arrtime=date('hi',strtotime($arrtime));
  
preg_match("/([0-9]+)/", $res['DUR'], $matches);

$D_TIME= $res['DEP_TIME'];
$arrtime= $res['ARRV_TIME'];

$minprice=$min_price;
$maxprice= $max_price;

?>

<script>
$('#flightnameid<?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>').show();
</script>


<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="card item itemlist bookrow"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">

<div class="card-body">

<div class="row">

<div class="col-9">

<div class="row select1col" >
<div class="col-4">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">
      <div>
        <?= $flightprice['STOP'] > 0 ? FightLogos($res['searchJson']) : '<img src="'.$imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])) .'" width="32" height="32">' ?>
      </div>
      <p style="display: <?= $flightprice['STOP'] > 0 ? 'block' : 'none' ?>;color: red;font-weight: bold;font-size: 0.4rem;text-wrap: nowrap; margin-top:5px">(Multiple Airlines)</p>
    </td>
    
    <td>
	<div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>
	<div class="flightnumber"><?php echo $flightprice['STOP'] > 0 ? nonStopFightId($res['searchJson'],',<br>') : stripslashes($res['FLIGHT_CODE']) .'-'.stripslashes($res['FLIGHT_NO']); ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo stripslashes($res['DEP_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($res['ORG_CODE']); ?></div>
	</td>
    <td width="33%" align="center">
	<div class="nonstop">
                        <h4><?php echo $res['DUR']; ?></h4>
                        <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <span class="graysmalltext"><?php if($res['STOP']==0){ ?>
                          Non Stop<?php  }else{ ?><span style="color:#bf0000 !important; cursor:pointer;" id="hoverstop<?php echo $res['id']; ?>" onmouseout="$('.stoptooltip').hide();" onmouseover="showtooltip(<?php echo $res['id']; ?>);"><?php echo $res['STOP'].' Stop '; ?></span><?php } ?></span>
							<div class="stoptooltip" id="stoptooltip<?php echo $res['id']; ?>"></div>
                      </div> 
	
	  </td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo stripslashes($res['ARRV_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($res['DES_CODE']); ?></div></td>
  </tr>
</table>

</div>
</div> 
 <?php if(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))!=''){ ?>
<div class="ymessage">
<?php echo stripslashes(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))); ?>
</div>
<?php  } ?>

<div class="row" style="margin-top:10px;">
<div class="col-6">
 
</div>

 


</div>
 
 
</div>

<div class="col-3">
<h4>&#8377;<?php 
  if($flightprice['acom'] == 0){ echo number_format(round($basefares[1]+$flightprice['agentFixedMakup']));}else{
    echo number_format(round($flightprice['acom']+$flightprice['NET_FARE']+$flightprice['agentFixedMakup']));
   } ?></h4>
<a id="booknowlink<?php echo stripslashes($res['id']); ?>" onclick="loadmoreflight('<?php echo stripslashes($res['id']); ?>','<?php echo $res['FLIGHT_NO']; ?>','<?php echo $res['DEP_TIME']; ?>','<?php echo $res['FLIGHT_CODE']; ?>');" style="cursor:pointer;"><button type="button" class="btn btn-danger" style="width:100%;"  >Select <i class="fa fa-angle-down" aria-hidden="true"></i></button></a>
</div>

<div class="col-12"><table class="roundwayseatast">
                        <tbody><tr>
                          <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><?php if($flightprice['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>&nbsp;&nbsp;&nbsp;</td>

                          <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <span class="red"> <?php echo stripslashes($flightprice['SEAT']); ?> Seat Left </span>                          </td>
                           
                          <td><div class="blackbox">
                      
						     <h5><i class="fa fa-list" aria-hidden="true"></i> <?php echo $_SESSION['PC'];  ?></h5>
						</div></td> 
                        </tr>
                      </tbody></table></div>
 

<div class="col-12 loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;">
<div   id="ratetablebox<?php echo stripslashes($res['id']); ?>">
<?php

$ns=1;
$farecolor='';
$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and FLIGHT_NAME="'.$res['FLIGHT_NAME'].'" and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and ARRV_TIME="'.$res['ARRV_TIME'].'" and FLIGHT_CODE="'.$res['FLIGHT_CODE'].'" group by PCC order by AMT asc');
while($flightprice=mysqli_fetch_array($b)){  

$str_arr = explode (",", $flightprice['agfare']);  
	$basefares = explode ("=", $str_arr[2]);
	
	
		$bagg=explode (",", $res['FLIGHT_INFO']);
 $iB=$bagg[1];
 $cB=$bagg[0];
?>

<?php  
//if($ns==1 && $mainlistcount==1){
  
 // $minprice=$basefares[1];
  
 // }


if($ns==1 ){ 

 ?>

<script>
$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-price','<?php echo $basefares[1]; ?>');
</script>
<?php } 

 //$maxprice=$basefares[1];

?>
<div class="pricelistflight">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pricelisttable">
 
 
  <tr>
    <td width="1%" align="left" valign="top"><input <?php if($ns==1){ ?>checked="checked"<?php } ?> id="<?php if($ns==1){ ?>firstradio<?php echo stripslashes($res['id']); ?><?php } ?>" name="flightprice" value="<?php echo stripslashes($flightprice['id']); ?>" type="radio" onClick="flightdetailsbox('<?php echo stripslashes($res['id']); ?>','<?php echo stripslashes($flightprice['id']); ?>','1');$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');$('#displaytab1price').html('<?php echo $basefares[1]; ?>');$('#i').val('<?php echo encode($flightprice['id']); ?>');"  ></td>
    <td align="left" valign="top" class="pricelistright"><div style="width:100%;"><h4 class="mainprice">&#8377;<?php $totalfare=0;
    //  echo $totalfare=$basefares[1]+$flightprice['agentFixedMakup'];
     if($flightprice['acom'] == 0){
      echo number_format(round($totalfare=$basefares[1]+$flightprice['agentFixedMakup'])); 
      }else{
        echo $totalfare= number_format(round($flightprice['acom']+$flightprice['NET_FARE']+$flightprice['agentFixedMakup']));
      }
     ?></h4>
	
	<div style="line-height: 0px;    line-height: 14px;"><span class="netpriceshow" style="  width:100%; color:#009933;"><span class="shownet" style="display: none;">&#8377; <?php
	
  $totaltdsdisplay=0;
	$totaltdsdisplay=round(abs($flightprice['acom']*5/100));
	$sellingfare=0;
	 echo $sellingfare=number_format(round($flightprice['netFareBeforecomm']))/*+$totaltdsdisplay;*/ ?> - </span><span class="showinv" style="display: none">Earn. &#8377;<?php

	
   echo number_format(round($flightprice['acom']));
   //round(abs($sellingfare-$totalfare)); 
   ?></span></span></div>
</div>
	   </td>
    <td align="left" valign="top" class="pricelistright"><div class="flhead">Fare Type </div>
   <div class="flhtext"><div class="blackbox" style="margin-left:0px;">
                        <?php if(getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))!=''){?><div class="blackbg"  style="background-color:<?php echo getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?>; color:#FFFFFF;"><?php echo getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?></div><?php }  else { ?>
						<div class="blackbg"><?php echo $flightprice['PCC']; ?></div>
					<?php } ?></div></div></td>
    <td align="left" valign="top" class="pricelistright"><div class="flhtext" style="line-height: 18px; color: #393939; text-transform: uppercase; font-size: 11px !important;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo $iB; ?><br />
<i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo $cB; ?></div> <div class="bookmsg"> 
                      <?php if(stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])))!=''){?><p><?php echo stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?></p><?php } ?> 
				 
      </div><?php if($flightprice['apiType']!='AK'){?><i class="fa fa-info-circle" aria-hidden="true" onclick="loadpop('Flight Details (<?php echo stripslashes($flightprice['FLIGHT_NAME']); ?>  - <?php echo stripslashes($flightprice['FLIGHT_CODE']); ?>-<?php echo stripslashes($flightprice['FLIGHT_NO']); ?>)',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=showflightdetails&id=<?php echo $flightprice['id']; ?>"></i><?php } ?></td>
    </tr>
</table>
</div>
 <?php 
  
  $farecolor.=' '.str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))).' ';
  ?>
  <script>
  $('.filter-<?php echo str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?>').show();
  </script>
  <?php $ns++; } ?>
</div>
 

<script>
var colorattr = $('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category','<?php echo $farecolor; ?>'+colorattr)
</script>
</div>

 


<div class="flightdetailsbox onewaydetailsbox" id="flightdetails<?php echo $res['id']; ?>" style="display:none;">



</div>

</div>

</div>

</div>

<?php    $mainlistcount++; } ?>


<script>
<?php
$a=GetPageRecord('*','sys_flightName','1 order by name asc');
while($res=mysqli_fetch_array($a)){
  $flight=0;
  $flightinfo2=null;

  $ab=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and roundTripFlight=0 and FLIGHT_NAME="'.stripslashes($res['name']).'"  group by ARRV_TIME,DEP_TIME,FLIGHT_NO,FLIGHT_CODE,FLIGHT_NAME order by AMT asc');
  while($flightdata=mysqli_fetch_array($ab)){
    if(is_null($flightinfo2)){
      $flightinfo2=array("flightno" => $flightdata['FLIGHT_NO'],"flightcode" => $flightdata['FLIGHT_CODE'],"deptime" => $flightdata['DEP_TIME'],"arrtime" => $flightdata['ARRV_TIME']);
    }else{
      if($flightdata['FLIGHT_NO'] == $flightinfo2['flightno'] && $flightdata['FLIGHT_CODE'] == $flightinfo2['flightcode']  && $flightdata['DEP_TIME'] == $flightinfo2['deptime']  && $flightdata['ARRV_TIME'] == $flightinfo2['arrtime']){
        
        continue;
        
      }
  
      $flightinfo2=array("flightno" => $flightdata['FLIGHT_NO'],"flightcode" => $flightdata['FLIGHT_CODE'],"deptime" => $flightdata['DEP_TIME'],"arrtime" => $flightdata['ARRV_TIME']);
  
    
    }
    $flight++;
  }
  
// $flight=mysqli_num_rows($ab);

$abc=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and roundTripFlight=0 and FLIGHT_NAME="'.stripslashes($res['name']).'" group by ARRV_TIME,DEP_TIME,FLIGHT_NO,FLIGHT_CODE,FLIGHT_NAME order by AMT asc');
$resf=mysqli_fetch_array($abc);

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and roundTripFlight=0  and FLIGHT_NO="'.$resf['FLIGHT_NO'].'" and DEP_TIME="'.$resf['DEP_TIME'].'" and FLIGHT_CODE="'.$resf['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);

  if($flightprice['acom'] == 0){
    
    $price= round($basefares[1]+$flightprice['agentFixedMakup']);
  }else{

    $price= round($flightprice['acom']+$flightprice['NET_FARE']+$flightprice['agentFixedMakup']);
   }?>
$('.totalflight<?php echo stripslashes($res['id']); ?>').html('(<?php echo stripslashes($flight); ?>)<span>&#8377;<?php echo round($price); ?></span>');
 
 <?php } ?>
 
 </script>

</div>









<!-------------------------Round Trip--------------------------->







 
  <div class="col-6 listouter2">
<div class="sortingouter nav">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture2();"><strong>Sort By:</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture2();">Departure <i class="fa fa-caret-down" id="departurefa2" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid2" type="hidden" id="departurefilterid2" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration2();">Duration <i class="fa fa-caret-down" id="durationfa2" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid2" type="hidden" id="durationfilterid2" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival2();">Arrival <i class="fa fa-caret-down" id="arrivalfa2" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid2" type="hidden" id="arrivalfilterid2" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice2();" id="pricefilter2">Price <i class="fa fa-caret-up" id="pricefa2" aria-hidden="true" style="display: inline-block;"></i>
 
                           <input name="pricefilterid2" type="hidden" id="pricefilterid2" value="1">



                        </td> 

                      </tr>



                    </tbody></table>
</div>




<?php

//$minprice=0;
$relt2=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and roundTripFlight=1 group by FLIGHT_NAME,FLIGHT_NO,DEP_TIME order by AMT asc');
$totalflights_ret=mysqli_num_rows($relt2);

$mainlistcount=1;
$flightinfo=null;
$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and roundTripFlight=1 group by FLIGHT_NAME,FLIGHT_NO,DEP_TIME,uniqueId order by AMT asc');
while($res=mysqli_fetch_array($a)){

  if(is_null($flightinfo)){
    $flightinfo=array("flightno" => $res['FLIGHT_NO'],"flightcode" => $res['FLIGHT_CODE'],"deptime" => $res['DEP_TIME'],"arrtime" => $res['ARRV_TIME']);
  }else{
    if($res['FLIGHT_NO'] == $flightinfo['flightno'] && $res['FLIGHT_CODE'] == $flightinfo['flightcode']  && $res['DEP_TIME'] == $flightinfo['deptime']  && $res['ARRV_TIME'] == $flightinfo['arrtime']){
      
      continue;
      
    }
    $flightinfo=array("flightno" => $res['FLIGHT_NO'],"flightcode" => $res['FLIGHT_CODE'],"deptime" => $res['DEP_TIME'],"arrtime" => $res['ARRV_TIME']);

  }
$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and FLIGHT_CODE="'.$res['FLIGHT_CODE'].'" and ARRV_TIME="'.$res['ARRV_TIME'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);


$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];
$deptime=date('hi',strtotime($deptime));

$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];
$arrtime=date('hi',strtotime($arrtime));
  
preg_match("/([0-9]+)/", $res['DUR'], $matches);

$D_TIME= $res['DEP_TIME'];
$arrtime= $res['ARRV_TIME'];


?>

<script>
$('#flightnameid2<?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>').show();
</script>

 
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="card item itemlist2 bookrow"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">

<div class="card-body">

<div class="row">

<div class="col-9">

<div class="row select2col">
<div class="col-4">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">
      <div>
      <?= $flightprice['STOP'] > 0 ? FightLogos($res['searchJson']) : '<img src="'.$imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])) .'" width="32" height="32">' ?>
      </div>
      <p style="display: <?= $flightprice['STOP'] > 0 ? 'block' : 'none' ?>;color: red;font-weight: bold;font-size: 0.4rem;text-wrap: nowrap;">(Multiple Airlines)</p>
    </td>
    <td>
	<div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>
	<div class="flightnumber"><?php echo $flightprice['STOP'] > 0 ? nonStopFightId($res['searchJson'],',<br>') : stripslashes($res['FLIGHT_CODE']) .'-'.stripslashes($res['FLIGHT_NO']); ?></div>
	
	</td>

  </tr>
</table>

</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo stripslashes($res['DEP_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($res['ORG_CODE']); ?></div>
	</td>
    <td width="33%" align="center"><div class="nonstop">
                        <h4><?php echo $res['DUR']; ?></h4>
                        <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <span class="graysmalltext"><?php if($res['STOP']==0){ ?>
                          Non Stop<?php  }else{ ?><span style="color:#bf0000 !important; cursor:pointer;" id="hoverstop<?php echo $res['id']; ?>" onmouseout="$('.stoptooltip').hide();" onmouseover="showtooltip(<?php echo $res['id']; ?>);"><?php echo $res['STOP'].' Stop '; ?></span><?php } ?></span>
							<div class="stoptooltip" id="stoptooltip<?php echo $res['id']; ?>"></div>
                      </div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo stripslashes($res['ARRV_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($res['DES_CODE']); ?></div></td>
  </tr>
</table>

</div>
</div> 
 <?php if(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))!=''){ ?>
<div class="ymessage">
<?php echo stripslashes(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))); ?>
</div>
<?php  } ?>

<div class="row" style="margin-top:10px;">
<div class="col-6">
 
</div>

 


</div>
 
 
</div>
<div class="col-3">
<h4>&#8377;<?php 
  if($flightprice['acom'] == 0){ echo number_format(round($basefares[1]+$flightprice['agentFixedMakup']));}else{
    echo number_format(round($flightprice['acom']+$flightprice['NET_FARE']+$flightprice['agentFixedMakup']));
   } ?></h4>
<a id="booknowlink<?php echo stripslashes($res['id']); ?>" onclick="loadmoreflight('<?php echo stripslashes($res['id']); ?>','<?php echo $res['FLIGHT_NO']; ?>','<?php echo $res['DEP_TIME']; ?>','<?php echo $res['FLIGHT_CODE']; ?>');" style="cursor:pointer;"><button type="button" class="btn btn-danger" style="width:100%;"  >Select <i class="fa fa-angle-down" aria-hidden="true"></i></button></a>
</div>

<div class="col-12"><table class="roundwayseatast">
                        <tbody><tr>
                          <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><?php if($flightprice['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>&nbsp;&nbsp;&nbsp;</td>

                          <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <span class="red"> <?php echo stripslashes($flightprice['SEAT']); ?> Seat Left </span>                          </td>
                           
                          <td><div class="blackbox">
                      
						     <h5><i class="fa fa-list" aria-hidden="true"></i> <?php echo $_SESSION['PC'];  ?></h5>
						</div></td> 
                        </tr>
                      </tbody></table></div>

<div class="col-12 loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;">

<div  id="ratetablebox<?php echo stripslashes($res['id']); ?>">
<?php
$ns=1;
$farecolor='';

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and FLIGHT_NAME="'.$res['FLIGHT_NAME'].'" and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and ARRV_TIME="'.$res['ARRV_TIME'].'" group by PCC order by AMT asc');
while($flightprice=mysqli_fetch_array($b)){ 


$str_arr = explode (",", $flightprice['agfare']);  
	$basefares = explode ("=", $str_arr[2]);
	
	
		$bagg=explode (",", $res['FLIGHT_INFO']);
 $iB=$bagg[1];
 $cB=$bagg[0];

$str_arr = explode (",", $flightprice['agfare']);  
	$basefares = explode ("=", $str_arr[2]);
?>

<?php  
// if($ns==1 && $mainlistcount==1){
//   $minprice=$basefares[1];
  
//   }


if($ns==1 ){ 

 ?>

<script>
$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-price','<?php echo $basefares[1]; ?>');
</script>
<?php } 

 //$maxprice=$basefares[1];
?>
<div class="pricelistflight">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pricelisttable">
 
 
  <tr>
    <td width="1%" align="left" valign="top"><input <?php if($ns==1){ ?>checked="checked"<?php } ?> id="<?php if($ns==1){ ?>firstradioround<?php echo stripslashes($res['id']); ?><?php } ?>" name="flightpriceround" value="<?php echo stripslashes($flightprice['id']); ?>" type="radio" onClick="flightdetailsboxround('<?php echo stripslashes($res['id']); ?>','<?php echo stripslashes($flightprice['id']); ?>','1');$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');$('#displaytab2price').html('<?php echo $basefares[1]; ?>');$('#r').val('<?php echo encode($flightprice['id']); ?>');"  ></td>
    <td align="left" valign="top" class="pricelistright"><div style="width:100%;"><h4 class="mainprice">&#8377;<?php $totalfare=0; 
    // echo $totalfare=$basefares[1]+$flightprice['agentFixedMakup'];
    if($flightprice['acom'] == 0){
      echo $totalfare=number_format(round($basefares[1]+$flightprice['agentFixedMakup'])); 
      }else{
        echo $totalfare= number_format(round($flightprice['acom']+$flightprice['NET_FARE']));
      }
     ?></h4>
	
	<div style="line-height: 0px;    line-height: 14px;"><span class="netpriceshow" style="  width:100%; color:#009933;"><span class="shownet" style="display: none;">&#8377; <?php

  $totaltdsdisplay=0;
	$totaltdsdisplay=number_format(round(abs($flightprice['acom']*5/100)));
	$sellingfare=0;
	 echo $sellingfare=number_format(round($flightprice['netFareBeforecomm']))/*+$totaltdsdisplay;*/ ?> - </span><span class="showinv" style="display: none">Earn. &#8377;<?php

	
	 echo number_format(round($flightprice['acom']));
   //round(abs($sellingfare-$totalfare));
    ?></span></span></div>
   </div>
	  	</td>
    <td align="left" valign="top" class="pricelistright"><div class="flhead">Fare Type </div>
   <div class="flhtext"><div class="blackbox" style="margin-left:0px;">
                        <?php if(getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))!=''){?><div class="blackbg"  style="background-color:<?php echo getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?>; color:#FFFFFF;"><?php echo getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?></div><?php }  else { ?>
						<div class="blackbg"><?php echo $flightprice['PCC']; ?></div>
					<?php } ?></div></div> </td>
    <td align="left" valign="top" class="pricelistright"><div class="flhtext" style="line-height: 18px; color: #393939; text-transform: uppercase; font-size: 11px !important;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo $iB; ?><br />
<i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo $cB; ?></div> <div class="bookmsg"> 
                      <?php if(stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])))!=''){?><p><?php echo stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?></p><?php } ?>  
				 
      </div><?php if($flightprice['apiType']!='AK'){?><i class="fa fa-info-circle" aria-hidden="true" onclick="loadpop('Flight Details (<?php echo stripslashes($flightprice['FLIGHT_NAME']); ?>  - <?php echo stripslashes($flightprice['FLIGHT_CODE']); ?>-<?php echo stripslashes($flightprice['FLIGHT_NO']); ?>)',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=showflightdetails&id=<?php echo $flightprice['id']; ?>"></i><?php } ?></td>
  </tr>
</table>

</div>

  <?php 
  
  $farecolor.=' '.str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))).' ';
  ?>
  <script>
  $('.filter2-<?php echo str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?>').show();
  </script>
  <?php $ns++; } ?>
</div>
 
<script>
var colorattr = $('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category','<?php echo $farecolor; ?>'+colorattr)
</script>
</div>

 


<div class="flightdetailsbox flightdetailsboxround2" id="flightdetails<?php echo $res['id']; ?>" style="display:none;">



</div>

</div>

</div>

</div>

<?php    $mainlistcount++; } ?>


</div>

<?php if($totalflights == 0 || $totalflights_ret == 0){ ?>


<div class="bookrow item itemlist itemnotfound"> 
  <div class="row" style="padding: 0px 12px; text-align: center;">
    <div class="col-6">
      <div class="m-3"><img width="30%" src="images/tripzygoimg.png"></div>
    </div>
    <div class="col-6">
     <div style="font-size: 15px; font-weight: 800;" class="py-3"> Sorry, There were no flights found for this route.<br />Please, Modify your search and try again.</div>
    <button type="button" class="btn btn-primary mb-3 mdifybtn">PLEASE, MODIFY YOUR SEARCH AND TRY AGAIN.</button>
    <div>
  <div>

</div>

<?php } ?>
<script>
<?php
$a=GetPageRecord('*','sys_flightName','1 order by name asc');
while($res=mysqli_fetch_array($a)){
  $flight=0;
  $flightinfo=null;
$ab=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and roundTripFlight=1 and FLIGHT_NAME="'.stripslashes($res['name']).'" group by ARRV_TIME,DEP_TIME,FLIGHT_NO,FLIGHT_CODE,FLIGHT_NAME order by AMT asc');
while($flightdata=mysqli_fetch_array($ab)){
  if(is_null($flightinfo)){
    $flightinfo=array("flightno" => $flightdata['FLIGHT_NO'],"flightcode" => $flightdata['FLIGHT_CODE'],"deptime" => $flightdata['DEP_TIME'],"arrtime" => $flightdata['ARRV_TIME']);
  }else{
    if($flightdata['FLIGHT_NO'] == $flightinfo['flightno'] && $flightdata['FLIGHT_CODE'] == $flightinfo['flightcode']  && $flightdata['DEP_TIME'] == $flightinfo['deptime']  && $flightdata['ARRV_TIME'] == $flightinfo['arrtime']){
      
      continue;
          
    }

    $flightinfo=array("flightno" => $flightdata['FLIGHT_NO'],"flightcode" => $flightdata['FLIGHT_CODE'],"deptime" => $flightdata['DEP_TIME'],"arrtime" => $flightdata['ARRV_TIME']);

  
  }
  $flight++;
}



$abc=GetPageRecord('FLIGHT_NO,DEP_TIME,FLIGHT_CODE','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and roundTripFlight=1 and FLIGHT_NAME="'.stripslashes($res['name']).'" group by ARRV_TIME,DEP_TIME,FLIGHT_NO,FLIGHT_CODE,FLIGHT_NAME order by AMT asc');
$resf=mysqli_fetch_array($abc);

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and roundTripFlight=1  and FLIGHT_NO="'.$resf['FLIGHT_NO'].'" and DEP_TIME="'.$resf['DEP_TIME'].'" and FLIGHT_CODE="'.$resf['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);

  if($flightprice['acom'] == 0){
    
    $price= round($basefares[1]+$flightprice['agentFixedMakup']);
  }else{

    $price= round($flightprice['acom']+$flightprice['NET_FARE']+$flightprice['agentFixedMakup']);
   }
   ?>
$('.totalflightret<?php echo stripslashes($res['id']); ?>').html('(<?php echo stripslashes($flight); ?>)<span>&#8377;<?php echo round($price); ?></span>');
 
 <?php } ?>
 
 </script>

</div>









<script>  
function showtooltip(id){
$('#stoptooltip'+id).show();
$('#stoptooltip'+id).load('websiteloadpopup.php?action=stoptooltip&id='+id);
}

  $('.mdifybtn').on('click', function(){
  window.location.href="<?php echo $fullurl; ?>flights";
});

function flightdetailsbox(id,secid,tabid){ 
 
var select1col = $('#itemlist'+id+' .select1col').html();
$('.displaytab1').html(select1col);

if(tabid==4){
$('#flightdetails'+id).html('Loading...');
}

var secid = $('input[name="flightprice"]:checked').val();
$('#flightdetails'+id).load('flightdetailsbox.php?id='+secid+'&mainid='+id+'&tabid='+tabid);
 
}


function flightdetailsboxround(id,secid,tabid){ 
 
var select1col = $('#itemlist'+id+' .select2col').html();
$('.displaytab2').html(select1col);

if(tabid==4){
$('#flightdetails'+id).html('Loading...');
}

var secid = $('input[name="flightpriceround"]:checked').val(); 
$('#flightdetails'+id).load('flightdetailsbox.php?id='+secid+'&mainid='+id+'&tabid='+tabid+'&round=1');
 
}

function hidedetailbtn(id){

var blk = $('#flightdetails'+id).css('display');

if(blk=='block'){
$('#viewdetailbtn'+id).text('Show Details');
$('#flightdetails'+id).hide();
} else {
$('#viewdetailbtn'+id).text('Hide Details');
$('#flightdetails'+id).show();
}

}


function hideallfilterarrow(){
$('#departurefa').hide();
$('#durationfa').hide();
$('#arrivalfa').hide();
$('#pricefa').hide();
$('#departurefaReturn').hide();
$('#durationfaReturn').hide();
$('#arrivalfaReturn').hide();
$('#pricefaReturn').hide();
}




function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#pricefa').show();$wrap.find('.item').sort(function(a, b) 
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
 
function getSortedArrival() 
{
var pricefilterid = $('#arrivalfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#arrivalfa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#arrivalfilterid').val('0'); 
$('#arrivalfa').removeClass('fa-caret-down');
$('#arrivalfa').addClass('fa-caret-up');return + a.getAttribute('data-arrive') - 
+b.getAttribute('data-arrive'); } else {$('#arrivalfilterid').val('1'); 
$('#arrivalfa').removeClass('fa-caret-up');
$('#arrivalfa').addClass('fa-caret-down');return + b.getAttribute('data-arrive') - 
+a.getAttribute('data-arrive');
}})
.appendTo($wrap); 
} 
function getSortedDeparture() 
{
var pricefilterid = $('#departurefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow();
$('#departurefa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#departurefilterid').val('0'); 
$('#departurefa').removeClass('fa-caret-down');
$('#departurefa').addClass('fa-caret-up');return + a.getAttribute('data-depart') - 
+b.getAttribute('data-depart'); } else {$('#departurefilterid').val('1'); 
$('#departurefa').removeClass('fa-caret-up');
$('#departurefa').addClass('fa-caret-down');return + b.getAttribute('data-depart') - 
+a.getAttribute('data-depart');
}})
.appendTo($wrap); 
} 
function getSortedDuration() 
{
var pricefilterid = $('#durationfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#durationfa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#durationfilterid').val('0'); 
$('#durationfa').removeClass('fa-caret-down');
$('#durationfa').addClass('fa-caret-up');return + a.getAttribute('data-duration') - 
+b.getAttribute('data-duration'); } else {$('#durationfilterid').val('1'); 
$('#durationfa').removeClass('fa-caret-up');
$('#durationfa').addClass('fa-caret-down');return + b.getAttribute('data-duration') - 
+a.getAttribute('data-duration');
}})
.appendTo($wrap); 
}




<!-----------------------Round Trip----------------------->



function hideallfilterarrow2(){
$('#departurefa2').hide();
$('#durationfa2').hide();
$('#arrivalfa2').hide();
$('#pricefa2').hide();
$('#departurefaReturn2').hide();
$('#durationfaReturn2').hide();
$('#arrivalfaReturn2').hide();
$('#pricefaReturn2').hide();
}


function getSortedPrice2(){

var pricefilterid = $('#pricefilterid2').val();
var $wrap = $('.listouter2');
hideallfilterarrow2(); 
$('#pricefa2').show();$wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#pricefilterid2').val('0'); 
$('#pricefa2').removeClass('fa-caret-down');
$('#pricefa2').addClass('fa-caret-up');return + a.getAttribute('data-price') - 
+b.getAttribute('data-price'); 
}else{$('#pricefilterid2').val('1'); 
$('#pricefa2').removeClass('fa-caret-up');
$('#pricefa2').addClass('fa-caret-down');return + b.getAttribute('data-price') - 
+a.getAttribute('data-price');
}})
.appendTo($wrap); 
}
getSortedPrice2();
 
function getSortedArrival2() 
{
var pricefilterid = $('#arrivalfilterid2').val();
var $wrap = $('.listouter2');
hideallfilterarrow2(); 
$('#arrivalfa2').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#arrivalfilterid2').val('0'); 
$('#arrivalfa2').removeClass('fa-caret-down');
$('#arrivalfa2').addClass('fa-caret-up');return + a.getAttribute('data-arrive') - 
+b.getAttribute('data-arrive'); } else {$('#arrivalfilterid2').val('1'); 
$('#arrivalfa2').removeClass('fa-caret-up');
$('#arrivalfa2').addClass('fa-caret-down');return + b.getAttribute('data-arrive') - 
+a.getAttribute('data-arrive');
}})
.appendTo($wrap); 
} 
function getSortedDeparture2() 
{
var pricefilterid = $('#departurefilterid2').val();
var $wrap = $('.listouter2');
hideallfilterarrow2();
$('#departurefa2').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#departurefilterid2').val('0'); 
$('#departurefa2').removeClass('fa-caret-down');
$('#departurefa2').addClass('fa-caret-up');return + a.getAttribute('data-depart') - 
+b.getAttribute('data-depart'); } else {$('#departurefilterid2').val('1'); 
$('#departurefa2').removeClass('fa-caret-up');
$('#departurefa2').addClass('fa-caret-down');return + b.getAttribute('data-depart') - 
+a.getAttribute('data-depart');
}})
.appendTo($wrap); 
} 
function getSortedDuration2() 
{
var pricefilterid = $('#durationfilterid2').val();
var $wrap = $('.listouter2');
hideallfilterarrow2(); 
$('#durationfa2').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#durationfilterid2').val('0'); 
$('#durationfa2').removeClass('fa-caret-down');
$('#durationfa2').addClass('fa-caret-up');return + a.getAttribute('data-duration') - 
+b.getAttribute('data-duration'); } else {$('#durationfilterid2').val('1'); 
$('#durationfa2').removeClass('fa-caret-up');
$('#durationfa2').addClass('fa-caret-down');return + b.getAttribute('data-duration') - 
+a.getAttribute('data-duration');
}})
.appendTo($wrap); 
}






var $filterCheckboxes = $('.allFilterDiv input[type="checkbox"]');
$filterCheckboxes.on('change', function() {
  var selectedFilters = {};
  $filterCheckboxes.filter(':checked').each(function() {
    if (!selectedFilters.hasOwnProperty(this.name)) {

      selectedFilters[this.name] = [];

    }
    selectedFilters[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.itemlist');
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
  $('.itemlist').hide().filter($filteredResults).show();
});



 var $filterCheckboxes2 = $('.allFilterDiv2 input[type="checkbox"]');
$filterCheckboxes2.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes2.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.itemlist2');
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
  $('.itemlist2').hide().filter($filteredResults).show();
});



</script>













	<script>

          $(function() {



          var maxprice = Number($('#maxprice').val()); 



          var minprice = Number($('#minprice').val());

          sliderange(minprice, maxprice);
                        
            $( "#amountfilter" ).val( "" + $( "#slider-ranges" ).slider( "values", 0 ) +

          " - " + $( "#slider-ranges" ).slider( "values", 1 ) );
          //console.log($( "#slider-ranges" ).slider( "values", 1 ));
          });

          $( ".amountfilter" ).on('change', function(){

            let min2 = $(this).val().split('-');

            let max2 = $(this).val().split('-');

            sliderange(Number(min2[0]), Number(max2[1]));

            showProducts(min2[0], max2[1]);

          });

          function showProducts(minPrice, maxPrice) {

            $(".item").hide().filter(function() {

            var price = parseInt($(this).data("price"), 10);

            return price >= minPrice && price <= maxPrice;

            }).show();

          }

                  
          function sliderange(minprice, maxprice){
            //console.log(minprice , maxprice);
            $( "#slider-ranges" ).slider({

              range: true,

              min: minprice,

              max: maxprice,

              values: [ minprice, maxprice ],

              slide: function( event, ui ) {
                //console.log(ui.values[ 0 ]);
              $( "#amountfilter" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );

              

              showProducts(ui.values[ 0 ], ui.values[ 1 ]);

              }
          
            });

          } 
					</script>
					
					<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
					<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">
					
					
					
					
					
					
					
	<script>
function showratetablebox(id){
var morefrebt = $('#morefrebt'+id).text();
if(morefrebt=='+ More Fare'){
$('#ratetablebox'+id).css('height','auto');
$('#morefrebt'+id).text('- Less Fare');
} else { 
$('#ratetablebox'+id).css('height','70px');
$('#morefrebt'+id).text('+ More Fare');
}
}

function loadmoreflight(id,FLIGHT_NO,DEP_TIME,FLIGHT_CODE){

var dd=$('#moreflight'+id).css('display');
var FLIGHT_NO = encodeURI(FLIGHT_NO);
var DEP_TIME = encodeURI(DEP_TIME);
var FLIGHT_CODE = encodeURI(FLIGHT_CODE);

if(dd=='block'){
$('#moreflight'+id).hide();
$('#booknowlink'+id+' i').addClass('fa-angle-down');
$('#booknowlink'+id+' i').removeClass('fa-angle-up');
} else {
$('#moreflight'+id).show();
$('#booknowlink'+id+' i').addClass('fa-angle-up');
$('#booknowlink'+id+' i').removeClass('fa-angle-down'); 
}

}
$('.flightsnet').on('click', function() {

if($('.flightsnet').prop('checked') == true){
$('.shownet').show();

}
else if($('.flightsnet').prop('checked') == false){
$('.shownet').hide();
}
})
$('.flightsfare').on('click', function() {
if($('.flightsfare').prop('checked') == true){
$('.showinv').show();
}
else if($('.flightsfare').prop('checked') == false){
$('.showinv').hide();
}
})

if($('.flightsnet').prop('checked') == true){
$('.shownet').show();
}
else if($('.flightsnet').prop('checked') == false){
$('.shownet').hide();
}

 if($('.flightsfare').prop('checked') == true){
$('.showinv').show();
}
  else if($('.flightsfare').prop('checked') == false){
$('.showinv').hide();
}
</script>