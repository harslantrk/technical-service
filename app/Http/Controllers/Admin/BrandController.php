<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
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

        $brands = Brand::all();

        return view('admin.brand.index', [
            'brands' => $brands,
            'deleg' => $this->sess
        ]);

    }
    public function create(){
        if($this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }

        return view('admin.brand.create');
    }
    public function save(Request $request){
        $data = $request->all();
        $data['status'] = 1;
        $data['user_id'] = Auth::user()->id;
        Brand::create($data);

        return redirect()->action('Admin\BrandController@index');
    }
    public function edit($id){
        if($this->update==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $brands = Brand::where('id',$id)->first();
        return view('admin.brand.edit',['brands' => $brands]);
    }
    public function update(Request $request,$id){
        $data = $request->all();
        Brand::find($id)->update($data);
        return redirect()->action('Admin\BrandController@index');
    }
    public function delete($id){
        if($this->delete==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $sil = Brand::find($id);
        $sil->status = 0;
        $sil->save();
        return redirect()->action('Admin\BrandController@index');
    }
}
