@extends("admin/layout")


@section("title")
    <title>إضافة عضو-  {{ config("app.name") }} </title>
@endsection


@section("content")

    <div class="card">

	<div class="mb-4 text-center card-header bg-primary">
	    <p class="h3">
		إضافة عضو

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
	    <form method="post" action="/admin/members/add" enctype="multipart/form-data">
		@csrf
		<div class="input-wrapper">
		    <label for="">الاسم الكامل</label>
		    <input class="form-control" name="fullname" type="text" value=""/>
		</div>

		<div class="input-wrapper">
		    <label for="">الرقم القومي</label>
		    <input class="form-control" name="nat_id" type="text" value=""/>
		</div>

		<div class="input-wrapper">
		    <label for="">رقم الهاتف</label>
		    <input class="form-control" name="phone" type="text" value=""/>
		</div>

		
		<div class="input-wrapper">
		    <label for="">كلمة السر</label>
		    <input class="form-control" name="password" type="password" value=""/>
		</div>
		
		
		<div class="input-wrapper">
		    <label for="">الجنس</label>

		    <select name="gender" class="custom-select">
			<option value="male">ذكر</option>
			<option value="female" >أنثى</option>
		    </select>
		</div>

		<div class="input-wrapper">
		    <label for="">الوظيفة</label>
		    <input class="form-control" name="designation" type="text" value=""/>

		</div>

		<div class="input-wrapper">
		    <label for="">حالة العمل</label>
		    <input class="form-control" name="status" type="text" value=""/>

		</div>

		
		<div class="input-wrapper">
		    <label for="">الكلية</label>
		    <select name="faculty" class="form-control custom-select">
			@foreach(\App\Models\Faculty::all() as $fac)
			    <option value="{{$fac->name }}">
				{{$fac->name}}
			    </option>
			@endforeach
		    </select>
		</div>
		
		<div class="input-wrapper">
		    <label for="">الصورة</label>
		    <div class="custom-file">
			<input type="file" class="custom-file-input" id="" name="pic">
			<label class="custom-file-label" for="">تغيير الصورة</label>
		    </div>
		</div>
		
		<button class="btn btn-success">إضافة
		    <i class="fa fa-plus"></i>
		</button>

		
	    </form>
	</div>
    </div>
    
@endsection

