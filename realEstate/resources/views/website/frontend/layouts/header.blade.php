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
        <div class="add-listing">
            <a href="upload.html">
                <img src="{{asset('FrontEnd/images/header/plus-ico.png')}}" alt="">
                Add Listing</a>
        </div>
        <div class="home">
           <ul>
               <li>
                   <a  href="{{url('/HomePage')}}"><img src="{{asset('FrontEnd/images/header/home.png')}}" alt="" title="" >
                       <span>0</span>
                   </a>
               </li>
               <li class="popup"  onclick="myFunctionmsg()">
                   <img src="{{asset('FrontEnd/images/header/mgs.png')}}" alt="" title="" >
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
                           </div><!--notification-info -->
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
                           </div><!--notification-info -->
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
                           </div><!--notification-info -->
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
                                <h3><a href="{{ url('/veiw_User/'.$notification->id) }}"> {{$notification->First_Name}} {{$notification->Middle_Name}} {{$notification->Last_Name}}</a> </h3> <h3 style="font-size: 10px;"><p>{{ $notification->Notification }} </p></h3>
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
</nav>