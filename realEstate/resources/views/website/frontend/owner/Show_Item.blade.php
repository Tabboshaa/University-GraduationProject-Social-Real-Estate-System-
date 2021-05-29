@extends('website.frontend.ownerlayouts.main')
@section('content')
<link href="{{asset('css/FrontEndCSS/MyItems.css')}}" rel="stylesheet" type="text/css">
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">



            <div class="row">

                <div class="filterDiv Places">

                    <div class=" mylisting">
                        @if(!empty($items))
                        @foreach($items as $item)
                        <div class="col-md-3 col-xs-12 ">

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
                    </div>

                </div>

            </div>




        </div>
    </div>
</div>
@endsection