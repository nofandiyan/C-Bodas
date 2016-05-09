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
                    <p>Masuk</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="homepage.html">Halaman Utama</a></li>
                        <li class="active">Masuk</li>
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
                        <form role="form" method="POST" action="{{ url('/signin') }}">
                            <h3>Masuk</h3>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email..." value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Kata Sandi...">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input type="checkbox" id="signin-remember">
                                    <label for="signin-remember">Ingat Saya</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </form>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-brand btn-facebook"><i class="fa fa-facebook"></i>Masuk dengan Facebook</a>
                            </div>
                        </div>
                    </div>
                    <p class="form-text">Lupa <a href="lost-password">kata sandi?</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->
    
    @stop