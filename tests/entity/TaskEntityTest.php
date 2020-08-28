<?php


namespace App\Tests\entity;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskEntityTest extends KernelTestCase
{

    public function getTask(){
        return (new Task())
            ->setCreatedAt(new \DateTime())
            ->setTitle("task 1")
            ->setContent("Je suis le contenue de la task")
            ->setUser();
    }

}