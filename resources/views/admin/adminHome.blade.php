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

<script type="text/javascript">
    $(function () {

        var active = true;

        $('#collapse-init').click(function () {
            if (active) {
                active = false;
                $('.showHideUser').collapse('show');
                // $('.panel-title').attr('data-toggle', '');
                $(this).text('Semua User');
            } else {
                active = true;
                $('.showHideUser').collapse('hide');
                // $('.panel-title').attr('data-toggle', 'collapse');
                $(this).text('Semua User');
            }
        });
        
        $('#accordion').on('show.bs.collapse', function () {
            if (active) $('#accordion .in').collapse('hide');
        });

    });

    $(function () {

        var active = true;

        $('#collapse-init2').click(function () {
            if (active) {
                active = false;
                $('.showHideLapak').collapse('show');
                // $('.panel-title').attr('data-toggle', '');
                $(this).text('Semua Lapak');
            } else {
                active = true;
                $('.showHideLapak').collapse('hide');
                // $('.panel-title').attr('data-toggle', 'collapse');
                $(this).text('Semua Lapak');
            }
        });
        
        $('#accordion').on('show.bs.collapse', function () {
            if (active) $('#accordion .in').collapse('hide');
        });

    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Halaman Admin</div>
                <div class="panel-body">
                    <div>
                        <!-- <form class="form-horizontal" role="form" method="POST"> -->
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-md-4" align="center">
                                <img src="{{ url(Auth::user()->profPict) }}" class="img-thumbnail" height="250" width="250">
                                <br>
                                <a href="/adminProfile/{{Auth::user()->id}}" class="btn btn-info" role="button">Lihat Profil</a>
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
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Kelola</div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" href="#user">User</a>
                                        </h4>
                                    </div>
                                    <div id="user" class="panel-collapse collapse">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#penjual">Penjual</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#pembeli">Pembeli</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" id="collapse-init">Semua User</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" href="#Lapak">Lapak</a>
                                        </h4>
                                    </div>
                                    <div id="Lapak" class="panel-collapse collapse">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#tani">Lapak Pertanian</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#ternak">Lapak Hewan Ternak</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#wisata">Lapak Pariwisata</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#villa">Lapak Persewaan Villa</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#edukasi">Lapak Edukasi Pertanian</a>
                                                </h4>
                                            </div>
                                            <div class="panel-heading clickable">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" id="collapse-init2">Semua Lapak</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                        </div>
                        <div class="col-md-9">

                            <div id="penjual" class="panel-collapse collapse showHideUser" align="center">
                                <h4><label>Daftar Penjual</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>ID</th>
                                            <th>Nama Penjual</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>

                                        @foreach($sellers as $seller)
                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short">{{$seller->id}}</td>
                                            <td class="short">{{$seller->name}}</td>
                                            <!-- <td class="short"></td> -->
                                            <td>
                                                <a href="/sellerProfile/{{$seller->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/seller/{{$seller->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>

                            <div id="pembeli" class="panel-collapse collapse showHideUser" align="center">
                                <h4><label>Daftar Pembeli</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>ID</th>
                                            <th>Nama Penjual</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($buyers as $buyer)

                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short">{{$buyer->id}}</td>
                                            <td class="short">{{$buyer->name}}</td>
                                            <td>
                                                <a href="/buyerProfile/{{$buyer->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/buyer/{{$buyer->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>

<!-- -------------------------------------------------------------------------------------------------------------------- -->
                            <div id="tani" class="panel-collapse collapse showHideLapak" align="center">
                                <h4><label>Daftar Lapak Pertanian</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No.</th>
                                            <th class="col-md-1">ID Lapak</th>
                                            <th class="col-md-1">ID Seller</th>
                                            <th class="col-md-2">Judul Lapak</th>
                                            <th class="col-md-4">Deskripsi Lapak</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($tanis as $tani)

                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short" align="center">{{$tani->id}}</td>
                                            <td class="short" align="center">{{$tani->idMerchant}}</td>
                                            <td class="short">{{$tani->title}}</td>
                                            <td class="short">{{$tani->desc}}</td>
                                            <td>
                                                <a href="/produkTani/{{$tani->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/produkTani/{{$tani->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>

                            <div id="ternak" class="panel-collapse collapse showHideLapak" align="center">
                                <h4><label>Daftar Lapak Hewan Ternak</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No.</th>
                                            <th class="col-md-1">ID Lapak</th>
                                            <th class="col-md-1">ID Seller</th>
                                            <th class="col-md-2">Judul Lapak</th>
                                            <th class="col-md-4">Deskripsi Lapak</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($ternaks as $ternak)

                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short" align="center">{{$ternak->id}}</td>
                                            <td class="short" align="center">{{$ternak->idMerchant}}</td>
                                            <td class="short">{{$ternak->title}}</td>
                                            <td class="short">{{$ternak->desc}}</td>
                                            <td>
                                                <a href="/produkTani/{{$ternak->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/produkTernak/{{$ternak->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>

                            <div id="wisata" class="panel-collapse collapse showHideLapak" align="center">
                                <h4><label>Daftar Lapak Pariwisata</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No.</th>
                                            <th class="col-md-1">ID Lapak</th>
                                            <th class="col-md-1">ID Seller</th>
                                            <th class="col-md-2">Judul Lapak</th>
                                            <th class="col-md-4">Deskripsi Lapak</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($wisatas as $wisata)

                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short" align="center">{{$wisata->id}}</td>
                                            <td class="short" align="center">{{$wisata->idMerchant}}</td>
                                            <td class="short">{{$wisata->title}}</td>
                                            <td class="short">{{$wisata->desc}}</td>
                                            <td>
                                                <a href="/produkWisata/{{$wisata->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/produkWisata/{{$wisata->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>

                            <div id="villa" class="panel-collapse collapse showHideLapak" align="center">
                                <h4><label>Daftar Lapak Persewaan Villa</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No.</th>
                                            <th class="col-md-1">ID Lapak</th>
                                            <th class="col-md-1">ID Seller</th>
                                            <th class="col-md-2">Judul Lapak</th>
                                            <th class="col-md-4">Deskripsi Lapak</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($villas as $villa)

                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short" align="center">{{$villa->id}}</td>
                                            <td class="short" align="center">{{$villa->idMerchant}}</td>
                                            <td class="short">{{$villa->title}}</td>
                                            <td class="short">{{$villa->desc}}</td>
                                            <td>
                                                <a href="/produkVilla/{{$villa->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/produkVilla/{{$villa->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>

                            <div id="edukasi" class="panel-collapse collapse showHideLapak" align="center">
                                <h4><label>Daftar Lapak Edukasi Pertanian</label></h4>

                                <table class="table table-hover" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No.</th>
                                            <th class="col-md-1">ID Lapak</th>
                                            <th class="col-md-1">ID Seller</th>
                                            <th class="col-md-2">Judul Lapak</th>
                                            <th class="col-md-4">Deskripsi Lapak</th>
                                            <th colspan="2">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1 ?>
                                        @foreach($edukasis as $edukasi)

                                        <tr>
                                            <td class="short"><?php echo "$i"; ?></td>
                                            <td class="short" align="center">{{$edukasi->id}}</td>
                                            <td class="short" align="center">{{$edukasi->idMerchant}}</td>
                                            <td class="short">{{$edukasi->title}}</td>
                                            <td class="short">{{$edukasi->desc}}</td>
                                            <td>
                                                <a href="/produkEdukasi/{{$edukasi->id}}" class="btn btn-info" role="button">Detail</a>
                                            </td>
                                            <td>
                                                <form class="" action="/produkEdukasi/{{$edukasi->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" name="" value="delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
