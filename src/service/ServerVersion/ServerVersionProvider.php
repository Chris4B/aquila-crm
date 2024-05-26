<?php

namespace App\Service\ServerVersion;

use Exception;
use PDO;
use Psr\Log\LoggerInterface;

class ServerVersionProvider
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getServerVersion(string $hostname, string $port, ?string $username, string $password): string
    {
        try {
            $dsn = "mysql:host=$hostname;port=$port";
            $pdo = new PDO($dsn, $username, $password);
            $stmt = $pdo->query("SELECT VERSION()");
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            $this->logger->error("Erreur lors de la récupération de la version du serveur : " . $e->getMessage());
            throw new Exception("Erreur lors de la récupération de la version du serveur : " . $e->getMessage());
        }
    }
}
