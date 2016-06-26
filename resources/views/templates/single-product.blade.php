@extends('templates.master')

@section('konten')

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
                                @foreach($images as $image)
                                <div class="item"><img style="border:0px; width:400px; height:300px;" src="{{ url($image->link) }}" class="img-thumbnail" height="100" width="100"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <form action="{{action('CartController@additemsingleproduct')}}" method="post">

              
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="detailproductid" value="{{ $product->detailproductid }}"> 
                        <input type="hidden" name="pricesproductid"   value="{{$product->price}}">
                        <input type="hidden" name="category_id" value="{{$product->category_id}}">
                        <input type="hidden" name="seller_id"  value="{{$product->seller_id}}">
                        <input type="hidden" name="jumlah" value="1">
                        <input type="hidden" name="name" value="{{$product->name}}"/>
                        <input type="hidden" name="price" value="{{$product->price}}"/>

                        <div class="col-xs-8">
                        <div class="product-body">
                            
                            <ul class="list-unstyled product-info">

                                <li><span>Nama Produk</span>{{ $product->name }}</li>
                                  
                           
                               
                                @if($product->category_id == 1)
                                <li><span>Harga</span>Rp {{$price->price}}</li>>
                                @elseif($product->category_id == 2)
                                <li><span>Harga</span>Rp {{$price->price}}</li>
                                @elseif($product->category_id == 3)
                                <li><span>Harga</span>Rp {{$price->price}}</li>
                                @endif

                                @if($product->category_id == 1)
                                <li><span>Stok</span>{{$product->stock}} Kilogram</li>
                                @elseif($product->category_id == 2)
                                <li><span>Stok</span>{{$product->stock}} Ekor</li>
                                @endif

                                <div class="product-rating">
                                <input id="rating" name="input-name" type="number" class="rating" min=0 max=5 step=0.01 data-rtl="false" value="{{$avgRat}}" data-size="xs">    
                                </div>
                            
                            </ul>
                            <p>{{ $product->description }}</p>
                       
                                    @if($product->type_product == 'Sayur Anorganik')
                                    
                                    <div align="left">
                                        <a href="{{ url('katalogsayuranorganik') }}" class="btn btn-inverse">Continue Shopping</a>
                                    </div>
                                   

                                    @elseif($product->type_product == 'Sayur Organik')

                                    <div align="left">
                                        <a href="{{ url('katalogsayuranorganik') }}" class="btn btn-inverse">Continue Shopping</a>
                                    </div>
                                    @elseif($product->type_product == 'Buah Anorganik')

                                    <div align="left">
                                        <a href="{{ url('katalogbuahanorganik') }}" class="btn btn-inverse">Continue Shopping</a>
                                    </div>

                                    @elseif($product->type_product == 'Buah Organik')

                                    <div align="left">
                                        <a href="{{ url('katalogbuahorganik') }}" class="btn btn-inverse">Continue Shopping</a>
                                    </div>

                                    @elseif($product->category_id == 2)

                                    <div align="left">
                                        <a href="{{ url('katalogpeternakan') }}" class="btn btn-inverse">Continue Shopping</a>
                                    </div>

                                    @elseif($product->category_id == 3)

                                    <div align="left">
                                        <a href="{{ url('katalogpariwisata') }}" class="btn btn-inverse">Continue Shopping</a>
                                    </div>
                                    @endif
                                    
                            
                            <div class="buttons">
                            <input type="submit" class="btn btn-primary btn-sm add-to-cart" value="Tambahkan ke Keranjang" style="float: left;">
                            </div> 
                            
                        </div>
                    </div>
                    </form>
                   <!--  -->
                </div>
            </article>
            
            <div class="tabs product-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    
                    <li role="presentation" class="active"><a href="#reviews" role="tab" data-toggle="tab" aria-controls="reviews" aria-expanded="true">Reviews</a></li>
                    
                </ul>
                <div class="tab-content">
                    
                    <div role="tabpanel" class="tab-pane active in" id="reviews">
                    
                        <div class="comments">
                
                            
                            <!-- REVIEW - START -->
                            @foreach($reviews as $rev)
                            <div class="media">
                                
                                <div class="media-body">
                                    <h3 class="media-heading">{{$rev->custName}}</h3>
                                    <div class="meta">
                                        <span class="date">{{$rev->created_at}}</span>
                                        
                                    </div>
                                    <p>{{$rev->review}}.</p>
                                </div>
                            </div>
                            <!-- REVIEW - END -->
                            @endforeach
                        </div>
                        
                       

                    </div>
                    
                </div>
            </div>
            
            
            
        </div>
    </section>
    <!-- ==========================
        PRODUCTS - END 
    =========================== -->











<div class="container">
    <div class="row">
        <br>
        
        
    </div>
</div>

@stop
