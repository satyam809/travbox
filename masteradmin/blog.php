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
						<h5 class="card-title">Blog</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		 <a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&add=1"><button type="button" class="btn btn-primary btn-sm">Add Post</button></a>
		                	</div>
	                	</div>
			  </div>		 

				 
						<table class="table">
							<thead>
								<tr>
									<th width="1%">&nbsp;</th>
									<th width="25%">Title</th>
									<th width="5%">Status</th>
									<th width="5%">Date</th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_blog',' where  addBy="'.$_SESSION['userid'].'"   order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
?>
								
<tr>
	<td width="1%" align="left" valign="top"><?php if(isset($rest['image'])){ ?><img src="upload/<?php echo stripslashes($rest['image']); ?>" width="50"  ><?php } ?></td>
	
	<td align="left" valign="top"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><?php echo stripslashes($rest['title']); ?></a></td>
	
	<td width="5%" align="left" valign="top"><?php if($rest['status']==1){echo "Active";}else{echo "In-active";} ?></td>
	
	<td width="5%" align="left" valign="top"><?php echo date("d-m-Y",strtotime($rest['addDate'])); ?></td>
	
	<td width="1%" align="left" valign="top">
	<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1">
	<button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>	</td>
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




   