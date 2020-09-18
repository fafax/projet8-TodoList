<?php

namespace tests\controller;

use App\Repository\UserRepository;
use App\Tests\controller\AuthConnexionTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseRedirects('http://localhost/login');
    }

      public function testIndexAuth()
      {
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();

          $client->request('GET', '/');
          $this->assertEquals(200, $client->getResponse()->getStatusCode());
      }
}
