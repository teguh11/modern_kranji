@extends('themes.adminlte.app')
@section('stylesheets')
<link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.bootstrap.min.css">
@endsection
@push('scripts')
  <script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
  <script>
    $(function () {
      $('#date_range').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
      })

      $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      var oTable = $('#list-report-unit').DataTable({
        buttons: [
            'excel'
        ],
        dom: 'Bfrtip',
        scrollX : true,
        processing: true,
        serverSide: true,
        fixedColumns: true,
        ajax: {
          url : '{{route('report.unit.data')}}',
          data : function(d){
            d.client = $("#client").val()
            d.available_status = $("#available_status").val()
            d.unit_type = $("#unit_type").val()
            d.floor = $("#floor").val()
            d.tower = $("#tower").val()
            d.view = $("#view").val()
            d.payment_status = $("#payment_status").val()
            d.date_range = $("#date_range").val()
          }
        },
        columns: [
          {data : 'unit_name', name : 'unit_name'}, 
          {data : 'client_name', name : 'client_name'}, 
          {data : 'available_status_name', name : 'available_status_name'}, 
          {data : 'dana_masuk', name : 'dana_masuk'}, 
          {data : 'unit_price', name : 'unit_price'},
          {data : 'unit_number', name : 'unit_number'}, 
          {data : 'unit_large', name : 'unit_large'}, 
          {data : 'unit_type_name', name : 'unit_type_name'}, 
          {data : 'floor_name', name : 'floor_name'}, 
          {data : 'tower_name', name : 'tower_name'}, 
          {data : 'view_name', name : 'view_name'},
          {data : 'user_name', name : 'user_name'},   
        ],
        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          function intVal(i) {
            if(typeof i === 'string'){
              i = i.replace(/\./g,"");
              return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '')*1 :
                  typeof i === 'number' ?
                      i : 0;
            }else if(typeof i === 'number'){
              return i;
            }else{
              return 0
            }
          }

          // Total over all pages
          total = api
            .column(4)
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

          // Update footer
          $( api.column( 4 ).footer()).html(
            new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(total)
          );
          total = api
            .column(3)
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

          // Update footer
          $( api.column( 3 ).footer()).html(
            new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(total)
          );
        },
      });
      $("#advance-search").submit(function(e) {
        console.log("test")
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
                  <label>Pemilik</label>
                  <select class="form-control" name="client" id="client">
                    <option value=""></option>
                    @foreach ($clients as $client)
                      <option value="{{$client->id}}" {{old('client') == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status Unit</label>
                  <select class="form-control" name="available_status" id="available_status">
                    <option value=""></option>
                    <option value="99">Tersedia</option>
                    @foreach ($available_statuss as $available_status)
                      <option value="{{$available_status->id}}" {{old('available_status') == $available_status->id ? "selected" : ""}}>{{$available_status->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status Pembayaran</label>
                  <select class="form-control" name="payment_status" id="payment_status">
                    <option value=""></option>
                    @foreach ($payment_statuss as $payment_status)
                      <option value="{{$payment_status->id}}" {{old('payment_status') == $payment_status->id ? "selected" : ""}}>{{$payment_status->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal Order</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="date_range" name="date_range" value="">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tipe</label>
                  <select class="form-control" name="unit_type" id="unit_type">
                    <option value=""></option>
                    @foreach ($tipe_units as $tipe_unit)
                      <option value="{{$tipe_unit->id}}" {{old('unit_type') == $tipe_unit->id ? "selected" : ""}}>{{$tipe_unit->name}}</option>
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
      </div>

			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						Report Unit
					</h3>
				</div>
				<div class="box-body">
					<table id="list-report-unit" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th>unit_name</th>
                <th>client_name</th>
                <th>available_status_name</th>
                <th>dana_masuk</th>
                <th>unit_price</th>
                <th>unit_number</th>
                <th>unit_large</th>
                <th>unit_type_name</th>
                <th>floor_name</th>
                <th>tower_name</th>
                <th>view_name</th>
                <th>user_name</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="3">Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
				</div>
			</div>
		</div>
	</div>
@endsection