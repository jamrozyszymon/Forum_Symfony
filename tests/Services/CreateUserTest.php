<?php

namespace App\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Tests\DatabasePrimer;
use App\Entity\User;

class CreateUserTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        DatabasePrimer::prime($kernel);
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testAUserCanBeAddedToDatabase()
    {
        $user = new User();
        $user->setName('Test');
        $user->setEmail('test@test.com');
        $user->setPassword('123123123');
        $user->setRoles([]);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $userRepository = $this->entityManager->getRepository(User::class);
        $userRecord = $userRepository->findOneBy(['name' => 'Test']);

        $this->assertEquals('Test', $userRecord->getName());
        $this->assertEquals('test@test.com', $userRecord->getEmail());
        $this->assertEquals('123123123', $userRecord->getPassword());
        $this->assertEquals(['ROLE_USER'], $userRecord->getRoles());
    }
    
}
