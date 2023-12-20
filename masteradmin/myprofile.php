<?php  
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['parentid'].'"'); 
$companyname=mysqli_fetch_array($rs); 
?>

<style>
.roomratelist{font-size: 11px;
    font-weight: 500;
    text-align: center;
    padding: 2px;
    background-color: #f1f1f1; margin-bottom:1px;
	}
	
	
</style>
	 

<div class="page-content pt-0">
<?php include "generalsettingsleft.php"; ?>

		<!-- Main content -->
		<div class="content-wrapper">
 
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 
 

<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-user" aria-hidden="true"></i> My Profile</span></div>


 


         <div class="card-body">
 
						<table class="table table-bordered table-striped" style=" font-size:13px;">
							
							<tbody> 
					 
								<tr>
								  <td width="10%" align="left" valign="top"><div style="width:125px;"><strong>Company Name</strong></div></td>
								  <td width="90%" align="left" valign="top"><?php echo $companyname['companyName']; ?></td>
							  </tr>
								<tr>
								  <td width="10%" align="left" valign="top"><strong>Contact Person  </strong></td>
								  <td width="90%" align="left" valign="top"><?php echo stripslashes($LoginUserDetails['name']); ?></td>
							    </tr>
								<tr>
								  <td width="10%" align="left" valign="top"><strong>Email </strong></td>
								  <td width="90%" align="left" valign="top"><?php echo stripslashes($LoginUserDetails['email']); ?></td>
							  </tr>
								<tr>
								  <td width="10%" align="left" valign="top"><strong>Contact No. </strong></td>
								  <td width="90%" align="left" valign="top"><?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?></td>
							  </tr>
							  <tr>
								  <td width="10%" align="left" valign="top"><strong>Address</strong></td>
								  <td width="90%" align="left" valign="top"><?php echo stripslashes($LoginUserDetails['address']); ?></td>
							  </tr>
							</tbody>
					  </table>
						 
			  </div>
			  
			  <div class="card-footer d-flex justify-content-between" style="position:relative; width:100%;"> 
<a style="cursor:pointer;" onClick="loadpop('Change Password',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=changepassword"><button type="button" class="btn btn-primary  ">Change Password</button></a> 

 
</div>
</div>



</div>
 
</div>

</div>

 