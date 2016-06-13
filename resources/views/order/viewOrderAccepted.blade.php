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

                            
                                <div align="center"><h2><label>Produk <font color="E87169">Diterima</font></label></h2></div>
                            
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
                                   
                                    
                                    <div class="col-md-12">
                                        <label class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            Accepted
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <b><label class="col-md-5">Total Harga</label></b>
                                        <div class="col-md-7">
                                            
                                                <b>{{$totPriceSellerAccepted}}</b>
                                            
                                        </div>
                                    </div>
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
                                            <th class="col-md-2" align="center">Tanggal Di Terima</th>
                                            <th class="col-md-2" align="center">Opsi</th>
                                        </thead>
                                        <tbody>
                                        
                                                @foreach($productSellerAccepted as $prod)
                                                        <tr>
                                                            <td align="center">{{$prod->detId}}</td>
                                                            <td>{{$prod->detProd->name}}</td>
                                                            <td>{{$prod->amount}}</td>
                                                            <td>{{$prod->price}}</td>
                                                            <td>{{$prod->delivery_cost}}</td>
                                                            <td>{{$prod->countPrice}}</td>
                                                            <td>{{$prod->updated_at}}</td>
                                                            <td>
                                                                <form method="POST" action="/shipping/{{$prod->resvId}}/{{$prod->detId}}" role="form">
                                                                
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <div id="hideme">
                                                                        <a class="btn btn-info" role="button" data-popup-open="popup-resi-{{$prod->resvId}}/{{$prod->detId}}">Kirim Sekarang</a>
                                                                        @if ($errors->has('resi'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('resi') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="popup" data-popup="popup-resi-{{$prod->resvId}}/{{$prod->detId}}">
                                                                        <div class="popup-inner">
                                                                            <div align="center">
                                                                                <label><h4><label>Masukkan Nomor Resi</label></h4>
                                                                                    
                                                                                    <div class="col-md-12 {{ $errors->has('resi') ? ' has-error' : '' }}">
                                                                                        <input type="text" id="resi" name="resi" maxlength="30"/>
                                                                                    </div>
                                                                                    <br>
                                                                                    <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                                                                        <i class="fa fa-btn fa-user"></i>Simpan
                                                                                    </button>
                                                                            </div>
                                                                            <a class="popup-close" data-popup-close="popup-resi-{{$prod->resvId}}/{{$prod->detId}}" href="#">x</a>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="2" align="right"><h4><b>Total Harga</b></h4></td>
                                                    <td><h4><b>{{$totPriceSellerAccepted}}</b></h4></td>
                                                    <td></td>
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
