@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')

<!-- 
{{--@foreach($details as $detail)--}}
{{--    <div><h3>{{$detail[i]}}</h3></div>--}}
{{--    @foreach($detail as $d)--}}
{{--        <div><h2>{{$d[][]}}</h2></div>--}}
{{--    @endforeach--}}
{{--@endforeach--}} -->

@foreach ($details as $d => $dd)
<table>
    <tr><td>
       <div><h1>{{$d}}</h1></div>
</td>
</tr>
       @foreach($dd as $ddd)
            <!-- <div><h2>{{$dd}}</h2></div> -->
            <tr>
                <td><h2>{{$ddd->Detail_Name}}</h2></td>
                <td><h2>{{$ddd->DetailValue}}</h2></td>
</tr>
            <!-- @foreach($ddd as $ddda) -->
            <!-- <td> -->
                <!-- <div><h3>{{$ddda}}</h3></div> -->
            <!-- </td>   -->
            <!-- @endforeach -->
            </tr>
        @endforeach
    
</table>
@endforeach

@endsection
