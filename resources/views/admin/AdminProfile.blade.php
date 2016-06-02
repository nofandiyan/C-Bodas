@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default">
                <div class="panel-heading">Profil {{$profiles->name}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                        <div class="col-md-5" align="center">
                            
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nama</label>
                                    <div class="col-md-9">
                                        {{$profiles->name}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nomor Telepon</label>
                                    <div class="col-md-9">
                                        {{$profiles->phone}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                        @if ($profiles->gender == 'L')
                                            Laki-Laki
                                        @elseif ($profiles->gender == 'P')
                                            Perempuan
                                        @endif
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Email</label>
                                    <div class="col-md-9">
                                        {{$profiles->email}}
                                    </div>
                                    <br>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Alamat</label>
                                    <div class="col-md-9">
                                        {{$profiles->street}}                       <br>
                                        {{$profiles->type}} {{$profiles->city}}     <br>
                                        {{$profiles->province}}                     <br>
                                        {{$profiles->zip_code}}   
                                    </div>
                                </div>

                                <div class="col-md-12">
                                <br>
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    <div class="col-md-3" align="right">
                                        <a href="/admin/{{$profiles->id}}/edit" class="btn btn-primary" role="button">Edit Profile</a>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>
    </div>
</div>

@stop
