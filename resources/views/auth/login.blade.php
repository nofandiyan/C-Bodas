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
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                <h3>Masuk</h3>
                                
                                {!! csrf_field() !!}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email" placeholder="Email..." value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <!-- <label class="col-md-4 control-label">Password</label> -->
                                    <input type="password" class="form-control" name="password" placeholder="Kata Sandi...">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <input type="checkbox" name="remember">
                                        <label for="signin-remember">Ingat Saya</label>
                                    </div>
                                </div>

                            <!-- <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>
                            </div> -->

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

                        </form>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-brand btn-facebook"><i class="fa fa-facebook"></i>Masuk dengan Facebook</a>
                            </div>
                        </div>
                    </div>
                    <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                    <p class="form-text">Lupa <a href="{{ url('/password/reset') }}">kata sandi?</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->
    
    @stop
