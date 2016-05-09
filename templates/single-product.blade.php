@extends('templates\master')

@section('konten')
    
    <!-- ==========================
    	BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h2>Sapi</h2>
                    <p>Sapi Limosin Silang Simmental</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Peternakan</a></li>
                        <li><a href="products.html">Sapi</a></li>
                        <li class="active">Sapi Limosin Silang Simmental</li>
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
        	<article class="product-item product-single">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="product-carousel-wrapper">
                            <div id="product-carousel">
                                <div class="item"><img style="border:0px; width:400px; height:300px;" src="assets/images/products/Peternakan/sapi_1.jpg" class="img-responsive" alt=""></div>
                                <div class="item"><img style="border:0px; width:400px; height:300px;" src="assets/images/products/Peternakan/sapi_2.jpg" class="img-responsive" alt=""></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8">
                    	<div class="product-body">
                            <h3>Sapi Limosin Silang Simmental</h3>
                            <div class="product-labels">
                                
                                <span class="label label-danger">sale</span>
                            </div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <span class="price">
                                <del><span class="amount">Rp 18.000.000</span></del>
                                <ins><span class="amount">Rp 17.200.000</span></ins>
                            </span>
                            <ul class="list-unstyled product-info">
                                <li><span>ID</span>SP-1</li>
                                <li><span>Ketersediaan</span>Tersedia</li>
                                <li><span>Tags</span>Sapi, Limosin, Simmental</li>
                            </ul>
                            <p>Sapi Potong Unggulan</p>
                            <div class="product-form clearfix">
                                <div class="row row-no-padding">
                                    
                                    <div class="col-md-3 col-sm-4">
                                        <div class="product-quantity clearfix">
                                            <a class="btn btn-default" id="qty-minus">-</a>
                                            <input type="text" class="form-control" id="qty" value="1">
                                            <a class="btn btn-default" id="qty-plus">+</a>
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-md-3 col-sm-12">
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
                </div>
            </article>
            
            <div class="tabs product-tabs">
                <ul class="nav nav-tabs" role="tablist">
                	<li role="presentation" class=""><a href="#description" role="tab" data-toggle="tab" aria-controls="description" aria-expanded="false">Description</a></li>
                	<li role="presentation" class="active"><a href="#reviews" role="tab" data-toggle="tab" aria-controls="reviews" aria-expanded="true">Reviews (3)</a></li>
                    <li role="presentation" class=""><a href="#video" role="tab" data-toggle="tab" aria-controls="video" aria-expanded="false">Responsive Video</a></li>
                </ul>
                <div class="tab-content">
                	<div role="tabpanel" class="tab-pane" id="description">
                    	<h4>Fisik</h4>
                        <p>Sapi normal tidak ada cacat maupun luka atau bekas luka</p>
						<ul>
                        	<li>Bobot 400 Kg</li>
                            <li>Usia 1,3 Tahun</li>
                            
                        </ul>
                        <h5>Kesehatan</h5>
                        <p>Sapi sehat dengan perawatan terbaik dan pemberian vaksin rutin.</p>
						
                  	</div>
                  	<div role="tabpanel" class="tab-pane active in" id="reviews">
                    
                        <div class="comments">
                            
                            <!-- REVIEW - START -->
                        	<div class="media">
                            	<div class="media-left">
                                	<img class="media-object" alt="" src="assets/images/default-avatar.png">
                              	</div>
                              	<div class="media-body">
                                	<h3 class="media-heading">Handoko</h3>
                                    <div class="meta">
                                    	<span class="date">20 Mei 2016</span>
                                        <a data-toggle="modal" data-target="#add-review">Reply</a>
                                    </div>
                                	<p>Sapi simmental yang dibeli dari Seller A ini bagus banget. Saya beli 1 ekor untuk percobaan, setelah sekarang mau 1 bulan tidak ada kendala apapun pada sapi. Sapi sehat, nafsu makan bagus, pertumbuhan berat badan sekitar 800 gram per hari. Sukses terus Seller A!</p>
                              	</div>
                            </div>
                            <!-- REVIEW - END -->
                            
                            <!-- REVIEW - START -->
                        	<div class="media">
                            	<div class="media-left">
                                	<img class="media-object" alt="" src="assets/images/default-avatar.png">
                              	</div>
                              	<div class="media-body">
                                	<h3 class="media-heading">Adelelaideleidelia</h3>
                                    <div class="meta">
                                    	<span class="date">8 Februari 2016</span>
                                        <a data-toggle="modal" data-target="#add-review">Reply</a>
                                    </div>
                                	<p>Beli tanggal 6, hari itu juga dikirim. Sapi sampai dengan selamat dan sehat. Bravo!</p>
                                
                                    <!-- REVIEW - START -->
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object" alt="" src="assets/images/default-avatar.png">
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Seller A</h3>
                                            <div class="meta">
                                                <span class="date">8 Februari 2016</span>
                                            </div>
                                            <p>Terimakasih telah berbelanja di toko kami. Semoga puas dengan pelayanan kami. Besar harapan kami untuk menjadi pelanggan setia kami.</p>
                                        </div>
                                    </div>
                                    <!-- REVIEW - END -->
                                    
                                    <!-- REVIEW - START -->
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object" alt="" src="assets/images/default-avatar.png">
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Adelelaideleidelia</h3>
                                            <div class="meta">
                                                <span class="date">9 Februari 2016</span>
                                            </div>
                                            <p>Siap..</p>
                                        </div>
                                    </div>
                                    <!-- REVIEW - END -->
                                
                                </div>
                            </div>
                            <!-- REVIEW - END -->
                            
                           
                            
                        </div>
                        
                        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-review">Add Review</a>

                  	</div>
                    <div role="tabpanel" class="tab-pane" id="video">
                    	<div class="embed-responsive embed-responsive-16by9">
            				<iframe allowfullscreen="" src="http://www.youtube.com/embed/M4z90wlwYs8?feature=player_detailpage"></iframe>
                        </div>
                  	</div>
                </div>
          	</div>
            
            <div class="releated-products">
            	<h2>Related Products</h2>
            	<div class="row grid" id="products">
                        
                    <!-- PRODUCT - START -->
                    <div class="col-sm-3 col-xs-6">
                        <article class="product-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="product-overlay">
                                        <div class="product-mask"></div>
                                        <a href="single-product.html" class="product-permalink"></a>
                                        <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                        <div class="product-quickview">
                                            <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="product-body">
                                        <h3>Lorem ipsum dolor sit amet consectetur</h3>
                                        <span class="price">
                                            <del><span class="amount">$36.00</span></del>
                                            <ins><span class="amount">$30.00</span></ins>
                                        </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat mauris eget magna egestas porta. Curabitur sagittis sagittis neque rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare, ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                        <div class="buttons buttons-simple">
                                            <a href="#"><i class="fa fa-exchange"></i></a>
                                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- PRODUCT - END -->
                    
                    <!-- PRODUCT - START -->
                    <div class="col-sm-3 col-xs-6">
                        <article class="product-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="product-overlay">
                                        <div class="product-mask"></div>
                                        <a href="single-product.html" class="product-permalink"></a>
                                        <img src="assets/images/products/product-2.jpg" class="img-responsive" alt="">
                                        <div class="product-quickview">
                                            <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="product-body">
                                        <h3>Lorem ipsum dolor sit amet consectetur</h3>
                                        <span class="price">
                                            <del><span class="amount">$36.00</span></del>
                                            <ins><span class="amount">$30.00</span></ins>
                                        </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat mauris eget magna egestas porta. Curabitur sagittis sagittis neque rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare, ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                        <div class="buttons buttons-simple">
                                            <a href="#"><i class="fa fa-exchange"></i></a>
                                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- PRODUCT - END -->
                    
                    <!-- PRODUCT - START -->
                    <div class="col-sm-3 col-xs-6">
                        <article class="product-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="product-overlay">
                                        <div class="product-mask"></div>
                                        <a href="single-product.html" class="product-permalink"></a>
                                        <img src="assets/images/products/product-3.jpg" class="img-responsive" alt="">
                                        <div class="product-quickview">
                                            <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="product-body">
                                        <h3>Lorem ipsum dolor sit amet consectetur</h3>
                                        <span class="price">
                                            <del><span class="amount">$36.00</span></del>
                                            <ins><span class="amount">$30.00</span></ins>
                                        </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat mauris eget magna egestas porta. Curabitur sagittis sagittis neque rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare, ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                        <div class="buttons buttons-simple">
                                            <a href="#"><i class="fa fa-exchange"></i></a>
                                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- PRODUCT - END -->
                    
                    <!-- PRODUCT - START -->
                    <div class="col-sm-3 col-xs-6">
                        <article class="product-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="product-overlay">
                                        <div class="product-mask"></div>
                                        <a href="single-product.html" class="product-permalink"></a>
                                        <img src="assets/images/products/product-4.jpg" class="img-responsive" alt="">
                                        <div class="product-quickview">
                                            <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="product-body">
                                        <h3>Lorem ipsum dolor sit amet consectetur</h3>
                                        <span class="price">
                                            <del><span class="amount">$36.00</span></del>
                                            <ins><span class="amount">$30.00</span></ins>
                                        </span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat mauris eget magna egestas porta. Curabitur sagittis sagittis neque rutrum congue. Donec lobortis dui sagittis, ultrices nunc ornare, ultricies elit. Curabitur tristique felis pulvinar nibh porta. </p>
                                        <div class="buttons buttons-simple">
                                            <a href="#"><i class="fa fa-exchange"></i></a>
                                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
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
    </section>
    <!-- ==========================
    	PRODUCTS - END 
    =========================== -->
    
    <!-- ==========================
    	ADD REVIEW - START
    =========================== -->
    <div class="modal fade modal-add-review" id="add-review" tabindex="-1" role="dialog">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
          		<div class="modal-header">
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title">Add a review</h4>
          		</div>
                <div class="modal-body">
                    <form class="comment-form">
                        <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked<span class="required">*</span></p>
                        <div class="row">
                            <div class="form-group comment-form-author col-sm-6">
                                <label for="author">Name<span class="required">*</span></label> 
                                <input class="form-control" id="author" name="author" type="text" required value="" placeholder="Enter your name">
                            </div>
                            <div class="form-group comment-form-email col-sm-6">
                                <label for="email">Email<span class="required">*</span></label> 
                                <input class="form-control" id="email" name="email" type="email" required value="" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="form-group comment-form-comment">
                            <label for="comment">Comment<span class="required">*</span></label>
                            <textarea class="form-control" id="comment" name="comment" required placeholder="Enter your message"></textarea>
                        </div>						
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>Submit</button>
                    </form>
                </div>
    		</div>
    	</div>
    </div>
    <!-- ==========================
    	ADD REVIEW - END 
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