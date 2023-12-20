<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$qid=$_REQUEST['qid'];


if($_REQUEST['tdid']!=''){ 
deleteRecord('quotationEvents','id="'.decode($_REQUEST['tdid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}

$a=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and  quotationId="'.decode($qid).'" and  	eventType="Transport" order by id asc '); 
$eventdata=mysqli_fetch_array($a);


$b=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($qid).'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

$c=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$quotationDetail['queryId'].'" order by id asc '); 
$queryData=mysqli_fetch_array($c);
?>



<?php if($eventdata['id']==''){ ?>

<div style="text-align:center; font-size:30px; color:#999999; padding:38px 0px;"><i class="fa fa-car" aria-hidden="true" title="Transport"></i><div style="font-size:14px;"> No Transport Added</div></div>

<?php } else { ?>

<?php   
$ha=GetPageRecord('*','quotationEvents','  quotationId="'.decode($qid).'" and parentId="'.$LoginUserDetails['parentId'].'" and eventType="Transport" order by id asc');
while($listhotel=mysqli_fetch_array($ha)){ 



$d=GetPageRecord('*','sys_vehicleMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$listhotel['vehicleId'].'" order by id asc '); 
$vehicleData=mysqli_fetch_array($d);
?>
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $listhotel['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $listhotel['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($listhotel['transportType']=='Private Cab'){ if($vehicleData['eventPhoto']!=''){ ?>upload/<?php echo $vehicleData['eventPhoto']; } else { ?>assets/pvtcab.png<?php } } ?><?php if($listhotel['transportType']=='SIC'){ ?>assets/siccab.png<?php } ?><?php if($listhotel['transportType']=='Bus'){ ?>assets/busicon.png<?php } ?><?php if($listhotel['transportType']=='Train'){ ?>assets/trainicon.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"> 
	
	
	 
	
	<input name="eventId" type="hidden" value="<?php echo encode($listhotel['id']); ?>">
	<input name="action" type="hidden" value="saveupdatesightseeingimage">
	<input name="cityId2" type="hidden" value="<?php echo $listhotel['cityId']; ?>">
	<input name="evenetname" type="hidden" value="<?php echo $listhotel['name']; ?>"> 
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="sightseeingaddbtn<?php echo encode($listhotel['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Transport',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtransportdetails&id=<?php echo encode($listhotel['id']); ?>&quotationid=<?php echo $_REQUEST['qid']; ?>&qt=<?php echo $_REQUEST['qt']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this transport?')) deleteloadquotationtransport('<?php echo encode($listhotel['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
	    </div>
	
	<div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;"><?php echo getDestination($listhotel['cityId']); ?> &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp; <?php echo getDestination($listhotel['toCityId']); ?></div>
	<div style="font-size:12px;  margin-bottom:5px;"><?php if($listhotel['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-car" aria-hidden="true"></i></span> <?php echo stripslashes($vehicleData['name']); ?> (Pax: <?php echo stripslashes($vehicleData['pax']); ?>) <?php } ?><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?php echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?>  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> - <?php echo date('d-m-Y',strtotime($listhotel['checkOutDate'])); ?>  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;  margin-bottom:5px;"><span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo (stripslashes($listhotel['transportType'])); ?> &nbsp; | &nbsp; <?php if($listhotel['transportType']=='Private Cab'){ ?><span style="color:#999999;"><i class="fa fa-user" aria-hidden="true"></i></span> Driver &nbsp; | &nbsp; <?php } ?><span style="color:#999999;"><i class="fa fa-life-ring" aria-hidden="true"></i></span> <?php if($listhotel['transportType']=='Train'){ echo $listhotel['trainClass']; } else {  ?>AC<?php } ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-suitcase" aria-hidden="true"></i></span> Luggage Bags</div>
	
	
 <div style="font-size:12px;"><?php echo nl2br(stripslashes($listhotel['eventDetails'])); ?> <span>
 
  </span></div>
  
  
      <?php if($_REQUEST['qt']=='other'){ ?>
    <div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	<?php if($listhotel['showTaxDetails']==0){ ?>
	<div style="background-color:#9a2b50; padding: 5px 15px; color:#fff; margin-bottom:10px;"> 
	<div style="font-size:14px; font-weight:400; text-align:right;">Hide Tax and Markup Details</strong></div> 
	</div>
	<?php } ?><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;">
	<?php if($listhotel['transportType']!='Private Cab'){ ?>
<strong>Base Price:</strong> <?php echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant:
<?php } else { ?>
<strong>Number Of Vehicle:</strong> <?php echo $listhotel['noOfVehicle']; ?> -  <strong>Per Vehicle Price:</strong> <?php echo $listhotel['adultCost']; ?> <?php echo currencyname($listhotel['currencyId']); ?>:
<?php } ?>
	</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['quotationCost']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
     <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $listhotel['quotationMarkup']; ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  
 <?php if($listhotel['CGSTValue']>0){ $taxyes=1; ?>
   
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['CGSTValue']); ?>% <?php echo stripslashes($listhotel['CGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['CGSTamount']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  <?php } ?>
   <?php if($listhotel['SGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['SGSTValue']); ?>% <?php echo stripslashes($listhotel['SGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['SGSTamount']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  <?php } ?>
     <?php if($listhotel['IGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['IGSTValue']); ?>% <?php echo stripslashes($listhotel['IGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listhotel['IGSTamount']); ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>
  <?php } ?>
  <?php if($listhotel['TCSValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listhotel['TCSValue']); ?>% <?php echo stripslashes($listhotel['TCS']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $listhotel['TCSamount']; ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?></td>
  </tr>

   <?php } ?>
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($listhotel['perPerson']==0){ echo 'Per Person Price';} else { echo 'Total Price'; }?>:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($listhotel['perPerson']==1){ echo $listhotel['quotationCostWithTax']; } else { echo round($listhotel['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($listhotel['currencyId']); ?>
      <div style="color:#666666; font-size:11px; width:120px;"><?php if($taxyes==1){ ?>Include all taxes<?php } else { ?>Taxes are not included<?php } ?></div></td>
  </tr>
</table>

	</div>
  <?php } ?>
	</td>
  </tr>
</table>
</form>
</div>
<?php } ?> 

<?php } ?> 

<a style="cursor:pointer;" class="addbluebigbutton" onclick="loadpop('Add Transport',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtransportdetails&quotationid=<?php echo $_REQUEST['qid']; ?>&startdate=<?php echo $queryData['startDate']; ?>&qt=<?php echo $_REQUEST['qt']; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Transport </a>