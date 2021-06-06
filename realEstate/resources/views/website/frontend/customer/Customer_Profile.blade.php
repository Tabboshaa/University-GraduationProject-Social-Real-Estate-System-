@extends('website.frontend.layouts.main')
@section('content')
<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
            <div class="advertisment-banner1 col-md-12">
            @if(!empty($Cover_Photo))

             <img class="background" height="600" src="{{asset('FrontEnd/images/coverpage/'.$Cover_Photo)}}" alt="">
             @endif
            </div>
            <div class="main-page">
                <div class=" dash-profile">
                    <img class="profile" height="600"src="{{asset('FrontEnd/images/coverpage/'.$Cover_Photo)}}" alt="">
                </div>
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
        <form method="POST" action="{{ url('/') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="Post_Title" class="col-md-2 col-form-label text-md-right" style="font-size: 12pt">
                        {{ __('Post Title:') }}
                    </label>
                    <div class="col-md-2">
                        <input style="border-radius: 3pt" type="text" class="form-control @error('Post_Title') is-invalid @enderror" name="Post_Title" value="{{ old('Post_Title') }}" required autocomplete="Post_Title">
                        @error('Post_Title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

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
                    <input type="file" class="form-control" name="images[]" placeholder="upload Images" multiple>
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

                    </div>
                </div>
            </form>
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
                        <p><a href="#">@ {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}</a></p>
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
        </script>

    </div>
</div>

@endsection
