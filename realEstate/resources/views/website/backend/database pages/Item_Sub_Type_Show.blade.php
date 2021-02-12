@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

<link href="{{asset('css/ItemStyle.css')}}" rel="stylesheet" type="text/css" />
    <div class="x_panel">
        <div class="x_title">

            <h2 style="text-align: center">New Item</h2>
            <div class="clearfix"></div>

        </div>
            <!-- EL MAIN FOREARCH HNA -->
            @if(count($main_type) !=0)
            @foreach($main_type as $main)
                <div class="col-sm-4">
                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                        <thead>
                            <th><h6>{{$main->Main_Type_Name}}</h6></th>
                        </thead>

                        <tbody>
                        <!-- EL SUB FOREARCH HNA -->
                            @foreach($sub_type as $sub)
                                @if($sub->Main_Type_Id == $main->Main_Type_Id)
                                    <tr><td><a href="{{ url('property_select/'.$item_id.'/'.$sub->Sub_Type_Id) }}">{{$sub->Sub_Type_Name}}</a></td></tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
            @else
            <h6>there is no main types<a href="{{url('/main_types')}}"> add a main type?</h6></a>
            @endif
     </div>
@endsection
