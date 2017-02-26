<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'Sefa Kendirli';
        $user->username = 'blacq0o';
        $user->email = 'sefa.kendirli@gmail.com';
        $user->password = bcrypt('123456789');
        $user->group_id = 2;
        $user->sms_code = 61031;
        $user->status = 1;
        $user->delegation_id = 1;

        $user->save();

        $user = new User();
        $user->name = 'Hasan Arslantürk';
        $user->username = 'harslantrk';
        $user->email = 'harslantrk@gmail.com';
        $user->password = bcrypt('123456789');
        $user->group_id = 2;
        $user->sms_code = 61031;
        $user->status = 1;
        $user->delegation_id = 1;

        $user->save();
    }
}
