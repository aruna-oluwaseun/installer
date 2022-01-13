<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product_id = DB::table('products')->insertGetId([
            'title'         => 'Business basic',
            'code'          => null,
            'description'   => null,
            'stripe_id'     => null,
            'status'        => 'active',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);

        DB::table('prices')->insert([
            ['product_id' => $product_id, 'cost' => 50.00, 'billing_period' => 'Monthly', 'status' => 'active', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['product_id' => $product_id, 'cost' => 480.00, 'billing_period' => 'Yearly', 'status' => 'active', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]
        ]);

        $product_features = DB::table('features')->get();

        if($product_features->count())
        {
            foreach($product_features as $feature)
            {
                DB::table('feature_product')->insert(['feature_id' => $feature->id,'product_id' => $product_id]);
            }
        }
    }
}
