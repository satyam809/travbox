<?php 
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php";
include "agenturlinc.php";




if($_REQUEST["action"]=="complete_profile" && $_POST["name"]!="" && $_POST["lastName"]!="" && $_POST["country"]!="" && $_POST["state"]!="" && $_POST["city"]!="" && $_POST["companyName"]!="" && $_POST["businessType"]!=""  ){

$EditID=trim($_REQUEST["EditID"]); 
$firstName=trim($_REQUEST["name"]); 
$salesManager=trim($_REQUEST["salesManager"]); 
 

$address=trim($_REQUEST["address"]); 

$lastName=trim($_REQUEST["lastName"]); 



$pincode=trim($_REQUEST["pincode"]); 

$country=trim($_REQUEST["country"]); 

$state=trim($_REQUEST["state"]); 

$city=trim($_REQUEST["city"]); 

$companyName=trim($_REQUEST["companyName"]);  

$pan=trim($_REQUEST["pan"]); 

$businessType=trim($_REQUEST["businessType"]); 

$gstNumber=trim($_REQUEST["gstNumber"]);

$website=trim($_REQUEST["website"]);
	
$userCountry=trim($_REQUEST["userCountry"]);

$userState=trim($_REQUEST["userState"]);

$userCity=trim($_REQUEST["userCity"]);
	
$companyPincode=trim($_REQUEST["companyPincode"]);
	
$companyAddress=trim($_REQUEST["companyAddress"]);
	
$companyMobile=trim($_REQUEST["companyMobile"]);
	
$agentCode=addslashes($_POST['agentCode']);
	
$aadharNumber=addslashes($_POST['aadharNumber']);
$citizinship=addslashes($_POST['citizinship']);
	
$oldpanCopy=addslashes($_POST['panCopy']);
$oldcompanyLogo=addslashes($_POST['companyLogo']);
	
	
/* if($_FILES["panCopy"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['panCopy']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$panCopy=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["panCopy"]["tmp_name"], "upload/{$panCopy}"); 
} */

if ($_FILES["panCopy"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['panCopy']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);




    // FTP configuration for the admintest.momtap.in server
    $ftpHost = 'ftp.travbox.travel';
    $ftpUsername = 'travbox@travbox.travel';
    $ftpPassword = 'Travbox@2023#';
    $destinationDirectory = '/ofc.travbox.travel/upload/';

    // Connect to the FTP server
    $ftpConnection = ftp_connect($ftpHost);
    if ($ftpConnection) {
        // Login to the FTP server
        $loginResult = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
        if ($loginResult) {
            // Upload the file
			$panCopy=time().$rt.'.'.$companyLogoFileExtension; 
            $remoteFilePath = $destinationDirectory . $panCopy;
			
            if (ftp_put($ftpConnection, $remoteFilePath, $_FILES["panCopy"]["tmp_name"], FTP_BINARY)) {
                $msg= 'File uploaded successfully.';
            } else {
                $msg= 'Error uploading file.';
            }
        } else {
            $msg= 'FTP login failed.';
        }

        // Close the FTP connection
        ftp_close($ftpConnection);
    } else {
        $msg= 'FTP connection failed.';
    }
}

if($panCopy==''){ 
$panCopy=$oldpanCopy; 
}

if ($_FILES["companyLogo"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['companyLogo']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);




    // FTP configuration for the admintest.momtap.in server
    $ftpHost = 'ftp.momtap.in';
    $ftpUsername = 'justclick@momtap.in';
    $ftpPassword = 'IZqFV%AUe7+{';
    $destinationDirectory = '/admintest.momtap.in/upload/';

    // Connect to the FTP server
    $ftpConnection = ftp_connect($ftpHost);
    if ($ftpConnection) {
        // Login to the FTP server
        $loginResult = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
        if ($loginResult) {
            // Upload the file
			$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 
            $remoteFilePath = $destinationDirectory . $companyLogo;
			
            if (ftp_put($ftpConnection, $remoteFilePath, $_FILES["companyLogo"]["tmp_name"], FTP_BINARY)) {
                $msg= 'File uploaded successfully.';
            } else {
                $msg= 'Error uploading file.';
            }
        } else {
            $msg= 'FTP login failed.';
        }

        // Close the FTP connection
        ftp_close($ftpConnection);
    } else {
        $msg= 'FTP connection failed.';
    }
}

if($companyLogo==''){ 
$companyLogo=$oldcompanyLogo; 
}
 

$a=GetPageRecord('*','sys_userMaster','id=1 ');  

$invoiceData=mysqli_fetch_array($a); 


$namevalue = 'name="'.$firstName.'",lastName="'.$lastName.'",salesManager="'.$salesManager.'",companyLogo="'.$companyLogo.'",panCopy="'.$panCopy.'",address="'.$address.'",pincode="'.$pincode.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",companyPincode="'.$companyPincode.'",companyAddress="'.$companyAddress.'",companyMobile="'.$companyMobile.'",businessType="'.$businessType.'",companyName="'.$companyName.'",pan="'.$pan.'",citizinship="'.$citizinship.'",aadharNumber="'.$aadharNumber.'",gstin="'.$gstNumber.'",profile_status="complete"';


$where=' id="'.$EditID.'"';
updatelisting('sys_userMaster',$namevalue,$where); 
$_SESSION['profile_status']='complete';  
?>

<script> 
window.parent.location.href = "<?php echo $fullurl; ?>"; 

</script> 

<?php 

}

?>