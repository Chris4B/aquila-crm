<?php

namespace App\Service\SystemInfo;

class SystemInfoProvider
{
    public function getConnectionsFilePath(): string
    {
        $os = php_uname('s');

        if (stripos($os, 'Windows') !== false) {
            return getenv("APPDATA") . '\\MySQL\\Workbench\\connections.xml';
        } elseif (stripos($os, 'Darwin') !== false) { // MacOs
            return getenv('HOME') . '/Library/Application Support/MySQL/Workbench/connections.xml';
        } else {  // Linux
            return getenv('HOME') . '/.mysql/workbench/connections.xml';
        }
    }

    public function getServerInstancesFilePath(): string
    {
        $os = php_uname('s');

        if (stripos($os, 'Windows') !== false) {
            return getenv("APPDATA") . '\\MySQL\\Workbench\\server_instances.xml';
        } elseif (stripos($os, 'Darwin') !== false) { // macOS
            return getenv('HOME') . '/Library/Application Support/MySQL/Workbench/server_instances.xml';
        } else {  // Linux
            return getenv('HOME') . '/.mysql/workbench/server_instances.xml';
        }
    }

    public function getServiceName(): string
    {
        $os = php_uname('s');
        if (stripos($os, 'Windows') !== false) {
            return 'MySQL80';
        } elseif (stripos($os, 'Darwin') !== false) { // MacOS
            return 'mysql'; // Example service name, update as needed
        } else { // Linux
            return 'mysql'; // Example service name, update as needed
        }
    }

    public function getSshKeyPath(): string
    {
        $os = php_uname('s');
        if (stripos($os, 'Windows') !== false) {
            return getenv("APPDATA") . '\\.ssh\\ssh_private_key';
        } else { // Unix-based systems
            return getenv('HOME') . '/.ssh/ssh_private_key';
        }
    }

    public function getConfigPath(): string
    {
        $os = php_uname('s');
        if (stripos($os, 'Windows') !== false) {
            return 'C:\\ProgramData\\MySQL\\MySQL Server 8.0\\my.ini';
        } elseif (stripos($os, 'Darwin') !== false) { // MacOS
            return '/usr/local/mysql/my.cnf'; // Example path, update as needed
        } else { // Linux
            return '/etc/mysql/my.cnf'; // Example path, update as needed
        }
    }
}

