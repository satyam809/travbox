<?php  
include "settingheader.php";  
?>


<div class="page-content pt-0" > 
		
<?php  
include "settingleft.php"; 
?>		
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php echo stripslashes($moduleDataName['name']); ?></h5>
						 
			  </div>		 

				 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
						<table class="table">
							<thead>
								<tr>
									<th width="30%">Flight&nbsp;Name</th>
									<th width="30%">Applicable Type</th>
									<th width="20%">Value %</th>
									<th width="20%">Applicable On</th>
								</tr>
							</thead>
							<tbody>
<?php
$ab=GetPageRecord('*','taxMaster',' 1 order by id asc ');
while($abb=mysqli_fetch_array($ab)){ 
?>
<input type="hidden" name="id[]" value="<?php echo $abb["id"]; ?>">
							<tr>
								<td><?php echo $abb["flightName"]; ?></td>
								<td>
									<select name="applicableType[]" class="form-control">
										<?php if($abb["id"]!=1){ ?>
										<option value="totalfare" <?php if($abb["applicableType"]=="totalfare"){ ?>selected="selected" <?php } ?>>Total Fare</option>
										<?php } ?>
										<option value="commission" <?php if($abb["applicableType"]=="commission"){ ?>selected="selected" <?php } ?>>Commission</option>									
									</select>
								</td>
								<td><input name="valuePerc[]" type="text" class="form-control" id="valuePerc" value="<?php echo stripslashes($abb['valuePerc']); ?>"></td>
								<td>
									<select name="applicableOn[]" class="form-control">
									<?php if($abb["id"]!=1){ ?>
										<option value="gst" <?php if($abb["applicableOn"]=="gst"){ ?>selected="selected" <?php } ?>>GST</option>
										<?php } ?>
										<option value="tds" <?php if($abb["applicableOn"]=="tds"){ ?>selected="selected" <?php } ?>>TDS</option>									
									</select>
								</td>
							</tr>
<?php } ?>
							</tbody>
						</table>	
					 <div class="card-footer text-right">
								 
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savetaxes" /> 
				  </div>
				  
				  </form>
			  </div>
					
					
				</div>
			<!-- Icons alignment -->

			 
				</div>
			
</div>




   