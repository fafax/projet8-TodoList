<?php

namespace tests\Service;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnonymeService extends WebTestCase
{
    public function testAnonymeService()
    {
        self::bootKernel();

        $task = new Task();
        $task->setTitle("task anonyme");
        $task->setContent("Je suis le contenue de la task");
        $task->setCreatedAt(new \DateTime());

        self::$container->get('Doctrine\ORM\EntityManagerInterface')->persist($task);
        self::$container->get('Doctrine\ORM\EntityManagerInterface')->flush();

        $task = self::$container->get('doctrine')->getRepository(Task::class)->findOneBy(['title' => 'task anonyme']);

        $this->assertEmpty($task->getUser());
        self::$container->get('App\Service\AnonymeTaskService');
        $this->assertEquals($task->getUser(), self::$container->get('doctrine')->getRepository(User::class)->findOneBy(['username' => 'anonyme']));

    }

}
