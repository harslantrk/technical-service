<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Customer;
use App\Product;
use App\Service;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Helpers\Helper;
use Session;
use App\Sms;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        Helper::sessionReload();

    }
    public function index()
    {
        $service = Service::all()->count();
        $product = Product::all()->count();
        $brand = Brand::all()->count();
        $customer = Customer::all()->count();
        return view('admin.home',['brand' => $brand,'customer' => $customer,'product' => $product,'service' => $service]);
    }
}
