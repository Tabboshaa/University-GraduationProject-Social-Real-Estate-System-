<<<<<<< Updated upstream
@extends('website.frontend.layouts.main')
@section('profile')
<div style="margin-left:150px;" class="row">
    <div class="col-xl-12 col-xxl-12 col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-md-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">
                    <div class="bg-pattern-div"></div>
                    <h2 class="display2-size display2-md-size fw-700 text-white mb-0 mt-0">My Items</h2>
                </div>
            </div>
            @if(!empty($items))
            @foreach($items as $item)

            <div class="col-lg-4 col-md-6">
                <div class="card w-100 border-0 mt-4">
                    @if($item->coverpage != null)
                    <div class="card-image w-100 p-0 text-center bg-greylight rounded-3 mb-2">
                        <a href="{{ url('/itemProfile/'.$item->Item_Id) }}"><img src="{{asset('storage/cover page/'.$item->coverpage->path)}}" alt="CoverPage" class="w-100 mt-0 mb-0 p-5"></a>
=======
@extends('website.frontend.ownerlayouts.main')
@section('content')
<link href="{{asset('css/FrontEndCSS/MyItems.css')}}" rel="stylesheet" type="text/css">
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">

        

            <div class="row">
            <div class="col-md-3 col-xs-12 ">
                <div class="filterDiv Places">

                    <div class=" mylisting">
                        @if(!empty($items))
                        @foreach($items as $item)
                        

                            <div class="box">
                                @if(!empty($item->coverpage['path']))
                                <div class="box-img">
                                    <img class="background" src="{{asset('storage/cover page/'.$item->coverpage['path'])}}" alt="" style="height: 150px;">
                                </div>
                                @else
                                <div class="box-img">
                                    <img class="background" src="{{asset('storage/cover page/Default1.jpeg')}}" alt="" style="height: 150px;">
                                </div>
                                @endif
                                <div class="notification-info">
                                    <h4>{{$item->Item_Name}}</h4>
                                </div>

                            </div>

                        </div>
                        @endforeach
                        @endif
>>>>>>> Stashed changes
                    </div>
                    @else
                    <div class="card-image w-100 p-0 text-center bg-greylight rounded-3 mb-2">
                        <a href="{{ url('/itemProfile/'.$item->Item_Id) }}"><img src="{{asset('Images/h1.jpg')}}" alt="CoverPage" class="w-100"></a>
                    </div>
                    @endif
                    <div class="card-body w-100  rounded-3 p-0 text-center">
                        <h2 class="mt-2 mb-1"><a href="{{ url('/itemProfile/'.$item->Item_Id) }}"  class="fw-700 font-xsss lh-26">{{$item->Item_Name}}</a></h2>
                    </div>                                
                </div>
            </div>

            @endforeach
            @endif
        </div>
    </div>
</div>

@endsection