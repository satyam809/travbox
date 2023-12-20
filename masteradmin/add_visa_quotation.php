<div class="card"> 
<div class="card-footer d-flex justify-content-between">
							<span class="text-muted" style="font-weight:500; color:#000000 !important;"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>">Quotation (#QT<?php echo encode($quotationDetail['id']); ?>)</a>  &nbsp;&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;  Visa Quotation</span>			</div>





<div class="card-body">

<div style="width:100%;" id="load_quotation_option">
<div class="form-group">
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;Quotation Title / Banner  / Terms</span>
				 </div>
	<div style="padding: 15px 15px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div style="width:80px; height:60px; overflow:hidden; border:1px solid #fff; border-radius: 4px;"><img src="<?php if($quotationDetail['bannerImg']!=''){ echo 'upload/'.stripslashes($quotationDetail['bannerImg']); } else { ?>assets/nobannerblue.png<?php } ?>"  style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td width="80%" style="padding-left:10px; font-size:22px;"><?php echo stripslashes($quotationDetail['name']); ?></td>
    <td width="20%" align="right" style="padding-left:10px; font-size:30px;"><button type="button" class="btn btn-primary" style="cursor:pointer;"  onclick="loadpop('Edit Title / Banner / Terms',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=saveotherquotation&id=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp; Edit Title / Banner / Terms</button></td>
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
<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-address-card-o" aria-hidden="true"></i> &nbsp;Visa</span>
</div>
    <div style="padding: 15px 15px;" id="loadquotationvisa"></div>
	<script>
	function loadquotationvisa(){
	$('#loadquotationvisa').load('loadquotationvisa.php?qid=<?php echo encode($quotationDetail['id']); ?>&qt=other'); 
	}	
	
	function deleteloadquotationvisa(id){
	$('#loadquotationvisa').load('loadquotationvisa.php?qid=<?php echo encode($quotationDetail['id']); ?>&qt=other&vdid='+id); 
	}		
	loadquotationvisa();
	</script>
				
</div>
</div>


<hr />



 
<div class="form-group">
<div style="border:1px solid #d8d8d8;">
<div class="card-footer d-flex justify-content-between" style="position:relative;">  

<span class="badge bg-blue" style="position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" onclick="loadpop('Edit Title / Banner / Terms',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=saveotherquotation&id=<?php echo encode($quotationDetail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>

<span class="text-muted" style="font-weight:500; color:#000000 !important;">Terms & Conditions</span>
</div>
   <?php if($quotationDetail['packageItinerary']!=''){ ?> <div style="padding: 15px 15px;"><?php echo (stripslashes($quotationDetail['packageItinerary'])); ?></div> <?php } else { ?>
   
   <div style="padding: 15px 15px; text-align:center; font-size:12px; color:#666666;">Terms & Conditions Not Added</div>
   <?php } ?>
</div>
</div>

</div>




</div>				






	
					 
  
</div>