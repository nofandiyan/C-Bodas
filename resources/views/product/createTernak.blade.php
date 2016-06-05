@extends('templates.master')

@section('konten')

<script type="text/javascript">

</script> 
                
    <div class="row">
    <br>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/Product') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div align="center"><h2><label>Form Pendaftaran <br> <font color="E87169">Produk Peternakan</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <br/>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="category_id" value="2">
                        <input type="hidden" name="type_product" value="Null">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Judul</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Keterangan Produk</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" value="{{ old('description') }}"></textarea> 

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!-- Tani -->           
                        <label class="col-md-4 control-label">Foto Hewan Ternak</label>
                            
                            <div class="form-group{{ $errors->has('foto1') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="foto1" id="foto1">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('foto1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('foto1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('foto2') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="foto2" id="foto2">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('foto2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('foto2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('foto3') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="foto3" id="foto3">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('foto3'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('foto3') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('foto4') ? ' has-error' : '' }}">
                                 <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="foto4" id="foto4">
                                    
                                    *maksimum 1MB

                                    @if ($errors->has('foto4'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('foto4') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                  
                            <input type="hidden" class="form-control" name="stock" step="1" value="1">

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Harga</label>

                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="price" step="50">

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

                        
                            
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
