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
                        <li><a href="homepage.html">Halaman Admin</a></li>
                        <li class="active">Admin Home</li>
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
                <!-- <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3"> -->
                <div class="col-md-12">
                    <div class="login-form-wrapper">
                        @foreach ($profiles as $profile)
                        <label>Selamat Datang {{ $profile->name }}, Selamat Beraktifitas</label>
                            <div>
                                {{$profile->email}}
                            </div>
                            <div>
                                {{$profile->name}}
                            </div>
                            <div>
                                {{$profile->phone}}
                            </div>
                            <div>
                                {{$profile->street}}
                            </div>
                            <div>
                                {{$profile->city}}
                            </div>
                            <div>
                                {{$profile->province}}
                            </div>
                            <div>
                                {{$profile->zip_code}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->

@stop
