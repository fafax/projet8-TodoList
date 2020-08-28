<?php

namespace App\Command;

use App\Service\AnonymeTaskService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetAnonymeCommand extends Command
{
    protected static $defaultName = 'set-anonyme';

    public function __construct(AnonymeTaskService $anonymeTaskService)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('attribute anonyme user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->success('attribute success anonyme user');

        return 0;
    }
}
