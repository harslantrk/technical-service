<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Support;
use App\User;
use Auth;
use App\Helpers\Helper;

class SupportController extends Controller
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
    public function index()
    {
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $user_id = Auth::user()->id;
        $support = $this->supportGetir($user_id,'receiver');
        $user = User::where('status',1)
                    ->where('id','!=',$user_id)
                    ->get();
        $read = $this->supportGetir($user_id,'read_count');
        /*echo '<pre>';
        print_r($support);
        die();*/
        return view('admin.support.index',[
            'deleg' => $this->sess,
            'supports' => $support,
            'users' => $user,
            'reads' => $read
        ]);
    }

    public function supportSave(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        $data['read'] = 0;
        $data['trash'] = 0;

        /*echo '<pre>';
        echo $data['receiver_id'][0];
        echo $data['receiver_id'][1];
        echo count($data['receiver_id']);
        print_r($data);
        die();*/
        $receiverC = count($data['receiver_id']);
        if ($receiverC > 1) {
            for ($i = 0;$i < $receiverC;$i++){

                $support = new Support();
                $support->sender_id      = $data['sender_id'];
                $support->receiver_id    = $data['receiver_id'][$i];
                $support->title          = $data['title'];
                $support->detail         = $data['detail'];
                $support->status         = $data['status'];
                $support->read           = $data['read'];
                $support->trash          = $data['trash'];
                $support->save();
            }
        }else {
            Support::create($data);
        }

        return redirect()->back();
    }

    public function sent()
    {
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $user_id = Auth::user()->id;
        $support = $this->supportGetir($user_id,'sender');
        $read = $this->supportGetir($user_id,'read_count');

        $user = User::where('status',1)
            ->where('id','!=',$user_id)
            ->get();
        /*echo '<pre>';
        print_r($support);
        die();*/
        return view('admin.support.sent',[
            'deleg' => $this->sess,
            'supports' => $support,
            'users' => $user,
            'reads' => $read
        ]);
    }

    public function supportGetir($user_id,$sr){
        $support ='';
        if ($sr == 'sender') {
            $support = DB::table('support')
                ->join('users','support.receiver_id','=','users.id')
                ->where('support.sender_id',$user_id)
                ->where('support.status',1)
                ->select('support.*','users.name as user_name')
                ->get();
        } elseif ($sr == 'read_count') {
            $support = DB::table('support')
                ->join('users','support.sender_id','=','users.id')
                ->where('support.receiver_id',$user_id)
                ->where('support.status',1)
                ->where('read',0)
                ->select('support.*','users.name as user_name')->count();
        } elseif ($sr == 'receiver') {
            $support = DB::table('support')
                ->join('users','support.sender_id','=','users.id')
                ->where('support.receiver_id',$user_id)
                ->where('support.status',1)
                ->select('support.*','users.name as user_name')
                ->get();
        } else {
            $support = DB::table('support')
                ->join('users','support.sender_id','=','users.id')
                ->where('support.receiver_id',$user_id)
                ->where('support.status',0)
                ->select('support.*','users.name as user_name')
                ->get();
        }
        return $support;
    }

    public function readSupport($id)
    {
        Support::where('id',$id)->update(['read' => 1]);
        $readSupport = Support::where('id',$id)
                                ->get();
        $user_id = Auth::user()->id;
        $support = $this->supportGetir($user_id,'receiver');
        $read = $this->supportGetir($user_id,'read_count');

       /* echo '<pre>';
        print_r($support);
        die();*/
        return view('admin.support.read-support',[
            'deleg' =>$this->sess,
            'readSupports' => $readSupport,
            'supports' => $support,
            'reads' => $read
        ]);
    }

    public function deleteSupport($id)
    {
        Support::where('id',$id)
                ->update(['status' => 0]);
        return redirect()->back();
    }

    public function trash()
    {
        if($this->read==0){
            return redirect()->action('Admin\HomeController@index');
        }
        $user_id = Auth::user()->id;
        $support = $this->supportGetir($user_id,'trash');
        $read = $this->supportGetir($user_id,'read_count');

        $user = User::where('status',1)
            ->where('id','!=',$user_id)
            ->get();
        /*echo '<pre>';
        print_r($support);
        die();*/
        return view('admin.support.trash',[
            'deleg' => $this->sess,
            'supports' => $support,
            'users' => $user,
            'reads' => $read
        ]);
    }

}
