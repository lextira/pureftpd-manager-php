<?php

return [
    'host' => env('LEXTIRA_PUREFTPD_HOST', 'http://localhost'),
    'auth_token' => env('LEXTIRA_PUREFTPD_AUTH_KEY', ''),
    'api_path' => env('LEXTIRA_PUREFTPD_API_PATH', '/api/v1/'),
];