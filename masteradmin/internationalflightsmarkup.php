<style>
.roomratelist{font-size: 11px;
    font-weight: 500;
    text-align: center;
    padding: 2px;
    background-color: #f1f1f1; margin-bottom:1px;
	}
	
	
</style>
	
<?php include "flightsettingsheader.php"; ?>

<div class="page-content pt-0">
<?php include "flightsettingsleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">
 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-plane" aria-hidden="true"></i> International Flights Markup</span>
</div>
 

<div class="nocsstable">
<table class="table">
							<thead>
								<tr>
									<th width="20%">Name</th>
									<th width="15%"><div align="left">Markup Type</div></th>
									<th width="15%"><div align="left">Value</div></th>
									<th width="10%"><div align="left"></div></th>
								    <th width="40%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$rs=GetPageRecord('*','internationalFlightsMarkupMaster',' id=1 order by id desc');
							 $editresult=mysqli_fetch_array($rs);
							 ?>
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
							<tr>
									<td width="20%"><div style="font-weight:500;"><?php echo $editresult['name']; ?></div>																		</td>
									<td width="15%"> 
									 <div class="form-group"> 
									   
								       <div align="left">
									       <select  name="markupType" class="form-control"  id="markupType" autocomplete="off" style=" width:150px;">  
									         <option value="Flat" <?php if($editresult['markupType']=='Flat' || $_REQUEST['id']==''){ ?>selected="selected"<?php } ?>>Flat</option>       
									         <option value="%" <?php if($editresult['markupType']=='%'){ ?>selected="selected"<?php } ?> >%</option>    
								         </select>
							           </div>
							  </div></td>
									
									<td width="15%"><div class="form-group"> 
									  
								      <div align="left">
								        <input name="markupValue" type="text" class="form-control" id="markupValue" value="<?php echo $editresult['markupValue']; ?>" style=" width:150px;">
							          </div>
									</div></td>
									<td width="10%"><div class="form-group"> 
									  <div align="left">
									    <button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
								      </div>
							  </div></td>
							        <td width="40%">&nbsp;</td>
							</tr>
							 <input name="action" type="hidden" id="action" value="addinternationalFlightsMarkup">   
							    <input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>"> 
								<input name="editid" type="hidden" id="editid" value="<?php echo encode($editresult['id']); ?>"> 
								</form>
							</tbody>
						</table>
						
						 
			  </div>
</div>



</div>

</div>

</div>

 