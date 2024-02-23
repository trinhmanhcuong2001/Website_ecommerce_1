    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{URL::to('template/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{URL::to('template/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                  Danh mục
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{URL::to('/admin/menu/add')}}" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Thêm danh mục</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{URL::to('/admin/menu/list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách danh mục</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>
                  Sản phẩm
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{URL::to('/admin/product/add')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm sản phẩm</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{URL::to('/admin/product/list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách sản phẩm</p>
                  </a>
                </li>        
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-images nav-icon"></i>
                <p>
                  Slider
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{URL::to('/admin/slider/add')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm slider</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{URL::to('/admin/slider/list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách slider</p>
                  </a>
                </li>        
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-cart-plus nav-icon"></i>
                <p>
                  Giỏ hàng
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{URL::to('/admin/customers')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách đơn hàng</p>
                  </a>
                </li>      
              </ul>
            </li>
            
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
