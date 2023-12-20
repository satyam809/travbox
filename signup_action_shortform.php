<?php 
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php";
include "agenturlinc.php";

if($_REQUEST['email']!='' && $_REQUEST['unique']!='')
{
   $email=trim($_REQUEST["email"]); 
   $rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'"  ');  
   

   $dubcheck=mysqli_fetch_array($rs8);  
   //print_r( $dubcheck); exit;

    if($dubcheck['id']!='')
    {
       $status = 'true';
      
    }
    else
    {
       $status = 'false';
    }
    echo  $status;
    exit;
}






if($_REQUEST["action"]=="register" && $_POST["companyName"]!="" && $_POST["mobile"]!="" && $_POST["email"]!=""   ){

$companyName=trim($_REQUEST["companyName"]); 
$mobile=trim($_REQUEST["mobile"]);
$email=trim($_REQUEST["email"]); 
$countryCode=trim($_REQUEST["countryCode"]); 
	

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" and parentId="'.$staticparentId.'" ');  

$dubcheck=mysqli_fetch_array($rs8);  

if($dubcheck['id']!=''){


?>

<script>alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!');</script>

<?php



}else{
$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 

$lag=GetPageRecord('*','sys_userMaster',' userType="agent" order by id desc'); 
$lastagentid=mysqli_fetch_array($lag);
$lastAgentId=round($lastagentid['agentId']+1);

//Insert
$namevalue ='companyName="'.$companyName.'",countryCode="'.$countryCode.'",email="'.$email.'",phone="'.$mobile.'",parentAgentId=1,parentId="'.$staticparentId.'",addDate="'.date('Y-m-d H:i:s').'",addBy="0",userType="agent",status=0,profile_status="incomplete",agentId="'.$lastAgentId.'"';

$userId=addlistinggetlastid('sys_userMaster',$namevalue);

if ($userId < 100) {
  // Append leading zeros to make it a 3-digit number
  $mainAgentId = "TB" . str_pad($userId, 3, '0', STR_PAD_LEFT);
} else {
  $mainAgentId = "TB" . $userId;
}
$namevalue ='mainAgentId="'.$mainAgentId.'"';  
$where=' id="'.$userId.'"';
updatelisting('sys_userMaster',$namevalue,$where); 

$_SESSION['mainAgentId']=$mainAgentId;

$ccmail='';   
$file_name='';  

$subject = 'Login Details - '.strip($getcompanybasicinfo['companyName']).''; 
//echo "<img src="'.$img_newurl.$getcompanybasicinfo['companyLogo'].'" height="45">"

$mailbody='<div style="text-align:center; width:100%; padding:20px 0px; background-color:#F4F4F4"> 
<table width="638" border="0" align="center" cellpadding="5" cellspacing="0" style="border: 1px solid #efefef; background-color:#FFFFFF;"> 
  <tr> 
    <td colspan="3" style="padding:20px;"><div align="left">
    <img src="'.$img_newurl.'167723296411226380101675418564.png'.'" height="100">
    </div>
    </td> 
  </tr> 
  <tr> 
  <td colspan="3"  style="padding:20px;"><div align="left">Dear '.$companyName.',<br /> 
          <br /> 
      Thank you for register with us.<br /> 
  <br /> 
  We will back to you soon.
  <br/>
  Agent ID: '.$mainAgentId.'<br />
 

    </div></td>

  </tr>

  <tr>

    <td colspan="3" bgcolor="#77c6d6" style="padding:20px; color:#fff;"><table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:16px; color:#fff;">

      <tr>

        <td colspan="2" align="center"><strong>HOW TO REACH US</strong></td>

        </tr>

      <tr>

        <td width="48%"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">

          <tr>

            <td colspan="2"><img src="'.$fullurl.'images/emailphone.png" width="38" height="38"></td>

            <td width="90%" style="padding-left:10px;"><div align="left">Live Assistance

            </div>

              <div style="font-size:18px; ">

                <div align="left"><strong>'.$getcompanybasicinfo['phone'].'</strong></div>

              </div>			</td>

          </tr>

          

        </table></td>

        <td style="border-left:1px solid #fff; padding-left:20px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">

          <tr>

            <td colspan="2"><img src="'.$fullurl.'images/emailemail.png" width="38" height="38"></td>

            <td width="90%" style="padding-left:10px;"><div align="left">E-mail us at</div>

              <div style="font-size:14px; ">

              <div align="left"><a href="mailto:'.$getcompanybasicinfo['email'].'" style="color:#fff; text-decoration:none;">'.$getcompanybasicinfo['email'].'</a></div>

            </div>			</td>

          </tr>

          

        </table></td>

      </tr>

      

    </table></td>

  </tr>

  <tr>

    <td colspan="3" align="center"><img src="'.$fullurl.'images/savingimage.png" width="100%" ></td>

  </tr>

</table>

</div> ';

 


$bcc_mail='Yes';
 sendmainmail($email,$subject,$mailbody,$bcc_mail); 



?>


 

<script> 
//window.parent.location.href = "<?php //echo $fullurl; ?>signup-done"; 
// window.location.href = "<?php //echo $fullurl; ?>signup-done"; 
//window.location.href = "<?php// echo $fullurl; ?>/signup-done";
window.location.replace("<?php echo $fullurl; ?>/signup-done");
</script> 

<?php 

} 


}



?>