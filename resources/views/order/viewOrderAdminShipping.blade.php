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

                            
                                <div align="center"><h2><label>Produk <font color="E87169">Di Kirim</font></label></h2></div>
                            
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
                                                Shipping
                                        </div>
                                    </div>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                    <h4><label>Rincian</label></h4>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Jumlah + Harga</label>
                                        <div class="col-md-7">
                                            {{$prices}}    
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-5">Jumlah Potongan 5%</label>
                                        <div class="col-md-7">
                                            {{$countProfit}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label class="col-md-5">Jumlah Biaya Pengiriman</label>
                                        <div class="col-md-7">
                                            {{$priceDeliv}}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <b><label class="col-md-5">Jumlah Transfer Ke Seller</label></b>
                                        <div class="col-md-7">
                                            <b>{{$totPriceSeller}}</b>
                                        </div>
                                    </div>
                                </div>
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
                                        <label class="col-md-5">Email</label>
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
                                            {{$ord->deliv->zip_code}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-md-13">
                            <div>
                                <h4><label>Informasi Produk</label></h4>
                                <div class="col-md-13">
                                    <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                            <th class="col-md-1" align="center">ID Produk</th>
                                            <th class="col-md-2" align="center">Nama Produk</th>
                                            <th class="col-md-1" align="center">Untuk Tanggal</th>
                                            <th class="col-md-1" align="center">Jumlah</th>
                                            <th class="col-md-1" align="center">Harga</th>
                                            <th class="col-md-1" >Potong 5%</th>
                                            <th class="col-md-1" align="center">Biaya Pengiriman</th>
                                            <th class="col-md-1" align="center">Jumlah Harga</th>
                                            <th class="col-md-1" align="center">Tanggal Pengiriman</th>
                                            <th class="col-md-1" align="center">Nomor Resi Pengiriman</th>
                                            <th class="col-md-1" align="center">Opsi</th>
                                        </thead>
                                        <tbody>
                                        <?php $i=1; ?>
                                                @foreach($productSeller as $prod)
                                                        <tr>
                                                            <td align="center">{{$prod->detProd->detId}}</td>
                                                            <td>{{$prod->detProd->name}}</td>
                                                            @if($prod->detProd->category_id == 3)
                                                                <td>{{$prod->schedule}}</td>
                                                            @else
                                                                <td>-</td>
                                                            @endif
                                                            <td>{{$prod->amount}}</td>
                                                            <td>{{$prod->price}}</td>
                                                            <td>{{$prod->profit[$i]}}</td>
                                                            <td>{{$prod->delivery_cost}}</td>
                                                            <td>{{$countPrice[$i]}}</td>
                                                            <td>{{$prod->updated_at}}</td>
                                                            <td>{{$prod->resi}}</td>
                                                            <td>
                                                                <a href="/shipped/{{$ord->cust->resvId}}/{{$prod->detProd->detId}}" class="btn btn-info" role="button">Sent</a>
                                                            </td>
                                                        </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><h4><b>{{$totPriceSeller}}</b></h4></td>
                                                    <td></td>
                                                    <td></td>
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
