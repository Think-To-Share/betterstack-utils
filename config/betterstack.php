<?php

return [
    'heartbeat_url' => env('BETTERSTACK_HEARTBEAT_URL', 'https://uptime.betterstack.com/api/v1/heartbeat'),
    'heartbeats' => [
        'email' => env('BETTERSTACK_HEARTBEAT_EMAIL'),
    ],
];
