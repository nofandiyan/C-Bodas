@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profil</div>
                <div class="panel-body">
                @foreach($profiles as $profile)
                    <form class="form-horizontal" role="form" method="POST" action="/seller/{{$profile->id}}" enctype="multipart/form-data">
                        
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="put">
                        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                        <input type="hidden" name='id' value="{{$profile->id}}">
                        <input type="hidden" name='role' value="seller">

                        <div class="form-group">    

                            <label class="col-md-10 col-md-offset-2">Informasi Akun</label>

                            <div class="form-group{{ $errors->has('prof_pic') ? ' has-error' : '' }}" align="center">
                                <label>Foto Profil</label>
                                <div class="full-image">
                                    <img src="{{ url($profile->prof_pic) }}" class="img-thumbnail" height="300" width="300">
                                </div>
                                <label>Ganti Foto Profil</label>
                                <input type="file" name="prof_pic">
                                 @if ($errors->has('prof_pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prof_pic') }}</strong>
                                    </span>
                                @endif
                            </div>

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

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <select class="form-control" name="type_id">
                                    <option value="KTP" <?php if("{{$profile->type_id}}"=='KTP') echo 'selected'; ?>>KTP</option>
                                    <option value="SIM" <?php if("{{$profile->type_id}}"=='SIM') echo 'selected'; ?>>SIM</option>
                                </select>

                                    @if ($errors->has('type_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('no_id') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="no_id" value="{{ $profile->no_id }}" placeholder="Nomor Identitas">

                                    @if ($errors->has('no_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('no_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

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

                        <!-- </div>

                        <div> -->
                            <label class="col-md-9 col-md-offset-3">Alamat</label>

                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="street" placeholder="Jalan + Nomor" value="{{ Auth::user()->street }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="city" value="Kab. Bandung" readonly="Kab. Bandung">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="province" value="Jawa Barat" readonly="Jawa Barat">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="zip_code" value="40391" readonly="40391">
                                </div>
                            </div>

                        <!-- </div>

                        <div> -->
                            <label class="col-md-10 col-md-offset-2">Informasi Rekening</label>

                            <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="bank_name" placeholder="Nama Bank" value="{{ $profile->bank_name }}">

                                    @if ($errors->has('bank_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="account_number" value="{{ $profile->account_number }}" placeholder="Nomor Rekening">

                                    @if ($errors->has('account_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bank_account') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="bank_account" value="{{ $profile->bank_account }}" placeholder="Nama Dalam Buku Rekening">

                                    @if ($errors->has('bank_account'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_account') }}</strong>
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
                @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
