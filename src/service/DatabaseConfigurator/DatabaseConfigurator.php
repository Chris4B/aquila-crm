<?php


namespace App\Service\DatabaseConfigurator;


use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Psr\Log\LoggerInterface;

class DatabaseConfigurator implements DatabaseConfiguratorInterface
{
    
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
       
        $this->logger = $logger;
    }

    public function configure(string $host, string $port, string $dbname, string $user, ?string $password, ?string $charset = null): bool
    {
        $params = [
            'dbname' => null,
            '$user' =>$user,
            'password' =>$password,
            'host' => $host,
            'port' => $port,
            
            
        ];

        try{
            // create a temporay connection 
            $connection = DriverManager::getConnection($params);
            $this->logger->info("Doctrine connection is established");


            //create the database if it doesn't exist
            $schemaManager = $connection->createSchemaManager();
            $databases = $schemaManager->listDatabases();

            if (!in_array($dbname, $databases)) {
                $schemaManager->createDatabase($dbname);
                $this->logger->info("Database `$dbname` created");
            } else {
                $this->logger->info("Database `$dbname` already exists");
            }

            return true;
        } catch (Exception $e) {
            $this->logger->error("Database configuration failed: " . $e->getMessage());
            return false;
        }

        


    }
}