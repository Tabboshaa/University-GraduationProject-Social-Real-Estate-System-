<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->profilePhoto)
                        <img src="{{asset('storage/cover page/'.Auth::user()->profilePhoto->Profile_Picture)}}" class="avatar" > {{Auth::user()->First_Name}}
                        @else
                        <img src="{{asset('storage/cover page/pic.png')}}" class="avatar" > {{Auth::user()->First_Name}}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('/AdminProfile')}}"> Profile</a>
                        <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
                <?php

                use App\Http\Controllers\NotificationController;
                use Illuminate\Support\Facades\Auth;

                $notifications = NotificationController::index(Auth::id());
                $today = \Carbon\Carbon::now();
                ?>
                <!-- <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">{{count($notifications)}}</span>
                    </a> -->
                    <!-- <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1"> -->
                        <!-- @foreach($notifications as $notification)
                        <li class="nav-item">
                            <a class="dropdown-item">
                                @if($notification->fromuser->profilePhoto !=null)
                                <span class="image"><img src="{{asset('storage/cover page/'.$notification->fromuser->profilePhoto['Profile_Picture'])}}" alt="Profile Image" /></span>
                                @else
                                <span class="image"><img src="{{asset('storage/cover page/pic.png')}}" alt="Profile Image" /></span>
                                @endif
                                <a href="javascript:void(0)" onclick="deletenotification('{{$notification->Notification_Id}}')"> <i class="fa fa-close float-right mt-1"></i></a>
                                <span>
                                    <span>{{$notification->fromuser->First_Name}} {{$notification->fromuser->Middle_Name}} {{$notification->fromuser['Last_Name']}}</span>
                                    <span class="time"><?php $end = \Carbon\Carbon::parse($notification->updated_at); ?>{{ $end->diffForHumans() }}</span>
                                </span>
                                <span class="message">
                                    {{ $notification->Notification }}
                                </span>
                            </a>
                        </li>
                        @endforeach -->
                    <!-- </ul> -->
                </li>
            </ul>
        </nav>
    </div>
</div>
<script>
    function deletenotification(id) {
        $.ajax({
            url: "{{route('view_notification')}}",
            data: {
                notification_id: id
            },
            success: function() {
                $("#notif" + id).remove();
            },
            error: function() {

            }
        });

    }
</script>