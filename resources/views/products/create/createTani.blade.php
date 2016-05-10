@extends('templates.master')

@section('konten')

<script type="text/javascript">

</script> 
@if (!empty(Auth::user()))
    @if(Auth::user()->userAs == 1)
                
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/produkTani') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name='idMerchant' value="{{Auth::user()->id}}">

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Judul</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

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
                                <textarea class="form-control" name="desc" value="{{ old('desc') }}"></textarea> 

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
                                    <input type="file" name="fotoTani1" id="fotoTani1">
                                    
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
                                    <input type="file" name="fotoTani2" id="fotoTani2">
                                    
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
                                    <input type="file" name="fotoTani3" id="fotoTani3">
                                    
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
                                    <input type="file" name="fotoTani4" id="fotoTani4">
                                    
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
                                    <input type="number" class="form-control" name="stock" step="1">

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="massStock" id="massStock">
                                        <option value="Gram">Gram</option>
                                        <option value="Ons">Ons</option>
                                        <option value="Kilogram">Kilogram</option>
                                        <option value="Kwintal">Kwintal</option>
                                        <option value="Ton">Ton</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-4">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="price" step="50">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label class="col-md-1 control-label">Per</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="massSell" id="massSell">
                                        <<option value="Gram">Gram</option>
                                        <option value="Ons">Ons</option>
                                        <option value="Kilogram">Kilogram</option>
                                        <option value="Kwintal">Kwintal</option>
                                        <option value="Ton">Ton</option>
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
