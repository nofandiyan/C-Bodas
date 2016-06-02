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
                        <input type="hidden" name='idMerchant' value="{{$profiles->id}}">

                        <div class="col-md-5" align="center">
                            <!-- <div class="wrapper"> -->
                                <div class="full-image"></div>
                                <div class="thumbnails">
                                    <label>
                                        <!-- <input type="radio" name="full-image" checked> -->
                                        <div class="full-image">
                                            <img src="{{ url($profiles->prof_pic) }}" class="img-thumbnail" height="300" width="300">
                                        </div>
                                    </label>
                                </div>
                            <!-- </div> -->
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
                                    <label class="col-md-3" align="right">Jenis Identitas</label>
                                    <div class="col-md-9">
                                        {{$profiles->type_id}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nomor Identitas</label>
                                    <div class="col-md-9">
                                        {{$profiles->no_id}}
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

                                <label class="col-md-3" align="right">Informasi Rekening</label>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nama Bank</label>
                                    <div class="col-md-9">
                                        {{$profiles->bank_name}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nomor Rekening</label>
                                    <div class="col-md-9">
                                        {{$profiles->account_number}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Nama Buku Rekening</label>
                                    <div class="col-md-9">
                                        {{$profiles->bank_account}}
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    @if(Auth::user()->role == 'seller')
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    <div class="col-md-3" align="right">
                                        <a href="/seller/{{$profiles->id}}/edit" class="btn btn-primary" role="button">Edit Profile</a>
                                    </div>
                                    @else
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                    @endif
                                    
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
