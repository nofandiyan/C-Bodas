@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Profil {{$profile->name}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='idMerchant' value="{{$profile->id}}">

                        <div class="col-md-5" align="center">
                            <!-- <div class="wrapper"> -->
                                <div class="full-image"></div>
                                <div class="thumbnails">
                                    <label>
                                        <!-- <input type="radio" name="full-image" checked> -->
                                        <div class="full-image">
                                            <img src="{{ url($profile->profPict) }}" class="img-thumbnail" height="300" width="300">
                                        </div>
                                    </label>
                                </div>
                            <!-- </div> -->
                        </div>

                        <div class="col-md-7">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nama</label>
                                    <div class="col-md-9">
                                        {{$profile->name}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nomor Telepon</label>
                                    <div class="col-md-9">
                                        {{$profile->telp}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Email</label>
                                    <div class="col-md-9">
                                        {{$profile->email}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Jenis Identitas</label>
                                    <div class="col-md-9">
                                        {{$profile->typeId}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nomor Identitas</label>
                                    <div class="col-md-9">
                                        {{$profile->noId}}
                                    </div>
                                    <br>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Alamat</label>
                                    <div class="col-md-9">
                                        {{$profile->street}}    <br>
                                        {{Auth::user()->village}}  <br>
                                        {{$profile->city}}      <br>
                                        {{$profile->prov}}      <br>
                                        {{$profile->zipCode}}   
                                    </div>
                                </div>

                                <label class="col-md-3" align="right">Informasi Rekening</label>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nama Bank</label>
                                    <div class="col-md-9">
                                        {{$profile->bankName}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nomor Rekening</label>
                                    <div class="col-md-9">
                                        {{$profile->rekId}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nama Buku Rekening</label>
                                    <div class="col-md-9">
                                        {{$profile->rekName}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
