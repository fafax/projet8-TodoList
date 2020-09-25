<?php


namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;


use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DataFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        /* create anonymous user */
        $UserAnonime = new User();
        $UserAnonime->setUsername('anonyme');
        $UserAnonime->setEmail('anonyme@anonyme.fr');
        $hash = $this->encoder->encodePassword($UserAnonime, "anonyme");
        $UserAnonime->setPassword($hash);
        $UserAnonime->setRoles([]);
        $manager->persist($UserAnonime);

        /* create user */
        $User = new User();
        $User->setUsername('user');
        $User->setEmail('user@user.fr');
        $hash = $this->encoder->encodePassword($User, "test");
        $User->setPassword($hash);
        $User->setRoles(['ROLE_USER']);
        $manager->persist($User);

        /* create admin user */
        $UserAdmin = new User();
        $UserAdmin->setUsername('admin');
        $UserAdmin->setEmail('admin@admin.fr');
        $hash = $this->encoder->encodePassword($UserAdmin, "admin");
        $UserAdmin->setPassword($hash);
        $UserAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($UserAdmin);

        /* create task */

        $task = new task();
        $task->setCreatedAt(new \Datetime());
        $task->setTitle('task anonyme');
        $task->setContent('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
        $manager->persist($task);

        $task2 = new task();
        $task2->setCreatedAt(new \Datetime());
        $task2->setTitle('task user');
        $task2->setContent('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
        $task2->setUser($User);
        $manager->persist($task2);

        $task3 = new task();
        $task3->setCreatedAt(new \Datetime());
        $task3->setTitle('task user');
        $task3->setContent('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
        $task3->setUser($User);
        $manager->persist($task3);

        $manager->flush();
    }
}