@extends('website.frontend.layouts.main')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
            <div class="advertisment-banner1 col-md-12">
        <img src="{{asset('storage/cover page/'.$cover->path)}}" alt="">
            </div>
            <div class="main-page">
                <div class="dash-profile">
                    <img src="" alt="">
                </div>
                <div class="prompr">
                    <ul class="widths">
                        <li class="number"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; +91 1234 567 890</li>
                        <li class="number"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Location here...</li>

                        @if ($check_follow=="[]")
                        <li class="saved">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <a href="{{url('/FollowItem/'.$item->Item_Id)}}">Follow</a>
                        </li>

                        @else
                        <li class="saved">

                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <a href="{{url('/UnfollowItem/'.$item->Item_Id)}}">Un Follow</a>

                        </li>
                        @endif
                        <li class="Reivew">
                            <a href="{{url('/itemReviews')}}">Add Review </a>
                        </li>
                        <li class="borders"><i class="fa fa-share-alt" aria-hidden="true"></i></li>
                        <li class="borders"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></li>
                    </ul>
                    <div class="dashname">
                        {{ $item->Item_Name }}
                        <p><a href="#">@ {{$item->First_Name}} {{$item->Middle_Name}} {{$item->Last_Name}}</a></p>
                    </div>

                </div>
            </div>
            <div class="clearfix">
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
                            <a href="{{url('/itemProfile/'.$item->Item_Id)}}">Posts </a>
                        </li>
                        <li>
                            <a href="{{url('/itemDetails/'.$item->Item_Id)}}">Detail </a>
                        </li>
                        <li>
                            <a href="{{url('/itemReviews/'.$item->Item_Id)}}">Review </a>
                        </li>
                        <li>
                            <a href="{{url('/itemGallery/'.$item->Item_Id)}}">Gallery </a>
                        </li>
                        <li>
                            <a href="{{url('/owneritemReservations/'.$item->Item_Id)}}">Reservation history </a>
                        </li>
                        <li>
                            <a href="{{url('/owneritemManageSchedule/'.$item->Item_Id)}}">Manage my calender </a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
        @yield('profile_Content')
    </div>
</div>
<script>

</script>
@endsection