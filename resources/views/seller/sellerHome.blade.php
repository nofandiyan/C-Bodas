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
                    <p>Seller Home</p>
                </div>
                <div class="col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="homepage.html">Halaman Seller</a></li>
                        <li class="active">Seller Home</li>
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
                    
                    <div class="panel-body">
                        <div><h2><label>Selamat Datang <font color="E87169">{{$profile->name}}</font></label></h2></div>
                                                
                        {!! csrf_field() !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        
                            <a href="/SellerProfile/{{$profile->id}}" class="btn btn-info" role="button">Lihat Profil</a>
                        
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div align="center"><h2><label><font color="E87169">Manage Page</font></label></h2></div>
                        <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                        <div class="col-md-3">
                            
                            <h4 align="center"><label>Daftar Produk Yuk!</label></h4>
                                
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Produk Pertanian
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse" align="center">
                                        <div class="panel-body">Produk Pertanian merupakan produk hasil bumi dari kawasan Cibodas
                                        </div>
                                        <div class="panel-body">
                                            <a href="{{ url('createTani') }}" class="btn btn-warning btn-sm">Daftar Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Produk Hewan Ternak
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse" align="center">
                                        <div class="panel-body">Produk Hewan Ternak merupakan produk hewan ternak dari kawasan Cibodas
                                        </div>
                                        <div class="panel-body">
                                            <a href="{{ url('createTernak') }}" class="btn btn-warning btn-sm">Daftar Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              Produk Pariwisata
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse" align="center">
                                        <div class="panel-body">
                                            Produk Pariwisata merupakan produk penjualan tiket pariwisata yang ada di kawasan Cibodas
                                        </div>
                                        <div class="panel-body">
                                            <a href="{{ url('createWisata') }}" class="btn btn-warning btn-sm">Buat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 align="center"><label>Order</label></h4>
                                <div class="panel panel-default">
                                    <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrder">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle">
                                              List Order
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div> 

                            
                            
                        </div>
                        <div class="col-md-9">
                            <h3 align="center"><label>Produk Terdaftar</label></h3>
                            <div id="accordion1">
                                <div class="panel">
                                    <div align="center">
                                        <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#productTani">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle">
                                                  Pertanian
                                                </a>
                                            </h4>
                                        </button>
                                        
                                        <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#productTernak">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle">
                                                  Hewan Ternak
                                                </a>
                                            </h4>
                                        </button>

                                        <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordion1" data-target="#productWisata">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle">
                                                  Pariwisata
                                                </a>
                                            </h4>
                                        </button>

                                        <button id="collapse-init" class="btn btn-info" data-toggle="collapse" data-parent="#accordion1">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle">
                                                  Semua Produk
                                                </a>
                                            </h4>
                                        </button>
                                    </div>

                                    
                                    <br>
                                    
                                        <div id="productTani" class="panel-collapse collapse showHideProduct" align="center">
                                        <h4><label>Produk Pertanian</label></h4>
                                          <table class="table table-hover" style="table-layout: fixed;">
                                            <thead>
                                              <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-3">Nama Produk</th>
                                                <th class="col-md-10">Keterangan Produk</th>
                                                <th class="col-md-2">Opsi</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                            <?php $i=1; ?>
                                                @foreach($products as $product)
                                                    @if(($product->category_id)==1)
                                                      <tr>
                                                        <td class="short">{{$product->id}}</td>
                                                        <td class="short">{{$product->name}}</td>
                                                        <td class="short">{{$product->description}}</td>
                                                        <td><a href="/Product/{{$product->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                      </tr>
                                                  <?php $i++; ?>
                                                  @endif
                                                @endforeach
                                            </tbody>
                                          </table>
                                          <hr>
                                        </div>

                                        <div id="productTernak" class="panel-collapse collapse showHideProduct" align="center">
                                        <h4><label>Produk Hewan Ternak</label></h4>
                                          <table class="table table-hover" style="table-layout: fixed;">
                                            <thead>
                                              <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-3">Nama Produk</th>
                                                <th class="col-md-10">Keterangan Produk</th>
                                                <th class="col-md-2">Opsi</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                            <?php $i=1; ?>
                                                @foreach($products as $product)
                                                    @if(($product->category_id)==2)
                                                      <tr>
                                                        <td class="short">{{$product->id}}</td>
                                                        <td class="short">{{$product->name}}</td>
                                                        <td class="short">{{$product->description}}</td>
                                                        
                                                        <td><a href="/Product/{{$product->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                      </tr>
                                                  <?php $i++; ?>
                                                  @endif
                                                @endforeach
                                            </tbody>
                                          </table>
                                          <hr>
                                        </div>

                                        <div id="productWisata" class="panel-collapse collapse showHideProduct" align="center">
                                        <h4><label>Produk Pariwisata</label></h4>
                                          <table class="table table-hover" style="table-layout: fixed;">
                                            <thead>
                                              <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-3">Nama Produk</th>
                                                <th class="col-md-10">Keterangan Produk</th>
                                                <th class="col-md-2">Opsi</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                            <?php $i=1; ?>
                                                @foreach($products as $product)
                                                    @if(($product->category_id)==3)
                                                      <tr>
                                                        <td class="short">{{$product->id}}</td>
                                                        <td class="short">{{$product->name}}</td>
                                                        <td class="short">{{$product->description}}</td>
                                                        
                                                        <td><a href="/Product/{{$product->id}}" class="btn btn-info" role="button">Detail</a></td>
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

                            <div id="accordion2">
                                <div class="panel">
                                    <div align="center">                                   
                                    <br>
                                    
                                        <div id="listOrder" class="panel-collapse collapse" align="center">
                                        <h4><label>List Pesanan</label></h4>
                                          <table class="table table-hover" style="table-layout: fixed;">
                                            <thead>
                                              <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-1">ID Product</th>
                                                <th class="col-md-3">Nama Produk</th>
                                                <th class="col-md-2">Status</th>
                                                <th class="col-md-2">Tanggal Pemesanan</th>
                                                <th class="col-md-2">Opsi</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                            @if($profile->id == Auth::user()->id)
                                                @foreach($orders as $order)
                                                      <tr>
                                                        <td class="short">{{$order->reservation_id}}</td>
                                                        <td class="short">{{$order->detail_product_id}}</td>
                                                        <td class="short">{{$order->name}}</td>
                                                        <td class="short">{{$order->status}}</td>
                                                        <td class="short">{{$order->created_at}}</td>
                                                        
                                                        <td><a href="/Order/{{$order->reservation_id}}" class="btn btn-info" role="button">Detail</a></td>
                                                      </tr>
                                                @endforeach
                                            @endif
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
