@extends('website.frontend.ownerlayouts.main')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
            <div class="advertisment-banner1 col-md-12">
                 {{-- Cover photo --}}
                 @if(!empty($cover))
                 {{-- imggggggggggggggggggggggggggggggggg --}}
                     <img class="background" src="{{asset('storage/cover page/'.$cover['File_Path'])}}" alt="">
                 @else
                 <div id="coverPhoto">
                     <img class="background" src="{{asset('storage/cover page/Default1.jpeg')}}" alt="">
                 </div>
                 <div class="screnshot" id="OpenImgUpload">
                 <form method="POST" action="{{url('/CreateCoverPhoto')}}" enctype="multipart/form-data">
                         @csrf
                         <input id="cover_photo_upload" name="CoverPhoto" type="file" class="hidden" onchange="javascript:this.form.submit();">
                 </form>
                 </div>
                 @endif
                 <form method="Post" action="{{url('/DeleteMyCoverPhoto/'.$cover['Photo_Id'].'/'.$cover['File_Path'].'?_method=delete')}}" enctype="multipart/form-data">
                 @csrf
                     <button type="submit" id="btun3" class="btn btn-success"></button>
                 </form>
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
                            <a href="{{url('/owneritemProfile/'.$item->Item_Id)}}">Posts </a>
                        </li>
                        <li>
                            <a href="{{url('/owneritemDetails/'.$item->Item_Id)}}">Detail </a>
                        </li>
                        <li>
                            <a href="{{url('/owneritemReviews/'.$item->Item_Id)}}">Review </a>
                        </li>
                        <li>
                            <a href="{{url('/owneritemGallery/'.$item->Item_Id)}}">Gallery </a>
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
