@extends('website.frontend.layouts.main')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Banner -->
        <div class="dashboard">
            <div class="advertisment-banner1 col-md-12">
                <img src="{{asset('FrontEnd/images/banner/r-bg.jpg')}}" alt="" title="">
            </div>
            <div class="main-page">
                <div class=" dash-profile">
                    <img src="{{asset('FrontEnd/images/banner/r-dp.jpg')}}" alt="">
                </div>
                <div class="prompr">
                    <ul class="widths">
                        <li class="number"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; +91 1234 567 890</li>
                        <li class="number"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Location here...</li>
                        <li class="saved">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <a href="#">saved</a>
                        </li>
                        <li class="Reivew">
                            <a href="#">Add Review </a>
                        </li>
                        <li class="borders"><i class="fa fa-share-alt" aria-hidden="true"></i></li>
                        <li class="borders"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></li>
                    </ul>
                    <div class="dashname">
                        House title name here
                        <p>@ auther_name</p>
                    </div>
                    <div class="Author">
                        <a href="#">Messages to Author</a>
                    </div>
                    <div class="promote">
                        <a href="#">Promote</a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>

        <!-- Banner Area-->
        <div class="settingmenu">
            <div class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse  visible-title" id="navbarNav">
                    <ul class="navbar-nav ">
                        <li>
                            <a href="#">Posts </a>
                        </li>
                        <li>
                            <a href="#">Detail </a>
                        </li>
                        <li>
                            <a href="#">Review </a>
                        </li>
                        <li>
                            <a href="#">Gallery </a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-7">
                <div name="post">
                    @foreach($posts as $post)
                    <div class=" locatins">
                        <div class="heading1">
                            <img src="{{asset('FrontEnd/images/icon/user.html')}}" alt="">
                            <h3>
                                John Doe
                                <p>jan 2, 2019 at 7.00 pm</p>
                            </h3>
                        </div>

                        <div class="sub-heading">
                        {{$post->Post_Title}} <br/>
                           {{$post->Post_Content}} <br />
                        </div>
                        <div class="clearfix"></div>

                        <div class="placeform1">
                            <input type="text" name="comment" placeholder="Write your comment...">
                            <a href="#">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="addbtn1">
                            <a href="javascript:void(0)" onclick="">Comment</a>
                        </div>
                    </div>
                    <script>
                        <?php $comments = App\Http\Controllers\CommentsController::getPostComments($post->Post_Id) ?>;
                    </script>

                    @if(count($comments) != 0)

                    @foreach($comments as $comment)
                    <div class=" locatins">
                        <div class="heading1">
                            <img src="images/icon/user.jpg" alt="">
                            <h3>

                                John Doe <p>jan 2, 2019 at 7.00 pm</p>
                            </h3>
                        </div>
                        <div class="reply">
                            <a href="#">Reply</a>
                        </div>
                        <div class="sub-heading">
                            {{ $comment->Comment }}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <script>
                        <?php $replies = App\Http\Controllers\CommentsController::getPostreplies($post->Post_Id) ?>;
                    </script>
                    @if(count($replies) != 0)

                    @foreach($replies as $reply)
                    <div class="col-md-8">
                    <div class=" locatins">
                        <div class="heading1">
                            <img src="images/icon/user.jpg" alt="">
                            <h3>

                                John Doe <p>jan 2, 2019 at 7.00 pm</p>
                            </h3>
                        </div>
                        <div class="sub-heading">
                            {{ $reply->Comment }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                </div>
                @endforeach
                @endif

                @endforeach
                @endif
                @endforeach
            </div>
            <div class="col-md-5">
                <div class="box-left">
                    <div class="rightboxs">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <span>Price</span>
                        <p>For Monthly Sale </br />
                            $55,500,000
                        </p>
                    </div>
                </div>
                <div class="box-left">
                    <div class="rightboxs">
                        <img src="images/banner/Icon4.png" alt="">
                        <span>Author</span>
                        <p><a href="#">@authorname </a></p>
                    </div>
                </div>
                <div class="box-left">
                    <div class="rightboxs">
                        <img src="images/banner/Icon9.png" alt="">
                        <span>Follow Us</span>
                        <p>
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-lastfm-square" aria-hidden="true"></i></a>
                        </p>
                    </div>
                </div>
                <div class="box-left">
                    <div class="rightboxs">
                        <img src="images/banner/Icon9.png" alt="">
                        <span>Region</span>
                        <p>India</p>
                    </div>
                </div>
                <div class="box-left">
                    <div class="rightboxs">
                        <img src="images/banner/Icon6.png" alt="">
                        <span>Categories</span>
                        <p>Place and Event Cafe</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
