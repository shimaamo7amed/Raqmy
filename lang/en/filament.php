<?php

return [
    'pages' => [
        'auth' => [
            'login' => [
                'title' => 'Sign in',
                'heading' => 'Sign in to your account',
                'buttons' => [
                    'submit' => [
                        'label' => 'Sign in',
                    ],
                ],
                'fields' => [
                    'email' => [
                        'label' => 'Email',
                        'placeholder' => 'Enter your email',
                    ],
                    'password' => [
                        'label' => 'Password',
                        'placeholder' => 'Enter your password',
                    ],
                ],
                'messages' => [
                    'failed' => 'These credentials do not match our records.',
                    'throttled' => 'Too many login attempts. Please try again in :seconds seconds.',
                ],
            ],
        ],
    ],
];
