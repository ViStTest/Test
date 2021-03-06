<?php
/**
 * Created by PhpStorm.
 * User: ViSt
 * Date: 04.09.2017
 * Time: 14:16
 */

$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'test',
            'password' => '',
            'charset' => 'utf8',
        ],

        // ... other components
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;