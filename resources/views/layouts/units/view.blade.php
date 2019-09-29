@extends('themes.adminlte.app')

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
                      <a href="#" class="label label-primary" data-toggle="modal" data-target="#viewHistory">View</a>
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
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">.col-md-4</div>
          <div class="col-md-4 col-md-offset-4">.col-md-4 .col-md-offset-4</div>
        </div>
        <div class="row">
          <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
          <div class="col-md-2 col-md-offset-4">.col-md-2 .col-md-offset-4</div>
        </div>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">.col-md-6 .col-md-offset-3</div>
        </div>
        <div class="row">
          <div class="col-sm-9">
            Level 1: .col-sm-9
            <div class="row">
              <div class="col-xs-8 col-sm-6">
                Level 2: .col-xs-8 .col-sm-6
              </div>
              <div class="col-xs-4 col-sm-6">
                Level 2: .col-xs-4 .col-sm-6
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection