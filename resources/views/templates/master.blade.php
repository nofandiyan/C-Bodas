<!DOCTYPE html>
<html>

<!-- Mirrored from demos.pixelized.cz/C-Bodas/v1.1/main/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2016 15:38:50 GMT -->
<head>
    <!-- ==========================
        Meta Tags 
    =========================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ==========================
        Title 
    =========================== -->
    <title>C-Bodas</title>
        
    <!-- ==========================
        Fonts 
    =========================== -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,900,800' rel='stylesheet' type='text/css'>

    <!-- ==========================
        CSS 
    =========================== -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dragtable.css" rel="stylesheet" type="text/css">
    <link href="assets/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="assets/css/color-switcher.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css">
    <link href="assets/css/color/red.css" id="main-color" rel="stylesheet" type="text/css"> -->

    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/dragtable.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/owl.carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/color-switcher.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/color/red.css') }}" id="main-color" rel="stylesheet" type="text/css">

    
    <link href="{{ URL::asset('assets/css/lightbox.css') }}" rel="stylesheet">
    
    <!-- ==========================
        JS 
    =========================== -->
    <!--        [if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  



    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

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

        function goBack() {
            window.history.back();
        }

        $(function () {

            var active = true;

            $('#collapse-init').click(function () {
                if (active) {
                    active = false;
                    $('.showHideProduct').collapse('show');
                    // $('.panel-title').attr('data-toggle', '');
                    $(this).text('Semua Produk');
                } else {
                    active = true;
                    $('.showHideProduct').collapse('hide');
                    // $('.panel-title').attr('data-toggle', 'collapse');
                    $(this).text('Semua Produk');
                }
            });
            
            $('#accordionProduct').on('show.bs.collapse', function () {
                if (active) $('#accordionProduct .in').collapse('hide');
            });

        });

//address
        function getIdProvince() {
            $(".kota:selected").removeAttr("selected");
            $("#kota-default").attr("selected", true);
            var provid =  document.getElementById("province").value;
            $(".kota").css("display", "none");
            $(".kota").attr("disabled", true);
            $("."+provid).css("display", "block");
            $("."+provid).attr("disabled", false);
        }
//input numeric
            function numeric(ob) {
              var invalidChars = /[^0-9]/gi
              if(invalidChars.test(ob.value)) {
                        ob.value = ob.value.replace(invalidChars,"");
                  }
            }
        
    </script>

    <style type="text/css">
        .wrapper {
            width: 700px;
            position: relative;
        }
        .wrapper .thumbnails {
            width: 150px;
            float: left;
            top: 0;
            left: 0;
        }
        .wrapper a {
            margin: 2px;
        }
        .wrapper img {
            border: 1px solid #000;
        }
        .wrapper label > img {
            opacity: 0.6;
        }
        .wrapper label > img:hover {
            opacity: 1;
        }
        .wrapper input {
            display: none;
        }
        .wrapper input:checked + .full-image {
            display: block;
        }
        .wrapper input:checked ~ img {
            opacity: 1;
        }
        .wrapper .full-image {
            display: none;
            position: absolute;
            top: 0;
            left: 125px;
        }
        .wrapper .description {
            width:95%;
            padding:5px;
            background-color:#DDDDDD;
        }
    </style>
    
</head>
<body>
    
    <!-- ==========================
        SCROLL TOP - START 
    =========================== -->
    <div id="scrolltop" class="hidden-xs"><i class="fa fa-angle-up"></i></div>
    <!-- ==========================
        SCROLL TOP - END 
    =========================== -->
    
    <div id="page-wrapper"> <!-- PAGE - START -->
    
    <!-- ==========================
        HEADER - START 
    =========================== -->
    <div class="top-header hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <ul class="list-inline contacts">
                        <li><i class="fa fa-envelope"></i> help@c-bodas.com</li>
                        <li><i class="fa fa-phone"></i> 022 6671806</li>
                    </ul>
                </div>
                @if (Auth::user())
                <div class="col-sm-7 text-right">
                    <ul class="list-inline links">
                        @if (Auth::user()->role=='admin')
                        <li><a href="/AdminProfile">Hai, {{Auth::user()->name}}</a></li>
                        @elseif (Auth::user()->role=='seller')
                        <li><a href="{{ url ('SellerProfile')}}">Hai, {{Auth::user()->name}}</a></li>
                        @elseif (Auth::user()->role=='customer')
                        <li><a href="/CustomerProfile">Hai, {{Auth::user()->name}}</a></li>
                        @endif
                        <li><a href="{{ url('/logout') }}">Keluar</a></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
    <header class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ url('/') }}" class="navbar-brand"><span>C-</span>Bodas</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
            </div>
            <div class="navbar-collapse collapse">
                <p class="navbar-text hidden-xs hidden-sm">Karena Waktu Sangat Berharga</p>
                
                
                <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())   
                    <li class="dropdown megamenu">
                        <a href="{{ url('/login') }}">Masuk</a>
                    </li>

                    <li class="dropdown megamenu">
                        <a href="signup">Daftar</a>
                    </li>

                @elseif(Auth::user())
                     <li class="dropdown megamenu">
                        <a href="/">Home</a>
                    </li>
                @endif    
                    <li class="dropdown navbar-cart hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true"><i class="fa fa-shopping-cart"></i></a>
                        <ul class="dropdown-menu">
                            
                            <!-- CART ITEM - START -->
                            <li>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="assets/images/products/product-1.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-sm-9">
                                        <h4><a href="single-product">Fusce Aliquam</a></h4>
                                        <p>1x - $20.00</p>
                                        <a href="#" class="remove"><i class="fa fa-times-circle"></i></a>
                                    </div>
                                </div>
                            </li>
                            
                            <!-- CART ITEM - END -->
                            
                        </ul>
                    </li>

                    <!-- Searching start -->



                    <li class="dropdown navbar-search hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                               
                                    <div class="input-group input-group-lg">
                                     {!! Form::open() !!}
                                        <input type="text" class="form-control" placeholder="Cari...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">Cari</button>
                                        </span>
                                    {!! Form::close() !!}
                                    </div>
                            </li>
                        </ul>
                    </li>



                    <!-- Searching end -->
                </ul>
            </div>
        </div>
    </header>
    <!-- ==========================
        HEADER - END 
    =========================== -->  
    



    @yield('konten')





     <!-- ==========================
        NEWSLETTER - START 
    =========================== -->
    <section class="separator separator-newsletter">
        <div class="container">
            
            <div class="newsletter-right">
                <div class="row">
                </div>
            </div>
        </div>
    </section>
    <!-- ==========================
        NEWSLETTER - END 
    =========================== -->
    
    <!-- ==========================
        FOOTER - START 
    =========================== -->
    <footer class="navbar navbar-default">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="footer-widget footer-widget-contacts">
                        <h4>Kontak</h4>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-envelope"></i> help@C-Bodas.com</li>
                            <li><i class="fa fa-phone"></i> 022 6671806</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="footer-widget footer-widget-links">
                        <h4>Informasi</h4>
                        <ul class="list-unstyled">
                            <li><a href="about-shop.html">Tentang Kami</a></li>
                            <li><a href="terms-conditions.html">Syarat & Ketentuan</a></li>
                            <li><a href="privacy-policy.html">Kebijakan Privasi</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="my-account.html">Akun Saya</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="copyright">© C-Bodas 2016 All right reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ==========================
        FOOTER - END 
    =========================== -->
    
    </div> <!-- PAGE - END -->

</body>

 <!-- ==========================
        JS 
    =========================== -->        
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=true"></script>

    <!-- <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/jquery.dragtable.js"></script>
    <script src="assets/js/jquery.card.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/twitterFetcher_min.js"></script>
    <script src="assets/js/jquery.mb.YTPlayer.min.js"></script>
    <script src="assets/js/color-switcher.js"></script>
    <script src="assets/js/custom.js"></script> -->

    
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/SmoothScroll.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/jquery.dragtable.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/jquery.card.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/owl.carousel.min.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/twitterFetcher_min.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/jquery.mb.YTPlayer.min.js') }}"></script>
    
    <script src="{{ URL::asset('assets/js/color-switcher.js') }}"></script>

    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

    <script src="{{ URL::asset('assets/js/lightbox.js') }}"></script>


<!-- Mirrored from demos.pixelized.cz/C-Bodas/v1.1/main/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2016 15:38:50 GMT -->
</html>