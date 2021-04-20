@extends('website.frontend.layouts.main')
@section('content')
<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
            <div class="advertisment-banner1 col-md-12">
                {{-- Cover photo --}}
                @if(!empty($Cover_Photo))
                <img class="background" src="{{asset('storage/cover page/'.$Cover_Photo)}}" alt="">
                @else
                <div id="coverPhoto">
                    <img class="background" src="{{asset('FrontEnd/images/cover page/Default1.jpeg')}}" alt="">
                </div>
                <div class="screnshot" id="OpenImgUpload">
                        <input id="cover_photo_upload" name="CoverPhoto" type="file" class="hidden" >    
                </div>
                @endif
            </div>
            <div class="main-page">
                <div class=" dash-profile">
                    {{-- profile photo --}}
                    @if(!empty($Profile_Photo))
                    <img class="profile" src="{{asset('storage/cover page/'.$Profile_Photo)}}" alt="">
                    @else
                    <div id="ProfilePhoto">
                        <img class="profile" src="{{asset('FrontEnd/images/cover page/pic.png')}}" alt="">
                    </div>
                    <div class="screnshot" id="OpenImgUpload">
                    <!-- New simple code hena ya Shaimaaa -->
                    <form method="POST" action="{{url('/CreateProfilePhoto')}}" enctype="multipart/form-data">
                        @csrf
                        <input id="profile_photo_upload" name="ProfilePhoto" type="file" class="hidden" onchange="javascript:this.form.submit();">
                    <!-- onchange="javascript:this.form.submit();" 3shan y3ml submit lel form awl ma ad5l photo -->
                    <!-- w yrooo7 ll controller -->
                    </form>
                    <!-- 5ls hna -->
                    </div>
                    @endif
                </div>
                {{-- User Name --}}
                <div class="prompr">
                    <div class="dashname">
                    {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>

        <!-- Banner Area-->
        <div class="settingmenu">
            <div class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse  visible-title" id="navbarNav">

                </div>
            </div>
        </div>

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

                                {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}
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
                                <?php $end = \Carbon\Carbon::parse($comment->updated_at); ?>
                                <p>{{ $end->diffForHumans($today) }} </p>
                            </h3>
                        </div>
                        <div class="sub-heading">
                            {{ $comment->Comment }}
                        </div>
                        <div class="clearfix">

                        </div>
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
                    <div class="clearfix">

                    </div>
                </div>

                @endif
            </div>
            <div class="col-md-5">
                <div class="box-left">
                    <div class="rightboxs">
                        <form method="POST" action="{{ url('/add_item_post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="heading1">
                                <img src="{{asset('FrontEnd/images/icon/user.html')}}" alt="">
                                <h3>
                                    {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}</a></p>
                                    <p>now</p>
                                </h3>
                            </div>
                            <div class="feedback col-md-12" style="margin-left: 0px;">
                                <div class="email-input">
                                    <input type="text" name="Post_Title" style="margin-left: 5px;" placeholder="Post Title" required autocomplete="Post_Title" value="{{ old('Post_Title') }}">
                                    <textarea placeholder="Post Content" name="Post_Content" style="margin-left: 5px;" value="{{ old('Post_Content') }}" required autocomplete="Post_Content"></textarea>
                                </div>
                                <div id="OpenImgUpload">
                                    <input type="file" name="images[]" placeholder="upload Images" multiple>
                                    <br>
                                </div>
                                </hr>
                            </div>
                            <button class="btn" type="submit">Submit</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
        <div class="box-left">
            <div class="rightboxs">
                <img src="images/banner/Icon4.png" alt="">
                <span>Owner</span>
                <p><a href="#">@
                        {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}</a></p>
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
</div>
</div>


<script>
    // upload cover photo
    $('#coverPhoto').on('click', function() {
        $('#cover_photo_upload').click();
    });

    // $('#cover_photo_upload').on('change', function() {


    //     // bageb user id by input id
    //     var user_id = $('#user_id').val();
    //     var CoverPhoto = $('#cover_photo_upload').val();
    //     $.ajax({
    //         url: "{{route('create.coverphoto')}}",
    //         Type: "PUT",
    //         data: {
    //             user_id: user_id,
    //             CoverPhoto: CoverPhoto
    //         },
    //         success: function(data) {
    //             console.log(data);
    //         },
    //         error: function() {
    //             console.log(user_id);
    //             console.log(CoverPhoto);
    //             console.log('Error');
    //         }
    //     });
    // });


    // upload profile photo
    $('#ProfilePhoto').on('click', function() {
        $('#profile_photo_upload').click();
    });

    // $('#profile_photo_upload').on('change', function() {

    //     var user_id = $('#user_id').val();
    //     var ProfilePhoto = $('#profile_photo_upload')[0].files;
    //     var test = ProfilePhoto[0];
    //     console.log(test);

    //     $.ajax({
    //         url: "{{route('create.profilephoto')}}",
    //         enctype: 'multipart/form-data',

    //         Type: "get",
    //         data: {
    //             user_id: user_id,
    //             ProfilePhoto: test
    //         },
    //         cache: false,
    //     contentType: false,
    //     processData: false,
    //         success: function(data) {
    //             console.log(data);
    //             // console.log(ProfilePhoto);
    //         },
    //         error: function() {
    //             console.log(user_id);
    //             console.log(ProfilePhoto);
    //             console.log('Error');
    //         }
    //     });
    // });

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
</div>
</div>

@endsection