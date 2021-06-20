@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')


<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-md-12">
        @if( count($reservations) != 0)
        @foreach($reservations as $reservation)
        <div name="post">
            <div class="locatins" style="background-color:rgb(252, 252, 252);">
                <div class="heading1">
                    <img src="{{asset('FrontEnd/images/icon/user.html')}}" alt="">
                    <h3>
                        #{{$reservation->Operation_Id}}
                        <!-- {{ $reservation->Item_Name }} -->
                    </h3>
                </div>

                <div class="sub-heading">
                    <!-- #{{$reservation->Operation_Id}} <br /> -->
                    <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                        <tr class="rightmsg">
                            <td class="box" style="background-color:rgb(252, 252, 252);">created at </td>
                            <td class="box" style="background-color:rgb(252, 252, 252);">Name</td>
                            @if( isset($reservation_details[$reservation->Operation_Id]) )
                            @foreach($reservation_details[$reservation->Operation_Id] as $reservation_detail)
                            <td class="box" style="background-color:rgb(252, 252, 252);">{{$reservation_detail->Operation_Detail_Name}}</td>

                            @endforeach
                            @endif

                        </tr>
                        <tr class="rightmsg">
                            <td class="box">{{$reservation->updated_at}} </td>
                            <td class="box"><a href="{{url('/view_User/'.$reservation->User_Id)}}">{{$reservation->First_Name}} {{$reservation->Middle_Name}} {{$reservation->Last_Name}}</a></td>
                            @if( isset($reservation_details[$reservation->Operation_Id]) )
                            @foreach($reservation_details[$reservation->Operation_Id] as $reservation_detail)
                            <td class="box">{{$reservation_detail->Operation_Detail_Value}}</td>
                            @endforeach
                            @endif
                         
                        </tr>


                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        @endforeach
        <!-- in case no posts are there yet -->
        @else
        <div class="locatins">
            <div class="heading1">
                {{ $reservation->Item_Name }}
                </h3>
            </div>
            <div class="sub-heading">
                No reservations for this item yet..<br />
            </div>
            <div class="clearfix"></div>
        </div>

        @endif
    </div>
</div>






@endsection