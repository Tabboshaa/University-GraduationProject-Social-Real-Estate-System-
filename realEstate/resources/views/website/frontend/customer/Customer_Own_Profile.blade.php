`@extends('website.frontend.layouts.main')
@section('profile')
<link href="{{asset('css/FrontEndCSS/CustomerHome.css')}}" rel="stylesheet" type="text/css" />
<!-- Model -->
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



    <!-- top box -->
    <div class="row">
        <!-- top box -->
        <div class="col-xl-12">
            <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3 overflow-hidden">
                @if(!empty($Cover_Photo))
                <div class="card-body position-relative h240 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$Cover_Photo->Cover_Photo)}}');"></div>
                @else
                <div class="card-body position-relative h240 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/Default1.jpeg')}}');"></div>
                @endif

                <div class="card-body d-block pt-4 text-center position-relative">
                    <figure class="avatar mt--6 position-relative w75 z-index-1 w100 z-index-1 ms-auto me-auto"><img src="{{asset('storage/cover page/'.$Profile_Photo->Profile_Picture)}}" alt="image" class="p-1 bg-white rounded-xl w-100"></figure>
                    <h4 class="font-xs ls-1 fw-700 text-grey-900"> {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}<span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"></span></h4>
                    <div class="d-flex align-items-center pt-0 position-absolute left-15 top-10 mt-4 ms-2">
                        <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{count($posts)}} </b> Posts</h4>
                        <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{count($followedItems)}} </b> following</h4>
                    </div>
                    <div class="d-flex align-items-center justify-content-center position-absolute right-15 top-10 mt-2 me-2">
                        <a href="#" class="p-2 text-center ms-auto menu-icon show" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-bs-toggle="dropdown"><i class="ti-more font-md"></i></a>
                        <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg show" aria-labelledby="dropdownMenu3" style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(567.2px, 76px);" data-popper-placement="bottom-end">

                            @if(!empty($Cover_Photo))
                            <div class="card-body p-0 d-flex">
                                <form method="Post" action="{{url('/DeleteMyCoverPhoto/'.$Cover_Photo->Photo_Id.'/'.$Cover_Photo->Cover_Photo.'?_method=delete')}}" enctype="multipart/form-data">
                                    @csrf
                                    <button class="btn" type="submit"><label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_delete"><i class="feather-trash-2 text-grey-500 me-3 font-sm"></i>Cover Photo</label></button>
                                </form>
                                <form method="POST" action="{{url('/UpdateCoverPhoto')}}" enctype="multipart/form-data">
                                    @csrf
                                    <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload"><i class="feather-edit text-grey-500 me-3 font-sm"></i>Cover Photo</label>
                                    <input id="cover_photo_upload" name="CoverPhoto" type="file" style="display:none" onchange="javascript:this.form.submit();">
                                </form>
                            </div>
                            @else
                            <div class="card-body p-0 d-flex">
                                <form method="POST" action="{{url('/CreateCoverPhoto')}}" enctype="multipart/form-data">
                                    @csrf
                                    <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="cover_photo_upload"><i class="feather-plus text-grey-500 me-3 font-sm"></i>Cover Photo</label>
                                    <input id="cover_photo_upload" name="CoverPhoto" type="file" style="display:none" onchange="javascript:this.form.submit();">
                                </form>
                            </div>
                            @endif
                            {{-- profile photo --}}
                            @if(!empty($Profile_Photo))
                            <div class="card-body p-0 d-flex">
                                <form method="Post" action="{{url('/DeleteMyProfilePhoto/'.$Profile_Photo['Attachment_Id'].'/'.$Profile_Photo['File_Path'].'?_method=delete')}}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="profile_photo_delete"><i class="feather-trash-2 text-grey-500 me-3 font-sm"></i>Profile Photo</label>
                            <input id="profile_photo_delete" name="CoverPhoto" type="file" style="display:none" onchange="javascript:this.form.submit();"> -->
                                    <button class="btn" type="submit"><label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="profile_photo_delete"><i class="feather-trash-2 text-grey-500 me-3 font-sm"></i>Profile Photo</label></button>
                                </form>

                                <form method="POST" action="{{url('/UpdateProfilePhoto')}}" enctype="multipart/form-data">
                                    @csrf
                                    <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="profile_photo_upload"><i class="feather-edit text-grey-500 me-3 font-sm"></i>Profile Photo</label>
                                    <input id="profile_photo_upload" name="ProfilePhoto" type="file" style="display:none" onchange="javascript:this.form.submit();">
                                </form>
                            </div>
                            @else
                            <div class="card-body p-0 d-flex">
                                <form method="POST" action="{{url('/CreateProfilePhoto')}}" enctype="multipart/form-data">
                                    @csrf
                                    <label class="fw-600 text-grey-900 font-xssss mt-0 me-0" for="profile_photo_upload"><i class="feather-plus text-grey-500 me-3 font-sm"></i>Profile Photo</label>
                                    <input id="profile_photo_upload" name="ProfilePhoto" type="file" style="display:none" onchange="javascript:this.form.submit();">
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                    <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('veiw_User'.$id)}}" data-toggle="tab">Profile</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('veiw_User'.$id)}}" data-toggle="tab">Owned items</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('veiw_User'.$id)}}" data-toggle="tab">Followed items</a></li>
                        <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="{{url('veiw_User'.$id)}}" data-toggle="tab">Gallery</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- left box -->
        <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
            <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                <div class="card-body d-block p-4">
                    <h4 class="fw-700 mb-3 font-xsss text-grey-900">Owned items</h4>
                    <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">Items of {{$First_Name}} {{$Middle_Name}} {{$Last_Name}}</p>
                </div>
                <div class="card-body border-top-xs d-flex">
                    <div class=row>
                        @foreach($items as $item)
                        <div class="col-6 mb-2 pe-1">
                            @if($item->coverpage['path'] != null)
                            <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$item->coverpage['path'])}}');"></div>
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
                    <h4 class="fw-700 mb-3 font-xsss text-grey-900">followed items</h4>
                    <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">Items {{$First_Name}} {{$Middle_Name}} {{$Last_Name}} follows</p>
                </div>
                <div class="card-body border-top-xs d-flex">
                    <div class=row>
                        @foreach($followedItems as $item)
                        <div class="col-6 mb-2 pe-1">
                            @if($item->item->coverpage['path'] != null)
                            <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/'.$item->item->coverpage['path'])}}');"></div>
                            @else
                            <div class="card-body position-relative h90 bg-image-cover bg-image-center" style="background-image: url('{{asset('storage/cover page/Default1.jpeg')}}');"></div>
                            @endif
                            <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="{{url('/itemProfile/'.$item->item->Item_Id)}}" data-toggle="tab">{{$item->item->Item_Name}}</a>
                            @if(count($item->item->checkfollow) == 0)
                            <a href="{{url('/FollowItem/'.$item->item->Item_Id)}}"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            @else
                            <a href="{{url('/UnfollowItem/'.$item->item->Item_Id)}}"> <i class="fa fa-heart" aria-hidden="true"></i></a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                <div class="card-body d-flex align-items-center  p-4">
                    <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
                    <a href="" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                </div>
                <div class="card-body d-block pt-0 pb-2">
                    @if( count($gallery) != 0)
                    <div class=row>
                        @foreach($gallery as $Image)
                        <div class="col-6 mb-2 pe-1"><a href="{{asset('storage/profile gallery/'.$Image->File_Path)}}" data-lightbox="roadtrip"><img src="{{asset('storage/profile gallery/'.$Image->File_Path)}}" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                        @endforeach
                    </div>
                    <div class="card-body d-block w-100 pt-0">
                        <a href="" class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i class="feather-external-link font-xss me-2"></i> More</a>
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

        <!-- right box that has posts -->
        <div class="col-xl-8 col-xxl-9 col-lg-8">

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
                        @if($User_Id== $post->User_Id )
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
                                    <a href="{{url('veiw_User/'.$comment->User_Id)}}">
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->user->First_Name}} {{$comment->user->Middle_Name}} {{$comment->user->Last_Name}}
                                            @if($User_Id== $comment->User_Id )
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
                                        <a href="{{url('veiw_User/'.$reply->User_Id)}}">
                                            <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->user->First_Name}} {{$reply->user->Middle_Name}} {{$reply->user->Last_Name}}
                                                @if($User_Id== $reply->User_Id )
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

    @endsection