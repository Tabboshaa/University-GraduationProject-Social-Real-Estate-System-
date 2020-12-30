@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
        <tr>
            <th>User</th>
            <td>{{$user[0]->First_Name}} {{$user[0]->Middle_Name}} {{$user[0]->Last_Name}}</td>

        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Location</th>
            <td>{{$Location->Country_Name}},{{$Location->State_Name}},{{$Location->City_Name}},{{$Location->Region_Name}},{{$Location->Street_Name}}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center">Details</td>
        </tr>
        <tr>
            {{--For each Sub Type Proberty--}}
            @foreach($details as $properties => $details)

            <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

                <thead>
                <tr>
                    <th colspan="{{count($details)+1}}" style="text-align:center">{{$properties}}</th>
                </tr>
                <tr >

                    <th>{{$properties}} Number</th>

                    {{--For each Sub Type Proberty Detail--}}
                    @foreach($details as $detail)
                    <th>{{$detail->Detail_Name }}</th>
                    @endforeach
                    {{-- End For each Sub Type Proberty Detail--}}


                </tr>
                </thead>
                <tbody>

                    {{--     LOOP FOR ROWS        --}}
                    @foreach($details as $detail)
                    <tr>
                        <td>{{$detail->Property_Name}} </td>

                        {{--For each Sub Type Proberty Detail--}}
                        <!-- @foreach($details as $detail) -->
                        <td>{{$detail->DetailValue}}</td>
                        <!-- @endforeach -->
                        {{-- End For each Sub Type Proberty Detail--}}

                    </tr>
                    @endforeach
                    {{--   END  LOOP FOR ROWS        --}}

                </tbody>
            </table>
            @endforeach

            {{--End For each  Sub Type Proberty--}}
        </tr>
        </tbody>
    </table>
@endsection
