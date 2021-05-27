@extends('website.frontend.ownerlayouts.main')
@section('content')
@include('website.backend.layouts.flashmessage')

<link href="{{asset('css/ItemAddressStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/Form.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/ItemStyle.css')}}" rel="stylesheet" type="text/css" />
    <div class="x_panel">
        <div class="x_title">

            <h2 style="text-align:center; margin-left:80px;margin-top:50px;">New Item</h2>
            <div class="clearfix"></div>

        </div>
        
        <div class="container-fluid">
            <!-- Banner -->
                <div class="row leftside">
                <!-- EL MAIN FOREARCH HNA -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="listing">
                            <h3 style="margin-left:65px;margin-top:10px;">{{$main_type}}<h3>
                            <ul>
                            @foreach($sub_type as $sub)
                                <li style="margin-left:65px;"><a href="{{ url('OwnerSelectDetails/'.$item_id.'/'.$sub->Sub_Type_Id) }}">{{$sub->Sub_Type_Name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection