@extends("admin/layout")

@section("title")
    <title>  -  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card ">

	    <div class="mb-4 text-center card-header bg-warning">
		<p class="h3">
		    تعديل سؤال
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


		
	    <form method="post" action="/admin/questions/edit/{{$question->id}}">
		@csrf
		<div class="input-wrapper">
		    <label for="">السؤال</label>
		    <input class="form-control" name="question_body" type="text" value="{{ $question->question_body }}"/>

		</div>
		<button type="button" class=" float-left btn btn-primary add-option">إضافة خيار
		    <i class="fa fa-plus"></i>
		</button>
		<div class="clearfix"></div>
		<hr/>
		
		<ul class="options">
		    @foreach($question->options()->get() as $option)
			
			<div class="input-wrapper">
			    <input class="form-control" name="options[]" type="text" value="{{ $option->option_body }}"/>
			    <button type="button" class="my-2 btn btn-danger delete-option">حذف الخيار
				<i class="fa fa-trash"></i>
			    </button>
			</div>
		    @endforeach
		</ul>
		

		<button id="submit-edit" class="btn btn-warning btn-block">
		    حفظ التعديل
		    <i class="fa fa-edit"></i>
		</button>
	    </form>
	    </div>
	</div>

    </div>

@endsection


@push("scripts")

<script>
 $(document).on("click","button.delete-option", function() {
     $(this).closest(".input-wrapper").remove();
 });
 
 $("button.add-option").on("click", function() {
     var element= "<div class='input-wrapper'>"
     element += "<input class='form-control' name='options[]' />";
     element += "<button type='button' class='my-2 btn btn-danger delete-option'>حذف الخيار <i class='fa fa-trash'> </i></button>";
     
     element += "</div>";
     $("ul.options").append(element);
 });


</script>
@endpush
