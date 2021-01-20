@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/Form.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
	<div class="">

		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Add User</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						 @include('website.backend.layouts.flashmessage') 
						<form id="regForm"  method="post" action="{{ url('/Add_User') }}"enctype="multipart/form-data">
							@csrf

							<div class="tab">
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" style="border-radius: 3pt" id="first-name" required="required" class="form-control " name="first_name">
								</div>
							</div>

							<div class="item form-group">
								<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Middle Name <span class="required">*  :</span></label>
								<div class="col-md-6 col-sm-6 ">
									<input id="middle-name" style="border-radius: 3pt" class="form-control" type="text" name="middle-name">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" style="border-radius: 3pt" id="last-name" name="last-name" required="required" class="form-control">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align ">User Type <span class="required">*  :</span></label>
								<div class="col-md-6 col-sm-6 ">
									<select class="form-control" style="border-radius: 3pt" name="select_type" required>
										<option value="0" selected disabled>Select Type</option>
										@foreach($user_type as $user_type)
										<option value="{{$user_type->User_Type_ID}}">{{$user_type->Type_Name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input id="birthday" style="border-radius: 3pt" name="birthdate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
									<script>
										function timeFunctionLong(input) {
											setTimeout(function() {
												input.type = 'text';
											}, 60000);
										}
									</script>
								</div>
							</div>
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Gender <span class="required">*  :</span></label>
								<div class="col-md-6 col-sm-6 ">
									<div id="gender" class="btn-group" data-toggle="buttons">
										<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" style="border-radius: 3pt" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
										</label>
										<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" style="border-radius: 3pt" name="gender" value="female" class="join-btn"> Female
										</label>
									</div>
								</div>
							</div>
							</div>

							<div class="tab">
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number">Phone Number <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="phone" style="border-radius: 3pt" id="phone_number" name="phone_number" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="Email">Email <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" style="border-radius: 3pt" id="Email" name="Email" required="required" class="form-control">
								</div>
							</div>
							</div>

							<div class="tab">
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Pasword <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="password" style="border-radius: 3pt" id="password" name="password" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="confirm_password">Confirm Password <span class="required">*  :</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="password" style="border-radius: 3pt" id="password_confirmation" name="password_confirmation" required="required" class="form-control">
								</div>
							</div>
							</div>

							<div style="overflow:auto;">
								<div style="float:right;">
								  <button type="button" id="prevBtn" onclick="nextPrev(-1)">  Previous</button>
								  <button type="button" id="nextBtn" onclick="nextPrev(1)"> Next  </button>
								</div>
							  </div>
							  
							  <!-- Circles which indicates the steps of the form: -->
							  <div style="text-align:center;margin-top:40px;">
								<span class="step"></span>
								<span class="step"></span>
								<span class="step"></span>
								
							  </div>

						</form>

						<script>

							var currentTab = 0; // Current tab is set to be the first tab (0)
							showTab(currentTab); // Display the current tab

							function showTab(n) {
							// This function will display the specified tab of the form ...
							var x = document.getElementsByClassName("tab");
							x[n].style.display = "block";
							// ... and fix the Previous/Next buttons:
							if (n == 0) {
								document.getElementById("prevBtn").style.display = "none";
							} else {
								document.getElementById("prevBtn").style.display = "inline";
							}
							if (n == (x.length - 1)) {
								document.getElementById("nextBtn").innerHTML = "Submit";
							} else {
								document.getElementById("nextBtn").innerHTML = "Next";
							}
							// ... and run a function that displays the correct step indicator:
							fixStepIndicator(n)
							}

							function nextPrev(n) {
							// This function will figure out which tab to display
							var x = document.getElementsByClassName("tab");
							// Exit the function if any field in the current tab is invalid:
							if (n == 1 && !validateForm()) return false;
							// Hide the current tab:
							x[currentTab].style.display = "none";
							// Increase or decrease the current tab by 1:
							currentTab = currentTab + n;
							// if you have reached the end of the form... :
							if (currentTab >= x.length) {
								//...the form gets submitted:
								document.getElementById("regForm").submit();
								return false;
							}
							// Otherwise, display the correct tab:
							showTab(currentTab);
							}

							function validateForm() {
							// This function deals with validation of the form fields
							var regName =/^[A-Za-z]{2,30}$/;
							var regEmail=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
							var regNational =/^[0-9]{14}$/;
							var passw=  /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
							var regexp = /^[A-Z]/;
                         var mobileReg=/^[0][1][0-9]{2}?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
						
							var x, y, i, valid = true;
							x = document.getElementsByClassName("tab");
							y = x[currentTab].getElementsByTagName("input");
							// A loop that checks every input field in the current tab:

							for (i = 0; i < y.length; i++) {
								// If a field is empty...
								
								if (y[i].value == "") {
								// add an "invalid" class to the field:
								y[i].className += " invalid";
								alert("Please Fill This Field");
								// and set the current valid status to false:
								valid = false;
								}else if(y[i].name=="first_name"&&!(regName.test(y[i].value)))
								{

									
									alert("Letters Only In First Name");
									valid = false;
								}
								
								
								else if(y[i].name=="middle-name"&&!(regName.test(y[i].value)))
								{

									
									alert("Letters Only In Middle Name");
									valid = false;
								}
								
								else if(y[i].name=="last-name"&&!(regName.test(y[i].value)))
								{


									
									alert("Letters Only In Last Name");
									valid = false;
								}
							
							
							else if(y[i].name=="Email"&&!(regEmail.test(y[i].value)))
								
                            {
	                        alert("You have entered an invalid email address!")
                             valid = false;
                             }
                              else if(y[i].name=="national_id"&&!(regNational.test(y[i].value)))
								
                              {
	                          alert("You have entered an invalid Id!")
                               valid = false;
                                 }
                              if(y[i].name=="password"&&!(passw.test(y[i].value))) 
                                {  
								alert('please enter capital letter and character and small letter ');
								valid = false;

		}
else{
if(y[i].name=="password"&& y[i].value!=y[i+1].value){
	alert("Not Matching!!");
	valid=false;
}
if(y[i].name=="phone_number"&&!(mobileReg.test(y[i].value))) 
{ 
alert('Invalid Phone Form ');
valid = false;

}

}}
for (i = 0; i < y.length; i++) {
								// If a field is empty...
								if (y[i].value == "") {
								// add an "invalid" class to the field:
								y[i].className += " invalid";
								// and set the current valid status to false:
								valid = false;
								}
							}
							// If the valid status is true, mark the step as finished and valid:
							if (valid) {
								document.getElementsByClassName("step")[currentTab].className += " finish";
							}
							return valid; // return the valid status
							}


							function fixStepIndicator(n) {
							// This function removes the "active" class of all steps...
							var i, x = document.getElementsByClassName("step");
							for (i = 0; i < x.length; i++) {
								x[i].className = x[i].className.replace(" active", "");
							}
							//... and adds the "active" class to the current step:
							x[n].className += " active";
							}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection