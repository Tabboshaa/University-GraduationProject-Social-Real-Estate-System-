@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
<link href="{{asset('css/ItemStyle.css')}}" rel="stylesheet" type="text/css" />
    
        

            <div class="x_panel">
                <div class="x_title">
                    <h2 style="text-align: center">New Item</h2>

                    <div class="clearfix"></div>
                </div>
            <!-- EL MAIN FOREARCH HNA -->
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

                   
                        <tr><td><a href="{{ url('property_select/'.$sub->Sub_Type_Id) }}">{{$sub->Sub_Type_Name}}</a></td></tr>

                    
                    @endif
                @endforeach
                </tbody>

                </table>
                </div>
                @endforeach
            </div>  
        
    
@endsection
