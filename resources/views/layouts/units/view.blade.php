@extends('themes.adminlte.app')
@push('scripts')
  <script>
    $(function() {
      $('#viewHistory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var payment_no = button.data('payment_no') // Extract info from data-* attributes
        var nominal = button.data('nominal') // Extract info from data-* attributes
        var payment_date = button.data('payment_date') // Extract info from data-* attributes
        var payment_status = button.data('payment_status') // Extract info from data-* attributes
        var payment_method = button.data('payment_method') // Extract info from data-* attributes
        var valid_transaction = button.data('valid_transaction') // Extract info from data-* attributes
        var transaction_file = button.data('transaction_file') // Extract info from data-* attributes
        
        var modal = $(this)
        modal.find('#payment_no').text(payment_no)
        modal.find('#nominal').text(nominal)
        modal.find('#payment_date').text(payment_date)
        modal.find('#payment_status').text(payment_status)
        modal.find('#payment_method').text(payment_method)
        modal.find('#valid_transaction').text(valid_transaction)
        transaction_file = "{{env("IMAGE_URL")}}"+transaction_file
        modal.find('#transaction_file').attr("src", transaction_file)
        modal.find('#transaction_file_link').attr("href", transaction_file)
      
      })
    })
  </script>
@endpush
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Modern Kranji Apartment.
                <small class="pull-right">Date: 2/10/2014</small>
              </h2>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
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
                  <td>{{$unit->floor_name}}</td>
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
            <div class="col-sm-3"><strong>Angsuran</strong></div>
            <div class="col-sm-4">{{$unit->order_cicilan != "" ? $unit->order_cicilan : "-"}}</div>
          </div>
          <div class="row">
            <div class="col-sm-3"><strong>Angsuran Per Bulan</strong></div>
            <div class="col-sm-4">{{$unit->order_bunga != "" ? $unit->order_bunga : "Rp 0"}}</div>
          </div>
        </div>
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
                  @role("kasir")
                    <th>Aksi</th>
                  @endrole
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
                @foreach ($transactionHistory as $item)
                  <tr>
                    @role("kasir")
                    <td>
                      <a target="_blank" href="{{route('payment-history.print', ['payment_history' => $item->id, 'order' => $item->order_id, 'unit' => $unit->id])}}" class="label label-primary">Print</a>
                      <a href="{{route('orders.edit', ['payment_history' => $item->id, 'order' => $item->order_id, 'unit' => $unit->id])}}" class="label label-primary">Validasi</a>
                      <a href="#" class="label label-primary" 
                        data-toggle="modal" 
                        data-target="#viewHistory"
                        data-payment_no = "{{$item->payment_number}}"
                        data-nominal = "{{$item->nominal}}"
                        data-payment_date = "{{$item->payment_date}}"
                        data-payment_status = "{{$item->payment_status_name}}"
                        data-payment_method = "{{$item->payment_method == 0 ? "Cash" : "Transfer"}}"
                        data-valid_transaction = "{{$item->valid_transaction == 0 ? "Not Valid":"Valid"}}"
                        data-transaction_file = "{{$item->transaction_file}}"
                      >View</a>
                    </td>
                    @endrole
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
              {{$transactionHistory->links()}}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="viewHistory">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4"><strong>Payment Number</strong></div>
          <div class="col-md-8"><span id="payment_no"></span></div>
        </div>
        <div class="row">
          <div class="col-md-4"><strong>Nominal</strong></div>
          <div class="col-md-8"><span id="nominal"></span></div>
        </div>
        <div class="row">
          <div class="col-md-4"><strong>Tanggal Pembayaran</strong></div>
          <div class="col-md-8"><span id="payment_date"></span></div>
        </div>
        <div class="row">
          <div class="col-md-4"><strong>Untuk Pembayaran</strong></div>
          <div class="col-md-8"><span id="payment_status"></span></div>
        </div>
        <div class="row">
          <div class="col-md-4"><strong>Metode Pembayaran</strong></div>
          <div class="col-md-8"><span id="payment_method"></span></div>
        </div>
        <div class="row">
          <div class="col-md-4"><strong>Status Pembayaran</strong></div>
          <div class="col-md-8"><span id="valid_transaction"></span></div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>Bukti Transaksi</strong></div>
            <div class="col-md-8">
              <a href="" target="_blank" id="transaction_file_link"><img id="transaction_file" class="img-responsive"></a>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection