@extends('website.frontend.layouts.main')
@section('profile')


    <div class="col-xl-12 ">
        <div class="row ps-2 pe-1">
            {{-- Posts --}}
            @foreach($items as $item)
            <div class="col-md-12 col-sm-12 pe-2 ps-2">
                <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">

                    @if($item->path != null)
                    <div class="card-body position-relative h200 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$item->path)}}');"></div>
                    @else
                    <div class="card-body position-relative h200 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/Default1.jpeg')}}');"></div>
                    @endif

                    <div class="card-body d-block w-100 pl-5 pe-4 pb-4 pt-0 text-left position-relative">
                        <div class="clearfix"></div>
                        <a href="{{url('/itemProfile/'.$item->Item_Id)}}">
                            <h4 class="fw-700 font-xsss mt-3 mb-1">{{ $item->Item_Name }}</h4> 
                        </a>
                        <span>@if($reviews[' '.$item->Item_Id.' ']!=null)
                       <p class=" font-xsssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center" > Rate: {{$reviews[' '.$item->Item_Id.' ']}} / 10 </p>
                        @endif</span>
                        <span class="position-absolute right-15 top-0 d-flex align-items-center">
                            @if (isset($check_follow[$item->Item_Id]))
                            <a href="{{url('/UnfollowItem/'.$item->Item_Id)}}" class="text-center p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white"> <i class="fa fa-heart" aria-hidden="true"></i> Un Follow</a>
                            @else
                            <a href="{{url('/FollowItem/'.$item->Item_Id)}}" class="text-center p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white"> <i class="fa fa-heart-o" aria-hidden="true"></i> Follow</a>
                            @endif
                        </span>
                        <br><br>
                        <p> <i class="feather-map-pin text-grey-500 me-3 font-lg"></i>
            {{ $item->Country_Name }}, {{ $item->State_Name }}, {{ $item->City_Name }}, {{ $item->Region_Name }}, {{ $item->Street_Name }}
        </p>
                        <p class="ps-5">

                        
                        @foreach($details as $detailz )
                        @if(isset($detailz[$item->Item_Id]))
                        @foreach($detailz[$item->Item_Id] as $detail )

                       @if($detail->count>1) {{$detail->count}} {{Str::plural($detail->Property_Name)}},
                       @else
                       {{$detail->count}} {{$detail->Property_Name}},
                       @endif
                        @endforeach
                        @else 
                        @endif
                       
                        @endforeach
                         </p>
          
                      
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>



@endsection