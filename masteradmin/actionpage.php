<?php 
include "inc.php"; 
include "config/logincheck.php"; 
include "config/mail.php"; 



function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}
?>
<script src="global_assets/js/main/jquery.min.js"></script>

<?php

if($_POST['action']=='savegeneralsetting' && $_POST['companyName']!="" && $_POST['contactPerson']!="" && $_POST['email']!="" && $_POST['phone']!="" && $_POST['country']!="" && $_POST['state']!="" && $_POST['city']!="" && $_POST['address']!=""){

$companyName=addslashes($_POST['companyName']);
$contactPerson=addslashes($_POST['contactPerson']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']);
$country=addslashes($_POST['country']);
$state=addslashes($_POST['state']);
$city=addslashes($_POST['city']);
$address=addslashes($_POST['address']);
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']);



if($_FILES["companyLogo"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}

if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}


$namevalue ='companyName="'.$companyName.'",contactPerson="'.$contactPerson.'",email="'.$email.'",phone="'.$phone.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",address="'.$address.'",companyLogo="'.$companyLogo.'"'; 
$where='userId="'.$_SESSION['userid'].'"';   
updatelisting('sys_companyMaster',$namevalue,$where);  


$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='updategeneralsetting',details='General Setting Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

?>
<script>
parent.redirectpage('display.html?ga=generalsettings&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='savebranch' && $_POST['companyName']!="" && $_POST['contactPerson']!="" && $_POST['email']!="" && $_POST['phone']!="" && $_POST['country']!="" && $_POST['state']!="" && $_POST['city']!="" && $_POST['address']!=""){

$companyName=addslashes($_POST['companyName']);
$contactPerson=addslashes($_POST['contactPerson']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']);
$country=addslashes($_POST['country']);
$state=addslashes($_POST['state']);
$city=addslashes($_POST['city']);
$address=addslashes($_POST['address']);
$userTimeZone=addslashes($_POST['userTimeZone']);
$currency=addslashes($_POST['currency']); 
$editid=addslashes($_POST['editid']);
 
$invoiceBookingEmail=addslashes($_POST['invoiceBookingEmail']);
$invoiceBookingPhone=addslashes($_POST['invoiceBookingPhone']);
$taxName1=addslashes($_POST['taxName1']);
$taxValue1=addslashes($_POST['taxValue1']);
$taxName2=addslashes($_POST['taxName2']);
$taxValue2=addslashes($_POST['taxValue2']);
$taxName3=addslashes($_POST['taxName3']);
$taxValue3=addslashes($_POST['taxValue3']);
$taxName4=addslashes($_POST['taxName4']);
$taxValue4=addslashes($_POST['taxValue4']);
$taxId=addslashes($_POST['taxId']);
$termsCondition=addslashes($_POST['termsCondition']);




if($_FILES["companyLogo"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}

if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}


if($editid!=''){

//-------EDIT-----------

echo $namevalue ='companyName="'.$companyName.'",contactPerson="'.$contactPerson.'",email="'.$email.'",phone="'.$phone.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",address="'.$address.'",userTimeZone="'.$userTimeZone.'",currency="'.$currency.'",invoiceBookingEmail="'.$invoiceBookingEmail.'",invoiceBookingPhone="'.$invoiceBookingPhone.'",taxName1="'.$taxName1.'",taxValue1="'.$taxValue1.'",taxName2="'.$taxName2.'",taxValue2="'.$taxValue2.'",taxName3="'.$taxName3.'",taxValue3="'.$taxValue3.'",taxName4="'.$taxName4.'",taxValue4="'.$taxValue4.'",taxId="'.$taxId.'",termsCondition="'.$termsCondition.'",companyLogo="'.$companyLogo.'"'; 



$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"'; 


  
updatelisting('sys_branchMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='branches',details='".$companyName." Branch Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='companyName="'.$companyName.'",contactPerson="'.$contactPerson.'",email="'.$email.'",phone="'.$phone.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",address="'.$address.'",userTimeZone="'.$userTimeZone.'",addDate="'.time().'",parentId="'.$_SESSION['userid'].'",userId="'.$_SESSION['userid'].'",currency="'.$currency.'",invoiceBookingEmail="'.$invoiceBookingEmail.'",invoiceBookingPhone="'.$invoiceBookingPhone.'",taxName1="'.$taxName1.'",taxValue1="'.$taxValue1.'",taxName2="'.$taxName2.'",taxValue2="'.$taxValue2.'",taxName3="'.$taxName3.'",taxValue3="'.$taxValue3.'",taxName4="'.$taxName4.'",taxValue4="'.$taxValue4.'",taxId="'.$taxId.'",termsCondition="'.$termsCondition.'",companyLogo="'.$companyLogo.'"';  
addlistinggetlastid('sys_branchMaster',$namevalue);   

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='branches',details='".$companyName." Branch Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}


 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=branches&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}









if($_POST['action']=='saverolepermission' && $_POST['name']!=""){

$name=addslashes($_POST['name']);
$description=addslashes($_POST['description']);
$profileClone=addslashes($_POST['profileClone']); 
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='name="'.$name.'",description="'.$description.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('rolePermissionProfile',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='rolepermission',details='".$name." Role and Permission Profile Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='name="'.$name.'",description="'.$description.'",addDate="'.time().'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('rolePermissionProfile',$namevalue);   


$rs3=GetPageRecord('*','permissionMaster','  parentId="'.$_SESSION['userid'].'" and profileId="'.$profileClone.'" order by id asc');
while($restsubsub=mysqli_fetch_array($rs3)){ 

$namevalue ='permissionView="'.$restsubsub['permissionView'].'",permissionAdd="'.$restsubsub['permissionAdd'].'",permissionEdit="'.$restsubsub['permissionEdit'].'",permissionDelete="'.$restsubsub['permissionDelete'].'",moduleId="'.$restsubsub['moduleId'].'",profileId="'.$lastid.'",parentId="'.$_SESSION['userid'].'"';  
addlistinggetlastid('permissionMaster',$namevalue);   

}



 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='branches',details='".$name." Role and Permission Profile Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=rolepermission&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}





if($_POST['action']=='addNewTransactionAll' && $_POST['agentId']!=''){
 
$agentId=trim(addslashes($_POST['agentId']));   
$amount=trim(addslashes($_POST['amount']));   
$paymentType=trim(addslashes($_POST['paymentType']));  
$paymentMethod=trim(addslashes($_POST['paymentMethod']));  
$transactionId=trim(addslashes($_POST['transactionId']));  
$remark=trim(addslashes($_POST['remark']));   

$creditFromDate=date('Y-m-d',strtotime($_POST['creditFromDate']));    
$credittoDate=date('Y-m-d',strtotime($_POST['credittoDate']));  


if($_FILES["companyLogo"]["tmp_name"]!=""){   
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']);   
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}
 
$agentId=decode($_POST['agentId']);


$namevalue ='agentId="'.$agentId.'",amount="'.$amount.'",paymentType="'.$paymentType.'",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",remarks="'.$remark.'",attachment="'.$companyLogo.'",creditFromDate="'.$creditFromDate.'",credittoDate="'.$credittoDate.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_balanceSheet',$namevalue); 

// add by sonam
// add credit in distributor
$namevalue1 ='to_agent_id="'.$agentId.'",from_agent_id="'.$_SESSION['userid'].'",amount="'.$amount.'",creditFromDate="'.$creditFromDate.'",credittoDate="'.$credittoDate.'",remarks="'.$remark.'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_transfer_balance',$namevalue1); 
//end credit in distributor
// end by sonam
 
?>
<script>
// parent.redirectpage('display.html?ga=topUpBalance&save=1');

parent.redirectpage('display.html?ga=topUpBalance&save=1');
</script>

<?php
exit();
}









if($_POST['action']=='savepermission' && $_POST['editid']!=""){

$editid=addslashes($_POST['editid']); 



foreach($_POST['moduleId'] as $index => $value) {
 

$rs5=GetPageRecord('*','permissionMaster',' parentId="'.$_SESSION['userid'].'" and profileId="'.decode($editid).'" and moduleId="'.$value.'" '); 
$editresult=mysqli_fetch_array($rs5);

if($editresult['id']!=''){

$namevalue ='permissionView="'.$_REQUEST['permissionView'.$value.''].'",permissionAdd="'.$_REQUEST['permissionAdd'.$value.''].'",permissionEdit="'.$_REQUEST['permissionEdit'.$value.''].'",permissionDelete="'.$_REQUEST['permissionDelete'.$value.''].'"'; 

$where=' parentId="'.$_SESSION['userid'].'" and profileId="'.decode($editid).'" and moduleId="'.$value.'" ';   
updatelisting('permissionMaster',$namevalue,$where); 

} else {

$namevalue ='permissionView="'.$_REQUEST['permissionView'.$value.''].'",permissionAdd="'.$_REQUEST['permissionAdd'.$value.''].'",permissionEdit="'.$_REQUEST['permissionEdit'.$value.''].'",permissionDelete="'.$_REQUEST['permissionDelete'.$value.''].'",moduleId="'.$value.'",parentId="'.$_SESSION['userid'].'",profileId="'.decode($editid).'"'; 

addlistinggetlastid('permissionMaster',$namevalue);   
}

}



$rs5=GetPageRecord('*','rolePermissionProfile',' parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" '); 
$editresult=mysqli_fetch_array($rs5);

 $sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='rolepermission',details='".$editresult['name']." User Permissions Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
 
 
 
?>
<script>
parent.redirectpage('display.html?ga=rolepermission&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}










if($_POST['action']=='savesystemuser' && $_POST['name']!="" && $_POST['email']!=""){

$name=addslashes($_POST['name']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']); 
$address=addslashes($_POST['address']); 
$branchId=addslashes($_POST['branchId']); 
$roleId=addslashes($_POST['roleId']); 
$status=addslashes($_POST['status']); 
$staffCreditLimit=addslashes($_POST['staffCreditLimit']); 
$logincredentials=addslashes($_POST['logincredentials']);  
$editid=addslashes($_POST['editid']);
$randPass = rand(999999,100000);

$permissionView='';
foreach($_POST['permissionView'] as $check) { 
		 $permissionView.=$check.',';
}

$permissionAdd='';
foreach($_POST['permissionAdd'] as $check) { 
		 $permissionAdd.=$check.',';
}

$permissionEdit='';
foreach($_POST['permissionEdit'] as $check) { 
		 $permissionEdit.=$check.',';
}

$sql='';
if($_FILES["profilePhoto"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['profilePhoto']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 
move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], "upload/{$companyLogo}"); 
$sql.=',profilePhoto="'.$companyLogo.'"';
}
 


if($editid!=''){

//-------EDIT-----------

if($_REQUEST['logincredentials']==1){
$namevalue ='name="'.$name.'",phone="'.$phone.'",address="'.$address.'",branchId="'.$branchId.'",roleId="'.$roleId.'",status="'.$status.'",staffCreditLimit="'.$staffCreditLimit.'",password="'.md5($randPass).'",permissionView="'.rtrim($permissionView,',').'",permissionAdd="'.rtrim($permissionAdd,',').'",permissionEdit="'.rtrim($permissionEdit,',').'" '.$sql.''; 
} else {  
$namevalue ='name="'.$name.'",phone="'.$phone.'",address="'.$address.'",branchId="'.$branchId.'",roleId="'.$roleId.'",status="'.$status.'",staffCreditLimit="'.$staffCreditLimit.'",permissionView="'.rtrim($permissionView,',').'",permissionAdd="'.rtrim($permissionAdd,',').'",permissionEdit="'.rtrim($permissionEdit,',').'" '.$sql.''; 
}

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_userMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." User Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" '); 
$dubcheck=mysqli_fetch_array($rs8);

if($dubcheck['id']!=''){
?>
<script>
alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!');
parent.$('#loadingwhite').hide();
</script>
<?php
exit(); }

 

$namevalue ='name="'.$name.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",branchId="'.$branchId.'",roleId="'.$roleId.'",status="'.$status.'",staffCreditLimit="'.$staffCreditLimit.'",password="'.md5($randPass).'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'",userType="admin_user" '.$sql.'';  
 
$lastid=addlistinggetlastid('sys_userMaster',$namevalue);   
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." User Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";    
}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 
if($_REQUEST['logincredentials']==1){ 

$subject = strip($LoginUserCompanyDetails['companyName']).' Assistance'; 

$mailbody='Dear '.$name.',<br /><br />

You have received this communication in response to the request for your '.strip($LoginUserCompanyDetails['companyName']).' System account password to be sent to you via e-mail.<br /><br />

Login URL: '.$fullurl.' <br /> 
Username: '.$email.'<br />
Temporary Password: '.$randPass.'<br /><br />

Please change your password as soon as possible, to ensure total privacy and confidentiality.<br /><br /> 

If you did not request for your password to be reset, please contact us at

'.$LoginUserCompanyDetails['phone'].' or email us at '.$LoginUserCompanyDetails['email'].'<br /><br />    

We hope to see you onboard again soon!';

$file_name='';
$ccmail='';
send_attachment_mail($_SESSION['parentid'],$email,$subject,$mailbody,$ccmail,$file_name);
}


 
?>
<script>
parent.redirectpage('display.html?ga=usermanagement&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}


if($_POST['action']=='addbannerb2c' && $_POST['bannerType']!="" && $_POST['bannerURL']!="" && $_POST['status']!=""){

$bannerType=addslashes($_POST['bannerType']);
$bannerTitle=addslashes($_POST['bannerTitle']);
$bannerURL=addslashes($_POST['bannerURL']);
$sequence=addslashes($_POST['sequence']);
$status=addslashes($_POST['status']); 
$oldphoto=addslashes($_POST['oldphoto']); 

if($_FILES["img"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['img']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["img"]["tmp_name"], "upload/{$companyLogo}"); 
}

if($companyLogo==''){ 
$companyLogo=$oldphoto; 
}

if($_REQUEST['id']!=''){


$namevalue ='bannerType="'.$bannerType.'",sequence="'.$sequence.'",bannerURL="'.$bannerURL.'",status="'.$status.'",bannerImage="'.$companyLogo.'",bannerTitle="'.$bannerTitle.'",addDate="'.date('Y-m-d H:i:s').'"';  
$where='id="'.decode($_REQUEST['id']).'" and agentId=0';
updatelisting('agentBannerMaster',$namevalue,$where); 

} else {

$namevalue ='bannerType="'.$bannerType.'",bannerURL="'.$bannerURL.'",sequence="'.$sequence.'",status="'.$status.'",bannerImage="'.$companyLogo.'",bannerTitle="'.$bannerTitle.'",agentId=0,addDate="'.date('Y-m-d H:i:s').'"'; 
addlistinggetlastid('agentBannerMaster',$namevalue); 

}
 
 
 

?>
<script>
parent.redirectpage('display.html?ga=bannermanagement&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}



if($_POST['action']=='addmarketingbanner' && $_POST['bannerTitle']!=""){

$bannerTitle=addslashes($_POST['bannerTitle']);
$category_id=addslashes($_POST['category_id']);
$sequence=addslashes($_POST['sequence']);
$status=addslashes($_POST['status']); 

$sql='';

if($_FILES["bannerImage"]["tmp_name"]!=""){  
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['bannerImage']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;
move_uploaded_file($_FILES["bannerImage"]["tmp_name"], "upload/{$companyLogo}"); 
$sql.=',bannerImage="'.$companyLogo.'"';
}

if($_REQUEST['editid']!=''){
$namevalue ='bannerTitle="'.$bannerTitle.'",category_id="'.$category_id.'",sequence="'.$sequence.'",status="'.$status.'",addDate="'.date('Y-m-d H:i:s').'" '.$sql.'';
$where='id="'.decode($_REQUEST['editid']).'"';
updatelisting('marketingBanner',$namevalue,$where); 
} else {
$namevalue ='bannerTitle="'.$bannerTitle.'",category_id="'.$category_id.'",sequence="'.$sequence.'",status="'.$status.'",addDate="'.date('Y-m-d H:i:s').'" '.$sql.''; 
addlistinggetlastid('marketingBanner',$namevalue); 
}
?>
<script>
parent.redirectpage('display.html?ga=marketingbanner&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>
<?php
exit();
}




if($_POST['action']=='addvisab2c' && $_POST['title']!="" && $_POST['url']!="" && $_POST['status']!=""){

$title=addslashes($_POST['title']);
$url=addslashes($_POST['url']);
$sequence=addslashes($_POST['sequence']);
$status=addslashes($_POST['status']); 

if($_REQUEST['id']!=''){

$namevalue ='title="'.$title.'",sequence="'.$sequence.'",url="'.$url.'",status="'.$status.'",addDate="'.date('Y-m-d H:i:s').'"';  
$where='id="'.decode($_REQUEST['id']).'" and agentId=0';
updatelisting('agentVisaMaster',$namevalue,$where); 

} else {

$namevalue ='title="'.$title.'",url="'.$url.'",sequence="'.$sequence.'",status="'.$status.'",agentId=0,addDate="'.date('Y-m-d H:i:s').'"'; 
addlistinggetlastid('agentVisaMaster',$namevalue); 

}
 
?>
<script>
parent.redirectpage('display.html?ga=visamanagement&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}



if($_POST['action']=='addwebcheck'){

$flightName=addslashes($_POST['flightName']); 
$url=addslashes($_POST['url']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

$sql='';

if($_FILES["logo"]["tmp_name"]!=""){  
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['logo']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;
move_uploaded_file($_FILES["logo"]["tmp_name"], "upload/{$companyLogo}"); 
$sql.=',logo="'.$companyLogo.'"';
}


if($editid!=''){
//-------EDIT-----------

$namevalue ='flightName="'.$flightName.'",url="'.$url.'",status="'.$status.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
$where='id="'.decode($editid).'"';   
updatelisting('sys_webCheckMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Web Check Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."' "; 

} else { 

//-------ADD----------- 

$namevalue ='flightName="'.$flightName.'",url="'.$url.'",status="'.$status.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"'; 
 
$lastid=addlistinggetlastid('sys_webCheckMaster',$namevalue);   
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Web Check Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";    
}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

 
?>
<script>
parent.redirectpage('display.html?ga=webcheck&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}

if($_POST['action']=='addspecialdeal'){

$title=addslashes($_POST['title']);
$dealtype=addslashes($_POST['dealtype']);
$url=addslashes($_POST['url']);
$description=addslashes($_POST['description']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

$sql='';
if($_FILES["image"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis"));
$companyLogoFileName=basename($_FILES['image']['name']);
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;
move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$companyLogo}"); 
$sql.=',image="'.$companyLogo.'"';
}


if($editid!=''){
//-------EDIT-----------

$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
$where='id="'.decode($editid).'"';   
updatelisting('sys_specialDeal',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." SPecial Deal Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."' "; 

} else { 

//-------ADD----------- 
$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
 
$lastid=addlistinggetlastid('sys_specialDeal',$namevalue);   
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Special Deal Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";    
}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 


?>
<script>
parent.redirectpage('display.html?ga=specialdeal&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}


if($_POST['action']=='addmarquee'){

$title=addslashes($_POST['title']); 
$messageType=addslashes($_POST['messageType']); 
$url=addslashes($_POST['url']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

if($editid!=''){
//-------EDIT-----------

$namevalue ='title="'.$title.'",url="'.$url.'",status="'.$status.'",messageType="'.$messageType.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"'; 
$where='id="'.decode($editid).'"';   
updatelisting('sys_Marquee',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Marquee Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 

//-------ADD----------- 

$namevalue ='title="'.$title.'",url="'.$url.'",status="'.$status.'",messageType="'.$messageType.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"'; 
 
$lastid=addlistinggetlastid('sys_Marquee',$namevalue);   
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Marquee Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";    
}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

 
?>
<script>
parent.redirectpage('display.html?ga=marquee&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}


if($_POST['action']=='topupUpdateStatus'){

$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

$namevalue ='status="'.$status.'"'; 
$where=' id="'.decode($editid).'" ';   
updatelisting('offlineRechargeRequest',$namevalue,$where); 


//fetch Data
$rs=GetPageRecord('*','offlineRechargeRequest',' id="'.decode($editid).'" ');
$rest=mysqli_fetch_array($rs);

if($status=='approve'){
//Insert data in balancesheet table
$namevalue1='agentId="'.$rest["agentId"].'",SubAgentId="0",amount="'.$rest["requestedAmount"].'",remarks="Approve offline topup request",paymentMethod="Offline",transactionId="'.encode($rest["id"]).'", paymentType="Credit",addedBy="'.$_SESSION['userid'].'",addDate="'.date("Y-m-d H:i:s").'",offlineAgent="1"';
addlistinggetlastid('sys_balanceSheet',$namevalue1); 


// $namevalue2 ='to_agent_id="'.$rest["agentId"].'",from_agent_id="'.$_SESSION['userid'].'",amount="'.$rest["requestedAmount"].'",creditFromDate="'.date("Y-m-d H:i:s").'",credittoDate="'.date("Y-m-d H:i:s").'",remarks="remarks="Approve offline topup request",addDate="'.date('Y-m-d H:i:s').'"';  
// addlistinggetlastid('sys_transfer_balance',$namevalue2); 

}

?>
<script>
parent.redirectpage('display.html?ga=topupoffline&save=1');
</script>

<?php
exit(); }



if($_POST['action']=='savequerystages'){
 
foreach($_POST['moduleId'] as $index => $value) {
  

$namevalue ='updatedName="'.$_REQUEST['updatedName'.$value.''].'"'; 
$where=' parentId="'.$_SESSION['userid'].'"  and id="'.$value.'" ';   
updatelisting('sys_queryStageMaster',$namevalue,$where); 
 

} 

 $sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='querystages',details='Query Stages Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
 
 
 
?>
<script>
parent.redirectpage('display.html?ga=querystagename&save=1');
</script>

<?php
exit(); }



if($_POST['action']=='savetaxes'){
	
	$count = count($_POST["id"]);
	
	for($i=0;$i<$count;$i++){
		
$namevalue ='applicableType="'.$_POST["applicableType"][$i].'",valuePerc="'.$_POST["valuePerc"][$i].'",applicableOn="'.$_POST["applicableOn"][$i].'"'; 
$where=' id="'.$_POST["id"][$i].'" ';   
updatelisting('taxMaster',$namevalue,$where); 
	}


$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='querystages',details='Taxes Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
 
 
 
?>
<script>
parent.redirectpage('display.html?ga=tax&save=1');
</script>

<?php
exit(); }



if($_POST['action']=='savetraveltype' && $_POST['name']!=""){

$name=addslashes($_POST['name']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='name="'.$name.'",status="'.$status.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_travelType',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='traveltype',details='".$name." Travel Type Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='name="'.$name.'",status="'.$status.'",addDate="'.time().'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_travelType',$namevalue);    

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='traveltype',details='".$name." Travel Type Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=traveltype&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}






if($_POST['action']=='savetravelsource' && $_POST['name']!=""){

$name=addslashes($_POST['name']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='name="'.$name.'",status="'.$status.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_travelSource',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='travelsource',details='".$name." Travel Source Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='name="'.$name.'",status="'.$status.'",addDate="'.time().'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_travelSource',$namevalue);    

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='travelsource',details='".$name." Travel Source Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=travelsource&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}








if($_POST['action']=='savequeryclosurereasons' && $_POST['name']!=""){

$name=addslashes($_POST['name']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='name="'.$name.'",status="'.$status.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_queryClosureReasons',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='queryclosurereasons',details='".$name." Query Closure Reasons Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='name="'.$name.'",status="'.$status.'",addDate="'.time().'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_queryClosureReasons',$namevalue);    

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='queryclosurereasons',details='".$name." Query Closure Reasons Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=queryclosurereasons&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}




if($_POST['action']=='savebookingtask' && $_POST['taskName']!="" && $_POST['taskDateAfter']!=""){

$taskName=addslashes($_POST['taskName']);
$taskDateAfter=addslashes($_POST['taskDateAfter']);
$assignTo=addslashes($_POST['assignTo']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='taskName="'.$taskName.'",status="'.$status.'",taskDateAfter="'.$taskDateAfter.'",assignTo="'.$assignTo.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_bookingSetting',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='bookingsetting',details='".$taskName." Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

}  
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=bookingmanagement&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}





if($_POST['action']=='savewebsitewidget' && $_POST['customWidth']>199 && $_POST['formTitle']!="" && $_POST['formSubtitle']!="" && $_POST['notificationEmail']!="" && $_POST['websiteName']!="" && $_POST['thankTitle']!="" && $_POST['thankSubtitle']!="" && $_POST['widgetBackgroud']!="" && $_POST['widgetTitleBackgroud']!="" && $_POST['buttonBackgroud']!="" && $_POST['widgetTitleBackgroudColor']!=""){

$customWidth=addslashes($_POST['customWidth']);
$formTitle=addslashes($_POST['formTitle']);
$formSubtitle=addslashes($_POST['formSubtitle']);
$notificationEmail=addslashes($_POST['notificationEmail']);
$websiteName=addslashes($_POST['websiteName']);
$thankTitle=addslashes($_POST['thankTitle']);
$thankSubtitle=addslashes($_POST['thankSubtitle']);
$widgetBackgroud=str_replace('#','',$_POST['widgetBackgroud']); 
$widgetTitleBackgroud=str_replace('#','',$_POST['widgetTitleBackgroud']); 
$buttonBackgroud=str_replace('#','',$_POST['buttonBackgroud']); 
$widgetTitleBackgroudColor=str_replace('#','',$_POST['widgetTitleBackgroudColor']);  

$customerName=addslashes($_POST['customerName']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']);
$address=addslashes($_POST['address']);
$travelLocation=addslashes($_POST['travelLocation']);
$country=addslashes($_POST['country']);
$traveldate=addslashes($_POST['traveldate']);  


$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='customWidth="'.$customWidth.'",formTitle="'.$formTitle.'",formSubtitle="'.$formSubtitle.'",notificationEmail="'.$notificationEmail.'",websiteName="'.$websiteName.'",thankTitle="'.$thankTitle.'",thankSubtitle="'.$thankSubtitle.'",widgetBackgroud="'.$widgetBackgroud.'",widgetTitleBackgroud="'.$widgetTitleBackgroud.'",buttonBackgroud="'.$buttonBackgroud.'",widgetTitleBackgroudColor="'.$widgetTitleBackgroudColor.'",customerName="'.$customerName.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",travelLocation="'.$travelLocation.'",country="'.$country.'",traveldate="'.$traveldate.'",status="'.$status.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_queryWidget',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='websitewidget',details='".$formTitle." Website Widget Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='customWidth="'.$customWidth.'",formTitle="'.$formTitle.'",formSubtitle="'.$formSubtitle.'",notificationEmail="'.$notificationEmail.'",websiteName="'.$websiteName.'",thankTitle="'.$thankTitle.'",thankSubtitle="'.$thankSubtitle.'",widgetBackgroud="'.$widgetBackgroud.'",widgetTitleBackgroud="'.$widgetTitleBackgroud.'",buttonBackgroud="'.$buttonBackgroud.'",widgetTitleBackgroudColor="'.$widgetTitleBackgroudColor.'",customerName="'.$customerName.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",travelLocation="'.$travelLocation.'",country="'.$country.'",traveldate="'.$traveldate.'",status="'.$status.'",addDate="'.time().'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_queryWidget',$namevalue);    

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='websitewidget',details='".$formTitle." Website Widget Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=websitewidget&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}











if($_POST['action']=='saveemailtemplate' && $_POST['editid']!="" && $_POST['pagename']!="" && $_POST['emailSubject']!="" && $_POST['replyEmail']!="" && $_POST['emailtype']!=""){

$emailSubject=addslashes($_POST['emailSubject']);
$replyEmail=addslashes($_POST['replyEmail']);
$emailContent=addslashes($_POST['emailContent']); 
$editid=addslashes($_POST['editid']);
  

if($editid!=''){

//-------EDIT-----------

$namevalue ='emailSubject="'.$emailSubject.'",replyEmail="'.$replyEmail.'",emailContent="'.$emailContent.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('emailTemplates',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='emailtemplate',details='".$emailtype." Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

}  
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=<?php echo $_POST['pagename']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');
</script>

<?php
exit();
}


 
if($_POST['action']=='savequery'  && $_POST['contactNumber']!="" && $_POST['contactEmail']!="" && $_POST['nameHead']!="" && $_POST['contactPerson']!="" && $_POST['contactCountry']!="" && $_POST['travelFromCity']!="" && $_POST['travelLocation']!="" && $_POST['startDate']!="" && $_POST['endDate']!=""){

$queryType=addslashes($_POST['queryType']);
$contactNumber=addslashes($_POST['contactNumber']);
$contactEmail=addslashes($_POST['contactEmail']);
$companyName=addslashes($_POST['companyName']);
$nameHead=addslashes($_POST['nameHead']);
$contactPerson=addslashes($_POST['contactPerson']);
$contactCountry=addslashes($_POST['contactCountry']);
$contactState=addslashes($_POST['contactState']);
$contactCity=addslashes($_POST['contactCity']);
$travelFromCity=$_POST['travelFromCity'];
$travelLocation=$_POST['travelLocation'];
$startDate=date('Y-m-d',strtotime($_POST['startDate']));
$endDate=date('Y-m-d',strtotime($_POST['endDate']));
$adult=addslashes($_POST['adult']);
$child=addslashes($_POST['child']);
$infant=addslashes($_POST['infant']);
$querySource=addslashes($_POST['querySource']);
$queryPriority=addslashes($_POST['queryPriority']);
$assignTo=addslashes($_POST['assignTo']);
$typePackage=addslashes($_POST['typePackage']);
$typeFlight=addslashes($_POST['typeFlight']);
$typeTransfer=addslashes($_POST['typeTransfer']);
$typeHotel=addslashes($_POST['typeHotel']);
$typeSightseeing=addslashes($_POST['typeSightseeing']);
$typeMiscellaneous=addslashes($_POST['typeMiscellaneous']);
 
$editid=addslashes($_POST['editid']);
$clientId=decode($_POST['clientId']);
$queryStage=decode($_POST['queryStage']);
 
 
$rs7=GetPageRecord('*','clientMaster',' parentId="'.$_SESSION['userid'].'" and (phone="'.trim($contactNumber).'" or email="'.trim($contactEmail).'") order by id desc limit 0,1 '); 
$checkclient=mysqli_fetch_array($rs7);


$clientId=$checkclient['id'];

if($checkclient['id']!=''){

$namevalue ='companyName="'.$companyName.'",nameHead="'.$nameHead.'",name="'.$contactPerson.'",phone="'.$contactNumber.'",email="'.$contactEmail.'",clientCountry="'.$contactCountry.'",clientState="'.$contactState.'",clientCity="'.$contactCity.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.$clientId.'"';   
updatelisting('clientMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='client',sectionId='".$checkclient['id']."',details='".$contactPerson." Client Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

$namevalue ='clientType="'.$queryType.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",name="'.$contactPerson.'",phone="'.$contactNumber.'",email="'.$contactEmail.'",clientCountry="'.$contactCountry.'",clientState="'.$contactState.'",clientCity="'.$contactCity.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['userid'].'"'; 
 
$clientId=addlistinggetlastid('clientMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='client',sectionId='".$clientId."',details='".$contactPerson." Client Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}

 

if($editid!=''){

//-------EDIT-----------

$namevalue ='contactNumber="'.$contactNumber.'",contactEmail="'.$contactEmail.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",contactPerson="'.$contactPerson.'",contactCountry="'.$contactCountry.'",contactState="'.$contactState.'",contactCity="'.$contactCity.'",travelFromCity="'.$travelFromCity.'",travelLocation="'.$travelLocation.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",querySource="'.$querySource.'",queryPriority="'.$queryPriority.'",assignTo="'.$assignTo.'",typePackage="'.$typePackage.'",typeFlight="'.$typeFlight.'",typeTransfer="'.$typeTransfer.'",typeHotel="'.$typeHotel.'",typeSightseeing="'.$typeSightseeing.'",typeMiscellaneous="'.$typeMiscellaneous.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('queryMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='#".$editid." Query Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='queryType="'.$queryType.'",contactNumber="'.$contactNumber.'",clientId="'.$clientId.'",contactEmail="'.$contactEmail.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",contactPerson="'.$contactPerson.'",contactCountry="'.$contactCountry.'",contactState="'.$contactState.'",contactCity="'.$contactCity.'",travelFromCity="'.$travelFromCity.'",travelLocation="'.$travelLocation.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",querySource="'.$querySource.'",queryPriority="'.$queryPriority.'",assignTo="'.$assignTo.'",typePackage="'.$typePackage.'",typeFlight="'.$typeFlight.'",typeTransfer="'.$typeTransfer.'",typeHotel="'.$typeHotel.'",typeSightseeing="'.$typeSightseeing.'",typeMiscellaneous="'.$typeMiscellaneous.'",status="'.$queryStage.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['userid'].'"'; 

$lastid=addlistinggetlastid('queryMaster',$namevalue);   

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#".encode($lastid)." Query Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";








//------------Send Mail To User--------------------

$a=GetPageRecord('*','emailTemplates',' parentId="'.$_SESSION['userid'].'"  and emailTemplateType="Assigned Query"'); 
$resTemplate=mysqli_fetch_array($a);

$subject=queryreplacetags($lastid,stripslashes($resTemplate['emailSubject']));
$description=queryreplacetags($lastid,stripslashes($resTemplate['emailContent']));
 
$ccmail=''; 
$attachment='';

$rs7=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$assignTo.'"'); 
$res=mysqli_fetch_array($rs7);

send_attachment_mail($frommail,$res['email'],$subject,$description,$ccmail,$attachment);

//------------Send Mail To User--------------------





//------------Send Mail To Client--------------------

$a=GetPageRecord('*','emailTemplates',' parentId="'.$_SESSION['userid'].'"  and emailTemplateType="New Lead"'); 
$resTemplate=mysqli_fetch_array($a);

$subject=queryreplacetags($lastid,stripslashes($resTemplate['emailSubject']));
$description=queryreplacetags($lastid,stripslashes($resTemplate['emailContent']));
 
$ccmail=''; 
$attachment=''; 

send_attachment_mail($frommail,trim($contactEmail),$subject,$description,$ccmail,$attachment);

//------------Send Mail To Client--------------------

}


 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=query&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}


if($_POST['action']=='queryBulkAssign'  && $_POST['datalist']!="" && $_POST['bulkassign']!="" ){

$rs7=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['bulkassign']).'"'); 
$res=mysqli_fetch_array($rs7);

foreach($_POST['datalist'] as $index => $value) {


$namevalue ='assignTo="'.$res['id'].'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($value).'"';   
updatelisting('queryMaster',$namevalue,$where); 
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($value)."',details='#".$value." Query Assigned To ".$res['name']."',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

$queryId=decode($value);
}


//------------Send Mail--------------------

$a=GetPageRecord('*','emailTemplates',' parentId="'.$_SESSION['userid'].'"  and emailTemplateType="Assigned Query"'); 
$resTemplate=mysqli_fetch_array($a);

$subject=queryreplacetags($queryId,stripslashes($resTemplate['emailSubject']));
$description=queryreplacetags($queryId,stripslashes($resTemplate['emailContent']));
 
$ccmail=''; 
$attachment='';

send_attachment_mail($frommail,$res['email'],$subject,$description,$ccmail,$attachment);

//------------Send Mail--------------------

?>
<script>
parent.redirectpage('display.html?ga=query&save=1');
</script>

<?php
exit();
}










if($_POST['action']=='savechangequerystatus' && $_POST['editid']!="" && $_POST['status']!="" && $_POST['statusname']!=""){

$comment=addslashes($_POST['comment']);
$status=addslashes($_POST['status']); 
$editid=addslashes($_POST['editid']); 
$closureReasons=addslashes($_POST['closureReasons']); 
  
if($closureReasons!=''){
$closureReasons=$closureReasons;





//------------Send Mail--------------------


$rs7=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" '); 
$res=mysqli_fetch_array($rs7);

$a=GetPageRecord('*','emailTemplates',' parentId="'.$_SESSION['userid'].'"  and emailTemplateType="Lead Closer"'); 
$resTemplate=mysqli_fetch_array($a);

$subject=queryreplacetags(decode($editid),stripslashes($resTemplate['emailSubject']));
$description=queryreplacetags(decode($editid),stripslashes($resTemplate['emailContent']));
 
$ccmail=''; 
$attachment='';

send_attachment_mail($frommail,$res['contactEmail'],$subject,$description,$ccmail,$attachment);

//------------Send Mail--------------------



} else {
$closureReasons=0;
}

if($editid!=''){

//-------EDIT-----------

$namevalue ='status="'.decode($status).'",editDate="'.date('Y-m-d H:i:s').'",editBy="'.$_SESSION['userid'].'",closureReasons="'.$closureReasons.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('queryMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='Query Status Changed To ".$_POST['statusname']."',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',comment='".$_POST['comment']."',addDate='".time()."'";   

}  
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['editid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');
</script>

<?php
exit();
}





if($_POST['action']=='savequerynote' && $_POST['editid']!="" && $_POST['comment']!=""){

$comment=addslashes($_POST['comment']); 
$editid=addslashes($_POST['editid']); 


  

if($editid!=''){

//-------EDIT-----------



$namevalue ='comment="'.$comment.'",queryId="'.decode($editid).'",parentId="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'"';   
$lastid=addlistinggetlastid('queryNote',$namevalue);  

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='Query Note Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


$namevalue ='editDate="'.date('Y-m-d H:i:s').'",editBy="'.$_SESSION['userid'].'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('queryMaster',$namevalue,$where); 
}  
 

 

?>
<script>
parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['editid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');
</script>

<?php
exit();
}






if($_REQUEST['action']=='addquotation' && $_REQUEST['quotationtype']!="" && $_REQUEST['queryid']!=""){

$queryid=addslashes($_REQUEST['queryid']); 
$quotationtype=addslashes($_REQUEST['quotationtype']); 
$editid=addslashes($_POST['editid']); 


$rs7=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($queryid).'" '); 
$res=mysqli_fetch_array($rs7);
  

if($editid!=''){ 
} else {


//-------------ADD-----------------

$namevalue ='queryId="'.decode($queryid).'",travelFromCity="'.$res['travelFromCity'].'",travelLocation="'.$res['travelLocation'].'",startDate="'.$res['startDate'].'",endDate="'.$res['endDate'].'",adult="'.$res['adult'].'",child="'.$res['child'].'",infant="'.$res['infant'].'",quotationType="'.$quotationtype.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['userid'].'"'; 

$lastid=addlistinggetlastid('quotationMaster',$namevalue);  



if($_REQUEST['quotationtype']=='Quick Package' || $_REQUEST['quotationtype']=='Detailed Package'){

$ha=GetPageRecord('*','packageTermsConditions','  parentId="'.$_SESSION['userid'].'" order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 

$namevalue ='termType="'.$listdata['termType'].'",termDescription="'.addslashes($listdata['termDescription']).'",quotationId="'.$lastid.'",parentId="'.$_SESSION['userid'].'"';  
addlistinggetlastid('quotationTerms',$namevalue); 

}




$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$_SESSION['userid'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 
$branchData=mysqli_fetch_array($ab);

$namevalue ='queryId="'.decode($queryid).'",quotationId="'.$lastid.'",parentId="'.$_SESSION['userid'].'",CGST="'.$branchData['taxName1'].'",SGST="'.$branchData['taxName2'].'",IGST="'.$branchData['taxName3'].'",TCS="'.$branchData['taxName4'].'",currencyId="'.$branchData['currency'].'"';  
addlistinggetlastid('sys_quickPackageOptions',$namevalue);  

}







 




$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#QT".encode($lastid)." Quotation Added in #".$queryid."',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
}
  

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo encode($lastid); ?>&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='savequickpackageoptionpeice' && $_POST['editid']!="" && $_POST['quotationid']!=""){

$perAdult=addslashes($_POST['perAdult']); 
$perChild=addslashes($_POST['perChild']);
$quotationAdultMarkup=addslashes($_POST['quotationAdultMarkup']); 
$quotationChildMarkup=addslashes($_POST['quotationChildMarkup']); 
$currencyId=addslashes($_POST['currencyId']); 
$editid=addslashes($_POST['editid']); 

if($editid!=''){

//-------EDIT-----------
$namevalue ='currencyId="'.$currencyId.'",perAdult="'.$perAdult.'",perChild="'.$perChild.'",quotationAdultMarkup="'.$quotationAdultMarkup.'",quotationChildMarkup="'.$quotationChildMarkup.'",currencyId="'.$currencyId.'"';  


$where='id="'.decode($editid).'"';   
updatelisting('sys_quickPackageOptions',$namevalue,$where); 
 

}  
 

 

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $_POST['quotationid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');
</script>

<?php
exit();
}









 
if($_POST['action']=='saveEventHotel'  && $_POST['quotationid']!="" && $_POST['optionid']!="" && $_POST['travelFromCity']!="" && $_POST['pickupCitySearchfromCity123']!="" && $_POST['name']!="" && $_POST['roomCategory']!="" && $_POST['mealPlan']!="" && $_POST['roomType']!=""){

$quotationid=addslashes($_POST['quotationid']);
$optionid=addslashes($_POST['optionid']);
$travelFromCity=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$roomCategory=trim(addslashes($_POST['roomCategory']));
$mealPlan=trim(addslashes($_POST['mealPlan']));
$category=trim(addslashes($_POST['hotelCategory']));
$roomType=trim(addslashes($_POST['roomType']));
$editid=trim(addslashes($_POST['editid']));
$eventPhoto=trim(addslashes($_POST['eventPhoto']));
 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate']));
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate']));

$checkInTime=$_POST['checkInTime'];
$checkOutTime=$_POST['checkOutTime']; 
$eventDetails=addslashes($_POST['eventDetails']); 
$roomCategory=trim(addslashes($_POST['roomCategory'])); 


 
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",eventDetails="'.$eventDetails.'",eventPhoto="'.$eventPhoto.'"'; 

$where='parentId="'.$_SESSION['userid'].'" and optionId="'.decode($_REQUEST['optionid']).'" and quotationId="'.decode($_REQUEST['quotationid']).'" and id="'.decode($_REQUEST['editid']).'"';
updatelisting('quotationEvents',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Hotel Updated In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

$namevalue ='quotationId="'.decode($quotationid).'",cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",eventDetails="'.$eventDetails.'",eventType="hotel",parentId="'.$_SESSION['userid'].'",optionId="'.decode($_REQUEST['optionid']).'",eventPhoto="'.$_REQUEST['eventPhoto'].'"';  
 
addlistinggetlastid('quotationEvents',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Hotel Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



$rs7=GetPageRecord('*','hotelMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityId="'.$travelFromCity.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



//------------Add Hotel-----------

if($hotelhave['id']==''){ 

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkIOutTime.'",hotelDetails="'.$eventDetails.'",hotelType="Hotel",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
 
addlistinggetlastid('hotelMaster',$namevalue); 
 
}

//------------Add Hotel-----------

}


 

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $quotationid; ?>&save=1');
</script>

<?php
exit();
}








 
if($_POST['action']=='saveupdatehotelimageoption'  && $_POST['eventId']!=""){

$eventId=addslashes($_POST['eventId']);

if($_FILES["eventPhoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventPhotoFileName=basename($_FILES['eventPhoto']['name']); 

$eventPhotoFileExtension=pathinfo($eventPhotoFileName, PATHINFO_EXTENSION);  
$eventPhoto=time().$rt.'.'.$eventPhotoFileExtension; 

move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], "upload/{$eventPhoto}"); 
}


 
if($eventId!=''){
 
$namevalue ='eventPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($eventId).'"';
updatelisting('quotationEvents',$namevalue,$where); 


$namevalue ='hotelPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and cityId="'.$_REQUEST['cityId2'].'" and name="'.$_REQUEST['hotelname'].'"'; 
updatelisting('hotelMaster',$namevalue,$where); 
}  
  

 

?>
<script>
parent.loadloadoptionhotel<?php echo $_REQUEST['optionid']; ?>();
</script>

<?php
exit();
}


 
if($_POST['action']=='saveupdatehotelimagepackage'  && $_POST['eventId']!=""){

$eventId=addslashes($_POST['eventId']);

if($_FILES["eventPhoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventPhotoFileName=basename($_FILES['eventPhoto']['name']); 

$eventPhotoFileExtension=pathinfo($eventPhotoFileName, PATHINFO_EXTENSION);  
$eventPhoto=time().$rt.'.'.$eventPhotoFileExtension; 

move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], "upload/{$eventPhoto}"); 
}


 
if($eventId!=''){
 
$namevalue ='eventPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($eventId).'"';
updatelisting('quotationEvents',$namevalue,$where); 


$namevalue ='hotelPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and cityId="'.$_REQUEST['cityId2'].'" and name="'.$_REQUEST['hotelname'].'"'; 
updatelisting('hotelMaster',$namevalue,$where); 
}  
  

 

?>
<script>
parent.selectthisday('<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['daydate']; ?>');
</script>

<?php
exit();
}


if($_REQUEST['action']=='adnewoptioninquickquotation' && $_REQUEST['quotationid']!="" && $_REQUEST['queryid']!=""){
 
$quotationid=addslashes($_REQUEST['quotationid']);  
$queryid=addslashes($_REQUEST['queryid']);  

 

//-------------ADD----------------- 


$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$_SESSION['userid'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 
$branchData=mysqli_fetch_array($ab);

$namevalue ='queryId="'.decode($queryid).'",quotationId="'.decode($quotationid).'",parentId="'.$_SESSION['userid'].'",CGST="'.$branchData['taxName1'].'",SGST="'.$branchData['taxName2'].'",IGST="'.$branchData['taxName3'].'",TCS="'.$branchData['taxName4'].'",currencyId="'.$branchData['currency'].'"';  
addlistinggetlastid('sys_quickPackageOptions',$namevalue);   
 
?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $quotationid; ?>&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='saveEventSightseeing'  && $_POST['travelFromCity']>0 && $_POST['checkInDate']!='' && $_POST['name']!=''){

$sightseeingcityfield=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$sightseeingcheckInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$eventDuration=addslashes($_POST['eventDuration']);
$sightseeingeventDetails=addslashes($_POST['eventDetails']);
$dayId=addslashes($_POST['dayId']);
$checkInTime=addslashes($_POST['checkInTime']);
$editid=addslashes($_POST['editid']);
 

  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$finalAdultCost=($adultCost*$queryData['adult']);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;
  


$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  


  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------
  
  

 

 
  
if($editid!=''){

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",eventPhoto="'.$_REQUEST['eventPhoto'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",eventType="Sightseeing",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Sightseeing Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}
   
   

$rs7=GetPageRecord('*','sightseeingMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityId="'.$sightseeingcityfield.'"'); 
$sightseeinghave=mysqli_fetch_array($rs7);
   
if($sightseeinghave['id']!=''){ 

$namevalue ='sectionDetails="'.$sightseeingeventDetails.'",sectionDuration="'.$eventDuration.'"';   
$where='parentId="'.$_SESSION['userid'].'" and id="'.$sightseeinghave['id'].'" ';
updatelisting('sightseeingMaster',$namevalue,$where);
 
} else {

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",sectionDuration="'.$eventDuration.'",sectionDetails="'.$sightseeingeventDetails.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sightseeingMaster',$namevalue); 

}





?>
<script> 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" ); 

<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $sightseeingcheckInDate; ?>');
<?php } else { ?>
parent.loadquotationsightseeing();
<?php } ?>
</script>

<?php
exit();
}












 
if($_POST['action']=='saveupdatesightseeingimage'  && $_POST['eventId']!=""){

$eventId=addslashes($_POST['eventId']);

if($_FILES["eventPhoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventPhotoFileName=basename($_FILES['eventPhoto']['name']); 

$eventPhotoFileExtension=pathinfo($eventPhotoFileName, PATHINFO_EXTENSION);  
$eventPhoto=time().$rt.'.'.$eventPhotoFileExtension; 

move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], "upload/{$eventPhoto}"); 
}


 
if($eventId!=''){
 
$namevalue ='eventPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($eventId).'"';
updatelisting('quotationEvents',$namevalue,$where); 


$namevalue ='sectionPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and cityId="'.$_REQUEST['cityId2'].'" and name="'.$_REQUEST['evenetname'].'"'; 
updatelisting('sightseeingMaster',$namevalue,$where); 
}  
  

 

?>
<script>
parent.loadquotationsightseeing<?php echo $_REQUEST['optionid']; ?>();
</script>

<?php
exit();
}





if($_POST['action']=='saveEventTransport'  && $_POST['travelFromCity']>0  && $_POST['pickupCitytoCity']>0 && $_POST['checkInDate']!='' && $_POST['checkOutDate']!=''){

$travelFromCity=addslashes($_POST['travelFromCity']);
$pickupCitytoCity=trim(addslashes($_POST['pickupCitytoCity']));
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate']));
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$eventDetails=addslashes($_POST['eventDetails']);
$transportType=addslashes($_POST['transportType']);
$trainClass=addslashes($_POST['trainClass']);
$checkInTime=addslashes($_POST['checkInTime']);
$checkOutTime=addslashes($_POST['checkOutTime']);
$vehicleId=addslashes($_POST['vehicleId']);
$dayId=addslashes($_POST['dayId']);
$editid=addslashes($_POST['editid']);







  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 
$noOfVehicle=addslashes($_POST['noOfVehicle']); 
$perVehiclePrice=addslashes($_POST['perVehiclePrice']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);

if($_REQUEST['transportType']=='Private Cab'){
$finalAdultCost=($perVehiclePrice*$noOfVehicle);
$adultCost=addslashes($perVehiclePrice); 

} else { 

$finalAdultCost=($adultCost*$queryData['adult']);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 
} 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost; 

$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  






  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------
  
  
 
 
  
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",toCityId="'.$pickupCitytoCity.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",eventDetails="'.$eventDetails.'",transportType="'.$transportType.'",trainClass="'.$trainClass.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",noOfVehicle="'.$noOfVehicle.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='cityId="'.$travelFromCity.'",toCityId="'.$pickupCitytoCity.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",eventDetails="'.$eventDetails.'",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",trainClass="'.$trainClass.'",transportType="'.$transportType.'",eventType="Transport",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",noOfVehicle="'.$noOfVehicle.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Transport Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
} 


?>


<script> 

parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );
<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $checkInDate; ?>');
<?php } else { ?>

parent.loadquotationtransport();
 
<?php } ?>
</script>

<?php
exit();
}








if($_POST['action']=='saveEventFlight'  && $_POST['travelFromCity']>0  && $_POST['pickupCitytoCity']>0 && $_POST['checkInDate']!=''&& $_POST['name']!=''){

$dayId=addslashes($_POST['dayId']);
$travelFromCity=addslashes($_POST['travelFromCity']);
$pickupCitytoCity=trim(addslashes($_POST['pickupCitytoCity']));
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate']));
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$eventDetails=addslashes($_POST['eventDetails']);
$flightTripType=addslashes($_POST['flightTripType']);
$viaFlightDeparture=addslashes($_POST['viaFlightDeparture']);
$fromDepartureFlightTime=addslashes($_POST['fromDepartureFlightTime']);
$toDepartureFlightTime=addslashes($_POST['toDepartureFlightTime']);
$departureFlightHour=addslashes($_POST['departureFlightHour']);

$viaFlightReturn=addslashes($_POST['viaFlightReturn']);
$fromReturnFlightTime=addslashes($_POST['fromReturnFlightTime']);
$toReturnFlightTime=addslashes($_POST['toReturnFlightTime']);
$returnFlightHour=addslashes($_POST['returnFlightHour']);
$trainClass=addslashes($_POST['trainClass']);
$eventPhoto=addslashes($_POST['eventPhoto']);
$name=addslashes($_POST['name']);
$editid=addslashes($_POST['editid']);
 
  
  
  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$finalAdultCost=($adultCost*$queryData['adult']);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 
$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);


$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  
 
  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------
  
  
  
  
  
  
  
  
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",toCityId="'.$pickupCitytoCity.'",name="'.$name.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",eventDetails="'.$eventDetails.'",flightTripType="'.$flightTripType.'",viaFlightDeparture="'.$viaFlightDeparture.'",fromDepartureFlightTime="'.$fromDepartureFlightTime.'",checkInTime="'.$fromDepartureFlightTime.'",toDepartureFlightTime="'.$toDepartureFlightTime.'",departureFlightHour="'.$departureFlightHour.'",viaFlightReturn="'.$viaFlightReturn.'",fromReturnFlightTime="'.$fromReturnFlightTime.'",toReturnFlightTime="'.$toReturnFlightTime.'",returnFlightHour="'.$returnFlightHour.'",trainClass="'.$trainClass.'",eventPhoto="'.$eventPhoto.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'"';  



$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",toCityId="'.$pickupCitytoCity.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",eventDetails="'.$eventDetails.'",flightTripType="'.$flightTripType.'",viaFlightDeparture="'.$viaFlightDeparture.'",fromDepartureFlightTime="'.$fromDepartureFlightTime.'",checkInTime="'.$fromDepartureFlightTime.'",toDepartureFlightTime="'.$toDepartureFlightTime.'",departureFlightHour="'.$departureFlightHour.'",viaFlightReturn="'.$viaFlightReturn.'",fromReturnFlightTime="'.$fromReturnFlightTime.'",toReturnFlightTime="'.$toReturnFlightTime.'",returnFlightHour="'.$returnFlightHour.'",eventType="Flight",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",trainClass="'.$trainClass.'",eventPhoto="'.$eventPhoto.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Flight Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
} 



$rs7=GetPageRecord('*','flightMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$flighthave=mysqli_fetch_array($rs7);
   
if($flighthave['id']==''){   

$namevalue ='name="'.$name.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('flightMaster',$namevalue); 

}


?>
<script> 
 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );
<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $checkInDate; ?>');
<?php } else { ?>

parent.loadquotationflight();
 
<?php } ?>

</script>

<?php
exit();
}






if($_POST['action']=='saveupdateflightimage'  && $_POST['eventId']!=""){

$eventId=addslashes($_POST['eventId']);

if($_FILES["eventPhoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventPhotoFileName=basename($_FILES['eventPhoto']['name']); 

$eventPhotoFileExtension=pathinfo($eventPhotoFileName, PATHINFO_EXTENSION);  
$eventPhoto=time().$rt.'.'.$eventPhotoFileExtension; 

move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], "upload/{$eventPhoto}"); 
}


 
if($eventId!=''){
 
$namevalue ='eventPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($eventId).'"';
updatelisting('quotationEvents',$namevalue,$where); 


$namevalue ='sectionPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'"  and name="'.$_REQUEST['evenetname'].'"'; 
updatelisting('flightMaster',$namevalue,$where); 
}  
   

?>
<script>
parent.loadquotationflight();
</script>

<?php
exit();
}










if($_POST['action']=='saveEventVisa'  && $_POST['country']>0  && $_POST['visaCategory']!="" && $_POST['checkInDate']!='' && $_POST['adult']>0 && $_POST['visaValidity']>0){

$country=addslashes($_POST['country']);
$visaCategory=trim(addslashes($_POST['visaCategory']));
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$adult=addslashes($_POST['adult']);
$child=addslashes($_POST['child']);
$infant=addslashes($_POST['infant']);
$entryType=addslashes($_POST['entryType']); 
$visaValidity=addslashes($_POST['visaValidity']); 
$nationality=addslashes($_POST['nationality']); 
$eventDetails=addslashes($_POST['eventDetails']);
$dayId=addslashes($_POST['dayId']);
$name=addslashes($_POST['name']);
$editid=addslashes($_POST['editid']);






  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$finalAdultCost=($adultCost*$queryData['adult']);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;




$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  



  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------





 
  
if($editid!=''){

$namevalue ='name="'.$name.'",eventDetails="'.$eventDetails.'",nationality="'.$nationality.'",visaValidity="'.$visaValidity.'",checkInDate="'.$checkInDate.'",entryType="'.$entryType.'",infant="'.$infant.'",child="'.$child.'",adult="'.$adult.'",visaCategory="'.$visaCategory.'",country="'.$country.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
 
} else { 

$namevalue ='name="'.$name.'",eventDetails="'.$eventDetails.'",nationality="'.$nationality.'",visaValidity="'.$visaValidity.'",checkInDate="'.$checkInDate.'",entryType="'.$entryType.'",infant="'.$infant.'",child="'.$child.'",adult="'.$adult.'",visaCategory="'.$visaCategory.'",country="'.$country.'",eventType="Visa",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",trainClass="'.$trainClass.'",eventPhoto="'.$eventPhoto.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Visa Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
} 

 


?>
<script>  
 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );
<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $checkInDate; ?>');
<?php } else { ?>

parent.loadquotationvisa();
 
<?php } ?>
</script>

<?php
exit();
}



if($_REQUEST['action']=='movetoArchive'  && $_REQUEST['id']!='' && $_REQUEST['qid']!=''){

 
$editid=addslashes($_REQUEST['id']);
$qid=addslashes($_REQUEST['qid']);
 
  
if($editid!=''){

$namevalue ='archiveStatus=1';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and queryId="'.decode($qid).'"';
updatelisting('quotationMaster',$namevalue,$where);
  
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($editid)."',details='#QT".$editid." Mark As Archive',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}  
 
 
?>
<script> 
parent.redirectpage('display.html?ga=query&add=1&id=<?php echo $qid; ?>&save=1&view=1');
</script>

<?php
exit();
}


if($_REQUEST['action']=='movetoUnarchive'  && $_REQUEST['id']!='' && $_REQUEST['qid']!=''){

 
$editid=addslashes($_REQUEST['id']);
$qid=addslashes($_REQUEST['qid']);
 
  
if($editid!=''){

$namevalue ='archiveStatus=0';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and queryId="'.decode($qid).'"';
updatelisting('quotationMaster',$namevalue,$where);
  
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($editid)."',details='#QT".$editid." Mark As Unarchive',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}  
 
 
?>
<script> 
parent.redirectpage('display.html?ga=query&add=1&id=<?php echo $qid; ?>&save=1&view=1');
</script>

<?php
exit();
}







if($_POST['action']=='savequickpackageotitle' && $_POST['name']!=""){

$name=addslashes($_POST['name']); 
$packageItinerary=addslashes($_POST['packageItinerary']); 
$editid=addslashes($_POST['editid']); 
$oldpackagebanner=addslashes($_POST['bannerImg']); 


if($_FILES["packagebanner"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$packagebannerFileName=basename($_FILES['packagebanner']['name']); 

$packagebannerFileExtension=pathinfo($packagebannerFileName, PATHINFO_EXTENSION);  
$packagebanner=time().$rt.'.'.$packagebannerFileExtension; 

move_uploaded_file($_FILES["packagebanner"]["tmp_name"], "upload/{$packagebanner}"); 
}

if($packagebanner==''){ 
$packagebanner=$oldpackagebanner; 
}


$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'"'; 
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('quotationMaster',$namevalue,$where);  

 

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $editid; ?>&save=1');
</script>

<?php
exit();
}




 





if($_POST['action']=='saveEventMiscellaneous'  && $_POST['name']!=""){

$name=addslashes($_POST['name']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate']));  
$eventDetails=addslashes($_POST['eventDetails']); 
$editid=addslashes($_POST['editid']);

$dayId=addslashes($_POST['dayId']);
$checkInTime=addslashes($_POST['checkInTime']);





  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$finalAdultCost=($adultCost*$queryData['adult']);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;
 

$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  

  
  
  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------

 


  
if($editid!=''){

$namevalue ='name="'.$name.'",eventDetails="'.$eventDetails.'",checkInDate="'.$checkInDate.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'",checkInTime="'.$checkInTime.'"';   
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='name="'.$name.'",eventDetails="'.$eventDetails.'",checkInDate="'.$checkInDate.'",eventType="Miscellaneous",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'",checkInTime="'.$checkInTime.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Miscellaneous Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
} 

 


?>
<script>  
 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );
<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $checkInDate; ?>');
<?php } else { ?>

parent.loadquotationmiscellaneous();
 
<?php } ?>
</script>

<?php
exit();
}








if($_POST['action']=='savetermspackagemaster' && $_POST['termType']!="" && $_POST['editid']!=""){

$termType=addslashes($_POST['termType']); 
$editid=addslashes($_POST['editid']); 
$termDescription=addslashes($_POST['termDescription']); 
$termDescription = preg_replace('/font-family.+?;/', "", $termDescription);
$termDescription = str_replace('font-family:',"", $termDescription);

$namevalue ='termType="'.$termType.'",termDescription="'.$termDescription.'"'; 
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('packageTermsConditions',$namevalue,$where);  

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='Package Terms',sectionId='0',details='Package ".$termType." Master Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

?>
<script>
parent.redirectpage('display.html?ga=packagetermsconditions&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveEventTermDescription' && $_POST['termType']!="" && $_POST['termType']!="" && $_POST['quotationid']!=""){

$termType=addslashes($_POST['termType']); 
$editid=addslashes($_POST['editid']); 
$termDescription=addslashes($_POST['termDescription']); 
$termDescription = preg_replace('/font-family.+?;/', "", $termDescription);
$termDescription = str_replace('font-family:',"", $termDescription);

$namevalue ='termType="'.$termType.'",termDescription="'.$termDescription.'"'; 
$where=' id="'.decode($editid).'"';   
updatelisting('quotationTerms',$namevalue,$where);  

 

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $_REQUEST['quotationid']; ?>&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveSendQuotation'  && $_POST['editid']!="" && $_POST['queryId']!=""  && $_POST['emailbody']!=""   && $_POST['subject']!="" && $_POST['clientEmail']!="" ){


$editid=decode($_POST['editid']); 
$queryId=decode($_POST['queryId']); 
$emailbody=addslashes($_POST['emailbody']); 
$subject=addslashes($_POST['subject']); 
$clientEmail=addslashes($_POST['clientEmail']); 
$CCEmail=addslashes($_POST['CCEmail']); 

 
 
 
$namevalue ='queryId="'.$queryId.'",quotationId="'.$editid.'",subject="'.$subject.'",mailBody="'.$emailbody.'",email="'.$clientEmail.'",ccEmail="'.$CCEmail.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_REQUEST['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('communicationMailMaster',$namevalue); 




$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$queryId."',details='Quotation #QT".encode($editid)." Sent To Client (".$clientEmail.")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


$namevalue ='status=2'; 
$where='parentId="'.$_SESSION['userid'].'" and id="'.$editid.'"';   
updatelisting('quotationMaster',$namevalue,$where); 



$rs7=GetPageRecord('*','sys_queryStageMaster',' parentId="'.$_SESSION['userid'].'" and name ="Proposal Sent" order by id asc '); 
$queryStageres=mysqli_fetch_array($rs7);


$namevalue ='status="'.$queryStageres['id'].'"'; 
$where='parentId="'.$_SESSION['userid'].'" and id="'.$queryId.'"';   
updatelisting('queryMaster',$namevalue,$where); 

 
//------------Send Mail--------------------

$subject=stripslashes($_POST['subject']);
$description=stripslashes($_POST['emailbody']);
 
$ccmail=$CCEmail; 
$attachment='';
$fromEmail='';

send_attachment_mail($fromEmail,$clientEmail,$subject,$description,$ccmail,$attachment);

//------------Send Mail--------------------

?>
<script>
parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&mailsent=1');
</script>

<?php
exit();
}








if($_POST['action']=='saveotherquotation' && $_POST['name']!=""){

$name=addslashes($_POST['name']); 
$packageItinerary=addslashes($_POST['packageItinerary']); 
$editid=addslashes($_POST['editid']); 
$oldpackagebanner=addslashes($_POST['bannerImg']); 


if($_FILES["packagebanner"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$packagebannerFileName=basename($_FILES['packagebanner']['name']); 

$packagebannerFileExtension=pathinfo($packagebannerFileName, PATHINFO_EXTENSION);  
$packagebanner=time().$rt.'.'.$packagebannerFileExtension; 

move_uploaded_file($_FILES["packagebanner"]["tmp_name"], "upload/{$packagebanner}"); 
}

if($packagebanner==''){ 
$packagebanner=$oldpackagebanner; 
}


$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'"'; 
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('quotationMaster',$namevalue,$where);  

 

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $editid; ?>&save=1');
</script>

<?php
exit();
}




 
if($_POST['action']=='saveEventHotelOpen'  && $_POST['quotationid']!="" && $_POST['travelFromCity']!=""  && $_POST['name']!="" && $_POST['mealPlan']!="" && $_POST['roomType']!=""){

$quotationid=addslashes($_POST['quotationid']);
$optionid=0;
$travelFromCity=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$roomCategory=trim(addslashes($_POST['roomCategory']));
$mealPlan=trim(addslashes($_POST['mealPlan']));
$category=trim(addslashes($_POST['hotelCategory']));
$roomType=trim(addslashes($_POST['roomType']));
$editid=trim(addslashes($_POST['editid']));
$eventPhoto=trim(addslashes($_POST['eventPhoto']));
 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate']));
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate']));

$checkInTime=$_POST['checkInTime'];
$checkOutTime=$_POST['checkOutTime']; 
$eventDetails=addslashes($_POST['eventDetails']); 
$roomCategory=trim(addslashes($_POST['roomCategory'])); 


 
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 

$singleRoom=addslashes($_POST['singleRoom']); 
$doubleRoom=addslashes($_POST['doubleRoom']); 
$tripleRoom=addslashes($_POST['tripleRoom']); 
$extraAdultRoom=addslashes($_POST['extraAdultRoom']); 
$childWithBedRoom=addslashes($_POST['childWithBedRoom']); 

$singleRoomCost=addslashes($_POST['singleRoomCost']); 
$doubleRoomCost=addslashes($_POST['doubleRoomCost']); 
$tripleRoomCost=addslashes($_POST['tripleRoomCost']); 
$extraAdultRoomCost=addslashes($_POST['extraAdultRoomCost']); 
$childWithBedRoomCost=addslashes($_POST['childWithBedRoomCost']); 
$dayId=addslashes($_POST['dayId']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$totalsingleRoomCost=($singleRoomCost*$singleRoom); 
$totaldoubleRoomCost=($doubleRoomCost*$doubleRoom); 
$totaltripleRoomCost=($tripleRoomCost*$tripleRoom); 
$totalextraAdultRoomCost=($extraAdultRoomCost*$extraAdultRoom); 
$totalchildWithBedRoomCost=($childWithBedRoomCost*$childWithBedRoom); 




 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$totalsingleRoomCost+$totaldoubleRoomCost+$totaltripleRoomCost+$totalextraAdultRoomCost+$totalchildWithBedRoomCost;
   
 
$totalnights=dateDifference($checkInDate,$checkOutDate);

$quotationCost=($quotationCost*$totalnights);

$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  


  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------


  
 
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",eventDetails="'.$eventDetails.'",eventPhoto="'.$eventPhoto.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",extraAdultRoom="'.$extraAdultRoom.'",childWithBedRoom="'.$childWithBedRoom.'",singleRoomCost="'.$singleRoomCost.'",doubleRoomCost="'.$doubleRoomCost.'",tripleRoomCost="'.$tripleRoomCost.'",extraAdultRoomCost="'.$extraAdultRoomCost.'",childWithBedRoomCost="'.$childWithBedRoomCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'"'; 

$where='parentId="'.$_SESSION['userid'].'"   and quotationId="'.decode($_REQUEST['quotationid']).'" and id="'.decode($_REQUEST['editid']).'"';
updatelisting('quotationEvents',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Hotel Updated In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

$namevalue ='quotationId="'.decode($quotationid).'",cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",eventDetails="'.$eventDetails.'",eventType="hotel",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",extraAdultRoom="'.$extraAdultRoom.'",childWithBedRoom="'.$childWithBedRoom.'",singleRoomCost="'.$singleRoomCost.'",doubleRoomCost="'.$doubleRoomCost.'",tripleRoomCost="'.$tripleRoomCost.'",extraAdultRoomCost="'.$extraAdultRoomCost.'",childWithBedRoomCost="'.$childWithBedRoomCost.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'"';  
 
addlistinggetlastid('quotationEvents',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Hotel Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



$rs7=GetPageRecord('*','hotelMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityId="'.$travelFromCity.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



//------------Add Hotel-----------

if($hotelhave['id']==''){ 

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkIOutTime.'",hotelDetails="'.$eventDetails.'",hotelType="Hotel",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
 
addlistinggetlastid('hotelMaster',$namevalue); 
 
}

//------------Add Hotel-----------

}


 

?>
<script>
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );


<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $checkInDate; ?>');
<?php } else { ?>
parent.loadloadoptionhotel();
<?php } ?>
</script>

<?php
exit();
}




if($_POST['action']=='savedetailpackageotitle' && $_POST['name']!=""){

$startDate=date('Y-m-d',strtotime($_POST['startDate'])); 
$endDate=date('Y-m-d',strtotime($_POST['endDate'])); 
/*
$adult=addslashes($_POST['adult']); 
$child=addslashes($_POST['child']);
$infant=addslashes($_POST['infant']);  
*/
$showOnWebsite=addslashes($_POST['showOnWebsite']);  
$packageTheme=addslashes($_POST['packageTheme']);  

$name=addslashes($_POST['name']); 
$packageItinerary=addslashes($_POST['packageItinerary']); 
$editid=addslashes($_POST['editid']); 
$oldpackagebanner=addslashes($_POST['bannerImg']); 
$nights=round($_POST['nights']); 

if($_FILES["packagebanner"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$packagebannerFileName=basename($_FILES['packagebanner']['name']); 

$packagebannerFileExtension=pathinfo($packagebannerFileName, PATHINFO_EXTENSION);  
$packagebanner=time().$rt.'.'.$packagebannerFileExtension; 

move_uploaded_file($_FILES["packagebanner"]["tmp_name"], "upload/{$packagebanner}"); 
}

if($packagebanner==''){ 
$packagebanner=$oldpackagebanner; 
}


//$destination = implode(',',$_POST['pickupCityfromCity']);
$destination = $_POST['cityName'];

$weekendGatewayLocationId=addslashes($_POST['weekendGatewayLocationId']);
$flighticon = $_POST['flighticon'];
$hotelicon = $_POST['hotelicon'];
$sightseeingicon = $_POST['sightseeingicon'];
$transfericon = $_POST['transfericon'];
$activityicon = $_POST['activityicon'];
$cruiseicon = $_POST['cruiseicon'];



$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" '); 
$editresult=mysqli_fetch_array($rs5);

if($editresult['queryId']==0){
$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'",packageTheme="'.$packageTheme.'",destination="'.$destination.'",showOnWebsite="'.$showOnWebsite.'",nights="'.$nights.'",flighticon="'.$flighticon.'",hotelicon="'.$hotelicon.'",sightseeingicon="'.$sightseeingicon.'",transfericon="'.$transfericon.'",activityicon="'.$activityicon.'",cruiseicon="'.$cruiseicon.'",weekendGatewayLocationId="'.$weekendGatewayLocationId.'"'; 
}else{
$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'",startDate="'.$startDate.'",endDate="'.$endDate.'",packageTheme="'.$packageTheme.'",nights="'.$nights.'",destination="'.$destination.'",showOnWebsite="'.$showOnWebsite.'",flighticon="'.$flighticon.'",hotelicon="'.$hotelicon.'",sightseeingicon="'.$sightseeingicon.'",transfericon="'.$transfericon.'",activityicon="'.$activityicon.'",cruiseicon="'.$cruiseicon.'",weekendGatewayLocationId="'.$weekendGatewayLocationId.'"'; 
}
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('quotationMaster',$namevalue,$where);  

 

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo $editid; ?>&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='savedaydetails' && $_POST['title']!="" && $_POST['description']!='' && $_POST['quotationid']!=''){

 
$title=addslashes($_POST['title']); 
$description=addslashes($_POST['description']); 
$editid=addslashes($_POST['editid']);  

$namevalue ='title="'.$title.'",description="'.$description.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 
$where='  id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';   
updatelisting('packageDays',$namevalue,$where);  

 

?>
<script>
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );
parent.selectthisday('<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['daydate']; ?>');

</script>

<?php
exit();
}








 
if($_POST['action']=='saveupdatesightseeingimagepackage'  && $_POST['eventId']!=""){

$eventId=addslashes($_POST['eventId']);

if($_FILES["eventPhoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventPhotoFileName=basename($_FILES['eventPhoto']['name']); 

$eventPhotoFileExtension=pathinfo($eventPhotoFileName, PATHINFO_EXTENSION);  
$eventPhoto=time().$rt.'.'.$eventPhotoFileExtension; 

move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], "upload/{$eventPhoto}"); 
}


 
if($eventId!=''){
 
$namevalue ='eventPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($eventId).'"';
updatelisting('quotationEvents',$namevalue,$where); 


$namevalue ='sectionPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and cityId="'.$_REQUEST['cityId2'].'" and name="'.$_REQUEST['evenetname'].'"'; 
updatelisting('sightseeingMaster',$namevalue,$where); 
}  
  

 

?>
<script>
parent.selectthisday('<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['daydate']; ?>');
</script>

<?php
exit();
}




if($_POST['action']=='saveupdateflightimagepackage'  && $_POST['eventId']!=""){

$eventId=addslashes($_POST['eventId']);

if($_FILES["eventPhoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventPhotoFileName=basename($_FILES['eventPhoto']['name']); 

$eventPhotoFileExtension=pathinfo($eventPhotoFileName, PATHINFO_EXTENSION);  
$eventPhoto=time().$rt.'.'.$eventPhotoFileExtension; 

move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], "upload/{$eventPhoto}"); 
}


 
if($eventId!=''){
 
$namevalue ='eventPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($eventId).'"';
updatelisting('quotationEvents',$namevalue,$where); 


$namevalue ='sectionPhoto="'.$eventPhoto.'"';  
$where='parentId="'.$_SESSION['userid'].'"  and name="'.$_REQUEST['evenetname'].'"'; 
updatelisting('flightMaster',$namevalue,$where); 
}  
   

?>
<script>
parent.selectthisday('<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['daydate']; ?>');
</script>

<?php
exit();
}



//===================================Masters=========================================



if($_POST['action']=='saveHotelLibrary' && $_POST['cityName']!="" && $_POST['name']!=""){ 

$cityName=addslashes($_POST['pickupCitySearchfromCity123']);
$name=trim(addslashes($_POST['name']));  
$category=trim(addslashes($_POST['hotelCategory'])); 
$address=trim(addslashes($_POST['address'])); 
$editid=trim(addslashes($_POST['editid']));
$eventPhotoold=trim(addslashes($_POST['eventPhotoold'])); 
$eventPhotoold2=trim(addslashes($_POST['eventPhotoold2'])); 
$eventPhotoold3=trim(addslashes($_POST['eventPhotoold3'])); 
$eventPhotoold4=trim(addslashes($_POST['eventPhotoold4'])); 
$eventPhotoold5=trim(addslashes($_POST['eventPhotoold5'])); 
$hotelType=trim(addslashes($_POST['hotelType'])); 
$status=trim(addslashes($_POST['status'])); 
$checkInTime=$_POST['checkInTime'];
$checkOutTime=$_POST['checkOutTime']; 
$cancellationType=$_POST['cancellationType']; 
$lat=$_POST['lat']; 
$lon=$_POST['lon']; 
$eventDetails=addslashes($_POST['eventDetails']);  

$hotelAmenities='';
foreach($_POST['hotelAmenities'] as $val){

$hotelAmenities.=$val.',';

}



if($_FILES["eventphoto"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto']['name']); 
$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto=time().$rt.'.'.$eventphotoFileExtension; 
move_uploaded_file($_FILES["eventphoto"]["tmp_name"], "upload/{$eventphoto}"); 
}

if($eventphoto==''){ 
$eventphoto=$eventPhotoold; 
}




if($_FILES["eventphoto2"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto2']['name']); 
$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto2=time().$rt.'.'.$eventphotoFileExtension; 
move_uploaded_file($_FILES["eventphoto2"]["tmp_name"], "upload/{$eventphoto2}"); 
}

if($eventphoto2==''){ 
$eventphoto2=$eventPhotoold2; 
}





if($_FILES["eventphoto3"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto3']['name']); 
$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto3=time().$rt.'.'.$eventphotoFileExtension; 
move_uploaded_file($_FILES["eventphoto3"]["tmp_name"], "upload/{$eventphoto3}"); 
}

if($eventphoto3==''){ 
$eventphoto3=$eventPhotoold3; 
}



if($_FILES["eventphoto4"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto4']['name']); 
$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto4=time().$rt.'.'.$eventphotoFileExtension; 
move_uploaded_file($_FILES["eventphoto4"]["tmp_name"], "upload/{$eventphoto4}"); 
}

if($eventphoto4==''){ 
$eventphoto4=$eventPhotoold4; 
}

if($_FILES["eventphoto5"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto5']['name']); 
$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto5=time().$rt.'.'.$eventphotoFileExtension; 
move_uploaded_file($_FILES["eventphoto5"]["tmp_name"], "upload/{$eventphoto5}"); 
}

if($eventphoto5==''){ 
$eventphoto5=$eventPhotoold5; 
}


if($editid!=''){
$namevalue ='cityName="'.$cityName.'",name="'.$name.'",category="'.$category.'",hotelAmenities="'.$hotelAmenities.'",lat="'.$lat.'",lon="'.$lon.'",cancellationType="'.$cancellationType.'",status="'.$status.'",address="'.$address.'",hotelPhoto="'.$eventphoto.'",hotelPhoto2="'.$eventphoto2.'",hotelPhoto3="'.$eventphoto3.'",hotelPhoto4="'.$eventphoto4.'",hotelPhoto5="'.$eventphoto5.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",hotelDetails="'.$eventDetails.'",hotelType="'.$hotelType.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';
$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('hotelMaster',$namevalue,$where);
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Hotel Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
}else{
$rs7=GetPageRecord('*','hotelMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityName="'.$cityName.'"');  
$hotelhave=mysqli_fetch_array($rs7);

if($hotelhave['id']!=''){
?>
<script>
alert('This hotel already exists.');
</script>
<?php
exit();
}

$namevalue ='cityName="'.$cityName.'",name="'.$name.'",category="'.$category.'",hotelAmenities="'.$hotelAmenities.'",lat="'.$lat.'",lon="'.$lon.'",address="'.$address.'",cancellationType="'.$cancellationType.'",hotelPhoto="'.$eventphoto.'",hotelPhoto2="'.$eventphoto2.'",hotelPhoto3="'.$eventphoto3.'",hotelPhoto4="'.$eventphoto4.'",hotelPhoto5="'.$eventphoto5.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",hotelDetails="'.$eventDetails.'",hotelType="'.$hotelType.'",parentId="'.$_SESSION['userid'].'",status="'.$status.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('hotelMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Hotel Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}
?>
<script>
parent.redirectpage('display.html?ga=hotellibrary&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveHotelLibraryRoomTypeCost' && $_POST['roomType']!="" && $_POST['hotelId']!="" && $_POST['adultCost']>0){ 

$roomType=addslashes($_POST['roomType']); 
$inclusion=addslashes($_POST['inclusion']); 
$cancellationPolicy=addslashes($_POST['cancellationPolicy']); 
$supplier=addslashes($_POST['supplier']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$adultCost=trim(addslashes($_POST['adultCost'])); 
$childCost=trim(addslashes($_POST['childCost'])); 
$infantCost=trim(addslashes($_POST['infantCost'])); 
$currencyId=trim(addslashes($_POST['currencyId']));  
$hotelId=decode($_POST['hotelId']);  
$editid=trim(addslashes($_POST['editid']));

 
 

 
if($editid!=''){

$namevalue ='hotelId="'.$hotelId.'",roomType="'.$roomType.'",inclusion="'.$inclusion.'",cancellationPolicy="'.$cancellationPolicy.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",currencyId="2755",validFrom="'.$checkInDate.'",validTo="'.$checkOutDate.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  hotelId="'.$hotelId.'"';
updatelisting('sys_HotelRoomTypeCost',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='hotel',sectionId='".$hotelId."',details='Hotel Rate Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='hotelId="'.$hotelId.'",roomType="'.$roomType.'",inclusion="'.$inclusion.'",cancellationPolicy="'.$cancellationPolicy.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",currencyId="2755",validFrom="'.$checkInDate.'",parentId="'.$_SESSION['userid'].'",validTo="'.$checkOutDate.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  


addlistinggetlastid('sys_HotelRoomTypeCost',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='hotel',sectionId='".$hotelId."',details='Hotel Rate Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#adultCost').val('0');
parent.$('#childCost').val('0');
parent.$('#infantCost').val('0');
parent.$('#editid').val('');
parent.redirectpage('display.html?ga=hotellibrary&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='saveHotelLibraryMealPlanCost' && $_POST['roomType']!="" && $_POST['hotelId']!="" && $_POST['adultCost']>0){ 

$roomType=addslashes($_POST['roomType']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$adultCost=trim(addslashes($_POST['adultCost'])); 
$childCost=trim(addslashes($_POST['childCost'])); 
$infantCost=trim(addslashes($_POST['infantCost'])); 
$currencyId=trim(addslashes($_POST['currencyId']));  
$supplier=trim(addslashes($_POST['supplier'])); 
$hotelId=decode($_POST['hotelId']);  
$editid=trim(addslashes($_POST['editid']));

 
 

 
if($editid!=''){

$namevalue ='hotelId="'.$hotelId.'",mealPlanId="'.$roomType.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",supplier="'.$supplier.'",infantCost="'.$infantCost.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",validTo="'.$checkOutDate.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  hotelId="'.$hotelId.'"';
updatelisting('sys_HotelMealPlanCost',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='hotel',sectionId='".$hotelId."',details='Hotel Meal Plan Rate Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='hotelId="'.$hotelId.'",mealPlanId="'.$roomType.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",supplier="'.$supplier.'",infantCost="'.$infantCost.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",parentId="'.$_SESSION['userid'].'",validTo="'.$checkOutDate.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_HotelMealPlanCost',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='hotel',sectionId='".$hotelId."',details='Hotel Meal Plan Rate Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#adultCost').val('0');
parent.$('#childCost').val('0');
parent.$('#infantCost').val('0');
parent.$('#editid').val('');
parent.loadmealplancost();
</script>

<?php
exit();
}




if($_POST['action']=='saveHotelLibraryExtraCost' && $_POST['roomType']!="" && $_POST['hotelId']!="" && $_POST['adultCost']>0){ 

$roomType=addslashes($_POST['roomType']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$adultCost=trim(addslashes($_POST['adultCost'])); 
$childCost=trim(addslashes($_POST['childCost'])); 
$infantCost=trim(addslashes($_POST['infantCost'])); 
$currencyId=trim(addslashes($_POST['currencyId']));  
$supplier=trim(addslashes($_POST['supplier']));  
$hotelId=decode($_POST['hotelId']);  
$editid=trim(addslashes($_POST['editid']));

 
 

 
if($editid!=''){

$namevalue ='hotelId="'.$hotelId.'",extraId="'.$roomType.'",adultCost="'.$adultCost.'",supplier="'.$supplier.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",validTo="'.$checkOutDate.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  hotelId="'.$hotelId.'"';
updatelisting('sys_HotelExtraCost',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='hotel',sectionId='".$hotelId."',details='Hotel Extra Rate Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='hotelId="'.$hotelId.'",extraId="'.$roomType.'",adultCost="'.$adultCost.'",supplier="'.$supplier.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",parentId="'.$_SESSION['userid'].'",validTo="'.$checkOutDate.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_HotelExtraCost',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='hotel',sectionId='".$hotelId."',details='Hotel Extra Rate Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#adultCost').val('0');
parent.$('#childCost').val('0');
parent.$('#infantCost').val('0');
parent.$('#editid').val('');
parent.loadextracost();
</script>

<?php
exit();
}




if($_POST['action']=='saveDestinationLibrary' && $_POST['name']!="" && $_POST['destination']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$status=trim(addslashes($_POST['status'])); 
$destination=trim(addslashes($_POST['destination']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",destination="'.$destination.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_destinationMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Destination Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  

$rs7=GetPageRecord('*','sys_destinationMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This destination already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",destination="'.$destination.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_destinationMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Destination Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=destinations&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveHotelCategoryLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_hotelCategory',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Hotel Category Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  

$rs7=GetPageRecord('*','sys_hotelCategory',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This destination already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_hotelCategory',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Hotel Category Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=hotelcategory&save=1');
</script>

<?php
exit();
}


if($_POST['action']=='saveRoomTypeLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_roomTypeMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Room Type Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  

$rs7=GetPageRecord('*','sys_roomTypeMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This destination already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_roomTypeMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Room Type Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=roomtype&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveMealPlanLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_mealPlanMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Meal Plan Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  

$rs7=GetPageRecord('*','sys_mealPlanMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This destination already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_mealPlanMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Meal Plan Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=mealplan&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveExtraLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_extraMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Extra Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  

$rs7=GetPageRecord('*','sys_extraMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This destination already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_extraMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Extra Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=extra&save=1');
</script>

<?php
exit();
}






if($_POST['action']=='saveVehicleLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$pax=trim(addslashes($_POST['pax']));   
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",pax="'.$pax.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_vehicleMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Vehicle Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  

$rs7=GetPageRecord('*','sys_vehicleMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This destination already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",pax="'.$pax.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_vehicleMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Vehicle Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=vehicle&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='adddestination' && $_FILES["eventphoto"]["tmp_name"]!=''){ 

$editid=$_REQUEST['editid'];
  
  
if($_FILES["eventphoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto']['name']); 

$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto=time().$rt.'.'.$eventphotoFileExtension; 

move_uploaded_file($_FILES["eventphoto"]["tmp_name"], "upload/{$eventphoto}"); 
}

  
 
if($editid!=''){

$namevalue ='thumbImage="'.$eventphoto.'"'; 

$where=' id="'.decode($_REQUEST['editid']).'"';
updatelisting('cityMaster',$namevalue,$where); 

 

}  


?>
<script>
parent.redirectpage('display.html?keyword=&ga=destinations&save=1');
</script>

<?php
exit();
}













if($_POST['action']=='saveActivityLibrary' && $_POST['name']!=""){ 

$travelFromCity=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid']));
$eventPhotoold=trim(addslashes($_POST['eventPhotoold'])); 
$status=trim(addslashes($_POST['status'])); 
$sectionDuration=trim(addslashes($_POST['sectionDuration'])); 
 
$eventDetails=addslashes($_POST['eventDetails']);  




if($_FILES["eventphoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto']['name']); 

$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto=time().$rt.'.'.$eventphotoFileExtension; 

move_uploaded_file($_FILES["eventphoto"]["tmp_name"], "upload/{$eventphoto}"); 
}

if($eventphoto==''){ 
$eventphoto=$eventPhotoold; 
}






 
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",status="'.$status.'",sectionPhoto="'.$eventphoto.'",sectionDetails="'.$eventDetails.'",sectionDuration="'.$sectionDuration.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('activityMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Activity Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','activityMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityId="'.$travelFromCity.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This activity already exists.');
</script>
<?php
exit();
}




$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",sectionDuration="'.$sectionDuration.'",sectionPhoto="'.$eventphoto.'",sectionDetails="'.$eventDetails.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('activityMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Activity Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=activitylibrary&save=1');
</script>

<?php
exit();
}



if($_POST['action']=='saveActivityCost' && $_POST['hotelId']!="" && $_POST['adultCost']>0){ 

$roomType=addslashes($_POST['roomType']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$adultCost=trim(addslashes($_POST['adultCost'])); 
$childCost=trim(addslashes($_POST['childCost'])); 
$infantCost=trim(addslashes($_POST['infantCost'])); 
$currencyId=trim(addslashes($_POST['currencyId']));  
$hotelId=decode($_POST['hotelId']);  
$editid=trim(addslashes($_POST['editid']));

$supplier=trim(addslashes($_POST['supplier']));  
 
 

 
if($editid!=''){

$namevalue ='activityId="'.$hotelId.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",supplier="'.$supplier.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",validTo="'.$checkOutDate.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  activityId="'.$hotelId.'"';
updatelisting('sys_ActivityCost',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='activity',sectionId='".$hotelId."',details='Activity Rate Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='activityId="'.$hotelId.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",supplier="'.$supplier.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",parentId="'.$_SESSION['userid'].'",validTo="'.$checkOutDate.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_ActivityCost',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='activity',sectionId='".$hotelId."',details='Activity Rate Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#adultCost').val('0');
parent.$('#childCost').val('0');
parent.$('#infantCost').val('0');
parent.$('#editid').val('');
parent.loadactivitycost();
</script>

<?php
exit();
}




if($_POST['action']=='saveSightseeingLibrary' && $_POST['name']!=""){ 

$travelFromCity=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid']));
$eventPhotoold=trim(addslashes($_POST['eventPhotoold'])); 
$status=trim(addslashes($_POST['status'])); 
 
$eventDetails=addslashes($_POST['eventDetails']);  




if($_FILES["eventphoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto']['name']); 

$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto=time().$rt.'.'.$eventphotoFileExtension; 

move_uploaded_file($_FILES["eventphoto"]["tmp_name"], "upload/{$eventphoto}"); 
}

if($eventphoto==''){ 
$eventphoto=$eventPhotoold; 
}






 
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",status="'.$status.'",sectionPhoto="'.$eventphoto.'",sectionDetails="'.$eventDetails.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sightseeingMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Sightseeing Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','sightseeingMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityId="'.$travelFromCity.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This sightseeing already exists.');
</script>
<?php
exit();
}




$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",sectionPhoto="'.$eventphoto.'",sectionDetails="'.$eventDetails.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sightseeingMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Sightseeing Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=sightseeinglibrary&save=1');
</script>

<?php
exit();
}


if($_POST['action']=='saveSightseeingLibraryVehicleCost' && $_POST['roomType']!="" && $_POST['hotelId']!="" && $_POST['adultCost']>0){ 

$roomType=addslashes($_POST['roomType']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$adultCost=trim(addslashes($_POST['adultCost'])); 
$childCost=trim(addslashes($_POST['childCost'])); 
$infantCost=trim(addslashes($_POST['infantCost'])); 
$currencyId=trim(addslashes($_POST['currencyId']));  
$supplier=trim(addslashes($_POST['supplier']));  
$hotelId=decode($_POST['hotelId']);  
$editid=trim(addslashes($_POST['editid']));

 
 

 
if($editid!=''){

$namevalue ='sightseeingId="'.$hotelId.'",vehicleId="'.$roomType.'",supplier="'.$supplier.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",validTo="'.$checkOutDate.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  sightseeingId="'.$hotelId.'"';
updatelisting('sys_vehicleCost',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='sightseeing',sectionId='".$hotelId."',details='Hotel Vehicle Rate Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='sightseeingId="'.$hotelId.'",vehicleId="'.$roomType.'",supplier="'.$supplier.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",parentId="'.$_SESSION['userid'].'",validTo="'.$checkOutDate.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_vehicleCost',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='sightseeing',sectionId='".$hotelId."',details='Hotel Vehicle Rate Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#adultCost').val('0');
parent.$('#childCost').val('0');
parent.$('#infantCost').val('0');
parent.$('#editid').val('');
parent.loadvehiclecost();
</script>

<?php
exit();
}
 

if($_POST['action']=='saveCruseLibrary' && $_POST['name']!=""){ 

$travelFromCity=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid']));
$eventPhotoold=trim(addslashes($_POST['eventPhotoold'])); 
$status=trim(addslashes($_POST['status'])); 
 
$eventDetails=addslashes($_POST['eventDetails']);  




if($_FILES["eventphoto"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$eventphotoFileName=basename($_FILES['eventphoto']['name']); 

$eventphotoFileExtension=pathinfo($eventphotoFileName, PATHINFO_EXTENSION);  
$eventphoto=time().$rt.'.'.$eventphotoFileExtension; 

move_uploaded_file($_FILES["eventphoto"]["tmp_name"], "upload/{$eventphoto}"); 
}

if($eventphoto==''){ 
$eventphoto=$eventPhotoold; 
}






 
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",status="'.$status.'",sectionPhoto="'.$eventphoto.'",sectionDetails="'.$eventDetails.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('cruseMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Cruse Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','cruseMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and cityId="'.$travelFromCity.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This sightseeing already exists.');
</script>
<?php
exit();
}




$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",sectionPhoto="'.$eventphoto.'",sectionDetails="'.$eventDetails.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('cruseMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Cruse Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 
 

}


 

?>
<script>
parent.redirectpage('display.html?ga=cruselibrary&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='saveCruseCost' && $_POST['hotelId']!="" && $_POST['adultCost']>0){ 

$seatId=addslashes($_POST['seatId']); 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate'])); 
$supplier=trim(addslashes($_POST['supplier']));  
$adultCost=trim(addslashes($_POST['adultCost'])); 
$childCost=trim(addslashes($_POST['childCost'])); 
$infantCost=trim(addslashes($_POST['infantCost'])); 
$currencyId=trim(addslashes($_POST['currencyId']));  
$hotelId=decode($_POST['hotelId']);  
$editid=trim(addslashes($_POST['editid']));

 
 

 
if($editid!=''){

$namevalue ='cruseId="'.$hotelId.'",adultCost="'.$adultCost.'",seatId="'.$seatId.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",supplier="'.$supplier.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",validTo="'.$checkOutDate.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  cruseId="'.$hotelId.'"';
updatelisting('sys_CruseCost',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='cruse',sectionId='".$hotelId."',details='Cruse Rate Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='cruseId="'.$hotelId.'",adultCost="'.$adultCost.'",seatId="'.$seatId.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",supplier="'.$supplier.'",currencyId="'.$currencyId.'",validFrom="'.$checkInDate.'",parentId="'.$_SESSION['userid'].'",validTo="'.$checkOutDate.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_CruseCost',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='cruse',sectionId='".$hotelId."',details='Cruse Rate Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#adultCost').val('0');
parent.$('#childCost').val('0');
parent.$('#infantCost').val('0');
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}









if($_POST['action']=='savesupplier' && $_POST['name']!="" && $_POST['companyName']!="" && $_POST['email']!=""){

$companyName=addslashes($_POST['companyName']);
$name=addslashes($_POST['name']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']); 
$country=addslashes($_POST['country']); 
$state=addslashes($_POST['state']); 
$city=addslashes($_POST['city']); 
$countryCode=addslashes($_POST['countryCode']); 
$description=addslashes($_POST['description']); 


 
$address=addslashes($_POST['address']); 
$branchId=addslashes($_POST['branchId']); 
$roleId=addslashes($_POST['roleId']); 
$status=addslashes($_POST['status']); 
$logincredentials=addslashes($_POST['logincredentials']);  
$editid=addslashes($_POST['editid']);
$randPass = rand(999999,100000);

if($_POST['status']!=''){ 
$status=$_POST['status'];
} else {
$status=0;
}
 


if($editid!=''){

//-------EDIT-----------

if($_REQUEST['logincredentials']==1){
$namevalue ='name="'.$name.'",phone="'.$phone.'",address="'.$address.'",status="'.$status.'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",password="'.md5($randPass).'",countryCode="'.$countryCode.'",description="'.$description.'"'; 
} else {  
$namevalue ='name="'.$name.'",phone="'.$phone.'",address="'.$address.'",status="'.$status.'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",countryCode="'.$countryCode.'",description="'.$description.'"'; 
}

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('sys_userMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='supplier',details='".$name." Supplier Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" '); 
$dubcheck=mysqli_fetch_array($rs8);

if($dubcheck['id']!=''){
?>
<script>
alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!');
parent.$('#loadingwhite').hide();
</script>
<?php
exit(); }

 

$namevalue ='name="'.$name.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",status="'.$status.'",password="'.md5($randPass).'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",countryCode="'.$countryCode.'",userType="suppliers",description="'.$description.'"';  
 
$lastid=addlistinggetlastid('sys_userMaster',$namevalue);   
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='supplier',details='".$name." Supplier Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";    
}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

 
?>
<script>
parent.redirectpage('display.html?ga=suppliers&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}






if($_POST['action']=='saveagents' && $_POST['name']!="" && $_POST['companyName']!="" && $_POST['email']!=""){

$commissionType=addslashes($_POST['commissionType']);
$agentType=addslashes($_POST['agentType']);
$lastName=addslashes($_POST['lastName']);
$website=addslashes($_POST['website']);
$companyName=addslashes($_POST['companyName']);
$agentCategory=addslashes($_POST['agentCategory']);
$name=addslashes($_POST['name']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']); 
$country=addslashes($_POST['country']); 
$state=addslashes($_POST['state']); 
$city=addslashes($_POST['city']); 
$countryCode=addslashes($_POST['countryCode']); 
$description=addslashes($_POST['description']);
$pan=addslashes($_POST['pan']);
$address2=addslashes($_POST['address2']);
$fax=addslashes($_POST['fax']); 
$pincode=addslashes($_POST['pincode']);
$businessType=addslashes($_POST['businessType']);
$gstin=addslashes($_POST['gstin']);
$contactPerson=addslashes($_POST['contactPerson']);
$gstphoneNumber=addslashes($_POST['gstphoneNumber']);
$gstmobileNumber=addslashes($_POST['gstmobileNumber']);
$gstemailId=addslashes($_POST['gstemailId']);
$correspondenceMailId=addslashes($_POST['correspondenceMailId']);
$gstinStatus=addslashes($_POST['gstinStatus']);
$hsn=addslashes($_POST['hsn']);
$salesManager=addslashes($_POST['salesManager']);
$defaultMarkup=addslashes($_POST['defaultMarkup']);
$defaultCommision=addslashes($_POST['defaultCommision']);
	
$userCountry=addslashes($_POST['userCountry']);
$userState=addslashes($_POST['userState']);
$userCity=addslashes($_POST['userCity']);
$companyPincode=addslashes($_POST['companyPincode']);
$companyAddress=addslashes($_POST['companyAddress']);
$companyMobile=addslashes($_POST['companyMobile']);

if(isset($_POST['activeWebsite'])){
$activeWebsite=addslashes($_POST['activeWebsite']); 	
}else{
$activeWebsite=0;	
} 

if(isset($_POST['websiteTheme'])){
$websiteTheme=addslashes($_POST['websiteTheme']); 	
}else{
$websiteTheme=0;	
} 

if(isset($_POST['customerLogin'])){
$customerLogin=addslashes($_POST['customerLogin']); 	
}else{
$customerLogin=0;	
}

$permissionView='';
foreach($_POST['permissionView'] as $check) { 
	$permissionView.=$check.',';
}

$debitCard=addslashes($_POST['debitCard']); 
$creditCard=addslashes($_POST['creditCard']); 
$upi=addslashes($_POST['upi']); 
$netBanking=addslashes($_POST['netBanking']); 


$domainName=addslashes(str_replace('/','',str_replace('www.','',str_replace('http://','',str_replace('https://','',trim($_POST['domainName'])))))); 





if($agentType!='AG' && $agentType!='CP' && $agentType!='' && trim($_POST['domainName'])!=''){

 
$domaindirectory="/home/travbizz/public_html/".$domainName.""; //agent domain directory

if(is_dir($domaindirectory)){ 




 //Zip('/home/travbizz/public_html/travbizz/', 'compressed.zip');
  
// Enter the name of directory
 
   
function copy_directory( $source, $destination ) { if ( is_dir( $source ) ) { @mkdir( $destination ); $directory = dir( $source ); while ( FALSE !== ( $readdirectory = $directory->read() ) ) { if ( $readdirectory == '.' || $readdirectory == '..' ) { continue; } $PathDir = $source . '/' . $readdirectory; if ( is_dir( $PathDir ) ) { copy_directory( $PathDir, $destination . '/' . $readdirectory ); continue; } copy( $PathDir, $destination . '/' . $readdirectory ); } $directory->close(); }else { copy( $source, $destination ); } }
copy_directory( '/home/travbizz/public_html/travbizz/', $domaindirectory );


//=======================================For website setting================================
$writedomaindirectory=$domaindirectory.'/config/'; 
$filename = $writedomaindirectory."setting.php";
$ourFileName =$filename;
$ourFileHandle = fopen($ourFileName, 'w'); 
/* $written="
<?php
\$systemname=\"$companyName\";
\$footerversion=\"V. 3.0 - Travbizz\"; 
\$agentbannerurl=\"https://www.travbizz.in/agent/upload/\";
\$agenturl=\"https://www.travbizz.in/agent/\";
\$fullurl=\"https://www.$domainName/\";
\$imgurl=\"https://www.travbizz.in/masteradmin/upload/\";
?>
"; */
$written="";
fwrite($ourFileHandle,$written); 
fclose($ourFileHandle);

//=======================================For Agent setting================================
$writedomaindirectory=$domaindirectory.'/agent/config/'; 
$filename = $writedomaindirectory."setting.php";
$ourFileName =$filename;
$ourFileHandle = fopen($ourFileName, 'w'); 
/* $written="
<?php
\$systemname=\"$companyName\";
\$footerversion=\"V. 3.0 - Travbizz\"; 
\$adminurl=\"https://www.travbizz.in/masteradmin/\";
\$websiteurl=\"https://www.$domainName/agent/\";
\$fullurl=\"https://www.$domainName/agent/\";
\$logoutUrl=\"https://www.$domainName/agent/\";
\$imgurl=\"https://www.travbizz.in/masteradmin/upload/\";
?>
";*/ 
$written="";
fwrite($ourFileHandle,$written); 
fclose($ourFileHandle);
 
 
//=======================================For Agent setting logincheck.php================================ 
$filename = $writedomaindirectory."logincheck.php"; 

$fname = $filename; 
$fhandle = fopen($fname,"r"); 
$content = fread($fhandle,filesize($fname));
$content = str_replace("https://travbizz.in/", "", $content); 
$content = str_replace("login-signup.html", "login", $content); 
$fhandle = fopen($fname,"w"); 
fwrite($fhandle,$content); 
fclose($fhandle);

if($_REQUEST['websiteTheme']==1){
rename("".$domaindirectory."/index1.php","".$domaindirectory."/index.php");
}

if($_REQUEST['websiteTheme']==2){
rename("".$domaindirectory."/index2.php","".$domaindirectory."/index.php");
}

if($_REQUEST['websiteTheme']==3){
rename("".$domaindirectory."/index3.php","".$domaindirectory."/index.php");
}

if($_REQUEST['websiteTheme']==4){
rename("".$domaindirectory."/index4.php","".$domaindirectory."/index.php");
}



}else{
 ?>
   <script>
   parent.$('#loadingwhite').hide();
    alert('Please add first addon domain from cpanel!'); </script>
   <?php
   exit();
} 

}

 


$websiteTitle=addslashes($_POST['websiteTitle']);
$facebookLink=addslashes($_POST['facebookLink']); 
$twitterLink=addslashes($_POST['twitterLink']); 
$instagramLink=addslashes($_POST['instagramLink']); 
$linkedinLink=addslashes($_POST['linkedinLink']); 
$websiteBaseColor=addslashes($_POST['websiteBaseColor']); 
$contactPhoneNo=addslashes($_POST['contactPhoneNo']); 
$contactEmail=addslashes($_POST['contactEmail']); 
$contactAddress=addslashes($_POST['contactAddress']); 
$queryEmail=addslashes($_POST['queryEmail']); 
$googleMap=addslashes($_POST['googleMap']); 
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']); 
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']); 
$paymentGatway=addslashes($_POST['paymentGatway']); 
$MERCHANT_KEY=addslashes($_POST['MERCHANT_KEY']); 
$SALT=addslashes($_POST['SALT']); 

 
$address=addslashes($_POST['address']); 
$branchId=addslashes($_POST['branchId']); 
$roleId=0; 
 
$status=round($_POST['agentstatus']); 
 
$logincredentials=addslashes($_POST['logincredentials']);  
$editid=addslashes($_POST['editid']);
$randPass = rand(999999,100000);

if($_FILES["companyLogo"]["tmp_name"]!=""){  
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}
if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}


$sql='';
if($_FILES["panCopy"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis"));
$panCopyFileName=basename($_FILES['panCopy']['name']); 
$panCopyFileExtension=pathinfo($panCopyFileName, PATHINFO_EXTENSION); 
$panCopy=time().$rt.'.'.$panCopyFileExtension; 
move_uploaded_file($_FILES["panCopy"]["tmp_name"], "upload/{$panCopy}"); 
$sql.=',panCopy="'.$panCopy.'"';
}

if($_FILES["aadharCopy"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis"));
$aadharCopyFileName=basename($_FILES['aadharCopy']['name']); 
$aadharCopyFileExtension=pathinfo($aadharCopyFileName, PATHINFO_EXTENSION); 
$aadharCopy=time().$rt.'.'.$aadharCopyFileExtension; 
move_uploaded_file($_FILES["aadharCopy"]["tmp_name"], "upload/{$aadharCopy}"); 
$sql.=',aadharCopy="'.$aadharCopy.'"';
}


if($editid!=''){

//-------EDIT-----------
	$userCountry=addslashes($_POST['userCountry']);
$userState=addslashes($_POST['userState']);
$userCity=addslashes($_POST['userCity']);
$companyPincode=addslashes($_POST['companyPincode']);
$companyAddress=addslashes($_POST['companyAddress']);
$companyMobile=addslashes($_POST['companyMobile']);

if($_REQUEST['logincredentials']==1){
$namevalue ='name="'.$name.'",agentType="'.$agentType.'",lastName="'.$lastName.'",email="'.$email.'",phone="'.$phone.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",companyPincode="'.$companyPincode.'",companyAddress="'.$companyAddress.'",companyMobile="'.$companyMobile.'",address="'.$address.'",roleId="'.$roleId.'",status="'.$status.'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",password="'.md5($randPass).'",countryCode="'.$countryCode.'",description="'.$description.'",agentCategory="'.$agentCategory.'",activeWebsite="'.$activeWebsite.'",domainName="'.$domainName.'",websiteTitle="'.$websiteTitle.'",websiteTheme="'.$websiteTheme.'",facebookLink="'.$facebookLink.'",twitterLink="'.$twitterLink.'",instagramLink="'.$instagramLink.'",linkedinLink="'.$linkedinLink.'",websiteBaseColor="'.$websiteBaseColor.'",customerLogin="'.$customerLogin.'",contactPhoneNo="'.$contactPhoneNo.'",contactEmail="'.$contactEmail.'",contactAddress="'.$contactAddress.'",queryEmail="'.$queryEmail.'",googleMap="'.$googleMap.'",companyLogo="'.$companyLogo.'",pan="'.$pan.'",address2="'.$address2.'",fax="'.$fax.'",pincode="'.$pincode.'",businessType="'.$businessType.'",gstin="'.$gstin.'",contactPerson="'.$contactPerson.'",gstphoneNumber="'.$gstphoneNumber.'",gstmobileNumber="'.$gstmobileNumber.'",gstemailId="'.$gstemailId.'",correspondenceMailId="'.$correspondenceMailId.'",gstinStatus="'.$gstinStatus.'",hsn="'.$hsn.'",debitCard="'.$debitCard.'",creditCard="'.$creditCard.'",upi="'.$upi.'",netBanking="'.$netBanking.'",salesManager="'.$salesManager.'",commissionType="'.$commissionType.'",permissionView="'.$permissionView.'",website="'.$website.'",paymentGatway="'.$paymentGatway.'",MERCHANT_KEY="'.$MERCHANT_KEY.'",SALT="'.$SALT.'" '.$sql.''; 
} else {  
$namevalue ='name="'.$name.'",agentType="'.$agentType.'",lastName="'.$lastName.'",email="'.$email.'",phone="'.$phone.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",companyPincode="'.$companyPincode.'",companyAddress="'.$companyAddress.'",companyMobile="'.$companyMobile.'",address="'.$address.'",roleId="'.$roleId.'",status="'.$status.'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",MERCHANT_KEY="'.$MERCHANT_KEY.'",SALT="'.$SALT.'",countryCode="'.$countryCode.'",description="'.$description.'",agentCategory="'.$agentCategory.'",activeWebsite="'.$activeWebsite.'",domainName="'.$domainName.'",websiteTitle="'.$websiteTitle.'",websiteTheme="'.$websiteTheme.'",facebookLink="'.$facebookLink.'",twitterLink="'.$twitterLink.'",instagramLink="'.$instagramLink.'",linkedinLink="'.$linkedinLink.'",websiteBaseColor="'.$websiteBaseColor.'",customerLogin="'.$customerLogin.'",contactPhoneNo="'.$contactPhoneNo.'",contactEmail="'.$contactEmail.'",contactAddress="'.$contactAddress.'",queryEmail="'.$queryEmail.'",googleMap="'.$googleMap.'",companyLogo="'.$companyLogo.'",pan="'.$pan.'",address2="'.$address2.'",fax="'.$fax.'",pincode="'.$pincode.'",businessType="'.$businessType.'",gstin="'.$gstin.'",contactPerson="'.$contactPerson.'",gstphoneNumber="'.$gstphoneNumber.'",gstmobileNumber="'.$gstmobileNumber.'",gstemailId="'.$gstemailId.'",correspondenceMailId="'.$correspondenceMailId.'",gstinStatus="'.$gstinStatus.'",hsn="'.$hsn.'",debitCard="'.$debitCard.'",creditCard="'.$creditCard.'",upi="'.$upi.'",netBanking="'.$netBanking.'",commissionType="'.$commissionType.'",website="'.$website.'",salesManager="'.$salesManager.'",permissionView="'.$permissionView.'",paymentGatway="'.$paymentGatway.'",MERCHANT_KEY="'.$MERCHANT_KEY.'",SALT="'.$SALT.'" '.$sql.'';
}

//$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
$where='id="'.decode($editid).'"';   
updatelisting('sys_userMaster',$namevalue,$where); 



$asd=GetPageRecord('*','sys_agentWebsitePages','agentId="'.decode($editid).'"'); 
if(mysqli_num_rows($asd)<1){

$rs8=GetPageRecord('*','sys_agentWebsitePages','agentId=0 and status=0'); 
while($agentWebsitePages=mysqli_fetch_array($rs8)){

$namevalue ='agentId="'.decode($editid).'",pageName="'.addslashes($agentWebsitePages['pageName']).'",pageTitle="'.addslashes($agentWebsitePages['pageTitle']).'",pageDescription="'.addslashes($agentWebsitePages['pageDescription']).'",parentId="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'"';  
addlistinggetlastid('sys_agentWebsitePages',$namevalue);

}
}


$sql_insk="insert into sys_userLogs set currentIp='".$_SERVER['REMOTE_ADDR']."',logType='agent',details='".$name." Agent Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" '); 
$dubcheck=mysqli_fetch_array($rs8);

if($dubcheck['id']!=''){
?>
<script>
alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!');
parent.$('#loadingwhite').hide();
</script>
<?php
exit(); }


//Fetch Agent Id
$lastId=GetPageRecord('id,agentType,agentCustomId','sys_userMaster',' agentType="'.$agentType.'" and agentCustomId!="" order by id desc   ');
 
 
if(mysqli_num_rows($lastId)>0){
$lastIdData=mysqli_fetch_array($lastId);

$lastAgentId=substr($lastIdData["agentCustomId"], 2);
$IncSr=$lastAgentId+1;
$agentCustomId=$lastIdData["agentType"].str_pad($IncSr,4,"0",STR_PAD_LEFT);

}else{
	if($agentType=="AG"){
		$str="00231";
		$serial=str_pad($str,4,"0",STR_PAD_LEFT);
		$agentCustomId="AG".$serial;
	}
	
	if($agentType=="BWL" || $agentType=="AWL" || $agentType=="CWL"){
		$str="00430";
		$serial=str_pad($str,4,"0",STR_PAD_LEFT);
		$agentCustomId="WL".$serial;
	}
	
	if($agentType=="CP"){
		$str="00110";
		$serial=str_pad($str,4,"0",STR_PAD_LEFT);
		$agentCustomId="CP".$serial;
	}
}

$lag=GetPageRecord('*','sys_userMaster',' userType="agent" order by id desc'); 
$lastagentid=mysqli_fetch_array($lag);

$lastAgentId=round($lastagentid['agentId']+1);
  
$namevalue ='agentType="'.$agentType.'",agentCustomId="'.$agentCustomId.'",name="'.$name.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",roleId="'.$roleId.'",status="'.$status.'",password="'.md5($randPass).'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",countryCode="'.$countryCode.'",userType="agent",description="'.$description.'",agentCategory="'.$agentCategory.'",activeWebsite="'.$activeWebsite.'",domainName="'.$domainName.'",websiteTitle="'.$websiteTitle.'",websiteTheme="'.$websiteTheme.'",facebookLink="'.$facebookLink.'",twitterLink="'.$twitterLink.'",instagramLink="'.$instagramLink.'",linkedinLink="'.$linkedinLink.'",websiteBaseColor="'.$websiteBaseColor.'",customerLogin="'.$customerLogin.'",contactPhoneNo="'.$contactPhoneNo.'",contactEmail="'.$contactEmail.'",contactAddress="'.$contactAddress.'",queryEmail="'.$queryEmail.'",googleMap="'.$googleMap.'",companyLogo="'.$companyLogo.'",pan="'.$pan.'",address2="'.$address2.'",fax="'.$fax.'",pincode="'.$pincode.'",businessType="'.$businessType.'",gstin="'.$gstin.'",contactPerson="'.$contactPerson.'",gstphoneNumber="'.$gstphoneNumber.'",gstmobileNumber="'.$gstmobileNumber.'",gstemailId="'.$gstemailId.'",correspondenceMailId="'.$correspondenceMailId.'",gstinStatus="'.$gstinStatus.'",hsn="'.$hsn.'",debitCard="'.$debitCard.'",creditCard="'.$creditCard.'",upi="'.$upi.'",netBanking="'.$netBanking.'",agentId="'.$lastAgentId.'",salesManager="'.$salesManager.'",permissionView="'.$permissionView.'",paymentGatway="'.$paymentGatway.'",MERCHANT_KEY="'.$MERCHANT_KEY.'",SALT="'.$SALT.'" '.$sql.'';  
 
$lastid=addlistinggetlastid('sys_userMaster',$namevalue);   
$editid=encode($lastid); 
 
$where=' id="'.decode($editid).'"';   
updatelisting('sys_userMaster','parentAgentId="'.decode($editid).'"',$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='agent',details='".$name." Agent Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";


 



$rs8=GetPageRecord('*','sys_agentWebsitePages','agentId=0 and status=0'); 
while($agentWebsitePages=mysqli_fetch_array($rs8)){


$namevalue ='agentId="'.$lastid.'",pageName="'.addslashes($agentWebsitePages['pageName']).'",pageTitle="'.addslashes($agentWebsitePages['pageTitle']).'",pageDescription="'.addslashes($agentWebsitePages['pageDescription']).'",parentId="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'"';  
addlistinggetlastid('sys_agentWebsitePages',$namevalue);


}






}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



if($defaultMarkup==1){

$a=GetPageRecord('*','domesticFlightsMarkupMaster',' status=1 order by id desc');
while($rest=mysqli_fetch_array($a)){ 

$b=GetPageRecord('*','fareTypedomesticFlightsMarkupMaster',' flightId="'.$rest['id'].'" order by id desc');
while($rest2=mysqli_fetch_array($b)){ 

 


$namevalue ='agentId="'.$_SESSION['userid'].'",sectorType="'.$sectorType.'",flightId="'.$rest['id'].'",name="'.$rest2['name'].'",markupType="'.$rest2['markupType'].'",markupValue="'.$rest2['markupValue'].'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticFlightsMarkupMaster',$namevalue);  
 

}

}

}


if($defaultCommision==1){

$a=GetPageRecord('*','domesticFlightsCommissionMaster',' status=1 order by id desc');
while($rest=mysqli_fetch_array($a)){ 

$b=GetPageRecord('*','fareTypedomesticFlightsCommissionMaster',' flightId="'.$rest['id'].'" order by id desc');
while($rest2=mysqli_fetch_array($b)){ 
 
$c=GetPageRecord('*','agent_fareTypedomesticFlightsCommissionMaster',' name="'.$rest2['name'].'" and flightId="'.$rest['id'].'" and agentId="'.decode($editid).'" order by id desc'); 
if(mysqli_num_rows($c)<1){ 

$namevalue ='agentId="'.decode($editid).'",flightId="'.$rest['id'].'",name="'.$rest2['name'].'",markupType="'.$rest2['markupType'].'",markupValue="'.$rest2['markupValue'].'",cashBackType="'.$rest2['cashBackType'].'",cashBackValue="'.$rest2['cashBackValue'].'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticFlightsCommissionMaster',$namevalue); 

}

}

}

}

 
if(isset($_REQUEST['salesmanagermail'])){
//Fetch Sales Manager Details
$sm=GetPageRecord('*','sys_userMaster','id="'.$salesManager.'"'); 
$smData=mysqli_fetch_array($sm); 

$subject = strip($smData['name']).' - Your New Account Manager'; 

$mailbody='<div>
  <div dir="auto">&nbsp;</div>
  <br>
  <br>
  <div class="gmail_quote">
    <br>
    <br>
    <u></u>
    <div style="font-family: arial,sans-serif;">
      <table style="background: #fff; width: 700px; margin: 0px auto; border: 5px solid #ccc; border-collapse: collapse; font-family: arial,sans-serif;" width="700px" cellspacing="0" cellpadding="0" align="center">
        <tbody>
          <tr>
            <td>
              <table style="width: 100%; border-collapse: collapse; height: 177px;" width="100%" cellspacing="0" cellpadding="10" bgcolor="#fff">
                <tbody>
                  <tr style="height: 177px;">
                    <td style="padding: 15px 35px; height: 177px;">
                      <table style="border-collapse: collapse;" width="100%" bgcolor="#fff">
                        <tbody>
                          <tr>
                            <td align="left">
                              <a href="https://www.travbizz.in/" target="_blank" rel="noopener noreferrer">
                                <img src="https://www.travbizz.in/assets/travbizz-logo-signup.png" alt="travbizz-logo" height="70">
                              </a>
                            </td>
                            <td style="font-size: 18px; font-weight: bold; color: #000;" align="right">Your New Account Manager</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 700px; border-collapse: collapse;" border="0" summary="" width="700" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="font-size: 13px; color: #626262; padding: 25px 35px; text-align: justify;">
                      <p style="color: #464646;">
                        <strong>Dear Travel Partners,</strong>
                      </p>
                      <p>Greetings from 
                        <span style="color: #1e99c3;">travbizz.in</span>&nbsp;
                      </p>
                      <p>In line to our commitment to give you the best possible service, please note that we have changed your account manager. From now on, I will be in-charge of your account and will be honoured to assist you in all your business queries. My contact details are below:</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 700px; border-collapse: collapse;" border="0" width="700" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="padding-left: 35px;">
                      <table style="height: 149px; font-size: 13px; color: #1e99c3; background: #fff; border-collapse: collapse;" border="1" width="100">
                        <tbody>
                          <tr>
                            <td style="display: block; height: 149px;"><img src="https://www.travbizz.in/masteradmin/upload/'.strip($smData["profilePhoto"]).'" style="height:150px;width:150px;">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td style="display: block;">
                      <table style="font-size: 13px; color: #1e99c3; background: #fff; border-collapse: collapse;" border="1" width="300">
                        <tbody>
                          <tr>
                            <td style="color: #f99f24; font-size: 14px; padding: 10px 25px; margin: 0px; font-weight: bold;">'.strip($smData['name']).'</td>
                          </tr>
                          <tr>
                            <td style="color: #f99f24; font-size: 14px; padding: 10px 25px; margin: 0px; font-weight: bold;"> Sales Manager</td>
                          </tr>
                          <tr>
                            <td style="color: #f99f24; font-size: 14px; padding: 11px 25px; margin: 0px; font-weight: bold;">'.strip($smData['email']).'</td>
                          </tr>
                          <tr>
                            <td style="color: #f99f24; font-size: 14px; padding: 10px 25px; margin: 0px; font-weight: bold;">'.strip($smData['phone']).'</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td width="280">&nbsp;</td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 700px; border-collapse: collapse;" border="0" summary="" width="700" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="font-size: 13px; color: #626262; padding: 25px 35px;">Feel free to contact me for:</td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding: 0px 30px;">
              <table style="width: 640px; border-collapse: collapse;" border="0" width="640" cellspacing="4" cellpadding="4">
                <tbody>
                  <tr>
                    <td>
                      <table style="border-collapse: collapse;" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td style="border: 1px solid #47acce; padding: 0px 6px; height: 148px;" align="center" width="160">
                              <img src="https://www.travbizz.in/assets/systemtraining.png"> 
                              <br>
                              <span style="color: #f99f24; font-size: 16px; font-weight: bold;">System 
                                <br>Training
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td>
                      <table style="border-collapse: collapse;" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td style="border: 1px solid #47acce; padding: 0px 6px; height: 148px;" align="center" width="160">
                              <img src="https://www.travbizz.in/assets/accounts-paymenticon.png"> 
                              <br>
                              <span style="color: #f99f24; font-size: 16px; font-weight: bold;">Accounts &amp; 
                                <br>Payment Support
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td>
                      <table style="border-collapse: collapse;" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td style="border: 1px solid #47acce; padding: 0px 6px; height: 148px;" align="center" width="160">
                              <img src="https://www.travbizz.in/assets/apiintigrationicon.png"> 
                              <br>
                              <span style="color: #f99f24; font-size: 16px; font-weight: bold;">API Integration 
                                <br>Support
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td>
                      <table style="border-collapse: collapse;" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td style="border: 1px solid #47acce; padding: 0px 6px; height: 148px;" align="center" width="160">
                              <img src="https://www.travbizz.in/assets/grievanceredressalicon.png"> 
                              <br>
                              <span style="color: #f99f24; font-size: 16px; font-weight: bold;">Grievance 
                                <br>Redressal
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 700px; border-collapse: collapse;" border="0" summary="" width="700" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="font-size: 13px; color: #626262; padding: 15px 35px; text-align: justify;">
                      <p>Moreover, for operation support, you can reach out to us at:</p>
                      <table style="font-size: 13px; color: #1e99c3; background: #fff; border-collapse: collapse;" border="1" width="400">
                        <tbody>
                          <tr>
                            <td style="color: #1e99c3; font-size: 14px; padding: 10px 25px; margin: 0px; font-weight: bold;">
                              <strong style="color: #626262;">Email:</strong> 
                              <a style="text-decoration: none; color: #1e99c3;" href="mailto:support@travbizz.in" target="_blank" rel="noopener noreferrer">support@travbizz.in</a>
                            </td>
                          </tr>
                          <tr>
                            <td style="color: #1e99c3; font-size: 14px; padding: 10px 25px; margin: 0px; font-weight: bold;">
                              <strong style="color: #626262;">Ops Emergency No:</strong> 
                              <a style="text-decoration: none; color: #1e99c3;" href="tel:+919218501850" target="_blank" rel="noopener noreferrer">+91 9654907178&nbsp;</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <p>We Look forward to further strengthen our business relationship with you and take it to new heights.</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 700px; border-collapse: collapse;" border="0" summary="" width="700" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="font-size: 13px; color: #626262; padding: 0px 35px;">
                      <p style="color: #464646;">
                        <strong>Thanking you, 
                          <br>'.strip($smData['name']).'
                        </strong>
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 700px; border-collapse: collapse;" border="0" width="700" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="font-size: 13px; background: #f1f2f3; padding: 18px 35px;">
                      <p style="color: #626262; margin: 0px; background: #f1f2f3;">
                        <a href="http://www.travbizz.in">www.travbizz.in</a>&nbsp; 
                        <br>
                        <span style="color: #3366ff;">
                                  <a href="https://twitter.com/travbizz_in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://twitter.com/travbizz_in&amp;source=gmail&amp;ust=1636701332038000&amp;usg=AOvVaw2XND0aCZK6Z0S7QUel1Hhv" rel="noopener" style="color: #3366ff;">
                                    <img src="https://www.travbizz.in/assets/twittericonn.png" alt="twitter icon" width="16" border="0"></a>                                </span>&nbsp; 
                                <a href="https://www.facebook.com/travbizz.in/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/travbizz.in/&amp;source=gmail&amp;ust=1636701332039000&amp;usg=AOvVaw2skqSUZT61zzZzLrgAhbcZ" rel="noopener">
                                  <img src="https://www.travbizz.in/assets/facebookiconin.png" alt="facebook icon" width="16" border="0"></a>&nbsp; 
                                <a href="https://www.linkedin.com/company/travbizz-in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/company/travbizz-in&amp;source=gmail&amp;ust=1636701332039000&amp;usg=AOvVaw2ktO45VlA6hTNbbVqAbiGE" rel="noopener">
                                  <img src="https://www.travbizz.in/assets/linkediniconin.png" alt="linkedin icon" width="16" border="0"></a>&nbsp; 
                                <a href="https://www.instagram.com/travbizz.in/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/travbizz.in/&amp;source=gmail&amp;ust=1636701332039000&amp;usg=AOvVaw3DCOAYi8mYK3HeBnQagFeD" rel="noopener">
                                  <img src="https://www.travbizz.in/assets/instagrammiconin.png" alt="instagram icon" width="16" border="0"></a>&nbsp; 
                                <br>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
     
    </div>
  </div>
</div>';

 

$to = $email;
$from = 'b2bsupport@travbizz.in';

$subject = 'Sale User - Your New Account Manager - travbizz.in';
$headers = "From: travbizz Partner <" . $from . ">\r\n"; 
$headers .= "Reply-To: ". $from . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = $mailbody;


mail($to, $subject, $message, $headers);

}



if($_REQUEST['logincredentials']==1){ 


$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" '); 
$dubcheck=mysqli_fetch_array($rs8);


$subject = 'Member Confirmation - travbizz.in'; 

$mailbody='<div>
  <div dir="ltr">
    <div>
      <div dir="auto">&nbsp;</div>
      <br>
      <div class="gmail_quote">
        <table style="background: #fff; border-top: #f29c1f 6px solid; border-left: 1px solid #d3d3d3; border-right: 1px solid #d3d3d3; border-bottom: 1px solid #d3d3d3;" border="0" width="727" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td>
                <table style="height: 847px; width: 100.966%;" border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr style="height: 10px;">
                      <td style="background: #f9f8f8; padding: px px; height: 10px;">
                        <table style="height: 111px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr style="height: 111px;">
                              <td style="background: #f9f8f8; padding: 27px 29px; height: 111px;">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                  <tbody>
                                    <tr>
                                      <td width="191">
                                        <img src="https://www.travbizz.in/assets/travbizz-logo-signup.png" alt="" height="70">
                                      </td>
                                      <td style="font-family: Arial,Helvetica,sans-serif; font-size: 10px; color: #5a5c5d;" align="left">A unit of Profes &amp; Hospitality Pvt ltd&nbsp;</td>
                                      <td style="color: #6eb9d7; font-family: Arial,Helvetica,sans-serif; font-size: 20px;" align="right">Agent Login</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr style="height: 837px;">
                      <td style="padding: 12px; height: 837px;">
                        <table style="height: 768px; width: 100%;" border="0" width="100%" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr style="height: 140px;">
                              <td style="font-family: Arial,Helvetica,sans-serif; line-height: 20px; font-size: 13px; color: #676767; padding-left: 16px; padding-right: 16px; padding-top: 20px; height: 140px;">
                                <span style="font-family: Arial,Helvetica,sans-serif; color: #f49f1f; font-size: 14px;">'.$name.' </span>
                                <p style="margin: 0px;">Greetings from 
                                  <a href="http://travbizz.in">travbizz.in</a>&nbsp;
                                </p>
                                <p style="margin: 0px;">Welcome in travbizz, we would like to congratulate you on becoming a part of 
                                  <span style="color: #329ac4;">
                                    <a href="http://travbizz.in">travbizz.in</a>
                                  </span> 
                                  <br>A user login has been created for you within 
                                  <a href="http://www.travbizz.in">www.travbizz.in</a> and following is the necessary information 
                                  <br>required to login to the system.
                                </p>
                              </td>
                            </tr>
                            <tr style="height: 0px;">
                              <td style="height: 0px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 153px;">
                              <td style="height: 153px;">
                                <table style="background: #d3d3d3; color: #343434; font-size: 13px; font-family: Arial,Helvetica,sans-serif;" border="0" width="100%" cellspacing="1" cellpadding="1">
                                  <tbody>
                                    <tr style="background: #fff;">
                                      <td style="background: #eeeeee; padding: 10px 15px 10px 15px;" width="50%">URL:</td>
                                      <td style="background: #fff; padding: 10px 15px 10px 15px;" width="50%">
                                        <a href="https://travbizz.in/login-signup.html" target="_blank" rel="noopener noreferrer">https://travbizz.in/login-signup.html</a>
                                      </td>
                                    </tr>
                                    <tr style="background: #fff;">
                                      <td style="background: #eeeeee; padding: 10px 15px 10px 15px;">Agent Code:</td>
                                      <td style="background: #fff; padding: 10px 15px 10px 15px;">'.makeAgentId($dubcheck['agentId']).'</td>
                                    </tr>
                                    <tr style="background: #fff;">
                                      <td style="background: #eeeeee; padding: 10px 15px 10px 15px;">Username:</td>
                                      <td style="background: #fff; padding: 10px 15px 10px 15px;">'.$email.'</td>
                                    </tr>
                                    <tr style="background: #fff;">
                                      <td style="background: #eeeeee; padding: 10px 15px 10px 15px;">Password:</td>
                                      <td style="background: #fff; padding: 10px 15px 10px 15px;">'.$randPass.'</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr style="height: 28px;">
                              <td style="height: 28px;" height="28">&nbsp;</td>
                            </tr>
                            <tr style="height: 28px;">
                              <td style="background: #6eb9d7; font-family: Arial,Helvetica,sans-serif; color: #ffffff; font-size: 14px; padding: 5px 15px; height: 28px;" height="28">Key Offerings</td>
                            </tr>
                            <tr style="height: 18px;">
                              <td style="height: 18px;" height="18">&nbsp;</td>
                            </tr>
                            <tr style="height: 28px;">
                              <td style="font-family: Arial,Helvetica,sans-serif; color: #676767; font-size: 13px; padding-left: 16px; padding-right: 15px; line-height: 20px; height: 28px;" height="28">We will once again highlight key offerings of our Award Winning Most Customer Friendly Company.</td>
                            </tr>
                            <tr style="height: 20px;">
                              <td style="height: 20px;" height="20">&nbsp;</td>
                            </tr>
                            <tr style="height: 158px;">
                              <td style="height: 158px;">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                  <tbody>
                                    <tr>
                                      <td style="background: #f69e00; height: 126px; color: #fff; font-size: 32px; letter-spacing: -1px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; vertical-align: top; padding: 5px;" align="center" valign="middle" width="25%">250,000+ 
                                        <br>
                                        <span style="font-size: 13px; letter-spacing: 0; line-height: 20px; font-weight: normal;">Hotel and Apartment 
                                          <br>Rooms Worldwide
                                        </span>
                                      </td>
                                      <td width="8">&nbsp;</td>
                                      <td style="background: #2899c5; height: 126px; color: #fff; font-size: 32px; letter-spacing: -1px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; vertical-align: top; padding: 5px;" align="center" valign="middle" width="25%">45,000+ 
                                        <br>
                                        <span style="font-size: 13px; line-height: 20px; letter-spacing: 0; font-weight: normal;">Sightseeing items and 
                                          <br>over 5000 Tours in 
                                          <br>500 Cities
                                        </span>
                                      </td>
                                      <td width="8">&nbsp;</td>
                                      <td style="background: #8aad1b; height: 126px; color: #fff; font-size: 32px; letter-spacing: -1px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; vertical-align: top; padding: 5px;" align="center" valign="middle" width="25%">5,000+ 
                                        <br>
                                        <span style="font-size: 13px; line-height: 20px; letter-spacing: 0; font-weight: normal;">Transfer options in over 
                                          <br>900 Airport and City 
                                          <br>Locations
                                        </span>
                                      </td>
                                      <td width="8">&nbsp;</td>
                                      <td style="background: #8145b3; height: 126px; color: #fff; font-size: 32px; letter-spacing: -1px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; vertical-align: top; padding: 5px;" align="center" width="25%">11,000+ 
                                        <br>
                                        <span style="font-size: 13px; line-height: 20px; letter-spacing: 0; font-weight: normal;">Preferred by 11,000+ 
                                          <br>Active Travel Agents
                                        </span>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr style="height: 30px;">
                              <td style="height: 30px;" height="30px">&nbsp;</td>
                            </tr>
                            <tr style="height: 20px;">
                              <td style="height: 20px;" height="20">&nbsp;</td>
                            </tr>
                            <tr style="height: 15px;">
                              <td style="padding: 10px 15px; background: #eeeeee; font-size: 13px; font-family: Arial,Helvetica,sans-serif; border: 1px solid #d3d3d3; height: 15px;">If have any query, feel free to contact us at 
                                <a href="mailto:support@travbizz.in">support@travbizz.in</a>&nbsp;
                              </td>
                            </tr>
                            <tr style="height: 40px;">
                              <td style="height: 40px;" height="40px">&nbsp;</td>
                            </tr>
                              <tr style="height: 60px;">
                          <td style="padding: 10px 15px; font-weight: bold; line-height: 20px; font-size: 13px; font-family: Arial, Helvetica, sans-serif; height: 60px;">
                            <span style="font-family: sans-serif, Arial, Verdana, Trebuchet MS;">
                              <span style="font-weight: normal; line-height: 20.7999992370605px;">Thanking you, 
                                <br>Registration &amp; Sales Team, 
                                <br>www.travbizz.in&nbsp; 
                                <br>
                                <span style="color: #3366ff;">
                                  <a href="https://twitter.com/travbizz_in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://twitter.com/travbizz_in&amp;source=gmail&amp;ust=1636701332038000&amp;usg=AOvVaw2XND0aCZK6Z0S7QUel1Hhv" rel="noopener" style="color: #3366ff;">
                                    <img src="https://www.travbizz.in/assets/twittericonn.png" alt="twitter icon" width="16" border="0"></a>                                </span>&nbsp; 
                                <a href="https://www.facebook.com/travbizz.in/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/travbizz.in/&amp;source=gmail&amp;ust=1636701332039000&amp;usg=AOvVaw2skqSUZT61zzZzLrgAhbcZ" rel="noopener">
                                  <img src="https://www.travbizz.in/assets/facebookiconin.png" alt="facebook icon" width="16" border="0"></a>&nbsp; 
                                <a href="https://www.linkedin.com/company/travbizz-in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/company/travbizz-in&amp;source=gmail&amp;ust=1636701332039000&amp;usg=AOvVaw2ktO45VlA6hTNbbVqAbiGE" rel="noopener">
                                  <img src="https://www.travbizz.in/assets/linkediniconin.png" alt="linkedin icon" width="16" border="0"></a>&nbsp; 
                                <a href="https://www.instagram.com/travbizz.in/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/travbizz.in/&amp;source=gmail&amp;ust=1636701332039000&amp;usg=AOvVaw3DCOAYi8mYK3HeBnQagFeD" rel="noopener">
                                  <img src="https://www.travbizz.in/assets/instagrammiconin.png" alt="instagram icon" width="16" border="0"></a>&nbsp; 
                                <br>
                              </span>
                            </span>
                          </td>
                        </tr>
                            <tr style="height: 30px;">
                              <td style="height: 30px;" height="30px">&nbsp;</td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div>';

 

$to = $email;
$from = 'b2bsupport@travbizz.in';

$subject = 'Sale User - Your New Account Manager - travbizz.in';

$headers = "From: travbizz Partner <" . $from . ">\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = $mailbody;


mail($to, $subject, $message, $headers);




}
 
?>
<script>
parent.redirectpage('display.html?ga=agents&id=<?php echo $editid; ?>&save=1');
</script>

<?php
exit();
}






if($_REQUEST['action']=='additinerary' && $_REQUEST['quotationtype']!=""){

$queryid=addslashes($_REQUEST['queryid']); 
$quotationtype=addslashes($_REQUEST['quotationtype']); 
$editid=addslashes($_POST['editid']); 
 

if($editid!=''){ 
} else {


//-------------ADD-----------------

$namevalue ='startDate="'.date('Y-m-d').'",endDate="'.date('Y-m-d').'",adult=1,child=0,infant=0,quotationType="'.$quotationtype.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['userid'].'",dayWise=1'; 

$lastid=addlistinggetlastid('quotationMaster',$namevalue);  



if($_REQUEST['quotationtype']=='Detailed Package'){

$ha=GetPageRecord('*','packageTermsConditions',' 1 order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 

$namevalue ='termType="'.$listdata['termType'].'",termDescription="'.addslashes($listdata['termDescription']).'",quotationId="'.$lastid.'",parentId="'.$_SESSION['userid'].'"';  
addlistinggetlastid('quotationTerms',$namevalue); 

}




$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$_SESSION['userid'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 
$branchData=mysqli_fetch_array($ab);

$namevalue ='quotationId="'.$lastid.'",parentId="'.$_SESSION['userid'].'",CGST="'.$branchData['taxName1'].'",SGST="'.$branchData['taxName2'].'",IGST="'.$branchData['taxName3'].'",TCS="'.$branchData['taxName4'].'",currencyId="'.$branchData['currency'].'"';  
addlistinggetlastid('sys_quickPackageOptions',$namevalue);  

}

 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#QT".encode($lastid)." Quotation Added in #".$queryid."',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
}
  

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo encode($lastid); ?>&save=1');
</script>

<?php
exit();
}








 
if($_POST['action']=='saveEventHotelOpenb2b'  && $_POST['quotationid']!="" && $_POST['travelFromCity']!=""  && $_POST['name']!="" && $_POST['mealPlan']!="" && $_POST['roomType']!=""){

$quotationid=addslashes($_POST['quotationid']);
$optionid=0;
$travelFromCity=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$roomCategory=trim(addslashes($_POST['roomCategory']));
$mealPlan=trim(addslashes($_POST['mealPlan']));
$category=trim(addslashes($_POST['hotelCategory']));
$roomType=trim(addslashes($_POST['roomType']));
$editid=trim(addslashes($_POST['editid']));
$eventPhoto=trim(addslashes($_POST['eventPhoto']));
 
$checkInDate=date('Y-m-d',strtotime($_POST['checkInDate']));
$checkOutDate=date('Y-m-d',strtotime($_POST['checkOutDate']));

$checkInTime=$_POST['checkInTime'];
$checkOutTime=$_POST['checkOutTime']; 
$eventDetails=addslashes($_POST['eventDetails']); 
$roomCategory=trim(addslashes($_POST['roomCategory'])); 



$m=GetPageRecord('*','sys_HotelMealPlanCost',' parentId="'.$_SESSION['userid'].'" and id="'.$_POST['mealPlan'].'"'); 
$mealcost=mysqli_fetch_array($m);
$totalmealcost=$mealcost['adultCost'];




$f=GetPageRecord('*','sys_HotelRoomTypeCost',' parentId="'.$_SESSION['userid'].'" and id="'.$_POST['roomType'].'"'); 
$roomcost=mysqli_fetch_array($f);

 
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 

$singleRoom=1; 
$doubleRoom=addslashes($_POST['doubleRoom']); 
$tripleRoom=addslashes($_POST['tripleRoom']); 
$extraAdultRoom=addslashes($_POST['extraAdultRoom']); 
$childWithBedRoom=addslashes($_POST['childWithBedRoom']); 

$singleRoomCost=$roomcost['adultCost']; 
$doubleRoomCost=addslashes($_POST['doubleRoomCost']); 
$tripleRoomCost=addslashes($_POST['tripleRoomCost']); 
$extraAdultRoomCost=addslashes($_POST['extraAdultRoomCost']); 
$childWithBedRoomCost=addslashes($_POST['childWithBedRoomCost']); 
$dayId=addslashes($_POST['dayId']); 
$hotelId=addslashes($_POST['hotelId']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$totalsingleRoomCost=($singleRoomCost*$singleRoom); 
$totaldoubleRoomCost=($doubleRoomCost*$doubleRoom); 
$totaltripleRoomCost=($tripleRoomCost*$tripleRoom); 
$totalextraAdultRoomCost=($extraAdultRoomCost*$extraAdultRoom); 
$totalchildWithBedRoomCost=($childWithBedRoomCost*$childWithBedRoom); 


 

 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$totalsingleRoomCost+$totaldoubleRoomCost+$totaltripleRoomCost+$totalextraAdultRoomCost+$totalchildWithBedRoomCost+$totalmealcost;
   
 
$totalnights=dateDifference($checkInDate,$checkOutDate);

$quotationCost=($quotationCost*$totalnights);

$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  


  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------


  
 
if($editid!=''){

$namevalue ='cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",eventDetails="'.$eventDetails.'",eventPhoto="'.$eventPhoto.'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",extraAdultRoom="'.$extraAdultRoom.'",childWithBedRoom="'.$childWithBedRoom.'",singleRoomCost="'.$singleRoomCost.'",doubleRoomCost="'.$doubleRoomCost.'",tripleRoomCost="'.$tripleRoomCost.'",extraAdultRoomCost="'.$extraAdultRoomCost.'",childWithBedRoomCost="'.$childWithBedRoomCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'",mealPlanCost="'.$totalmealcost.'",hotelId="'.$hotelId.'"'; 

$where='parentId="'.$_SESSION['userid'].'"   and quotationId="'.decode($_REQUEST['quotationid']).'" and id="'.decode($_REQUEST['editid']).'"';
updatelisting('quotationEvents',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Hotel Updated In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

$namevalue ='quotationId="'.decode($quotationid).'",cityId="'.$travelFromCity.'",name="'.$name.'",category="'.$category.'",roomCategory="'.$roomCategory.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",checkInDate="'.$checkInDate.'",checkOutDate="'.$checkOutDate.'",checkInTime="'.$checkInTime.'",checkOutTime="'.$checkOutTime.'",eventDetails="'.$eventDetails.'",eventType="hotel",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",extraAdultRoom="'.$extraAdultRoom.'",childWithBedRoom="'.$childWithBedRoom.'",singleRoomCost="'.$singleRoomCost.'",doubleRoomCost="'.$doubleRoomCost.'",tripleRoomCost="'.$tripleRoomCost.'",extraAdultRoomCost="'.$extraAdultRoomCost.'",childWithBedRoomCost="'.$childWithBedRoomCost.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",dayId="'.$dayId.'",mealPlanCost="'.$totalmealcost.'",hotelId="'.$hotelId.'"';  
 
addlistinggetlastid('quotationEvents',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Hotel Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


 

//------------Add Hotel-----------

}


 

?>
<script>
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" );


<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $checkInDate; ?>');
<?php } else { ?>
parent.loadloadoptionhotel();
<?php } ?>
</script>

<?php
exit();
}



if($_POST['action']=='saveEventSightseeingb2b'  && $_POST['travelFromCity']>0 && $_POST['checkInDate']!='' && $_POST['name']!=''){

$sightseeingcityfield=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$sightseeingcheckInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$eventDuration=addslashes($_POST['eventDuration']);
$sightseeingeventDetails=addslashes($_POST['eventDetails']);
$dayId=addslashes($_POST['dayId']);
$checkInTime=addslashes($_POST['checkInTime']);
$editid=addslashes($_POST['editid']);
$vehicleId=addslashes($_POST['vehicleId']);
$noOfVehicle=addslashes($_POST['noOfVehicle']);
$sightseeingId=addslashes($_POST['sightseeingId']);
 

$m=GetPageRecord('*','sys_vehicleCost',' parentId="'.$_SESSION['userid'].'" and id="'.$_POST['vehicleId'].'"'); 
$mealcost=mysqli_fetch_array($m);
$totalvehicle=$mealcost['adultCost'];
  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['userid'].'" and id="'.$quotationData['queryId'].'"'); 
$queryData=mysqli_fetch_array($a);


$finalAdultCost=($totalvehicle*$noOfVehicle);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;
  


$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  


  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------
  
 
  
if($editid!=''){

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",eventPhoto="'.$_REQUEST['eventPhoto'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'",noOfVehicle="'.$noOfVehicle.'",sightseeingId="'.$sightseeingId.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",eventType="Sightseeing",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'",noOfVehicle="'.$noOfVehicle.'",sightseeingId="'.$sightseeingId.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Sightseeing Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}
   
   
  





?>
<script> 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" ); 

<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $sightseeingcheckInDate; ?>');
<?php } else { ?>
parent.loadquotationsightseeing();
<?php } ?>
</script>

<?php
exit();
}


if($_POST['action']=='saveEventActivityb2b'  && $_POST['travelFromCity']>0 && $_POST['checkInDate']!='' && $_POST['name']!=''){

$sightseeingcityfield=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$sightseeingcheckInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$eventDuration=addslashes($_POST['eventDuration']);
$sightseeingeventDetails=addslashes($_POST['eventDetails']);
$dayId=addslashes($_POST['dayId']);
$checkInTime=addslashes($_POST['checkInTime']);
$editid=addslashes($_POST['editid']);
$vehicleId=addslashes($_POST['vehicleId']);
$noOfVehicle=addslashes($_POST['noOfVehicle']);
$activityId=addslashes($_POST['activityId']);
$adult=addslashes($_POST['adult']);
 
 
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($_POST['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);
 


$finalAdultCost=($adult*$adultCost);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;
  


$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  


  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------
  
 
  
if($editid!=''){

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",eventPhoto="'.$_REQUEST['eventPhoto'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'",noOfVehicle="'.$noOfVehicle.'",activityId="'.$activityId.'",adult="'.$adult.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",eventType="Activity",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'",noOfVehicle="'.$noOfVehicle.'",activityId="'.$activityId.'",adult="'.$adult.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Activity Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}
   
   
  





?>
<script> 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" ); 

<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $sightseeingcheckInDate; ?>');
<?php } else { ?>
parent.loadquotationsightseeing();
<?php } ?>
</script>

<?php
exit();
}



if($_POST['action']=='saveEventCruiseb2b'  && $_POST['travelFromCity']>0 && $_POST['checkInDate']!='' && $_POST['name']!=''){

$seatId=addslashes($_POST['seatId']);
$sightseeingcityfield=addslashes($_POST['travelFromCity']);
$name=trim(addslashes($_POST['name']));
$sightseeingcheckInDate=date('Y-m-d',strtotime($_POST['checkInDate'])); 
$eventDuration=addslashes($_POST['eventDuration']);
$sightseeingeventDetails=addslashes($_POST['eventDetails']);
$dayId=addslashes($_POST['dayId']);
$checkInTime=addslashes($_POST['checkInTime']);
$editid=addslashes($_POST['editid']);
$vehicleId=addslashes($_POST['vehicleId']);
$noOfVehicle=addslashes($_POST['noOfVehicle']);
$cruiseId=addslashes($_POST['cruiseId']);
$adult=addslashes($_POST['adult']);
 
 
$m=GetPageRecord('*','sys_CruseCost',' parentId="'.$_SESSION['userid'].'" and id="'.$_POST['seatId'].'"'); 
$seatCostres=mysqli_fetch_array($m);
$seatCost=$seatCostres['adultCost'];
  
  
 //--------GST-------------
  
$quotationMarkup=addslashes($_POST['quotationMarkup']);  
$currencyId=addslashes($_POST['currencyId']); 
$perPerson=addslashes($_POST['perPerson']); 
$adultCost=addslashes($seatCostres['adultCost']); 
$childCost=addslashes($_POST['childCost']); 
$infantCost=addslashes($_POST['infantCost']); 


$a=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['userid'].'" and id="'.decode($_POST['quotationid']).'"'); 
$quotationData=mysqli_fetch_array($a);
 


$finalAdultCost=($adult*$adultCost);
$finalChildCost=($childCost*$queryData['child']);
$finalInfantCost=($infantCost*$queryData['infant']);
 

$CGST=addslashes($_POST['CGST']);
$SGST=addslashes($_POST['SGST']);
$IGST=addslashes($_POST['IGST']);
$TCS=addslashes($_POST['TCS']);

$quotationCost=$finalAdultCost+$finalChildCost+$finalInfantCost;
  


$taxApply=addslashes($_POST['taxApply']); 
$showTaxDetails=addslashes($_POST['showTaxDetails']); 

if($taxApply==0){
$quotationCostwithmarkup=($quotationCost+$quotationMarkup);
} else { 
$quotationCostwithmarkup=($quotationMarkup); 
}  


  
$CGSTamount=round(($quotationCostwithmarkup*$CGST)/100);
$SGSTamount=round(($quotationCostwithmarkup*$SGST)/100);
$IGSTamount=round(($quotationCostwithmarkup*$IGST)/100);
$TCSamount=round(($quotationCostwithmarkup*$TCS)/100);

$quotationCostWithTax=($quotationCost+$CGSTamount+$SGSTamount+$IGSTamount+$TCSamount+$quotationMarkup);
 
$CGSTamount=$CGSTamount;
$SGSTamount=$SGSTamount;
$IGSTamount=$IGSTamount;
$TCSamount=$TCSamount;


$taxName1=addslashes($_POST['taxName1']);
$taxName2=addslashes($_POST['taxName2']);
$taxName3=addslashes($_POST['taxName3']);
$taxName4=addslashes($_POST['taxName4']);
 
 
/// --------GST-------------
  
 
  
if($editid!=''){

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",eventPhoto="'.$_REQUEST['eventPhoto'].'",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'",noOfVehicle="'.$noOfVehicle.'",cruiseId="'.$cruiseId.'",adult="'.$adult.'",cruiseCost="'.$seatCost.'",seatId="'.$seatId.'"';  
$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';
updatelisting('quotationEvents',$namevalue,$where);
 
  
} else { 

$namevalue ='cityId="'.$sightseeingcityfield.'",name="'.$name.'",checkInDate="'.$sightseeingcheckInDate.'",eventDuration="'.$eventDuration.'",eventDetails="'.$sightseeingeventDetails.'",quotationId="'.decode($_POST['quotationid']).'",parentId="'.$_SESSION['userid'].'",eventPhoto="'.$_REQUEST['eventPhoto'].'",eventType="Cruise",CGSTamount="'.$CGSTamount.'",SGSTamount="'.$SGSTamount.'",IGSTamount="'.$IGSTamount.'",TCSamount="'.$TCSamount.'",CGSTValue="'.$CGST.'",SGSTValue="'.$SGST.'",IGSTValue="'.$IGST.'",TCSValue="'.$TCSamount.'",quotationCost="'.$quotationCost.'",quotationMarkup="'.$quotationMarkup.'",currencyId="'.$currencyId.'",quotationCostWithTax="'.$quotationCostWithTax.'",adultCost="'.$adultCost.'",childCost="'.$childCost.'",infantCost="'.$infantCost.'",perPerson="'.$perPerson.'",CGST="'.$taxName1.'",SGST="'.$taxName2.'",IGST="'.$taxName3.'",TCS="'.$taxName4.'",taxApply="'.$taxApply.'",showTaxDetails="'.$showTaxDetails.'",checkInTime="'.$checkInTime.'",dayId="'.$dayId.'",vehicleId="'.$vehicleId.'",noOfVehicle="'.$noOfVehicle.'",cruiseId="'.$cruiseId.'",adult="'.$adult.'",cruiseCost="'.$seatCost.'",seatId="'.$seatId.'"';   
addlistinggetlastid('quotationEvents',$namevalue); 
 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='quotation',sectionId='".decode($_REQUEST['quotationid'])."',details='".$name." Cruise Added In Quotation (QT".$_REQUEST['quotationid'].")',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
}
   
   
  





?>
<script> 
parent.$('#loadingwhite').hide();
parent.$( ".close" ).trigger( "click" ); 

<?php if($_REQUEST['dayId']>0 && $_REQUEST['dayId']!=''){ ?>
parent.selectthisday(<?php echo $_REQUEST['dayId']; ?>,'<?php echo $_REQUEST['dayId']; ?>','<?php echo $sightseeingcheckInDate; ?>');
<?php } else { ?>
parent.loadquotationsightseeing();
<?php } ?>
</script>

<?php
exit();
}









if($_POST['action']=='saveAgentCategoryLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$packageMarginValue=trim(addslashes($_POST['packageMarginValue']));   
$hotelMarginValue=trim(addslashes($_POST['hotelMarginValue']));   
$sightseeingMarginValue=trim(addslashes($_POST['sightseeingMarginValue']));   
$activityMarginValue=trim(addslashes($_POST['activityMarginValue']));   
$cruiseMarginValue=trim(addslashes($_POST['cruiseMarginValue']));   
$currencyId=trim(addslashes($_POST['currencyId']));   
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",packageMarginValue="'.$packageMarginValue.'",hotelMarginValue="'.$hotelMarginValue.'",sightseeingMarginValue="'.$sightseeingMarginValue.'",activityMarginValue="'.$activityMarginValue.'",cruiseMarginValue="'.$cruiseMarginValue.'",currencyId="'.$currencyId.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_agentMarginCategory',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Agent Category Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  
  

$namevalue ='name="'.$name.'",status="'.$status.'",packageMarginValue="'.$packageMarginValue.'",hotelMarginValue="'.$hotelMarginValue.'",sightseeingMarginValue="'.$sightseeingMarginValue.'",activityMarginValue="'.$activityMarginValue.'",currencyId="'.$currencyId.'",cruiseMarginValue="'.$cruiseMarginValue.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_agentMarginCategory',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Agent Category Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}

 

?>
<script>
parent.redirectpage('display.html?ga=agentcategory&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='saveCruiseSeatLibrary' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
  
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  

  
 
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_CruiseSeatMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Cruise Seat Category Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else {  
  

$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",editBy="'.$_SESSION['userid'].'",editDate="'.time().'"';  
addlistinggetlastid('sys_CruiseSeatMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Cruise Seat Category Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 

}

 

?>
<script>
parent.redirectpage('display.html?ga=cruiseseat&save=1');
</script>

<?php
exit();
}






if($_POST['action']=='updateAgentWebsitePages' && $_POST['editid']!="" && $_POST['agentId']!=""){ 
 
$pageName=trim(addslashes($_POST['pageName']));   
$pageTitle=trim(addslashes($_POST['pageTitle']));   
$pageDescription=trim(addslashes($_POST['pageDescription']));    
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  



$namevalue ='pageName="'.$pageName.'",pageTitle="'.$pageTitle.'",pageDescription="'.$pageDescription.'",status="'.$status.'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_agentWebsitePages',$namevalue,$where); 

 
 

?>
<script>
parent.redirectpage('display.html?ga=agents&id=<?php echo $_POST['agentId']; ?>&add=1');
</script>

<?php
exit();
}




if($_POST['action']=='addNewsEvents' && $_POST['agentId']!=""){ 
   
$oldimage=trim(addslashes($_POST['oldimage']));   
$title=trim(addslashes($_POST['title']));   
$description=trim(addslashes($_POST['description']));    
$status=trim(addslashes($_POST['status']));  
$editid=trim(addslashes($_POST['editid']));  


if($_FILES["image"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$imageFileName=basename($_FILES['image']['name']); 

$imageFileExtension=pathinfo($imageFileName, PATHINFO_EXTENSION);  
$image=time().$rt.'.'.$imageFileExtension; 

move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$image}"); 
}

if($image==''){ 
$image=$oldimage; 
}

if($_POST['editid']!=''){ 
$namevalue ='image="'.$image.'",parentId="'.$_SESSION['userid'].'",title="'.$title.'",description="'.$description.'",status="'.$status.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_agentNewsEvents',$namevalue,$where); 

}else{


$namevalue ='image="'.$image.'",agentId="'.decode($_POST['agentId']).'",parentId="'.$_SESSION['userid'].'",title="'.$title.'",description="'.$description.'",status="'.$status.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_agentNewsEvents',$namevalue);  

}




 
 

?>
<script>
parent.redirectpage('display.html?ga=agents&id=<?php echo $_POST['agentId']; ?>&add=1');
</script>

<?php
exit();
}





if($_POST['action']=='addagentgallery' && $_POST['agentId']!=""){ 

$totalImg = count($_FILES["image"]["tmp_name"]);
  
for($i=0; $i<=$totalImg; $i++){
if($_FILES["image"]["tmp_name"][$i]!=""){ 
$rt=time(); 
$companyLogoFileName=basename($_FILES['image']['name'][$i]); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
move_uploaded_file($_FILES["image"]["tmp_name"][$i], "upload/{$profilePhoto}"); 

$namevalue ='name="'.$profilePhoto.'",agentId="'.decode($_POST['agentId']).'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('sys_agentImageGallery',$namevalue);   
}
}
 

?>
<script>
parent.$('#pageName').val(''); 
parent.loadagentgallery('<?php echo $_POST['agentId']; ?>');
</script>

<?php
exit();
}











if($_REQUEST['action']=='deletenewsevent' && $_REQUEST['agentId']!="" && $_REQUEST['deleteId']!=""){ 
     
deleteRecord('sys_agentNewsEvents','id="'.decode($_REQUEST['deleteId']).'"'); 
 

?>
<script>
parent.redirectpage('display.html?ga=agents&id=<?php echo $_REQUEST['agentId']; ?>&add=1');
</script>

<?php
exit();
}




 

if($_POST['action']=='saveFlightName' && $_POST['name']!=""){

$name=addslashes($_POST['name']); 
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']);
$editid=trim(addslashes($_POST['editid'])); 


if($_FILES["companyLogo"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}

if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}

if($_POST['editid']!=''){ 
$namevalue ='name="'.$name.'",parentId="'.$_SESSION['userid'].'",details="'.$companyLogo.'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_flightName',$namevalue,$where); 

}else{


$namevalue ='name="'.$name.'",details="'.$companyLogo.'",parentId="'.$_SESSION['userid'].'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_flightName',$namevalue);  

}


?>
<script>
parent.redirectpage('display.html?ga=flightsname&save=1');
</script>

<?php
exit();
}

if($_POST['action']=='commissiontype' && $_POST['name']!=""){

$name=addslashes($_POST['name']);  

  
if($_POST['editid']!=''){ 
$namevalue ='name="'.$name.'",parentId="'.$_SESSION['userid'].'",details="'.$companyLogo.'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_commissionType',$namevalue,$where); 

}else{


$namevalue ='name="'.$name.'",details="'.$companyLogo.'",parentId="'.$_SESSION['userid'].'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_commissionType',$namevalue);  

}


?>
<script>
parent.redirectpage('display.html?ga=commissiontype&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='addblockflights' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  
$typeid=trim(addslashes($_POST['typeid'])); 

  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('blockFlightMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Block Flight Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 




 




$namevalue ='name="'.$name.'",status="'.$status.'",agentTypeGroupId="'.decode($typeid).'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('blockFlightMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Block Flight Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=blockflights&save=1&typeid=<?php echo $typeid; ?>');
</script>

<?php
exit();
}



if($_POST['action']=='addfaretypeblockflights' && $_POST['name']!=''){ 

$name=addslashes(trim($_POST['name']));  
$sectorType=addslashes(trim($_POST['sectorType']));  
$blockFlightId=decode($_POST['blockFlightId']);
$editid=trim(addslashes($_POST['editid']));
$typeid=trim(addslashes($_POST['typeid'])); 
 

 
if($editid!=''){

$namevalue ='blockFlightId="'.$blockFlightId.'",name="'.$name.'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  blockFlightId="'.$blockFlightId.'"';
updatelisting('fareTypeblockFlightMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypeblockflights',sectionId='".$blockFlightId."',details='Fare Type Block Flights Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='blockFlightId="'.$blockFlightId.'",name="'.$name.'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypeblockFlightMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypeblockflights',sectionId='".$blockFlightId."',details='Fare Type Block Flights Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


$rs6=GetPageRecord('*','sys_userMaster',' userType="agent" '); 
while($agentcate=mysqli_fetch_array($rs6)){  

$namevalue ='agentId="'.$agentcate['id'].'",blockFlightId="'.$blockFlightId.'",name="'.$name.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypeblockFlightMaster',$namevalue);  

}
 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}




if($_POST['action']=='addmanualflights' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$seat=trim(addslashes($_POST['seat']));   
$flightNo=trim(addslashes($_POST['flightNo']));   
$departure=trim(addslashes($_POST['departure']));   
$departureTime=trim(addslashes($_POST['departureTime']));   
$duration=trim(addslashes($_POST['duration']));   
$stops=trim(addslashes($_POST['stops']));   
$arrival=trim(addslashes($_POST['arrival']));   
$arrivalTime=trim(addslashes($_POST['arrivalTime']));   
$baseFare=trim(addslashes($_POST['baseFare']));   
$baggage=trim(addslashes($_POST['baggage']));   
$checkin=trim(addslashes($_POST['checkin']));   
$cabin=trim(addslashes($_POST['cabin']));   
$surchargesTaxes=trim(addslashes($_POST['surchargesTaxes']));   
$flightType=trim(addslashes($_POST['flightType']));   
$status=trim(addslashes($_POST['status']));    
$oldimg=trim(addslashes($_POST['oldimg']));    
$fareType='FIXEDMF';
$flightCode=addslashes($_POST['flightCode']);
$description=addslashes($_POST['description']);
$cancellationPolicy=addslashes($_POST['cancellationPolicy']);
$fromDate=date('Y-m-d', strtotime($_POST['fromDate']));
$toDate=date('Y-m-d', strtotime($_POST['toDate'])); 
$supplierId=addslashes($_POST['supplierId']);
$editid=$_POST['editid'];

if($_FILES["img"]["tmp_name"]!=""){   
$rt=mt_rand().strtotime(date("YMDHis")); 
$imgFileName=basename($_FILES['img']['name']);  
$imgFileExtension=pathinfo($imgFileName, PATHINFO_EXTENSION);  
$img=time().$rt.'.'.$imgFileExtension;  
move_uploaded_file($_FILES["img"]["tmp_name"], "upload/{$img}"); 
}

if($img==''){ 
$img=$oldimg; 
}

  
if($editid!=''){

$namevalue ='name="'.$name.'",flightNo="'.$flightNo.'",img="'.$img.'",departure="'.$departure.'",departureTime="'.$departureTime.'",duration="'.$duration.'",stops="'.$stops.'",arrival="'.$arrival.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",baggage="'.$baggage.'",checkin="'.$checkin.'",cabin="'.$cabin.'",surchargesTaxes="'.$surchargesTaxes.'",flightType="'.$flightType.'",status="'.$status.'",fareType="'.$fareType.'",description="'.$description.'",cancellationPolicy="'.$cancellationPolicy.'",flightCode="'.$flightCode.'",seat="'.$seat.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",supplierId="'.$supplierId.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$LoginUserDetails['parentId'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('manualFlightMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Manual Flight Update',userId='".$_SESSION['userid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','manualFlightMaster',' parentId="'.$LoginUserDetails['parentId'].'" and name="'.$name.'" and flightNo="'.$flightNo.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Manual Flight already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",flightNo="'.$flightNo.'",img="'.$img.'",departure="'.$departure.'",departureTime="'.$departureTime.'",duration="'.$duration.'",stops="'.$stops.'",arrival="'.$arrival.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",baggage="'.$baggage.'",flightCode="'.$flightCode.'",checkin="'.$checkin.'",cabin="'.$cabin.'",surchargesTaxes="'.$surchargesTaxes.'",flightType="'.$flightType.'",status="'.$status.'",parentId="'.$LoginUserDetails['parentId'].'",fareType="'.$fareType.'",seat="'.$seat.'",description="'.$description.'",cancellationPolicy="'.$cancellationPolicy.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",supplierId="'.$supplierId.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('manualFlightMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Manual Flight Added',userId='".$_SESSION['userid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=manualflights&save=1');
</script>

<?php
exit();
}






if($_POST['action']=='addfixeddeparture' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$flightNo=trim(addslashes($_POST['flightNo']));   
$departure=trim(addslashes($_POST['departure']));   
$fromDate=date("Y-m-d",strtotime($_POST['fromDate']));
$toDate=date("Y-m-d",strtotime($_POST['toDate']));  
$departureTime=trim(addslashes($_POST['departureTime']));   
$duration=trim(addslashes($_POST['duration']));   
$stops=trim(addslashes($_POST['stops']));   
$arrival=trim(addslashes($_POST['arrival']));   
$arrivalTime=trim(addslashes($_POST['arrivalTime']));   
$baseFare=trim(addslashes($_POST['baseFare']));   
$baggage=trim(addslashes($_POST['baggage']));   
$checkin=trim(addslashes($_POST['checkin']));   
$cabin=trim(addslashes($_POST['cabin']));   
$surchargesTaxes=trim(addslashes($_POST['surchargesTaxes']));   
$flightType=trim(addslashes($_POST['flightType']));   
$status=trim(addslashes($_POST['status']));    
$oldimg=trim(addslashes($_POST['oldimg']));    
$fareType=addslashes($_POST['fareType']);
$description=addslashes($_POST['description']);
$cancellationPolicy=addslashes($_POST['cancellationPolicy']);
$editid=$_POST['editid'];

if($_FILES["img"]["tmp_name"]!=""){   
$rt=mt_rand().strtotime(date("YMDHis")); 
$imgFileName=basename($_FILES['img']['name']);  
$imgFileExtension=pathinfo($imgFileName, PATHINFO_EXTENSION);  
$img=time().$rt.'.'.$imgFileExtension;  
move_uploaded_file($_FILES["img"]["tmp_name"], "upload/{$img}"); 
}

if($img==''){ 
$img=$oldimg; 
}

  
if($editid!=''){

$namevalue ='name="'.$name.'",flightNo="'.$flightNo.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",img="'.$img.'",departure="'.$departure.'",departureTime="'.$departureTime.'",duration="'.$duration.'",stops="'.$stops.'",arrival="'.$arrival.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",baggage="'.$baggage.'",checkin="'.$checkin.'",cabin="'.$cabin.'",surchargesTaxes="'.$surchargesTaxes.'",flightType="'.$flightType.'",status="'.$status.'",fareType="'.$fareType.'",description="'.$description.'",cancellationPolicy="'.$cancellationPolicy.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('fixedDepartureMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Fixed Departue Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','fixedDepartureMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and flightNo="'.$flightNo.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Fixed departure already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",flightNo="'.$flightNo.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",img="'.$img.'",departure="'.$departure.'",departureTime="'.$departureTime.'",duration="'.$duration.'",stops="'.$stops.'",arrival="'.$arrival.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",baggage="'.$baggage.'",checkin="'.$checkin.'",cabin="'.$cabin.'",surchargesTaxes="'.$surchargesTaxes.'",flightType="'.$flightType.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",fareType="'.$fareType.'",description="'.$description.'",cancellationPolicy="'.$cancellationPolicy.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fixedDepartureMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Fixed departure Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=fixeddeparture&save=1');
</script>

<?php
exit();
}











if($_POST['action']=='adddomesticflightsmarkup' && $_POST['name']!="" && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$typeid=trim(addslashes($_POST['typeid']));  
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  


  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",agentTypeGroupId="'.decode($typeid).'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('domesticFlightsMarkupMaster',$namevalue,$where); 
 

} else { 





$rs7=GetPageRecord('*','domesticFlightsMarkupMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



 




$namevalue ='name="'.$name.'",agentTypeGroupId="'.decode($typeid).'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('domesticFlightsMarkupMaster',$namevalue); 
 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=domesticflightsmarkup&save=1&typeid=<?php echo $_REQUEST['typeid'];?>');
</script>

<?php
exit();
}






if($_POST['action']=='addfaretypedomesticFlightsMarkup' && $_POST['name']!=''){ 


$typeid=trim(addslashes($_POST['typeid']));  
$name=addslashes(trim($_POST['name']));  
$sectorType=addslashes(trim($_POST['sectorType']));  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue']));  
$flightId=decode($_POST['flightId']);
$editid=trim(addslashes($_POST['editid']));
 
 

 
if($editid!=''){

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  flightId="'.$flightId.'"';
updatelisting('fareTypedomesticFlightsMarkupMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypeblockflights',sectionId='".$flightId."',details='Fare Type Domestic Flights Markup Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypedomesticFlightsMarkupMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypeblockflights',sectionId='".$flightId."',details='Fare Type Domestic Flights Markup Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


  

$namevalue ='agentId="'.$_SESSION['userid'].'",agentTypeGroupId="'.decode($typeid).'",flightId="'.$flightId.'",sectorType="'.$sectorType.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticFlightsMarkupMaster',$namevalue);  

 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#markupValue').val(''); 
parent.$('#editid').val('');

parent.window.location.reload();
</script>

<?php
exit();
}


if($_POST['action']=='addinternationalFlightsMarkup' && $_POST['editid']!=''){ 
  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue']));  
$editid=trim(addslashes($_POST['editid']));
 
 

$namevalue ='markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('internationalFlightsMarkupMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='internationalflightsmarkup',sectionId='".decode($_REQUEST['editid'])."',details='International Flights Markup Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 





 

?>
<script>
parent.redirectpage('display.html?ga=internationalflightsmarkup&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='addinternationalFlightsCommission' && $_POST['editid']!=''){ 
  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue']));  
$editid=trim(addslashes($_POST['editid']));
 
 

$namevalue ='markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('internationalFlightsCommissionMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='internationalflightsmarkup',sectionId='".decode($_REQUEST['editid'])."',details='International Flights Commission Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 





 

?>
<script>
parent.redirectpage('display.html?ga=internationalflightscommission&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='adddomesticflightscommission' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  


  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('domesticFlightsCommissionMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Domestic Flights Commission Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','domesticFlightsCommissionMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Flight already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('domesticFlightsCommissionMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Domestic Flights Commission Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=domesticflightscommission&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='addfaretypedomesticFlightscommission' && $_POST['name']!=''){ 

$name=addslashes(trim($_POST['name']));  
$markupType=addslashes(trim($_POST['markupType']));  
$commissionType=addslashes(trim($_POST['commissionType'])); 
$markupValue=addslashes(trim($_POST['markupValue'])); 
$cashBackType=addslashes(trim($_POST['cashBackType']));  
$cashBackValue=addslashes(trim($_POST['cashBackValue']));   
$flightId=decode($_POST['flightId']);
$editid=trim(addslashes($_POST['editid']));
 
 

 
if($editid!=''){

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",commissionType="'.$commissionType.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",cashBackType="'.$cashBackType.'",cashBackValue="'.$cashBackValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  flightId="'.$flightId.'"';
updatelisting('fareTypedomesticFlightsCommissionMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypedomesticFlightscommission',sectionId='".$flightId."',details='Fare Type Domestic Flights Commission Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",commissionType="'.$commissionType.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",cashBackType="'.$cashBackType.'",cashBackValue="'.$cashBackValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypedomesticFlightsCommissionMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypedomesticFlightscommission',sectionId='".$flightId."',details='Fare Type Domestic Flights Commission Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



$rs6=GetPageRecord('*','sys_userMaster',' userType="agent" '); 
while($agentcate=mysqli_fetch_array($rs6)){

$namevalue ='agentId="'.$agentcate['id'].'",flightId="'.$flightId.'",commissionType="'.$commissionType.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",cashBackType="'.$cashBackType.'",cashBackValue="'.$cashBackValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
//addlistinggetlastid('agent_fareTypedomesticFlightsCommissionMaster',$namevalue); 

}
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#markupValue').val(''); 
parent.$('#cashBackValue').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}





if($_POST['action']=='addofflineflightsbooking' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  
$typeid=trim(addslashes($_POST['typeid']));  


  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",agentTypeGroupId="'.decode($typeid).'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('offlineflightsbookingMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Offline Flight Booking Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





 



$namevalue ='name="'.$name.'",status="'.$status.'",agentTypeGroupId="'.decode($typeid).'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('offlineflightsbookingMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Offline Flight Booking Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=offlineflightsbooking&save=1&typeid=<?php echo $typeid; ?>');
</script>

<?php
exit();
}





if($_POST['action']=='addfaretypeofflineflightsbooking' && $_POST['name']!=''){ 

$name=addslashes(trim($_POST['name'])); 
$sectorType=addslashes(trim($_POST['sectorType']));  
$flightId=decode($_POST['flightId']);
$editid=trim(addslashes($_POST['editid']));
 $typeid=trim(addslashes($_POST['typeid']));  
 

 
if($editid!=''){

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  flightId="'.$flightId.'"';
updatelisting('fareTypeofflineflightsbookingMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='fareTypeofflineflightsbooking',sectionId='".$flightId."',details='Fare Type Offline Flights Booking Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypeofflineflightsbookingMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='fareTypeofflineflightsbooking',sectionId='".$flightId."',details='Fare Type Offline Flights Booking Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



$rs6=GetPageRecord('*','sys_userMaster',' userType="agent" '); 
while($agentcate=mysqli_fetch_array($rs6)){  

$namevalue ='agentId="'.$agentcate['id'].'",flightId="'.$flightId.'",name="'.$name.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypeofflineflightsbookingMaster',$namevalue); 

}
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}




if($_POST['action']=='addfaretype' && $_POST['flightName']!=""){
 
$displayType=trim(addslashes($_POST['displayType']));   
$displayColor=trim(addslashes($_POST['displayColor']));   
$flightName=trim(addslashes($_POST['flightName']));   
$fareTypeName=trim(addslashes($_POST['fareTypeName']));   
$description=addslashes($_POST['description']); 
$cancellationPolicy=addslashes($_POST['cancellationPolicy']); 
$b2cDescription=addslashes($_POST['b2cDescription']); 
$b2cCancellationPolicy=addslashes($_POST['b2cCancellationPolicy']); 
 $editid=$_POST['editid'];

  
if($editid!=''){

$namevalue ='flightName="'.$flightName.'",fareTypeName="'.$fareTypeName.'",description="'.$description.'",b2cDescription="'.$b2cDescription.'",b2cCancellationPolicy="'.$b2cCancellationPolicy.'",cancellationPolicy="'.$cancellationPolicy.'",displayType="'.$displayType.'",displayColor="'.$displayColor.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('fareTypeMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretype',details='".$name." Fare Type Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','fareTypeMaster',' parentId="'.$_SESSION['userid'].'" and flightName="'.$flightName.'" and fareTypeName="'.$fareTypeName.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Manual Flight already exists.');
</script>
<?php
exit();
}

 


$namevalue ='flightName="'.$flightName.'",fareTypeName="'.$fareTypeName.'",description="'.$description.'",b2cDescription="'.$b2cDescription.'",b2cCancellationPolicy="'.$b2cCancellationPolicy.'",cancellationPolicy="'.$cancellationPolicy.'",displayType="'.$displayType.'",parentId="'.$_SESSION['userid'].'",displayColor="'.$displayColor.'",addBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypeMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretype',details='".$name." Fare Type Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=faretype&save=1');
</script>

<?php
exit();
}

if($_POST['action']=='addmarketingcategory' && $_POST['title']!=""){
 
$title=trim(addslashes($_POST['title']));   
$status=trim(addslashes($_POST['status']));
$editid=$_POST['editid'];

if($editid!=''){
$namevalue ='title="'.$title.'",status="'.$status.'",editDate="'.date('Y-m-d H:i:s').'"';
$where='id="'.decode($_REQUEST['editid']).'"';
updatelisting('marketingCategory',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='marketingcategory',details='".$title." Marketing Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";
} else {
$rs7=GetPageRecord('*','marketingCategory',' title="'.$title.'"'); 
$hotelhave=mysqli_fetch_array($rs7);
if($hotelhave['id']!=''){
?>
<script>
alert('This Category already exists.');
</script>
<?php
exit();
}
$namevalue = 'title="'.$title.'",status="'.$status.'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('marketingCategory',$namevalue);
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='marketingCategory',details='".$name." Marketing Category Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db()));
} 
?>
<script>
parent.redirectpage('display.html?ga=marketingcategory&save=1');
</script>

<?php
exit();
}



if($_POST['action']=='updatePNR' && $_POST['editid']!=''){ 
 
$pnrNo=trim(addslashes($_POST['pnrNo']));  
$supplier=trim(addslashes($_POST['supplier']));  
$type=trim(addslashes($_POST['type']));  
$status=trim(addslashes($_POST['status']));  
$remark=trim(addslashes($_POST['remark']));  
$editid=$_POST['editid']; 

if($type=="online"){
	$url="flightbooking";
}else{
	$url="offlineflightbooking";
}

$namevalue ='pnrNo="'.$pnrNo.'",supplier="'.$supplier.'",remark="'.$remark.'",status="'.$status.'",updateDatePNR="'.date('Y-m-d H:i:s').'"'; 

$where=' id="'.decode($_REQUEST['editid']).'"';
updatelisting('flightBookingMaster',$namevalue,$where);

//Update Ticket No. Passangers wise ->flightBookingPaxDetailMaster
$count=count($_POST["rowId"]);

for($i=0;$i<$count;$i++){
$namevalue1 ='ticketNo="'.addslashes($_POST["ticketNo"][$i]).'"'; 
$where1=' id="'.$_POST["rowId"][$i].'"';
updatelisting('flightBookingPaxDetailMaster',$namevalue1,$where1);	
}


if($status=="2"){
 
 sendtickettomail($websiteurl,$_REQUEST['editid']);
}

 

if($status=="4"){ 
/*
*For Reject
*Reverse Balance to Agent Account
*Fetch Previous Balance Details
*/
$prvBalance=GetPageRecord('*','sys_balanceSheet',' bookingId="'.decode($_REQUEST['editid']).'" order by id asc'); 
while($prvBalanceData=mysqli_fetch_array($prvBalance)){
	$agentId=$prvBalanceData["agentId"];
	$SubAgentId=$prvBalanceData["SubAgentId"];
	$amount=$prvBalanceData["amount"];
	$paymentMethod=$prvBalanceData["paymentMethod"];
	$transactionId=$prvBalanceData["transactionId"];
	$attachment=$prvBalanceData["attachment"];
	$bookingId=$prvBalanceData["bookingId"];
	$bookingType=$prvBalanceData["bookingType"];
	$offlineAgent=$prvBalanceData["offlineAgent"];
	
	if($prvBalanceData["paymentType"]=="Debit"){
		$paymentType="Credit";
	}
	
	if($prvBalanceData["paymentType"]=="Credit"){
		$paymentType="Debit";
	}
	
//Insert Reverse Entry in BalanceSheet
$namevalue ='agentId="'.$agentId.'",SubAgentId="'.$SubAgentId.'",amount="'.$amount.'", remarks="Rejected",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",attachment="'.$attachment.'",paymentType="'.$paymentType.'",bookingId="'.$bookingId.'",bookingType="'.$bookingType.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",offlineAgent="'.$offlineAgent.'"';  
addlistinggetlastid('sys_balanceSheet',$namevalue); 	
	
}
}
 
 

 
?>
<script>
parent.redirectpage('display.html?ga=<?php echo $url; ?>&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='addNewTransaction' && $_POST['agentId']!=''){ 
 
  $amount=trim(addslashes($_POST['amount']));   
  $paymentType=trim(addslashes($_POST['paymentType']));  
  $paymentMethod=trim(addslashes($_POST['paymentMethod']));  
  $transactionId=trim(addslashes($_POST['transactionId']));  
  $remark=trim(addslashes($_POST['remark']));   
  
   
  
  
  if($_FILES["companyLogo"]["tmp_name"]!=""){   
  $rt=mt_rand().strtotime(date("YMDHis")); 
  $companyLogoFileName=basename($_FILES['companyLogo']['name']);   
  $companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
  $companyLogo=time().$rt.'.'.$companyLogoFileExtension;  
  move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
  }
  
  
    
  $agentId=decode($_POST['agentId']);
  
   
  
  $rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_transfer_balance','to_agent_id="'.$_SESSION['userid'].'"');
  
  $agentCreditAmt=mysqli_fetch_array($rs8); 
   
  
  $rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_transfer_balance','from_agent_id="'.$_SESSION['userid'].'"');
  $agentDebitAmt=mysqli_fetch_array($rs8); 
  // echo "Debit Amount"  .$agentDebitAmt['totaldebitAmt'];
  
  $totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
  if($amount > $totalwalletBalance)
  {
    echo '<script>
    alert("Insufficient Funds: Sorry, you don\'t have enough balance in your wallet to complete this transaction");
    </script>';
  }
  
  else if($totalwalletBalance > 0)
  {
  
    $namevalue ='agentId="'.$agentId.'",amount="'.$amount.'",paymentType="'.$paymentType.'",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",remarks="'.$remark.'",attachment="'.$companyLogo.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
    addlistinggetlastid('sys_balanceSheet',$namevalue); 
    
    
    $namevalue1 ='to_agent_id="'.$agentId.'",from_agent_id="'.$_SESSION['userid'].'",amount="'.$amount.'",creditFromDate="'.$creditFromDate.'",credittoDate="'.$credittoDate.'",remarks="'.$remark.'",addDate="'.date('Y-m-d H:i:s').'"';  
    addlistinggetlastid('sys_transfer_balance',$namevalue1); 
  ?>
    <script>
    //parent.redirectpage('display.html?ga=agents&id=<?php echo $_POST['agentId']; ?>&view=1&save=1');
    parent.redirectpage('display.html?ga=agents');
    </script>
  
  <?php 
  
  }
  else
  {
  
  ?>
  
  <script>
  alert('No Balance');
  </script>
  
  <?php 
  
  }
  
  ?>
  
  <?php
  exit();
  }
  



if($_POST['action']=='addsmsTemplate' && $_POST['title']!=""){ 
 
$title=trim(addslashes($_POST['title']));   
$content=trim(addslashes($_POST['content']));
$status=trim(addslashes($_POST['status']));
$editid=$_POST['editid'];
 
if($editid!=''){
$namevalue ='title="'.$title.'",content="'.$content.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 
$where='id="'.decode($_REQUEST['editid']).'"';
updatelisting('sys_smsTemplate',$namevalue,$where);

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='smsTemplate',details='".$name." SMS Template Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
}else{ 

$rs7=GetPageRecord('*','sys_smsTemplate',' title="'.$title.'"'); 
$hotelhave=mysqli_fetch_array($rs7);
if($hotelhave['id']!=''){
?>
<script>
alert('SMS template title already exists.');
</script>
<?php
exit();
}

$namevalue ='title="'.$title.'",content="'.$content.'",status="'.$status.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_smsTemplate',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='smsTemplate',details='".$name." SMS Template Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=smstemplate&save=1');
</script>

<?php
exit();
}










if($_POST['action']=='addquotationgallery' && $_POST['quotationId']!=""){ 
 
$quotationId=decode($_POST["quotationId"]);

$countimg=count($_FILES["images"]["tmp_name"]);
//deleteRecord('homeAboutSliderImg','1');

for($i=0; $i<$countimg; $i++){
if($_FILES["images"]["tmp_name"][$i]!=""){

$rt=mt_rand().strtotime(time()); 
$FileName=basename($_FILES['images']['name'][$i]); 
$FileExtension=pathinfo($FileName, PATHINFO_EXTENSION); 
$file=str_replace(' ','_',time().$rt.'.'.$FileExtension); 
move_uploaded_file($_FILES["images"]["tmp_name"][$i], "upload/{$file}");

$namevalueImg ='quotationId="'.$quotationId.'",img="'.$file.'"';  
addlistinggetlastid('quotationGallery',$namevalueImg);  
}
}

?>
<script>
parent.redirectpage('display.html?ga=quotation&add=1&id=<?php echo trim($_POST['quotationId']); ?>&save=1');
</script>

<?php
exit();
}


if(trim($_REQUEST['action'])=='deleteQuotationGallery' && trim($_REQUEST['id'])!=''){
deleteRecord('quotationGallery','id="'.decode($_REQUEST['id']).'"');
?>
<script> 
window.location.href='display.html?ga=quotation&id=<?php echo trim($_REQUEST['quotationId']); ?>&add=1&delete=1';
</script>
<?php
}





if($_POST['action']=='adddomestichotelsmarkup' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  


  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('domesticHotelMarkupMaster',$namevalue,$where); 
 

} else { 





$rs7=GetPageRecord('*','domesticHotelMarkupMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Hotel already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('domesticHotelMarkupMaster',$namevalue); 
 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=domestichotelsmarkup&save=1');
</script>

<?php
exit();
}




if($_POST['action']=='addfaretypedomesticHotelMarkup' && $_POST['markupValue']!=''){ 

$name=addslashes(trim($_POST['name']));  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue']));  
$hotelId=decode($_POST['hotelId']);
$editid=trim(addslashes($_POST['editid']));
 
 

 
if($editid!=''){

$namevalue ='hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  hotelId="'.$hotelId.'"';
updatelisting('fareTypedomesticHotelMarkupMaster',$namevalue,$where); 
 

} else { 
  

$namevalue ='hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypedomesticHotelMarkupMaster',$namevalue); 
 

$rs6=GetPageRecord('*','sys_userMaster',' userType="agent" limit 0,1'); 
while($agentcate=mysqli_fetch_array($rs6)){   

$namevalue ='agentId="'.$agentcate['id'].'",hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticHotelsMarkupMaster',$namevalue);  

}
 

} 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#markupValue').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}



if($_POST['action']=='adddomestichotelscommission' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  


  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('domesticHotelsCommissionMaster',$namevalue,$where); 
 

} else { 





$rs7=GetPageRecord('*','domesticHotelsCommissionMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Flight already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('domesticHotelsCommissionMaster',$namevalue); 
 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=domestichotelscommission&save=1');
</script>

<?php
exit();
}





if($_POST['action']=='fareTypedomesticHotelsCommissionMaster' && $_POST['markupValue']!=''){ 

$name=addslashes(trim($_POST['name']));  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue']));  
$hotelId=decode($_POST['hotelId']);
$editid=trim(addslashes($_POST['editid']));
 
 

 
if($editid!=''){

$namevalue ='hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and  hotelId="'.$hotelId.'"';
updatelisting('fareTypedomesticHotelsCommissionMaster',$namevalue,$where); 
 

} else { 
  

$namevalue ='hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fareTypedomesticHotelsCommissionMaster',$namevalue); 
 



$rs6=GetPageRecord('*','sys_userMaster',' userType="agent" '); 
while($agentcate=mysqli_fetch_array($rs6)){

$namevalue ='agentId="'.$agentcate['id'].'",hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticHotelsCommissionMaster',$namevalue); 

}
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#markupValue').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}




if($_POST['action']=='callbackrequest' && $_POST['editid']!=""){ 
 
$status=$_POST["status"];
echo $editid=decode($_POST["editid"]);

$namevalue ='status="'.$status.'",editDate="'.date('Y-m-d H:i:s').'"';
$where='id="'.$editid.'"';
updatelisting('callBackRequest',$namevalue,$where); 
?>
<script>
parent.redirectpage('display.html?ga=callbackrequest&save=1');
</script>
<?php
exit();
}



if($_POST['action']=='hotelcancelrequest' && $_POST['editid']!=""){ 

$status=$_POST["status"];
$adminRemark=$_POST["adminRemark"];
$editid=decode($_POST["editid"]);

$namevalue ='adminRemark="'.$adminRemark.'",status="'.$status.'",editDate="'.date('Y-m-d H:i:s').'"';
$where='id="'.$editid.'"';
updatelisting('hotelCancelRequest',$namevalue,$where); 
?>
<script>
parent.redirectpage('display.html?ga=hotelcancelrequest&save=1');
</script>
<?php
exit();
}


if($_POST['action']=='ticketcancelrequest' && $_POST['editid']!=""){ 
 
$adminRemark=$_POST["adminRemark"];
$status=$_POST["status"];
$editid=decode($_POST["editid"]);

$namevalue ='adminRemark="'.$adminRemark.'",status="'.$status.'",editDate="'.date('Y-m-d H:i:s').'"';
$where='id="'.$editid.'"';
updatelisting('ticketCancelRequest',$namevalue,$where); 
?>
<script>
parent.redirectpage('display.html?ga=ticketcancelrequest&save=1');
</script>
<?php
exit();
}


if($_REQUEST['action']=='packagemarkup' && $_REQUEST['markup']!='' && $_REQUEST['packageId']!=''){

$markup=$_REQUEST['markup'];
$markupb2c=$_REQUEST['markupb2c'];
$packageId=decode($_REQUEST['packageId']); 

$rs5=GetPageRecord('*','packageMarkup',' 1 and packageId="'.$packageId.'" and agentId=0 '); 
$editresult=mysqli_fetch_array($rs5);

if($editresult['id']!=''){

$namevalue ='markupValue="'.$markup.'",markupb2c="'.$markupb2c.'"';  
$where='packageId="'.$packageId.'" and agentId=0';
updatelisting('packageMarkup',$namevalue,$where); 

} else {

$namevalue ='markupValue="'.$markup.'",markupb2c="'.$markupb2c.'",agentId=0,packageId="'.$packageId.'"';  
addlistinggetlastid('packageMarkup',$namevalue); 

}

}





















if($_POST['action']=='addagentfaretypedomesticFlightsMarkup' && $_POST['name']!=''){ 

$name=addslashes(trim($_POST['name']));  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue']));  
$flightId=decode($_POST['flightId']);
$editid=trim(addslashes($_POST['editid']));
 
 

 
if($editid!=''){

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and agentId="'.decode($_REQUEST['agentId']).'" and flightId="'.$flightId.'"';
updatelisting('agent_fareTypedomesticFlightsMarkupMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypeblockflights',sectionId='".$flightId."',details='Fare Type Domestic Flights Markup Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='agentId="'.decode($_REQUEST['agentId']).'",flightId="'.$flightId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticFlightsMarkupMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='faretypeblockflights',sectionId='".$flightId."',details='Fare Type Domestic Flights Markup Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#markupValue').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}




if($_POST['action']=='addagentfaretypedomesticFlightscommission' && $_POST['name']!=''){ 

$name=addslashes(trim($_POST['name']));  
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue'])); 
$cashBackType=addslashes(trim($_POST['cashBackType']));  
$cashBackValue=addslashes(trim($_POST['cashBackValue']));   
$flightId=decode($_POST['flightId']);
$editid=trim(addslashes($_POST['editid']));
$agentId=trim(addslashes($_POST['agentId']));
 
 

 
if($editid!=''){

$namevalue ='flightId="'.$flightId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",cashBackType="'.$cashBackType.'",cashBackValue="'.$cashBackValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'" and agentId="'.decode($_REQUEST['agentId']).'" and  flightId="'.$flightId.'"';
updatelisting('agent_fareTypedomesticFlightsCommissionMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='agent_faretypedomesticFlightscommission',sectionId='".$flightId."',details='Fare Type Domestic Flights Commission Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 



} else { 
  

$namevalue ='agentId="'.decode($_REQUEST['agentId']).'",flightId="'.$flightId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",cashBackType="'.$cashBackType.'",cashBackValue="'.$cashBackValue.'",parentId="'.$_SESSION['userid'].'",addBy="1",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('agent_fareTypedomesticFlightsCommissionMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='agent_faretypedomesticFlightscommission',sectionId='".$flightId."',details='Fare Type Domestic Flights Commission Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


 
 

}


 

?>
<script>
alert('Saved Successfully!');
parent.$('#name').val(''); 
parent.$('#markupValue').val(''); 
parent.$('#cashBackValue').val(''); 
parent.$('#editid').val('');

parent.loadcrusecost();
</script>

<?php
exit();
}





if($_REQUEST['action']=='savepickedby' && $_REQUEST['id']!=''){ 

$pickedBy=addslashes(trim($_REQUEST['pickedBy']));   
$id=trim(addslashes($_REQUEST['id'])); 

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and pickedBy>0 '); 
if(mysqli_num_rows($a)>0){

?>
<script>
alert('Already Picked...!'); 
</script>
<?php 
}else{


if($pickedBy==0){
$namevalue ='pickedBy="0"';  
$where=' id="'.decode($_REQUEST['id']).'"';
updatelisting('flightBookingMaster',$namevalue,$where);
}

if($pickedBy==1){
$namevalue ='pickedBy="'.$_SESSION['userid'].'"';  
$where=' id="'.decode($_REQUEST['id']).'"';
updatelisting('flightBookingMaster',$namevalue,$where);
}

}

 

?>
 <script> 
parent.location.reload();
</script>

<?php
exit();
}








if($_POST['action']=='weekendgetawayslocation' && $_POST['name']!=""){

$name=addslashes($_POST['name']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);
$oldcompanyLogo=addslashes($_POST['oldimg']);



if($_FILES["companyLogo"]["tmp_name"]!=""){   
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']);  
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}

if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}
 


if($editid!=''){

//-------EDIT-----------

$namevalue ='name="'.$name.'",status="'.$status.'",img="'.$companyLogo.'",editDate="'.time().'",editBy="'.$_SESSION['userid'].'"'; 

$where='parentId="'.$_SESSION['userid'].'" and id="'.decode($editid).'"';   
updatelisting('weekendGatewayLocationMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='weekendgetawayslocation',details='".$name." Travel Type Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='name="'.$name.'",status="'.$status.'",img="'.$companyLogo.'",addDate="'.time().'",addBy="'.$_SESSION['userid'].'",parentId="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('weekendGatewayLocationMaster',$namevalue);    

 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='weekendgetawayslocation',details='".$name." Travel Type Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

}
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script>
parent.redirectpage('display.html?ga=weekendgetawayslocation&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}





if($_POST['action']=='addofflinehotel' && $_POST['name']!=""){ 
 
$name=trim(addslashes($_POST['name']));   
$editid=trim(addslashes($_POST['editid'])); 
$status=trim(addslashes($_POST['status']));  


  
if($editid!=''){

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('offlinehotelMaster',$namevalue,$where); 
 

} else { 





$rs7=GetPageRecord('*','offlinehotelMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Hotel already exists.');
</script>
<?php
exit();
}




$namevalue ='name="'.$name.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('offlinehotelMaster',$namevalue); 
 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=offlinehotel&save=1');
</script>

<?php
exit();
}






if($_POST['action']=='confirmHotelVoucher' && $_POST['editid']!=''){ 
 
$confirmationNo=trim(addslashes($_POST['confirmationNo']));  
$supplier=trim(addslashes($_POST['supplier']));  
$type=trim(addslashes($_POST['type']));  
$status=trim(addslashes($_POST['status']));  
$confirmedBy=trim(addslashes($_POST['confirmedBy']));  
$remark=trim(addslashes($_POST['remark']));  
$editid=$_POST['editid']; 

if($type=="online"){
	$url="hotelBookings";
}else{
	$url="offlinehotelBookings";
}

$namevalue ='confirmationNo="'.$confirmationNo.'",supplier="'.$supplier.'",remark="'.$remark.'",status="'.$status.'",confirmedBy="'.$confirmedBy.'",confirmedDate="'.date('Y-m-d H:i:s').'"'; 

$where=' id="'.decode($_REQUEST['editid']).'"';
updatelisting('hotelBookingMaster',$namevalue,$where);

//Update Ticket No. Passangers wise ->flightBookingPaxDetailMaster
 
if($status=="4"){ 
/*
*For Reject
*Reverse Balance to Agent Account
*Fetch Previous Balance Details
*/
$prvBalance=GetPageRecord('*','sys_balanceSheet',' bookingId="'.decode($_REQUEST['editid']).'" order by id asc'); 
while($prvBalanceData=mysqli_fetch_array($prvBalance)){
	$agentId=$prvBalanceData["agentId"];
	$SubAgentId=$prvBalanceData["SubAgentId"];
	$amount=$prvBalanceData["amount"];
	$paymentMethod=$prvBalanceData["paymentMethod"];
	$transactionId=$prvBalanceData["transactionId"];
	$attachment=$prvBalanceData["attachment"];
	$bookingId=$prvBalanceData["bookingId"];
	$bookingType=$prvBalanceData["bookingType"];
	$offlineAgent=$prvBalanceData["offlineAgent"];
	
	if($prvBalanceData["paymentType"]=="Debit"){
		$paymentType="Credit";
	}
	
	if($prvBalanceData["paymentType"]=="Credit"){
		$paymentType="Debit";
	}
	
//Insert Reverse Entry in BalanceSheet
$namevalue ='agentId="'.$agentId.'",SubAgentId="'.$SubAgentId.'",amount="'.$amount.'", remarks="Rejected",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",attachment="'.$attachment.'",paymentType="'.$paymentType.'",bookingId="'.$bookingId.'",bookingType="'.$bookingType.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",offlineAgent="'.$offlineAgent.'"';  
addlistinggetlastid('sys_balanceSheet',$namevalue); 	
	
}
}
 
?>
<script>
parent.redirectpage('display.html?ga=<?php echo $url; ?>&save=1');
</script>

<?php
exit();
}


if($_POST['action']=='hotelVouchersendtomail' && trim($_POST['to'])!="" && trim($_POST['editid'])!=""){ 
 
$email=trim(addslashes($_POST['to'])); 
$ta=trim(addslashes($_POST['ticketaction'])); 
$markup=trim(addslashes($_POST['markup'])); 
$subject = 'Hotel Voucher'; 

$mailbody=file_get_contents($fullurl.'hotel_voucher.php?id='.$_REQUEST['editid'].'&sm=1&ta='.$ta.'&markup='.$markup);;

$file_name='';
$ccmail='';
send_attachment_mail($_SESSION['parentid'],$email,$subject,$mailbody,$ccmail,$file_name);




?>
<script>
alert('Mail Sent Successfully...');
parent.redirectpage('display.html?ga=<?php echo $_POST['page']; ?>&save=1');
</script>

<?php
exit();
}



if($_REQUEST['action']=='popactionhide' && trim($_REQUEST['id'])!="" ){ 

if($_REQUEST['type']=='hotel'){ 
$namevalue ='notifyStatus="1"';  
$where=' id="'.decode($_REQUEST['id']).'"';
updatelisting('hotelBookingMaster',$namevalue,$where);
} 


if($_REQUEST['type']=='flight'){ 
$namevalue ='notifyStatus="1"';  
$where=' id="'.decode($_REQUEST['id']).'"';
updatelisting('flightBookingMaster',$namevalue,$where);
} 
exit();
}






if($_REQUEST['action']=='savepickedbyhotel' && $_REQUEST['id']!=''){ 

$pickedBy=addslashes(trim($_REQUEST['pickedBy']));   
$id=trim(addslashes($_REQUEST['id'])); 

$a=GetPageRecord('*','hotelBookingMaster',' id="'.decode($_REQUEST['id']).'" and pickedBy>0 '); 
if(mysqli_num_rows($a)>0){

?>
<script>
alert('Already Picked...!'); 
</script>
<?php 
}else{


if($pickedBy==0){
$namevalue ='pickedBy="0"';  
$where=' id="'.decode($_REQUEST['id']).'"';
updatelisting('hotelBookingMaster',$namevalue,$where);
}

if($pickedBy==1){
$namevalue ='pickedBy="'.$_SESSION['userid'].'"';  
$where=' id="'.decode($_REQUEST['id']).'"';
updatelisting('hotelBookingMaster',$namevalue,$where);
}

}

 

?>
 <script> 
parent.location.reload();
</script>

<?php
exit();
}








if($_POST['action']=='addfixeddeparturenew' && $_POST['name']!=""){ 


$sector=trim(addslashes($_POST['sector'])); 
$name=trim(addslashes($_POST['name']));   
$flightNo=trim(addslashes($_POST['flightNo'])); 
$fromDate=date("Y-m-d",strtotime($_POST['fromDate']));
$toDate=date("Y-m-d",strtotime($_POST['toDate'])); 
$departureTime=trim(addslashes($_POST['departureTime'])); 
$arrivalTime=trim(addslashes($_POST['arrivalTime'])); 
$totalSeats=trim(addslashes($_POST['totalSeats'])); 
$baseFare=trim(addslashes($_POST['baseFare'])); 
$status=trim(addslashes($_POST['status']));  
 

$editid=$_POST['editid']; 
  
if($editid!=''){

$namevalue ='sector="'.$sector.'",name="'.$name.'",flightNo="'.$flightNo.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",departureTime="'.$departureTime.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",totalSeats="'.$totalSeats.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['userid'].'" and  id="'.decode($_REQUEST['editid']).'"';
updatelisting('fixedDepartureMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$sector." Fixed Departue Update',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 

} else { 





$rs7=GetPageRecord('*','fixedDepartureMaster',' parentId="'.$_SESSION['userid'].'" and name="'.$name.'" and flightNo="'.$flightNo.'" and sector="'.$sector.'"'); 
$hotelhave=mysqli_fetch_array($rs7);



if($hotelhave['id']!=''){
?>
<script>
alert('This Fixed departure already exists.');
</script>
<?php
exit();
}




$namevalue ='sector="'.$sector.'",name="'.$name.'",flightNo="'.$flightNo.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",departureTime="'.$departureTime.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",totalSeats="'.$totalSeats.'",status="'.$status.'",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('fixedDepartureMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='master',details='".$name." Fixed departure Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
} 
?>
<script>
parent.redirectpage('display.html?ga=fixeddeparture&save=1');
</script>

<?php
exit();

}






if($_POST['action']=='Importfixeddeparturenew'){  


 $n=1;
 $file = $_FILES["img"]["tmp_name"];
 $file_open = fopen($file,"r");
 while(($Row = fgetcsv($file_open, 1000, ",")) !== false)
 { 
 
	$sector = trim($Row[0]);  
	$name = trim($Row[1]);  
	$flightNo = trim($Row[2]);  
	$fromDate = date('Y-m-d', strtotime(trim($Row[3])));  
	$toDate = date('Y-m-d', strtotime(trim($Row[4])));
	$departureTime = trim($Row[5]);  
	$arrivalTime = trim($Row[6]);  
	$totalSeats = trim($Row[7]);  
	$baseFare = trim($Row[8]);    
	
	
	if($sector!='' && $name!='' && $n!=1){  
	  $namevalue ='sector="'.$sector.'",name="'.$name.'",flightNo="'.$flightNo.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",departureTime="'.$departureTime.'",arrivalTime="'.$arrivalTime.'",baseFare="'.$baseFare.'",totalSeats="'.$totalSeats.'",status="1",parentId="'.$_SESSION['userid'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
	addlistinggetlastid('fixedDepartureMaster',$namevalue); 
	}    
  $n++;
 }
  
?> 

<script> 
parent.redirectpage('display.html?ga=fixeddeparture&save=1'); 
 </script> 
<?php 
}



if($_POST['action']=='addcontentpages' && $_REQUEST['title']!=''){

$title=addslashes($_POST['title']);
$dealtype=addslashes($_POST['dealtype']);
$url=addslashes($_POST['url']);
$description=addslashes($_POST['description']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

$sql='';
if($_FILES["image"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis"));
$companyLogoFileName=basename($_FILES['image']['name']);
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;
move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$companyLogo}"); 
$sql.=',image="'.$companyLogo.'"';
}


if($editid!=''){
//-------EDIT-----------

$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
$where='id="'.decode($editid).'"';   
updatelisting('sys_contentPages',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Content Page Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."' "; 

} else { 

//-------ADD----------- 
$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
 
$lastid=addlistinggetlastid('sys_contentPages',$namevalue);   
 
$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='user',details='".$name." Content Page Added',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";    
}

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 


?>
<script>
parent.redirectpage('display.html?ga=contentpages&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}










if($_POST['action']=='addtestimonial'){

$title=addslashes($_POST['title']); 
$description=addslashes($_POST['description']);
$destination=addslashes($_POST['destination']);
$name=addslashes($_POST['name']);
$dateoftravel=date('Y-m-d',strtotime($_POST['dateoftravel']));
$starRating=addslashes($_POST['starRating']); 
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

  
if($editid!=''){
//-------EDIT-----------

$namevalue ='title="'.$title.'",description="'.$description.'",name="'.$name.'",starRating="'.$starRating.'",status="'.$status.'",destination="'.$destination.'",dateoftravel="'.$dateoftravel.'"'; 
$where='id="'.decode($editid).'"';   
updatelisting('sys_testimonials',$namevalue,$where); 

 

} else { 

//-------ADD----------- 
$namevalue ='title="'.$title.'",description="'.$description.'",name="'.$name.'",starRating="'.$starRating.'",destination="'.$destination.'",status="'.$status.'",dateoftravel="'.$dateoftravel.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_testimonials',$namevalue);   
 
}
?>
 
<script>
parent.redirectpage('display.html?ga=testimonials&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}













if($_POST['action']=='savewebsitesetting'){

$metaTitle=addslashes($_POST['metaTitle']);
$metaKeyword=addslashes($_POST['metaKeyword']);
$metaDescription=addslashes($_POST['metaDescription']);
$headerScript=addslashes($_POST['headerScript']);
$footerScript=addslashes($_POST['footerScript']);
$whatsAppNumber=addslashes($_POST['whatsAppNumber']); 
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']);



if($_FILES["companyLogo"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}

if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}


$namevalue ='metaTitle="'.$metaTitle.'",metaKeyword="'.$metaKeyword.'",metaDescription="'.$metaDescription.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",whatsAppNumber="'.$whatsAppNumber.'",websiteFavicon="'.$companyLogo.'"'; 
$where='id=1';   
updatelisting('websiteSetting',$namevalue,$where);  


$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='updatewebsitesetting',details='Website Setting Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'"; 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

?>
<script>
parent.redirectpage('display.html?ga=websitesetting&save=1&<?php echo $companyLogo; ?>');
</script>

<?php
exit();
}







 


if($_POST['action']=='addblog' && $_REQUEST['title']!=''){

$title=addslashes($_POST['title']);
$dealtype=addslashes($_POST['dealtype']);
$url=addslashes($_POST['url']);
$description=addslashes($_POST['description']);
$status=addslashes($_POST['status']);
$editid=addslashes($_POST['editid']);

$sql='';
if($_FILES["image"]["tmp_name"]!=""){
$rt=mt_rand().strtotime(date("YMDHis"));
$companyLogoFileName=basename($_FILES['image']['name']);
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;
move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$companyLogo}"); 
$sql.=',image="'.$companyLogo.'"';
}


if($editid!=''){
//-------EDIT-----------

$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
$where='id="'.decode($editid).'"';   
updatelisting('sys_blog',$namevalue,$where); 

 

} else { 

//-------ADD----------- 
 $namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 
 
$lastid=addlistinggetlastid('sys_blog',$namevalue);   
 
 
}

 

 


?>
<script>
parent.redirectpage('display.html?ga=blog&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}







if($_POST['action']=='flightapisetting'){


$namevalue ='kafilaAPIOneWay="'.$_REQUEST['kafilaAPIOneWay'].'",kafilaAPIRoundTrip="'.$_REQUEST['kafilaAPIRoundTrip'].'",tboAPIOneWay="'.$_REQUEST['tboAPIOneWay'].'",tboAPIRoundTrip="'.$_REQUEST['tboAPIRoundTrip'].'",fixedGF="'.$_REQUEST['fixedGF'].'",fixedAK="'.$_REQUEST['fixedAK'].'"  '; 
$where='id=1';   
updatelisting('sys_userMaster',$namevalue,$where); 
?>
<script>
alert('Fligt API Setting Changed!');
parent.$('#loadingwhite').hide();
</script>
<?php
}

if($_REQUEST['action']=='addduplicateitinerary' && $_REQUEST['id']!=""){

$rs=GetPageRecord('*','quotationMaster','  id="'.$_REQUEST['id'].'"');
$qtdata=mysqli_fetch_array($rs);




$namevalue ='startDate="'.$qtdata['startDate'].'",endDate="'.$qtdata['endDate'].'",packageItinerary="'.$qtdata['packageItinerary'].'",name="'.$qtdata['name'].'",bannerImg="'.$qtdata['bannerImg'].'",travelFromCity="'.$qtdata['travelFromCity'].'",travelLocation="'.$qtdata['travelLocation'].'",quotationCost="'.$qtdata['quotationCost'].'",status="'.$qtdata['status'].'",packageTheme="'.$qtdata['packageTheme'].'",nights="'.$qtdata['nights'].'",destination="'.$qtdata['destination'].'",dayWise="'.$qtdata['dayWise'].'",showOnWebsite="'.$qtdata['showOnWebsite'].'",features="'.$qtdata['features'].'",flighticon="'.$qtdata['flighticon'].'",hotelicon="'.$qtdata['hotelicon'].'",sightseeingicon="'.$qtdata['sightseeingicon'].'",transfericon="'.$qtdata['transfericon'].'",activityicon="'.$qtdata['activityicon'].'",cruiseicon="'.$qtdata['cruiseicon'].'",weekendGatewayLocationId="'.$qtdata['weekendGatewayLocationId'].'",adult=1,child=0,infant=0,quotationType="Detailed Package",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['userid'].'"'; 

$lastid=addlistinggetlastid('quotationMaster',$namevalue);  

 

$ha=GetPageRecord('*','quotationTerms','  quotationId="'.$_REQUEST['id'].'"');
while($listdata=mysqli_fetch_array($ha)){ 

$namevalue ='termType="'.$listdata['termType'].'",termDescription="'.addslashes($listdata['termDescription']).'",quotationId="'.$lastid.'",parentId="'.$_SESSION['userid'].'"';  
addlistinggetlastid('quotationTerms',$namevalue); 

}


$rs=GetPageRecord('*','sys_quickPackageOptions','  quotationId="'.$_REQUEST['id'].'"');
$qtdataoptions=mysqli_fetch_array($rs);



  $namevalue ='quotationId="'.$lastid.'",queryId="'.addslashes($qtdataoptions['queryId']).'",perPerson="'.addslashes($qtdataoptions['perPerson']).'",quotationCost="'.addslashes($qtdataoptions['quotationCost']).'",serviceMarkup="'.addslashes($qtdataoptions['serviceMarkup']).'",quotationCostWithTax="'.addslashes($qtdataoptions['quotationCostWithTax']).'",perAdult="'.addslashes($qtdataoptions['perAdult']).'",perChild="'.addslashes($qtdataoptions['perChild']).'",quotationChildMarkup="'.addslashes($qtdataoptions['quotationChildMarkup']).'",currencyId="'.addslashes($qtdataoptions['currencyId']).'",CGST="'.addslashes($qtdataoptions['CGST']).'",SGST="'.addslashes($listdata['SGST']).'",IGST="'.addslashes($qtdataoptions['IGST']).'",TCS="'.addslashes($qtdataoptions['TCS']).'",CGSTValue="'.addslashes($qtdataoptions['CGSTValue']).'",SGSTValue="'.addslashes($qtdataoptions['SGSTValue']).'",IGSTValue="'.addslashes($qtdataoptions['IGSTValue']).'",TCSValue="'.addslashes($qtdataoptions['TCSValue']).'",CGSTamount="'.addslashes($qtdataoptions['CGSTamount']).'",IGSTamount="'.addslashes($qtdataoptions['IGSTamount']).'",TCSamount="'.addslashes($qtdataoptions['TCSamount']).'",taxApply="'.addslashes($qtdataoptions['taxApply']).'",showTaxDetails="'.addslashes($qtdataoptions['showTaxDetails']).'",parentId="'.$_SESSION['userid'].'"';  
addlistinggetlastid('sys_quickPackageOptions',$namevalue); 



$haa=GetPageRecord('*','quotationGallery','  quotationId="'.$_REQUEST['id'].'" order by id asc');
while($listdataimg=mysqli_fetch_array($haa)){ 

$namevalue ='img="'.$listdataimg['img'].'",quotationId="'.$lastid.'"';  
addlistinggetlastid('quotationGallery',$namevalue); 
}
 
 
 
 $haaa=GetPageRecord('*','packageDays','  quotationId="'.$_REQUEST['id'].'" order by id asc');
while($listdatadays=mysqli_fetch_array($haaa)){ 

$namevalue ='quotationId="'.$lastid.'",parentId="'.$listdatadays['parentId'].'",title="'.$listdatadays['title'].'",description="'.$listdatadays['description'].'",dayId="'.$listdatadays['dayId'].'",destinationId="'.$listdatadays['destinationId'].'",dayDate="'.$listdatadays['dayDate'].'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
$lastdayid=addlistinggetlastid('packageDays',$namevalue); 



/*
 $haaas=GetPageRecord('*','quotationEvents','  quotationId="'.$_REQUEST['id'].'" and dayId="'.$listdatadays['dayId'].'" order by id asc');
while($listdataevent=mysqli_fetch_array($haaas)){ 

  $namevalue ='quotationId="'.$lastid.'",parentId="'.$listdataevent['parentId'].'",optionId="'.$listdataevent['optionId'].'",name="'.$listdataevent['name'].'",eventDuration="'.$listdataevent['eventDuration'].'",category="'.$listdataevent['category'].'",roomCategory="'.$listdataevent['roomCategory'].'",roomType="'.$listdataevent['roomType'].'",mealPlan="'.$listdataevent['mealPlan'].'",mealPlanCost="'.$listdataevent['mealPlanCost'].'",cityId="'.$listdataevent['cityId'].'",toCityId="'.$listdataevent['toCityId'].'",eventPhoto="'.$listdataevent['eventPhoto'].'",checkInDate="'.$listdataevent['checkInDate'].'",checkOutDate="'.$listdataevent['checkOutDate'].'",checkInTime="'.$listdataevent['checkInTime'].'",checkOutTime="'.$listdataevent['checkOutTime'].'",eventType="'.$listdataevent['eventType'].'",transportType="'.$listdataevent['transportType'].'",trainClass="'.$listdataevent['trainClass'].'",eventDetails="'.$listdataevent['eventDetails'].'",viaFlightDeparture="'.$listdataevent['viaFlightDeparture'].'",viaFlightReturn="'.$listdataevent['viaFlightReturn'].'",fromDepartureFlightTime="'.$listdataevent['fromDepartureFlightTime'].'",toDepartureFlightTime="'.$listdataevent['toDepartureFlightTime'].'",fromReturnFlightTime="'.$listdataevent['fromReturnFlightTime'].'",toReturnFlightTime="'.$listdataevent['toReturnFlightTime'].'",departureFlightHour="'.$listdataevent['departureFlightHour'].'",returnFlightHour="'.$listdataevent['returnFlightHour'].'",flightTripType="'.$listdataevent['flightTripType'].'",country="'.$listdataevent['country'].'",visaCategory="'.$listdataevent['parentId'].'",parentId="'.$listdataevent['parentId'].'",parentId="'.$listdataevent['parentId'].'",parentId="'.$listdataevent['parentId'].'",parentId="'.$listdataevent['parentId'].'",visaCategory="'.$listdataevent['adult'].'",child="'.$listdataevent['child'].'",infant="'.$listdataevent['infant'].'",entryType="'.$listdataevent['entryType'].'",visaValidity="'.$listdataevent['visaValidity'].'",nationality="'.$listdataevent['nationality'].'",CGSTValue="'.$listdataevent['CGSTValue'].'",SGSTValue="'.$listdataevent['SGSTValue'].'",IGSTValue="'.$listdataevent['IGSTValue'].'",TCSValue="'.$listdataevent['TCSValue'].'",CGST="'.$listdataevent['CGST'].'",SGST="'.$listdataevent['SGST'].'",IGST="'.$listdataevent['IGST'].'",TCS="'.$listdataevent['TCS'].'",CGSTamount="'.$listdataevent['CGSTamount'].'",SGSTamount="'.$listdataevent['SGSTamount'].'",IGSTamount="'.$listdataevent['IGSTamount'].'",TCSamount="'.$listdataevent['TCSamount'].'",quotationCost="'.$listdataevent['quotationCost'].'",quotationCostWithTax="'.$listdataevent['quotationCostWithTax'].'",quotationMarkup="'.$listdataevent['quotationMarkup'].'",currencyId="'.$listdataevent['currencyId'].'",perPerson="'.$listdataevent['perPerson'].'",adultCost="'.$listdataevent['adultCost'].'",childCost="'.$listdataevent['childCost'].'",infantCost="'.$listdataevent['infantCost'].'",noOfVehicle="'.$listdataevent['noOfVehicle'].'",singleRoom="'.$listdataevent['singleRoom'].'",doubleRoom="'.$listdataevent['doubleRoom'].'",tripleRoom="'.$listdataevent['tripleRoom'].'",childWithBedRoom="'.$listdataevent['childWithBedRoom'].'",extraAdultRoom="'.$listdataevent['extraAdultRoom'].'",singleRoomCost="'.$listdataevent['singleRoomCost'].'",doubleRoomCost="'.$listdataevent['doubleRoomCost'].'",tripleRoomCost="'.$listdataevent['tripleRoomCost'].'",childWithBedRoomCost="'.$listdataevent['childWithBedRoomCost'].'",extraAdultRoomCost="'.$listdataevent['extraAdultRoomCost'].'",taxApply="'.$listdataevent['taxApply'].'",showTaxDetails="'.$listdataevent['showTaxDetails'].'",dayId="'.$lastdayid.'",vehicleId="'.$listdataevent['vehicleId'].'",hotelId="'.$listdataevent['hotelId'].'",sightseeingId="'.$listdataevent['sightseeingId'].'",activityId="'.$listdataevent['activityId'].'",cruiseId="'.$listdataevent['cruiseId'].'",extraId="'.$listdataevent['extraId'].'",noOfExtra="'.$listdataevent['noOfExtra'].'",seatId="'.$listdataevent['seatId'].'",cruiseCost="'.$listdataevent['cruiseCost'].'",dayDate="'.$listdatadays['dayDate'].'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('quotationEvents',$namevalue); 
}*/


}
 
 
?>
  
 
 
 
 
<script>
 parent.redirectpage('display.html?ga=itinerary&save=1');
</script>

<?php
exit();
}




 
 
if(trim($_POST['action'])=='add_cab_booking' && $_POST['name']!='' && $_POST['email']!='' && $_POST['mobile']!=''){   

$name=addslashes($_POST['name']);   
$email=addslashes(strip_tags($_POST['email'])); 
$mobile=addslashes(strip_tags($_POST['mobile'])); 
$numberofdays=addslashes(strip_tags($_POST['numberofdays'])); 
$final_base_tariff_cost=addslashes(strip_tags($_POST['final_base_tariff_cost'])); 
$final_base_driver_cost=addslashes(strip_tags($_POST['final_base_driver_cost'])); 
$final_base_night_allowance_cost=addslashes(strip_tags($_POST['final_base_night_allowance_cost'])); 
$extra_hrs=addslashes(strip_tags($_POST['extra_hrs'])); 
$final_extra_hrs_charges=addslashes(strip_tags($_POST['final_extra_hrs_charges']));

$extra_kms=addslashes(strip_tags($_POST['extra_kms'])); 
$final_extra_kms_charges=addslashes(strip_tags($_POST['final_extra_kms_charges'])); 
$subtotal=addslashes(strip_tags($_POST['subtotal'])); 
$tax=addslashes(strip_tags($_POST['tax'])); 

$after_tax=addslashes(strip_tags($_POST['after_tax'])); 
$promo_code=addslashes(strip_tags($_POST['promo_code'])); 
$discount=addslashes(strip_tags($_POST['discount'])); 

$final_charges=addslashes(strip_tags($_POST['final_charges'])); 

$payment_status=addslashes(strip_tags($_POST['payment_status'])); 
$booking_status=addslashes(strip_tags($_POST['booking_status'])); 


$addedBy=$_SESSION['userid']; 
$dateAdded=date('Y-m-d H:i:s'); 


echo $namevalue ='name="'.$name.'",email="'.$email.'",numberofdays="'.$numberofdays.'",final_base_tariff_cost="'.$final_base_tariff_cost.'",final_base_driver_cost="'.$final_base_driver_cost.'",final_base_night_allowance_cost="'.$final_base_night_allowance_cost.'",extra_hrs="'.$extra_hrs.'",final_extra_hrs_charges="'.$final_extra_hrs_charges.'",extra_kms="'.$extra_kms.'",final_extra_kms_charges="'.$final_extra_kms_charges.'",subtotal="'.$subtotal.'",tax="'.$tax.'",after_tax="'.$after_tax.'",promo_code="'.$promo_code.'",discount="'.$final_charges.'",discount="'.$final_charges.'",payment_status="'.$payment_status.'",booking_status="'.$booking_status.'",updated_at="'.$dateAdded.'"'; 
$where='id="'.decode($_POST['editId']).'"';  
updatelisting('cab_package_booking',$namevalue,$where);



if(isset($_POST["paymentLink"]) && $_POST["payment_status"]!=3){
//Send payment link
$payment_url=$fullurlweb."checkout.html?id=".trim($_REQUEST["id"]);
	
$mailbody='<div style="padding:50px 0px; background-color:#f6f5f5; font-family:Arial, Helvetica, sans-serif;">
<div style="background-color: #FFFFFF; border: 1px solid #e5e4e4; max-width: 750px; padding: 20px; margin: auto; box-shadow: 3px 3px 5px #ededed;">
<div style="text-align:left; padding:20px 0px; padding-top:0px; padding-bottom: 0px;"><img src="'.$fullurlweb.'img/logo/logo.png" width="120"  ></div>

<div style="padding:20px 0px;"><table width="100%" border="0" cellpadding="8" cellspacing="0" style="font-size:14px;">
  <tr>
	<td>Subject</td>
    <td>:</td>
    <td>Cab Booking Payment Link</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5">Link</td>
	<td>:</td>
    <td><a href="'.$payment_url.'">'.$payment_url.'</a></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5">Booking Id</td>
	<td>:</td>
    <td>'.decode($_POST['editId']).'</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5">Payable Amount (INR)</td>
	<td>:</td>
    <td>'.round($final_charges).'</td>
  </tr>
  <tr>
    <td>Traveler Info</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Full Name</td>
    <td>:</td>
    <td>'.$name.'</td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td>:</td>
    <td>'.$mobile.'</td>
  </tr>  
</table>

</div>

<div style="text-align:center; font-size:11px; color:#666666;">Copyright &copy; 2022 Travelocar | All Rights Reserved.</div>

</div>
</div>';

$mailsubject='Cab Booking Payment Link ';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@travbizz.com \r\n";
mail($email,$mailsubject,$mailbody,$headers);
}

if($_POST["payment_status"]==3){
	
//queryId
//decode($_POST['editId'])

$packageInfo=GetPageRecord('*','cab_package_booking','id="'.decode($_POST['editId']).'"');
$packageData=mysqli_fetch_array($packageInfo);
$queryId=$packageData["queryId"];

//Update query status
$namevalue ='statusId="5';
$where='id="'.$queryId.'"';  
updatelisting('queryMaster',$namevalue,$where);
	
	
$mailsubject='Cab Booking Confirmation';
$mailbody=file_get_contents($fullurlweb.'confirm_booking.php?id='.$_POST['editId']);

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@travbizz.com \r\n";
mail($email,$mailsubject,$mailbody,$headers);	
}
?>
<script> 
parent.redirectpage('display.html?ga=cabbooking&save=1'); 
</script> 
<?php 
}


if(trim($_POST['action'])=='addoffer' && trim($_POST['name'])!='' ){ 

$name=trim(addslashes($_POST['name']));  
$description=addslashes($_POST['description']);   
$maximumUsage=addslashes($_POST['maximumUsage']);  
$counponType=addslashes($_POST['counponType']);  
$discountValue=addslashes($_POST['discountValue']);  
$activateDate=date('Y-m-d',strtotime($_POST['activateDate']));  
$deactivateDate=date('Y-m-d',strtotime($_POST['deactivateDate']));  
$status=addslashes($_POST['status']);    
$oldphoto=addslashes($_POST['oldchangeprofilepic']);
$discountCartValue=addslashes($_POST['discountCartValue']);
$editid=decode($_POST['editId']); 


if($_FILES["changeprofilepic"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(time()); 
$companyLogoFileName=basename($_FILES['changeprofilepic']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=str_replace(' ','_',time().$rt.'.'.$companyLogoFileExtension); 
move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "package_image/{$profilePhoto}"); 
}

if($profilePhoto==''){ 
$profilePhoto=$oldphoto; 
} 

if($_REQUEST['editId']!=''){   
$namevalue ='name="'.$name.'",description="'.$description.'",maximumUsage="'.$maximumUsage.'",counponType="'.$counponType.'",discountCartValue="'.$discountCartValue.'",discountValue="'.$discountValue.'",activateDate="'.$activateDate.'",deactivateDate="'.$deactivateDate.'",status="'.$status.'",img="'.$profilePhoto.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';  
$where='id="'.$editid.'"';    
updatelisting('couponmaster',$namevalue,$where);  
$lstaddid=$editid;
} else {


$namevalue ='name="'.$name.'",description="'.$description.'",maximumUsage="'.$maximumUsage.'",counponType="'.$counponType.'",discountValue="'.$discountValue.'",discountCartValue="'.$discountCartValue.'",activateDate="'.$activateDate.'",deactivateDate="'.$deactivateDate.'",status="'.$status.'",img="'.$profilePhoto.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';  
$lstaddid=addlistinggetlastid('couponmaster',$namevalue); 
}
?>
<script> 
parent.redirectpage('display.html?ga=offers&save=1'); 
</script> 
<?php 
exit();
}




if(trim($_POST['action'])=='addcabroute' && $_POST['name']!='' && $_POST['url']!=''){   

$name=addslashes($_POST['name']);   
$url=addslashes($_POST['url']);   
$status=addslashes(strip_tags($_POST['status'])); 
$addedBy=$_SESSION['userid']; 
$dateAdded=date('Y-m-d H:i:s'); 


if($_REQUEST['editId']==''){   
$namevalue ='name="'.$name.'",url="'.$url.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 
addlisting('cab_route',$namevalue);  
} else {
$namevalue ='name="'.$name.'",url="'.$url.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 
$where='id="'.decode($_POST['editId']).'"';  
updatelisting('cab_route',$namevalue,$where);  
}
?>
<script> 
parent.redirectpage('display.html?ga=cab_route&save=1'); 
</script> 
<?php 
}




if(trim($_POST['action'])=='addCabPackage' && $_POST['package_category']!='' && $_POST['available_for']!='' && $_POST['location']!='' && $_POST['min_klm_per_day']!='' && $_POST['tariff_cost']!='' && $_POST['driver_allowance']!='' && $_POST['extra_per_klm_charges']!='' && $_POST['night_shift_start_time']!='' && $_POST['night_shift_end_time']!='' && $_POST['night_shift_allowence']!='' && $_POST['convenience_fee']!='' && $_POST['tax']!=''){   

$package_category=addslashes(strip_tags($_POST['package_category'])); 
$available_for=addslashes(strip_tags($_POST['available_for'])); 
$location=addslashes(strip_tags($_POST['location'])); 
$min_klm_per_day=addslashes(strip_tags($_POST['min_klm_per_day'])); 
$tariff_cost=addslashes(strip_tags($_POST['tariff_cost'])); 
$driver_allowance=addslashes(strip_tags($_POST['driver_allowance'])); 
$extra_per_klm_charges=addslashes(strip_tags($_POST['extra_per_klm_charges'])); 
$night_shift_start_time=addslashes(strip_tags($_POST['night_shift_start_time'])); 
$night_shift_end_time=addslashes(strip_tags($_POST['night_shift_end_time'])); 
$night_shift_allowence=addslashes(strip_tags($_POST['night_shift_allowence'])); 
$convenience_fee=addslashes(strip_tags($_POST['convenience_fee'])); 
$tax=addslashes(strip_tags($_POST['tax'])); 
$status=addslashes(strip_tags($_POST['status']));
$inclusion_exclusion=addslashes(strip_tags($_POST['inclusion_exclusion'])); 
$cancellation_policy=addslashes(strip_tags($_POST['cancellation_policy'])); 
$govt_advisory=addslashes(strip_tags($_POST['govt_advisory'])); 
$other_information=addslashes(strip_tags($_POST['other_information'])); 


$min_hrs_per_day=addslashes(strip_tags($_POST['min_hrs_per_day'])); 
$extra_charges_per_hrs=addslashes(strip_tags($_POST['extra_charges_per_hrs'])); 

$sql='';

if($package_category=="1" || $package_category=="2"){
	$sql.=',min_hrs_per_day="'.$min_hrs_per_day.'",extra_charges_per_hrs="'.$extra_charges_per_hrs.'"';
}


$addedBy=$_SESSION['userid']; 
$dateAdded=date('Y-m-d H:i:s');

$cab_category=$_POST['cab_category'];

$cab_contents='';
foreach($_POST['cab_contents'] as $check) { 
	$cab_contents.=$check.',';
}

if($_REQUEST['editId']==''){   
$namevalue ='package_category="'.$package_category.'",available_for="'.$available_for.'",location="'.$location.'",min_klm_per_day="'.$min_klm_per_day.'",tariff_cost="'.$tariff_cost.'",driver_allowance="'.$driver_allowance.'",extra_per_klm_charges="'.$extra_per_klm_charges.'",night_shift_start_time="'.$night_shift_start_time.'",night_shift_end_time="'.$night_shift_end_time.'",night_shift_allowence="'.$night_shift_allowence.'",cab_category="'.$cab_category.'",cab_contents="'.$cab_contents.'",inclusion_exclusion="'.$inclusion_exclusion.'",convenience_fee="'.$convenience_fee.'",tax="'.$tax.'",cancellation_policy="'.$cancellation_policy.'",govt_advisory="'.$govt_advisory.'",other_information="'.$other_information.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'" '.$sql.''; 
addlisting('cab_packages',$namevalue);  
} else {
$namevalue ='package_category="'.$package_category.'",available_for="'.$available_for.'",location="'.$location.'",min_klm_per_day="'.$min_klm_per_day.'",tariff_cost="'.$tariff_cost.'",driver_allowance="'.$driver_allowance.'",extra_per_klm_charges="'.$extra_per_klm_charges.'",night_shift_start_time="'.$night_shift_start_time.'",night_shift_end_time="'.$night_shift_end_time.'",night_shift_allowence="'.$night_shift_allowence.'",cab_category="'.$cab_category.'",cab_contents="'.$cab_contents.'",convenience_fee="'.$convenience_fee.'",tax="'.$tax.'",inclusion_exclusion="'.$inclusion_exclusion.'",cancellation_policy="'.$cancellation_policy.'",govt_advisory="'.$govt_advisory.'",other_information="'.$other_information.'",status="'.$status.'",addedBy="'.$addedBy.'" '.$sql.''; 
$where='id="'.decode($_POST['editId']).'"';
updatelisting('cab_packages',$namevalue,$where);
}
?>
<script>
parent.redirectpage('display.html?ga=cabpackage&save=1'); 
</script> 
<?php
}


if(trim($_POST['action'])=='addvehiclecategory' && $_POST['name']!='' && $_POST['pax']!=''){   

$name=addslashes($_POST['name']);  
$pax=addslashes($_POST['pax']);  
$status=addslashes(strip_tags($_POST['status'])); 
$addedBy=$_SESSION['userid']; 
$dateAdded=date('Y-m-d H:i:s'); 

if($_FILES["image"]["tmp_name"]!=""){

$rt=time(); 
$companyLogoFileName=basename($_FILES['image']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$profilePhoto}");  
}else{
$profilePhoto=$_REQUEST['oldlogo'];
}


if($_REQUEST['editId']==''){   
$namevalue ='name="'.$name.'",pax="'.$pax.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 
addlisting('vehicle_category',$namevalue);  
} else {
$namevalue ='name="'.$name.'",pax="'.$pax.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 
$where='id="'.decode($_POST['editId']).'"';  
updatelisting('vehicle_category',$namevalue,$where);  
}
?> 
<script> 
parent.redirectpage('display.html?ga=vehicle_category&save=1'); 
</script> 
<?php 
}



if(trim($_POST['action'])=='tariff_setting'){   
$inclusion_exclusion=addslashes($_POST['inclusion_exclusion']);  
$cancellation_policy=addslashes($_POST['cancellation_policy']);  
$govt_advisory=addslashes($_POST['govt_advisory']);  
$other_information=addslashes($_POST['other_information']);  

$namevalue ='inclusion_exclusion="'.$inclusion_exclusion.'",cancellation_policy="'.$cancellation_policy.'",govt_advisory="'.$govt_advisory.'",other_information="'.$other_information.'"';  
$where='id="1"';    
updatelisting('tariff_settting',$namevalue,$where);   


?> 
<script> 
parent.redirectpage('display.html?ga=cabpackage&save=1'); 
</script> 
<?php 
}










if(trim($_POST['action'])=='citycabMaster'){    
 

if($_POST['editId']>0){ 
$namevalue2 ='name="'.trim($_REQUEST['name']).'"';
$where='id="'.decode($_POST['editId']).'"';    
updatelisting('destination',$namevalue2,$where);  
 
} else { 

$namevalue2 ='name="'.trim($_REQUEST['name']).'"';
addlistinggetlastid('destination',$namevalue2); 
 
}

?> 
<script> 
parent.redirectpage('display.html?ga=cabdestination&save=1'); 
</script> 
<?php 
}









if(trim($_POST['action'])=='addcabcontent' && $_POST['name']!=''){   

$name=addslashes($_POST['name']);   
$status=addslashes(strip_tags($_POST['status'])); 
$addedBy=$_SESSION['userid']; 
$dateAdded=date('Y-m-d H:i:s'); 


if($_REQUEST['editId']==''){   
$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 
addlisting('cab_content',$namevalue);  
} else {
$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 
$where='id="'.decode($_POST['editId']).'"';  
updatelisting('cab_content',$namevalue,$where);  
}
?>
<script> 
parent.redirectpage('display.html?ga=cab_content&save=1'); 
</script> 
<?php 
}










if(trim($_POST['action'])=='addcabvehicle' && $_POST['name']!=''){   

$name=addslashes($_POST['name']);   
$category_id=addslashes(strip_tags($_POST['category_id']));  
$fuel=addslashes(strip_tags($_POST['fuel'])); 
$remark=addslashes(strip_tags($_POST['details'])); 
$status=addslashes(strip_tags($_POST['status'])); 
$addedBy=$_SESSION['userid']; 
$dateAdded=date('Y-m-d H:i:s'); 

if($_FILES["image"]["tmp_name"]!=""){

$rt=time(); 
$companyLogoFileName=basename($_FILES['image']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$profilePhoto}");  
}else{
$profilePhoto=$_REQUEST['oldlogo'];
}


if($_REQUEST['editId']==''){   
$namevalue ='name="'.$name.'",category_id="'.$category_id.'",fuel="'.$fuel.'",remark="'.$remark.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 
addlisting('vehiclemaster',$namevalue);  
} else {
$namevalue ='name="'.$name.'",category_id="'.$category_id.'",fuel="'.$fuel.'",remark="'.$remark.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 
$where='id="'.decode($_POST['editId']).'"';  
updatelisting('vehiclemaster',$namevalue,$where);  
}
?> 
<script> 
parent.redirectpage('display.html?ga=cab_vehicle&save=1'); 
</script> 
<?php 
}






if($_POST['action']=='savemyprofile' && $_POST['name']!="" && $_POST['companyName']!="" && $_POST['email']!=""){
     
$commissionType=addslashes($_POST['commissionType']);
$agentType=addslashes($_POST['agentType']);
$lastName=addslashes($_POST['lastName']);
$website=addslashes($_POST['website']);
$companyName=addslashes($_POST['companyName']);
$agentCategory=addslashes($_POST['agentCategory']);
$name=addslashes($_POST['name']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']); 
$country=addslashes($_POST['country']); 
$state=addslashes($_POST['state']); 
$city=addslashes($_POST['city']); 
$countryCode=addslashes($_POST['countryCode']); 
$description=addslashes($_POST['description']);
$pan=addslashes($_POST['pan']);
$address2=addslashes($_POST['address2']);
$fax=addslashes($_POST['fax']); 
$pincode=addslashes($_POST['pincode']);
$businessType=addslashes($_POST['businessType']);
$gstin=addslashes($_POST['gstin']);
$contactPerson=addslashes($_POST['contactPerson']);
$gstphoneNumber=addslashes($_POST['gstphoneNumber']);
$gstmobileNumber=addslashes($_POST['gstmobileNumber']);
$gstemailId=addslashes($_POST['gstemailId']);
$correspondenceMailId=addslashes($_POST['correspondenceMailId']);
$gstinStatus=addslashes($_POST['gstinStatus']);
$hsn=addslashes($_POST['hsn']);
$salesManager=addslashes($_POST['salesManager']);
$defaultMarkup=addslashes($_POST['defaultMarkup']);
$defaultCommision=addslashes($_POST['defaultCommision']);

if(isset($_POST['activeWebsite'])){
$activeWebsite=addslashes($_POST['activeWebsite']); 	
}else{
$activeWebsite=0;	
} 

if(isset($_POST['websiteTheme'])){
$websiteTheme=addslashes($_POST['websiteTheme']); 	
}else{
$websiteTheme=0;	
} 

if(isset($_POST['customerLogin'])){
$customerLogin=addslashes($_POST['customerLogin']); 	
}else{
$customerLogin=0;	
}

$permissionView='';
foreach($_POST['permissionView'] as $check) { 
	$permissionView.=$check.',';
}

$debitCard=addslashes($_POST['debitCard']); 
$creditCard=addslashes($_POST['creditCard']); 
$upi=addslashes($_POST['upi']); 
$netBanking=addslashes($_POST['netBanking']); 


$domainName=addslashes(str_replace('/','',str_replace('www.','',str_replace('http://','',str_replace('https://','',trim($_POST['domainName'])))))); 

 


$websiteTitle=addslashes($_POST['websiteTitle']);
$facebookLink=addslashes($_POST['facebookLink']); 
$twitterLink=addslashes($_POST['twitterLink']); 
$instagramLink=addslashes($_POST['instagramLink']); 
$linkedinLink=addslashes($_POST['linkedinLink']); 
$websiteBaseColor=addslashes($_POST['websiteBaseColor']); 
$contactPhoneNo=addslashes($_POST['contactPhoneNo']); 
$contactEmail=addslashes($_POST['contactEmail']); 
$contactAddress=addslashes($_POST['contactAddress']); 
$queryEmail=addslashes($_POST['queryEmail']); 
$googleMap=addslashes($_POST['googleMap']); 
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']); 
$oldcompanyLogo2=addslashes($_POST['oldcompanyLogo2']); 
$paymentGatway=addslashes($_POST['paymentGatway']); 
$MERCHANT_KEY=addslashes($_POST['MERCHANT_KEY']); 
$SALT=addslashes($_POST['SALT']); 

 
$address=addslashes($_POST['address']); 
$branchId=addslashes($_POST['branchId']); 
$roleId=0; 
 
$status=round($_POST['agentstatus']); 
 
$logincredentials=addslashes($_POST['logincredentials']);  
$editid=addslashes($_POST['editid']);
$randPass = rand(999999,100000);

if($_FILES["companyLogo"]["tmp_name"]!=""){  
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}
if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}


if($_FILES["companyLogo2"]["tmp_name"]!=""){  
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo2']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo2=time().$rt.'.'.$companyLogoFileExtension; 
move_uploaded_file($_FILES["companyLogo2"]["tmp_name"], "upload/{$companyLogo2}"); 
}
if($companyLogo2==''){ 
$companyLogo2=$oldcompanyLogo2; 
}




$sql='';
 

if($editid!=''){

//-------EDIT-----------

 
$namevalue ='name="'.$name.'",lastName="'.$lastName.'",email="'.$email.'",loginBanner="'.$companyLogo.'",companyLogo="'.$companyLogo2.'",phone="'.$phone.'",address="'.$address.'",companyName="'.$companyName.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",MERCHANT_KEY="'.$MERCHANT_KEY.'",SALT="'.$SALT.'",countryCode="'.$countryCode.'",description="'.$description.'",agentCategory="'.$agentCategory.'",activeWebsite="'.$activeWebsite.'",domainName="'.$domainName.'",websiteTitle="'.$websiteTitle.'",websiteTheme="'.$websiteTheme.'",facebookLink="'.$facebookLink.'",twitterLink="'.$twitterLink.'",instagramLink="'.$instagramLink.'",linkedinLink="'.$linkedinLink.'",websiteBaseColor="'.$websiteBaseColor.'",customerLogin="'.$customerLogin.'",contactPhoneNo="'.$contactPhoneNo.'",contactEmail="'.$contactEmail.'",contactAddress="'.$contactAddress.'",queryEmail="'.$queryEmail.'",googleMap="'.$googleMap.'",pan="'.$pan.'",address2="'.$address2.'",fax="'.$fax.'",pincode="'.$pincode.'",businessType="'.$businessType.'",gstin="'.$gstin.'",contactPerson="'.$contactPerson.'",gstphoneNumber="'.$gstphoneNumber.'",gstmobileNumber="'.$gstmobileNumber.'",gstemailId="'.$gstemailId.'",correspondenceMailId="'.$correspondenceMailId.'",gstinStatus="'.$gstinStatus.'",hsn="'.$hsn.'",debitCard="'.$debitCard.'",creditCard="'.$creditCard.'",upi="'.$upi.'",netBanking="'.$netBanking.'",website="'.$website.'",salesManager="'.$salesManager.'",permissionView="'.$permissionView.'",paymentGatway="'.$paymentGatway.'",MERCHANT_KEY="'.$MERCHANT_KEY.'",SALT="'.$SALT.'" '.$sql.'';
 
 
$where='id="'.$_SESSION['userid'].'"';   
updatelisting('sys_userMaster',$namevalue,$where); 

 


$sql_insk="insert into sys_userLogs set currentIp='".$_SERVER['REMOTE_ADDR']."',logType='agent',details='".$name." Agent Updated',userId='".$_SESSION['userid']."',parentId='".$_SESSION['userid']."',addDate='".time()."'";   

}  

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



 
 
 
 
?>
<script>
parent.redirectpage('display.html?ga=generalsettings&save=1');
</script>

<?php
exit();
}







if($_POST['action']=='busmarkup' && $_REQUEST['busMarkupValue']!=''){ 

 

$namevalue ='busMarkupValue="'.$_REQUEST['busMarkupValue'].'",busMarkupType="'.$_REQUEST['busMarkupType'].'"';  
$where=' id="'.$_SESSION['userid'].'"';
updatelisting('sys_userMaster',$namevalue,$where); 

 

?>
<script>
parent.redirectpage('display.html?keyword=&ga=bussetting&save=1');
</script>

<?php
exit();
}



if($_POST['action']=='changePassword' && trim($_POST['oldPassword'])!=""){ 
 
$oldPassword=trim(addslashes($_POST['oldPassword']));
$newPassword=trim(addslashes($_POST['newPassword']));
$confirmPassword=trim(addslashes($_POST['confirmPassword']));



$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" and parentId=1 and password="'.md5($oldPassword).'" '); 
if(mysqli_num_rows($rs)>0){
$LoginUserDetails=mysqli_fetch_array($rs); 

if($newPassword==$confirmPassword){


$namevalue ='password="'.md5($newPassword).'"';  
$where=' id="'.$_SESSION['userid'].'" and parentId=1';
updatelisting('sys_userMaster',$namevalue,$where);

?>
<script> alert('Password Successfully Changed...!'); 
parent.redirectpage('display.html?ga=myprofile&save=1');
</script>
<?php

}else{

?>
<script> alert('New Password and Confirm Password did not match...!');  
</script>
<?php
exit();
} 
 

}else{ 
?>
<script> alert('Old Password did not match...!');  
</script>
<?php
exit();
}
?>  

<?php 
?>
<script>
parent.redirectpage('display.html?ga=myprofile&save=1');
</script>

<?php
exit();
} 




if($_REQUEST['action']=='onlineRecharge' && $_REQUEST['amount']!=""){
$amount=addslashes($_REQUEST['amount']);
$note=addslashes($_REQUEST['notes']);
$token=rand(89898,543132113).strtotime(date('YmdHis'));
$booking_payment_type=addslashes($_REQUEST['booking_payment_type']);

$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 
if(mysqli_num_rows($chkrow)==0){

$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",bookingType="'.$_REQUEST["booking_payment_type"].'",serviceId="'.$_SESSION['serviceId'].'",merchant_param1="'.$_REQUEST["booking_payment_type"].'",merchant_param2="'.$token.'",merchant_param3="'.$_SESSION['agentUserid'].'",merchant_param4="'.$_SESSION['parentAgentId'].'",merchant_param5="'.$_SESSION['parentid'].'",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'" ';
$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);
$floatValue = number_format((float)$amount, 2, '.', '');  // return float

$_SESSION["txnID"]=$txnID;
$_SESSION["amount"]=$amount;
$_SESSION["first_name"]=strip($LoginUserDetails['name']);
$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);
$_SESSION["phone"]=strip($LoginUserDetails['phone']);
$_SESSION["user_email"]=strip($LoginUserDetails['email']);
$_SESSION["order_id"]=encode($txnID);
$_SESSION["token"]=$token;
?>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<img src="<?php echo $fullurl; ?>images/loading.gif" style="display: block; margin-left: auto; margin-right: auto;">			  
<form  action="<?php echo $fullurl; ?>pay.php" method="POST" style="display:none;" id="paymentpay">
<input type="hidden" name="item_name" value="Flight booking">
<input type="hidden" name="item_description" value="Flight booking - Online payment">
<input type="hidden" name="item_number" value="<?php echo $txnID; ?>">
<input type="hidden" name="amount" value="<?php echo $floatValue; ?>">
<input type="hidden" name="address" value="Delhi">
<input type="hidden" name="currency" value="INR">
<input type="hidden" name="cust_name" value="<?php echo strip($LoginUserDetails['name'])."".strip($LoginUserDetails['lastName']); ?>">
<input type="hidden" name="email" value="<?php echo strip($LoginUserDetails['email']); ?>">
<input type="hidden" name="contact" value="<?php echo strip($LoginUserDetails['phone']); ?>">
<input type="hidden" name="receipt" value="<?php echo $txnID; ?>">
<input type="hidden" name="logoImg" value="<?php echo $fullurl; ?>profilepic/<?php  echo $LoginUserDetails['companyLogo']; ?>">
<input type="submit" class="btn btn-primary" value="Buy Now">
</form>
<script>
$('#paymentpay').submit();
</script>

<?php
exit();
}

}


if(trim($_POST['action'])=='addpaymentrequest' && trim($_POST['requestedAmount'])!=''){

$requestedAmount=stripslashes($_POST['requestedAmount']);  
$paymentMode=stripslashes($_POST['paymentMode']); 
$referenceNumber=stripslashes($_POST['referenceNumber']);  
$chequeNumber=stripslashes($_POST['chequeNumber']);  
$draftNumber=stripslashes($_POST['draftNumber']);  
$chequeDate=stripslashes($_POST['chequeDate']);  
$bank=stripslashes($_POST['bank']);  
$branch=stripslashes($_POST['branch']);  
$account_number=stripslashes($_POST['account_number']);  
$bank_transaction_id=stripslashes($_POST['bank_transaction_id']); 
$note=stripslashes($_POST['note']);

$sql='';

if($_FILES["attachment"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['attachment']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["attachment"]["tmp_name"], "masteradmin/upload/{$profilePhoto}");

$sql=',attachment="'.$profilePhoto.'"';
}


$namevalue ='requestedAmount="'.$requestedAmount.'",paymentMode="'.$paymentMode.'",referenceNumber="'.$referenceNumber.'",chequeNumber="'.$chequeNumber.'",draftNumber="'.$draftNumber.'",chequeDate="'.$chequeDate.'",bank="'.$bank.'",branch="'.$branch.'",account_number="'.$account_number.'",bank_transaction_id="'.$bank_transaction_id.'",note="'.$note.'",agentId="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d').'" '.$sql.'';
addlistinggetlastid('offlineRechargeRequest',$namevalue);  



?> 
<script>
parent.redirectpage('display.html?ga=topupOffline&save=1');
</script> 
<?php
}




if(trim($_REQUEST['action'])=='paymentGatewayPayment' && trim($_REQUEST['serviceId'])!=''  && trim($_REQUEST['type'])!='' ){

//echo ' serviceId="'.decode($_REQUEST['serviceId']).'" and bookingType="'.trim($_REQUEST['type']).'"';

$aResp=GetPageRecord('*','onlineRechargeRequest',' serviceId="'.($_REQUEST['serviceId']).'" and bookingType="'.trim($_REQUEST['type']).'" order by id desc');


$numChk=mysqli_num_rows($aResp);

$resPayment=mysqli_fetch_array($aResp);







   if($numChk>0)
   {

		if($resPayment['status']=='success')
		{
		?>
		<script>
		alert('Success Payment');
		//console.log('Success Payment ');
		allBookingSubmit();
		</script>
		<?php
		}
		else
		{
		?>
		<script>
		//console.log('Faile Payment ');
		//alert("Payment Failed, Please try again - payment stauts <?php echo $resPayment['status']; ?>");
		</script>
		<?php
		}
		
	}	

}

?>