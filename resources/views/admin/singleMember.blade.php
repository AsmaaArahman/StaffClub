@extends("admin/layout")


@push("style")
<style>
.card {
    padding: 40px;
 }

</style>
@endpush

@section("content")


    <div class="card">

	<div class="card-header bg-primary text-center">
	    <p class="h3">	
		{{$member->fullname }}
	    </p>
	</div>


	
	<div class="card-body">

	    <div class="row">
		<div class="col-sm-6">
		    <table class="table-responsive table">
			
			<tbody>
			    
			    <tr>
				<td>الاسم الكامل</td>
				<td>{{ $member->fullname }}</td>
			    </tr>

			    <tr>
				<td>الرقم القومي</td>
				<td>{{ $member->nat_id }}</td>
			    </tr>

			    
			    <tr>
				<td>رقم الهاتف</td>
				<td>{{ $member->phone }}</td>
			    </tr>

			    <tr>
				<td>الكلية</td>
				<td>{{ $member->faculty }}</td>
			    </tr>
			    
			    <tr>
				<td>الوظيفة</td>
				<td>{{ $member->designation }}</td>
			    </tr>

			    <td>الحالة</td>
			    <td>{{ $member->status }}</td>
			    </tr>

			    <!-- 
				 <tr>
				 <td>الصورة الشخصية</td>
				 <td><img src="/uploads/{{ $member->pic }}"/></td>
				 </tr>
			    -->
			    
			    <tr>
				<td>الأقارب</td>
				<td>
				    <ul>
					@foreach($member->relatives()->get() as $relative)
					    <div class="relative">
						<li>
						    {{ $relative->fullname }}
						    <button  class="btn btn-primary view-relative">عرض
							<i class="fa fa-external-link-alt"></i>
						    </button>
						    <!-- <button class="btn btn-warning edit-relative">تعديل</button> -->


						</li>


						<!-- view relative modal -->
						<div class="view-relative-modal modal" tabindex="-1" role="dialog">
						    <div class="modal-dialog" role="document">
							<div class="modal-content">
							    <div class="modal-header">
								<h5 class="modal-title">عرض القريب</h5>
								<button type="button" class="btn" data-dismiss="modal" aria-label="Close">
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
									<td><img class="img-thumbnail" src="/uploads/{{ $relative-> pic }}" /></td>
								    </tr>

								</table>
							    </div>
							    
							    <div class="modal-footer">
								<button type="button" class="my-2 btn btn-secondary" data-dismiss="modal">إغلاق
								    <i class="fa fa-times"></i>
								</button>
							    </div>
							</div> 
						    </div>
						</div><!-- view relative moda -->



						
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
								<button type="submit" class="btn btn-warning submit-edit-relative-form">تعديل</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							    </div>

								</form>

							</div>
						    </div>
						</div> <!-- edit relative modal -->
					    </div>
					    
					@endforeach
				    </ul>
				    
				</td>
			    </tr>
			    
			    
			    
			</tbody>
		    </table>
		    
		    </div> <!-- end right side -->

		    <div class="col-sm-6">
			<div class="w-100">
			    <img src="/uploads/{{ $member->pic }}"/>
			    
			</div>
		    </div>
	    </div> <!-- end row -->
	    
	    @if(!isAllowed(["admin", "normal_mod"]))
	    @else
		<a href="/admin/members/edit/{{ $member->id }}">
		    <button class="btn btn-warning">
			تعديل
			<i class="fa fa-edit"></i>

		    </button>
		</a>
	    @endif
	    
	    @if(!isAllowed(["admin"]))
	    @else
		
		<form class="d-inline" method="post" action="/admin/members/delete/{{$member->id }}">
		    @csrf
		    <button type="submit" class="submit-delete btn btn-danger">
			حذف
			<i class="fa fa-trash"></i>
		    </button>
		</form>
	    @endif


	</div>
    </div>


				    
    
    @push("scripts")
    <script>
     $(".view-relative").on("click", function() {
	 /* $("#view-relative-modal").modal("toggle"); */
	 $(this).closest(".relative").children(".view-relative-modal").modal("toggle");

	 
     });

     $(".edit-relative").on("click", function() {
	 $(this).closest(".relative").children(".edit-relative-modal").modal("toggle");
     });

     
     /* $("#edit-relative").on("click", function() {
	$("#edit-relative-modal").modal("toggle");
      * });
      */
    </script>
    @endpush
    
@endsection
