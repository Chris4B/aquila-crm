<?php


namespace App\Service\DatabaseConfigurator;

use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class DatabaseConfigurator implements DatabaseConfiguratorInterface
{
    private PDO $pdo;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        // $this->pdo = $pdo;
        $this->logger = $logger;
    }

    public function configure(string $host, string $port, string $dbname, string $user, ?string $password): bool
    {
        try {
            $dsn = "mysql:host=$host;port=$port;charset=utf8";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->logger->info("PDO connection established");

            //Create the database if it doesn't exist
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $this->logger->info("Database `$dbname` created or already exists");


            return true;
        } catch (PDOException $e) {
              $this->logger->error("Database configuration failed: " . $e->getMessage());
            return false;
        }
    }
}