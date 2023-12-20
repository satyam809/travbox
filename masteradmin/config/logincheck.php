<?php 
if($_SESSION['userid']=="" || $_SESSION['username']=="" || $_SESSION['parentid']=="" || $_SESSION['admintype']==""){ 
header("Location:login.html");
exit(); }  
?>