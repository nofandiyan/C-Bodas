@extends('templates\master',['url'=>'barang','link'=>'barang'])

@section('konten')
    
    <!-- ==========================
    	BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h2>C-Bodas</h2>
                    <p>Cart</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Cart</li>
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
                    <article class="account-content">
                        
                        <form>
                            <div class="products-order shopping-cart">
                            	<div class="table-responsive">
                                    <table class="table table-products">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga Unit</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                                <th>Add</th>
                                                <th>Remove</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach ($cart as $c)
                                            <tr>
                                                <form action="{{action('CartSubController@jml')}}" method="post">
                                                <input type="hidden" name="name" value="<?php echo $c['name']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $c['price']; ?>">
                                               

                           

                                                <td class="col-xs-4 col-md-5 text-center"><h4><a href="single-product.html"><?php echo $c['name']; ?></h4></td>
                                                <td class="col-xs-2 text-center"><span>Rp <?php echo $c['price']; ?></span></td>
                                                <td class="col-xs-2 col-md-1"><div class="form-group"> <input type="text" class="form-control" name="jumlah" placeholder="1" >
                                                <td class="col-xs-2 text-center"><span>Rp <?php echo $c['total']; ?></span></td>
                                                <td class="col-xs-1 text-center"><input type="submit" class="btn btn-primary btn-sm add-to-cart" value="Tambah"></td>
                                                <td class="col-xs-1 text-center"><input type="submit" class="btn btn-primary btn-sm add-to-cart" value="Hapus"></td>
                                                </form>
                                            </tr>
                                           @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            	<a href="{{ url('/') }}" class="btn btn-inverse">Continue Shopping</a>
                                <a href="#" class="btn btn-inverse update-cart">Update Shopping Cart</a>
                            </div>
                        
                            <div class="box">
                                <div class="row">
                                    <div class="col-sm-6">
                                        
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <ul class="list-unstyled order-total">
                                            <li>Total products<span>$315.00</span></li>
                                            <li>Discount<span>- $25.00</span></li>
                                            <li>Subtotal<span class="total">$290.00</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <a href="checkout" class="btn btn-primary btn-lg pull-right ">Checkout</a>
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