@extends('themes.adminlte.app')
@push('scripts')
<script>
    $(function(){
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('.img-container').show();
            $('.img-preview').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $("#identity_file").change(function() {
        readURL(this);
      });
    });
</script>
@endpush
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Customer</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('clients.update', $data->id): route('clients.store');
        ?>
        <form role="form" action="{{$action}}" method="POST"  enctype="multipart/form-data">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('name') has-error @enderror">
                  <label for="name">Nama @php echo in_array('name', $required) ? "*":""; @endphp</label>
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
                  <label for="email">Email @php echo in_array('email', $required) ? "*":""; @endphp</label>
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
              <div class="col-md-4">
                <div class="form-group @error('identity_no') has-error @enderror">
                  <label for="identity_no">No KTP @php echo in_array('identity_no', $required) ? "*":""; @endphp</label>
                  <input type="text" class="form-control" id="identity_no" placeholder="" name="identity_no" value="{{old('identity_no') == ''? (isset($data)?$data->identity_no:"") : old('identity_no')}}">
                  @error('identity_no')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('identity_file') has-error @enderror">
                  <label for="identity_file">Foto KTP @php echo in_array('identity_file', $required) ? "*":""; @endphp</label>
                  <input type="file" class="form-control" id="identity_file" placeholder="" name="identity_file" />
                  @error('identity_file')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
                
            @if ($type == "update" && $data->identity_file != "")
              <div class="row img-container">
                <div class="col-md-4">
                  <img class="form-group img-preview img-responsive" src="{{env('IMAGE_URL').$data->identity_file}}">
                </div>
              </div>
            @else
              <div class="row img-container" style="display:none;">
                <div class="col-md-4">
                  <img class="form-group img-preview img-responsive" src="">
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('handphone') has-error @enderror">
                  <label for="handphone">Handphone @php echo in_array('handphone', $required) ? "*":""; @endphp</label>
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
                  <label for="address">Alamat @php echo in_array('address', $required) ? "*":""; @endphp</label>
                  <textarea name="address" id="address" cols="30" rows="10" class="form-control" >{{old('address') == '' ? (isset($data)?$data->address:"") : old('address')}}</textarea>
                  @error('address')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('bank') has-error @enderror">
                  <label for="bank">Bank @php echo in_array('bank', $required) ? "*":""; @endphp</label>
                  <select class="form-control" name="bank">
                    @foreach ($banks as $bank)
                      <option value="{{$bank->id}}" {{old('bank') == $bank->id ? "selected" : isset($data) && $data->bank_id == $bank->id ? "selected" : ""}}>{{$bank->name}}</option>
                    @endforeach
                  </select>
                  @error('bank')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('account_name') has-error @enderror">
                  <label for="account_name">Nama Akun Bank @php echo in_array('account_name', $required) ? "*":""; @endphp</label>
                  <input type="text" class="form-control" id="account_name" placeholder="" name="account_name" value="{{old('account_name') == '' ? (isset($data)?$data->account_name:"") : old('account_name')}}">
                  @error('account_name')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('account_number') has-error @enderror">
                  <label for="account_number">Nomor Rekening @php echo in_array('account_number', $required) ? "*":""; @endphp</label>
                  <input type="text" class="form-control" id="account_number" placeholder="" name="account_number" value="{{old('account_number') == '' ? (isset($data)?$data->account_number:"") : old('account_number')}}">
                  @error('account_number')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('npwp') has-error @enderror">
                  <label for="npwp">NPWP @php echo in_array('npwp', $required) ? "*":""; @endphp</label>
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
                  <label for="telp_rumah">Telepon Rumah @php echo in_array('telp_rumah', $required) ? "*":""; @endphp</label>
                  <input type="text" class="form-control" id="telp_rumah" placeholder="" name="telp_rumah" value="{{old('telp_rumah') == '' ? (isset($data)?$data->telp_rumah:"") : old('telp_rumah')}}">
                </div>
                @error('telp_rumah')
                  <span class="help-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group @error('telp_kantor') has-error @enderror">
                  <label for="telp_kantor">Telepon Kantor @php echo in_array('telp_kantor', $required) ? "*":""; @endphp</label>
                  <input type="text" class="form-control" id="telp_kantor" placeholder="" name="telp_kantor" value="{{old('telp_kantor') == '' ? (isset($data)?$data->telp_kantor:"") : old('telp_kantor')}}">
                  @error('telp_kantor')
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