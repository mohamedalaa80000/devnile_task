
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="/home">
				<img src="{{asset('theme/images/logo-icon.png')}}" alt="" class="dark-logo">
				<img src="{{asset('theme/images/logo-icon.png')}}" alt="" class="light-logo">
				{{env('APP_NAME')}}
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="{{route('home')}}" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">{{__('Home')}}</span>
						</a>
					</li>
					@if(auth()->guard('admin')->check())
                    <li>
						<a href="{{route('admin.supervisors.list')}}" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-library"></span><span class="mtext">{{__('Supervisors')}}</span>
						</a>
					</li>
					@endif
					@if(auth()->guard('supervisor')->check())
					<li>
						<a href="{{route('supervisor.categories.list')}}" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-browser2"></span><span class="mtext">{{__('Categories')}}</span>
						</a>
					</li>
					<li>
						<a href="{{route('supervisor.products.list')}}" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">{{__('Products')}}</span>
						</a>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>