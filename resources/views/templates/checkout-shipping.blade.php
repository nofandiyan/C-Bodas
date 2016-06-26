@extends('templates\master',['url'=>'barang','link'=>'barang'])
<link href="{{ URL::asset('assets/css/normalize.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/skeleton.css') }}" rel="stylesheet" type="text/css">
@section('konten')

    <!-- ==========================
    	BREADCRUMB - START 
        =========================== -->
        <section class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <h2>Checkout</h2>
                        <p>Shipping Method</p>
                    </div>
                    <div class="col-xs-6">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li class="active">Shipping Method</li>
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
                                <div class="checkout-step">
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

                            <div class="progress checkout-progress hidden-xs"><div class="progress-bar" role="progressbar" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100" style="width:33.3%;"></div></div>

                                <h3>Ulasan Pengiriman</h3>
                                <div class="products-order checkout shipping-method">


                                </div>
                                <div class="row">
                                    <form action="{{action('ApiShippingController@pilihongkir')}}" method="post">
                                        {!! csrf_field() !!}
                                        <div class="table-responsive">

                                            <table class="table table-products">

                                                <tr>
                                                    <th>Servis</th>
                                                    <th>Deskripsi Servis</th>   
                                                    <th>Lama Kirim (hari)</th>
                                                    <th>Total Biaya</th>
                                                    <th></th>
                                                </tr>
                                                <span id="resultbox">
                                                    @foreach($services as $service)

                                                    <tr>

                                                        <td>{{ $service->service }}</td>
                                                        <td>{{ $service->description }}</td>
                                                        <td>{{ $service->cost[0]->etd }}</td>
                                                        <td>{{ $service->cost[0]->value*$weight }}</td>
                                                        <td class="col-xs-1 text-center">

                                                            <button type="submit" class="btn btn-primary btn-sm add-to-cart" name="data" value="{{ $service->cost[0]->value*$weight }}">Pilih</button>

                                                        </td>
                                                    </tr>

                                                    @endforeach

                                                </span> 

                                            </table>

                                        </div>
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
        
        @stop