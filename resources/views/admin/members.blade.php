@extends("admin/layout")


@section("title")
    <title>الأعضاء -  {{ config("app.name") }} </title>
@endsection

@section("content")


    <div class="card">

	
	<div class="card-header bg-primary text-center">
	    <p class="h3">	
		الأعضاء
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

	    @if(!isAllowed(["admin", "normal_mod"]))
	    @else
		<a href="/admin/members/add" class="d-block my-2 btn btn-primary float-left">إضافة عضو
		    <i class="fa fa-plus"></i>
		</a>
	    @endif
		
	    
	    <div class="clearfix"></div>

	    
	    <table class="table-responsive table-responsive table">
		<thead class="bg-secondary">
		    <th>الاسم الكامل</th>
		    <th>الرقم القومي</th>
		    <th>الكلية</th>
		    <th>المسمى الوظيفي</th>
		    <th>الحالة</th>

		    @if(!isAllowed(["admin", "normal_mod"]))
		    @else
			<th>خيارات</th>
		    @endif
		</thead>
		
		<tbody>
		    @foreach($members as $member)
			<tr>
			    <td> <a href="/admin/members/{{$member->id}}"> {{ $member->fullname }} </a></td>
			    <td> {{ $member->nat_id }}</td>
			    <td> {{ $member->faculty }}</td>
			    <td> {{ $member->designation }}</td>
			    <td> {{ $member->status }}</td>

			    <td class="d-flex justify-content-between">

				@if(!isAllowed(["admin", "normal_mod"]))
				@else
				    <a class="mx-2" href="/admin/members/edit/{{ $member->id }}">
				    <button class="btn btn-warning">
					تعديل
					<i class="fa fa-edit"></i>

				    </button>
				    </a>
				@endif
				    
				    @if(!isAllowed(["admin"]))
				    @else
					
					<form class="d-inline" method="post" action="/admin/members/delete/{{$member->id }}">
					    @csrf
					    <button type="submit" class="submit-delete btn btn-danger">
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
	<div class="d-flex justify-content-center">
	    {!!  $members->links("vendor.pagination.bootstrap-4") !!}

	</div>
    </div>


    


    @push("scripts")
    
    @endpush
    
@endsection
