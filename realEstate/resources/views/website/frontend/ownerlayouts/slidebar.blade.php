<!-- navigation left -->
<nav class="navigation scroll-bar">
	<div class="container ps-0 pe-0">
		<div class="nav-content">
			<div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2">
				<div class="nav-caption fw-600 font-xssss text-grey-500">Menu</div>
				<ul class="mb-1 top-content">
					<li class="logo d-none d-xl-block d-lg-block"></li>
					<li><a href="{{ url('/MyItems') }}" class="nav-content-bttn open-font" ><i class="feather-layers btn-round-md bg-blue-gradiant me-3"></i><span>My Properties</span></a></li>
					<li><a href="{{ url('/BeOwner') }}" class="nav-content-bttn open-font" ><i class="feather-plus btn-round-md bg-gold-gradiant me-3"></i><span>Add Property</span></a></li>
                    <li><a href="{{ url('/HomePage') }}" class="nav-content-bttn open-font" ><i  class="btn-round-md bg-red-gradiant text-white feather-log-out font-md me-3"></i><span> Customer Side</span></a></li>
                </ul>
			</div>

			<!-- <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2">
				<div class="nav-caption fw-600 font-xssss text-grey-500"><span>More </span>Pages</div>
				<ul class="mb-3">
					<li><a href="default-email-box.html" class="nav-content-bttn open-font"><i class="font-xl text-current feather-inbox me-3"></i><span>Email Box</span><span class="circle-count bg-warning mt-1">584</span></a></li>
					<li><a href="default-hotel.html" class="nav-content-bttn open-font"><i class="font-xl text-current feather-home me-3"></i><span>Near Hotel</span></a></li>
					<li><a href="default-event.html" class="nav-content-bttn open-font"><i class="font-xl text-current feather-map-pin me-3"></i><span>Latest Event</span></a></li>
					<li><a href="default-live-stream.html" class="nav-content-bttn open-font"><i class="font-xl text-current feather-youtube me-3"></i><span>Live Stream</span></a></li>
				</ul>
			</div> -->
			<div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1">
				<div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
				<ul class="mb-1">
					<li class="logo d-none d-xl-block d-lg-block"></li>
					<li><a href="{{url('/settings')}}" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-settings me-3 text-grey-500"></i><span>Settings</span></a></li>
					<!-- <li><a href="default-analytics.html" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-pie-chart me-3 text-grey-500"></i><span>Analytics</span></a></li> -->
                    <li><a href="{{url('/EditUserProfile')}}" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="feather-edit text-grey-500 me-3 font-sm"></i><span>EditAccount</span></a></li>
                    <li><a href="{{url('/logout')}}" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="feather-log-out text-grey-500 me-3 font-sm"></i><span>Log Out</span></a></li>

				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- navigation left -->
