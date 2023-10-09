@extends("admin/layout")

@section("title")
    <title>الاستبيانات-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">
	
	<div class="card">

	    
	    <div class="mb-4 text-center card-header bg-primary">
		<p class="h3">
		    الاستبيانات
		</p>
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
		<a href="/admin/polls/add" class="">
		    <button class="btn btn-primary float-left my-3">إضافة استبيان
			<i class="fa fa-plus"></i>
		    </button>
		</a>

		<table class="table-responsive table text-center">

		<thead>
		    <th>العنوان</th>
		    <th>الوصف</th>
		    <th>مفعّل</th>
		    <th>المسموح لهم بالتصويت</th>
		    <th>خيارات</th>
		</thead>
		
		@foreach($polls as $poll)
		    <tr>
			<td><a href="/admin/polls/{{$poll->id}}">{{ $poll->title }}</a></td>
			<td>{{ $poll->desc }}</td>
			<td>
			    @if($poll->active == 1)
				<span class="text-success">مفعّل</span>
			    @else
				<span class="text-danger">غير مفعّل</span>
			    @endif
			</td>
			<td>
			    <ul>
				@foreach(explode(",", $poll->allowedVoters) as $allowedVoter)
				    <li>
					{{ $allowedVoter }}
				    </li>
				@endforeach
			    </ul>
			</td>
			<td>
			    <div>
				<a class="btn btn-warning" href="/admin/polls/edit/{{ $poll->id }}">تعديل
				    <i class="fa fa-edit"></i>
				</a>
				
				
				<form method="post" class="delete-poll-form d-inline" action="/admin/polls/delete/{{ $poll->id }}">
				    @csrf
				    <button class="submit-delete btn btn-danger">
					حذف
					<i class="fa fa-trash"></i>
				    </button>
				</form>

				@if(count(\App\Models\PollVoters::where("poll_id", "=", $poll->id)->get()) > 0)
				    <a href="/admin/polls/report/{{$poll->id}}" class="btn btn-primary">عرض النتائج
					<i class="fa fa-external-link-alt"></i>
				    </a>
				@endif
			    </div>
			</td>
		    </tr>
		@endforeach
		
	    </table>
	    </div>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
