<?php
include "config/database.php";
include "config/function.php";
include "config/setting.php";
include "urlinc.php";

$rs=GetPageRecord('*','sys_companyMaster','id=1'); 
$getlogo=mysqli_fetch_array($rs);


if($_POST['username']!='' && $_POST['password']!=''){

$cip=$_SERVER['REMOTE_ADDR'];  
$clogin=date('Y-m-d H:i:s');  
$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."' and  password='".md5($_POST['password'])."' and status=1 and (userType='admin' or userType='staff') ")  or die(mysqli_error()); 
$number =mysqli_num_rows($result);  
if($number>0) 
{  

$select=''; 
$where=''; 
$rs=''; 
 
$select='*'; 
$where="email='".$_POST['username']."' and  password='".md5($_POST['password'])."'"; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$userinfo=mysqli_fetch_array($rs);
  

$_SESSION['userid']=$userinfo['id'];  
$_SESSION['username']=$userinfo['email'];   
$_SESSION['parentid']=$userinfo['parentId'];   
$_SESSION['admintype']='masteradmin';

$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='User Login',userId='".$_SESSION['userid']."',parentId='".$userinfo['parentId']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
  

$sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['userid'].""; 
mysqli_query(db(),$sql_ins) or die(mysqli_error()); 
  

header('Location: '.$fullurl.'');
exit();
} else {
$notlogin=1;
}

}
?>

<!DOCTYPE html>
<html lang="zxx">

 <head>
    <title>Login - <?php echo $systemname; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="login/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="login/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="login/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?php echo $fullurl; ?>login/favicon.png" type="image/x-icon" >

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="login/css/style.css">
<style>
.login-15 .form-section .form-group { margin-bottom: 15px; }
.login-15 .form-section .form-control { padding: 10px 10px; font-size: 16px; outline: none; height: 45px; color: #535353; border-radius: 0px; font-weight: 500; border: 1px solid transparent; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; }
.login-15 .btn-primary { background: #77c6d6; }
.login-15 .btn-primary:before { background: #77c6d6; }

.bgimg { position: absolute; z-index: 0; left: 0px; bottom: 0px; width: 100%; height: auto; min-height: 100%; display: block; }
</style>
</head>
<body id="top">

<img src="login/loginbgportal.jpg" class="bgimg">
<div class="page_loader"></div>

<!-- Login 15 start -->
<div class="login-15">
    <div class="container">
        <div class="row login-box" style="max-width:350px; background-color:transparent;">
            <div class="col-lg-12 align-self-center pad-0">
                <div class="form-section align-self-center" style="padding: 30px 30px;border-radius: 5px;">
				<div style="text-align:center; margin-bottom:10px;"><img src="<?php echo $superadminurl; ?>upload/<?php echo $getlogo['companyLogo']; ?>" alt="<?php echo stripslashes($getlogo['companyName']); ?>" style="height: 143px;margin-top: -38px;"></div>
                    <h3 style="font-size:18px; color:#000000; margin-bottom:5px; margin-top:20px;">Distributor Login</h3>
					<div style="font-size:12px; margin-bottom:20px;">Login with your login credentials.</div>
                     
                     
                    <form action=""  method="post">
                        <div class="form-group">
                            <input name="username" type="email" class="form-control" id="username" placeholder="Email Address" aria-label="Email Address">
                        </div>
                        <div class="form-group clearfix">
                            <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-lg btn-primary btn-theme" style="width: 100%;"><span>Login</span></button>
                            
                        </div>
                    </form>
                     
                </div>
            </div>
             
        </div>
    </div>
</div>
<!-- Login 15 end -->

<!-- External JS libraries -->
<script src="login/js/jquery-3.6.0.min.js"></script>
<script src="login/js/bootstrap.bundle.min.js"></script>
<script src="login/js/jquery.validate.min.js"></script>
<script src="login/js/app.js"></script>
<!-- Custom JS Script -->
</body>
 
</html>

























