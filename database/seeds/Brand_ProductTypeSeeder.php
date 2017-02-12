<?php

use Illuminate\Database\Seeder;
use App\Brand;
use App\Product_Type;

class Brand_ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Marka Verileri Başlangıç
        $brand = new Brand();
        $brand->brand   = 'Asus';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Logitech';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'MSI';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Razer';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Toshiba';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();


        $brand = new Brand();
        $brand->brand   = 'BenQ';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'HP';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Apple';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Samsung';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'LG';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Acer';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'Intel';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();

        $brand = new Brand();
        $brand->brand   = 'AMD';
        $brand->user_id = '1';
        $brand->status  = '1';
        $brand->save();
        //Marka Verileri Bitiş

        //Ürün Türleri Verileri Başlangıç
        $ptype = new Product_Type();
        $ptype->product_type   = 'Klavye';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Mouse';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Telefon';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Bilgisayar';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Monitör';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Kulaklık';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'İşlemci';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Ekran Kartı';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Hard Disk';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Hoparlör';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Tablet';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        $ptype = new Product_Type();
        $ptype->product_type   = 'Televizyon';
        $ptype->user_id = '1';
        $ptype->status  = '1';
        $ptype->save();

        //Marka Verileri Bitiş

    }
}
