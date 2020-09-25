<?php

namespace tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testlogin()
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testloginWithGoodCredentials()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'user',
            '_password' => 'test',
        ]);
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertEquals('http://localhost/', $client->getRequest()->getUri());
    }

    public function testloginWithBadCredentials()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'user',
            '_password' => 'badPassword',
        ]);
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('http://localhost/login', $client->getRequest()->getUri());
        $this->assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }

    public function testlogout()
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertEquals('http://localhost/', $client->getRequest()->getUri());
    }

}
