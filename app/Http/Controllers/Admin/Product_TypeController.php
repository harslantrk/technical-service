<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Helper;
use App\Product_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('admin.product_type.index', [
            'product_types' => $product_types,
            'deleg' => $this->sess
        ]);

    }
    public function create(){
    if($this->add==0){
        return redirect()->action('Admin\HomeController@index');
    }

    return view('admin.product_type.create');
    }
    public function save(Request $request){
        $data = $request->all();
        $data['status'] = 1;
        $data['user_id'] = Auth::user()->id;
        Product_Type::create($data);

        return redirect()->action('Admin\Product_TypeController@index');
    }
    public function edit($id){
        if($this->update==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $product_types = Product_Type::where('id',$id)->first();
        return view('admin.product_type.edit',['product_types' => $product_types]);
    }
    public function update(Request $request,$id){
        $data = $request->all();
        Product_Type::find($id)->update($data);
        return redirect()->action('Admin\Product_TypeController@index');
    }
    public function delete($id){
        if($this->delete==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $sil = Product_Type::find($id);
        $sil->status = 0;
        $sil->save();
        return redirect()->action('Admin\Product_TypeController@index');
    }
}
