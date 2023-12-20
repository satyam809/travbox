<?php   
if($_REQUEST['id']!=''){ 
$select1='*';    
$where1='id="'.decode($_REQUEST['id']).'"';  
$rs1=GetPageRecord($select1,'cab_package_booking',$where1);   
$editresult=mysqli_fetch_array($rs1); 
}


?><div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Back</a></h4> 
			</div> 
		</div>
		
				
	</div>

<div class="page-content pt-0"> 
		
		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
				 
 
				
				<div class="card">
				<div class="card-header bg-light header-elements-inline">
						<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td align="left"><h5 class="card-title" >View Cab Booking</h5>
	</td>
    <td align="right"><a href="display.html?ga=cabbooking"><button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom:10px;">Back to booking list</button></a></td>
  </tr>
</table>

				  </div>
					
					<div class="card-body">
			 
					 
								  

	<form action="actionpage.php" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
 
			<div class="row"> 
				<div class="col-lg-6">
					<div class="row" style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">
						<div class="col-lg-12">
							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Basic Information</div>
						</div>

<div class="col-lg-12">	
	<div class="form-group">
		<label for="validationCustom02">Traveller Name <span class="redmtext">*</span></label>
		<input type="text" id="name" name="name" class="form-control" value="<?php echo stripslashes($editresult['name']); ?>">
	</div>
</div>

<div class="col-lg-12">	
	<div class="form-group">
		<label for="validationCustom02">Traveller Email <span class="redmtext">*</span></label>
		<input type="text" id="email" name="email" class="form-control" value="<?php echo stripslashes($editresult['email']); ?>">
	</div>
</div>

<div class="col-lg-12">	
	<div class="form-group">
		<label for="validationCustom02">Traveller Mobile <span class="redmtext">*</span></label>
		<input type="text" id="mobile" name="mobile" class="form-control" value="+91<?php echo stripslashes($editresult['mobile']); ?>">
	</div>
</div>

<div class="col-lg-12">	
	<div class="form-group">
		<label for="validationCustom02">Pickup Address</label>
		<textarea id="address" name="address" class="form-control" rows="4" readonly="readonly"><?php echo stripslashes($editresult['pickup_address']); ?></textarea>
	</div>
</div>
<div class="col-lg-12">	
	<div class="form-group">
		<label for="validationCustom02">Remark</label>
		<textarea id="address" name="address" class="form-control" rows="4" readonly="readonly"><?php echo stripslashes($editresult['remark']); ?></textarea>
	</div>
</div>


<div class="col-lg-12">
	<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Journey Info</div>
</div>
<div class="col-lg-12">	
	<table class="table table-hover mb-0">
		<tbody>
			<tr>
				<td>Package Info</td>
				<td><a href="<?php echo $fullurlweb.'confirm_booking.php?id='.encode($editresult["id"]); ?>" target="_blank">Click here</a></td>
			<tr>
			<tr>
				<td>Trip Type</td>
				<td><?php if($editresult['category']==1){echo "Local";} if($editresult['category']==2){echo "Airport Transfer";} if($editresult['category']==3){echo "Out Station";} ?>&nbsp;&nbsp;(<?php if($editresult['wayselection']==1){echo "One-way";} if($editresult['wayselection']==2){echo "Round-trip";}?>)</td>
			<tr>
			<tr>
				<td>From Location</td>
				<td><?php echo $editresult['fromlocation']; ?><br />Lattitute: <?php echo $editresult['fromlatitude']; ?><br />Longitude: <?php echo $editresult['fromlongitude']; ?></td>
			<tr>
			<tr>
				<td>To Location</td>
				<td><?php echo $editresult['tolocation']; ?><br />Lattitute: <?php echo $editresult['tolatitude']; ?><br />Longitude: <?php echo $editresult['tolongitude']; ?></td>
			<tr>
			<tr>
				<td>From Date</td>
				<td><?php echo date("d-m-Y", strtotime($editresult['fromdate']))." ".$editresult['fromtime']; ?></td>
			<tr>
			<?php if($editresult['todate']!=="1970-01-01" && $editresult['todate']!==" " && $editresult['todate']!=="0000-00-00"){ ?>
			<tr>
				<td>To Date</td>
				<td><?php echo date("d-m-Y", strtotime($editresult['todate']))." ".$editresult['fromtime']; ?></td>
			<tr>
			<?php } ?>
			<tr>
				<td>Estimated Distance</td>
				<td><?php echo $editresult['distance']; ?></td>
			<tr>
		</tbody>
	</table>
</div>


					</div>
				</div>
					
				<div class="col-lg-6">
					<div class="row" style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">

						<div class="col-lg-12">
							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Payment Information</div>
						</div>
<div class="col-lg-12">	

<table class="table table-hover mb-0">
		<tbody>
			<tr>
				<td>Number of days</td>
				<td><input readonly="readonly" type="number" id="numberofdays" name="numberofdays" class="form-control" value="<?php echo stripslashes($editresult['numberofdays']); ?>"></td>
			<tr>
		
			<tr>
				<td>Final Tariff Cost</td>
				<td><input readonly="readonly" type="number" id="final_base_tariff_cost" name="final_base_tariff_cost" class="form-control" value="<?php echo stripslashes($editresult['final_base_tariff_cost']); ?>"></td>
			<tr>
			
			<tr>
				<td>Final Driver Cost</td>
				<td><input readonly="readonly" type="number" id="final_base_driver_cost" name="final_base_driver_cost" class="form-control" value="<?php echo stripslashes($editresult['final_base_driver_cost']); ?>"></td>
			<tr>
			
			<tr>
				<td>Night Allowance</td>
				<td><input readonly="readonly" type="number" id="final_base_night_allowance_cost" name="final_base_night_allowance_cost" class="form-control" value="<?php echo stripslashes($editresult['final_base_night_allowance_cost']); ?>"></td>
			<tr>
		
			<tr>
				<td>Extra Hrs</td>
				<td><input readonly="readonly" type="number" id="extra_hrs" name="extra_hrs" class="form-control" value="<?php if($editresult['extra_hrs']>0){echo stripslashes($editresult['extra_hrs']);} ?>"></td>
			<tr>
			
			<tr>
				<td>Extra Hrs Cost</td>
				<td><input readonly="readonly" type="number" id="final_extra_hrs_charges" name="final_extra_hrs_charges" class="form-control" value="<?php if($editresult['final_extra_hrs_charges']>0){echo stripslashes($editresult['final_extra_hrs_charges']);} ?>"></td>
			<tr>
			
			<tr>
				<td>Extra Kms</td>
				<td><input readonly="readonly" type="number" id="extra_kms" name="extra_kms" class="form-control" value="<?php if($editresult['extra_kms']>0){echo stripslashes($editresult['extra_kms']);} ?>"></td>
			<tr>
			
			<tr>
				<td>Extra Kms Cost</td>
				<td><input readonly="readonly" type="number" id="final_extra_kms_charges" name="final_extra_kms_charges" class="form-control" value="<?php if($editresult['final_extra_kms_charges']>0){echo stripslashes($editresult['final_extra_kms_charges']);} ?>"></td>
			<tr>
			
			
			<tr>
				<td>Subtotal</td>
				<td><input readonly="readonly" type="number" id="subtotal" name="subtotal" class="form-control" value="<?php echo stripslashes($editresult['subtotal']); ?>"></td>
			<tr>
			<tr>
				<td>Tax%</td>
				<td><input readonly="readonly" type="number" id="tax" name="tax" class="form-control" value="<?php echo stripslashes($editresult['tax']); ?>"></td>
			<tr>
			<tr>
				<td>Including Tax</td>
				<td><input readonly="readonly" type="number" id="after_tax" name="after_tax" class="form-control" value="<?php echo stripslashes($editresult['after_tax']); ?>"></td>
			<tr>
			
			<tr>
				<td>Promo Code</td>
				<td><input readonly="readonly" type="text" id="promo_code" name="promo_code" class="form-control" value="<?php echo stripslashes($editresult['promo_code']); ?>"></td>
			<tr>
			
			<tr>
				<td>Discount</td>
				<td><input readonly="readonly" type="text" id="discount" name="discount" class="form-control" value="<?php echo stripslashes($editresult['discount']); ?>"></td>
			<tr>
			
			<tr>
				<td>Final Cost</td>
				<td><input readonly="readonly"type="number" id="final_charges" name="final_charges" class="form-control" value="<?php echo stripslashes($editresult['final_charges']); ?>"></td>
			<tr>
			
			<tr>
				<td>Payment Status</td>
				<td>
				<select name="payment_status" id="payment_status" class="form-control" onchange="sendMail(this.value);">
					<option value="0" <?php if($editresult['payment_status']=='0'){ ?>selected="selected"<?php } ?>>Pending</option>
					<option value="1" <?php if($editresult['payment_status']=='1'){ ?>selected="selected"<?php } ?>>Success</option>
					<option value="2" <?php if($editresult['payment_status']=='2'){ ?>selected="selected"<?php } ?>>Cancelled</option>
					<option value="3" <?php if($editresult['payment_status']=='3'){ ?>selected="selected"<?php } ?>>COD</option>
				</select>
				</td>
			<tr>
			
			<tr>
				<td>Booking Status</td>
				<td>
				<select name="booking_status" id="booking_status" class="form-control">
					<option value="0" <?php if($editresult['booking_status']=='0'){ ?>selected="selected"<?php } ?>>Pending</option>
					<option value="1" <?php if($editresult['booking_status']=='1'){ ?>selected="selected"<?php } ?>>Confirmed</option>
				</select>
				</td>
			<tr>
			
			<tr id="sendMail">
				<td>&nbsp;</td>
				<td><input type="checkbox" name="paymentLink" value="1">&nbsp;Send Payment Link</td>
			<tr>
		
		</tbody>
	</table>

<script>
function sendMail(id){
	if(id==0 || id==2){
		$("#sendMail").show();
	}else{
		$("#sendMail").hide();
	}
}
</script>
</div>
												
					</div>
				</div>
			</div>  
									
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
						<button type="submit" id="savingbutton" class="btn btn-secondary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" >Update</button>
                        <input autocomplete="false" name="action" type="hidden" id="action" value="add_cab_booking" />
						<input autocomplete="false" name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
					</div>
				</div>
			</div>
 
	</form>
 

	 
					</div>
					
				   
					
				</div>
	 
			  </form>
		  </div>
 




   