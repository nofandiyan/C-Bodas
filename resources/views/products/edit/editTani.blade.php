@extends('templates.master')

@section('konten')

@if (!empty(Auth::user()))
    @if(Auth::user()->userAs == 1)
                

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/produkTani/{{$tani->id}}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='idMerchant' value="{{Auth::user()->id}}">

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Judul</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ $tani->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                <textarea class="form-control" name="desc">{{ $tani->desc }}</textarea> 

                                @if ($errors->has('desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- Tani -->
                        <label class="col-md-4 control-label">Foto Produk</label>
                            
                            <div class="form-group{{ $errors->has('fotoTani1') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <img src="{{ url($tani->fotoTani1) }}" class="img-thumbnail" height="300" width="300" >
                                    <br>
                                    Ubah Foto 1
                                    <input type="file" name="fotoTani1" id="fotoTani1" value="{{ $tani->fotoTani1 }}">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTani1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTani1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoTani2') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <img src="{{ url($tani->fotoTani2) }}" class="img-thumbnail" height="300" width="300" >
                                    <br>
                                    Ubah Foto 2
                                    <input type="file" name="fotoTani2" id="fotoTani2" value="{{ $tani->fotoTani2 }}">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTani2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTani2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoTani3') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <img src="{{ url($tani->fotoTani3) }}" class="img-thumbnail" height="300" width="300" >
                                    <br>
                                    Ubah Foto 3
                                    <input type="file" name="fotoTani3" id="fotoTani3" value="{{ $tani->fotoTani3 }}">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTani3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTani3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoTani4') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <img src="{{ url($tani->fotoTani4) }}" class="img-thumbnail" height="300" width="300" >
                                    <br>
                                    Ubah Foto 4
                                    <input type="file" name="fotoTani4" id="fotoTani4" value="{{ $tani->fotoTani4 }}">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTani4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTani4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Stok Tersedia</label>

                                <div class="col-md-4">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="stock" step="1" value="{{ $tani->stock }}">

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="massStock" id="massStock">
                                        <option <?php if($tani->massStock=="Gram") echo 'selected'; ?> value="Gram">Gram</option>
                                        <option <?php if($tani->massStock=="Ons") echo 'selected'; ?> value="Ons">Ons</option>
                                        <option <?php if($tani->massStock=="Kilogram") echo 'selected'; ?> value="Kilogram">Kilogram</option>
                                        <option <?php if($tani->massStock=="Kwintal") echo 'selected'; ?> value="Kwintal">Kwintal</option>
                                        <option <?php if($tani->massStock=="Ton") echo 'selected'; ?> value="Ton">Ton</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-4">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="price" step="50" value="{{ $tani->price }}">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label class="col-md-1 control-label">Per</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="massSell" id="massSell" value="{{ $tani->massSell }}">
                                        <option <?php if($tani->massSell=="Gram") echo 'selected'; ?> value="Gram">Gram</option>
                                        <option <?php if($tani->massSell=="Ons") echo 'selected'; ?> value="Ons">Ons</option>
                                        <option <?php if($tani->massSell=="Kilogram") echo 'selected'; ?> value="Kilogram">Kilogram</option>
                                        <option <?php if($tani->massSell=="Kwintal") echo 'selected'; ?> value="Kwintal">Kwintal</option>
                                        <option <?php if($tani->massSell=="Ton") echo 'selected'; ?> value="Ton">Ton</option>
                                    </select>
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

@else
    return view('/');
@endif
@endif

@stop
