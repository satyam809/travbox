<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$id=decode($_REQUEST['id']); 


if($_REQUEST['dltid']!=''){ 
deleteRecord('sys_vehicleCost','id="'.decode($_REQUEST['dltid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}
?>

<table class="table">
							<thead>
								<tr>
								  <th align="left">Supplier</th>
									<th align="left">Vehicle</th>
									<th align="left"><div align="center">From</div></th>
									<th align="left"><div align="center">To</div></th>
									<th align="left"><div align="center">Vehicle Cost</div></th>
									<th align="left"><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
					 
<?php 
$n=1;  
$roomslist='';
$rs=GetPageRecord('*','sys_vehicleCost',' sightseeingId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 

 
$a=GetPageRecord('*','sys_userMaster',' id="'.$rest['supplier'].'"   order by id desc');
$supplierdata=mysqli_fetch_array($a);
?>
<tr>
  <td align="left"><?php echo stripslashes($supplierdata['companyName']); ?></td>
<td align="left"><?php echo vehiclename($rest['vehicleId']).' '.vehiclenamepax($rest['vehicleId']); ?></td>
<td align="left"><div align="center"><?php echo date('d-m-Y',strtotime($rest['validFrom'])); ?></div></td>
<td align="left"><div align="center"><?php echo date('d-m-Y',strtotime($rest['validTo'])); ?></div></td>
<td align="left"><div align="center"><?php echo $rest['adultCost']; ?> <?php echo currencyname($rest['currencyId']); ?></div></td>
<td align="left"><div align="center"><a  style="cursor:pointer;" onclick="$('#roomTypeid').val('<?php echo ($rest['vehicleId']); ?>');$('#checkInDate').val('<?php echo date('d-m-Y',strtotime($rest['validFrom'])); ?>');$('#checkOutDate').val('<?php echo date('d-m-Y',strtotime($rest['validTo'])); ?>');$('#adultCost').val('<?php echo $rest['adultCost']; ?>');$('#childCost').val('<?php echo $rest['childCost']; ?>');$('#infantCost').val('<?php echo $rest['infantCost']; ?>');$('#currencyId').val('<?php echo $rest['currencyId']; ?>');$('#editid').val('<?php echo encode($rest['id']); ?>');$('#supplier').val('<?php echo $rest['supplier']; ?>');">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a>
									
									&nbsp;&nbsp;
									<a  style="cursor:pointer;"  onclick="if(confirm('Are you sure you want to delete this rate?')) loadvehiclecostdlt('<?php echo encode($rest['id']); ?>');">
									  <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
								    </a>
									
									</div></td>
</tr> 

<?php $n++; } ?>
			
<?php
$roomslist=''; 
$a=GetPageRecord('*','sys_vehicleCost',' sightseeingId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" group by vehicleId order by id desc');
while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.vehiclename($roomlist['vehicleId']).' - '.vehiclenamepax($roomlist['vehicleId']).' ('.$roomlist['adultCost'].' '.currencyname($roomlist['currencyId']).')'.'</div>'; }   ?> 			
						
<script>
$('#displayroomrate<?php echo $id; ?>').html('<?php echo $roomslist; ?>');
</script>						
							</tbody>
						</table>

<?php if($n==1){ ?>
<div style="font-size:14px; color:#999999; text-align:center; padding:20px 0px; width:100%;">No Extra Found</div>
<?php } ?>