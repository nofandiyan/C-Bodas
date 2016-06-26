@extends('templates\master',['url'=>'barang','link'=>'barang'])

@section('konten')

    <!-- ==========================
    	BREADCRUMB - START 
        =========================== -->
        <section class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <h2>C-Bodas</h2>
                        <p>Cart</p>
                    </div>
                    <div class="col-xs-6">
                        <ol class="breadcrumb">
                            <li><a href="/">Home</a></li>
                            <li class="active">Cart</li>
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
                        <article class="account-content">

                            <div class="products-order shopping-cart">
                            	<div class="table-responsive">
                                    <table class="table table-products">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga Unit</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                                <th>Remove</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $total=0;
                                            ?>

                                            @foreach ($cart as $c)

                                            <tr>
                                                <form action="{{action('CartController@removeItem')}}" method="post">
                                                    <?php $i=$i+1; ?>
                                                    <input type="hidden" name="name" value="<?php echo $c['name']; ?>">
                                                    <input type="hidden" name="detailproductid" value="<?php echo $c['detail_product_id']; ?>">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" id="harga<?php echo $i; ?>" onkeyup="multiplyBy(<?php echo $i; ?>)" name="price" value="<?php echo $c['price']; ?>">
                                                    <input type="hidden" id="category_id<?php echo $i; ?>" onkeyup="multiplyBy(<?php echo $i; ?>)" name="category_id" value="<?php echo $c['category_id']; ?>">

                                                    <td class="col-xs-4 col-md-5 text-center"><h4><?php echo $c['name']; ?></h4></td>

                                                    <td class="col-xs-2 text-center"><span>Rp <?php echo $c['price']; ?></span></td>
                                                    @if($c['category_id'] == 1)
                                                    <td class="col-xs-2 col-md-1"><div class="form-group"> <input type="number" id="jumlah<?php echo $i; ?>" onkeyup="multiplyBy(<?php echo $i; ?>)" min="5" class="form-control" name="jumlah" value="<?php echo $c['jumlah']; ?>">


                                                    @elseif($c['category_id'] == 2)
                                                    <td class="col-xs-2 col-md-1"><div class="form-group"> <input type="number" id="jumlah<?php echo $i; ?>" onkeyup="multiplyBy(<?php echo $i; ?>)" min="1" class="form-control" name="jumlah" value="<?php echo $c['jumlah']; ?>">


                                                    @elseif($c['category_id'] == 3)
                                                    <td class="col-xs-2 col-md-1"><div class="form-group"> <input type="number" id="jumlah<?php echo $i; ?>" onkeyup="multiplyBy(<?php echo $i; ?>)" min="1" class="form-control" name="jumlah" value="<?php echo $c['jumlah']; ?>">
                                                    @endif

                                                    <?php 
                                                    $subtotal = $c['jumlah']*$c['price'];
                                                    $total += $subtotal;
                                                    ?>
                                                    <td class="col-xs-2 text-center"><span>Rp </span><span id="result<?php echo $i; ?>" class="total_harga_item"><?php echo $subtotal;?></span></td>


                                                    <td class="col-xs-1 text-center"><input type="submit" class="btn btn-primary btn-sm add-to-cart" value="Hapus"></td>
                                                </form>
                                            </tr>

                                                    @endforeach

                                            </tbody>
                                            </table>
                                            </div>
                                            <a href="{{ url('/') }}" class="btn btn-inverse">Continue Shopping</a>

                                        </div>

                                        <div class="box">
                                            <div class="row">
                                                <div class="col-sm-6">

                                                </div>
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <ul class="list-unstyled order-total">


                                                        <li>Total Harga<span>Rp </span><span id="total"><?php echo $total ?></span></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <a href="checkout" class="btn btn-primary btn-lg pull-right ">Checkout</a>
                                        </div>

                                    </article>
                                </div>
                            </div> 
                        </div>
                    </section>
    <!-- ==========================
    	MY ACCOUNT - END 
        =========================== -->
        
        <script type="text/javascript">

            function multiplyBy(id)
            {

                harga = document.getElementById("harga"+id).value;
                jumlah = document.getElementById("jumlah"+id).value;
                category_id = document.getElementById("category_id"+id).value;
                subtotal=harga*jumlah;

                document.getElementById("result"+id).innerHTML = subtotal;
       /*alur
       total=subtotal1+subtotal2+subtotal3 dst*/


       var total = document.getElementsByClassName("total_harga_item");
       var totalHarga = 0;
       for(var i=0;i<total.length;i++){
        totalHarga += parseInt(total[i].innerHTML);
    }

    document.getElementById("total").innerHTML = totalHarga;

}
function alert1(){
    alert("Jumlah Minimal 1");
}
function alert5(){
    alert("Jumlah Minimal 5");
}


</script>    
@stop

