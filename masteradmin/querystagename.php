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
									<th width="30%">Orignal&nbsp;Name</th>
									<th width="5%">&nbsp;</th>
									<th width="40%">Updated&nbsp;Name </th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_queryStageMaster',' where parentId="'.$LoginUserDetails['parentId'].'" order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>
								
								<tr>
									<td width="30%" align="left" valign="top"><strong><?php echo stripslashes($rest['name']); ?></strong><input name="moduleId[]" type="hidden" value="<?php echo stripslashes($rest['id']); ?>"/></td>
									<td width="5%" align="left" valign="top"><i class="fa fa-long-arrow-right" aria-hidden="true" style=" color:#2196f3;"></i></td>
									<td width="40%" align="left" valign="top"><input name="updatedName<?php echo stripslashes($rest['id']); ?>" type="text" class="form-control" id="updatedName<?php echo stripslashes($rest['id']); ?>" value="<?php echo stripslashes($rest['updatedName']); ?>"></td>
									<td align="left" valign="top"></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>	
					 <div class="card-footer text-right">
								 
								
								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							    <input name="action" type="hidden" id="action" value="savequerystages" /> 
				  </div>
				  
				  </form>
			  </div>
					
					
				</div>
			<!-- Icons alignment -->

			 
				</div>
			
</div>




   