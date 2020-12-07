@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
    <div class="row">
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                <tr>

                  

                </tr>
                </thead>
                <tbody>
                <!-- EL FOREARCH HNA -->
                @foreach($main_type as $main)
                <tr>
                <td>{{$main->Main_Type_Name}}</td>

                @foreach($sub_type as $sub)
                @if($sub->Main_Type_Id == $main->Main_Type_Id)

                   
                        <td><a href="{{ url('/property_select/'.$sub->Sub_Type_Id) }}">{{$sub->Sub_Type_Name}}</a></td>

                    
                    @endif
                @endforeach
                </tr>
                @endforeach
                <!-- END OF FOREACH -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
