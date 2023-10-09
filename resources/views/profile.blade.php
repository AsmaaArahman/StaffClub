<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>الملف الشخصي -  {{ config("app.name") }} </title>
	<link rel="stylesheet" href="{{ asset('css/adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

	
	<link rel="stylesheet" href="{{ asset("/css/bootstraprtl.min.css") }}">
	<link href="{{asset("/css/profile.css")}}" rel="stylesheet"/>
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet"> 

	
    </head>


    <body>

	<div class="content-wrapper profile-wrapper">

	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="/profile">الملف الشخصي - نادي أعضاء هيئة التدريس</a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto">
			

			 @if(isAnyPollsToVote())
			     <li class="mx-2">
				 <a class=" my-1 mt-2 btn btn-warning slide-top" href="/polls">
				     الاستبيانات
				     <i class="fas fa-poll"></i>
				 </a>
			     </li>
			 @endif

			 <li class="mx-2">
			     <a class="btn btn-success" href="/">
				 الرئيسية
				 <i class="fa fa-home"></i>
			     </a>
			 </li> 
			 
			 <li>
			 <a class="btn btn-danger" href="/logout">
			     تسجيل الخروج
			     <i class="fa fa-arrow-left"></i>
			 </a>
			 </li>
		    </ul>
		</div>

	    </nav>
	    
	    <div class="container">

		<div class="row">
		    
		    <div class="side-section col-sm-4">
			<div class="avatar">
			    <img alt="" src="uploads/{{ $user->pic }}"/>
			</div>
			<hr/>


			<div class="side-info">

			   			    
			</div>
			
			
		    </div> <!-- side -->


		    
		    <div class="wide-section col-sm-8">
			<div class="row justify-content-between">
			    <p class="h3">
				{{$user->fullname}}
			    </p>
			    <button id="edit-member" class="mx-1 my-1 btn btn-warning">
				تعديل بياناتي
				<i class="fa fa-edit"></i>
			    </button>

			</div>
			
			
			@if(session()->has("success"))
			    <div class="alert alert-success alert-dismissible ">
				<span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
				{{ session()->get("success") }}
			    </div>
			@endif

			
			@if(session()->has("error"))
			    <div class="alert alert-danger alert-dismissible ">
				{{ session()->get("error") }}
			    </div>
			@endif

			

			<div class="contact-info">

			    <p class="other-color">
				معلومات عامة
			    </p>
			    
			    <table class="table-responsive table contact-info-table">
				<tbody>
				    @if($user->email)
				    <tr>
					<td class="td-key">البريد الإلكتروني</td>
					<td>{{ $user->email }}</td>
				    </tr>
				    @endif

				    
				    @if($user->nat_id)
					<tr>
					    <td class="td-key">الرقم القومي</td>
					    <td>{{ $user->nat_id }}</td>
					</tr>
				    @endif

				    <tr>
					<td class="td-key">الكلية</td>
					<td>{{ $user->faculty }}</td>
				    </tr>

				    
				    @if($user->designation)
					<tr>
					    <td class="td-key"> الوظيفة</td>
					    <td>{{ $user->designation }}</td>
					</tr>
				    @endif

				    @if($user->status)
					<tr>
					    <td class="td-key">الحالة</td>
					    <td>{{ $user->status }}</td>
					</tr>
				    @endif


				    @if($user->phone)
					<tr>
					<td class="td-key">رقم الهاتف</td>
					<td>{{ $user->phone }}</td>
				    </tr>
				    @endif
				    

				    

				    

				    
				</tbody>
			    </table>
			</div> <!-- contact info -->



			<div class="relatives">
			    <div class="row justify-content-between">
				
			    <p class="other-color">
				الأقارب والعائلة
			    </p>

			    <button id="add-relative" class="mx-1 my-1 btn btn-success">
				إضافة أفراد عائلة
				<i class="fa fa-plus"></i>
			    </button>
			    </div>

			    
			    
			    @if(!$user->relatives()->get())
				لا يوجد
			    @else
				<div class="row relatives_gallery">

				    @foreach($user->relatives()->get() as $relative )
					
					<div class="card relative col-md-5">

					    <!-- modals -->
					    <!-- edit relative modal -->
					    <div class="edit-relative-modal modal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
						    <div class="modal-content">
							<div class="modal-header">
							    <h5 class="modal-title">تعديل الأقارب</h5>
							    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							    </button>
							</div>
							<div class="modal-errors"></div>

							<div class="modal-body">
							    <form method="post" id="edit-relative-form"
								  action="/edit-relative/{{ $relative->id }}"
								  enctype="multipart/form-data">
								@csrf
								<div class="input-wrapper">
								    <label for="">الاسم</label>
								    <input class="form-control" name="fullname" type="text" value="{{ $relative -> fullname }}"/>
								</div>
								<div class="input-wrapper">
								    <label for="">الرقم القومي</label>
								    <input class="form-control" name="nat_id" type="text" value="{{ $relative -> nat_id }}"/>
								</div>

								
								
								<div class="input-wrapper">
								    <label for="">السن</label>
								    <input class="form-control" name="age" type="text" value="{{ $relative -> age }}"/>
								</div>

								<div class="input-wrapper">
								    <label for="">صلة القرابة</label>
								    <select name="kinship" class="form-control custom-select">
									
									
									@foreach($kinships as $kinship)

									    <option value="{{$kinship->id }}"
											   {{ $relative->kinship->type ==  $kinship->type?  "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
										    {{ $relative->kinship->type ==  $kinship->type? "selected" : "" }}
									    >  
										{{ $kinship->type == "son"? "ابن" : "" }}
										{{ $kinship->type == "daughter"? "ابنة" : "" }}
										{{ $kinship->type == "father"? "اب" : "" }}
										{{ $kinship->type == "mother"? "أم" : "" }}
										{{ $kinship->type == "sister"? "أخت" : "" }}
										{{ $kinship->type == "brother"? "أخ" : "" }}
										{{ $kinship->type == "husband"? "زوج" : "" }}
										{{ $kinship->type == "wife"? "زوجة" : "" }}

									    </option>
									    
									@endforeach
								    </select>
								</div>

								
								
								<div class="custom-file">
								    <input type="file" class="custom-file-input" id="" name="pic">
								    <label class="custom-file-label" for="">تغيير الصورة</label>
								</div>
								
								
								
							</div>
							
							<div class="modal-footer">
							    <button type="submit" class="btn btn-warning submit-edit-relative-form">تعديل
								<i class="fa fa-edit"></i>
							    </button>
							    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء
								<i class="fa fa-times"></i>
							    </button>
							</div>

							    </form>

						    </div>
						</div>
					    </div> <!-- edit relative modal -->
					    

					    <!-- view relative modal -->
					    <div class="view-relative-modal modal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">

						    <div class="modal-content">
							<div class="modal-header">
							    <h5 class="modal-title">عرض القريب</h5>
							    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							    </button>
							</div>

							<div class="modal-body">
							    <table class="table-responsive table">
								<tr>
								    <td>الاسم</td>
								    <td>{{ $relative->fullname }}</td>
								</tr>

								<tr>
								    <td>الرقم القومي</td>
								    <td>{{ $relative->nat_id }}</td>
								</tr>

								
								<tr>
								    <td> السن</td>
								    <td>{{ $relative->age }}</td>
								</tr>

								<tr>
								    <td>القرابة</td>
								    <td>
									{{ $relative->kinship->type == "son"? "ابن" : "" }}
									{{ $relative->kinship->type == "daughter"? "ابنة" : "" }}
									{{ $relative->kinship->type == "father"? "اب" : "" }}
									{{ $relative->kinship->type == "mother"? "أم" : "" }}
									{{ $relative->kinship->type == "sister"? "أخت" : "" }}
									{{ $relative->kinship->type == "brother"? "أخ" : "" }}
									{{ $relative->kinship->type == "husband"? "زوج" : "" }}
									{{ $relative->kinship->type == "wife"? "زوجة" : "" }}
								    </td>
								</tr>

								

								<tr>
								    <td>الصورة</td>
								    <td><img class="img-thumbnail" src="/uploads/{{$relative-> pic }}" /></td>
								</tr>

								
							    </table>
							</div>
							
							<div class="modal-footer">
							    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
							    <button type="button" class="btn btn-secondary" data-dismiss="modal">
								إغلاق
								<i class="fa fa-times"></i>
							    </button>
							</div>
						    </div> 
						</div>
					    </div><!-- view relative modal -->

					    <!-- end-modals -->
					    
					<img class="card-img-top" src="/uploads/{{$relative->pic }}" alt="الصورة الشخصية">
					<!-- <div class="avatar">
					     <img class="img-thumbnail"
					     alt=""
					     src="{{ $relative->pic }}">
					     </div>
					-->
					    <div class="">
						<table class="table-responsive table">
						    <tr>
							<td>  {{ $relative->fullname }} </td>
						    </tr>
						</table>
					    </div>

					    

					    <div class=" row justify-content-around relative-actions">

						<button class="view-relative btn btn-success">
						    عرض
						    <i class="fa fa-external-link-alt"></i>
						</button>

						<button class="edit-relative btn btn-warning">
						    تعديل
						    <i class="fa fa-edit"></i>
						</button>
						

						<form method="post" class="delete-relative-form form-inline" action="/delete-relative/ {{$relative->id }}">
						    @csrf
						    <button class="delete-relative btn btn-danger submit-delete">
							حذف
							<i class="fa fa-trash-alt"></i>
						    </button>
						</form>

					    </div>
					    

					    
					    
					</div>
					
					
					
					
				@endforeach

				    </div> <!-- card -->

			    @endif
			    
			</div> <!-- relatives -->
			
			
			
		    </div> <!-- info<!--  --> 


		</div>
		
	    </div>
	    
	</div>



	<!-- loop indpendent modals -->

	<!-- add relatvie modal -->
	<div class="add-relative-modal modal" tabindex="-1" role="dialog">
	    <div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
			<h5 class="modal-title">إضافة أفراد العائلة</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
		    </div>

		    <div class="modal-errors"></div>

		    <div class="modal-body">
			<form id="add-relative-form" class="add-relative-form" method="post" action="/add-relative" enctype="multipart/form-data">
			    @csrf
			    
			    
			    <div class="input-wrapper">
				<label for="">الاسم الكامل</label>
				<input type="text" name="fullname" class="form-control" id=""  placeholder="الاسم الكامل" />
			    </div>

			    <div class="input-wrapper">
				<label for="">الرقم القومي</label>
				<input type="text" name="nat_id" class="form-control" id=""  placeholder="الرقم القومي" />
			    </div>

			    
			    <!-- <div class="input-wrapper">
				 <select name="gender" class="custom-select">
				 <option value="male" selected>ذكر</option>
				 <option value="female">أنثى</option>
				 </select>
				 </div>
			    -->
			    <label for="">صلة القرابة</label>
			    <div class="input-wrapper">
				<select name="kinship" class="custom-select">
				    @foreach($kinships as $kinship)

					<option value="{{$kinship->id }}">
					    {{ $kinship->type == "son"? "ابن" : "" }}
					    {{ $kinship->type == "daughter"? "ابنة" : "" }}
					    {{ $kinship->type == "father"? "اب" : "" }}
					    {{ $kinship->type == "mother"? "أم" : "" }}
					    {{ $kinship->type == "sister"? "أخت" : "" }}
					    {{ $kinship->type == "brother"? "أخ" : "" }}
					    {{ $kinship->type == "husband"? "زوج" : "" }}
					    {{ $kinship->type == "wife"? "زوجة" : "" }}

					</option>
					
				    @endforeach
				</select>
			    </div>

			    <div class="input-wrapper">
				<div class="custom-file">
				    <input type="file" class="custom-file-input" id="" name="pic">
				    <label class="custom-file-label" for="">أضف صورة</label>
				</div>
			    </div>

			    
			    
			</form>
		    </div>

		    <div class="modal-footer">
			<button type="submit" form="add-relative-form"  class="btn btn-success">إضافة <i class="fa fa-plus"></i></button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">إلغاء <i class="fa fa-times"></i></button>
		    </div>
		</div>
	    </div>
	</div> <!-- add relatvie modal -->


	<!-- edit member modal -->
	<div class="edit-member-modal modal" tabindex="-1" role="dialog">
	    <div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="modal-header">
			<h5 class="modal-title">تعديل بياناتي</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
		    </div>

		    <div class="modal-errors"></div>
		    
		    <div class="modal-body">
			<form id="edit-member-form" class="edit-member-form" method="post" action="/edit-member/{{ $user->id }}" enctype="multipart/form-data">
			    @csrf

			    
			    <!-- <div class="input-wrapper">
				 <label for="">الاسم بالكامل</label>
				 <input type="text" name="fullname" class="form-control" id=""  value="{{ $user->fullname }}" placeholder="الاسم الكامل" />
				 </div>
			    -->
			    <div class="input-wrapper">
				<label for="">رقم الهاتف</label>
				<input type="text" name="phone" class="form-control" id=""  value="{{ $user->phone }}" placeholder="رقم الهاتف" />
			    </div>

			    <div class="input-wrapper">
				<label for="">كلمة المرور</label>
				<input type="password" name="password" class="form-control" id=""  value="" placeholder="" />
			    </div>
			    
			    {{-- <div class="input-wrapper">
				<label for="">الكلية</label>
				<select name="faculty" class="form-control custom-select">
				    @foreach(\App\Models\Faculty::all() as $fac)
					<option value="{{$fac->name }}" {{$user->faculty == $fac->name ? "selected" : "" }}>
					    {{$fac->name}}
					</option>
				    @endforeach
				</select>
			    </div>   --}}

			    <!-- 
				 <div class="input-wrapper">
				 <label for="">الجنس</label>
				 <select name="gender" class="custom-select">
				 <option value="male" {{ $user->gender=="male"? "selected" : "" }}>ذكر</option>
				 <option value="female"  {{ $user->gender=="female"? "selected" : "" }} >أنثى</option>
				 </select>
				 </div>
			    -->
			    <div class="custom-file">
				<input type="file" class="custom-file-input" id="" name="pic">
				<label class="custom-file-label" for="">تغيير الصورة</label>
			    </div>			    
			    
			    
			</form>
		    </div>

		    <div class="modal-footer">
			<button type="submit" form="edit-member-form" type="button" class="btn btn-warning">
			    تعديل
			    <i class="fa fa-edit"></i>
			</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">إلغاء <i class="fa fa-times"></i></button>
		    </div>
		</div>
	    </div>
	</div> <!-- edit member modal -->

	
	
	


	
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="{{ asset("scripts/jquery.min.js") }}" ></script>
	<script src="{{ asset("scripts/bootstraprtl.bundle.min.js") }}" ></script>

	<script>

	 $(".edit-relative").on("click", function() {
	     $(this).closest(".relative").children(".edit-relative-modal").modal("toggle");
	 });
	 
	 $(".view-relative").on("click", function() {
	     $(this).closest(".relative").children(".view-relative-modal").modal("toggle");
	 });

	 
	 $("#add-relative").on("click", function() {
	     $(".add-relative-modal").modal("toggle");
	 });

	 $("#edit-member").on("click", function() {
	     $(".edit-member-modal").modal("toggle");
	 });
	 

	</script>
	


	{{-- handle if validation errors occured in edit member modal --}}
	@if($errors->any()  && session()->has("edit-member-errors"))
	    <script>
	     $(".edit-member-modal").modal("toggle");
	     var error_element= "<div class='alert alert-danger' >";
	     error_element += "<ul>";

	     @foreach($errors->all() as $error)
	     error_element += "<li> " + "{{ $error }}" + "</li>";
	     @endforeach

	     error_element += "</ul>";
	     error_element += "</div>";
	     
	     $(".edit-member-modal div.modal-errors").append(error_element);
	    </script>
	@endif

	@if($errors->any() && session()->has("add-relative-errors"))
	    <script>
	     $(".add-relative-modal").modal("toggle");
	     var error_element= "<div class='alert alert-danger' >";
	     error_element += "<ul>";

	     @foreach($errors->all() as $error)
	     error_element += "<li> " + "{{ $error }}" + "</li>";
	     @endforeach

	     error_element += "</ul>";
	     error_element += "</div>";
	     
	     $(".add-relative-modal div.modal-errors").append(error_element);
	    </script>
	@endif

	@if($errors->any() && session()->has("edit-relative-errors"))
	    <script>
	     $(".edit-relative-modal").modal("toggle");
	     var error_element= "<div class='alert alert-danger' >";
	     error_element += "<ul>";

	     @foreach($errors->all() as $error)
	     error_element += "<li> " + "{{ $error }}" + "</li>";
	     @endforeach

	     error_element += "</ul>";
	     error_element += "</div>";
	     
	     $(".edit-relative-modal div.modal-errors").append(error_element);
	    </script>
	@endif


	<script>
	 $("button.submit-delete").on("click", function(e) {
	     e.preventDefault();
	     var confirm_delete= confirm("هل أنت واثق من أنك تريد متابعة الحذف؟");
	     if(confirm_delete) {
		 $(this).closest("form").submit();
	     }else {
		 return false;
	     } 
	 });

	</script>
	
	
    </body>

</html>
