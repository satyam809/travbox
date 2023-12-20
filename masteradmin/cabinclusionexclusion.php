<?php

$rs1=GetPageRecord('*','tariff_settting','1');   

$editresult=mysqli_fetch_array($rs1); 

?>

 <script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>



<div class="page-header" style="margin-top: 48px;">
	 

		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><a href="display.html?ga=cabpackage"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Back</a>  -  <strong>Cab Inclusion & Exclusion</strong> </h4> 
			</div> 
		</div>
		
				
	</div>

<div class="page-content pt-0"> 
		
		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<!-- Icons alignment -->

				<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 

		<div class="col-lg-12">

			<div class="row"> 					

				<div class="col-lg-12">

					<div class="row" style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">



						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Inclusion & Exclusion</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="inclusion_exclusion" class="form-control editorclass" ><?php echo stripslashes($editresult['inclusion_exclusion']); ?></textarea>
<script type="text/javascript">

var editor = CKEDITOR.replace('inclusion_exclusion');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
						</div>

						

						

						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px; margin-top:20px; color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Cancellation policy</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="cancellation_policy" class="form-control editorclass" ><?php echo stripslashes($editresult['cancellation_policy']); ?></textarea>
<script type="text/javascript">

var editor = CKEDITOR.replace('cancellation_policy');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
						</div>



						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px;  margin-top:20px;color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Govt. advisory & safety guidelines</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="govt_advisory" class="form-control editorclass"><?php echo stripslashes($editresult['govt_advisory']); ?></textarea>
<script type="text/javascript">

var editor = CKEDITOR.replace('govt_advisory');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
						</div>

						

						<div class="col-lg-12">

							<div style="background-color: #06304c; padding: 10px; margin-bottom: 10px;  margin-top:20px;color: #fff; width: 100%; border-radius: 4px; font-size: 16px; font-weight:600;">Other information</div>

						</div>

						<div class="col-lg-12">	

							<textarea name="other_information" class="form-control editorclass"><?php echo stripslashes($editresult['other_information']); ?></textarea>
<script type="text/javascript">

var editor = CKEDITOR.replace('other_information');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
						</div>

						

					</div>

				</div>

			</div>  

									

			<div class="row">

				<div class="col-lg-12">

					<div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">

						<button type="submit" id="savingbutton" class="btn btn-secondary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" >Update</button>

                        <input autocomplete="false" name="action" type="hidden" id="action" value="tariff_setting" />

					</div>

				</div>

			</div>

		</div>

	</form>
		  </div>
 




   