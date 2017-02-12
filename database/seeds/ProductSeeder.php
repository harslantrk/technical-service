<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name              = 'G 103';
        $product->brand_id          = '2';
        $product->product_type_id   = '1';
        $product->user_id           = '1';
        $product->detail            = 'Oyuncu Klavyesi';
        $product->stock             = '10';
        $product->in_price          = '50';
        $product->out_price         = '73';
        $product->status            = '1';
        $product->save();

        $product = new Product();
        $product->name              = 'GTX 1080';
        $product->brand_id          = '3';
        $product->product_type_id   = '8';
        $product->user_id           = '1';
        $product->detail            = 'Ekran kartı';
        $product->stock             = '7';
        $product->in_price          = '3500';
        $product->out_price         = '3650';
        $product->status            = '1';
        $product->save();

        $product = new Product();
        $product->name              = 'iPhone 7';
        $product->brand_id          = '8';
        $product->product_type_id   = '3';
        $product->user_id           = '1';
        $product->detail            = 'iPhone Cep Telefonu';
        $product->stock             = '3';
        $product->in_price          = '3150';
        $product->out_price         = '3370';
        $product->status            = '1';
        $product->save();

        $product = new Product();
        $product->name              = 'RL2240HE';
        $product->brand_id          = '6';
        $product->product_type_id   = '5';
        $product->user_id           = '1';
        $product->detail            = 'BenQ 1 Ms Tepkimeli Oyuncu Monitörü';
        $product->stock             = '8';
        $product->in_price          = '450';
        $product->out_price         = '600';
        $product->status            = '1';
        $product->save();
    }
}
