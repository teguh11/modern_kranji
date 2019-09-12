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
        processing: true,
        serverSide: true,
        ajax: '{{route('orders.data')}}',
        columns: [
            {data:'no_order', name: 'no_order'},
            {data:'pembeli', name: 'pembeli'},
            {data:'user', name: 'user'},
            {data: 'nominal', name: 'nominal'},
            {data:'unit', name: 'unit'},
            {data:'payment_method', name: 'payment_method'},
            {data:'payment_date', name: 'payment_date'},
            {data: 'refundable_status', name: 'refundable_status'},
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
          <h3 class="box-title">Data Pembeli</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 col-sm-4 pull-right">
              <a href="{{route('orders.create')}}" class="btn btn-block btn-info btn-sm">Tambah Data</a>
            </div>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table id="list-pembeli" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Handphone</th>
              <th>Action</th>
              <th>Id</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Handphone</th>
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