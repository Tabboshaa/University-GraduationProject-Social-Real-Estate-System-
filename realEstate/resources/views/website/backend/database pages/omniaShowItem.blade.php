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
<table class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

@foreach ($details as $d => $dd)
    <tr>
        <td>
       <h4>{{$d}}</h4>
</td>
</tr>

       @foreach($dd as $ddd)
            <!-- <div><h2>{{$dd}}</h2></div> -->
            <tr>
                <td><h6>{{$ddd->Detail_Name}}</h6></td>
                <td><h6>{{$ddd->DetailValue}}</h6></td>
</tr>
           
        @endforeach
    

@endforeach
</table>
</tr>
        </tbody>
    </table>
    <a href="{{url('/Item')}}" class="btn btn-info"> Create Another Item</a>
@endsection
