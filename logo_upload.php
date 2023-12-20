<?php

include "config/database.php"; 
include "config/function.php"; 
include "agenturlinc.php";

//print_r($_FILES); exit;


if(!empty($_FILES['company_logo']['name'])){
    //Include database configuration file
   
 
    
    //File uplaod configuration
    $result = 0;
    $uploadDir = "images/";
    $fileName = time().'_'.basename($_FILES['company_logo']['name']);
    $targetPath = $uploadDir.$fileName;
    //echo $targetPath; exit;
    
    //Upload file to server
    if(@move_uploaded_file($_FILES['company_logo']['tmp_name'], $targetPath)){
        //Get current user ID from session
        $userId = $_SESSION['agentUserid'];
        
        //Update picture name in the database
      
        $sql_ins="UPDATE sys_userMaster SET companyLogo = '".$fileName."' WHERE id =$userId"; 
        //echo $sql_ins; exit;
        mysqli_query(db(),$sql_ins) or die(mysqli_error()); 
        //$update = $db->query("UPDATE sys_usermaster SET companyLogo = '".$fileName."' WHERE id =126");
        
        //Update status
        // if($update){
        //     $result = 1;
            echo 'File uploaded successfully.';
        // }
    }
    
    //Load JavaScript function to show the upload status
   // echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' . $targetPath . '\');</script>  ';
}








?>


