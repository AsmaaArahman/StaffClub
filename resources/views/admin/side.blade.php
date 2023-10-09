<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary   elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">

	<img src="{{asset('css/adminlte3/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
	<br/>
	<span class="brand-text font-weight-light">نادي أعضاء هيئة التدريس</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
          <div class="info">
              <a href="/admin" class="d-block"> {{ session()->get("user")->fullname }}</a>
          </div>
	  <br/>
	  <div class="image">
              <img src="/uploads/{{ session()->get("user")->pic }}" class="img-circle elevation-2" alt="User Image">
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
		   with font-awesome or any other icon font library -->


	      @if(!isAllowed(["admin", "normal_mod"]))
	      @else
		  <li class="nav-item has-treeview ">
		  <a href="/admin/mods" class="nav-link  {{ request()->is('admin/mods*') ? 'active' : '' }} ">
		      <i class="nav-icon fas fa-tachometer-alt"></i>
		      <p>
			  المشرفين
			  <i class="right fas fa-angle-left"></i>
		      </p>
		  </a>
	      </li>
	      @endif
	      

	      
	      <li class="nav-item has-treeview">
		<a href="/admin/members" class="nav-link 
			 {{ request()->is('admin/members*') ? 'active' : '' }}">
		    <i class="nav-icon fas fa-tachometer-alt"></i>
		    <p>
			الأعضاء
			<i class="right fas fa-angle-left"></i>
		    </p>
		</a>
	      </li>


	      @if(!isAllowed(["admin", "normal_mod"]))
	      @else
		  <li class="nav-item has-treeview ">
		      <a href="/admin/polls" class="nav-link {{ request()->is('admin/polls*') ? 'active' : '' }}">
			  <i class="nav-icon fas fa-tachometer-alt"></i>
			  <p>
			      الاستبيانات
			      <i class="right fas fa-angle-left"></i>
			  </p>
		      </a>
		  </li>
	      @endif


	      @if(false)
	      @if(!isAllowed(["admin", "normal_mod"]))
	      @else
		  <li class="nav-item has-treeview ">
		      <a href="/admin/news" class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}">
			  <i class="nav-icon fas fa-tachometer-alt"></i>
			  <p>
			      الأخبار
			      <i class="right fas fa-angle-left"></i>
			  </p>
		      </a>
		  </li>
	      @endif
	      @endif
	      
	      @if(!isAllowed(["admin", "normal_mod"]))
	      @else
		  <li class="nav-item has-treeview ">
		      <a href="/admin/info" class="nav-link {{ request()->is('admin/info*') ? 'active' : '' }}">
			  <i class="nav-icon fas fa-tachometer-alt"></i>
			  <p>
			      معلومات عامة
			      <i class="right fas fa-angle-left"></i>
			  </p>
		      </a>
		  </li>
	      @endif


	    
	</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
