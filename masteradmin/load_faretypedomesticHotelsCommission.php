<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$id=decode($_REQUEST['id']); 


if($_REQUEST['dltid']!='' && $_REQUEST['name']!=''){ 
deleteRecord('fareTypedomesticHotelsCommissionMaster','id="'.decode($_REQUEST['dltid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
deleteRecord('agent_fareTypedomesticHotelsCommissionMaster',' hotelId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" and name="'.trim($_REQUEST['name']).'"');
}
?>

<table class="table">
							<thead>
								<tr>
								  <th align="left">Commission</th>
									<th align="left"><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
					 
<?php 
$n=1;  
$roomslist='';
$rs=GetPageRecord('*','fareTypedomesticHotelsCommissionMaster',' hotelId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
 
?>
<tr>
  <td align="left"><?php echo stripslashes($rest['markupValue']); ?><?php echo stripslashes($rest['markupType']); ?></td>
  <td align="left"><div align="center"><a  style="cursor:pointer;"  onclick="if(confirm('Are you sure you want to delete this fare type?')) loadcrusecostdlt('<?php echo encode($rest['id']); ?>','<?php echo ($rest['name']); ?>');">
									  <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
								    </a>
									
									</div></td>
</tr> 

<?php $n++; } ?>
			
<?php
$roomslist='';
$a=GetPageRecord('*','fareTypedomesticHotelsCommissionMaster',' hotelId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" order by id desc');
while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).' '.($roomlist['markupValue']).' '.($roomlist['markupType']).'</div>'; }   ?> 			
						
<script>
$('#displayroomrate<?php echo $id; ?>').html('<?php echo $roomslist; ?>');
</script>						
							</tbody>
						</table>

<?php if($n==1){ ?>
<div style="font-size:14px; color:#999999; text-align:center; padding:20px 0px; width:100%;">Nothing Found</div>
<?php } ?>