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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>ORDERS</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('orders.index')}}"><i class="fa fa-users"></i> <span>ALL</span></a></li>
            <li><a href="{{action('OrdersController@status', ['status'=> 'reserved'])}}"><i class="fa fa-users"></i> <span>RESERVED</span></a></li>
            <li><a href="{{action('OrdersController@status', ['status'=> 'booking'])}}"><i class="fa fa-circle-o"></i>BOOKING FEE</a></li>
            <li><a href="{{action('OrdersController@status', ['status'=> 'dp'])}}"><i class="fa fa-users"></i> <span>DP</span></a></li>
            <li><a href="{{action('OrdersController@status', ['status'=> 'cash-bertahap'])}}"><i class="fa fa-circle-o"></i>CASH BERTAHAP</a></li>
            <li><a href="{{action('OrdersController@status', ['status'=> 'lunas'])}}"><i class="fa fa-circle-o"></i>LUNAS</a></li>
          </ul>
        </li>
        @if (auth()->user()->hasRole('administrator'))
          <li><a href="{{route('payment-history.index')}}"><i class="fa fa-users"></i> <span>HISTORY TRANSAKSI</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>MASTER DATA</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>USERS</span></a></li>
              <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>ROLES</a></li>
              <li><a href="{{route('unit-type.index')}}"><i class="fa fa-circle-o"></i>UNIT TYPE</a></li>
              <li><a href="{{route('floors.index')}}"><i class="fa fa-users"></i> <span>FLOORS</span></a></li>
              <li><a href="{{route('towers.index')}}"><i class="fa fa-circle-o"></i>TOWERS</a></li>
              <li><a href="{{route('views.index')}}"><i class="fa fa-users"></i> <span>VIEWS</span></a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>REPORT</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('report.unit')}}"><i class="fa fa-users"></i> <span>PER UNIT</span></a></li>
              <li><a href="{{route('report.order')}}"><i class="fa fa-circle-o"></i>PER ORDER</a></li>
              <li><a href="{{route('report.transaction')}}"><i class="fa fa-circle-o"></i>PER TRANSAKSI</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>