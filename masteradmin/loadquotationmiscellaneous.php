<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$qid=$_REQUEST['qid'];


if($_REQUEST['mdid']!=''){ 
deleteRecord('quotationEvents','id="'.decode($_REQUEST['mdid']).'" and parentId="'.$LoginUserDetails['parentId'].'"'); 
}

$a=GetPageRecord('*','quotationEvents',' parentId="'.$LoginUserDetails['parentId'].'" and  quotationId="'.decode($qid).'" and  	eventType="Miscellaneous" order by id asc '); 
$eventdata=mysqli_fetch_array($a);


$b=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($qid).'"  order by id asc '); 
$quotationDetail=mysqli_fetch_array($b);

$c=GetPageRecord('*','queryMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$quotationDetail['queryId'].'" order by id asc '); 
$queryData=mysqli_fetch_array($c);
?>



<?php if($eventdata['id']==''){ ?>

<div style="text-align:center; font-size:30px; color:#999999; padding:38px 0px;"><i class="icon-cube3 icon-2x" aria-hidden="true" title="Miscellaneous"></i>
<div style="font-size:14px;"> No Miscellaneous Added</div>
</div>

<?php } else { ?>



<?php   
$n=1;
$ha=GetPageRecord('*','quotationEvents','  quotationId="'.decode($qid).'" and parentId="'.$LoginUserDetails['parentId'].'" and eventType="Miscellaneous" order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 
?> 
<?php if($_REQUEST['qt']=='other'){ ?><div style="text-align:left; font-size:14px; padding:10px; border-bottom:1px solid #ddd;  border-top:1px solid #ddd; background-color:#F0F0F0; margin-top:20px; "><strong>Option <?php echo $n; ?></strong></div><?php } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Name </td>
    <td width="20%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;"> Date </td>
    <td width="40%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;">Description</td>
    <td width="10%" style="padding:10px; background-color:#EFEFEF; font-weight:500; text-transform:uppercase; font-size:12px; border-bottom:1px solid #ddd;"></td>
  </tr>
 <tr>
    <td width="30%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($listdata['name']); ?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo getnationality($listdata['nationality']); ?></div></td>
    <td width="20%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo date('d-m-Y', strtotime($listdata['checkInDate'])); ?></td>
    <td width="40%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php echo stripslashes($listdata['eventDetails']); ?></td>
    <td width="10%" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd; padding-right:0px;"><div class="btn-group" style="width:90px; float: right;"> 
      <h5>
        <button type="button"   class="btn btn-light"  onclick="loadpop('Edit Miscellaneous',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmiscellaneousdetails&id=<?php echo encode($listdata['id']); ?>&quotationid=<?php echo $_REQUEST['qid']; ?>&qt=<?php echo $_REQUEST['qt']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-light" data-toggle="tooltip" onclick="if(confirm('Are you sure you want to delete this miscellaneous?')) deleteloadquotationmiscellaneous('<?php echo encode($listdata['id']); ?>');" data-html="true" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
      </h5>
    </div></td>
  </tr>
<tr>
  <td colspan="4" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><?php if($_REQUEST['qt']=='other'){ ?><tr>
  <td colspan="6" style="padding:10px; font-size:12px; border-bottom:1px solid #ddd;"><div style="border-top:2px solid #ddd; margin-top:10px; padding-top:10px;">
	
	<?php if($listdata['showTaxDetails']==0){ ?>
	<div style="background-color:#9a2b50; padding: 5px 15px; color:#fff; margin-bottom:10px;"> 
	<div style="font-size:14px; font-weight:400; text-align:right;">Hide Tax and Markup Details</strong></div> 
	</div>
	<?php } ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="88%" align="right" style="padding-bottom:5px; padding-left:20px; position:relative;"><strong>
Base Price:</strong> <?php $taxyes=0; echo $queryData['adult']; ?> Adult - <?php echo $queryData['child']; ?> Child - <?php echo $queryData['infant']; $totalpax=$queryData['adult']+$queryData['child']+$queryData['infant']; ?> Infant: </td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listdata['quotationCost']+$listdata['quotationMarkup']); ?>&nbsp;<?php echo currencyname($listdata['currencyId']); ?></td>
  </tr>
     
  
 <?php if($listdata['CGSTValue']>0){ $taxyes=1; ?>
   
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listdata['CGSTValue']); ?>% <?php echo stripslashes($listdata['CGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listdata['CGSTamount']); ?>&nbsp;<?php echo currencyname($listdata['currencyId']); ?></td>
  </tr>
  <?php } ?>
   <?php if($listdata['SGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listdata['SGSTValue']); ?>% <?php echo stripslashes($listdata['SGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listdata['SGSTamount']); ?>&nbsp;<?php echo currencyname($listdata['currencyId']); ?></td>
  </tr>
  <?php } ?>
     <?php if($listdata['IGSTValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listdata['IGSTValue']); ?>% <?php echo stripslashes($listdata['IGST']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo stripslashes($listdata['IGSTamount']); ?>&nbsp;<?php echo currencyname($listdata['currencyId']); ?></td>
  </tr>
  <?php } ?>
  <?php if($listdata['TCSValue']>0){ $taxyes=1; ?>
  <tr>
    <td align="right" style="padding-bottom:5px; padding-left:20px;"><?php echo stripslashes($listdata['TCSValue']); ?>% <?php echo stripslashes($listdata['TCS']); ?>:</td>
    <td width="12%" align="right" style="padding-bottom:5px; padding-left:20px; font-weight:500;"><?php echo $listdata['TCSamount']; ?>&nbsp;<?php echo currencyname($listdata['currencyId']); ?></td>
  </tr>

   <?php } ?>
   <tr>
    <td align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($listdata['perPerson']==0){ echo 'Per Person Price';} else { echo 'Total Price'; }?>:  </td>
    <td width="12%" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; font-weight:500;  padding-top:10px; font-size:18px; font-weight:500; border-top:1px solid #ddd;"><?php if($listdata['perPerson']==1){ echo $listdata['quotationCostWithTax']; } else { echo round($listdata['quotationCostWithTax']/$totalpax); } ?>&nbsp;<?php echo currencyname($listdata['currencyId']); ?>
      <div style="color:#666666; font-size:11px; width:120px;"><?php if($taxyes==1){ ?>Include all taxes<?php } else { ?>Taxes are not included<?php } ?></div></td>
  </tr>
   <tr>
     <td colspan="2" align="right" valign="top" style="padding-bottom:5px; padding-left:20px; padding-top:10px; font-size:18px; font-weight:500;  ">&nbsp;</td>
     </tr>
</table>

	</div></td>
  </tr><?php } ?></td>
  </tr>

</table>


<?php $n++;} ?> 

 


<?php } ?> 

<a style="cursor:pointer; margin-top:20px;" class="addbluebigbutton" onclick="loadpop('Add Miscellaneous',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addmiscellaneousdetails&quotationid=<?php echo $_REQUEST['qid']; ?>&startdate=<?php echo $queryData['startDate']; ?>&qt=<?php echo $_REQUEST['qt']; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Miscellaneous </a>