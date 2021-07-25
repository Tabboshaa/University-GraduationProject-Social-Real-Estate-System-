@if( isset($comments[$post->Post_Id]) )
<a href="javascript:void(0)" id="more{{$post->Post_Id}}" onclick="$('#allcomments{{$post->Post_Id}}').slideToggle(function(){$('#more{{$post->Post_Id}}').html($('#allcomments{{$post->Post_Id}}').is(':visible')?'Hide Comments':'<i class=\'feather-message-circle text-dark text-grey-900 btn-round-sm font-lg\'></i> {{count($comments[$post->Post_Id])}} Comment');});" onclick="viewComment('{{$post->Post_Id}}')" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($comments[$post->Post_Id])}} Comment</a>
@else
<a href="javascript:void(0)" id="more{{$post->Post_Id}}" onclick="$('#allcomments{{$post->Post_Id}}').slideToggle(function(){$('#more{{$post->Post_Id}}').html($('#allcomments{{$post->Post_Id}}').is(':visible')?'Hide Comments':'<i class=\'feather-message-circle text-dark text-grey-900 btn-round-sm font-lg\'></i> 0 Comments');});" onclick="viewComment('{{$post->Post_Id}}')" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Comments</a>
@endif
<!-- 0055FF -->
<div class="form-group">
    <input id="CommentForPost{{$post->Post_Id}}" type="text" placeholder="Say something nice." style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
    <a href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>
</div>
<div class="chat-body p-3 ">
    <div class="messages-content pb-5"  id="allcomments{{$post->Post_Id}}" style="display: none;">
        @if( isset($comments[$post->Post_Id]) )
            @foreach($comments[$post->Post_Id] as $comment)
            <div class="card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10">

                @if($comment->Profile_Picture !=null)
                <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$comment->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35" height="35"></figure>
                @else
                <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                @endif
                <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                    <a href="{{url('view_User/'.$comment->User_Id)}}">
                    <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                        </a>
                        @if($User->id== $comment->User_Id )
                        <a href="{{url('/delete_comment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                        <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                        @endif
                    </h4>
                    <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0"> {{ $end->diffForHumans() }}</p>
                    </div>
                    <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $comment->Comment }}</p>
                </div>
            </div>
            @if( isset($replies[$comment->Comment_Id]))
            <a href="javascript:void(0)" id="morereplies{{$comment->Comment_Id}}" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies{{$comment->Comment_Id}}').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'<i class=\'feather-message-circle text-dark text-grey-900 btn-round-sm font-lg \'></i> {{count($replies[$comment->Comment_Id])}} Relpy');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($replies[$comment->Comment_Id])}} Relpy</span></a>
            @else
            <a href="javascript:void(0)" id="morereplies{{$comment->Comment_Id}}" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies{{$comment->Comment_Id}}').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'<i class=\'feather-message-circle text-dark text-grey-900 btn-round-sm font-lg \'></i> 0 Replies');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i> 0 Replies</span></a>
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
                    <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$reply->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35" height="35"></figure>
                    @else
                    <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                    @endif <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                        <a href="{{url('view_User/'.$reply->User_Id)}}">
                            <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                        </a> @if($User->id== $reply->User_Id )
                        <a href="{{url('/delete_comment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                        <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                        @endif
                        </h4>
                        <div class="time"><?php $end = \Carbon\Carbon::parse($reply->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0">{{ $end->diffForHumans() }}</p>
                        </div>
                        <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $reply->Comment }}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <script>


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
        console.log(id);
        $("#editPost").val(name);
        $("#EditPostModal").modal("toggle");
    }




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
                var str=$('#more'+post_id).html();
                matches = str.match(/\d+/g);
                if(matches.length != 0 ){
                console.log(matches[1]);
                var m= parseInt(matches[1])+1;
                $('#more'+post_id).html('<i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>'+m+' Comments');
                }

                console.log(data);
                if (data['Profile_Picture'] == null) {
                    data['Profile_Picture'] = 'pic.png';
                }
                if (data['Last_Name'] == null) {
                    data['Last_Name'] = '';
                }
                if (data['First_Name'] == null) {
                    data['First_Name'] = '';
                }
                if (data['Middle_Name'] == null) {
                    data['Middle_Name'] = '';
                }
                
                $("#allcomments" + post_id).prepend("<div class='card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10'>" +
                    "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35' height='35'></figure>" +
                    "<div class='chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg'>" +
                    "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                    "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + "" +
                    "<a href=\"/delete_comment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
                    "<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" +
                    "</a></h4>" +
                    "<div class=\"time\"><p class=\"fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0\"> 1 second ago </p></div>" +
                    "<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" +
                    "</div>" +
                    "</div>" +
                    "<a href=\"javascript:void(0)\" id=\"morereplies"+data['Comment_Id']+"\" onclick=\"$('#allreplies" + data['Comment_Id'] + "').slideToggle(function(){$('#morereplies"+data['Comment_Id']+"').html($('#allreplies" + data['Comment_Id'] + "').is(':visible')?'Hide Replies':'0 Relpies');});\" class=\"ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss\"><i class=\"feather-message-circle text-dark text-grey-900 btn-round-sm font-lg\"></i>0 Relpies</span></a>" +
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
    }

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
                    "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35' height='35'></figure>" +
                    "<div class=\"chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg\">" +
                    "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                    "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + "" +
                    "<a href=\"/delete_comment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
                    "<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" +
                    "</a></h4>" +
                    "<div class=\"time\"><p class=\"fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0\"> 1 second ago </p></div>" +
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
    }
    </script>