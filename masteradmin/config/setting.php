<?php

$a=GetPageRecord('*','sys_companyMaster','id=1 ');  
$companyProfileData=mysqli_fetch_array($a); 
$systemname=$companyProfileData['companyName'];  


$footerversion='V. 3.0 -  tripzygo'; 



//-----------------Flight API-----------------  


$hitSource = 'P'; //Production 
$A_ID = '79820682';
$PWD = 'flyshop1234'; 
$U_ID = 'flyshop';
$MODULE = 'B2B';



/*$hitSource = 'D'; //Development  
$A_ID = '74842703';
$U_ID = 'flyshop';
$PWD = '9911346115';
$MODULE = 'B2B';*/



//Endpoint URL to hit API:

//For develpoment enviroment url:
/*$TokenUrl = 'http://nauth.ksofttechnology.com/API/AUTH';
$FlightSearchUrl = 'http://stageapi.ksofttechnology.com/API/FLIGHT';
$SeatAvailUrl = 'http://stageapi.ksofttechnology.com/API/AVLT';
$PnrCreateUrl = 'http://stageapi.ksofttechnology.com/API/flight';
$PnrRetreiveUrl = 'http://stageapi.ksofttechnology.com/API/flight';*/

//For Live Enviroment url:
$TokenUrl = 'http://nauth.ksofttechnology.com/API/AUTH';
$FlightSearchUrl = 'http://napi.ksofttechnology.com/API/FLIGHT';
$SeatAvailUrl = 'http://napi.ksofttechnology.com/API/AVLT';
$PnrCreateUrl = 'http://napi.ksofttechnology.com/API/flight';
$PnrRetreiveUrl = 'http://napi.ksofttechnology.com/API/flight';


?>