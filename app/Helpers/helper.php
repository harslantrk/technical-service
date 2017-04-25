<?php
/**
 * Created by PhpStorm.
 * User: Hasan
 * Date: 17.10.2016
 * Time: 14:35
 */
namespace App\Helpers;
use App\User;
use Carbon\Carbon;
use Session;
use App\Modules;
use Auth;
use App\UserDelegation;
use Illuminate\Support\Facades\DB;


class Helper
{
    public static function shout($url)
    {
        $url = explode('/', $url);
        $modul = '/'.$url['0'].'/'.$url['1'];

        $id=Modules::where('url',$modul)->select('name')->first()->name;
        $sess=Session::get($id );
        return $sess;
    }
    public static function sessionReload()
    {
        $del_id=Auth::user()->delegation_id;
        $delegation=UserDelegation::where('id',$del_id)->select('auth')->first();

        $json=json_decode($delegation->auth);


        foreach ($json as $key => $str) {
            $name = Modules::where('id', $key)->select('name')->first()->name;
            $read = substr($str, 0, 1);
            $add = substr($str, 1, 1);
            $update = substr($str, 2, 1);
            $delete = substr($str, 3, 1);

            $data = array(
                'r' => $read,
                'a' => $add,
                'u' => $update,
                'd' => $delete,
            );
            Session::put($name, $data);
        }
    }
    public static function MonthNameConverter($oldMonth)
    {
        $search  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $replace = array('OCAK', 'ŞUBAT', 'MART', 'NİSAN', 'MAYIS', 'HAZİRAN', 'TEMMUZ', 'AĞUSTOS', 'EYLÜL', 'EKİM', 'KASIM'    , 'ARALIK');
        $newMonth=str_replace($search, $replace, $oldMonth);
        return $newMonth;
    }

    // Zaman farkını türkçe olarak geri döndürme.
    public static function trDiff($tarih)
    {
        Carbon::setLocale('tr');
        $result = Carbon::parse($tarih)->diffForHumans();
        return $result;
    }

    public static function mesajlar($user,$status,$read)
    {
        $result = DB::table('support')
            ->join('users','support.sender_id','=','users.id')
            ->where('support.receiver_id',$user)
            ->where('support.status',$status)->where('read',$read)
            ->select('support.*','users.name as user_name')
            ->get();

        return $result;
    }
}