<?php 

include "inc.php"; 

include "config/logincheck.php";  

?>



<?php if($_REQUEST['action']=='copywidgetcode' && $_REQUEST['id']!=''){ 



$rs5=GetPageRecord('*','sys_queryWidget',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);

?>

<p class="font-weight-semibold">Copy and paste below code in body section where you want to  appear enquiry form</p>

<pre class="mb-3 language-javascript code-toolbar"><code class=" language-javascript"><span class="token comment">/* Website Widget */</span> 

<span class="token punctuation" style="color:#333333;">&lt;iframe frameborder="0" src="<?php echo $fullurl; ?>submitquery.html?id=<?php echo $_REQUEST['id']; ?>" style="width:<?php if($editresult['customWidth']<1){ echo '400'; } else { echo stripslashes($editresult['customWidth']); } ?>px; height:500px;">&lt;/iframe></span> </code> </pre>





<?php } ?>





<?php
	if($_REQUEST['action']=='addNewTransactionAll'){
?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row"> 

<div class="col-md-12"> 

	<div class="form-group">

		<label>Select Agent</label>

		<div style="height:0px; font-size:0px; position:relative;" id="searchagentlistsfromAgent"></div>

			<div class="input-group input-group-lg">  

				<input type="text" class="form-control" required  onkeyup="getSearchAgent('pickupAgentSearchfromAgent','pickupAgentfromAgent','searchagentlistsfromAgent');" id="pickupAgentSearchfromAgent" name="pickupCitySearchfromAgent123" value="" autocomplete="nope" >

				<input name="agentId" id="pickupAgentfromAgent" type="hidden" value="" autocomplete="nope" />

			</div>

	</div>

</div>


<div class="col-md-12"> 

<div class="form-group">

<label for="validationCustom02">Amount*</label>

  <input name="amount" type="number" class="form-control" id="name" value="" required="" >

</div></div>

 



 <div class="col-md-12" > 

<div class="form-group">

<label for="validationCustom02">Payment Type*</label>   

<select name="paymentType" id="paymentType"  class="form-control" onchange="debcre();" >

<option value="Credit" >Credit</option> 

</select>

</div></div>

  <script>
  	function debcre(){
		var paymentType = $('#paymentType').val();
		if(paymentType=='Debit'){ $('.dc').hide(); }else{ $('.dc').show(); }
	}
  </script>

  <div class="col-md-12 paid dc" > 

<div class="form-group">

<label for="validationCustom02">Payment Method*</label>   

<select name="paymentMethod" id="transectionType"  class="form-control" onchange="getreceipt();">

<option value="" >Select</option> 

<option value="Cash" >Cash</option> 

<option value="Credit" >Credit Limit</option> 

<option value="Cheque" >Cheque</option>

<option value="NEFT" >NEFT</option> 

<option value="Mobile&nbsp;Payment" >Mobile&nbsp;Payment</option> 

<option value="Payzapp" >Payzapp</option>   

<option value="Razorpay" >Razorpay</option>   

<option value="Paypal" >Paypal</option>   

<option value="Payu" >Payu</option>   

<option value="B2C" >B2C</option>    

</select>

</div></div>





<script>

function getreceipt(){

var transectionType = encodeURI($('#transectionType').val());

$('.shoonlycredit').hide();
 

if(transectionType=='Cash' || transectionType=='Credit'){
$('.receiptfield').show();
$('.trans').hide();
}else{
$('.receiptfield').hide();
$('.trans').show();
}

if(transectionType=='Credit'){
$('.shoonlycredit').show();
$('.receiptfield').hide();
}

}
</script>

							<div class="col-md-6 shoonlycredit" style="display:none;">
								<div class="form-group">
									<label>Credit From Date<span class="text-danger">*</span></label> 
									<input type="text" id="dt1" name="creditFromDate" class="form-control" placeholder="From Date" value="<?php if(date('Y',strtotime($editresult['creditFromDate']))>1970){ echo date("d-m-Y",strtotime($editresult['creditFromDate']));} else { echo date('d-m-Y'); } ?>"  readonly >
								</div>
							</div>
							
							<div class="col-md-6 shoonlycredit" style="display:none;">
								<div class="form-group">
								<label>Credit To Date<span class="text-danger">*</span></label>
								<input type="text" id="dt2" name="credittoDate" class="form-control" placeholder="To Date" value="<?php if(date('Y',strtotime($editresult['credittoDate']))>1970){ echo date("d-m-Y",strtotime($editresult['credittoDate']));} else { echo date('d-m-Y',strtotime(' + 1 Days')); } ?>"  readonly >
								</div>
							</div>
							
<script>

$(document).ready(function () {
    $("#dt1").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#dt2');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            //difference in days. 86400 seconds in day, 1000 ms in second
            var dateDiff = (dt2Date - minDate)/(86400 * 1000);

            //dt2 not set or dt1 date is greater than dt2 date
            if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', minDate);
            }
            //dt1 date is 30 days under dt2 date
            else if (dateDiff > 30){
                    dt2.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#dt2').datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,onSelect: function () { 
        }
    });
	
});
</script> 							




<div class="col-md-12 receiptfield dc" > 

<div class="form-group">

<label for="validationCustom02">Receipt</label>   

<input type="file" class="form-control" name="companyLogo" />

</div></div>



<div class="col-md-12 paid trans dc" style="display:none;" > 

<div class="form-group">

<label for="validationCustom02">Transaction ID</label>   

<input name="transactionId" type="text" class="form-control" value=" " required="" >

</div></div>



<div class="col-md-12"> 

<div class="form-group">

<label for="validationCustom02">Remark</label>

  <textarea name="remark" rows="2" class="form-control"></textarea>

</div></div>



</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addNewTransactionAll">  

				  </div>

</form>

<?php } ?>





<?php if($_REQUEST['action']=='addbannerb2c'){



$c=GetPageRecord('*','agentBannerMaster',' agentId=0 and id="'.decode($_REQUEST['id']).'"  order by id desc '); 

$res=mysqli_fetch_array($c);

 ?>



<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

				<div class="modal-body" >	

					<div class="col-md-12">

						<div class="row">

							<div class="col-md-12">

								<div class="form-group">

									<label>Banner Type</label> 

									<select name="bannerType" class="form-control" id="bannerType" autocomplete="off" >

									  <option value="flight" <?php if($res['bannerType']=='flight'){ ?>selected="selected"<?php } ?>>Search Box Bottom Flight</option>

									  <option value="hotel" <?php if($res['bannerType']=='hotel'){ ?>selected="selected"<?php } ?>>Search Box Bottom Hotel</option>

									  <option value="package" <?php if($res['bannerType']=='package'){ ?>selected="selected"<?php } ?>>Search Box Bottom Package</option>

									  <option value="weekend_gateway" <?php if($res['bannerType']=='weekend_gateway'){ ?>selected="selected"<?php } ?>>Weekend Gateway</option>

									  <option value="bus" <?php if($res['bannerType']=='bus'){ ?>selected="selected"<?php } ?>>Search Box Bottom Bus</option>

									  <option value="home" <?php if($res['bannerType']=='home'){ ?>selected="selected"<?php } ?>>Home Banner</option>

									  <option value="topup" <?php if($res['bannerType']=='topup'){ ?>selected="selected"<?php } ?>>Top Up Banner</option>

									  <option value="home_popup" <?php if($res['bannerType']=='home_popup'){ ?>selected="selected"<?php } ?>>Home Pop Up Banner</option>

									  <option value="login_popup" <?php if($res['bannerType']=='login_popup'){ ?>selected="selected"<?php } ?>>Login/Signup Banner</option>

									</select> 	

								</div> 

						   </div> 

							<div class="col-md-12">

								<div class="form-group">

									<label>Banner Title</label> 

									<input type="text" id="bannerTitle" name="bannerTitle" class="form-control" value="<?php echo stripslashes($res['bannerTitle']); ?>" >	

								</div> 

						   </div> 

							<div class="col-md-12">

								<div class="form-group">

									<label>Banner Image </label>  

								 <input name="img" type="file" class="form-control" id="img" style="padding: 4px;">

	

								</div> 

						   </div> 

							  

							  	<div class="col-md-12">

								<div class="form-group">

									<label>Banner URL</label> 

									<input type="text" id="bannerURL" name="bannerURL" class="form-control"  value="<?php echo stripslashes($res['bannerURL']); ?>" >	

								</div> 

						   </div> 

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Sequence</label> 

									<input type="number" id="sequence" name="sequence" class="form-control"  value="<?php echo stripslashes($res['sequence']); ?>" >	

								</div> 

						   </div> 

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Status</label> 

									<select name="status" class="form-control" id="status" autocomplete="off" >

									  <option value="1" <?php if($res['status']==1){ ?>selected="selected"<?php } ?>>Active</option>

									  <option value="0" <?php if($res['status']==0){ ?>selected="selected"<?php } ?>>Deactive</option>

									 

									</select>

								</div> 

						   </div>

						</div>

					</div>

					

								

				</div>

				

  </div><div class="card-footer text-right">

						 

								

						<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						<input name="action" type="hidden" id="action" value="addbannerb2c" />

						<input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $res['bannerImage']; ?>" /> 

						<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>" /> 

					</div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addvisab2c'){



$c=GetPageRecord('*','agentVisaMaster',' agentId=0 and id="'.decode($_REQUEST['id']).'"  order by id desc '); 

$res=mysqli_fetch_array($c);

?>



<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

				<div class="modal-body" >	

					<div class="col-md-12">

						<div class="row"> 

							<div class="col-md-12">

								<div class="form-group">

									<label>Visa Title</label> 

									<input type="text" id="title" name="title" class="form-control" value="<?php echo stripslashes($res['title']); ?>" >	

								</div> 

						   </div> 

							  

							  	<div class="col-md-12">

								<div class="form-group">

									<label>Visa URL</label> 

									<input type="text" id="url" name="url" class="form-control"  value="<?php echo stripslashes($res['url']); ?>" >	

								</div> 

						   </div> 

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Sequence</label> 

									<input type="number" id="sequence" name="sequence" class="form-control"  value="<?php echo stripslashes($res['sequence']); ?>" >	

								</div> 

						   </div> 

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Status</label> 

									<select name="status" class="form-control" id="status" autocomplete="off" >

									  <option value="1" <?php if($res['status']==1){ ?>selected="selected"<?php } ?>>Active</option>

									  <option value="0" <?php if($res['status']==0){ ?>selected="selected"<?php } ?>>Deactive</option>

									 

									</select>

								</div> 

						   </div>

						</div>

					</div>

					

								

				</div>

				

  </div><div class="card-footer text-right">

						 

								

						<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						<input name="action" type="hidden" id="action" value="addvisab2c" />

						<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>" /> 

					</div>

</form> 

<?php } ?>









<?php if($_REQUEST['action']=='editbookingtask' && $_REQUEST['id']!=''){





$rs5=GetPageRecord('*','sys_bookingSetting',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

						 <div class="col-md-12">

						<div class="form-group">

									<label>Task Name<span class="text-danger">*</span></label>

									<input name="taskName" type="text" class="form-control" id="taskName" value="<?php echo stripslashes($editresult['taskName']); ?>">

						   </div>

						   

						   <div class="form-group">

									<label>To be completed in<span class="text-danger">*</span></label>

									 <select name="taskDateAfter" class="form-control" id="taskDateAfter">

											<?php

											$sum = 0;

											for($i = 1; $i<=24; $i++) {

											?>

									   <option value="<?php echo $i; ?>" <?php if($editresult['taskDateAfter']==$i){ ?>selected="selected"<?php } ?>><?php echo $i; ?> hour(s)</option>

									   <?php } ?>

							 </select>

						   </div>

						   <div class="form-group">

									<label>Assign task to<span class="text-danger">*</span></label>

									 <select name="assignTo" class="form-control" id="assignTo">

									 <option value="0">Booking Owner</option>

										<?php  

										$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

										while($rest=mysqli_fetch_array($rs)){ 

										?> 

									   <option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['assignTo']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

									   <?php } ?>

							 </select>

						   </div>

						   

						   <div class="form-group">

									<label class="d-block font-weight-semibold">Status</label>

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="status" type="checkbox" class="custom-control-input" id="status" value="1" <?php if($editresult['status']==1){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="status">Active this stage</label>

										.

									</div>

						

						</div>

						</div> 

						

						

					</div>

					

		   </div>



								

								<div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savebookingtask">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

				  </div>

   </div>

</form>

<?php } ?>





<?php if($_REQUEST['action']=='topupUpdateStatus' && $_REQUEST['id']!=''){ ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

			 <div class="modal-body" >  

				<div class="form-group">

					<label>Select Status<span class="text-danger">*</span></label>

					<select name="status" class="form-control" id="status">

						<option value="pending">Pending</option>

						<option value="approved">Approved</option>

						<option value="cancelled">Cancelled</option>

					</select>

			   </div>

			 </div>

			 <div class="card-footer text-right" >

				<button type="submit" class="btn btn-primary">Change Status &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

				<input name="action" type="hidden" id="action" value="topupUpdateStatus">

				<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

			</div>

</form>

<?php } ?>





<?php if($_REQUEST['action']=='changequerystatus' && $_REQUEST['id']!='' && $_REQUEST['status']!='' && $_REQUEST['statusname']!=''){

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

			 <div class="modal-body" >  

			 <?php if($_REQUEST['statusname2']=='Cancelled' || $_REQUEST['statusname2']=='Lost'){ ?>

						<div class="form-group">

									<label>Query Closure Reasons<span class="text-danger">*</span></label>

									 <select name="closureReasons" class="form-control" id="closureReasons">

											<?php  

										$rs=GetPageRecord('*','sys_queryClosureReasons','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

										while($rest=mysqli_fetch_array($rs)){ 

										?> 

									   <option value="<?php echo stripslashes($rest['id']); ?>"><?php echo stripslashes($rest['name']); ?></option>

									   <?php } ?>

						  </select>

			   </div>

			   <?php } ?>

						<div class="form-group">

									<label>Comment</label>

									<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Write a comment..."></textarea>

			   </div>

						     

						 



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Change Query Status &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savechangequerystatus">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="status" type="hidden" id="status" value="<?php echo $_REQUEST['status']; ?>">

							    <input name="statusname" type="hidden" id="statusname" value="<?php echo $_REQUEST['statusname']; ?>">

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addquerynote' && $_REQUEST['id']!=''){

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

			 <div class="modal-body" >  

			 

						

						<div class="form-group"> 

									<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Enter Note"></textarea>

			   </div>

						     

						 



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savequerynote">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addquotation' && $_REQUEST['id']!=''){

 

 ?>

 <div class="modal-body" >  

 <div class="row row-tile no-gutters">

								<div class="col-3">

									<a href="actionpage.php?action=addquotation&quotationtype=Quick Package&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-briefcase icon-2x" style=" color:#f44336;"></i>

										<span>Quick Package</span>

									</button></a>



									<a href="actionpage.php?action=addquotation&quotationtype=Flight&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-airplane2 text-blue-400 icon-2x"></i>

										<span>Flight</span>

									</button></a>

								</div>

								

								<div class="col-3">

									<a href="actionpage.php?action=addquotation&quotationtype=Detailed Package&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-briefcase3 text-pink-400 icon-2x" style="color:#5c6bc0;"></i>

										<span>Detailed Package</span>

									</button></a>



									<a href="actionpage.php?action=addquotation&quotationtype=Sightseeing&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-images3 text-success-400 icon-2x"></i>

										<span>Sightseeing</span>

									</button></a>

								</div>

								<div class="col-3">

									<a href="actionpage.php?action=addquotation&quotationtype=Hotel&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-office text-pink-400 icon-2x"></i> 

										<span>Hotel</span>

									</button></a>

									

								<a href="actionpage.php?action=addquotation&quotationtype=Visa&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="fa fa-address-card-o" aria-hidden="true" style="font-size: 32px; color: #1a5769;"></i>

										<span>Visa</span>

									</button>

								  </a>

									

								</div>

								<div class="col-3">

									<a href="actionpage.php?action=addquotation&quotationtype=Transport&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-car text-pink-400 icon-2x" style=" color:#607d8b;"></i>

										<span>Transport</span>

									</button></a>



									 <a href="actionpage.php?action=addquotation&quotationtype=Miscellaneous&queryid=<?php echo $_REQUEST['id']; ?>" target="actoinfrm"><button type="button" class="btn btn-light btn-block btn-float m-0">

										<i class="icon-cube3 icon-2x"></i>

										<span>Miscellaneous</span>

									</button></a>

								</div>

   </div>

 </div> 

 

<?php } ?>















<?php if($_REQUEST['action']=='editquickpackageoptionpeice' && $_REQUEST['id']!='' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','sys_quickPackageOptions','id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);







$ab=GetPageRecord('*','sys_branchMaster',' id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

$branchData=mysqli_fetch_array($ab);

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-3">

						<div class="form-group">

									<label>Type<span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

				      </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Price<span class="text-danger">*</span></label>

									<input name="quotationCost" type="number" class="form-control" id="quotationCost" value="<?php echo stripslashes($editresult['quotationCost']); ?>">

						   </div> 

				      </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						   

						    <div class="col-md-12"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> 

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> 

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> 

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px;">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div> 

						

						

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							<button type="button" class="btn btn-danger" style="float:left;" data-dismiss="modal" onclick="if(confirm('Are you sure you want to delete this option?')) deleteoptions<?php echo $_REQUEST['id']; ?>('<?php echo $_REQUEST['id']; ?>');">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savequickpackageoptionpeice">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addoptionhotel' && $_REQUEST['optionid']!='' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','quotationEvents','id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" and optionId="'.decode($_REQUEST['optionid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 







$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('d-m-Y', strtotime($editresult['checkOutDate'])); 

}





if($_REQUEST['filledhotelid']!=''){

$a=GetPageRecord('*','hotelMaster','id="'.$_REQUEST['filledhotelid'].'" '); 

$editresult=mysqli_fetch_array($a);

}

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-6">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

									<div class="input-group input-group-lg">  

									<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo getDestination($editresult['cityId']); ?>" autocomplete="nope" >

														

														 <input name="travelFromCity" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['cityId']); ?>" autocomplete="nope" />

  

						  </div>

				      </div> 

				      </div>

						 <div class="col-md-6">

						<div class="form-group">

									<label>Hotel Category<span class="text-danger">*</span></label> 

									<select id="hotelCategory" name="hotelCategory" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','sys_hotelCategory',' 1 order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['category']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

				      </div>

						   

						   

						    <div class="col-md-8">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchHotel('name','nope','searchhotellist');"  >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Room Category<span class="text-danger">*</span></label>

									<select id="roomCategory" name="roomCategory" class="form-control select-clear"  autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','sys_roomCategory',' 1 order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['roomCategory']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Room Type <span class="text-danger">*</span></label>

									<input name="roomType" type="text" class="form-control" id="roomType" value="<?php echo stripslashes($editresult['roomType']); ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Meal Plan<span class="text-danger">*</span></label>

									<input name="mealPlan" type="text" class="form-control" id="mealPlan" value="<?php echo stripslashes($editresult['mealPlan']); ?>">

						   </div> 

						   </div>

						   

						   

						        <div class="col-md-6">

						<div class="form-group">

									<label>Check-In Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Check-Out Date<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				

				

				     <div class="col-md-6">

						<div class="form-group">

									<label>Check-In Time</label>

								 

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	<?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?> 

</select>

					   </div> 

				      </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Check-Out Time</label>

								<select  name="checkOutTime" class="form-control"  id="checkOutTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      





	<?php 

	if($editresult['checkOutTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkOutTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

</select>

									

									

									

						   </div> 

						   </div>

						     

						   

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Hotel</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" placeholder="Write here about hotel"><?php  echo stripslashes($editresult['eventDetails']); ?><?php  echo stripslashes($editresult['hotelDetails']); ?></textarea>

						   </div> 

						   </div> 

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventHotel">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">

							    <input name="optionid" type="hidden" id="optionid" value="<?php echo $_REQUEST['optionid']; ?>">

								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php echo $editresult['eventPhoto']; ?><?php echo $editresult['hotelPhoto']; ?>">

				  </div>

</form>

<?php } ?>



































<?php if($_REQUEST['action']=='addsightseeingdetails' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents','id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 }



$a=GetPageRecord('*','quotationMaster','id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster','id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);





$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate'])); 

}





if($_REQUEST['filledsightseeingid']!=''){

$a=GetPageRecord('*','sightseeingMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$_REQUEST['filledsightseeingid'].'" '); 

$editresult=mysqli_fetch_array($a);

}





 

 

 ?>

 

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">  

									  

														 

														 <select class="form-control" name="travelFromCity" id="pickupCityfromCity" data-fouc>

										

					<?php  

					if($_REQUEST['package']==1){ 

 $rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'" and id in ('.rtrim($quotationData['destination'],',').') and status=1  order by name asc');

					} else {

$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');

					}

					

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>"  <?php if($_REQUEST['cityIds']==$rest['id']) { ?>selected="selected"<?php } ?> <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

														 

  	<script>

 $(document).ready(function() {

    $('#pickupCityfromCity').select2({dropdownParent: $('.modal')}); 

});

</script>	

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-12">

						<div class="form-group">

									<label>Sightseeing / Activity Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchsightseeinglist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchSightseeing('name','nope','searchsightseeinglist');"  >

						   </div> 

						   </div>

						    

						     

						        <div class="col-md-4">

						<div class="form-group">

									<label>Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div> 

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 }); 

				} );

				</script>

				

				

				     <div class="col-md-4">

						<div class="form-group">

									<label>Duration</label>

									<input name="eventDuration" type="text" class="form-control" id="eventDuration" value="<?php  if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDuration']);  } else {  ?><?php echo stripslashes($editresult['sectionDuration']); }  ?>">

					   </div> 

				      </div>

						    

							

							<div class="col-md-4">

						<div class="form-group">

									<label>Start Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

									

			<script>

 $(document).ready(function() {

    $('#checkInTime').select2({dropdownParent: $('.modal')}); 

});

</script>							

						   </div> 

						   </div>

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails"  ><?php if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDetails']); } else {  ?><?php  echo stripslashes($editresult['sectionDetails']); } ?></textarea>

						   </div> 

						   </div> 

						   

						   

						   

						   

						    <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 	 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

				      </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

				      </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						              <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventSightseeing">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

							    <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>"> 

								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php if($_REQUEST['filledsightseeingid']==''){ echo $editresult['eventPhoto']; } else { ?><?php echo $editresult['sectionPhoto']; } ?>">

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addtransportdetails' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 }



$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['startdate']));

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('d-m-Y', strtotime($editresult['checkOutDate'])); 

} 

 ?>

 

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Transport Type<span class="text-danger">*</span></label> 

						 <select id="transportType" name="transportType" class="form-control select-clear" autocomplete="off" onchange="funtrainclass();checkvehicletype();" > 

						<?php   

						$rs=GetPageRecord('*','sys_transferType',' 1 order by id asc');

						while($rest=mysqli_fetch_array($rs)){ 

						?>

						<option value="<?php echo $rest['name']; ?>" <?php if($rest['name']==$editresult['transportType']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

						<?php }  ?>

						</select>

				      </div> 

				      </div>

						   

					<div class="col-md-12 privatetransfer">

						<div class="form-group">

									<label>Vehicle</label> 

						 <select id="vehicleId" name="vehicleId" class="form-control" autocomplete="off"   > 

						<?php   

						$rs=GetPageRecord('*','sys_vehicleMaster',' parentId="'.$LoginUserDetails['parentId'].'"  order by id asc');

						while($rest=mysqli_fetch_array($rs)){ 

						?>

						<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['vehicleId']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?> (Pax: <?php echo stripslashes($rest['pax']); ?>)</option>

						<?php }  ?>

						</select>

				      </div> 

				      </div>

					<div class="col-md-4">

						<div class="form-group">

									<label>From Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

				      </div> 

				      </div>

						   

					<div class="col-md-4">

						<div class="form-group">

									<label>From City<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

									<div class="input-group input-group-lg">  

									<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo getDestination($editresult['cityId']); ?>" autocomplete="nope" >

														

														 <input name="travelFromCity" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['cityId']); ?>" autocomplete="nope" />

  

						  </div>

				      </div> 

				      </div>

						  

						   <div class="col-md-4">

						<div class="form-group">

									<label>Start Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?> 

</select>

									

			<script>

 $(document).ready(function() {

    $('#checkInTime').select2({dropdownParent: $('.modal')}); 

});

</script>							

						   </div> 

						   </div>

						   

						 	<div class="col-md-4">

						<div class="form-group">

									<label>To Date<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>  

						   

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>To City<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcityliststoCity"></div>

									<div class="input-group input-group-lg"> 

									

									<select class="form-control" name="pickupCitytoCity" id="pickupCitytoCity" data-fouc>

										

					<?php  

				$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');

					

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

 <option value="<?php echo stripslashes($rest['id']); ?>"  <?php if($editresult['toCityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

									

								<script>

 $(document).ready(function() {

    $('#pickupCitytoCity').select2({dropdownParent: $('.modal')}); 

});

</script>	

									

 </div>

						   </div> 

						   </div>

						    

						   	     

						   

						   

						     <div class="col-md-4">

						<div class="form-group">

									<label>End Time</label>

									  

									

										<select  name="checkOutTime" class="form-control"  id="checkOutTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	<?php 

	if($editresult['checkOutTime']!=''){  

	$selectedtime=date('Y-m-d H:i:s',strtotime($editresult['checkOutTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if($selectedtime==$newthisday){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?> 

</select>

									

			<script>

 $(document).ready(function() {

    $('#checkOutTime').select2({dropdownParent: $('.modal')}); 

});

</script>		

						   </div> 

						   </div>

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				

				function funtrainclass(){

				var transportType = $('#transportType').val();

				if(transportType=='Train'){

				$('#trainclass').show();

				} else {

				$('#trainclass').hide();

				}

				}

				

				

				function checkvehicletype(){

				var transportType = $('#transportType').val();

				

				if(transportType=='Private Cab'){

				$('.privatetransfer').show();

				$('.sic').hide();

				$('#infantCost').val('0');

				$('#childCost').val('0');

				$('#adultCost').val('0');

				} else {

				$('.privatetransfer').hide(); 

				$('.sic').show(); 

				$('#noOfVehicle').val('0');

				$('#perVehiclePrice').val('0');

				}

				}

				checkvehicletype();

				</script>

				 

						   

						   <div class="col-md-12"  id="trainclass" <?php if($editresult['transportType']!='Train'){ ?>style="display:none;"<?php } ?>>

						<div class="form-group">

									<label>Class</label> 

						 <select id="trainClass" name="trainClass" class="form-control select-clear" autocomplete="off" > 

						<?php   

						$rs=GetPageRecord('*','sys_trainClass',' 1 order by id asc');

						while($rest=mysqli_fetch_array($rs)){ 

						?>

						<option value="<?php echo $rest['name']; ?>" <?php if($rest['name']==$editresult['trainClass']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

						<?php }  ?>

						</select>

						   </div> 

						   </div>

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" ><?php  echo stripslashes($editresult['eventDetails']);  ?></textarea>

						   </div> 

						   </div> 

						   

						   

						   

						   

						   

						   

						   

						   

						   

						   <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

                       <?php if($_REQUEST['package']!=1){ ?><option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option> <?php } ?>

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

				      </div>

						   	 <div class="col-md-3 privatetransfer">

						<div class="form-group">

									<label>Number Of Vehicle <span class="text-danger">*</span></label>

									<input name="noOfVehicle" type="number"  class="form-control" id="noOfVehicle" value="<?php echo stripslashes($editresult['noOfVehicle']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3 privatetransfer">

						<div class="form-group">

									<label>Per Vehicle Price <span class="text-danger">*</span></label>

									<input name="perVehiclePrice" type="number"  class="form-control" id="perVehiclePrice" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

						   </div>

						   

						   

						 <div class="col-md-3 sic"  style="display:none;">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

				      </div>

						   

						   <div class="col-md-3 sic"  style="display:none;">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3 sic"  style="display:none;">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						    <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						       

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group hideinpackage"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventTransport">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

								  <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>">

								 

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='addflightdetails' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

}

$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);

 







$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['startdate']));

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('d-m-Y', strtotime($editresult['checkOutDate'])); 

} 

 ?>

 

 

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Trip Type<span class="text-danger">*</span></label> 

						 <select id="flightTripType" name="flightTripType" class="form-control select-clear" autocomplete="off" onchange="funtrainclass();" >  

						<option value="One Way" <?php if('One Way'==$editresult['flightTripType']){ ?>selected="selected"<?php } ?>>One Way</option> 

						<option value="Round Trip" <?php if('Round Trip'==$editresult['flightTripType']){ ?>selected="selected"<?php } ?>>Round Trip</option> 

						</select>

				      </div> 

				      </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>From City<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

									<div class="input-group input-group-lg">  

									<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo getDestination($editresult['cityId']); ?>" autocomplete="nope" >

														

														 <input name="travelFromCity" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['cityId']); ?>" autocomplete="nope" />

  

						  </div>

						   </div> 

						   </div>

					 

					

						  <div class="col-md-6">

						<div class="form-group">

									<label>To City<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcityliststoCity"></div>

									<div class="input-group input-group-lg">  

									<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchtoCity','pickupCitytoCity','searchcityliststoCity');" id="pickupCitySearchtoCity" name="pickupCitySearchfromCity123" value="<?php echo getDestination($editresult['toCityId']); ?>" autocomplete="nope" >

														

														 <input name="pickupCitytoCity" id="pickupCitytoCity" type="hidden" value="<?php echo stripslashes($editresult['toCityId']); ?>" autocomplete="nope" />

  

						  </div>

						   </div> 

				      </div>

						   

						   

						      <div class="col-md-7">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label>

									<div style="height:0px; font-size:0px; position:relative;" id="searchflightlist"></div> 

									<input name="name" type="text" class="form-control" id="flightName" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchFlight('flightName','nope','searchflightlist');">

						   </div> 

						   </div>

						   

						   <div class="col-md-5">

						<div class="form-group">

									<label>Class</label> 

						 <select id="trainClass" name="trainClass" class="form-control select-clear" autocomplete="off" >  

						<option value="Economy Class" <?php if('Economy Class'==$editresult['trainClass']){ ?>selected="selected"<?php } ?>>Economy</option> 

						<option value="Premium Economy Class" <?php if('Premium Economy Class'==$editresult['trainClass']){ ?>selected="selected"<?php } ?>>Premium Economy</option> 

						<option value="Business Class" <?php if('Business Class'==$editresult['trainClass']){ ?>selected="selected"<?php } ?>>Business</option> 

						<option value="First Class" <?php if('First Class'==$editresult['trainClass']){ ?>selected="selected"<?php } ?>>First Class</option> 

						</select>

						   </div> 

						   </div>

						   

						    <div class="row" style="width: 100%; border: aliceblue; margin-left: 0px; margin-bottom: 20px; padding-top: 10px; background-color: #f1f1f1; border-radius: 4px;">

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Departure Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Flight Via<span class="text-danger">*</span></label>

									<input name="viaFlightDeparture" type="text" class="form-control" placeholder="eg: 1 stop via Ranchi" id="viaFlightDeparture" value="<?php echo stripslashes($editresult['viaFlightDeparture']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label> From Time<span class="text-danger">*</span></label>

								<select  name="fromDepartureFlightTime" class="form-control"  id="fromDepartureFlightTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['fromDepartureFlightTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['fromDepartureFlightTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

	

	

	

	

</select>

									

									

									

						   </div> 

						   </div>

						   

						         <div class="col-md-4">

						<div class="form-group">

									<label> To Time<span class="text-danger">*</span></label>

									 

									

									<select  name="toDepartureFlightTime" class="form-control"  id="toDepartureFlightTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	 

	

	<?php 

	if($editresult['toDepartureFlightTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['toDepartureFlightTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

</select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Departure Hour<span class="text-danger">*</span></label>

									<input name="departureFlightHour" type="text" class="form-control" placeholder="eg: 2 Hours" id="departureFlightHour" value="<?php echo stripslashes($editresult['departureFlightHour']); ?>">

						   </div> 

						   </div>

						   </div>

						      

						   <div class="row trainclass" style=" <?php if('Round Trip'!=$editresult['flightTripType']){ ?>display:none;<?php } ?> width: 100%; border: aliceblue; margin-left: 0px; margin-bottom: 20px; padding-top: 10px; background-color: #f1f1f1; border-radius: 4px;">

						   

						 	<div class="col-md-6">

						<div class="form-group">

									<label>Return Date</label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>  

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Return Flight Via<span class="text-danger">*</span></label>

									<input name="viaFlightReturn" type="text" class="form-control" placeholder="eg: 1 stop via Ranchi" id="viaFlightReturn" value="<?php echo stripslashes($editresult['viaFlightReturn']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Return From Time<span class="text-danger">*</span></label>

									 

									

									

									

									<select  name="fromReturnFlightTime" class="form-control"  id="fromReturnFlightTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	 

	

	

	

	

	<?php 

	if($editresult['fromReturnFlightTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['fromReturnFlightTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

						   </div> 

						   </div>

						   

						         <div class="col-md-4">

						<div class="form-group">

									<label>Return To Time<span class="text-danger">*</span></label>

									 

									

									<select  name="toReturnFlightTime" class="form-control"  id="toReturnFlightTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>       

	

	

	<?php 

	if($editresult['toReturnFlightTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['toReturnFlightTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

</select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Return Hour<span class="text-danger">*</span></label>

									<input name="returnFlightHour" type="text" class="form-control" placeholder="eg: 2 Hours" id="returnFlightHour" value="<?php echo stripslashes($editresult['returnFlightHour']); ?>">

						   </div> 

						   </div>

						   

						   

						   </div>

						   

						    

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 }); 

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 }); 

				} );

				

				function funtrainclass(){

				var transportType = $('#flightTripType').val();

				if(transportType=='Round Trip'){

				$('.trainclass').show();

				} else {

				$('.trainclass').hide();

				}

				}

				</script>

				 

						   

						    

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" ><?php  echo stripslashes($editresult['eventDetails']);  ?></textarea>

						   </div> 

						   </div> 

						

						

						   <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

				      </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

				      </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   		    <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						       

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

					</div>

					

		   </div>



								

								

  </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventFlight">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

								 <input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php echo $editresult['eventPhoto'];  ?>">

								  <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>">

				  </div>

</form>

<?php } ?>













<?php if($_REQUEST['action']=='addvisadetails' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 }



$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['startdate']));

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('d-m-Y', strtotime($editresult['checkOutDate'])); 

} 

 ?>

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									<input name="name" type="text"  class="form-control" id="name" placeholder="eg: Tourist visa 30 days" value="<?php echo stripslashes($editresult['name']); ?>">

				      </div> 

				      </div>

					

					<div class="col-md-6">

						<div class="form-group">

									<label>Country<span class="text-danger">*</span></label> 

						 <select id="country" name="country" class="form-control"  data-placeholder="Select Country"  autocomplete="off" >  

											<option></option>  

 <?php  

$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?> 

<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['country']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  

 <?php } ?>

</select>

				      </div> 

				      </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Visa Category<span class="text-danger">*</span></label> 

						 <select id="visaCategory" name="visaCategory" class="form-control"  data-placeholder="Visa Category"  autocomplete="off" >   

 <?php  

$rs=GetPageRecord('*','sys_visaCategory','  1  order by id desc');

while($rest=mysqli_fetch_array($rs)){ 

?> 

<option value="<?php echo $rest['name']; ?>" <?php if($rest['name']==$editresult['visaCategory']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  

 <?php } ?>

</select>

				      </div> 

						   </div>

						   

						     

						   

						      <div class="col-md-4">

						<div class="form-group">

									<label>Adult<span class="text-danger">*</span></label> 

									<input name="adult" type="number" min="1" class="form-control" id="adult" value="<?php echo stripslashes($editresult['adult']); ?>"  >

						   </div> 

						   </div>

						   

						      <div class="col-md-4">

						<div class="form-group">

									<label>Child</label> 

									<input name="child" type="number" min="0" class="form-control" id="child" value="<?php echo stripslashes($editresult['child']); ?>"  >

						   </div> 

						   </div>

						   

						      <div class="col-md-4">

						<div class="form-group">

									<label>Infant</label> 

									<input name="infant" type="number" min="0" class="form-control" id="infant" value="<?php echo stripslashes($editresult['infant']); ?>"  >

						   </div> 

						   </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Entry Type</label> 

						 <select id="entryType" name="entryType" class="form-control select-clear" autocomplete="off" >  

						<option value="Single-entry visa" <?php if('Single-entry visa'==$editresult['entryType']){ ?>selected="selected"<?php } ?>>Single-entry visa</option> 

						<option value="Double-entry visa" <?php if('Double-entry visa'==$editresult['entryType']){ ?>selected="selected"<?php } ?>>Double-entry visa</option> 

						<option value="Multiple-entry visa" <?php if('Multiple-entry visa'==$editresult['entryType']){ ?>selected="selected"<?php } ?>>Multiple-entry visa</option>  

						</select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Travel Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Validity (Days)<span class="text-danger">*</span></label>

									<input name="visaValidity" type="number" min="1" class="form-control" id="visaValidity" placeholder="eg: 30" value="<?php echo stripslashes($editresult['visaValidity']); ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Nationality<span class="text-danger">*</span></label>

									<select id="nationality" name="nationality" class="form-control"  data-placeholder="Select Country"  autocomplete="off" >  

											<option></option>  

 <?php  

$rs=GetPageRecord('*','sys_nationalityMaster',' 1  order by nationality asc');

while($rest=mysqli_fetch_array($rs)){ 

?> 

<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['nationality']){ ?>selected="selected"<?php } ?>><?php echo $rest['nationality']; ?></option>  

 <?php } ?>

</select>

						   </div> 

						   </div> 

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				 

				</script>

				 

						   

						    

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" ><?php  echo stripslashes($editresult['eventDetails']);  ?></textarea>

						   </div> 

						   </div> 

						

						<?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price <span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

                      <?php if($_REQUEST['package']!=1){ ?> <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option> <?php } ?>

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

				      </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

				      </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						       

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none;">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventVisa">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

								 <input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php echo $editresult['eventPhoto'];  ?>">

								 <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId'];  ?>">

				  </div>

</form>

 

 

 <script>

 $(document).ready(function() {

    $('#country').select2({dropdownParent: $('.modal')});

    $('#nationality').select2({dropdownParent: $('.modal')});

});

 </script>

<?php } ?>





















<?php if($_REQUEST['action']=='editquickpackagetitle' && $_REQUEST['id']!=''){





$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.($editresult['queryId']).'" '); 

$queryData=mysqli_fetch_array($a);

 

 ?>

 

<script>

 $(document).ready(function() {

    $('#destination').select2({dropdownParent: $('.modal'), tags: true, tokenSeparators: [',', ' ']}); 

});

</script>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					 <div class="col-md-6">

						<div class="form-group">

									<label>Package Title<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" maxlength="255">

					   </div> 

				      </div> 

						

						<div class="col-md-6">

						<div class="form-group">

									<label>Package Banner</label>

									<input name="packagebanner" type="file" class="form-control" id="packagebanner" style="padding: 4px;">

					      </div> 

				      </div>

						   

						   <?php if($_REQUEST['package']!='detail'){ ?>

						   <div class="col-md-12">

						<div class="form-group">

									<label>Package Itinerary</label>

									 <textarea name="packageItinerary" rows="3" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('packageItinerary'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

						   </div> 

						   </div>

						   <?php } else {?>

						   

						   

						   

						   

						      

						        <div class="col-md-2">

						<div class="form-group">

									<label>Start Date<span class="text-danger">*</span></label>

									<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo date('d-m-Y',strtotime($editresult['startDate'])); ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-2">

						<div class="form-group">

									<label>End Date<span class="text-danger">*</span></label>

									<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo date('d-m-Y',strtotime($editresult['endDate'])); ?>">

						   </div> 

						   </div>

						   

						   

						   	 <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Adult</label>

									<input name="adult" type="number" min="1" class="form-control" id="adult" readonly="readonly" value="<?php echo stripslashes($queryData['adult']); ?>">

						   </div> 

						   </div>

						   

						    <div class="col-md-1"  style="display:none;">

						<div class="form-group">

									<label>Child</label>

									<input name="child" type="number" min="0" class="form-control" id="child" readonly="readonly" value="<?php echo stripslashes($queryData['child']); ?>">

						   </div> 

						   </div>

						   

						    <div class="col-md-1"  style="display:none;">

						<div class="form-group">

									<label>Infant</label>

									<input name="infant" type="number" min="0" class="form-control" id="infant" readonly="readonly" value="<?php echo stripslashes($queryData['infant']); ?>">

						   </div> 

						   </div>

						   

					 <div class="col-md-4">

						<div class="form-group">

									<label>Package Theme</label>

									<select name="packageTheme" class="form-control" id="packageTheme">

	<?php  

	$rs=GetPageRecord('*','sys_packageTheme','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

	while($rest=mysqli_fetch_array($rs)){ 

	?> 

	<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($rest['id']==$editresult['packageTheme']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

	<?php } ?>

						  </select>

					   </div> 

				      </div>

						   

						    <div class="col-md-12">

						<div class="form-group">

									<label>Select Destinations (Multiselect)</label>

										<select class="form-control" multiple="multiple" name="destination[]" id="destination" data-fouc>

										

					<?php  

					$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					

					$HiddenProducts = explode(',',$editresult['destination']);

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if (in_array($rest['id'], $HiddenProducts)) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

						   </div> 

						   </div>

						  <script>









				$( function() {

				$( "#startDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#endDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				</script>

				

						   

						   

						   <?php  } ?>

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							 	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="<?php if($_REQUEST['package']=='detail'){ echo 'savedetailpackageotitle'; } else { ?>savequickpackageotitle<?php } ?>">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

							    <input name="bannerImg" type="hidden" id="bannerImg" value="<?php echo $editresult['bannerImg']; ?>"> 

				  </div>

</form>

<?php } ?>















<?php if($_REQUEST['action']=='addmiscellaneousdetails' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 }





$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['startdate']));

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('d-m-Y', strtotime($editresult['checkOutDate'])); 

} 

 ?>

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									<input name="name" type="text"  class="form-control" id="name"   value="<?php echo stripslashes($editresult['name']); ?>">

				      </div> 

				      </div>

					

					 

						   

						    

						   

			  

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-6">

						<div class="form-group">

									<label>Start Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 

	

	

	<?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

</select>

									

			<script>

 $(document).ready(function() {

    $('#checkInTime').select2({dropdownParent: $('.modal')}); 

});

</script>							

						   </div> 

						   </div>

						   

						   

						     

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });  

				} );

				 

				</script>

				 

						   

						    

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" ><?php  echo stripslashes($editresult['eventDetails']);  ?></textarea>

						   </div> 

						   </div> 

						   

						   

						     <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

                      <?php if($_REQUEST['package']!=1){ ?> <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option> <?php } ?>

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

				      </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

				      </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   		    <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						       

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventMiscellaneous">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">  

				   <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId'];  ?>"></div>

</form>

 

 

 <script>

 $(document).ready(function() {

    $('#country').select2({dropdownParent: $('.modal')});

    $('#nationality').select2({dropdownParent: $('.modal')});

});

 </script>

<?php } ?>





<?php if($_REQUEST['action']=='editpackageterms' && $_REQUEST['quotationid']!='' && $_REQUEST['id']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationTerms','  id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 }

 

 ?>



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Title<span class="text-danger">*</span></label>

									<input name="termType" type="text"  class="form-control" id="termType"   value="<?php echo stripslashes($editresult['termType']); ?>">

				      </div> 

				      </div> 

			   

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="termDescription" rows="3" class="form-control" id="termDescription" ><?php  echo stripslashes($editresult['termDescription']);  ?></textarea>

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('termDescription'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

						   </div> 

						   </div> 

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventTermDescription">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">  

				  </div>

</form>

 

 

  

<?php } ?>



<?php if($_REQUEST['action']=='viewquotation'  && $_REQUEST['id']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"'); 

$quotationInfo=mysqli_fetch_array($rs5);

 }

 

 ?>

<div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

			   

						  <?php if($quotationInfo['quotationType']=='Quick Package'){ include "quickpackageview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Flight'){ include "flightquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Sightseeing'){ include "sightseeingquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Transport'){ include "transportquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Visa'){ include "visaquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Miscellaneous'){ include "miscellaneousquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Hotel'){ include "hotelquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Detailed Package'){ include "detailedpackageview.php"; } ?>

						

					</div>

					

  </div>



								

								

</div>

  

 

 

  

<?php } ?>















<?php if($_REQUEST['action']=='sendquotation'  && $_REQUEST['id']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"'); 

$quotationInfo=mysqli_fetch_array($rs5);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationInfo['queryId'].'"'); 

$queryInfo=mysqli_fetch_array($a);

 }

 

 

//------------Get Template--------------------



 if($quotationInfo['quotationType']=='Quick Package' || $quotationInfo['quotationType']=='Detailed Package'){ 



$a=GetPageRecord('*','emailTemplates',' parentId="'.$LoginUserDetails['parentId'].'"  and emailTemplateType="Package Quotation"'); 

$resTemplate=mysqli_fetch_array($a);



$quotation_url=$fullurl.'quotationpreview/'.encode($quotationInfo['id']).'/'.seo_friendly_url($quotationInfo['name']);



$subject=quotationreplacetags($quotationInfo['id'],stripslashes($resTemplate['emailSubject']),$quotation_url);

$description=quotationreplacetags($quotationInfo['id'],stripslashes(str_replace('#user_signature#','',$resTemplate['emailContent'])),$quotation_url);



$sendmaildetails=quotationreplacetags($quotationInfo['id'],stripslashes($resTemplate['emailContent']),$quotation_url);



} else {



$subject='Quotation - QT'.encode($quotationInfo['id']).' - '.stripslashes($LoginUserCompanyDetails['companyName']).'';

$description = file_get_contents($fullurl.'quotationpreview/'.encode($quotationInfo['id']).'/'.seo_friendly_url($quotationInfo['name']));



$sendmaildetails=quotationreplacetags($quotationInfo['id'],'<div style=" width:800px; margin:auto;">'.$description.'</div><br><br> #user_signature#','');



}





 

//------------Get Template--------------------

 

 ?> 

			<div class="col-md-12">

			<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Subject<span class="text-danger">*</span></label>

									<input name="subject" type="text"  class="form-control" id="subject"   value="<?php echo $subject; ?>">

				      </div> 

				      </div> 

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Client Email<span class="text-danger">*</span></label>

									<input name="clientEmail" type="text" class="form-control" readonly="readonly" id="clientEmail" value="<?php echo $queryInfo['contactEmail']; ?>">

						   </div> 

						   </div>  

						    

						     <div class="col-md-6">

						<div class="form-group">

									<label>CC Email</label> 

									<input name="CCEmail" type="text" class="form-control" id="CCEmail" value="">

						   </div> 

						   </div> 

						

					</div>

					

		   </div>



								

								

			  </div><div class="card-footer text-right" >

								  

		<button type="submit" class="btn btn-primary" style="background-color: #26a69a;">Send Quotation Now&nbsp; <i class="fa fa-paper-plane" aria-hidden="true"></i></button>

		<input name="action" type="hidden" id="action" value="saveSendQuotation">

		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

		<input name="queryId" type="hidden" id="queryId" value="<?php echo encode($queryInfo['id']); ?>"> 

		<textarea name="emailbody" style="display:none;" cols="" rows=""><?php echo $sendmaildetails; ?></textarea> 

			 </div>

</form>

			

			<div style="text-align:center; font-size:18px; padding:10px; border-bottom:1px solid #ddd; border-top:1px solid #ddd; background-color:#F0F0F0; ">Preview</div> 

			<div style="border:1px solid #ddd; padding:20px;"> 

						  <?php  echo $description; ?> 

			  </div>	

					

</div>



								

								

				  </div>

  

 

 

  

<?php } ?>



















<?php if($_REQUEST['action']=='saveotherquotation' && $_REQUEST['id']!=''){





$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					 <div class="col-md-12">

						<div class="form-group">

									<label>Quotation Title<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" maxlength="255">

					   </div> 

				      </div> 

						

						<div class="col-md-6">

						<div class="form-group">

									<label>Quotation Banner</label>

									<input name="packagebanner" type="file" class="form-control" id="packagebanner" style="padding: 4px;">

					      </div> 

				      </div>

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Terms & Conditions</label>

									 <textarea name="packageItinerary" rows="3" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('packageItinerary'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

						   </div> 

						   </div>

						    

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							 	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveotherquotation">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

							    <input name="bannerImg" type="hidden" id="bannerImg" value="<?php echo $editresult['bannerImg']; ?>"> 

				  </div>

</form>

<?php } ?>

























<?php if($_REQUEST['action']=='addoptionhotelopen' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 



 

$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'" '); 

$quotationData=mysqli_fetch_array($a);





$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('d-m-Y', strtotime($editresult['checkOutDate'])); 

}





if($_REQUEST['filledhotelid']!=''){

$a=GetPageRecord('*','hotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$_REQUEST['filledhotelid'].'" '); 

$editresult=mysqli_fetch_array($a);

}

 ?>

 

<?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-6">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

									<div class="input-group input-group-lg">   

  

  <select class="form-control" name="travelFromCity" id="pickupCityfromCity" data-fouc>

										

					<?php  

					if($_REQUEST['package']==1){ 

 $rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'" and id in ('.rtrim($quotationData['destination'],',').') and status=1  order by name asc');

					} else {

$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');

					}

					

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>"  <?php if($_REQUEST['cityIds']==$rest['id']) { ?>selected="selected"<?php } ?> <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

									

								<script>

 $(document).ready(function() {

    $('#pickupCityfromCity').select2({dropdownParent: $('.modal')}); 

});

</script>	

  

						  </div>

				      </div> 

				      </div>

						 <div class="col-md-6">

						<div class="form-group">

									<label>Hotel Category<span class="text-danger">*</span></label> 

									<select id="hotelCategory" name="hotelCategory" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','sys_hotelCategory',' 1 order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['category']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

				      </div>

						   

						   

						    <div class="col-md-12">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchHotelOpen('name','nope','searchhotellist');"  >

						   </div> 

						   </div>

						   

						    

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Room Type <span class="text-danger">*</span></label>

									<input name="roomType" type="text" class="form-control" id="roomType" value="<?php echo stripslashes($editresult['roomType']); ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Meal Plan<span class="text-danger">*</span></label>

									<input name="mealPlan" type="text" class="form-control" id="mealPlan" value="<?php echo stripslashes($editresult['mealPlan']); ?>">

						   </div> 

						   </div>

						   

						   

						        <div class="col-md-6">

						<div class="form-group">

									<label>Check-In Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Check-Out Date<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				</script>

				

				

				     <div class="col-md-6">

						<div class="form-group">

									<label>Check-In Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

									

			 							

					   </div> 

				      </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Check-Out Time</label>

									  

									

										<select  name="checkOutTime" class="form-control"  id="checkOutTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	 

	

	<?php 

	if($editresult['checkOutTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkOutTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

		 	

						   </div> 

						   </div>

						     

						   

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Hotel</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" placeholder="Write here about hotel"><?php  echo stripslashes($editresult['eventDetails']); ?><?php  echo stripslashes($editresult['hotelDetails']); ?></textarea>

						   </div> 

						   </div> 

						   

						   

						   

						   

						   <div class="col-md-12 hideinpackage">

						<div class="form-group">

									<label>Show Price <span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

						   </div> 

						   </div>

						   

						   

						 <div class="col-md-2">

						<div class="form-group">

									<label>Single Room No.</label>

									<input name="singleRoom" type="number" class="form-control" id="singleRoom" value="<?php echo stripslashes($editresult['singleRoom']); ?>">

						   </div> 

				      </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Double Room No.</label>

									<input name="doubleRoom" type="number" class="form-control" id="doubleRoom" value="<?php echo stripslashes($editresult['doubleRoom']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Triple Room No.</label>

									<input name="tripleRoom" type="number" class="form-control" id="tripleRoom" value="<?php echo stripslashes($editresult['tripleRoom']); ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Extra Adult No.</label>

									<input name="extraAdultRoom" type="number" class="form-control" id="extraAdultRoom" value="<?php echo stripslashes($editresult['extraAdultRoom']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Child With Bed No.</label>

									<input name="childWithBedRoom" type="number" class="form-control" id="childWithBedRoom" value="<?php echo stripslashes($editresult['childWithBedRoom']); ?>">

						   </div> 

						   </div>

						   

						   

						   

						   

						    <div class="col-md-12">

										<div class="form-group" style="color:#FF0000;">

										Room price should be per room per night</div>

					  </div>

						   

						   

						   

						   

						    <div class="col-md-2">

						<div class="form-group">

									<label>Single Price</label>

									<input name="singleRoomCost" type="number" class="form-control" id="singleRoomCost" value="<?php echo stripslashes($editresult['singleRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Double Price</label>

									<input name="doubleRoomCost" type="number" class="form-control" id="doubleRoomCost" value="<?php echo stripslashes($editresult['doubleRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Triple Price</label>

									<input name="tripleRoomCost" type="number" class="form-control" id="tripleRoomCost" value="<?php echo stripslashes($editresult['tripleRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Extra Price</label>

									<input name="extraAdultRoomCost" type="number" class="form-control" id="extraAdultRoomCost" value="<?php echo stripslashes($editresult['extraAdultRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Child With Bed Price</label>

									<input name="childWithBedRoomCost" type="number" class="form-control" id="childWithBedRoomCost" value="<?php echo stripslashes($editresult['childWithBedRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						       

							   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>   

							   

							   

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none;">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventHotelOpen"> 

								  <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">

 								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php echo $editresult['eventPhoto']; ?><?php echo $editresult['hotelPhoto']; ?>">

				  </div>

</form>

<?php } ?>















<?php if($_REQUEST['action']=='editdaydetails' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','packageDays','   id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);



$b=GetPageRecord('*','quotationMaster','   id="'.$editresult['quotationId'].'"   '); 

$quotationDetail=mysqli_fetch_array($b);

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">				   

						   

						   

					

					 <div class="col-md-12">

						<div class="form-group">

									<label>Title<span class="text-danger">*</span></label>

									<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>" maxlength="255">

					   </div> 

				      </div> 

						 

						   <div class="col-md-12">

						<div class="form-group">

									<label>Day Details</label>

									 <textarea name="description" rows="6" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['description']);  ?></textarea>

 

						   </div> 

						   </div>

						    

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							 	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savedaydetails">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

							    <input name="daydate" type="hidden" id="daydate" value="<?php echo $_REQUEST['daydate']; ?>"> 

							    <input name="dayid" type="hidden" id="dayid" value="<?php echo $_REQUEST['dayid']; ?>">  

				  </div>

</form>

<?php } ?>



















<?php if($_REQUEST['action']=='editdetailpackageoptionpeice' && $_REQUEST['id']!='' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','sys_quickPackageOptions',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);







$ab=GetPageRecord('*','sys_branchMaster','   id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

$branchData=mysqli_fetch_array($ab);

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					

<div class="col-md-6">

	<div class="form-group">

		<label>Per Adult Price</label>

		<input name="perAdult" type="number" class="form-control" id="perAdult" value="<?php echo stripslashes($editresult['perAdult']); ?>">

	</div> 

</div>



<div class="col-md-6">

	<div class="form-group">

		<label>Per Child Price</label>

		<input name="perChild" type="number" class="form-control" id="perChild" value="<?php echo stripslashes($editresult['perChild']); ?>">

	</div> 

</div>



<div class="col-md-6" style="display:none;">

	<div class="form-group">

		<label>Adult Markup</label>

		<input name="quotationAdultMarkup" type="number" class="form-control" id="quotationAdultMarkup" value="0<?php // echo stripslashes($editresult['quotationAdultMarkup']); ?>">

	</div> 

</div>



<div class="col-md-6"  style="display:none;">

	<div class="form-group">

		<label>Child Markup</label>

		<input name="quotationChildMarkup" type="number" class="form-control" id="quotationChildMarkup" value="0<?php // echo stripslashes($editresult['quotationChildMarkup']); ?>">

	</div> 

</div>

					

					

<input type="hidden" id="currencyId" name="currencyId" value="2755">			

						   

						 

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							<!--<button type="button" class="btn btn-danger" style="float:left;" data-dismiss="modal" onclick="if(confirm('Are you sure you want to delete this option?')) deleteoptions<?php echo $_REQUEST['id']; ?>('<?php echo $_REQUEST['id']; ?>');">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>-->	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savequickpackageoptionpeice">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">

				  </div>

</form>

<?php } ?>















<?php if($_REQUEST['action']=='addhotellibrary'){

 



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">



						   

<div class="col-md-4">

	<div class="form-group">

		<label>Location</label>

		<div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

			<div class="input-group input-group-lg">  

				<input type="text" class="form-control" requered  onkeyup="getSearchCItyName('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo $editresult['cityName']; ?>" autocomplete="nope" >

				<input name="cityName" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['cityName']); ?>" autocomplete="nope" />

			</div>

		</div>

</div>

		

						   

						   

						 <div class="col-md-4">

						<div class="form-group">

									<label>Hotel Category<span class="text-danger">*</span></label> 

									<select id="hotelCategory" name="hotelCategory" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','sys_hotelCategory',' parentId="'.$LoginUserDetails['parentId'].'" and status=1 order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['category']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

				      </div>

						   <div class="col-md-4">

						<div class="form-group">

									<label>Hotel Type<span class="text-danger">*</span></label> 

									<select id="hotelType" name="hotelType" class="form-control select-clear"  autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','sys_hotelType',' status=1 order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['name']; ?>" <?php if($rest['name']==$editresult['hotelType']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                          </select>

						   </div> 

				      </div>

						   

						    <div class="col-md-9">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						   

						     

				

				     <div class="col-md-4">

						<div class="form-group">

									<label>Check-In Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

									

			 							

					   </div> 

				      </div>

						   

						   

						     <div class="col-md-4">

						<div class="form-group">

									<label>Check-Out Time</label>

									  

									

										<select  name="checkOutTime" class="form-control"  id="checkOutTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	 

	

	<?php 

	if($editresult['checkOutTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkOutTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

		 	

						   </div> 

						   </div>

						   
<div class="col-md-4">

						<div class="form-group">

									<label>Cancellation Type</label>

								<select  name="cancellationType" class="form-control"  id="cancellationType" autocomplete="off"   >  

						<option value="Free Cancellation" <?php if($editresult['cancellationType']=='Free Cancellation' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Free Cancellation</option>       

						<option value="Cancellation Charges Apply" <?php if($editresult['cancellationType']=='Cancellation Charges Apply'){ ?>selected="selected"<?php } ?> >Cancellation Charges Apply</option>    

						</select>

									

							   </div>

					  </div>
						   

						     

						     

						   <div class="col-md-12">

						<div class="form-group">

									<label>Address</label>

                                    <input name="address" type="text" class="form-control" id="address" value="<?php  echo stripslashes($editresult['address']); ?>" placeholder="Address" />

						   </div> 

						   </div>

						      <div class="col-md-6">

						<div class="form-group">

									<label>Latitude</label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="lat" type="text" class="form-control" id="lat" value="<?php echo stripslashes($editresult['lat']); ?>"    >

						   </div> 

						   </div>
						   
						   
						   <div class="col-md-6">

						<div class="form-group">

									<label>Longitude</label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="lon" type="text" class="form-control" id="lon" value="<?php echo stripslashes($editresult['lon']); ?>"    >

						   </div> 

						   </div>

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Hotel</label>

 <textarea name="eventDetails" rows="8" class="form-control" id="eventDetails" placeholder="Write here about hotel"><?php  echo stripslashes($editresult['eventDetails']); ?><?php  echo stripslashes($editresult['hotelDetails']); ?></textarea>

						   </div> 

						   </div>
						   
						   
						    <div class="col-md-12">
							<div class="row" style="padding: 10px; border: 1px solid #ddd; margin-left: 0px; margin-right: 0px; margin-bottom: 20px;">
							<h4 style="margin-bottom:10px; width:100%;">Amenities</h4>
							 <?php 
							  						    
$rs=GetPageRecord('*','sys_hotelAmenities',' status=1 order by name asc'); 
while($rest=mysqli_fetch_array($rs)){ 

?>
							
							 <div class="col-md-3">
							 <input name="hotelAmenities[]" type="checkbox" value="<?php echo stripslashes($rest['name']); ?>" <?php if (strpos($editresult['hotelAmenities'], $rest['name']) !== false || $editresult['hotelAmenities']=='') { ?>checked="checked"<?php } ?> /> <?php echo stripslashes($rest['name']); ?>
							 </div>
	<?php } ?>						
							
							</div>
							
							</div> 
						   
						

						    
	<div class="col-md-12"  style="margin-bottom:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <?php if($editresult['hotelPhoto']!=''){ ?><td colspan="2"><div style="width:90px; height:65px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($editresult['hotelPhoto']!=''){ echo 'upload/'.stripslashes($editresult['hotelPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td><?php } ?>
    <td width="95%" style="padding-left:10px;"><label>Hotel Photo 1</label><br />


								<input name="eventphoto" type="file" class="form-control" id="eventphoto" style="padding: 4px;">
</td>
  </tr>
</table>

	
	</div>
	
			<div class="col-md-12" style="margin-bottom:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <?php if($editresult['hotelPhoto2']!=''){ ?><td colspan="2"><div style="width:90px; height:65px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($editresult['hotelPhoto2']!=''){ echo 'upload/'.stripslashes($editresult['hotelPhoto2']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td><?php } ?>
    <td width="95%" style="padding-left:10px;"><label>Hotel Photo 2</label><br />


								<input name="eventphoto2" type="file" class="form-control" id="eventphoto2" style="padding: 4px;">
</td>
  </tr>
</table>

	
	</div>	
	
	<div class="col-md-12"  style="margin-bottom:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <?php if($editresult['hotelPhoto3']!=''){ ?><td colspan="2"><div style="width:90px; height:65px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($editresult['hotelPhoto3']!=''){ echo 'upload/'.stripslashes($editresult['hotelPhoto3']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td><?php } ?>
    <td width="95%" style="padding-left:10px;"><label>Hotel Photo 3</label><br />


								<input name="eventphoto3" type="file" class="form-control" id="eventphoto3" style="padding: 4px;">
</td>
  </tr>
</table>

	
	</div>		 
	
	<div class="col-md-12"  style="margin-bottom:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <?php if($editresult['hotelPhoto4']!=''){ ?><td colspan="2"><div style="width:90px; height:65px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($editresult['hotelPhoto4']!=''){ echo 'upload/'.stripslashes($editresult['hotelPhoto4']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td><?php } ?>
    <td width="95%" style="padding-left:10px;"><label>Hotel Photo 4</label><br />


								<input name="eventphoto4" type="file" class="form-control" id="eventphoto4" style="padding: 4px;">
</td>
  </tr>
</table>

	
	</div>
	
	<div class="col-md-12"  style="margin-bottom:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <?php if($editresult['hotelPhoto5']!=''){ ?><td colspan="2"><div style="width:90px; height:65px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($editresult['hotelPhoto5']!=''){ echo 'upload/'.stripslashes($editresult['hotelPhoto5']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td><?php } ?>
    <td width="95%" style="padding-left:10px;"><label>Hotel Photo 5</label><br />


								<input name="eventphoto5" type="file" class="form-control" id="eventphoto5" style="padding: 4px;">
</td>
  </tr>
</table>

	
	</div>

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveHotelLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

 								<input name="eventPhotoold" type="hidden" id="eventPhotoold" value="<?php echo $editresult['hotelPhoto']; ?>">
 								<input name="eventPhotoold2" type="hidden" id="eventPhotoold2" value="<?php echo $editresult['hotelPhoto2']; ?>">
 								<input name="eventPhotoold3" type="hidden" id="eventPhotoold3" value="<?php echo $editresult['hotelPhoto3']; ?>">
 								<input name="eventPhotoold4" type="hidden" id="eventPhotoold4" value="<?php echo $editresult['hotelPhoto4']; ?>">
 								<input name="eventPhotoold5" type="hidden" id="eventPhotoold5" value="<?php echo $editresult['hotelPhoto5']; ?>">

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addhotellibraryroomtype' && $_REQUEST['id']!=''){

  

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelMaster',' addBy="'.$_SESSION['userid'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 





$fromdate=date('d-m-Y');

$todate=date('d-m-Y',strtotime("+3 months")); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-2" style="display:none;">

						<div class="form-group">

							<label>Supplier<span class="text-danger">*</span></label>

							<div class="input-group">   

								<select class="form-control" name="supplier" id="supplier"> 

<?php  

$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 and userType="suppliers"  order by name asc'); 

while($rest=mysqli_fetch_array($rs)){  

?> 

<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['supplier']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>

<?php }  ?> 

								</select>

							</div>

						</div> 

					</div>

					<div class="col-md-2">

						<div class="form-group">

							<label>Room Name<span class="text-danger">*</span></label>

							<div class="input-group">   

								<input type="text" class="form-control" name="roomType" id="roomType">

							</div>

						</div> 

					</div>

					<div class="col-md-2">

						<div class="form-group">

							<label>Inclusion<span class="text-danger">*</span></label>

							<div class="input-group">   

								<input type="text" class="form-control" name="inclusion" id="inclusion">

							</div>

						</div> 

					</div>

					<div class="col-md-2">

						<div class="form-group">

							<label>Cancellation Policy<span class="text-danger">*</span></label>

							<div class="input-group">   

								<input type="text" class="form-control" name="cancellationPolicy" id="cancellationPolicy">

							</div>

						</div> 

					</div>

					<div class="col-md-2" style="max-width:140px;">

						<div class="form-group">

							<label>Valid From<span class="text-danger">*</span></label>

							<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						</div> 

					</div>

					<div class="col-md-2" style="max-width: 140px;">

						<div class="form-group">

							<label>Valid To<span class="text-danger">*</span></label>

							<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						</div> 

					</div>

						   

						   

				<script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				

				   

				<div class="col-md-1">

					<div class="form-group">

						<label>Room Cost<span class="text-danger">*</span></label>

						<input name="adultCost" type="number" min="0"  class="form-control" id="adultCost" value="0">

					</div> 

				</div>

						   

				<div class="col-md-1">

					<div class="form-group">

						<label>Child With Bad</label>

						<input name="childCost" type="number" min="0"  class="form-control" id="childCost" value="0">

					</div> 

				</div>

						   

						   

				<div class="col-md-1">

					<div class="form-group">

						<label>Child No Bad</label>

						<input name="infantCost" type="number" min="0"  class="form-control" id="infantCost" value="0">

					</div> 

				</div>

						   

						   

				<div class="col-md-1">

					<div class="form-group">

						<label>&nbsp;&nbsp;</label>

						<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

					</div> 

				</div>

			</div>

		</div>



<input name="action" type="hidden" id="action" value="saveHotelLibraryRoomTypeCost">  

<input name="editid" type="hidden" id="editid" value="">  

<input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_hotelroomtypecost">



</div>

</div>

</div>



<script>

function loadroomtypecost(){

$('#load_hotelroomtypecost').load('load_hotelroomtypecost.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadroomtypecostdlt(dlt){

$('#load_hotelroomtypecost').load('load_hotelroomtypecost.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadroomtypecost();

</script>

<?php } ?>





<?php if($_REQUEST['action']=='addhotellibrarymealplan' && $_REQUEST['id']!=''){

  

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 





$fromdate=date('d-m-Y');

$todate=date('d-m-Y',strtotime("+3 months")); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					

					<div class="col-md-2">

						<div class="form-group">

									<label>Supplier<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="supplier" id="supplier"> 

					<?php  

				$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 and userType="suppliers"  order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){  

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['supplier']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>

					<?php }  ?> 

					</select>

					

			 

  

						  </div>

				      </div> 

				      </div>

					<div class="col-md-2">

						<div class="form-group">

									<label>Meal Plan<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="roomType" id="roomTypeid"> 

					<?php  

				$rs=GetPageRecord('*','sys_mealPlanMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1 order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?> 

					</select>

					

			 

  

						  </div>

				      </div> 

				      </div>

						   

						   

						   

						           <div class="col-md-2" style="max-width: 140px;">

						<div class="form-group">

									<label>Valid From<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-2"  style="max-width: 140px;"> 

						<div class="form-group">

									<label>Valid To<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				

				   

						     <div class="col-md-1">

						<div class="form-group">

									<label>Adult Cost<span class="text-danger">*</span></label>

									<input name="adultCost" type="number" min="0"  class="form-control" id="adultCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Child</label>

									<input name="childCost" type="number" min="0"  class="form-control" id="childCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Infant</label>

									<input name="infantCost" type="number" min="0"  class="form-control" id="infantCost" value="0">

						   </div> 

						   </div>

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

    <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$LoginUserBranchDetails['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="saveHotelLibraryMealPlanCost">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_hotelmealplancost">



</div>

</div>

</div>



<script>

function loadmealplancost(){

$('#load_hotelmealplancost').load('load_hotelloadmealplancost.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadmealplancostdlt(dlt){

$('#load_hotelmealplancost').load('load_hotelloadmealplancost.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadmealplancost();

</script>

<?php } ?>



<?php if($_REQUEST['action']=='addhotellibraryextra' && $_REQUEST['id']!=''){

  

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 





$fromdate=date('d-m-Y');

$todate=date('d-m-Y',strtotime("+3 months")); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					

					<div class="col-md-2">

						<div class="form-group">

									<label>Supplier<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="supplier" id="supplier"> 

					<?php  

				$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 and userType="suppliers"  order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){  

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['supplier']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>

					<?php }  ?> 

					</select>

					

			 

  

						  </div>

				      </div> 

				      </div>

					

					<div class="col-md-2">

						<div class="form-group">

									<label>Add-ons Extra<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="roomType" id="roomTypeid"> 

					<?php  

				$rs=GetPageRecord('*','sys_extraMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1 order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?> 

					</select>

					

			 

  

						  </div>

				      </div> 

				      </div>

						   

						   

						   

						           <div class="col-md-2"  >

						<div class="form-group">

									<label>Valid From<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-2" >

						<div class="form-group">

									<label>Valid To<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				

				   

						     <div class="col-md-2">

						<div class="form-group">

									<label>Cost<span class="text-danger">*</span></label>

									<input name="adultCost" type="number" min="0"  class="form-control" id="adultCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Child</label>

									<input name="childCost" type="number" min="0"  class="form-control" id="childCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Infant</label>

									<input name="infantCost" type="number" min="0"  class="form-control" id="infantCost" value="0">

						   </div> 

						   </div>

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

    <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$LoginUserBranchDetails['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="saveHotelLibraryExtraCost">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_hotelextracost">



</div>

</div>

</div>



<script>

function loadextracost(){

$('#load_hotelextracost').load('load_hotelloadextracost.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadextracostdlt(dlt){

$('#load_hotelextracost').load('load_hotelloadextracost.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadextracost();

</script>

<?php } ?>





















<?php if($_REQUEST['action']=='adddestination'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','cityMaster','   id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row"> 

						   <div class="col-md-12">

						<div class="form-group">

									<label>Destinatin Iamge (270px - 247px)</label>

								<input name="eventphoto" type="file" class="form-control" id="eventphoto" style="padding: 4px;"> 

							   </div>

					  </div> 

					</div> 

		   </div> 			

   </div><div class="card-footer text-right" > 

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="adddestination">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>



























<?php if($_REQUEST['action']=='addhotelcategorylibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_hotelCategory',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-8">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveHotelCategoryLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addroomtypelibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_roomTypeMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-8">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveRoomTypeLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>





<?php if($_REQUEST['action']=='addmealplanlibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_mealPlanMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-8">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveMealPlanLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addextralibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_extraMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-8">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveExtraLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>













<?php if($_REQUEST['action']=='addvehiclelibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_vehicleMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-6">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Pax<span class="text-danger">*</span></label> 

									<input name="pax" type="number" class="form-control" id="pax" value="<?php echo stripslashes($editresult['pax']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveVehicleLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>

















<?php if($_REQUEST['action']=='addactivitylibrary'){

 



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','activityMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-6">

						<div class="form-group">

									<label>Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">   

  

  <select class="form-control" name="travelFromCity" id="pickupCityfromCity" data-fouc>

										

					<?php  

				$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');

					

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

									

								<script>

 $(document).ready(function() {

    $('#pickupCityfromCity').select2({dropdownParent: $('.modal')}); 

});

</script>	

  

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-6">

						<div class="form-group">

									<label>Activity Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Duration<span class="text-danger">*</span></label> 

									<input name="sectionDuration" type="text" class="form-control" id="sectionDuration" placeholder="Eg. 2 Hours" value="<?php echo stripslashes($editresult['sectionDuration']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						   

						     

				

	 

						   

						     <div class="col-md-4">

						<div class="form-group">

									<label>Activity Photo</label>

								<input name="eventphoto" type="file" class="form-control" id="eventphoto" style="padding: 4px;">

									

							   </div>

					  </div>

						     

						   

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Activity</label>

 <textarea name="eventDetails" rows="8" class="form-control" id="eventDetails" placeholder="Write here about activity"><?php  echo stripslashes($editresult['sectionDetails']); ?><?php  echo stripslashes($editresult['sectionDuration']); ?></textarea>

						   </div> 

						   </div> 

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveActivityLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

 								<input name="eventPhotoold" type="hidden" id="eventPhotoold" value="<?php echo $editresult['sectionPhoto']; ?>">

				  </div>

</form>

<?php } ?>

















<?php if($_REQUEST['action']=='addactivitylibrarycost' && $_REQUEST['id']!=''){

  

 

if($_REQUEST['id']!=''){

 

$fromdate=date('d-m-Y');

$todate=date('d-m-Y',strtotime("+3 months")); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

					  

					  <div class="col-md-2">

						<div class="form-group">

									<label>Supplier<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="supplier" id="supplier"> 

					<?php  

				$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 and userType="suppliers"  order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){  

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['supplier']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>

					<?php }  ?> 

					</select>

					

			 

  

						  </div>

					    </div> 

				      </div>

					  

						           <div class="col-md-2">

						<div class="form-group">

									<label>Valid From<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-2">

						<div class="form-group">

									<label>Valid To<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				

				   

						     <div class="col-md-1">

						<div class="form-group">

									<label>Adult Cost<span class="text-danger">*</span></label>

									<input name="adultCost" type="number" min="0"  class="form-control" id="adultCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Child Cost</label>

									<input name="childCost" type="number" min="0"  class="form-control" id="childCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Infant Cost</label>

									<input name="infantCost" type="number" min="0"  class="form-control" id="infantCost" value="0">

						   </div> 

						   </div>

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

    <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$LoginUserBranchDetails['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="saveActivityCost">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_activitycost">



</div>

</div>

</div>



<script>

function loadactivitycost(){

$('#load_activitycost').load('load_activitycost.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadactivitycostdlt(dlt){

$('#load_activitycost').load('load_activitycost.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadactivitycost();

</script>

<?php } ?>

















<?php if($_REQUEST['action']=='addsightseeinglibrary'){

 



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sightseeingMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-6">

						<div class="form-group">

									<label>Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">   

  

  <select class="form-control" name="travelFromCity" id="pickupCityfromCity" data-fouc>

										

					<?php  

				$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');

					

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

									

								<script>

 $(document).ready(function() {

    $('#pickupCityfromCity').select2({dropdownParent: $('.modal')}); 

});

</script>	

  

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-6">

						<div class="form-group">

									<label>Sightseeing Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						   

						     

				

	 

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Sightseeing Photo</label>

								<input name="eventphoto" type="file" class="form-control" id="eventphoto" style="padding: 4px;">

									

							   </div>

					  </div>

						     

						   

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Sightseeing</label>

 <textarea name="eventDetails" rows="8" class="form-control" id="eventDetails" placeholder="Write here about sightseeing"><?php  echo stripslashes($editresult['sectionDetails']); ?><?php  echo stripslashes($editresult['sectionDuration']); ?></textarea>

						   </div> 

						   </div> 

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveSightseeingLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

 								<input name="eventPhotoold" type="hidden" id="eventPhotoold" value="<?php echo $editresult['sectionPhoto']; ?>">

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addsightseeinglibrarycost' && $_REQUEST['id']!=''){

  

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sightseeingMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 





$fromdate=date('d-m-Y');

$todate=date('d-m-Y',strtotime("+3 months")); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-2">

						<div class="form-group">

									<label>Supplier<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="supplier" id="supplier"> 

					<?php  

				$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 and userType="suppliers"  order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){  

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['supplier']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>

					<?php }  ?> 

					</select>

					

			 

  

						  </div>

				      </div> 

				      </div>

					<div class="col-md-2">

						<div class="form-group">

									<label>Meal Plan<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="roomType" id="roomTypeid"> 

					<?php  

				$rs=GetPageRecord('*','sys_vehicleMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1 order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?> (Pax: <?php echo stripslashes($rest['pax']); ?>)</option>

					<?php }} ?> 

					</select>

					

			 

  

						  </div>

				      </div> 

				      </div>

						   

						   

						   

						           <div class="col-md-2">

						<div class="form-group">

									<label>Valid From<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-2">

						<div class="form-group">

									<label>Valid To<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				

				   

						     <div class="col-md-2">

						<div class="form-group">

									<label>Vehicle Cost<span class="text-danger">*</span></label>

									<input name="adultCost" type="number" min="0"  class="form-control" id="adultCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Child</label>

									<input name="childCost" type="number" min="0"  class="form-control" id="childCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Infant</label>

									<input name="infantCost" type="number" min="0"  class="form-control" id="infantCost" value="0">

						   </div> 

						   </div>

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

    <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$LoginUserBranchDetails['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="saveSightseeingLibraryVehicleCost">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_hotelextracost">



</div>

</div>

</div>



<script>

function loadvehiclecost(){

$('#load_hotelextracost').load('load_hotelloadvehiclecost.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadvehiclecostdlt(dlt){

$('#load_hotelextracost').load('load_hotelloadvehiclecost.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadvehiclecost();

</script>

<?php } ?>





<?php if($_REQUEST['action']=='addcruselibrary'){

 



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','cruseMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-6">

						<div class="form-group">

									<label>Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">   

  

  <select class="form-control" name="travelFromCity" id="pickupCityfromCity" data-fouc>

										

					<?php  

				$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1  order by name asc');

					

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?>

					

									</select>

									

								<script>

 $(document).ready(function() {

    $('#pickupCityfromCity').select2({dropdownParent: $('.modal')}); 

});

</script>	

  

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-6">

						<div class="form-group">

									<label>Cruse Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						   

						     

				

	 

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Cruse Photo</label>

								<input name="eventphoto" type="file" class="form-control" id="eventphoto" style="padding: 4px;">

									

							   </div>

					  </div>

						     

						   

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Cruse</label>

 <textarea name="eventDetails" rows="8" class="form-control" id="eventDetails" placeholder="Write here about cruse"><?php  echo stripslashes($editresult['sectionDetails']); ?><?php  echo stripslashes($editresult['sectionDuration']); ?></textarea>

						   </div> 

						   </div> 

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveCruseLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

 								<input name="eventPhotoold" type="hidden" id="eventPhotoold" value="<?php echo $editresult['sectionPhoto']; ?>">

				  </div>

</form>

<?php } ?>





    



<?php if($_REQUEST['action']=='addcruselibrarycost' && $_REQUEST['id']!=''){

  

   

if($_REQUEST['id']!=''){

 

$fromdate=date('d-m-Y');

$todate=date('d-m-Y',strtotime("+3 months")); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

					  <div class="col-md-1">

						<div class="form-group">

									<label>Supplier<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="supplier" id="supplier"> 

					<?php  

				$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 and userType="suppliers"  order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){  

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['supplier']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>

					<?php }  ?> 

					</select>

					

			 

  

						  </div>

					    </div> 

				      </div>

					  

						           <div class="col-md-2">

						<div class="form-group">

									<label>Valid From<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-2">

						<div class="form-group">

									<label>Valid To<span class="text-danger">*</span></label>

									<input name="checkOutDate" type="text" class="form-control" id="checkOutDate" value="<?php echo $todate; ?>">

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

				} );

				</script>

				<div class="col-md-2">

						<div class="form-group">

									<label>Cruise Seat Category<span class="text-danger">*</span></label>

						   

									<div class="input-group">   

  

  <select class="form-control" name="seatId" id="seatId"> 

					<?php  

				$rs=GetPageRecord('*','sys_CruiseSeatMaster','  parentId="'.$LoginUserDetails['parentId'].'"  and status=1 order by name asc'); 

					while($rest=mysqli_fetch_array($rs)){ 

					if(trim($rest['name'])!=''){ 

					?> 

					<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($editresult['cityId']==$rest['id']) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

					<?php }} ?> 

					</select>

					

			 

  

						  </div>

			      </div> 

				      </div>

				   

						     <div class="col-md-1">

						<div class="form-group">

									<label>Adult Cost<span class="text-danger">*</span></label>

									<input name="adultCost" type="number" min="0"  class="form-control" id="adultCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Child Cost</label>

									<input name="childCost" type="number" min="0"  class="form-control" id="childCost" value="0">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Infant Cost</label>

									<input name="infantCost" type="number" min="0"  class="form-control" id="infantCost" value="0">

						   </div> 

						   </div>

						   

						   <div class="col-md-1">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

    <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$LoginUserBranchDetails['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="saveCruseCost">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_crusecost.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadcrusecostdlt(dlt){

$('#load_crusecost').load('load_crusecost.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadcrusecost();

</script>

<?php } ?>





















<?php if($_REQUEST['action']=='editinerary' && $_REQUEST['id']!=''){





$rs5=GetPageRecord('*','quotationMaster','   id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);



$a=GetPageRecord('*','queryMaster','     id="'.($editresult['queryId']).'" '); 

$queryData=mysqli_fetch_array($a);

 

 ?>

 

<script>

 $(document).ready(function() {

    $('#destination').select2({dropdownParent: $('.modal'), tags: true, tokenSeparators: [',', ' ']}); 

});

</script>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					 <div class="col-md-6">

						<div class="form-group">

									<label>Package Title<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" maxlength="255">

					   </div> 

				      </div> 

						

						<div class="col-md-6">

						<div class="form-group">

									<label>Package Banner</label>

									<input name="packagebanner" type="file" class="form-control" id="packagebanner" style="padding: 4px;">

					      </div> 

				      </div>



<?php

//Get City Name

$cityName=GetPageRecord('*','cityMaster','  id="'.$editresult['destination'].'" order by name asc');

$cityNameData=mysqli_fetch_array($cityName);

?>

						   <div class="col-md-6">

	<div class="form-group">

		<label>Select Location</label>

		<div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

			<div class="input-group input-group-lg">  

				<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo $cityNameData['name']; ?>" autocomplete="nope" >

				<input name="cityName" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['destination']); ?>" autocomplete="nope" />

			</div>

		</div>

</div>







  <div class="col-md-6 d-none">

	<div class="form-group">

		<label>Weekend Getaways</label>

		<div style="height:0px; font-size:0px; position:relative;  " ></div>

			<div class="input-group input-group-lg">  

				 <select name="weekendGatewayLocationId" class="form-control" id="weekendGatewayLocationId">

	<?php  

	$a=GetPageRecord('*','weekendGatewayLocationMaster','  status=1 order by name asc');

	while($locationData=mysqli_fetch_array($a)){



 ?>

	<option value="<?php echo $locationData['id']; ?>" <?php if($locationData['id']==$editresult['weekendGatewayLocationId']){ ?>selected="selected"<?php } ?>><?php echo $locationData['name']; ?></option>

	<?php } ?>

						  </select>

				 

			</div>

		</div>

</div>

						   

						   <?php if($_REQUEST['package']!='detail'){ ?>

						   <div class="col-md-12">

						<div class="form-group">

									<label>Package Itinerary</label>

									 <textarea name="packageItinerary" rows="3" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('packageItinerary'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

						   </div> 

						   </div>

						   <?php } else {?>

						   

						   

						   

						   

						      

						        <div class="col-md-2" <?php if($queryData['id']==''){ ?>style="display:none;"<?php } ?>>

						<div class="form-group">

									<label>Start Date<span class="text-danger">*</span></label>

									<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo date('d-m-Y',strtotime($editresult['startDate'])); ?>">

						   </div> 

						   </div>

						   

						   <?php if($queryData['id']==''){ ?>

						     <div class="col-md-6">

						<div class="form-group">

									<label>Package Duration<span class="text-danger">*</span></label>

									<select name="nights" class="form-control" id="nights">

	<?php $n=1; for ($x = 1; $x <= 20; ) { ?>

	<option value="<?php echo ($x-1); ?>" <?php if(($x-1)==$editresult['nights']){ ?>selected="selected"<?php } ?>><?php echo ($x-1); ?> Nights / <?php echo $n; ?> Days</option>

	<?php $n++; $x++;} ?>

						  </select>

									

									 

						   </div> 

						   </div>

						   <?php } else { ?>

						   

						    <div class="col-md-2">

						<div class="form-group">

									<label>End Date<span class="text-danger">*</span></label>

									<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo date('d-m-Y',strtotime($editresult['endDate'])); ?>">

						   </div> 

						   </div>

						   

						   <?php }  ?>

						   

						   

						   

						   

						   

						   	 <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Adult</label>

									<input name="adult" type="number" min="1" class="form-control" id="adult" readonly="readonly" value="<?php echo stripslashes($queryData['adult']); ?>">

						   </div> 

						   </div>

						   

						    <div class="col-md-1"  style="display:none;">

						<div class="form-group">

									<label>Child121</label>

									<input name="child" type="number" min="0" class="form-control" id="child" readonly="readonly" value="<?php echo stripslashes($queryData['child']); ?>">

						   </div> 

						   </div>

						   

						    <div class="col-md-1"  style="display:none;">

						<div class="form-group">

									<label>Infant</label>

									<input name="infant" type="number" min="0" class="form-control" id="infant" readonly="readonly" value="<?php echo stripslashes($queryData['infant']); ?>">

						   </div> 

						   </div>

						   

					 <div class="col-md-6">

						<div class="form-group">

									<label>Package Theme</label>

									<select name="packageTheme" class="form-control" id="packageTheme">

										<?php  

										$rs=GetPageRecord('*','sys_packageTheme','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

										while($rest=mysqli_fetch_array($rs)){ 

										?> 

										<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($rest['id']==$editresult['packageTheme']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

										<?php } ?>

						  			</select>

					   </div> 

				      </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Show On Website</label>

									<select name="showOnWebsite" class="form-control" id="showOnWebsite">

	 

	<option value="1" <?php if(1==$editresult['showOnWebsite']){ ?>selected="selected"<?php } ?>>Yes</option>

	<option value="0" <?php if(0==$editresult['showOnWebsite']){ ?>selected="selected"<?php } ?>>No</option>

 

						  </select>

						   </div> 

						   </div>

						   

<div class="col-md-12" style="display:none;">

	<div class="form-group">

	<label>Select Location (Multiselect)</label>

	<select class="form-control" multiple="multiple" name="destination[]" id="destination" data-fouc>

	<?php  

		$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

		while($rest=mysqli_fetch_array($rs)){ 

		if(trim($rest['name'])!=''){ 

			$HiddenProducts = explode(',',$editresult['destination']);

		?> 

		<option value="<?php echo stripslashes($rest['id']); ?>" <?php if (in_array($rest['id'], $HiddenProducts)) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

	<?php }} ?>

	</select>

</div> 

</div>





<div class="row" style=" width:100%; padding-left:10px; margin-top:10px; margin-bottom:10px;">

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="flighticon" id="checkbox2" value="1" <?php if(1==$editresult['flighticon']){ ?> checked="checked" <?php } ?> />

							<label for="checkbox2">

							Flight Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="hotelicon" id="hotelicon" value="1" <?php if(1==$editresult['hotelicon']){ ?> checked="checked" <?php } ?> />

							<label for="hotelicon">

							Hotel Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="sightseeingicon" id="sightseeingicon" value="1" <?php if(1==$editresult['sightseeingicon']){ ?> checked="checked" <?php } ?> />

							<label for="sightseeingicon">

							Sightseeing Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="transfericon" id="transfericon" value="1" <?php if(1==$editresult['transfericon']){ ?> checked="checked" <?php } ?> />

							<label for="transfericon">

							Transfer Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="activityicon" id="activityicon" value="1" <?php if(1==$editresult['activityicon']){ ?> checked="checked" <?php } ?> />

							<label for="activityicon">

							Activity Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="cruiseicon" id="cruiseicon" value="1" <?php if(1==$editresult['cruiseicon']){ ?> checked="checked" <?php } ?> />

							<label for="cruiseicon">

							Cruise Icon

							</label>

							</div> 

							</div>



				</div>		    

						   

						    

						   

						    

						   

						    

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Package Overview</label>

									 <textarea name="packageItinerary" rows="6" class="form-control" id="packageItinerary" placeholder="Write something about package" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>

 

						   </div> 

						   </div>

						  <script>









				$( function() {

				$( "#startDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#endDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				</script>

				

						   

						   

						   <?php  } ?>

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							 	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

<input name="action" type="hidden" id="action" value="<?php if($_REQUEST['package']=='detail'){?>savedetailpackageotitle<?php }else{ ?>savequickpackageotitle<?php } ?>">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

							    <input name="bannerImg" type="hidden" id="bannerImg" value="<?php echo $editresult['bannerImg']; ?>">

								<input name="adult" type="hidden" id="adult" value="1"> 

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='addoptionhotelopenb2b' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 

$hotelId=$editresult['hotelId'];

 

$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'" '); 

$quotationData=mysqli_fetch_array($a);





$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('Y-m-d',strtotime($_REQUEST['enddate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate']));

$todate=date('Y-m-d', strtotime($editresult['checkOutDate'])); 

}





if($_REQUEST['filledhotelid']!=''){

$a=GetPageRecord('*','hotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$_REQUEST['filledhotelid'].'" '); 

$editresult=mysqli_fetch_array($a);

$hotelId=$editresult['id'];

}  

 ?>

 

<?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-6">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label>

						  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

									<div class="input-group input-group-lg">   

  

  <select class="form-control" name="travelFromCity" id="pickupCityfromCity"> 

					<option value="<?php echo stripslashes($_REQUEST['destination']); ?>"><?php echo getdestinationname($_REQUEST['destination']); ?></option> 

					

									</select>

							

  

						  </div>

				      </div> 

				      </div>

						 <div class="col-md-6">

						<div class="form-group">

									<label>Hotel Category<span class="text-danger">*</span></label> 

									<select id="hotelCategory" name="hotelCategory" class="form-control"> 

                                      <?php   

$rs=GetPageRecord('*','sys_hotelCategory',' 1 order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

                                      <option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['category']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

				      </div>

						   

						   <input name="hotelId" id="hotelId" type="hidden" value="<?php echo $hotelId; ?>" />

						    <div class="col-md-12">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchHotelOpen('name','nope','searchhotellist');"  >

						   </div> 

						   </div>

						   

						    

						   

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Room Type <span class="text-danger">*</span></label>

									 

									

									<select id="roomType" name="roomType" class="form-control"> 

					<?php    

					

					$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$hotelId.'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'" group by roomTypeId order by id desc');

					while($rest=mysqli_fetch_array($rs)){ 

					?>

					<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['roomType']){ ?>selected="selected"<?php } ?>><?php echo gethotelroomtype($rest['roomTypeId']); ?> - <?php echo $rest['adultCost']; ?> <?php echo currencyname($rest['currencyId']); ?></option>

					<?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-6">

						<div class="form-group">

									<label>Meal Plan<span class="text-danger">*</span></label> 

									

									<select id="mealPlan" name="mealPlan" class="form-control"> 

					<?php   

					$rs=GetPageRecord('*','sys_HotelMealPlanCost',' hotelId="'.$hotelId.'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'" group by mealPlanId order by id desc');

					while($rest=mysqli_fetch_array($rs)){ 

					?>

					<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['mealPlan']){ ?>selected="selected"<?php } ?>><?php echo gethotelmealplan($rest['mealPlanId']); ?> - <?php echo $rest['adultCost']; ?> <?php echo currencyname($rest['currencyId']); ?></option>

					<?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						   

						        <div class="col-md-6" style="display:none;">

						<div class="form-group">

									<label>Check-In Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div>

						   

						   

						     <div class="col-md-4">

						<div class="form-group">

									<label>Nights Stay<span class="text-danger">*</span></label>  

									<select name="checkOutDate" class="form-control" id="checkOutDate">

	<?php $n=1; for ($x = 1; $x <= ($quotationData['nights']-($_REQUEST['dayId']-1)); $x++) { ?>

	<option value="<?php echo date('Y-m-d',strtotime($_REQUEST['startdate']. ' + '.$x.' days')); ?>" <?php if(date('Y-m-d',strtotime($_REQUEST['startdate']. ' + '.$x.' days'))==$todate){ ?>selected="selected"<?php } ?>><?php echo $n;  ?></option>

	<?php $n++; } ?>

						  </select>

						   </div> 

						   </div>

						   

						   

						   <script>

				$( function() {

				$( "#checkInDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#checkOutDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				</script>

				

				

				     <div class="col-md-4">

						<div class="form-group">

									<label>Check-In Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

									

			 							

					   </div> 

				      </div>

						   

						   

						     <div class="col-md-4">

						<div class="form-group">

									<label>Check-Out Time</label>

									  

									

										<select  name="checkOutTime" class="form-control"  id="checkOutTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

	 

	

	<?php 

	if($editresult['checkOutTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkOutTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

		 	

						   </div> 

						   </div>

						     

						   

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>About Hotel</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails" placeholder="Write here about hotel"><?php  echo stripslashes($editresult['eventDetails']); ?><?php  echo stripslashes($editresult['hotelDetails']); ?></textarea>

						   </div> 

						   </div> 

						   

						   

						   <div style="display:none;">

						   

						   <div class="col-md-12 hideinpackage">

						<div class="form-group">

									<label>Show Price <span class="text-danger">*</span></label>

						 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

						   </div> 

						   </div>

						   

						   

						 <div class="col-md-2">

						<div class="form-group">

									<label>Single Room No.</label>

									<input name="singleRoom" type="number" class="form-control" id="singleRoom" value="<?php echo stripslashes($editresult['singleRoom']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Double Room No.</label>

									<input name="doubleRoom" type="number" class="form-control" id="doubleRoom" value="<?php echo stripslashes($editresult['doubleRoom']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Triple Room No.</label>

									<input name="tripleRoom" type="number" class="form-control" id="tripleRoom" value="<?php echo stripslashes($editresult['tripleRoom']); ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Extra Adult No.</label>

									<input name="extraAdultRoom" type="number" class="form-control" id="extraAdultRoom" value="<?php echo stripslashes($editresult['extraAdultRoom']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Child With Bed No.</label>

									<input name="childWithBedRoom" type="number" class="form-control" id="childWithBedRoom" value="<?php echo stripslashes($editresult['childWithBedRoom']); ?>">

						   </div> 

						   </div>

						   

						   

						   

						   

						    <div class="col-md-12">

										<div class="form-group" style="color:#FF0000;">

										Room price should be per room per night</div>

							 </div>

						   

						   

						   

						   

						    <div class="col-md-2">

						<div class="form-group">

									<label>Single Price</label>

									<input name="singleRoomCost" type="number" class="form-control" id="singleRoomCost" value="<?php echo stripslashes($editresult['singleRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Double Price</label>

									<input name="doubleRoomCost" type="number" class="form-control" id="doubleRoomCost" value="<?php echo stripslashes($editresult['doubleRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Triple Price</label>

									<input name="tripleRoomCost" type="number" class="form-control" id="tripleRoomCost" value="<?php echo stripslashes($editresult['tripleRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-2">

						<div class="form-group">

									<label>Extra Price</label>

									<input name="extraAdultRoomCost" type="number" class="form-control" id="extraAdultRoomCost" value="<?php echo stripslashes($editresult['extraAdultRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Child With Bed Price</label>

									<input name="childWithBedRoomCost" type="number" class="form-control" id="childWithBedRoomCost" value="<?php echo stripslashes($editresult['childWithBedRoomCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						       

							   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>   

							   

							   

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none;">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						</div>

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventHotelOpenb2b"> 

								  <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">

 								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php echo $editresult['eventPhoto']; ?><?php echo $editresult['hotelPhoto']; ?>">

				  </div>

</form>

<?php } ?>















<?php if($_REQUEST['action']=='addsightseeingdetailsb2b' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);





 

$sightseeingId=$editresult['sightseeingId'];

 }



$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);





$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate'])); 

}





if($_REQUEST['filledsightseeingid']!=''){

$a=GetPageRecord('*','sightseeingMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$_REQUEST['filledsightseeingid'].'" '); 

$editresult=mysqli_fetch_array($a);



$sightseeingId=$editresult['id'];

}





 

 

 ?>

 

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">  

									  

														 

														 <select class="form-control" name="travelFromCity" id="pickupCityfromCity"> 

					<option value="<?php echo stripslashes($_REQUEST['destination']); ?>"><?php echo getdestinationname($_REQUEST['destination']); ?></option> 

					

									</select> 

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-12">

						<div class="form-group">

									<label>Sightseeing<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchsightseeinglist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchSightseeing('name','nope','searchsightseeinglist');"  >

						   <input name="sightseeingId" id="sightseeingId" type="hidden" value="<?php echo $sightseeingId; ?>" />

						   <input name="noOfVehicle" id="noOfVehicle" type="hidden" value="1" />

						   </div> 

						   </div>

						   

						   

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Vehicle<span class="text-danger">*</span></label> 

									<select id="vehicleId" name="vehicleId" class="form-control"> 

					<?php    

					

					$rs=GetPageRecord('*','sys_vehicleCost',' sightseeingId="'.$sightseeingId.'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'" group by vehicleId order by id desc');

					while($rest=mysqli_fetch_array($rs)){ 

					?>

					<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['vehicleId']){ ?>selected="selected"<?php } ?>><?php echo vehiclename($rest['vehicleId']); ?> (<?php echo vehiclenamepax($rest['vehicleId']); ?> Pax) - <?php echo $rest['adultCost']; ?> <?php echo currencyname($rest['currencyId']); ?></option>

					<?php }  ?>

                                    </select> </div> 

						   </div>

						   

						   

						    

						     

						        <div class="col-md-4" style="display:none;">

						<div class="form-group">

									<label>Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div> 

						   

						   

						 

				

				

				     <div class="col-md-4">

						<div class="form-group">

									<label>Duration</label>

									<input name="eventDuration" type="text" class="form-control" id="eventDuration" value="<?php  if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDuration']);  } else {  ?><?php echo stripslashes($editresult['sectionDuration']); }  ?>">

					   </div> 

				      </div>

						    

							

							<div class="col-md-4">

						<div class="form-group">

									<label>Start Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

		 					

						   </div> 

						   </div>

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails"  ><?php if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDetails']); } else {  ?><?php  echo stripslashes($editresult['sectionDetails']); } ?></textarea>

						   </div> 

						   </div> 

						   

						   <div style="display:none;">

						   

						   

						    <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 	 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

						   </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($editresult['adultCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						              <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						</div>

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventSightseeingb2b">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

							    <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>"> 

								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php if($_REQUEST['filledsightseeingid']==''){ echo $editresult['eventPhoto']; } else { ?><?php echo $editresult['sectionPhoto']; } ?>">

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addactivitydetailsb2b' && $_REQUEST['quotationid']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);





 

$activityId=$editresult['activityId'];

$adultCost=$editresult['adultCost'];

 }



$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



$a=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$quotationData['queryId'].'"'); 

$queryData=mysqli_fetch_array($a);





$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate'])); 

}





if($_REQUEST['filledsightseeingid']!=''){

$a=GetPageRecord('*','activityMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$_REQUEST['filledsightseeingid'].'" '); 

$editresult=mysqli_fetch_array($a);



$activityId=$editresult['id'];



$a=GetPageRecord('*','sys_ActivityCost',' activityId="'.$editresult['id'].'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id desc');

$editresultrate=mysqli_fetch_array($a);



$adultCost=$editresultrate['adultCost'];

}





 

 

 ?>

 

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">  

									  

														 

														 <select class="form-control" name="travelFromCity" id="pickupCityfromCity"> 

					<option value="<?php echo stripslashes($_REQUEST['destination']); ?>"><?php echo getdestinationname($_REQUEST['destination']); ?></option> 

					

									</select> 

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-9">

						<div class="form-group">

									<label>Activity<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchsightseeinglist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchActivity('name','nope','searchsightseeinglist');"  >

						   <input name="activityId" id="activityId" type="hidden" value="<?php echo $activityId; ?>" />

						  

						   </div> 

						   </div>

						   

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Per Person<span class="text-danger">*</span></label> 

									

				

									

									

									<select id="adultCost2" name="adultCost2" class="form-control">  

					<option value="<?php echo stripslashes($adultCost); ?>"><?php echo stripslashes($adultCost); ?> <?php echo currencyname($LoginUserBranchDetails['currency']); ?></option>

					  </select>

						   </div> 

						   </div>

						   

						   

						    

						     

						        <div class="col-md-4" style="display:none;">

						<div class="form-group">

									<label>Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div> 

						   

						   

						 

				

				

				     <div class="col-md-4">

						<div class="form-group">

									<label>Duration</label>

									<input name="eventDuration" type="text" class="form-control" id="eventDuration" value="<?php  if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDuration']);  } else {  ?><?php echo stripslashes($editresult['sectionDuration']); }  ?>">

					   </div> 

				      </div>

						    

							

							<div class="col-md-4">

						<div class="form-group">

									<label>Start Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

		 					

						   </div> 

						   </div>

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails"  ><?php if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDetails']); } else {  ?><?php  echo stripslashes($editresult['sectionDetails']); } ?></textarea>

						   </div> 

						   </div> 

						   

						   <div style="display:none;">

						   

						   

						    <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 	 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

						   </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($adultCost); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						              <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						</div>

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventActivityb2b">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

							    <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>"> 

								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php if($_REQUEST['filledsightseeingid']==''){ echo $editresult['eventPhoto']; } else { ?><?php echo $editresult['sectionPhoto']; } ?>">

								 	<input name="adult" type="hidden" id="adult" value="1"> 

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='addcruisedetailsb2b' && $_REQUEST['quotationid']!=''){     



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);





 

$cruiseId=$editresult['cruiseId'];

$adultCost=$editresult['adultCost'];

 }



$a=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['quotationid']).'"'); 

$quotationData=mysqli_fetch_array($a);



  

$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate'])); 

 

 

if($editresult['id']!=''){

$fromdate=date('d-m-Y', strtotime($editresult['checkInDate'])); 

}





if($_REQUEST['filledsightseeingid']!=''){

$a=GetPageRecord('*','cruseMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$_REQUEST['filledsightseeingid'].'" '); 

$editresult=mysqli_fetch_array($a);



$cruiseId=$editresult['id'];



$a=GetPageRecord('*','sys_CruseCost',' cruseId="'.$editresult['id'].'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'"  order by id desc');

$editresultrate=mysqli_fetch_array($a);



$adultCost=$editresultrate['adultCost'];

$cruiseId=$editresultrate['cruseId'];

}





 

 

 ?>

 

 <?php if($_REQUEST['package']==1){ ?>

<style>

.hideinpackage{display:none;}

</style>

<?php } ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Travel Location<span class="text-danger">*</span></label> 

									<div class="input-group input-group-lg">  

									  

														 

														 <select class="form-control" name="travelFromCity" id="pickupCityfromCity"> 

					<option value="<?php echo stripslashes($_REQUEST['destination']); ?>"><?php echo getdestinationname($_REQUEST['destination']); ?></option> 

					

									</select> 

						  </div>

				      </div> 

				      </div>

						  

						   

						   

						    <div class="col-md-9">

						<div class="form-group">

									<label>Activity<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchsightseeinglist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" onkeyup="getSearchCruise('name','nope','searchsightseeinglist');"  >

						   <input name="cruiseId" id="cruiseId" type="hidden" value="<?php echo $cruiseId; ?>" />

						  

						   </div> 

						   </div>

						   

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Seat Category<span class="text-danger">*</span></label> 

														<select id="seatId" name="seatId" class="form-control"> 

					<?php    

					

					$rs=GetPageRecord('*','sys_CruseCost',' cruseId="'.$cruiseId.'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" and parentId="'.$LoginUserDetails['parentId'].'" group by seatId order by id desc');

					while($rest=mysqli_fetch_array($rs)){ 

					?>

					<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['seatId']){ ?>selected="selected"<?php } ?>><?php echo cruiseSeatName($rest['seatId']); ?> - <?php echo $rest['adultCost']; ?> <?php echo currencyname($rest['currencyId']); ?></option>

					<?php }  ?>

                                    </select>

									

									

								 

						   </div> 

						   </div>

						   

						   

						    

						     

						        <div class="col-md-4" style="display:none;">

						<div class="form-group">

									<label>Date<span class="text-danger">*</span></label>

									<input name="checkInDate" type="text" class="form-control" id="checkInDate" value="<?php echo $fromdate; ?>">

						   </div> 

						   </div> 

						   

						   

						 

				

				

				     <div class="col-md-4">

						<div class="form-group">

									<label>Duration</label>

									<input name="eventDuration" type="text" class="form-control" id="eventDuration" value="<?php  if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDuration']);  } else {  ?><?php echo stripslashes($editresult['sectionDuration']); }  ?>">

					   </div> 

				      </div>

						    

							

							<div class="col-md-4">

						<div class="form-group">

									<label>Start Time</label>

									

									

									

									<select  name="checkInTime" class="form-control"  id="checkInTime" autocomplete="off"   >  

	<option value="00:00" >00:00</option>      

 <?php 

	if($editresult['checkInTime']!=''){  

	 $selectedtime=date('g:i A',strtotime($editresult['checkInTime']));

	 } else { 

	 $selectedtime=date('Y-m-d 13:00:00');

	  }

	

	

	$thisday=date('Y-m-d'); 

	$start=strtotime('00:00');  

	$end=strtotime('23:30');  

	for ($i=$start;$i<=$end;$i = $i + 15*60)  

	{  

	$thisdaytime=date('H:i:s',$i); 

	$newthisday=date('Y-m-d H:i:s',strtotime($thisday.' '.$thisdaytime)); 

	?>

	<option value="<?php echo $newthisday; ?>" <?php if(date('g:i A',$i)==$selectedtime){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>   

	<?php  }  ?>  

	

	

</select>

		 					

						   </div> 

						   </div>

						   

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="eventDetails" rows="3" class="form-control" id="eventDetails"  ><?php if($_REQUEST['filledsightseeingid']==''){ echo stripslashes($editresult['eventDetails']); } else {  ?><?php  echo stripslashes($editresult['sectionDetails']); } ?></textarea>

						   </div> 

						   </div> 

						   

						   <div style="display:none;">

						   

						   

						    <?php if($_REQUEST['qt']=='other'){ ?>  

					<div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Price<span class="text-danger">*</span></label>

						 	 <select id="perPerson" name="perPerson" class="form-control select-clear"   autocomplete="off" > 

						 <?php if($_REQUEST['package']!=1){ ?>

                       <option value="0" <?php if(0==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Per Person</option>

					   <?php } ?> 

                       <option value="1" <?php if(1==$editresult['perPerson']){ ?>selected="selected"<?php } ?>>Total Price</option> 

                        </select>

				      </div> 

						   </div>

						 <div class="col-md-3">

						<div class="form-group">

									<label>Per Adult (<?php echo $queryData['adult']; ?>) <span class="text-danger">*</span></label>

									<input name="adultCost" type="number" class="form-control" id="adultCost" value="<?php echo stripslashes($adultCost); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Child (<?php echo $queryData['child']; ?>) <span class="text-danger">*</span></label>

									<input name="childCost" type="number" class="form-control" id="childCost" value="<?php echo stripslashes($editresult['childCost']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Per Infant  (<?php echo $queryData['infant']; ?>) <span class="text-danger">*</span></label>

									<input name="infantCost" type="number" class="form-control" id="infantCost" value="<?php echo stripslashes($editresult['infantCost']); ?>">

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Markup</label>

									<input name="quotationMarkup" type="number" class="form-control" id="quotationMarkup" value="<?php echo stripslashes($editresult['quotationMarkup']); ?>">

						   </div> 

						   </div>

						   

						   	<?php

					$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

					$branchData=mysqli_fetch_array($ab);

					?>

						  

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                     

									 

									  <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>				



                      <?php if($editresult['currencyId']>0){ ?>

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$editresult['currencyId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } else { ?>

					  

					 <option value="<?php echo $rest['id']; ?>"  <?php if($rest['id']==$branchData['currency']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

					 <?php } ?>

					 

					 

					 

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						   

						              <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Tax Apply On<span class="text-danger">*</span></label>

									<select id="taxApply" name="taxApply" class="form-control"  autocomplete="off" >  

                                      <option value="0" <?php if(0==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Total Price</option>

                                      <option value="1" <?php if(1==$editresult['taxApply']){ ?>selected="selected"<?php } ?>>Markup Only</option> 

                                    </select>

						   </div> 

						   </div>

						   

						   

						   <div class="col-md-3 hideinpackage">

						<div class="form-group">

									<label>Show Tax Details<span class="text-danger">*</span></label>

									<select id="showTaxDetails" name="showTaxDetails" class="form-control"  autocomplete="off" >  

                                      <option value="1" <?php if(1==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>Yes</option>

                                      <option value="0" <?php if(0==$editresult['showTaxDetails']){ ?>selected="selected"<?php } ?>>No</option> 

                                    </select>

						   </div> 

						   </div>

						   <div class="col-md-12 hideinpackage"> 

						   

						   <div style="border:1px solid #ddd; padding:0px; margin-bottom:20px;">

						   <div style="padding:10px; background-color:#F0F0F0; font-weight:500;">Apply Taxes</div>

						   <div style="padding:20px;">

						   

				 

						   

						   <?php if($branchData['taxValue1']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="CGST" type="checkbox" class="custom-control-input" id="CGST" value="<?php echo stripslashes($branchData['taxValue1']); ?>" <?php if($editresult['CGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="CGST"><?php echo stripslashes($branchData['taxValue1']); ?>% <?php echo stripslashes($branchData['taxName1']); ?></label> <input name="taxName1" type="hidden" value="<?php echo stripslashes($branchData['taxName1']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						  <?php if($branchData['taxValue2']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="SGST" type="checkbox" class="custom-control-input" id="SGST" value="<?php echo stripslashes($branchData['taxValue2']); ?>" <?php if($editresult['SGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="SGST"><?php echo stripslashes($branchData['taxValue2']); ?>% <?php echo stripslashes($branchData['taxName2']); ?></label> <input name="taxName2" type="hidden" value="<?php echo stripslashes($branchData['taxName2']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue3']>0){ ?>

						   <div class="form-group"> 

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="IGST" type="checkbox" class="custom-control-input" id="IGST" value="<?php echo stripslashes($branchData['taxValue3']); ?>" <?php if($editresult['IGSTValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="IGST"><?php echo stripslashes($branchData['taxValue3']); ?>% <?php echo stripslashes($branchData['taxName3']); ?></label> <input name="taxName3" type="hidden" value="<?php echo stripslashes($branchData['taxName3']); ?>" />

									</div> 

						</div>

						<?php } ?>

						

						

						 <?php if($branchData['taxValue4']>0){ ?>

						   <div class="form-group"  style="margin-bottom:0px; display:none; ">

									<div class="custom-control custom-checkbox custom-control-inline">

										<input name="TCS" type="checkbox" class="custom-control-input" id="TCS" value="<?php echo stripslashes($branchData['taxValue4']); ?>" <?php if($editresult['TCSValue']>0){ ?>checked<?php } ?>>

										<label class="custom-control-label" for="TCS"><?php echo stripslashes($branchData['taxValue4']); ?>% <?php echo stripslashes($branchData['taxName4']); ?></label> 									<input name="taxName4" type="hidden" value="<?php echo stripslashes($branchData['taxName4']); ?>" />

									</div> 

						</div>

						<?php } ?>

						</div>

						   </div>

						

						

						

						</div>

						

						<?php } ?>

						</div>

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventCruiseb2b">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

							    <input name="dayId" type="hidden" id="dayId" value="<?php echo $_REQUEST['dayId']; ?>"> 

								<input name="eventPhoto" type="hidden" id="eventPhoto" value="<?php if($_REQUEST['filledsightseeingid']==''){ echo $editresult['eventPhoto']; } else { ?><?php echo $editresult['sectionPhoto']; } ?>">

								 	<input name="adult" type="hidden" id="adult" value="1"> 

				  </div>

</form>

<?php } ?>













<?php if($_REQUEST['action']=='addagentcategorylibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_agentMarginCategory',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-8">

						<div class="form-group">

									<label>Agent Category Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

							

							<div class="col-md-3">

						<div class="form-group">

									<label>Package / Person</label> 

									<input name="packageMarginValue" type="number" class="form-control" id="packageMarginValue" value="<?php echo stripslashes($editresult['packageMarginValue']); ?>"    >

						   </div> 

						   </div>

							<div class="col-md-3">

						<div class="form-group">

									<label>Hotel / Room</label> 

									<input name="hotelMarginValue" type="number" class="form-control" id="hotelMarginValue" value="<?php echo stripslashes($editresult['hotelMarginValue']); ?>"    >

						   </div> 

						   </div>

							<div class="col-md-3">

						<div class="form-group">

									<label>Sightseeing / Vehicle</label> 

									<input name="sightseeingMarginValue" type="number" class="form-control" id="sightseeingMarginValue" value="<?php echo stripslashes($editresult['sightseeingMarginValue']); ?>"    >

						   </div> 

						   </div>

							<div class="col-md-3">

						<div class="form-group">

									<label>Activity / Person</label> 

									<input name="activityMarginValue" type="number" class="form-control" id="activityMarginValue" value="<?php echo stripslashes($editresult['activityMarginValue']); ?>"    >

						   </div> 

						   </div>

							<div class="col-md-3">

						<div class="form-group">

									<label>Curise / Person</label> 

									<input name="cruiseMarginValue" type="number" class="form-control" id="cruiseMarginValue" value="<?php echo stripslashes($editresult['cruiseMarginValue']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Currency<span class="text-danger">*</span></label>

									<select id="currencyId" name="currencyId" class="form-control select-clear" displayname="Currency"  data-placeholder="Select Currency" autocomplete="off" > 

                                      <?php   

$rs=GetPageRecord('*','apiCurrencyMaster',' 1 order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?>

    <option value="<?php echo $rest['id']; ?>" <?php if($editresult['id']==''){ if($rest['id']==$LoginUserBranchDetails['currency']){ ?>selected="selected"<?php } } else { if($editresult['currencyId']==$rest['id']){ ?>selected="selected"<?php }  } ?>><?php echo $rest['name']; ?></option>

                                      <?php }  ?>

                                    </select>

						   </div> 

						   </div>

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveAgentCategoryLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

 								<input name="eventPhotoold" type="hidden" id="eventPhotoold" value="<?php echo $editresult['hotelPhoto']; ?>">

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addcruiseseatlibrary'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_CruiseSeatMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-8">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Status</label>

									

									

									

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveCruiseSeatLibrary">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='updateAgentWebsitePages' && $_REQUEST['id']!=''){

 

  

$a=GetPageRecord('*','sys_agentWebsitePages',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

 

 ?> 

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('pageDescription'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-6">

						<div class="form-group">

									<label>Page Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="pageName" type="text" class="form-control" id="pageName" value="<?php echo stripslashes($editresult['pageName']); ?>" readonly="" >

						   </div> 

						   </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Status</label> 

						<select  name="status" class="form-control"  id="status" autocomplete="off" >  

						<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>In-Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >Active</option>    

						</select> 	

						   </div> 

						   </div>

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Page Title<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="pageTitle" type="text" class="form-control" id="pageTitle" value="<?php echo stripslashes($editresult['pageTitle']); ?>"    >

						   </div> 

						   </div>

						   <div class="col-md-12">

						<div class="form-group">

									<label>Page Description</label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									 <textarea name="pageDescription" rows="15" class="form-control" id="pageDescription"><?php echo stripslashes($editresult['pageDescription']); ?></textarea>

						   </div> 

						   </div>

						   

						     

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="updateAgentWebsitePages">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

								 <input name="agentId" type="hidden" id="agentId" value="<?php echo $_REQUEST['agentId']; ?>"> 

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addNewsEvents' && $_REQUEST['agentId']!=''){

 

  

$a=GetPageRecord('*','sys_agentNewsEvents',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

 

 ?> 

  <script type="text/javascript"> 

	var editor = CKEDITOR.replace('packageItinerary'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Title<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Image</label> 

									<input name="image" type="file" class="form-control" id="pageName" > 	

									<input name="oldimage" type="hidden" id="oldimage" value="<?php echo $editresult['image']; ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Status</label> 

						<select  name="status" class="form-control"  id="status" autocomplete="off" >  

						<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>In-Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >Active</option>    

						</select> 	

						   </div> 

						   </div>

						   

						    

						   <div class="col-md-12">

						<div class="form-group">

									<label>Page Description</label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									 <textarea name="description" rows="5" class="form-control" id="packageItinerary"><?php echo stripslashes($editresult['description']); ?></textarea>

						   </div> 

						   </div>

						   

						     

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addNewsEvents">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

								 <input name="agentId" type="hidden" id="agentId" value="<?php echo $_REQUEST['agentId']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addagentgallery' && $_REQUEST['agentId']!=''){ ?> 

  

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Image<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="image[]" multiple type="file" class="form-control" id="pageName" >

						   </div> 

						   </div> 

						     

					</div>

					

		   </div>

			<hr />

			<div class="col-md-12">

					<div class="row" id="loadgallery">

					    

					</div>

					<script>

							function deleteimg(id,agentId){

								if(confirm('Are you sure want to delete?')){

								$('#loadgallery').load('load_agentgallery.php?dltid='+id+'&agentId='+agentId);

								}

							}

							

							

							function loadagentgallery(agentId){

							$('#loadgallery').load('load_agentgallery.php?agentId='+agentId);

							}

							loadagentgallery('<?php echo $_REQUEST['agentId']; ?>');

						</script>

		   </div>					

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Upload &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addagentgallery">   

								 <input name="agentId" type="hidden" id="agentId" value="<?php echo $_REQUEST['agentId']; ?>"> 

								  <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addflightname'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_flightName',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Name<span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						    

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Logo</label>

									<input name="companyLogo" type="file" class="form-control" id="logoimage" style="padding: 4px;">

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveFlightName">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

								 <input name="oldcompanyLogo" type="hidden" id="bannerImg" value="<?php echo $editresult['details']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addblockflights'){

 



$fromdate=date('d-m-Y',strtotime($_REQUEST['startdate']));

$todate=date('d-m-Y',strtotime($_REQUEST['enddate'])); 

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','blockFlightMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 

				 
									
									<select name="name" class="form-control">

<?php 

$supplier=GetPageRecord('*','sys_flightName',' status=1 order by name asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["name"]; ?>" <?php if($flight["name"]==$editresult['name']){ ?> selected="selected" <?php } ?>><?php echo $flight["name"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1">Active</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addblockflights">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 
								
								<input name="typeid" type="hidden" id="editid" value="<?php echo $_REQUEST['typeid']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addfaretypeblockflights' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">
<div class="col-md-12">

						<div class="form-group">

									<label>Sector Type<span class="text-danger">*</span></label> 
									
									<select name="sectorType" class="form-control"> 
	<option value="D">Domestic</option>
	<option value="I">International</option> 
</select>

						   </div> 

						   </div>
					   

						     <div class="col-md-9">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label>

			 
									
									<select name="name" class="form-control">

<?php 

$supplier=GetPageRecord('*','fareTypeMaster',' flightName="'.$_REQUEST['name'].'" order by displayType asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["displayType"]; ?>"  ><?php echo $flight["displayType"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						    

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="addfaretypeblockflights">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="blockFlightId" type="hidden" id="blockFlightId" value="<?php echo $_REQUEST['id']; ?>">  
									<input name="typeid" type="hidden" id="editid" value="<?php echo $_REQUEST['typeid']; ?>"> 

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_faretypeblockflights.php?id=<?php echo $_REQUEST['id']; ?>&flightname=<?php echo str_replace(' ','%20',$_REQUEST['name']); ?>');

}



function loadcrusecostdlt(dlt){

$('#load_crusecost').load('load_faretypeblockflights.php?id=<?php echo $_REQUEST['id']; ?>&flightname=<?php echo str_replace(' ','%20',$_REQUEST['name']); ?>&dltid='+dlt);

}





loadcrusecost();

</script>

<?php } ?>









<?php if($_REQUEST['action']=='addmanualflights'){



$fromdate=date('d-m-Y');

$todate=date('d-m-Y'); 



if($_REQUEST['id']!=''){

$a=GetPageRecord('*','manualFlightMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

  

$fromdate=date('d-m-Y', strtotime($editresult['fromDate']));

$todate=date('d-m-Y', strtotime($editresult['toDate'])); 

 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-3">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 
 
									
									
									<select name="name" class="form-control">

<?php 

$air=GetPageRecord('*','sys_flightName','  1 order by id asc');  
while($airline=mysqli_fetch_array($air)){

?> 
	<option value="<?php echo $airline["name"]; ?>" <?php if($airline['name']==$editresult['name']){ ?> selected="selected" <?php } ?>><?php echo $airline["name"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						   

						    <div class="col-md-3">

						<div class="form-group">

									<label>Flight Code<span class="text-danger">*</span></label> 

									<input name="flightCode" type="text" class="form-control" id="flightCode" value="<?php echo stripslashes($editresult['flightCode']); ?>"    >

						   </div> 

						   </div>
<div class="col-md-3">

						<div class="form-group">

									<label>Flight No<span class="text-danger">*</span></label> 

									<input name="flightNo" type="text" class="form-control" id="flightNo" value="<?php echo stripslashes($editresult['flightNo']); ?>"    >

						   </div> 

						   </div>
						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label> 

									<input name="fareType" type="text" class="form-control" disabled="disabled" id="fareType" value="FIXEDMF"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Logo</label>

									<input name="img" type="file" class="form-control" id="logoimage" style="padding: 4px;">

									<input name="oldimg" type="hidden" class="form-control" id="oldimg" style="padding: 4px;" value="<?php echo stripslashes($editresult['img']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Departure (Code)</label> 

									<input name="departure" type="text" class="form-control" id="departure" value="<?php echo stripslashes($editresult['departure']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Departure Time</label> 

									<input name="departureTime" type="text" class="form-control" id="departureTime" value="<?php echo stripslashes($editresult['departureTime']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Duration</label> 

									<input name="duration" type="text" class="form-control" id="duration" value="<?php echo stripslashes($editresult['duration']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Stops</label> 

									<input name="stops" type="text" class="form-control" id="stops" value="<?php echo stripslashes($editresult['stops']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Arrival (Code)</label> 

									<input name="arrival" type="text" class="form-control" id="arrival" value="<?php echo stripslashes($editresult['arrival']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Arrival Time</label> 

									<input name="arrivalTime" type="text" class="form-control" id="arrivalTime" value="<?php echo stripslashes($editresult['arrivalTime']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Base Fare</label> 

									<input name="baseFare" type="text" class="form-control" id="baseFare" value="<?php echo stripslashes($editresult['baseFare']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Surcharges Taxes</label> 

									<input name="surchargesTaxes" type="text" class="form-control" id="surchargesTaxes" value="<?php echo stripslashes($editresult['surchargesTaxes']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Baggage</label> 

									<input name="baggage" type="text" class="form-control" id="baggage" value="<?php echo stripslashes($editresult['baggage']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Check-in</label> 

									<input name="checkin" type="text" class="form-control" id="checkin" value="<?php echo stripslashes($editresult['checkin']); ?>"    >

						   </div> 

						   </div>

						   

						   

						   

						   

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Flight Type</label>  

						<select  name="flightType" class="form-control"  id="flightType" autocomplete="off"   >  

						<option value="D" <?php if($editresult['flightType']=="D" || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Domestic</option>       

						<option value="I" <?php if($editresult['flightType']=="I"){ ?>selected="selected"<?php } ?> >International</option>    

						</select>  		

						   </div> 

						   </div>   

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>  		

						   </div> 

						   </div>
						   
						   <div class="col-md-3">

						<div class="form-group">

									<label>PNR</label> 

									<input name="cabin" type="text" class="form-control" id="cabin" value="<?php echo stripslashes($editresult['cabin']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>From Date<span class="text-danger">*</span></label> 

									<input name="fromDate" type="text" class="form-control" id="fromDate" value="<?php echo $fromdate; ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>To Date<span class="text-danger">*</span></label> 

									<input name="toDate" type="text" class="form-control" id="toDate" value="<?php echo $todate; ?>"    >

						   </div> 

						   </div>

						   

							<script>

								$( function() {

								$( "#fromDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

								$( "#toDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0 });

								} );

							</script>

						   

						   <div class="col-md-3">

								<div class="form-group">

									<label>Supplier</label> 

<select name="supplierId" class="form-control">

<?php 

$supplier=GetPageRecord('*','sys_userMaster',' parentId="'.$LoginUserDetails['parentId'].'"  and  userType="suppliers" order by id asc'); 

while($supplierData=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $supplierData["id"]; ?>" <?php if($supplierData["id"]==$editresult["supplierId"]){ ?> selected="selected" <?php } ?>><?php echo $supplierData["companyName"]; ?></option>

<?php } ?>

</select>

								</div> 

						   </div>

						   <div class="col-md-3">

								<div class="form-group">

									<label>Seat</label> 

<input name="seat" type="text" class="form-control" id="seat" value="<?php echo stripslashes($editresult['seat']); ?>"    >

								</div> 

						   </div>

						   <div class="col-md-12">

						<div class="form-group">

									<label>Message</label>  

						   			<input name="description" type="text" class="form-control" id="description" value="<?php echo stripslashes($editresult['description']); ?>" />

						   </div> 

						   </div>

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Cancellation Policy</label>  

						   			<textarea name="cancellationPolicy" rows="2" class="form-control" id="cancellationPolicy"><?php echo stripslashes($editresult['cancellationPolicy']); ?></textarea>  

						   </div> 

						   </div>

					</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addmanualflights">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addfixeddeparture'){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','fixedDepartureMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-4">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						    <div class="col-md-4">

						<div class="form-group">

									<label>Flight No<span class="text-danger">*</span></label> 

									<input name="flightNo" type="text" class="form-control" id="flightNo" value="<?php echo stripslashes($editresult['flightNo']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label> 

									<input name="fareType" type="text" class="form-control" id="fareType" value="<?php echo stripslashes($editresult['fareType']); ?>"    >

						   </div> 

						   </div>

						   

						   

						    <div class="col-md-4">

								<div class="form-group">

								<label>From Date<span class="text-danger">*</span></label> 

									<input type="text" id="fromDate" name="fromDate" class="form-control" placeholder="From Date" value="<?php if($editresult['fromDate']!=''){echo date("m-d-Y",strtotime($editresult['fromDate']));} ?>"  readonly >

								</div>

							</div>

							

							<div class="col-md-4">

								<div class="form-group">

								<label>To Date<span class="text-danger">*</span></label>

<input type="text" id="toDate" name="toDate" class="form-control" placeholder="To Date" value="<?php if($editresult['toDate']!=''){echo date("m-d-Y",strtotime($editresult['toDate']));} ?>"  readonly >

								</div>

							</div>

<script>

$(function(){

    $("#fromDate").datepicker({ dateFormat: 'dd-mm-yy' });

    $("#toDate").datepicker({ dateFormat: 'dd-mm-yy' });

});

</script> 

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Logo</label>

									<input name="img" type="file" class="form-control" id="logoimage" style="padding: 4px;">

									<input name="oldimg" type="hidden" class="form-control" id="oldimg" style="padding: 4px;" value="<?php echo stripslashes($editresult['img']); ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Departure (Code)</label> 

									<input name="departure" type="text" class="form-control" id="departure" value="<?php echo stripslashes($editresult['departure']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Departure Time</label> 

									<input name="departureTime" type="text" class="form-control" id="departureTime" value="<?php echo stripslashes($editresult['departureTime']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Duration</label> 

									<input name="duration" type="text" class="form-control" id="duration" value="<?php echo stripslashes($editresult['duration']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Stops</label> 

									<input name="stops" type="text" class="form-control" id="stops" value="<?php echo stripslashes($editresult['stops']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Arrival (Code)</label> 

									<input name="arrival" type="text" class="form-control" id="arrival" value="<?php echo stripslashes($editresult['arrival']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Arrival Time</label> 

									<input name="arrivalTime" type="text" class="form-control" id="arrivalTime" value="<?php echo stripslashes($editresult['arrivalTime']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Base Fare</label> 

									<input name="baseFare" type="text" class="form-control" id="baseFare" value="<?php echo stripslashes($editresult['baseFare']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Surcharges Taxes</label> 

									<input name="surchargesTaxes" type="text" class="form-control" id="surchargesTaxes" value="<?php echo stripslashes($editresult['surchargesTaxes']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Baggage</label> 

									<input name="baggage" type="text" class="form-control" id="baggage" value="<?php echo stripslashes($editresult['baggage']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Check-in</label> 

									<input name="checkin" type="text" class="form-control" id="checkin" value="<?php echo stripslashes($editresult['checkin']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Cabin</label> 

									<input name="cabin" type="text" class="form-control" id="cabin" value="<?php echo stripslashes($editresult['cabin']); ?>"    >

						   </div> 

						   </div>

						   

						   

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Flight Type</label>  

						<select  name="flightType" class="form-control"  id="flightType" autocomplete="off"   >  

						<option value="D" <?php if($editresult['flightType']=="D" || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Domestic</option>       

						<option value="I" <?php if($editresult['flightType']=="I"){ ?>selected="selected"<?php } ?> >International</option>    

						</select>  		

						   </div> 

						   </div>   

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>  		

						   </div> 

						   </div>

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Message</label>  

						   			<input name="description" type="text" class="form-control" id="description" value="<?php echo stripslashes($editresult['description']); ?>" />

						   </div> 

						   </div>

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Cancellation Policy</label>  

						   			<textarea name="cancellationPolicy" rows="2" class="form-control" id="cancellationPolicy"><?php echo stripslashes($editresult['cancellationPolicy']); ?></textarea>  

						   </div> 

						   </div>

					</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addfixeddeparture">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='adddomesticflightsmarkup' && $_REQUEST['typeid']!=''){

  

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','domesticFlightsMarkupMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 

									 
									
									<select name="name" class="form-control">

<?php 

$supplier=GetPageRecord('*','sys_flightName',' status=1 order by name asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["name"]; ?>" <?php if($flight["name"]==$editresult['name']){ ?> selected="selected" <?php } ?>><?php echo $flight["name"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1">Active</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="adddomesticflightsmarkup">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 
							    <input name="typeid" type="hidden" id="editid" value="<?php echo $_REQUEST['typeid']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addfaretypedomesticFlightsMarkup' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					   
<div class="col-md-6">

						<div class="form-group">

									<label>Sector Type<span class="text-danger">*</span></label> 
									
									<select name="sectorType" class="form-control"> 
	<option value="D">Domestic</option>
	<option value="I">International</option> 
</select>

						   </div> 

						   </div>
						     <div class="col-md-6">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label> 
									
									<select name="name" class="form-control">

<?php 

$supplier=GetPageRecord('*','fareTypeMaster',' flightName="'.$_REQUEST['name'].'" order by displayType asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["displayType"]; ?>"  ><?php echo $flight["displayType"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						    <div class="col-md-6">

								<div class="form-group">

									<label>Markup<span class="text-danger">*</span></label> 

									<select  name="markupType" class="form-control"  id="markupType" autocomplete="off"   >  

									<option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

									<option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    

									</select>

						   </div> 

						   </div>

						   <div class="col-md-4">

								<div class="form-group">

									<label>Value<span class="text-danger">*</span></label>

									<input name="markupValue" type="text" class="form-control" id="markupValue" value="">

						   </div> 

						   </div>

						      <div class="col-md-1">

							<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="addfaretypedomesticFlightsMarkup">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="flightId" type="hidden" id="flightId" value="<?php echo $_REQUEST['id']; ?>">  
								<input name="typeid" type="hidden" id="editid" value="<?php echo $_REQUEST['typeid']; ?>"> 

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_faretypedomesticFlightsMarkup.php?id=<?php echo $_REQUEST['id']; ?>&flightName=<?php echo str_replace(' ','%20',$_REQUEST['name']); ?>');

}



function loadcrusecostdlt(dlt){

$('#load_crusecost').load('load_faretypedomesticFlightsMarkup.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadcrusecost();

</script>

<?php } ?>











<?php if($_REQUEST['action']=='adddomesticflightscommission'){

  

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','domesticFlightsCommissionMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1">Active</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="adddomesticflightscommission">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='addfaretypedomesticFlightscommission' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

		 

		 <div class="col-md-12">

					<div class="row">

						<table border="0" cellpadding="0">

							<tbody>

								<tr>
								  <td><div class="form-group"><label>Commission Type </label> 
									<select id="commissionType" name="commissionType" class="form-control"   autocomplete="off" >  
 <?php  
$rs=GetPageRecord('*','sys_commissionType','  1 order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['commissionType']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select></div>
							 </td>

									<td>

										<div class="form-group">

										<label>Fare Type<span class="text-danger">*</span></label>

										<input name="name" type="text" class="form-control" id="name" value="">
										</div>									</td>

									<td>

										<div class="form-group">

										<label>Markup<span class="text-danger">*</span></label> 

										<select  name="markupType" class="form-control"  id="markupType" autocomplete="off"   >  

										<option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

										<option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    
										</select>
										</div>									</td>

									<td>

										<div class="form-group">

										<label>Value<span class="text-danger">*</span></label>

										<input name="markupValue" type="text" class="form-control" id="markupValue" value="" style="width: 120px;">
										</div>									</td>

									<td>

										<div class="form-group" style="display:none;">

										<label>Cash Back Type</label> 

										<select  name="cashBackType" class="form-control"  id="cashBackType" autocomplete="off"   >  

										<option value="Flat" <?php if($editresult['cashBackType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

										<option value="%" <?php if($editresult['cashBackType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    
										</select>
										</div>									</td>

									<td>

										<div class="form-group" style="display:none;">

										<label>Cash Back Value</label>

										<input name="cashBackValue" type="text" class="form-control" id="cashBackValue" value="" style="width: 120px;">
										</div>									</td>

									<td>

										<div class="form-group">

										<label>&nbsp;&nbsp;</label><br />


										<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
										</div>									</td>
								</tr>
							</tbody>
					  </table>

 

						

					</div>

					

   </div>

			 



								

			 <input name="action" type="hidden" id="action" value="addfaretypedomesticFlightscommission">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="flightId" type="hidden" id="flightId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_faretypedomesticFlightsCommission.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadcrusecostdlt(dlt,name){

name=encodeURI(name);

$('#load_crusecost').load('load_faretypedomesticFlightsCommission.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt+'&name='+name);

}





loadcrusecost();

</script>

<?php } ?>





<?php if($_REQUEST['action']=='addofflineflightsbooking'){

  

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','offlineflightsbookingMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 

									 
									
									<select name="name" class="form-control">

<?php 

$supplier=GetPageRecord('*','sys_flightName',' status=1 order by name asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["name"]; ?>" <?php if($flight["name"]==$editresult['name']){ ?> selected="selected" <?php } ?>><?php echo $flight["name"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" >Active</option>        

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addofflineflightsbooking">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 
								
								<input name="typeid" type="hidden" id="editid" value="<?php echo $_REQUEST['typeid']; ?>"> 

				  </div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addfaretypeofflineflightsbooking' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					   <div class="col-md-12">

						<div class="form-group">

									<label>Sector Type<span class="text-danger">*</span></label> 
									
									<select name="sectorType" class="form-control"> 
	<option value="D">Domestic</option>
	<option value="I">International</option> 
</select>

						   </div> 

						   </div>

						     <div class="col-md-9">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label>

					 
									
									<select name="name" class="form-control">

<?php 

$supplier=GetPageRecord('*','fareTypeMaster',' flightName="'.$_REQUEST['name'].'" order by displayType asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["displayType"]; ?>"  ><?php echo $flight["displayType"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div>

						    

						   

						      <div class="col-md-1">

						<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="addfaretypeofflineflightsbooking">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="flightId" type="hidden" id="flightId" value="<?php echo $_REQUEST['id']; ?>">  
<input name="typeid" type="hidden" id="editid" value="<?php echo $_REQUEST['typeid']; ?>"> 
</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_faretypeofflineflightsbooking.php?id=<?php echo $_REQUEST['id']; ?>&flightname=<?php echo str_replace(' ','%20',$_REQUEST['name']); ?>');

}



function loadcrusecostdlt(dlt){

$('#load_crusecost').load('load_faretypeofflineflightsbooking.php?id=<?php echo $_REQUEST['id']; ?>&flightname=<?php echo str_replace(' ','%20',$_REQUEST['name']); ?>&dltid='+dlt);

}





loadcrusecost();

</script>

<?php } ?>











<?php if($_REQUEST['action']=='addfaretype'){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','fareTypeMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Flight Name<span class="text-danger">*</span></label> 
 
									
									<select name="flightName" class="form-control">

<?php 

$supplier=GetPageRecord('*','sys_flightName',' status=1 order by name asc'); 

while($flight=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $flight["name"]; ?>" <?php if($flight["name"]==$editresult['flightName']){ ?> selected="selected" <?php } ?>><?php echo $flight["name"]; ?></option>

<?php } ?>

</select>

						   </div> 

						   </div> 

						   
 
						   <div class="col-md-12">

						<div class="form-group">

									<label>Fare Type Name <span class="text-danger"> Enter Comma Separated Ex. <Span style="color:#333333;">FF,RED,MAIN</Span></span></label> 

									<input name="fareTypeName" type="text" class="form-control" id="fareTypeName" value="<?php echo stripslashes($editresult['fareTypeName']); ?>"    >

						   </div> 

						   </div>

						   

						      <div class="col-md-6">

						<div class="form-group">

									<label>Display Type Name<span class="text-danger">*</span></label> 

									<input name="displayType" type="text" class="form-control" id="displayType" value="<?php echo stripslashes($editresult['displayType']); ?>"    >

						   </div> 

						   </div>

						   

						         <div class="col-md-6">

						<div class="form-group">

									<label>Display Color<span class="text-danger">*</span></label> 

									<input name="displayColor" type="color" class="form-control" id="displayColor" value="<?php echo stripslashes($editresult['displayColor']); ?>"  style="height: 36px; padding:0px;"   >

						   </div> 

						   </div>

						     

							 

						   <div class="col-md-12">

						<div class="form-group">

									<label>B2B Description</label>  

						   			<textarea name="description" rows="5" class="form-control" id="description"><?php echo stripslashes($editresult['description']); ?></textarea>

						   </div> 

						   </div>

						   <div class="col-md-12">

						<div class="form-group">

									<label>B2C Description</label>  

						   			<textarea name="b2cDescription" rows="5" class="form-control" id="b2cDescription"><?php echo stripslashes($editresult['b2cDescription']); ?></textarea>

						   </div> 

						   </div>

						   <div class="col-md-12">

						<div class="form-group">

									<label>B2B Cancellation Policy</label>  

						   			<textarea name="cancellationPolicy" rows="5" class="form-control" id="cancellationPolicy"><?php echo stripslashes($editresult['cancellationPolicy']); ?></textarea>

						   </div> 

						   </div>
						   
						   
						    <div class="col-md-12">

						<div class="form-group">

									<label>B2C Cancellation Policy</label>  

						   			<textarea name="b2cCancellationPolicy" rows="5" class="form-control" id="b2cCancellationPolicy"><?php echo stripslashes($editresult['b2cCancellationPolicy']); ?></textarea>

						   </div> 

						   </div>

						   

						    

					</div>

					

		   </div>

 

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addfaretype">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>



<?php if($_REQUEST['action']=='addmarketingcategory'){

	

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','marketingCategory',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

?>

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">

				<div class="col-md-12">

					<div class="form-group">

						<label>Title<span class="text-danger">*</span></label> 

						<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>"    >

					</div> 

				</div> 

				<div class="col-md-12">

					<div class="form-group">

						<label>Status</label>  

						<select name="status" class="form-control">

							<option value="1" <?php if($editresult["status"]==1){ ?> selected="selected" <?php } ?>>Active</option>

							<option value="0" <?php if($editresult["status"]==0){ ?> selected="selected" <?php } ?>>Inactive</option>

						</select>

					</div> 

				</div>

			</div>

		</div>

	</div>

	<div class="card-footer text-right" >

		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

		<input name="action" type="hidden" id="action" value="addmarketingcategory">  

		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

	</div>

</form>

<?php } ?>





<?php if($_REQUEST['action']=='addmarketingbanner'){

	

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','marketingBanner',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

?>

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">

				

				<div class="col-md-12">

					<div class="form-group">

						<label>Title<span class="text-danger">*</span></label> 

						<input name="bannerTitle" type="text" class="form-control" id="bannerTitle" value="<?php echo stripslashes($editresult['bannerTitle']); ?>"    >

					</div> 

				</div> 

				

				<div class="col-md-6">

					<div class="form-group">

						<label>Category</label>  

						<select name="category_id" id="category_id" class="form-control">

<?php

$cat=GetPageRecord('*','marketingCategory','status="1" order by title asc');

while($catData=mysqli_fetch_array($cat)){

?>

<option value="<?php echo $catData['id']; ?>" <?php if($editresult["category_id"]==$catData['id']){ ?> selected="selected" <?php } ?>><?php echo $catData['title']; ?></option>

<?php } ?>

						</select>

					</div> 

				</div>

				

				<div class="col-md-6">

					<div class="form-group">

						<label>Sequence<span class="text-danger">*</span></label> 

						<input name="sequence" type="number" class="form-control" id="sequence" value="<?php echo stripslashes($editresult['sequence']); ?>"    >

					</div> 

				</div>



				<div class="col-md-6">

					<div class="form-group">

						<label>Flyer Image (.PNG)<span class="text-danger">*</span></label> 

						<input name="bannerImage" type="file" class="form-control" id="bannerImage" <?php if($_REQUEST['id']==''){ ?>required="required"<?php } ?>>

					</div> 

				</div>				

				

				

				<div class="col-md-6">

					<div class="form-group">

						<label>Status</label>  

						<select name="status" class="form-control">

							<option value="1" <?php if($editresult["status"]==1){ ?> selected="selected" <?php } ?>>Active</option>

							<option value="0" <?php if($editresult["status"]==0){ ?> selected="selected" <?php } ?>>Inactive</option>

						</select>

					</div> 

				</div>

			</div>

		</div>

	</div>

	<div class="card-footer text-right" >

		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

		<input name="action" type="hidden" id="action" value="addmarketingbanner">  

		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

	</div>

</form>

<?php } ?>









<?php /* if($_REQUEST['action']=='updatePNR' && $_REQUEST['id']!=''){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>PNR No.</label> 

									<input name="pnrNo" type="text" class="form-control" id="pnrNo" value="<?php echo stripslashes($editresult['pnrNo']); ?>"    >

						   </div> 

						   </div>

						   

						    <div class="col-md-12">

						<div class="form-group">

									<label>Ticket No.</label> 

									<input name="ticketNo" type="text" class="form-control" id="ticketNo" value="<?php echo stripslashes($editresult['ticketNo']); ?>"    >

						   </div> 

						   </div>

						     

						    

					</div>

					

					</div>



					 		

								

				  </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="updatePNR">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } */ ?>



<?php if($_REQUEST['action']=='updatePNR' && $_REQUEST['id']!=''){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

<?php if($editresult["bookingType"]==1){ ?>

<input type="hidden" name="type" value="offline">

<?php }else{ ?>

<input type="hidden" name="type" value="online">

<?php } ?>

<div class="col-md-12">

								<div class="form-group">

									<label>API Booking ID</label> 

									<input name="bookingNumber" type="text" class="form-control" id="bookingNumber" value="<?php echo stripslashes($editresult['bookingNumber']); ?>">

								</div> 

						   </div>

						    <div class="col-md-4">

								<div class="form-group">

									<label>PNR No.</label> 

									<input name="pnrNo" type="text" class="form-control" id="pnrNo" value="<?php echo stripslashes($editresult['pnrNo']); ?>">

								</div> 

						   </div>

						   

						   <div class="col-md-4">

								<div class="form-group">

									<label>Supplier</label> 

<select name="supplier" class="form-control">

<?php 
if($LoginUserDetails['userType']=='admin'){
$supplier=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['userid'].'"  and  userType="suppliers" order by id asc'); 
} else { 
$supplier=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'"   and  userType="suppliers" order by id asc');
}
while($supplierData=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $supplierData["companyName"]; ?>" <?php if($supplierData["companyName"]==$editresult["supplier"]){ ?> selected="selected" <?php } ?>><?php echo $supplierData["companyName"]; ?></option>

<?php } ?>

</select>

								</div> 

						   </div>



						   <div class="col-md-4">

								<div class="form-group">

									<label>Update Status</label>

									<select name="status" class="form-control">

										<option value="1" <?php if($editresult["status"]==1){ ?> selected="selected" <?php } ?>>Pending</option>

										<option value="2" <?php if($editresult["status"]==2){ ?> selected="selected" <?php } ?>>Confirmed</option>

										<option value="3" <?php if($editresult["status"]==3){ ?> selected="selected" <?php } ?>>Cancelled</option>

										<option value="4" <?php if($editresult["status"]==4){ ?> selected="selected" <?php } ?>>Rejected</option>

									</select>

									

								</div> 

						   </div>

						   

<!--Passengers wise ticket information-->

<style>

.modal-content table {

  border-collapse: collapse;

  width: 100%;

  margin-bottom:25px;

}



.modal-content td {

  text-align: left;

  padding: 8px;

}



.modal-content tr:nth-child(even){background-color: #f2f2f2}



.modal-content th {

  background-color: #486b88;

  color: white;

  font-weight:500;

}

</style>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="-webkit-print-color-adjust: exact;" >

	<tr>

        <th width="20%">Type</th>

        <th width="50%">Passenger&nbsp;Name</th>

        <th width="30%">Ticket&nbsp;Number</th>

	</tr>

	  <?php 

		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 

		while($paxData=mysqli_fetch_array($rs6)){

	  ?>

	<tr>

        <td><?php echo ucfirst($paxData['paxType']); ?></td>

        <td><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></td>

        <td><input type="hidden" name="rowId[]" value="<?php echo $paxData['id']; ?>"><input type="text" name="ticketNo[]" class="form-control" value="<?php echo $paxData['ticketNo']; ?>"></td>

	</tr>

	<?php } ?>

</table>

<!--End-->

						   

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Remark</label>

									<textarea class="form-control" name="remark"><?php echo $editresult["remark"]; ?></textarea>

								</div> 

						   </div>   

					</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="updatePNR">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='viewTicket' && $_REQUEST['id']!=''){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class=" ">
 

					<?php echo file_get_contents($fullurl.'download_ticket.php?id='.$_REQUEST['id']); ?>	    
					</div> 
		   </div> 			

   </div> 

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addNewTransaction' && $_REQUEST['agentId']!=''){

  

if($_REQUEST['agentId']!=''){

$a=GetPageRecord('*','sys_balanceSheet',' id="'.decode($_REQUEST['agentId']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row"> 

<div class="col-md-12"> 

<div class="form-group">

<label for="validationCustom02">Amount*</label>

  <input name="amount" type="number" class="form-control" id="name" value="" required="" >

</div></div>

 



 <div class="col-md-12" > 

<div class="form-group">

<label for="validationCustom02">Payment Type*</label>   

<select name="paymentType" id="paymentType"  class="form-control" onchange="debcre();" >

<option value="Credit" >Credit</option> 

<option value="Debit" >Debit</option> 

</select>

</div></div>

  <script>

  	function debcre(){

		var paymentType = $('#paymentType').val();

		if(paymentType=='Debit'){ $('.dc').hide(); }else{ $('.dc').show(); }

	}

  </script>

  <div class="col-md-12 paid dc" > 

<div class="form-group">

<label for="validationCustom02">Payment Method*</label>   

<select name="paymentMethod" id="transectionType"  class="form-control" onchange="getreceipt();">

<option value="" >Select</option> 

<option value="Cash" >Cash</option> 

<option value="Cheque" >Cheque</option>

<option value="NEFT" >NEFT</option> 

<option value="Mobile&nbsp;Payment" >Mobile&nbsp;Payment</option> 

<option value="Payzapp" >Payzapp</option>   

<option value="Razorpay" >Razorpay</option>   

<option value="Paypal" >Paypal</option>   

<option value="Payu" >Payu</option>   

<option value="B2C" >B2C</option>   

</select>

</div></div>

<script>

function getreceipt(){

var transectionType = encodeURI($('#transectionType').val());

 

if(transectionType=='Cash'){

$('.receiptfield').show();

$('.trans').hide();

}else{

$('.receiptfield').hide();

$('.trans').show();

}

}



</script>

<div class="col-md-12 receiptfield dc" > 

<div class="form-group">

<label for="validationCustom02">Receipt</label>   

<input type="file" class="form-control" name="companyLogo" />

</div></div>



<div class="col-md-12 paid trans dc" style="display:none;" > 

<div class="form-group">

<label for="validationCustom02">Transaction ID</label>   

<input name="transactionId" type="text" class="form-control" value=" " required="" >

</div></div>



<div class="col-md-12"> 

<div class="form-group">

<label for="validationCustom02">Remark</label>

  <textarea name="remark" rows="2" class="form-control"></textarea>

</div></div>



</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addNewTransaction">  

							    <input name="agentId" type="hidden" id="agentId" value="<?php echo $_REQUEST['agentId']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addsmstemplate'){

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_smsTemplate',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

								<div class="col-md-12">

									<div class="form-group">

										<label>Title<span class="text-danger">*</span></label>

										<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>">

									</div> 

								</div>

								

								<div class="col-md-12">

									<div class="form-group">

										<label>Content<span class="text-danger">*</span></label>

										<textarea name="content" class="form-control" id="content"><?php echo stripslashes($editresult['content']); ?></textarea>

									</div> 

								</div>

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Status</label>		

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>

									

			 							

						   </div> 

						   </div>

						    

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addsmsTemplate">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

				  </div>

</form>

<?php } ?>













<?php

	if($_REQUEST['action']=='addquotationgallery' && $_REQUEST["quotationid"]!=''){

?> 

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">	  

				<div class="col-md-12">

					<div class="form-group">

						<label>Upload Images<span class="text-danger">*</span></label>

						<input name="images[]" type="file" multiple="multiple">

					</div> 

				</div>

			</div>

		</div>

	</div>

	<div class="card-footer text-right" >

		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

		<input name="action" type="hidden" id="action" value="addquotationgallery">  

		<input name="quotationId" type="hidden" id="quotationId" value="<?php echo $_REQUEST['quotationid']; ?>">  

	</div>

</form>

<?php } ?>













<?php if($_REQUEST['action']=='adddomestichotelsmarkup'){

  

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','domesticHotelMarkupMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1">Active</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="adddomestichotelsmarkup">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addfaretypedomesticHotelMarkup' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					   

						     <div class="col-md-5" style="display:none;">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="">

						   </div> 

						   </div>

						    <div class="col-md-4">

								<div class="form-group">

									<label>Markup Type<span class="text-danger">*</span></label> 

									<select  name="markupType" class="form-control"  id="markupType" autocomplete="off"   >  

									<option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

									<option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    

									</select>

						   </div> 

						   </div>

						   <div class="col-md-4">

								<div class="form-group">

									<label>Value<span class="text-danger">*</span></label>

									<input name="markupValue" type="text" class="form-control" id="markupValue" value="">

						   </div> 

						   </div>

						      <div class="col-md-1">

							<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="addfaretypedomesticHotelMarkup">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_faretypedomesticHotelsMarkup.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadcrusecostdlt(dlt){

$('#load_crusecost').load('load_faretypedomesticHotelsMarkup.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt);

}





loadcrusecost();

</script>

<?php } ?>









<?php if($_REQUEST['action']=='adddomestichotelscommission'){

  

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','domesticHotelsCommissionMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1">Active</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="adddomestichotelscommission">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='addfaretypedomesticHotelscommission' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					   

						     <div class="col-md-5" style="display:none;">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="">

						   </div> 

						   </div>

						    <div class="col-md-4">

								<div class="form-group">

									<label>Commission Type<span class="text-danger">*</span></label> 

									<select  name="markupType" class="form-control"  id="markupType" autocomplete="off"   >  

									<option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

									<option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    

									</select>

						   </div> 

						   </div>

						   <div class="col-md-4">

								<div class="form-group">

									<label>Value<span class="text-danger">*</span></label>

									<input name="markupValue" type="text" class="form-control" id="markupValue" value="">

						   </div> 

						   </div>

						      <div class="col-md-1">

							<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

			 <input name="action" type="hidden" id="action" value="fareTypedomesticHotelsCommissionMaster">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="hotelId" type="hidden" id="hotelId" value="<?php echo $_REQUEST['id']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_faretypedomesticHotelsCommission.php?id=<?php echo $_REQUEST['id']; ?>');

}



function loadcrusecostdlt(dlt,name){

name=encodeURI(name);

$('#load_crusecost').load('load_faretypedomesticHotelsCommission.php?id=<?php echo $_REQUEST['id']; ?>&dltid='+dlt+'&name='+name);

}





loadcrusecost();

</script>

<?php } ?>









<?php if($_REQUEST['action']=='callbackrequest'){

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','callBackRequest',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off">  

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?>>Pending</option>      

						<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>Confirmed</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="callbackrequest">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo encode($editresult['id']); ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='ticketcancelrequest'){

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','ticketCancelRequest',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">

				<div class="col-md-12">

					<div class="form-group">

						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="-webkit-print-color-adjust: exact;" >

							<tr>

								<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Type</td>

								<td colspan="2" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Passenger&nbsp;Name</td>

								<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Ticket&nbsp;Number</td>

								<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">PNR</td>

							</tr>

<?php 

	$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' id IN ("'.$editresult['paxIds'].'") and firstName!="" '); 

	while($paxData=mysqli_fetch_array($rs6)){

		

$a1=GetPageRecord('*','flightBookingMaster',' id="'.$paxData['BookingId'].'" '); 

$editresult1=mysqli_fetch_array($a1); 

?>

							<tr>

								<td><?php echo ucfirst($paxData['paxType']); ?></td>

								<td colspan="2"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></td>

								<td><?php echo $paxData['ticketNo']; ?></td>

								<td><?php echo $editresult1['pnrNo']; ?></td>

							</tr>

<?php } ?>

						</table>

					</div>

				</div>



<br />

<hr />

<br />

						<div class="col-md-12">

							<div class="form-group">

									<label>Remark</label>

									<input name="adminRemark" type="text" class="form-control" id="name" value="<?php echo $editresult["adminRemark"]; ?>">

						   </div> 

						   </div>

						   

						   <div class="col-md-12">

						<div class="form-group">

						<label>Status</label>  

						<select name="status" class="form-control"  id="status" autocomplete="off">  

						<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>

						<option value="2" <?php if($editresult['status']==2){ ?>selected="selected"<?php } ?>>Not-Cancelled</option>

						<option value="3" <?php if($editresult['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>

						<option value="4" <?php if($editresult['status']==4){ ?>selected="selected"<?php } ?>>Rejected</option>

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="ticketcancelrequest">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo encode($editresult['id']); ?>"> 

				  </div>

</form>

<?php } ?>







<?php 

if($_REQUEST['action']=='hotelcancelrequest'){

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelCancelRequest',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">



<div class="row">

	<div class="col-md-12">

		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="-webkit-print-color-adjust: exact;" >

			<tr>

				<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Type</td>

				<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Room No</td>

				<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Booking Number</td>

				<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Title</td>

				<td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Name</td>

			</tr>

<?php 

	$rs6=GetPageRecord('*','hotelBookingPaxDetailMaster',' id = "'.$editresult['hotelBookingId'].'" and firstName!="" '); 

	while($paxData=mysqli_fetch_array($rs6)){

?>

			<tr>

				<td><?php echo ucfirst($paxData['paxType']); ?></td>

				<td><?php echo $paxData['roomNo']; ?></td>

				<td><?php echo $paxData['BookingNumber']; ?></td>

				<td><?php echo $paxData['title']; ?></td>

				<td><?php echo $paxData['firstName'] . $paxData['lastName']; ?></td>

			</tr>

<?php } ?>

		</table>

	</div>

</div>

<br />

<hr />

<br />





						   <div class="col-md-12">

							<div class="form-group">

									<label>Remark</label>

									<input name="adminRemark" type="text" class="form-control" id="name" value="<?php echo $editresult["adminRemark"]; ?>">

						   </div> 

						   </div>

						   <div class="col-md-12">

								<div class="form-group">

									<label>Status</label>  

									<select name="status" class="form-control" id="status" autocomplete="off">  

<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>

<option value="2" <?php if($editresult['status']==2){ ?>selected="selected"<?php } ?>>Not-Cancelled</option>

<option value="3" <?php if($editresult['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>

<option value="4" <?php if($editresult['status']==4){ ?>selected="selected"<?php } ?>>Rejected</option>

									</select>

								</div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="hotelcancelrequest">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo encode($editresult['id']); ?>"> 

				  </div>

</form>

<?php } ?>







<?php if($_REQUEST['action']=='addagentfaretypedomesticFlightsMarkup' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					   

						     <div class="col-md-5">

						<div class="form-group">

									<label>Fare Type<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="">

						   </div> 

						   </div>

						    <div class="col-md-2">

								<div class="form-group">

									<label>Markup<span class="text-danger">*</span></label> 

									<select  name="markupType" class="form-control"  id="markupType" autocomplete="off"   >  

									<option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

									<option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    

									</select>

						   </div> 

						   </div>

						   <div class="col-md-2">

								<div class="form-group">

									<label>Value<span class="text-danger">*</span></label>

									<input name="markupValue" type="text" class="form-control" id="markupValue" value="">

						   </div> 

						   </div>

						      <div class="col-md-1">

							<div class="form-group">

									<label>&nbsp;&nbsp;</label>

									<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						   </div> 

						   </div>

						

					</div>

					

   </div>



								

<input name="action" type="hidden" id="action" value="addagentfaretypedomesticFlightsMarkup">  

<input name="editid" type="hidden" id="editid" value="">  

<input name="flightId" type="hidden" id="flightId" value="<?php echo $_REQUEST['id']; ?>">  

<input name="agentId" type="hidden" id="agentId" value="<?php echo $_REQUEST['agentId']; ?>"> 

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_agentfaretypedomesticFlightsMarkup.php?id=<?php echo $_REQUEST['id']; ?>&agentId=<?php echo $_REQUEST['agentId']; ?>');

}



function loadcrusecostdlt(dlt){

$('#load_crusecost').load('load_agentfaretypedomesticFlightsMarkup.php?id=<?php echo $_REQUEST['id']; ?>&agentId=<?php echo $_REQUEST['agentId']; ?>&dltid='+dlt);

}





loadcrusecost();

</script>

<?php } ?>











<?php if($_REQUEST['action']=='addagentfaretypedomesticFlightscommission' && $_REQUEST['id']!=''){

  

 

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

		 

		 <div class="col-md-12">

					<div class="row">

						<table width="100%" border="0" cellpadding="0">

							<tbody>

								<tr>

									<td>

										<div class="form-group">

										<label>Fare Type<span class="text-danger">*</span></label>

										<input name="name" type="text" class="form-control" id="name" value="">

										</div>

									</td>

									<td>

										<div class="form-group">

										<label>Markup<span class="text-danger">*</span></label> 

										<select  name="markupType" class="form-control"  id="markupType" autocomplete="off"   >  

										<option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

										<option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    

										</select>

										</div>

									</td>

									<td>

										<div class="form-group">

										<label>Value<span class="text-danger">*</span></label>

										<input name="markupValue" type="text" class="form-control" id="markupValue" value="" style="width: 120px;">

										</div>

									</td>

									<td>

										<div class="form-group">

										<label>Cash Back Type</label> 

										<select  name="cashBackType" class="form-control"  id="cashBackType" autocomplete="off"   >  

										<option value="Flat" <?php if($editresult['cashBackType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       

										<option value="%" <?php if($editresult['cashBackType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    

										</select>

										</div>

									</td>

									<td>

										<div class="form-group">

										<label>Cash Back Value</label>

										<input name="cashBackValue" type="text" class="form-control" id="cashBackValue" value="" style="width: 120px;">

										</div>

									</td>

									<td>

										<div class="form-group">

										<label>&nbsp;&nbsp;</label>

										<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

										</div>

									</td>

								</tr>

							</tbody>

						</table>

 

						

					</div>

					

   </div>

			 



								

			 <input name="action" type="hidden" id="action" value="addagentfaretypedomesticFlightscommission">  

							    <input name="editid" type="hidden" id="editid" value="">  

							    <input name="flightId" type="hidden" id="flightId" value="<?php echo $_REQUEST['id']; ?>">  

							    <input name="agentId" type="hidden" id="agentId" value="<?php echo $_REQUEST['agentId']; ?>">  

</form>

<hr />

<div class="modal-body" >	

<div class="col-md-12">

<div class="row" id="load_crusecost">



</div>

</div>

</div>



<script>

function loadcrusecost(){

$('#load_crusecost').load('load_agentfaretypedomesticFlightsCommission.php?id=<?php echo $_REQUEST['id']; ?>&agentId=<?php echo $_REQUEST['agentId']; ?>');

}



function loadcrusecostdlt(dlt,name){

name=encodeURI(name);

$('#load_crusecost').load('load_agentfaretypedomesticFlightsCommission.php?id=<?php echo $_REQUEST['id']; ?>&agentId=<?php echo $_REQUEST['agentId']; ?>&dltid='+dlt+'&name='+name);

}





loadcrusecost();

</script>

<?php } ?>













<?php if($_REQUEST['action']=='viewAgentDetails' && $_REQUEST['id']!=''){

$ag=GetPageRecord('*','sys_userMaster',' id="'.decode($_REQUEST['id']).'" '); 

$rest=mysqli_fetch_array($ag);

 

 ?>  

		 <div class="modal-body" > 	 

		 

		 <div class="col-md-12">

					<div class="row">

					<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#F2F2F2">

  <tr>

    <td width="129"><strong>Agent Id</strong></td>

    <td width="26" align="center"><strong>:</strong></td>

    <td width="31"><?php echo $_REQUEST['id']; ?></td>

  </tr>

  <tr>

    <td><strong>Contact Person</strong></td>

    <td align="center"><strong>:</strong></td>

    <td><?php echo stripslashes($rest['name']); ?></td>

  </tr>

  <tr>

    <td><strong>Email</strong></td>

    <td align="center"><strong>:</strong></td>

    <td><?php echo stripslashes($rest['email']); ?></td>

  </tr>

  <tr>

    <td><strong>Contact&nbsp;Number</strong></td>

    <td align="center"><strong>:</strong></td>

    <td><?php echo stripslashes($rest['countryCode']); ?>-<?php echo stripslashes($rest['phone']); ?></td>

  </tr>

  <tr>

    <td><strong>Location</strong></td>

    <td align="center"><strong>:</strong></td>

    <td><?php echo getCityName($rest['city']); ?>, <?php echo getStateName($rest['state']); ?>, <?php echo getCountryName($rest['country']); ?></td>

  </tr>

  <tr>

    <td><strong>Sales Person </strong></td>

    <td align="center"><strong>:</strong></td>

    <td><?php

$user=GetPageRecord('*','sys_userMaster',' userType="staff" and status=1 and parentAgentId=0 and agentId=0 and id="'.$rest['salesManager'].'" order by name asc');

$userData=mysqli_fetch_array($user); echo $userData['name']; 

?></td>

  </tr>

  <tr>

    <td><strong>Wallet</strong></td>

    <td align="center"><strong>:</strong></td>

    <td><?php

									

									$a=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Credit" and offlineAgent=0 '); 

									$agentCreditAmt=mysqli_fetch_array($a); 

									

									$b=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$rest['id'].'" and paymentType="Debit" and offlineAgent=0 '); 

									$agentDebitAmt=mysqli_fetch_array($b); 

									

									echo $totalwalletBalance=round($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);

									

									 ?> INR </td>

  </tr>

</table>



		   </div>

					

   </div>

			 



								

 

</div>



 

<?php } ?>





















<?php if($_REQUEST['action']=='addofflinehotel'){

  

 

 

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','offlinehotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Hotel Name<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-12" style="display:none;">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1">Active</option>      

						</select>  		

						   </div> 

						   </div>   

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addofflinehotel">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>



































<?php if($_REQUEST['action']=='viewHotelVoucher' && $_REQUEST['id']!=''){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					

					<div class="col-md-4">

						<div class="form-group">

							<label>Action</label>

							<select name="ticketaction" id="ticketaction" class="form-control" onchange="loadticket();"> 

								<option value="1">With Fare Ticket</option>

								<option value="2">Without Fare Ticket</option>  

								<option value="4">Add Markup</option>

							</select>

						</div>

					</div> 

					<div class="col-md-3 addmrkp" style="display:none;">

						<div class="form-group " >

							<label>Markup</label> 

							<input name="markup" type="number" min="0" class="form-control" id="markup" value="0">

						</div> 

					</div> 

					

					<div class="col-md-4 tomail" style="display:none;"> 

						<div class="form-group ">

							<label>To Mail</label> 

							<input name="to" type="text" min="0" class="form-control" id="to" value="">

						</div>

					</div>

					<div class="col-md-1 addmrkp" style="display:none;">

						<button type="button" class="btn btn-primary" style="margin-top: 28px;" onclick="loadticketwithmarkup();">Apply Markup</button> 

					</div>

					 <div class="col-md-4 tomail" style="display:none;"><button type="submit" class="btn btn-primary" style="margin-top: 28px;" >Send to Mail</button></div>   

					</div>

					

					

					<hr style="border-top: 2px solid #c9c9c9;" />

					<div class="row" id="loadticket"> 

					<?php echo file_get_contents($fullurl.'hotel_voucher.php?id='.$_REQUEST['id'].'&ta=1'); ?> 

					</div>

					<script>

					

						function loadticket(){

							var ta = $('#ticketaction').val();

							var markup = Number($('#markup').val());

							if(ta!='' ){ 

								if(ta==4 && markup=='0'){

									$('.addmrkp').show();  

								}else{ 

									$('#markup').val('0');

									$('.addmrkp').hide();

									$('#loadticket').load('hotel_voucher.php?id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 

								} 

							

							} 

						}

					

					function loadticketwithmarkup(){

					

						var ta = $('#ticketaction').val();

						var markup = Number($('#markup').val());

						

							if(markup>0){

								$('#loadticket').load('hotel_voucher.php?id=<?php echo $_REQUEST['id']; ?>&ta='+ta+'&markup='+markup); 

							}

					

					}

					

					

					</script>

					<hr style="border-top: 2px solid #c9c9c9;" />

					<div class="row" style="margin-top:40px;">  

					<div class="col-md-6" ></div> 

					<div class="col-md-4" > 

						<div class="form-group "> 

							<input name="to" type="text" min="0" class="form-control" id="to" value="" placeholder="Enter Email Id">

						</div>

					</div>

					 <div class="col-md-2"><button type="submit" class="btn btn-primary" >Send to Mail</button></div>   

					</div>

		   </div>



		<input name="action" type="hidden" id="action" value="hotelVouchersendtomail">  

		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 			

		<input name="page" type="hidden" id="page" value="<?php echo $_REQUEST['page']; ?>"> 	

								

   </div> 

</form>

<?php } ?>



























<?php if($_REQUEST['action']=='confirmHotelVoucher' && $_REQUEST['id']!=''){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','hotelBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

<?php if($editresult["bookingType"]==1){ ?>

<input type="hidden" name="type" value="offline">

<?php }else{ ?>

<input type="hidden" name="type" value="online">

<?php } ?>

						    <div class="col-md-6">

								<div class="form-group">

									<label>Confirmation No.</label> 

									<input name="confirmationNo" type="text" class="form-control" id="confirmationNo" value="<?php echo stripslashes($editresult['confirmationNo']); ?>">

								</div> 

						   </div>

						   

						   <div class="col-md-6">

								<div class="form-group">

									<label>Supplier</label> 

<select name="supplier" class="form-control">

<?php 

$supplier=GetPageRecord('*','sys_userMaster',' parentId="'.$LoginUserDetails['parentId'].'"  and  userType="suppliers" order by id asc'); 

while($supplierData=mysqli_fetch_array($supplier)){

?>

	<option value="<?php echo $supplierData["companyName"]; ?>" <?php if($supplierData["companyName"]==$editresult["supplier"]){ ?> selected="selected" <?php } ?>><?php echo $supplierData["companyName"]; ?></option>

<?php } ?>

</select>

								</div> 

						   </div>

						   

						   <div class="col-md-6">

								<div class="form-group">

									<label>Confirmed By</label> 

									<input name="confirmedBy" type="text" class="form-control" id="confirmedBy" value="<?php echo stripslashes($editresult['confirmedBy']); ?>">

								</div> 

						   </div>



						   <div class="col-md-6">

								<div class="form-group">

									<label>Update Status</label>

									<select name="status" class="form-control">

										<option value="1" <?php if($editresult["status"]==1){ ?> selected="selected" <?php } ?>>Pending</option>

										<option value="2" <?php if($editresult["status"]==2){ ?> selected="selected" <?php } ?>>Confirmed</option>

										<option value="3" <?php if($editresult["status"]==3){ ?> selected="selected" <?php } ?>>Cancelled</option>

										<option value="4" <?php if($editresult["status"]==4){ ?> selected="selected" <?php } ?>>Rejected</option>

									</select>

									

								</div> 

						   </div>

						   

<!--Passengers wise ticket information-->

 

 

<!--End-->

						   

						   

						   <div class="col-md-12">

								<div class="form-group">

									<label>Remark</label>

									<textarea class="form-control" name="remark"><?php echo $editresult["remark"]; ?></textarea>

								</div> 

						   </div>   

					</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="confirmHotelVoucher">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>











<?php if($_REQUEST['action']=='addfixeddeparturenew'){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','fixedDepartureMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-4">

						<div class="form-group">

									<label>Sector<span class="text-danger">*</span></label> 

									<input name="sector" type="text" class="form-control" id="sector" value="<?php echo stripslashes($editresult['sector']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Airline<span class="text-danger">*</span></label> 

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						    <div class="col-md-4">

						<div class="form-group">

									<label>Flight No<span class="text-danger">*</span></label> 

									<input name="flightNo" type="text" class="form-control" id="flightNo" value="<?php echo stripslashes($editresult['flightNo']); ?>"    >

						   </div> 

						   </div>

						   

						    

						   

						   

						    <div class="col-md-4">

								<div class="form-group">

								<label>Departure Date<span class="text-danger">*</span></label> 

									<input type="text" id="fromDate" name="fromDate" class="form-control" placeholder="From Date" value="<?php if($editresult['fromDate']!='' && $editresult['fromDate']!='1970-01-01'){echo date("d-m-Y",strtotime($editresult['fromDate']));} ?>"  readonly >

								</div>

							</div>

							

							<div class="col-md-4">

								<div class="form-group">

								<label>Return Date<span class="text-danger">*</span></label>

<input type="text" id="toDate" name="toDate" class="form-control" placeholder="To Date" value="<?php if($editresult['toDate']!='' && $editresult['toDate']!='1970-01-01'){echo date("d-m-Y",strtotime($editresult['toDate']));} ?>"  readonly >

								</div>

							</div>

<script>

$(function(){

    $("#fromDate").datepicker({ dateFormat: 'dd-mm-yy' });

    $("#toDate").datepicker({ dateFormat: 'dd-mm-yy' });

});

</script> 

						   

						    

						   

						    

						   

						   <div class="col-md-4">

						<div class="form-group">

									<label>Departure Time</label> 

									<input name="departureTime" type="text" class="form-control" id="departureTime" value="<?php echo stripslashes($editresult['departureTime']); ?>"    >

						   </div> 

						   </div> 

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Return Time</label> 

									<input name="arrivalTime" type="text" class="form-control" id="arrivalTime" value="<?php echo stripslashes($editresult['arrivalTime']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Available Seats</label> 

									<input name="totalSeats" type="text" class="form-control" id="totalSeats" value="<?php echo stripslashes($editresult['totalSeats']); ?>"    >

						   </div> 

						   </div>

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Air Fare</label> 

									<input name="baseFare" type="text" class="form-control" id="baseFare" value="<?php echo stripslashes($editresult['baseFare']); ?>"    >

						   </div> 

						   </div>

						   

						     

						   

						   <div class="col-md-3">

						<div class="form-group">

									<label>Status</label>  

						<select  name="status" class="form-control"  id="status" autocomplete="off"   >  

						<option value="1" <?php if($editresult['status']==1 || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Active</option>       

						<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?> >In-Active</option>    

						</select>  		

						   </div> 

						   </div> 

						   

						   

					</div>

					

		   </div>



					 		

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addfixeddeparturenew">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>















<?php if($_REQUEST['action']=='Importfixeddeparturenew'){

 

 ?>



<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

				<div class="modal-body" >	

					<div class="col-md-12">

						<div class="row">

							  

							  

							<div class="col-md-12">

								<div class="form-group">

									<label>Import File </label>  

								 <input name="img" type="file" class="form-control" id="img" style="padding: 4px;">

	

								</div> 

						   </div> 

							  

							  	  

						   

						     

						   

						    

						</div>

					</div>

					

								

				</div>

				

  </div><div class="card-footer text-right">

						 

								

						<button type="submit" class="btn btn-primary">Upload &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

						<input name="action" type="hidden" id="action" value="Importfixeddeparturenew" /> 

					</div>

</form>

<?php } ?>









<?php if($_REQUEST['action']=='addcommissiontype'){

 

 

 if($_REQUEST['id']!=''){

$a=GetPageRecord('*','sys_commissionType',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 

}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

						    <div class="col-md-12">

						<div class="form-group">

									<label>Agent Type Name <span class="text-danger">*</span></label>

									 <div style="height:0px; font-size:0px; position:relative;" id="searchhotellist"></div>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>"    >

						   </div> 

						   </div>

						   

						    
 

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="commissiontype">  

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">  

								 <input name="oldcompanyLogo" type="hidden" id="bannerImg" value="<?php echo $editresult['details']; ?>"> 

				  </div>

</form>

<?php } 
 ?>



 
 <?php if($_REQUEST['action']=='addcabDestination' ){
  
$a=GetPageRecord('*','destination','id="'.decode($_REQUEST['id']).'"');  
$result=mysqli_fetch_array($a);
 ?> 

 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Name<span class="redmtext">*</span> </label>
  <input type="text" class="form-control" required="" name="name" value="<?php echo stripslashes($result['name']); ?>" >
</div></div>
 
  
   
</div>   
</div>
 
<div class="modal-footer"> 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="citycabMaster" /> 
<input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
</form>
		 
<?php } ?>






<?php if($_REQUEST['action']=='addvehiclecategory' ){  
if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','vehicle_category','id="'.decode($_REQUEST['id']).'"');  
$data=mysqli_fetch_array($a); 
}
?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Category name*
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($data['name']); ?>" required="" >
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Pax*
</label>
  <input name="pax" type="text" class="form-control" id="pax" value="<?php echo stripslashes($data['pax']); ?>" required="" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Photo*<br />160 * 120 PX
</label>
<input name="image" type="file" id="changeprofilepic"  class="form-control">

<input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Status*
</label>
  <select  name="status" class="form-control"  autocomplete="off">  

<option value="1" <?php if('1'==$data['status']){ ?>selected="selected"<?php } ?>>Active</option> 

<option value="0" <?php if('0'==$data['status']){ ?>selected="selected"<?php } ?>>Inactive</option>  

</select>
</div></div>


 </div>
   
</div>
 
<div class="modal-footer">  

<input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="addvehiclecategory" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>



<script>



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 

</script>
<?php } ?>  
 
 

 
<?php if($_REQUEST['action']=='addcabcontent' ){  
if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','cab_content','id="'.decode($_REQUEST['id']).'"');  
$data=mysqli_fetch_array($a); 
}
?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Name*
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($data['name']); ?>" required="" >
</div></div>

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Status*
</label>
  <select  name="status" class="form-control"  autocomplete="off">  

<option value="1" <?php if('1'==$data['status']){ ?>selected="selected"<?php } ?>>Active</option> 

<option value="0" <?php if('0'==$data['status']){ ?>selected="selected"<?php } ?>>Inactive</option>  

</select>
</div></div>


 </div>
   
</div>
 
<div class="modal-footer">  

<input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="addcabcontent" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php } ?> 


<?php if($_REQUEST['action']=='addcabroute' ){  
if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','cab_route','id="'.decode($_REQUEST['id']).'"');  
$data=mysqli_fetch_array($a); 
}
?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Name*
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($data['name']); ?>" required="" >
</div></div>


<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Url*
</label>
  <input name="url" type="text" class="form-control" id="url" value="<?php echo stripslashes($data['url']); ?>" required="" >
</div></div>

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Status*
</label>
  <select  name="status" class="form-control"  autocomplete="off">  

<option value="1" <?php if('1'==$data['status']){ ?>selected="selected"<?php } ?>>Active</option> 

<option value="0" <?php if('0'==$data['status']){ ?>selected="selected"<?php } ?>>Inactive</option>  

</select>
</div></div>


 </div>
   
</div>
 
<div class="modal-footer">  

<input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="addcabroute" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php } ?>   







<?php if($_REQUEST['action']=='addcabvehicle' ){
  
if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','vehiclemaster','id="'.decode($_REQUEST['id']).'"');  
$data=mysqli_fetch_array($a); 
}
?>

 
<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
<div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Name*</label>
<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($data['name']); ?>" required="" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Category*</label>
<select name="category_id" class="form-control" autocomplete="off">
<?php
$a1=GetPageRecord('*','vehicle_category','status="1"');  
while($data1=mysqli_fetch_array($a1)){
?>
<option value="<?php echo $data1['id']; ?>" <?php if($data['category_id']==$data1['id']){ ?>selected="selected"<?php } ?>><?php echo $data1['name']; ?></option>
<?php } ?> 
</select>
</div></div>



<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">PAX*</label>
<input name="pax" type="number" id="pax"  class="form-control" value="<?php echo $data['pax']; ?>">
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Fuel*</label>
<select  name="fuel" class="form-control" autocomplete="off">
<option value="1" <?php if('1'==$data['fuel']){ ?>selected="selected"<?php } ?>>Diesel</option> 
<option value="2" <?php if('2'==$data['fuel']){ ?>selected="selected"<?php } ?>>Petrol</option>  
<option value="0" <?php if('0'==$data['fuel']){ ?>selected="selected"<?php } ?>>CNG</option>  
</select>
</div></div>
 

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Details</label> 
<textarea name="details" rows="6" class="form-control"><?php echo stripslashes($data['remark']); ?></textarea>
</div></div>
   

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Photo*
</label>
<input name="image" type="file" id="changeprofilepic"  class="form-control">
<input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Status*
</label>
<select  name="status" class="form-control"  autocomplete="off">  
<option value="1" <?php if('1'==$data['status']){ ?>selected="selected"<?php } ?>>Active</option> 
<option value="0" <?php if('0'==$data['status']){ ?>selected="selected"<?php } ?>>Inactive</option>  
</select>
</div>
</div>

</div>
   
</div>
 
<div class="modal-footer">  

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="addcabvehicle" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>



<script>



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 

</script>
<?php } ?> 

 


 <?php if($_REQUEST['action']=='viewbusVoucher' && $_REQUEST['i']!=''){ 
 
 $id=base64_encode(($_REQUEST['i']));
 $_REQUEST['i']=$id; ?>
 <div style="padding:10px;">
 <?php  include "bus-ticket.php"; ?>
   </div>
 <?php } ?>
 
  <?php if($_REQUEST['action']=='changepassword'){   ?>
<div class="card-body">
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
	<div class=" ">  
		<div class="form-group">
			<label>Old Password</label>
			<input name="oldPassword" type="password" min="0" class="form-control" id="oldPassword" value=""    >
		</div>	
		
		<div class="form-group">
			<label>New Password</label>
			<input name="newPassword" type="password" min="0" class="form-control" id="newPassword" value=""    >
		</div>	
		
		<div class="form-group">
			<label>Confirm Password</label>
			<input name="confirmPassword" type="password" min="0" class="form-control" id="confirmPassword" value=""    >
		</div>	     
	</div>
	<input name="action" type="hidden" id="action" value="changePassword">   
	<div class="card-footer d-flex justify-content-between" >
	<button type="button" class="btn btn-Secondary" data-dismiss="modal" aria-label="Close">Close</button>
		<button type="submit" class="btn btn-primary">Save&nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
	</div>
</form>
</div>
<?php } ?>

<?php 
	if($_REQUEST['action']=='addpaymentrequest' ){
?>

<form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



	<div class="modal-body" >	
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label>Requested Amount<span class="text-danger">*</span></label>
						<input name="requestedAmount" type="number" class="form-control" value="0" required>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Payment Mode<span class="text-danger">*</span></label>
							<select name="paymentMode" class="form-control" onChange="paymentTypeMode(this.value);">
								<option value="">Select</option>
								<option value="Cheque">Cheque</option>
								<option value="NEFT">NEFT</option>
								<option value="DD">DD</option>
								<option value="Cash">Bank Cash</option>
								<!--
								<option value="Credit">Credit</option>
								-->
							</select>
					</div>
				</div>
				 

				<div class="col-md-6">
					<div class="form-group">
						<label>Reference Number</label>
						<input name="referenceNumber" type="text"  class="form-control"  value="">
					</div> 
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Attachment</label>
						<input name="attachment" type="file">
					</div> 
				</div>
				
				
<script>
function paymentTypeMode(val){

	if(val == "Cash"){
		$("#bankDiv").show();
		$("#branchDiv").show();
		$("#account_numberDiv").show();
		$("#bank_transaction_idDiv").show();
	}else if(val == "Cheque"){
		$("#chequeNumberDiv").show();
		$("#chequeDateDiv").show();
		$("#bankDiv").hide();
		$("#branchDiv").hide();
		$("#account_numberDiv").hide();
		$("#bank_transaction_idDiv").hide();
		$("#draftNumberDiv").hide();
	}else if(val == "NEFT"){
		$("#chequeNumberDiv").hide();
		$("#chequeDateDiv").hide();
		$("#bankDiv").show();
		$("#branchDiv").show();
		$("#account_numberDiv").show();
		$("#bank_transaction_idDiv").show();
		$("#draftNumberDiv").hide();
	}else if(val == "DD"){
		$("#chequeNumberDiv").hide();
		$("#chequeDateDiv").hide();
		$("#bankDiv").hide();
		$("#branchDiv").hide();
		$("#account_numberDiv").hide();
		$("#bank_transaction_idDiv").hide();
		$("#draftNumberDiv").show();
	}

}
</script>

				<div class="col-md-6" style="display:none;" id="chequeNumberDiv">
					<div class="form-group">
						<label>Cheque Number</label>
						<input name="chequeNumber" id="chequeNumber" type="text" class="form-control" value="">
					</div> 
				</div>
				
				<div class="col-md-6" style="display:none;" id="draftNumberDiv">
					<div class="form-group">
						<label>Draft Number</label>
						<input name="draftNumber" id="draftNumber" type="text" class="form-control"  value="">
					</div> 
				</div>
				
				<div class="col-md-6" id="chequeDateDiv" style="display:none;">
					<div class="form-group">
						<label>Date</label>
						<input name="chequeDate" id="chequeDate" type="date" class="form-control"  value="">
					</div> 
				</div>

				<div class="col-md-6" id="bankDiv" style="display:none;">
					<div class="form-group">
						<label>Bank</label>
						<input name="bank" id="bank" type="text" class="form-control"  value="">
					</div> 
				</div>
				
				<div class="col-md-6" style="display:none;" id="branchDiv">
					<div class="form-group">
						<label>Branch</label>
						<input name="branch" id="branch" type="text" class="form-control"  value="">
					</div> 
				</div>

				<div class="col-md-12" style="display:none;" id="account_numberDiv">
					<div class="form-group">
						<label>Our Bank Account</label>
						<input name="account_number" id="account_number" type="text" placeholder="50200068661036"  class="form-control" value="" style="font-size:12px;">
					</div> 
				</div>

				
				<div class="col-md-12" style="bank_transaction_idDiv">
					<div class="form-group">
						<label>Bank Transaction ID</label>
						<input name="bank_transaction_id" id="bank_transaction_id" type="text"  class="form-control"  value="">
					</div> 
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label>Remark </label>
						<textarea name="note" type="text"  class="form-control"></textarea>
					</div>
				</div>
			</div>
		</div>

		</div>
		
		
		
		
		<div class="card-footer text-right" style="margin-top:0px; padding:20px; padding-top:10px;">

		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
		
		<input name="action" type="hidden" id="action" value="addpaymentrequest">
	</div>
</form>
<?php } ?>