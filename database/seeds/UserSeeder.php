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
        $user->first_name = 'Mr.';
        $user->last_name = 'Admin';
        $user->password = Hash::make("12345");
        $user->email = 'bkbkucse@gmail.com';
        $user->role = 1;
        $user->activestatus = 1;
        $user->reset_code=md5($user->email . uniqid());
        $user->save();

    }
}
