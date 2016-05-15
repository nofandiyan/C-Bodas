@extends('templates\master')

@section('konten')

<!-- ==========================
        BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h2>C-Bodas</h2>
                    <p>Daftar</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="homepage.html">Halaman Utama</a></li>
                        <li class="active">Daftar Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END 
    =========================== -->
    
    <!-- ==========================
        ACCOUNT - START 
    =========================== -->
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                    <div class="login-form-wrapper">
                        <form class="form-horizontal" role="form" method="POST" action="/admin/{{$profile->id}}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" id="userAs" name="userAs" value="0">

                            <h3>Form Edit Profil Admin</h3>

                            <br>
                            <h4><label>Informasi Akun</label></h4>

                            <div class="form-group{{ $errors->has('profPict') ? ' has-error' : '' }}" align="center">
                                <label>Foto Profil</label>
                                <div class="full-image">
                                    <img src="{{ url($profile->profPict) }}" class="img-thumbnail" height="300" width="300">
                                </div>
                                <label>Ganti Foto Profil</label>
                                <input type="file" name="profPict" id="profPict">
                                 @if ($errors->has('profPict'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profPict') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div>
                                <input type="text" class="form-control" name="email" value="{{ $profile->email }}" readonly>
                            </div>
                            
                            <br>
                            <h4><label>Informasi Data Diri</label></h4>
                            
                            <div class="{{ $errors->has('typeId') ? ' has-error' : '' }}">
                                <select class="form-control" name="typeId" id="typeId">
                                    <option>--Jenis Identitas--</option>
                                    <option <?php if($profile->typeId=="KTP") echo 'selected'; ?> value="KTP">KTP</option>
                                    <option <?php if($profile->typeId=="SIM") echo 'selected'; ?> value="SIM">SIM</option>
                                </select>
                                @if ($errors->has('typeId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('typeId') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('noId') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="noId" placeholder="Nomor Identitas..." value="{{ $profile->noId }}">
                                 @if ($errors->has('noId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('noId') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap..." value="{{ $profile->name }}">
                                 @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            
                            <div class="{{ $errors->has('telp') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="telp" maxlength="12" placeholder="Nomor Telepon..." value="{{ $profile->telp }}">
                                @if ($errors->has('telp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telp') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <br>
                            <h4><label>Informasi Alamat</label></h4>

                            <div class="{{ $errors->has('street') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="street" placeholder="Nama Jalan dan Nomor..." value="{{ $profile->street }}">
                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('city') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="city" placeholder="Kota..." value="{{ $profile->city }}">
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('prov') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="prov" placeholder="Propinsi..." value="{{ $profile->prov }}">
                                @if ($errors->has('prov'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prov') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('zipCode') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="zipCode" placeholder="Kode Pos..." value="{{ $profile->zipCode }}">
                                @if ($errors->has('zipCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipCode') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <br>
                            <h4><label>Informasi Rekening</label></h4>

                            <div class="{{ $errors->has('bankName') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="bankName" placeholder="Nama Bank..." value="{{ $profile->bankName }}">
                                @if ($errors->has('bankName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bankName') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('rekId') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="rekId" placeholder="Nomor Rekening..." value="{{ $profile->rekId }}">
                                @if ($errors->has('rekId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rekId') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('rekName') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="rekName" placeholder="Nama Dalam Buku Rekening..." value="{{ $profile->rekName }}">
                                @if ($errors->has('rekName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rekName') }}</strong>
                                    </span>
                                @endif
                            </div>   

                            <div class="form-group{{ $errors->has('myCheck') ? ' has-error' : '' }}">
                                <div class="col-md-1">
                                    <input type="checkbox" id="myCheck" name="" required>
                                </div>
                                <div class="col-md-offset-1" align="justify">
                                    Data tersebut saya isi dengan jujur dan apa adanya, apabila terdapat kesalahan pada saat pengisian formulir adalah murni dari kesalahan saya dan pihak C-Bodas tidak ikut menanggung kesalahan yang telah saya perbuat.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="edit">Simpan</button>

                        </form>
                        
                        <!-- <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-brand btn-facebook"><i class="fa fa-facebook"></i>Daftar dengan Facebook</a>
                            </div>
                        </div> -->

                    </div>
                    <p class="form-text">Sudah memiliki akun? <a href="{{ url('/login') }}">Masuk</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->

@stop