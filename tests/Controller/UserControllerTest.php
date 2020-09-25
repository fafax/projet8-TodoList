<?php

namespace tests\Controller;
use App\Tests\Controller\AuthConnexionTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testListUsers()
    {
        $client = new AuthConnexionTest();
        $client = $client->testAdminUserConnexion();

        $client->request('GET', '/users');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

     public function testCreateUser()
       {
           $client = new AuthConnexionTest();
           $client = $client->testAdminUserConnexion();

           $client->request('GET', '/users/create');

           $this->assertEquals(200, $client->getResponse()->getStatusCode());
       }

    public function testListUsersforRoleUser()
    {
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();

        $client->request('GET', '/users');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    public function testCreateUserForRoleUser()
    {
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();

        $client->request('GET', '/users/create');

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    public function testListUsersforAnonymeUser()
    {
        $client = new AuthConnexionTest();
        $client = $client->testAnonymeUserConnexion();

        $client->request('GET', '/users');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    public function testCreateUserForAnomymeUser()
    {
        $client = new AuthConnexionTest();
        $client = $client->testAnonymeUserConnexion();

        $client->request('GET', '/users/create');

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    public function testCreateUserForm()
    {
        $client = new AuthConnexionTest();
        $client = $client->testAdminUserConnexion();

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton("Ajouter")->form();
        $this->assertSame(1, $crawler->filter('input[name="user[username]"]')->count());
        $this->assertSame(1, $crawler->filter('input[name="user[password][first]"]')->count());
        $this->assertSame(1, $crawler->filter('input[name="user[password][second]"]')->count());
        $this->assertSame(1, $crawler->filter('input[name="user[email]"]')->count());
        $form["user[username]"] = "utilisateur";
        $form["user[password][first]"] = "mot de passe";
        $form["user[password][second]"] = "mot de passe";
        $form["user[email]"] = "test@test.fr";
        $client->submit($form);
        $this->assertEquals(302 ,$client->getResponse()->getStatusCode());
        $crawler = $client->followRedirect();
        $this->assertContains("Superbe ! L'utilisateur a bien été ajouté.", $crawler->filter('div.alert.alert-success')->text());
    }
    public function testCreateUserFormDifferentPWD()
    {
        $client = new AuthConnexionTest();
        $client = $client->testAdminUserConnexion();

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton("Ajouter")->form();
        $this->assertSame(1, $crawler->filter('input[name="user[username]"]')->count());
        $this->assertSame(1, $crawler->filter('input[name="user[password][first]"]')->count());
        $this->assertSame(1, $crawler->filter('input[name="user[password][second]"]')->count());
        $this->assertSame(1, $crawler->filter('input[name="user[email]"]')->count());
        $form["user[username]"] = "utilisateur";
        $form["user[password][first]"] = "mot de passe";
        $form["user[password][second]"] = "autre mot de passe";
        $form["user[email]"] = "test@test.fr";
        $client->submit($form);
        $this->assertEquals(200 ,$client->getResponse()->getStatusCode());

    }

}
