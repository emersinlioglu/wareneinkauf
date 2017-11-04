<?php

$dbConfig = [];

switch (getenv('APPLICATION_ENV')) {
    case 'development':
        $dbConfig = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=abgproject',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ];
        break;
    case 'staging':
        $dbConfig = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=abgproject-staging',
            'username' => 'root',
            'password' => 'Sicher4uns',
            'charset' => 'utf8',
        ];
        break;
    case 'live':
        $dbConfig = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=abgproject',
            'username' => 'root',
            'password' => 'Sicher4uns',
            'charset' => 'utf8',
        ];
        break;
}

return $dbConfig;