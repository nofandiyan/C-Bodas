@extends('templates\master',['url'=>'barang','link'=>'barang'])

@section('konten')

    
    <!-- ==========================
    	BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h2>Checkout</h2>
                    <p>Review</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li class="active">Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
	<!-- ==========================
    	BREADCRUMB - END 
    =========================== -->
    
    <!-- ==========================
    	MY ACCOUNT - START 
    =========================== -->
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <article class="account-content checkout-steps">
                        
                        <div class="row row-no-padding">
                        	<div class="col-xs-6 col-sm-3">
                            	<div class="checkout-step active">
                                	<div class="number">1</div>
                                    <div class="title">Billing & Shipping Address</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step active">
                                	<div class="number">2</div>
                                    <div class="title">Shipping Method</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step active">
                                	<div class="number">3</div>
                                    <div class="title">Payment Method</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step active">
                                	<div class="number">4</div>
                                    <div class="title">Review</div>
                                </div>
                            </div>
                        </div>
                                                
                        <div class="progress checkout-progress hidden-xs"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;"></div></div>
                        	
                        <form action="{{action('CartController@postcart')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h3>Review Order</h3>                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="box">
                                        <h4>Alamat Pengiriman</h4>
                                        <ul class="list-unstyled">
                                            <li>{{ $destination->street }}</li>
                                            <li>{{ $destination->city }}</li>
                                            <li>{{ $destination->province }}</li>
                                            <li>{{ $destination->zip_code }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="box">
                                        <h4>Informasi Bank</h4>
                                        <ul class="list-unstyled">
                                            <li><?php echo $bank['bank_name']?></li>
                                            <li><?php echo $bank['bank_account']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                </div>
                               
                            </div>
                            
                            <div class="products-order checkout shopping-cart">
                                <div class="table-responsive">
                                    <table class="table table-products">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga Unit</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=0;
                                            $total=0;
                                            ?>

                                             

                                            @foreach ($cart as $c)
                                            <tr>
                                                 

                                                <td class="col-xs-4 col-md-5 text-center"><h4><?php echo $c['name']; ?></h4></td>
                                          
                                                <td class="col-xs-2 text-center"><span>Rp <?php echo $c['price']; ?></span></td>

                                                <td class="col-xs-2 text-center"><span><?php echo $c['jumlah']; ?></span></td>
                                           
                                                    
                                                      <?php 
                                                    $subtotal = $c['jumlah']*$c['price'];
                                                    $total += $subtotal;

                                                    $finaltotal=$total+intval($hargaongkir['harga_ongkir']);

                                                    ?>
                                            </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <ul class="list-unstyled order-total">
                                    <li>Sub Total<span>Rp </span><span id="total"><?php echo $total ?></span></li>
                                    <li>Ongkos Kirim<span>Rp </span><span><?php echo $hargaongkir['harga_ongkir'];?></span></li>
                                    <li>Total<span>Rp </span><span><?php echo $finaltotal;?></span></li>
                                </ul>
                            </div>
                            <div class="clearfix">
                                 <td><button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">Konfirmasi Pesanan</button></td>   
                            </form>    
                            </div>
                        </form>                        
                    </article>
                </div>
            </div> 
        </div>
    </section>
    <!-- ==========================
    	MY ACCOUNT - END 
    =========================== -->
    <script type="text/javascript">

    function multiplyBy(id)
    {

        harga = document.getElementById("harga"+id).value;
        jumlah = document.getElementById("jumlah"+id).value;
        category_id = document.getElementById("category_id"+id).value;
        subtotal=harga*jumlah;

        document.getElementById("result"+id).innerHTML = subtotal;



        var total = document.getElementsByClassName("total_harga_item");
        var totalHarga = 0;
        for(var i=0;i<total.length;i++){
        totalHarga += parseInt(total[i].innerHTML);
    }

    document.getElementById("total").innerHTML = totalHarga;

}
function alert1(){
    alert("Jumlah Minimal 1");
}
function alert5(){
    alert("Jumlah Minimal 5");
}


</script>    
    @stop