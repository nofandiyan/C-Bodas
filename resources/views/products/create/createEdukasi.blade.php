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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/produkEdukasi') }}" enctype="multipart/form-data">
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
                            <div class="form-group{{ $errors->has('fotoEdukasi1') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoEdukasi1" id="fotoEdukasi1">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoEdukasi1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoEdukasi1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoEdukasi2') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoEdukasi2" id="fotoEdukasi2">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoEdukasi2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoEdukasi2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoEdukasi3') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoEdukasi3" id="fotoEdukasi3">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoEdukasi3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoEdukasi3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoEdukasi4') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoEdukasi4" id="fotoEdukasi4">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoEdukasi4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoEdukasi4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
<!-- Edukasi -->
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
                                
                                <div class="col-md-4">
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
                                            datesDisabled: ['04/06/2016', '04/21/2016'],  
                                            
                                         });  
                                    </script>  

                                    @if ($errors->has('dateOrdered'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dateOrdered') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('quota') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Kuota</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="quota" value="{{ old('quota') }}" min="0">

                                    @if ($errors->has('quota'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quota') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-4">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="price" step="50" min="0">

                                    @if ($errors->has('stock'))
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
