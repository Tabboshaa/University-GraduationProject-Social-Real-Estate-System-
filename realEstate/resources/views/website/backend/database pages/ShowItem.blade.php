@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

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
            @foreach($details as $detail)

            <table class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

                <thead>
                <tr>
                    <th colspan="{{$detail}}" style="text-align:center">{{$detail->Property_Name}}</th>
                </tr>
                <tr >

                    <th>RoomNumber</th>

                    {{--For each Sub Type Proberty Detail--}}
                    <th>{{$detail->Detail_Name}}</th>
                    {{-- End For each Sub Type Proberty Detail--}}

                </tr>
                </thead>
                <tbody>
                    {{--     LOOP FOR ROWS        --}}
                    <tr>
                        <td>{{$detail->Property_Name}}{{count($detail)}}</td>

                        {{--For each Sub Type Proberty Detail--}}

                        <td>{{$detail->DetailValue}}</td>
                        {{-- End For each Sub Type Proberty Detail--}}

                    </tr>
                    {{--   END  LOOP FOR ROWS        --}}

                </tbody>
            </table>
            @endforeach

            {{--End For each  Sub Type Proberty--}}
        </tr>
        </tbody>
    </table>

{{--    <table id="datatable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th></th>--}}
{{--           <th></th>--}}

{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}

{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}


@endsection
