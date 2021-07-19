@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_item_gallery/'.$item_id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="Post_Content" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Upload Images:') }}
                    </label>
                    <div class="col-md-3">
                        <input type="file" class="form-control" name="images[]" accept="image/*" placeholder="upload Images" multiple>
                        @error('Upload Images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" id="btun1" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                    @if( count($gallery) != 0)
                    @foreach($gallery as $Image)
                    <div class="col-md-0 col-sm-2">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img height="200px" width="200px" src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" alt="">

                                <div class="mask">
                                    <a href="javascript:void(0)" onclick="viewImage('{{$Image->File_Path}}')">
                                        <p>View image</p>
                                    </a>
                                    <div class="tools tools-bottom">
                                        <a href="{{url('delete_gallery/'.$Image->Attachment_Id)}}" onclick="return confirm('Are you sure you want to delete?')">
                                            <small><i class="fa fa-trash-o" aria-hidden="true"></i></small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @else
                    <div class="">
                        <div class="">
                            No Images are posted for this item yet..<br />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ImageModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content" style="background-color: #00000000; border: 0px; ">
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
        console.log(src);
        $("#ImageModel").modal("toggle");
    }
</script>
@endsection
