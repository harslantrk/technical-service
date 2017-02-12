<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Customer();
        $customer->name         = 'Yunus';
        $customer->surname      = 'Kaya';
        $customer->email        = 'yunus.kaya@gmail.com';
        $customer->phone        = '';
        $customer->gsm          = '05315963565';
        $customer->adres        = 'Mimarsinan / Büyükçekmece / İstanbul';
        $customer->companyName  = 'Kayalar İnşaat';
        $customer->status       = '1';
        $customer->save();

        $customer = new Customer();
        $customer->name         = 'Hasan';
        $customer->surname      = 'Arslantürk';
        $customer->email        = 'harslantrk@gmail.com';
        $customer->phone        = '';
        $customer->gsm          = '05326549878';
        $customer->adres        = 'Yeniler / Kartal / İstanbul';
        $customer->companyName  = 'Arslantürk Yazılım';
        $customer->status       = '1';
        $customer->save();

        $customer = new Customer();
        $customer->name         = 'Mehmet';
        $customer->surname      = 'Sert';
        $customer->email        = 'sert.mehmet@gmail.com';
        $customer->phone        = '';
        $customer->gsm          = '05549126674';
        $customer->adres        = 'Mimarsinan / Büyükçekmece / İstanbul';
        $customer->companyName  = 'Sert Unlu Mamülleri';
        $customer->status       = '1';
        $customer->save();

        $customer = new Customer();
        $customer->name         = 'Atakan';
        $customer->surname      = 'Ece';
        $customer->email        = 'ece.turizm@gmail.com';
        $customer->phone        = '';
        $customer->gsm          = '05355995951';
        $customer->adres        = 'Mimarsinan / Büyükçekmece / İstanbul';
        $customer->companyName  = 'Ece Turizm';
        $customer->status       = '1';
        $customer->save();
    }
}
