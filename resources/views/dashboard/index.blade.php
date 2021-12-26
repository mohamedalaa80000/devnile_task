
	@include('dashboard.layouts.header')
	@include('dashboard.layouts.nav')
	@include('dashboard.layouts.sidebar')
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		@yield('content')
	</div>
	@include('dashboard.layouts.footer')