@extends('themes.adminlte.app')
@section('stylesheets')
  <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/square/blue.css')}}">
@endsection

@push('scripts')
  <script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{asset('adminlte/bower_components/cleave.js/dist/cleave.min.js')}}"></script>
  <script>
    $(function(){
      $('input[type=radio].minimal').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
        });

      new Cleave('#nominal', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
      });
      // new Cleave('#order_persen_dp', {
      //   numeral: true,
      //   numeralThousandsGroupStyle: 'thousand'
      // });

      function hideDPAngsuran() {
        if($("#payment_status").val() == 2){
          $(".dp-angsuran").hide()
        }else{
          $(".dp-angsuran").show()
        }
      }
      hideDPAngsuran()

      $("#payment_status").change(function(){
        hideDPAngsuran()        
      })

      $("#editdp").on("change", function() {
        if($(this).is(":checked")){
          $("#order_persen_dp").prop("disabled", false);
        }else{
          $("#order_persen_dp").prop("disabled", true);
        }
      })
      $("#editcicilan").on("change", function() {
        if($(this).is(":checked")){
          $("#order_lama_cicilan").prop("disabled", false);
        }else{
          $("#order_lama_cicilan").prop("disabled", true);
        }
      })
    })
  </script>
@endpush

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Detail Unit
              </h2>
            </div>
          </div>

          @if ($unit->available_status_id != null)
            <div class="row">
              <div class="col-md-4">
                <div class="row">
                  <div class="col-xs-12">
                      <strong>Detail Konsumen</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <address>
                      {{$unit->client_name}} <br>
                      {{$unit->client_phone}} <br>
                      {{$unit->client_address}}
                    </address>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-xs-12">
                      <strong>Detail Sales</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <address>
                      {{$unit->user_name}} <br>
                      {{$unit->user_email}}
                    </address>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-xs-12">
                      <strong>Order</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <address>
                      <strong>Nomor Order :</strong>{{$unit->order_number}} <br>
                      <strong>Tanggal Order :</strong>{{$unit->order_date}} <br>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          @endif

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nomor Unit</th>
                  <th>Nama Unit</th>
                  <th>Tipe Unit</th>
                  <th>Lantai</th>
                  <th>Pemandangan</th>
                  <th>Luas</th>
                  <th>Harga</th>
                  <th>Tower</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$unit->unit_number}}</td>
                  <td>{{$unit->unit_name}}</td>
                  <td>{{$unit->unit_type_name}}</td>
                  <td>{{$unit->floor}}</td>
                  <td>{{$unit->view_name}}</td>
                  <td>{{$unit->large}}</td>
                  <td>{{number_format($unit->price, 0, ",", ".")}}</td>
                  <td>{{$unit->tower_name}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-money"></i> Detail Pembayaran
              </h2>
            </div>
          </div>
          
          @php
            foreach($transactionHistory as $index => $item){
              if($item->valid_transaction == 1){
                if(!isset($arr[$item->payment_status_name])){
                    $arr[$item->payment_status_name] = $item->nominal;
                }else{
                  $arr[$item->payment_status_name] += $item->nominal;
                }
              }
            }
            $total_dp = $unit->order_nominal_dp != "" ? $unit->order_nominal_dp : 0;
            $dp_bayar = isset($arr['DP']) ? $arr['DP'] : 0;
            $kurang_bayar = $total_dp - $dp_bayar;

            $payment_statuss = $payment_statuss->filter(function($value, $key) use ($kurang_bayar){
              if($kurang_bayar == 0 && $value["id"]==4){
                return false;
              }
              return $value;
            });
          @endphp
          <div class="row">
            <div class="col-sm-3"><strong>DP</strong></div>
            <div class="col-sm-4">{{$unit->order_persen_dp != "" ? $unit->order_persen_dp." %" : ""}}</div>
          </div>
          <div class="row">
            <div class="col-sm-3"><strong>Total DP</strong></div>
            <div class="col-sm-4">{{$unit->order_nominal_dp != "" ? "Rp ".number_format($unit->order_nominal_dp, 0, ",", ".") : ""}}</div>
          </div>
          <div class="row">
            <div class="col-sm-3"><strong>Total DP Yang telah dibayar</strong></div>
            <div class="col-sm-4">{{isset($arr['DP']) ? "Rp ".number_format($arr['DP'], 0, ",", ".") : "Rp 0"}}</div>
          </div>
          <div class="row">
            <div class="col-sm-3"><strong>Total DP Yang Belum dibayar</strong></div>
            <div class="col-sm-4 text-danger">
              @php
                  echo "Rp ".number_format($kurang_bayar, 0, ",", ".");
              @endphp
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"><strong>Angsuran</strong></div>
            <div class="col-sm-4">{{$unit->order_lama_cicilan." Kali"}}</div>
          </div>
          <div class="row">
            <div class="col-sm-3"><strong>Angsuran Per Bulan</strong></div>
            <div class="col-sm-4">{{$unit->order_cicilan != "" ? "Rp ".number_format($unit->order_cicilan, 0, ",", ".") : "-"}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        @if (empty($payment_statuss->all()))
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-money"></i> Order
                </h2>
              </div>
            </div>
            <div class="alert alert-danger">
              Pembayaran Anda Belum di validasi Oleh kasir, Silahkan Hubungi kasir untuk memvalidasi pembayaran terlebih dahulu.
            </div>
          </div>
        @else
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-money"></i> Order
                </h2>
              </div>
            </div>
      
            @php
              $action = $type == 'update' ? route('orders.update', ['payment_history' => $unit->payment_history_id, 'order' => $order_id, 'unit' => $unit->unit_id]): route('orders.store');
            @endphp
            <form role="form" action="{{$action}}" method="POST" enctype="multipart/form-data">
              @csrf
              <?php if($type=='update'):?>
                @method('PUT')
              <?php endif;?>
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group @error('client') has-error @enderror">
                        <label for="client">Konsumen</label>
                        @php
                            $disabled = (auth()->user()->hasRole('kasir') ? "disabled" : "");
                        @endphp
                        <select class="form-control" name="client" id="client" {{isset($unit->client_id) && $unit->client_id != null ? "disabled":""}}>
                          @foreach ($clients as $client)
                            <option value="{{$client->id}}" {{old('client') == $client->id ? "selected" : isset($unit->client_id) && $unit->client_id == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
      
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Status</label>
                        @php
                            // $disabled = (auth()->user()->hasRole('kasir') ? "disabled" : "");
                            $disabled = "";
                        @endphp
                        <select class="form-control" name="payment_status" {{$disabled}} id="payment_status">
                          @foreach ($payment_statuss as $payment_status)
                            <option value="{{$payment_status->id}}"  {{old('payment_status') == $payment_status->id ? "selected":isset($unit->payment_status) && $unit->payment_status == $payment_status->id ? "selected" : ""}} >{{$payment_status->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Payment Method</label>
                        @php
                            // $disabled = (auth()->user()->hasRole('kasir') ? "disabled" : "");
                            $disabled = "";
                        @endphp
                        <select class="form-control" name="payment_method" {{$disabled}}>
                          @foreach ($payment_methods as $payment_method_id => $payment_method_name)
                            <option value="{{$payment_method_id}}"  {{old('payment_method') == $payment_method_id ? "selected":isset($unit->payment_method) && $unit->payment_method == $payment_method_id ? "selected" : ""}} >{{$payment_method_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  {{-- {{dd($unit)}} --}}
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group @error('nominal') has-error @enderror">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" placeholder="" name="nominal" value="{{old('nominal') != "" ? old('nominal'): isset($unit->nominal)?$unit->nominal:""}}">
                        @error('nominal')
                          <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  {{-- @if ($unit->order_persen_dp == "" && $type == "create") --}}
                  <div class="dp-angsuran">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group @error('order_persen_dp') has-error @enderror">
                          <label for="order_persen_dp">DP</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="order_persen_dp" placeholder="" name="order_persen_dp" value="{{old('order_persen_dp') != "" ? old('order_persen_dp'): isset($unit->order_persen_dp) ?$unit->order_persen_dp :""}}" disabled>
                            <div class="input-group-addon">%</div>
                          </div>
                          <input type="checkbox" name="editdp" id="editdp"><label for="editdp">edit</label>
                          @error('order_persen_dp')
                            <span class="help-block" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                    </div>    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group @error('order_lama_cicilan') has-error @enderror">
                          <label for="order_lama_cicilan">CICILAN</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="order_lama_cicilan" placeholder="" name="order_lama_cicilan" value="{{old('order_lama_cicilan') != "" ? old('order_lama_cicilan'): isset($unit->order_lama_cicilan) ?$unit->order_lama_cicilan :""}}" disabled>
                            <div class="input-group-addon">Kali</div>
                          </div>
                          <input type="checkbox" name="editcicilan" id="editcicilan"><label for="editcicilan">edit</label>
                          @error('order_lama_cicilan')
                            <span class="help-block" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                    </div>  
                  </div>  
                  {{-- @endif --}}
                  
                  @role('kasir')
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group @error('transaction_file') has-error @enderror">
                          <label for="transaction_file">Bukti Transaksi</label>
                          <input type="file" class="form-control" id="transaction_file" placeholder="" name="transaction_file" />
                          @error('transaction_file')
                            <span class="help-block" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    {{-- @if ($unit->available_status_id < 1) --}}
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group @error('valid_transaction') has-error @enderror">
                            <label for="transaction_file">Verify Transaction ?</label>
                            <label class="radio-inline">
                              <input type="radio" name="valid_transaction" class="form-control minimal" value="0" {{old("valid_transaction") != null ?"checked":isset($unit->valid_transaction) == 0 ? "checked" : ""}}>&nbsp;Tidak
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="valid_transaction" class="form-control minimal" value="1" {{old("valid_transaction") != null ?"checked":isset($unit->valid_transaction) == 1 ? "checked" : ""}}>&nbsp;YA
                            </label>
                            @error('valid_transaction')
                              <span class="help-block" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      @if ($type == "update" && $unit->payment_status == 2)
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group @error('refundable_status') has-error @enderror">
                              <label for="refundable_status">Status Pengembalian</label>
                              <label class="radio-inline">
                                <input type="radio" name="refundable_status" class="form-control minimal" value="0" {{old("refundable_status")==0?"checked":isset($unit->refundable_status) == 0 ? "checked" : ""}}>&nbsp;Belum
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="refundable_status" class="form-control minimal" value="1" {{old("refundable_status")==1?"checked":isset($unit->refundable_status) == 1 ? "checked" : ""}}>&nbsp;Sudah
                              </label>
                              @error('refundable_status')
                                <span class="help-block" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      @endif
                  @endrole
                  <input type="hidden" name="unit_id" value="{{app('request')->query('unit')}}">
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                      <label for="payment_history_note">Catatan</label>
                      <textarea name="payment_history_note" id="payment_history_note" cols="30" rows="10" class="form-control">{{old('payment_history_note') != "" ? old('payment_history_note'): isset($unit->payment_history_note) ?$unit->payment_history_note :""}}</textarea>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <h3 class="page-header">
                History Transaksi
              </h3>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Valid?</th>
                  <th>No Pembayaran</th>
                  <th>Nominal</th>
                  <th>Dibuat Oleh</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Pembayaran Untuk</th>
                  <th>Metode Pembayaran</th>
                  <th>Status Pengembalian</th>
                </tr>
              </thead>
              <tbody>
                @php
                    // echo $listHistory;
                @endphp
                @foreach ($transactionHistory as $index => $item)
                  @php
                    if(!isset($arr[$item->payment_status_name])){
                        $arr[$item->payment_status_name] = $item->nominal;
                    }else{
                      $arr[$item->payment_status_name] += $item->nominal;
                    }
                  @endphp    
                  <tr>
                    <td>@php echo $item->valid_transaction == 0 ? '<span class="label label-danger">NOT VALID</span>' : '<span class="label label-success">VALID</span>'; @endphp</td>
                    <td>{{$item->payment_number}}</td>
                    <td>{{number_format($item->nominal, 0, ",", ".")}}</td>
                    <td>{{$item->user_name}}</td>
                    <td>{{$item->payment_date}}</td>
                    <td>{{$item->payment_status_name}}</td>
                    <td>{{$item->payment_method == 0 ? "Cash" : "Transfer"}}</td>
                    <td>{{$item->refundable_status == 0 ? "Belum" : "Sudah"}}</td>
                  </tr>

                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-xs-12">
              {{-- {{$transactionHistory->links()}} --}}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection