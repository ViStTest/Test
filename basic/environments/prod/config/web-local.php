<?php
/**
 * Created by PhpStorm.
 * User: ViSt
 * Date: 04.09.2017
 * Time: 14:18
 */

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=prod_db',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

        // ... other components ...
    ],
];