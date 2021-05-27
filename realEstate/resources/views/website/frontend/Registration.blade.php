<!DOCTYPE html>
<html lang="en">
<!-- signin15:54:02 GMT -->
    <head>

        <title>Sign UP </title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="{{asset('css/logStyle.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="Sign">
            <div class="form1">
                <img src="{{asset('FrontEnd/images/header/log.png')}}" alt="" style="width:170px;height:170;margin-left:10px">
                    <div class="BackToLogin"> 
                        <a class ="back"href="{{route('userLogin')}}"> Already Has Account </a> &nbsp;
                        <i class="fas fa-arrow-right arrowStyle"></i>
                    </div>
                    <div>
                        <div class="OperationName">
                            <h1>Sign Up</h1>
                        </div>
                                    <p class="txtt">Hello there! Sign UP and start managing your item.</p>
                                    <form method="POST" class="sinup" action="{{ route('registerUser') }}">
                                        @csrf
                                        @if ($message = Session::get('error'))
                                            
                                                <strong>{{ $message }}</strong>
                                            
                                        @endif
                                        
                                            <input class="in"type="text" placeholder="Email" name="email">
                                            <input  class="in"type="password" placeholder="Password" name="password">
                                            <button type="submit" class="btn">Sign Up</button>
                                        
                                            <a class="Forget"href="#">
                                                Forgot password?
                                            </a>
                                        
                                    </form>
                                    
                                    <ul id="Iinfo" style="margin-top: 100px;
                                    margin-left: 270px;
                                    margin-right: 200px;">
                                        <li><a href="#">About </a></li> |
                                        <li><a href="#">Faq’s</a></li> |
                                        <li><a href="#"> Privacy policy</a></li> |
                                        <li><a href="#">Advertise</a></li> |
                                        <li><a href="#">career</a></li> |
                                        <li><a href="#">Term and conditions </a></li> |
                                        <li><a href="#">Press</a></li> |
                                        <li><a href="#">Sitemap</a></li> |
                                        <li><a href="#">Tags</a></li> |
                                        <li><a href="#">Blogs</a></li>
                                    </ul>
            </div>
    </body>
</html>
