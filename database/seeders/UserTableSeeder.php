<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
         'name' => 'super admin',
         'email' => 'mhamdghanoumstr@gmail.com',
         'password' => bcrypt(value ('wakemeupwhenitsallover')),

        ]);

        $user->attachRole('super_admin');


    }//end of run
}//end of seeder
