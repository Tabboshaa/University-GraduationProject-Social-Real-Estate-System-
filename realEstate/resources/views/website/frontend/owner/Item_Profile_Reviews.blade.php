@extends('website.frontend.owner.Item_Profile')
@section('profile_Content')

<div class="col-xl-12">
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
        <small>  {{$review->Number_Of_Stars}} <span>/5 </span> </span><i class="feather-star  me-2"></i></small>
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
        </div>
        @endif
        @include('website.frontend.customer.ReplyComments')

        @endforeach
      
        @else
        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
            <div class="card-body p-0 d-flex">
                <p style="margin-left: 360px;" class="fw-500 text-grey-500 lh-26 font-xss w-100">
                    There is No Reviwes Yet!
                </p>
            </div>
            <div class="card-body p-0 d-flex">
                <div style="margin-left: 120px;" class="col-xs-6 col-sm-6 p-1"><img src="{{asset('storage/profile gallery/bg-2.png')}}" class="rounded-3 w-100" alt="image"></div>
            </div>
        </div>
        @endif

    </div>
</div>


<script>
    var n = 0;
    // $("#reviewForm").submit(function() {

    //     var review_content = $('#content').val();
    //     var item_id = $('#item_id').val();
    //     console.log(review_content);
    //     console.log(item_id);
    //     console.log(n);
    //     $.ajax({
    //         url: "{{route('review.add')}}",
    //         Type: "POST",
    //         data: {
    //             stars: n,
    //             id: item_id,
    //             review_content: review_content
    //         },
    //         success: function(data) {
    //             console.log("Success");
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
        
         $('#stars').val(n);
         var s=$('#stars').val();
        console.log(s);

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