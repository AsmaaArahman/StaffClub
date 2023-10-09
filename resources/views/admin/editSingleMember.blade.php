@extends("admin/layout")

@push("style")
<style>
 .card-header p {
     font-family: 'Almarai'  !important ;
 }
</style>
@endpush

@section("content")

    
    <div class="card">

	
	<div class="mb-4 text-center card-header bg-warning">
	    <p class="h3">
		تعديل بيانات العضو
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

	    <div class="my-4 float-left ">

		@if(!isAllowed(["admin"]))
		    <button type="submit" class="submit-delete disabled btn btn-danger">
			حذف
			<i class="fa fa-trash"></i>
		    </button>

		@else
		<form class="d-inline " method="post" action="/admin/members/delete/{{$member->id }}">
		    @csrf
		    <button type="submit" class="submit-delete btn btn-danger">
			حذف
			<i class="fa fa-trash"></i>
		    </button>
		</form>
		@endif

	    </div>

	    <div class="clearfix"></div>

	    
	    <form id="edit-member-form" class="edit-member-form" method="post" action="/admin/members/edit/{{ $member->id }}" enctype="multipart/form-data">
		@csrf

		
		<div class="input-wrapper">
		    <label for="">الاسم الكامل</label>
		    <input type="text" name="fullname" class="form-control" id=""  value="{{ $member->fullname }}" placeholder="الاسم الكامل" />
		</div>
		
		<div class="input-wrapper">
		    <label for="">الرقم القومي</label>
		    <input class="form-control" name="nat_id" type="text" value="{{$member->nat_id}}"/>
		</div>

		
		<label for="">رقم الهاتف</label>
		<div class="input-wrapper">
		    <input type="text" name="phone" class="form-control" id=""  value="{{ $member->phone }}" placeholder="رقم الهاتف" />
		</div>

		<label for="">كلمة المرور</label>
		<div class="input-wrapper">
		    <input type="password" name="password" class="form-control" id=""  value="" placeholder="" />
		</div>

		<label for="">الجنس</label>
		<div class="input-wrapper">
		    <select name="gender" class="custom-select">
			<option value="male" {{ $member->gender=="male"? "selected" : "" }}>ذكر</option>
			<option value="female"  {{ $member->gender=="female"? "selected" : "" }} >أنثى</option>
		    </select>
		</div>

		
		<div class="input-wrapper">
		    <label for="">المسمى الوظيفي</label>
		    <input class="form-control" name="designation" type="text" value="{{$member->designation }}"/>

		</div>

		<div class="input-wrapper">
		    <label for="">حالة العمل</label>
		    <input class="form-control" name="status" type="text" value="{{$member->status }}"/>

		</div>


		
		<div class="input-wrapper">
		    <label for="">الكلية</label>
		    <select name="faculty" class="form-control custom-select">
			@foreach(\App\Models\Faculty::all() as $fac)
			    <option value="{{$fac->name }}" {{$member->faculty == $fac->name ? "selected" : "" }}>
				{{$fac->name}}
			    </option>
			@endforeach
		    </select>
		</div>

		
		<label for="">الصورة</label>

		<div class="input-wrapper">
		    <div class="custom-file">
			<input type="file" class="custom-file-input" id="" name="pic">
			<label class="custom-file-label" for="">تغيير الصورة</label>
		    </div>
		</div>
		

		<button class="btn btn-warning btn-block">
		    حفظ التعديل
		    <i class="fa fa-edit"></i>
		</button>
		
		
		
	    </form>
	</div>	
    </div>


    
    
    @push("scripts")
    <script>
     $("#view-relative").on("click", function() {
	 $("#view-relative-modal").modal("toggle");

     });
    </script>
    @endpush
    
@endsection
