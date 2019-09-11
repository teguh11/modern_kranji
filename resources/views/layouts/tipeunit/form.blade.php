@extends('themes.adminlte.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tipe Unit</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('pembeli.update', $pembeli->id): route('pembeli.create');
        ?>
        <form role="form" action="{{$action}}" method="POST">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('nama') has-error @enderror">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="{{old('nama') == "" ? (isset($pembeli)?$pembeli->nama : "") : old('nama')}}">
                  @error('nama')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>      
              </div>
              <div class="col-md-6">
                <div class="form-group @error('email') has-error @enderror">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{old('email') == '' ? (isset($pembeli)?$pembeli->email:"") : old('email')}}">
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
                <div class="form-group @error('no_ktp') has-error @enderror">
                  <label for="no_ktp">No KTP</label>
                  <input type="text" class="form-control" id="no_ktp" placeholder="" name="no_ktp" value="{{old('no_ktp') == ''? (isset($pembeli)?$pembeli->no_ktp:"") : old('no_ktp')}}">
                  @error('no_ktp')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group @error('npwp') has-error @enderror">
                  <label for="npwp">NPWP</label>
                  <input type="text" class="form-control" id="npwp" placeholder="" name="npwp" value="{{old('npwp') == '' ? (isset($pembeli)?$pembeli->npwp:"") : old('npwp')}}">
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
                  <input type="text" class="form-control" id="telp_rumah" placeholder="" name="telp_rumah" value="{{old('telp_rumah') == '' ? (isset($pembeli)?$pembeli->telp_rumah:"") : old('telp_rumah')}}">
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
                  <input type="text" class="form-control" id="telp_kantor" placeholder="" name="telp_kantor" value="{{old('telp_kantor') == '' ? (isset($pembeli)?$pembeli->telp_kantor:"") : old('telp_kantor')}}">
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
                  <input type="text" class="form-control" id="handphone" placeholder="" name="handphone" value="{{old('handphone') == '' ? (isset($pembeli)?$pembeli->handphone:"") : old('handphone')}}">
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
                <div class="form-group @error('alamat') has-error @enderror">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" >{{old('alamat') == '' ? (isset($pembeli)?$pembeli->alamat:"") : old('alamat')}}</textarea>
                  @error('alamat')
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