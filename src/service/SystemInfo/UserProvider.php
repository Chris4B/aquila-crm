<?php

namespace App\Service\SystemInfo;


class UserProvider
{
    public function getSshLocalPort(): string
    {
        return '3306'; // Default MySQL port, update as needed
    }

    public function getSshUserName(): string
    {
        return 'mysql'; // Default MySQL user, update as needed
    }

    public function isWindowsAdmin(): bool
    {
        // Check if the user is a Windows administrator
        if (stripos(php_uname('s'), 'Windows') !== false) {
            return shell_exec('net session') !== null;
        }

        // For non-Windows systems, assume admin access
        return true;
    }
}