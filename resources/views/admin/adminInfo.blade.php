@extends("admin/layout")

@section("title")
    <title>معلومات عامة-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">
	    <div class="card-header bg-primary">
		<p class="h2 text-center">معلومات عامة</p>

	    </div>

	    <table class="table-responsive table table-bordered table-stripped">
		<tbody>
		    <tr>
			<td>
			    عدد الأعضاء الذين قاموا بإضافة بياناتهم
			</td>
			<td> {{\App\Models\Member::where("password", "!=", null)->count() }}</td>
		    </tr>
		</tbody>
	    </table>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
