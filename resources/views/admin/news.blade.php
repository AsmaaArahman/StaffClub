@extends("admin/layout")

@section("title")
    <title>الأخبار-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">
	
	<div class="card">

	    
	    <div class="mb-4 text-center card-header bg-primary">
		<p class="h3">الأخبار</p>
	    </div>

	    
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


	    <div class="card-body">

		<table class="table-responsive table text-center">

		    <thead>
			<th>العنوان</th>
			<th>مفعل</th>
			<th>خيارات</th>
		    </thead>

		    <tbody>
			@foreach($news as $singlenews)
			<tr>
			    <td><a href="/admin/news/{{$singlenews->id}}">{{$singlenews->title }}</a></td>
			    <td>
				@if($singlenews->active == 1)
				    <span class="text-success">مفعّل</span>
				@else
				    <span class="text-danger">غير مفعّل</span>
				@endif
			    </td>
			    <td>
				<a class="btn btn-warning" href="/admin/news/{{$singlenews->id}}/edit">
				    تعديل
				    <i class="fa fa-edit"></i>
				</a>
				    
				<form method="post" class="d-inline" action="/admin/news/{{$singlenews->id }}">
				    @csrf
				    <input type="hidden" name="_method" value="DELETE">
				    
				    <button class="submit-delete btn btn-danger">
					    حذف
					    <i class="fa fa-trash"></i>
					</button>
				    </form>
			    </td>
			</tr>
			@endforeach
		    </tbody>
		    
		</table>

		<a href="/admin/news/create" class="">
		    <button class="btn btn-primary float-left my-3">إضافة خبر
			<i class="fa fa-plus"></i>
		    </button>
		</a>

	    </div>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
