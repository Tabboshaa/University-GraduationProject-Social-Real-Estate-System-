@extends('website.frontend.ownerlayouts.main')
@section('profile')
<div  class="row">
    <div class="col-xl-12 col-xxl-12 col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-md-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">
                    <div class="bg-pattern-div"></div>
                    <h2 class="display2-size display2-md-size fw-700 text-white mb-0 mt-0">My Items</h2>
                </div>
            </div>
            @if(!empty($items))
            @foreach($items as $item)

            <div class="col-lg-4 col-md-6">
                <div class="card w-100 border-0 mt-4">
                    @if($item->coverpage != null)
                    <div class="card-image w-100 p-0 text-center bg-greylight rounded-3 mb-2">
                        <a href="{{ url('/owneritemProfile/'.$item->Item_Id) }}"><img height="200" width="260" src="{{asset('storage/cover page/'.$item->coverpage->path)}}" alt="CoverPage" class="w-100 mt-0 mb-0 p-5"></a>
                    </div>
                    @else
                    <div class="card-image w-100 p-0 text-center bg-greylight rounded-3 mb-2">
                        <a href="{{ url('/owneritemProfile/'.$item->Item_Id) }}"><img  height="200" width="260" src="{{asset('storage/cover page/h1.jpg')}}" alt="CoverPage" class="w-100"></a>
                    </div>
                    @endif
                    <div class="card-body w-100  rounded-3 p-0 text-center">
                        <h2 class="mt-2 mb-1"><a href="{{ url('/owneritemProfile/'.$item->Item_Id) }}"  class="fw-700 font-xsss lh-26">{{$item->Item_Name}}</a></h2>
                    </div>                                
                </div>
            </div>

            @endforeach
            @endif
        </div>
    </div>
</div>

@endsection