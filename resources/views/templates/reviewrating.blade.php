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
                         

                              <div class="item"><img style="border:0px; width:300px; height:200px;" src="{{ url($cart->images[0]->link)}}" class="img-thumbnail" height="100" width="100"></div>
                                
                           
                        </div>
                    </div>
                    <!--  -->
                    <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-xs-8">
                        <div class="product-body">
                            
                            <ul class="list-unstyled product-info">
                                <li><span>Nama Produk</span>{{ $cart->name }}</li>
                                <li><span>Harga</span>Rp {{$cart->price}}</li>
                                <div class="product-rating">
                            </ul>
                           
                            
                            <div class="buttons">
                            
                            
                        </div>
                    </div>
                    </form>
                   <!--  -->
                </div>
            </article>
            
            <div class="tabs product-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    
                    <li role="presentation" class="active"><a href="#reviews" role="tab" data-toggle="tab" aria-controls="reviews" aria-expanded="true">Reviews & Rating</a></li>
                    <form action="{{action('ReviewratingController@insertreviewrating')}}" method="post">
                    </ul>
                        <div class="tab-content">
                    
                            <div role="tabpanel" class="tab-pane active in" id="reviews">
                    
                                <div class="comments">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="detail_product_id" value="{{$cart->detailproductid}}"/>
                            
                            <!-- REVIEW - START -->
                        
                                    <div class="media">
                                
                                        <div class="media-body">
                                            <h3 class="media-heading"></h3>
                                        <div class="meta">
                                        <span class="date"></span>
                                        
                                    </div>
                                    <div>
                                        <td>
                                        <textarea class="form-control" id="comment" name="review" required ></textarea>
                                        </td>
                                    </div>
                                    <div>
                                        <td>
                                        <input type="number" min="1" name="rating" required>
                                        </td>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-sm add-to-cart" value="Submit" style="float: left;">
                            </div> 
                        </div>
                            <!-- REVIEW - END -->
                        </form>
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
