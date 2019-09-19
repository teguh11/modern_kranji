@extends('themes.adminlte.app')
@push('scripts')
<script src="{{asset('adminlte/bower_components/cleave.js/dist/cleave.min.js')}}"></script>
<script>
$(function(){
  new Cleave('#price', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
  new Cleave('#unit_number', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
  new Cleave('#large', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
  });
  new Cleave('#unit_total', {
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
          $action = $type == 'update' ? route('units.update', $data->id): route('units.store');
        ?>
        <form role="form" action="{{$action}}" method="POST">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('unit_name') has-error @enderror">
                  <label for="unit_name">Nama Unit</label>
                  <input type="text" class="form-control" id="unit_name" placeholder="Nama" name="unit_name" value="{{old('unit_name') == "" ? (isset($data)?$data->unit_name : "") : old('unit_name')}}">
                  @error('unit_name')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>      
              </div>
              <div class="col-md-4">
                <div class="form-group @error('unit_number') has-error @enderror">
                  <label for="unit_number">No Unit</label>
                  <input type="text" class="form-control" id="unit_number" placeholder="" name="unit_number" value="{{old('unit_number') == '' ? (isset($data)?$data->unit_number:"") : old('unit_number')}}">
                  @error('unit_number')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Tipe Unit</label>
                    <select class="form-control" name="unit_type">
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
                  <select class="form-control" name="floor">
                    @foreach ($lantais as $lantai)
                      <option value="{{$lantai->id}}" {{old('floor') == $lantai->id ? "selected" : isset($data) && $data->floor_id == $lantai->id ? "selected" : ""}}>{{$lantai->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tower</label>
                  <select class="form-control" name="tower">
                    @foreach ($towers as $tower)
                      <option value="{{$tower->id}}" {{old('tower') == $tower->id ? "selected" : isset($data) && $data->tower_id == $tower->id ? "selected" : ""}}>{{$tower->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Views</label>
                    <select class="form-control" name="view">
                      @foreach ($views as $view)
                        <option value="{{$view->id}}" {{old('view') == $view->id ? "selected" : isset($data) && $data->view_id == $view->id ? "selected" : ""}}>{{$view->name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('large') has-error @enderror">
                  <label for="large">Luas</label>
                  <input type="text" class="form-control" id="large" placeholder="" name="large" value="{{old('large') == '' ? (isset($data)?$data->large:"") : old('large')}}">
                  @error('large')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group @error('price') has-error @enderror">
                  <label for="price">Harga</label>
                  <input type="text" class="form-control" id="price" placeholder="" name="price" value="{{old('price') == '' ? (isset($data)?$data->price:"") : old('price')}}">
                  @error('price')
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