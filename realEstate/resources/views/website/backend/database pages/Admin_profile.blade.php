@extends('website.backend.layouts.main')
@section('content')

<div class="right_col" role="main">
    <div class="title_right">
        <div style="height: 100%;margin-top:70px;background-color:white;">
        <div style=" margin: auto;width: 50%;text-align: center;padding: 10px;">
            <img src="{{asset('glint/images/avatars/Shaimaa.jpeg')}}" style="border-radius: 0%;width:150pt;height:150px;">
            <h4 style="color: black;">{{$user->First_Name}} {{$user->Last_Name}}</h4><br>
            <h2 style="color: black;"><strong> E-mail :</strong> {{$email->email}}</h2>
            <h2 style="color: black;"><strong> Number :</strong> {{$phone->phone_number}}</h2>
        </div>
        </div>
    </div>
</div>


@endsection
