@extends("admin/layout")


@section("title")
    <title>تعديل مشرف-  {{ config("app.name") }} </title>
@endsection


@section("content")

    <div class="card">

	<div class="card">
	    <div class="mb-4 text-center card-header bg-warning">
		<p class="h3">
		    تعديل مشرف
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
	
	
	<form method="post" action="/admin/mods/edit/{{ $mod->id }}" enctype="multipart/form-data">
	    @csrf
	    <div class="input-wrapper">
		<label for="">الاسم الكامل</label>
		<input class="form-control" name="fullname" type="text" value="{{ $mod->fullname }}"/>
	    </div>

	    <div class="input-wrapper">
		<label for="">الرقم القومي</label>
		<input class="form-control" name="nat_id" type="text" value="{{ $mod->nat_id }}"/>
	    </div>

	    <div class="input-wrapper">
		<label for="">رقم الهاتف</label>
		<input class="form-control" name="phone" type="text" value="{{ $mod->phone}}"/>
	    </div>

	    
	    <div class="input-wrapper">
		<label for="">كلمة السر</label>
		<input class="form-control" name="password" type="password" value=""/>
	    </div>
	    
	    
	    @if(isAllowed(["admin"]))
		<div class="input-wrapper">
		<label for="">الرتبة</label>

		<select name="role" class="custom-select">
		    <option {{ $mod->role=="1"? "selected" : "" }} value="1">مدير</option>
		    <option  {{ $mod->role=="2"? "selected" : "" }} value="2" >مشرف</option>
		    <option  {{ $mod->role=="3"? "selected" : "" }} value="3" >ريسبشن/اخرى</option>

		</select>
	    </div>
	    @endif
	    
	    <div class="input-wrapper">
		<label for="">الجنس</label>
		<select name="gender" class="custom-select">
		    <option value="male" {{ $mod->gender=="male"? "selected" : "" }}>ذكر</option>
		    <option value="female"  {{ $mod->gender=="female"? "selected" : "" }} >أنثى</option>
		</select>
	    </div>
	    
	    <div class="input-wrapper">
		<label for="">الصورة</label>
		<div class="custom-file">
		    <input type="file" class="custom-file-input" id="" name="pic">
		    <label class="custom-file-label" for="">تغيير الصورة</label>
		</div>
	    </div>
	    
	    <button class="btn btn-warning btn-block">تعديل
		<i class="fa fa-edit"></i>
	    </button>

	    
	</form>
	    </div>    
	    
    </div>
    
@endsection

