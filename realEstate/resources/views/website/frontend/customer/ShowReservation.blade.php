@extends('website.frontend.layouts.main')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="filterDiv Places"
    @foreach($operations as $operations => $reservation)
    <div class="col-lg-4 col-md-6 pe-2 ps-2" style="display:table;">
        <div class="card p-3 bg-white w-100 hover-card border-0 shadow-xss rounded-xxl border-0 mb-3 overflow-hidden ">
            <p>
                <strong> Reservation Number :</strong>{{$reservation['Operation_Id']}}
             </p>
             <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-grey-500"><strong> House Name :</strong><a href="{{url('/itemProfile/'.$reservation['Item_Id'])}}">{{$reservation->item['Item_Name']}}</a></span>
             <span class="d-flex font-xssss fw-500 mt-2 lh-3 text-grey-500">
                @if( isset($reservation->operationdetails) )
                    @foreach($reservation->operationdetails as $reservation_detail)
                        <p class="fw-700 lh-3 font-xss">{{$reservation_detail->detailname['Operation_Detail_Name']}} :</p>
                    @endforeach
                @endif 
                @if( isset($reservation->operationdetails) )
                    @foreach($reservation->operationdetails as $reservation_detail)
                        <p class="fw-700 lh-3 font-xss">{{$reservation_detail['Operation_Detail_Value']}}</p>
                    @endforeach
                @endif
             </span>
            <div class="card-body d-flex ps-0 pe-0 pb-0">
                <div class="bg-greylight me-3 p-3 border-light-md rounded-xxl theme-dark-bg"><h6 class="fw-700 font-lg ls-3 text-grey-900 mb-0"><span class="ls-3 d-block font-xsss text-grey-500 fw-500">Reservation Date :</span></h6><h6  class="ls-3 d-block font-xsss text-grey-500 fw-500">{{$reservation['updated_at']}}</h6></div>
                
            </div>
        </div>
    </div>
    @endforeach
        </div>
    </div>
</div>
                        
@endsection