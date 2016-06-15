@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/Product/{{$product->id}}">
                        {!! csrf_field() !!}
                        
                        @if($product->category_id == 1)
                            <div align="center"><h2><label>Produk Pertanian <br> <font color="E87169">{{ $product->name }}</font></label></h2></div>
                        @elseif($product->category_id == 2)
                            <div align="center"><h2><label>Produk Peternakan <br> <font color="E87169">{{ $product->name }}</font></label></h2></div>
                        @elseif($product->category_id == 3)
                            <div align="center"><h2><label>Produk Pariwisata<br> <font color="E87169">{{ $product->name }}</font></label></h2></div>
                        @endif
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">

                        <div class="col-md-5">
							<div class="wrapper">
                                <div class="full-image"></div>
                                <div class="thumbnails">
                                	@foreach($images as $image)
	                                    <label>
	                                        <input type="radio" name="full-image" checked>
	                                        <div class="full-image">
	                                            <img src="{{ url($image->link) }}" class="img-thumbnail" height="300" width="300">
	                                        </div>
	                                        <img src="{{ url($image->link) }}" class="img-thumbnail" height="100" width="100">
	                                    </label>

	                                @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
	                        <div class="row">
                                @if(Auth::user()->role=='admin')
                                    <div class="col-md-12">
                                        <label class="col-md-3" align="right">ID Seller</label>
                                        <div class="col-md-9">
                                            {{ $product->seller_id }}
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-3" align="right">Dibuat Tanggal</label>
                                        <div class="col-md-9">
                                            {{ $product->created_at }}
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-3" align="right">Terakhir update</label>
                                        <div class="col-md-9">
                                            {{ $product->updated_at }}
                                        </div>
                                        <br>
                                    </div>
                                @endif
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Nama Produk</label>
		                            <div class="col-md-9">
		                                {{ $product->name }}
		                            </div>
		                            <br>
		                        </div>
		                        @if($product->category_id == 1)
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Jenis Produk</label>
                                    <div class="col-md-9">
                                        {{$product->type_product}}
                                    </div>
                                </div>
                                @endif

		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Keterangan Produk</label>
		                            <div class="col-md-9">
		                                {{ $product->description }}
		                            </div>
		                        </div>

                                @if($product->category_id == 1)
                                    <div class="col-md-12">
                                        <label class="col-md-3" align="right">Stok</label>
                                        <div class="col-md-9">
                                            {{$product->stock}} Kilogram
                                        </div>
                                    </div>
                                    @elseif($product->category_id == 2)
                                    <div class="col-md-12">
                                        <label class="col-md-3" align="right">Stok</label>
                                        <div class="col-md-9">
                                            {{$product->stock}} Ekor
                                        </div>
                                    </div>
                                

                                @endif

		                        <div class="col-md-12">
                                    @if($product->category_id == 1)
		                            <label class="col-md-3" align="right">Harga</label>
		                            <div class="col-md-9">
		                              	{{$price->price}} Per Kilogram
		                            </div>
                                    @elseif($product->category_id == 2)
                                    <label class="col-md-3" align="right">Harga</label>
                                    <div class="col-md-9">
                                        {{$price->price}}
                                    </div>
                                    @elseif($product->category_id == 3)
                                    <label class="col-md-3" align="right">Harga Tiket</label>
                                    <div class="col-md-9">
                                        {{$price->price}}
                                    </div>
                                    @endif
		                        </div>

                                <div class="col-md-12">
                                    <div class="col-md-3" align="right"><label>Reputasi</label></div>
                                    <div class="col-md-9">
                                    <input id="rating" name="input-name" type="number" class="rating" min=0 max=5 step=0.01 data-rtl="false" value="{{$avgRat}}" data-size="xs">
                                    </div>
                                </div>

                        		@if(Auth::user()->role == 'seller')
                                <div class="col-md-12">
                                	<div class="col-md-3" align="right">
                                        <br>
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    
                                    <div class="col-md-9">
                                        <br>
                                        <a href="/Product/{{$product->id}}/edit" class="btn btn-primary" role="button">Edit Produk</a>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="" onclick="goBack()" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                </div>
                                @endif
                        	</div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div align="center">
                    <h3><label>Rating dan Review</label></h3>
                    <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                </div>
                @foreach($reviews as $rev)
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <input id="rating" name="input-name" type="number" class="rating" min=0 max=5 step=0.01 data-rtl="false" value="{{$rev->rating}}" data-size="xs" disabled>
                            </div>
                            <div class="col-md-5" align="right">
                                {{$rev->created_at}}
                            </div>
                        </div>
                        <div class="col-md-12">{{$rev->review}}</div>
                        <div class="col-md-12"><h6>Oleh <label>{{$rev->custName}}</label></h6></div>
                    </div>
                    <hr style="height:1px;color:#777777;background-color:#777777;" />
                @endforeach
            </div>
        </div>
    </div>
</div>

@stop
