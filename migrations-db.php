<?php

// return the database configuration for migrations

// load env variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// load ssl certificate
$options = [
];
if ($_ENV['SSL_CERT_PATH']) {
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $_ENV['SSL_CERT_PATH'],
    ];
}

return [
    'driver' => 'pdo_mysql',
    'host' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'driverOptions' => $options,
];