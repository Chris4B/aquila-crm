<?php

namespace App\Controller\Install;

use App\Entity\DatabaseConfig;
use App\Form\Database\DatabaseConfigType;
use App\Service\DatabaseConfigurator\DatabaseConfigurator;
use App\SystemRequirements\AppRequirements;
use PDO;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RequirementsController extends AbstractController
{
    #[Route('/', name: 'app_install_requirements')]
    public function index(): Response
    {
        $requirements = new AppRequirements();
       

        // dd($requirements->getRequirements());
        return $this->render('install/requirements/requirements.html.twig', [
            'requirements' => $requirements,
        ]);
    }

    #[Route('/install', name:'app_install_database_config')]
    public function databaseConfig(DatabaseConfigurator $dbConfigurator, Request $request, LoggerInterface $logger): Response
    {   
       $availableDrivers = PDO::getAvailableDrivers();
       $logger->info("Available PDO drivers: " . implode(", ", $availableDrivers));

        $databaseConfig = new DatabaseConfig();


       $form = $this->createForm(DatabaseConfigType::class,
        $databaseConfig,[
            'available_drivers' => $availableDrivers
            ]
         );
        // dd($dbConfigurator);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $logger->info("Form data: " . json_encode($data));

            $logger->info(sprintf('Driver: %s, Host: %s, Port: %s, Name: %s, User: %s, Password: %s', 
            $data->getDatabaseDriver(),
            $data->getDatabaseHost(),
            $data->getDatabasePort(),
            $data->getDatabaseName(),
            $data->getDatabaseUser(),
            $data->getDatabasePassword() ?? 'NULL'
        ));
            $result = $dbConfigurator->configure(
                $data->getDatabaseHost(),
                $data->getDatabasePort(),
                $data->getDatabaseName(),
                $data->getDatabaseUser(),
                $data->getDatabasePassword()
            );

            

            if ($result) {
                $this->addFlash('success', 'Database configured successfully.');
            } else {
                $this->addFlash('error', 'Database configuration failed.');
            }
            return $this->redirectToRoute('configure_database_form');
        } else{
            $logger->info("Form is not submitted or is invalid.");
        }



        return $this->render('install/requirements/databaseConfig.html.twig',[
            'database_form' => $form->createView(),
        ]);
    }

    #[Route('/install/configure', name: 'configure_database_form')]
    public function showForm(): Response
    {
        $databaseConfig = new DatabaseConfig();
        $form = $this->createForm(DatabaseConfigType::class, $databaseConfig);
        
        return $this->render('install/requirements/databaseConfig.html.twig',[
            'database_form' => $form->createView()
        ]);
    }
}
