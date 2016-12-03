<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Helper;
use App\Product_Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Product_TypeController extends Controller
{
    //Hizmetlerimiz Listeleme
    public function __construct(Request $request)
    {
        $url = $request->path();
        Helper::sessionReload();
        $sess= Helper::shout($url);
        $this->read=$sess['r'];
        $this->update=$sess['u'];
        $this->add=$sess['a'];
        $this->delete=$sess['d'];
        $this->sess=$sess;
    }
    public function index(){
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }

        $product_types = Product_Type::all();

        return view('admin.product_type.index', ['product_types' => $product_types, 'deleg' => $this->sess]);

    }
}
