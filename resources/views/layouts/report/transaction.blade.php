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

      var totalNominal;
      
      var oTable = $('#list-report-unit').DataTable({
        buttons: [
            'excel'
        ],
        // dom: 'Bfrtip',
        scrollX : true,
        processing: true,
        serverSide: true,
        fixedColumns: true,
        ajax: {
          url : '{{route('report.transaction.data')}}',
          dataSrc: function ( data ) {
            totalNominal = data.totalNominal;
           return data.data;
          },
          data : function(d){
            d.client = $("#client").val()
            d.unit = $("#unit").val()
            d.date_range = $("#date_range").val()
          }
        },
        columns: [
          {data : 'unit_name', name : 'unit_name'}, 
          {data : 'client_name', name : 'client_name'}, 
          {data : 'order_number', name : 'order_number'}, 
          {data : 'payment_status_name', name : 'payment_status_name'}, 
          {data : 'user_name', name : 'user_name'}, 
          {data : 'payment_number', name : 'payment_number'},
          {data : 'nominal', name : 'nominal'}, 
          {data : 'payment_method', name : 'payment_method'}, 
          {data : 'payment_date', name : 'payment_date'}, 
          {data : 'status', name : 'status'},
          {data : 'refundable_status', name : 'refundable_status'}, 
          {data : 'valid_transaction', name : 'valid_transaction'}, 
          {data : 'user_verified_by', name : 'user_verified_by'},   
        ],
        drawCallback: function( settings ) {
          var api = this.api();
          $(api.column(4).footer()).html(new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(totalNominal));
        },
        rowCallback: function (row, data) {
          if ( data.valid_transaction == "No" ) {
              $(row).addClass('danger');
          }
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
                  <label>Unit</label>
                  <select class="form-control" name="unit" id="unit">
                    <option value=""></option>
                    @foreach ($units as $unit)
                      <option value="{{$unit->id}}" {{old('unit') == $unit->id ? "selected" : ""}}>{{$unit->unit_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal Pembayaran</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="date_range" name="date_range" value="">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Payment Status</label>
                  <select class="form-control" name="payment_status" id="payment_status">
                    <option value=""></option>
                    @foreach ($payment_statuss as $payment_status)
                      <option value="{{$payment_status->id}}" {{old('payment_status') == $unit->id ? "selected" : ""}}>{{$payment_status->name}}</option>
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
              <th>Unit Name</th>
              <th>Pemilik</th>
              <th>order</th>
              <th>payment_status</th>
              <th>user</th>
              <th>payment_number</th>
              <th>nominal</th>
              <th>payment_method</th>
              <th>payment_date</th>
              <th>status</th>
              <th>refundable_status</th>
              <th>valid_transaction</th>
              <th>verified_by</th>
            </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="4">Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
				</div>
			</div>
		</div>
	</div>
@endsection