<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			
		</div>
		@php
			if(auth()->guard('admin')->check()){
				$guard = 'admin';
			}
			elseif(auth()->guard('supervisor')->check()){
				$guard = 'supervisor';
			}
		@endphp
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="{{auth()->guard($guard)->user()->avatar_path}}" alt="">
						</span>
						<span class="user-name">{{auth()->guard($guard)->user()->username}}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="{{route($guard.'.auth.logout')}}"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>