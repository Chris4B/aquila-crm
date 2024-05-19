<?php

namespace App\Entity;


class DatabaseConfig
{

    
    private ?string $databaseHost = null;

    
    private ?string $databasePort = null;

    
    private ?string $databaseName = null;

   
    private ?string $databaseUser = null;

    
    private ?string $databasePassword = null;



    public function getDatabaseHost(): ?string
    {
        return $this->databaseHost;
    }

    public function setDatabaseHost(?string $databaseHost): static
    {
        $this->databaseHost = $databaseHost;

        return $this;
    }

    public function getDatabasePort(): ?string
    {
        return $this->databasePort;
    }

    public function setDatabasePort(?string $databasePort): static
    {
        $this->databasePort = $databasePort;

        return $this;
    }

    public function getDatabaseName(): ?string
    {
        return $this->databaseName;
    }

    public function setDatabaseName(?string $databaseName): static
    {
        $this->databaseName = $databaseName;

        return $this;
    }

    public function getDatabaseUser(): ?string
    {
        return $this->databaseUser;
    }

    public function setDatabaseUser(?string $databaseUser): static
    {
        $this->databaseUser = $databaseUser;

        return $this;
    }

    public function getDatabasePassword(): ?string
    {
        return $this->databasePassword;
    }

    public function setDatabasePassword(?string $databasePassword): static
    {
        $this->databasePassword = $databasePassword;

        return $this;
    }
}
