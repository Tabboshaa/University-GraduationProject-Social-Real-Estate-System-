@extends('website.backend.layouts.main')
@section('content')

<link href="{{asset('css/ButtonStyle.css')}}" rel="stylesheet" type="text/css" />

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <form method="POST" action="{{ url('/add_item_post/'.$item_id) }}" enctype="multipart/form-data">
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
                        <!-- <button id="btun2" class="btn btn-primary">
                            <a href="{{url('/show_item_schedule/'.$item_id)}}" class="link2">{{ __('Show') }}</a>
                        </button> -->
                    </div>
                </div>
            </form>
        </div>
        <div class="x_panel">
            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-md-7">
                            @if( count($posts) != 0)
                            @foreach($posts as $post)
                            <div name="post">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <?php $today = \Carbon\Carbon::now();
                                        $end = \Carbon\Carbon::parse($post->updated_at);
                                        ?>
                                        <img src="{{asset('FrontEnd/images/icon/user.html')}}" alt="">
                                        <h3>

                                            <p>{{ $end->diffForHumans($today)}}
                                            <a href="{{url('delete_posts/'.$post->Post_Id)}}">
                                                <small><i class="fa fa-trash-o" aria-hidden="true"></i></small>
                                            </a>
                                            </p>
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

                                    <div class="x_content">
                                        {{$post->Post_Title}} <br />
                                        {{$post->Post_Content}} <br />
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="placeform1">
                                        <input type="text" id="CommentForPost{{$post->Post_Id}}" class="form-control" style="font-size: 12pt" name="comment" placeholder="Write your comment...">
                                    </div>
                                    <div>
                                        </br>
                                        <a class="btn btn-info" href="javascript:void(0)" onclick="Comment('{{$post->Post_Id}}');">Comment</a>
                                    </div>

                                </div>
                            </div>
                            @if( isset($comments[$post->Post_Id]) )

                            @foreach($comments[$post->Post_Id] as $comment)
                            <div class="col-md-12">

                                <img src="images/icon/user.jpg" alt="">
                                <p>
                                    {{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                                    <a href="{{url('delete_comment/'.$comment->Comment_Id)}}">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <?php $end = \Carbon\Carbon::parse($comment->updated_at); ?>
                                    </br> <small>{{ $end->diffForHumans($today) }} </small>
                                </p>


                                <div class="x_content">
                                    {{ $comment->Comment }}
                                </div>
                                <div class="clearfix"></div>


                                <div class="placeform1">
                                    <input type="text" id="ReplyForComment{{$comment->Comment_Id}}" class="form-control" style="font-size: 9pt" name="comment" placeholder="Write a reply...">
                                </div>
                                <div>
                                    </br>
                                    <a class="btn btn-info" href="javascript:void(0)" onclick="Reply('{{$post->Post_Id}}','{{$comment->Comment_Id}}');">Reply</a>
                                </div>

                            </div>

                            @if( isset($replies[$comment->Comment_Id]) )
                            @foreach($replies[$comment->Comment_Id] as $reply)
                            <div class="col-md-8">

                                <img src="images/icon/user.jpg" alt="">

                                <p>
                                    {{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                                    <a href="{{url('delete_reply/'.$reply->Comment_Id)}}">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <?php $end = \Carbon\Carbon::parse($reply->updated_at); ?>
                                <p>{{ $end->diffForHumans($today) }} </p>
                                </p>

                                {{ $reply->Comment }}

                                <div class="clearfix"></div>

                            </div>

                            @endforeach
                            @endif

                            @endforeach
                            @endif

                            @endforeach
                            <!-- in case no posts are there yet -->
                            @else
                            <div class=" x_panel">
                                <div class="x_title">
                                    {{ $item->Item_Name }}
                                    </h3>
                                </div>
                                <div class="x_content">
                                    No Posts are posted for this item yet..<br />
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
