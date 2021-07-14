@extends('website.frontend.layouts.main')
@section('profile')
<div class="row">
    <?php

    use App\Http\Controllers\NotificationController;
    use Illuminate\Support\Facades\Auth;

    $notifications = NotificationController::index(Auth::id());
    $today = \Carbon\Carbon::now();
    ?>

    <div class="col-xl-12">
        <div class="chat-wrapper p-3 w-100 position-relative scroll-bar bg-white theme-dark-bg">
            <h2 class="fw-700 mb-4 mt-2 font-md text-grey-900 d-flex align-items-center">Notification
                <span class="circle-count bg-warning text-white font-xsssss rounded-3 ms-2 ls-3 fw-600 p-2  mt-0">{{count($notifications)}}</span>
            </h2> 
                <ul class="notification-box">
                    @if(count($notifications)>0)
                    @foreach($notifications as $notification)
                    <li>
                        @if($notification->Redirect_To !=null)<a href="{{url(''.$notification->Redirect_To)}}" class="d-flex align-items-center p-3 rounded-3">@else <a href="{{ url('/view_User/'.$notification->From_User_Id) }}" class="d-flex align-items-center p-3 rounded-3"> @endif
                                @if($notification->fromuser->profilePhoto !=null)
                                <img src="{{asset('storage/cover page/'.$notification->fromuser->profilePhoto['Profile_Picture'])}}" alt="user" class="w45 me-3">
                                @else
                                <img src="{{asset('storage/cover page/pic.png')}}" alt="user" class="w45 me-3">
                                @endif

                                <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>{{$notification->fromuser->First_Name}} {{$notification->fromuser->Middle_Name}} {{$notification->fromuser['Last_Name']}}</strong> {{ $notification->Notification }} <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 ms-auto"> <?php $end = \Carbon\Carbon::parse($notification->updated_at); ?>{{ $end->diffForHumans($today) }}</span> </h6>
                            </a>
                    </li>

                    @endforeach
                    @else
                    <li>
                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>You have no notifications</strong></h6>
                    </li>
                    @endif
                </ul>
        </div>
    </div>
</div>
@endsection