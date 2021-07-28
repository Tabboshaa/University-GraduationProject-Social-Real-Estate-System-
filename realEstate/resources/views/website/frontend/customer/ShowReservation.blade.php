@extends('website.frontend.layouts.main')
@section('profile')
    @if($operations!='[]')
    <div class="col-lg-12">
        <div class="card p-md-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">
            <div class="bg-pattern-div"></div>

            <h2 class="display2-size display2-md-size fw-700 text-white mb-0 mt-0">Your Reservations In Traveller Club  </h2>
        </div>
    </div>
    @else
    <div class="col-lg-12" >
    <div class="card p-md-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">
        <div class="bg-pattern-div"></div>

        <h2 class="display2-size display2-md-size fw-700 text-white mb-0 mt-0">There is No Reservations Yet !</h2>
        <img src="{{asset('FrontEnd/sociala/image/young women.jpg')}} ">
    </div>
{{--        <div class="card p-md-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">--}}
{{--            <div class="bg-pattern-div"></div>--}}

{{--            <img src="{{asset('FrontEnd/sociala/image/young women.jpg')}} ">--}}
{{--        </div>--}}

</div>

    @endif
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            @foreach($operations as $operations=> $reservation)
            <div class="col-lg-4 col-md-6 pe-2 ps-2" style="display:table;">
                <div class="card p-0 bg-white w-100 hover-card border-0 shadow-xss rounded-xxl border-0 mb-3 overflow-hidden ">
                    <p class="bg-grey p-3">
                        <strong> Reservation Number :</strong> {{$reservation['Operation_Id']}}
                    </p>
                    <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                        <p class="fw-700 lh-3 font-xss"> House Name : <a href="{{url('/itemProfile/'.$reservation['Item_Id'])}}">{{$reservation->item['Item_Name']}}</a></p>
                    </span>
                    <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                        <p class="fw-700 lh-3 font-xss"> Reservation Date :{{$reservation['updated_at']}}</p>
                    </span>
                    @if( isset($reservation->operationdetails) )
                    @foreach($reservation->operationdetails as $reservation_detail)
                    <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-black-500 ps-3">
                        <p class="fw-700 lh-3 font-xss">{{$reservation_detail->detailname['Operation_Detail_Name']}} : {{$reservation_detail['Operation_Detail_Value']}}</p>
                    </span>
                    @endforeach
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
