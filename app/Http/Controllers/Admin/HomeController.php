<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Comment;
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
        $five_services = Service::where('status',1)->orderBy('id','desc')->take(5)->get(); // Son 5 kayıt
        $five_customers = Customer::where('status',1)->orderBy('id','desc')->take(5)->get(); // Son 5 kayıt
        $service = Service::all()->count();
        $products = Product::where('status',1)->orderBy('created_at','desc')->get();
        $brand = Brand::all()->count();
        $customer = Customer::all()->count();

        $comments = Comment::orderBy('status','asc')->get();
        $commentCount = Comment::all()->count();

        /*echo '<pre>';
        print_r($comments);
        die();*/
        return view('admin.home',[
            'brand' => $brand,
            'customer' => $customer,
            'products' => $products,
            'service' => $service,
            'five_services' => $five_services,
            'five_customers' => $five_customers,
            'comments'=>$comments,
            'commentCount' => $commentCount
        ]);
    }
}
