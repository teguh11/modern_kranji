@extends('themes.adminlte.app')
@push('scripts')
<script src="{{asset('adminlte/bower_components/cleave.js/dist/cleave.min.js')}}"></script>
<script>
$(function(){
  new Cleave('#nominal', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
})
</script>
@endpush

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('orders.update', $data->id): route('orders.store');
        ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Detail Unit.
              </h2>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nomor Unit</th>
                    <th>Nama Unit</th>
                    <th>Tipe Unit</th>
                    <th>Lantai</th>
                    <th>Pemandangan</th>
                    <th>Luas</th>
                    <th>Harga</th>
                    <th>Tower</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>{{$unit->unit_number}}</td>
                    <td>{{$unit->unit_name}}</td>
                    <td>{{$unit->unit_type_name}}</td>
                    <td>{{$unit->floor}}</td>
                    <td>{{$unit->view_name}}</td>
                    <td>{{$unit->large}}</td>
                    <td>{{number_format($unit->price, 0, ",", ".")}}</td>
                    <td>{{$unit->tower_name}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <form role="form" action="{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('client') has-error @enderror">
                  <label for="client">Konsumen</label>
                  @php
                      $disabled = (auth()->user()->hasRole('kasir') ? "disabled" : "");
                  @endphp
                  <select class="form-control" name="client" id="client" {{isset($unit->client_id) && $unit->client_id != null ? "disabled":""}}>
                    @foreach ($clients as $client)
                      <option value="{{$client->id}}" {{old('client') == $client->id ? "selected" : isset($unit->client_id) && $unit->client_id == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status</label>
                  @php
                      $disabled = (auth()->user()->hasRole('kasir') ? "disabled" : "");
                  @endphp
                  <select class="form-control" name="payment_status" {{$disabled}}>
                    @foreach ($payment_statuss as $payment_status)
                      <option value="{{$payment_status->id}}"  {{old('payment_status') == $payment_status->id ? "selected":""}} >{{$payment_status->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Payment Method</label>
                  @php
                      $disabled = (auth()->user()->hasRole('kasir') ? "disabled" : "");
                  @endphp
                  <select class="form-control" name="payment_method" {{$disabled}}>
                    @foreach ($payment_methods as $payment_method_id => $payment_method_name)
                      <option value="{{$payment_method_id}}"  {{old('payment_method') == $payment_method_id ? "selected":""}} >{{$payment_method_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('nominal') has-error @enderror">
                  <label for="nominal">Nominal</label>
                  <input type="text" class="form-control" id="nominal" placeholder="" name="nominal" value="{{old('nominal')}}">
                  @error('nominal')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            @role('kasir')
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('transaction_file') has-error @enderror">
                  <label for="transaction_file">Bukti Transaksi</label>
                  <input type="file" class="form-control" id="transaction_file" placeholder="" name="transaction_file" />
                  @error('transaction_file')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            @endrole
            <input type="hidden" name="unit_id" value="{{app('request')->query('id')}}">
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection