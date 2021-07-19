<!-- navigation left -->
<nav class="navigation scroll-bar">
	<div class="container ps-0 pe-0">
		<div class="nav-content">
			<div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2">
				<div class="nav-caption fw-600 font-xssss text-grey-500">Menu</div>
				<ul class="mb-1 top-content">
					<li class="logo d-none d-xl-block d-lg-block"></li>
					<li><a href="{{ url('/HomePage') }}" class="nav-content-bttn open-font"><i class="feather-home btn-round-md bg-blue-gradiant me-3"></i><span>Home</span></a></li>
					<li><a href="{{ url('/') }}" class="nav-content-bttn open-font"><i class="feather-search btn-round-md bg-gold-gradiant me-3"></i><span>Find Proprties</span></a></li>
					{{-- <li><a href="default-storie.html" class="nav-content-bttn open-font" ><i class="feather-globe btn-round-md bg-gold-gradiant me-3"></i><span>Explore Stories</span></a></li>
					<li><a href="default-group.html" class="nav-content-bttn open-font" ><i class="feather-zap btn-round-md bg-mini-gradiant me-3"></i><span>Popular Groups</span></a></li>
					<li><a href="user-page.html" class="nav-content-bttn open-font"><i class="feather-user btn-round-md bg-primary-gradiant me-3"></i><span>Author Profile </span></a></li>                         --}}
				</ul>
			</div>

			<div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2">
				<div class="nav-caption fw-600 font-xssss text-grey-500"><span>More </span>Pages</div>
				<ul class="mb-3">
					<li><a href="{{url('/user_reservations')}}" class="nav-content-bttn open-font"><i class="feather-shopping-bag font-xl text-current me-3"></i><span>My Reservations</span></a></li>
				</ul>
			</div>
			<div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1">
				<div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
				<ul class="mb-1">
					<li class="logo d-none d-xl-block d-lg-block"></li>
					<li><a href="{{url('/settings')}}" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-settings me-3 text-grey-500"></i><span>Settings</span></a></li>
					<!-- <li><a href="default-analytics.html" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-pie-chart me-3 text-grey-500"></i><span>Analytics</span></a></li> -->
					<li><a href="{{url('/EditUserProfile')}}" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="feather-edit text-grey-500 me-3 font-sm"></i><span>EditAccount</span></a></li>

				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- navigation left -->