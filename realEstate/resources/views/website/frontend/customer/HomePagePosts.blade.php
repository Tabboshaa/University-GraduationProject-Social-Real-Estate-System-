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
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="{{url('/HomePage')}}" data-toggle="tab">items</a></li>
                    <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('/HomepageUserPosts')}}" data-toggle="tab">Followed users</a></li>
                </ul>
            </div>
        </div>


        @if( count($posts) != 0)
        @foreach($posts as $post)
        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
            <div class="card-body p-0 d-flex">
                @if($post->path!=null)
                <figure class="avatar me-3"><img src="{{asset('storage/cover page/'.$post->path)}}" alt="image" class="shadow-sm rounded-circle w45" height="45"></figure>
                @else
                <figure class="avatar me-3"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w45" height="45"></figure>
                @endif

                <h4 class="fw-700 text-grey-900 font-xssss mt-1"><a href="{{url('/itemProfile/'.$post->Item_Id)}}">
                        {{ $post->Item_Name }}
                        @if($User->id== $post->User_Id )
                        <a href="{{url('/deletePost/'.$post->Post_Id)}}" name="del_post" id="del_post"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                        <a name="editpost" href="javascript:void(0)" onclick="setPost('{{$post->Post_Id}}','{{$post->Post_Content}}')"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
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

            @include('website.frontend.customer.Comments')

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
    <div class="col-xl-12">
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

    </script>

@endsection