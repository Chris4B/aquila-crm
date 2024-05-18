<?php


namespace App\Service\DatabaseConfigurator;

use PDO;

class DatabaseConnectionFactory
{
    public static function createConnection(): PDO
    {
        $dsn = 'mysql:host=localhost;port=3306;charset=utf8'; // Default values, can be overridden
        $username = 'root';
        $password = '';

        return new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}