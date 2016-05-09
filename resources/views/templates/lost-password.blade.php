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
                        <li><a href="homepage">Home</a></li>
                        <li class="active">Lupa Kata Sandi</li>
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
                	<div class="login-form-wrapper no-border">
                        <form>
                        	<h3>Lupa Kata Sandi</h3>
                            <p>Masukkan email yang terdaftar dengan akun anda. Klik submit untuk mendapatkan password pada email anda.</p>
                            <div class="form-group">
                                <label>Email<span class="required">*</span></label>
                                <input type="email" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
    	ACCOUNT - END 
    =========================== -->
   @stop