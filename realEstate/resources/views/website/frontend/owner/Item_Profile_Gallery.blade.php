@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')

<div class="row">


    <div class="col-md-12">
        <a href="javascript:void(0)" onclick="SelectImg()">Select</a>
        <a href="javascript:void(0)" id="deleteLinke" onclick="deleteImg()" style="display: none;">Delete</a>
        <!-- <a href="javascript:void(0)" onclick="deleteImg()">Select</a> -->
        <!-- <a href="{{url('/addItemSteps/')}}" ><i class="fa fa-plus-square-o  w3-xxlarge"></i> -->
        <div class="gallery">
            @if( count($gallery) != 0)
            @foreach($gallery as $Image)
            <div class="col-md-0 col-sm-3">
                <div class="gallery">
                    <!-- <a href="{{url('')}}"> <i class="fa fa-trash w3-large"></i></a> -->
                    <a href="javascript:void(0)" onclick="viewImage('{{$Image->File_Path}}')">
                        <img height="200px" width="270px" src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" alt="">
                    </a>
                    <input type="checkbox" name="Dcheckbox" value="{{$Image->Attachment_Id}}" style="display: none;">

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

    var c = 0;

    function SelectImg() {

        var Dcheckboxes = document.getElementsByName("Dcheckbox");


        if (c == 0) {
            for (var i = 0; i < Dcheckboxes.length; i += 1) {
                c = 1;
                Dcheckboxes[i].style.display = 'block';
            }
            document.getElementById('deleteLinke').style.display = "block";


        } else {
            for (var i = 0; i < Dcheckboxes.length; i += 1) {
                Dcheckboxes[i].style.display = 'none';
            }
            c = 0;
            document.getElementById('deleteLinke').style.display = "none";

        }


    }

    function deleteImg() {
        var Dcheckboxes = document.getElementsByName("Dcheckbox");
        var 
        for (var i = 0; i < Dcheckboxes.length; i += 1) {
            if (Dcheckboxes[i].checked == true) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('/') }}",
                    data: {

                    },
                    success: function(data) {

                    },
                    error: function() {

                    }
                });
            }

        }
    }
</script>
@endsection