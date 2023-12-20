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

$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."' and id!=1 and  password='".md5($_POST['password'])."' and status=1 and (userType='agent') ")  or die(mysqli_error());  

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



deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 



$_SESSION['agentUserid']=$userinfo['id'];   

$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  

$_SESSION['agentUsername']=$userinfo['email'];    

$_SESSION['parentid']=$userinfo['parentId'];  



loginattampmail($userinfo['id'],$_POST['username']); 



$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='User Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

 

$sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['agentUserid']."";  

mysqli_query(db(),$sql_ins) or die(mysqli_error());  



header('Location: '.$fullurl.'');



exit();



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/15.0.1/css/intlTelInput.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
   <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4ETVF45NR8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-4ETVF45NR8');
    </script>
    <!-- End Google Tag Manager -->
    <style>
        
         .intl-tel-input.allow-dropdown input, .intl-tel-input.allow-dropdown input[type=text], .intl-tel-input.allow-dropdown input[type=tel], .intl-tel-input.separate-dial-code input, .intl-tel-input.separate-dial-code input[type=text], .intl-tel-input.separate-dial-code input[type=tel]
         {
         padding-right: 0;
         box-sizing: content-box;
         }
         .intl-tel-input .country-list .flag-box, .intl-tel-input .country-list .country-name
         {
         color:#000;
         }
         .error {
         color: red;
         }
         .height-100 {
         height: 100vh
         }
         .card {
         width: 400px;
         border: none;
         height: 300px;
         box-shadow: 0px 5px 20px 0px #d2dae3;
         z-index: 1;
         display: flex;
         justify-content: center;
         align-items: center
         }
         .card h6 {
         color: red;
         font-size: 20px
         }
         .inputs input {
         width: 40px;
         height: 40px
         }
         input[type=number]::-webkit-inner-spin-button,
         input[type=number]::-webkit-outer-spin-button {
         -webkit-appearance: none;
         -moz-appearance: none;
         appearance: none;
         margin: 0
         }
         .card-2 {
         background-color: #fff;
         padding: 10px;
         width: 350px;
         height: 100px;
         bottom: -50px;
         left: 20px;
         position: absolute;
         border-radius: 5px
         }
         .card-2 .content {
         margin-top: 50px
         }
         .card-2 .content a {
         color: red
         }
         .form-control:focus {
         box-shadow: none;
         border: 2px solid red
         }
         .validate {
         border-radius: 20px;
         height: 40px;
         background-color: red;
         border: 1px solid red;
         width: 140px
         }
         .success
         {
         font-size: 10px;
         color: green!important;
         font-weight: bold;
         }
         .mobile_input .intl-tel-input{
            width: 100%;
         }
        @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {

              #mobile
              {
                 width:82%!important;              
              }
              .web
              {
                 display:none!important;
              }
              .mobile_logo
         {
            display:block!important;
         }
         .carousel-control.right
         {
             background-image:none;
         }
         .carousel-control.left
         {
             background-image:none;
         }
         .carousel-indicators
         {
            display:none!important;
         }
       

            }
      </style>


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

      <!-- <li data-target="#myCarousel" data-slide-to="2"></li>

      <li data-target="#myCarousel" data-slide-to="3"></li> -->

    </ol>



    <!-- Wrapper for slides -->

    <div class="carousel-inner">

      <div class="item active">

        <img src="images/signup1.png" class="leftbanner" alt="travbox" style="width:100%;">

      </div>

 <div class="item">

        <img src="images/signup2.png" class="leftbanner" alt="travbox" style="width:100%;">

      </div>

      <!-- <div class="item">

        <img src="images/cruise.jpg" class="leftbanner" alt="travbox" style="width:100%;">

      </div> -->

    

      <!-- <div class="item">

        <img src="images/GlobalFlight.jpg" class="leftbanner" alt="travbox" style="width:100%;">

      </div> -->

      

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

      <form class="login-form" action="process-signup" id="signupform" target="actoinfrm" method="post">
        

            <div class="formlogo web">

              <img src="<?php echo $img_newurl; ?><?php echo $AgentWebsiteData['companyLogo']; ?>" style="height:55px;margin-left: 80px;">

			 <?php if($notlogin==1){?>
         <div style="margin:10px 0px; color:#CC0000; font-size:12px; font-weight:600;">Invalid Login!</div><?php } ?>

            </div>

          <div class="formlogo mobile_logo" style="display:none;">

          <img src="<?php echo $img_newurl; ?>logo/travbox-small-size.png" style="">
          <a href="<?php echo $fullurl; ?>" class="btn btn-primary border-0 float-end" style="background-color: #49cec1!important;">Login</a>

          <?php if($notlogin==1){?>
          <div style="margin:10px 0px; color:#CC0000; font-size:12px; font-weight:600;">Invalid Login!</div><?php } ?>

          </div>

            <div class="image_mobile">
              <br>
            <!-- <img style="width:100%;border-radius: 12px;" alt="travbox"  src="images/vecon-slider_final.png"> -->
            <!-- <img style="width:100%;border-radius: 12px;" alt="travbox"  src="images/slider/slide5.jpg"> -->

            <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                     
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                       
                      </ol>

                  
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="images/slider/slide5.jpg" style="border-radius:10px;" alt="slider1" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="images/slider/slide6.jpg" style="border-radius:10px;" alt="slider2" style="width:100%;">
                        </div>
                      
                      
                      </div>

                     
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  

              <br>
              <!-- <br> -->
             </div>

            <div class="inputbox">
            <h1 class="mb-3">Sign Up</h1>
                             
            
            <div class="row" >
            <div class="col-12">

                                <div class="mb-3">

                                <label for="companyName" class="form-label">Agency/Company Name<span class="mdt">*</span></label>

                                <input type="text" name="companyName" id="companyName" class="form-control"  aria-describedby="emailHelp">

                                <span id="companyNameError" class="error"></span>

                                </div>

                                </div>

                                 <div class="col-12">
                                    <div class="mb-3">
                                       <label for="email" class="form-label">Email Address<span class="mdt">*</span></label>
                                       <input type="email" class="form-control" name="email" id="email">
                                       <span id="emailError" class="error"></span>
                                    </div>
                                 </div>
                                
                                 <div class="col-12 mobile_input">
                                    <div class="mb-3">
                                       <label for="mobile" class="form-label">Mobile Number<span class="mdt">*</span></label><br>
                                       <!-- <input name="mobile" type="tel" class="form-control" id="mobile" maxlength="10"  > -->
                                       <input id="mobile" name="mobile" type="tel" class="form-control" style="width: 86%;height:7px;"><br>
                                       <input name="verfied" class="d-none" type="text" id="veifiedinput">
                                       <span id="otp_msg" style="color: #b2abab;font-size: 12px;">An OTP will be sent on your above entered number for verification.</span><br>
                                       <span id="mobileNumberError" class="error"></span>
                                       <span id="verifiedError" class="error"></span>
                                       <span id="verified_phone" class="success"></span>
                                       <i class="fa fa-edit" style="margin-top: 10px;display:none;" onclick="edit_num()" id="editnumber" style="display:none;">&nbsp;Edit Mobile Number</i>
                                       <div id="recaptcha-container"></div>
                                    </div>
                                    <div class="mb-3">
                                       <input type="text" style="display:none"  type="tel" class="form-control" id="verificationCode" placeholder="Enter verification code">
                                       <button class="btn btn-primary" type="button" id="send_otp" onclick="phoneAuth();">Send OTP
                                       &nbsp;<img src="<?php echo $fullurl; ?>images/loading.gif" width="20" id="loader" >
                                      </button>
                                    </div>
                                    <div class="">
                                       <button class="btn btn-primary" type="button" id="verifiy_otp" onclick="codeverify();" style="display:none">Verify code
                                        &nbsp;<img src="<?php echo $fullurl; ?>images/loading.gif" width="20" id="verifiyloader" >
                                      </button>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 mt-4 mb-0">
                                    <div class="checkbox">
                                        <label>
                                            <input  style="margin-top:0px;" type="checkbox" name="iaccept" value="1" class="checkbox"><span style="margin-left:12px;"> I accept the</span> <a target="_blank" href="terms-conditions">terms &amp; conditions</a>
                                        </label>
                                    </div>
                                    <span class="error" id="checkboxError"></span>
                                 </div>
                                 <div class="col-lg-12">
                                 
                                    <div class="checkbox web">
                                       <p style="font-weight: 500;">Already have account? <a href="<?php echo $fullurl; ?>">Login now</a> By signing up, you agree to our <a href="privacy-policy" target="_blank">Privacy Policy</a></p>
                                      
                                    </div>
                                    
                                 </div>
                                 <div class="col-lg-12 mt-4 text-center">
                                     <button type="submit" class="btn btn-danger registerbutton py-3" style=" width:200px;">Register</button>
                                 </div>
                              </div>

            </div>
            <input name="action" type="hidden" value="register">

                     <input name="validpan" id="validpan" type="hidden" value="0">

					     <input type="hidden" id="countryCodeInput" name="countryCode" value="91">
            </form>

      

            

        

           

     

      </div>

    </td>

  </tr>

</table>



</div>

</div>

<?php //include "footerinc.php"; ?>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@15.0.2/build/js/intlTelInput.js"></script>
<script>

// Initialize the intlTelInput library

var input = document.querySelector("#mobile");



var iti = window.intlTelInput(input, {

    initialCountry: "in" // Set the initial country code to India (ISO 3166-1 alpha-2 code for India is "in")

  });

const listbox = document.querySelector('ul[role="listbox"]');

const options = listbox.querySelectorAll('[role="option"]');



options.forEach(option => {

option.addEventListener('click', () => {

    // Toggle the aria-selected attribute for the clicked option

    country_code =(option.getAttribute('data-dial-code'));

    console.log(country_code);

    document.getElementById("countryCodeInput").value = country_code;

    if(country_code == '91')

            {

                

                $('.hide_Class').show();

                $('show_Class').hide();

                $('.show_Class').addClass('d-none');

               

            }

            else

            {

                $('.hide_Class').hide();

                $('.show_Class').removeClass('d-none');

            }

    // const isSelected = option.getAttribute('aria-selected') == 'true';

    // option.setAttribute('aria-selected', !isSelected);

    // console.log(isSelected);

});

});

</script>
<script>

var firebaseConfig = {
    apiKey: "AIzaSyBICD2hiceeimiZR4lIozvWz3Y9t0Jx-GU",
    authDomain: "travbox-1800c.firebaseapp.com",
    projectId: "travbox-1800c",
    storageBucket: "travbox-1800c.appspot.com",
    messagingSenderId: "257558896948",
    appId: "1:257558896948:web:1ab13f2d4f044081d00561",
    measurementId: "G-PGD76EV4MF"
  };







    // Initialize Firebase



    firebase.initializeApp(firebaseConfig);



    firebase.analytics();











        $(document).ready(function() {







            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {



            'size': 'invisible',



            'callback': (response) => {



            // reCAPTCHA solved, allow signInWithPhoneNumber.



            //phoneAuth();



            }



        });







            $('#verifiy_otp').hide();



            $('#verificationCode').hide();



        //      $('#exampleModal').modal({backdrop: 'static', keyboard: false}, 'show');



        //      $(".btn").click(function(){



        //     $("#exampleModal").modal('hide');



        // });



            $('#signupform').submit(function(event) {

                debugger;



                event.preventDefault();



                $('.error').text('');



               

               // alert(salesManager);



                var companyName = $('#companyName').val();





                var mobileNumber = $('#mobile').val();



                var  veifiedinput =  $('#veifiedinput').val();



                var email = $('#email').val();



               // var password = $('#password').val();



               // var confirmPassword = $('#confirmpassword').val();



               



                var checkboxChecked = $('input[type="checkbox"]:checked').length > 0;



            

              



                







                // Regular expressions for validation



                var companyNameRegex = /^[a-zA-Z ]+$/;



                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



                var mobileRegex = /^\d{10}$/;



                // var aadhaarRegex = /^\d{12}$/;



                var panRegex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;



                var gstRegex = /^([0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Za-z]{1}[A-Za-z0-9]{2})$/;









                // // Validate first name



                if(companyName=='')



                {



                    $('#companyNameError').text('Company Name is required');



                   



                    return false;



                }



                if (!companyName.match(companyNameRegex)) {



                    $('#companyNameError').text('Please enter a valid Company name');



                    return false;



         



                }







              







                







                   if(veifiedinput != 'VERIFIED')



                   {



                     $('#verifiedError').text('Please verified your mobile number');



                     //return false;



                   



                   }







        







                if (!email.match(emailRegex)) {



                $('#emailError').text('Invalid email address');



                return false;



                }





                //Validate checkboxes



                if (!checkboxChecked) {



                $('#checkboxError').text('Please select term & conditions');



                return false;



                } 
                
                if(companyName!='' &&  checkboxChecked!='' && email!='' && veifiedinput!='')
                {
                  $('#signupform').unbind('submit').submit();

                      var email = $(this).val();
                      $('#emailError').text('');
                      $.ajax({
                          type: 'POST',
                          url: 'signup_action.php',
                          data: {'email': email,'unique':'email'},
                          success: function(response) {
                            console.log(response);
                            if(response == 'true')
                            {
                              $('#emailError').text('email already exit');
                            }
                          
                            
                          }
                      });




                }



                 



            });


            //   email already check for already exit
            $('#email').on('input', function() {
                var email = $(this).val();
                $('#emailError').text('');
                $.ajax({
                    type: 'POST',
                    url: 'signup_action_shortform.php',
                    data: {'email': email,'unique':'email'},
                    success: function(response) {
                      console.log(response);
                      if(response == 'true')
                      {
                         $('#emailError').text('email already exit');
                      }
                     
                      
                    }
                });
            });



            



        });










    $('#loader').hide();
    $('#verifiyloader').hide();
    function phoneAuth() {
    
      $('#loader').show();
    var selectedCountryData = iti.getSelectedCountryData();

    var countryCode = selectedCountryData.dialCode;



    //get the number



    var number = $('#mobile').val();



    //var number = '+91'+number;

    var number = '+'+countryCode +number;



    // alert(number);



    //it takes two parameter first one is number and second one is recaptcha



    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {



        //s is in lowercase



        window.confirmationResult = confirmationResult;



        coderesult = confirmationResult;



        console.log(coderesult);



        $('#send_otp').hide();



        $('#verificationCode').show();



        $('#verifiy_otp').show();



        // var inputField = document.getElementById('number');



        // inputField.style.display = 'none'; // Hide the input field



        // var inputField = document.getElementById('send_otp');



        // inputField.style.display = 'none'; // Hide the input field



        // var inputField = document.getElementById('verificationCode');



        // inputField.style.display = 'block'; // Hide the input field



        // var inputField = document.getElementById('verifiy_otp');



        // inputField.style.display = 'block'; // Hide the input field


    
        $('#otp_msg').text('OTP Send Successfully');
        $("#otp_msg").css("color", "green").css("important", "color");
        $("#mobile").prop("readonly", true);


        

        //alert("otp send successfully");



    }).catch(function(error) {



        alert(error.message);



    });



}







function codeverify() {



    var code = document.getElementById('verificationCode').value;










    $('#verifiyloader').show();
    coderesult.confirm(code).then(function(result) {



       



        $('#verified_phone').text('VERIFIED');



        $('#veifiedinput').val('VERIFIED');



        $('#verificationCode').hide();



        $('#verifiy_otp').hide();



        $("#mobile").css({



            "pointer-events": 'none',



            "background": "#ccc",



        });



        $('#editnumber').show();



        $('#verified_phone').show();
        $('#verifiyloader').hide();






        //alert("Successfully registered");



        var user = result.user;



        console.log(user);



    }).catch(function(error) {



        alert(error.message);



    });



}



















    $('body').on('keyup', '#mobile', function () {



        var $input = $(this),



            value = $input.val(),



            length = value.length,



            inputCharacter = parseInt(value.slice(-1));







        if (!((length > 1 && inputCharacter >= 0 && inputCharacter <= 9) || (length === 1 && inputCharacter >= 7 && inputCharacter <= 9))) {



            $input.val(value.substring(0, length - 1));



        }



  });













     $('input[type="tel"]').keyup(function(e) {



        var inputValue = $(this).val();







        // Remove non-digit characters



        var numericValue = inputValue.replace(/\D/g, '');







        // Update the input value



        $(this).val(numericValue);



      });







      $("#companyName").keypress(function(e) {



        var key = e.keyCode || e.which;



        var char = String.fromCharCode(key);



        



        // Regular expression to match special characters



        var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;



        



        // Check if the pressed character is a special character



        if (regex.test(char)) {



            e.preventDefault();



        }







        if (key >= 48 && key <= 57) {



            e.preventDefault();



        }







        });








function edit_num()



{

  
    $('#loader').hide();

    var number = $('#mobile').val();



    $('#verified_phone').text('');



    $('#verified_phone').hide();



    $('#verificationCode').hide();



    $('#verifiy_otp').hide();



    $('#send_otp').show();



    $("#mobile").css({



        "pointer-events": 'visible',



        "background": "#fff",



    });



    $('#editnumber').hide();



    $('#verificationCode').val('');



   



}



</script>
       <style>
         .flightfooter{position:fixed; left:0px; bottom:0px; width:100%;}
      </style>
<!-- Event snippet for signup conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-11251069322/uWG1CN367u0YEIrj9vQp'});
</script>
</body>

</html>





















