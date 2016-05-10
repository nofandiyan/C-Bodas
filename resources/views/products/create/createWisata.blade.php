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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/produkWisata') }}"enctype="multipart/form-data">
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
                        <!-- </div> -->
                        <label class="col-md-4 control-label">Foto Edukasi</label>
                            
                        <!-- <div> -->
                            <div class="form-group{{ $errors->has('fotoWisata1') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoWisata1" id="fotoWisata1">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoWisata1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoWisata1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoWisata2') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoWisata2" id="fotoWisata2">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoWisata2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoWisata2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoWisata3') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoWisata3" id="fotoWisata3">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoWisata3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoWisata3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoWisata4') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoWisata4" id="fotoWisata4">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoWisata4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoWisata4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
<!-- Wisata -->
                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Alamat</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="street" placeholder="Jalan + Nomor" value="{{ old('street') }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('village') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="village" value="Desa Cibodas" readonly="Desa Cibodas">
                                    @if ($errors->has('village'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('village') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="city" value="Kab. Bandung" readonly="Kab. Bandung">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prov') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="prov" value="Jawa Barat" readonly="Jawa Barat">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="text" class="form-control" name="zipCode" maxlength="5" value="40391" readonly="40391">
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('ticketStock') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Jumlah Tiket</label>

                                <div class="col-md-4">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="ticketStock" step="1">

                                    @if ($errors->has('ticketStock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ticketStock') }}</strong>
                                        </span>
                                    @endif
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
