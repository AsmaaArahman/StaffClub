@extends("admin/layout")


@push("style")
<style>
.card {
    padding: 40px;
 }

</style>
@endpush

@section("content")


    <div class="card">
	
	<div class="card-header bg-primary text-center">
	    <p class="h3">	
		{{$news->title}}
	    </p>
	</div>
	
	
	
	<div class="card-body">
	    <img alt="" src="/uploads/{{$featured_image->image}}"/>
	    <hr/>

	    {!! $news->content !!}
	</div>
    </div>


				    
    
    @push("scripts")
    <script>
     $(".view-relative").on("click", function() {
	 /* $("#view-relative-modal").modal("toggle"); */
	 $(this).closest(".relative").children(".view-relative-modal").modal("toggle");

	 
     });

     $(".edit-relative").on("click", function() {
	 $(this).closest(".relative").children(".edit-relative-modal").modal("toggle");
     });

     
     /* $("#edit-relative").on("click", function() {
	$("#edit-relative-modal").modal("toggle");
      * });
      */
    </script>
    @endpush
    
@endsection
