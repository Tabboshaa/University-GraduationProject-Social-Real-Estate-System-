@extends('website.frontend.ownerlayouts.main')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
            <div class="row">
                <link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />

                <link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />
                    <div class="col-md-12">
                     
                        @foreach($operations as $operations => $reservation)

                        <div name="post">
                            <div class="locatins" style="background-color:rgb(252, 252, 252);">
                                <div class="heading1">
                                    <img src="{{asset('FrontEnd/images/icon/user.html')}}" alt="">
                                    <h3>
                                        #{{$reservation['Operation_Id']}}
                                    </h3>
                                </div>

                                <div class="sub-heading" >

                                    <table id="datatable" class="table table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">
                                        <tr class="rightmsg">
                                            <td class="box" style="background-color:rgb(252, 252, 252);">created at </td>
                                            <td class="box" style="background-color:rgb(252, 252, 252);">Name</td>
                                            @if( isset($reservation->operationdetails) )
                                            @foreach($reservation->operationdetails as $reservation_detail)
                                            <td class="box" style="background-color:rgb(252, 252, 252);">{{$reservation_detail->detailname['Operation_Detail_Name']}}</td>
                                            @endforeach
                                            @endif

                                        </tr>
                                        <tr class="rightmsg">
                                            <td class="box">{{$reservation['updated_at']}} </td>
                                            <td class="box"><a href="{{url('/veiw_User/'.$reservation['User_Id'])}}">{{$reservation->user['First_Name']}} {{$reservation->user['Middle_Name']}} {{$reservation->user['Last_Name']}}</a></td>
                                            @if( isset($reservation->operationdetails) )
                                            @foreach($reservation->operationdetails as $reservation_detail)
                                            <td class="box">{{$reservation_detail['Operation_Detail_Value']}}</td>
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
                      
                    </div>

            </div>
        </div>
    </div>
</div>




@endsection