<!DOCTYPE html>
<html lang="en">


<!-- signin15:54:02 GMT -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->
    <link href="{{asset('FrontEnd/images/header/fav.png')}}" rel="shortcut icon" type="image/x-icon" />

    <title>Sign UP </title>

    <!-- Bootstrap core CSS-->
    <link href="{{asset('FrontEnd/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('FrontEnd/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('FrontEnd/css/responsive.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{asset('FrontEnd/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link rel="stylesheet" href="{{asset('FrontEnd/css/portfolio.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('FrontEnd/css/dropdown.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('FrontEnd/css/owlslider.css')}}" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{asset('FrontEnd/css/sb-admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('FrontEnd/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('FrontEnd/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/owlcarousel/assets/owl.theme.default.min.css')}}">

</head>

<body>
<div class="sign">
    <div class="container">
        <div class="row">
            <div class="bg-form">
                <div class="sinheader">
                    <div class="col-md-6">
                        <img src="{{asset('FrontEnd/images/header/logo.png')}}" alt="">
                    </div>
                    <div class="sings col-md-6">
                        <a href="{{route('userLogin')}}"> Already Has Account </a> &nbsp;
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="sform">
                        <h1>Sign Up</h1>
                        <span>Hello there! Sign UP and start managing your item.</span>
                        <form method="POST" class="sinup" action="{{ route('registerUser') }}">
                            @csrf
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="input-container">
                                <input class="input-field" type="text" placeholder="Email" name="email">

                                <i class="fa fa-envelope icon"></i>
                            </div>

                            <div class="input-container">
                                <input class="input-field" type="password" placeholder="Password" name="password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>

                            <button type="submit" class="btn">Sign UP</button>
                            <div class="forgets">
                                <a href="#">
                                    Forgot password?
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="footer-sign">
                    <div class="p-left col-md-8 footermenu">
                        <ul>
                            <li><a href="#">About </a></li>
                            <li><a href="#">Faq’s</a></li>
                            <li><a href="#"> Privacy policy</a></li>
                            <li><a href="#">Advertise</a></li>
                            <li><a href="#">career</a></li>
                            <li><a href="#">Term and conditions </a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Tags</a></li>
                            <li><a href="#">Blogs</a></li>
                        </ul>
                    </div>
                    <div class="p-left col-md-4 copyrightsign text-right">
                        <a target="_blank" href="https://www.templateshub.net">Templates Hub</a>
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

</body>

</html>
