<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'shops' => 'r',
            'products' => 'r',



        ],
        'delivery_serviceprovider' => [
            'users' => 'r',
            'shops' => 'r',
            'products' => 'r',


        ],
        'shop_owner' => [
            'shops' => 'c,r,u,d',
            'products' => 'c,r,u,d',



        ],
        'costumer' => [
            'shops' => 'r',
            'products' => 'r',

        ],


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
