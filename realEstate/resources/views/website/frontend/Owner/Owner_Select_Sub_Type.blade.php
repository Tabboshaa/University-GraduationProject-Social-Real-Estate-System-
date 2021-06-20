@extends('website.frontend.layouts.main')
@section('profile')
<div style="margin-left:150px;" class="row">
    <div class="col-xl-12 col-xxl-12 col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                    <a href="default-settings.html" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                    <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">  Adding Item Step 2</h4>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card w-100 border-0 mt-4">
                    <div class="card w-100 border-0 shadow-none p-4 rounded-xxl mb-3" style="background-color: #e5f6ff;">
                        <div class="card-body d-flex p-0">
                            <i class="btn-round-lg d-inline-block me-3 bg-primary-gradiant feather-home font-md text-white"></i>
                            <h4 class="text-primary font-xl fw-700">{{$main_type}} <span class="fw-500 mt-0 d-block text-grey-500 font-xssss">Add Your Item</span></h4>
                        </div>
                        <ul class="recent-post mt-2">
                            @foreach($sub_type as $sub)
                            <li class="mb-0"><a href="{{ url('OwnerSelectDetails/'.$item_id.'/'.$sub->Sub_Type_Id) }}" class="fw-600 font-xssss">{{$sub->Sub_Type_Name}}</a></li>
                            @endforeach
                        </ul>
                    </div>                               
                </div>
            </div>

        </div>
    </div>
</div>
@endsection