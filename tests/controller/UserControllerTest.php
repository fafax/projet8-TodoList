<?php

namespace tests\controller;

use App\Tests\controller\AuthConnexionTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testListUsers()
    {
        $client = static::createClient();

        $client->request('GET', '/users');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

     public function testCreateUser()
       {
           $client = static::createClient();
           $client->request('GET', '/users/create');

           $this->assertEquals(200, $client->getResponse()->getStatusCode());
       }

}
