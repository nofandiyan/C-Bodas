@extends('templates.master')

@section('konten')
                
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

                <br>
            <div class="panel panel-default">
                @if (Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                @endif

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/Product') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div align="center"><h2><label>Form Pendaftaran <br> <font color="E87169">Produk Pertanian</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br/>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="category_id" value="1">

                        <div class="col-md-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nama Produk</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"  maxlength="50">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Keterangan Produk</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" value="{{ old('description') }}"  maxlength="255"></textarea> 
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 {{ $errors->has('type_product') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Jenis Produk</label>
                            <div class="col-md-3">
                                <select class="form-control" name="type_product" id="type_product">
                                    <option value="Sayur Organik">Sayur Organik</option>
                                    <option value="Sayur Anorganik">Sayur Anorganik</option>
                                    <option value="Buah Organik">Buah Organik</option>
                                    <option value="Buah Anorganik">Buah Anorganik</option>
                                </select>

                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <label class="col-md-4 control-label">Foto Produk</label>
                        <div class="col-md-12 {{ $errors->has('foto1') ? ' has-error' : '' }}">
                             <div class="col-md-6 col-md-offset-4">
                                <input type="file" name="foto1" id="foto1" >
                                *maksimum 1MB
                                @if ($errors->has('foto1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 {{ $errors->has('foto2') ? ' has-error' : '' }}">
                             <div class="col-md-6 col-md-offset-4">
                                <input type="file" name="foto2" id="foto2" >
                                *maksimum 1MB
                                @if ($errors->has('foto2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 {{ $errors->has('foto3') ? ' has-error' : '' }}">
                             <div class="col-md-6 col-md-offset-4">
                                <input type="file" name="foto3" id="foto3" >
                                *maksimum 1MB
                                @if ($errors->has('foto3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 {{ $errors->has('foto4') ? ' has-error' : '' }}">
                             <div class="col-md-6 col-md-offset-4">
                                <input type="file" name="foto4" id="foto4" >
                                *maksimum 1MB
                                @if ($errors->has('foto4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 {{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Stok Tersedia</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="stock" step="1" placeholder="Kilogram" maxlength="10" min="5"> *Stok minimal 5 Kilogram
                                @if ($errors->has('stock'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-12 {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Harga</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="price" step="50" placeholder="Per Kilogram" min="50">
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
                            
                                <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                    <i class="fa fa-btn fa-user"></i>Daftar
                                </button>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@stop
