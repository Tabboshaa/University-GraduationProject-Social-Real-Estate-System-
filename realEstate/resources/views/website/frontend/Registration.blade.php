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
                    <div class="backtologin"> 
                        <a href="{{route('userLogin')}}"> Already Has Account </a> &nbsp;
                        <i class="fas fa-arrow-right arrowStyle"></i>
                    </div>
                                
                                    <h1>Sign Up</h1>
                                    <span>Hello there! Sign UP and start managing your item.</span>
                                    <form method="POST" class="sinup" action="{{ route('registerUser') }}">
                                        @csrf
                                        @if ($message = Session::get('error'))
                                            
                                                <strong>{{ $message }}</strong>
                                            
                                        @endif
                                        
                                            <input class="input-field" type="text" placeholder="Email" name="email">
            
                                            <i class="fa fa-envelope icon"></i>
                                        
            
                                        
                                            <input class="input-field" type="password" placeholder="Password" name="password">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                    
                                        <button type="submit" class="btn">Sign UP</button>
                                        
                                            <a href="#">
                                                Forgot password?
                                            </a>
                                        
                                    </form>
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
    </body>
</html>
