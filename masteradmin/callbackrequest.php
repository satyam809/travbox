<div class="page-content pt-0" >
	<div class="content-wrapper">
		<!-- Content area -->
		<div class="content">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Call Back Request</h5>
				</div>		 

				<table class="table">
					<thead>
						<tr>
							<th width="35%">Agent Info</th>
							<th width="35%">remark</th>
							<th width="10%">Status</th>
							<th width="10%">Date</th>
							<th width="10%">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','callBackRequest',' order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
	
//Agent Info
$rs7=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'"'); 
$res=mysqli_fetch_array($rs7);
?>
								
<tr>
	<td align="left" valign="top">Name: <?php echo $res["name"]; ?><br />Email: <?php echo $res["email"]; ?><br />Phone: <?php echo $res["phone"]; ?></td>
	<td align="left" valign="top"><?php echo $rest['remark']; ?></td>
	<td align="left" valign="top"><?php if($rest['status']==1){echo "Confirmed";}else{echo "Pending";} ?></td>
	<td align="left" valign="top"><?php echo date("d-m-Y",strtotime($rest['addDate'])); ?></td>
	<td align="left" valign="top">
	<a style="cursor:pointer;" onclick="loadpop('Update Status',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=callbackrequest&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>

	</td>
									

								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>	
					 <div class="card-footer text-right">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
			  </div>
					
					
				</div>
			<!-- Icons alignment -->

			 
				</div>
			
</div>