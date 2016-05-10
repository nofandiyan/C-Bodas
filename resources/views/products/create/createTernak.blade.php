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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/produkTernak') }}" enctype="multipart/form-data">
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

                        <label class="col-md-4 control-label">Foto Ternak</label>
                            
                        <!-- <div> -->
                            <div class="form-group{{ $errors->has('fotoTernak1') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoTernak1" id="fotoTernak1">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTernak1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTernak1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoTernak2') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoTernak2" id="fotoTernak2">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTernak2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTernak2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoTernak3') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoTernak3" id="fotoTernak3">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTernak3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTernak3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fotoTernak4') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fotoTernak4" id="fotoTernak4">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('fotoTernak4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fotoTernak4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

<!-- Ternak -->
                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Usia</label>

                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="year" step="1" placeholder="Tahun" min="0">

                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="month" step="1" placeholder="Bulan" min="0">

                                    @if ($errors->has('month'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('month') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="day" step="1" placeholder="Hari" min="0">

                                    @if ($errors->has('day'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('day') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <!-- <select class="form-control" name="userAs" id="userAs" onchange="changeFunc();"> -->
                                    <select class="form-control gender" name="gender" id="gender">
                                    <!-- <select class="form-control" name="userAs" id="userAs"> -->

                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Berat</label>

                                <div class="col-md-4">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="weight" step="1" min="0">

                                    @if ($errors->has('weight'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                
                                <label class="control-label">Kilogram</label>
                                

                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-8">
                                    <!-- <textarea class="form-control" name="desc" value="{{ old('desc') }}"> -->
                                    <input type="number" class="form-control" name="price" step="50" min="0">

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
