<?php 

// ini_set('display_errors', '1');

// ini_set('display_startup_errors', '1');

// error_reporting(E_ALL);

include "config/database.php";

include "config/function.php";

include "config/setting.php";

include "agenturlinc.php";





$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  

$AgentWebsiteData=mysqli_fetch_array($rs);

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/15.0.1/css/intlTelInput.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

  </style>



<title>Sign Up - <?php echo $systemname; ?></title> 

<?php include "headerinc.php"; ?>



<script>



function selectcity(){



	var stateId = $('#state').val();



	$('#city').load('loadcity.php?id='+stateId+'&selectId=');



	}



	



	function selectstate(){



	var countryId = $('#country').val(); 

	 



	$('#state').load('loadstate.php?id='+countryId+'&selectId='); 



	}





function selectcityuser(){



	var stateId = $('#userState').val();



	$('#userCity').load('loadcity.php?id='+stateId+'&selectId=');



	}



	



	function selectstateuser(){



	var countryId = $('#userCountry').val(); 

	 



	$('#userState').load('loadstate.php?id='+countryId+'&selectId='); 



	}











function checkUID(uid) {

    if (uid.length != 12) {

        return false;

    }



    var Verhoeff = {

        "d": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],

            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],

            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],

            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],

            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],

            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],

            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],

            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],

            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],

            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]],

        "p": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],

            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],

            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],

            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],

            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],

            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],

            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],

            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]],

        "j": [0, 4, 3, 2, 1, 5, 6, 7, 8, 9],

        "check": function (str) {

            var c = 0;

            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {

                c = Verhoeff.d[c][Verhoeff.p[i % 8][parseInt(u, 10)]];

            });

            return c;



        },

        "get": function (str) {



            var c = 0;

            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {

                c = Verhoeff.d[c][Verhoeff.p[(i + 1) % 8][parseInt(u, 10)]];

            });

            return Verhoeff.j[c];

        }

    };



    String.prototype.verhoeffCheck = (function () {

        var d = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],

            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],

            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],

            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],

            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],

            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],

            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],

            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],

            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],

            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]];

        var p = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],

            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],

            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],

            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],

            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],

            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],

            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],

            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]];



        return function () {

            var c = 0;

            this.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {

                c = d[c][p[i % 8][parseInt(u, 10)]];

            });

            return (c === 0);

        };

    })();



    if (Verhoeff['check'](uid) === 0) {

        return true;

		alert();

    } else {

        return false;

    }

}







</script>

</head>



<body id="loginbg" class="loginbody">

  <!-- header -->

   

    <div id="loginouter" style="height: auto;margin-top: 20px ;margin-bottom: 20px ; position:inherit;  padding-bottom:130px;">

<div id="loginouterin" style="height: auto;">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 d-flex"style="border-bottom:1px solid var(--lightgray)">

                <div>

                    <h1 class="pt-3 ms-4 me-4 my-2 pb-3 createheading">Create Your Account</h1>

                      

                </div>

                <div class="registerlogo ms-auto me-3">

                    <!-- <img src="<?php echo $imgurlagent; ?><?php echo $AgentWebsiteData['companyLogo']; ?>" alt=""> -->

                    <img src="<?php echo $fullurl; ?>images/<?php echo $AgentWebsiteData['companyLogo']; ?>" alt="">

                </div>

                </div>







	  <form class="login-form" action="process-signup" id="signupform" target="actoinfrm" method="post">



                <div class="row" style="margin:auto;">

            <div class="col-lg-6">

                <div class="createform">

                

                    <h2 class="accountheading">Account Information</h2>

					      <div class="row" >

              	<div class="col-12">

                            <div class="mb-3">

                                <label for="agentId" class="form-label">Reference By<span class="mdt">*</span></label> 

								

								<select id="salesManager" name="salesManager" class="form-select form-control select-clear" data-placeholder="Select Sales Manager" >  

						<option value="0">Select Manager</option>

						<?php

						//$user=GetPageRecord('*','sys_userMaster',' userType="superadmin_user"   order by name asc');

                     
						$user=GetPageRecord('*','sys_userMaster',' userType="superadmin_user" and showOnWebsite=1 order by name asc');
						

						while($userData=mysqli_fetch_array($user)){

						?>

						<option value="<?php echo $userData['id']; ?>" <?php if($userData['id']==$editresult['salesManager']){ ?>selected="selected"<?php } ?>><?php echo $userData['name']; ?></option> 

						<?php } ?>

						<option value="100001">Others</option>

						</select>

                        <span id="salesManagererror" class="error"></span>

                            </div>

							</div> 

               

                 <div class="col-6">

                            <div class="mb-3">

                                <label for="firstName" class="form-label">First Name<span class="mdt">*</span></label>

                                <input type="text" name="firstName" id="firstName" class="form-control"  aria-describedby="emailHelp">

                                <span id="firstNameError" class="error"></span>

                            </div>

							</div>

							

							

							 <div class="col-6">

							<div class="mb-3">

                            <label for="lastName" class="form-label">Last Name<span class="mdt">*</span></label>

                            <input  type="name" name="lastName" class="form-control" id="lastName">

                            <span id="lastNameError" class="error"></span>

                            

                        </div>

						</div>

							

							 <div class="col-6">

                            <div class="mb-3">

                                <label for="mobile" class="form-label">Mobile Number<span class="mdt">*</span></label>

                                <!-- <input name="mobile" type="tel" class="form-control" id="mobile" maxlength="10"  > -->
                                 <input id="mobile" name="mobile" type="tel" class="form-control">

                                <input name="verfied" class="d-none" type="text" id="veifiedinput">

                                <span style="color: #b2abab;font-size: 12px;">An OTP will be sent on your above entered number for verification.</span><br>

                                

                                <span id="mobileNumberError" class="error"></span>

                                <span id="verifiedError" class="error"></span>

                                <span id="verified_phone" class="success"></span>

                                <i class="fa fa-edit" style="margin-top: 10px;display:none;" onclick="edit_num()" id="editnumber" style="display:none;">&nbsp;Edit Mobile Number</i>

                                <div id="recaptcha-container"></div>

                            </div>

                            <div class="mb-3">

                            <input type="text" style="display:none"  type="tel" class="form-control" id="verificationCode" placeholder="Enter verification code">

                            <button class="btn btn-primary" type="button" id="send_otp" onclick="phoneAuth();">Send Otp</button>

                            </div>



                            <div class="mb-3">

                            <button class="btn btn-primary" type="button" id="verifiy_otp" onclick="codeverify();" style="display:none">Verify code</button>

                            </div>





							</div>

							

							 <div class="col-6">

							<div class="mb-3">

                            <label for="email" class="form-label">Email Address<span class="mdt">*</span></label>

                            <input type="email" class="form-control" name="email" id="email">

                            <span id="emailError" class="error"></span>



                        </div>

						</div>

							

							 <div class="col-6">

                            <div class="mb-3">

                                <label for="password" class="form-label">Password (Min. 8 characters)<span class="mdt">*</span></label>

                                <input type="password" id="password" class="form-control" name="password" maxlength="8">

                                <span id="passwordError" class="error"></span>

                            </div>

							</div>

							

							 <div class="col-6">

							<div class="mb-3">

                            <label for="confirmpassword" class="form-label">Confirm Password<span class="mdt">*</span></label>

                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" maxlength="8"   >

                            <span id="confirmPasswordError" class="error"></span>

                        </div>

						</div>



						 





 

                        

                        

                         <div class="col-6">

                        <div class="mb-3">

                            <label for="pincode" class="form-label">Pincode<span class="mdt">*</span></label>

                            <input type="tel" class="form-control"  name="pincode" id="pincode" maxlength="6">

                            <span id="pincodeerror" class="error"></span>

                        </div>

                        </div>

                		<div class="col-6">

                        <div class="mb-3 hide_Class">

                            <label for="aadharNumber" class="form-label">Aadhar Number</label>

                            <input type="tel" class="form-control"  name="aadharNumber" id="aadharNumber" pattern="(\d{4}\s?){3}" placeholder="&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226;" maxlength="12"  >

                            <span id="aadhaarNumberError" class="error"></span>

                            

                        </div>

                         <div class="mb-3 show_Class d-none">

                            <label for="Citizenship" class="form-label">Citizenship Identity</label>

                            <input type="tel" class="form-control"  name="citizinship" id="Citizenship" placeholder="">

                            

                            

                        </div>

                        </div>

                <div class="col-12">

                            <div class="mb-3">

                                <label for="address" class="form-label">Residential Address<span class="mdt">*</span></label><br>

                                <input name="address" type="text" class="form-control" id="address" value="" size="30">

                                <span id="addressError" class="error"></span>

                                

                                

                            </div>

                   </div>

                     

                        <div class="col-4">

                            <div class="mb-3">

                                <label for="country" class="form-label">Select Country<span class="mdt">*</span></label>

                                <select class="form-select form-control" name="userCountry" id="userCountry" aria-label="Default select example"  onChange="selectstateuser();">

                                    <option selected>Select Your Country</option>

                             <?php  



$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');



while($rest=mysqli_fetch_array($rs)){ 



?> 



<option value="<?php echo $rest['id']; ?>" <?php if($rest['name']=='India'){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  



<?php } ?>

                                  </select>

								  

								  

                            </div>



                            

                        </div>

                        <div class="col-4">

                            <div class="mb-3">

                                <label for="state" class="form-label">Select State<span class="mdt">*</span></label>

                                <select class="form-select form-control" id="userState" name="userState" aria-label="Default select example"  onChange="selectcityuser();">

                                <option value="">Select Your State</option>

                                  </select>

                            </div>

                        </div>

                        <div class="col-4">

                            <div class="mb-3">

                                <label for="city" class="form-label">Select City<span class="mdt">*</span></label>

                                <select name="userCity" id="userCity" class="form-select form-control"  tabindex="11">



                                    <option value="">Select Your City</option>



                                </select>

                                <span class="error" id="dropdownError"></span>

                                

                            </div>

                        </div>

                    </div>



                    

                </div>

            </div>

            

<!-- leftformends -->



               <!-- rightformstarts -->

            <div class="col-lg-6">

                <div class="agencyform">

                    <h2>Agency Information</h2>

                    <!-- companyrow -->

                    <div class="row">

					   <div class="col-6">

						  <div class="mb-3">

                              <label for="companyName" class="form-label">Company Name<span class="mdt">*</span></label>

                              <input type="companyName" class="form-control" id="companyName" name="companyName"  >

                              <span id="companyNameError" class="error"></span>

                          </div>

						  </div>

						  

                          <div class="col-6 hide_Class">

                            <label for="panNumber" class="form-label">Pan Number <span class="mdt">*</span></label>

                            <input type="text" class="form-control" id="txtPANNumber" name="pan" maxlength="10"  >

                            <span id="panNumberError" class="error"></span>

                            

                        </div>

					<div class="col-6">

						  <div class="mb-3">

                              <label for="companyNumber" class="form-label">Phone Number<span class="mdt">*</span></label>

                              <input type="tel" class="form-control" id="companyMobile" name="companyMobile" maxlength="10"  >

                              <span id="phoneNumberError" class="error"></span>

                          </div>

						  </div>

						  

						<div class="col-6 hide_Class">

							<label for="panNumber" class="form-label">Attach PAN Card Copy</label>

							<input type="file" class="form-control" id="panCopy" name="panCopy" accept=".png, .jpg, .jpeg,.pdf">

						</div>

						<div class="col-6">

						<div class="mb-3">

							<label for="companyAddress" class="form-label">Company Address<span class="mdt">*</span></label><br>

							<input name="companyAddress" type="text" class="form-control" id="companyAddress" value="" size="30">

                            <span id="companyaddressError" class="error"></span>

						</div>

						</div>





 

                        

                        

                         <div class="col-6">

                        <div class="mb-3">

                            <label for="companyPincode" class="form-label">Company Pincode<span class="mdt">*</span></label>

                            <input type="tel" class="form-control"  name="companyPincode" id="companyPincode" maxlength="6" >

                            <span id="companypincodeError" class="error"></span>

                        </div>

                        </div>

                  

							

                        <div class="col-4">

                            <div class="mb-3">

                                <label for="country" class="form-label">Select Country<span class="mdt">*</span></label>

                                <select class="form-select form-control" name="country" id="country" aria-label="Default select example"  onChange="selectstate();">

                                    <option selected>Select Your Country</option>

                             <?php  



$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');



while($rest=mysqli_fetch_array($rs)){ 



?> 



<option value="<?php echo $rest['id']; ?>" <?php if($rest['name']=='India'){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  



<?php } ?>

                                  </select>

                            </div>



                            

                        </div>

                        <div class="col-4">

                            <div class="mb-3">

                                <label for="state" class="form-label">Select State<span class="mdt">*</span></label>

                                <select class="form-select form-control" id="state" name="state" aria-label="Default select example"  onChange="selectcity();">

                                <option value="">Select Your State</option>

                                  </select>

                            </div>

                        </div>

                        <div class="col-4">

                            <div class="mb-3">

                                <label for="city" class="form-label">Select City<span class="mdt">*</span></label>

                                <select name="city" id="city" class="form-select form-control"  tabindex="11">



                            <option value="">Select Your City</option>



                        </select>

                        <span id="cityerror" class="error"></span>

                            </div>

                        </div>

             

                          <div class="col-6">

                              <label for="businessType" class="form-label register-lev">Business Type<span class="mdt">*</span></label>

                             

							 <select id="businessType" name="businessType" class="form-select form-control" data-placeholder="Select Business Type" tabindex="-1" aria-hidden="true">  

										<option value="">Select Type</option>  

										<option value="1">Proprietorship</option>  

										<option value="2">Partnership</option>  

										<option value="3">Limited Partnership</option>  

										<option value="4">Corporation</option>  

										<option value="5">Limited Liability Company </option>  

										<option value="6">Nonprofit Organization </option>  

										<option value="7">Cooperative</option>  

									</select>



                                    <span id="businessTypeError" class="error"></span>

                                    

                            

                                    

							   

                          </div>

                          <div class="col-6">

						  <div class="mb-3 hide_Class">

                            <label for="gstNumber" class="form-label">GST Number</label>

                            <input type="text" class="form-control" name="gstNumber" id="gstNumber" maxlength="15">

                            <span id="gstNumberError" class="error"></span>

                            

								</div>

                        </div>

                       

                    <div class="col-lg-12 my-4">

                    <h6> <input type="checkbox" name="iaccept" value="1" class="checkbox"> I accept the <a target="_blank" href="terms-conditions">terms &amp; conditions</a></h6>

                    <span class="error" id="checkboxError"></span>

                    </div>  <!-- atacchaddharcopy -->

					

					</div>

               

            <!-- rightformends -->

        </div>

    </div>

                </div>

                <div class="row" style="border-top: 1px solid var(--lightgray); margin: auto; padding: 20px 10px;">

        <div class="col-lg-6">

            <div class="youhave my-1">

                <!--<p>Already have account? <a href="<?php echo $fullurl; ?>">Login now</a></p>-->

            </div>

        </div>

        <div class="col-lg-6" style="text-align: right;">

    

            <!-- <button type="button" class="btn btn-danger registerbutton" onClick="submitregister();" style=" width:200px;">Register</button> -->



            <button type="submit" class="btn btn-danger registerbutton" style=" width:200px;">Register</button>

                </div>

            

        </div>

		<input name="action" type="hidden" value="register">

			<input name="validpan" id="validpan" type="hidden" value="0">

</form>

 

    </div>

</div>

</div>

</div>





<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <!-- <div class="modal-content"> -->

      <!-- <div class="modal-body"> -->

      <!-- <div class="container  d-flex justify-content-center align-items-center"> -->

        <div class="position-relative">

            <div class="card p-2 text-center">

                <h6>Please enter the one time password <br> to verify your account</h6>

                <div> <span>A code has been sent to</span> <small>*******9897</small> </div>

                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" /> </div>

                <div class="mt-4"> <button class="btn btn-danger px-4 validate">Validate</button> </div>

            </div>

        <!-- </div> -->

<!-- </div> -->

      <!-- </div> -->

        <!-- <div class="modal-footer">

            <button type="button" class="btn btn-secondary" >Close</button>

            

        </div> -->

    </div>

  </div>

</div>

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

selectstateuser();

selectstate();

var selectedCountryData = iti.getSelectedCountryData();
var countryCode = selectedCountryData.dialCode;
var country_code = selectedCountryData.dialCode;
//alert(countryCode);
//console.log(countryCode);

// window.onload = function() {

//     render();

// };



// function render() {

//     // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');

//     // recaptchaVerifier.render();



//     window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {

//         'size': 'invisible',

//         'callback': (response) => {

//           // reCAPTCHA solved, allow signInWithPhoneNumber.

//           phoneAuth();

//         }

//       });

    

// }

  



var firebaseConfig = {

    apiKey: "AIzaSyCesI8_rDZSGzVWJ5fa4pxK2grtkdrkJLc",

    authDomain: "mobileotp-5df6e.firebaseapp.com",

    projectId: "mobileotp-5df6e",

    storageBucket: "mobileotp-5df6e.appspot.com",

    messagingSenderId: "942825759037",

    appId: "1:942825759037:web:3595ecc073450a85f16554",

    measurementId: "G-763BZHVC93"

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

                

                var salesManager = $('#salesManager').val();

               // alert(salesManager);

                var firstName = $('#firstName').val();

                // alert(firstName); 

                var lastName = $('#lastName').val();

                var mobileNumber = $('#mobile').val();

                  var  veifiedinput =  $('#veifiedinput').val();

                var email = $('#email').val();

                var password = $('#password').val();

                var confirmPassword = $('#confirmpassword').val();

                var pincode = $('#pincode').val();

                var address = $('#address').val();

                var phoneNumber = $('#phoneNumber').val();

                // var aadhaarNumber = $('#aadharNumber').val();

                var panNumber = $('#txtPANNumber').val();

                var checkboxChecked = $('input[type="checkbox"]:checked').length > 0;

                var companyAddress = $('#companyAddress').val();

                var companyPincode = $('#companyPincode').val();

                var companyMobile  = $('#companyMobile').val();

                var companyName =  $('#companyName').val();

                var userCity = $('#userCity').val();

                var city     = $('#city').val();

                var businessType = $('#businessType').val();

                



                // Regular expressions for validation

                var nameRegex = /^[a-zA-Z ]+$/;

                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                var mobileRegex = /^\d{10}$/;

                // var aadhaarRegex = /^\d{12}$/;

                var panRegex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

                var gstRegex = /^([0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Za-z]{1}[A-Za-z0-9]{2})$/;





                if(salesManager == 0)

                {

                    $('#salesManagererror').text('Please select sales manager');

                   

                    return false;

                }



                // // Validate first name

                if(firstName=='')

                {

                    $('#firstNameError').text('Name is required');

                   

                    return false;

                }

                if (!firstName.match(nameRegex)) {

                    $('#firstNameError').text('Please enter a valid first name');

                    return false;

         

                }



                // Validate last name

                if (!lastName.match(nameRegex)) {

                    $('#lastNameError').text('Please enter a valid last name');

                    return;

                }



                // if (!mobileNumber.match(mobileRegex)) {

                // $('#mobileNumberError').text('Invalid mobile number');

                // return false;

                // }



                   if(veifiedinput != 'VERIFIED')

                   {

                     $('#verifiedError').text('Please verified your mobile number');

                     return false;

                   

                   }



        



                if (!email.match(emailRegex)) {

                $('#emailError').text('Invalid email address');

                return false;

                }



                    // Validate password

                if (password.length < 8) {

                $('#passwordError').text('Password should be at least 8 characters long');

                return false;

                }



                // Validate confirm password

                if (confirmPassword !== password) {

                $('#confirmPasswordError').text('Passwords do not match');

                return false;

                }



                if(pincode == '')

                {

                    $('#pincodeerror').text('Pincode is required');

                    return false;

                }



               



                    



                // Validate Aadhaar number



                // if (aadhaarNumber !== '' && !aadhaarNumber.match(aadhaarRegex)) {

                // $('#aadhaarNumberError').text('Invalid Aadhaar number');

                // return false;

                // }

                

                



                // // Validate phone number

                // if (!phoneNumber.match(mobileRegex)) {

                // $('#phoneNumberError').text('Invalid phone number');

                // return false;

                // }





                // Validate address

                if (address.trim() === '') {

                $('#addressError').text('Address is required');

                return false;

                }



                



                // Validate dropdown

                if (userCity === '') {

                $('#dropdownError').text('Please select city');

                return false;

                }



                if (companyName.trim() === '') {

                    $('#companyNameError').text('Company Name is required');

                    return false;

                }

             if(country_code == '91')
                {
                   

                if(panNumber=='')

                {

                    $('#panNumberError').text('Please enter PAN ');

                }



                if (!panNumber.match(panRegex)) {

                    $('#panNumberError').text('Invalid PAN number');

                    return false;

                }

            }

                if(companyMobile == '')

                {

                    $('#phoneNumberError').text('Company phone is required');

                     return false;

                }



                

                

                if (companyAddress == '') {

                $('#companyaddressError').text('Company Address is required');

                return false;

                }





                



                if (companyPincode == '') {

                $('#companypincodeError').text('Company Pincode is required');

                return false;

                }





                if(city == '')

                {



                   $('#cityerror').text('City is required');

                   return false;

                   

                }



               



                if (businessType === '') {

                $('#businessTypeError').text('Please select Business Type');

                    return false;

                }





                //Validate checkboxes

                if (!checkboxChecked) {

                $('#checkboxError').text('Please select term & conditions');

                return false;

                }  



                // If all validations pass, submit the form

                 //alert('Form submitted successfully');

                

                // $('#exampleModal').modal({backdrop: 'static', keyboard: false}, 'show');

                // $('#exampleModal').modal('show'); 

                // $("#exampleModal").modal({

                // show: false,

                // backdrop: 'static'

                // });

                 $('#signupform').unbind('submit').submit();

            });

            

        });





    function phoneAuth() {
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

        alert("otp send successfully");

    }).catch(function(error) {

        alert(error.message);

    });

}



function codeverify() {

    var code = document.getElementById('verificationCode').value;





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



    aadharNumber.addEventListener('keyup',function (e) {

    // console.log(e.keyCode);

    if (e.keyCode !== 8) {

        if (this.value.length === 4 || this.value.length === 9 || this.value.length === 14) {

        this.value = this.value += ' ';

        }

    }

    });



     $('input[type="tel"]').keyup(function(e) {

        var inputValue = $(this).val();



        // Remove non-digit characters

        var numericValue = inputValue.replace(/\D/g, '');



        // Update the input value

        $(this).val(numericValue);

      });



      $("#firstName,#lastName").keypress(function(e) {

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



     





        $("#aadharNumber").on("keydown", function(e) {

        var key = e.keyCode || e.which;

        

        // Allow only digits and specific key codes

        if (!((key >= 48 && key <= 57) || key === 8 || key === 9 || key === 35 || key === 36 || key === 37 || key === 39 || key === 46)) {

            e.preventDefault();

        }

        });



        $("#txtPANNumber").on("keypress", function(event) {

        var panCardValue = $(this).val() + String.fromCharCode(event.which);



        var panRegex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

        var isValidPanCard = panRegex.test(panCardValue);



        if (!isValidPanCard) {

            $("#panNumberError").text("Invalid PAN card format");

        } else {

            $("#panNumberError").text("");

        }

        });



        // $("#gstNumber").on("keypress", function(event) {

        // var gstValue = $(this).val() + String.fromCharCode(event.which);



       

        // var gstRegex = /^([0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Za-z]{1}[A-Za-z0-9]{2})$/;

        // var isValidGST = gstRegex.test(gstValue);



        // if (!isValidGST) {

        //     $("#gstNumberError").text("Invalid GST format");

        // } else {

        //     $("#gstNumberError").text("");

        // }

        // });


        // $("#mobile").on("input", function() {
        //     validateMobileNumber();
        // });

        // function validateMobileNumber() {
        //     const mobileNumber = $("#mobile").val();
        //     const mobileRegex = /^\+?\d{1,15}$/;
        //     //const mobileRegex = /^\d{10}$/; // Regular expression for a 10-digit mobile number

        //     if (!mobileNumber.match(mobileRegex)) {
        //         $("#mobileNumberError").text("Invalid mobile number");
        //     } else {
        //         $("#mobileNumberError").text("");
        //     }
        // }


        // $("#password, #confirmpassword").on("keypress", function(event) {
        // validatePasswords();
        // });

        // function validatePasswords() {
        //     const password = $("#password").val();
        //     const confirmPassword = $("#confirmpassword").val();
        //     // const minLength = 8;
        //     // alert(password.length);

        //     if (password.length < 7) {
        //         $("#passwordError").text("Password must be at least 8 characters long");
        //     } else {
        //         $("#passwordError").text("");
        //     }

        //     if (confirmPassword !== password) {
        //         $("#confirmPasswordError").text("Passwords do not match");
        //     } else {
        //         $("#confirmPasswordError").text("");
        //     }
        // }



      











  



  

 





// $('#txtPANNumber').change(function (event) {     

//  var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 

//  var txtpan = $(this).val(); 

//  if (txtpan.length == 10 ) { 

//   if( txtpan.match(regExp) ){ 

//    $('#validpan').val('1');

//   }

//   else {

//    alert('Not a valid PAN number');

//    event.preventDefault(); 

//   } 

//  } 

//  else { 

//        alert('Please enter 10 digits for a valid PAN number');

//        event.preventDefault(); 

//  } 



// });





/*function submitregister(){



var aadharNumber = $('#aadharNumber').val();

 

if(checkUID(aadharNumber)){



if($('#validpan').val()==1){

 

$('#signupform').submit();



} else {

alert('Please enter valid pan number.');

}



} else { 

alert('Please enter correct aadhaar number.');

}





}*/









// function submitregister(){



// var aadharNumber = $('#aadharNumber').val();

 



// if($('#validpan').val()==1){

 

// $('#signupform').submit();



// } else {

// alert('Please enter valid pan number.');

// }

 





// }

















// var panVal = $('#pan').val();

// var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;



// if(regpan.test(panVal)){

//    // valid pan card number

// } else {

//    // invalid pan card number

// }

function edit_num()

{

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

<?php include "footerinc.php"; ?>

<?php include "footer.php"; ?> 

</body>

</html>

