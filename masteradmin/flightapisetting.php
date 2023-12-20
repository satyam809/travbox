<?php 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

 $fromdate=$_REQUEST['fromdate'];
 $todate=$_REQUEST['todate'];

} else {
// $fromdate=date('d-m-Y', strtotime("-30 days"));
// $todate=date('d-m-Y'); 
}




$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getapistatus=mysqli_fetch_array($rs); 
?>
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
  

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-cog" aria-hidden="true"></i> Flight API Setting</span>
</div>


 


<div class="nocsstable">
<form action="frmaction.html" method="post" enctype="multipart/form-data" target="actoinfrm" id="addeditfrmapi">  
<table class="table">
							<thead>
								<tr>
								  <th width="1%" align="left" >API</th>
								  <th width="20%" align="left" ><div align="left">Type</div></th>
									<th align="left"><div align="left">Status </div></th>
								    <th align="left">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							
															<tr>
															  <td width="1%" align="left" ><img src="assets/kafilalogo.png" height="34" style="margin-right:30px;" /></td>
								  <td width="20%" align="left" ><div align="left"><strong>One Way  																		</strong></div></td>
									<td align="left">
									<select name="kafilaAPIOneWay"  class="form-control" style="width:130px;" onchange="$('#addeditfrmapi').submit();">
									  <option value="1" <?php if($getapistatus['kafilaAPIOneWay']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['kafilaAPIOneWay']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select>									</td>
								    <td align="left">&nbsp;</td>
								</tr>
															<tr>
															  <td width="1%" align="left" ><img src="assets/kafilalogo.png" height="34" /></td>
															  <td width="20%" align="left" ><strong>Round Trip </strong></td>
															  <td align="left"><select name="kafilaAPIRoundTrip"   class="form-control" style="width:130px;" onchange="$('#addeditfrmapi').submit();" disabled="disabled">
									  <option value="1" <?php if($getapistatus['kafilaAPIRoundTrip']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['kafilaAPIRoundTrip']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select></td>
							                                  <td align="left" style="color:#FF0000;">If TBO round trip api deactivated then kafila round trip automatic activate and show result</td>
							  </tr>
															<tr>
															  <td width="1%" align="left" ><img src="assets/tbologo.png" height="34" /></td>
															  <td width="20%" align="left" ><strong>One Way </strong></td>
															  <td colspan="2" align="left"><select name="tboAPIOneWay"  class="form-control" style="width:130px;" onchange="$('#addeditfrmapi').submit();">
									  <option value="1" <?php if($getapistatus['tboAPIOneWay']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['tboAPIOneWay']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select></td>
							  </tr>
															<tr>
															  <td width="1%" align="left" ><img src="assets/tbologo.png" height="34" /></td>
															  <td width="20%" align="left" ><strong>Round Trip </strong></td>
															  <td colspan="2" align="left"><select name="tboAPIRoundTrip"  class="form-control" style="width:130px;" onchange="$('#addeditfrmapi').submit();">
									  <option value="1" <?php if($getapistatus['tboAPIRoundTrip']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['tboAPIRoundTrip']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select></td>
							  </tr>
															<tr>
															  <td align="left" >&nbsp;</td>
															  <td align="left" ><strong>Fixed GF </strong></td>
															  <td colspan="2" align="left"><select name="fixedGF"  class="form-control" style="width:130px;" onchange="$('#addeditfrmapi').submit();">
                                                                <option value="1" <?php if($getapistatus['fixedGF']==1){ ?>selected="selected"<?php } ?>>Active</option>
                                                                <option value="0" <?php if($getapistatus['fixedGF']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
                                                              </select></td>
							  </tr>
															<tr>
															  <td align="left" >&nbsp;</td>
															  <td align="left" ><strong>Fixed AK </strong></td>
															  <td colspan="2" align="left"><select name="fixedAK"  class="form-control" style="width:130px;" onchange="$('#addeditfrmapi').submit();">
                                                                <option value="1" <?php if($getapistatus['fixedAK']==1){ ?>selected="selected"<?php } ?>>Active</option>
                                                                <option value="0" <?php if($getapistatus['fixedAK']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
                                                              </select></td>
							  </tr> 
															</tbody>
						</table>
						<input name="action" type="hidden" value="flightapisetting" />
</form>
						
						 
			  </div>
</div>



</div>
 
</div>

</div>

 