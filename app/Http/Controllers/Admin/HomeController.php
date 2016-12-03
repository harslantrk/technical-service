<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\UserCustomers;
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
        $brand = Brand::all()->count();
        $customer = UserCustomers::all()->count();
        return view('admin.home',['brand' => $brand,'customer' => $customer]);
    }
}
