@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
    <div class="row">
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                <thead>
                <tr>

                    <th>Sub Type ID</th>

                </tr>
                </thead>
                <tbody>
                <!-- EL FOREARCH HNA -->
                @foreach($sub_type as $sub_type)
                    <tr>
                        <td><a href="{{ url('/Item_Details_show/'.$main_id.'/'.$sub_type->Sub_Type_Id) }}">{{$sub_type->Sub_Type_Name}}</a></td>

                    </tr>
                @endforeach
                <!-- END OF FOREACH -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
