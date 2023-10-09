@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">
	    <div class="card-header bg-success text-center">
		<p class="h3">إضافة استبيان جديد</p>
	    </div>
	    
	    <div class="card-body">

		@if($errors->any())
		    <div class="alert alert-danger">
			<ul>
			    @foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			    @endforeach
			</ul>
		    </div>
		@endif
		

		
		<form  method="post" action="/admin/polls/add">
		    @csrf
		    <div class="input-wrapper">
			<label for="">عنوان الاستبيان</label>
			<input class="form-control" name="title" type="text" value="{{old("title")}}"/>
		    </div>

		    <div class="input-wrapper">
			<label for="">الوصف</label>
			<textarea class="form-control" cols="30" id="" name="desc" rows="10">{{old("desc")}}</textarea>
		    </div>

		    <div class="allow-vote my-2">

			<p>من يستطيع رؤية الاستبيان، وله حق التصويت؟</p>
			
			<div class="form-check">
			    <input name="allowed[]" class="form-check-input" type="checkbox" value="معيد" id="">
			    <label class="form-check-label" for="">
				معيد
			    </label>
			</div>

			<div class="form-check">
			    <input name="allowed[]" class="form-check-input" type="checkbox" value="مدرس" id="">
			    <label class="form-check-label" for="">
				مدرس
			    </label>
			</div>

			
			<div class="form-check">
			    <input name="allowed[]" class="form-check-input" type="checkbox" value="استاذ" id="">
			    <label class="form-check-label" for="">
				استاذ
			    </label>
			</div>
		    </div>


		    <button class="btn btn-success btn-block">إضافة
			<i class="fa fa-plus"></i>
		    </button>
		</form>
		
	    </div>

	</div>
	
    </div>
	
	
@endsection


@push("scripts")

@endpush
