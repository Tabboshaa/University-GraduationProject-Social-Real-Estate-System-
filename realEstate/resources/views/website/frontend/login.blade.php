<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from uitheme.net/sociala/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 May 2021 19:34:52 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In </title>
    <link rel="stylesheet" href="{{asset('FrontEnd/sociala/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/sociala/css/feather.css')}}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('FrontEnd/sociala/images/logo.png')}}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('FrontEnd/sociala/css/style.css')}}">

     <!-- Bootstrap core CSS-->
     <link href="{{asset('FrontEnd/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
     <link href="{{asset('FrontEnd/css/style.css')}}" rel="stylesheet">
     <link href="{{asset('FrontEnd/css/responsive.css')}}" rel="stylesheet">
     <!-- Custom fonts for this template-->
     <link href="{{asset('FrontEnd/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

</head>

<body class="color-theme-blue">

    <div class="preloader"></div>

    <div class="main-wrap">

        <div class="nav-header bg-transparent shadow-none border-0">
            <div class="nav-top w-100">
            <a href="#"><img src="{{asset('storage/images/logo.png')}}" height="35" width="40"><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xl logo-text mb-0 "> Traveller club</span> </a>
            <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
        
                <a href="#" class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl">Login</a>
                <a href="{{ route('UserRegister') }}" class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl">Register</a>

            </div>


        </div>

        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat" style="background-image: url(FrontEnd/sociala/images/login15.jfif);"></div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-3">Login into <br>your account</h2>
                        <form method="POST" action="{{ route('loginUser') }}">
                            @csrf
                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif

                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" name="email" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex@gmail.com" placeholder="Your Email Address">
                            </div>
                            <div class="form-group icon-input mb-1">
                                <input name="password"type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                            </div>
                            <div class="form-check text-left mb-3">
                                <input type="checkbox" class="form-check-input mt-2" id="exampleCheck5">
                                <label class="form-check-label font-xsss text-grey-500" for="exampleCheck5">Remember me</label>
                                <a href="#" class="fw-600 font-xsss text-grey-700 mt-1 float-right"  data-bs-toggle="modal" data-bs-target="#Modallogin">Forgot your Password?</a>
                            </div>

                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-1">
                                    <input type="submit" value="LOGIN"  class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">
                                </div>
                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a href="{{ route('UserRegister') }}" class="fw-700 ms-1">Register</a></h6>
                            </div>
                        </form>
                        <div class="col-sm-12 p-0 text-center mt-2">

                            <h6 class="mb-0 d-inline-block bg-white fw-500 font-xsss text-grey-500 mb-3">Or, Sign in with your social account </h6>
                            <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-twiiter border-0 p-0 "><img src="{{asset('FrontEnd/sociala/images/icon-3.png')}}" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Facebook</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('FrontEnd/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('FrontEnd/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->

    <script src="{{asset('FrontEnd/sociala/js/plugin.js')}}"></script>
    <script src="{{asset('FrontEnd/sociala/js/scripts.js')}}"></script>

    <!-- Modal Login -->
    <div class="modal bottom fade" style="overflow-y: scroll;" id="Modallogin" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
                <div class="modal-body p-3 d-flex align-items-center bg-none">
                    <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                        <div class="card-body rounded-0 text-left p-3">
                            <h2 class="fw-700 display1-size display2-md-size mb-4">Enter Your Email</h2>
                            <form method="post" action="{{url('ForgotPassword')}}"  id="ForgotForm">
                                @CSRF
                                <div id="alertParent" >
                                <strong id="Emailalert"></strong>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="text" id="email" name="UserEmail" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">
                                </div>
                                <b><span>An email with a New Password code will send to you </span> </b>
                                <div class="form-group mb-1">
                                    <a href="javascript:void(0)" onclick="validateForm()" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">send me new password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


<!-- Mirrored from uitheme.net/sociala/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 May 2021 19:34:54 GMT -->
</html>
<script>
    function validateForm(){
        console.log('rrrrrrr');
        let emailRegx= /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let email=$('#email');
        let emailalert= $('#Emailalert');
        if(!emailRegx.test(email.val())){
            console.log(email.val());
           emailalert.html("Invalid Email Format");
           $('#alertParent').addClass("alert alert-danger alert-block");

         } else{
            $('#ForgotForm').submit();
         }

    }
</script>
