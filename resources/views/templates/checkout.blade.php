@extends('templates\master',['url'=>'barang','link'=>'barang'])

@section('konten')
    
    <!-- ==========================
    	BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h2>Checkout</h2>
                    <p>Pembayaran & Alamat Pengiriman</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li class="active">Billing & Shipping Address</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
	<!-- ==========================
    	BREADCRUMB - END 
    =========================== -->
    
    <!-- ==========================
    	MY ACCOUNT - START 
    =========================== -->
    <section class="content account">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <article class="account-content checkout-steps">
                        <div class="row row-no-padding">
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step active">
                                    <div class="number">1</div>
                                    <div class="title">Alamat Pengiriman</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step">
                                    <div class="number">2</div>
                                    <div class="title">Metode Pengiriman</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step">
                                    <div class="number">3</div>
                                    <div class="title">Metode Pembayaran</div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="checkout-step">
                                    <div class="number">4</div>
                                    <div class="title">Ulasan Pemesanan</div>
                                </div>
                            </div>
                        </div>
                       
                        
                        <div class="progress checkout-progress hidden-xs"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;"></div></div>
                        
                            <h3>Informasi Alamat Pengiriman</h3>
                            <div class="products-order checkout billing-information">
                                <button class="btn btn-primary addresses-toggle" type="button" data-toggle="collapse" data-target="#my-addresses-billing" aria-expanded="false" aria-controls="my-addresses-billing">Gunakan Alamat Tersimpan</button>
                                <div id="my-addresses-billing" class="collapse">
                                	<div class="table-responsive border">
                                        <form action="{{action('CartController@addalamatlama')}}" method="post" enctype="multipart/form-data">
                            
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <table class="table table-bordered">
                                            <input type="hidden" id="nama" onClick="add()" name="name" value="{{$informasi->name}}">
                                            <input type="hidden" id="street" onClick="add()" name="street" value="{{$informasi->street}}">
                                            <input type="hidden" id="street" onClick="add()" name="zip_code" value="{{$informasi->zip_code}}">
                                            <input type="hidden" id="city" onClick="add()" name="city" value="{{$informasi->city}}">
                                            <input type="hidden" id="type" onClick="add()" name="type" value="{{$informasi->type}}">
                                            <input type="hidden" id="provincee" onClick="add()" name="province" value="{{$informasi->province}}">
                                            <input type="hidden" id="phone" onClick="add()" name="phone" value="{{$informasi->phone}}">
                                            <input type="hidden" name ="customer_id" value="{{$informasi->customer_id}}">
                                            <input type="hidden"name="province_id" value="{{$informasi->province_id}}">
                                            <input type="hidden"name="city_id" value="{{$informasi->city_id}}">

                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Pos</th>
                                                <th>Telepon</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td>{{$informasi->name}}</td>
                                                <td>{{$informasi->street}} {{$informasi->city}} {{$informasi->province}} </td>
                                                <td>{{$informasi->zip_code}}</td>
                                                <td>{{$informasi->phone}}</td>
                                            
                                                <td><button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">Pilih</button></td>
                                            </tr>
                                            
                                        </table>

                                        


                                    </form>
                                    <!-- <h4>Detail Alamat</h4>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label>Nama :</label>
                                            <span id="namaa"></span>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label>Jalan :</label>
                                            <span id="streett"></span>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label>Provinsi :</label>
                                            <span id="provincee"></span>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label>Type :</label>
                                            <span id="typee"></span>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label>city :</label>
                                            <span id="cityy"></span>
                                        </div>


                                    </div> -->
                                </div>
                              
                                   
                                </div>
                            </div>
                            <form action="{{action('CartController@addalamatbaru')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="role" value="customer">
                            <input type="hidden" name="customer_id" value="customer">
                            
                            <h3>Alamat Pengiriman Berbeda</h3>
                            <div class="products-order checkout shipping-information">
                                <div class="checkbox">  
                                    <input id="check-shipping" type="checkbox" checked>
                                    <label for="check-shipping" data-toggle="collapse" data-target="#shipping-address-collapse" aria-controls="shipping-address-collapse">Klik disini untuk menggunakan alamat berbeda.</label>
                                </div>
                                <div id="shipping-address-collapse" class="collapse">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label>Informasi Diri<span class="required">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div>
                                            <input type="text" class="form-control" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" maxlength="15" onkeyup="numeric(this)">

                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="form-group col-sm-12">
                                            <label>Alamat Pengiriman<span class="required">*</span></label>
                                            <div class="{{ $errors->has('province') ? ' has-error' : '' }}">
                                                <select class="form-control" name="province" id="province" onchange="getIdProvince()">
                                                <option>--Pilih Provinsi--</option>
                                                @foreach($province as $prov)
                                                <option value="{{$prov->id}}">{{$prov->province}}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('province'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-12">
                                            <div class="{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                <select class="form-control" name="city_id">
                                                <option id="kota-default" selected="true">--Pilih Kota/Kabupaten--</option>
                                
                                                @foreach($cities as $city)
                                                <option class="kota {{$city->province_id}}" value="{{$city->id}}" disabled="true">
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
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <div class="{{ $errors->has('street') ? ' has-error' : '' }}">
                                            <input type="text" class="form-control" name="street" placeholder="Nama Jalan dan Nomor..." value="{{ old('street') }}" maxlength="50">
                                            @if ($errors->has('street'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <div class="{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                            <input type="text" class="form-control" name="zip_code" placeholder="Kode Pos" value="{{ old('zip_code') }}" maxlength="5">
                                            @if ($errors->has('zip_code'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                        </div>
                                        <td><button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">Simpan</button></td> 
                                    </div>                                  
                                </div>
                            </div>
                           
                              
                            </form>                    
                    </article>
                </div>
            </div> 
        </div>
    </section>
    <!-- ==========================
    	MY ACCOUNT - END 
    =========================== -->
<script type="text/javascript">

function add()
{
        nama = document.getElementById("nama").value;
        street = document.getElementById("street").value;
        province = document.getElementById("province").value;
        type=document.getElementById("type").value;
        city=document.getElementById("city").value;

        document.getElementById("namaa").innerHTML = nama;
        document.getElementById("streett").innerHTML = street;
        document.getElementById("provincee").innerHTML = province;
        document.getElementById("typee").innerHTML = type;
        document.getElementById("cityy").innerHTML = city;
       /*alur
        total=subtotal1+subtotal2+subtotal3 dst*/
        
        document.getElementById("total"+id).innerHTML = total;
}
//address
        function getIdProvince() {
            $(".kota:selected").removeAttr("selected");
            $("#kota-default").attr("selected", true);
            var provid =  document.getElementById("province").value;
          
            $(".kota").css("display", "none");
            $(".kota").attr("disabled", true);
            $("."+provid).css("display", "block");
            $("."+provid).attr("disabled", false);
        }


</script>   
        
   @stop