<?php 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

 $fromdate=$_REQUEST['fromdate'];
 $todate=$_REQUEST['todate'];

} else {
// $fromdate=date('d-m-Y', strtotime("-30 days"));
// $todate=date('d-m-Y'); 
}

?>
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
<?php include "hotelsettingsleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">

<form action="" method="get" enctype="multipart/form-data" name="addeditfrm"  > 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
<span onclick="loadpop('Add Hotel',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addhotellibrary" class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add Hotel</span> 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-bed" aria-hidden="true"></i> Hotel</span>
</div>


<div style="padding:10px; width:100%; border-bottom:1px solid #ddd;">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td> <input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>" />
	<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>" style="width:200px;"></td>
    <td><button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></td>
  </tr>
</table>

</div>


<div class="nocsstable">
<table class="table">
							<thead>
								<tr>
									<th width="2%">Photo</th>
									<th width="30%">Name</th>
									<th>Type</th>
									<th>Destination</th>
									<th>Cancellation</th>
									<th>Status</th>
									<th><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

if($_REQUEST['keyword']!=''){
$search.=' and ( name like "%'.$_REQUEST['keyword'].'%" or cityName like "%'.$_REQUEST['keyword'].'%") ';
}


$search.='';

 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&destination='.$_REQUEST['destination'].'&'; 
$rs=GetRecordList('*','hotelMaster',' where addBy="'.$_SESSION['userid'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
?>	<style>
									.roomratelist{ margin-bottom:5px; }
									</style>
								<tr>
<td width="2%"><div style="width:40px; height:40px; overflow:hidden; border:1px solid #ddd; "><img src="<?php if($rest['hotelPhoto']!=''){ echo 'upload/'.stripslashes($rest['hotelPhoto']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td>

<td width="30%"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>

 

<div style="margin-top:1px; font-weight:12px; font-weight:400;display:none;"><?php echo gethotelcategorytype($rest['category']); ?></div>									</td>
<td><span class="badge bg-dark" style="background-color:#0cb5b5;"><?php echo stripslashes($rest['hotelType']); ?></span></td>
<td><?php echo $rest['cityName']; ?></td>
								
									
									<td><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo stripslashes($rest['cancellationType']); ?></td>
									<td><div align="left"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#0cb5b5;">Active</span><?php } else { ?><span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span><?php } ?></div></td>
									<td><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Hotel',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addhotellibrary&id=<?php echo encode($rest['id']); ?>">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a></div></td>
								</tr> 
								
								<tr>
<td colspan="7" bgcolor="#F9F9F9" style="position:relative;">
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAC5UlEQVR4nO2aP2gUQRSHP3MaUU9UDBIwgoImWIQogn/AQlG0sVArwVrsFLSwE+2EIAhWWkkaS8VoJwg2oiJCIkhiRA2CooUEgiSa3FpMAkH2ZmZv3uxbkvngVcO++f3e7u3MvD1IJBKJRCKRwwogs0S7njQ52ixjqx3XrpMUooWtALYxgE5JIVrYTM46rt0sKUQLWwFmHNd2SQrRwlaAaaBhGd8lrEUF10/gh2V8n7CWSvKK5svgNO6VovK43vTjlrF24JigFhVcBRhxjJ+SElJVTmLfDf4CVqmpK4FO7AXIgHNq6kriI/YCjAI1NXWB+AjvBvZaxjcCY8CQiKIKcgT3z2AUWKklMDZtwBfcRbimJbAMruMuwBSwU0tgbLZitsauIgyxCHaHzRjEXYAMGNASGJs9mNOhTxGuKGmMzkP8CpABl4XnHqACu84+TKPEpwAN4KLg3BnwEtgimLMlbuH/FGTAHUyHOZT5fD+BowL5WqYOfKJYEZ4S3kJbmO8vcCkwXxDH8X8hLjw5ng2YMy/nfWBNQM4g+puIcsUL4GAL8zXL9x6lDdhyzKPdShEawAPgcIH5XE/XiVBDrdABfHaIc8UwZt/Q45jLlWcWcx5xdbnE6QG+eQj0iRHgHnABODSXuz43j2+OQWB9PLv59ADfC4iMHR+A3qiOc+jDfEfQNj8fk8CZqI5z2Aa8CxQuHVIbMW/WAo+ETYTGc0r+ml0DrgJ/BE2Exjj23mYUeoG3gcIlY4r/Dmix18xhYD+mpTYZeS5ffmtN3AHcwNwFjbv/FXMz1NkO3AYmKM/8M2BTGeaKUAfOA68pfrIsEjcx55ZK04UpxmPMu0LCuNdGaJmsDxFqwA5g91x0Yx7fAwVyjAGnMS/hRYPvnX8CbFDSGBWX8QZmlSn9OFwWNvMTLIF/qzQzr9YSK5s886pN0bJZaHwG00ar4ioWjXnz6h9GtMiAN5hP9UuSuyziv+EkEolEIqHAP9xBnx0sdPLEAAAAAElFTkSuQmCC" width="40px;" style="position:absolute; left:10px; top:3px; width:30px;">


 
   <div style="margin-bottom:2px; cursor:pointer; padding-left:60px;  margin:auto;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('<?php echo stripslashes($rest['name']); ?>',this,'1300px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addhotellibraryroomtype&id=<?php echo encode($rest['id']); ?>">
											<?php
											$roomslist='';
											$a=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'"  order by id desc');
											while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.$roomlist['roomType'].' '.gethotelroomtype($roomlist['roomTypeId']).' ('.$roomlist['adultCost'].' '.currencyname($roomlist['currencyId']).')'.'</div>'; }  echo $roomslist; ?> <span class="badge bg-blue" style="background-color:#2196f3; cursor:pointer;" onclick="loadpop('<?php echo stripslashes($rest['name']); ?>',this,'1300px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addhotellibraryroomtype&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Room Type</span>				  </div>								    </td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						
						<div class="card-footer text-right" style="overflow:hidden;">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
			  </div>
</div>



</div>
</form>
</div>

</div>

 