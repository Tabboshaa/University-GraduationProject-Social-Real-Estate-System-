<nav class="navbar navbar-expand-md navbar-light fixed-top sticky-top nav-menu">

    <div class="col-md-2 col-xs-12 p-left  p-right">

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo">
            <a href="#">
                <img src="{{asset('FrontEnd/images/header/logo.png')}}" alt="logo">
            </a>
        </div>
    </div>
    <!-- Navbar -->
    <div class="col-md-5 col-xs-12 p-left  p-right">
        <div class="searching">
            <form action="{{url('search_by_place')}}">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                <input type="text" list="states" name="search" placeholder="Search for item by state">
                <datalist id="states">

                </datalist>
            </form>
        </div>
    </div>


    <div class="col-md-5 col-xs-12 p-left p-right">
        <div id="checkIfOwnerDiv">
            <div class="add-listing">
                <a href="javascript:void(0)" onclick="ToggleBeOwnerModal()">
                    <img src="{{asset('FrontEnd/images/header/plus-ico.png')}}" alt=''>Continue As Owner </a>
            </div>
        </div>
        <div class="home">
            <ul>
                <li>
                    <a href="{{url('/HomePage')}}"><img src="{{asset('FrontEnd/images/header/home.png')}}" alt="" title="">
                        <span>0</span>
                    </a>
                </li>
                <li class="popup" onclick="myFunctionmsg()">
                    <img src="{{asset('FrontEnd/images/header/mgs.png')}}" alt="" title="">
                    <span>0</span>
                    <div class="popuptext" id="message">
                        <div class="notfication-details">
                            <div class="noty-user-img">
                                <img src="{{asset('FrontEnd/images/resources/ny-img1.png')}}" alt="">
                            </div>
                            <div class="notification-info">
                                <h5><a href="message.html">Jassica William</a>
                                    Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit,</h5>
                                <p>2 min ago</p>
                            </div>
                            <!--notification-info -->
                        </div>
                        <div class="notfication-details">
                            <div class="noty-user-img">
                                <img src="{{asset('FrontEnd/images/resources/ny-img1.png')}}" alt="">
                            </div>
                            <div class="notification-info">
                                <h5><a href="message.html">Jassica William</a>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    .</h5>
                                <p>2 min ago</p>
                            </div>
                            <!--notification-info -->
                        </div>

                        <div class="notfication-details">
                            <div class="noty-user-img">
                                <img src="{{asset('FrontEnd/images/resources/ny-img1.png')}}" alt="">
                            </div>
                            <div class="notification-info">
                                <h5><a href="message.html">Jassica William</a>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                </h5>
                                <p>2 min ago</p>
                            </div>
                            <!--notification-info -->
                        </div>

                    </div>

                </li>
                <?php

                use App\Http\Controllers\NotificationController;
                use Illuminate\Support\Facades\Auth;

                $notifications = NotificationController::index(Auth::id());
                $today = \Carbon\Carbon::now();
                ?>
                <li class="popup" onclick="myFunctionicon()">
                    <img src="{{asset('FrontEnd/images/header/notification.png')}}" alt="" title="">

                    <span>{{count($notifications)}}</span>
                    <!-- do by javascript -->
                    <div class="popuptext visible-title" id="icon">
                        @foreach($notifications as $notification)
                        <div class="notfication-details visible-title">
                            <div class="noty-user-img visible-title">
                                <img src="images/resources/ny-img1.png" alt="">
                            </div>
                            <div class="notification-info visible-title">
                                <a href="{{ url('/veiw_notification/'.$notification->Notification_Id) }}"> <i class="fa fa-close"></i></a>
                                <h3><a href="{{ url('/veiw_User/'.$notification->id) }}"> {{$notification->First_Name}} {{$notification->Middle_Name}} {{$notification->Last_Name}}</a> </h3>
                                <h3 style="font-size: 10px;">
                                    <p>{{ $notification->Notification }} </p>
                                </h3>
                                <?php $end = \Carbon\Carbon::parse($notification->updated_at); ?>
                                <p>{{ $end->diffForHumans($today) }}</p>
                            </div>
                            <!--notification-info -->
                        </div>
                        @endforeach
                        <p><a href="{{ url('/show_notifications') }}">Click here to view all notifications</a></p>
                    </div>
                </li>
            </ul>
        </div>
        <!--#Home-->
        <div class="login popup" onclick="signin()">

            <img src="{{asset('FrontEnd/images/header/u-icon.png')}}" title="" alt="">
            {{\Illuminate\Support\Facades\Auth::user()->First_Name }}
            <div class="popuptext1" id="signin">
                <div class="notfication-details">
                    <div class="notification-info">
                        <a href="{{url('/EditCustomerProfile')}}">Profile </a>

                    </div>
                </div>
                <div class="notfication-details">
                    <div class="notification-info">
                        <a href="my_profile_dashboard.html">Dashboard</a>
                    </div>
                </div>
                @if (Route::has('login'))
                <div class="notfication-details">
                    <div class="notification-info">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <!--notification-info -->
                    @else
                    <div class="notfication-details">
                        <div class="notification-info">
                            <a href="signin.html">Sign In</a>
                        </div>
                        <!--notification-info -->
                    </div>
                    @endif

                </div>
            </div>

        </div>

    </div>
    </div>
</nav>
<div class="modal fade" id="BeOwnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Need more information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/'.Auth::id())}}">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label style="font-size: 12pt">First Name</label>
                        <input type="text" style="border-radius: 3pt" name="First" class="form-control">

                    </div>

                    <div class="form-group">
                        <label style="font-size: 12pt">Middle Name</label>
                        <input type="text" style="border-radius: 3pt" name="Middle" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Last Name</label>
                        <input type="text" style="border-radius: 3pt" name="Last" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Phone Number</label>
                        <input type="text" style="border-radius: 3pt" name="Phone" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">National ID</label>
                        <input type="text" style="border-radius: 3pt" name="National" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Continue</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    function ToggleBeOwnerModal() {
        $("#BeOwnerModal").modal("toggle");
    };
    $(document).ready(function() {
        $.ajax({
            url: "{{route('checkIfOwner')}}",
            Type: "",
            data: {

            },
            success: function(checkIfOwner) {
                var text = "";
                // console.log(checkIfOwner);
                var checkIfOwnerDiv = $("#checkIfOwnerDiv");
                // console.log(checkIfOwnerDiv);
                if (checkIfOwner == '0') {
                    text +=
                        "<div clrass='add-listing'> " +
                        "<a href='javascript:void(0)' onclick='ToggleBeOwnerModal()'> " +
                        "<img src='{{asset('FrontEnd/images/header/plus-ico.png')}}' alt=''>Continue As Owner </a></div>";

                } else {
                    text +=
                        "<div class='add-listing'> " +
                        "<a href='{{url('/BeOwner')}}'> " +
                        "<img src='{{asset('FrontEnd/images/header/plus-ico.png')}}' alt=''> Your Properties</a></div>";
                }
                $("#checkIfOwnerDiv").html(text);
            },
            error: function() {

            }
        });
    });
</script>