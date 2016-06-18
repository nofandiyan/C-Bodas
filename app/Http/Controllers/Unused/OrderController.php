public function show($id)
    {

        $order = DB::table('carts')
            ->join('reservations','carts.reservation_id', '=', 'reservations.id')
            ->where('carts.reservation_id','=',$id)
            ->select(DB::raw('DISTINCT(carts.reservation_id)'))
            ->get();

        foreach ($order as $ord) {

            $ord->totPrice = DB::table('prices_products')
            ->join('carts', 'carts.price_id','=', 'prices_products.id')
            ->where('carts.reservation_id','=',$id)
            ->sum(DB::raw('carts.amount * prices_products.price + carts.delivery_cost'));

            $ord->cust = DB::table('carts')
            ->join('reservations','carts.reservation_id','=','reservations.id')
            ->join('users','reservations.customer_id','=','users.id')
            ->join('detail_products','detail_products.id','=','carts.detail_product_id')
            ->where('carts.reservation_id','=',$id)
            ->select('users.id as customer_id','users.name','users.email','users.phone','users.city_id','users.street','users.zip_code',
                'reservations.id as resvId','reservations.delivery_address_id','reservations.status as resvStatus', 'reservations.bank_name','reservations.bank_account','reservations.payment_proof',
                'reservations.created_at',
                'carts.status as cartStatus','carts.resi','carts.detail_product_id as detId')
            ->first();

            $ord->city = DB::table('cities')
            ->where('id','=', $ord->cust->city_id)
            ->select('city','type','province_id')
            ->first();

            $ord->prov = DB::table('provinces')
            ->where('id','=', $ord->city->province_id)
            ->select('province')
            ->first();

            $ord->deliv = DB::table('delivery_address')
            ->join('cities','delivery_address.city_id','=','cities.id')
            ->join('provinces','cities.province_id','=','provinces.id')
            ->where('delivery_address.id','=', $ord->cust->delivery_address_id)
            ->select('delivery_address.name','delivery_address.phone','delivery_address.street','delivery_address.zip_code','cities.city','cities.type','provinces.province')
            ->first();
        }           

        return view ('order.viewOrder', compact('products','order','productSeller','totPriceAdmin','totPriceSeller','productSellerAccepted','productSellerRejected','productSellerShipping','productSellerShipped','totPriceSellerAccepted','totPriceSellerRejected','totPriceSellerShipping','totPriceSellerShipped'));
    }