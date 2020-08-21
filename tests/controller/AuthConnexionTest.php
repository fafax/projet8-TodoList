<?php


namespace App\Tests\controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthConnexionTest extends WebTestCase
{

    public function testConnexion(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('fabienhamayon@gmail.fr');
        $client->loginUser($testUser);
        return $client;
    }
}