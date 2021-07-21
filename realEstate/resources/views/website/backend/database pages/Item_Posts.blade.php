@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel" >
            @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_item_post/'.$item_id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="Post_Content" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Post Content:') }}
                    </label>
                    <div class="col-md-2">
                        <input style="border-radius: 3pt" type="text" class="form-control @error('Post_Content') is-invalid @enderror" name="Post_Content" value="{{ old('Post_Content') }}" required autocomplete="Post_Content">
                        @error('Post_Content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Post_Content" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Upload Images:') }}
                    </label>
                    <div class="col-md-2">
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
                        <!-- <button id="btun2" class="btn btn-primary">
                            <a href="{{url('/show_item_schedule/'.$item_id)}}" class="link2">{{ __('Show') }}</a>
                        </button> -->
                    </div>
                </div>
            </form>
        </div>
        
    <div class="title_right">
        
        <div class="x_panel" style="background-color:rgb(247, 247, 247)">
                        <div style="margin-left: 250px;"class="col-md-7">
                            @if( count($posts) != 0)
                            @foreach($posts as $post)
                            <div name="post">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <?php $today = \Carbon\Carbon::now();
                                        $end = \Carbon\Carbon::parse($post->updated_at);
                                        ?>
                                        <img src="{{asset('storage/cover page/'.$post->path)}}" style="width:60px; height:60px;"  class="avatar" alt="Avatar">
                                        <h5 style="color: black; margin-left:10px;">{{$post->Item_Name}} <br> <small><p style="color: rgb(73, 73, 73);">{{ $end->diffForHumans()}}</p></small> </h5>

                                        <div style=" position:absolute;top:10px;right:10px;">
                                        <a href="{{url('delete_posts/'.$post->Post_Id)}}" onclick="return confirm('Are you sure you want to delete?')">
                                            <small><i class="fa fa-trash-o" style="font-size: 1.7em;"aria-hidden="true"></i></small>
                                        </a>
                                        <a href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')" name="editpost">
                                            <small><i class="fa fa-edit" style="font-size: 1.7em;"></i></small>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="x_content">
                                        <p>
                                        <h6 style="color: black;">{{$post->Post_Content}} </h6><br />
                                        </p>
                                    </div>
                                    <div class="gallery">
                                        @if( isset($post_images[$post->Post_Id]) )
                                        @foreach($post_images[$post->Post_Id] as $Image)
                                        <div class="col-md-5 col-sm-5">
                                            <div class="gallery">
                                                <img style="float:left;width:250px;height:200px;" src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" alt="">
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>


                                    <div class="clearfix"></div>
                                    <br />
                                    <div class="placeform1">
                                        <input type="text" id="CommentForPost{{$post->Post_Id}}" class="form-control" style="font-size: 12pt" name="comment" placeholder="Write your comment...">
                                    </div>
                                    <div>
                                        </br>
                                        <a class="btn btn-info" href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');">Comment</a>
                                    </div>

                                    <div id="allcomments{{$post->Post_Id}}">
                                        @if( isset($comments[$post->Post_Id]) )
                                        @foreach($comments[$post->Post_Id] as $comment)
                                        <div class="col-md-12">

                                            <img src="images/icon/user.jpg" alt="">
                                            <p>
                                                {{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                                                <a href="{{url('/delete_comment/'.$comment->Comment_Id)}}" onclick="return confirm('Are you sure you want to delete?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment">
                                                    <i class="fa fa-edit">

                                                    </i></a>

                                                <?php $end = \Carbon\Carbon::parse($comment->updated_at); ?>
                                                </br> <small>{{ $end->diffForHumans() }} </small>
                                            </p>


                                            <div class="x_content">
                                                {{ $comment->Comment }}
                                            </div>
                                            <div class="clearfix"></div>


                                            <div class="placeform1">
                                                <input type="text" id="ReplyForComment{{$comment->Comment_Id}}" class="form-control" style="font-size: 9pt" name="comment" placeholder="Write a reply...">
                                            </div>
                                            <div>
                                                </br>
                                                <a class="btn btn-info" href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');">Reply</a>
                                            </div>

                                            @if( isset($replies[$comment->Comment_Id]) )
                                            @foreach($replies[$comment->Comment_Id] as $reply)
                                            <div class="col-md-8">

                                                <img src="images/icon/user.jpg" alt="">

                                <p>
                                    {{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                                    <a href="{{url('delete_reply/'.$reply->Comment_Id)}}" onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <?php $end = \Carbon\Carbon::parse($reply->updated_at); ?>
                                <p>{{ $end->diffForHumans() }} </p>
                                </p>

                                                {{ $reply->Comment }}

                                                <div class="clearfix"></div>

                                            </div>
                                        </div>

                                            @endforeach
                                            @endif
                                    </div>
                                            @endforeach
                                            @endif
                                </div>
                            </div>
                                            @endforeach
                                            <!-- in case no posts are there yet -->
                                        </div>
                                    </div>
                                    @else
                                    <div class=" x_panel">
                                        <div class="x_content">
                                            No Posts are posted for this item yet..<br />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="EditCommentForm">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="edit_Comment" style="font-size: 12pt">Edit Comment</label>
                            <input type="text" style="border-radius: 3pt" name="edit_Comment" id="editComment" class="form-control">
                        </div>
                        <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="EditPostForm">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="edit_Post" style="font-size: 12pt">Edit Post</label>
                            <input type="text" style="border-radius: 3pt" name="edit_Post" id="editPost" class="form-control">
                        </div>
                        <button type="submit" id="btun3" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function Comment(post_id) {

            var comment = $("#CommentForPost" + post_id).val();

            if (comment.length == 0) {
                return;
            }

            $.ajax({
                url: "{{route('comment.addAdmin')}}",
                Type: "POST",
                data: {
                    post_id: post_id,
                    comment: comment

                },
                success: function(data) {
                    console.log(data);
                    if (data['Profile_Picture'] == null) {
                        data['Profile_Picture'] = 'pic.png';
                    }
                    $("#allcomments" + post_id).prepend("<div class=\"col-md-12\"></div");
                    console.log(data);
                },
                error: function() {
                    console.log(post_id);
                    console.log(comment);
                    console.log('Error');
                }

            });
        };

        function setComment(id, name) {

            // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty
            $("#id").val(id);
            console.log(name);
            $("#editComment").val(name);
            $("#EditCommentModal").modal("toggle");
        }
        $('#EditCommentForm').submit(function() {

            var id = $("#id").val();

            //byb3t el value el gdeda
            var edit_Comment = $("#editComment").val();
            console.log(edit_Comment);

            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{route('Comment.update')}}",
                Type: "PUT",
                data: {
                    id: id,
                    edit_Comment: edit_Comment,
                    _token: _token
                },
                success: function() {
                    console.log('Success');
                    $("#EditCommentModal").modal("toggle");

                },
                error: function() {
                    console.log('Error');
                }

            });

        });

        function Reply(post_id, parent_id) {

            var comment = $("#ReplyForComment" + parent_id).val();

            if (comment.length == 0) {
                return;
            }

            $.ajax({
                url: "{{route('reply.add')}}",
                Type: "POST",
                data: {
                    post_id: post_id,
                    parent_id: parent_id,
                    comment: comment

                },
                success: function(data) {
                    $("#allreplies" + parent_id).append("<div class=\"card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative\">" +
                        "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35'></figure>" +
                        "<div class=\"chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg\">" +
                        "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                        "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + "" +
                        "<a href=\"/deletecomment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
                        "<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" +
                        "</a></h4>" +
                        "<div class=\"time\"><p class=\"fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0\"> 1 second ago </p></div>" +
                        "<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" +
                        "</div>" +
                        "</div>");

                    console.log(data);
                },
                error: function() {
                    console.log('Error');
                }

            });
        };

        function setPost(id, name) {

            // Kda hwa mask el id w name bto3 el row el 2adem eli hwa fe delwa2ty
            $("#id").val(id);
            console.log(name);
            $("#editPost").val(name);
            $("#EditPostModal").modal("toggle");
        }
        $('#EditPostForm').submit(function() {

            var id = $("#id").val();

            //byb3t el value el gdeda
            var edit_Post = $("#editPost").val();
            console.log(edit_Post);

            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{route('post.update')}}",
                Type: "PUT",
                data: {
                    id: id,
                    edit_Post: edit_Post,
                    _token: _token
                },
                success: function() {
                    console.log('Success');
                    $("#EditPostModal").modal("toggle");

                },
                error: function() {
                    console.log('Error');
                }

            });

        });
    </script>
    @endsection
