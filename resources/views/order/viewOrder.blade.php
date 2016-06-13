@extends('templates.master')

@section('konten')
<script>
    function hide(obj) {
        var el = document.getElementById(obj);
            el.style.display = 'none';
    }
</script>
<style type="text/css">
    fieldset {
        padding-top:10px;
        padding-bottom:10px;
        border:1px solid #999;
        border-radius:8px;
        box-shadow:0 0 10px #999;
        margin:auto;
    }
</style>
<div class="container">
    <div class="row">
    <br>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                        @foreach($order as $ord)

                        @if(Auth::user()->role=='admin')
                            <div align="center"><h2><label>View Order</label></h2></div>                        
                        @endif
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />

                        <div class="col-md-5 col-md-offset-1">
                            <div class="row">
                                <div>
                                    <h4><label>Informasi Pesanan</label></h4>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Kode Pemesanan</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->resvId}}                
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Tanggal Pemesanan</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->created_at}}
                                        </div>
                                    </div>
                                    @if(Auth::user()->role=='admin')
                                    <div class="col-md-12">
                                        <label class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            @if($ord->cust->resvStatus == 1)
                                                Pending
                                            @elseif($ord->cust->resvStatus == 2)
                                                Valid
                                            @elseif($ord->cust->resvStatus == 3)
                                                Invalid
                                            @elseif($ord->cust->resvStatus == 4)
                                                Reservation Closed
                                            @endif
                                        </div>
                                    </div>
                                    <div>&nbsp;</div>
                                    <h4><label>Informasi Transfer</label></h4>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nama Bank</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->bank_name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Nomor Rekening</label>
                                        <div class="col-md-7">
                                            {{$ord->cust->bank_account}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Total Biaya</label>
                                        <div class="col-md-7">
                                            {{$totPriceAdmin}}
                                        </div>
                                    </div>
                                            @if($ord->cust->resvStatus == '1')
                                                <a class="btn" data-popup-open="popup-1" href="#">Bukti Pembayaran</a>
                                                <div class="popup" data-popup="popup-1">
                                                    <div class="popup-inner" align="center">
                                                        <img src="{{url($ord->cust->payment_proof)}}" width="300px" />
                                                        <a href="/invalid/<?php echo $ord->cust->resvId ?>" class="btn btn-danger" role="button">Tidak Valid</a>
                                                        <a href="/valid/<?php echo $ord->cust->resvId ?>" class="btn btn-danger" role="button">Valid</a>
                                                        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                                                    </div>
                                                </div>
                                            @elseif($ord->cust->resvStatus == '2' || $ord->cust->resvStatus == '3')
                                            <a class="btn" data-popup-open="popup-1" href="#">Bukti Pembayaran</a>
                                                <div class="popup" data-popup="popup-1">
                                                    <div class="popup-inner" align="center">
                                                        <img src="{{url($ord->cust->payment_proof)}}" width="300px" />
                                                        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                                                    </div>
                                                </div>
                                            @endif

                                    <div class="col-md-12">
                                        <b><label class="col-md-5">Total Biaya</label></b>
                                        <div class="col-md-7">
                                            @if($ord->cust->cartStatus==0)
                                                <b>{{$totPriceSeller}}</b>
                                            @elseif($ord->cust->cartStatus==1)
                                                <b>{{$totPriceSellerAccepted}}</b>
                                            @elseif($ord->cust->cartStatus==2)
                                                <b>{{$totPriceSellerRejected}}</b>
                                            @elseif($ord->cust->cartStatus==3)
                                                <b>{{$totPriceSellerShipping}}</b>
                                            @elseif($ord->cust->cartStatus==4)
                                                <b>{{$totPriceSellerShipped}}</b>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
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
                                            {{$ord->cust->customer_id}}
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
                        </div>
                        @endforeach

                        <div class="col-md-12">
                            <div>
                                <h4><label>Informasi Produk</label></h4>
                                <div class="col-md-12">
                                    <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                            <th class="col-md-1" align="center">ID Produk</th>
                                            <th class="col-md-3" align="center">Nama Produk</th>
                                            <th class="col-md-1" align="center">Jumlah</th>
                                            <th class="col-md-1" align="center">Harga</th>
                                            <th class="col-md-1" align="center">Biaya Pengiriman</th>
                                            <th class="col-md-1" align="center">Jumlah Harga</th>
                                            @if(Auth::user()->role=='admin')
                                            <th class="col-md-2" align="center">Detail</th>
                                            @elseif(Auth::user()->role=='seller')
                                                @if($ord->cust->cartStatus==0)
                                                <th class="col-md-2" align="center">Opsi</th>
                                                @elseif($ord->cust->cartStatus==1)
                                                <b>{{$totPriceSellerAccepted}}</b>
                                                @elseif($ord->cust->cartStatus==2)
                                                <b>{{$totPriceSellerRejected}}</b>
                                                @elseif($ord->cust->cartStatus==3)
                                                <th class="col-md-2" align="center">Kode Pengiriman</th>
                                                @elseif($ord->cust->cartStatus==4)
                                                <th class="col-md-2" align="center">Kode Pengiriman</th>
                                                @endif
                                            @endif
                                        </thead>
                                        <tbody>
                                        @if(Auth::user()->role=='admin')
                                            @foreach($products as $prod)
                                                <tr>
                                                    <td align="center">{{$prod->detProd->detId}}</td>
                                                    <td>{{$prod->detProd->name}}</td>
                                                    <td>{{$prod->amount}}</td>
                                                    <td>{{$prod->price}}</td>
                                                    <td>{{$prod->delivery_cost}}</td>
                                                    <td>{{$prod->countPrice}}</td>
                                                    <td>
                                                        <a href="/Product/<?php echo $prod->detProd->detId; ?>" class="btn btn-info" role="button">Product</a>
                                                        <a href="/viewSellerProfile/<?php echo $prod->detProd->seller_id; ?>" class="btn btn-info" role="button">Seller</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><h4><b>Total Biaya</b></h4></td>
                                                <td><h4><b>{{$totPriceAdmin}}</b></h4></td>
                                            </tr>
                                        @elseif(Auth::user()->role=='seller')
                                            @if($ord->cust->resvStatus == 2)
                                                @if($ord->cust->cartStatus == 0)
                                                    @foreach($productSeller as $prod)
                                                            <tr>
                                                                <td align="center">{{$prod->detProd->detId}}</td>
                                                                <td>{{$prod->detProd->name}}</td>
                                                                <td>{{$prod->amount}}</td>
                                                                <td>{{$prod->price}}</td>
                                                                <td>{{$prod->delivery_cost}}</td>
                                                                <td>{{$prod->countPrice}}</td>
                                                                <td>
                                                                    <div class="col-md-12" align="center">
                                                                        <a href="/accepted/{{$prod->resvId}}/{{$prod->detId}}" class="btn btn-danger" role="button">Terima</a>
                                                                        <a href="/rejected/{{$prod->resvId}}/{{$prod->detId}}" class="btn btn-danger" role="button">Tolak</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><h4><b>Total Biaya</b></h4></td>
                                                        <td><h4><b>{{$totPriceSeller}}</b></h4></td>
                                                    </tr>
                                                
                                                @elseif($ord->cust->cartStatus == 1)
                                                    @foreach($productSellerAccepted as $prod)
                                                        <tr>
                                                            <td align="center">{{$prod->detProd->detId}}</td>
                                                            <td>{{$prod->detProd->name}}</td>
                                                            <td>{{$prod->amount}}</td>
                                                            <td>{{$prod->price}}</td>
                                                            <td>{{$prod->delivery_cost}}</td>
                                                            <td>{{$prod->countPrice}}</td>
                                                            <td>
                                                                <div id="hideme">
                                                                    <a class="btn btn-info" role="button" data-popup-open="popup-2" href="#">Kirim Sekarang</a>
                                                                    @if ($errors->has('resi'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('resi') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="popup" data-popup="popup-2">
                                                                    <div class="popup-inner">
                                                                        <div align="center">
                                                                            <form method="POST" action="/shipping/{{$prod->resvId}}/{{$prod->detId}}" role="form">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                <label><h4><label>Masukkan Nomor Resi</label></h4>
                                                                                    <div class="col-md-12 {{ $errors->has('resi') ? ' has-error' : '' }}">
                                                                                    <input type="text" id="resi" name="resi" maxlength="30"/>
                                                                                    </div>
                                                                                    <br>
                                                                                    <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                                                                        <i class="fa fa-btn fa-user"></i>Simpan
                                                                                    </button>
                                                                            </form>
                                                                        </div>
                                                                        <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><h4><b>Total Biaya</b></h4></td>
                                                        <td><h4><b>{{$totPriceSellerAccepted}}</b></h4></td>
                                                    </tr>

                                                @elseif($ord->cust->cartStatus == 2)
                                                    @foreach($productSellerRejected as $prod)
                                                            <tr>
                                                                <td align="center">{{$prod->detProd->detId}}</td>
                                                                <td>{{$prod->detProd->name}}</td>
                                                                <td>{{$prod->amount}}</td>
                                                                <td>{{$prod->price}}</td>
                                                                <td>{{$prod->delivery_cost}}</td>
                                                                <td>{{$prod->countPrice}}</td>
                                                                <td>
                                                                    <div class="col-md-12" align="center">
                                                                        <a href="/accepted/{{$prod->resvId}}/{{$prod->detId}}" class="btn btn-danger" role="button">Terima</a>
                                                                        <a href="/rejected/{{$prod->resvId}}/{{$prod->detId}}" class="btn btn-danger" role="button">Tolak</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><h4><b>Total Biaya</b></h4></td>
                                                        <td><h4><b>{{$totPriceSellerRejected}}</b></h4></td>
                                                    </tr>
                                                

                                                @elseif($ord->cust->cartStatus == 3)
                                                    @foreach($productSellerShipping as $prod)
                                                            <tr>
                                                                <td align="center">{{$prod->detProd->detId}}</td>
                                                                <td>{{$prod->detProd->name}}</td>
                                                                <td>{{$prod->amount}}</td>
                                                                <td>{{$prod->price}}</td>
                                                                <td>{{$prod->delivery_cost}}</td>
                                                                <td>{{$prod->countPrice}}</td>
                                                                <td>Kode Pengiriman <br>{{$prod->resi}}</td>
                                                            </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><h4><b>Total Biaya</b></h4></td>
                                                        <td><h4><b>{{$totPriceSellerShipping}}</b></h4></td>
                                                    </tr>
                                                @elseif($ord->cust->cartStatus == 4)
                                                    @foreach($productSellerShipped as $prod)
                                                            <tr>
                                                                <td align="center">{{$prod->detProd->detId}}</td>
                                                                <td>{{$prod->detProd->name}}</td>
                                                                <td>{{$prod->amount}}</td>
                                                                <td>{{$prod->price}}</td>
                                                                <td>{{$prod->delivery_cost}}</td>
                                                                <td>{{$prod->countPrice}}</td>
                                                                <td>Kode Pengiriman <br>{{$prod->resi}}</td>
                                                            </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><h4><b>Total Biaya</b></h4></td>
                                                        <td><h4><b>{{$totPriceSellerShipped}}</b></h4></td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endif
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
