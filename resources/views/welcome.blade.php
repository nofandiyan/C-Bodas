@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <a href="{{'/AdminSignUp'}}" button type="submit" class="btn btn-primary btn-lg btn-block">Daftar Admin</button></a><br>
                    <a href="{{'/SellerSignUp'}}" button type="submit" class="btn btn-primary btn-lg btn-block">Daftar Seller</button></a><br>
                    <a href="{{'/CustomerSignUp'}}" button type="submit" class="btn btn-primary btn-lg btn-block">Daftar Customer</button></a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
