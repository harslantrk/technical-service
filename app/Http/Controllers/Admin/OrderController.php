<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Helpers\Helper;
use App\Joining;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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
    public function index(){
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }

        $orders = Order::all();

        return view('admin.order.index', [
            'orders' => $orders,
            'deleg' => $this->sess
        ]);
    }

    public function create()
    {
        if($this->read==0 || $this->add==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $customers = Customer::where('status',1)->get();
        $products = Product::where('status',1)->get();
        return view('admin.order.create',[
            'customers' => $customers,
            'products' => $products
        ]);
    }

    public function OrderControl(Request $request)
    {
        $data = $request->all();
        $quantity = $data['quantity'];

        $joinings = DB::table('joining')
                        ->join('product','product.id','=','joining.twoproduct_id')
                        ->where('joining.product_id',$data['product_id'])
                        ->select('joining.*','product.stock','product.name')->get();

        return view('admin.order.controlModal',[
            'joinings' => $joinings,
            'quantity' => $quantity
        ]);

    }
}
