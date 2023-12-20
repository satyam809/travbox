<?php 
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php";
include "agenturlinc.php";


if($_REQUEST["action"]=="modify_companylogo"   ){

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$EditID=trim($_REQUEST["EditID"]); 

 
$oldcompanyLogo=addslashes($_POST['oldComanyLogo']);
/* 
if($_FILES["companyLogo"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
} */

if ($_FILES["companyLogo"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['companyLogo']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);




    // FTP configuration for the admintest.momtap.in server
    $ftpHost = 'ftp.momtap.in';
    $ftpUsername = 'admin@momtap.in';
    $ftpPassword = 'cuTU9uN.Xvc_';
    $destinationDirectory = '/upload/';

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

$namevalue = 'companyLogo="'.$companyLogo.'"';


$where=' id="'.$EditID.'"';
updatelisting('sys_userMaster',$namevalue,$where); 

?>

<script> 
window.parent.location.href = "<?php echo $fullurl; ?>my-profile?data=<?php echo $msg; ?>"; 

</script> 

<?php 

}

?>