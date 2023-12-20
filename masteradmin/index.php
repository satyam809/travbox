<?php 
include "inc.php"; 
include "config/logincheck.php"; 
 
 
$pageselect=''; 
 
$pageurl='dashboard.php'; 

if($_REQUEST['ga']!=''){


$addpage='';
if($_REQUEST['add']==1){
$addpage='add_';
}
 
if($_REQUEST['view']==1){
$addpage='view_';
}
 
$pageurl=$addpage.$_REQUEST['ga'].'.php'; 
echo $pageurl;
}



?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!--<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">-->
      <title><?php echo $systemname; ?></title> 
	  <?php include "headerinc.php"; ?>  
	  
   </head>
   <body> 
   <?php include "header.php"; ?>   
     
	 <?php  include $pageurl; ?>
       <?php include "footer.php"; ?>  
	 
   </body>
   
</html>