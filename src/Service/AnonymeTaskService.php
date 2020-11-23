<?php


namespace App\Service;

use App\Entity\User;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AnonymeTaskService
{
    private $em;
    private $encoder;
    private $anomymeUser = NULL;

    public function __construct(EntityManagerInterface $em, TaskRepository $taskRepository, UserPasswordEncoderInterface $encoder, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->encoder = $encoder;

        $this->anomymeUser = $userRepository->findOneBy(['username' => User::ANONYME]);

        /* create user anonymous if don't exist */

        if ($this->anomymeUser == NULL) {
            $UserAnonime = new User();
            $UserAnonime->setUsername(User::ANONYME);
            $UserAnonime->setEmail(User::EMAIL);
            $UserAnonime->setRoles([]);

            $hash = $this->encoder->encodePassword($UserAnonime, User::ANONYME);
            $UserAnonime->setPassword($hash);

            $this->em->persist($UserAnonime);
            $this->em->flush();
        }

        $this->checkTask($taskRepository);
    }

    public function checkTask(TaskRepository $taskRepository)
    {
        $tasks = $taskRepository->findBy(["user" => NULL]);
        foreach ($tasks as $value) {
            $this->setAnonymeTask($value);
        }

    }

    public function setAnonymeTask($task)
    {
        try {
            $task->setUser($this->anomymeUser);
            $this->em->persist($task);
            $this->em->flush();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }


    }
}