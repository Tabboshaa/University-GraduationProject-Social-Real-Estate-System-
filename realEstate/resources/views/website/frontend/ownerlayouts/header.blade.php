<!-- navigation top-->

<div class="nav-header bg-white shadow-xs border-0">
  
    <div class="nav-top">
        <a href="{{url('/HomePage')}}"><img src="{{asset('FrontEnd/sociala/images/logo.png')}}" height="35" width="40"><span class="d-inline-block fredoka-font ls-3 fw-600 font-xl logo-text mb-0 "> Traveller club</span> </a>
        <a href="{{url('/HomePage')}}" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>

    </div>

    <form action="#" class="float-left header-search">
        <div class="form-group mb-0 icon-input">
            <i class="feather-search font-sm text-grey-400"></i>
            <input type="text" placeholder="Start typing to search.." class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
        </div>
    </form>
    <a href="{{url('/MyItems')}}" class="p-2 text-center ms-3 menu-icon center-menu-icon"><i class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current "></i></a>
    <a href="{{url('/EditCustomerProfile')}}" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-user font-lg bg-greylight btn-round-lg theme-dark-bg text-current"></i></a>
    <?php

    use App\Http\Controllers\NotificationController;
    use Illuminate\Support\Facades\Auth;

    $notifications = NotificationController::index(Auth::id());
    $today = \Carbon\Carbon::now();
    ?>

    <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">@if(count($notifications)!=0)<span class="dot-count bg-warning"></span>@endif<i class="feather-bell font-xl text-current"></i></a>
    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" style="max-height: 650px; overflow: auto;" aria-labelledby="dropdownMenu3">
        <h4 class="fw-700 font-xss mb-4">Notification</h4>
        @if( count($notifications) != 0)
        @foreach($notifications as $notification)
        <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3" id="notif{{$notification->Notification_Id}}">

            @if($notification->fromuser->profilePhoto !=null)
            <img src="{{asset('storage/cover page/'.$notification->fromuser->profilePhoto['Profile_Picture'])}}" alt="user" height="40" style=" border-radius: 50%;" class="w40 position-absolute left-0">
            @else
            <img src="{{asset('storage/cover page/pic.png')}}" alt="user" class="w40 position-absolute left-0">
            @endif
            <a href="javascript:void(0)" onclick="deletenotification('{{$notification->Notification_Id}}')"> <i class="fa fa-close float-right mt-1"></i></a>
            @if($notification->Redirect_To !=null)<a href="{{url(''.$notification->Redirect_To)}}">@else <a href="{{ url('/view_User/'.$notification->From_User_Id) }}"> @endif
                    <h5 class="font-xssss text-grey-900 mb-1 mt-0 fw-700 d-block">{{$notification->fromuser->First_Name}} {{$notification->fromuser->Middle_Name}} {{$notification->fromuser['Last_Name']}}<span class="text-grey-400 font-xsssss fw-600 float-right mt-1"> <?php $end = \Carbon\Carbon::parse($notification->updated_at); ?>{{ $end->diffForHumans() }}</span></h5>
                    <h6 class="text-grey-500 fw-500 font-xssss lh-4">{{ $notification->Notification }}</h6>
                </a>
            </a>
        </div>
        @endforeach
        @else
        <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
            <p>There is no notification </p>
        </div>
        @endif
    </div>

    <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
        <i class="feather-settings animation-spin d-inline-block font-xl text-current"></i>
        <div class="dropdown-menu-settings switchcolor-wrap">
            <h4 class="fw-700 font-sm mb-4">Settings</h4>
            <h6 class="font-xssss text-grey-500 fw-700 mb-3 d-block">Choose Color Theme</h6>
            <ul>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="red" checked=""><i class="ti-check"></i>
                        <span class="circle-color bg-red" style="background-color: #ff3b30;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="green"><i class="ti-check"></i>
                        <span class="circle-color bg-green" style="background-color: #4cd964;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="blue" checked=""><i class="ti-check"></i>
                        <span class="circle-color bg-blue" style="background-color: #132977;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="pink"><i class="ti-check"></i>
                        <span class="circle-color bg-pink" style="background-color: #ff2d55;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="yellow"><i class="ti-check"></i>
                        <span class="circle-color bg-yellow" style="background-color: #ffcc00;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="orange"><i class="ti-check"></i>
                        <span class="circle-color bg-orange" style="background-color: #ff9500;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="gray"><i class="ti-check"></i>
                        <span class="circle-color bg-gray" style="background-color: #8e8e93;"></span>
                    </label>
                </li>

                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="brown"><i class="ti-check"></i>
                        <span class="circle-color bg-brown" style="background-color: #D2691E;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="darkgreen"><i class="ti-check"></i>
                        <span class="circle-color bg-darkgreen" style="background-color: #228B22;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="deeppink"><i class="ti-check"></i>
                        <span class="circle-color bg-deeppink" style="background-color: #FFC0CB;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="cadetblue"><i class="ti-check"></i>
                        <span class="circle-color bg-cadetblue" style="background-color: #5f9ea0;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="darkorchid"><i class="ti-check"></i>
                        <span class="circle-color bg-darkorchid" style="background-color: #9932cc;"></span>
                    </label>
                </li>
            </ul>

            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Header Background</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-menu-color"><input type="checkbox"><span class="toggle-icon"></span></label>
                </div>
            </div>
            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Menu Position</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-menu"><input type="checkbox"><span class="toggle-icon"></span></label>
                </div>
            </div>
            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Dark Mode</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-dark"><input type="checkbox" id="darkmodeswitch"><span class="toggle-icon"></span></label>
                </div>
            </div>

        </div>
    </div>

    @if(Auth::user()->profilePhoto!=null)
    <a id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" class="p-0 ms-3 menu-icon"><img src="{{asset('storage/cover page/'.Auth::user()->profilePhoto->Profile_Picture)}}" alt="user" height="40" class="w40 mt--1 " style=" border-radius: 50%;"></a>
    @else
    <a id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" class="p-0 ms-3 menu-icon"><img src="{{asset('storage/cover page/pic.png')}}" alt="user" class="w40 mt--1 " style=" border-radius: 50%;"></a>
    @endif
    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu2">

        <div class="card bg-transparent-card w-100 border-0 ps-0 mb-3">
            <h5 class="font-xsss text-grey-900 mb-0 mt-0 fw-700 d-block"> <a href="{{url('/EditCustomerProfile')}}"> profile</a></h5>
        </div>
        <div class="card bg-transparent-card w-100 border-0 ps-0 mb-3" id="checkIfOwnerDiv">
            <h5 class="font-xsss text-grey-900 mb-0 mt-0 fw-700 d-block"> <a href='javascript:void(0)' onclick='ToggleBeOwnerModal()' data-backdrop="false"> Switch to Owner</a></h5>
        </div>
        <div class="card bg-transparent-card w-100 border-0 ps-0 mb-3">
            <h5 class="font-xsss text-grey-900 mb-0 mt-0 fw-700 d-block"> <a href="{{ url('/logout') }}"> Log Out</a></h5>
        </div>

    </div>

</div>
<!-- Modal -->




<script>
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
                        "<div class='card bg-transparent-card w-100 border-0 ps-0 mb-3'> " +
                        "<a href='javascript:void(0)' onclick='ToggleBeOwnerModal()'> " +
                        "Continue As Owner </a></div>";

                    0
                } else {
                    text +=
                        "<div class='card bg-transparent-card w-100 border-0 ps-0 mb-3'> " +
                        "<h5 class='font-xsss text-grey-900 mb-0 mt-0 fw-700 d-block'> <a href='{{url('/BeOwner')}}'> " +
                        " Your Properties</a></h5></div>";
                }
                $("#checkIfOwnerDiv").html(text);
            },
            error: function() {

            }

        });

        $('.toggle-menu input').on('change', function() {
            if (this.checked) {
                $('.navigation,.main-content').addClass('menu-active');
            } else {
                $('.navigation,.main-content').removeClass('menu-active');
            }
        });
        $('input[name="color-radio"]').on('change', function() {
            if (this.checked) {
                $('body').removeClass('color-theme-teal color-theme-cadetblue color-theme-pink color-theme-deepblue color-theme-blue color-theme-red color-theme-black color-theme-gray color-theme-orange color-theme-yellow color-theme-green color-theme-white color-theme-brown color-theme-darkgreen color-theme-deeppink color-theme-darkorchid');
                $('body').addClass('color-theme-' + $(this).val());
            }
        });

        $('.toggle-menu-color input').on('change', function() {
            if (this.checked) {
                $('.navigation').addClass('menu-current-color');
            } else {
                $('.navigation').removeClass('menu-current-color');
            }
        });

        $('.dropdown-menu-icon').on('click', function() {
            $('.dropdown-menu-settings').toggleClass('active');
        });

        $('#darkmodeswitch').on('change', function() {
            if (this.checked) {
                $('body').addClass('theme-dark');
            } else {
                $('body').removeClass('theme-dark');
            }
        });
    });

    function ToggleBeOwnerModal() {
        let $show = $('#show').val();
        if ($show == 'true') {
            $("#BeOwnerModal2").modal("toggle");
        } else {
            $("#BeOwnerLightModal").modal("toggle");
        }

    };


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


<!-- navigation top -->