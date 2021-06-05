@extends('website.frontend.customer.Item_Profile')
@section('profile_Content')

<div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-block p-4">
            <h4 class="fw-700 mb-3 font-xsss text-grey-900">Owner</h4>
            <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0"><a href="{{url('/veiw_User/'.$item->User_Id)}}">@ {{$item->user->First_Name}} {{$item->user->Middle_Name}} {{$item->user->Last_Name}}</p>
        </div>
        <div class="card-body d-flex pt-0">
            <i class="feather-map-pin text-grey-500 me-3 font-lg"></i>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1"> {{$item->street->country->Country_Name}}, {{$item->street->state->State_Name}} </h4>
        </div>
    </div>
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-flex align-items-center  p-4">
            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
            <a href="{{url('/itemGallery/'.$item->Item_Id)}}" class="fw-600 ms-auto font-xssss text-primary">See all</a>
        </div>
        <div class="card-body d-block pt-0 pb-2">
            @if( count($gallery) != 0)
            <div class=row>
                @foreach($gallery as $Image)
                <div class="col-6 mb-2 pe-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtrip"><img src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                @endforeach
            </div>
            <div class="card-body d-block w-100 pt-0">
                <a href="{{url('/itemGallery/'.$item->Item_Id)}}" class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i class="feather-external-link font-xss me-2"></i> More</a>
            </div>
            @else
            <div class="card-body d-block w-100 pt-0">
                <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                    No Images are posted for this item yet..<br />
                </p>
            </div>
            <div class="clearfix"></div>
            @endif
        </div>
    </div>
</div>

<!--end of right box -->
<div class="col-xl-8 col-xxl-9 col-lg-9">
    @if( count($posts) != 0)
    @foreach($posts as $post)
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            @if($item->coverpage->path!=null)
            <figure class="avatar me-3"><img src="{{asset('storage/cover page/'.$item->coverpage->path)}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
            @else
            <figure class="avatar me-3"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
            @endif
            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                    {{ $item->Item_Name }}
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
                            <a href="{{url('veiw_User/'.$comment->User_Id)}}">
                                <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                            </a></h4>
                            <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0"> {{ $end->diffForHumans($today) }}</p>
                            </div>
                            <p class="fw-500 text-grey-500 lh-20 font-xsss w-100 mt-2 mb-0">{{ $comment->Comment }}</p>
                        </div>
                    </div>

                    @if( isset($replies[$comment->Comment_Id]))
                    <a href="javascript:void(0)" id="morereplies" onclick="$('#allreplies{{$comment->Comment_Id}}').slideToggle(function(){$('#morereplies').html($('#allreplies{{$comment->Comment_Id}}').is(':visible')?'Hide Replies':'{{count($replies[$comment->Comment_Id])}} Relpy');});" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>{{count($replies[$comment->Comment_Id])}} Relpy</span></a>
                    @endif
                    <!-- 0055FF -->
                    <div class="form-group">
                        <input id="ReplyForComment{{$comment->Comment_Id}}" name="comment{{$comment->Comment_Id}}" placeholder="Write a reply..." type="text" style="background-color:#0055ff1a;width:770px;" class="border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xsssss fw-500 rounded-xl w300 theme-dark-bg">
                        <a href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>
                    </div>
                    @if( isset($replies[$comment->Comment_Id]) )
                    <div id="allreplies{{$comment->Comment_Id}}" style="display: none;">
                        @foreach($replies[$comment->Comment_Id] as $reply)
                        <div class="card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative">
                            @if($reply->Profile_Picture!=null)
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$reply->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @else
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @endif <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                <a href="{{url('veiw_User/'.$reply->User_Id)}}">
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                                </a></h4>
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
        </div>
    </div>

    @endforeach
@else
@endif
</div>

<script>
    var commentflag = 0;
    var replyflag = 0;

    function viewComment(id) {

        var comments = $("#allcomments" + id);
        console.log(comments);
        if (commentflag != "0") {
            comments.style.display = 'block';
            commentflag = 1;

        } else {
            var comments = $("#allcomments" + id);
            comments.style.display = 'none';
            commentflag = 0;

        }
        console.log(value);
        //else
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
