@extends('website.frontend.customer.Item_Profile')
@section('profile_Content')
<div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-block p-4">
            @if($AuthReview!=null)
            <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>This is your Review Do you want to Change it? </a>
            <h6>{{$AuthReview->Number_Of_Stars}}/10</h6>
            @else
            <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>How did you find us?</a>
            @endif
        </div>
        <div class="card-body border-top-xs d-flex">

            <form id="reviewForm" class="form-group" action="{{route('review.add')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <!-- <figure class="avatar position-absolute ms-2 mt-1 top-5"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w30"></figure> -->
                @if($AuthReview!=null)
                <textarea id="content" value="{{$AuthReview->Number_Of_Stars}}" placeholder="" name="review_content" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10">{{$AuthReview->Review_Content}}</textarea>
                @else
                <textarea id="content" value="" name="review_content" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                @endif

                <div class="rating margin">
                    <span> overall rating </span>
                    &nbsp; &nbsp;
                    <i onclick="review(1)" class="fa  fa-star-o" name="starLabel" for="star1">
                        <input type="radio" style="display: none;" value="1" name="stars" id="star1">
                    </i>
                    <label onclick="review(2)" class="fa  fa-star-o" name="starLabel" for="star2">
                        <input type="radio" style="display: none;" value="2" name="stars" id="star2">
                    </label>
                    <label onclick="review(3)" class="fa  fa-star-o" name="starLabel" for="star3">
                        <input type="radio" style="display: none;" value="3" name="stars" id="star3">
                    </label>
                    <label onclick="review(4)" class="fa  fa-star-o" name="starLabel" for="star4">
                        <input type="radio" style="display: none;" value="4" name="stars" id="star4">
                    </label>
                    <label onclick="review(5)" class="fa  fa-star-o" name="starLabel" for="star5">
                        <input type="radio" style="display: none;" value="5" name="stars" id="star5">
                    </label>
                    <label onclick="review(6)" class="fa  fa-star-o" name="starLabel" for="star6">
                        <input type="radio" style="display: none;" value="6" name="stars" id="star6">
                    </label>
                    <label onclick="review(7)" class="fa  fa-star-o" name="starLabel" for="star7">
                        <input type="radio" style="display: none;" value="7" name="stars" id="star7">
                    </label>
                    <label onclick="review(8)" class="fa  fa-star-o" name="starLabel" for="star8">
                        <input type="radio" style="display: none;" value="8" name="stars" id="star8">
                    </label>
                    <label onclick="review(9)" class="fa  fa-star-o" name="starLabel" for="star9">
                        <input type="radio" style="display: none;" value="9" name="stars" id="star9">
                    </label>
                    <label onclick="review(10)" class="fa  fa-star-o" name="starLabel" for="star10">
                        <input type="radio" style="display: none;" value="10" name="stars" id="star10">
                        <input type="hidden" id="itemid" name="item_id" value="{{$itemID}}">
                        <input type="hidden" id="stars" name="stars" value="">
                    </label>
                </div>
                <div class="card-body d-flex p-2 mt-0">
                    <label for="uploadImages" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4 pt-2"><i class="font-md text-success feather-image me-2"></i><span class="d-none-xs">Add Photo</span></label>
                    <input type="file" style="display:none;" id="uploadImages" name="images[]" accept="image/*" placeholder="upload Images" multiple>
                    <a href="javascript:void(0);" onclick="document.getElementById('reviewForm').submit(); return false;" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i class="font-md text-success feather-check-circle me-2"></i><span class="d-none-xs">Submit Review</span></a>
                </div>
                <!-- <input class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block" type="submit" value="submit review"> -->
            </form>
        </div>
    </div>
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3" style="display:none;">
        <div class="card-body d-flex align-items-center  p-4">
            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
            <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
        </div>
        <div class="card-body d-block pt-0 pb-2">
            <div class="row">
                <div class="col-6 mb-2 pe-1"><a href="images/e-2.jpg" data-lightbox="roadtrip"><img src="images/e-2.jpg" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                <div class="col-6 mb-2 ps-1"><a href="images/e-3.jpg" data-lightbox="roadtrip"><img src="images/e-3.jpg" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                <div class="col-6 mb-2 pe-1"><a href="images/e-4.jpg" data-lightbox="roadtrip"><img src="images/e-4.jpg" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                <div class="col-6 mb-2 ps-1"><a href="images/e-5.jpg" data-lightbox="roadtrip"><img src="images/e-5.jpg" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                <div class="col-6 mb-2 pe-1"><a href="images/e-2.jpg" data-lightbox="roadtrip"><img src="images/e-2.jpg" alt="image" class="img-fluid rounded-3 w-100"></a></div>
                <div class="col-6 mb-2 ps-1"><a href="images/e-1.jpg" data-lightbox="roadtrip"><img src="images/e-1.jpg" alt="image" class="img-fluid rounded-3 w-100"></a></div>
            </div>
        </div>
        <div class="card-body d-block w-100 pt-0">
            <a href="#" class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i class="feather-external-link font-xss me-2"></i> More</a>
        </div>
    </div>
</div>
<div class=" col-xl-8 col-xxl-9 col-lg-8">
    @if( count($reviews) != 0)
    @foreach($reviews as $review)
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            <figure class="avatar me-3"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w45"></figure>
            <?php $today = \Carbon\Carbon::now();
            $end = \Carbon\Carbon::parse($review->updated_at);
            ?>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><a href="{{url('view_User/'.$review->User_Id)}}">
                    {{$review->First_Name}} {{$review->Middle_Name}} {{$review->Last_Name}}
                </a> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"><?php $today = \Carbon\Carbon::now();
                                                                                        $end = \Carbon\Carbon::parse($review->updated_at);
                                                                                        ?>{{ $end->diffForHumans()}}</span></h4>
        </div>
        <div class="ms-auto">
            {{$review->Number_Of_Stars}} <span>/10</span>
        </div>
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                {{$review->Review_Title}} <br />
                {{$review->Review_Content}} <br />
            </p>
        </div>

        @if( isset($post_images[$review->Review_Id]) )
        <div class="card-body d-block p-0">
            <div class="row ps-2 pe-2">
                @if(count($post_images[$review->Review_Id])==1)
                @foreach($post_images[$review->Review_Id] as $Image)
                <div class="col-sm-12 p-1"><a href="{{asset('storage/profile gallery/'.$Image->path)}}" data-lightbox="roadtr"><img src="{{asset('storage/profile gallery/'.$Image->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                @endforeach
                @elseif(count($post_images[$review->Review_Id])==2)
                @foreach($post_images[$review->Review_Id] as $Image)
                <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$Image->path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$Image->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                @endforeach
                @elseif(count($post_images[$review->Review_Id])==3||count($post_images[$review->Review_Id])==4)
                @foreach($post_images[$review->Review_Id] as $Image)
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$Image->path)}}" data-lightbox="roadtrip"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$Image->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                @endforeach
                @elseif(count($post_images[$review->Review_Id])==5)
                @foreach($post_images[$review->Review_Id] as $Image)
                <!-- two med -->
                <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][0]->path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][0]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][1]->path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][1]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <!-- two small -->
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][2]->path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][2]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][3]->path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][3]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][4]->path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][4]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                @endforeach
                @else
                <!-- two med -->
                <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][0]->path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][0]->path)}}" class="rounded-3 w-100" alt="image" width="220px" hieght="142px"></a></div>
                <div class="col-xs-6 col-sm-6 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][1]->path)}}" data-lightbox="roadtri"><img style="max-height: 370px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][1]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <!-- two small -->
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][2]->path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][2]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][3]->path)}}" data-lightbox="roadtrip"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][3]->path)}}" class="rounded-3 w-100" alt="image"></a></div>
                <!-- the span -->
                <div class="col-xs-4 col-sm-4 p-1"><a href="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][3]->path)}}" data-lightbox="roadtri" class="position-relative d-block"><img style="max-height: 220px;" src="{{asset('storage/profile gallery/'.$post_images[$review->Review_Id][4]->path)}}" class="rounded-3 w-100" alt="image"><span class="img-count font-sm text-white ls-3 fw-600"><b>+{{(-5+count($post_images[$review->Review_Id]))}}</b></span></a></div>
                @endif
            </div>
            @endif
        </div>
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
            <div id="allcomments{{$review->Review_Id}}" style="display: none;">
                <div class="chat-body p-3 ">
                    <div class="messages-content pb-5">
                        @foreach($comments[$review->Review_Id] as $comment)
                        <div class="card-body border-top-xs pt-4 pb-3 pe-4 d-block ps-5">
                            @if($comment->Profile_Picture!=null)
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$comment->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w40" height="40"></figure>
                            @else
                            <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                            @endif
                            <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                <a href="{{url('view_User/'.$comment->User_Id)}}">
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$comment->First_Name}} {{$comment->Middle_Name}} {{$comment->Last_Name}}
                                </a> @if($User->id== $comment->User_Id )
                                <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                                <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                                @endif</h4>
                                <div class="time"><?php $end = \Carbon\Carbon::parse($comment->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0"> {{ $end->diffForHumans() }}</p>
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
                            <a href="javascript:void(0)" onclick="Reply('{{$review->Review_Id}}','{{$comment->Comment_Id}}');"><i class="btn-round-sm bg-primary-gradiant text-white font-sm ti-arrow-right text-blue"></i></a>
                        </div>
                        @if( isset($replies[$comment->Comment_Id]) )
                        <div id="allreplies{{$comment->Comment_Id}}" style="display: none;">
                            @foreach($replies[$comment->Comment_Id] as $reply)
                            <div class="card-body pt-0 pb-3 pe-4 d-block ps-5 ms-5 position-relative">
                                @if($reply->Profile_Picture!=null)
                                <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/'.$reply->Profile_Picture)}}" alt="image" class="shadow-sm rounded-circle w40" height="40"></figure>
                                @else
                                <figure class="avatar position-absolute left-0 ms-2 mt-1"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w35"></figure>
                                @endif <div class="chat p-3 bg-greylight rounded-xxl d-block text-left theme-dark-bg">
                                    <a href="{{url('view_User/'.$reply->User_Id)}}">
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-0 mb-1">{{$reply->First_Name}} {{$reply->Middle_Name}} {{$reply->Last_Name}}
                                    </a> @if($User->id== $reply->User_Id )
                                    <a href="{{url('/deletecomment/'.$comment->Comment_Id)}}" name="del_Comment" id="del_Comment"><i class="feather-trash-2 text-grey-500 me-0 font-xs"></i></a>
                                    <a href="javascript:void(0)" onclick="setComment('{{$comment->Comment_Id}}','{{$comment->Comment}}')" name="editComment" id="edit_Comment"><i class="feather-edit text-grey-500 me-0 font-xs"></i></a>
                                    @endif</h4>
                                    <div class="time"><?php $end = \Carbon\Carbon::parse($reply->updated_at); ?><p class="fw-500 text-grey-500 lh-20 font-xssss w-100 mt-2 mb-0">{{ $end->diffForHumans() }}</p>
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
            @endforeach

            @else
            <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                <div class="card-body p-0 d-flex">
                    <p style="margin-left: 180px;" class="fw-500 text-grey-500 lh-26 font-xss w-100">
                        Be the first to review us!
                    </p>
                </div>
                <div class="card-body p-0 d-flex">
                    <div style="margin-left: 120px;" class="col-xs-6 col-sm-6 p-1"><img src="{{asset('storage/profile gallery/bg-2.png')}}" class="rounded-3 w-100" alt="image"></div>
                </div>
            </div>
            @endif

        </div>



        <script>
            var AuthReviewStars = document.getElementById('content').name;
            console.log(AuthReviewStars);
            if (AuthReviewStars != null) {
                review(AuthReviewStars);
            }
            var n = 0;
            // $("#reviewForm").submit(function() {

            //     var review_content = $('#content').val();
            //     var item_id =document.getElementById('itemid').value;
            //     console.log(review_content);
            //     console.log(item_id);
            //     console.log(n);
            //     $.ajax({
            //         url: "{{route('review.add')}}",
            //         Type: "POST",
            //         data: {
            //             stars: n,
            //             id: item_id,
            //             review_content: 
            //         },
            //         success: function(data) {
            //             console.log(data);
            //         },
            //         error: function() {
            //             console.log('Error');
            //         }

            //     });
            // });


            function review(starNumber) {
                n = starNumber;
                var content = document.getElementById('content').valueOf();
                console.log("test");
                console.log(content);

                $('stars').val(n);
                var i, x = document.getElementsByName("starLabel");

                for (i = 0; i < x.length; i++) {
                    x[i].className = "font-md  feather-star  me-2";
                }
                for (i = 0; i < starNumber; i++) {
                    x[i].className = "font-md text-success  feather-star  me-2";
                }
            }
        </script>



        @endsection