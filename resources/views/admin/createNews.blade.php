@extends("admin/layout")



@section("title")
    <title>إنشاء خبر-  {{ config("app.name") }} </title>
@endsection


@section("content")

    <div class="card">

	<div class="mb-4 text-center card-header bg-secondary">
	    <p class="h3">
		إنشاء خبر
	    </p>
	</div>
	
	@if($errors->any())
	    <div class="alert alert-danger">
		<ul>
		    @foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		    @endforeach
		</ul>
	    </div>
	@endif

	
	<div class="card-body">
	    
	    <form method="post" action="/admin/news"
		  enctype="multipart/form-data">
		@csrf


		
		<div class=" my-4 input-wrapper">
		    <label for="">العنوان</label>
		    <div class="custom-file">
			<input required type="text" class="form-control"  id="" name="title">
		    </div>
		</div>

		<textarea required name="content" id="editor">
		</textarea>

		<div class=" my-4 input-wrapper">
		    <label for="">الصورة</label>
		    <div class="custom-file">
			<input required type="file" class="custom-file-input" id="" name="image">
			<label class="custom-file-label" for="">ارفع صورة</label>
		    </div>
		</div>

		<div class="input-wrapper">
		    <div class="custom-control custom-switch">
			<input name="active" type="checkbox" class="custom-control-input" id="activeswitch">
			<label class="custom-control-label" for="activeswitch">تفعيل</label>
		    </div>


		    
		<button class="btn btn-block my-4 w-50 btn-primary float-left">
		    إنشاء
		    <i class="fa fa-plus"></i>
		</button>
		
	    </form>
	
	    
	</div>
    </div>
    
@endsection

@push("scripts")
<script src="{{asset("/scripts/tinymce/tinymce/js/tinymce/jquery.tinymce.min.js")}}">
</script>
    
<script src="{{asset("/scripts/tinymce/tinymce/js/tinymce/tinymce.min.js") }}">
</script>


<script src="{{asset("/scripts/news.js") }}"></script>
@endpush

