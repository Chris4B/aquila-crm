<?php

namespace App\Controller\Install;

use App\SystemRequirements\AppRequirements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RequirementsController extends AbstractController
{
    #[Route('/', name: 'app_install_requirements')]
    public function index(): Response
    {
        $requirements = new AppRequirements();
       

        // dd($requirements->getRequirements());
        return $this->render('install/requirements/index.html.twig', [
            'requirements' => $requirements,
        ]);
    }
}
