<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{strtoupper(auth()->user()->name)}}</p>
          {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{route('clients.index')}}"><i class="fa fa-users"></i> <span>CUSTOMERS</span></a></li>
        <li><a href="{{route('units.index')}}"><i class="fa fa-users"></i> <span>UNITS</span></a></li>
        <li><a href="{{route('orders.index')}}"><i class="fa fa-users"></i> <span>ORDERS</span></a></li>
        <li><a href="{{route('payment-history.index')}}"><i class="fa fa-users"></i> <span>HISTORY TRANSAKSI</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Orders</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Reserved</span></a></li>
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>Booking Fee</a></li>
            <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>DP</span></a></li>
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>Cash Bertahap</a></li>
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>Lunas</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>MASTER DATA</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>USERS</span></a></li>
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>ROLES</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>