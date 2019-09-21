@extends('themes.adminlte.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">UNIT TYPE</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('unit-type.update', $data->id): route('unit-type.store');
        ?>
        <form role="form" action="{{$action}}" method="POST">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('name') has-error @enderror">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="{{old('name') == "" ? (isset($data)?$data->name : "") : old('name')}}">
                  @error('name')
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