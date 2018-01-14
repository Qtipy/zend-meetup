<?php

use Doctrine\DBAL\Driver\PDOMySql\Driver;


return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host'     => '127.0.0.1',
                    'port'     => '8889',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'meetup',
                ],
            ],
        ],
    ],
];
