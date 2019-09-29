@extends('themes.adminlte.app')
@section('stylesheets')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@push('scripts')
  <script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script>
    $(function () {
      $('#list-pembeli').DataTable({
        scrollX : true,
        processing: true,
        serverSide: true,
        ajax: '{{route('orders.data')}}',
        columns: [
            {data:'order_number', name: 'order_number'},
            {data:'pending_payment', name: 'pending_payment'},
            {data:'client_name', name: 'client_name'},
            {data:'user_name', name: 'user_name'},
            {data: 'unit_name', name: 'unit_name'},
            {data:'large', name: 'large'},
            {data:'price', name: 'price'},
            {data:'unit_type', name: 'unit_type'},
            {data: 'floor', name: 'floor'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
            
        ]
      });
    })
  </script>

@endpush

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orders</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="list-pembeli" class="table table-bordered table-striped" style="width:100%">
            <thead>
            <tr>
              <th>Order Number</th>
              <th>Pending Validation</th>
              <th>Nama Konsumen</th>
              <th>Nama user</th>
              <th>Unit</th>
              <th>Luas</th>
              <th>Harga</th>
              <th>Tipe</th>
              <th>Lantai</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection