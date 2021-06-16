@extends('website.backend.layouts.main')
@section('content')

<div class="right_col" role="main">
    <div class="title_right">
        <div class="x_panel">
            <h2>Item Reviews</h2>
            @include('website.backend.layouts.flashmessage')
            @foreach($reviews as $review)
            <div class="x_panel">
                <div class="x_title">
                    <?php $today = \Carbon\Carbon::now();
                    $end = \Carbon\Carbon::parse($review->updated_at);
                    ?>
                    <img src="images/icon/user.html" alt="">
                    <h6>
                        {{$review->First_Name}} {{$review->Middle_Name}} {{$review->Last_Name}}
                        <a href="{{url('delete_review/'.$review->Review_Id)}}">
                            <small><i class="fa fa-trash-o" aria-hidden="true"></i></small>
                        </a>
                        <p>{{ $end->diffForHumans($today)}} </p>
                    </h6>
                </div>
                <div class="">
                    {{$review->Number_Of_Stars}} <span>/10</span>
                </div>
                <div class="">
                    {{$review->Review_Title}} <br />
                    {{$review->Review_Content}} <br />
                </div>

                <div class="clearfix"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    var n = 0;
    $("#reviewForm").submit(function() {

        var review_content = $('#content').val();
        var item_id = $('#item_id').val();
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
            x[i].className = "fa fa-star-o";
        }
        for (i = 0; i < starNumber; i++) {
            x[i].className = "fa blue fa-star-o";
        }
    }
 </script>



@endsection
