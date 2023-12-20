<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$id=decode($_REQUEST['id']);
$qid=decode($_REQUEST['qid']);

if($_REQUEST['did']!=''){ 
deleteRecord('quotationEvents','id="'.decode($_REQUEST['did']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}


if($_REQUEST['didoption']!=''){ 
deleteRecord('sys_quickPackageOptions','id="'.decode($_REQUEST['didoption']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
deleteRecord('quotationEvents','optionId="'.decode($_REQUEST['didoption']).'" and parentId="'.$LoginUserDetails['parentId'].'" and optionId!=0'); 

?>
<script>
location.reload();
</script>
<?php
}

$a=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and  optionId="'.$id.'" order by id asc '); 
$eventdata=mysqli_fetch_array($a);
 

$b=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$qid.'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

$c=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$quotationDetail['queryId'].'" order by id asc '); 
$queryData=mysqli_fetch_array($c);
?>


<?php if($eventdata['id']==''){ ?>
<div style="text-align:center; font-size:30px; color:#999999; padding:38px 0px;"><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i><div style="font-size:14px;"> No Hotel Added</div></div>
<?php } else { ?>

<?php   
$ha=GetPageRecord('*','quotationEvents',' optionId="'.$id.'" and quotationId="'.$qid.'" and parentId="'.$LoginUserDetails['parentId'].'" and eventType="hotel" order by id asc');
while($listhotel=mysqli_fetch_array($ha)){ 
?>
<div style="margin-bottom:10px; border:1px solid #ddd; padding:15px;">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm<?php echo $listhotel['id']; ?>" target="actoinfrm" id="addeditfrm<?php echo $listhotel['id']; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="width:140px; position:relative; height:110px; overflow:hidden; border:1px solid #ddd; margin-right:10px;"><img src="<?php if($listhotel['eventPhoto']!=''){ echo 'upload/'.stripslashes($listhotel['eventPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;"><span class="badge bg-blue" style="position:absolute; right:2px; top:2px; cursor:pointer;">Change</span>
	
	
	<input name="eventPhoto" onChange="$('#addeditfrm<?php echo $listhotel['id']; ?>').submit();" type="file" style="width:100%; height:100%; z-index:9; left:0px; top:0px; position:absolute;opacity: 0;">
	
	<input name="eventId" type="hidden" value="<?php echo encode($listhotel['id']); ?>">
	<input name="action" type="hidden" value="saveupdatehotelimageoption">
	<input name="cityId2" type="hidden" value="<?php echo $listhotel['cityId']; ?>">
	<input name="hotelname" type="hidden" value="<?php echo $listhotel['name']; ?>">
	<input name="optionid" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
	</div>
	</td>
    <td width="95%" align="left" valign="top" style="position:relative;">
	
	<div class="btn-group" style="position:absolute; right:0px; top:0px;"> 
 <button type="button" id="hoteladdbtn<?php echo encode($listhotel['id']); ?>" class="btn btn-light"  onclick="loadpop('Edit Hotel',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addoptionhotel&optionid=<?php echo $_REQUEST['id']; ?>&quotationid=<?php echo $_REQUEST['qid']; ?>&startdate=<?php echo $queryData['startDate']; ?>&enddate=<?php echo $queryData['endDate']; ?>&id=<?php echo encode($listhotel['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
 
 <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this hotel?')) loadloadoptionhoteldelete<?php echo encode($id); ?>('<?php echo encode($listhotel['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>  
									 
		  </div>
	
	<div style="font-size:15px; font-weight:500; margin-bottom:5px;line-height: 15px;"><?php echo stripslashes($listhotel['name']); ?> <span class="hotelcategorystar"><?php echo hotelcategory($listhotel['category']); ?></span></div>
	<div style="font-size:12px;  margin-bottom:2px;"><span style="color:#999999;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <?php echo getDestination($listhotel['cityId']); ?> &nbsp; | &nbsp; <span style="color:#999999;"><i class="fa fa-check" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['roomType']); ?> &nbsp; | &nbsp;  <span style="color:#999999;"><i class="fa fa-share-alt-square" aria-hidden="true"></i></span> <?php echo roomCategory($listhotel['roomCategory']); ?> Sharing   &nbsp; | &nbsp;  <span style="color:#999999;"><i class="fa fa-cutlery" aria-hidden="true"></i></span> <?php echo stripslashes($listhotel['mealPlan']); ?></div>
	
	<div style="font-size:12px;  margin-bottom:4px;"><span style="color:#999999;">Check-In:</span> <?php echo date('d-m-Y',strtotime($listhotel['checkInDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkInTime'])); ?> &nbsp; | &nbsp; <span style="color:#999999;">Check-Out:</span> <?php echo date('d-m-Y',strtotime($listhotel['checkOutDate'])); ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('h:i A',strtotime($listhotel['checkOutTime'])); ?></div>
	
	<div style="font-size:12px;"><?php echo stripslashes($listhotel['eventDetails']); ?></div>
	</td>
  </tr>
</table>
</form>

</div>
<?php } ?>


<?php } ?>

<a style="cursor:pointer;" id="hoteladdnewbtn<?php echo $_REQUEST['id']; ?>" class="addbluebigbutton" onclick="loadpop('Add Hotel',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addoptionhotel&optionid=<?php echo $_REQUEST['id']; ?>&quotationid=<?php echo $_REQUEST['qid']; ?>&startdate=<?php echo $queryData['startDate']; ?>&enddate=<?php echo $queryData['endDate']; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Hotel</a>