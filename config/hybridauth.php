<?php
use Cake\Core\Configure;

return [
    'HybridAuth' => [
        'providers' => [
            'Google' => [
                'enabled' => true,
                'keys' => [
                    'id' => '440116605469-v8kp8rndac7htgfe2fs02oo0a0pgq6m5.apps.googleusercontent.com',
                    'secret' => 'bJ04zWxBGEaEUHAEoi70Go-e'   
                ],
                'redirect_uri' => 'https://forecastclash.com/forecast_clash/hybrid-auth/endpoint?hauth.done=google'
            ],
            'Facebook' => [
                'enabled' => true,
                'keys' => [
                    'id' => '1427081177598582',
                    'secret' => '5b215a7d791dda7abed5d65abd3d1831'
                ],
                'scope' => 'email, user_about_me, user_birthday, user_hometown'
            ],
            'Twitter' => [
                'enabled' => true,
                'keys' => [
                    'key' => 't3GXZhBaG7VrLgVpaefFoNc8R',
                    'secret' => '9huIDFyNhPf7DbKsQX2DrswoL6HH2WidZvkv1rwNh3DQ33aAel'
                ],
                'includeEmail' => true, // Only if your app is whitelisted by Twitter Support
            ]
        ],
        'debug_mode' => Configure::read('debug'),
        'debug_file' => LOGS . 'hybridauth.log',
    ]
];