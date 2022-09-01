<?php

return [
    'driver' => 'smtp',
    'host' => 'smtp.sendgrid.net',
    'port' => 587,
    'from' => [
        'address' => 'noreply@nataalam.org',
        'name' => 'Nataalam.org'
    ],
    'encryption' => 'tls',
    'username' => env('SENDGRID_USERNAME'),
    'password' => env('SENDGRID_PASSWORD'),
];