<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;
use Laracasts\Flash\Flash;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Sms;

class SmsController extends Controller
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

        return view('admin.sms.index', ['deleg' => $this->sess]);
    }
}
