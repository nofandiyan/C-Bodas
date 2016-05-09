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
                        <li class="active">Daftar Pembeli</li>
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
                        <form>
                            <h3>Form Pendaftaran Pembeli</h3>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap..." value="{{ old('name') }}">
                                 @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="email" placeholder="Email..." value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" name="password" placeholder="Kata Sandi...">
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi Kata Sandi...">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" name="telp" maxlength="12" placeholder="Nomor Telepon..." value="{{ old('telp') }}">

                                @if ($errors->has('telp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telp') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">Submit</button>
                        </form>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-brand btn-facebook"><i class="fa fa-facebook"></i>Daftar dengan Facebook</a>
                            </div>
                        </div>
                    </div>
                    <p class="form-text">Sudah memiliki akun? <a href="signin.html">Masuk</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->
 @stop