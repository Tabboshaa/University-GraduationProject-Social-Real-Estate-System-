<!DOCTYPE html>
<html lang="en">
@include('website.backend.layouts.head')

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"> <!--<i class="fa fa-paw"></i>--> 
                        <img src="{{asset('FrontEnd/sociala/images/logowhite.png')}}" style="width: 45px;height: 45px;"><span> Traveller Club </span></a>
                </div>
                <div class="clearfix"></div>

                <br />

                <!-- sidebar menu -->
            @include('website.backend.layouts.slidebar')
            <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        @include('website\backend\layouts\header')
        <!-- /top navigation -->

        <!-- page content -->

    @yield('content')
    </div>
    <!-- /page content -->

        <!-- footer content -->
    @include('website.backend.layouts.footer')
    <!-- /footer content -->
    </div>

<!-- jQuery -->
@include('website.backend.layouts.foot')
</body>
</html>
