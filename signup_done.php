<?php 
include "config/database.php"; 
include "config/function.php"; 
include "agenturlinc.php";

 $a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 


$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Thank You - <?php echo $systemname; ?></title> 
<?php include "headerinc.php"; ?>
</head>

<body id="loginbg" class="loginbody">
  <!-- header -->
   
<div id="loginouter" style="height: fit-content; ">
<div id="loginouterin" class="formloginouter">
 <div class="loginform" style="text-align:center;">  
 <div style="text-align:center;"><img src="<?php echo $img_newurl; ?><?php echo $AgentWebsiteData['companyLogo']; ?>" id="company_logo"  style="height: 200px; margin-top: 40px;"></div>
 <div id="heading_msg" style="background-color: var(--lowblue); margin-top: 40px; padding: 30px; border-radius: 10px;"> <h1 style="  margin-bottom: 8px;">
 <div style="text-align:center; color:#02DF97; font-size:50px; margin-bottom:10px;"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
 <strong>Thanks for registering!</strong></h1>
     <p style="font-size:15px;">Your account has been created successfully. Your login credentials sent to your email id.</p> 
 </div>
 

  <div style="margin:5px 0px; font-size:18px; text-align:center; padding:20px 0px; ">
	  
	  <table border="0" align="center" id="agent" cellpadding="10" cellspacing="0" style="width: 500px; margin: auto;">
  <tr>
    <td width="50%" class="width_td" align="right"><strong>Your Agent ID:  </strong></td>
    <td width="50%"><strong><?php echo $_SESSION['mainAgentId']; ?></strong></td>
  </tr>
</table>

	  </div>
	   
	    
	  
	  
	  <div style="margin-top:20px; margin-bottom:40px; text-align:center;"><a href="https://www.travbox.travel/login"><button type="button" class="btn btn-danger" style="background-color: var(--blue); margin-bottom: 0px !important; max-width: 300px;">Go to login page</button></a></div>
   
    </div>

</div>
</div>
<?php include "footerinc.php"; ?>
</body>
</html>
