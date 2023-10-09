@extends("admin/layout")

@section("title")
    <title>  -  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card ">
	    <card class="card-header bg-success text-center">
		<p class="h3">إضافة سؤال</p>
	    </card>

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


		<button type="button" class="my-2 btn btn-primary add-option float-left">إضافة خيار
		    <i class="fa fa-plus"></i>

		</button>

	    <form method="post" action="/admin/polls/{{ $poll->id }}/add-question">
		@csrf
		
		<div class="input-wrapper">
		    <label for="">السؤال</label>
		    <input class="form-control" name="question_body" type="text" value=""/>
		</div>
		
		<hr/>
		
		<ul class="options">
		</ul>
		

		<button id="submit-edit" class="btn btn-success btn-block">حفظ
		    <i class="fa fa-plus"></i>
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
     console.log("d");
     var element= "<div class='input-wrapper'>"
     element += "<input class='form-control' name='options[]' />";
     element += "<button type='button' class='my-2 btn btn-danger delete-option'>حذف الخيار <i class='fa fa-trash'> </i></button>";
    element += "</div>";

     $("ul.options").append(element);
 });


</script>
@endpush
