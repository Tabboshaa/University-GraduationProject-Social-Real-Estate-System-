@extends('website.backend.layouts.main')
@section('content')

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
						<form method="POST" action="{{ url('/Add_User') }}" enctype="multipart/form-data">
							@csrf
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">{{ __('Upload Image') }}</label>

								<div class="col-md-6">
									<input type="file" name="image" value="{{ old('image') }}">

								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align ">User Type</label>
								<div class="col-md-6 col-sm-6 ">
									<select class="form-control" name="select_type">
										@foreach($user_type as $user_type)
										<option value="{{$user_type->User_Type_ID}}">{{$user_type->Type_Name}}</option>
										@endforeach
									</select>
								</div>
							</div>


							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="first-name" required="required" class="form-control " name="first_name">
								</div>
							</div>

							<div class="item form-group">
								<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Middle Name </label>
								<div class="col-md-6 col-sm-6 ">
									<input id="middle-name" class="form-control" type="text" name="middle-name">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="last-name" name="last-name" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="Email">Email <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="Email" name="Email" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Pasword <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="pasword" id="pasword" name="pasword" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="confirm_password">Confirm Password <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="password" id="confirm_password" name="confirm_password" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number">Phone Number <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="phone" id="phone_number" name="phone_number" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input id="birthday" name="birthdate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
									<script>
										function timeFunctionLong(input) {
											setTimeout(function() {
												input.type = 'text';
											}, 60000);
										}
									</script>
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="phone_number">National ID <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="national_id" name="national_id" required="required" class="form-control">
								</div>
							</div>

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
								<div class="col-md-6 col-sm-6 ">
									<div id="gender" class="btn-group" data-toggle="buttons">
										<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
										</label>
										<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="gender" value="female" class="join-btn"> Female
										</label>
									</div>
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 offset-md-3">
									<button type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection