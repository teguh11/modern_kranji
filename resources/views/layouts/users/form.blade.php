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
          $action = $type == 'update' ? route('useres.update', $data->id): route('users.store');
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
            <div class="row">
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
            @if ($type == "create")
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('password') has-error @enderror">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="" name="password" value="{{old('password') == '' ? (isset($data)?$data->email:"") : old('password')}}">
                    @error('password')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group @error('password_confirmation') has-error @enderror">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation" value="{{old('password_confirmation')}}">
                    @error('password_confirmation')
                      <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            @endif
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role">
                      @foreach ($roles as $role)
                        <option value="{{$role->name}}" {{old('role_id')}}>{{$role->name}}</option>
                      @endforeach
                    </select>
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