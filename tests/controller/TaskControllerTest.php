<?php

namespace tests\controller;

use App\Entity\Task;
use App\Tests\controller\AuthConnexionTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
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
           $client = $client->testUserConnexion();

           $client->request('GET', '/tasks');
           $this->assertEquals(200, $client->getResponse()->getStatusCode());
       }
    /* check validate form with the good value */

       public function testCreateTask(){
           $client = new AuthConnexionTest();
           $client = $client->testUserConnexion();


           $crawler = $client->request('GET', '/tasks/create');
           $form = $crawler->selectButton('Ajouter')->form();

           // set some values
           $form['task[title]'] = 'titre';
           $form['task[content]'] = 'texte';

            // submit the form
           $crawler = $client->submit($form);

           $this->assertEquals(302, $client->getResponse()->getStatusCode());

       }

    /* check no validate form if don't have a content */

    public function testInvalidateTitleCreateTask(){
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();


        $crawler = $client->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form();

        // set some values
        $form['task[title]'] = 'titre';

        // submit the form
        $crawler = $client->submit($form);

        $this->assertNotEquals(302, $client->getResponse()->getStatusCode());

    }

    /* check no validate form if don't have a title */

    public function testInvalidateTextCreateTask(){
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();


        $crawler = $client->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form();

        // set some values
        $form['task[content]'] = 'texte';

        // submit the form
        $crawler = $client->submit($form);

        $this->assertNotEquals(302, $client->getResponse()->getStatusCode());
    }

    /* check validate form after edit task */

    public function testvalidateEditTask(){
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();


       $client->request('GET', '/tasks/24/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /* check inValidate form after edit task */

    public function testInvalidateEditTask(){
        $client = new AuthConnexionTest();
        $client = $client->testAnonymeUserConnexion();

        $client->request('GET', '/tasks/25/edit');

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    /* check Validate form delete task */

    public function testValidateDeleteTask(){
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();

        $client->request('GET', '/tasks/24/delete');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    /* check inValidate form delete task */

    public function testInValidateDeleteTask(){
        $client = new AuthConnexionTest();
        $client = $client->testAnonymeUserConnexion();

        $client->request('GET', '/tasks/25/delete');

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    /* check inValidate form delete task already */

    public function testInValidateDeleteTaskAlreadyDelete(){
        $client = new AuthConnexionTest();
        $client = $client->testUserConnexion();

        $client->request('GET', '/tasks/24/delete');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /* check Validate form delete anonyme task  */

    public function testValidateDeleteAnonymeTask(){
        $client = new AuthConnexionTest();
        $client = $client->testAdminUserConnexion();
        $client->request('GET', '/tasks/23/delete');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }


}
