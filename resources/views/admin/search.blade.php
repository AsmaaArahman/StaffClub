@extends("admin/layout")


@section("title")
    <title>الأعضاء -  {{ config("app.name") }} </title>
@endsection

@section("content")


    <div class="card">


	<div class="card-body">
	
	<p class="h4 my-4">
	    نتائج البحث عن: 
	    {{ request()->q }}

	</p>


	    @if($members == null || count($members) == 0)
		<p class="h4">لا يوجد نتائج!</p>
	    @else
		
	<table class="table-responsive table">
	    <thead class="bg-primary">
		<th>الاسم الكامل</th>
		<th>الرقم القومي</th>
		<th>الكلية</th>
		<th>المسمى الوظيفي</th>
		<th>الحالة</th>

		<th>الأقارب</th>
		@if(!isAllowed(["admin", "normal_mod"]))
		@else
		    <th>خيارات</th>
		@endif
		
	    </thead>
	    
	    <tbody>
		@foreach($members as $member)
		    <tr>
			<td> <a href="/admin/members/{{$member->id}}">{{ $member->fullname }} </a></td>
			<td> {{ $member->nat_id}}</td>
			<td> {{ $member->faculty }}</td>
			<td> {{ $member->designation }}</td>
			<td> {{ $member->status }}</td>

			<td><ul>
			    @foreach($member->relatives()->get() as $relative)
				<li>{{ $relative->fullname }}</li>
			    @endforeach
			</ul></td>
			<td class="d-flex">
			    @if(!isAllowed(["admin", "normal_mod"]))
			    @else
				<a href="/admin/members/edit/{{ $member->id }}">
				    <button class="btn btn-warning">تعديل
					<i class="fa fa-edit"></i>
				    </button>
				</a>
			    @endif
			</td>
		    </tr>
		@endforeach
	    </tbody>
	</table>
	@endif

	</div>
    </div>


    


    @push("scripts")
    
    @endpush
    
@endsection
