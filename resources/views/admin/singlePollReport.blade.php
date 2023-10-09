@extends("admin/layout")

@section("title")
    <title>نتيجة الاستبيان-  {{ config("app.name") }} </title>
@endsection



@section("content")

    
    <div class="polls-wrapper">

	<div class="card">
	    <div class="card-header bg-primary">
		<p class="h2 text-center">نتيجة استبيان: {{ $poll->title }}</p>

	    </div>

	    <table class="table-responsive table table-bordered">
		<tbody>
		    <tr>
			<td>عدد الأسئلة</td>
			<td>{{ $qcount }}</td>
		    </tr>

		    <tr>
			<td>عدد المجيبين</td>
			<td>{{ $num_of_voters }}</td>
		    </tr>

		    @foreach($poll->questions as $question)
			<tr>
			    <td>{{ $question->question_body }}</td>
			    <td>
				<table class="table-responsive table table-borderless">
				    <tbody>
					@foreach($question->options as $option)
					    <tr>

						<td>
						    {{ $option->option_body }}
						</td>
						<td>
						    @if($num_of_voters != 0)
							({{ count($option->answers) / $num_of_voters*100  }}%)
						    @endif
						</td>
						<td>
						    عدد المصوتين: 
						    {{ count($option->answers) }}
						</td>
					    </tr>
					@endforeach
				    </tbody>
				</table>
				
			    </td>
			</tr>
		    @endforeach
		    
		</tbody>
	    </table>
	    
	</div>
    </div>
    
    
    
    
    
@endsection


@push("scripts")

@endpush
