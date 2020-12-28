@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')


{{--@foreach($details as $detail)--}}
{{--    <div><h3>{{$detail[i]}}</h3></div>--}}
{{--    @foreach($detail as $d)--}}
{{--        <div><h2>{{$d[][]}}</h2></div>--}}
{{--    @endforeach--}}
{{--@endforeach--}}

@foreach ($details as $d => $dd)

       <div><h3>{{$d}}</h3></div>
        @foreach($dd as $ddd)
            <div><h2>{{$dd}}</h2></div>
            @foreach($ddd as $ddda)
                <div><h1>{{$ddda}}</h1></div>
            @endforeach
        @endforeach

@endforeach

@endsection
