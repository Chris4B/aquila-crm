<?php

namespace App\Service\DatabaseConfigurator;

interface DatabaseConfiguratorInterface
{
    public function configure(string $host, string $port, string $dbname, string $user, string $password): bool; 
}