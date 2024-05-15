<?php

namespace App\SystemRequirements;

use App\Requirements\SymfonyRequirements;


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
    parent::__construct();

   }

    
}
