@extends('dashboard.index')
@section('content')
<div class="card-box mb-30">
	<form method="post" action="{{route('supervisor.products.update',@$product->id)}}" enctype="multipart/form-data">
					@csrf
					<div class="pd-20">
						<h4 class="text-blue h4">Products Edit / {{@$product->name}}</h4>
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
							<label class="col-sm-12 col-md-2 col-form-label">{{__('Category')}}</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="category_id">
									<option selected="">Choose...</option>
									@foreach($categories as $category)
										<option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">{{__('Name')}}</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" value="{{@$product->name}}" name="name">
							</div>
						</div>
						@if($product->slug)
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">{{__('Slug')}}</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" disabled type="text" value="{{@$product->slug}}">
							</div>
						</div>
						@endif
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">{{__('Description')}}</label>
							<div class="col-sm-12 col-md-10">
							<textarea class="form-control" name="description">{{@$product->description}}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Choose Image</label>
							<div class="custom-file col-sm-12 col-md-6">
								<input type="file" class="custom-file-input" name="image_file">
								<label class="custom-file-label">Choose file</label>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Product Images</label>
							<div class="dropzone"id="my-awesome-dropzone">
							<div class="fallback">
								<input type="file" name="file" />
							</div>
						</div>
						</div>
					</div>
					<div class="card-footer text-muted">
						<button class="btn btn-primary">Save</button>
					</div>
				</form>
				</div>
@endsection
@section('js')
<script>
	 	$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
		Dropzone.autoDiscover = false;
		$(".dropzone").dropzone({
            maxFilesize: 2, // MB
            maxFiles: 20,
            paramName: "media",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            url: "{!! route('supervisor.products.imageUpload',@$product->id) !!}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },autoQueue: true,
            success: function (file, response) {
                file.file_name = response.name;
            },
             removedfile: function(file) {
               var file_id = file.id; 

               $.ajax({
                 type: 'POST',
                 url: "{!! route('supervisor.products.removeImageUpload',@$product->id) !!}",
                 data: {file_id: file_id},
                 sucess: function(data){
                    console.log('success: ' + data);
                 }
               });
               var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
             },
            init: function () {
				@if(isset($product) && $product->images)
                    var files =
                      {!! json_encode($product->images) !!};
                    for (var i in files) {
                      var file = files[i]
                      this.options.addedfile.call(this, file)
                      this.options.thumbnail.call(this, file, file.image_path);
                      file.previewElement.classList.add('dz-complete')
                     
                    }
                  @endif
                }
        });
	</script>
@endsection