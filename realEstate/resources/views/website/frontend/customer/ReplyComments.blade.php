@if( isset($comments[$review->Review_Id]) )
<a href="javascript:void(0)" id="more" onclick="$('#allcomments{{$review->Review_Id}}').slideToggle(function(){$('#more').html($('#allcomments{{$review->Review_Id}}').is(':visible')?'Hide Comments':'{{count($comments[$review->Review_Id])}} Comment');});" onclick="viewComment('{{$review->Review_Id}}')" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($comments[$review->Review_Id])}} Comment</span></a>
@else
<div class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Comments</span></div>
@endif
<!-- 0055FF -->
<div class="form-group">
    <input id="CommentForPost{{$review->Review_Id}}" type="text" placeholder="Say something nice." style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
    <a href="javascript:void(0)" onclick="Comment('{{$review->Review_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>

</div>
@if( isset($comments[$review->Review_Id]) )
<div>
    <div class="chat-body p-3 ">
        <div class="messages-content pb-5"  id="allcomments{{$review->Review_Id}}" style="display: none;">
            @foreach($comments[$review->Review_Id] as $comment)
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
                        <a href="{{url('/delete_review_comment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                        <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                        @endif
                    </h4>
                    <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0"> {{ $end->diffForHumans() }}</p>
                    </div>
                    <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $comment->Comment }}</p>
                </div>
            </div>
            @if( isset($replies[$comment->Comment_Id]))
            <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'{{count($replies[$comment->Comment_Id])}} Relpy');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($replies[$comment->Comment_Id])}} Relpy</span></a>
            @else
            <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'<i class=\'feather-message-circle text-dark text-grey-900 btn-round-sm font-lg \'></i> 0 Replies');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Replies</span></a>
            @endif

            <div id="allreplies{{$comment->Comment_Id}}" style="display: none;">
                <div class="form-group">
                    <input id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder="Write a reply..." type="text" style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg">
                    <a href="javascript:void(0)" onclick="Reply('{{$review->Review_Id}}','{{$comment->Comment_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>

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
                        <a href="{{url('/delete_review_comment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
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
        </div>
    </div>
</div>
@endif

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
            url: "{{route('reviewcomment.update')}}",
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

    function Comment(post_id) {

        var comment = $("#CommentForPost" + post_id).val();

        if (comment.length == 0) {
            return;
        }

        $.ajax({
            url: "{{route('reviewcomment.add')}}",
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
                if (data['Last_Name'] == null) {
                    data['Last_Name'] = '';
                }
                if (data['First_Name'] == null) {
                    data['First_Name'] = '';
                }
                if (data['Middle_Name'] == null) {
                    data['Middle_Name'] = '';
                }

                $("#allcomments" + post_id).prepend("<div class=' card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10'>" +
                    "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35'></figure>" +
                    "<div class='chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg'>" +
                    "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                    "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + " " +
                    "<a href=\"/delete_review_comment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
                    "<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" +
                    "</a></h4>" +
                    "<div class=\"time\"><p class=\"fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0\"> 1 second ago </p></div>" +
                    "<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" +
                    "</div>" +
                    "</div>" +
                    "<a href=\"javascript:void(0)\" id=\"morereplies\" onclick=\"$('#allreplies" + data['Comment_Id'] + "').slideToggle(function(){$('#morereplies').html($('#allreplies" + data['Comment_Id'] + "').is(':visible')?'Hide Replies':'<i class=\'feather-message-circle text-dark text-grey-900 btn-round-sm font-lg \'></i> 0 Relpies');});\" class=\"ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss\"><i class=\"feather-message-circle text-dark text-grey-900 btn-round-sm font-lg\"></i>0 Relpies</span></a>" +
                    "<div id=\"allreplies" + data['Comment_Id'] + "\" style=\"display: none;\">" +
                    "<div class=\"form-group\">" +
                    "<input id=\"ReplyForComment" + data['Comment_Id'] + "\" name=\"comment" + data['Comment_Id'] + "\" placeholder=\"Write a reply...\" type=\"text\" style=\"background-color:#0055ff1a;width:770px;\" class=\"border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg\">" +
                    "<a href=\"javascript:void(0)]\" onclick=\"Reply('" + post_id + "','" + data['Comment_Id'] + "');\"><i class=\"btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue\"></i></a>" +
                    "</div>");
                console.log(data);
            },
            error: function(data) {
                console.log(data);
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
            url: "{{route('reviewreply.add')}}",
            Type: "POST",
            data: {
                post_id: post_id,
                parent_id: parent_id,
                comment: comment

            },
            success: function(data) {
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
                $("#allreplies" + parent_id).append("<div class=\"card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative\">" +
                    "<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/" + data['Profile_Picture'] + "\" alt='image' class='shadow-sm rounded-circle w35'></figure>" +
                    "<div class=\"chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg\">" +
                    "<a href=\"/view_User/" + data['User_Id'] + "\">" +
                    "<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> " + data['First_Name'] + " " + data['Middle_Name'] + " " + " " + data['Last_Name'] + "" +
                    "<a href=\"/delete_review_comment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" +
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
    };
</script>