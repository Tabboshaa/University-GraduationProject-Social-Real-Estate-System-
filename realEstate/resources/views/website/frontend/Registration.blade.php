
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from uitheme.net/sociala/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 May 2021 19:34:54 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="{{asset('FrontEnd/sociala/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/sociala/css/feather.css')}}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('FrontEnd/sociala/images/favicon.png')}}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('FrontEnd/sociala/css/style.css')}}">



</head>

<body class="color-theme-blue">

    <div class="preloader"></div>

    <div class="main-wrap">

        <div class="nav-header bg-transparent shadow-none border-0">
            <div class="nav-top w-100">
                <a href="index.html"><i class="feather-zap text-success display1-size me-2 ms-0"></i><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Sociala. </span> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.html" class="mob-menu me-2"><i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>

                <a href="{{route('userLogin')}}" class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl" >Login</a>
                <a href="{{ route('registerUser') }}" class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl" >Register</a>

            </div>


        </div>

        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat" style="background-image: url(FrontEnd/sociala/images/login-bg-2.jpg);"></div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Create <br>your account</h2>
                        <form method="POST" action="{{ route('activateRegister') }}">
                            @csrf
                            @if ($message = Session::get('error'))

                                <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                                </div>

                            @endif

                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input name="email"  type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex@gmail.com" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <input id="pw1"  name="password" type="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Uppercase,Lowercase, numbers and characters" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                            </div>

                            <div class="form-group icon-input mb-3">
                                <input pw2 name="Confirm" type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Confirm Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                            </div>

                            <div class="col-sm-12 p-0 text-left">

                                <div class="form-group mb-1"><input type="submit"  value="Register" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Register</div>
                                <div class="form-group mb-1"><a href="{{url('redirect/facebook')}}" class="form-control text-left style2-input text-white fw-600 bg-twiiter border-0 p-0 "><img src="{{asset('FrontEnd/sociala/images/icon-3.png')}}" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Facebook</a></div>

                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Already have account <a href="{{route('userLogin')}}" class="fw-700 ms-1">Login</a></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('FrontEnd/sociala/js/plugin.js')}}">
    </script>
    <script src="{{asset('FrontEnd/sociala/js/scripts.js')}}"></script>

    <div class="modal bottom fade" style="overflow-y: scroll;" id="ModalActivation" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">




        
            <div class="modal-content border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
                <div class="modal-body p-3 d-flex align-items-center bg-none">
                    <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                        <div class="card-body rounded-0 text-left p-3">
                            <h2 class="fw-700 display1-size display2-md-size mb-4">We send to You An Activation Code</h2>
                            <form method="post" action="{{url('ForgotPassword')}}">
                                @CSRF
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="text" name="UserEmail" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">
                                </div>
                                <b><span>Please Enter Activation</span> </b>
                                <div class="form-group mb-1">
                                    <input type="text"  value=" " class="form-control">
                                </div>
                                <div class="form-group mb-1">
                                    <input type="submit"  value="send me new password "  class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


<!-- Mirrored from uitheme.net/sociala/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 May 2021 19:34:59 GMT -->
</html>
