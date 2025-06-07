<?php

return [

'paths' => [
    'api/*',
    'getDeviceList',
    'getTechnicianList',
    'getUserById', // 👈 AÑADE ESTA LÍNEA
],


    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
