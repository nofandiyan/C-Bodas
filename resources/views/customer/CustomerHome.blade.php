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
                        <li><a href="homepage.html">Halaman Customer</a></li>
                        <li class="active">Customer Home</li>
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
                        Customer Home
                        @foreach($profiles as $profile)
                            <div>
                                <div>
                                    Email
                                </div>
                                <div>
                                    {{ $profile->email }}        
                                </div>
                            </div>

                            <div>
                                <div>
                                    Nama
                                </div>  
                                <div>
                                    {{ $profile->name }}    
                                </div>
                            </div>
                            
                            
                            
                            {{ $profile->street }}
                            {{ $profile->city }}
                            {{ $profile->province }}
                            {{ $profile->zip_code }}
                            {{ $profile->gender }}
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
