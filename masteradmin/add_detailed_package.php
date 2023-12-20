

<div class="card"> 
<div class="card-footer d-flex justify-content-between">
							<span class="text-muted" style="font-weight:500; color:#000000 !important;"> <?php if($quotationDetail['queryId']>0){ ?><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>">Quotation (#QT<?php echo encode($quotationDetail['id']); ?>)</a>  &nbsp;&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;  <?php } ?>Detailed Package</span>			</div>





<div class="card-body">

<div style="width:100%;" id="load_quotation_option"> 

 

 
</div>

<?php  
$queryId=$rest['id'];
$quotationId=$quotationDetail['id'];

$no=1;
$rs=GetPageRecord('*','sys_quickPackageOptions','  queryId="'.$queryId.'" and quotationId="'.$quotationId.'"   order by id asc');
while($optiondata=mysqli_fetch_array($rs)){ 
?> 
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;">

<span class="badge bg-blue" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" onclick="loadpop('Package Price Setting',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editdetailpackageoptionpeice&id=<?php echo encode($optiondata['id']); ?>&quotationid=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Price Setting</span>


<span class="badge bg-blue" style="background-color: #2196f3; position: absolute; right: 143px; top: 13px; font-size: 12px; cursor: pointer;"  onclick="loadpop('Edit Title / Banner / Itinerary',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="<?php if($quotationDetail['queryId']>0){ ?>action=editquickpackagetitle&id=<?php echo encode($quotationDetail['id']); ?>&package=detail<?php }else { ?>action=editinerary&id=<?php echo encode($quotationDetail['id']); ?>&package=detail<?php } ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Title / Banner / Itinerary</span>

							<span class="text-muted" style="font-weight:500; color:#000000 !important;">Package Title / Banner / Itinerary / Pricing</span>
				  </div>
							 
							 
							 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"> 
	<div style="padding:15px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="width:80px; height:60px; overflow:hidden; border:1px solid #fff; border-radius: 4px;"><img src="<?php if($quotationDetail['bannerImg']!=''){ echo 'upload/'.stripslashes($quotationDetail['bannerImg']); } else { ?>assets/nobannerblue.png<?php } ?>"  style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td width="90%" style="padding-left:10px; font-size:22px;"><?php echo stripslashes($quotationDetail['name']); ?>
	
	  <div style="font-size:12px;  margin-bottom:4px;"><?php if($quotationDetail['queryId']>0){ ?><span style="color:#999999;"><i class="fa fa-calendar" aria-hidden="true"></i> Start:</span> <?php echo date('d-m-Y',strtotime($quotationDetail['startDate'])); ?> &nbsp; - &nbsp; <span style="color:#999999;"><i class="fa fa-calendar" aria-hidden="true"></i> End:</span> <?php echo date('d-m-Y',strtotime($quotationDetail['endDate'])); ?> -   <?php } ?><?php echo ($quotationDetail['nights']); ?> <span style="color:#999999;">Nights:</span> / <?php echo ($quotationDetail['nights']+1); ?> <span style="color:#999999;">Days:</span> - <span style="color:#999999;">Theme:</span> <?php echo getpackagethemename($quotationDetail['packageTheme']); ?></div>
	
	<div style="font-size:12px; overflow:hidden;">

	<div style="float: left; padding: 3px 7px; color: #FFFFFF; background-color: #333333; border-radius: 2px; margin-right: 5px;"><?php echo getcityname($quotationDetail['destination']); ?></div>

	</div>	
	
	<div style="font-size:12px;  margin-top:10px;">
	<?php echo nl2br(stripslashes($quotationDetail['packageItinerary'])); ?>
	</div>
	
	</td>
    </tr>
</table>
	</div>
	 
	</td>
    <td width="28%" align="right" valign="bottom" style="background-color:#f7f7f7; border-left:1px solid #d8d8d8;" id="loaddetailpackagecost">
	
	</td>
  </tr>
</table>

<script>
function loaddetailpackagecost(){
$('#loaddetailpackagecost').load('loaddetailpackagecost.php?id=<?php echo $_REQUEST['id']; ?>&optionid=<?php echo encode($optiondata['id']); ?>');
}

loaddetailpackagecost();
</script>

</div>
</div>
<?php $no++; } ?>


<div style="text-align:center; font-size:18px; padding:10px; border-bottom:1px solid #ddd; margin-top:20px; margin-bottom:20px;  border-top:1px solid #ddd; background-color:#F0F0F0; "><i class="fa fa-list-ol" aria-hidden="true"></i> Package Itinerary</div>
<style>
.daywiseday{padding: 15px 15px; border:1px solid #ddd; border-top:0px; cursor:pointer; color:#000000;}
.daywiseday:hover{ background-color:#f9f9f9;}
.daywiseday .datebox{color: #000000; margin-top: 0px; font-size: 12px; font-weight: 500;}
.daytbactive{background-color: #26a69a !important; color: #fff !important;}
.daytbactive .datebox{color: #fff !important;}
</style>
<script>
function selectthisday(id,dayid,daydate){
$('.daywiseday').removeClass('daytbactive');
$('#day'+id).addClass('daytbactive'); 
$('#loaddaywisedetails').load('loaddaywisedetails.php?dayid='+dayid+'&daydate='+daydate+'&quotationid=<?php echo encode($quotationDetail['id']); ?>');
}

function selectthisdaydelete(id,dayid,daydate,did){
$('.daywiseday').removeClass('daytbactive');
$('#day'+id).addClass('daytbactive'); 
$('#loaddaywisedetails').load('loaddaywisedetails.php?dayid='+dayid+'&daydate='+daydate+'&quotationid=<?php echo encode($quotationDetail['id']); ?>&did='+did);
}

</script>

<div class="form-group">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div style="border:1px solid #d8d8d8;">
	<div class="card-footer d-flex justify-content-between" style="position:relative;">   
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;Itinerary Days</span>
</div> 
	</div>
	<?php $n=1; for ($x = 0; $x <= $quotationDetail['nights']; $x++) { ?>
<div class="daywiseday" id="day<?php echo $n; ?>" onclick="selectthisday(<?php echo $n; ?>,'<?php echo $n; ?>','<?php echo date('Y-m-d',strtotime($quotationDetail['startDate']. ' + '.$x.' days')); ?>');">
<div style="font-size:16px; font-weight:600;">Day <?php echo $n; ?></div>
<?php if($quotationDetail['dayWise']==0){ ?><div class="datebox"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('l, j M Y',strtotime($quotationDetail['startDate']. ' + '.$x.' days')); ?></div><?php } ?>
</div>



<?php
$a=GetPageRecord('*','packageDays',' quotationId="'.$quotationDetail['id'].'" and dayId="'.$n.'"'); 
$yesdata=mysqli_fetch_array($a);
if($yesdata['id']==''){

$namevalue ='parentId="'.$LoginUserDetails['parentId'].'",quotationId="'.$quotationDetail['id'].'",dayId="'.$n.'",dayDate="'.date('Y-m-d H:i:s',strtotime($quotationDetail['startDate']. ' + '.$x.' days')).'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('packageDays',$namevalue);  

} else {


$namevalue ='dayDate="'.date('Y-m-d H:i:s',strtotime($quotationDetail['startDate'])).'"'; 
$where='quotationId="'.$quotationDetail['id'].'" and dayId="'.$n.'"';   
updatelisting('packageDays',$namevalue,$where);  

}
?>

<?php $n++; } ?>
	</td>
    <td width="80%" align="left" valign="top" style=" padding-left:15px;">
	<div style="width:100%;" id="loaddaywisedetails"></div>
	
	</td>
  </tr>
</table>
<script>
selectthisday(1,'1','<?php echo date('Y-m-d',strtotime($quotationDetail['startDate'])); ?>');
</script>
</div>

<!-- Quotation Gallery-->
<hr />
<div class="form-group">
	<div style="border:1px solid #d8d8d8;">
		<div class="card-footer d-flex justify-content-between" style="position:relative;">
			<span class="badge bg-blue" style="background-color: #0cb5b5; position: absolute; right: 15px; font-size: 12px; cursor: pointer;" onclick="loadpop('Add Package Gallery',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addquotationgallery&quotationid=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Add Gallery</span>
			
				<span class="text-muted" style="font-weight:500; color:#000000 !important;">Add Package Gallery</span>
		</div>
							 						 
		<table width="100%" border="0" cellpadding="10" cellspacing="10">
			<thead>
				<th width="80%" align="left" valign="top">Image</th>
				<th width="20%" align="right" valign="top" style="text-align:right;">Actions</th>
			</thead>
			
<?php
$gallery=GetPageRecord('*','quotationGallery',' quotationId="'.$quotationDetail['id'].'" order by id asc');
while($galleryData=mysqli_fetch_array($gallery)){
?>
			<tr>
				<td><img src="<?php echo $fullurl."upload/".$galleryData["img"]; ?>" height="70" width="150"></td>
				<td align="right"><a onclick="return confirm('Are you sure?');" href="actionpage.php?action=deleteQuotationGallery&id=<?php echo encode($galleryData['id']); ?>&quotationId=<?php echo encode($quotationDetail['id']); ?>" style="margin-right:10px;"><button class="btn btn-danger btn-icon" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
			</tr>
<?php } ?>
			
		</table>
	</div>
</div>



<!--End-->
 

<?php $ha=GetPageRecord('*','quotationTerms','  quotationId="'.$quotationDetail['id'].'" order by id asc');
while($listdataterm=mysqli_fetch_array($ha)){ ?>
<hr />
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;">  

<span class="badge bg-blue" style="position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" onclick="loadpop('Edit <?php echo stripslashes($listdataterm['termType']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editpackageterms&id=<?php echo encode($listdataterm['id']); ?>&quotationid=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><?php echo stripslashes($listdataterm['termType']); ?></span>
</div>
    <div style="padding: 15px 15px;"><?php echo (stripslashes($listdataterm['termDescription'])); ?></div> 
</div>
</div>

<?php } ?>






</div>				
 	 
  
</div>

