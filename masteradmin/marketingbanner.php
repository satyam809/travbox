<div class="page-content pt-0" > 
	<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Marketing Banner</h5>
						<div class="header-elements">
							<div style="text-align:right;"><a style="cursor:pointer;" onclick="loadpop('Add Marketing Banner',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmarketingbanner"><button type="button" class="btn btn-primary btn-sm">Add Banner</button></a></div>
	                	</div>
			  </div>		 

<div style="padding:10px; width:100%; border-bottom:1px solid #ddd;">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>" style="width:200px;"><input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>" /></td>
    <td><button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></td>
  </tr>
</table>

</div>
						<table class="table">
							<thead>
								<tr>
									<th width="10%">Banner </th>
									<th><div align="left">Title</div></th>
									<th><div align="left">Category</div></th>
									<th><div align="center">Sequence</div></th>
									<th><div align="center">Status </div></th>
									<th align="right"><div align="center">Date</div></th>
								<th align="right">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
 
 
 

$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;

if($_REQUEST['keyword']!=''){
$search.=' where title like "%'.$_REQUEST['keyword'].'%" ';
}
$search.='';


$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','marketingBanner',' '.$search.' order by id desc ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){




	
$cat=GetPageRecord('*','marketingCategory','id="'.$rest['category_id'].'" order by title asc');
$catData=mysqli_fetch_array($cat);
?>
						
<tr>
<td width="10%" align="left" valign="top"><img src="upload/<?php echo $rest['bannerImage']; ?>" style="width:100px; " /></td>
<td align="left" valign="top"><div align="left"><?php echo strip($rest['bannerTitle']); ?></div></td>
<td align="left" valign="top"><div align="left"><?php echo strip($catData['title']); ?></div></td>
<td align="left" valign="top"><div align="center"><?php echo strip($rest['sequence']); ?></div></td>
<td align="left" valign="top">
<div align="center">
  <?php if($rest['status']==1){ ?>
  <span class="badge badge-success">Active</span>
  <?php }else{ ?>
  <span class="badge badge-secondary">Inactive</span>
  <?php } ?>
</div>
</td>

<td align="right" valign="top"><div align="center"><?php echo date('d-m-Y',strtotime($rest['addDate'])); ?></div></td>

<td align="right" valign="top"><a style="cursor:pointer;" onclick="loadpop('Edit Banner',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmarketingbanner&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
									

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




   