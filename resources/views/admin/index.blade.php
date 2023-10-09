@extends("admin/layout")


@section("title")
    <title>لوحة التحكم -  {{ config("app.name") }} </title>

@endsection

@push("style")
<style>
.small-box .icon{
right: auto;
left: 100px;
}
</style>
@endpush

@section("content")

    <div class="row">
	
	<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
		<div class="inner">
                    <h3> {{ \App\Models\Member::count() }}</h3>

                    <p>الأعضاء المسجلين</p>
		</div>
		<div class="icon">
                    <i class="ion ion-stats-bars"></i>
		</div>
		<a href="/admin/members" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
        </div>


	@if(!isAllowed(["admin", "normal_mod"]))
	@else

	    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
		<div class="inner">
                    <h3> {{ \App\Models\Poll::count() }}</h3>

                    <p>الاستبيانات </p>
		</div>
		<div class="icon">
                    <i class="ion ion-stats-bars"></i>
		</div>
		<a href="/admin/polls" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
            </div>
	@endif

	    @if(!isAllowed(["admin", "normal_mod"]))
	    @else

		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
		<div class="inner">
                    <h3> {{ \App\Models\Mod::count() }}</h3>

                    <p>المشرفين المتواجدين </p>
		</div>
		<div class="icon">
                    <i class="ion ion-stats-bars"></i>
		</div>
		<a href="/admin/mods" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
		</div>
		@endif


    </div>

@endsection
