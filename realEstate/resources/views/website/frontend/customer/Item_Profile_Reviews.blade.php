@extends('website.frontend.customer.Item_Profile')
@section('profile_Content')
<div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-block p-4">
            @if($AuthReview!=null)
            <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>This is your Review Do you want to Change it? </a>
        
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
                    <input type="hidden" id="itemid" name="item_id" value="{{$itemID}}">
                    <input type="hidden" id="stars" name="stars" value="">
                    @if($AuthReview!=null)
                    <h6>{{$AuthReview->Number_Of_Stars}}/5</h6>
                    @endif
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
        
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500  lh-26 font-xssss w-100">
                {{$review->Review_Title}} <br />
                {{$review->Review_Content}} <br />
            </p>
            <div class="ms-auto">
                </div>
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
        </div>
        @endif
        <small>  {{$review->Number_Of_Stars}} <span>/5 </span><i class="feather-star  me-2"></i></small>
        
        @include('website.frontend.customer.ReplyComments')
        
    </div>
    @endforeach

    @else
    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            <p style="margin-left: 180px;" class="fw-500  lh-26 font-xss w-100">
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
            x[i].className = "feather-star  ";
        }
        for (i = 0; i < starNumber; i++) {
            x[i].className = " text-success  feather-star ";
        }
    }
</script>



@endsection