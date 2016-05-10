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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/produkVilla') }}  " enctype="multipart/form-data">
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

                        <label class="col-md-4 control-label">Foto Edukasi</label>
                            
                        <!-- <div> -->
                            <div class="form-group{{ $errors->has('fotoVilla1') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoVilla1" id="fotoVilla1">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoVilla1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoVilla1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoVilla2') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoVilla2" id="fotoVilla2">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoVilla2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoVilla2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoVilla3') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoVilla3" id="fotoVilla3">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoVilla3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoVilla3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoVilla4') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoVilla4" id="fotoVilla4">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoVilla4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoVilla4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
<!-- Villa -->
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

                            <div class="form-group{{ $errors->has('dateOrdered') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Tanggal Sudah Terpesan</label>
                                
                                <div class="col-md-6">
                                    <input class="date form-control" type="text" name="dateOrdered">
                                    <script type="text/javascript">  
                                        $('.date').datepicker({
                                            startDate: "today",
                                            format: "dd/mm/yyyy",
                                            clearBtn: true,
                                            language: "id",
                                            multidate: true,
                                            forceParse: false,
                                            todayHighlight: true,
                                            datesDisabled: ['04/06/2016', '04/21/2016']  
                                         });  
                                    </script>  

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('quota') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Kapasitas</label>

                                <div class="col-md-6">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="quota" step="5" min="0">

                                    @if ($errors->has('quota'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quota') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="control-label">Orang</label>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-6">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="price" step="50" min="0">

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <label class="control-label">Per Malam</label>
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
