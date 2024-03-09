<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.html" class="brand-link">
        <img src="{{url('frontend/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">Oil Palm Cultivation</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <a href="#" class="d-block">{{ $name }}</a>
            <!-- <div class="image"> -->
                <!-- <img src="{{url('frontend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> -->
            <!-- </div> -->
            <!-- <div class="info">
            <a href="#" class="d-block">{{ $name }}</a>
            </div> -->
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
                <li class="nav-item"> <a href="/training-partner/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Applications
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                            <a href="/training-partner/submitted-applications" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Submitted Applications</p>

                                <i class="far nav-icon"></i>
                                <p>(For Physical Verification)</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/training-partner/approved-applications" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approved Applications</p>

                                <i class="far nav-icon"></i>
                                <p>(For Plantation)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/training-partner/all-others-applications" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Others Applications</p>

                                <i class="far nav-icon"></i>
                                <p>(For View)</p>
                            </a>
                        </li>


                        

                    </ul>
                </li>





                <li class="nav-item" style="margin-top:20px;">
                    <a href="/profile" class="nav-link">
                        <i class="" aria-hidden="true"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

                <li class="nav-item" style="">
                    <a href="/change-password" class="nav-link">
                        <i class="" aria-hidden="true"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <p>Log Out</p>
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
