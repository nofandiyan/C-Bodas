@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profil</div>
                <div class="panel-body">
                    @foreach($profiles as $profile)
                    <form class="form-horizontal" role="form" method="POST" action="/customer/{{$profile->id}}" enctype="multipart/form-data">

                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='id' value="{{$profile->id}}">
                        <input type="hidden" name='role' value="customer">

                        <div class="form-group">    

                            <label class="col-md-10 col-md-offset-2">Informasi Akun</label>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                 <div class="col-md-6 col-md-offset-3">
                                    <input type="email" class="form-control" name="email" value="{{ $profile->email }}" placeholder="Alamat E-Mail" readonly>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <label class="col-md-10 col-md-offset-2">Informasi Data Diri</label>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">

                                 <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="phone" value="{{ $profile->phone }}" placeholder="Nomor Telepon">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <select class="form-control" name="gender">
                                    <option value="L" <?php if("{{$profile->gender}}"=='L') echo 'selected'; ?>>Laki-Laki</option>
                                    <option value="P" <?php if("{{$profile->gender}}"=='P') echo 'selected'; ?>>Perempuan</option>
                                </select>

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <label class="col-md-9 col-md-offset-3">Alamat</label>

                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="street" placeholder="Jalan + Nomor" value="{{ $profile->street }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="city" placeholder="Kota..." value="{{ $profile->city }}">

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="province" placeholder="Propinsi..." value="{{ $profile->province }}">

                                    @if ($errors->has('province'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('province') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="zip_code" placeholder="Kode Pos..." value="{{ $profile->zip_code }}" maxlength="5">

                                    @if ($errors->has('zip_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zip_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3" align="center">
                                <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                    <i class="fa fa-btn fa-user"></i>Simpan
                                </button>
                            </div>
                        </div>
                
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
