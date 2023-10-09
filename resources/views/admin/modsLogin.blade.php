<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>تسجيل الدخول للمشرفين -  {{ config("app.name") }} </title>

	
	<link rel="stylesheet" href="{{ asset("/css/bootstraprtl.min.css") }}">

	<link href="{{asset("css/admin_login.css")}}" rel="stylesheet"/>
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet"> 
    </head>
    <!-- viewBox="0 0 135.128 138.68401" -->
    <!-- viewBox="91 11 102 145" -->

    <body>

	
	<svg
	    class="d-none d-md-block"
	    xmlns:dc="http://purl.org/dc/elements/1.1/"
	    xmlns:cc="http://creativecommons.org/ns#"
	    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	    xmlns:svg="http://www.w3.org/2000/svg"
	    xmlns="http://www.w3.org/2000/svg"
	    xmlns:xlink="http://www.w3.org/1999/xlink"
	    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
	    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
	    viewBox="0 0 135.128 138.68401"
		      version="1.1"
	    id="svg8"
	    inkscape:version="1.0.1 (3bc2e813f5, 2020-09-07)"
	    sodipodi:docname="drawing.svg"
	    inkscape:export-filename="/home/walid/drawing.png"
	    inkscape:export-xdpi="96"
	    inkscape:export-ydpi="96">
	    <defs
		id="defs2">
		<linearGradient
		    inkscape:collect="always"
		    id="linearGradient70">
		    <stop
			style="stop-color:#5565d9;stop-opacity:1"
			offset="0"
			id="stop66" />
		    <stop
			style="stop-color:#e28b97;stop-opacity:1"
			offset="1"
			id="stop68" />
		</linearGradient>
		<linearGradient
		    inkscape:collect="always"
		    xlink:href="#linearGradient70"
		    id="linearGradient72"
		    x1="84.739883"
		    y1="63.174046"
		    x2="77.813339"
		    y2="145.58824"
		    gradientUnits="userSpaceOnUse"
		    gradientTransform="translate(-32.886916,-27.606078)" />
	    </defs>
	    <sodipodi:namedview
		id="base"
		pagecolor="#ffffff"
		bordercolor="#666666"
		borderopacity="1.0"
		inkscape:pageopacity="0.0"
		inkscape:pageshadow="2"
		inkscape:zoom="0.51894833"
		inkscape:cx="22.05393"
		inkscape:cy="505.39092"
		inkscape:document-units="mm"
		inkscape:current-layer="layer1"
		inkscape:document-rotation="0"
		showgrid="false"
		inkscape:window-width="1364"
		inkscape:window-height="751"
		inkscape:window-x="0"
		inkscape:window-y="15"
		inkscape:window-maximized="0"
		units="in"
		width="3.5in" />
	    <metadata
		id="metadata5">
		<rdf:RDF>
		    <cc:Work
			rdf:about="">
			<dc:format>image/svg+xml</dc:format>
			<dc:type
			    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
			<dc:title></dc:title>
		    </cc:Work>
		</rdf:RDF>
	    </metadata>
	    <g
		inkscape:label="Layer 1"
				inkscape:groupmode="layer"
				id="layer1">
		<ellipse
		    style="fill:url(#linearGradient72);fill-opacity:1;fill-rule:evenodd;stroke-width:0.281051"
		    id="path10"
		    cx="67.905357"
		    cy="69.855164"
		    rx="66.455132"
		    ry="68.313339" />
		<ellipse
		    style="fill:#ffffff;stroke-width:0.403871"
		    id="path14"
		    cx="69.191994"
		    cy="69.642654"
		    rx="61.692879"
		    ry="64.865067" />
	    </g>
	</svg>

	
	<nav class="navbar navbar-expand-lg navbar-light ">
	    <a class="navbar-brand" href="/profile">نادي أعضاء هيئة التدريس</a>
	    
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto ml-auto">
		    <li class="nav-item">
			<a class="nav-link" href="/">الرئيسية</a>
		    </li>
		    <li class="nav-item">
			<a class="nav-link" href="/admin">لوحة التحكم</a>

		    </li>
		</ul>
		
	    </div>

	</nav>

	
	<div class="container">


	    
	    <div class="login-wrapper content-wrapper">
		
		<div class="form-wrapper">

	    	    <p class="h1 title">تسجيل الدخول للمشرفين </p>

		    <div class="errors">

			@if($errors->any())
			    <div class="alert alert-danger">
				@foreach($errors->all() as $error)
				    <li>{{$error}}</li>
				@endforeach
			    </div>
			@endif
		    </div>

		    
	    <form method="post" action="/admin/mods/login">
		@csrf
		
		
		<div class="input-wrapper">
		    <input type="text" name="nat_id" class="form-control" id=""  placeholder="الرقم القومي" value="{{ old("nat_id") }}"}}">
		</div>
		
		    <div class="input-wrapper">
			<input type="password" name="password" class="form-control" id=""  placeholder="كلمة المرور">
		    </div>

		    <button class="btn btn-primary login-btn">متابعة</button>
		    
	    </form>
		</div>
	    </div>

	    
	</div>
	

	
	<script src="{{ asset("scripts/jquery.min.js") }}" ></script>
	<script src="{{ asset("scripts/bootstraprtl.bundle.min.js") }}" ></script>

    </body>
</html>
