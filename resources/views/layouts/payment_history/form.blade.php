@extends('themes.adminlte.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Pembeli</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('clients.update', $data->id): route('clients.store');
        ?>
        <form role="form" action="{{$action}}" method="POST">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Order</label>
                  <select class="form-control" name="order">
                    @foreach ($orders as $order)
                      <option value="{{$order->id}}" {{old('order') == $order->id ? "selected" : isset($data) && $data->order_id == $order->id ? "selected" : ""}}>{{$order->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group @error('email') has-error @enderror">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{old('email') == '' ? (isset($data)?$data->email:"") : old('email')}}">
                  @error('email')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('identity_no') has-error @enderror">
                  <label for="identity_no">No KTP</label>
                  <input type="text" class="form-control" id="identity_no" placeholder="" name="identity_no" value="{{old('identity_no') == ''? (isset($data)?$data->identity_no:"") : old('identity_no')}}">
                  @error('identity_no')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group @error('npwp') has-error @enderror">
                  <label for="npwp">NPWP</label>
                  <input type="text" class="form-control" id="npwp" placeholder="" name="npwp" value="{{old('npwp') == '' ? (isset($data)?$data->npwp:"") : old('npwp')}}">
                  @error('npwp')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('telp_rumah') has-error @enderror">
                  <label for="telp_rumah">Telepon Rumah</label>
                  <input type="text" class="form-control" id="telp_rumah" placeholder="" name="telp_rumah" value="{{old('telp_rumah') == '' ? (isset($data)?$data->telp_rumah:"") : old('telp_rumah')}}">
                </div>
                @error('telp_rumah')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-4">
                <div class="form-group @error('telp_kantor') has-error @enderror">
                  <label for="telp_kantor">Telepon Kantor</label>
                  <input type="text" class="form-control" id="telp_kantor" placeholder="" name="telp_kantor" value="{{old('telp_kantor') == '' ? (isset($data)?$data->telp_kantor:"") : old('telp_kantor')}}">
                  @error('telp_kantor')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group @error('handphone') has-error @enderror">
                  <label for="handphone">Handphone</label>
                  <input type="text" class="form-control" id="handphone" placeholder="" name="handphone" value="{{old('handphone') == '' ? (isset($data)?$data->handphone:"") : old('handphone')}}">
                  @error('handphone')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('address') has-error @enderror">
                  <label for="address">Alamat</label>
                  <textarea name="address" id="address" cols="30" rows="10" class="form-control" >{{old('address') == '' ? (isset($data)?$data->address:"") : old('address')}}</textarea>
                  @error('address')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection