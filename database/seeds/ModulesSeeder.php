<?php

use Illuminate\Database\Seeder;
use \App\Modules;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = new Modules();
        $modules->name = 'Anasayfa';
        $modules->url = '/admin';
        $modules->icon = 'fa-home';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 1;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Yetkilendirme İşlemleri';
        $modules->url = '/admin/delegations';
        $modules->icon = 'fa-plus';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 2;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Üyeler';
        $modules->url = '/admin/users';
        $modules->icon = 'fa-users';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 3;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Ayarlar';
        $modules->url = '/admin/settings';
        $modules->icon = 'fa-gears';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 4;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Servis';
        $modules->url = '/admin/service';
        $modules->icon = 'fa-plus';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 5;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Müşteri';
        $modules->url = '/admin/customers';
        $modules->icon = 'fa-plus';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 6;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Marka';
        $modules->url = '/admin/brand';
        $modules->icon = 'fa-plus';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 7;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Ürün Türü';
        $modules->url = '/admin/product_type';
        $modules->icon = 'fa-plus';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 8;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Ürün';
        $modules->url = '/admin/product';
        $modules->icon = 'fa-plus';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 9;
        $modules->status = 1;
        $modules->save();

        $modules = new Modules();
        $modules->name = 'Takvim';
        $modules->url = '/admin/event';
        $modules->icon = 'fa-calendar';
        $modules->parent = 0;
        $modules->parent_id = 0;
        $modules->priority = 10;
        $modules->status = 1;
        $modules->save();
    }
}
