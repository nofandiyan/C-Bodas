@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profil</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/buyer/{{$profile->id}}" enctype="multipart/form-data">
                        
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name='id' value="{{Auth::user()->id}}">

                        <div class="form-group">    

                            <label class="col-md-10 col-md-offset-2">Informasi Akun</label>

                            <div class="form-group{{ $errors->has('profPict') ? ' has-error' : '' }}" align="center">
                                <label>Foto Profil</label>
                                <div class="full-image">
                                    <img src="{{ url($profile->profPict) }}" class="img-thumbnail" height="300" width="300">
                                </div>
                                <label>Ganti Foto Profil</label>
                                <input type="file" name="profPict" id="profPict">
                                 @if ($errors->has('profPict'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profPict') }}</strong>
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

                            <div class="form-group{{ $errors->has('typeId') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <select class="form-control" name="typeId" id="typeId">
                                    <option value="KTP" <?php if("{{Auth::user()->typeId->KTP}}") echo 'selected'; ?>>KTP</option>
                                    <option value="SIM" <?php if("{{Auth::user()->typeId->SIM}}") echo 'selected'; ?>>SIM</option>
                                </select>

                                    @if ($errors->has('typeId'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('typeId') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('noId') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="noId" value="{{ Auth::user()->noId }}" placeholder="Nomor Identitas">

                                    @if ($errors->has('noId'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('noId') }}</strong>
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

                            <div class="form-group{{ $errors->has('telp') ? ' has-error' : '' }}">

                                 <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="telp" value="{{ Auth::user()->telp }}" placeholder="Nomor Telepon">

                                    @if ($errors->has('telp'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telp') }}</strong>
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
                                    <input type="text" class="form-control" name="prov" value="Jawa Barat" readonly="Jawa Barat">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="zipCode" value="40391" readonly="40391">
                                </div>
                            </div>

                        <!-- </div>

                        <div> -->
                            <label class="col-md-10 col-md-offset-2">Informasi Rekening</label>

                            <div class="form-group{{ $errors->has('bankName') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="bankName" placeholder="Nama Bank" value="{{ Auth::user()->bankName }}">

                                    @if ($errors->has('bankName'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bankName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rekName') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="rekName" value="{{ Auth::user()->rekName }}" placeholder="Nama Dalam Buku Rekening">

                                    @if ($errors->has('rekName'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rekName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rekId') ? ' has-error' : '' }}">

                                <div class="col-md-6 col-md-offset-3">
                                    <input type="text" class="form-control" name="rekId" value="{{ Auth::user()->rekId }}" placeholder="Nomor Rekening">

                                    @if ($errors->has('rekId'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rekId') }}</strong>
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
