<?php 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

 $fromdate=$_REQUEST['fromdate'];
 $todate=$_REQUEST['todate'];

} else {
// $fromdate=date('d-m-Y', strtotime("-30 days"));
// $todate=date('d-m-Y'); 
}

?>

	<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4 style="font-weight:500;"><?php if($_REQUEST['stage']==''){ ?>All<?php } else { echo getquerystatus($_REQUEST['stage']); } ?> Queries</h4> 
			</div> 
			
	<div style="float:right; width:80%;" class="searchbox">
			<form method="get" id="searchform">
		<div class="row">
		
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-2">
			<div class="input-group">
	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $fromdate; ?>"  readonly >
		
			</div>
			</div>
				
		<div class="col-xl-2">
			<div class="input-group">
	 	<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $todate; ?>" readonly>
		
			</div>
			</div>
			
			
			<script>
		$( function() {
    $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  </script>
			
		<div class="col-xl-2">
			<div class="input-group">
			  
			</div>
			</div>
		
		<div class="col-xl-2">
			<div class="input-group">
			  
			</div>
			</div>
				
		<div class="col-xl-2">
			<div class="input-group">
			  
			</div>
			</div>
		
		<div class="col-xl-2">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</span>
			</div>
			</div>
				
				
				 	</div>
		</form>										
						 	</div>				
		
		</div>
		</div>


<div class="page-content pt-0">
<?php include "queryleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="selectfrm"> 
			<div class="content">
			
 <div class="card" style="margin-bottom:10px; display:none;" id="selectcheckboxbox"> 
 <div class="card-body" style="padding: 10px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="middle" style="line-height: 13px;"><input  type="checkbox" id="ckbCheckAll"   style="width: 16px; height: 16px;"  ></td>
    <td width="7%" align="left" valign="middle" style="padding-left:5px;"><div style=" width:70px;" id="selectandunselectall">Select All</div></td>
    <td width="20%" align="left" valign="middle" style="padding-left:5px;">
	
	
	<input name="action" type="hidden" value="queryBulkAssign" />
	<select id="bulkassign" name="bulkassign" class="form-control"  data-placeholder="Select User"  autocomplete="off"  onchange="$('#selectfrm').submit();">   
			<option>Assign To</option>   
 <?php  
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'"  order by name asc');
while($rest=mysqli_fetch_array($rs)){ ?>
<option value="<?php echo encode($rest['id']); ?>"><?php echo stripslashes($rest['name']); ?></option>  
 <?php } ?>
</select></td>
    <td width="73%" align="left" valign="middle" style="padding-left:5px;">&nbsp;</td>
  </tr>
</table>

 </div>
 </div>			
			
 <?php
$search='';
if($fromdate!='' && $todate!=''){
 $search.=' and DATE(addDate) between "'.date('Y-m-d',strtotime($fromdate)).'" and "'.date('Y-m-d',strtotime($todate)).'" '; 
 }
 
if($_REQUEST['user']>0){
$search.=' and assignTo = "'.$_REQUEST['user'].'"  '; 
}

if($_REQUEST['querysource']>0){
$search.=' and querySource = "'.$_REQUEST['querysource'].'"  '; 
}

if($_REQUEST['status']>0){
$search.=' and status = "'.$_REQUEST['status'].'"  '; 
}


if($_REQUEST['travelLocation']>0){
$search.=' and travelLocation = "'.$_REQUEST['travelLocation'].'"  '; 
}

if(trim($_REQUEST['keyword'])!=''){
$search.=' and (id = "'.decode(str_replace('#','',trim($_REQUEST['keyword']))).'" or  contactNumber like "%'.trim($_REQUEST['keyword']).'%" or  contactEmail like "%'.trim($_REQUEST['keyword']).'%" or  companyName like "%'.trim($_REQUEST['keyword']).'%" or  contactPerson like "%'.trim($_REQUEST['keyword']).'%") '; 
}
  
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&stage='.$_REQUEST['stage'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&destination='.$_REQUEST['destination'].'&user='.$_REQUEST['user'].'&querysource='.$_REQUEST['querysource'].'&keyword='.$_REQUEST['querysource'].'&'; 
$rs=GetRecordList('*','queryMaster',' where parentId="'.$LoginUserDetails['parentId'].'" '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$a=GetPageRecord('*','queryNote',' parentId="'.$LoginUserDetails['parentId'].'" and queryId="'.$rest['id'].'" order by id desc '); 
$lastnote=mysqli_fetch_array($a);
?>
 <div class="card querylist" style="margin-bottom: 10px; <?php if($rest['queryPriority']==1){ ?> border:1px solid #dc0808; <?php } ?>">
 
 <div class="card-body" style="padding: 10px;">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="3%" align="left" valign="top" style="padding-right:10px;"><input name="datalist[]" class="checkBoxClass" onclick="checkboxcheck();" type="checkbox" value="<?php echo encode($rest['id']); ?>"  style="width: 16px; height: 16px;" >			    </td>
    <td width="14%" align="left" valign="top" style="padding-right:20px;"><div style="font-size:15px; font-weight:500;line-height: 16px; margin-bottom:3px;"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" <?php if($rest['queryPriority']==1){ ?>style="color:#dc0808;"<?php } ?>>#<?php echo encode($rest['id']); ?></a></div>
	<?php echo getquerystatustag($rest['status']); ?> &nbsp;<?php if($rest['queryPriority']==1){ ?><i class="fa fa-free-code-camp" aria-hidden="true" style="color:#dc0808;" title="Hot Query"></i><?php } ?></td>
    <td width="20%" align="left" valign="top" style="padding-right:20px;"><div style="font-size:13px; line-height: 16px; margin-bottom:3px;white-space: nowrap; max-width:200px; overflow: hidden; text-overflow: ellipsis;"><a href="#" style="color:#333333;"><?php if($rest['queryType']==1){ echo stripslashes($rest['nameHead'].' '.$rest['contactPerson']);  } else { echo stripslashes($rest['companyName']); } ?></a></div>
	
	<div style="font-size:13px; color:#7d7d7d;"><?php echo getquerytypename($rest['queryType']); ?></div>	</td>
    <td width="17%" align="left" valign="top" style="padding-right:20px;"><div style="font-size:13px; line-height: 16px; margin-bottom:3px;"><span style="color:#7d7d7d;">From: </span><?php echo getDestination($rest['travelFromCity']); ?></div>
	
	<div style="font-size:13px; line-height: 16px;"><span style="color:#7d7d7d;">To: </span><?php echo getDestination($rest['travelLocation']); ?></div>	</td>
    <td width="15%" align="left" valign="top" style="padding-right:20px;"><div style="font-size:13px; line-height: 16px; margin-bottom:3px;"><span style="color:#7d7d7d;"><i class="fa fa-calendar" aria-hidden="true"></i></span> <?php echo date('d-m-Y', strtotime($rest['startDate'])); ?></div>
	
	<div style="font-size:13px; line-height: 16px;"><span style="color:#7d7d7d;">Till</span> <?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></div>	</td>
    <td align="left" valign="top">
	<?php if($rest['closureReasons']>0){ ?>	<div style="font-size:13px; line-height: 16px; margin-bottom:3px;"><span style="color:#FF3300; font-size:12px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;<?php  echo getquerycloserReasons($rest['closureReasons']); ?></span></div><?php } else { ?>
	<div style="font-size:13px; line-height: 16px; margin-bottom:3px;"><span style="color:#7d7d7d;">Task: </span>No Task</div>
	<?php } ?>
	
	<?php if($lastnote['comment']!=''){ ?><div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size:12px;color:#7d7d7d;"><i class="fa fa-sticky-note" aria-hidden="true" style=" color:#ffa500;"></i> &nbsp;<?php echo strip_tags(stripslashes($lastnote['comment'])); ?></div><?php } ?>
	
	</td>
    <td width="13%" align="right" valign="middle">
	<a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-primary btn-icon btn-sm" <?php if($rest['queryPriority']==1){ ?>style=" background-color:#dc0808;"<?php } ?>>View</button></style>
	<a href="display.html?ga=query&add=1&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button></a></td>
  </tr>
</table>
 
</div>
<div style="background-color:#f7f7f7;">
 <div class="card-body" style="padding: 10px;">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="3%" align="left" valign="top" style="padding-right:10px;">			    </td>
    <td width="14%" align="left" valign="top" style="padding-right:20px;"><div style="font-size:12px; line-height: 16px; margin-bottom:3px;color:#7d7d7d;">Requirement</div>
 <div class="blueicons">
<?php if($rest['typePackage'] ==1){ ?><i class="fa fa-suitcase" aria-hidden="true" title="Package"></i><?php } ?>
<?php if($rest['typeFlight'] ==1){ ?><i class="fa fa-plane" aria-hidden="true" title="Flight"></i><?php } ?>
<?php if($rest['typeTransfer'] ==1){ ?><i class="fa fa-car" aria-hidden="true" title="Transfer"></i><?php } ?>
<?php if($rest['typeHotel'] ==1){ ?><i class="fa fa-bed" aria-hidden="true" title="Hotel"></i><?php } ?> 
<?php if($rest['typeSightseeing'] ==1){ ?><i class="fa fa-picture-o" aria-hidden="true" title="Sightseeing"></i><?php } ?> 
<?php if($rest['typeMiscellaneous'] ==1){ ?><i class="fa fa-cubes" aria-hidden="true" title="Miscellaneous"></i><?php } ?>
 </div>	</td>
    <td width="20%" align="left" valign="top" style="padding-right:20px;"> 
	
	<div style="color:#888888; font-size:12px; margin-bottom:3px;"><?php echo stripslashes($rest['contactEmail']); ?></div>
	<div style="color:#888888; font-size:12px; margin-bottom:3px;"><?php echo stripslashes($rest['contactNumber']); ?></div>	</td>
    <td width="17%" align="left" valign="top" style="padding-right:20px;"><div style="color:#888888; font-size:12px; margin-bottom:3px;">Travellers</div>
	
	<div style="font-size:13px; line-height: 16px;"><?php echo stripslashes($rest['adult']); ?> <span style="color:#7d7d7d; font-size:11px;">Adult</span> <?php echo stripslashes($rest['child']); ?> <span style="color:#7d7d7d; font-size:11px;">Clild</span> <?php echo stripslashes($rest['infant']); ?> <span style="color:#7d7d7d; font-size:11px;">Infant</span></div>	</td>
    <td width="15%" align="left" valign="top" style="padding-right:20px;"><div style="color:#888888; font-size:12px; margin-bottom:3px;">Assigned to</div>
	
	<div style="font-size:12px;"><?php echo getUserName($rest['assignTo']); ?></div>	</td>
    <td align="left" valign="top"><div style="font-size:12px; line-height: 16px; margin-bottom:3px;"><span style="color:#7d7d7d;">Created</span></div>
	  <div style="font-size:11px; line-height: 16px; margin-bottom:3px;"><?php echo showdatetimesimple($rest['addDate']); ?></div>	</td>
    <td width="13%" align="left" valign="top"><div style="font-size:12px; line-height: 16px; margin-bottom:3px;"><span style="color:#7d7d7d;">Last Updated</span></div>
	  <div style="font-size:11px; line-height: 16px; margin-bottom:3px;"><?php if($rest['editDate']!='' && $rest['editDate']!='0000-00-00 00:00:00'){ echo showdatetimesimple($rest['editDate']); } else { echo '-'; } ?></div>	</td>
  </tr>
</table>
</div>
</div>

</div>
<?php $sNo++; } ?>
<?php if($sNo>1){ ?>
<div class="card-footer text-right" style="overflow:hidden;">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
<?php } else { ?>
 <div class="card">
 <div class="card-body" style="text-align:center;">
<div style="font-size:20px; font-weight:400;"><img src="assets/no-result-found.png" width="140" /></div>
</div>
</div>
<?php } ?>
</div>
</form>
</div>

</div>

<script>
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		if($(".checkBoxClass").prop('checked') == true){
		$('#selectandunselectall').text('Unselect All');
		$('.querylist').addClass("yellowBackground");
		}else{
		$('#selectandunselectall').text('Select All');
		$('.querylist').removeClass("yellowBackground");
		}
    });
});

function checkboxcheck(){
if ($('input.checkBoxClass').is(':checked')) {
$('#selectcheckboxbox').show();
} else { 
$('#selectcheckboxbox').hide();
}


$("input[type='checkbox']").change(function(){
    if($(this).is(":checked")){
        $(this).parent().parent().parent().parent().parent().parent().addClass("yellowBackground"); 
    }else{
        $(this).parent().parent().parent().parent().parent().parent().removeClass("yellowBackground");  
    }
});
}
</script>