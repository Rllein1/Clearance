 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/Mats-Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">INFORMATION</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/User-icon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!--  -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      @if(Auth::user()->rank=='admin')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('adviser.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adviser</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('signatory.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Signatory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('student.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
                Clearance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('clearance.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Clearance</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                Utilities
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('schoolyear.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Schoolyear</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('classroom.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Room</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      @endif
      @if(Auth::user()->role=='signatory')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class=" nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                My Students
              </p>
            </a>
          </li>

        </ul>
      </nav>
      @endif
      <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
  </aside>
