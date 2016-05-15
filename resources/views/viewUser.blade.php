@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Merchant</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                    
                        {!! csrf_field() !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="form-group">
                            
                            <a href="/sellerProfile/{{Auth::user()->id}}/edit" class="btn btn-info" role="button">Edit</a>

                            <label class="col-md-10 col-md-offset-2">Informasi Akun</label>
                                <div class="col-md-10" align="center">
                                    <img src="{{ url(Auth::user()->profPict) }}" class="img-thumbnail" height="304" width="236">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Alamat Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->email}}
                                    </div>
                                </div>
                            <hr>
                            <label class="col-md-10 col-md-offset-2">Informasi Data Diri</label>
                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Tipe Identitas</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->typeId}}
                                    </div>
                                </div>

                               <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Nomor Identitas</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->noId}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->name}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Alamat Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->telp}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Jalan</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->street}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Kota</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->city}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Provinsi</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->prov}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Kode Pos</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->zipCode}}
                                    </div>
                                </div>

                            <hr>
                            <label class="col-md-10 col-md-offset-2">Informasi Rekening</label>
                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Nama Bank</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->bankName}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Nama Rekening</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->rekName}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4" align="right">
                                        <label>Nomor Rekening</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{Auth::user()->rekId}}
                                    </div>
                                </div>                       

                        </div>

                        

                        <div align="center">

                            <!-- <a href="/sellerProfile/{{Auth::user()->id}}/edit" class="btn btn-info" role="button">Ubah Profile</a> -->
                            <!-- <button type="submit" class="btn btn-primary" name="submit" value="">
                                <i class="fa fa-btn fa-user"></i>Ubah Profil
                            </button>     -->
                        
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
