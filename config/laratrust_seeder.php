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

    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'sliders' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'attr' => 'c,r,u,d',
            'daytour' => 'c,r,u,d',
            'vedios' => 'c,r,u,d',
            'gallery' => 'c,r,u,d',
            'que_ans' => 'c,r,u,d',

        ],
        'admin' => []
        
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
