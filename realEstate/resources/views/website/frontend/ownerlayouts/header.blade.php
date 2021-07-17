<!-- navigation top-->

<div class="nav-header bg-white shadow-xs border-0">
    <div class="nav-top">
        <a href="index.html"><i class="feather-pocket text-success display1-size me-2 ms-0"></i><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Sociala. </span> </a>
        <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
        <a href="default-video.html" class="mob-menu me-2"><i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
        <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
        <button class="nav-menu me-0 ms-2"></button>
    </div>

    <form action="#" class="float-left header-search">
        <div class="form-group mb-0 icon-input">
            <i class="feather-search font-sm text-grey-400"></i>
            <input type="text" placeholder="Start typing to search.." class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
        </div>
    </form>
    <a href="{{url('/MyItems')}}" class="p-2 text-center ms-3 menu-icon center-menu-icon"><i class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current "></i></a>

    <a href="{{url('/EditCustomerProfile')}}" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-user font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 "></i></a>
    <a href="shop-2.html" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-shopping-bag font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 "></i></a>

    <?php

    use App\Http\Controllers\NotificationController;
    use Illuminate\Support\Facades\Auth;

    $notifications = NotificationController::index(Auth::id());
    $today = \Carbon\Carbon::now();
    ?>
    
    <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">@if(count($notifications)!=0)<span class="dot-count bg-warning"></span>@endif<i class="feather-bell font-xl text-current"></i></a>
    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" style="max-height: 650px; overflow: auto;" aria-labelledby="dropdownMenu3">
        <h4 class="fw-700 font-xss mb-4">Notification</h4>
        @foreach($notifications as $notification)
        <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3" id="notif{{$notification->Notification_Id}}">

            @if($notification->fromuser->profilePhoto !=null)
            <img src="{{asset('storage/cover page/'.$notification->fromuser->profilePhoto['Profile_Picture'])}}" alt="user" class="w40 position-absolute left-0">
            @else
            <img src="{{asset('storage/cover page/pic.png')}}" alt="user" class="w40 position-absolute left-0">
            @endif
            <a href="javascript:void(0)" onclick="deletenotification('{{$notification->Notification_Id}}')"> <i class="fa fa-close float-right mt-1"></i></a>
            @if($notification->Redirect_To !=null)<a href="{{url(''.$notification->Redirect_To)}}">@else <a href="{{ url('/view_User/'.$notification->From_User_Id) }}"> @endif
                    <h5 class="font-xssss text-grey-900 mb-1 mt-0 fw-700 d-block">{{$notification->fromuser->First_Name}} {{$notification->fromuser->Middle_Name}} {{$notification->fromuser['Last_Name']}}<span class="text-grey-400 font-xsssss fw-600 float-right mt-1"> <?php $end = \Carbon\Carbon::parse($notification->updated_at); ?>{{ $end->diffForHumans($today) }}</span></h5>
                    <h6 class="text-grey-500 fw-500 font-xssss lh-4">{{ $notification->Notification }}</h6>
                </a>
        </div>
        @endforeach
    </div>

    <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
    <a href="{{url('/settings')}}">   <i class="feather-settings animation-spin d-inline-block font-xl text-current"></i></a>
    </div>
@if(Auth::user()->profilePhoto!=null)
    <a id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" class="p-0 ms-3 menu-icon"><img src="{{asset('storage/cover page/'.Auth::user()->profilePhoto->Profile_Picture)}}" alt="user" class="w40 mt--1 " style=" border-radius: 50%;"></a>

@endif
    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu2">

        <div class="card bg-transparent-card w-100 border-0 ps-0 mb-3" >
            <h5 class="font-xsss text-grey-900 mb-0 mt-0 fw-700 d-block"> <a href="{{url('/EditCustomerProfile')}}"> profile</a></h5>
        </div>
        <div class="card bg-transparent-card w-100 border-0 ps-0 mb-3" id="checkIfOwnerDiv">
            <h5 class="font-xsss text-grey-900 mb-0 mt-0 fw-700 d-block"> <a href='javascript:void(0)' onclick='ToggleBeOwnerModal()' data-backdrop="false"> Switch to Owner</a></h5>
        </div>
        <div class="card bg-transparent-card w-100 border-0 ps-0 mb-3" >
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
    });

    function ToggleBeOwnerModal() {
        let $show=$('#show').val();
        if($show=='true')
        {
            $("#BeOwnerModal2").modal("toggle");
        }else{$("#BeOwnerLightModal").modal("toggle"); }

    };


    function deletenotification(id){
        $.ajax({
            url: "{{route('view_notification')}}",
            data: {
                notification_id:id
            },
            success: function() {
                $("#notif"+id).remove();
            },
            error: function() {

            }
        });


    }

</script>


<!-- navigation top -->
