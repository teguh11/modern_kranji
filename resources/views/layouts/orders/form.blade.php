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
            <div class="col-md-12">
              <h3>Detail Unit</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-4">
              <label for="">Nama Unit</label>
              <div>{{$unit->unit_name}}</div>
            </div>
            <div class="col-md-4 col-xs-6 ">
              <label for="">Tipe Unit</label>
              <div>{{$unit->unit_type_name}}</div>
            </div>
            <div class="col-md-4 col-xs-6 ">
              <label for="">Luas Unit</label>
              <div>{{$unit->large}}</div>
            </div>
            <div class="col-md-4 col-xs-6 ">
              <label for="">Lantai</label>
              <div>{{$unit->floor}}</div>
            </div>
            <div class="col-md-4 col-xs-6 ">
              <label for="">Harga</label>
              <div>{{number_format($unit->price, 0, ",", ".")}}</div>
            </div>
          </div>
        </div>
        <form role="form" action="{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            {{-- <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('user') has-error @enderror">
                  <label for="nama">User</label>
                  <select class="form-control" name="user">
                    @foreach ($users as $user)
                      <option value="{{$user->id}}" {{old('user') == $user->id ? "selected" : isset($data) && $data->user_id == $user->id ? "selected" : ""}}>{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>      
              </div>
            </div> --}}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('client') has-error @enderror">
                  <label for="client">Konsumen</label>
                  <select class="form-control" name="client" id="client">
                    @foreach ($clients as $client)
                      <option value="{{$client->id}}" {{old('client') == $client->id ? "selected" : isset($data) && $data->client_id == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Unit</label>
                    <select class="form-control" name="unit" id="unit">
                      @foreach ($units as $unit)
                        <option value="{{$unit->id}}" {{old('unit') == $unit->id ? "selected" : isset($data) && $data->unit_id == $unit->id ? "selected" : ""}}>{{$unit->unit_name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">Nama Unit : <b><div class="unit_name-detail"></div></b></li>
                    <li class="list-group-item">Tipe Unit : <b><div class="unit_type-detail"></div></b></li>
                    <li class="list-group-item">Luas : <b><div class="large-detail"></div></b></li>
                    <li class="list-group-item">Lantai : <b><div class="floor-detail"></div></b></li>
                    <li class="list-group-item">Harga : <b><div class="price-detail"></div></b></li>
                  </ul>
              </div>
            </div> --}}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="payment_status">
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
                  <select class="form-control" name="payment_method">
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