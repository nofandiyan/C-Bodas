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
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="homepage.html">Halaman Utama</a></li>
                        <li class="active">Daftar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END 
    =========================== -->
    <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                  <div class="login-form-wrapper">      
                    <h3>Daftar</h3><br>
                    <div class="row">
                        
                        <a href="signuppembeli" button type="submit" class="btn btn-primary btn-lg btn-block">Daftar Sebagai Pembeli</button></a><br>
                       
                    </div>
                    <div class="row">
                        
                        <a href="{{ url('/sellerSignUp') }}" button type="submit" class="btn btn-primary btn-lg btn-block">Daftar Sebagai Penjual</button></a>
                    </div>
                  </div>  
                </div>    
            </div>
    </div>        
 @stop