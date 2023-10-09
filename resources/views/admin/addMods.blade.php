@extends("admin/layout")


@section("title")
    <title>إضافة مشرف-  {{ config("app.name") }} </title>
@endsection


@section("content")

    <div class="card">

	<div class="card-header bg-success text-center">
	    <p class="h3">	
		إضافة مشرف
	    </p>
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
	

	<form method="post" action="/admin/mods/add-mod" enctype="multipart/form-data">
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
		<label for="">الرتبة</label>

		<select name="role" class="custom-select">
		    <option value="1">مدير</option>
		    <option value="2" >مشرف</option>
		    <option value="3" >ريسبشن/اخرى</option>

		</select>
	    </div>

	    
	    <div class="input-wrapper">
		<label for="">الجنس</label>

		<select name="gender" class="custom-select">
		    <option value="male">ذكر</option>
		    <option value="female" >أنثى</option>
		</select>
	    </div>

	    <div class="input-wrapper">
		<label for="">الصورة</label>
		<div class="custom-file">
		    <input type="file" class="custom-file-input" id="" name="pic">
		    <label class="custom-file-label" for="">تغيير الصورة</label>
		</div>
	    </div>
	    
	    <button class="btn btn-success btn-block">إضافة
		<i class="fa fa-plus"></i>
	    </button>

	    
	</form>
	</div>
    </div>
    
@endsection

