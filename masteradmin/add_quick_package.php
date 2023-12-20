<div class="card"> 
<div class="card-footer d-flex justify-content-between">
							<span class="text-muted" style="font-weight:500; color:#000000 !important;"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>">Quotation (#QT<?php echo encode($quotationDetail['id']); ?>)</a>  &nbsp;&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;  Quick Package</span>			</div>





<div class="card-body">

<div style="width:100%;" id="load_quotation_option">
<div class="form-group">
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;Package Title / Banner / Itinerary</span>
				  </div>
	<div style="padding: 15px 15px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div style="width:80px; height:60px; overflow:hidden; border:1px solid #fff; border-radius: 4px;"><img src="<?php if($quotationDetail['bannerImg']!=''){ echo 'upload/'.stripslashes($quotationDetail['bannerImg']); } else { ?>assets/nobannerblue.png<?php } ?>"  style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td width="80%" style="padding-left:10px; font-size:22px;"><?php echo stripslashes($quotationDetail['name']); ?></td>
    <td width="20%" align="right" style="padding-left:10px; font-size:30px;"><button type="button" class="btn btn-primary" style="cursor:pointer;"  onclick="loadpop('Edit Title / Banner / Itinerary',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editquickpackagetitle&id=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp; Edit Title / Banner / Itinerary</button></td>
  </tr>
</table>

 
	</div>
	 
	
	
</div>
</div>
</div>

<hr />

<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-list-ol" aria-hidden="true"></i> Itinerary</span>
				  </div>
				
	 
	
		<div style="padding: 15px 15px;">
		<?php if($quotationDetail['packageItinerary']!=''){   echo stripslashes($quotationDetail['packageItinerary']);  } else { ?>
		<div style="text-align:center; font-size:14px; color:#666666; padding:30px 0px;">No Itinerary<div style="margin-top:5px;"><a href="#"  onclick="loadpop('Edit Title / Banner / Itinerary',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editquickpackagetitle&id=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Update Itinerary</a></div></div>
		
		<?php } ?>
 	</div>
	 
	
	
</div>
</div>

<hr />

<?php  
$queryId=$rest['id'];
$quotationId=$quotationDetail['id'];

$no=1;
$rs=GetPageRecord('*','sys_quickPackageOptions','  queryId="'.$queryId.'" and quotationId="'.$quotationId.'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');
while($optiondata=mysqli_fetch_array($rs)){ 
?> 
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;">

<span class="badge bg-blue" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" onclick="loadpop('Edit Option <?php echo $no; ?> Price',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editquickpackageoptionpeice&id=<?php echo encode($optiondata['id']); ?>&quotationid=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Price</span>

							<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i> &nbsp;Option <?php echo $no; ?></span>
				  </div>
							 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div style="padding:20px;" id="loadoptionhotel<?php echo encode($optiondata['id']); ?>"></div>
	
	<script>
	function loadloadoptionhotel<?php echo encode($optiondata['id']); ?>(){
	$('#loadoptionhotel<?php echo encode($optiondata['id']); ?>').load('loadoptionhotel.php?id=<?php echo encode($optiondata['id']); ?>&qid=<?php echo encode($quotationDetail['id']); ?>'); 
	}
	
	function loadloadoptionhoteldelete<?php echo encode($optiondata['id']); ?>(id){
	$('#loadoptionhotel<?php echo encode($optiondata['id']); ?>').load('loadoptionhotel.php?id=<?php echo encode($optiondata['id']); ?>&qid=<?php echo encode($quotationDetail['id']); ?>&did='+id); 
	}
	
	
	function deleteoptions<?php echo encode($optiondata['id']); ?>(id){
	$('#loadoptionhotel<?php echo encode($optiondata['id']); ?>').load('loadoptionhotel.php?id=<?php echo encode($optiondata['id']); ?>&qid=<?php echo encode($quotationDetail['id']); ?>&didoption='+id); 
	}
	
	loadloadoptionhotel<?php echo encode($optiondata['id']); ?>();
	</script>
	</td>
    <td width="28%" align="right" valign="bottom" style="background-color:#f7f7f7; border-left:1px solid #d8d8d8;">
	<?php
$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 
$branchData=mysqli_fetch_array($ab);


?>
	
	<div style="padding: 5px 15px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="66%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;">Price:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($optiondata['quotationCost']); ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
     <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;">Markup:</td>
    <td align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $optiondata['quotationMarkup']; ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
  
 <?php if($optiondata['CGSTValue']>0){ $taxyes=1; ?>
   
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($optiondata['CGSTValue']); ?>% <?php echo stripslashes($optiondata['CGST']); ?>:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($optiondata['CGSTamount']); ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
  <?php } ?>
   <?php if($optiondata['SGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($optiondata['SGSTValue']); ?>% <?php echo stripslashes($optiondata['SGST']); ?>:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($optiondata['SGSTamount']); ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
  <?php } ?>
     <?php if($optiondata['IGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($optiondata['IGSTValue']); ?>% <?php echo stripslashes($optiondata['IGST']); ?>:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($optiondata['IGSTamount']); ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>
  <?php } ?>
  <?php if($optiondata['TCSValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($optiondata['TCSValue']); ?>% <?php echo stripslashes($optiondata['TCS']); ?>:</td>
    <td width="40%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $optiondata['TCSamount']; ?>&nbsp;<?php echo currencyname($optiondata['currencyId']); ?></td>
  </tr>

   <?php } ?>
  
</table>

	</div>
	<?php if($optiondata['showTaxDetails']==0){ ?>
	<div style="background-color:#9a2b50; padding: 5px 15px; color:#fff;"> 
	<div style="font-size:14px; font-weight:400;">Hide Tax Details</strong></div> 
	</div>
	<?php } ?>
	
	<div style="background-color:#ec407a; padding: 5px 15px; padding-top:10px; color:#fff;">
	<div style="font-size:22px; font-weight:500; margin-bottom:0px;line-height: 22px;"><?php echo $optiondata['quotationCostWithTax']; ?> <?php echo currencyname($optiondata['currencyId']); ?></div>
	<div style="font-size:14px; font-weight:500; margin-bottom:5px;"><?php if($optiondata['perPerson']==0){ echo 'Per Person';} else { echo 'Total Cost'; }?></div>
	<div style="font-size:12px;"><?php if($taxyes==1){ ?>Include all taxes<?php } else { ?>Taxes are not included in this price<?php } ?></div>
	</div>
	<?php if($optiondata['perPerson']==0){ ?>
	<div style="background-color:#9a2b50; padding: 5px 15px; color:#fff;"> 
	<div style="font-size:14px; font-weight:400;">Total price wtih <?php echo ($rest['adult']+$rest['child']+$rest['infant']); ?> pax:<strong> <?php echo round($optiondata['quotationCostWithTax']*($rest['adult']+$rest['child']+$rest['infant'])); ?> <?php echo currencyname($optiondata['currencyId']); ?></strong></div> 
	</div>
	<?php } ?>
	</td>
  </tr>
</table>


</div>
</div>
<?php $no++; } ?>
<div class="form-group" style="text-align:right;">

<a href="actionpage.php?action=adnewoptioninquickquotation&quotationid=<?php echo encode($quotationDetail['id']); ?>&queryid=<?php echo encode($rest['id']); ?>" target="actoinfrm"><button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Option</button></a>
</div>

<hr />
 
 
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;Activities / Sightseeing</span>
				  </div>
				
	 
	
		<div style="padding: 15px 15px;" id="loadquotationsightseeing">
 	</div>
	
	
	<script>
		function loadquotationsightseeing(){
	$('#loadquotationsightseeing').load('loadquotationsightseeing.php?qid=<?php echo encode($quotationDetail['id']); ?>'); 
	}
	
	function deleteloadquotationsightseeing(id){
	$('#loadquotationsightseeing').load('loadquotationsightseeing.php?qid=<?php echo encode($quotationDetail['id']); ?>&sdid='+id); 
	}
	loadquotationsightseeing();
	
	</script>
</div>
</div>

<hr />




<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-car" aria-hidden="true"></i> &nbsp;Transport</span>
				  </div>
			<div style="padding: 15px 15px;" id="loadquotationtransport"></div>
	<script>
	function loadquotationtransport(){
	$('#loadquotationtransport').load('loadquotationtransport.php?qid=<?php echo encode($quotationDetail['id']); ?>'); 
	}	
	
	function deleteloadquotationtransport(id){
	$('#loadquotationtransport').load('loadquotationtransport.php?qid=<?php echo encode($quotationDetail['id']); ?>&tdid='+id); 
	}		
	loadquotationtransport();
	</script>
				
</div>
</div>
<hr />




<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-plane" aria-hidden="true"></i> &nbsp;Flight</span>
				  </div>
			<div style="padding: 15px 15px;" id="loadquotationflight"></div>
	<script>
	function loadquotationflight(){
	$('#loadquotationflight').load('loadquotationflight.php?qid=<?php echo encode($quotationDetail['id']); ?>'); 
	}	
	
	function deleteloadquotationflight(id){
	$('#loadquotationflight').load('loadquotationflight.php?qid=<?php echo encode($quotationDetail['id']); ?>&fdid='+id); 
	}		
	loadquotationflight();
	</script>
				
</div>
</div>

<hr />

<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-address-card-o" aria-hidden="true"></i> &nbsp;Visa</span>
</div>
    <div style="padding: 15px 15px;" id="loadquotationvisa"></div>
	<script>
	function loadquotationvisa(){
	$('#loadquotationvisa').load('loadquotationvisa.php?qid=<?php echo encode($quotationDetail['id']); ?>'); 
	}	
	
	function deleteloadquotationvisa(id){
	$('#loadquotationvisa').load('loadquotationvisa.php?qid=<?php echo encode($quotationDetail['id']); ?>&vdid='+id); 
	}		
	loadquotationvisa();
	</script>
				
</div>
</div>




<hr />

<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="icon-cube3" aria-hidden="true"></i> &nbsp;Miscellaneous</span>
</div>
    <div style="padding: 15px 15px;" id="loadquotationmiscellaneous"></div>
	<script>
	function loadquotationmiscellaneous(){
	$('#loadquotationmiscellaneous').load('loadquotationmiscellaneous.php?qid=<?php echo encode($quotationDetail['id']); ?>'); 
	}	
	
	function deleteloadquotationmiscellaneous(id){
	$('#loadquotationmiscellaneous').load('loadquotationmiscellaneous.php?qid=<?php echo encode($quotationDetail['id']); ?>&mdid='+id); 
	}		
	loadquotationmiscellaneous();
	</script>
				
</div>
</div>


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






	
					 
  
</div>