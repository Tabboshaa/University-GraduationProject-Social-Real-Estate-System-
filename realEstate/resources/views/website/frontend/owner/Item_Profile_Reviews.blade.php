@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')

<div class="row">
    <div class="col-md-7">
     @foreach($reviews as $review)
        <div class=" locatins">
            <div class="heading1">
            <?php $today = \Carbon\Carbon::now();
                    $end = \Carbon\Carbon::parse($review->updated_at);
                    ?>
                <img src="images/icon/user.html" alt="">
                <h3>
                {{$review->First_Name}} {{$review->Middle_Name}} {{$review->Last_Name}}
                        <p>{{ $end->diffForHumans($today)}} </p>
                </h3>
            </div>
            <div class="rightmais">
            {{$review->Number_Of_Stars}} <span>/10</span>
            </div>
            <div class="sub-heading">
            {{$review->Review_Title}} <br />
                    {{$review->Review_Content}} <br />
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

            <div class="clearfix"></div>
        </div>
        @endforeach

    </div>
    <div class="col-md-5">
        <div class="box-left">
            <div class="rightboxs">
                <img src="images/icon/view.png" alt="">
                <span>add review</span>
                <form id="reviewForm">
                    @csrf
                    <div class="rating margin">
                        <span> overall rating </span>
                        &nbsp; &nbsp;
                        <label onclick="review(1)" class="fa  fa-star-o" name="starLabel" for="star1">
                            <input type="radio" value="1" name="stars" id="star1">
                        </label>
                        <label onclick="review(2)" class="fa  fa-star-o" name="starLabel" for="star2">
                            <input type="radio" value="2" name="stars" id="star2">
                        </label>
                        <label onclick="review(3)" class="fa  fa-star-o" name="starLabel" for="star3">
                            <input type="radio" value="3" name="stars" id="star3">
                        </label>
                        <label onclick="review(4)" class="fa  fa-star-o" name="starLabel" for="star4">
                            <input type="radio" value="4" name="stars" id="star4">
                        </label>
                        <label onclick="review(5)" class="fa  fa-star-o" name="starLabel" for="star5">
                            <input type="radio" value="5" name="stars" id="star5">
                        </label>
                        <label onclick="review(6)" class="fa  fa-star-o" name="starLabel" for="star6">
                            <input type="radio" value="6" name="stars" id="star6">
                        </label>
                        <label onclick="review(7)" class="fa  fa-star-o" name="starLabel" for="star7">
                            <input type="radio" value="7" name="stars" id="star7">
                        </label>
                        <label onclick="review(8)" class="fa  fa-star-o" name="starLabel" for="star8">
                            <input type="radio" value="8" name="stars" id="star8">
                        </label>
                        <label onclick="review(9)" class="fa  fa-star-o" name="starLabel" for="star9">
                            <input type="radio" value="9" name="stars" id="star9">
                        </label>
                        <label onclick="review(10)" class="fa  fa-star-o" name="starLabel" for="star10">
                            <input type="radio" value="10" name="stars" id="star10">
                        </label>

                    </div>
                    <div class="rightboxes">
                        <h3>your message</h3>
                        <textarea id="content" name="review_content">enter message...</textarea>
                        <input type="hidden" id="item_id" value="{{$item->Item_Id}}">
                        <input type="submit" value="submit review">

                    </div>
                </form>
            </div>

        </div>




    </div>
</div>
<script>
    var n=0;
    $("#reviewForm").submit(function() {

        var review_content=$('#content').val();
        var item_id=$('#item_id').val();
        $.ajax({
            url: "{{route('review.add')}}",
            Type: "POST",
            data: {
               stars:n,
               id:item_id,
               review_content:review_content
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
            x[i].className = "fa fa-star-o";
        }
        for (i = 0; i < starNumber; i++) {
            x[i].className = "fa blue fa-star-o";
        }
    }


    function Comment(post_id) {

        var comment = $("#CommentForReview" + post_id).val();

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
