<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>الاستبيانات -  {{ config("app.name") }} </title>


	<link rel="stylesheet" href="{{ asset("/css/bootstraprtl.min.css") }}">
	<link href="{{asset("css/profile.css")}}" rel="stylesheet"/>

	<link rel="stylesheet" href="{{ asset('css/adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

	
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
		@foreach($active_polls as $poll)
		    @if(memberAllowedToVote(session()->get("user"), $poll))
			<a href="/polls/{{$poll->id}}">
			    <p class="h3"> {{ $poll->title }}</p>
			</a>
			<p class="h5 text-secondary">{{$poll->desc }}</p>

		    @endif
		@endforeach
	    </div>
	    
	    


	    <script src="{{ asset("/scripts/jquery.min.js") }}" ></script>
	    <script src="{{ asset("/scripts/bootstraprtl.bundle.min.js") }}" ></script>
	    
	    
	
	
    </body>

</html>
