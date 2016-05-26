@extends('templates.master')

@section('konten')
                
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/Lapak/{{ $lapak->id }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Judul</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $lapak->name }}" readonly>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" >{{ $lapak->description }}</textarea> 

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- Tani -->           
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
                            
                           

                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Stok Tersedia</label>

                                <div class="col-md-4">
                                    @if($lapak->category_id == 1)
                                        <input type="number" class="form-control" name="stock" step="1" placeholder="Kilogram" value="{{ $lapak->stock }}">
                                    @elseif($lapak->category_id == 2)
                                        <input type="number" class="form-control" name="stock" step="1" value="{{ $lapak->stock }}" readonly>
                                    @elseif($lapak->category_id == 3)
                                        <input type="number" class="form-control" name="stock" step="1" value="{{ $lapak->stock }}">
                                    @endif

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="price" step="50" placeholder="Per Kilogram" value="{{ $prices->price}}">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
