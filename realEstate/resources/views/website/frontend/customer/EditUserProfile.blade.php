@extends('website.frontend.layouts.main')
@section('profile')
    <div class="main-content bg-lightblue theme-dark-bg right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                            <a href="default-settings.html" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                            <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Account Details</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0 ">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 text-center">
                                    @if($image!=null)
                                    <figure class="avatar ms-auto me-auto mb-0 mt-2 w100"><img src="{{asset('storage/cover page/'.$image->Profile_Picture)}}" alt="image" class="shadow-sm rounded-3 w-100"></figure>
                                    @else
                                        <figure class="avatar ms-auto me-auto mb-0 mt-2 w100"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-3 w-100"></figure>

                                    @endif
                                    <form method="POST" action="{{url('/UpdateProfilePhoto')}}" enctype="multipart/form-data">
                                        @csrf
                                        <label class="fw-600 text-grey-900 font-xssss mt-0 ms-3 me-0" for="profile_photo_upload"><i class="feather-edit text-grey-500 me-3 font-sm"></i></label>
                                        <input id="profile_photo_upload" name="ProfilePhoto" type="file" accept="image/*" style="display:none" onchange="javascript:this.form.submit();">
                                    </form>
                                    <h2 class="fw-700 font-sm text-grey-900 mt-3">{{$user->First_Name}}  {{$user->Last_Name}}</h2>
                                    <!-- <a href="#" class="p-3 alert-primary text-primary font-xsss fw-500 mt-2 rounded-3">Upload New Photo</a> -->
                                </div>
                            </div>

                            <form method="POST" action="{{url('/EditUserProfile1')}}">
                                @CSRF
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">First Name</label>
                                            <input type="text" class="form-control" value="{{$user->First_Name}}" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" name="Fname" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Last Name</label>
                                            <input type="text" class="form-control" value="{{$user->Last_Name}}" pattern="[A-Z][a-z]+(\s*([A-Z][a-z]+)*)*" title="First Letter must be Capital" name="Lname"required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Email</label>
                                            <input type="text" class="form-control"value="{{$email->email}}"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex@gmail.com" name="email"required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Phone</label>
                                            @if($phone)
                                            <input type="text" pattern="^01[0-2]\d{1,8}$" title="01---------" class="form-control" value="{{$phone->phone_number}}" name="phone"required>
                                            @else
                                            <input type="text" pattern="^01[0-2]\d{1,8}$" title="01---------" class="form-control" value="" name="phone" required>
                                            @endif
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="col-lg-12 mb-3">--}}
{{--                                    <b><label>Edit Your Cover Photo</label></b>--}}
{{--                                        <div class="card mt-3 border-0">--}}
{{--                                            <div class="card-body d-flex justify-content-between align-items-end p-0">--}}
{{--                                                  <form  method="POST" action="{{url('/UpdateCoverPhoto')}}">--}}
{{--                                                    @CSRF--}}

{{--                                                    <label for="file" class="rounded-3 text-center bg-white btn-tertiary js-labelFile p-4 w-100 border-dashed">--}}
{{--                                                        <input type="file" name="file" id="file" class="input-file" onchange="javascript:this.form.submit();">--}}
{{--                                                        <i class="ti-cloud-down large-icon me-3 d-block"></i>--}}
{{--                                                        <span class="js-fileName">Drag and drop or click to replace</span>--}}
{{--                                                    </label>--}}
{{--                                                  </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                </div>--}}
                                <div class="row">
                                <div class="col-lg-12 mb-3">

                                    <label class="mont-font fw-600 font-xsss" style="color: #1a3a95;"><a href="javascript:void(0)"onclick="display()">Change Password</a></label>
                                    <div id="changePasswordDiv" style="display: none;">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label class="mont-font fw-600 font-xsss">Current Password</label>
                                                <input type="password" id="CurrentPassword" class="form-control"value=""name="CurrentPassword">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label class="mont-font fw-600 font-xsss">New Password</label>
                                                <input type="password"  id="NewPassword" class="form-control" value="" name="NewPassword">
                                            </div>
                                        </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Confirm Password</label>
                                            <input type="password" class="form-control" value="" name="Confirm">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">

                                        <div class="">
                                            <strong id="alert"></strong>
                                        </div>
                                        <div class="form-group">
                                           <a href="javascript:void(0)" onclick="check()" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Change</a>
                                        </div>
                                    </div>

                                </div>
                                </div>
                                </div>
{{--                                    <div class="col-lg-12 mb-3">--}}
{{--                                        <label class="mont-font fw-600 font-xsss">Description</label>--}}
{{--                                        <textarea class="form-control mb-0 p-3 h100 bg-greylight lh-16" rows="5" placeholder="Write your message..." spellcheck="false"></textarea>--}}
{{--                                    </div>--}}

                                    <div class="col-lg-12">
                                      <input type="submit" value="Edit Information" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">
                                    </div>
                            </form>
                                </div>


                        </div>
                    </div>
                    <!-- <div class="card w-100 border-0 p-2"></div> -->
                </div>
            </div>

        </div>


<script>
    var c=0;
    function display(){
        if(c==0) {
            document.getElementById('changePasswordDiv').style.display = 'block';
            c=1;
        }else if (c==1){
            document.getElementById('changePasswordDiv').style.display = 'none';
            c=0;
        }


    }
    function check(){

        var password = $('#CurrentPassword').val();
        var newpassword = $('#NewPassword').val();
        // console.log(password);
        // console.log(newpassword);
        $.ajax({
            url: "{{route('changePassword')}}",
            Type: "POST",
            data: {
                password:password,
                newpassword:newpassword
            },
            success:function (data){
                console.log(data);
                if(data){
                    document.getElementById('alert').parentElement.className='alert alert-success alert-block';
                    document.getElementById('alert').innerText='Password Change Successfully';
                }else{
                    document.getElementById('alert').parentElement.className='alert alert-danger alert-block';
                    document.getElementById('alert').innerText='You Entered Wrong Password ';
                }
            },
            error:function (){

            }
        });
    }
</script>


