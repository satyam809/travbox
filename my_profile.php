<?php

include "inc.php"; 

include "config/logincheck.php";  

$selectedpage=''; 

$selectleft=''; 

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/15.0.1/css/intlTelInput.css">

<title>My Profile - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 

<?php include "headerinc.php"; ?>

</head>



<body class="greyouter">

  <?php include "header.php"; ?>







<!--------------Left Menu---------------->





<?php include "left.php"; ?>











<!--------------Mid Body---------------->





<section class="profile">

    <div class="container midcontent">

        <div class="card profilecard">

            <div class="card-body">







<?php

if ($_SESSION['profile_status'] == "incomplete") {

?>

   <div class="alert alert-danger fs-7 fw-bold" role="alert">

      <?php echo $_SESSION['profile_statusMessage']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-xm btn-primary edit_AccountInformation" data-toggle="modal" data-mode="edit"  data-target="#edit_AccountInformation">Complete Now</span>

   </div>

<?php

} else if ($_SESSION['profile_status'] == "complete") {

?>

   <div class="alert alert-warning fs-6 fw-bold" role="alert">

       <?php echo $_SESSION['profile_statusMessage']; ?>

   </div>

<?php }else{ ?>

	<div class="alert alert-success fs-6 fw-bold" role="alert">

			Profile Verification complete! You're good to go for a seamless system experience. Enjoy! 😊

			</div>

<?php	} ?>



			

			

			

			

                <div class="card-header d-flex justify-contetnt-end">

              <h1>Account Information</h1>

			   

               </div>

			   <p>Basic info,for a faster booking experience</p>                

                <div class="table-responsive"><table class="table table-bordered table-striped profiletable" style=" font-size:13px;">

                                            

                                            <tbody> 

                                     <tr>

                                                  <td align="left" valign="top"><div style="width:120px;"><strong>First Name </strong></div></td>

                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['name']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Last Name  </strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['lastName']); ?></td>

                                                </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Email </strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['email']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Contact No. </strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>City</strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo getCityName($LoginUserDetails['city']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td align="left" valign="top"><strong>State</strong></td>

                                                  <td align="left" valign="top" class="profiledetail"><?php echo getStateName($LoginUserDetails['state']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td align="left" valign="top"><strong>Country</strong></td>

                                                  <td align="left" valign="top" class="profiledetail"><?php echo getCountryName($LoginUserDetails['country']); ?></td>

                                              </tr>

                                              <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Address</strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['address']); ?></td>

                                              </tr>

                                              

                                              <tr>

                                                <td align="left" valign="top"><strong>Pin Code </strong></td>

                                                <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['pincode']); ?></td>

                                              </tr>

                                            </tbody>

                                      </table>

                                    </div>

                </div>

          </div>

          <div class="card profilecard">

            <div class="card-body">

               

                <h1>Agency Information</h1>

                <p>Basic info,for a faster booking experience</p>                

                <div class="table-responsive"><table class="table table-bordered table-striped profiletable" style=" font-size:13px;">

                                            

                                            <tbody> 

                                     <tr>

                                                  <td align="left" valign="top"><div style="width:120px;"><strong>Logo</strong></div></td>

                                                  <td align="left" valign="top" class="profiledetail"><img src="<?php echo $imgurl; ?><?php echo !empty($LoginUserDetails['companyLogo']) ? $LoginUserDetails['companyLogo'] : "travbox_logo.webp"; ?> " alt="<?php echo stripslashes($LoginUserDetails['companyName']); ?>"  ><span class="btn btn-xm btn-primary edit_CompanyLogo float-end mt-3" data-toggle="modal" data-mode="edit"  data-target="#edit_CompanyLogo"> <i class="fa fa-edit" aria-hidden="true"></i></span> <br>                                                
                                                  <span id="" style="font-size: 10px" class="text-danger">Only formats are allowed: jpeg,jpg,png , Size should be less than 200kb , height less than 246px and  width less than 969px.</span>
                                                </td>



											 </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Agent ID:</strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail">#<?php echo makeAgentId($LoginUserDetails['agentId']); ?></td>

                                                </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Company Name</strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['companyName']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>Business Type</strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php if(1==$LoginUserDetails['businessType']){ echo 'Proprietorship'; } 

								  if(2==$LoginUserDetails['businessType']){ echo 'Partnership'; } 

								  if(3==$LoginUserDetails['businessType']){ echo 'Limited Partnership'; } 

								  if(4==$LoginUserDetails['businessType']){ echo 'Corporation'; } 

								  if(5==$LoginUserDetails['businessType']){ echo 'Limited Liability Company'; } 

								  if(6==$LoginUserDetails['businessType']){ echo 'Nonprofit Organization'; } 

								  if(7==$LoginUserDetails['businessType']){ echo 'Cooperative'; } 

								  

								  ?></td>

                                              </tr>

											  <?php if($LoginUserDetails['countryCode']==91){ ?>

                                                <tr>

                                                  <td width="10%" align="left" valign="top"><strong>PAN</strong></td>

                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['pan']); ?></td>

                                              </tr>

                                                <tr>

                                                  <td align="left" valign="top"><strong>Agency GSTIN</strong></td>

                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['gstin']); ?></td>

                                              </tr>

											  <?php }else{ ?>

											  

											     <tr>

                                                  <td align="left" valign="top"><strong>Citizinship Identity</strong></td>

                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['citizinship']); ?></td>

                                              </tr>

											  <?php } ?>

											  

                                                <tr>

                                                  <td align="left" valign="top"><strong>Website</strong></td>

                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['website']); ?></td>

                                              </tr>

                            

                                            </tbody>

                                      </table>

                                    </div>

                </div>

          </div>

    </div>

</section>

<div class="modal fade" id="edit_CompanyLogo">

   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

      <form id="edit_CompanyLogoFORM" method="POST" target="actoinfrm" enctype="multipart/form-data" action="modify-companylogo">

            <input type="hidden" name="EditID" id="EditID" value="<?php echo stripslashes($LoginUserDetails['id']); ?>" >
            <input type="hidden" name="oldComanyLogo" id="oldComanyLogo" value="<?php echo stripslashes($LoginUserDetails['companyLogo']); ?>" >

            <div class="modal-header">

               <h4 class="modal-title" id="modal-title">Update Company Logo</h4>

               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>

            </div>

            <div class="modal-body">

        

            

               

               <div class="row">

              

                  <div class="col-md-12">

                     <div class="form-group">

                        <label>Company Logo </label>

                        <input type="file" required class="form-control" id="companyLogoCustom" name="companyLogo" accept=".png, .jpg, .jpeg">

						<span id="err-companyLogoCustom" class="text-danger">Only formats are allowed: jpeg,jpg,png , Size should be less than 200kb , height less than 246px and  width less than 969px.</span>

                     </div>

                  </div>

              

               </div>

            </div>

            <div class="modal-footer">

               <button type="button" class="btn btn-danger light btn-sm" data-dismiss="modal">Close</button>

               <button type="submit" id="edit_CompanyLogoBtns" class="btn btn-primary light btn-sm" >Save</button>

            </div>

            <input name="action" type="hidden" value="modify_companylogo">

         </form>

      </div>

   </div>

</div>



<div class="modal fade" id="edit_AccountInformation">

   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

      <div class="modal-content">

         <form id="AccountInformationForm" method="POST" target="actoinfrm" enctype="multipart/form-data" action="complete-signup">

            <input type="hidden" name="EditID" id="EditID" value="<?php echo stripslashes($LoginUserDetails['id']); ?>" >

            <div class="modal-header">

               <h4 class="modal-title" id="modal-title">Edit Account Information</h4>

               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>

            </div>

            <div class="modal-body">

               <div class="row">

                  <h5 class="modal-title">Basic info,for a faster booking experience</h5>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Reference By</label>

						<?php

						$countryCode = $LoginUserDetails['countryCode'];

                        $LoginUserDetails['countryCode'] = str_replace('+', '', $countryCode);

						?>

                        <select  required id="salesManager" name="salesManager" class="form-select form-control select-clear" data-placeholder="Select Sales Manager" >

                           <option value="0">Select Manager</option>

                           <?php

                              $user=GetPageRecord('*','sys_userMaster',' userType="superadmin_user" and showOnWebsite=1 order by name asc');

                              

                              

                              while($userData=mysqli_fetch_array($user)){

                              

                              ?>

                           <option value="<?php echo $userData['id']; ?>" <?php if($userData['id']==$editresult['salesManager']){ ?>selected="selected"<?php } ?>><?php echo $userData['name']; ?></option>

                           <?php } ?>

                           <option value="100001">Others</option>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>First Name </label>

                        <input type="text" name="name" required id="name" value="<?php echo stripslashes($LoginUserDetails['name']); ?>" class="form-control  "> 

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Last Name </label>

                        <input type="text" name="lastName" required id="lastName" value="<?php echo stripslashes($LoginUserDetails['lastName']); ?>" class="form-control  ">

                     </div>

                  </div>

                  <div class="col-md-12 d-none">

                     <div class="form-group">

                        <label> Email address</label>

                        <input readonly type="text" name="email" required value="<?php echo stripslashes($LoginUserDetails['email']); ?>"  id="email" class="form-control  ">

                     </div>

                  </div>

                  <div class="col-md-6 d-none">

                     <div class="form-group">

                        <label>Contact No. </label>

                        <input readonly type="text" pattern="^07[0-9]{9}$" name="phone" value="<?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?>" required id="mobile" class="form-control  ">

                     </div>

                  </div>

                  <h6 class="modal-title">Residential Address Information</h6>

                  <div class="col-md-4">

                     <div class="from-group">

                        <label>country</label>

                        <select class="form-select form-control" required name="userCountry" id="userCountry" aria-label="Default select example"  onChange="selectstateuser();">

                           <option selected>Select Your Country</option>

                           <?php  

                              $rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');

                              

                              

                              

                              while($rest=mysqli_fetch_array($rs)){ 

                              

                              

                              

                              ?> 

                           <option value="<?php echo $rest['id']; ?>" <?php if($rest['phonecode']==$LoginUserDetails['countryCode']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                           <?php } ?>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="from-group">

                        <label>State</label>

                        <select class="form-select form-control" required id="userState" name="userState" aria-label="Default select example"  onChange="selectcityuser();">

                           <option value="">Select Your State</option>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="from-group">

                        <label>City</label>

                        <select id="userCity" name="userCity" required class="form-control form-control-sm  my-0 City">

                           <option value=""></option>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Residential Address</label>

                        <input type="text" name="address" required value="<?php echo stripslashes($LoginUserDetails['address']); ?>"  id="address" class="form-control  ">

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Pincode</label>

                        <input  required  type="tel"  name="pincode" id="pincode" maxlength="6" value="<?php echo stripslashes($LoginUserDetails['pincode']); ?>"  class="form-control  ">

                     </div>

                  </div>

                  <?php if($LoginUserDetails['countryCode']=='91'){ ?>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Aadharcard Number</label>

                        <input type="tel" class="form-control" name="aadharNumber" id="aadharNumber" pattern="\d{4}\s\d{4}\s\d{4}" placeholder="&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226;" maxlength="14">

                     </div>

                  </div>

                  <?php }else { ?>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Citizenship Identity</label>

                        <input type="tel" class="form-control"  name="citizinship" id="Citizenship" placeholder="">

                     </div>

                  </div>

                  <?php } ?>

               </div>

               <hr>

               <h5 class="modal-title">Edit your Agency Information</h5>

               <div class="row">

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Company Name* </label>

                        <input type="companyName" required class="form-control" id="companyName" name="companyName" value="<?php echo stripslashes($LoginUserDetails['companyName']); ?>"   >

                     </div>

                     </div>

                 

				  

                  <?php if($LoginUserDetails['countryCode']=='91'){ ?>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Pan Number* </label>

                      <input type="text" required class="form-control" id="txtPANNumber" name="pan" maxlength="10" oninput="this.value = this.value.toUpperCase();" <?php echo stripslashes($LoginUserDetails['pan']); ?>>



                     </div>

			      </div>

                     <?php } ?>

                

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Phone Number* </label>

                        <input type="tel" class="form-control" required id="companyMobile" name="companyMobile" maxlength="10"   > 

                     </div>

                  </div>

                  <?php if($LoginUserDetails['countryCode']=='91'){ ?>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Attach PAN Card Copy </label>

                        <input type="file" class="form-control" required id="panCopy" name="panCopy" accept=".png, .jpg, .jpeg,.pdf">

                     </div>

                  </div>

                  <?php } ?>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Company Logo </label>

                        <input type="file" class="form-control" id="companyLogo" name="companyLogo" accept=".png, .jpg, .jpeg">

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label> Company Address* </label>

                        <input name="companyAddress" type="text" required class="form-control" id="companyAddress" value="" size="30">

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                        <label>Company Pincode* </label>

                        <input type="tel" class="form-control" required  name="companyPincode" id="companyPincode" maxlength="6" >

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="from-group">

                        <label>country</label>

                        <select class="form-select form-control" name="country" id="country" required aria-label="Default select example"  onChange="selectstate();">

                           <option selected>Select Your Country</option>

                           <?php  

                              $rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');

                              

                              

                              

                              while($rest=mysqli_fetch_array($rs)){ 

                              

                              

                              

                              ?> 

                           <option value="<?php echo $rest['id']; ?>"  <?php if($rest['phonecode']==$LoginUserDetails['countryCode']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

                           <?php } ?>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="from-group">

                        <label>State</label>

                        <select class="form-select form-control" id="state" required name="state" aria-label="Default select example"  onChange="selectcity();">

                           <option value="">Select Your State</option>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="from-group">

                        <label>City</label>

                        <select id="city" name="city" required class="form-control form-control-sm  my-0 City">

                           <option value=""></option>

                        </select>

                     </div>

                  </div>

                  <div class="col-md-6">

                     <div class="from-group">

                        <label> Business Type* </label>

                        <select required id="businessType" name="businessType" class="form-select form-control" data-placeholder="Select Business Type" tabindex="-1" aria-hidden="true">

                           <option value="">Select Type</option>

                           <option value="1">Proprietorship</option>

                           <option value="2">Partnership</option>

                           <option value="3">Limited Partnership</option>

                           <option value="4">Corporation</option>

                           <option value="5">Limited Liability Company </option>

                           <option value="6">Nonprofit Organization </option>

                           <option value="7">Cooperative</option>

                        </select>

                     </div>

                  </div>

                  <?php if($LoginUserDetails['countryCode']=='91'){ ?>

                  <div class="col-md-6">

                     <div class="from-group">

                        <label>GST Number</label>

                        <input type="text" required class="form-control" name="gstNumber" id="gstNumber" maxlength="15">

                     </div>

                  </div>

                  <?php } ?>

               </div>

            </div>

            <div class="modal-footer">

               <button type="button" class="btn btn-danger light btn-sm" data-dismiss="modal">Close</button>

               <button type="submit" id="editAccountInformationBtns" class="btn btn-primary light btn-sm" >Save</button>

            </div>

            <input name="action" type="hidden" value="complete_profile">

         </form>

      </div>

   </div>

</div>



<!-- Bootstrap Modal -->

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="profileModalLabel">Important Notification !</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <?php echo $_SESSION['profile_statusMessage']; ?>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>







<!-- HTML -->



<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@15.0.2/build/js/intlTelInput.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // Get the file input element, submit button, and error message span

    const fileInput = document.getElementById("companyLogoCustom");

    const submitButton = document.getElementById("edit_CompanyLogoBtns");

    const fileErrorMessage = document.getElementById("err-companyLogoCustom");



    // Disable the submit button by default and hide the error message

    submitButton.setAttribute("disabled", "disabled");

    fileErrorMessage.style.display = "none";



    // Add an event listener to the file input

    fileInput.addEventListener("change", function () {
      const selectedFile = this.files[0];
      // console.log(selectedFile);
         if($('#companyLogoCustom').val() != ''){
        // Get the selected file

        var img = new Image();
         
         img.onload = function() {

            // console.log(this.width);

               if(this.width < 969 && this.height < 246){
                  
                  submitButton.removeAttribute("disabled");

               fileErrorMessage.style.display = "none";
               

               }else{
                  submitButton.setAttribute("disabled", "disabled");

                  fileErrorMessage.style.display = "block";
               }

         }


         var objectURL = URL.createObjectURL(selectedFile);

         img.src = objectURL;

        // Check if a file is selected

        if (selectedFile) {

            // Check file format (extension)

            const allowedFormats = ["jpeg", "jpg", "png"];

            const fileNameParts = selectedFile.name.split(".");

            const fileExtension = fileNameParts[fileNameParts.length - 1].toLowerCase();



            if (allowedFormats.includes(fileExtension)) {

                // Check file size (less than 200kb)

                if (selectedFile.size <=1024 * 200) {

                    // Enable the submit button and hide the error message

                    submitButton.removeAttribute("disabled");

                    fileErrorMessage.style.display = "none";

                    return;

                }

            }

        }





        // If the validation fails or no file is selected, disable the submit button and show the error message

        submitButton.setAttribute("disabled", "disabled");

        fileErrorMessage.style.display = "block";
      }else{
         submitButton.setAttribute("disabled", "disabled");
         fileErrorMessage.style.display = "none";
      }

    });

});



</script>

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



selectstateuser();



selectstate();



var selectedCountryData = iti.getSelectedCountryData();

var countryCode = selectedCountryData.dialCode;

var country_code = selectedCountryData.dialCode;



</script>

<script>

$(document).ready(function() {

	

	

if (country_code == '91') {

	   aadharNumber.addEventListener('keyup',function (e) {



    // console.log(e.keyCode);



    if (e.keyCode !== 8) {



        if (this.value.length === 4 || this.value.length === 9 || this.value.length === 14) {



        this.value = this.value += ' ';



        }



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

   

}

   

    $('#AccountInformationForm').submit(function(event) {

       // debugger;

        event.preventDefault();

        $('.error').text('');



        var salesManager = $('#salesManager').val();

        var firstName = $('#name').val();

        var lastName = $('#lastName').val();

      

       

        var pincode = $('#pincode').val();

        var address = $('#address').val();

        

        var panNumber = $('#txtPANNumber').val();

       

        var companyAddress = $('#companyAddress').val();

        var companyPincode = $('#companyPincode').val();

        var companyMobile  = $('#companyMobile').val();

        var companyName =  $('#companyName').val();

        var userCity = $('#userCity').val();

        var city = $('#city').val();

        var businessType = $('#businessType').val();



        // Regular expressions for validation

        var nameRegex = /^[a-zA-Z ]+$/;

      

        var panRegex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

        var gstRegex = /^([0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Za-z]{1}[A-Za-z0-9]{2})$/;



        if (salesManager == 0) {

    alert('Please select sales manager');

    return false;

}



// Validate first name

if (firstName == '') {

    alert('Name is required');

    return false;

}

if (!firstName.match(nameRegex)) {

    alert('Please enter a valid first name');

    return false;

}



// Validate last name

if (!lastName.match(nameRegex)) {

    alert('Please enter a valid last name');

    return false;

}



if (pincode == '') {

    alert('Pincode is required');

    return false;

}



// Validate address

if (address.trim() === '') {

    alert('Address is required');

    return false;

}



// Validate dropdown

if (userCity === '') {

    alert('Please select city');

    return false;

}



if (companyName.trim() === '') {

    alert('Company Name is required');

    return false;

}



if (country_code == '91') {

    if (panNumber == '') {

        alert('Please enter PAN');

    }

    if (!panNumber.match(panRegex)) {

        alert('Invalid PAN number');

        return false;

    }

}



if (companyMobile == '') {

    alert('Company phone is required');

    return false;

}



if (companyAddress == '') {

    alert('Company Address is required');

    return false;

}



if (companyPincode == '') {

    alert('Company Pincode is required');

    return false;

}



if (city == '') {

    alert('City is required');

    return false;

}



if (businessType === '') {

    alert('Please select Business Type');

    return false;

}





        $('#AccountInformationForm').unbind('submit').submit();

    });

});



</script>



<script>

    <?php

    if (isset($_SESSION['showProfileModal']) && $_SESSION['showProfileModal'] === true) {

        echo '$(document).ready(function() { $("#profileModal").modal("show"); });';

        // After showing the modal, reset the session variable to prevent showing it again on subsequent page loads

        $_SESSION['showProfileModal'] = false;

    }

    ?>

</script>





  <?php include "footerinc.php"; ?>



</body>

</html>

