<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$agentId=decode($_REQUEST['agentId']); 


if($_REQUEST['dltid']!=''){ 
deleteRecord('sys_agentImageGallery','id="'.decode($_REQUEST['dltid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}
?>
<?php
$n=1;
$rs8=GetPageRecord('*','sys_agentImageGallery','agentId="'.$agentId.'" '); 
while($agentWebsitePages=mysqli_fetch_array($rs8)){
?>
<div class="col-md-3">
<div class="form-group" style="position: relative; top: 0px;">
	 <div style="position:absolute; top:0px; background-color: #ffffffd9; width: 100%;"><i class="fa fa-trash" aria-hidden="true" style="font-size: 15px; color: #FF0000; cursor: pointer; float: right; margin: 3px;" onclick="deleteimg('<?php echo encode($agentWebsitePages['id']); ?>','<?php echo $_REQUEST['agentId']; ?>');"></i></div>
	  <img src="<?php echo $fullurl; ?>upload/<?php echo $agentWebsitePages['name']; ?>" style="width:170px;height: 109px;" />
	 
</div> 
</div>
<?php $n++; } ?>
<?php if($n==1){ ?>
<div style="font-size:14px; color:#999999; text-align:center; padding:20px 0px; width:100%;">No Image Found</div>
<?php } ?>