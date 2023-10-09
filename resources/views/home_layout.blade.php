<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            {{config('app.name') }}
        </title>
        <link rel="stylesheet" href="{{asset('/css/home.css') }}">
	<link rel="stylesheet" href="{{ asset("/css/bootstraprtl.min.css") }}">
	<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="{{ asset('css/adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

	<link href="{{asset('/css/home.css') }}" rel="stylesheet"/>
	
	<style>

	 body {
	     font-family: 'Almarai', sans-serif;

	 } 
	 
	 .slider .carousel-one{
	     background-image: url("{{asset('/assets/back.PNG')}}");
	     background-size: cover;
	     background-position: center;
	     
	 }
	 .slider .carousel-two{
	     background-image: url("{{asset('/assets/back2.PNG')}}");
	     background-size: cover;
	     background-position: center;
	 }
	 
	 span.uni-span {
	     margin-top: 10px;
	     border-radius: 6px;
	 }
	</style>
    </head>
    <body>
        <!-- Start Upper Bar -->
        <section class="upper-bar">
          
        </section>
        <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="mainnav">
		    
                    <ul class="navbar-nav ml-auto">
			@if(isMemberLogin())
			    <li class="nav-item">
				<a class="nav-link" href="/profile">الملف الشخصي</a>
			    </li>
			@else 
			    <li class="nav-item">
				<a class="nav-link" href="/login">تسجيل الدخول للأعضاء</a>
                            </li>
			@endif
			@if(isModLogin())
			      <li class="nav-item">
				  <a class="nav-link" href="/admin">لوحة التحكم</a>
                              </li>
			@else
			    <li class="nav-item">
				<a class="nav-link" href="/admin/mods/login">تسجيل الدخول للمشرفين</a>
                            </li>
			@endif
                    </ul>
                </div>
                <a class="navbar-brand" href="#" style="float: left;">
                    <img src="{{asset('/assets/logo.png')}}" width="50px" height="50px" alt="">   
                 </a>
            </div>
        </nav>
        <!-- Start Slider -->
        <div class="slider">
            <div id="main-slider" class="carousel slide" data-ride="carousel">                
                <ol class="carousel-indicators">
                    <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#main-slider" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <h1>نادي اعضاء هيئة التدريس<br> <span class="uni-span">بجامعة سوهاج</span>
                      </h1>
                     <div class="overlay"></div>
                    <div class="carousel-item carousel-one active">
                    </div>
                    <div class="carousel-item carousel-two">
                    </div>
                </div>
            </div>
        </div>

	@yield("content")
	
        <!-- Start Footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                   
                    <div class="col-sm-6 col-lg-4 ">
                        <div class="contact">
                            <h2>للتواصل معنا</h2>
                            <ul class="list-unstyled">
                                <li>  <strong>العنوان:</strong> اخميم - الصوامعه، قسم ثان سوهاج، سوهاج      </li>
                                <li>  <strong>الموبيل:</strong> +20934603218  </li>
                                <!-- <li> <strong>الايميل:</strong> <a href="#">info@info.com</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8 ">
                        <div class="site-info">
                            <h2><span>نادي اعضاء هيئة التدريس</span><span> بجامعة سوهاج </span></h2>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3568.517130061325!2d31.708884585450555!3d26.56777608125087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x144f5eb06d31667d%3A0xf987511abbc6dd9e!2z2YbYp9iv2Ykg2KfYudi22KfYoSDZh9mK2KbYqSDYp9mE2KrYr9ix2YrYsw!5e0!3m2!1sar!2seg!4v1609409906046!5m2!1sar!2seg" width="100%" height="450" frameborder="0" style="border:2px solid #eeeeee;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Copyright -->
        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 text-center text-sm-right text-uppercase">
                        <p>وحدة البرمجيات - مركز الخدمات الالكترونية و المعرفية - جامعة سوهاج</p>
			 <p class="text-center"> مدير مركز الخدمات : ا. د محمود ابو العز</p>
                         <p class="text-center">مدير الوحدة : المهندسة أسماء أبوالدهب </p>
		    </div>
                    <div class="col-sm-6 text-center text-sm-left">
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://www.facebook.com/sohagstaffclub/"><i class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

	<script src="{{ asset("scripts/jquery.min.js") }}" ></script>
	<script src="{{ asset("scripts/bootstraprtl.bundle.min.js") }}" ></script>

	<script>
	 $(function(){
	     'use strict';
	     //adjust slider height    
	     var winH    = $(window).height(),
		 upperH  = $('.upper-bar').innerHeight(),
		 navH    = $('.navbar').innerHeight();
	     $('.slider, .carousel-item').height(winH - ( upperH + navH ));
	 });
	</script>
	
    </body>
</html>
