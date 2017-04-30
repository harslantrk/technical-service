<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*Route::auth();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index');

});*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
 * Ön Sayfalar
 */
Route::get('/','HomeController@index');
Route::get('/iletisim','ContactController@index');
Route::get('/hakkimizda','AboutController@index');
Route::get('/hizmetlerimiz','ServicesController@index');
Route::get('/referanslarimiz','ReferenceController@index');
/*F
 * Admin Sayfaları
 */
Route::auth();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin', 'Admin\HomeController@index');

	/*Üyelik Modülü Başlangıcı*/
	Route::get('/admin/users','Admin\UserController@index');//listeleme sayfası
	Route::get('/admin/users/create','Admin\UserController@create');//yeni üye ekleme sayfası
	Route::get('/admin/users/edit/{id}','Admin\UserController@edit');//var olan üyenin bilgilerini gösteren sayfa
	Route::get('/admin/users/delete/{id}','Admin\UserController@delete');//var olan üyenin bilgilerini silen fonksiyon
    Route::get('/admin/users/commentShow/{id}','Admin\UserController@commentShow');//Üyelerin Yorumlarını Listelemek için Şuanlık

	Route::post('/admin/users/save','Admin\UserController@save');//yeni üye kayıt eden fonksiyon
	Route::post('/admin/users/update','Admin\UserController@update');//var olan üyenin bilgilerini güncelleyen fonksiyon
	/*Üyelik Modülü Bitişi*/

    /*Dosya Yöneticisi Modülü*/
    Route::get('/admin/files','Admin\FilesController@index'); // Tüm Dosyalar
    Route::post('/admin/files/single-upload','Admin\FilesController@singleUpload');

    /*Müşteri Yorumları Modülü Başlangıç*/

    Route::get('/admin/our-client','Admin\OurClientsController@index');

    Route::get('/admin/our-client/create','Admin\OurClientsController@create');
    Route::get('/admin/our-client/edit/{id}','Admin\OurClientsController@edit');
    Route::get('/admin/our-client/delete/{id}','Admin\OurClientsController@delete');
    Route::post('/admin/our-client/save','Admin\OurClientsController@save');
    Route::post('/admin/our-client/update','Admin\OurClientsController@update');

    /*Müşteri Yorumları Modülü Bitiş*/

    /*Referanslarımız Modülü Başlangıç*/

    Route::get('/admin/reference','Admin\ReferenceController@index');

    Route::get('/admin/reference/create','Admin\ReferenceController@create');
    Route::get('/admin/reference/edit/{id}','Admin\ReferenceController@edit');
    Route::get('/admin/reference/delete/{id}','Admin\ReferenceController@delete');
    Route::post('/admin/reference/save','Admin\ReferenceController@save');
    Route::post('/admin/reference/update','Admin\ReferenceController@update');

    /*Referanslarımız Modülü Bitiş*/

    /*İletişim Modülü Başlangıç*/

    Route::get('/admin/contacts','Admin\ContactController@index');
    Route::get('/admin/contacts/delete/{id}','Admin\ContactController@delete');
    Route::post('/admin/contacts/add','Admin\ContactController@save');
    Route::post('/admin/contacts/read','Admin\ContactController@read');

    /*İletişim Modülü Bitiş*/

    /*Slider Modülü Başlangıç*/

    Route::get('/admin/slider','Admin\SliderController@index');

    Route::get('/admin/slider/create','Admin\SliderController@create');
    Route::get('/admin/slider/edit/{id}','Admin\SliderController@edit');
    Route::get('/admin/slider/delete/{id}','Admin\SliderController@delete');
    Route::post('/admin/slider/save','Admin\SliderController@save');
    Route::post('/admin/slider/update','Admin\SliderController@update');

    /*İletişim Modülü Bitiş*/

	/*Reklam Modülü Başlangıcı*/
	// Google Analytics Kodu ekleme alanı
	Route::get('/admin/advertise/google-analytics','Admin\SettingsController@googleAnalytics');
	Route::post('/admin/advertise/advertise-analytics','Admin\SettingsController@googleAnalyticsSave');
	// Intro Reklam Sayfası oluşturma alanı
	Route::get('/admin/advertise/intro','Admin\AdvertiseController@introIndex');
	Route::get('/admin/advertise/intro/create','Admin\AdvertiseController@introCreate');
	Route::get('/admin/advertise/intro/edit/{id}','Admin\AdvertiseController@introEdit');
	Route::get('/admin/advertise/intro/delete/{id}','Admin\AdvertiseController@introDelete');
    
    Route::post('/admin/advertise/intro/save','Admin\AdvertiseController@introSave');
    Route::post('/admin/advertise/intro/update','Admin\AdvertiseController@introUpdate');
    //Popup Yönetimi oluşturma alanı
    Route::get('/admin/advertise/popup','Admin\AdvertiseController@popupIndex');
    Route::get('/admin/advertise/popup/create','Admin\AdvertiseController@popupCreate');
    Route::get('/admin/advertise/popup/edit/{id}','Admin\AdvertiseController@popupEdit');
    Route::get('/admin/advertise/popup/delete/{id}','Admin\AdvertiseController@popupDelete');

    Route::post('/admin/advertise/popup/save','Admin\AdvertiseController@popupSave');
    Route::post('/admin/advertise/popup/update','Admin\AdvertiseController@popupUpdate');
    //Sayfa İçi Reklamları oluşturma alanı
    Route::get('/admin/advertise/page-in','Admin\AdvertiseController@pageInIndex');
    Route::get('/admin/advertise/page-in/create','Admin\AdvertiseController@pageInCreate');
    Route::get('/admin/advertise/page-in/edit/{id}','Admin\AdvertiseController@pageInEdit');
    Route::get('/admin/advertise/page-in/delete/{id}','Admin\AdvertiseController@pageInDelete');

    Route::post('/admin/advertise/page-in/save','Admin\AdvertiseController@pageInSave');
    Route::post('/admin/advertise/page-in/update','Admin\AdvertiseController@pageInUpdate');
    /*Reklam Modülü Bitişi*/

    /*Kategori Modülü Başlangıç*/
    Route::get('/admin/categories','Admin\CategoriesController@index');//Sayfa Kategorilerini listeleme sayfası
    Route::get('/admin/categories/create','Admin\CategoriesController@create');//YeniKategori ekleme sayfası
    Route::get('/admin/categories/blog','Admin\CategoriesController@blog');//Blog Kategorilerini listeleme sayfası
    Route::get('/admin/categories/gallery','Admin\CategoriesController@gallery');//Blog Kategorilerini listeleme sayfası
    Route::get('/admin/categories/edit/{id}','Admin\CategoriesController@edit');// Kategorileri düzenleme sayfası
    Route::get('/admin/categories/delete/{id}','Admin\CategoriesController@delete');// Kategorileri silme sayfası
    Route::get('/admin/test','Admin\CategoriesController@test');// Kategorileri silme sayfası
    Route::post('/admin/categories/save','Admin\CategoriesController@save');//yeni kategori ekleyen fonksiyon
    Route::post('/admin/categories/update','Admin\CategoriesController@update');//yeni kategori ekleyen fonksiyon
    /*Kategori Modülü Bitiş*/

    /*Sayfalar Modülü Başlangıç*/
    Route::get('/admin/pages','Admin\PageController@index');// Aktif Sayfaları listeleme sayfası
    Route::get('/admin/pages/create','Admin\PageController@create');//Yeni Sayfa ekleme sayfası
    Route::get('/admin/pages/drafts','Admin\PageController@draft');// Statusu 2 olan taslak sayfaları listeleme sayfası
    Route::get('/admin/pages/deleted','Admin\PageController@deleted');// Statusu 0 olan silinen sayfaları listeleme sayfası
    Route::get('/admin/pages/edit/{id}','Admin\PageController@edit');// Sayfaları düzenleme sayfası
    Route::get('/admin/pages/delete/{id}','Admin\PageController@delete');// Sayfaları silme sayfası
    Route::get('/admin/pages/active/{id}','Admin\PageController@active');// Sayfaları silme sayfası

    Route::post('/admin/pages/save','Admin\PageController@save');//yeni sayfa ekleyen fonksiyon
    Route::post('/admin/pages/update','Admin\PageController@update');//yeni sayfa ekleyen fonksiyon
    /*Sayfalar Modülü Bitiş*/

	/*Ayarlar Modülü Başlangıcı*/
	Route::get('/admin/settings','Admin\SettingsController@index');
	Route::post('/admin/settings/save','Admin\SettingsController@save');
	/*Ayarlar Modülü Bitişi*/

    /*TEKNİK-TALEP MODÜLÜ*/


    /* SUPPORT Başlangıç */
    Route::get('/admin/support','Admin\SupportController@index');
    Route::get('/admin/support/sent','Admin\SupportController@sent');
    Route::get('/admin/support/trash','Admin\SupportController@trash');
    Route::get('/admin/support/read-support/{id}','Admin\SupportController@readSupport');
    Route::get('/admin/support/delete/{id}','Admin\SupportController@deleteSupport');
    Route::get('/admin/support/reply-support/{id}','Admin\SupportController@replySupport');

    Route::post('/admin/support/supportSave','Admin\SupportController@supportSave');


    // Yetkilendirme Modülü
    Route::get('/admin/delegations','Admin\UserDelegationController@index');
    Route::get('admin/delegations/create','Admin\UserDelegationController@create_file');
    Route::get('admin/delegations/edit/{id}','Admin\UserDelegationController@update_file');
    Route::post('admin/delegations/ajaxDelegationAdd','Admin\UserDelegationController@ajax_createFile');
    Route::post('/admin/delegations/ajaxDelegationEdit','Admin\UserDelegationController@ajax_editFile');
    Route::get('/admin/delegations/delegationDelete','Admin\UserDelegationController@ajax_deleteFile');
    //Yetkilendirme Modülü Son

    //Kullanıcılar Modülü
    Route::get('/admin/customers','Admin\CustomerController@index');
    Route::get('/admin/customers/create','Admin\CustomerController@create');
    Route::get('/admin/customers/edit/{id}','Admin\CustomerController@edit');
    Route::get('/admin/customers/delete/{delete_id}','Admin\CustomerController@delete');

    Route::post('admin/customers/save','Admin\CustomerController@save');
    Route::post('/admin/customers/update','Admin\CustomerController@update');
    //Kullanıcılar Modülü Son

    // Modüller Modülü
    Route::get('/admin/modules','Admin\ModulesController@index');
    Route::get('admin/modules/create','Admin\ModulesController@create_file');
    Route::get('/admin/modules/edit/{id}','Admin\ModulesController@edit_file');

    Route::post('/admin/modules/ajaxModulesCreate','Admin\ModulesController@ajax_createFile');
    Route::post('/admin/modules/ajaxModulesEdit','Admin\ModulesController@ajax_editFile');
    Route::get('/admin/modules/delete','Admin\ModulesController@ajax_deleteFile');

    // Modüller Modülü Son

    //Sms Modülü Başlangıç
    Route::get('/admin/sms','Admin\SmsController@index'); //Tüm Hastalar Sayfası
    Route::get('/admin/sms/create','Admin\SmsController@create'); //Yeni Hasta Ekleme
    Route::get('/admin/sms/edit/{id}','Admin\SmsController@edit');//Hasta Düzenleme
    Route::get('/admin/sms/delete/{id}','Admin\SmsController@delete'); //Hasta Silme

    Route::post('/admin/sms/create','Admin\SmsController@createPost'); //Sms Atma Tablodan Seçerek
    Route::post('/admin/sms/elle','Admin\SmsController@createElle'); //Sms Atma Elle Numara Girerek
    Route::post('/admin/sms/save','Admin\SmsController@save'); //Hastayı Kaydetme
    //Sms Modülü Bitiş

    Route::post('/admin/users/resizeImagePost','Admin\UserController@resizeImagePost');

    //Marka Modülü Başlangıç
    Route::get('/admin/brand','Admin\BrandController@index'); //Tüm Hastalar Sayfası
    Route::get('/admin/brand/edit/{id}','Admin\BrandController@edit'); //Tüm Hastalar Sayfası
    Route::get('/admin/brand/delete/{id}','Admin\BrandController@delete'); //Tüm Hastalar Sayfası

    Route::post('/admin/brand/create','Admin\BrandController@create'); //Tüm Hastalar Sayfası
    Route::post('/admin/brand/save','Admin\BrandController@save'); //Hastayı Kaydetme
    Route::post('/admin/brand/update/{id}','Admin\BrandController@update'); //Hastayı Kaydetme
    //Marka Modülü Bitiş

    //Ürün Türü Modülü Başlangıç
    Route::get('/admin/product_type','Admin\Product_TypeController@index'); //Tüm Hastalar Sayfası
    Route::get('/admin/product_type/edit/{id}','Admin\Product_TypeController@edit'); //Tüm Hastalar Sayfası
    Route::get('/admin/product_type/delete/{id}','Admin\Product_TypeController@delete'); //Tüm Hastalar Sayfası

    Route::post('/admin/product_type/create','Admin\Product_TypeController@create'); //Tüm Hastalar Sayfası
    Route::post('/admin/product_type/save','Admin\Product_TypeController@save'); //Hastayı Kaydetme
    Route::post('/admin/product_type/update/{id}','Admin\Product_TypeController@update'); //Hastayı Kaydetme

    //Ürün Türü Modülü Bitiş

    /*Ürünler Modülü Başlangıcı*/
    Route::get('/admin/product/','Admin\ProductController@index'); //Tüm Ürünler Sayfası
    Route::get('/admin/product/create','Admin\ProductController@create'); //Yeni Ürün Ekleme
    Route::get('/admin/product/edit/{id}','Admin\ProductController@edit');//var olan Ürünün bilgilerini gösteren sayfa
    Route::get('/admin/product/delete/{id}','Admin\ProductController@delete'); //var olan ürünü silen fonksiyon
    Route::get('/admin/product/show/{id}','Admin\ProductController@show'); //var olan ürünü silen fonksiyon
    Route::get('/admin/product/commentCheck/{id}','Admin\ProductController@commentCheck'); //Ürün Yorumunu Onaylama
    Route::get('/admin/product/commentUnCheck/{id}','Admin\ProductController@commentUnCheck'); //Ürün Yorumunu Kapat
    Route::get('/admin/product/AllProductExcelExport','Admin\ProductController@AllProductExcelExport'); //Excel
    Route::get('/admin/product/ExcelExport/{text}','Admin\ProductController@ExcelExportText'); //Excel Aramalı

    Route::post('/admin/product/update/{id}','Admin\ProductController@update');//var olan ürünün bilgilerini güncelleyen fonksiyon
    Route::post('/admin/product/save','Admin\ProductController@save');//yeni ürün ekleyen fonksiyon
    Route::post('/admin/product/ImagePostSave','Admin\ProductController@ImagePostSave');
    Route::post('/admin/product/commentThought','Admin\ProductController@commentThoughtSave');//Ürün İçin Yoruma Olumlu Olumsuz Ekleme
    Route::post('/admin/product/commentSave','Admin\ProductController@commentSave');
    /*Ürünler Modülü Bitiş*/

    // Servis Modülü Başlangıç
    Route::get('/admin/service','Admin\ServiceController@index');
    Route::get('/admin/service/create','Admin\ServiceController@create');
    Route::get('/admin/service/edit/{id}','Admin\ServiceController@edit');
    Route::get('/admin/service/delete/{id}','Admin\ServiceController@delete');
    Route::get('/admin/service/serviceClose/{id}','Admin\ServiceController@serviceClose');
    Route::get('/admin/service/paymentModalView/{id}','Admin\ServiceController@PaymentView');
    Route::get('/admin/service/deletePayment/{id}','Admin\ServiceController@deletePayment');
    Route::get('/admin/service/show/{id}','Admin\ServiceController@show');
    Route::get('/admin/service/ExcelDownload/{id}','Admin\ServiceController@excelDownload');

    Route::post('/admin/service/save','Admin\ServiceController@save');
    Route::post('/admin/service/update/{id}','Admin\ServiceController@update');
    Route::post('/admin/service/AddPayment/{id}','Admin\ServiceController@AddPayment'); // Servise ürün ekleme ve sepeti güncelleme
    // Servis Modülü Bitiş

    //Takvim İşlemleri Başlangıç
    Route::get('/admin/event','Admin\EventController@index'); // Takvim index'i açma
    Route::get('admin/event/api', function () {
        $events = DB::table('event')->select('id', 'user_id', 'title', 'start_time as start', 'end_time as end')->get();

        return $events;
    });
    Route::post('/admin/event/createCalendarModalShow','Admin\EventController@createCalendarModalShow'); //Reçete İçin Raporları Getirme Ajax
    Route::post('/admin/event/calendarModalSave','Admin\EventController@calendarModalSave');
    Route::post('/admin/event/editModal','Admin\EventController@editModal');
    //Takvim İşlemleri Bitiş

    Route::get('/admin/user_auth','Admin\UserAuthController@index');

    Route::post('/admin/user_auth/saveAuth','Admin\UserAuthController@save');


    Route::get('/admin/instagram','Admin\HomeController@instagram');
});



