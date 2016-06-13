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
                                       <li class="panel"><a role="button" data-toggle="collapse" data-parent="#categories" href="#parent-1" aria-expanded="true" aria-controls="parent-1">Pertanian<span>[4]</span></a>
                                            <ul id="parent-1" class="list-unstyled panel-collapse collapse in" role="menu">
                                                <li><a href="katalogsayurorganik">Sayur Organik</a></li>
                                                <li><a href="katalogsayuranorganik">Sayur Anorganik</a></li>
                                                <li><a href="katalogbuahorganik">Buah Organik</a></li>
                                                <li class="active"><a href="katalogbuahanorganik">Buah Anorganik</a></li>
                                               
                                            </ul>
                                        </li>

                                        <li class="panel"><a class="collapsed" role="button" data-parent="#categories" href="katalogpeternakan">Peternakan<span></span></a>
                                           
                                        </li>

                                        
                                        <li class="panel"><a class="collapsed" role="button" data-parent="#categories" href="katalogpariwisata">Pariwisata</a>
                               
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
                        

                        <!-- PRODUCT KATALOG -->
                        @foreach ($barang as $bar)
                        <div class="col-sm-4 col-xs-6">
                            <article class="product-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-overlay">
                                            <div class="product-mask"></div>
                                            <a href="single-product.html" class="product-permalink"></a>
                                            <img style="border:0px; width:300px; height:200px;" src="{{ url($bar->image[0]->link) }}" class="img-responsive" alt="">

                                            <div class="product-quickview">
                                                <a class="btn btn-quickview" data-toggle="modal" data-target="#product-quickview">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-body">
                                            <h3>{{$bar->name}}</h3>
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
                                              
                                                <span class="amount">{{$bar->price}}</span>
                                            </span>
                                            <p>{{$bar->description}}</p>
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
                   
             

                        @endforeach
                        
                         
    <!-- PRODUCT - END -->
                    </div>  
                    <center>{!! $barang->links() !!}</center>                         
                </div>
            </div>
        </div>
    </section>
    
    
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
                                    @foreach($barang as $bara)
                                        
                                            <?php $count = 4; ?>
                                            <?php $counts = count($barang); ?>
                                        
                                            @for($i=0; $i<$counts; $i++)
                                                    @if($bara->image[$i]->idDetProdIm == $bara->id)
                                                    <div class="item"><img src="{{url($bara->image[$i]->link)}}" class="img-responsive" alt=""></div>
                                                    @endif
                                            @endfor

                                        
                                    @endforeach
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