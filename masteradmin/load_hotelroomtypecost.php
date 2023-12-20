<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$id=decode($_REQUEST['id']); 


if($_REQUEST['dltid']!=''){ 
deleteRecord('sys_HotelRoomTypeCost','id="'.decode($_REQUEST['dltid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}
?>

<table class="table">
							<thead>
								<tr>
									<th align="left">Room</th>
									<th align="left">Inclusion</th>
									<th align="left">Cancellation Policy</th>
									<th align="left"><div align="center">From</div></th>
									<th align="left"><div align="center">To</div></th>
									<th align="left"><div align="center">Room Cost</div></th>
									<th align="left"><div align="center">Child With Bad</div></th>
									<th align="left"><div align="center">Child Without Bad</div></th>
									<th align="left"><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
					 
<?php 
$n=1;  
$roomslist='';
$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$id.'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<tr>
<td align="left"><?php echo $rest['roomType'] ?></td>
<td align="left"><?php echo $rest['inclusion']; ?></td>
<td align="left"><?php echo $rest['cancellationPolicy']; ?></td>
<td align="left"><div align="center"><?php echo date('d-m-Y',strtotime($rest['validFrom'])); ?></div></td>
<td align="left"><div align="center"><?php echo date('d-m-Y',strtotime($rest['validTo'])); ?></div></td>
<td align="left"><div align="center"><?php echo $rest['adultCost']; ?> INR</div></td>
<td align="left"><div align="center"><?php echo $rest['childCost']; ?> INR</div></td>
<td align="left"><div align="center"><?php echo $rest['infantCost']; ?> INR</div></td>
<td align="left"><div align="center"><a  style="cursor:pointer;" onclick="$('#inclusion').val('<?php echo ($rest['inclusion']); ?>');$('#cancellationPolicy').val('<?php echo ($rest['cancellationPolicy']); ?>');$('#roomType').val('<?php echo ($rest['roomType']); ?>');$('#checkInDate').val('<?php echo date('d-m-Y',strtotime($rest['validFrom'])); ?>');$('#checkOutDate').val('<?php echo date('d-m-Y',strtotime($rest['validTo'])); ?>');$('#adultCost').val('<?php echo $rest['adultCost']; ?>');$('#childCost').val('<?php echo $rest['childCost']; ?>');$('#infantCost').val('<?php echo $rest['infantCost']; ?>');$('#editid').val('<?php echo encode($rest['id']); ?>');">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a>
									
									&nbsp;&nbsp;
									<a  style="cursor:pointer;"  onclick="if(confirm('Are you sure you want to delete this rate?')) loadroomtypecostdlt('<?php echo encode($rest['id']); ?>');">
									  <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
								    </a>
									
									</div></td>
</tr> 

<?php $n++; } ?>
			
<?php
$roomslist='';
$a=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$id.'" and parentId="'.$LoginUserDetails['parentId'].'" and validTo>="'.date('Y-m-d').'" and validFrom<="'.date('Y-m-d').'" group by roomTypeId order by id desc');
while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.$roomlist['roomType'].' '.gethotelroomtype($roomlist['roomTypeId']).' ('.$roomlist['adultCost'].' '.currencyname($roomlist['currencyId']).')'.'</div>'; }   ?> 			
						
<script>
$('#displayroomrate<?php echo $id; ?>').html('<?php echo $roomslist; ?>');
</script>						
							</tbody>
						</table>

<?php if($n==1){ ?>
<div style="font-size:14px; color:#999999; text-align:center; padding:20px 0px; width:100%;">No Room Found</div>
<?php } ?>