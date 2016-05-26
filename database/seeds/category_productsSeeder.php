<?php

use Illuminate\Database\Seeder;

class category_productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_products')->insert([
		    [
		        'category_name' => 'Pertanian'
		    ],
		    [
		      	'category_name' => 'Peternakan'  
		    ],
		    [
		      	'category_name' => 'Pariwisata'  
		    ]
		]);
    }
}
