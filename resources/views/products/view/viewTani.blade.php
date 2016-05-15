@extends('templates.master')

@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lapak Pertanian</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/produkTani/{{$tani->id}}">
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
                                            <img src="{{ url($tani->fotoTani1) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($tani->fotoTani1) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($tani->fotoTani2) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($tani->fotoTani2) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($tani->fotoTani3) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($tani->fotoTani3) }}" class="img-thumbnail" height="100" width="100">
                                    </label>

                                    <label>
                                        <input type="radio" name="full-image">
                                        <div class="full-image">
                                            <img src="{{ url($tani->fotoTani4) }}" class="img-thumbnail" height="300" width="300" >
                                            <!-- <div class="description">Description 1.</div> -->
                                        </div>
                                        <img src="{{ url($tani->fotoTani4) }}" class="img-thumbnail" height="100" width="100">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Judul Lapak</label>
                                    <div class="col-md-9">
                                        {{ $tani->title }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Deskripsi Lapak</label>
                                    <div class="col-md-9">
                                        {{ $tani->desc }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Jumlah Stok</label>
                                    <div class="col-md-9">
                                        {{ $tani->stock }} {{ $tani->massStock }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-3" align="right">Harga Jual</label>
                                    <div class="col-md-9">
                                        {{ $tani->price }} / {{ $tani->massSell}}
                                    </div>
                                </div>
                                @if(Auth::user()->userAs == 1)
                                <div class="col-md-7">
                                    <div class="col-md-3" align="right">
                                        <a href="/produkTani/{{$tani->id}}/edit" class="btn btn-primary" role="button">Edit Lapak</a>
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
