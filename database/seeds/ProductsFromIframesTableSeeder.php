<?php

use Illuminate\Database\Seeder;

class ProductsFromIframesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iframe_productos=DB::table('iframes')->where('tipos_de_iframe_id',2)->get();
        $products=[];
        foreach($iframe_productos as $iframe_producto){
            $product=['title'=>$iframe_producto->title,'value'=>$iframe_producto->html,'product_type_id'=>2,'enterprise_id'=>5,'created_at'=>date('Y-m-d H:i:s')];
            array_push($products,$product);
        }
        DB::table('products')->insert($products);
        DB::table('iframes')->where('tipos_de_iframe_id',2)->delete();
        
    }
}
