<?php


namespace App\Service\DatabaseConfigurator;


use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;


class DatabaseConnectionFactory
{
    public static function createConnection(array $params): Connection
    {
        return DriverManager::getConnection($params);
    }
}