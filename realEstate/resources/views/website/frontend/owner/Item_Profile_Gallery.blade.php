@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')

<div class="row">
    <div class="col-md-12">
        <a href="{{url('/addItemSteps/')}}" ><i class="fa fa-plus-square-o  w3-xxlarge"></i>
            <div class="gallery">
                @if( count($gallery) != 0)
                @foreach($gallery as $Image)
                <div class="col-md-0 col-sm-3">
                    <div class="gallery">
                        <a href="{{url('')}}"> <i class="fa fa-trash w3-large"></i></a>
                        <a href="javascript:void(0)" onclick="viewImage('{{$Image->File_Path}}')">
                            <img height="200px" width="270px" src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" alt="">
                        </a>
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