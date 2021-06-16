@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')

<link href="{{asset('css/hamada.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/ShowStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            @if( count($reservations) != 0)
            @foreach($reservations as $reservation)
            <div class="col-lg-4 col-md-6 pe-2 ps-2" style="display:table;">
                <div class="card p-0 bg-white w-100 hover-card border-0 shadow-xss rounded-xxl border-0 mb-3 overflow-hidden ">
                    <p class="bg-grey p-3">
                        <strong>
                        #{{$reservation->Operation_Id}}
                        </strong>
                    </p>

                    <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                        <p class="fw-700 lh-3 ">created at : {{$reservation->updated_at}} </p>
                    </span>
                    <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                        <p class="fw-700 lh-3 ">Name : <a href="{{url('/veiw_User/'.$reservation->User_Id)}}">{{$reservation->First_Name}} {{$reservation->Middle_Name}} {{$reservation->Last_Name}}</a></p>
                    </span>
                    @if( isset($reservation_details[$reservation->Operation_Id]) )
                    @foreach($reservation_details[$reservation->Operation_Id] as $reservation_detail)
                    <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                        <p class="fw-700 lh-3">{{$reservation_detail->Operation_Detail_Name}} : {{$reservation_detail->Operation_Detail_Value}}</p>
                    </span>
                    @endforeach
                    @endif
                </div>
            </div>
            
            @endforeach
        </div>
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