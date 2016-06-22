<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Valid</h2>
        <div>
            Terimakasih telah melakukan transaksi melaklui aplikasi C-Bodas. <br><br>
            Pesanan Anda telah kami validasi, <br>
            Untuk pemesanan produk pertanian dan peternakan menunggu respon dari seller kami untuk di tindak lanjuti. <br>
            Untuk pemesanan tiket pariwisata, tunjukkan email berikut untuk masuk ke lokasi<br>

            <div align="center"><h2><label>Order<font color="E87169"> Valid</font></label></h2></div>
            <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />

            <table style="width:100%">
                @foreach($order as $ord)
                <tr>
                    <td style="width:50%" valign="top">
                        <table>
                        <caption><h3><label>Informasi Pesanan</label></h3></caption>
                            <tr>
                                <td style="width:20%" align="right">Kode Pemesanan</td>
                                <td style="width:20%">{{$ord['cust']['reservation_id']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Tanggal Pemesanan</td>
                                <td style="width:20%">{{$ord['cust']['created_at']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Status</td>
                                <td style="width:20%">Valid</td>
                            </tr>
                            
                            <tr>
                                <td style="width:20%" align="right"><b><label class="col-md-5">Total Harga</label></b></td>
                                <td style="width:20%"><b>{{$totPrice}}</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:50%" align="right">
                        <table>
                        <caption><h3><label>Informasi Customer</label></h3></caption>
                            <tr>
                                <td style="width:20%" align="right">ID Customer</td>
                                <td style="width:20%">{{$ord['cust']['customer_id']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Email</td>
                                <td style="width:20%">{{$ord['cust']['email']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Nama Customer</td>
                                <td style="width:20%">{{$ord['cust']['name']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Nomor Telepon</td>
                                <td style="width:20%">{{$ord['cust']['phone']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Alamat</td>
                                <td style="width:20%">{{$ord['cust']['street']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right"></td>
                                <td style="width:20%">{{$ord['city']['type']}} {{$ord['city']['city']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right"></td>
                                <td style="width:20%">{{$ord['prov']['province']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right"></td>
                                <td style="width:20%">{{$ord['cust']['zip_code']}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width:50%" valign="top">
                        &nbsp;
                    </td>
                    <td style="width:50%" align="right">
                        <table>
                        <caption><h3><label>Informasi Pengiriman</label></h3></caption>
                            <tr>
                                <td style="width:20%" align="right">Nama Penerima</td>
                                <td style="width:20%">{{$ord['deliv']['name']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Telepon</td>
                                <td style="width:20%">{{$ord['deliv']['phone']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right">Alamat</td>
                                <td style="width:20%">{{$ord['deliv']['street']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right"></td>
                                <td style="width:20%">{{$ord['deliv']['type']}} {{$ord['deliv']['city']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right"></td>
                                <td style="width:20%">{{$ord['deliv']['province']}}</td>
                            </tr>
                            <tr>
                                <td style="width:20%" align="right"></td>
                                <td style="width:20%">{{$ord['deliv']['zip_code']}}</td>
                            </tr>                
                        </table>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td style="width:100%" valign="top" colspan="2">
                        <table border="2px" style="width:90%;" align="center">
                        <caption><h3><label>Detail Produk</label></h3></caption>
                            <tr>
                                <th style="width:10%">ID Produk</th>
                                <th style="width:30%">Nama Produk</th>
                                <th style="width:15%">Jumlah</th>
                                <th style="width:15%">Harga</th>
                                <th style="width:15%">Biaya Pengiriman</th>
                                <th style="width:15%">Jumlah Harga</th>
                            </tr>
                            <?php $i=1; ?>
                             @foreach($product as $prod)
                                <tr>
                                    <td align="center">{{$prod['detProd']['detId']}}</td>
                                    <td>{{$prod['detProd']['name']}}</td>
                                    <td align="center">{{$prod['amount']}}</td>
                                    <td>{{$prod['price']}}</td>
                                    @if($prod['detProd']['category_id'] == 1)
                                    <td>{{$prod['delivery_cost']}}</td>
                                    @else
                                    <td>0</td>
                                    @endif
                                    <td>{{$countPrice[$i]}}</td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </table>
                        <table style="width:90%" align="center">
                            <tr>
                                <td style="width:10%"></td>
                                <td style="width:30%"></td>
                                <td style="width:15%"></td>
                                <td style="width:15%"></td>
                                <td style="width:15%" align="right"><h4><b>Total Harga</b></h4></td>
                                <td style="width:15%"><h4><b>{{$totPrice}}</b></h4></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>