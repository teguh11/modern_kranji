@extends('themes.adminlte.app')
@section('stylesheets')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@push('scripts')
  <script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script>
    $(function () {
      $('#list-unit-type').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('unit-type.data')}}',
        columns: [
            {data:'id', name: 'id'},
            {data:'name', name: 'name'},
            {data:'action', name: 'action'},
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
          <h3 class="box-title">Data Unit Type</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 col-sm-4 pull-right">
              <a href="{{route('unit-type.create')}}" class="btn btn-block btn-info btn-sm">Tambah Data</a>
            </div>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table id="list-unit-type" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nama</th>
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