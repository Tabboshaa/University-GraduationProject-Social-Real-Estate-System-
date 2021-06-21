@extends('website.frontend.layouts.main')
@section('content')
<link href="{{asset('css/FrontEndCSS/paymentDesign.css')}}" rel="stylesheet" type="text/css" />
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="row">
            <div class="messages text-center col-md-12">
                Notification
                <hr>
            </div>
        </div>
        <!-- Banner Area-->
        <div class="settingmenu">
            <div class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse  visible-title" id="navbarNav">
                    <ul class="navbar-nav ">
                        <li>
                            <a href="setting.html">OverView </a>
                        </li>
                        <li>
                            <a href="privacy.html">Privacy </a>
                        </li>
                        <li>
                            <a href="notification.html">Notification </a>
                        </li>
                        <li>
                            <a href="listing.html">Listing </a>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
        <div class="row">
            @foreach($notifications as $notification)
            <div class="col-md-12">
                <div class=" locatins">
                    <div class="heading">
                        <img src="images/banner/icon.html" alt="">
                        <h3>
                            <a href="{{ url('/view_User/'.$notification->id) }}"> {{$notification->First_Name}} {{$notification->Middle_Name}} {{$notification->Last_Name}}</a>
                        </h3>
                    </div>
                    <div class="sub-heading">
                        {{ $notification->Notification }}
                    </div>
                    <div class="clearfix">
                        <?php $end = \Carbon\Carbon::parse($notification->updated_at);
                        $today = \Carbon\Carbon::now(); ?>
                        <p>{{ $end->diffForHumans($today) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <!--#Spiner-->
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <!--#Spiner-->
        <!-- Sticky Footer -->
        <footer class="sticky-footer col-md-12">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">

                    <div class="footer-info">
                        <a href="#">About </a> |
                        <a href="#">Faq’s </a> |
                        <a href="#">Privacy</a>
                        <a href="#"> Advertise</a> |
                        <a href="#">Term & Conditions </a>
                        <a href="#">Sitemap </a>|
                        <a href="#">Tags </a>|
                        <a href="#">Blog</a>
                    </div>
                    <div class="copy-right">
                        <a target="_blank" href="https://www.templateshub.net">Templates Hub</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>
@endsection