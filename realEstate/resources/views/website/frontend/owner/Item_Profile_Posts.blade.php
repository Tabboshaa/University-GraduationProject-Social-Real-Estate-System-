@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')
<div class="row">
    <div class="col-md-7">
        @if( count($posts) != 0)
        @foreach($posts as $post)
        <div name="post">
            <div class="locatins">
                <div class="heading1">
                    <?php $today = \Carbon\Carbon::now();
                    $end = \Carbon\Carbon::parse($post->updated_at);
                    ?>
                    <img src="{{asset('FrontEnd/images/icon/user.html')}}" alt="">
                    <h3>
                        {{ $item->Item_Name }}
                        <a href="{{url('/deletePost/'.$post->Post_Id)}}" name="del_post" id="del_post"> <i class="fa fa-trash" style="margin-left:490px;"></i></a>
                        <a href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')" name="editpost"> <i class="fa fa-edit" style="margin-left:5px;"></i></a>
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
                        <p>{{ $today->diffForHumans($end)}} </p>
                    </h3>
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

                <div class="sub-heading">
                    {{$post->Post_Title}} <br />
                    {{$post->Post_Content}} <br />


                </div>
                <div class="clearfix"></div>

                <div class="placeform1">
                    <input type="text" id="CommentForPost{{$post->Post_Id}}" name="comment" placeholder="Write your comment...">
                    <a href="#">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="addbtn1">
                    <a href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');">Comment</a>
                </div>

            </div>
        </div>
        @if( isset($comments[$post->Post_Id]) )

        @foreach($comments[$post->Post_Id] as $comment)
        <div class="col-md-12">
            <div class="locatins">
                <div class="heading1">
                    <img src="images/icon/user.jpg" alt="">
                    <h3>
                        {{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                        <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"> <i class="fa fa-trash" style="margin-left:490px;"></i></a>
                        <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"> <i class="fa fa-edit" style="margin-left:5px;"></i></a>
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
                        <?php $end = \Carbon\Carbon::parse($comment->updated_at); ?>
                        <p>{{ $end->diffForHumans($today) }} </p>

                    </h3>
                </div>
                <!-- <div class="reply">
                                <a href="#">Reply</a>
                            </div> -->
                <div class="sub-heading">
                    {{ $comment->Comment }}
                </div>
                <div class="clearfix"></div>


                <div class="placeform1">
                    <input type="text" id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder="Write a reply...">
                    <a href="#">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="addbtn1">
                    <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');">Reply</a>
                </div>


            </div>
        </div>

        @if( isset($replies[$comment->Comment_Id]) )
        @foreach($replies[$comment->Comment_Id] as $reply)
        <div class="col-md-8">
            <div class=" locatins">
                <div class="heading1">
                    <img src="images/icon/user.jpg" alt="">
                    <h3>
                        {{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                        <a href="{{url('/deletecomment/'.$reply->Comment_Id)}}"> <i class="fa fa-trash" style="margin-left:190px;"></i></a>
                        <a href="javascript:void(0)" onclick="setComment('{{$reply->Comment_Id}}','{{$reply->Comment}}')"> <i class="fa fa-edit" style="margin-left:5px;"></i></a>
                        <?php $end = \Carbon\Carbon::parse($reply->updated_at); ?>
                        <p>{{ $end->diffForHumans($today) }} </p>

                    </h3>
                </div>
                <div class="sub-heading">
                    <input type="hidden" name="reply{{$comment->Comment_Id}}" autofocus>
                    {{ $reply->Comment }}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        @endforeach
        @endif

        @endforeach
        @endif

        @endforeach
        <!-- in case no posts are there yet -->
        @else
        <div class=" locatins">
            <div class="heading1">
                {{ $item->Item_Name }}
                </h3>
            </div>
            <div class="sub-heading">
                No Posts are posted for this item yet..<br />
            </div>
            <div class="clearfix"></div>
        </div>

        @endif
    </div>
    <div class="col-md-5">
        <div class="box-left">
            <div class="rightboxs">
                <img src="images/banner/Icon4.png" alt="">
                <span>Owner</span>
                <p><a href="#">@ {{$item->First_Name}} {{$item->Middle_Name}} {{$item->Last_Name}}</a></p>
                <div id="test"></div>
            </div>
        </div>
        <div class="box-left">
            <div class="rightboxs">
                <img src="images/banner/Icon9.png" alt="">
                <span>Follow Us</span>
                <p>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-lastfm-square" aria-hidden="true"></i></a>
                </p>
            </div>
        </div>
        <div class="box-left">
            <div class="rightboxs">
                <img src="images/banner/Icon9.png" alt="">
                <span>Country</span>
                <p>Egypt</p>
            </div>
        </div>
        <div class="box-left">
            <div class="rightboxs">
                <img src="images/banner/Icon6.png" alt="">
                <span>Categories</span>
                <p>For Rent</p>
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
            url: "{{route('comment.add')}}",
            Type: "POST",
            data: {
                post_id: post_id,
                comment: comment

            },
            success: function(data) {

                console.log(data);
            },
            error: function() {
                console.log(post_id);
                console.log(comment);
                console.log('Error');
            }

        });
    };

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