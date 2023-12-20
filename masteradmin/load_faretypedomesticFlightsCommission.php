<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$id=decode($_REQUEST['id']); 


if($_REQUEST['dltid']!='' && $_REQUEST['name']!=''){ 
deleteRecord('fareTypedomesticFlightsCommissionMaster','id="'.decode($_REQUEST['dltid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
deleteRecord('agent_fareTypedomesticFlightsCommissionMaster',' flightId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" and name="'.trim($_REQUEST['name']).'"');
}
?>

<table class="table">
							<thead>
								<tr>
								  <th align="left"><div align="left">Com. Type </div></th>
								  <th align="left">Fare Type</th>
									<th align="left">Markup</th>
									<th align="left" style="display:none;">Cash&nbsp;Back</th>
									<th width="5%" align="left"><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
					 
<?php 
$n=1;  
$roomslist='';
$rs=GetPageRecord('*','fareTypedomesticFlightsCommissionMaster',' flightId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" order by id desc');
while($rest=mysqli_fetch_array($rs)){


$rs88=GetPageRecord('*','sys_commissionType',' id="'.$rest['commissionType'].'"'); 
$comtype=mysqli_fetch_array($rs88); 
 
?>
<tr>
  <td align="left">							    <div style="background-color: #FFCC00;  <?php if($rest['commissionType']==2){ ?>background-color: #FFCC00;<?php } ?><?php if($rest['commissionType']==1){ ?>background-color:#e7e7e7;<?php } ?><?php if($rest['commissionType']==3){ ?>background-color:#F7F7F7;;<?php } ?>font-weight: 700; padding: 5px 10px; display: inline-block; line-height: 10px; border-radius: 10px;">
	      <div align="center"><?php echo stripslashes($comtype['name']); ?>          </div>
      </div></td>
  <td align="left"><?php echo stripslashes($rest['name']); ?></td>
  <td align="left"><?php echo stripslashes($rest['markupValue']); ?> <?php echo stripslashes($rest['markupType']); ?></td>
  <td align="left" style="display:none;"><?php echo stripslashes($rest['cashBackValue']); ?><?php echo stripslashes($rest['cashBackType']); ?></td>
  <td width="5%" align="left"><div align="center"><a  style="cursor:pointer;"  onclick="if(confirm('Are you sure you want to delete this fare type?')) loadcrusecostdlt('<?php echo encode($rest['id']); ?>','<?php echo ($rest['name']); ?>');">
									  <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
								    </a>
									
									</div></td>
</tr> 

<?php $n++; } ?>
			
<?php
$roomslist='';
$a=GetPageRecord('*','fareTypedomesticFlightsCommissionMaster',' flightId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" order by id desc');
while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).' '.($roomlist['markupValue']).' '.($roomlist['markupType']).'</div>'; }   ?> 			
						
<script>
$('#displayroomrate<?php echo $id; ?>').html('<?php echo $roomslist; ?>');
</script>						
							</tbody>
						</table>

<?php if($n==1){ ?>
<div style="font-size:14px; color:#999999; text-align:center; padding:20px 0px; width:100%;">Nothing Found</div>
<?php } ?>