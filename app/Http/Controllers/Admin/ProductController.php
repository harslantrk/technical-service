<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Requests;
use App\Product_Type;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;


class ProductController extends Controller
{
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
    //Tüm Ürünler
    public function index(){
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }
    	//$products = Product::all();
        $products = Product::where('status',1)->get();
    	return view('admin.product.index')->with(['products' => $products,'deleg' => $this->sess]);
    }
    //Yeni Ürünler
    public function create(){
        if($this->read==0 || $this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $brands = Brand::where('status',1)->get();
        $product_types = Product_Type::where('status',1)->get();
    	return view('admin.product.create',['brands' => $brands,'product_types' => $product_types]);
    }
    public function ImagePostSave(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/uploads/');
        $image->move($destinationPath,$input['imagename']);

        $user = Product::findOrFail($request->id);
        $user->picture ='/uploads/'.$input['imagename'];
        $user->save();

        return redirect()->back();
    }

    //Yeni Ürün Oluşturma Fonksiyonu
    public function save(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 1;
        $product = Product::create($data);
        /*echo '<pre>';
        print_r($product->id);
        die();*/
    	return redirect('/admin/product');
    }

    public function edit(Request $request){
        if($this->read==0 || $this->update==0){
            return redirect()->back();
        }
        $brands = Brand::where('status',1)->get();
        $product_types = Product_Type::where('status',1)->get();
    	$id = $request->id;
    	$product = Product::where('id',$id)->first();
    	return view('admin.product.edit')->with(['product' => $product,'brands' => $brands,'product_types' => $product_types]);
    }
    
    // Ürün Güncelleme Fonksiyonu
    public function update(Request $request,$id){
        $data = $request->all();
        Product::find($id)->update($data);
    	return redirect('/admin/product');
    }
    // Ürün Silme Fonksiyonu
    public function delete(Request $request){
        if ($this->read==0 || $this->delete==0) {
            return redirect()->action('Admin\HomeController@index');
        }
    	$id = $request->id;
    	$productData = Product::find($id);
		$productData->status = 0;
		$productData->save();
		return redirect('/admin/product');
    }

}
