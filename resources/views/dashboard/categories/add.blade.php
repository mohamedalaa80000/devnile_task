@extends('dashboard.index')
@section('content')
<div class="card-box mb-30">
	<form method="post" action="{{route('supervisor.categories.save')}}" enctype="multipart/form-data">
					@csrf
					<div class="pd-20">
						<h4 class="text-blue h4"> New Category</h4>
					</div>
					<div class="pd-20">
						<div class="row pd-20">
							<div class="col-sm-12 col-md-2"></div>
							@if(session()->get('errors'))
								<div class="alert alert-danger col-sm-12 col-md-10" role="alert">
									{{ session()->get('errors')->first() }}
								</div>
							@endif
							@if(session()->get('success'))
								<div class="alert alert-success col-sm-12 col-md-10" role="alert">
									{{ session()->get('success') }}
								</div>
							@endif
						</div>
					<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">{{__('Name')}}</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" name="name">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Choose Image</label>
							<div class="custom-file col-sm-12 col-md-6">
								<input type="file" class="custom-file-input" name="icon_file">
								<label class="custom-file-label">Choose file</label>
							</div>
						</div>
					</div>
					<div class="card-footer text-muted">
						<button class="btn btn-primary">Save</button>
					</div>
				</form>
				</div>
@endsection