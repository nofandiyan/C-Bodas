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
                    <p>Customer Home</p>
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Halaman Penjual</div>
                <div class="panel-body">
                    <div>
                    @foreach($profiles as $profile)
                        <!-- <form class="form-horizontal" role="form" method="POST"> -->
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-md-4" align="center">
                                
                                <a href="/CustomerProfile/{{$profile->id}}" class="btn btn-info" role="button">Lihat Profil</a>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    {{$profile->name}}
                                </div>

                                <div class="form-group">
                                    {{$profile->phone}}
                                </div>

                                <div class="form-group">
                                    {{$profile->street}}
                                </div>
                                
                                <div class="form-group">
                                    {{$profile->city}}
                                </div>

                                <div class="form-group">
                                    {{$profile->province}}
                                </div>

                                <div class="form-group">
                                    {{$profile->zip_code}}
                                </div>
                            </div>
                        <!-- </form> -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->

@stop
