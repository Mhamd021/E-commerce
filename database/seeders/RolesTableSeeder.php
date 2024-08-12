<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = \App\Models\Role::create([
         'name' => 'super-admin',
         'display_name' => 'super admin',
         'description' => 'manage user roles and permissions',
        ]);

        $serviceProvider = \App\Models\Role::create([
            'name' => 'service-provider',
            'display_name' => 'service provider',
            'description' => 'provides delivery service ',
           ]);

           $ShopOwner = \App\Models\Role::create([
            'name' => 'shop-owner',
            'display_name' => 'shop owner',
            'description' => 'create stores and add its products',
           ]);

           $costumer = \App\Models\Role::create([
            'name' => 'costumer',
            'display_name' => 'costumer',
            'description' => ' serf and order',
           ]);
    }//end of run
}//end of seeder


