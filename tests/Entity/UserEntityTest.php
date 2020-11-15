<?php


namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEntityTest extends KernelTestCase
{


    public function setUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('user@user.fr');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);
        return $User;
    }

    public function testValidateUser()
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($this->setUser());
        $this->assertCount(0, $error);
    }

    public function testInvalidateUsernameUser()
    {
        $User = new User();
        $User->setEmail('user@user.fr');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }

    public function testInvalidateEmailUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }

    public function testInvalidatePWDUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('user@user.fr');
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }

    public function testInvalidateEmailFormateUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('useruser.fr');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }

    public function testInvalidatePWDFormateUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('user@user.fr');
        $User->setPassword("testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest");
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }

    public function testInvalidateEmailLimiteUser()
    {
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('useruseruseruseruseruseruseruseruseruseruseruseruseruseruseruseruseruseruseruser@user.fr');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }

    public function testInvalidateUsernameLimitUser()
    {
        $User = new User();
        $User->setUsername('useruseruseruseruseruseruseruser');
        $User->setEmail('user@user.fr');
        $User->setPassword("test");
        $User->setRoles(['ROLE_USER']);
        self::bootKernel();
        $error = self::$container->get('validator')->validate($User);
        $this->assertCount(1, $error);
    }


}