@extends('templates.master')

@section('konten')

<style>
    td.short{
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
    }
    .clickable {
    cursor: pointer;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Halaman Penjual</div>
                <div class="panel-body">
                    <div>
                        <form class="form-horizontal" role="form" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-md-4" align="center">
                                <img src="{{ url(Auth::user()->profPict) }}" class="img-thumbnail" height="250" width="250">
                                <br>
                                <a href="/sellerProfile/{{Auth::user()->id}}" class="btn btn-info" role="button">Edit Profil</a>
                                <!-- <button type="submit" class="btn btn-primary" name="submit" value="">
                                    <i class="fa fa-btn fa-user"></i>Lihat Profil
                                </button>     -->
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    {{Auth::user()->name}}
                                </div>

                                <div class="form-group">
                                    {{Auth::user()->telp}}
                                </div>

                                <div class="form-group">
                                    {{Auth::user()->street}}
                                </div>
                                
                                <div class="form-group">
                                    {{Auth::user()->city}}
                                </div>

                                <div class="form-group">
                                    {{Auth::user()->prov}}
                                </div>

                                <div class="form-group">
                                    {{Auth::user()->zipCode}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak</div>
                <div class="panel-body">
                    <div class="col-md-3">
                        
                        <h4 align="center"><label>Buat Lapak Yuk!</label></h4>
                            
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Lapak Pertanian
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse" align="center">
                                    <div class="panel-body">Lapak Pertanian merupakan lapak hasil bumi dari kawasan Cibodas
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{ url('produkTani/create') }}" class="btn btn-warning btn-sm">Buat Lapak</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Lapak Hewan Ternak
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" align="center">
                                    <div class="panel-body">Lapak Hewan Ternak merupakan lapak hewan ternak dari kawasan Cibodas
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{ url('produkTernak/create') }}" class="btn btn-warning btn-sm">Buat Lapak</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Lapak Tiket Pariwisata
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" align="center">
                                    <div class="panel-body">
                                        Lapak Pariwisata merupakan lapak penjualan tiket pariwisata yang ada di kawasan Cibodas
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{ url('produkWisata/create') }}" class="btn btn-warning btn-sm">Buat Lapak</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse4">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Lapak Persewaan Villa
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse" align="center">
                                    <div class="panel-body">
                                        Lapak Villa merupakan lapak persewaan Villa yang ada di kawasan Cibodas
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{ url('produkVilla/create') }}" class="btn btn-warning btn-sm">Buat Lapak</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse5">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Lapak Edukasi Tani
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse" align="center">
                                    <div class="panel-body">
                                        Lapak Edukasi Tani merupakan lapak penjualan jasa edukasi Pertanian yang ada di kawasan Cibodas
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{ url('produkEdukasi/create') }}" class="btn btn-warning btn-sm">Buat Lapak</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                                
                            
                        
                    </div>
                    <div class="col-md-9">
                        <h3 align="center"><label>Lapak Terdaftar</label></h3>
                        <!-- <div>
                            <a href="/produkTani/" class="btn btn-info" role="button">Daftar Lapak Pertanian</a>
                        </div>
                        <div>
                            <a href="/produkTernak/" class="btn btn-info" role="button">Daftar Lapak Hewan Ternak</a>
                        </div>
                        <div>
                            <a href="/produkWisata/" class="btn btn-info" role="button">Daftar Lapak Pariwisata</a>
                        </div>
                        <div>
                            <a href="/produkVilla/" class="btn btn-info" role="button">Daftar Lapak Persewaan Villa</a>
                        </div>
                        <div>
                            <a href="/produkEdukasi/" class="btn btn-info" role="button">Daftar Lapak Edukasi Tani</a>
                        </div> -->
<!-- button -->
                        <!-- <div align="center">
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lapakTani">Lapak Pertanian</button>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lapakTernak">Lapak Hewan Ternak</button>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lapakWisata">Lapak Pariwisata</button>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lapakVilla">Lapak Persewaan Villa</button>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lapakEdukasi">Lapak Edukasi Tani</button>
                        </div>
                        <div align="center">
                            <br>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#lapakTani, #lapakTernak, #lapakWisata, #lapakVilla, #lapakEdukasi">Semua Lapak</button>
                        </div> -->


                        <div id="accordion1">
                            <div class="panel">
                                <div align="center">
                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#lapakTani">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Pertanian
                                            </a>
                                        </h4>
                                    </button>
                                    
                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#lapakTernak">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Hewan Ternak
                                            </a>
                                        </h4>
                                    </button>

                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#lapakWisata">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Pariwisata
                                            </a>
                                        </h4>
                                    </button>

                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#lapakVilla">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Persewaan Villa
                                            </a>
                                        </h4>
                                    </button>

                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#lapakEdukasi">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Edukasi Tani
                                            </a>
                                        </h4>
                                    </button>
                                </div>

                                <script type="text/javascript">
                                    $(function () {

                                    var active = true;

                                    $('#collapse-init').click(function () {
                                        if (active) {
                                            active = false;
                                            $('.showHide').collapse('show');
                                            // $('.panel-title').attr('data-toggle', '');
                                            $(this).text('(-) Semua Lapak');
                                        } else {
                                            active = true;
                                            $('.showHide').collapse('hide');
                                            // $('.panel-title').attr('data-toggle', 'collapse');
                                            $(this).text('(+) Semua Lapak');
                                        }
                                    });
                                    
                                    $('#accordion1').on('show.bs.collapse', function () {
                                        if (active) $('#accordion1 .in').collapse('hide');
                                    });

                                });
                                </script>
                                <br>
                                <div align="center">
                                    <button id="collapse-init" class="btn btn-info" data-toggle="collapse" data-parent="#accordion1">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              (+) Semua Lapak
                                            </a>
                                        </h4>
                                    </button>
                                </div>
                                <!-- <button id="collapse-init" class="btn btn-info">
                                    (+) Semua Lapak
                                </button> -->
                                <!-- <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#lapakTani, #lapakTernak, #lapakWisata, #lapakVilla, #lapakEdukasi">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Semua Lapak
                                        </a>
                                    </h4>
                                </button> -->

                                <div id="lapakTani" class="panel-collapse collapse showHide" align="center">
                                    <h4><label>Lapak Pertanian</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                          <tr>
                                            <th class="col-md-3">Judul Lapak</th>
                                            <th class="col-md-10">Deskripsi Lapak</th>
                                            <th class="col-md-2">Opsi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tanis as $tani)
                                          <tr>
                                            <td class="short">{{$tani->title}}</td>
                                            <td class="short">{{$tani->desc}}</td>
                                            <td><a href="/produkTani/{{$tani->id}}" class="btn btn-info" role="button">Detail</a></td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                      <hr>
                                </div>
                                
                                <div id="lapakTernak" class="panel-collapse collapse showHide" align="center">
                                    <h4><label>Lapak Hewan Ternak</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                          <tr>
                                            <th class="col-md-3">Judul Lapak</th>
                                            <th class="col-md-10">Deskripsi Lapak</th>
                                            <th class="col-md-2">Opsi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ternaks as $ternak)
                                          <tr>
                                            <td class="short">{{$ternak->title}}</td>
                                            <td class="short">{{$ternak->desc}}</td>
                                            <td><a href="/produkTernak/{{$ternak->id}}" class="btn btn-info" role="button">Detail</a></td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                      <hr>
                                </div>

                                <div id="lapakWisata" class="panel-collapse collapse showHide" align="center">
                                    <h4><label>Lapak Pariwisata</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                          <tr>
                                            <th class="col-md-3">Judul Lapak</th>
                                            <th class="col-md-10">Deskripsi Lapak</th>
                                            <th class="col-md-2">Opsi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wisatas as $wisata)
                                          <tr>
                                            <td class="short">{{$wisata->title}}</td>
                                            <td class="short">{{$wisata->desc}}</td>
                                            <td><a href="/produkWisata/{{$wisata->id}}" class="btn btn-info" role="button">Detail</a></td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                      <hr>
                                </div>

                                <div id="lapakVilla" class="panel-collapse collapse showHide" align="center">
                                    <h4><label>Lapak Persewaan Villa</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                          <tr>
                                            <th class="col-md-3">Judul Lapak</th>
                                            <th class="col-md-10">Deskripsi Lapak</th>
                                            <th class="col-md-2">Opsi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($villas as $villa)
                                          <tr>
                                            <td class="short">{{$villa->title}}</td>
                                            <td class="short">{{$villa->desc}}</td>
                                            <td><a href="/produkVilla/{{$villa->id}}" class="btn btn-info" role="button">Detail</a></td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                      <hr>
                                </div>

                                <div id="lapakEdukasi" class="panel-collapse collapse showHide" align="center">
                                    <h4><label>Lapak Edukasi Tani</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                          <tr>
                                            <th class="col-md-3">Judul Lapak</th>
                                            <th class="col-md-10">Deskripsi Lapak</th>
                                            <th class="col-md-2">Opsi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($edukasis as $edukasi)
                                          <tr>
                                            <td class="short">{{$edukasi->title}}</td>
                                            <td class="short">{{$edukasi->desc}}</td>
                                            <td><a href="/produkEdukasi/{{$edukasi->id}}" class="btn btn-info" role="button">Detail</a></td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop