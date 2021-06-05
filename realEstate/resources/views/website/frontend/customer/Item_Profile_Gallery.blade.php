@extends('website.frontend.customer.Item_Profile')
@section('profile_Content')
<div class="class=" col-xl-12">
    @if( count($gallery) != 0)
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
            <div class=row>
            @foreach($gallery as $Image)
            <div class="col-6 mb-2 pe-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtrip"><img src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            @endforeach
        </div>
    </div>
    @else
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                No Images are posted for this item yet..<br />
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    @endif
</div>

<div class="modal fade" id="ImageModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content" style="background-color: #00000000; border: 0px; padding-top:10%;">
            <div class="modal-body">
                <img src='' id="model_image">
            </div>
        </div>
    </div>
</div>
<script>
    function viewImage(src) {
        var image = "<?php echo (asset('storage/profile gallery/"
            +src
            +"')) ?>";

        $("#model_image").prop('src', image);
        $("#model_image").prop('height', 200);
        $("#model_image").prop('width', 400);

        console.log(src);
        $("#ImageModel").modal("toggle");
    }
</script>
@endsection