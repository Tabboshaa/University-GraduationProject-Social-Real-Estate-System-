@extends('website.frontend.layouts.main')
@section('content')
@include('website.backend.layouts.flashmessage')

<link href="{{asset('css/ItemAddressStyle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/Form.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/ItemStyle.css')}}" rel="stylesheet" type="text/css" />
    <div class="x_panel">
        <div class="x_title">

            <h2 style="text-align: center">New Item</h2>
            <div class="clearfix"></div>

        </div>
        <!-- EL MAIN FOREARCH HNA -->
        <div class="col-sm-4">
            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                    <th><h6>{{$main_type}}</h6></th>
                </thead>

                <tbody>
                <!-- EL SUB FOREARCH HNA -->
                    @foreach($sub_type as $sub)
                        <tr><td><a href="{{ url('OwnerSelectDetails/'.$item_id.'/'.$sub->Sub_Type_Id) }}">{{$sub->Sub_Type_Name}}</a></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection