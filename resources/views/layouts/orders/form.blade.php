@extends('themes.adminlte.app')
@push('scripts')
<script src="{{asset('adminlte/bower_components/cleave.js/dist/cleave.min.js')}}"></script>
<script>
$(function(){
  new Cleave('#harga_pengikatan', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
  new Cleave('#no_unit', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
  new Cleave('#luas', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
  new Cleave('#jumlah_unit', {
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
        <div class="box-header with-border">
          <h3 class="box-title">Tipe Unit</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('orders.update', $data->id): route('orders.store');
        ?>
        <form role="form" action="{{$action}}" method="POST">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('nama_unit') has-error @enderror">
                  <label for="nama"></label>
                  <input type="text" class="form-control" id="nama_unit" placeholder="Nama" name="nama_unit" value="{{old('nama_unit') == "" ? (isset($data)?$data->nama_unit : "") : old('nama_unit')}}">
                  @error('nama_unit')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>      
              </div>
              <div class="col-md-6">
                <div class="form-group @error('no_unit') has-error @enderror">
                  <label for="no_unit">No Unit</label>
                  <input type="text" class="form-control" id="no_unit" placeholder="" name="no_unit" value="{{old('no_unit') == '' ? (isset($data)?$data->no_unit:"") : old('no_unit')}}">
                  @error('no_unit')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Tipe Unit</label>
                    <select class="form-control" name="tipe_unit">
                      @foreach ($tipe_units as $tipe_unit)
                        <option value="{{$tipe_unit->id}}" {{old('tipe_unit') == $tipe_unit->id ? "selected" : isset($data) && $data->tipe_unit == $tipe_unit->id ? "selected" : ""}}>{{$tipe_unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Lantai</label>
                  <select class="form-control" name="lantai">
                    @foreach ($lantais as $lantai)
                      <option value="{{$lantai->id}}" {{old('lantai') == $lantai->id ? "selected" : isset($data) && $data->lantai == $lantai->id ? "selected" : ""}}>{{$lantai->nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('luas') has-error @enderror">
                  <label for="luas">Luas</label>
                  <input type="text" class="form-control" id="luas" placeholder="" name="luas" value="{{old('luas') == '' ? (isset($data)?$data->luas:"") : old('luas')}}">
                  @error('luas')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group @error('harga_pengikatan') has-error @enderror">
                  <label for="telp_kantor">Harga</label>
                  <input type="text" class="form-control" id="harga_pengikatan" placeholder="" name="harga_pengikatan" value="{{old('harga_pengikatan') == '' ? (isset($data)?$data->harga_pengikatan:"") : old('harga_pengikatan')}}">
                  @error('harga_pengikatan')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group @error('jumlah_unit') has-error @enderror">
                    <label for="telp_kantor">Jumlah Unit</label>
                    <input type="text" class="form-control" id="jumlah_unit" placeholder="" name="jumlah_unit" value="{{old('jumlah_unit') == '' ? (isset($data)?$data->jumlah_unit:"") : old('jumlah_unit')}}">
                    @error('jumlah_unit')
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