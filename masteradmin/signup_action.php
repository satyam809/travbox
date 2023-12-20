<?php 
include "inc.php"; 
include "config/mail.php"; 
?>
<script src="global_assets/js/main/jquery.min.js"></script>


<?php
/*
if($_POST['action']=='agentRegistration' && $_POST['name']!="" && $_POST['email']!="" && $_POST['phone']!="" && $_POST['agentType']!="" && $_POST['companyName']!="" && $_POST['pan']!="" && $_POST['gstin']!="" && $_POST['mobile']!="" && $_POST['address']!="" && $_POST['pincode']!="" && $_POST['country']!="" && $_POST['state']!="" && $_POST['city']!="" && $_POST['businessType']!="" && $_POST['stateCode']!="" && $_POST['hsn']!=""){
	*/
if($_POST['action']=='agentRegistration'){
	
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, count($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    return $pass;
}

$name=addslashes($_POST['name']);
$email=addslashes($_POST['email']);
$phone=addslashes($_POST['phone']);
$agentType=addslashes($_POST['agentType']);
$companyName=addslashes($_POST['companyName']);
$pan=addslashes($_POST['pan']);
$mobile=addslashes($_POST['mobile']);
$address=addslashes($_POST['address']);
$address2=addslashes($_POST['address2']);
$fax=addslashes($_POST['fax']); 
$pincode=addslashes($_POST['pincode']);
$country=addslashes($_POST['country']);
$state=addslashes($_POST['state']);
$city=addslashes($_POST['city']);
$businessType=addslashes($_POST['businessType']);
$gstin=addslashes($_POST['gstin']);
$contactPerson=addslashes($_POST['contactPerson']);
$gstphoneNumber=addslashes($_POST['gstphoneNumber']);
$gstmobileNumber=addslashes($_POST['gstmobileNumber']);
$gstemailId=addslashes($_POST['gstemailId']);
$correspondenceMailId=addslashes($_POST['correspondenceMailId']);
$gstinStatus=addslashes($_POST['gstinStatus']);
$hsn=addslashes($_POST['hsn']);
$password=randomPassword();

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" '); 
$dubcheck=mysqli_fetch_array($rs8);

if($dubcheck['id']!=''){
?>
<script>
alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!');
parent.redirectpage('signup.php?added=1');
</script>
<?php
exit(); }


//Fetch Agent Id
$lastId=GetPageRecord('id,agentType,agentCustomId','sys_userMaster',' agentType="'.$agentType.'" and agentCustomId!="" and agentType!=NULL order by id desc limit 1');
 
 
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


//-------ADD-----------
$namevalue ='name="'.$name.'",agentCustomId="'.$agentCustomId.'",email="'.$email.'",password="'.md5($password).'",phone="'.$phone.'",agentType="'.$agentType.'",companyName="'.$companyName.'",pan="'.$pan.'",mobile="'.$mobile.'",address="'.$address.'",address2="'.$address2.'",fax="'.$fax.'",pincode="'.$pincode.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",businessType="'.$businessType.'",gstin="'.$gstin.'",contactPerson="'.$contactPerson.'",gstphoneNumber="'.$gstphoneNumber.'",gstmobileNumber="'.$gstmobileNumber.'",gstemailId="'.$gstemailId.'",correspondenceMailId="'.$correspondenceMailId.'",gstinStatus="'.$gstinStatus.'",hsn="'.$hsn.'",status="0" '.$sql.'';
addlistinggetlastid('sys_userMaster',$namevalue);   
?>
<script>
parent.redirectpage('signup.php?added=1');
</script>

<?php
exit();
}

?>

