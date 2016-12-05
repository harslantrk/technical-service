<?php

use Illuminate\Database\Seeder;
use App\UserDelegation;

class DelegationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delegation = new UserDelegation();
        $delegation->name = 'Admin';
        $delegation->auth = '{"1":"1111","2":"1111","3":"1111","4":"1111","5":"1111","6":"1111","7":"1111","8":"1111","9":"1111"}';
        $delegation->status = 1;
        $delegation->save();

    }
}
