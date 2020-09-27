<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('set-anonyme');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

// the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('attribute success anonyme user', $output);

    }
}