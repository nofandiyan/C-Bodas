@extends('templates\master')

@section('konten')

   <!-- ==========================
        BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                <h2>C-Bodas</h2>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        
                        <li class="active">Halaman Utama</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END 
    =========================== -->
    
    <!-- ==========================
        PRODUCTS - START 
    =========================== -->
    <section class="content products">
        <div class="container">
            <h2 class="hidden">Products</h2>
            <div class="row">
                <div class="col-sm-3">
                    <aside class="sidebar">
                        
                        <!-- WIDGET:CATEGORIES - START -->
                        <div class="widget widget-categories">
                            <h3><a role="button" data-toggle="collapse" href="#widget-categories-collapse" aria-expanded="true" aria-controls="widget-categories-collapse">Kategori</a></h3>
                            <div class="collapse in" id="widget-categories-collapse" aria-expanded="true" role="tabpanel">
                                <div class="widget-body">
                                    <ul class="list-unstyled" id="categories" role="tablist" aria-multiselectable="true">
                                        <li class="panel"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#categories" href="#parent-1" aria-expanded="false" aria-controls="parent-1">Pertanian<span></span></a>
                                           
                                        </li>

                                        <li class="panel"><a role="button" data-toggle="collapse" data-parent="#categories" href="#parent-2" aria-expanded="true" aria-controls="parent-2">Peternakan<span>[2]</span></a>
                                            <ul id="parent-2" class="list-unstyled panel-collapse collapse in" role="menu">
                                                <li><a href="katalogdomba">Domba</a></li>
                                                <li class="active"><a href="#">Sapi</a></li>
                                            </ul>
                                        </li>

                                        
                                        <li class="panel"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#categories" href="katalogpariwisata" aria-expanded="false" aria-controls="parent-3">Pariwisata</a>
                                            <ul id="parent-4" class="list-unstyled panel-collapse collapse" role="menu">
                                                
                                            </ul>
                                        </li>
                                        <li class="panel"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#categories" href="#parent-4" aria-expanded="false" aria-controls="parent-4">Vila</a>
                                            <ul id="parent-5" class="list-unstyled panel-collapse collapse" role="menu">
                                                
                                            </ul>
                                        </li>
                                        <li class="panel"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#categories" href="#parent-6" aria-expanded="false" aria-controls="parent-6">Edukasi Tani</a>
                                            <ul id="parent-6" class="list-unstyled panel-collapse collapse" role="menu">
                                                
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- WIDGET:CATEGORIES - END -->
                        
                        <!-- WIDGET:PRICE - START -->
                        <div class="widget widget-price">
                            <h3><a role="button" data-toggle="collapse" href="#widget-price-collapse" aria-expanded="true" aria-controls="widget-price-collapse">Filter Berdasarkan Harga</a></h3>
                            <div class="collapse in" id="widget-price-collapse" aria-expanded="true" role="tabpanel">
                                <div class="widget-body">
                                    <div class="price-slider">  
                                        <input type="text" class="pull-left" id="amount" readonly> 
                                        <input type="text" class="pull-right" id="amount2" readonly>                       
                                        <div id="slider-range"></div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- WIDGET:PRICE - END -->
                        
                    </aside>
                </div>
                <div class="col-sm-9">
                    
                   
                    
                    <div class="row grid" id="products">
                        
                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="assets/images/products/Peternakan/domba.jpg" class="img-responsive" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Domba</h3>
                                            <div class="product-labels">
                                               
                                                <span class="label label-danger">Sale</span>
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                              
                                                <span class="amount">Rp 4.200.000</span>
                                            </span>
                                            <p>Domba sehat. </p>
                                            <div class="buttons">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>
                                                <a href="#" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->
                        
                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="assets/images/products/Peternakan/dombagarut.jpg" class="img-responsive" alt="">
                                            
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Domba Garut</h3>
                                            <div class="product-labels">
                                               
                                    
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <span class="amount">Rp 5.200.000</span>
                                            </span>
                                            <p>Sapi FH </p>
                                            <div class="buttons">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>
                                                <a href="#" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->
                        
                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="assets/images/products/Peternakan/dombaa.jpg" class="img-responsive" alt="">
                                            
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Domba Siap Potong</h3>
                                            <div class="product-labels">
                
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <span class="amount">Rp 5.000.000</span>
                                                
                                            </span>
                                            <p>Domba bagus</p>
                                            <div class="buttons">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>
                                                <a href="#" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->
                        
                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="assets/images/products/Peternakan/domba super.jpg" class="img-responsive" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Domba Super</h3>
                                            <div class="product-labels">
                                                
                                                
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <span class="amount">Rp 6.300.000<br></span>
                                            </span>
                                            <p>Domba super </p>
                                            <div class="buttons">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>
                                                <a href="#" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->
                        
                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="assets/images/products/Peternakan/dombaaa.jpg" class="img-responsive" alt="">
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>SDomba Sehat</h3>
                                            <div class="product-labels">
                                                
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                               
                                                <span class="amount">Rp 5.300.000</span>
                                            </span>
                                            <p>Sapi Limosin murni umur 1 tahun bobot 300 Kg</p>
                                            <div class="buttons">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>
                                                <a href="#" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->
                        
                        <!-- PRODUCT - START -->
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="assets/images/products/Peternakan/domba ikal.jpg" class="img-responsive" alt="">
                                            
                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>Domba</h3>
                                            <div class="product-labels">
                                               
                                                
                                            </div>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="price">
                                                <span class="amount">Rp 4.800.000</span></del>
                                               
                                            </span>
                                            <p>Domba ikal</p>
                                            <div class="buttons">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>
                                                <a href="#" class="btn btn-primary btn-sm add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- PRODUCT - END -->
                        
                    </div>
                                        
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        PRODUCTS - END 
    =========================== -->
    
    <!-- ==========================
        SERVICES - START 
    =========================== -->
    <section class="content services services-3x border-top border-bottom">
        <div class="container">
            <div class="row row-no-padding">
            
                <!-- SERVICE - START -->
                <div class="col-xs-12 col-sm-4">
                    <div class="service">
                        <i class="fa fa-star"></i>
                        <h3>GRATIS ONGKOS KIRIM UNTUK PEMBELIAN HEWAN TERNAK</h3>
                        <p>Bagi konsumen yang berada di wilayah Bandung, Cimahi, dan Kabupaten Bandung Barat dapat menikmati fasilitas gratis ongkos kirim untuk pembelian hewan ternak</p>
                    </div>
                </div>
                <!-- SERVICE - END -->
                
                <!-- SERVICE - START -->
                <div class="col-xs-6 col-sm-4">
                    <div class="service">
                        <i class="fa fa-heart"></i>
                        <h3>JAMINAN TIDAK BARANG SAMPAI ATAU UANG KEMBALI 100%</h3>
                        <p>Anda tidak perlu merasa khawatir untuk bertransaki di C-Bodas.com karena kami bertindak sebagai escrow (rekening bersama) sehingga uang yang anda bayarkan tidak langsung diberikan kepada penjual dan uang dapat dengan mudah dikembalikan apabila barang tidak sampai</p>
                    </div>
                </div>
                <!-- SERVICE - END -->
                
                <!-- SERVICE - START -->
                <div class="col-xs-6 col-sm-4">
                    <div class="service">
                        <i class="fa fa-rocket"></i>
                        <h3>TRANSAKSI LEBIH CEPAT DAN GA PAKE RIBET</h3>
                        <p>Dengan menggunakan C-Bodas anda tidak perlu datang ke Desa Cibodas untuk melakukan transaksi dengan penjual. Cukup akses C-Bodas.com dan anda pun dapat menyelesaikan transaksi dalam waktu yang relatif singkat</p>
                    </div>
                </div>
                <!-- SERVICE - END -->
                
            </div>
            
        </div>
    </section>
    <!-- ==========================
        SERVICES - END 
    =========================== -->
    
    
    
    <!-- ==========================
        PRODUCT QUICKVIEW - START
    =========================== -->
    <div class="modal fade modal-quickview" id="product-quickview" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <article class="product-item product-single">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="product-carousel-wrapper hidden">
                                    <div id="product-carousel-modal">
                                        <div class="item"><img src="assets/images/products/product-1.jpg" class="img-responsive" alt=""></div>
                                        <div class="item"><img src="assets/images/products/product-2.jpg" class="img-responsive" alt=""></div>
                                        <div class="item"><img src="assets/images/products/product-3.jpg" class="img-responsive" alt=""></div>
                                        <div class="item"><img src="assets/images/products/product-4.jpg" class="img-responsive" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h3>Fusce Aliquam</h3>
                                <div class="product-labels">
                                    <span class="label label-info">new</span>
                                    <span class="label label-danger">sale</span>
                                </div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <span class="price">
                                    <del><span class="amount">$36.00</span></del>
                                    <ins><span class="amount">$30.00</span></ins>
                                </span>
                                <ul class="list-unstyled product-info">
                                    <li><span>ID</span>U-187423</li>
                                    <li><span>Availability</span>In Stock</li>
                                    <li><span>Brand</span>Esprit</li>
                                    <li><span>Tags</span>Dress, Black, Women</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat mauris eget magna egestas porta. Curabitur sagittis sagittis neque rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare, ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                <div class="product-form clearfix">
                                    <div class="row row-no-padding">
                                        
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="product-quantity clearfix">
                                                <a class="btn btn-default" id="modal-qty-minus">-</a>
                                                <input type="text" class="form-control" id="modal-qty" value="1">
                                                <a class="btn btn-default" id="modal-qty-plus">+</a>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="product-size">
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <label>Size:</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control">
                                                            <option>XS</option>
                                                            <option>S</option>
                                                            <option selected="selected">M</option>
                                                            <option>L</option>
                                                            <option>XL</option>
                                                            <option>XXL</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="product-color">
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <label>Color:</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control">
                                                            <option selected="selected">Black</option>
                                                            <option>White</option>
                                                            <option>Red</option>
                                                            <option>Yellow</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-12 col-sm-6">
                                            <a href="#" class="btn btn-primary add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <ul class="list-inline product-links">
                                    <li><a href="#"><i class="fa fa-heart"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i>Compare</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i>Email to friend</a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================
        PRODUCT QUICKVIEW - END 
    =========================== -->
    


@stop