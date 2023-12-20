<?php
include "inc.php";
include "agenturlinc.php";
include "config/mail.php";
include 'tripjackAPI/APIConstants.php';

include 'tripjackAPI/RestApiCaller.php';

$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<?php

// for visa

if(trim($_POST['action'])=='visaFormSubmit' && trim($_POST['first_name'])!=''){ 

$first_name=stripslashes($_POST['first_name']);  
$last_name=stripslashes($_POST['last_name']); 
$contact_number=stripslashes($_POST['contact_number']);  
$email=stripslashes($_POST['email']);  
$father_name=stripslashes($_POST['father_name']);  
$mother_name=stripslashes($_POST['mother_name']);  
$permanent_address=stripslashes($_POST['permanent_address']);  
$entry_visa=stripslashes($_POST['entry_visa']);  
$visa_type=stripslashes($_POST['visa_type']);  
$destination_country=stripslashes($_POST['destination_country']); 
$passport_number=stripslashes($_POST['passport_number']);
$place_of_issue=stripslashes($_POST['place_of_issue']);
$date_of_issue=stripslashes($_POST['date_of_issue']);
$passport_number=stripslashes($_POST['passport_number']);

$sql='';
$passportFilePath='';
$aadharFilePath='';
$panCopyPath='';

if($_FILES["passportFile"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['passportFile']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$passportFile=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["passportFile"]["tmp_name"], "masteradmin/upload/{$passportFile}");
$sql.=',passportFile="'.$passportFile.'"';
$passportFilePath.="masteradmin/temp/".$passportFile;
}


if($_FILES["aadharFile"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['aadharFile']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$aadharFile=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["aadharFile"]["tmp_name"], "masteradmin/upload/{$aadharFile}");
$sql.=',aadharFile="'.$aadharFile.'"';
$aadharFilePath.="masteradmin/temp/".$aadharFile;
}

if($_FILES["panCopy"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['panCopy']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$panCopy=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["panCopy"]["tmp_name"], "masteradmin/upload/{$panCopy}");
$sql.=',panCopy="'.$panCopy.'"';
$panCopyPath.="masteradmin/temp/".$panCopy;
}

$namevalue ='first_name="'.$first_name.'",last_name="'.$last_name.'",contact_number="'.$contact_number.'",email="'.$email.'",father_name="'.$father_name.'",mother_name="'.$mother_name.'",permanent_address="'.$permanent_address.'",entry_visa="'.$entry_visa.'",visa_type="'.$visa_type.'",destination_country="'.$destination_country.'",passport_number="'.$passport_number.'",place_of_issue="'.$place_of_issue.'",date_of_issue="'.$date_of_issue.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d').'" '.$sql.'';
addlistinggetlastid('visaRequest',$namevalue);




$description="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Visa Application</title>
</head>
<body>
<table style='width: 100%;border-collapse: collapse;'>
	<tbody>
        <tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>First Name</strong></td>
            <td style='border: 1px solid black;'>".$first_name."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Last Name</strong></td>
            <td style='border: 1px solid black;'>".$last_name."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Contact</strong></td>
            <td style='border: 1px solid black;'>".$contact_number."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Email</strong></td>
            <td style='border: 1px solid black;'>".$email."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Father Name</strong></td>
            <td style='border: 1px solid black;'>".$father_name."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Mother Name</strong></td>
            <td style='border: 1px solid black;'>".$mother_name."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Permanent Address</strong></td>
            <td style='border: 1px solid black;'>".$permanent_address."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Entry Visa</strong></td>
            <td style='border: 1px solid black;'>".$entry_visa."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Visa Type</strong></td>
            <td style='border: 1px solid black;'>".$visa_type."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Destination Country</strong></td>
            <td style='border: 1px solid black;'>".$destination_country."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Passport Number</strong></td>
            <td style='border: 1px solid black;'>".$passport_number."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Place of Issue</strong></td>
            <td style='border: 1px solid black;'>".$place_of_issue."</td>
        </tr><tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Date of Issue</strong></td>
            <td style='border: 1px solid black;'>".$date_of_issue."</td>
        </tr>
    </tbody>
</table>
</body>
</html>";

// Recipient
$to = "visa@tripzygo.travel";
// Sender
$from = $email;
$fromName = $first_name. " ".$last_name ;
// Email subject
$subject = "Visa Request";   
// Email body content
$htmlContent = $description;
 
// Header for sender info
$headers = "From: $fromName"." <".$from.">";
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment
if(!empty($passportFilePath) > 0){
    if(is_file($passportFilePath)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($passportFilePath,"rb");
        $data =  @fread($fp,filesize($passportFilePath));
 
        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($passportFilePath)."\"\n" .  
        "Content-Description: ".basename($passportFilePath)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($passportFilePath)."\"; size=".filesize($passportFilePath).";\n".  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}

if(!empty($aadharFilePath) > 0){
    if(is_file($aadharFilePath)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($aadharFilePath,"rb");
        $data =  @fread($fp,filesize($aadharFilePath));
 
        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($aadharFilePath)."\"\n" .  
        "Content-Description: ".basename($aadharFilePath)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($aadharFilePath)."\"; size=".filesize($aadharFilePath).";\n".  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}


if(!empty($panCopyPath) > 0){
    if(is_file($panCopyPath)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($panCopyPath,"rb");
        $data =  @fread($fp,filesize($panCopyPath));
 
        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($panCopyPath)."\"\n" .  
        "Content-Description: ".basename($panCopyPath)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($panCopyPath)."\"; size=".filesize($panCopyPath).";\n".  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;
// Send email
$mail = @mail($to, $subject, $message, $headers, $returnpath);






?> 
<script>   
parent.window.location.href = "visa.php?save=1";
</script> 
<?php
}
// end visa
// end visa
if($_POST['action']=='demofile'){ 
  header("Location:".$fullurl.'upload/customerdata.xlsx'); 
}



if($_POST['action']=='changePassword' && trim($_POST['oldPassword'])!=""){ 
 
$oldPassword=trim(addslashes($_POST['oldPassword']));
$newPassword=trim(addslashes($_POST['newPassword']));
$confirmPassword=trim(addslashes($_POST['confirmPassword']));



$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" and parentId="'.$staticparentId.'" and password="'.md5($oldPassword).'" '); 
if(mysqli_num_rows($rs)>0){
$LoginUserDetails=mysqli_fetch_array($rs); 

if($newPassword==$confirmPassword){


$namevalue ='password="'.md5($newPassword).'"';  
$where=' id="'.$_SESSION['agentUserid'].'" and parentId="'.$staticparentId.'"';
updatelisting('sys_userMaster',$namevalue,$where);

?>
<script> alert('Password Successfully Changed...!'); 
parent.redirectpage('settings');
</script>
<?php

}else{

?>
<script> alert('New Password and Confirm Password did not match...!');  
</script>
<?php

} 
 

}else{ 
?>
<script> alert('Old Password did not match...!');  
</script>
<?php

}
?>  

<?php 
exit();
}

if($_POST['action']=='flightcancellationforpax' && trim($_POST['id'])!="" && $_POST['paxid'] != ''){ 
  $tripsarray=array();
  $tripsarray2=array();
  
  $id=base64_decode(base64_decode($_POST['id']));
  $a=GetPageRecord('*','flightBookingMaster',' id="'.$id.'" '); 
  $editresult=mysqli_fetch_array($a);
  
   $remark=$_POST['remark'];
   $agentid=$_POST['agentid'];
   $requesttype=$_POST['requesttype'];
   $bookingid=$editresult['tboBookingId'];
   $source=$editresult['source'];
   $source=explode('-', $source);
   $destination=$editresult['destination'];
   $destination=explode('-', $destination);
   $journeyDate=$editresult['journeyDate'];
  
   $tripsarray['src']=$source[1];
   $tripsarray['dest']=$destination[1];
   $tripsarray['departureDate']=$journeyDate;

    $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$_POST['paxid'].'" and firstName!="" '); 
      $paxdata=mysqli_fetch_array($rs6);
  
      $travellersifoarr=array();
      $firstName=strtoupper($paxdata['firstName']);
      $lastName=strtoupper($paxdata['lastName']);
      $travellersifoarr['fn']=$firstName;
      $travellersifoarr['ln']=$lastName;
      $tripsarray['travellers'][]=$travellersifoarr;
  
     if($_POST['paxid2'] != ''){
      // echo $_POST['paxid2'];
      // die;
      $idcout=1;
      $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$_POST['paxid2'].'" and firstName!="" '); 
      $paxdata2=mysqli_fetch_array($rs9);
   
      $b=GetPageRecord('*','flightBookingMaster',' id="'.$paxdata2['BookingId'].'" '); 

      $editresult2=mysqli_fetch_array($b);
        $bookingId2=$editresult2['id'];
     $journeyDate2=$editresult2['journeyDate'];
      
  
      $tripsarray2['src']=$destination[1];
      $tripsarray2['dest']=$source[1];
      $tripsarray2['departureDate']=$journeyDate2;
  
  
      $travellersifoarr2=array();
  
      $firstName2=strtoupper($paxdata2['firstName']);
      $lastName2=strtoupper($paxdata2['lastName']);
      $travellersifoarr2['fn']=$firstName2;
      $travellersifoarr2['ln']=$lastName2;
      $tripsarray2['travellers'][]=$travellersifoarr2;
      
      
    }
 
  if($_POST['paxid2'] != ''){
  $arrayToRequest = array( 
  
    "bookingId" => $bookingid,
  
    "type" => $requesttype,
  
    "remarks" => $remark,
  
    "trips" => [$tripsarray,$tripsarray2],
    
  ); 
  }else{
    $arrayToRequest = array( 
  
      "bookingId" => $bookingid,
    
      "type" => $requesttype,
    
      "remarks" => $remark,
    
      "trips" => [$tripsarray],
      
    );
  }

   $postDataCancellation=json_encode($arrayToRequest);
  // print_r($postDataCancellation);
  // die;
  try
  
  {
   
  
    $restCaller = new RestApiCaller();
  
    $cancellationRequest = $restCaller->getTripJackResponse(_CANCELLATION_, $postDataCancellation);
  
    $cancellationResult = json_decode($cancellationRequest,true);
  
    if($cancellationResult['status']['success']==1)
  
    {
      $ammendmentId=$cancellationResult['amendmentId'];
      $Status=2;
  
    }
    //echo "<br>******Result*********<br>";
  
    //print_r($bookingResult);
  }
  
  catch(Exception $e)
  
  {
  
      $errhdng="Technical Error !!";
  
      $errmsg="Sorry Something went wrong.";
  
    $ErrorMessage=$errmsg;
  
     // include dirname(dirname(__FILE__)).'/error.php';
  
     // exit;
  
  }

    if(trim($ErrorMessage)!=''){

      $Status=0;
  
    }
 
    if($Status == 2){
      $namevalue ='agentId="'.$agentid.'" ,flightBookingId="'.$id.'",paxIds="'.$_POST['paxid'].'",remark="'.$remark.'",requestType="'.$requesttype.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'",ammendmentId="'.$ammendmentId.'"';  
      $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue); 

      
  $namevalue ='status="3"';  
  $where=' id="'.$_POST['paxid'].'"';
  updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);

  if($_POST['paxid2'] != ''){
    $namevalue ='status="3"';  
    $where=' id="'.$_POST['paxid2'].'"';
    updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
  }

       ?> 
<script>
parent.$('#showflightbookingcancelaltion').hide();
parent.$('#showflightbookingcancelaltion').html('');
parent.$('#showflightbookingcancelaltionthanks').show();
parent.window.location.reload();
</script>
      <?php
    } 
      else{
        $namevalue ='agentId="'.$agentid.'" ,flightBookingId="'.$id.'",paxIds="'.$_POST['paxid'].'",remark="'.$remark.'",requestType="'.$requesttype.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'"';  
        $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue);
         
    $namevalue ='status="0"';  
    $where=' id="'.$_POST['paxid'].'"';
    updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
      
    if($_POST['paxid2'] != ''){
      $namevalue ='status="0"';  
      $where=' id="'.$_POST['paxid2'].'"';
      updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
    }
        ?>
<script>
parent.$('#showflightbookingcancelaltion').hide();
parent.$('#showflightbookingcancelaltion').html('');
parent.$('#showflightbookingcancelaltionerror').show();
parent.window.location.reload();
</script>
    <?php }

    }






if($_POST['action']=='flightcancellation' && trim($_POST['id'])!=""){ 
$tripsarray=array();
$tripsarray2=array();

$id=base64_decode(base64_decode($_POST['id']));
$a=GetPageRecord('*','flightBookingMaster',' id="'.$id.'" '); 
$editresult=mysqli_fetch_array($a);

 $remark=$_POST['remark'];
 $agentid=$_POST['agentid'];
 $requesttype=$_POST['requesttype'];
 $bookingid=$editresult['tboBookingId'];
 $source=$editresult['source'];
 $source=explode('-', $source);
 $destination=$editresult['destination'];
 $destination=explode('-', $destination);
 $journeyDate=$editresult['journeyDate'];

 $tripsarray['src']=$source[1];
 $tripsarray['dest']=$destination[1];
 $tripsarray['departureDate']=$journeyDate;
 
    $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 
    while($paxdetail=mysqli_fetch_array($rs6)){
      if($paxcount['status'] != 3){
      $travellersifoarr=array();
    $firstName=strtoupper($paxdetail['firstName']);
    $lastName=strtoupper($paxdetail['lastName']);
    $travellersifoarr['fn']=$firstName;
    $travellersifoarr['ln']=$lastName;
    $tripsarray['travellers'][]=$travellersifoarr;
    //$tripsarray2['travellers'][]=$travellersifoarr;
      }
    }

    $idcout=1;
    if(!empty($editresult['roundTripId'])){
      $b=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'" '); 
      while($editresult2=mysqli_fetch_array($b)){
        $bookingId2[$idcout]=$editresult2['id'];
        $journeyDate2[$idcout]=$editresult2['journeyDate'];
        $idcout++;
      }
    }else{
      $bookingId2[2]='';
    }
    if($bookingId2[2] != ''){
            
    $tripsarray2['src']=$destination[1];
    $tripsarray2['dest']=$source[1];
    $tripsarray2['departureDate']=$journeyDate2[2];

    $rs9=GetPageRecord('COUNT(id) as totalcount','flightBookingPaxDetailMaster',' BookingId="'.$bookingId2[2].'" and firstName!="" '); 
    $paxcount2=mysqli_fetch_array($rs9);

    
    for($i=1; $i <= $paxcount2['totalcount']; $i++){
    $travellersifoarr2=array();
    $firstName2=strtoupper($_POST['firstName'.$i]);
    $lastName2=strtoupper($_POST['lastName'.$i]);
    $travellersifoarr2['fn']=$firstName2;
    $travellersifoarr2['ln']=$lastName2;
    $tripsarray2['travellers'][]=$travellersifoarr2;
    }

    }

if(!empty($bookingId2[2])){
$arrayToRequest = array( 

  "bookingId" => $bookingid,

  "type" => $requesttype,

  "remarks" => $remark,

  "trips" => [$tripsarray,$tripsarray2],
  
); 
}else{
  $arrayToRequest = array( 

    "bookingId" => $bookingid,
  
    "type" => $requesttype,
  
    "remarks" => $remark,
  
    "trips" => [$tripsarray],
    
  );
}

 $postDataCancellation=json_encode($arrayToRequest);
// print_r($postDataCancellation);
// die;
try

{
 

	$restCaller = new RestApiCaller();

	$cancellationRequest = $restCaller->getTripJackResponse(_CANCELLATION_, $postDataCancellation);

	$cancellationResult = json_decode($cancellationRequest,true);

	if($cancellationResult['status']['success']==1)

	{
    $ammendmentId=$cancellationResult['amendmentId'];
		$Status=2;

	}
	//echo "<br>******Result*********<br>";

	//print_r($bookingResult);

}

catch(Exception $e)

{

    $errhdng="Technical Error !!";

    $errmsg="Sorry Something went wrong.";

	$ErrorMessage=$errmsg;

   // include dirname(dirname(__FILE__)).'/error.php';

   // exit;

}

if(trim($ErrorMessage)!=''){

  $Status=0;

}

if($Status == 2){
  $namevalue ='agentId="'.$agentid.'" ,flightBookingId="'.$id.'",remark="'.$remark.'",requestType="'.$requesttype.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'",ammendmentId="'.$ammendmentId.'"';  
  $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue); 

  $namevalue ='status="3"';  
  $where=' id="'.$id.'"';
  updatelisting('flightBookingMaster',$namevalue,$where);
  if($$bookingId2[2] != ''){
  $namevalue ='status="3"';  
  $where=' id="'.$bookingId2[2].'"';
  updatelisting('flightBookingMaster',$namevalue,$where);
  }
   ?> 
  <script>
  parent.$('#showflightbookingcancelaltion').hide();
  parent.$('#showflightbookingcancelaltion').html('');
  parent.$('#showflightbookingcancelaltionthanks').show();
 parent.window.location.reload();
  </script>
      <?php
    }
  else{
    $namevalue ='agentId="'.$agentid.'" ,flightBookingId="'.$id.'",remark="'.$remark.'",requestType="'.$requesttype.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'"';  
    $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue);
    ?>
    <script>
    parent.$('#showflightbookingcancelaltion').hide();
    parent.$('#showflightbookingcancelaltion').html('');
    parent.$('#showflightbookingcancelaltionerror').show();
    parent.window.location.reload();
    </script>
       <?php  }
}




if($_POST['action']=='submithotelenquiry' && trim($_POST['name'])!="" && trim($_POST['mobile'])!="" && trim($_POST['email'])!="" && trim($_POST['hotelName'])!="" && trim($_POST['roomName'])!=""){ 

 $namevalue ='name="'.addslashes($_POST['name']).'",mobile="'.addslashes($_POST['mobile']).'",email="'.addslashes($_POST['email']).'",notes="'.addslashes($_POST['notes']).'",hotelName="'.addslashes($_POST['hotelName']).'",roomName="'.addslashes($_POST['roomName']).'",room="'.addslashes($_POST['room']).'",adult="'.addslashes($_POST['adult']).'",child="'.addslashes($_POST['child']).'",startDate="'.date('Y-m-d',strtotime($_POST['startdate'])).'",endDate="'.date('Y-m-d',strtotime($_POST['enddate'])).'",city="'.addslashes($_POST['city']).'",addDate="'.date('Y-m-d H:i:s').'",agentId="'.$_SESSION['agentUserid'].'"';  
 $bookinglastId = addlistinggetlastid('hotelEnquiry',$namevalue); 
 
 
 
 
 
 $subject = 'New Enquiry Received For Hotel';
 

$mailbody=' <table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td colspan="3" bgcolor="#F5F5F5"><strong>Hotel Enquiry</strong> </td>
  </tr>
  <tr>
    <td><strong>Name</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['name']).'</td>
  </tr>
  <tr>
    <td><strong>Phone</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['mobile']).'</td>
  </tr>
  <tr>
    <td><strong>Email</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['email']).'</td>
  </tr>
  <tr>
    <td><strong>Notes</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['notes']).'</td>
  </tr>
  <tr>
    <td><strong>Hotel</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['hotelName']).'</td>
  </tr>
  <tr>
    <td><strong>Room</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['roomName']).'</td>
  </tr>
  <tr>
    <td><strong>Hotel City </strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['city']).'</td>
  </tr>
  <tr>
    <td><strong>No of rooms </strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['room']).'</td>
  </tr>
  <tr>
    <td><strong>Adult</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['adult']).'</td>
  </tr>
  <tr>
    <td><strong>Child</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['child']).'</td>
  </tr>
  <tr>
    <td><strong>Checkin</strong></td>
    <td><strong>:</strong></td>
    <td>'.date('d-m-Y',strtotime($_POST['startdate'])).'</td>
  </tr>
  <tr>
    <td><strong>Checkout</strong></td>
    <td><strong>:</strong></td>
    <td>'.date('d-m-Y',strtotime($_POST['enddate'])).'</td>
  </tr>
  
</table>';

 
 
 
 
 
  sendmainmail($getcompanybasicinfo['email'],$subject,$mailbody);
 
?>
<script>
parent.$('#showflightbookingcancelaltion').hide();
parent.$('#showflightbookingcancelaltion').html('');
parent.$('#showflightbookingcancelaltionthanks').show();
</script>
<?php
}




if($_POST['action']=='submitpackageenquiry' && trim($_POST['name'])!="" && trim($_POST['mobile'])!="" && trim($_POST['email'])!="" && trim($_POST['citydestination'])!="" && trim($_POST['departureCity'])!=""){ 

 $namevalue ='name="'.addslashes($_POST['name']).'",mobile="'.addslashes($_POST['mobile']).'",email="'.addslashes($_POST['email']).'",packageName="'.addslashes($_POST['packageName']).'",citydestination="'.addslashes($_POST['citydestination']).'",departureCity="'.addslashes($_POST['departureCity']).'",departureDate="'.date('Y-m-d',strtotime($_POST['departuredate'])).'",addDate="'.date('Y-m-d H:i:s').'",agentId="'.$_SESSION['agentUserid'].'"';  
 $bookinglastId = addlistinggetlastid('packageEnquiry',$namevalue); 
 
 
 
 
 
 $subject = 'New Enquiry Received For Package';
 

$mailbody=' <table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td colspan="3" bgcolor="#F5F5F5"><strong>Package Enquiry</strong> </td>
  </tr>
  <tr>
    <td><strong>Name</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['name']).'</td>
  </tr>
  <tr>
    <td><strong>Phone</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['mobile']).'</td>
  </tr>
  <tr>
    <td><strong>Email</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['email']).'</td>
  </tr>
  
   <tr>
    <td><strong>Package</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['packageName']).'</td>
  </tr>
  <tr>
    <td><strong>Destination</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['citydestination']).'</td>
  </tr>
  <tr>
    <td><strong>City of Departure</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['departureCity']).'</td>
  </tr>
  <tr>
    <td><strong>Date of Departure</strong></td>
    <td><strong>:</strong></td>
    <td>'.addslashes($_POST['departuredate']).'</td>
  </tr>
  
  
</table>';

 
 

 
 
 sendmainmail($getcompanybasicinfo['email'],$subject,$mailbody);
 
 
?>
<script>
parent.$('#showflightbookingcancelaltion').hide();
parent.$('#showflightbookingcancelaltion').html('');
parent.$('#showflightbookingcancelaltionthanks').show();
</script>
<?php
}


if($_REQUEST['action']=='onlineRecharge' && $_REQUEST['amount']!=""){

$amount=0;

if($_POST['pg_name']=="DC"){
  
 
  $amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.0085));
  //echo "second".$amount; exit;
}

if($_POST['pg_name']=="DCR"){
if(isset($_POST['rupay']) && $_POST['rupay'] == 1)
{
  $amount=round($_REQUEST["amount"]);
  //echo "first".$amount; exit;
}
else 
  $amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.0085));
  //echo "second".$amount; exit;
}



if($_POST['pg_name']=="CC"){
$amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.019));
}

if($_POST['pg_name']=="MW"){
$amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.0175));
}

if($_POST['pg_name']=="NB"){
$amount=round($_REQUEST["amount"]+17);
}

if($_POST['pg_name']=="UPI"){
$amount=round($_REQUEST['amount']);
}


$note=addslashes($_REQUEST['notes']);
$token=rand(89898,543132113).strtotime(date('YmdHis'));
$booking_payment_type=addslashes($_REQUEST['booking_payment_type']);

$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 
if(mysqli_num_rows($chkrow)==0){

$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.round($_REQUEST["amount"]).'",note="'.$note.'",status="pending",bookingType="'.$_REQUEST["booking_payment_type"].'",serviceId="'.$_SESSION['serviceId'].'",merchant_param1="'.$_REQUEST["booking_payment_type"].'",merchant_param2="'.$token.'",merchant_param3="'.$_SESSION['agentUserid'].'",merchant_param4="'.$_SESSION['parentAgentId'].'",merchant_param5="'.$_SESSION['parentid'].'",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'" ';
$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);
$floatValue = number_format((float)$amount, 2, '.', '');  // return float

$_SESSION["txnID"]=encode($txnID);
$_SESSION["token"]=encode($token);
$_SESSION["amount"]=trim($floatValue);
$_SESSION["first_name"]=strip($LoginUserDetails['name']);
$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);
$_SESSION["phone"]=strip($LoginUserDetails['phone']);
$_SESSION["user_email"]=strip($LoginUserDetails['email']);
$_SESSION["show_payment_mode"]='';
$_SESSION["order_id"]=encode($txnID);
$_SESSION["token"]=$token;
$_SESSION["pg_name"]=$_POST['pg_name'];
$_SESSION['req_amount']=round($_REQUEST["amount"]);
header("Location:easebuzzPayment.php?actionType=".$_REQUEST["booking_payment_type"]);

exit();
}

}




if($_REQUEST['action']=='onlineRecharge__________PayuMoney' && $_REQUEST['amount']!=""){
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

<!--
    <form id="redirectForm" name="redirectForm" method="post" action="<?php echo $fullurl; ?>request.php" style="display:none;">
		<input type="hidden" name="appId" value=""/>
		<input type="hidden" name="orderId" value="<?php echo $txnID; ?>"/>
		<input type="hidden" name="orderAmount" value="<?php echo trim($amount); ?>"/>
        <input type="hidden" name="orderCurrency" value="INR"/>
        <input type="hidden" name="orderNote" placeholder="<?php echo strip($note); ?>"/>
        <input type="hidden" name="customerName" value="<?php echo strip($LoginUserDetails['name'])."".strip($LoginUserDetails['lastName']); ?>" />
        <input type="hidden" name="customerEmail" value="<?php echo strip($LoginUserDetails['email']); ?>"/>
		<input type="hidden" name="customerPhone" value="<?php echo strip($LoginUserDetails['phone']); ?>"/>
        <input class="form-control" name="returnUrl" value="https://pay.tripzygo.travel/response.php"/> 
        <input class="form-control" name="notifyUrl" value="https://pay.tripzygo.travel/response.php"/>
        <button type="submit" class="btn btn-primary btn-block" value="Pay">Submit</button>
      </form>

<script type="text/javascript">
document.redirectForm.submit();
</script>
-->

<?php
exit();
}

}






/*
if($_POST['action']=='onlineRechargeFlightBook' && $_POST['amount']!=""){

$booking_payment_type=addslashes($_POST['booking_payment_type']);
$amount=addslashes($_POST['amount']);
$note=addslashes($_POST['notes']);
$token=addslashes($_POST['token']);

$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 
if(mysqli_num_rows($chkrow)==0){

$amount=round($_POST['amount']);

$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'" ';
$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);

$floatValue = number_format((float)$amount, 2, '.', '');  // return float

$_SESSION["txnID"]=encode($token);
$_SESSION["amount"]=trim($floatValue);
$_SESSION["first_name"]=strip($LoginUserDetails['name']);
$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);
$_SESSION["phone"]=strip($LoginUserDetails['phone']);
$_SESSION["user_email"]=strip($LoginUserDetails['email']);
$_SESSION["show_payment_mode"]=$show_payment_mode;
$_SESSION["order_id"]=encode($token);
$_SESSION["token"]=$token;
header("Location:easebuzzPayment.php?actionType=".$_REQUEST["booking_payment_type"]);

exit();

}

}
*/






if($_POST['action']=='resetpassword' && trim($_POST['email'])!=""){ 




$rs=GetPageRecord('*','sys_userMaster','  email="'.$_REQUEST['email'].'" and parentId="'.$staticparentId.'" '); 
if(mysqli_num_rows($rs)>0){
$LoginUserDetails=mysqli_fetch_array($rs); 
 
$password=rand ( 10000000 , 99999999 );

$namevalue ='password="'.md5($password).'"';  
$where=' id="'.$LoginUserDetails['id'].'" and parentId="'.$staticparentId.'"';
updatelisting('sys_userMaster',$namevalue,$where);

 
 $subject = 'Reset Password';
 

$mailbody=' <div style="text-align:center; width:100%; padding:20px 0px; background-color:#F4F4F4">
<table width="638" border="0" align="center" cellpadding="5" cellspacing="0" style="border: 1px solid #efefef; background-color:#FFFFFF;">
  <tr>
    <td colspan="3" style="padding:20px;"><div align="left"><img src="'.$imgurlagent.$AgentWebsiteData['companyLogo'].'" height="45"></div></td>
  </tr>
  <tr>
    <td colspan="3"  style="padding:20px;"><div align="left">Dear '.stripslashes($LoginUserDetails['name']).',
    .<br />
  <br />
      
  <strong>Your updated login credentials</strong><br />
  <br />
      
      Login Page URL: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a><br />
  <br />
      
      Username: '.stripslashes($LoginUserDetails['email']).'<br /> 
      
      Password: '.$password.'<br />
  <br />
      
      
       
    </div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#dc3545" style="padding:20px; color:#fff;"><table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:16px; color:#fff;">
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
</div>';

 
 sendmainmail($LoginUserDetails['email'],$subject,$mailbody); 



} else {
?>
<script> alert('Email address not registered with us');  
</script>
<?php
exit();
}
 
 
 
 
 
?>
<script>
parent.$('.showflightbookingcancelaltion').hide();
parent.$('#showflightbookingcancelaltion').html('');
parent.$('#showflightbookingcancelaltionthanks').show();
</script>
<?php
}

if($_REQUEST['action']=='applycop' && $_REQUEST['id']!='' && $_REQUEST['bid']!='' && $_REQUEST['displayprice']!=''){

$id=decode($_REQUEST['id']);
$bid=decode($_REQUEST['bid']);

$a=GetPageRecord('*','couponCodeMaster','id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 

$usage=GetPageRecord('id','flightBookingMaster','couponCode="'.$res["couponCode"].'"');
$total_usage=mysqli_num_rows($usage);

$minAmt=GetPageRecord('*','couponCodeMaster',' couponCode="'.$res["couponCode"].'" and featured="1" and status="1" and fromDate<="'.date('Y-m-d').'" and minAmount<="'.$_REQUEST['displayprice'].'" and useslimit>"'.$total_usage.'"');

if($res["useslimit"]>$total_usage && mysqli_num_rows($minAmt)>0){

if($res['discountType']==1){
$couponValue=trim(($res['discount']*$_REQUEST['displayprice'])/100);
}
if($res['discountType']==2){
$couponValue=$res['discount'];
}

$couponType=stripslashes($res['couponType']);
$couponCode=stripslashes($res['couponCode']);

$namevalue ='couponType="'.$couponType.'",discountType="'.$res['discountType'].'",couponCode="'.$couponCode.'",couponValue="'.$couponValue.'"';
$where='id="'.$bid.'"';
updatelisting('wig_flight_json_bkp',$namevalue,$where);
?>
<div style="font-size:14px; border:1px solid #6cf7c3; padding:15px; background-color:#effff6; margin-bottom:10px; overflow:hidden;">
<i class="fa fa-check-circle" aria-hidden="true" style="color:#339900;"></i> &nbsp;Congrats! You have availed a discount <?php if($res['couponType']==2){echo "(Cashback)";} ?>  of <?php echo $couponValue; ?> INR , TnC apply.
<!--<div style="overflow:hidden;">
<a href="#" onclick="removeapplycop();" style=" background-color:#CC0000; color:#fff; font-size:11px; padding:2px 10px; float:right;border-radius:2px;">Remove</a></div>-->
</div>

<script>
/*
$('#discountapply').text('<?php echo $couponValue; ?>');
$('#discountAmt').text('<?php echo $couponValue; ?>');
$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');
$('#discountAmtDiv').show();
*/
</script>

<?php if($res['couponType']==1){ ?>
<script>
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');
$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');
$('#displayprice').text('<?php echo ($_REQUEST['displayprice']-$couponValue); ?>');
</script>
<?php } ?>

<?php if($res['couponType']==2){ ?>
o<script>
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');
$('#arq').val('<?php echo ($_REQUEST['displayprice'])+202565517+202565517; ?>');
$('#displayprice').text('<?php echo ($_REQUEST['displayprice']); ?>');
</script>
<?php } ?>

<script>
$('#couponCodeApply').val('<?php echo $couponCode; ?>');
$('#discountapply').text('<?php echo $couponValue; ?>');
$('#discountAmt').text('<?php echo $couponValue; ?>');
$('#discountAmtDiv').show();
</script>


<?php
}else{
$namevalue ='couponType="",discountType="",couponCode="",couponValue=""'; 
$where='id="'.$bid.'"';   
updatelisting('wig_flight_json_bkp',$namevalue,$where);
?>
<script>
$('#discountapply').text('');
$('#displayprice').text('');
$('#discountAmt').text('');
$('#discountAmtDiv').hide();
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');
$('#arq').val('<?php echo $_REQUEST['displayprice']+202565517+202565517; ?>');

alert('This Coupon is not valid or limit exceed...!');
</script>
<?php
}

} 

if($_REQUEST['action']=='removeapplycop' && $_REQUEST['id']!='' && $_REQUEST['bid']!='' && $_REQUEST['displayprice']!=''){

$id=decode($_REQUEST['id']);
$bid=decode($_REQUEST['bid']); 

$namevalue ='couponType="",discountType="",couponCode="",couponValue=""'; 
$where='id="'.$bid.'"';   
updatelisting('wig_flight_json_bkp',$namevalue,$where);

?> 

<script>
$('#couponCodeApply').val('');
$('#discountAmtDiv').hide();
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');
$('#displayprice').text('<?php echo ($_REQUEST['displayprice']); ?>');
$('#arq').val('<?php echo $_REQUEST['displayprice']+202565517+202565517; ?>');
</script>

<?php
} 


if($_REQUEST['action']=='applycopmanual' && $_REQUEST['couponcode']!='' && $_REQUEST['bid']!='' && $_REQUEST['displayprice']!=''){

$couponcode=trim($_REQUEST['couponcode']);
$bid=decode($_REQUEST['bid']);

$usage=GetPageRecord('id','flightBookingMaster','couponCode="'.$couponcode.'"');
$total_usage=mysqli_num_rows($usage);

$a=GetPageRecord('*','couponCodeMaster',' couponCode="'.$couponcode.'" and featured="1" and status="1" and fromDate<="'.date('Y-m-d').'" and minAmount<="'.$_REQUEST['displayprice'].'" and useslimit>"'.$total_usage.'"');
if(mysqli_num_rows($a)<1){
?>
<script>
alert('This Coupon is not valid...!');
</script>
<?php
exit();
}else{
$res=mysqli_fetch_array($a); 

if($res['discountType']==1){
$couponValue=trim(($res['discount']*$_REQUEST['displayprice'])/100);
}
if($res['discountType']==2){
$couponValue=$res['discount'];
}

$couponCode=stripslashes($res['couponCode']);
$couponValue=stripslashes($couponValue);

$namevalue ='couponType="'.$res['couponType'].'",discountType="'.$res['discountType'].'",couponCode="'.$couponCode.'",couponValue="'.$couponValue.'"';
$where='id="'.$bid.'"';   
updatelisting('wig_flight_json_bkp',$namevalue,$where);

?>
<div style="font-size:14px; border:1px solid #6cf7c3; padding:15px; background-color:#effff6; margin-bottom:10px; overflow:hidden;">
<i class="fa fa-check-circle" aria-hidden="true" style="color:#339900;"></i> &nbsp;Congrats! You have availed a discount <?php if($res['couponType']==2){echo "(Cashback)";} ?> of <?php echo $couponValue; ?> INR , TnC apply.
<!--<div style="overflow:hidden;">
<a href="#" onclick="removeapplycop();" style=" background-color:#CC0000; color:#fff; font-size:11px; padding:2px 10px; float:right;border-radius:2px;">Remove</a></div>-->
</div>

<script>
/*
$('#discountAmt').text('<?php echo $couponValue; ?>');
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');
$('#discountAmtDiv').show();
$('.appliedbtn').show();
$('.applybtn').hide(); 
$('#discountapply').text('<?php echo $couponValue; ?>');
$('#displayprice').text('<?php echo ($_REQUEST['displayprice']-$couponValue); ?>');
$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');
*/
</script>


<?php if($res['couponType']==1){ ?>
<script>
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');
$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');
$('#displayprice').text('<?php echo ($_REQUEST['displayprice']-$couponValue); ?>');
</script>
<?php } ?>

<?php if($res['couponType']==2){ ?>
<script>
$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');
$('#arq').val('<?php echo ($_REQUEST['displayprice'])+202565517+202565517; ?>');
$('#displayprice').text('<?php echo ($_REQUEST['displayprice']); ?>');
</script>
<?php } ?>

<script>
$('#discountAmt').text('<?php echo $couponValue; ?>');
$('#discountAmtDiv').show();
$('.appliedbtn').show();
$('.applybtn').hide(); 
$('#couponCodeApply').val('<?php echo $couponCode; ?>');
$('#discountapply').text('<?php echo $couponValue; ?>');
</script>



<?php
}
} 






 
 
 
 
 
 if(trim($_POST['action'])=='addlandingpage' && trim($_POST['name'])!=''){  
 
 
$name=addslashes($_POST['name']);   
$bannerHeading=addslashes($_POST['bannerHeading']);  
$pageURL=str_replace(' ','-',addslashes($_POST['pageURL']));   
$bannerSubHeading=addslashes($_POST['bannerSubHeading']);    
$enquiryHeading=addslashes($_POST['enquiryHeading']);    
$enquirySubHeading=addslashes($_POST['enquirySubHeading']);    
$contactNumber=addslashes($_POST['contactNumber']);    
$emailId=addslashes($_POST['emailId']);    
$address=addslashes($_POST['address']);    
$mainHeading=addslashes($_POST['mainHeading']);     
$description=addslashes($_POST['description']);     
$leadSource=addslashes($_POST['leadSource']);     
$facebook=addslashes($_POST['facebook']);     
$instagram=addslashes($_POST['instagram']);     
$twitter=addslashes($_POST['twitter']);     
$youtube=addslashes($_POST['youtube']);     
$pinterest=addslashes($_POST['pinterest']);   
$metaTitle=addslashes($_POST['metaTitle']);   
$metaDescription=addslashes($_POST['metaDescription']);   
$metaKeyword=addslashes($_POST['metaKeyword']);   
$headerScript=addslashes($_POST['headerScript']);       
$footerScript=addslashes($_POST['footerScript']);      
$oldphoto=addslashes($_POST['bannerold']);     
$companyLogoold=addslashes($_POST['companyLogoold']);    
$status=addslashes($_POST['status']);        
$packages=addslashes($_POST['packages']);    
$editid=decode($_POST['editid']);
  
  
  
  
if($_FILES["banner"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['banner']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["banner"]["tmp_name"], "package_image/{$profilePhoto}");  
} 
if($profilePhoto==''){ 
$profilePhoto=$oldphoto; 
} 
  
  
  
  
if($_FILES["companyLogo"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhotocompany=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "package_image/{$profilePhotocompany}");  
} 
if($profilePhotocompany==''){ 
$profilePhotocompany=$companyLogoold; 
} 
  

if($editid!=''){  

$namevalue ='name="'.$name.'",bannerHeading="'.$bannerHeading.'",bannerSubHeading="'.$bannerSubHeading.'",companyLogo="'.$profilePhotocompany.'",packages="'.$packages.'",enquiryHeading="'.$enquiryHeading.'",enquirySubHeading="'.$enquirySubHeading.'",contactNumber="'.$contactNumber.'",emailId="'.$emailId.'",address="'.$address.'",mainHeading="'.$mainHeading.'",description="'.$description.'",leadSource="'.$leadSource.'",facebook="'.$facebook.'",instagram="'.$instagram.'",twitter="'.$twitter.'",youtube="'.$youtube.'",pinterest="'.$pinterest.'",metaTitle="'.$metaTitle.'",metaDescription="'.$metaDescription.'",metaKeyword="'.$metaKeyword.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",pageURL="'.$pageURL.'",banner="'.$profilePhoto.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['agentUserid'].'"';
$where='id="'.$editid.'"';    
updatelisting('landingPages',$namevalue,$where);  
  
} else {  
$namevalue ='name="'.$name.'",bannerHeading="'.$bannerHeading.'",bannerSubHeading="'.$bannerSubHeading.'",companyLogo="'.$profilePhotocompany.'",packages="'.$packages.'",enquiryHeading="'.$enquiryHeading.'",enquirySubHeading="'.$enquirySubHeading.'",contactNumber="'.$contactNumber.'",emailId="'.$emailId.'",address="'.$address.'",mainHeading="'.$mainHeading.'",description="'.$description.'",leadSource="'.$leadSource.'",facebook="'.$facebook.'",instagram="'.$instagram.'",twitter="'.$twitter.'",youtube="'.$youtube.'",pinterest="'.$pinterest.'",metaTitle="'.$metaTitle.'",metaDescription="'.$metaDescription.'",metaKeyword="'.$metaKeyword.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",pageURL="'.$pageURL.'",banner="'.$profilePhoto.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['agentUserid'].'"';
addlistinggetlastid('landingPages',$namevalue);  
  
}  
 


?> 
<script> 
parent.redirectpage('landing-page'); 
</script> 
<?php 
}










if($_POST['action']=='savechangequerystatus' && $_POST['editid']!="" && $_POST['status']!="" && $_POST['statusname']!=""){

$comment=addslashes($_POST['comment']);
$status=addslashes($_POST['status']); 
$editid=addslashes($_POST['editid']); 
$closureReasons=addslashes($_POST['closureReasons']); 
  
if($closureReasons!=''){
$closureReasons=$closureReasons;





//------------Send Mail--------------------


$rs7=GetPageRecord('*','queryMaster','   id="'.decode($editid).'" '); 
$res=mysqli_fetch_array($rs7);

$a=GetPageRecord('*','emailTemplates','  emailTemplateType="Lead Closer"'); 
$resTemplate=mysqli_fetch_array($a);

$subject=queryreplacetags(decode($editid),stripslashes($resTemplate['emailSubject']));
$description=queryreplacetags(decode($editid),stripslashes($resTemplate['emailContent']));
 
$ccmail=''; 
$attachment='';

//send_attachment_mail($frommail,$res['contactEmail'],$subject,$description,$ccmail,$attachment);

//------------Send Mail--------------------



} else {
$closureReasons=0;
}

if($editid!=''){

//-------EDIT-----------

$namevalue ='status="'.decode($status).'",editDate="'.date('Y-m-d H:i:s').'",editBy="'.$_SESSION['agentUserid'].'",closureReasons="'.$closureReasons.'"';  
$where='  id="'.decode($editid).'"';   
updatelisting('queryMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='Query Status Changed To ".str_replace('%20',' ',$_POST['statusname'])."',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',comment='".$_POST['comment']."',addDate='".time()."'";   

}  
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

?>
<script> 
parent.redirectpage('query-view?id=<?php echo $_POST['editid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');
</script>

<?php
exit();
}





if($_POST['action']=='savequerynote' && $_POST['editid']!="" && $_POST['comment']!=""){

$comment=addslashes($_POST['comment']); 
$editid=addslashes($_POST['editid']); 


  

if($editid!=''){

//-------EDIT-----------



$namevalue ='comment="'.$comment.'",queryId="'.decode($editid).'",parentId="'.$LoginUserDetails['parentId'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['agentUserid'].'"';   
$lastid=addlistinggetlastid('queryNote',$namevalue);  

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='Query Note Added',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";   

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 


$namevalue ='editDate="'.date('Y-m-d H:i:s').'",editBy="'.$_SESSION['agentUserid'].'"';  
$where='parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($editid).'"';   
updatelisting('queryMaster',$namevalue,$where); 
}  
 

 

?>
<script>
parent.redirectpage('query-view?id=<?php echo $_POST['editid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');
</script>

<?php
exit();
}








if($_POST['action']=='fixedMarkupAgent'){

$count=count($_REQUEST["flightId"]);

if($count>0){
	mysqli_query(db(),'delete from fixedMarkupAgent where agentId="'.$_SESSION['agentUserid'].'"');
}



for($i=0;$i<$count;$i++){
	
	$flightId=$_REQUEST["flightId"][$i];
	$type=$_REQUEST["type"][$i];
	$value=$_REQUEST["value"][$i];
$namevalue='flightId="'.$flightId.'",type="'.$type.'",value="'.$value.'",agentId="'.$_SESSION['agentUserid'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['agentUserid'].'"';
$lastid=addlistinggetlastid('fixedMarkupAgent',$namevalue);

}
?>
<script>
location.href='<?php echo $fullurl; ?>settings';
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
$description=addslashes($_POST['description']);
 
$editid=addslashes($_POST['editid']);
$clientId=decode($_POST['clientId']);
$queryStage=decode($_POST['queryStage']);
 
 
$rs7=GetPageRecord('*','clientMaster',' parentId="'.$LoginUserDetails['parentId'].'" and (phone="'.trim($contactNumber).'" or email="'.trim($contactEmail).'") order by id desc limit 0,1 '); 
$checkclient=mysqli_fetch_array($rs7);


$clientId=$checkclient['id'];

if($checkclient['id']!=''){

$namevalue ='companyName="'.$companyName.'",nameHead="'.$nameHead.'",name="'.$contactPerson.'",phone="'.$contactNumber.'",email="'.$contactEmail.'",clientCountry="'.$contactCountry.'",clientState="'.$contactState.'",clientCity="'.$contactCity.'",editBy="'.$_SESSION['agentUserid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$LoginUserDetails['parentId'].'" and id="'.$clientId.'"';   
updatelisting('clientMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='client',sectionId='".$checkclient['id']."',details='".$contactPerson." Client Updated',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";   

} else { 

$namevalue ='clientType="'.$queryType.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",name="'.$contactPerson.'",phone="'.$contactNumber.'",email="'.$contactEmail.'",clientCountry="'.$contactCountry.'",clientState="'.$contactState.'",clientCity="'.$contactCity.'",addBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$LoginUserDetails['parentId'].'"'; 
 
$clientId=addlistinggetlastid('clientMaster',$namevalue); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='client',sectionId='".$clientId."',details='".$contactPerson." Client Added',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'"; 

}

 

if($editid!=''){

//-------EDIT-----------

$namevalue ='contactNumber="'.$contactNumber.'",contactEmail="'.$contactEmail.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",contactPerson="'.$contactPerson.'",contactCountry="'.$contactCountry.'",contactState="'.$contactState.'",contactCity="'.$contactCity.'",travelFromCity="'.$travelFromCity.'",travelLocation="'.$travelLocation.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",querySource="'.$querySource.'",queryPriority="'.$queryPriority.'",assignTo="'.$assignTo.'",typePackage="'.$typePackage.'",typeFlight="'.$typeFlight.'",typeTransfer="'.$typeTransfer.'",typeHotel="'.$typeHotel.'",description="'.$description.'",typeSightseeing="'.$typeSightseeing.'",typeMiscellaneous="'.$typeMiscellaneous.'",editBy="'.$_SESSION['agentUserid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='  id="'.decode($editid).'"';   
updatelisting('queryMaster',$namevalue,$where); 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='#".$editid." Query Updated',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";   

} else { 

//-------ADD-----------

$namevalue ='queryType="'.$queryType.'",contactNumber="'.$contactNumber.'",clientId="'.$clientId.'",contactEmail="'.$contactEmail.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",contactPerson="'.$contactPerson.'",contactCountry="'.$contactCountry.'",contactState="'.$contactState.'",contactCity="'.$contactCity.'",travelFromCity="'.$travelFromCity.'",travelLocation="'.$travelLocation.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",querySource="'.$querySource.'",queryPriority="'.$queryPriority.'",assignTo="'.$assignTo.'",typePackage="'.$typePackage.'",typeFlight="'.$typeFlight.'",typeTransfer="'.$typeTransfer.'",typeHotel="'.$typeHotel.'",typeSightseeing="'.$typeSightseeing.'",typeMiscellaneous="'.$typeMiscellaneous.'",status="'.$queryStage.'",addBy="'.$_SESSION['agentUserid'].'",description="'.$description.'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$LoginUserDetails['parentId'].'"'; 

$lastid=addlistinggetlastid('queryMaster',$namevalue);   

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#".encode($lastid)." Query Added',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";








//------------Send Mail To User--------------------

$a=GetPageRecord('*','emailTemplates',' parentId="'.$LoginUserDetails['parentId'].'"  and emailTemplateType="Assigned Query"'); 
$resTemplate=mysqli_fetch_array($a);

$subject=queryreplacetags($lastid,stripslashes($resTemplate['emailSubject']));
$description=queryreplacetags($lastid,stripslashes($resTemplate['emailContent']));
 
$ccmail=''; 
$attachment='';

$rs7=GetPageRecord('*','sys_userMaster','  id="'.$assignTo.'"'); 
$res=mysqli_fetch_array($rs7);

send_attachment_mail($frommail,$res['email'],$subject,$description,$ccmail,$attachment);

//------------Send Mail To User--------------------





//------------Send Mail To Client--------------------

$a=GetPageRecord('*','emailTemplates','   emailTemplateType="New Lead"'); 
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
parent.redirectpage('querylist?<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');
</script>

<?php
exit();
}





if(trim($_POST['action'])=='savemailsetting' && trim($_POST['fromName'])!='' && trim($_POST['emailAccount'])!='' && trim($_POST['emailPassword'])!='' && trim($_POST['smtpServer'])!='' && trim($_POST['emailPort'])!=''){ 
 

$fromName=$_POST['fromName'];  
$emailAccount=$_POST['emailAccount'];  
$emailPassword=$_POST['emailPassword'];  
$smtpServer=$_POST['smtpServer'];  
$emailPort=$_POST['emailPort'];  
$securityType=$_POST['securityType'];  

$namevalue ='fromName="'.$fromName.'",emailAccount="'.$emailAccount.'",emailPassword="'.$emailPassword.'",smtpServer="'.$smtpServer.'",emailPort="'.$emailPort.'",securityType="'.$securityType.'"'; 
$where='id="'.$_SESSION['agentUserid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where); 

 

?> 
<script>   
parent.redirectpage('my-profile'); 
</script> 
<?php  } 




if($_REQUEST['action']=='additinerary' && $_REQUEST['quotationtype']!=""){

$queryid=addslashes($_REQUEST['queryid']); 
$quotationtype=addslashes($_REQUEST['quotationtype']); 
$editid=addslashes($_POST['editid']); 
 

if($editid!=''){ 
} else {


//-------------ADD-----------------

$namevalue ='startDate="'.date('Y-m-d').'",endDate="'.date('Y-m-d').'",adult=1,child=0,infant=0,quotationType="'.$quotationtype.'",addBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['agentUserid'].'",dayWise=1'; 

$lastid=addlistinggetlastid('quotationMaster',$namevalue);  



if($_REQUEST['quotationtype']=='Detailed Package'){

$ha=GetPageRecord('*','packageTermsConditions','  parentId="'.$LoginUserDetails['parentId'].'" order by id asc');
while($listdata=mysqli_fetch_array($ha)){ 

$namevalue ='termType="'.$listdata['termType'].'",termDescription="'.addslashes($listdata['termDescription']).'",quotationId="'.$lastid.'",parentId="'.$_SESSION['agentUserid'].'"';  
addlistinggetlastid('quotationTerms',$namevalue); 

}




$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 
$branchData=mysqli_fetch_array($ab);

$namevalue ='quotationId="'.$lastid.'",parentId="'.$_SESSION['agentUserid'].'",CGST="'.$branchData['taxName1'].'",SGST="'.$branchData['taxName2'].'",IGST="'.$branchData['taxName3'].'",TCS="'.$branchData['taxName4'].'",currencyId="'.$branchData['currency'].'"';  
addlistinggetlastid('sys_quickPackageOptions',$namevalue);  

}

 

$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#QT".encode($lastid)." Quotation Added in #".$queryid."',userId='".$_SESSION['agentUserid']."',parentId='".$_SESSION['agentUserid']."',addDate='".time()."'"; 
}
  

?>
<script>
parent.redirectpage('add-quotation?id=<?php echo encode($lastid); ?>&save=1');
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



$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($editid).'" '); 
$editresult=mysqli_fetch_array($rs5);

if($editresult['queryId']==0){
$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'",packageTheme="'.$packageTheme.'",destination="'.$destination.'",showOnWebsite="'.$showOnWebsite.'",nights="'.$nights.'",flighticon="'.$flighticon.'",hotelicon="'.$hotelicon.'",sightseeingicon="'.$sightseeingicon.'",transfericon="'.$transfericon.'",activityicon="'.$activityicon.'",cruiseicon="'.$cruiseicon.'",weekendGatewayLocationId="'.$weekendGatewayLocationId.'"'; 
}else{
$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'",startDate="'.$startDate.'",endDate="'.$endDate.'",packageTheme="'.$packageTheme.'",nights="'.$nights.'",destination="'.$destination.'",showOnWebsite="'.$showOnWebsite.'",flighticon="'.$flighticon.'",hotelicon="'.$hotelicon.'",sightseeingicon="'.$sightseeingicon.'",transfericon="'.$transfericon.'",activityicon="'.$activityicon.'",cruiseicon="'.$cruiseicon.'",weekendGatewayLocationId="'.$weekendGatewayLocationId.'"'; 
}
$where='parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($editid).'"';   
updatelisting('quotationMaster',$namevalue,$where);  

 

?>
<script>
parent.redirectpage('add-quotation?id=<?php echo $editid; ?>&save=1');
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
parent.redirectpage('add-quotation?id=<?php echo $_POST['quotationid']; ?>&save=1'); 
</script>

<?php
exit();
}






if($_POST['action']=='savedaydetails' && $_POST['title']!="" && $_POST['description']!='' && $_POST['quotationid']!=''){

 
$title=addslashes($_POST['title']); 
$description=addslashes($_POST['description']); 
$editid=addslashes($_POST['editid']);  

$namevalue ='title="'.$title.'",description="'.$description.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 
$where='parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';   
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


if($_POST['action']=='saveEventTermDescription' && $_POST['termType']!="" && $_POST['termType']!="" && $_POST['quotationid']!=""){

$termType=addslashes($_POST['termType']); 
$editid=addslashes($_POST['editid']); 
$termDescription=addslashes($_POST['termDescription']); 
$termDescription = preg_replace('/font-family.+?;/', "", $termDescription);
$termDescription = str_replace('font-family:',"", $termDescription);

$namevalue ='termType="'.$termType.'",termDescription="'.$termDescription.'"'; 
$where='parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($editid).'"';   
updatelisting('quotationTerms',$namevalue,$where);  

 

?>
<script>
parent.redirectpage('add-quotation?id=<?php echo $_REQUEST['quotationid']; ?>&save=1');
</script>

<?php
exit();
}



if($_REQUEST['action']=='createflyer' && $_REQUEST['typevar']!='' && $_SESSION['agentUserid']!=''){ 
$typevar=$_REQUEST['typevar'];
$pageWidth='0px';
$pageHeight='0px';

if($typevar=='Instagram Story'){
$pageWidth='1080px';
$pageHeight='1920px';
}


if($typevar=='Instagram Post'){
$pageWidth='1080px';
$pageHeight='1080px';
}

if($typevar=='Facebook Post'){
$pageWidth='1200px';
$pageHeight='630px';
}
if($typevar=='Emailer'){
$pageWidth='800px';
$pageHeight='1000px';
}

if($pageWidth!='0px'){
 
$namevalue ='userId="'.$_SESSION['agentUserid'].'",projectType="'.trim($typevar).'",name="New Project",pageWidth="'.$pageWidth.'",pageHeight="'.$pageHeight.'",editDate="'.date('Y-m-d H:i:s').'",addDate="'.date('Y-m-d H:i:s').'"';   
$lastid=addlistinggetlastid('flyer_project',$namevalue); 

?>
<script>
window.location.href = "flyer-designer/edit-project.html?id=<?php echo encode($lastid); ?>";
</script>
<?php

}
}










if(trim($_POST['action'])=='saveaddcustomer' && trim($_POST['name'])!=''  && trim($_POST['lastName'])!='' ){ 
 

$name=stripslashes($_POST['name']);  
$nameHead=stripslashes($_POST['nameHead']); 
$lastName=stripslashes($_POST['lastName']);  
$gender=stripslashes($_POST['gender']);  
$dob=date('Y-m-d',strtotime($_POST['dob'])); 
$passportExpiry=date('Y-m-d',strtotime($_POST['passportExpiry']));  
$passportNo=stripslashes($_POST['passportNo']);   


if(decode($_REQUEST['editid'])>0){

$namevalue ='firstName="'.$name.'",lastName="'.$lastName.'",gender="'.$gender.'",dob="'.$dob.'",passportExpiry="'.$passportExpiry.'",passportNumber="'.$passportNo.'",title="'.$nameHead.'",addDate="'.date('Y-m-d').'"'; 
$where=' id="'.decode($_REQUEST['editid']).'"';  
updatelisting('flightBookingPaxDetailMaster',$namevalue,$where); 

} else { 


$namevalue ='firstName="'.$name.'",lastName="'.$lastName.'",gender="'.$gender.'",dob="'.$dob.'",passportExpiry="'.$passportExpiry.'",passportNumber="'.$passportNo.'",title="'.$nameHead.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d').'"';   
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue);  

}

 

?> 
<script>   
parent.window.location.href = "my-customer";
</script> 
<?php  } 



if(trim($_REQUEST['action'])=='paymentGatewayPayment' && trim($_REQUEST['serviceId'])!=''  && trim($_REQUEST['type'])!='' ){

//echo ' serviceId="'.decode($_REQUEST['serviceId']).'" and bookingType="'.trim($_REQUEST['type']).'"';

$aResp=GetPageRecord('*','onlineRechargeRequest',' serviceId="'.($_REQUEST['serviceId']).'" and bookingType="'.trim($_REQUEST['type']).'" order by id desc');


$numChk=mysqli_num_rows($aResp);

$resPayment=mysqli_fetch_array($aResp);







   if($numChk>0)
   {
    sendbalancetomail();

		if($resPayment['status']=='success')
		{

$email=$LoginUserDetails["email"];
$subject="Success Payment";
$mailbody="Dear ".$LoginUserDetails['name']."<br> Recharge of ₹ ".$resPayment['requestedAmount']."/- has been successfull<br>
 Thanks You for Recharge";
 sendmainmail($email,$subject,$mailbody);
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

      $email=$LoginUserDetails["email"];
      $subject="Payment Fail";
      $mailbody="Dear ".$LoginUserDetails['name']."<br> Recharge of ₹ ".$resPayment['requestedAmount']."/- has been failed<br>";

       sendmainmail($email,$subject,$mailbody);

		?>
		<script>
		//console.log('Faile Payment ');
		//alert("Payment Failed, Please try again - payment stauts <?php echo $resPayment['status']; ?>");
		</script>
		<?php
		}
		
	}	

}








if(trim($_POST['action'])=='addflightbookingnote' && trim($_POST['details'])!=''  && trim($_POST['bookingid'])!=''){ 
 

$bookingid=decode($_POST['bookingid']);  
$details=stripslashes($_POST['details']);  


 
$namevalue ='bookingid="'.$bookingid.'",details="'.$details.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('flightBookingNotes',$namevalue);  
 
 

?> 
<script>   
parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['bookingid']; ?>";
</script> 
<?php  } 

 

if(trim($_POST['action'])=='flightbookingamendments' && trim($_POST['id'])!=''  && trim($_POST['amType'])!='' && $_POST['amPax'] == ''){ 
 

$tripsarray=array();
$tripsarray2=array();

$id=decode($_POST['id']);  
$amendmentType=strtoupper($_POST['amType']);  
$amPax=stripslashes($_POST['amPax']);  
$remarkDetails=stripslashes($_POST['remarkDetails']);  
$nextTravelDate=date('Y-m-d',strtotime($_POST['nextTravelDate']));  
$generationTime=date('Y-m-d H:i:s');   
$addBy=$_SESSION['agentUserid'];  


$a=GetPageRecord('*','flightBookingMaster',' id="'.$id.'" '); 
$editresult=mysqli_fetch_array($a);

 $agentid=$editresult['agentid'];
 $bookingid=$editresult['tboBookingId'];
 $source=$editresult['source'];
 $source=explode('-', $source);
 $destination=$editresult['destination'];
 $destination=explode('-', $destination);
 $journeyDate=$editresult['journeyDate'];

 $tripsarray['src']=$source[1];
 $tripsarray['dest']=$destination[1];
 $tripsarray['departureDate']=$journeyDate;

$selectedPax='';
foreach ( $_POST['amPax'] as $value ) {
   $selectedPax.=$value.',';
  // print_r($selectedPax);
   
}


$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 
while($paxdetail=mysqli_fetch_array($rs6)){
  if($paxdetail['status'] != 3 && $paxdetail['status'] != 5){
    $travellersifoarr=array();
    $firstName=strtoupper($paxdetail['firstName']);
    $lastName=strtoupper($paxdetail['lastName']);
    $travellersifoarr['fn']=$firstName;
    $travellersifoarr['ln']=$lastName;
    $tripsarray['travellers'][]=$travellersifoarr;
    //$tripsarray2['travellers'][]=$travellersifoarr;
  }
}
    $idcout=1;
    if(!empty($editresult['roundTripId'])){
      $b=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'" '); 
      while($editresult2=mysqli_fetch_array($b)){
        $bookingId2[$idcout]=$editresult2['id'];
        $journeyDate2[$idcout]=$editresult2['journeyDate'];
        $idcout++;
      }
    }else{
      $bookingId2[2]='';
    }
    if($bookingId2[2] != ''){
            
      $tripsarray2['src']=$destination[1];
      $tripsarray2['dest']=$source[1];
      $tripsarray2['departureDate']=$journeyDate2[2];

      $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$bookingId2[2].'" and firstName!="" '); 
    while($paxdata2=mysqli_fetch_array($rs9)){
      if($paxdata2['status'] != 3 && $paxdata2['status'] != 5){
        $travellersifoarr2=array();
        $firstName2=strtoupper($paxdata2['firstName']);
        $lastName2=strtoupper($paxdata2['lastName']);
        $travellersifoarr2['fn']=$firstName2;
        $travellersifoarr2['ln']=$lastName2;
        $tripsarray2['travellers'][]=$travellersifoarr2;
      }
    }
	}

if(!empty($bookingId2[2])){
$arrayToRequest = array( 

  "bookingId" => $bookingid,

  "type" => $amendmentType,

  "remarks" => $remarkDetails,

  "trips" => [$tripsarray,$tripsarray2],
  
); 
}else{
	
$arrayToRequest = array( 

  "bookingId" => $bookingid,

  "type" => $amendmentType,

  "remarks" => $remarkDetails,

  "trips" => [$tripsarray],

  
);
}

$postDataCancellation=json_encode($arrayToRequest);
// print_r($postDataCancellation);
//  die;
try

{
  $restCaller = new RestApiCaller();

	$cancellationChargesRequest = $restCaller->getTripJackResponse(_CANCELLATION_CHARGES_, $postDataCancellation);

	$cancellationChargesResult = json_decode($cancellationChargesRequest,true);

//  echo '<pre>';
//  print_r($cancellationChargesResult);
//  die;
 

	if($cancellationChargesResult['status']['success']==1)

	{
	$cancellationCharges_adt=round($cancellationChargesResult['trips'][0]['amendmentInfo']['ADULT']['amendmentCharges']);
	$cancellationCharges_chd=round($cancellationChargesResult['trips'][0]['amendmentInfo']['CHILD']['amendmentCharges']);
	$cancellationCharges_inf=round($cancellationChargesResult['trips'][0]['amendmentInfo']['INFANT']['amendmentCharges']);
	
  $cancellationCharges1=round($cancellationCharges_adt+$cancellationCharges_chd+$cancellationCharges_inf);

	$cancellationCharges_adt2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['ADULT']['amendmentCharges']);
	$cancellationCharges_chd2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['CHILD']['amendmentCharges']);
	$cancellationCharges_inf2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['INFANT']['amendmentCharges']);
	
   $cancellationCharges2=round($cancellationCharges_adt2+$cancellationCharges_chd2+$cancellationCharges_inf2);
 
  $cancellationCharges=$cancellationCharges1+$cancellationCharges2;
 
 
  $refund1=round($cancellationChargesResult['trips'][0]['amendmentInfo']['ADULT']['totalFare']+$cancellationChargesResult['trips'][0]['amendmentInfo']['CHILD']['totalFare']+$cancellationChargesResult['trips'][0]['amendmentInfo']['INFANT']['totalFare']);

  $refund2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['ADULT']['totalFare']+$cancellationChargesResult['trips'][1]['amendmentInfo']['CHILD']['totalFare']+$cancellationChargesResult['trips'][1]['amendmentInfo']['INFANT']['totalFare']);

 $refund=$refund1+$refund2;
 

	}

	//$restCaller = new RestApiCaller();

	$cancellationRequest = $restCaller->getTripJackResponse(_CANCELLATION_, $postDataCancellation);

	$cancellationResult = json_decode($cancellationRequest,true);

//  print_r($cancellationResult);
//   die; 
	if($cancellationResult['status']['success']==1)

	{
    $ammendmentId=$cancellationResult['amendmentId'];
		$status = "success";
		
	$arrayToRequestid = array( 

      "amendmentId" => $ammendmentId,
    );

    $getDataCancellation=json_encode($arrayToRequestid);
	
	//$restCaller = new RestApiCaller();
      
        $getDataCancellationRequest = $restCaller->getTripJackResponse(_CANCELLATION_DETAIL_, $getDataCancellation);
      
        $getDataCancellationResult = json_decode($getDataCancellationRequest,true);
      
        if($getDataCancellationResult['status']['success']==1)

        {
          $refundableAmount=$getDataCancellationResult['refundableAmount'];
		  	   switch ($getDataCancellationResult['amendmentStatus']) {
							case "REQUESTED ":
								$Status=1;
							  break;
							case "REJECTED ":
								$Status=2;
							  break;
							case "SUCCESS ":
								$Status=4;
							  break;
							default:
							$Status=3;
						  }
        }

	}
}
  catch(Exception $e)

  {
  
      $errhdng="Technical Error !!";
  
      $errmsg="Sorry Something went wrong.";
  
    $ErrorMessage=$errmsg;
  
     // include dirname(dirname(__FILE__)).'/error.php';
  
     // exit;
  
  }
  
  if(trim($ErrorMessage)!=''){
  
    $Status=0;
  
  }
  
	if($status == 'success'){
 

		if(!empty($bookingId2[2])){
			  $namevalue ='bookingId="'.$id.'",bookingId2="'.$bookingId2[2].'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.'"';
			  addlistinggetlastid('flightAmendments',$namevalue);

			  $namevalue ='agentId="'.$addBy.'" ,flightBookingId="'.$id.'",flightBookingId2="'.$bookingId2[2].'",remark="'.$remarkDetails.'",requestType="'.$amendmentType.'",cancellationCharges="'.$cancellationCharges.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'",ammendmentId="'.$ammendmentId.'",refundableAmount="'.$refund.'"';  
			  $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue); 
			  
			
        $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 
        while($paxdetails=mysqli_fetch_array($rs6)){
          // print_r($paxdetails);
          if($paxdetails['paxType']=="adult"){
            $where=' id="'.$paxdetails['id'].'" and paxType="adult"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_adt.'" ';
            }elseif($paxdetails['paxType']=="child"){
              $where=' id="'.$paxdetails['id'].'" and paxType="child"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_chd.'" ';
            }else{
              $where=' id="'.$paxdetails['id'].'" and paxType="infant"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_inf.'" ';
            }
               updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
          }

          $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$bookingId2[2].'" and firstName!="" '); 
          while($paxdetails2=mysqli_fetch_array($rs9)){

            if($paxdetails2['paxType']=="adult"){
            $where=' id="'.$paxdetails2['id'].'" and paxType="adult"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_adt2.'" ';
            }elseif($paxdetails2['paxType']=="child"){
              $where=' id="'.$paxdetails2['id'].'" and paxType="child"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_chd2.'" ';
            }else{
              $where=' id="'.$paxdetails2['id'].'" and paxType="infant"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_inf2.'" ';
            }
               updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
           }

				  
			   

		}else{
			  $namevalue ='bookingId="'.$id.'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.'"';
			  addlistinggetlastid('flightAmendments',$namevalue);
			  
			  $namevalue ='agentId="'.$addBy.'" ,flightBookingId="'.$id.'",remark="'.$remarkDetails.'",requestType="'.$amendmentType.'",cancellationCharges="'.$cancellationCharges.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'",ammendmentId="'.$ammendmentId.'",refundableAmount="'.$refund.'"';  
			  $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue);
		
        $rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 
        while($paxdetails=mysqli_fetch_array($rs6)){
         
          if($paxdetails['paxType']=="adult"){
            $where=' id="'.$paxdetails['id'].'" and paxType="adult"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_adt.'" ';
            }elseif($paxdetails['paxType']=="child"){
              $where=' id="'.$paxdetails['id'].'" and paxType="child"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_chd.'" ';
            }else{
              $where=' id="'.$paxdetails['id'].'" and paxType="infant"';
             
               $namevalue ='cancellationCharges="'.$cancellationCharges_inf.'" ';
            }
               updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
          }
	
		}
	  $rsult=GetPageRecord('*','sys_userMaster','id="1"'); 
    $getresult=mysqli_fetch_array($rsult);

    $rs=GetPageRecord('*','sys_userMaster','id="'.$addBy.'"'); 
    $LoginParentId=mysqli_fetch_array($rs);

    $rslt=GetPageRecord('*','flightBookingMaster','id="'.$id.'"'); 
    $bookingdeatil=mysqli_fetch_array($rslt);

    $subject="Cancellation Request";
    $mailbody="Dear Reservation Supervisor,<br><br>

    Kindly cancel my plane ticket ".$bookingdeatil['ticketNo']."/".$bookingdeatil['pnrNo']." dated ".date("d-m-Y",strtotime($bookingdeatil['bookingDate'])). " and make a refund. I will be unable to travel due to itinerary changes. I hope you will oblige my request.
    
    Sincere Regards,<br>
    
    ".$LoginParentId['name'] ." ".$LoginParentId['lastName']."<br> Ticket and PNR Number: " .$bookingdeatil['ticketNo']." / ".$bookingdeatil['pnrNo'];


     sendmainmail($getresult['email'],$subject,$mailbody);

	?> 
	<script>   
		parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['id']; ?>";
	</script> 
	<?php 
					
	}else{
		?>
	<script>   

		parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['id']; ?>";
		alert('Something Went Wrong. Please Try Again.');
	</script> 
		<?php
	}
	
			
} 
if(trim($_POST['action'])=='offlineflightbookingamendments' && trim($_POST['id'])!='' && trim($_POST['amType'])!=''){

  
  $id=decode($_POST['id']);  
  $amendmentType=strtoupper($_POST['amType']);  
  $amPax=stripslashes($_POST['amPax']);
  $remarkDetails=stripslashes($_POST['remarkDetails']);  
  $nextTravelDate=date('Y-m-d',strtotime($_POST['nextTravelDate']));  
  $generationTime=date('Y-m-d H:i:s');   
  $addBy=$_SESSION['agentUserid'];  

  $selectedPax='';
  foreach ( $_POST['amPax'] as $value ) {
     $selectedPax.=$value.',';;
     
  }
  
  foreach ( $_POST['amPax2'] as $value2 ) {
    $selectedPax.=$value2.',';;
    
 }
 
  $a=GetPageRecord('*','flightBookingMaster',' id="'.$id.'" '); 
  $editresult=mysqli_fetch_array($a);
  if(!empty($editresult['roundTripId'])){
  $rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(seatPrice) as totalseatPrice, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'"  '); 
  }else{
    $rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(seatPrice) as totalseatPrice, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice','flightBookingMaster',' roundTripId="'.$editresult['id'].'"  '); 
  }
  $totalcostings=mysqli_fetch_array($rto);
  if(!empty($selectedPax)){
    $refund='';
  }else{
  $refund=round($totalcostings['totalagentTotalFare']+$totalcostings['totalmealPrice']+$totalcostings['totalseatPrice']+$totalcostings['totalextraBaggagePrice']); 
  }
   $agentid=$editresult['agentid'];
   $bookingid=$editresult['tboBookingId'];



      $idcout=1;
      if(!empty($editresult['roundTripId'])){
      $b=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'" '); 
      while($editresult2=mysqli_fetch_array($b)){
        $bookingId2[$idcout]=$editresult2['id'];
        $journeyDate2[$idcout]=$editresult2['journeyDate'];
        $idcout++;
      }
    }else{
      $bookingId2[2]='';
    }
    
      if(!empty($bookingId2[2])){
          $namevalue ='bookingId="'.$id.'",bookingId2="'.$bookingId2[2].'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.'"';
          addlistinggetlastid('flightAmendments',$namevalue);
  
          $namevalue ='agentId="'.$addBy.'" ,flightBookingId="'.$id.'",flightBookingId2="'.$bookingId2[2].'",remark="'.$remarkDetails.'",requestType="'.$amendmentType.'",addDate="'.date('Y-m-d H:i:s').'",status="1",refundableAmount="'.$refund.'",paxIds="'.$selectedPax.'"';  
          $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue);    
  
          
        if(!empty($selectedPax) || !empty($_POST['amPax2'])){
          foreach ($_POST['amPax'] as $value ) {
            $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value.'" and firstName!="" '); 
          $paxdetails=mysqli_fetch_array($rs9);
          if($paxdetails['paxType']=="adult"){
          $where=' id="'.$value.'" and paxType="adult"';
          
            $namevalue ='status="3"';
          }elseif($paxdetails['paxType']=="child"){
            $where=' id="'.$value.'" and paxType="child"';
          
            $namevalue ='status="3"';
          }else{
            $where=' id="'.$value.'" and paxType="infant"';
          
            $namevalue ='status="3"';
          }
            updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
          
          }

        foreach ($_POST['amPax2'] as $value2 ) {

          $rslt=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value2.'" and firstName!="" '); 

          $paxdetails2=mysqli_fetch_array($rslt);

          if($paxdetails2['paxType']=="adult"){
            
          $where=' id="'.$value2.'" and paxType="adult"';
          
            $namevalue ='status="3"';

          }elseif($paxdetails2['paxType']=="child"){

            $where=' id="'.$value2.'" and paxType="child"';

            $namevalue ='status="3"';

          }else{

            $where=' id="'.$value2.'" and paxType="infant"';
          
            $namevalue ='status="3"';
          }
            updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
          
          }
        
        }
      }else{
          $namevalue ='bookingId="'.$id.'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.'"';
          addlistinggetlastid('flightAmendments',$namevalue);
          
          $namevalue ='agentId="'.$addBy.'" ,flightBookingId="'.$id.'",remark="'.$remarkDetails.'",requestType="'.$amendmentType.'",addDate="'.date('Y-m-d H:i:s').'",status="1",ammendmentId="'.$ammendmentId.'",refundableAmount="'.$refund.'",paxIds="'.$selectedPax.'"';  
          $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue);   

          if(!empty($selectedPax)){
            foreach ($_POST['amPax'] as $value ) {
              $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value.'" and firstName!="" '); 
            $paxdetails=mysqli_fetch_array($rs9);
            if($paxdetails['paxType']=="adult"){
            $where=' id="'.$value.'" and paxType="adult"';

            }elseif($paxdetails['paxType']=="child"){
              $where=' id="'.$value.'" and paxType="child"';
            
            }else{
              $where=' id="'.$value.'" and paxType="infant"';
            
             
            }
            $namevalue ='status="3"';

              updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
            
            }
          }
        
      }


      $rsult=GetPageRecord('*','sys_userMaster','id="1"'); 
      $getresult=mysqli_fetch_array($rsult);
  
      $rs=GetPageRecord('*','sys_userMaster','id="'.$addBy.'"'); 
      $LoginParentId=mysqli_fetch_array($rs);
  
      $rslt=GetPageRecord('*','flightBookingMaster','id="'.$id.'"'); 
      $bookingdeatil=mysqli_fetch_array($rslt);
  
      $subject="Cancellation Request";
      $mailbody="Dear Reservation Supervisor,<br><br>
  
      Kindly cancel my plane ticket ".$bookingdeatil['ticketNo']."/".$bookingdeatil['pnrNo']." dated ".date("d-m-Y",strtotime($bookingdeatil['bookingDate'])). " and make a refund. I will be unable to travel due to itinerary changes. I hope you will oblige my request.
      
      Sincere Regards,<br>
      
      ".$LoginParentId['name'] ." ".$LoginParentId['lastName']."<br> Ticket and PNR Number: " .$bookingdeatil['ticketNo']." / ".$bookingdeatil['pnrNo'];
  
  
       sendmainmail($getresult['email'],$subject,$mailbody);
  
    ?> 
    <script>   
  
      parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['id']; ?>";
     // alert('Something Went Wrong. Please Try Again.');
    </script> 
      <?php
}

if(trim($_POST['action'])=='flightbookingamendments' && trim($_POST['id'])!=''  && trim($_POST['amType'])!='' && trim($_POST['amPax'] != '')){ 
 


$tripsarray=array();
$tripsarray2=array();

$id=decode($_POST['id']);  
$amendmentType=strtoupper($_POST['amType']);  
$amPax=stripslashes($_POST['amPax']);  
$remarkDetails=stripslashes($_POST['remarkDetails']);  
$nextTravelDate=date('Y-m-d',strtotime($_POST['nextTravelDate']));  
$generationTime=date('Y-m-d H:i:s');   
$addBy=$_SESSION['agentUserid'];  


$a=GetPageRecord('*','flightBookingMaster',' id="'.$id.'" '); 
$editresult=mysqli_fetch_array($a);

 $agentid=$editresult['agentid'];
 $bookingid=$editresult['tboBookingId'];
 $source=$editresult['source'];
 $source=explode('-', $source);
 $destination=$editresult['destination'];
 $destination=explode('-', $destination);
 $journeyDate=$editresult['journeyDate'];

 $tripsarray['src']=$source[1];
 $tripsarray['dest']=$destination[1];
 $tripsarray['departureDate']=$journeyDate;

$selectedPax='';
foreach ( $_POST['amPax'] as $value ) {
   $selectedPax.=$value.',';
 //echo count($selectedPax);
   
}
$selectedPax2='';
foreach ( $_POST['amPax2'] as $value2 ) {
   $selectedPax2.=$value2.',';
 //echo count($selectedPax);
   
}

$paxid=$_POST['amPax'];
$paxcount= count($_POST['amPax']); 
$counter=0;

for($i =1; $i <= $paxcount; $i++){
	$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$paxid[$counter].'" and firstName!="" '); 
$paxdetail=mysqli_fetch_array($rs6);
 $travellersifoarr=array();
  if($paxdetail['status'] != 3){
 
$firstName[$i]=strtoupper($paxdetail['firstName']);
$lastName[$i]=strtoupper($paxdetail['lastName']);
$travellersifoarr['fn']=$firstName[$i];
$travellersifoarr['ln']=$lastName[$i];
$tripsarray['travellers'][]=$travellersifoarr;

  }
}
$counter++;

$idcout=1;
if(!empty($editresult['roundTripId'])){
  $b=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'" '); 
  while($editresult2=mysqli_fetch_array($b)){
    $bookingId2[$idcout]=$editresult2['id'];
    $journeyDate2[$idcout]=$editresult2['journeyDate'];
    $idcout++;
  }
  }
			
$paxid2=$_POST['amPax2'];

if(!empty($paxid2)){
	
	$tripsarray2['src']=$destination[1];
	$tripsarray2['dest']=$source[1];
	$tripsarray2['departureDate']=$journeyDate2[2];

	$paxcount2= count($_POST['amPax2']); 
	$counter2=0;
		for($j =1; $j <= $paxcount2; $j++){
			$rs7=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$paxid2[$counter2].'" and firstName!="" '); 
		$paxdetail2=mysqli_fetch_array($rs7);
    
		 $travellersifoarr2=array();

		  if($paxdetail2['status'] != 3){
		 
		$firstName2=strtoupper($paxdetail2['firstName']);
		$lastName2=strtoupper($paxdetail2['lastName']);
		$travellersifoarr2['fn']=$firstName2;
		$travellersifoarr2['ln']=$lastName2;
		$tripsarray2['travellers'][]=$travellersifoarr2;

		  }
		}
	$counter2++;
}

if(!empty($paxid2)){
  $arrayToRequest = array( 

    "bookingId" => $bookingid,

    "type" => $amendmentType,

    "remarks" => $remarkDetails,

    "trips" => [$tripsarray,$tripsarray2],
    
  ); 
}else{
	
  $arrayToRequest = array( 

    "bookingId" => $bookingid,

    "type" => $amendmentType,

    "remarks" => $remarkDetails,

    "trips" => [$tripsarray],

    
  );
}

$postDataCancellation=json_encode($arrayToRequest);
// print_r($postDataCancellation);
// die;
try

{
 
  $restCaller = new RestApiCaller();

	$cancellationChargesRequest = $restCaller->getTripJackResponse(_CANCELLATION_CHARGES_, $postDataCancellation);

	$cancellationChargesResult = json_decode($cancellationChargesRequest,true);

  // echo '<pre>';
  // print_r($cancellationChargesResult);
  // die;

	if($cancellationChargesResult['status']['success']==1)

	{
    $cancellationCharges_adt=round($cancellationChargesResult['trips'][0]['amendmentInfo']['ADULT']['amendmentCharges']);
    $cancellationCharges_chd=round($cancellationChargesResult['trips'][0]['amendmentInfo']['CHILD']['amendmentCharges']);
    $cancellationCharges_inf=round($cancellationChargesResult['trips'][0]['amendmentInfo']['INFANT']['amendmentCharges']);
    
    $cancellationCharges1=round($cancellationCharges_adt+$cancellationCharges_chd+$cancellationCharges_inf);
  
    $cancellationCharges_adt2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['ADULT']['amendmentCharges']);
    $cancellationCharges_chd2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['CHILD']['amendmentCharges']);
    $cancellationCharges_inf2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['INFANT']['amendmentCharges']);
    
     $cancellationCharges2=round($cancellationCharges_adt2+$cancellationCharges_chd2+$cancellationCharges_inf2);
   
    $cancellationCharges=$cancellationCharges1+$cancellationCharges2;

    $refund1=round($cancellationChargesResult['trips'][0]['amendmentInfo']['ADULT']['totalFare']+$cancellationChargesResult['trips'][0]['amendmentInfo']['CHILD']['totalFare']+$cancellationChargesResult['trips'][0]['amendmentInfo']['INFANT']['totalFare']);

    $refund2=round($cancellationChargesResult['trips'][1]['amendmentInfo']['ADULT']['totalFare']+$cancellationChargesResult['trips'][1]['amendmentInfo']['CHILD']['totalFare']+$cancellationChargesResult['trips'][1]['amendmentInfo']['INFANT']['totalFare']);
  
   $refund=$refund1+$refund2;
	
	}

	//$restCaller = new RestApiCaller();

	$cancellationRequest = $restCaller->getTripJackResponse(_CANCELLATION_, $postDataCancellation);

	$cancellationResult = json_decode($cancellationRequest,true);

	if($cancellationResult['status']['success']==1)

	{
    $ammendmentId=$cancellationResult['amendmentId'];
    $status = "success";
		
    $arrayToRequestid = array( 

      "amendmentId" => $ammendmentId,
    );

    $getDataCancellation=json_encode($arrayToRequestid);
    // print_r($postDataCancellation);
    // die;

    //$restCaller = new RestApiCaller();
      
    $getDataCancellationRequest = $restCaller->getTripJackResponse(_CANCELLATION_DETAIL_, $getDataCancellation);
  
    $getDataCancellationResult = json_decode($getDataCancellationRequest,true);
  
    if($getDataCancellationResult['status']['success']==1)

    {
      $refundableAmount=$getDataCancellationResult['refundableAmount'];
     switch ($getDataCancellationResult['amendmentStatus']) {
							case "REQUESTED":
								$Status=1;
							  break;
							case "REJECTED":
								$Status=2;
							  break;
							case "SUCCESS":
								$Status=4;
							  break;
							default:
							$Status=3;
						  }
    }

	}
}
  catch(Exception $e)

  {
  
      $errhdng="Technical Error !!";
  
      $errmsg="Sorry Something went wrong.";
  
    $ErrorMessage=$errmsg;
  
     // include dirname(dirname(__FILE__)).'/error.php';
  
     // exit;
  
  }
  
  if(trim($ErrorMessage)!=''){
  
    $Status=0;
  
  }
  
	if($status == "success"){

 

		if(!empty($paxid2)){
			  $namevalue ='bookingId="'.$id.'",bookingId2="'.$bookingId2[2].'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.$selectedPax2.'"';
			  addlistinggetlastid('flightAmendments',$namevalue);

			  $namevalue ='agentId="'.$addBy.'" ,flightBookingId="'.$id.'",paxIds="'.$selectedPax.$selectedPax2.'",flightBookingId2="'.$bookingId2[2].'",remark="'.$remarkDetails.'",requestType="'.$amendmentType.'",cancellationCharges="'.$cancellationCharges.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'",ammendmentId="'.$ammendmentId.'",refundableAmount="'.$refund.'"';  
			  $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue); 
           
        foreach ($_POST['amPax'] as $value ) {
          $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value.'" and firstName!="" '); 
        $paxdetails=mysqli_fetch_array($rs9);
        if($paxdetails['paxType']=="adult"){
        $where=' id="'.$value.'" and paxType="adult"';
        
          $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_adt.'" ';
        }elseif($paxdetails['paxType']=="child"){
          $where=' id="'.$value.'" and paxType="child"';
        
          $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_chd.'" ';
        }else{
          $where=' id="'.$value.'" and paxType="infant"';
        
          $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_inf.'" ';
        }
          updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
        
        }

       foreach ($_POST['amPax2'] as $value2 ) {

        $rslt=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value2.'" and firstName!="" '); 

        $paxdetails2=mysqli_fetch_array($rslt);

        if($paxdetails2['paxType']=="adult"){
          
        $where=' id="'.$value2.'" and paxType="adult"';
        
          $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_adt2.'" ';

        }elseif($paxdetails2['paxType']=="child"){

          $where=' id="'.$value2.'" and paxType="child"';

          $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_chd2.'" ';

        }else{

          $where=' id="'.$value2.'" and paxType="infant"';
        
          $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_inf2.'" ';
        }
          updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
        
        }
      

		}else{
			  $namevalue ='bookingId="'.$id.'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.'"';
			  addlistinggetlastid('flightAmendments',$namevalue);
			  
			  $namevalue ='agentId="'.$addBy.'" ,flightBookingId="'.$id.'",paxIds="'.$selectedPax.'",remark="'.$remarkDetails.'",requestType="'.$amendmentType.'",cancellationCharges="'.$cancellationCharges.'",addDate="'.date('Y-m-d H:i:s').'",status="'.$Status.'",ammendmentId="'.$ammendmentId.'",refundableAmount="'.$refund.'"';  
			  $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue);
   
          foreach ($_POST['amPax'] as $value ) {
            $rs9=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value.'" and firstName!="" '); 
          $paxdetails=mysqli_fetch_array($rs9);
          if($paxdetails['paxType']=="adult"){
          $where=' id="'.$value.'" and paxType="adult"';
          
            $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_adt.'" ';
          }elseif($paxdetails['paxType']=="child"){
            $where=' id="'.$value.'" and paxType="child"';
          
            $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_chd.'" ';
          }else{
            $where=' id="'.$value.'" and paxType="infant"';
          
            $namevalue ='status="3",cancellationCharges="'.$cancellationCharges_inf.'" ';
          }
            updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
          
          }

        }
        
        $rs=GetPageRecord('*','sys_userMaster','id=1'); 
        $LoginParentId=mysqli_fetch_array($rs);
    
        $rslt=GetPageRecord('*','flightBookingMaster','id="'.$id.'"'); 
        $bookingdeatil=mysqli_fetch_array($rslt);
    
        $subject="Cancellation Request";
        $mailbody="Dear Reservation Supervisor,<br><br>
    
        Kindly cancel my plane ticket ".$bookingdeatil['ticketNo']."/".$bookingdeatil['pnrNo']." dated ".date("d-m-Y",strtotime($bookingdeatil['bookingDate'])). " and make a refund. I will be unable to travel due to itinerary changes. I hope you will oblige my request.
        
        Sincere Regards,<br>
        
        ".$LoginParentId['name'] ." ".$LoginParentId['lastName']."<br> Ticket and PNR Number=" .$bookingdeatil['ticketNo']." / ".$bookingdeatil['pnrNo'];
    
         sendmainmail($LoginParentId['email'],$subject,$mailbody);


    
	?> 
	<script>   
		parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['id']; ?>";
	</script> 
	<?php 
	}else{
		?>
	<script>   

		parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['id']; ?>";
		alert('Something Went Wrong. Please Try Again.');
	</script> 
		<?php
	}
} 

if(trim($_POST['action'])=='addpaymentrequest' && trim($_POST['requestedAmount'])!=''){ 
// print_r($_POST);die;
$requestedAmount=stripslashes($_POST['requestedAmount']);  
$paymentMode=stripslashes($_POST['paymentMode']); 
$referenceNumber=stripslashes($_POST['referenceNumber']);  

$note                = stripslashes($_POST['note']);
$chequeDate          = stripslashes($_POST['chequeDate']);
$bank                = stripslashes($_POST['bank']);
$branch              = stripslashes($_POST['branch']);
$account_number      = stripslashes($_POST['account_number']);
$our_bank            = stripslashes($_POST['our_bank']);
$our_branch          = stripslashes($_POST['our_branch']);
$bank_transaction_id = stripslashes($_POST['bank_transaction_id']);


$sql='';

if($_FILES["attachment"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['attachment']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["attachment"]["tmp_name"], "masteradmin/upload/{$profilePhoto}");

$sql=',attachment="'.$profilePhoto.'"';
}

$namevalue ='requestedAmount="'.$requestedAmount.
            '",paymentMode="'.$paymentMode.
            '",referenceNumber="'.$referenceNumber.
            '",note="'.$note.
            '",chequeDate="'.$chequeDate.
            '",bank="'.$bank.
            '",branch="'.$branch.
            '",account_number="'.$account_number.
            '",our_bank="'.$our_bank.
            '",our_branch="'.$our_branch.
            '",bank_transaction_id="'.$bank_transaction_id.
            '",agentId="'.$_SESSION['agentUserid'].
            '",addDate="'.date('Y-m-d').
            '" '.$sql.'';

switch($paymentMode)
{
  case "Cheque":
    $namevalue .= ',chequeNumber="'.stripslashes($_POST['chequeNumber']).'"';
    break;
  case "DD":
    $namevalue .= ',draftNumber="'.stripslashes($_POST['ddNumber']).'"';
    break;
}
addlistinggetlastid('offlineRechargeRequest',$namevalue);  


$a=GetPageRecord('*','sys_userMaster','id=1');


$Data=mysqli_fetch_array($a);

// $email=$LoginUserDetails["email"];
$email=$Data["email"];
$subject="Payment Request";
$mailbody="Dear Admin,<br>
I'm seeking confirmation and your approval regarding the receipt of the following amount:<br><br>

Transaction ID: ".$bank_transaction_id." <br>
Transaction Amount: ".$requestedAmount."<br>

Please confirm and approve if the amount has been received on your end.<br>
Company Name: " .$getcompanybasicinfo['companyName']."<br>
Agent Id: " .$_SESSION['agentUserid'];

 sendmainmail($email,$subject,$mailbody);
 sendbalancetomail();

?> 
<script>   
parent.window.location.href = "topup-request?save=1";
</script> 
<?php
}


if($_POST['action']=='importfiledata'){

//   ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


$fileName = $_FILES["file"]["name"];
$fileExtension = explode('.', $fileName);
$fileExtension = strtolower(end($fileExtension));
$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

$rt=mt_rand().strtotime(date("YMDHis")); 
$FileName=basename($_FILES['file']['name']); 

$FileExtension=pathinfo($FileName, PATHINFO_EXTENSION);  
$importfile=time().$rt.'.'.$FileExtension; 

$targetDirectory = "upload/{$importfile}";
move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);

// error_reporting(0);
// ini_set('display_errors', 0);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

require 'excelReader/excel_reader2.php';
require 'excelReader/SpreadsheetReader.php';

$reader = new SpreadsheetReader($targetDirectory);

foreach($reader as $key => $row){

  $paxtype = $row[0];
  $title = $row[1];
  $firstname =$row[2];
  $lastname = $row[3];
  $mobile = $row[4];
  $email = $row[5];
  $dob = $row[6];
  $passport_number = $row[7];
  $expiry = $row[8];

$Dob =date('Y-m-d', strtotime($dob));
$Expiry =date('Y-m-d', strtotime($expiry));
  if(!empty($paxtype) && !empty($title) && !empty($firstname)){  

    $namevalue ='paxType="'.$paxtype.'",title="'.$title.'",firstName="'.$firstname.'",lastName="'.$lastname.'",mobile="'.$mobile.'",email="'.$email.'",dob="'.$Dob.'",passportNumber="'.$passport_number.'",passportExpiry="'.$Expiry.'",agentId="'.$_SESSION['agentUserid'].'", addDate="'.date("Y-m-d H:i:s").'" ';  

    addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue);
    }
} ?> 
<script>   
parent.window.location.href = "my_customer.php?save=1";
</script>
<?php 
}  
?>