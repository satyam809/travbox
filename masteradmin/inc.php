<?php
include "config/database.php";
include "config/function.php";
include "config/setting.php";
include "urlinc.php";





$agentid=$_SESSION['parentAgentId'];  
$webagentid=$_SESSION['parentAgentId'];
$hotelApiKey = '711888cf13f347-efe0-476c-8233-cacf552896a9';
  
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'" and parentId="'.$_SESSION['parentid'].'"'); 
$LoginUserDetails=mysqli_fetch_array($rs);

if($LoginUserDetails['userType']=='admin'){
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'" and parentId="'.$_SESSION['parentid'].'"'); 
$logoquery=mysqli_fetch_array($rs);
} else { 
$rs=GetPageRecord('*','sys_userMaster','parentId="'.$_SESSION['parentid'].'"'); 
$logoquery=mysqli_fetch_array($rs);
}

 
 
$rs35=GetPageRecord('*','sys_commissionType','id="'.$LoginUserDetails['commissionType'].'"'); 
$getcommitypename=mysqli_fetch_array($rs35);

 
  
$rs2=GetPageRecord('*','sys_companyMaster','userId="'.$LoginUserDetails['parentId'].'"'); 
$LoginUserCompanyDetails=mysqli_fetch_array($rs2); 
  
$rs3=GetPageRecord('*','sys_branchMaster','userId="'.$LoginUserDetails['branchId'].'"'); 
$LoginUserBranchDetails=mysqli_fetch_array($rs3);

date_default_timezone_set(''.$LoginUserBranchDetails['userTimeZone'].'');

function formatOffset($offset) {
        $hours = $offset / 3600;
        $remainder = $offset % 3600;
        $sign = $hours > 0 ? '+' : '-';
        $hour = (int) abs($hours);
        $minutes = (int) abs($remainder / 60);

        if ($hour == 0 AND $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');

}


function showdatetimesimple($datetime){
return date('d/m/Y - h:i A',strtotime($datetime));
}


function queryreplacetags($id,$content){

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$id.'"'); 
$res=mysqli_fetch_array($a);

$a=GetPageRecord('*','clientMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$res['clientId'].'"'); 
$clientInfo=mysqli_fetch_array($a);

$a=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$res['assignTo'].'"'); 
$userInfo=mysqli_fetch_array($a);

$rs2=GetPageRecord('*','sys_companyMaster','userId="'.$_SESSION['parentid'].'"'); 
$companyInfo=mysqli_fetch_array($rs2); 

$content=str_replace('#company_name#',stripslashes($companyInfo['companyName']),$content);
$content=str_replace('#customer_name#',stripslashes($clientInfo['nameHead'].' '.$clientInfo['name']),$content);
return $content=str_replace('#user_name#',stripslashes($userInfo['name']),$content);

}



function getquerycloserReasons($id){

$a=GetPageRecord('*','sys_queryClosureReasons',' parentId="'.$_SESSION['parentid'].'" and id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}


function currencyname($id){

$a=GetPageRecord('*','apiCurrencyMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}

function roomCategory($id){

$a=GetPageRecord('*','sys_roomCategory',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}


function cruiseSeatName($id){

$a=GetPageRecord('*','sys_CruiseSeatMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}



function hotelcategory($id){

if($id==1){ 
$star='<i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==2){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==3){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==4){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==5){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==6){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}

$a=GetPageRecord('*','sys_hotelCategory',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return ' ('.stripslashes($res['name']).')';

//return $star;
}


function getnationality($id){

$a=GetPageRecord('*','sys_nationalityMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['nationality']);

}


function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
} 


function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}












function quotationreplacetags($id,$content,$quotationURL){

$ab=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$id.'"'); 
$resQuoation=mysqli_fetch_array($ab);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$resQuoation['queryId'].'"'); 
$res=mysqli_fetch_array($a);

$a=GetPageRecord('*','clientMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$res['clientId'].'"'); 
$clientInfo=mysqli_fetch_array($a);

$a=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$_SESSION['userid'].'"'); 
$userInfo=mysqli_fetch_array($a);

$rs2=GetPageRecord('*','sys_companyMaster','userId="'.$_SESSION['parentid'].'"'); 
$companyInfo=mysqli_fetch_array($rs2); 

$quotation_url_replace=$quotationURL;

$content=str_replace('#company_name#',stripslashes($companyInfo['companyName']),$content);
$content=str_replace('#customer_name#',stripslashes($clientInfo['nameHead'].' '.$clientInfo['name']),$content);
$content=str_replace('#user_signature#',stripslashes($userInfo['userSignature']),$content);
$content=str_replace('#quotation_id#','QT'.encode($resQuoation['id']),$content);
$content=str_replace('#user_name#',stripslashes($userInfo['name']),$content);
return $content=str_replace('#quotation_url#',$quotation_url_replace,$content);

}



function getpackagethemename($id){

$a=GetPageRecord('*','sys_packageTheme',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}


function dateDifference($start_date, $end_date)
{ 
    $diff = strtotime($start_date) - strtotime($end_date); 
    return ceil(abs($diff / 86400));
}


function getdestinationname($id){

$a=GetPageRecord('*','sys_destinationMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}

function gethotelcategorytype($id){

$a=GetPageRecord('*','sys_hotelCategory',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}



function gethotelroomtype($id){

$a=GetPageRecord('*','sys_roomTypeMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function gethotelmealplan($id){

$a=GetPageRecord('*','sys_mealPlanMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function gethotelextra($id){

$a=GetPageRecord('*','sys_extraMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function getactivityname($id){

$a=GetPageRecord('*','activityMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function vehiclename($id){ 
$a=GetPageRecord('*','sys_vehicleMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function vehiclenamepax($id){ 
$a=GetPageRecord('*','sys_vehicleMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['pax']); 
}

function crusename($id){ 
$a=GetPageRecord('*','cruseMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}


function getdestinationnamewithlocation($id){

$a=GetPageRecord('*','sys_destinationMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name'].', '.$res['destination']);

}



function getflightdestination($code){ 
if($code!=''){
$a=GetPageRecord('*','flightDestinationMaster',' airportCode="'.trim($code).'"'); 
$res=mysqli_fetch_array($a);  
return stripslashes($res['city']); 
}
}



function logger($errorlog)
{
	$newfile = 	'errorlog/errorlog'.date('dmy').'.txt';

	//rename('errorlog/miserrorlog.txt',$newfile);
  
	if(!file_exists($newfile))
	{
	  file_put_contents($newfile,'');
	}
	$logfile=fopen($newfile,'a');
	
	$ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('Asia/Kolkata');
	$time = date('d-m-Y h:i:s A',time());
	//$contents = file_get_contents('errorlog/errorlog.txt');
	$contents = "$ip\t$time\t$errorlog\r";
	fwrite($logfile,$contents);
	//file_put_contents('errorlog/errorlog.txt',$contents);
}

function getHotelApiData($url,$jsonPost,$apiKey){
    $crl = curl_init($url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $jsonPost);
    
    // Set HTTP Header for POST request 
    curl_setopt($crl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'APIkey: ' . $apiKey));
    
    // Submit the POST request
    return $result = curl_exec($crl);
    curl_close($crl);
}

function checkifvalue($stringvalue,$selectvalue){
$a = explode(',',$stringvalue);
if (in_array($selectvalue, $a)) {
  echo "checked";
} 
}


$permissionView = explode(',',$LoginUserDetails["permissionView"]);

if((!in_array($_REQUEST['ga'], $permissionView)) && $LoginUserDetails["userType"]!="admin"){

	
	exit();
	
}


function getfaretypedisplayname($flightname,$faretype){

$fareType=explode('~',$faretype); 
$fareType=$fareType[1];

if(trim($fareType[1])==''){
$fareType=$faretype;
}

$a=GetPageRecord('*','fareTypeMaster',' 1 and  FIND_IN_SET("'.trim($fareType).'",fareTypeName) and flightName="'.trim($flightname).'" '); 
$datares=mysqli_fetch_array($a); 

if($datares['displayType']!=''){
return stripslashes($datares['displayType']);
}  
}

?>