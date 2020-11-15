<?php


namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TaskEntityTest extends KernelTestCase
{

    public function setTaskAnonyme()
    {

        $task = new Task();
        $task->setTitle("task 1");
        $task->setContent("Je suis le contenue de la task");
        $task->setCreatedAt(new \DateTime());
        return $task;
    }

    public function setTaskUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('user@user.fr');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);

        $task = new Task();
        $task->setTitle("task 1");
        $task->setContent("Je suis le contenue de la task");
        $task->setCreatedAt(new \DateTime());
        $task->setUser($User);
        return $task;
    }

    public function testValidateTaskAnonyme()
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($this->setTaskAnonyme());
        $this->assertCount(0, $error);
    }

    public function testInvalidateTitleTaskAnonyme()
    {
        $task = new Task();
        $task->setContent("Je suis le contenue de la task");
        $task->setCreatedAt(new \DateTime());
        self::bootKernel();
        $error = self::$container->get('validator')->validate($task);
        $this->assertCount(1, $error);
    }

    public function testInvalidateContentTaskAnonyme()
    {
        $task = new Task();
        $task->setTitle('titre');
        $task->setCreatedAt(new \DateTime());
        self::bootKernel();
        $error = self::$container->get('validator')->validate($task);
        $this->assertCount(1, $error);
    }

    public function testValidateTaskUser()
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($this->setTaskUser());
        $this->assertCount(0, $error);
    }

}