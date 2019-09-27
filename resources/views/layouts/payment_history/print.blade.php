@extends('themes.adminlte.print')
@section('content')
  <section class="invoice">
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
              <div class="col-sm-4">
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
              <div class="col-sm-4">
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
              <div class="col-sm-4">
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
                    <th>No Pembayaran</th>
                    <th>Nominal</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Pembayaran Untuk</th>
                    <th>Metode Pembayaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactionHistory as $item)
                    <tr class="{{$item->valid_transaction == 1?"bg-green":""}}">
                      <td>{{$item->payment_number}}</td>
                      <td>{{number_format($item->nominal, 0, ",", ".")}}</td>
                      <td>{{$item->payment_date}}</td>
                      <td>{{$item->payment_status_name}}</td>
                      <td>{{$item->payment_method == 0 ? "Cash" : "Transfer"}}</td>
                    </tr>    
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="text-center">
                  Kasir
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="text-center">
                  {{auth()->user()->name}}
                </div>
              </div>
              
              <div class="col-xs-6">
                <div class="text-center">
                  Konsumen
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="text-center">
                  {{$unit->client_name}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection