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
                            
                        <div id="accordion1">
                            <div class="panel">
                                <div align="center">
                                    <button class="btn btn-info clickable" style="width:100%" data-toggle="collapse" data-parent="#accordion1" data-target="#listCategory">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              List Category
                                            </a>
                                        </h4>
                                    </button>
                                </div>
                                <div align="center">
                                    <button class="btn btn-info clickable" style="width:100%" data-toggle="collapse" data-parent="#accordion1" data-target="#createCategory">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Create Category
                                            </a>
                                        </h4>
                                    </button>
                                </div>
                            </div>
                        </div> 
                        
                    </div>
                    <div class="col-md-9">
                        <!-- <h3 align="center"><label>Lapak Terdaftar</label></h3> -->
                        <div id="accordion1">
                            <div class="panel">
                                <div align="center">
                                    
                                    <div id="listCategory" class="panel-collapse collapse showHide" align="center">
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

                                    <div id="createCategory" class="panel-collapse collapse showHide" align="center">
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
                                    </div>

                                </div>
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
