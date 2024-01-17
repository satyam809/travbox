<?php
$systemname="Earn My Travel";
$footerversion="V. 3.0 - Earn My Travel"; 
$adminurl="http://localhost/travbox//masteradmin/";
$websiteurl="http://localhost/travbox//agent/";
$fullurl="http://localhost/travbox//agent/";
$logoutUrl="http://localhost/travbox//agent/";
$imgurl="http://localhost/travbox//masteradmin/upload/";
$cabimgurl="http://localhost/travbox//masteradmin/upload/";



$rs=GetPageRecord('*','sys_companyMaster','id=1'); 
$getcompanybasicinfo=mysqli_fetch_array($rs);
?>
