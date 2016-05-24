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
                                <input type="text" class="form-control" name="name" value="{{ $lapak->name }}">

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
                            <?php $i=1 ?>
                            @foreach($gambars as $gambar)
                            <div class="form-group{{ $errors->has('foto.$i') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <img src="{{ url($gambar->link) }}" class="img-thumbnail" height="300" width="300">
                                    <input type="file" name="foto{{$i}}" id="foto">

                                    *maksimum 1MB

                                    @if ($errors->has('foto.$i'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('foto.$i') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <? php $i++ ?>
                            @endforeach
                           

                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Stok Tersedia</label>

                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="stock" step="1" placeholder="Kilogram" value="{{ $lapak->stock }}">

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
                                    <input type="number" class="form-control" name="price" step="50" placeholder="Per Kilogram" value="{{ $lapak->price}}">

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
                                    <i class="fa fa-btn fa-user"></i>Buat Lapak
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
