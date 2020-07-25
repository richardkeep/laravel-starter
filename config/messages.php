<?php

return [
    'user' => [
        'create' => [
            'not_allowed_role' => 'Only a super admin can create another super admin.'
        ],
        'update' => [
            'not_allowed_role' => 'Only a super admin can make someone super admin.'
        ]
    ]
];
