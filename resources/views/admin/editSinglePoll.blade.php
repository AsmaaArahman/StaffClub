@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="wrapper">

	<div class="card-header bg-warning text-center">
	    <p class="h3">إضافة استبيان جديد</p>
	</div>
	

	
	<div class="card">
	    
	    <card class="card-body">

		
		
		@if($errors->any())
		    <div class="alert alert-danger">
			<ul>
			    @foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			    @endforeach
			</ul>
		    </div>
		@endif

		
	    <form method="post" class="" action="/admin/polls/edit/{{$poll->id }}">
		@csrf
		<div class="input-wrapper">
		    <label for="">عنوان الاستبيان</label>
		    <input class="form-control" name="title" type="text" value=" {{ $poll->title }}"/>
		</div>
		

		<div class="input-wrapper">
		    <label for="">الوصف</label>
		    <textarea class="form-control" cols="30" id="" name="desc" rows="10">{{$poll->desc }}</textarea>
		</div>

		<div class="allow-vote my-2">

		    <p>من يستطيع رؤية الاستبيان، وله حق التصويت؟</p>
		    
		    <div class="form-check">
			<input name="allowed[]" class="form-check-input" type="checkbox" value="معيد"
			       {{in_array("معيد", explode(",", $poll->allowedVoters)) ? "checked"  : ""}}
			>
			<label class="form-check-label" for="">
			    معيد
			</label>
		    </div>

		    <div class="form-check">
			<input name="allowed[]" class="form-check-input" type="checkbox" value="مدرس"
			       {{in_array("مدرس", explode(",", $poll->allowedVoters)) ? "checked"  : ""}}
			>
			<label class="form-check-label" for="">
			    مدرس
			</label>
		    </div>

		    

		    
		    <div class="form-check">
			<input name="allowed[]" class="form-check-input" type="checkbox" value="استاذ"
			       {{in_array("استاذ", explode(",", $poll->allowedVoters)) ? "checked"  : ""}}
			       {{in_array("أستاذ", explode(",", $poll->allowedVoters)) ? "checked"  : ""}}
			>
			<label class="form-check-label" for="">
			    استاذ
			</label>
		    </div>
		</div>

		<hr/>
		
		<div class="input-wrapper">
		    <div class="custom-control custom-switch">
			<input name="active" type="checkbox" {{ $poll->active == 1? "checked" : "" }} class="custom-control-input" id="activeswitch">
			<label class="custom-control-label" for="activeswitch">تفعيل</label>
		    </div>

		</div>

		<button type="submit" class="btn btn-warning btn-block">
		    حفظ التعديل
		    <i class="fa fa-edit"></i>
		</button>
	    </form>

	    </card>
	    
	</div>
    </div>
	    
	    
@endsection


@push("scripts")

@endpush
