@extends('website.frontend.ownerlayouts.main')
@section('profile')
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

                    <a href="{{url('/item_delete1/'.$item->Item_Id)}}" onclick="return confirm('Are you sure you want to delete?')" class="d-none d-lg-block bg-danger p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                    <a href="#" class="p-2 text-center ms-auto menu-icon show" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown"><i class="ti-more font-md"></i></a>
                    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg show" aria-labelledby="dropdownMenu3" style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(567.2px, 76px);" data-popper-placement="bottom-end">

                        @if(!empty($cover))
                        <div class="card-body p-0 d-flex">
                            <form method="Post" action="{{url('/DeleteMyCoverPage/'.$cover->id.'/'.$cover->path.'?_method=delete')}}" enctype="multipart/form-data">
                                @csrf
                                <button class="btn" type="submit"><label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_page_delete"><i class="feather-trash-2 text-grey-500 me-3 font-sm"></i>Cover Page</label></button>
                            </form>
                            <form method="POST" action="{{url('/UpdateCoverPage/')}}" enctype="multipart/form-data">
                                @csrf
                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_page_update"><i class="feather-edit text-grey-500 me-3 font-sm"></i>Cover Page</label>
                                <input id="cover_page_update" name="CoverPageUpdate" type="file" style="display:none" accept="image/*" onchange="javascript:this.form.submit();">
                            </form>
                        </div>
                        @else
                        <div class="card-body p-0 d-flex">
                            <form method="POST" action="{{url('/CreateCoverPage/'.$item->Item_Id)}}" enctype="multipart/form-data">
                                @csrf
                                <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload"><i class="feather-plus text-grey-500 me-3 font-sm"></i>Cover Photo</label>
                                <input id="cover_photo_upload" name="CoverPage" type="file" accept="image/*" style="display:none" onchange="javascript:this.form.submit();">
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                    <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/owneritemProfile/'.$item->Item_Id)}}" data-toggle="tab">Posts</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/owneritemDetails/'.$item->Item_Id)}}" data-toggle="tab">Detail</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/owneritemReviews/'.$item->Item_Id)}}" data-toggle="tab">Reviews</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/owneritemGallery/'.$item->Item_Id)}}" data-toggle="tab">Gallery</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/owneritemReservations/'.$item->Item_Id)}}" data-toggle="tab">Item Reservations</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/owneritemManageSchedule/'.$item->Item_Id)}}" data-toggle="tab">Manage Schedule</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- start of post -->
    @yield('profile_Content')
    <!-- end of post -->


</div>

@endsection
