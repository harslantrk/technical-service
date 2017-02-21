<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Product;
use App\ServicePayment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use Auth;
use Carbon\Carbon;
use DB;
use Session;
use Laracasts\Flash\Flash;
use App\Helpers\Helper;

class ServiceController extends Controller
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
    	$services = Service::where('status',1)->get();

    	return view('admin.service.index', [
    	    'services' => $services,
            'deleg' => $this->sess
        ]);

    }
    public function create(){
    	if($this->read==0 || $this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
    	return view('admin.service.create',[
    	    'customers' => $customers,
            'products' => $products
        ]);
    }

    public function save(Request $request){
    	$data =$request->all();
    	$data['status'] = 1;
    	$data['user_id'] = Auth::user()->id;
    	Service::create($data);
    	/*echo '<pre>';
    	print_r($data);
    	die();*/
    	return redirect('/admin/service');
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        Service::find($id)->update($data);
        return redirect('/admin/service');
    }

    public function edit($id)
    {
        if($this->read==0 || $this->update==0){
            return redirect()->back();
        }
        $service = Service::where('id',$id)->first();
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
        return view('admin.service.edit',[
            'service' => $service,
            'customers' => $customers,
            'products' => $products
        ]);
    }

    public function delete($id) {
    	if ($this->read==0 || $this->delete==0) {
    		return redirect()->action('Admin\HomeController@index');
    	}
    	$services=Service::find($id);
    	$services->status = 0;
    	$services->save();
        return redirect('/admin/service');
    }
    public function serviceClose($id){
        $service = Service::find($id);
        $service['status'] = 2;
        $service->save();
        return redirect('/admin/service');
    }
    public function PaymentView($id){
        $service_payments = ServicePayment::where('service_id',$id)->get();
        $service = Service::where('id',$id)->first();
        $products = Product::where('status',1)->where('stock','>',0)->get();

        return view('admin.service.paymentModal',[
            'service_id' => $id,
            'products' => $products,
            'service' => $service,
            'service_payments' => $service_payments
        ]);
    }
    public function AddPayment(Request $request,$id){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['service_id'] = $id;

        $stock = Product::where('id',$data['product_id'])->first();
        $stock->stock = $stock->stock - $data['quantity'];
        $stock->save();

        $guncelle = ServicePayment::where('service_id',$id)->where('product_id',$data['product_id'])->first();
        if ($guncelle) {
            $guncelle->quantity = $guncelle->quantity + $data['quantity'];
            $guncelle->kdv = $guncelle->kdv + $data['kdv'];
            $guncelle->total = $guncelle->total + $data['total'];
            $guncelle->save();
            //ServicePayment::find($guncelle->id)->update($guncelle);
        }else{
            ServicePayment::create($data);
        }
        return redirect()->back();
    }

    public function deletePayment($id)
    {
        $sPayment = ServicePayment::where('id',$id)->first();

        $pQuantity = $sPayment->quantity;
        $pId = $sPayment->product_id;

        ServicePayment::destroy($id);
        $product = Product::where('id',$pId)->first();
        $product->stock = $product->stock + $pQuantity;
        $product->save();
        //Product::where('id',$pId)->update(['quantity' => $pQuantity]);
        return redirect()->back();
    }
    public function show($id)
    {
        if($this->read==0 || $this->update==0){
            return redirect()->back();
        }
        $service_payments = ServicePayment::where('service_id',$id)->get();
        $service = Service::where('id',$id)->first();
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
        return view('admin.service.show',[
            'service' => $service,
            'customers' => $customers,
            'products' => $products,
            'service_payments' => $service_payments
        ]);
    }
}
