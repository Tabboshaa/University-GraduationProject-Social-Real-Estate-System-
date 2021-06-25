@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')
<div class="class="col-xl-12">
<form method="POST" action="{{url('/add_item_gallery/'.$item_id)}}" enctype="multipart/form-data">
        @csrf
        <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3 mt-3">
            <label>Add image to your Property </label>
            <div class="form-group" id="OpenImgUpload" >
                <input type="submit" class="btn" value="Choose File">
                <input class="d-none d-lg-block bg-blue-gradiant p-3 mb-3 ms-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3 w-auto" type="file" name="images[]" accept="image/*"  onchange="javascript:this.form.submit();" multiple ><br>
                <span>Maximum file size 100MB</span>
            </div>
        </div>
        </form>
        @if( count($gallery) != 0)
        <a class="d-none d-lg-block bg-blue-gradiant p-3 mb-3 ms-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3 w-auto" href="javascript:void(0)" onclick="SelectImg()">Select</a>
        <a href="javascript:void(0)" id="deleteLinke" onclick="deleteImg()" style="display: none;"><i class="feather-trash font-lg ms-3"></i></a>
        @endif

        <table id="result" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="datatable_info">

        </table>
    @if( count($gallery) != 0)
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
            <div class=row>
            @foreach($gallery as $Image)
            <div class="col-6 mb-2 pe-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtrip"><img src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <input type="checkbox" name="Dcheckbox" value="{{$Image->Attachment_Id}}" style="display: none;">

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