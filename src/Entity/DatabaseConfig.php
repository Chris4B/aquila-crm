<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;


class DatabaseConfig
{
    
    private string  $connectionName = 'Aquilas-CRM';

    #[Assert\NotBlank]
    private ?string $databaseDriver = null;

    #[Assert\NotBlank]
    private ?string $databaseHost = null;

    #[Assert\NotBlank]
    private ?string $databasePort = null;

    #[Assert\NotBlank]
    private ?string $databaseName = null;

    #[Assert\NotBlank]
    private ?string $databaseUser = null;

    
    private ?string $databasePassword = '';

    public function getConnectionName(): string
    {
        return $this->connectionName;
    }

    public function setDatabaseDriver(?string $databaseDriver): self
    {
        $this->databaseDriver = $databaseDriver;
        return $this;
    }
    public function getDatabaseDriver(): ?string
    {
        return $this->databaseDriver;
    }

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
