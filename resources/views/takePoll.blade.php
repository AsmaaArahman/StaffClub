<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>الاستبيانات -  {{ config("app.name") }} </title>
	
	<link rel="stylesheet" href="{{ asset("/css/bootstraprtl.min.css") }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

	<link href="{{asset("/css/profile.css")}}" rel="stylesheet"/>
	<link href="{{ asset('/css/takePoll.css') }}" rel="stylesheet"/>
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

			<a href="/profile" id="" class="mx-1 my-1 btn btn-primary">
			    الرجوع
			    <i class="fa fa-arrow-left"></i>
			</a>
		    </ul>
		</div>

	    </nav>

	    
	    <div class="container">

		<div class="poll" data-id ="{{ $poll->id }}">
		@foreach($poll->questions()->get() as $question)
		    <div class="question" data-question-id="{{ $question->id }}">
			<div class="question_body">
			    {{ $question->question_body }}
			</div>
			<hr/>
			@foreach($question->options()->get() as $option)
			    <div class="option">
				<label for="">{{ $option->option_body }}</label>
				<input type="radio" id="male" name="poll{{$question->id}}" value="{{ $option->id }}">
			    </div>
			@endforeach
		    </div>
		@endforeach
		</div>
		
		<button class="btn btn-success btn-block send">إرسال</button>
	    </div>
	    
	    



	    <script src="{{ asset("/scripts/jquery.min.js") }}" ></script>
	    <script src="{{ asset("/scripts/bootstraprtl.bundle.min.js") }}" ></script>


	<script>
	 $("button.send").on("click", function() {
	     var answers= {};
	     var questions= $("div.poll .question");
	     questions.each(function() {
		 var qid= $(this).data("question-id");
		 var options= $(this).find(".option");
		 options.each(function() {
		     var radio_input = $(this).find("input");
		     if(radio_input.is(":checked")) {
			 answers[qid] = radio_input.val();
		     }
		 });
		 if(answers[qid] == undefined ) {
		     alert("لا يمكنك ترك السؤال فارغا!");
		     console.log(answers)
		     throw new Error("error");
		 }
		 
	     });

	     var final_data= {
		 _token: "{{ csrf_token() }}",
		 poll_id: $(".poll").data("id"),
		 answers: answers
	     } 

	     $.ajax({
		 type: "POST",
		 url: "/polls/save-answers",
		 data: final_data,
		 success: function(result) {
		     if(result == "success") { 
			 window.location= "/profile";
		     } else {
			 console.log("error");
			 alert("error\n", result);

		     }
		 },
		 error: function(req, status, error) {
		     console.log("error");
		 } 
		 
	     });
	     
	 });
	</script>
	
    </body>

</html>
