@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
    <br>
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/seller/{{$profiles->id}}" enctype="multipart/form-data">
                        
                        <div align="center"><h2><label>Perbaharui Profil <br> <font color="E87169">{{$profiles->name}}</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />

                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='id' value="{{$profiles->id}}">
                        <input type="hidden" name='role' value="seller">

                            

                            <div class="{{ $errors->has('prof_pic') ? ' has-error' : '' }}" align="center">
                                <label>Foto Profil</label>
                                <div class="full-image">
                                    <img src="{{ url($profiles->prof_pic) }}" class="img-thumbnail" height="300" width="300">
                                </div>
                                <label>Ganti Foto Profil</label>
                                <input type="file" name="prof_pic">
                                 @if ($errors->has('prof_pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prof_pic') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">

                                    <input type="email" class="form-control" name="email" value="{{ $profiles->email }}" placeholder="Alamat E-Mail" readonly>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <br>
                            <h4><label>Informasi Data Diri</label></h4>

                            <div class="{{ $errors->has('type_id') ? ' has-error' : '' }}">

                                    <select class="form-control" name="type_id">
                                    <option value="KTP" <?php if("{{$profiles->type_id}}"=='KTP') echo 'selected'; ?>>KTP</option>
                                    <option value="SIM" <?php if("{{$profiles->type_id}}"=='SIM') echo 'selected'; ?>>SIM</option>
                                </select>

                                    @if ($errors->has('type_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_id') }}</strong>
                                        </span>
                                    @endif

                            </div>

                            <div class="{{ $errors->has('no_id') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="no_id" value="{{ $profiles->no_id }}" placeholder="Nomor Identitas">

                                    @if ($errors->has('no_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('no_id') }}</strong>
                                        </span>
                                    @endif

                            </div>

                            <div class="{{ $errors->has('name') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="{{ $errors->has('phone') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="phone" value="{{ $profiles->phone }}" placeholder="Nomor Telepon">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="{{$errors->has('gender') ? ' has-error' : '' }}">
                                    <select class="form-control" name="gender">
                                        <option value="Laki-laki" <?php if("{{$profiles->gender}}"=='Laki-laki') echo 'selected'; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?php if("{{$profiles->gender}}"=='Perempuan') echo 'selected'; ?>>Perempuan</option>
                                    </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <br>
                            <h4><label>Alamat</label></h4>

                            <div class="{{ $errors->has('street') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="street" placeholder="Jalan + Nomor" value="{{ Auth::user()->street }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="">
                                    <input type="text" class="form-control" name="province" value="{{$profiles->province}}" readonly="{{$profiles->province}}">
                            </div>

                            <div class="">
                                    <input type="hidden" name="city_id" value="{{$profiles->city_id}}">
                                    <input type="text" class="form-control" name="city" value="{{$profiles->type}} {{$profiles->city}}" readonly="{{$profiles->city}}">
                            </div>

                            <div class="">
                                    <input type="text" class="form-control" name="zip_code" value="40391" readonly="40391">
                            </div>

                            <br>
                            <h4><label>Informasi Rekening</label></h4>

                            <div class="{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                    <select class="form-control" name="bank_name">
                                        <option value="BRI" <?php if("{{$profiles->bank_name}}"=='BRI') echo 'selected'; ?>>BRI</option>
                                        <option value="Mandiri" <?php if("{{$profiles->bank_name}}"=='Mandiri') echo 'selected'; ?>>Mandiri</option>
                                        <option value="BNI" <?php if("{{$profiles->bank_name}}"=='BNI') echo 'selected'; ?>>BNI</option>
                                        <option value="BCA" <?php if("{{$profiles->bank_name}}"=='BCA') echo 'selected'; ?>>BCA</option>
                                    </select>

                                    @if ($errors->has('bank_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                        </div>

                            <div class="{{ $errors->has('account_number') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="account_number" value="{{ $profiles->account_number }}" placeholder="Nomor Rekening">

                                    @if ($errors->has('account_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_number') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="{{ $errors->has('bank_account') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="bank_account" value="{{ $profiles->bank_account }}" placeholder="Nama Dalam Buku Rekening">

                                    @if ($errors->has('bank_account'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_account') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <br>
                            <div class="{{ $errors->has('myCheck') ? ' has-error' : '' }}">
                                <div class="col-md-1">
                                    <input type="checkbox" id="myCheck" name="myCheck" required>
                                </div>
                                <div class="col-md-offset-1" align="justify">
                                    Data tersebut saya isi dengan jujur dan apa adanya, apabila terdapat kesalahan pada isi formulir merupakan murni dari kesalahan saya dan pihak C-Bodas tidak ikut menanggung kesalahan yang telah saya perbuat.
                                </div>
                            </div>
                            <br>

                        <div class="">
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
