<?php

namespace App\Controller\Install;

use App\Entity\DatabaseConfig;
use App\Form\Database\DatabaseConfigType;
use App\Service\DatabaseConfigurator\DatabaseConfigurator;
use App\Service\DatabaseConnection\DatabaseConnectionConfiguratorInterface;
use PDO;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseConfigController extends AbstractController
{

    private DatabaseConfigurator $databaseConfigurator;

    public function __construct(DatabaseConnectionConfiguratorInterface $databaseConnectionConfigurator, DatabaseConfigurator $databaseConfigurator)
    {
        $this->databaseConfigurator = $databaseConfigurator;
    }

    #[Route('/install', name: 'app_install_database_config')]
    public function databaseConfig(DatabaseConfigurator $dbConfigurator, Request $request, LoggerInterface $logger): Response
    {
        $availableDrivers = PDO::getAvailableDrivers();
        $logger->info("Available PDO drivers: " . implode(", ", $availableDrivers));

        $databaseConfig = new DatabaseConfig();

        $form = $this->createForm(DatabaseConfigType::class, $databaseConfig, [
            'available_drivers' => $availableDrivers
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $logger->info("Form data: " . json_encode($data));

            $logger->info(sprintf(
                'Driver: %s, Host: %s, Port: %s, Name: %s, User: %s, Password: %s',
                $data->getDatabaseDriver(),
                $data->getDatabaseHost(),
                $data->getDatabasePort(),
                $data->getDatabaseName(),
                $data->getDatabaseUser(),
                $data->getDatabasePassword() ?? 'NULL'
            ));

            $result = $this->databaseConfigurator->configure(
                $data->getDatabaseDriver(),
                $data->getDatabaseHost(),
                $data->getDatabasePort(),
                $data->getDatabaseName(),
                $data->getDatabaseUser(),
                $data->getDatabasePassword()
            );

            if ($result) {
                $logger->info("MySQL Workbench connection added successfully.");
                $this->addFlash('success', 'Database configured successfully.');
            } else {
                $logger->error("Failed to add MySQL Workbench connection.");
                $this->addFlash('error', 'Database configuration failed.');
            }

            return $this->redirectToRoute('configure_database_form');
        }

        return $this->render('install/requirements/databaseConfig.html.twig', [
            'database_form' => $form->createView(),
        ]);
    }

    #[Route('/install/configure', name: 'configure_database_form')]
    public function showForm(): Response
    {
        $databaseConfig = new DatabaseConfig();
        $form = $this->createForm(DatabaseConfigType::class, $databaseConfig);

        return $this->render('install/requirements/databaseConfig.html.twig', [
            'database_form' => $form->createView()
        ]);
    }
}
