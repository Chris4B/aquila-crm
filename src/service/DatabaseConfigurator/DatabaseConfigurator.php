<?php


namespace App\Service\DatabaseConfigurator;

use PDO;
use PDOException;

class DatabaseConfigurator implements DatabaseConfiguratorInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function configure(string $host, string $port, string $dbname, string $user, string $password): bool
    {
        try {
            $dsn = "mysql:host=$host;port=$port;charset=utf8";
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            echo "Database configured successfully.";
            return true;
        } catch (PDOException $e) {
            // Handle the exception or log it
            return false;
        }
    }
}