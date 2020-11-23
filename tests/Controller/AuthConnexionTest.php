<?php


namespace App\Tests\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthConnexionTest extends WebTestCase
{

    public function testUserConnexion()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user@user.fr');
        $client->loginUser($testUser);
        return $client;
    }

    public function testAnonymeUserConnexion()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('anonyme@anonyme.fr');
        $client->loginUser($testUser);
        return $client;
    }

    public function testAdminUserConnexion()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@admin.fr');
        $client->loginUser($testUser);
        return $client;
    }
}