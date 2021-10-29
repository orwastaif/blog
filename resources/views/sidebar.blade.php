<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('logout') }}" class="nav-link">Logout</a>
      </li>
    </ul>
      
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div>
        
      
      </div>

   
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" ></a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profile1')}}" class="nav-link">
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('Add_post') }}" class="nav-link">
                  <p>Add Post</p>
                </a>
              </li>
           <li class="nav-item">
            <a href="{{ route('list-posts') }}" class="nav-link">
                 <p>My Posts</p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{ route('all.posts') }}" class="nav-link">
                <p>All Posts</p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <p>
                Categories
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category1') }}" class="nav-link">
                  
                  <p>Category 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category2') }}" class="nav-link active">
                  
                  <p>Category 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category3') }}" class="nav-link">
                  
                  <p>Category 3</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
