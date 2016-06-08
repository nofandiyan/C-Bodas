@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
    <br>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    
                    <div align="center"><h2><label>View Order</label></h2></div>
                    <hr>
                        <!-- {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put"> -->
                        @foreach($order as $ord)
                        <div class="col-md-5 col-md-offset-1">
                            <div class="row">
                                <div>
                                    <h4><label>Informasi Pesanan</label></h4>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Kode Pemesanan</label>
                                        <div class="col-md-7">
                                            {{$ord->id}}                
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Tanggal Pemesanan</label>
                                        <div class="col-md-7">
                                            {{$ord->created_at}}
                                        </div>
                                    </div>
                                    @if(Auth::user()->role=='admin')
                                    <div class="col-md-12">
                                        <label class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            @if($ord->status == 1)
                                                Pending
                                            @elseif($ord->status == 2)
                                                Valid
                                            @elseif($ord->status == 3)
                                                Invalid
                                            @elseif($ord->status == 4)
                                                Reservation Closed
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <div>&nbsp;</div>
                                    @if(Auth::user()->role=='admin')
                                    <h4><label>Informasi Transfer</label></h4>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nama Bank</label>
                                        <div class="col-md-7">
                                            {{$ord->bank_name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nomor Rekening</label>
                                        <div class="col-md-7">
                                            {{$ord->bank_account}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Total Biaya</label>
                                        <div class="col-md-7">
                                            {{$ord->totPrice}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-7 col-md-offset-5">
                                            <a href="{{url($ord->payment_proof)}}" data-lightbox="image-1" data-title="Payment Proof" class="btn btn-info" role="button">
                                                Bukti Pembayaran
                                            </a>
                                        </div>
                                    </div>                              
                                    @endif
                                </div>
                                @if(Auth::user()->role=='admin')
                                    <div class="col-md-12" align="center">
                                    <hr>
                                        <a href="/invalid/{{$ord->id}}" class="btn btn-danger" role="button">Tidak Valid</a>
                                    
                                        <a href="/valid" class="btn btn-danger" role="button">Valid</a>
                                    </div>
                                @elseif(Auth::user()->role=='seller')
                                    <div class="col-md-12" align="center">
                                    <hr>
                                        <a href="/invalid/{{$ord->id}}" class="btn btn-danger" role="button">Terima</a>
                                    
                                        <a href="/valid" class="btn btn-danger" role="button">Tolak</a>
                                    </div>
                                @endif
                                
                                <div>&nbsp;</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div>
                                    <h4><label>Identitas Customer</label></h4>
                                     <div class="col-md-12">
                                        <label class="col-md-5">ID Customer</label>
                                        <div class="col-md-7">
                                            {{$ord->customer_id}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nomor Telepon</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->email}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nama Customer</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nomor Telepon</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->phone}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Alamat</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->street}} <br>
                                            {{$ord->city->type}} {{$ord->city->city}} <br>
                                            {{$ord->prov->province}} <br>
                                            {{$ord->cust->zip_code}}
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="col-md-7 col-md-offset-5">
                                            <a href="/viewCustomerProfile/<?php echo $ord->customer_id; ?>" class="btn btn-info" role="button">Detail Customer</a>
                                        </div>
                                    </div> -->
                                </div>
                                <div>&nbsp;</div>
                                <div>

                                    <h4><label>Informasi Pengiriman</label></h4>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nama Penerima</label>
                                        <div class="col-md-7">
                                            {{$ord->deliv->name}}                
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Telepon</label>
                                        <div class="col-md-7">
                                            {{$ord->deliv->phone}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Alamat</label>
                                        <div class="col-md-7">
                                            {{$ord->deliv->street}} <br>
                                            {{$ord->deliv->type}} {{$ord->deliv->city}} <br>
                                            {{$ord->deliv->province}} <br>
                                            {{$ord->cust->zip_code}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="col-md-12">
                            <div>
                                <h4><label>Informasi Produk</label></h4>
                                <div class="col-md-12">
                                    <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                            <th class="col-md-1" align="center">ID Seller</th>
                                            <th class="col-md-2" align="center">Nama Produk</th>
                                            <th class="col-md-1" align="center">Jumlah</th>
                                            <th class="col-md-1" align="center">Harga</th>
                                            <th class="col-md-1" align="center">Biaya Pengiriman</th>
                                            <th class="col-md-1" align="center">Jumlah Harga</th>
                                            @if(Auth::user()->role=='admin')
                                            <th class="col-md-2" align="center">Detail</th>
                                            @endif
                                        </thead>
                                        <tbody>
                                        @foreach($products as $prod)
                                            <tr>
                                                <td align="center">{{$prod->detProd->seller_id}}</td>
                                                <td>{{$prod->detProd->name}}</td>
                                                <td>{{$prod->amount}}</td>
                                                <td>{{$prod->price}}</td>
                                                <td>{{$prod->delivery_cost}}</td>
                                                <td>{{$prod->countPrice}}</td>
                                                @if(Auth::user()->role=='admin')
                                                <td>
                                                <a href="/Product/<?php echo $prod->detProd->detId; ?>" class="btn btn-info" role="button">Product</a>
                                                <a href="/viewSellerProfile/<?php echo $prod->detProd->seller_id; ?>" class="btn btn-info" role="button">Seller</a>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><h4><b>Total Biaya</b></h4></td>
                                                <td><h4><b>{{$prod->totPrice}}</b></h4></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
