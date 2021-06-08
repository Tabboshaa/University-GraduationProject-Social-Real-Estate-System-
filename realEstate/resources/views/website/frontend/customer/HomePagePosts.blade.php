@extends('website.frontend.layouts.main')
@section('content')

<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />
<?php $today = \Carbon\Carbon::now(); ?>

@if( count($posts) != 0)
@foreach($posts as $post)
<div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
    <div class="card-body p-0 d-flex">
        @if($post->path!=null)
        <figure class="avatar me-3"><img src="{{asset('storage/cover page/'.$post->path)}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
        @else
        <figure class="avatar me-3"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
        @endif

        <h4 class="fw-700 text-grey-900 font-xssss mt-1"><a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                {{ $post->Item_Name }}
            </a> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"><?php $today = \Carbon\Carbon::now();
                                                                                    $end = \Carbon\Carbon::parse($post->updated_at);
                                                                                    ?>{{ $end->diffForHumans($today)}}</span></h4>
    </div>
    <div class="card-body p-0 me-lg-5">
        <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{$post->Post_Title}} <br />
            {{$post->Post_Content}} <br />
        </p>
    </div>
    @if( isset($post_images[$post->Post_Id]) )
    <div class="card-body d-block p-0">
        <div class="row ps-2 pe-2">
            @if(count($post_images[$post->Post_Id])==1)
            @foreach($post_images[$post->Post_Id] as $Image)
            <div class="col-sm-12 p-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtr"><img src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            @endforeach
            @elseif(count($post_images[$post->Post_Id])==2)
            @foreach($post_images[$post->Post_Id] as $Image)
            <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            @endforeach
            @elseif(count($post_images[$post->Post_Id])==3||count($post_images[$post->Post_Id])==4)
            @foreach($post_images[$post->Post_Id] as $Image)
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtrip"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            @endforeach
            @elseif(count($post_images[$post->Post_Id])==5)
            @foreach($post_images[$post->Post_Id] as $Image)
            <!-- two med -->
            <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][0]->File_Path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][0]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][1]->File_Path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][1]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <!-- two small -->
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][2]->File_Path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][2]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][3]->File_Path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][3]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][4]->File_Path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][4]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            @endforeach
            @else
            <!-- two med -->
            <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][0]->File_Path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][0]->File_Path)}}" class="rounded-3 w-100" alt="image" width="220px" hieght="142px"></a></div>
            <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][1]->File_Path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][1]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <!-- two small -->
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][2]->File_Path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][2]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][3]->File_Path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][3]->File_Path)}}" class="rounded-3 w-100" alt="image"></a></div>
            <!-- the span -->
            <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][3]->File_Path)}}" data-lightbox="roadtri" class="position-relative d-block"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$post->Post_Id][4]->File_Path)}}" class="rounded-3 w-100" alt="image"><span class="img-count font-sm text-white ls-3 fw-600"><b>+{{(-5+count($post_images[$post->Post_Id]))}}</b></span></a></div>
            @endif
        </div>
    </div>
    @endif

    @if($User_Id== $post->User_Id )
    <a href="{{url('/deletePost/'.$post->Post_Id)}}" name="del_post" id="del_post"> Delete</a>
    @endif
    @if($User_Id== $post->User_Id )
    <a href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')" name="editpost"> Edit</a>
    @endif

    @if( isset($comments[$post->Post_Id]) )
    <a href="javascript:void(0)" id="more" onclick="$('#allcomments{{$post->Post_Id}}').slideToggle(function(){$('#more').html($('#allcomments{{$post->Post_Id}}').is(':visible')?'Hide Comments':'{{count($comments[$post->Post_Id])}} Comment');});" onclick="viewComment('{{$post->Post_Id}}')" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($comments[$post->Post_Id])}} Comment</span></a>
    @else
    <div class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Comments</span></div>
    @endif
    <!-- 0055FF -->

    <div class="form-group">
        <input id="CommentForPost{{$post->Post_Id}}" type="text" placeholder="Say something nice." style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
        <a href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>

    </div>

    @if( isset($comments[$post->Post_Id]) )
    <div id="allcomments{{$post->Post_Id}}" style="display: none;">
        <div class="chat-body p-3 ">
            <div class="messages-content pb-5">
                @foreach($comments[$post->Post_Id] as $comment)
                <div class="card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-5">
                    @if($comment->Profile_Picture!=null)
                    <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$comment->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                    @else
                    <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                    @endif
                    <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                        <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}<a href="#" class="ms-auto"></a></h4>
                        <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0">{{ $end->diffForHumans($today) }}</p>
                        </div>
                        <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $comment->Comment }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <input id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder="Write a reply..." type="text" style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg">
                    <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>
                </div>
                @if( isset($replies[$comment->Comment_Id]))
                <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'{{count($replies[$comment->Comment_Id])}} Relpy');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($replies[$comment->Comment_Id])}} Relpy</span></a>
                @endif
                <!-- 0055FF -->
                @if( isset($replies[$comment->Comment_Id]) )
                <div id="allreplies{{$comment->Comment_Id}}" style="display: none;">
                    @foreach($replies[$comment->Comment_Id] as $reply)
                    <div class="card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative">
                        @if($reply->Profile_Picture!=null)
                        <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$reply->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                        @else
                        <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                        @endif
                        <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                        <a href="{{url('veiw_User/'.$reply->User_Id)}}"><h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}</a></h4>
                            <div class="time"><?php $end = \Carbon\Carbon::parse($reply->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0">{{ $end->diffForHumans($today) }}</p>
                            </div>
                            <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $reply->Comment }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
  


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
                    <?php
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