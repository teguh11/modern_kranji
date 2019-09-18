@extends('themes.adminlte.app')
@section('stylesheets')
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@push('scripts')
  <script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script>
    $(function () {
      var oTable = $('#list-units').DataTable({
        scrollX : true,
        // scrollCollapse : true,
        dom: "<'row'<'col-xs-12'<'col-sm-6'l><'col-sm-6'>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
          url : '{{route('units.data')}}',
          data : function(d){
            d.unit_type = $("#unit_type").val()
            d.floor = $("#floor").val()
            d.tower = $("#tower").val()
            d.view = $("#view").val()
          }
        },
        columns: [
            {data:'unit_number', name: 'unit_number'},
            {data:'unit_name', name: 'unit_name'},
            {data: 'unit_type', name: 'unit_type'},
            {data:'floor', name: 'floor'},
            {data: 'tower', name: 'tower'},
            {data:'large', name: 'large'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action'},
        ]
      });

      $("#advance-search").submit(function(e) {
        oTable.draw();
        e.preventDefault();
      })
      $("#reset").click(function () {
        oTable.draw();
      })
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
            <form method="get" id="advance-search" action="#">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tipe</label>
                    <select class="form-control" name="unit_type" id="unit_type">
                      <option value=""></option>
                      @foreach ($tipe_units as $tipe_unit)
                        <option value="{{$tipe_unit->id}}" {{old('unit_type') == $tipe_unit->id ? "selected" : isset($data) && $data->unit_type_id == $tipe_unit->id ? "selected" : ""}}>{{$tipe_unit->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Lantai</label>
                    <select class="form-control" name="floor" id="floor">
                      <option value=""></option>
                      @foreach ($lantais as $lantai)
                        <option value="{{$lantai->id}}" {{old('floor') == $lantai->id ? "selected" : isset($data) && $data->floor_id == $lantai->id ? "selected" : ""}}>{{$lantai->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tower</label>
                    <select class="form-control" name="tower" id="tower">
                      <option value=""></option>
                      @foreach ($towers as $tower)
                        <option value="{{$tower->id}}" {{old('tower') == $tower->id ? "selected" : isset($data) && $data->tower_id == $tower->id ? "selected" : ""}}>{{$tower->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Views</label>
                    <select class="form-control" name="view" id="view">
                      <option value=""></option>
                      @foreach ($views as $view)
                        <option value="{{$view->id}}" {{old('view') == $view->id ? "selected" : isset($data) && $data->view_id == $view->id ? "selected" : ""}}>{{$view->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-primary" id="reset">Reset</button>
                  
                </div>
              </div>
            </form>
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
                <th>Tower</th>
                <th>Luas</th>
                <th>Harga</th>
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