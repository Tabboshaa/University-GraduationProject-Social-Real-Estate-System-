@extends('website.backend.layouts.main')
@section('content')

<div class="right_col" role="main">
    <div class="title_right">
        <h4 class="heading" style="color: black;"><strong>Item Reviews</strong></h4>
        @if(count($reviews))
        @foreach($reviews as $review)
        <div class="x_panel">
            @include('website.backend.layouts.flashmessage')
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">
                  <!-- start recent activity -->
                  <ul class="messages">
                    <li>
                        <?php $today = \Carbon\Carbon::now();
                                $end = \Carbon\Carbon::parse($review->updated_at);
                        ?>
                      <img src="{{asset('storage/cover page/Shaimaaa.JPG')}}"  class="avatar" alt="Avatar">
                      <div class="message_date" >
                        <a href="{{url('delete_review/'.$review->Review_Id)}}" onclick="return confirm('Are you sure you want to delete?')">
                            <small><i class="fa fa-trash-o" style="font-size: 1.7em;"aria-hidden="true"></i></small>
                        </a>
                      </div>
                      <div class="message_wrapper">
                        <h6 style="color: black;"><strong>{{$review->First_Name}} {{$review->Middle_Name}} {{$review->Last_Name}}</strong></h6>
                        <p style="color: rgb(85, 85, 85);">{{ $end->diffForHumans()}} </p>
                        <blockquote class="message" style="color: black; ">
                            {{$review->Review_Title}} <br />
                            {{$review->Review_Content}} <br />
                        </blockquote>
                        <br />
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          
                          <i class="fa fa-star" aria-hidden="true"> </i> {{$review->Number_Of_Stars}} <span>/10</span>
                      </div>
                    </li>
                   
                  </ul>
                  <!-- end recent activity -->

                </div>
              </div>
        </div>
        @endforeach
        @else
        <div class=" x_panel">
            <div class="x_content">
                No Reviews are posted for this item yet..<br />
            </div>
            <div class="clearfix"></div>
        </div>
        @endif
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
