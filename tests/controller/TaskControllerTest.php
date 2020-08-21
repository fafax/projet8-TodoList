<?php

namespace tests\controller;

use App\Tests\controller\AuthConnexionTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TackControllerTest extends WebTestCase
{
    public function testTasks()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('http://localhost/login', $client->getRequest()->getUri());
    }

     public function testTasksAuth()
       {
           $client = new AuthConnexionTest();
           $client = $client->testConnexion();

           $client->request('GET', '/tasks');

           $this->assertEquals(200, $client->getResponse()->getStatusCode());
       }

}
