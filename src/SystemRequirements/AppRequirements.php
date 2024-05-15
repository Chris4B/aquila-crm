<?php

namespace App\SystemRequirements;

use const PHP_VERSION;
use const PHP_VERSION_ID;

class AppRequirements
{
    public function checkRequirements(): array
    {

        
        $errors = [];

        // Vérifiez les exigences système personnalisées ici
        if (version_compare(PHP_VERSION, '7.4.15', '<')) {
            $errors[] = 'PHP version must be at least 7.4.15.';
        }

        // Ajoutez d'autres vérifications d'exigences système personnalisées selon vos besoins

        return $errors;
        
    }

    
}
