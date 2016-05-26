@extends('templates\master')

@section('konten')

<!-- ==========================
        BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h2>C-Bodas</h2>
                    <p>Home</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="homepage.html">Halaman Admin</a></li>
                        <li class="active">Admin Home</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END 
    =========================== -->
    
    <!-- ==========================
        ACCOUNT - START 
    =========================== -->
    <section class="content account">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Halaman Admin</div>
                    <div class="panel-body">
                        <div>
                        @foreach($profiles as $profile)

                                <div class="col-md-4" align="center">
                                    
                                    <a href="/AdminProfile/{{$profile->id}}" class="btn btn-info" role="button">Lihat Profil</a>
                                </div>

                                <div class="col-md-7">
                                    <div class="form-group">
                                        {{$profile->name}}
                                    </div>

                                    <div class="form-group">
                                        {{$profile->phone}}
                                    </div>

                                    <div class="form-group">
                                        {{$profile->street}}
                                    </div>
                                    
                                    <div class="form-group">
                                        {{$profile->city}}
                                    </div>

                                    <div class="form-group">
                                        {{$profile->province}}
                                    </div>

                                    <div class="form-group">
                                        {{$profile->zip_code}}
                                    </div>
                                </div>
                            @endforeach
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
                        
                        <h4 align="center"><label>Category</label></h4>
                            
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listCategory">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          List Category
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <!-- </div>

                        <div class="panel-group" id="accordion"> -->
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listLapak">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          List Lapak
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-9">
                        
                            <div align="center">
                                <div id="listCategory" class="panel-collapse collapse" align="center">
                                    <h4><label>List Category</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <thead>
                                          <tr>
                                            <th class="col-md-3">ID</th>
                                            <th class="col-md-10">Name Category</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category as $category)
                                          <tr>
                                            <td class="short">{{$category->id}}</td>
                                            <td class="short">{{$category->category_name}}</td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                      <hr>
                                </div>

                                <!-- <div id="createCategory" class="panel-collapse collapse showHide" align="center">
                                    <h4><label>Create Category</label></h4>
                                      <table class="table table-hover" style="table-layout: fixed;">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/createCategory') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="text" name="category_name">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">Submit</button>
                                        </form>
                                        </tbody>
                                      </table>
                                      <hr>
                                </div> -->
                                <div id="listLapak" class="panel-collapse collapse" align="center">
                                    <h4><label>List Lapak</label></h4>
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

                                                    <button id="collapse-init" class="btn btn-info" data-toggle="collapse" data-parent="#accordion1">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle">
                                                              Semua Lapak
                                                            </a>
                                                        </h4>
                                                    </button>
                                                </div>

                                                
                                                <br>
                                                    <div id="lapakTani" class="panel-collapse collapse showHideLapak" align="center">
                                                    <h4><label>Lapak Pertanian</label></h4>
                                                      <table class="table table-hover" style="table-layout: fixed;">
                                                        <thead>
                                                          <tr>
                                                            <th class="col-md-1">ID</th>
                                                            <th class="col-md-3">Judul Lapak</th>
                                                            <th class="col-md-10">Deskripsi Lapak</th>
                                                            <!-- <th class="col-md-3">Kategori</th> -->
                                                            <th class="col-md-2">Opsi</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php $i=1; ?>
                                                            @foreach($lapaks as $lapak)
                                                                @if(($lapak->category_id)==1)
                                                                  <tr>
                                                                    <td class="short">{{$lapak->id}}</td>
                                                                    <td class="short">{{$lapak->name}}</td>
                                                                    <td class="short">{{$lapak->description}}</td>
                                                                    <!-- <td class="short">{{$lapak->category_name}}</td> -->
                                                                    <td><a href="/Lapak/{{$lapak->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                                  </tr>
                                                              <?php $i++; ?>
                                                              @endif
                                                            @endforeach
                                                        </tbody>
                                                      </table>
                                                      <hr>
                                                    </div>

                                                    <div id="lapakTernak" class="panel-collapse collapse showHideLapak" align="center">
                                                    <h4><label>Lapak Hewan Ternak</label></h4>
                                                      <table class="table table-hover" style="table-layout: fixed;">
                                                        <thead>
                                                          <tr>
                                                            <th class="col-md-1">ID</th>
                                                            <th class="col-md-3">Judul Lapak</th>
                                                            <th class="col-md-10">Deskripsi Lapak</th>
                                                            <!-- <th class="col-md-3">Kategori</th> -->
                                                            <th class="col-md-2">Opsi</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php $i=1; ?>
                                                            @foreach($lapaks as $lapak)
                                                                @if(($lapak->category_id)==2)
                                                                  <tr>
                                                                    <td class="short">{{$lapak->id}}</td>
                                                                    <td class="short">{{$lapak->name}}</td>
                                                                    <td class="short">{{$lapak->description}}</td>
                                                                    <!-- <td class="short">{{$lapak->category_name}}</td> -->
                                                                    <td><a href="/Lapak/{{$lapak->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                                  </tr>
                                                              <?php $i++; ?>
                                                              @endif
                                                            @endforeach
                                                        </tbody>
                                                      </table>
                                                      <hr>
                                                    </div>

                                                    <div id="lapakWisata" class="panel-collapse collapse showHideLapak" align="center">
                                                    <h4><label>Lapak Pariwisata</label></h4>
                                                      <table class="table table-hover" style="table-layout: fixed;">
                                                        <thead>
                                                          <tr>
                                                            <th class="col-md-1">ID</th>
                                                            <th class="col-md-3">Judul Lapak</th>
                                                            <th class="col-md-10">Deskripsi Lapak</th>
                                                            <!-- <th class="col-md-3">Kategori</th> -->
                                                            <th class="col-md-2">Opsi</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php $i=1; ?>
                                                            @foreach($lapaks as $lapak)
                                                                @if(($lapak->category_id)==3)
                                                                  <tr>
                                                                    <td class="short">{{$lapak->id}}</td>
                                                                    <td class="short">{{$lapak->name}}</td>
                                                                    <td class="short">{{$lapak->description}}</td>
                                                                    <!-- <td class="short">{{$lapak->category_name}}</td> -->
                                                                    <td><a href="/Lapak/{{$lapak->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                                  </tr>
                                                              <?php $i++; ?>
                                                              @endif
                                                            @endforeach
                                                        </tbody>
                                                      </table>
                                                      <hr>
                                                    </div>
                                            </div>
                                        </div>
                                      <hr>
                                </div>
                            </div>
                        

                    </div>
            </div>
        </div>
    </div>
        
    </div>

    
    </div>
    </section>
    <!-- ==========================
        ACCOUNT - END 
    =========================== -->

@stop
