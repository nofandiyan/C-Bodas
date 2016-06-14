<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Valid</h2>
        <div>
            Terimakasih telah melakukan transaksi pada C-Bodas. <br>
            Pesanan Anda telah kami validasi, sekarang pesanan anda sedang menunggu respon dari seller kami.

        <div class="container">
            <div class="row">
            <br>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                                    
                                <div align="center"><h2><label>Order<font color="E87169"> Valid</font></label></h2></div>
                                    
                                <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />

                                <div class="col-md-5 col-md-offset-1">
                                    <div class="row">
                                        <div>
                                            <h4><label>Informasi Pesanan</label></h4>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Kode Pemesanan</label>
                                                <div class="col-md-7">
                                                    {{$resvId}}              
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Tanggal Pemesanan</label>
                                                <div class="col-md-7">
                                                    {{$dateOrder}}
                                                </div>
                                            </div>
                                           
                                            
                                            <div class="col-md-12">
                                                <label class="col-md-5">Status</label>
                                                <div class="col-md-7">
                                                    {{$status}}
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <b><label class="col-md-5">Total Harga</label></b>
                                                <div class="col-md-7">
                                                    <b>{{$totPrice}}</b>
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
                                                    {{$custId}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Nomor Telepon</label>
                                                <div class="col-md-7">
                                                    {{$custMail}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Nama Customer</label>
                                                <div class="col-md-7">
                                                    {{$custName}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Nomor Telepon</label>
                                                <div class="col-md-7">
                                                    {{$custPhone}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Alamat</label>
                                                <div class="col-md-7">
                                                    {{$custStreet}}<br>
                                                    {{$custCityType}} {{$custCity}}<br>
                                                    {{$custProv}}<br>
                                                    {{$custZip}}
                                                </div>
                                            </div>
                                        </div>
                                        <div>&nbsp;</div>
                                        <div>
                                            <h4><label>Informasi Pengiriman</label></h4>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Nama Penerima</label>
                                                <div class="col-md-7">
                                                    {{$sendName}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Telepon</label>
                                                <div class="col-md-7">
                                                    {{$sendPhone}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5">Alamat</label>
                                                <div class="col-md-7">
                                                    {{$sendStreet}}<br>
                                                    {{$sendCityType}} {{$sendCity}}<br>
                                                    {{$sendProv}}<br>
                                                    {{$sendZip}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                        </thead>
                                        <tbody>
                                        
                                                @foreach($products as $prod)
                                                        <tr>
                                                            <td align="center">{{$prod['detProd']['detId']}}</td>
                                                            <td>{{$prod['detProd']['name']}}</td>
                                                            <td>{{$prod['amount']}}</td>
                                                            <td>{{$prod['price']}}</td>
                                                            <td>{{$prod['delivery_cost']}}</td>
                                                            <td>{{$prod['countPrice']}}</td>
                                                        </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><h4><b>Total Biaya</b></h4></td>
                                                    <td><h4><b>{{$totPrice}}</b></h4></td>
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
 
        </div>
    </body>
</html>