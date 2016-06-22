@extends('templates.master')

@section('konten')
                
    <div class="row">
        <br>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/Product/{{ $product->id }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">

                        @if($product->category_id == 1)
                        <div align="center"><h2><label>Form Update Produk Pertanian <br> <font color="E87169">{{ $product->name }}</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br>
                        @elseif($product->category_id == 2)
                        <div align="center"><h2><label>Form Update Produk Peternakan <br> <font color="E87169">{{ $product->name }}</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br>
                        @elseif($product->category_id == 3)
                        <div align="center"><h2><label>Form Update Produk Pariwisata <br> <font color="E87169">{{ $product->name }}</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br>
                        @endif

                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nama Produk</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" readonly>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Keterangan Produk</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" >{{ $product->description }}</textarea> 

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        @if($product->category_id == 1)
                        <div class="{{ $errors->has('type_product') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Jenis Produk</label>
                            <div class="col-md-3">
                                <select class="form-control" name="type_product" id="type_product" disabled>
                                    <option>--Jenis Produk--</option>
                                    <option value="Sayur Organik" 
                                        <?php $so = "Sayur Organik"; if($product->type_product==$so) echo 'selected'; ?>>Sayur Organik</option>
                                    <option value="Sayur Anorganik" <?php $sa = "Sayur Anorganik"; if($product->type_product==$sa) echo 'selected'; ?>>Sayur Anorganik</option>
                                    <option value="Buah Organik" <?php $bo = "Buah Organik"; if($product->type_product==$bo) echo 'selected'; ?>>Buah Organik</option>
                                    <option value="Buah Anorganik" <?php $ba = "Buah Anorganik"; if($product->type_product==$ba) echo 'selected'; ?>>Buah Anorganik</
                                </select>

                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <label class="col-md-4 control-label">Foto Produk</label>
                            
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="idImage1" id="idImage1" value="{{$images[0]->id}}">
                                    <img src="{{ url($images[0]->link) }}" class="img-thumbnail" height="300" width="300">
                                    <input type="file" name="foto1" id="foto1">
                                    *maksimum 1MB
                                </div>
                                
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="idImage2" id="idImage2" value="{{$images[1]->id}}">
                                    <img src="{{ url($images[1]->link) }}" class="img-thumbnail" height="300" width="300">
                                    <input type="file" name="foto2" id="foto2">
                                    *maksimum 1MB
                                </div>

                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="idImage3" id="idImage3" value="{{$images[2]->id}}">
                                    <img src="{{ url($images[2]->link) }}" class="img-thumbnail" height="300" width="300">
                                    <input type="file" name="foto3" id="foto3">
                                    *maksimum 1MB
                                </div>

                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="idImage4" id="idImage4" value="{{$images[3]->id}}">
                                    <img src="{{ url($images[3]->link) }}" class="img-thumbnail" height="300" width="300">
                                    <input type="file" name="foto4" id="foto4">
                                    *maksimum 1MB
                                </div>
                        
                            <div class="col-md-12 {{ $errors->has('stock') ? ' has-error' : '' }}">

                                @if($product->category_id == 1)
                                    <label class="col-md-4 control-label">Stok Tersedia</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" name="stock" step="1" placeholder="Kilogram" value="{{ $product->stock }}">
                                    </div>
                                    @elseif($product->category_id == 2)
                                    <label class="col-md-4 control-label">Stok Tersedia</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" name="stock" step="1" placeholder="Jumlah Sapi Tersedia" value="{{ $product->stock }}">
                                    </div>
                                    @elseif($product->category_id == 3)
                                    <!-- <label class="col-md-4 control-label">Stok Tersedia</label>
                                    <div class="col-md-3"> -->
                                        <input type="hidden" class="form-control" name="stock" step="1" value="{{ $product->stock }}">
                                    <!-- </div> -->
                                    @endif

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            
                            <div class="col-md-12 {{ $errors->has('price') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-3">
                                    @if($product->category_id == 1)
                                        <input type="number" class="form-control" name="price" step="50" placeholder="Per Kilogram" value="{{ $prices->price}}">
                                    @elseif($product->category_id == 2)
                                        <input type="number" class="form-control" name="price" step="50" placeholder="" value="{{ $prices->price}}">
                                    @elseif($product->category_id == 3)
                                        <input type="number" class="form-control" name="price" step="50" placeholder="" value="{{ $prices->price}}">
                                    @endif

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="{{ $errors->has('myCheck') ? ' has-error' : '' }}">
                                <br>
                                    <div class="col-md-1 col-md-offset-2" align="right">
                                        <input type="checkbox" id="myCheck" name="myCheck" required>
                                    </div>
                                    <div class="col-md-offset-1" align="justify">
                                        Data tersebut saya isi dengan jujur dan apa adanya, apabila terdapat kesalahan pada isi formulir merupakan murni dari kesalahan saya dan pihak C-Bodas tidak ikut menanggung kesalahan yang telah saya perbuat.
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-12" align="center">
                                <br>
                                <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                    <i class="fa fa-btn fa-user"></i>Simpan
                                </button>
                            </div>

                        </div>

                        
                                
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
