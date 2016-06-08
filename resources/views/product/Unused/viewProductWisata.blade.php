@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Produk Edukasi</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/Product/{{$product->id}}">
                        {!! csrf_field() !!}

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
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Nama Produk</label>
		                            <div class="col-md-9">
		                                {{ $product->name }}
		                            </div>
		                            <br>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Keterangan Produk</label>
		                            <div class="col-md-9">
		                                {{ $product->description }}
		                            </div>
		                        </div>
		                       
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Tiket Tersedia</label>
		                            <div class="col-md-9">
		                                {{$product->stock}}
		                            </div>
		                        </div>
		                        
		                        <div class="col-md-12">
		                            <label class="col-md-3" align="right">Harga Tiket</label>
		                            <div class="col-md-9">
		                              	{{$price->price}}
		                            </div>
		                            
		                        </div>

                        		@if(Auth::user()->role == 'seller')
                                <div class="col-md-7">
                                	<div class="col-md-3">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <a href="/Product/{{$product->id}}/edit" class="btn btn-primary" role="button">Edit Product</a>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                </div>
                                @endif
                        	</div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
