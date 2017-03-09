<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserDelegation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        $delegations = UserDelegation::all();
        return view('admin.user_auth.index',[
            'users'=>$users,
            'delegations' => $delegations
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();

        User::where('id',$data['user_id'])->update(['delegation_id'=>$data['delegation_id']]);

        return redirect()->back();
    }
}
