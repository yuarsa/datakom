<?php

return [
    'role_structure' => [
        'superadmin' => [
            'dashboard-admin' => 'r',
            'auth-users' => 'c,r,u,d',
            'auth-roles' => 'c,r,u,d',
            'auth-permissions' => 'c,r,u,d',
            'monitorings' => 'c,r,u,d'
        ],
        'analis' => [
            'dashboard-admin' => 'r',
            'monitorings' => 'r'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'i' => 'import',
        'e' => 'export'
    ]
];
