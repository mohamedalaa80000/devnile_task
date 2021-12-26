<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>{{env('APP_NAME')}}</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('/theme/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/theme/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/theme/styles/style.css')}}">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="/" style="color:black">
					<img src="{{asset('/')}}theme/images/logo-icon.png" alt="">
					{{env('APP_NAME')}}
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{{asset('/')}}theme/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To {{env('APP_NAME')}}</h2>
						</div>
						<form id="loginForm" method="POST">
							@csrf
							@if(session()->get('errors'))
								<div class="alert alert-danger" role="alert">
									{{ session()->get('errors')->first() }}
								</div>
							@endif
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin" checked>
										<div class="icon"><img src="{{asset('/')}}theme/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Admin
									</label>
									<label class="btn">
										<input type="radio" name="options" id="supervisor">
										<div class="icon"><img src="{{asset('/')}}theme/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Supervisor
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email" name="email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button class="btn btn-primary btn-lg btn-block">Sign In</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{asset('/theme/scripts/core.js')}}"></script>
	<script src="{{asset('/theme/scripts/script.min.js')}}"></script>
	<script src="{{asset('/theme/scripts/process.js')}}"></script>
	<script src="{{asset('/theme/scripts/layout-settings.js')}}"></script>
	<script>
		var type = $('input[name="options"]').attr('id');
		var loginForm = $('#loginForm');
		if(type == 'admin'){
			loginForm.attr('action',"{!! route('admin.auth.login.submit') !!}");
		}else if(type == 'supervisor'){
			loginForm.attr('action',"{!! route('supervisor.auth.login.submit') !!}");
		}
		$('input[name="options"]').change(function(){
			var type = $(this).attr('id');
			var loginForm = $('#loginForm');
			if(type == 'admin'){
				loginForm.attr('action',"{!! route('admin.auth.login.submit') !!}");
			}else if(type == 'supervisor'){
				loginForm.attr('action',"{!! route('supervisor.auth.login.submit') !!}");
			}
		});	
	</script>
</body>
</html>