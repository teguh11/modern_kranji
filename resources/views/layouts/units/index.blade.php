@extends('themes.adminlte.app')
@section('stylesheets')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@push('scripts')
  <script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script>
    $(function () {
      $('#list-units').DataTable({
        scrollX : true,
        // scrollCollapse : true,
        dom: "<'row'<'col-xs-12'<'col-sm-6'l><'col-sm-6'>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: '{{route('units.data')}}',
        columns: [
            {data:'unit_number', name: 'unit_number'},
            {data:'unit_name', name: 'unit_name'},
            {data: 'unit_type_id', name: 'unit_type_id'},
            {data:'floor_id', name: 'floor_id'},
            {data:'large', name: 'large'},
            {data: 'price', name: 'price'},
            {data:'unit_total', name: 'unit_total'},
            {data: 'unit_stock', name: 'unit_stock'},
            {data: 'action', name: 'action'},
        ]
      });
    })
  </script>

@endpush

@section('content')
  <div class="row">
    <div class="col-xs-12">
        <div class="box collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Advance Search</h3>
  
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            Start creating your amazing application!
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            Footer
          </div>
          <!-- /.box-footer-->
        </div>
        <div class="box">
    
        <div class="box-header">
          <h3 class="box-title">Units</h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 col-sm-4 pull-right">
              <a href="{{route('units.create')}}" class="btn btn-block btn-info btn-sm">Tambah Data</a>
            </div>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table id="list-units" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th>NO Unit</th>
                <th>Nama Unit</th>
                <th>Tipe Unit</th>
                <th>Lantai</th>
                <th>Luas</th>
                <th>Harga</th>
                <th>Jumlah Unit</th>
                <th>Stock Unit</th>
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