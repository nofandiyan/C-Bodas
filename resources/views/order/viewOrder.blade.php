@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Order</div>
                <div class="panel-body">
                    
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">

                        <div class="col-md-6">
                            <div class="row">
                                <div>
                                    <label>Informasi Pesanan</label>
                                    <br>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Kode Pemesanan</label>
                                        <div class="col-md-7">
                                            {{$orders->reservation_id}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Tanggal Pemesanan</label>
                                        <div class="col-md-7">
                                            {{$orders->schedule}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">ID Detail Produk</label>
                                        <div class="col-md-7">
                                            {{$orders->detail_product_id}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nama Produk</label>
                                        <div class="col-md-7">
                                            {{$orders->product_name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Kategori Produk</label>
                                        <div class="col-md-7">
                                            {{$orders->category_name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Jumlah Pesanan</label>
                                        <div class="col-md-7">
                                            {{$orders->amount}} 
                                            @if($orders->category_id == 1)
                                            <label>Kilogram</label>
                                            @elseif ($orders->category_id == 2)
                                            <label>Ekor</label>
                                            @elseif ($orders->category_id == 3)
                                            <label>Tiket</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Harga</label>
                                        <div class="col-md-7">
                                            {{$price->price}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Total Harga</label>
                                        <div class="col-md-7">
                                            {{$orders->amount * $price->price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div>
                                    <label>Identitas Customer</label>
                                    <br>
                                     <div class="col-md-12">
                                        <label class="col-md-5">ID Customer</label>
                                        <div class="col-md-7">
                                            {{$orders->customer_id}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nama Customer</label>
                                        <div class="col-md-7">
                                            {{$orders->user_name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nomor Telepon</label>
                                        <div class="col-md-7">
                                            {{$orders->phone}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Alamat Penagihan</label>
                                        <div class="col-md-7">
                                            {{$orders->street}}<br>
                                            {{$orders->city}}<br>
                                            {{$orders->province}}<br>
                                            {{$orders->zip_code}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Alamat Pengiriman</label>
                                        <div class="col-md-7">
                                            {{$orders->street}}<br>
                                            {{$orders->city}}<br>
                                            {{$orders->province}}<br>
                                            {{$orders->zip_code}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" align="center">
                            <a href="/reject" class="btn btn-danger" role="button">Tolak</a>
                        
                            <a href="/reject" class="btn btn-danger" role="button">Terima</a>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop
