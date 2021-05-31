@extends('website.frontend.layouts.main')
@section('profile')
<div class="row">
    <div class="col-xl-12">
        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3 overflow-hidden">
            <div class="card-body position-relative h240 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$cover->path)}}');"></div>
            <div class="card-body d-block pt-4 text-center position-relative">
                <h4 class="font-xs ls-1 fw-700 text-grey-900"> {{ $item->Item_Name }}<span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">@ {{$item->First_Name}} {{$item->Middle_Name}} {{$item->Last_Name}}</span></h4>
            </div>


            <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                    <li class="active list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="#navtabs1" data-toggle="tab">About</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs2" data-toggle="tab">Membership</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs3" data-toggle="tab">Discussion</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs4" data-toggle="tab">Video</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs3" data-toggle="tab">Group</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs1" data-toggle="tab">Events</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 me-sm-5 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs7" data-toggle="tab">Media</a></li>
                    <li class="list-inline-item ms-auto mt-3 me-4"><a href="#" class=""><i class="ti-more-alt text-grey-500 font-xs"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-xxl-9 col-lg-8">
        <!-- start of post -->
        @yield('profile_Content')
        <!-- end of post -->

    </div>


</div>

@endsection