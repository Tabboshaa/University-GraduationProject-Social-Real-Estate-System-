@extends('website.frontend.layouts.main')
@section('profile')

<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/FrontEndCSS/TimeLine.css')}}" rel="stylesheet" type="text/css" />
<?php $today = \Carbon\Carbon::now(); ?>

<div class="row">
    <div class="col-xl-8 col-xxl-9 col-lg-8">

    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3 overflow-hidden">
        <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
            <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/HomePage')}}" data-toggle="tab">items</a></li>
                <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="{{url('/HomepageUserPosts')}} data-toggle=" tab">Followed users</a></li>
            </ul>
        </div>
    </div>

    @if( count($posts) != 0)
    @foreach($posts as $post)
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            @if($post->Profile_Picture!=null)
            <figure class="avatar me-3"><img src="{{asset('storage/cover page/'.$post->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
            @else
            <figure class="avatar me-3"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
            @endif

            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                    {{ $post->First_Name }} {{ $post->Middle_Name }} {{ $post->Last_Name }}
                    @if($User->id== $post->User_Id )
                    <a href="{{url('/deletePost/'.$post->Post_Id)}}" name="del_post" id="del_post"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                    <a href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')" name="editpost"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                    @endif
                </a> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"><?php $today = \Carbon\Carbon::now();
                                                                                        $end = \Carbon\Carbon::parse($post->updated_at);
                                                                                        ?>{{ $end->diffForHumans()}}</span></h4>
        </div>
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500 text-black-500 lh-26 font-xss w-100">{{$post->Post_Title}} <br />
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
                    <div class="card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10">

                        @if($comment->Profile_Picture !=null)
                        <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$comment->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                        @else
                        <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                        @endif
                        <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                            <a href="{{url('view_User/'.$comment->User_Id)}}">
                                <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                                    @if($User->id== $comment->User_Id )
                                    <a href="{{url('/delete_comment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                                    <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                                    @endif
                            </a></h4>
                            <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0"> {{ $end->diffForHumans() }}</p>
                            </div>
                            <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $comment->Comment }}</p>
                        </div>
                    </div>
                    @if( isset($replies[$comment->Comment_Id]))
                    <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'{{count($replies[$comment->Comment_Id])}} Relpy');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($replies[$comment->Comment_Id])}} Relpy</span></a>
                    @else
                    <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'0 Relpies');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Relpies</span></a>
                    @endif

                    <div id="allreplies{{$comment->Comment_Id}}" style="display: none;">
                        <div class="form-group">
                            <input id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder="Write a reply..." type="text" style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg">
                            <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>

                        </div>
                        <!-- 0055FF -->
                        @if( isset($replies[$comment->Comment_Id]) )
                        @foreach($replies[$comment->Comment_Id] as $reply)
                        <div class="card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative">
                            @if($reply->Profile_Picture !=null)
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$reply->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @else
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @endif <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                <a href="{{url('view_User/'.$reply->User_Id)}}">
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                                        @if($User->id== $reply->User_Id )
                                        <a href="{{url('/delete_comment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                                        <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                                        @endif
                                </a></h4>
                                <div class="time"><?php $end = \Carbon\Carbon::parse($reply->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0">{{ $end->diffForHumans() }}</p>
                                </div>
                                <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $reply->Comment }}</p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
    @endforeach
    </div>

    <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
            <div class="card-body d-block p-4">
                <h4 class="fw-700 mb-3 font-xsss text-grey-900"> Popular items <i class="fa fa-fire"></i></h4>
                <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">Popular items right now </p>
            </div>
            <div class="card-body border-top-xs d-flex">
                <div class=row>
                    @foreach($mostPopularitems as $item)
                    <div class="col-6 mb-2 pe-1">
                        @isset($item->coverpage->path )
                        <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$item->coverpage->path)}}');"></div>
                        @else
                        <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/Default1.jpeg')}}');"></div>
                        @endif
                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="{{url('/itemProfile/'.$item->Item_Id)}}" data-toggle="tab">{{$item->Item_Name}}</a>
                        @if(count($item->checkfollow) == 0)
                        <a href="{{url('/FollowItem/'.$item->Item_Id)}}"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        @else
                        <a href="{{url('/UnfollowItem/'.$item->Item_Id)}}"> <i class="fa fa-heart" aria-hidden="true"></i></a>
                        @endif

                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
            <div class="card-body d-block p-4">
                <h4 class="fw-700 mb-3 font-xsss text-grey-900">Newest items <i class="fa fa-certificate"></i></h4>
                <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">See Our Newest Items </p>
            </div>
            <div class="card-body border-top-xs d-flex">
                <div class=row>
                    @foreach($newestitems as $item)
                    <div class="col-6 mb-2 pe-1">
                        @isset($item->coverpage->path )

                        <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$item->coverpage->path)}}');"></div>
                        @else
                        <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/Default1.jpeg')}}');"></div>
                        @endif
                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="{{url('/itemProfile/'.$item->Item_Id)}}" data-toggle="tab">{{$item->Item_Name}}</a>
                        @if(count($item->checkfollow) == 0)
                        <a href="{{url('/FollowItem/'.$item->Item_Id)}}"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        @else
                        <a href="{{url('/UnfollowItem/'.$item->Item_Id)}}"> <i class="fa fa-heart" aria-hidden="true"></i></a>
                        @endif

                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    @else

    @endif
</div>


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
                if (data['Profile_Picture'] == null) {
                    data['Profile_Picture'] = 'pic.png';
                }
                $("#allcomments" + post_id).prepend("<div class='chat-body messages-content pb-5 card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10'>" +
                    "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35'></figure>" +
                    "<div class='chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg'>" +
                    "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                    "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + "" +
                    "<a href=\"/delete_comment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
                    "<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" +
                    "</a></h4>" +
                    "<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" +
                    "</div>" +
                    "</div>" +
                    "<a href=\"javascript:void(0)\" id=\"morereplies\" onclick=\"$('#allreplies" + data['Comment_Id'] + "').slideToggle(function(){$('#morereplies').html($('#allreplies" + data['Comment_Id'] + "').is(':visible')?'Hide Replies':'0 Relpies');});\" class=\"ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss\"><i class=\"feather-message-circle text-dark text-grey-900 btn-round-sm font-lg\"></i>0 Relpies</span></a>" +
                    "<div id=\"allreplies" + data['Comment_Id'] + "\" style=\"display: none;\">" +
                    "<div class=\"form-group\">" +
                    "<input id=\"ReplyForComment" + data['Comment_Id'] + "\" name=\"comment" + data['Comment_Id'] + "\" placeholder=\"Write a reply...\" type=\"text\" style=\"background-color:#0055ff1a;width:770px;\" class=\"border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg\">" +
                    "<a href=\"javascript:void(0)]\" onclick=\"Reply('" + post_id + "','" + data['Comment_Id'] + "');\"><i class=\"btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue\"></i></a>" +
                    "</div>" +
                    "</div></div>");
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
                $("#allreplies" + parent_id).append("<div class=\"card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative\">" +
                    "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35'></figure>" +
                    "<div class=\"chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg\">" +
                    "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                    "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + "" +
                    "<a href=\"/delete_comment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
                    "<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" +
                    "</a></h4>" +
                    "<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" +
                    "</div>" +
                    "</div>");

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
