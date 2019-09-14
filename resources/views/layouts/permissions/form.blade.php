@extends('themes.adminlte.app')
@section('stylesheets')
  <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/square/blue.css')}}">
@endsection
@push('scripts')
<script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>

  <script>
    $(function(){
      $('input[type=checkbox].minimal').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    })
  </script>
@endpush

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{strtoupper($role->name)}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{route("roles.store-permission", ["id" => $role->id])}}" method="POST">
                @csrf
                  @php $title = ""; @endphp
                  @foreach ($permissions as $item)
                    @php $split = explode("-", $item->name); 
                      if($title != $split[1]):
                        $title = $split[1];
                    @endphp
                      <div class="row">
                        <div class="col-sm-12">
                          MODULE {{strtoupper($title)}}
                        </div>
                        <div class="col-sm-12">                  
                    @php
                        endif;
                    @endphp
                        <div class="col-sm-3">
                            <div class="checkbox icheck">
                              <label>
                                <input type="checkbox" class="minimal" {{($role->hasPermissionTo($item->name))?"checked" : ""}} value="{{$item->name}}" name="permission[]"> {{$item->name}}
                              </label>
                            </div>
                        </div>
                    @if($title != $split[1]):
                      </div>
                    @endif
                  @endforeach
                </form>
                <div class="row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>
@endsection