 <div class="page-header">
	 

		<div class="page-header-content header-elements-md-inline" >
			<div class="page-title d-flex">
				<h4><a href="<?php echo $fullurl; ?>"><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></a> - Package Enquiry</h4> 
			</div>
			
			  
		</div>
		
				
	</div>

<div class="page-content pt-0" > 
		
 	
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
			<?php if($_REQUEST['did']!=''){ ?>
			<div class="alert alert-success alert-styled-right alert-arrow-right alert-dismissible">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
										 Hotel Booked Successfully. <strong>Booking ID: <?php echo $_REQUEST['did']; if($_REQUEST['rid']!=''){ ?> - Return Hotel Booking ID: <?php echo $_REQUEST['rid']; } ?></strong>
		      </div>
									<?php  }?>
			<div class="card">
						 
					

			<div class="card-header header-elements-inline">
						<h5 class="card-title">Package Enquiry List</h5>
						<div class="header-elements">
							<!--<div class="list-icons">
		                		 <a href="display.html?ga=hotellibrary"><button type="button" class="btn btn-primary btn-sm">Hotel Setting</button></a>
		                		  
		                	</div>-->
	                	</div>
						
						
			  </div>		 

				 
									
									
						<table class="table">
							<thead>
								<tr>
								  <th>Agent</th>
								  <th>Package </th>
									<th>Destination</th>
									<th>Departure</th>
									<th>Departure Date </th>
									<th>Contact</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(CheckIn)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(CheckIn)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (Destination like "%'.$_REQUEST['keyword'].'%" or  HotelName like "%'.$_REQUEST['keyword'].'%" or  HotelCode like "%'.$_REQUEST['keyword'].'%" or RoomType like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
  
$rs=GetRecordList('*','packageEnquiry',' where 1 and agentId in (select id from sys_userMaster where parentId="'.$_SESSION['userid'].'") '.$search.' order by id desc','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
 $ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
?>
								
								<tr>
								  <td align="left" valign="top"><strong><?php echo strip($agentData['companyName']); ?></strong><div style="width:140px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div></td>
								  <td align="left" valign="top"><?php echo strip($rest['packageName']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['citydestination']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['departureCity']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['departureDate']); ?></td>
								  <td align="left" valign="top"><?php echo strip($rest['name']); ?><br />
                                      <strong>Phone:</strong> <?php echo strip($rest['mobile']); ?><br />
<strong>Email:</strong> <?php echo strip($rest['email']); ?></td>
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

<div style=" display:none;" id="savedatasub"></div>
<script>

function pickedbyfun(id){
var pickedBy=0;
if($("#pickedBy"+id).prop('checked') == true){
    pickedBy=1;
}

$('#savedatasub').load('actionpage.php?action=savepickedbyhotel&id='+id+'&pickedBy='+pickedBy);

}

</script>



   