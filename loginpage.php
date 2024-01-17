<?php 

include "config/database.php"; 

include "config/function.php"; 

include "agenturlinc.php";



$rs=GetPageRecord('*','sys_companyMaster','userId=1');  

$getlogo=mysqli_fetch_array($rs); 



if($_POST['username']!='' && $_POST['password']!=''){ 



ini_set('max_execution_time', '300');  



$domainName=str_replace('www.','',$_SERVER['SERVER_NAME']); 

$rs=GetPageRecord('*','sys_userMaster','domainName="'.$domainName.'" ');  

$AgentWebsiteData=mysqli_fetch_array($rs);



$cip=$_SERVER['REMOTE_ADDR'];   

$clogin=date('Y-m-d H:i:s');   


$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."' and id!=1 and  password='".md5($_POST['password'])."'  and (userType='agent') ")  or die(mysqli_error());  

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
if($userinfo['status']==1){

    

    

  deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 

  

  $_SESSION['agentUserid']=$userinfo['id'];   

  $_SESSION['parentAgentId']=$userinfo['parentAgentId'];  

  $_SESSION['agentUsername']=$userinfo['email'];    

  $_SESSION['parentid']=$userinfo['parentId'];  

  if($userinfo['profile_status']=='complete'){

    $_SESSION['profile_statusMessage'] = 'In order to access the system, please complete your profile. Your profile information is essential for a seamless experience. '; // Set the session variable

  }

  if($userinfo['profile_status']=='incomplete'){

    $_SESSION['profile_statusMessage'] = 'Your profile is now complete! We will  be in touch shortly for verification. Thanks for your cooperation.'; // Set the session variable

  }

   $_SESSION['profile_status']=$userinfo['profile_status']; 



  

  loginattampmail($userinfo['id'],$_POST['username']); 

  

  $sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='User Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  

  mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

   

  $sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['agentUserid']."";  

  mysqli_query(db(),$sql_ins) or die(mysqli_error());  

  

  

  

  if($userinfo['complete']=='complete'){

  

  header('Location: '.$fullurl.'');

   

  }else{

   header('Location: '.$fullurl.'flights');

  }

  

  exit();

   

  }else{

   

   $notactivated=1;

   

  }


} else {



$notlogin=1;



}

 

} 





$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  

$AgentWebsiteData=mysqli_fetch_array($rs);

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<title>Login - <?php echo $systemname; ?></title> 

<?php include "headerinc.php"; ?>

</head>



<body id="loginbg" class="loginbody">

  <!-- header -->

   

<div id="loginouter">

<div id="loginouterin" class="formloginouter">

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="logintable">

  <tr>

    <td colspan="2" align="left" valign="top">

    <!--<div class="container">-->

    <div >

  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->

    <ol class="carousel-indicators">

      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

      <li data-target="#myCarousel" data-slide-to="1"></li>

      <li data-target="#myCarousel" data-slide-to="2"></li>

      <li data-target="#myCarousel" data-slide-to="3"></li>

    </ol>



    <!-- Wrapper for slides -->

    <div class="carousel-inner">

      <div class="item active">

        <img src="images/loginbanner.png" class="leftbanner" alt="travbox" style="width:100%;">

      </div>

 <div class="item">

        <img src="images/welcome.png" class="leftbanner" alt="travbox" style="width:100%;">

      </div>

      <div class="item">

        <img src="images/cruise.jpg" class="leftbanner" alt="travbox" style="width:100%;">

      </div>

    

      <div class="item">

        <img src="images/GlobalFlight.jpg" class="leftbanner" alt="travbox" style="width:100%;">

      </div>

      

    </div>



    <!-- Left and right controls -->

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">

      <span class="glyphicon glyphicon-chevron-left"></span>

      <span class="sr-only">Previous</span>

    </a>

    <a class="right carousel-control" href="#myCarousel" data-slide="next">

      <span class="glyphicon glyphicon-chevron-right"></span>

      <span class="sr-only">Next</span>

    </a>

  </div>

</div></td>

    <td width="40%" align="left" valign="">

      <div class="loginform"> 

<form action=""  method="post">

            <div class="formlogo">

              <img src="<?php echo $img_newurl; ?><?php echo $AgentWebsiteData['companyLogo']; ?>" style="height:55px;margin-left: 80px; margin-bottom: 60px;" >

              <p>Login here to your account as</p>

			
              <?php if($notlogin==1){?> 

<div style="margin:10px 0px; color:#CC0000; font-size:12px; font-weight:600;">Invalid Login!</div>

<?php } ?>

<?php if($notactivated==1){?> 

<div style="margin:10px 0px; color:#CC0000; font-size:12px; font-weight:600;">Your Account is not activated yet ,Please contact your admin</div>

<?php } ?>

            </div>

            <div class="inputbox">

              <input name="username" type="email" id="username" placeholder="Email">

              <input name="password" type="password" id="password" placeholder="Password">

            </div>

            <div class="loginbutton">

             <a>

                  <button type="submit">Login</button>

				  </a>

               

            </div>

            <div class="reset">

              <p>Forgot your password ? <a style=" cursor:pointer; color:var(--blue);" onclick="loadpop('Reset Password',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=resetpassword">Reset Here</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style=" cursor:pointer; color:var(--blue);" href="/masteradmin/login.html">Distributer login</a></p>

              

              <hr>

              <p class="dontheading">Don't have an account?

              </p>

            </div>

            <p></p>

            <div class="createbutton">

              <a href="sign-up">

                <button type="button">Create Account</button>

              </a>

            </div>

            <div style="text-align: center;padding: 7px ;font-weight: bold;">For more Enquiry : +91 8929000444</a></div>

             <div style="text-align: center;padding: 0px ;font-weight: bold;">For Whatsapp Enquiry : <a href="https://wa.me/+917717301769" class="whatsapp-button" target="_blank"><i class="fa fa-whatsapp" style="font-size:13px;color:#075e54"></i> +91 7717301769</a></div>

            <!--<div class="loginlinks">-->

              

            <!--  <a href="<?php echo $fullurl; ?>about-us">About</a>-->

            <!--  <a href="<?php echo $fullurl; ?>terms-conditions">Terms & conditions</a>-->

            <!--  <a href="<?php echo $fullurl; ?>privacy-policy">Privacy Policy</a>-->

            <!--  <a href="<?php echo $fullurl; ?>contact-us">Contact</a>-->

            <!--</div>-->

        </form>

      </div>

    </td>

  </tr>

</table>



</div>

</div>

<?php include "footerinc.php"; ?>

</body>

</html>





















