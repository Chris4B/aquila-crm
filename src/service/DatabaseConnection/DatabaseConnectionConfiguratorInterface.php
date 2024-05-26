<?php

namespace App\Service\DatabaseConnection;


interface DatabaseConnectionConfiguratorInterface
{
    public function addMysqlWorkbenchConnection(
        string $connectionName,
        string $hostname,
        string $port,
        string $username,
        ?string $password,
        string $schema = ""

    ): bool;

    // public function addServerInstance(
    //     string $instanceName,
    //     string $connectionId,
    //     string $sshHostName,
    //     string $sshKeyPath,
    //     string $sshLocalPort,
    //     string $sshUserName,
    //     bool $isWindowsAdmin,
    //     string $configPath,
    //     string $serviceName
    // ): bool;
    
}