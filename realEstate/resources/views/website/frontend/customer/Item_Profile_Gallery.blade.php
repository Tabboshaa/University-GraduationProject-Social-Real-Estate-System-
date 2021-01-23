@extends('website.frontend.customer.Item_Profile')
@section('profile_Content')
<div class="row">
    <div class="col-md-12">
        <div class="gallery">
        @if( count($gallery) != 0)
            @foreach($gallery as $Image)
            <div class="col-md-3 col-sm-3">
                <div class="gallery">
                    <img src="{{asset('FrontEnd/images/profile gallery/'.$Image->File_Path)}}" alt="">
                </div>
            </div>
            @endforeach
        @else
        <div class=" locatins">
            <div class="sub-heading">
                No Images are posted for this item yet..<br />
            </div>
            <div class="clearfix"></div>
        </div>
        @endif
        </div>
    </div>
</div>
@endsection
