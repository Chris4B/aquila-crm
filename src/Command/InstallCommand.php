<?php

namespace App\Command;

use App\SystemRequirements\AppRequirements;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:check-requirements',
    description: 'Check system requirements for the application.',
)]
class InstallCommand extends Command
{
    private AppRequirements $requirements;

    public function __construct(AppRequirements $requirements)
    {
        parent::__construct();
        $this->requirements = $requirements;
    }

    protected function configure(): void
    {
        $this->setDescription('Check system requirements for the application.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Checking System Requirements');

        // Check system requirements
        $errors = $this->requirements->getFailedRequirements();
        $warnings = $this->requirements->getFailedRecommendations();

        

        if (!empty($errors)) {
            foreach ($errors as $error) {
                $io->error($error->getTestMessage());
            }
            $io->error('System requirements check failed. Please review the requirements.');
            return Command::FAILURE;
        }

        if (!empty($warnings)) {
            foreach ($warnings as $warning) {
                $io->warning($warning->getTestMessage());
            }
        }

        $io->success('System requirements check passed. Your system meets the requirements.');

        return Command::SUCCESS;
    }
}
