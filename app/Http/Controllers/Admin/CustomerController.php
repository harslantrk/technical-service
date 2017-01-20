<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Auth;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use DB;
use App\Customer;
use App\UserDelegation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
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
   		$data=Customer::where('status','1')->get();

   		return view('admin.customers.index',['data'=>$data,'deleg' => $this->sess]);
   	}

   	public function create(Request $request){
        if($this->read==0 || $this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }
   		return view('admin.customers.create');
   	}
      public function save(Request $request){
         $data=$request->all();

         $data['status']='1';

          Customer::create($data);

          return redirect('admin/customers');
      }

    public function edit($id){
        if($this->read==0 || $this->update==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $customers = Customer::where('id',$id)->first();

        return view('admin.customers.edit',['customers'=>$customers]);
    }

      public function update(Request $request){
         $data=$request->all();

          Customer::find($data['id'])->update($data);
          Flash::message('Tamam','success');//Güncelleme İşleminde Uyarı Verdirtme
          return redirect('admin/customers');
      }

      public function delete($delete_id){
          if($this->read==0 || $this->delete==0){
              return redirect()->action('Admin\HomeController@index');
          }
         $customers = Customer::where('id', $delete_id)->first();
          $customers->status = '0';
          $customers->save();

          return redirect()->back();
      }
}
