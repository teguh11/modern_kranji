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
        ajax: '{{route('clients.data')}}',
        columns: [
            {data:'id', name: 'id'},
            {data:'name', name: 'name'},
            {data:'email', name: 'email'},
            {data:'handphone', name: 'handphone'},
            {data: 'action', name: 'action'}
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
          <h3 class="box-title">Customers</h3>
        </div>
        @can('create-clients')
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12 col-sm-4 pull-right">
                <a href="{{route('clients.create')}}" class="btn btn-block btn-info btn-sm">Tambah Data</a>
              </div>
            </div>
          </div>
        @endcan
        <!-- /.box-header -->
        <div class="box-body">
          <table id="list-pembeli" class="table table-bordered table-striped" style="width:100%">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Handphone</th>
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