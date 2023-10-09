<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@yield("title")
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('css/adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="{{ asset('css/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('css/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{asset('css/adminlte3/plugins/jqvmap/jqvmap.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('css/adminlte3/dist/css/adminlte.min.css')}}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset('css/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{asset('css/adminlte3/plugins/daterangepicker/daterangepicker.css')}}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{asset('css/adminlte3/plugins/summernote/summernote-bs4.css')}}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet"> 

	{{-- NOTE(walid): the condition statement maybe needed in bilingual; --}}
	@if(true)
	    <link rel="stylesheet" href="{{asset('css/adminlte3/dist_rtl/css/adminlte.min.css')}}">
	    <link rel="stylesheet" href="{{asset('css/adminlte3/dist_rtl/css/bootstrap-rtl.min.css')}}">
	    <link rel="stylesheet" href="{{asset('css/adminlte3/dist_rtl/css/custom-style.css')}}">
	    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"/>

	    
	@endif
	
	@stack("style")
	
    </head>
    <body class="hold-transition sidebar-mini layout-fixed ">
	<div class="wrapper">







	    <!-- Navbar -->
	    <nav class="main-header navbar navbar-expand navbar-light color-black">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
		    <li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		    </li>
		    <li class="nav-item d-none d-sm-inline-block">
			<a href="/admin" class="nav-link">الرئيسية</a>
		    </li>

		    <li class="nav-item d-none d-sm-inline-block">
			<a href="/admin/mods/logout" class="nav-link">تسجيل الخروج</a>
		    </li>
		</ul>

		<!-- SEARCH FORM -->
		<form class="header-search-form" method="get" action="/admin/search">
		    <div class="input-group input-group-sm">
			<input name="q" class="form-control form-control-navbar" type="search" placeholder="ابحث عن عضو" aria-label="Search">
			<div class="input-group-append">
			    <button class="btn btn-navbar" type="submit">
				<i class="fas fa-search"></i>
			    </button>
			</div>
		    </div>
		</form>

		    </nav>
	    <!-- /.navbar -->




	    
