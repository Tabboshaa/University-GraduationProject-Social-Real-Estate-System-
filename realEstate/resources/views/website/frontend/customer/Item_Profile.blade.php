@extends('website.frontend.layouts.main')
@section('profile')
<!-- Modal Receipte -->



<div class="row">
    <div class="col-xl-12">
        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3 overflow-hidden">
            @if($cover != null)
            <div class="card-body position-relative h240 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$cover->path)}}');"></div>
            @else
            <div class="card-body position-relative h240 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/Default1.jpeg')}}');"></div>
            @endif
            <div class="card-body d-block pt-4 text-center position-relative">
                <h4 class="font-xs ls-1 fw-700 text-grey-900"> {{ $item->Item_Name }}<span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">@ {{$item->user->First_Name}} {{$item->user->Middle_Name}} {{$item->user->Last_Name}}</span></h4>

                <div class="d-flex align-items-center pt-0 position-absolute left-15 top-10 mt-4 ms-2">
                    <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{($item->posts == null)?0:count($item->posts)}} </b> Posts</h4>
                    <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{($item->followers == null)?0:count($item->followers)}} </b> Followers</h4>
                </div>
                <div class="d-flex align-items-center justify-content-center position-absolute right-15 top-10 mt-2 me-2">
                    @if ($check_follow=="[]")
                    <a href="{{url('/FollowItem/'.$item->Item_Id)}}" class="d-none d-lg-block bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3"> <i class="fa fa-heart-o" aria-hidden="true"></i> Follow</a>
                    @else
                    <a href="{{url('/UnfollowItem/'.$item->Item_Id)}}" class="d-none d-lg-block bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3"> <i class="fa fa-heart-o" aria-hidden="true"></i> Un Follow</a>
                    @endif
                </div>

            </div>
            <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/itemProfile/'.$item->Item_Id)}}" data-toggle="tab">Posts</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/itemDetails/'.$item->Item_Id)}}" data-toggle="tab">Detail</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/itemReviews/'.$item->Item_Id)}}" data-toggle="tab">Reviews</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/itemGallery/'.$item->Item_Id)}}" data-toggle="tab">Gallery</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- start of post -->
    @yield('profile_Content')
    <!-- end of post -->


</div>

@endsection
