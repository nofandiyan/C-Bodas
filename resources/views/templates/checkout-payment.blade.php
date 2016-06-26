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
                    <p>Payment Method</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li class="active">Payment Method</li>
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
                                    <div class="title">Alamat Pengiriman</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step active">
                                    <div class="number">2</div>
                                    <div class="title">Metode Pengiriman</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step active">
                                    <div class="number">3</div>
                                    <div class="title">Metode Pembayaran</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step">
                                    <div class="number">4</div>
                                    <div class="title">Ulasan Pemesanan</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="progress checkout-progress hidden-xs"><div class="progress-bar" role="progressbar" aria-valuenow="66.6" aria-valuemin="0" aria-valuemax="100" style="width:66.6%;"></div></div>
                        
                        <form action="{{action('ApiShippingController@reviewpemesanan')}}" method="post">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h3>Metode Pembayaran</h3>
                            <div class="products-order checkout payment-method">
                            	<div id="payment-methods" role="tablist" aria-multiselectable="true">
                                <p>Silahkan Pilih Salah Satu Bank Berikut Untuk Melakukan Pembayaran Dengan Cara Transfer</p> 
                                <div class="col-sm-6">
                                    <div class="panel radio">
                                        <input type="radio" name="Bank" id="radio-payment-1" checked value="Bank Mandiri">
                                        <label for="radio-payment-1" data-toggle="collapse" data-target="#parent-1" data-parent="#payment-methods" aria-controls="parent-1">Bank Mandiri</label>
                                    </div>    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="panel radio">
                                        <input type="radio" name="Bank" id="radio-payment-2" checked value="Bank BNI">
                                        <label for="radio-payment-2" class="collapsed" data-toggle="collapse" data-target="#parent-2" data-parent="#payment-methods" aria-controls="parent-2">Bank BNI</label>
                                    </div>    
                                </div>
                                <div class="col-sm-6">
                                    <div class="panel radio">
                                        <input type="radio" name="Bank" id="radio-payment-3" checked value="Bank BCA">
                                        <label for="radio-payment-3" class="collapsed" data-toggle="collapse" data-target="#parent-3" data-parent="#payment-methods" aria-controls="parent-3">Bank BCA</label>
                                    </div>    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="panel radio">
                                        <input type="radio" name="Bank" id="radio-payment-4" checked value="Bank BRI">
                                        <label for="radio-payment-4" class="collapsed" data-toggle="collapse" data-target="#parent-4" data-parent="#payment-methods" aria-controls="parent-4">Bank BRI</label>
                                    </div>    
                                </div> 
                                </div>

                                <p><br>Nama Rekening</p> 
                                <input type="text" name="bankaccount">
                            </div>
                            <div class="clearfix">
                                <button type="submit" class="btn btn-primary btn-sm add-to-cart" name="data">Lanjutkan</button>
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
        
   @stop