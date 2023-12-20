<?php 
include "inc.php"; 

if($_REQUEST['i']!=''){
$a=GetPageRecord('*','quotationMaster','  id="'.decode($_REQUEST['i']).'"'); 
$quotationInfo=mysqli_fetch_array($a);

$b=GetPageRecord('*','sys_companyMaster','userId="'.$quotationInfo['addBy'].'"'); 
$LoginUserCompanyDetails=mysqli_fetch_array($b);
}

 
?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui"> 
      <title><?php echo stripslashes($quotationInfo['name']); ?> - <?php echo stripslashes($LoginUserCompanyDetails['companyName']); ?></title>  
	  
	 	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo $fullurl; ?>global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $fullurl; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $fullurl; ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $fullurl; ?>assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $fullurl; ?>assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $fullurl; ?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 
	</head>
	<body <?php if($_REQUEST['p']!='pdf'){ ?>style="background-color:#fff !important;"<?php } ?>>
	<div class="page-content pt-0" <?php if($_REQUEST['p']=='pdf'){ ?> style="padding:0px;"<?php } ?>>
	<div class="content" <?php if($_REQUEST['p']=='pdf'){ ?> style="padding:0px;"<?php } ?>>
			<div class="row" <?php if($_REQUEST['p']=='pdf'){ ?> style="padding:0px;"<?php } ?>>
			
	<div class="col-md-12" <?php if($_REQUEST['p']=='pdf'){ ?> style="padding:0px;"<?php } ?>>	
	<div style="padding:10px; background-color:#FFFFFF; <?php if($_REQUEST['p']!='pdf'){ ?>border:1px solid #ddd;  max-width:1200px; margin:auto;  <?php } ?><?php if($_REQUEST['p']=='pdf'){ ?>  <?php } else { ?>margin-top:20px;<?php } ?>" class="margin0">
<?php
if($quotationInfo['quotationType']=='Quick Package'){
include "quickpackageview.php";
}

if($quotationInfo['quotationType']=='Flight'){
include "flightquotationview.php";
}

if($quotationInfo['quotationType']=='Sightseeing'){
include "sightseeingquotationview.php";
}

if($quotationInfo['quotationType']=='Transport'){
include "transportquotationview.php";
}

if($quotationInfo['quotationType']=='Visa'){
include "visaquotationview.php";
}

if($quotationInfo['quotationType']=='Miscellaneous'){
include "miscellaneousquotationview.php";
}

if($quotationInfo['quotationType']=='Hotel'){
include "hotelquotationview.php";
}
if($quotationInfo['quotationType']=='Detailed Package'){
include "detailedpackageview.php";
}
 ?>
 </div>
 </div> </div> </div> </div>
 </body>
 </html>