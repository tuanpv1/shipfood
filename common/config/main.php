<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'phptest102@gmail.com',
                'password' => '102phptest',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
    'aliases' => [
        '@image_file' => 'upload/file',
        '@image_banner' => 'upload/image_banner',
        '@image_news' => 'upload/image_news',
        '@images' => 'images',
    ],
];
