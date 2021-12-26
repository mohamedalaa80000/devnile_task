@extends('dashboard.index')
@section('content')
<!-- Checkbox select Datatable start -->
<div class="card-box mb-30">
					<div class="pd-20">
						<div class="row">
							<div class="col-lg-6 btn-group-vertical"><h4 class="text-blue h4 mb-0">Supervisors List</h4></div>
							<div class="col-lg-6 text-right">
								<a href="{{route('admin.supervisors.add')}}" class="btn btn-primary">Add New</a>
							</div>
						</div>
					</div>
					<form id="delete_selected" action="{{route('admin.supervisors.delete')}}" method="POST" style="display:none;">
							@csrf
							<input name="ids">
					</form>
					<div class="pd-20"><button class="btn btn-primary" id="deleteRows">Delete Selected Rows</button><div>
					<div class="pd-20">
					@if(session()->get('success'))
								<div class="alert alert-success col-sm-12 col-md-12" role="alert">
									{{ session()->get('success') }}
								</div>
							@endif
						<table class="checkbox-datatable table nowrap">
							<thead>
								<tr>
									<th><div class="dt-checkbox">
											<input type="checkbox" name="select_all" value="1" id="example-select-all">
											<span class="dt-checkbox-label"></span>
										</div>
									</th>
									<th>{{__('Username')}}</th>
									<th>{{__('Phone')}}</th>
									<th>{{__('Email')}}</th>
									<th>{{__('Avatar')}}</th>
									<th>{{__('Options')}}</th>
								</tr>
							</thead>
							<tbody>
                                @foreach($supervisors as $supervisor)
                                    <tr>
                                        <td>{{@$supervisor->id}}</td>
                                        <td>{{@$supervisor->username}}</td>
                                        <td>{{@$supervisor->phone}}</td>
                                        <td>{{@$supervisor->email}}</td>
                                        <td><img width="60" src="{{@$supervisor->avatar_path}}"></td>
                                        <td><a type="button" class="btn btn-outline-primary" href="{{route('admin.supervisors.view',@$supervisor->id)}}">View</a></td>
                                    </tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
				<!-- Checkbox select Datatable End -->
@endsection