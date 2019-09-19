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
        <div class="box-header with-border">
          <h3 class="box-title">Payment</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
          $action = $type == 'update' ? route('payment-history.update', $data->id): route('payment-history.store');
        ?>
        <form role="form" action="{{$action}}" method="POST">
          <input type="hidden" name="order_id" value="{{$order->order_id}}">
          @csrf
          <?php if($type=='update'):?>
            @method('PUT')
          <?php endif;?>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Unit name</label>
                  <div class="form-control">
                    <strong>{{$order->unit_name}}</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Customer</label>
                  <div class="form-control">
                    <strong>{{$order->client_name}}</strong>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('payment_status') has-error @enderror">
                  <label for="payment_status">Payment for</label>
                  <select name="payment_status" id="payment_status" class="form-control" >
                    @foreach ($payment_status as $item)
                        <option value="{{$item->id}}"  {{old('payment_status') == $item->id ? "selected" : isset($data) && $data->payment_status_id == $item->id ? "selected" : ""}}>{{$item->name}}</option>
                    @endforeach
                  </select>
                  @error('payment_status')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('nominal') has-error @enderror">
                  <label for="nominal">Nominal</label>
                  <input type="text" class="form-control" id="nominal" placeholder="" name="nominal" value="{{old('nominal') == '' ? (isset($data)?$data->nominal:"") : old('nominal')}}">
                  @error('nominal')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('payment_method') has-error @enderror">
                  <label for="payment_method">Payment Method</label>
                  <select name="payment_method" id="payment_method" class="form-control" >
                    @foreach ($payment_methods as $id => $name)
                        <option value="{{$id}}"  {{old('payment_method') == $id ? "selected" : isset($data) && $data->payment_method == $id ? "selected" : ""}}>{{$name}}</option>
                    @endforeach
                  </select>
                  @error('payment_status')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>  
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('status') has-error @enderror">
                  <label for="status">Can refund ?</label>
                  <select name="status" id="status" class="form-control" >
                    @foreach ($status as $id => $name)
                        <option value="{{$id}}"  {{old('status') == $id ? "selected" : isset($data) && $data->status == $id ? "selected" : ""}}>{{$name}}</option>
                    @endforeach
                  </select>
                  @error('status')
                    <span class="help-block" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>  
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group @error('refundable_status') has-error @enderror">
                  <label for="refundable_status">Refund Status</label>
                  <select name="refundable_status" id="refundable_status" class="form-control" >
                    @foreach ($refundable_status as $id => $name)
                        <option value="{{$id}}"  {{old('refundable_status') == $id ? "selected" : isset($data) && $data->refundable_status == $id ? "selected" : ""}}>{{$name}}</option>
                    @endforeach
                  </select>
                  @error('refundable_status')
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