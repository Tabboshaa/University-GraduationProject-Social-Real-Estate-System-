
<div class="col-xl-8 col-xxl-9 col-lg-8">
        <!-- create post div -->
        <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3 mt-3">
            <form method="POST" action="{{ url('/add_user_post') }}" id="postform" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-0">
                    <a class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Create Post</a>
                </div>
                <div class="card-body p-0 mt-3 position-relative">
                    <!-- <figure class="avatar position-absolute ms-2 mt-1 top-5"><img class="shadow-sm rounded-circle w30" src="{{asset('storage/cover page/'.$User->profilePhoto->Profile_Picture)}}" alt="image"></figure> -->
                    <textarea name="Post_Content" value="{{ old('Post_Content') }}" style="padding-left:50pt;" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10" placeholder="What's on your mind?" required></textarea>
                </div>
                <div class="card-body d-flex p-2 mt-0">
                    <label for="uploadImages" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4 pt-2"><i class="font-md text-success feather-image me-2"></i><span class="d-none-xs">Add Photo</span></label>
                    <input type="file" style="display:none;" id="uploadImages" name="images[]" placeholder="upload Images" multiple>
                    <a href="javascript:void(0);" onclick="document.getElementById('postform').submit(); return false;" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i class="font-md text-success feather-check-circle me-2"></i><span class="d-none-xs">Create Post</span></a>
                </div>
            </form>
        </div>
        <!-- end of create post div -->

        @if( count($posts) != 0)
        @foreach($posts as $post)
        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
            <div class="card-body p-0 d-flex">
                @if($Profile_Photo!=null)
                <figure class="avatar me-3"><img src="{{asset('storage/cover page/'.$Profile_Photo->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
                @else
                <figure class="avatar me-3"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
                @endif
                <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                    {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}
                    @if($User->id== $post->User_Id )
                    <a href="{{url('/deletePost/'.$post->Post_Id)}}" name="del_post" id="del_post"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                    <a href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')" name="editpost"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                    @endif
                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"><?php $today = \Carbon\Carbon::now();
                                                                                    $end = \Carbon\Carbon::parse($post->updated_at);
                                                                                    ?>{{ $end->diffForHumans($today)}}</span>
                </h4>
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
            @if( isset($post->comments) )
            <a href="javascript:void(0)" id="more" onclick="$('#allcomments{{$post->Post_Id}}').slideToggle(function(){$('#more').html($('#allcomments{{$post->Post_Id}}').is(':visible')?'Hide Comments':'{{count($post->comments)}} Comment');});" onclick="viewComment('{{$post->Post_Id}}')" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($post->comments)}} Comment</span></a>
            @else
            <div class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Comments</span></div>
            @endif
            <!-- 0055FF -->
            <div class="form-group">
                <input id="CommentForPost{{$post->Post_Id}}" type="text" placeholder="Say something nice." style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
                <a href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>

            </div>
            @if( isset($post->comments) )
            <div id="allcomments{{$post->Post_Id}}" style="display: none;">
                <div class="chat-body p-3 ">
                    <div class="messages-content pb-5">
                        @foreach($post->comments as $comment)
                        <div class="card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10">

                            @if($comment->user->profilePhoto !=null)
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$comment->user->profilePhoto->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @else
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @endif
                            <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                <a href="{{url('view_User/'.$comment->User_Id)}}">
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->user->First_Name}} {{$comment->user->Middle_Name}} {{$comment->user->Last_Name}}
                                        @if($User->id== $comment->User_Id )
                                        <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                                        <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                                        @endif
                                </a></h4>
                                <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0"> {{ $end->diffForHumans($today) }}</p>
                                </div>
                                <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $comment->Comment }}</p>
                            </div>
                        </div>
                        @if( isset($comment->replies))
                        <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'{{count($comment->replies)}} Relpy');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($comment->replies)}} Relpy</span></a>
                        @else
                        <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'0 Relpies');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>0 Relpies</span></a>
                        @endif

                        <div id="allreplies{{$comment->Comment_Id}}" style="display: none;">
                            <div class="form-group">
                                <input id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder="Write a reply..." type="text" style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg">
                                <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>

                            </div>
                            <!-- 0055FF -->
                            @if( isset($comment->replies) )
                            @foreach($comment->replies as $reply)
                            <div class="card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative">
                                @if($reply->user->profilePhoto !=null)
                                <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$reply->user->profilePhoto->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                                @else
                                <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                                @endif <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                    <a href="{{url('view_User/'.$reply->User_Id)}}">
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->user->First_Name}} {{$reply->user->Middle_Name}} {{$reply->user->Last_Name}}
                                            @if($User->id== $reply->User_Id )
                                            <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                                            <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                                            @endif
                                    </a></h4>
                                    <div class="time"><?php $end = \Carbon\Carbon::parse($reply->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0">{{ $end->diffForHumans($today) }}</p>
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
        @endif
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
                if(data['Profile_Picture'] == null)
                {
                    data['Profile_Picture']='pic.png';
                }
                $("#allcomments" + post_id).prepend("<div class='chat-body messages-content pb-5 card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-10'>" 
                    +"<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/"+data['Profile_Picture']+"\" alt='image' class='shadow-sm rounded-circle w35'></figure>" 
                    +"<div class='chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg'>" 
                    +"<a href=\"/view_User/"+data['User_Id']+"\">" 
                    +"<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> "+data['First_Name']+" "+data['Middle_Name']+" "+" "+data['Last_Name']+"" 
                    +"<a href=\"/deletecomment/" + data['Comment_Id'] + "\" name=\"del_Comment\" id=\"del_Comment\"><i class=\"feather-trash-2 text-grey-500 me-0 font-xs\"></i></a>" 
                    +"<a href=\"javascript:void(0)\" onclick=\"setComment('" + data['Comment_Id'] + "','" + data['Comment'] + "')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>" 
                    +"</a></h4>"
                    +"<div class=\"time\"><\?php $end = \Carbon\Carbon::parse(" + data['updated_at'] + "); ?><p class=\"fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0\"> {{ $end->diffForHumans($today) }}</p></div>" 
                    +"<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" 
                    +"</div>"
                    +"</div>" 
                    +"<a href=\"javascript:void(0)\" id=\"morereplies\" onclick=\"$('#allreplies" + data['Comment_Id'] + "').slideToggle(function(){$('#morereplies').html($('#allreplies" + data['Comment_Id'] + "').is(':visible')?'Hide Replies':'0 Relpies');});\" class=\"ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss\"><i class=\"feather-message-circle text-dark text-grey-900 btn-round-sm font-lg\"></i>0 Relpies</span></a>" 
                    +"<div id=\"allreplies" + data['Comment_Id'] + "\" style=\"display: none;\">" 
                    +"<div class=\"form-group\">" 
                    +"<input id=\"ReplyForComment" + data['Comment_Id'] + "\" name=\"comment" + data['Comment_Id'] + "\" placeholder=\"Write a reply...\" type=\"text\" style=\"background-color:#0055ff1a;width:770px;\" class=\"border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg\">" 
                    +"<a href=\"javascript:void(0)]\" onclick=\"Reply('" + post_id + "','" + data['Comment_Id'] + "');\"><i class=\"btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue\"></i></a>" 
                    +"</div>" 
                    +"</div></div>");
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
                $("#allreplies" + parent_id).append("<div class=\"card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative\">" 
                    +"<figure class='avatar position-absolute left-0 ms-2 mt-1'><img src=\"/storage/cover page/"+data['Profile_Picture']+"\" alt='image' class='shadow-sm rounded-circle w35'></figure>" 
                    +"<div class=\"chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg\">" 
                    +"<a href=\"/view_User/"+data['User_Id']+"\">" 
                    +"<h4 class=\"fw-700 text-grey-900 font-xssss mt-0 mb-1\"> "+data['First_Name']+" "+data['Middle_Name']+" "+" "+data['Last_Name']+"" 
                    +"<a href=\"javascript:void(0)\" onclick=\"setComment('"+ data['Comment_Id']+"','"+ data['Comment']+"')\" name=\"editComment\" id=\"edit_Comment\"><i class=\"feather-edit text-grey-500 me-0 font-xs\"></i></a>"           
                    +"</a></h4>"
                    +"<div class=\"time\"><\?php $end = \Carbon\Carbon::parse(" + data['updated_at'] + "); ?><p class=\"fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0\"> {{ $end->diffForHumans($today) }}</p></div>" 
                    +"<p class=\"fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0\">" + data['Comment'] + "</p>" 
                    +"</div>"
                    +"</div>");

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
</script>