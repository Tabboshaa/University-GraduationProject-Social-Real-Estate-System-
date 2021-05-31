@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />


@if( count($posts) != 0)
@foreach($posts as $post)
<div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
    <div class="card-body p-0 d-flex">

        @if( isset($post_images[$post->Post_Id]) )
        @foreach($post_images[$post->Post_Id] as $post_image)

        <?php $today = \Carbon\Carbon::now();
        $end = \Carbon\Carbon::parse($post->updated_at);
        ?>
        <a href="{{url('/itemProfile/'.$post->Item_Id)}}">
            <figure class="avatar me-3"><img src="{{asset('FrontEnd/images/coverpage/'.$post_image->File_Path)}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
        </a>

        @endforeach
        @endif
        <h4 class="fw-700 text-grey-900 font-xssss mt-1"> <a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                {{ $post->Item_Name }}
            </a> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{$post->created_at}}</span></h4>
        <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu2">
            <div class="card-body p-0 d-flex">
                <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved items</span></h4>
            </div>
            <div class="card-body p-0 d-flex mt-2">
                <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
            </div>
            <div class="card-body p-0 d-flex mt-2">
                <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
            </div>
            <div class="card-body p-0 d-flex mt-2">
                <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
            </div>
        </div>
    </div>

    <p>
    <div class="card-body p-0 me-lg-5">
        <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{$post->Post_Content}} <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
    </div>
    </p>
    @if($User_Id== $post->User_Id )
    <a href="{{url('/deletePost/'.$post->Post_Id)}}" name="del_post" id="del_post"> Delete</a>
    @endif
    @if($User_Id== $post->User_Id )
    <a href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')" name="editpost"> Edit</a>
    @endif

</div>

<div>
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

        </td>
        </tr>

        {{-- Input for comment --}}
        <tr>
            <td colspan="2">
                <input type="text" class="coment" id="CommentForPost{{$post->Post_Id}}" name="comment" placeholder="Write a comment...">
            </td>
            <td class="arrowStyleL">
                <a href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');"><i class="fas fa-arrow-right arrowStyle"></i></a>
            </td>
        </tr>

        {{-- Loop for comments --}}
        @if( isset($comments[$post->Post_Id]))
        @foreach($comments[$post->Post_Id] as $comment)
        {{-- Comment --}}
        <tr>
            <td colspan="3">
                <div class="commentt">
                    <a class="Usr_name" href="">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}} </a><br>
                    {{ $comment->Comment }}<br>
                    <?php $today = \Carbon\Carbon::now();
                    $end = \Carbon\Carbon::parse($comment->updated_at); ?>
                    {{ $end->diffForHumans($today) }}
                    <a id="viewReplies{{$comment->Comment_Id}}" href="javascript:void(0)" onclick="view('{{$comment->Comment_Id}}')">View Replies</a>
                    <a href="javascript:void(0)" onclick="writeReplay('{{ $comment->Comment_Id}}')"> reply</a>

                    @if($User_Id== $comment->User_Id )
                    <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"> Delete</a>
                    @endif
                    @if($User_Id== $comment->User_Id )
                    <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"> Edit</a>
                    @endif
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
            </td>
        </tr>

        {{-- Replies --}}
        <tr id="Replies{{$comment->Comment_Id}}"></tr>
        <div>
            {{-- Input for reply --}}
            <tr name="writeReplay{{$comment->Comment_Id}}" style="display: none;">

                <td colspan="2">
                    <input type="text" class="replyyy" id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder=" Write a reply...">
                </td>
                <td class="arrowStyleL">
                    <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');"><i class="fas fa-arrow-right arrowStyle"></i></a>
                </td>
            </tr>


        </div>

        @endforeach
        @endif
        </tbody>
        </table>
    </div>
    @endforeach
    @else
    @if( count($items) != 0)
    <div class="modal fade" id="ImageModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-content" style="background-color: #00000000; border: 0px; padding-top:10%;">
            <div class="modal-dialog">
                <table>
                    <thead>
                        <tr>
                            <td colspan="3">
                                <p>
                                    Follow items that you are interested in.
                                </p>
                            </td>
                        </tr>
                    </thead>
                    @foreach($items as $item)
                    <tbody>
                        <tr>
                            <td colspan="3">
                                @if( count($cover__pages) != 0)
                                @foreach($cover_pages as $cover_page)
                                <a href="{{url('/itemProfile/'.$item->Item_Id)}}">
                                    <img height="50" width="70" src="{{asset('FrontEnd/images/coverpage/'.$cover__page->path)}}" alt="">
                                </a>
                                <a href="{{url('/itemProfile/'.$item->Item_Id)}}">
                                    {{ $item->Item_Name }}
                                </a>
                                @if ($check_follow=="[]")
                                <a href="{{url('/FollowItem/'.$item->Item_Id)}}">Follow</a>
                                @else
                                <a href="{{url('/UnfollowItem/'.$item->Item_Id)}}">Un Follow</a>
                                @endif
                                @endforeach
                                @else
                                <a href="{{url('/itemProfile/'.$item->Item_Id)}}">
                                    {{ $item->Item_Name }}
                                </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endif


    @endif

    <script>
        $(document).ready(function() {
            $("#ImageModel").modal("toggle");
        });

        function view(id) {
            // if value view reply
            value = document.getElementById("viewReplies" + id).innerHTML;
            console.log('one');

            if (value === "View Replies") {
                var replys = document.getElementsByName("reply1" + id);
                for (var reply of replys) {
                    reply.style.display = 'block';
                }
                document.getElementById("viewReplies" + id).innerHTML = "Hide Replies";
                console.log('two');
                getReplies(id);

            } else {
                var replys = document.getElementsByName("reply1" + id);
                for (var reply of replys) {
                    reply.style.display = 'none';
                }
                document.getElementById("viewReplies" + id).innerHTML = "View Replies";

            }

            //else
        }

        function writeReplay(id) {
            var writeReplayDivs = document.getElementsByName("writeReplay" + id);
            for (var Divs of writeReplayDivs) {
                Divs.style.display = 'block';
            }
        }

        function getReplies(comment_id) {


            $.ajax({
                url: "{{route('get.replies')}}",
                Type: "POST",
                data: {
                    comment_id: comment_id,

                },
                success: function(data) {
                    var Form = '';
                    Object.values(data).forEach(val => {

                        Form += '<tr>' +
                            '<td colspan="3">' +
                            '<div class="commentt" name="reply1' + comment_id + '">' +
                            ' <a class="Usr_name" href="">' + val['First_Name'] + ' ' + val['Middle_Name'] + ' ' + val['Last_Name'] + '</a><br>' +
                            '<input type="hidden" name="reply' + comment_id + '">' +
                            val['Comment'] +
                            '<br>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                    });
                    if (Form == '')
                        Form = 'No Replies';
                    else
                        Form += '';


                    $('#Replies' + comment_id).html(Form);
                },
                error: function() {
                    console.log('Error');
                }

            });
        };

        function setComment(id, name) {
            console.log("sdsdsdds");
        }

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

        })

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

        })

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
    </script>

    @endsection