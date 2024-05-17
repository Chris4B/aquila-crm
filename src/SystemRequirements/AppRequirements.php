<?php

namespace App\SystemRequirements;

use App\Requirements\SymfonyRequirements;
use PDO;

class AppRequirements extends SymfonyRequirements
{
   public function __construct()
   {
    $this->addRequirement(
        PHP_VERSION_ID >= 70415,
        sprintf('PHP version must be at least %s (%s installed)', '7.4.15', PHP_VERSION),
        sprintf(
            'You are running PHP version "<strong>%s</strong>", but SolidInvoice needs at least PHP "<strong>%s</strong>" to run.
        Before using SolidInvoice, upgrade your PHP installation, preferably to the latest version.',
            '7.4.15',
            PHP_VERSION
        ),
        sprintf('Install PHP %s or newer (installed version is %s)', '7.4.15', PHP_VERSION)
    );
    // parent::__construct();

    //Check all Extensions needed

    $requiredExtensions = [
        'pdo',
        'pdo_mysql',
        // 'pdo_pgsql',
        'mbstring',
        'json',
        'openssl',
        // 'curl',
        'intl',
        'gd',
        // 'zip',
    ];

    foreach($requiredExtensions as  $extension){
        $this->addRequirement(
            extension_loaded($extension),
            sprintf('The PHP extension "%s" must be installed and enabled.', $extension),
            sprintf(
                'Install and enable the <strong>%s</strong> extension.',
                $extension
            ),
            sprintf('The PHP extension "%s" is not available.', $extension)
        );
    }

    // available PDO drivers

    $pdoDrivers = PDO::getAvailableDrivers();
        $this->addRequirement(
            !empty($pdoDrivers),
            'At least one PDO driver must be available.',
            'No PDO drivers are available. Install a PDO driver such as pdo_mysql or pdo_pgsql.',
            'No PDO drivers are available.'
        );

    // Write permissions
    // $configPath = __DIR__ . '/../../config/';
    // $this->addRequirement(
    //     is_writable($configPath),
    //     sprintf('The directory "%s" must be writable.', $configPath),
    //     sprintf(
    //         'The directory "<strong>%s</strong>" is not writable. Change the permissions of the directory to make it writable.',
    //         $configPath
    //     ),
    //     sprintf('The directory "%s" is not writable.', $configPath)
    // );

    // Memory limit
    $this->addRequirement(
        $this->compareMemoryLimit('128M'),
        sprintf('The PHP memory limit should be at least %s.', '128M'),
        sprintf(
            'The PHP memory limit is too low. Change the <strong>memory_limit</strong> setting in your php.ini file to at least "<strong>%s</strong>".',
            '128M'
        ),
        sprintf('The PHP memory limit is too low.')
    );

    // Max execution time
    $this->addRequirement(
        ini_get('max_execution_time') >= 30,
        'The PHP max execution time should be at least 30 seconds.',
        'The PHP max execution time is too low. Change the <strong>max_execution_time</strong> setting in your php.ini file to at least "<strong>30</strong>".',
        'The PHP max execution time is too low.'
    );

    // OPcache extension
    // $this->addRequirement(
    //     extension_loaded('Zend OPcache'),
    //     'The OPcache extension should be installed and enabled.',
    //     'The OPcache extension is not enabled. Install and enable the <strong>Zend OPcache</strong> extension.',
    //     'The OPcache extension is not enabled.'
    // );

    // Internet connection
    $this->addRequirement(
        $this->checkInternetConnection(),
        'The server must have an active Internet connection.',
        'The server does not have an active Internet connection. Check your network settings and ensure the server can connect to the Internet.',
        'No active Internet connection.'
    );

    // Recommend increasing memory limit
    $this->addRecommendation(
        $this->compareMemoryLimit('256M'),
        sprintf('It is recommended to have at least %s of memory limit.', '256M'),
        sprintf(
            'The PHP memory limit is less than recommended. Change the <strong>memory_limit</strong> setting in your php.ini file to at least "<strong>%s</strong>".',
            '256M'
        ),
        sprintf('The PHP memory limit is less than recommended.')
    );

    // Recommend increasing max execution time
    $this->addRecommendation(
        ini_get('max_execution_time') >= 60,
        'It is recommended to have at least 60 seconds of max execution time.',
        'The PHP max execution time is less than recommended. Change the <strong>max_execution_time</strong> setting in your php.ini file to at least "<strong>60</strong>".',
        'The PHP max execution time is less than recommended.'
    );

    // Recommend enabling OPcache
    $this->addRecommendation(
        extension_loaded('Zend OPcache'),
        'It is recommended to have OPcache enabled for better performance.',
        'The OPcache extension is not enabled. Enabling OPcache can improve performance.',
        'OPcache is not enabled.'
    );

   }

   private function compareMemoryLimit(string $requiredLimit): bool
   {
       $memoryLimit = ini_get('memory_limit');
       return $this->convertToBytes($memoryLimit) >= $this->convertToBytes($requiredLimit);
   }

   private function convertToBytes(string $value): int
   {
       $units = ['B' => 1, 'K' => 1024, 'M' => 1048576, 'G' => 1073741824];
       $unit = strtoupper(substr($value, -1));
       $number = (int) substr($value, 0, -1);
       return $number * ($units[$unit] ?? 1);
   }

   private function checkInternetConnection(): bool
    {
        return (bool) @fsockopen('www.google.com', 80, $errno, $errstr, 2);
    }
}
