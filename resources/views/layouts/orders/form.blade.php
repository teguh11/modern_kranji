@extends('themes.adminlte.app')
@push('scripts')
<script>
  $(function(){
    $("#unit").on("change",function(){
      changeUnit($(this).val());
    })
    function changeUnit(id) {
        $.get('/units/'+id, function(data) {
          json_data = JSON.parse(data)
          console.log(json_data)
          $("#unit_name").html(json_data.unit_name)
          $("#unit_type").html(json_data.unit_type_name)
          $("#floor").html(json_data.floor)
          $("#large").html(json_data.large)
          $("#price").html("Rp "+number_format(json_data.price, "0", ",", "."))
        })
    }

    changeUnit($("#unit").val());

    function number_format (number, decimals, decPoint, thousandsSep) {
      number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
      var n = !isFinite(+number) ? 0 : +number
      var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
      var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
      var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
      var s = ''

      var toFixedFix = function (n, prec) {
        if (('' + n).indexOf('e') === -1) {
          return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
        } else {
          var arr = ('' + n).split('e')
          var sig = ''
          if (+arr[1] + prec > 0) {
            sig = '+'
          }
          return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
        }
      }

      // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
      }

      return s.join(dec)
    }
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
                <div class="form-group @error('user') has-error @enderror">
                  <label for="nama">User</label>
                  <select class="form-control" name="user">
                    @foreach ($users as $user)
                      <option value="{{$user->id}}" {{old('user') == $user->id ? "selected" : isset($data) && $data->user_id == $user->id ? "selected" : ""}}>{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>      
              </div>
            </div>
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

            <div class="row">
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
                    <li class="list-group-item">Nama Unit : <b><div id="unit_name"></div></b></li>
                    <li class="list-group-item">Tipe Unit : <b><div id="unit_type"></div></b></li>
                    <li class="list-group-item">Luas : <b><div id="large"></div></b></li>
                    <li class="list-group-item">Lantai : <b><div id="floor"></div></b></li>
                    <li class="list-group-item">Harga : <b><div id="price"></div></b></li>
                  </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="available_status">
                    @foreach ($available_statuss as $available_status)
                      <option value="{{$available_status->id}}" {{old('available_status') == $available_status->id ? "selected" : isset($data) && $data->available_status_id == $available_status->id ? "selected" : ""}}>{{$available_status->name}}</option>
                    @endforeach
                  </select>
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