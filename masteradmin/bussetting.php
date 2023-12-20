<style>
.roomratelist{font-size: 11px;
    font-weight: 500;
    text-align: center;
    padding: 2px;
    background-color: #f1f1f1; margin-bottom:1px;
	}
	
	
</style>
	
<?php include "libraryheader.php"; ?>

<div class="page-content pt-0">
 

		<!-- Main content -->
		<div class="content-wrapper">

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
  

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-percent" aria-hidden="true"></i> Bus Markup</span>
</div>


 

<div class="nocsstable">
<table width="24%" class="table">
							<thead>
								<tr>
								  <th width="20%"><div align="left">Markup&nbsp;Type</div></th>
									<th width="20%"><div align="left">Markup</div></th>
									<th><div align="center">
									  <input name="action" type="hidden" id="action" value="busmarkup" />
</div></th>
								    <th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							 
								<tr>
								  <td width="20%"> 
								    <div align="left"><select name="busMarkupType" id="busMarkupType" class="form-control">
									        <option value="flat" <?php if($LoginUserDetails['busMarkupType']=='flat'){ ?>selected="selected"<?php } ?>>Flat</option>
									        <option value="percentage" <?php if($LoginUserDetails['busMarkupType']=='percentage'){ ?>selected="selected"<?php } ?>>Percentage</option>
								          </select>
								    </div></td>
									<td width="20%" style="text-align:center;">
									    <div align="left">
									      <input name="busMarkupValue" type="number" class="form-control" id="busMarkupValue" value="<?php echo $LoginUserDetails['busMarkupValue']; ?>" />
							            </div></td>
									
									<td> 
									<button type="submit" class="btn btn-primary btn-icon btn-sm"   > <i class="fa fa-plus" aria-hidden="true"></i> Save</button>	
									<a href="display.html?ga=busbooking">
								    <button type="button" class="btn btn-primary btn-icon btn-sm"   >&lt;&lt; Back </button>
								    </a>							    </td>
								    <td></td>
								</tr> 
							</tbody>
						</table>
						
						 
			  </div>
</div>



</div>
</form>
</div>

</div>

 