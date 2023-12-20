<?php 
$packagetype=0;
if($_REQUEST['packagetype']!=''){
$packagetype=$_REQUEST['packagetype'];
}

?>

 <style>

.roomratelist{font-size: 11px;

    font-weight: 500;

    text-align: center;

    padding: 2px;

    background-color: #f1f1f1; margin-bottom:1px;

	}
	
	
	.table th { padding-left: 10px !important;}
</style>

	 



<div class="page-content pt-5"> 


		<!-- Main content -->

		<div class="content-wrapper"> 

	<div class="content">

		<div class="card">

			<div class="card-footer d-flex justify-content-between" style="position:relative;">

				<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-suitcase" aria-hidden="true"></i> &nbsp;Holidays Packages</span>
<a href="actionpage.php?action=additinerary&quotationtype=Detailed Package" target="actoinfrm"><button type="button" class="btn btn-primary btn-sm" style="position: absolute; right:8px ; top:8px; }">Add Package</button></a>
			</div>

			

				<div class="card-body">

			<form method="get" id="searchform">

				<div class="row">
					<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
					<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />

				<div class="col-xl-4">
					<div class="input-group">
					<input type="text" id="keyword" name="keyword" class="form-control" placeholder="Enter package name" value="<?php echo $_REQUEST['keyword']; ?>"  style="width:100px;"  >
					</div>
				</div>


				<div class="col-xl-3">
					<div class="input-group">
						  
						<span class="input-group-append">
						<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</span>
					</div>
				</div>
 
				</div>

			</form>										

		</div>

<div class="card-body">
<table class="table table-bordered table-striped" style=" font-size:13px;">

	<thead>

		<tr>

			<th width="5%" align="left"> </th>

			<th align="left">Name</th>

			<th align="left">Destination</th>

			<th>Nights / Days</th>

			<th align="left"><div align="center">Buying Cost</div></th>

			<th align="right"><div align="center">B2B Markup (INR)</div></th>
			<th align="right"><div align="center">B2C Markup (INR)</div></th>
			<th align="right">Status</th>
			<th align="right"><div align="center">Date</div></th>
			</tr>
	</thead>

	<tbody> 

	<?php 
	
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

 
 
$search='';

if($_REQUEST['keyword']!=''){
$search.=' and  (name like "%'.$_REQUEST['keyword'].'%" ) ';
}

 
$search.=' and agentId=0 ';
 


 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&packagetype='.$packagetype.'&';
$rs=GetRecordList('*','quotationMaster',' where  packageTheme>0 and queryId=0 and quotationType="Detailed Package" and (addBy="'.$LoginUserDetails['id'].'" or addBy="1") '.$search.'  order by id desc  ','20',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$ab=GetPageRecord('*','sys_quickPackageOptions',' quotationId="'.$rest['id'].'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id desc '); 
$optiondata=mysqli_fetch_array($ab);
 
$c=GetPageRecord('*','packageMarkup',' agentId=0 and packageId="'.$rest['id'].'"  order by id desc '); 
$packagemarkup=mysqli_fetch_array($c);

 //if($rest['packageTheme']>0){
?>




		<tr <?php if(getcityname($rest['destination'])=='' || $optiondata['perAdult']<1){?>style="background-color:#FDEAEC;"<?php  } ?>>

			<td width="5%" align="left" valign="top"><img src="<?php  echo $superadminurl.'upload/'.$rest['bannerImg'];  ?>" width="192%" height="41"  style="width:50px; height:40px;"  /></td>

			<td align="left" valign="top"><strong><?php echo stripslashes($rest['name']); ?></strong><div ><span style="color:#999999;">Theme:</span> <?php echo getpackagethemename($rest['packageTheme']); ?></div>
			
			<?php if($rest['showOnWebsite']==0){ ?>
	<div style="margin-top:4px; font-size:12px; color:#FF0000;">Disabled</div>
	<?php } ?>			</td>

			<td align="left" valign="top"><?php echo getcityname($rest['destination']); ?></td>

			<td align="left" valign="top"><div style="width:150px;"><?php echo ($rest['nights']); ?> <span style="color:#999999;">Nights:</span> / <?php echo ($rest['nights']+1); ?> <span style="color:#999999;">Days</span></div></td>

			<td align="right" valign="top"> 			 
			  <div align="center"><strong><?php echo $optiondata['perAdult']; ?> INR</strong> / PP</div></td>

								    <td align="right" valign="top"><div align="center"><input type="number" id="markup<?php echo encode($rest['id']); ?>" style="width:100px; text-align:center;" onkeyup="markupcalculations(<?php echo encode($rest['id']); ?>,'<?php echo $optiondata['perAdult']; ?>');" value="<?php echo $packagemarkup['markupValue']; ?>" /></div></td>
								    <td align="right" valign="top"><div align="center"><input type="number" id="markupb2c<?php echo encode($rest['id']); ?>" style="width:100px; text-align:center;" onkeyup="markupcalculations(<?php echo encode($rest['id']); ?>,'<?php echo $optiondata['perAdult']; ?>');" value="<?php echo $packagemarkup['markupb2c']; ?>" /></div></td>
								    <td align="right" valign="top"><?php if($rest['showOnWebsite']==1){ echo '<span class="badge bg-blue" style="background-color:#46cd93;">Active</span>'; } else { echo '<span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span>'; } ?></td>
								    <td align="right" valign="top"><div align="center"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></div></td>
								    <td align="right" valign="top"><div class="list-icons">
				  <div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">
															
<a style="cursor:pointer;"  class="dropdown-item"  onclick="loadpop('View Quotation - #QT<?php echo encode($rest['id']); ?>',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
									 

 
 									<?php if($rest['parentId']==$_SESSION['userid']){ ?>
							<?php if($packagetype==0){ ?>								
							<a href="display.html?ga=quotation&add=1&id=<?php echo  encode($rest['id']); ?>" class="dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
						  <?php } ?>
						  <?php } ?>
						 
						 
															<a href="https://wa.me/<?php if($rest['countryCode']==''){ echo '+91'; } else { echo $rest['countryCode']; } ?><?php echo stripslashes($rest['contactNumber']); ?>?text=Hi <?php if($rest['queryType']==1){ echo stripslashes($rest['nameHead'].' '.$rest['contactPerson']);  } else { echo stripslashes($rest['companyName']); } ?>, 
															
															<?php if($rest['quotationType']=='Quick Package'){ ?>Please click the link to view your itinerary.<?php } else { ?>Please click the link to view quotation.<?php } ?> <?php echo $fullurl.'quotationpreview/'.encode($rest['id']).'/'.seo_friendly_url($rest['name']); ?>" target="_blank" class="dropdown-item"><i class="fa fa-whatsapp" aria-hidden="true"></i> Share By WhatsApp</a>		
															
					 <a style="cursor:pointer;"  href="actionpage.php?action=addduplicateitinerary&id=<?php echo stripslashes($rest['id']); ?>" target="actoinfrm" class="dropdown-item" ><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>										
															
															
															
																	    </div>
				  </div>
			  </div></td>
	          </tr>

								

								<?php $sNo++;} ?>			 
							</tbody>
					  </table>
 
				 
				 <?php if($sNo==1){ ?>
				 <div class="card">			
				 <div style="padding:30px; text-align:center; color:#666666;">No Itinerary Found</div>
				 </div>
				 <?php }   ?>

				

		  </div>
<div class="card-footer text-right"> 
<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
<div class="pagingnumbers"><?php echo $paging; ?></div> 
</div>
		</div>
 
	</div>

</div>

</div>

<script>
function markupcalculations(id,price){ 
var markup = Number($('#markup'+id).val());
var markupb2c = Number($('#markupb2c'+id).val());
var price = Number(price);
$('#sellingprice'+id).text(Number(price+markup));
$('#footer_action_div').load('actionpage.php?action=packagemarkup&markup='+markup+'&packageId='+id+'&markupb2c='+markupb2c);
}
</script>