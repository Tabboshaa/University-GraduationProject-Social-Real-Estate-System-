@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')
<div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-block p-4">
            <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>How did you find us?</a>
        </div>
        <div class="card-body border-top-xs d-flex">
            <form id="reviewForm" class="form-group" action="{{url('/addReview')}}}">
                @csrf
                <!-- <figure class="avatar position-absolute ms-2 mt-1 top-5"><img src="{{asset('storage/cover page/pic.png')}}" alt="image" class="shadow-sm rounded-circle w30"></figure> -->
                <textarea id="content" name="review_content" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
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
                    <label onclick="review(8)" class="fa  fa-star-o" name="starLabel" for="star8" >
                        <input type="radio" style="display: none;" value="8" name="stars" id="star8">
                    </label>
                    <label onclick="review(9)" class="fa  fa-star-o" name="starLabel" for="star9">
                        <input type="radio" style="display: none;" value="9" name="stars" id="star9">
                    </label>
                    <label onclick="review(10)" class="fa  fa-star-o" name="starLabel" for="star10">
                        <input type="radio" style="display: none;" value="10" name="stars" id="star10">
                    </label>
                </div>
                <input type="hidden" id="item_id" value="{{$item->Item_Id}}">
                <input class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block" type="submit" value="submit review">
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
            <h4 class="fw-700 text-grey-900 font-xssss mt-1"><a href="{{url('veiw_User/'.$review->User_Id)}}">
                    {{$review->First_Name}} {{$review->Middle_Name}} {{$review->Last_Name}}
                </a> <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"><?php $today = \Carbon\Carbon::now();
                                                                                        $end = \Carbon\Carbon::parse($review->updated_at);
                                                                                        ?>{{ $end->diffForHumans($today)}}</span></h4>
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
        <!-- <div class="rating">
                <i class="fa fa-check" aria-hidden="true"></i>
                <span> overall rating </span>
                &nbsp; &nbsp;
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa blue fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
            </div> -->
    </div>
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
    var n = 0;
    $("#reviewForm").submit(function() {

        var review_content = $('#content').val();
        var item_id = $('#item_id').val();
        console.log(review_content);
        console.log(item_id);
        console.log(n);
        $.ajax({
            url: "{{route('review.add')}}",
            Type: "POST",
            data: {
                stars: n,
                id: item_id,
                review_content: review_content
            },
            success: function(data) {
                console.log("Success");
            },
            error: function() {
                console.log('Error');
            }

        });
    });

    function review(starNumber) {
        n = starNumber;
        var content = document.getElementById('content').valueOf();
        console.log("test");
        console.log(content);

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
