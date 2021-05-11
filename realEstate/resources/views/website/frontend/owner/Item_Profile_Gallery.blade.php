@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')

<div class="row">


    <div class="col-md-12">
        <form method="POST" action="{{url('/add_item_gallery/'.$item_id)}}" enctype="multipart/form-data"   >
        @csrf
            <label>Add image to your Property </label>
            <div class="screnshot" id="OpenImgUpload">
                <input type="submit" class="btn" value="Choose File">
                <input type="file" name="images[]" onchange="javascript:this.form.submit();" multiple ><br>
                <span>Maximum file size 100MB</span>
            </div>
        </form>
        @if( count($gallery) != 0)
        <a href="javascript:void(0)" onclick="SelectImg()">Select</a>
        <a href="javascript:void(0)" id="deleteLinke" onclick="deleteImg()" style="display: none;">Delete</a>
        @endif

        <table id="result" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

        </table>
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
        var id = [];
        for (var i = 0; i < Dcheckboxes.length; i += 1) {
            if (Dcheckboxes[i].checked == true)
                id.push(Dcheckboxes[i].value);
        }

        $.ajax({
            type: 'get',
            url: "{{ url('/deleteImgFromGallery') }}",
            data: {
                id: id,
            },

            success: function(data) {
                location.reload(true);
                console.log(data);
                if (data != null)
                    $("#result").html("<tr class='table-success'><td> Done! ,Images Deleted Successfully </td></tr>");
                else
                    $("#result").html("<tr class='table-success'><td> Done! ,Images Deleted Successfully </td></tr>");

            },
            error: function() {
                $("#result").html("<tr class='table-danger'><td>Sorry! , Images cannot be deleted</td></tr>");

            }
        });
    }
</script>
@endsection