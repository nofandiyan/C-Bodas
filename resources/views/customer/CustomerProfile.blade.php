@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
    <br>
        <div class="col-md-12">
        
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <div align="center"><h2><label>Profil <font color="E87169">{{$profiles->name}}</font></label></h2></div>
                    <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                    
                    <form class="form-horizontal" role="form" method="POST" action="/">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                                <div class="col-md-12">
                                    <div class="col-md-6" align="right">Nama</div>
                                    <div class="col-md-6">{{$profiles->name}}</div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6" align="right">Nomor Telepon</div>
                                    <div class="col-md-6">{{$profiles->phone}}</div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6" align="right">Jenis Kelamin</div>
                                    <div class="col-md-6">
                                        {{$profiles->gender}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6" align="right">Email</div>
                                    <div class="col-md-6">
                                        {{$profiles->email}}
                                    </div>
                                    <br>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="col-md-6" align="right">Alamat</div>
                                    <div class="col-md-6">
                                        {{$profiles->street}}                       <br>
                                        {{$profiles->type}} {{$profiles->city}}     <br>
                                        {{$profiles->province}}                     <br>
                                        {{$profiles->zip_code}}   
                                    </div>
                                </div>

                                <div class="col-md-12">
                                <br>
                                    @if(Auth::user()->role=='customer')
                                    <div class="col-md-6" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    <div class="col-md-6" align="left">
                                        <a href="/customer/{{$profiles->id}}/edit" class="btn btn-primary" role="button">Edit Profile</a>
                                    </div>
                                    @else
                                    <div class="col-md-12" align="center">
                                        <a href="" onclick="goBack()" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    @endif
                                </div>


                        
                    </form>
                </div>
            </div>
        
        </div>
    </div>
</div>

@stop
