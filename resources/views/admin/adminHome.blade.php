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
                    <p>Admin Home</p>
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
                    <!-- <div class="panel-heading">Halaman Admin</div> -->
                    <div class="panel-body">
                        <h3>Selamat Bertugas <font color="E87169">{{$profiles->name}}</font></h3>
                        <br>
                        <a href="/AdminProfile/{{$profiles->id}}" class="btn btn-info" role="button">Lihat Profil</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            <br>
                <div  align="center"><h2><label><font color="E87169">Overview</font></label></h2></div>
                <hr style="height:3px;border:none;color:#777777;background-color:#777777;" />
                <div class="panel-body">
                    <div class="col-md-3">
                        
                        <!-- <h4 align="center"><label>Category</label></h4> -->
                            
                        <div class="panel-group" id="accordion">
                            
                            <h4 align="center"><label>User</label></h4>
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listUser">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          List User
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <br>
                            <h4 align="center"><label>Produk</label></h4>
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listCategory">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          List Category
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listProduct">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          List Product
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <br>
                            <h4 align="center"><label>Order</label></h4>
                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrder">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Order Request
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrderValid">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Order Valid
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrderInvalid">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Order Invalid
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrderShipping">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Order Shipping
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrderShipped">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Order Shipped
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <!-- <div class="panel panel-default">
                                <div class="panel-heading clickable" data-toggle="collapse" data-parent="#accordion" data-target="#listOrderClosed">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle">
                                          Order Closed
                                        </a>
                                    </h4>
                                </div>
                            </div> -->
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
                                <div id="listProduct" class="panel-collapse collapse" align="center">
                                    <h4><label>List Product</label></h4>
                                        <div id="accordion1">
                                            <div class="panel">
                                                <div align="center">
                                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordionProduct" data-target="#productTani">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle">
                                                              Pertanian
                                                            </a>
                                                        </h4>
                                                    </button>
                                                    
                                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordionProduct" data-target="#productTernak">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle">
                                                              Hewan Ternak
                                                            </a>
                                                        </h4>
                                                    </button>

                                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordionProduct" data-target="#productWisata">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle">
                                                              Pariwisata
                                                            </a>
                                                        </h4>
                                                    </button>

                                                    <button id="collapse-init" class="btn btn-info" data-toggle="collapse" data-parent="#accordionProduct">
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
                                                            <th class="col-md-3">Judul Produk</th>
                                                            <th class="col-md-4">Deskripsi Produk</th>
                                                            <th class="col-md-2">Seller ID</th>
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
                                                                    <td class="short">{{$product->seller_id}}</td>
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
                                                            <th class="col-md-3">Judul Produk</th>
                                                            <th class="col-md-4">Deskripsi Produk</th>
                                                            <th class="col-md-2">Seller ID</th>
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
                                                                    <td class="short">{{$product->seller_id}}</td>
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
                                                            <th class="col-md-3">Judul Produk</th>
                                                            <th class="col-md-4">Deskripsi Produk</th>
                                                            <th class="col-md-2">Seller ID</th>
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
                                                                    <td class="short">{{$product->seller_id}}</td>
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
                                      <hr>
                                </div>
<!-- ------------------------------------------------------------------------- -->
                                <div id="listUser" class="panel-collapse collapse" align="center">
                                    <h4><label>List User</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <div align="center">
                                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordionUser" data-target="#listSeller">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle">
                                                              Seller
                                                            </a>
                                                        </h4>
                                                    </button>
                                                    
                                                    <button class="btn btn-info clickable" data-toggle="collapse" data-parent="#accordionUser" data-target="#listCustomer">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle">
                                                              Customer
                                                            </a>
                                                        </h4>
                                                    </button>
                                                </div>

                                                <br>
                                                    <div id="listSeller" class="panel-collapse collapse showHideLapak" align="center">
                                                    <h4><label>List Seller</label></h4>
                                                      <table class="table table-hover" style="table-layout: fixed;">
                                                        <thead>
                                                          <tr>
                                                            <th class="col-md-1">ID User</th>
                                                            <th class="col-md-4">Name</th>
                                                            <th class="col-md-2">Opsi</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php $i=1; ?>
                                                            @foreach($sellers as $seller)
                                                                @if(($seller->role)=='seller')
                                                                  <tr>
                                                                    <td class="short">{{$seller->id}}</td>
                                                                    <td class="short">{{$seller->name}}</td>
                                                                    <td><a href="viewSellerProfile/{{$seller->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                                  </tr>
                                                              <?php $i++; ?>
                                                              @endif
                                                            @endforeach
                                                        </tbody>
                                                      </table>
                                                      <hr>
                                                    </div>

                                                    <div id="listCustomer" class="panel-collapse collapse showHideLapak" align="center">
                                                    <h4><label>List Customer</label></h4>
                                                      <table class="table table-hover" style="table-layout: fixed;">
                                                        <thead>
                                                          <tr>
                                                             <th class="col-md-1">ID User</th>
                                                            <th class="col-md-4">Name</th>
                                                            <th class="col-md-2">Opsi</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php $i=1; ?>
                                                            @foreach($customers as $customer)
                                                                @if(($customer->role)=='customer')
                                                                  <tr>
                                                                    <td class="short">{{$customer->id}}</td>
                                                                    <td class="short">{{$customer->name}}</td>
                                                                    <td><a href="viewCustomerProfile/{{$customer->id}}" class="btn btn-info" role="button">Detail</a></td>
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

                                <div id="listOrder" class="panel-collapse collapse" align="center">
                                    <h4><label>List Order Request</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <br>
                                                  <table class="table table-hover" style="table-layout: fixed;">
                                                    <thead>
                                                      <tr>
                                                        <th class="col-md-1">Resv. ID</th>
                                                        <th class="col-md-1">Cust. ID</th>
                                                        <th class="col-md-3">Cust. Name</th>
                                                        <th class="col-md-2">Total Biaya</th>
                                                        <th class="col-md-3">Tanggal Pemeesanan</th>
                                                        <th class="col-md-2">Opsi</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                              <tr>
                                                                <td class="short" align="center">{{$order->resv->id}}</td>
                                                                <td class="short" align="center">{{$order->resv->customer_id}}</td>
                                                                <td class="short">{{$order->resv->name}}</td>
                                                                <td class="short">{{$order->totPrice}}</td>
                                                                <td class="short">{{$order->resv->created_at}}</td>
                                                                <td><a href="OrderAdmin/{{$order->resv->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                              </tr>

                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                  <hr>
                                            </div>
                                        </div>
                                      <hr>
                                </div>

                                <div id="listOrderValid" class="panel-collapse collapse" align="center">
                                    <h4><label>List Order Valid</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <br>
                                                  <table class="table table-hover" style="table-layout: fixed;">
                                                    <thead>
                                                      <tr>
                                                        <th class="col-md-1">Resv. ID</th>
                                                        <th class="col-md-1">Cust. ID</th>
                                                        <th class="col-md-3">Cust. Name</th>
                                                        <th class="col-md-2">Total Biaya</th>
                                                        <th class="col-md-3">Tanggal Pemeesanan</th>
                                                        <th class="col-md-2">Opsi</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderValid as $order)
                                                              <tr>
                                                                <td class="short" align="center">{{$order->resv->id}}</td>
                                                                <td class="short" align="center">{{$order->resv->customer_id}}</td>
                                                                <td class="short">{{$order->resv->name}}</td>
                                                                <td class="short">{{$order->totPrice}}</td>
                                                                <td class="short">{{$order->resv->created_at}}</td>
                                                                <td><a href="OrderValid/{{$order->resv->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                              </tr>

                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                  <hr>
                                            </div>
                                        </div>
                                      <hr>
                                </div>

                                <div id="listOrderInvalid" class="panel-collapse collapse" align="center">
                                    <h4><label>List Order Invalid</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <br>
                                                  <table class="table table-hover" style="table-layout: fixed;">
                                                    <thead>
                                                      <tr>
                                                        <th class="col-md-1">Resv. ID</th>
                                                        <th class="col-md-1">Cust. ID</th>
                                                        <th class="col-md-3">Cust. Name</th>
                                                        <th class="col-md-2">Total Biaya</th>
                                                        <th class="col-md-3">Tanggal Pemeesanan</th>
                                                        <th class="col-md-2">Opsi</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderInvalid as $order)
                                                              <tr>
                                                                <td class="short" align="center">{{$order->resv->id}}</td>
                                                                <td class="short" align="center">{{$order->resv->customer_id}}</td>
                                                                <td class="short">{{$order->resv->name}}</td>
                                                                <td class="short">{{$order->totPrice}}</td>
                                                                <td class="short">{{$order->resv->created_at}}</td>
                                                                <td><a href="OrderInvalid/{{$order->resv->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                              </tr>

                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                  <hr>
                                            </div>
                                        </div>
                                      <hr>
                                </div>

                                <div id="listOrderShipping" class="panel-collapse collapse" align="center">
                                    <h4><label>List Order Di Kirim</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <br>
                                                  <table class="table table-hover" style="table-layout: fixed;">
                                                    <thead>
                                                      <tr>
                                                        <th class="col-md-1">Kode Pemesanan</th>
                                                        <th class="col-md-1">Cust. ID</th>
                                                        <th class="col-md-3">Cust. Name</th>
                                                        <th class="col-md-2">Opsi</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderAdminShipping as $ordShip)
                                                            <tr>
                                                                <td class="short" align="center">{{$ordShip->reservation_id}}</td>
                                                                <td class="short" align="center">{{$ordShip->cust->custId}}</td>
                                                                <td class="short" align="center">{{$ordShip->cust->custName}}</td>
                                                                 <td><a href="OrderAdminShipping/{{$ordShip->reservation_id}}" class="btn btn-info" role="button">Detail</a></td>
                                                              </tr>
                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                  <hr>
                                            </div>
                                        </div>
                                    <hr>
                                </div>

                                <div id="listOrderShipped" class="panel-collapse collapse" align="center">
                                    <h4><label>List Order Terkirim</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <br>
                                                  <table class="table table-hover" style="table-layout: fixed;">
                                                    <thead>
                                                      <tr>
                                                        <th class="col-md-1">Kode Pemesanan</th>
                                                        <th class="col-md-1">Cust. ID</th>
                                                        <th class="col-md-3">Cust. Name</th>
                                                        <th class="col-md-2">Opsi</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderAdminShipped as $ordShip)
                                                            <tr>
                                                                <td class="short" align="center">{{$ordShip->reservation_id}}</td>
                                                                <td class="short" align="center">{{$ordShip->cust->custId}}</td>
                                                                <td class="short" align="center">{{$ordShip->cust->custName}}</td>
                                                                
                                                                 <td><a href="OrderShipped/{{$ordShip->reservation_id}}" class="btn btn-info" role="button">Detail</a></td>
                                                              </tr>
                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                  <hr>
                                            </div>
                                        </div>
                                    <hr>
                                </div>

                                <div id="listOrderClosed" class="panel-collapse collapse" align="center">
                                    <h4><label>List Order Closed</label></h4>
                                        <div id="accordionUser">
                                            <div class="panel">
                                                <br>
                                                  <table class="table table-hover" style="table-layout: fixed;">
                                                    <thead>
                                                      <tr>
                                                        <th class="col-md-1">Resv. ID</th>
                                                        <th class="col-md-1">Cust. ID</th>
                                                        <th class="col-md-3">Cust. Name</th>
                                                        <th class="col-md-2">Total Biaya</th>
                                                        <th class="col-md-3">Tanggal Pemesanan</th>
                                                        <th class="col-md-2">Opsi</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderClosed as $order)
                                                              <tr>
                                                                <td class="short" align="center">{{$order->resv->id}}</td>
                                                                <td class="short" align="center">{{$order->resv->customer_id}}</td>
                                                                <td class="short">{{$order->resv->name}}</td>
                                                                <td class="short">{{$order->totPrice}}</td>
                                                                <td class="short">{{$order->resv->created_at}}</td>
                                                                <td><a href="OrderClosed/{{$order->resv->id}}" class="btn btn-info" role="button">Detail</a></td>
                                                              </tr>

                                                        @endforeach
                                                    </tbody>
                                                  </table>
                                                  <hr>
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
