@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
    <br>
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/{{$profiles->id}}" enctype="multipart/form-data">
                        
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='id' value="{{$profiles->id}}">
                        <input type="hidden" name='role' value="super">

                        <div align="center"><h2><label>Perbaharui Profil <br> <font color="E87169">{{$profiles->name}}</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        
                            <h4><label>Informasi Akun</label></h4>

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

                            <div class="{{ $errors->has('name') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="name" value="{{ $profiles->name }}" placeholder="Nama Lengkap">

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

                            <div class="{{ $errors->has('gender') ? ' has-error' : '' }}">
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
                            <h4><label>Informasi Alamat</label></h4>

                            <div class="{{ $errors->has('street') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="street" placeholder="Jalan + Nomor" value="{{ $profiles->street }}">

                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="{{ $errors->has('province') ? ' has-error' : '' }}">
                                <select class="form-control" name="province" id="province" onchange="getIdProvince()">
                                    <option>--Pilih Propinsi--</option>

                                @foreach($province as $prov)
                                    <option value="{{$prov->id}}" <?php if("{{$profiles->idProvince}}"=="{{$prov->id}}") echo 'selected'; ?>>{{$prov->province}}</option>
                                @endforeach

                                </select>
                                @if ($errors->has('province'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <select class="form-control" name="city_id">
                                    <option id="kota-default" selected="true">--Pilih Kota/Kabupaten--</option>
                                
                                @foreach($cities as $city)
                                        <option class="kota {{$city->province_id}}" value="{{$city->id}}" readonly="true" <?php if("{{$profiles->city_id}}"=="{{$city->id}}") echo 'selected'; ?>>
                                            {{$city->type}} {{$city->city}}
                                        </option>
                                @endforeach
                                
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="{{ $errors->has('zip_code') ? ' has-error' : '' }}">

                                    <input type="text" class="form-control" name="zip_code" placeholder="Kode Pos..." value="{{ $profiles->zip_code }}" maxlength="5">

                                    @if ($errors->has('zip_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zip_code') }}</strong>
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
                            <div class="col-md-6 col-md-offset-3" align="center">
                                <button type="submit" class="btn btn-primary" name="submit" value="POST">
                                    <i class="fa fa-btn fa-user"></i>Simpan
                                </button>
                            </div>
    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
