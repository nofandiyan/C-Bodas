@extends('templates.master')

@section('konten')
               

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Hewan Ternak</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/produkTernak/{{$ternak->id}}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name='idMerchant' value="{{Auth::user()->id}}">

                        <div class="col-md-5">
                            <div class="wrapper">
                                <div class="full-image"></div>
                                <div class="thumbnails">
                                    <label>
                                        <input type="radio" name="full-image" checked>
                                        <div class="full-image">
                                            <img src="{{ url($ternak->fotoTernak1) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($ternak->fotoTernak1) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($ternak->fotoTernak2) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($ternak->fotoTernak2) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($ternak->fotoTernak3) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($ternak->fotoTernak3) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($ternak->fotoTernak4) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($ternak->fotoTernak4) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Judul Lapak</label>
                                    <div class="col-md-9">
                                        {{ $ternak->title }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Deskripsi Lapak</label>
                                    <div class="col-md-9">
                                        {{ $ternak->desc }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Usia</label>
                                    <div class="col-md-9">
                                        {{ $ternak->year }} Tahun {{ $ternak->month }} Bulan {{ $ternak->day }} Hari
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                        <?php 
                                        if ($ternak->gender=='L') {
                                            echo "Laki-laki";
                                        } elseif ($ternak->gender=='P') {
                                            echo "Perempuan";
                                        }?>
                                        
                                        <!-- {{ $ternak->gender }} -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Berat</label>
                                    <div class="col-md-9">
                                        {{ $ternak->weight }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Harga</label>
                                    <div class="col-md-9">
                                        {{ $ternak->price }}
                                    </div>
                                </div>
                                @if(Auth::user()->userAs == 1)
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="/produkTernak/{{$ternak->id}}/edit" class="btn btn-primary" role="button">Edit Lapak</a>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="/" class="btn btn-primary" role="button">Kembali</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop