$products = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->select('prices_products.price','reservations.id','reservations.customer_id','reservations.delivery_address_id','reservations.created_at','reservations.status as resvStatus','reservations.payment_proof','carts.amount', 'carts.delivery_cost', 'carts.detail_product_id')
            ->get();

        $totPriceAdmin = 0;
        foreach ($products as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->join('carts','carts.detail_product_id','=','carts.detail_product_id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber','products.category_id','carts.status as cartStatus')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detProd->detId)
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));
            $totPriceAdmin += $prod->countPrice;
        }
        
//order
        $productSeller = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$id)
            ->where('carts.status','=','0')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id','carts.detail_product_id','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi',
                'carts.detail_product_id as detId','carts.reservation_id as resvId')
            ->get();

        $totPriceSeller = 0;
        foreach ($productSeller as $prod) {
            $prod->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prod->detail_product_id)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prod->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prod->detProd->detId)
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSeller += $prod->countPrice;

// echo "<pre>";
// var_dump($prod);

        }

        // die();
        

//Accepted
        $productSellerAccepted = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$id)
            ->where('carts.status','=','1')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id as resvId','carts.detail_product_id as detId','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi')
            ->get();


        $totPriceSellerAccepted = 0;
        foreach ($productSellerAccepted as $prodAcc) {
            $prodAcc->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prodAcc->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prodAcc->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prodAcc->detId)
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerAccepted += $prodAcc->countPrice;

        // echo "<pre>";
        // var_dump($prod);

        }
        // die();
        


//Rejected
        $productSellerRejected = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$id)
            ->where('carts.status','=','2')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id as resvId','carts.detail_product_id as detId','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi')
            ->get();


        $totPriceSellerRejected = 0;
        foreach ($productSellerRejected as $prodAcc) {
            $prodAcc->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prodAcc->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prodAcc->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prodAcc->detId)
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerRejected += $prodAcc->countPrice;

        // echo "<pre>";
        // var_dump($prod);

        }
        // die();

//Shipping
        $productSellerShipping = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$id)
            ->where('carts.status','=','3')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id as resvId','carts.detail_product_id as detId','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi')
            ->get();


        $totPriceSellerShipping = 0;
        foreach ($productSellerShipping as $prodAcc) {
            $prodAcc->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prodAcc->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prodAcc->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prodAcc->detId)
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerShipping += $prodAcc->countPrice;

        // echo "<pre>";
        // var_dump($prod);

        }
        // die();
        

//shipped
        $productSellerShipped = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('detail_products','carts.detail_product_id','=','detail_products.id')
            ->join('users','detail_products.seller_id','=','users.id')
            ->join('prices_products','carts.price_id','=','prices_products.id')
            ->where('reservations.id','=',$id)
            ->where('carts.status','=','4')
            ->where('detail_products.seller_id','=',Auth::user()->id)
            ->select('carts.reservation_id as resvId','carts.detail_product_id as detId','carts.amount','prices_products.price','carts.delivery_cost','carts.status as cartStatus ','carts.resi')
            ->get();


        $totPriceSellerShipped = 0;
        foreach ($productSellerShipped as $prodAcc) {
            $prodAcc->detProd = DB::table('detail_products')
            ->join('products','products.id','=','detail_products.product_id')
            ->join('sellers','detail_products.seller_id','=','sellers.id')
            ->where('detail_products.id','=', $prodAcc->detId)
            ->select(
                'detail_products.id as detId','detail_products.type_product','detail_products.stock','detail_products.seller_id',
                'products.name', 'products.category_id',
                'sellers.bank_name as sellerBankName','sellers.bank_account as sellerBankAccount','sellers.account_number as sellerAccountNumber')
            ->first();

            $prodAcc->countPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.detail_product_id','=',$prodAcc->detId)
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $totPriceSellerShipped += $prodAcc->countPrice;

        // echo "<pre>";
        // var_dump($prod);

        }
        // die();