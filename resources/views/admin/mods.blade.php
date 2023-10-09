@extends("admin/layout")


@section("title")
    <title>المشرفين -  {{ config("app.name") }} </title>
@endsection


@section("content")

    
    <div class="card">

	<div class="mb-4 text-center card-header bg-primary">
	    <p class="h3">
		المشرفين
	    </p>
	</div>
	

	<div class="card-body">

	    @if(session()->has("success"))
		<div class="alert alert-success alert-dismissible ">
		    {{ session()->get("success") }}
		</div>
	    @endif

	    
	    @if(session()->has("error"))
		<div class="alert alert-danger alert-dismissible ">
		    {{ session()->get("error") }}
		</div>
	    @endif

	    @if(!isAllowed(["admin"]))
		<a href="/admin/mods/add-mod/" class="btn disabled btn-primary float-left">
		    إضافة مشرف
		    <i class="fa fa-plus"></i>
		</a>	    
	    @else
		<a href="/admin/mods/add-mod/" class="btn btn-primary float-left">
		    إضافة مشرف
		    <i class="fa fa-plus"></i>
		</a>
	    @endif

	<table class="table-responsive table text-center">
	    
	    <thead>
		<tr>
		    <th>الاسم الكامل</th>
		    <th>الرقم القومي</th>
		    <th>الرتبة</th>
		    <th>خيارات</th>
		</tr>
	    </thead>

	    <tbody>
		@foreach($mods as $mod)
		    <tr>
			<td> <a href="/admin/mods/{{ $mod->id}}">{{$mod->fullname }}</a></td>
			<td>{{$mod->nat_id }}</td>
			<td>{{$mod->role == "1"? "مدير" : ""}}
			    {{ $mod->role=="2" ? "مشرف" : ""}}
			    {{ $mod->role == "3" ? "ريسبشن/اخرى" : ""}}</td>

			
			<td>
			    @if(!isAllowed(["admin"]) && session()->get("user")->id != $mod->id )
				<a class="btn disabled btn-warning" href="/admin/mods/edit/{{ $mod->id }}">
				    تعديل
				    <i class="fa fa-edit"></i>
				</a>
			    @else
				<a class="btn btn-warning" href="/admin/mods/edit/{{ $mod->id }}">
				    تعديل
				    <i class="fa fa-edit"></i>
				</a>
			    @endif
			    
			    @if(!isAllowed(["admin"]))
			    <form method="post" class="d-inline" action="/admin/mods/delete/{{ $mod->id }}">
				@csrf
				<button class="submit-delete btn disabled btn-danger">
				    حذف
				    <i class="fa fa-trash"></i>
				</button>
			    </form>
			    @else
			    <form method="post" class="d-inline" action="/admin/mods/delete/{{ $mod->id }}">
				@csrf
				<button class="submit-delete btn btn-danger">
				    حذف
				    <i class="fa fa-trash"></i>
				</button>
			    </form>

			    @endif

			</td>
			
		    </tr>
		@endforeach
		
	    </tbody>
	    
	</table>
	</div>
    </div>
    
@endsection

