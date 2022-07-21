<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Entity\Category;


class AdminControllerKernelTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testSearchUserByName()
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['name' => 'user2'])
        ;

        $this->assertSame('user2@user.com', $user->getEmail());
    }
    

    public function testCategoryCanBeCreatedInDatabase()
    {
        $category = new Category();
        $category->setName('category testing');
        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $categoryRepository = $this->entityManager->getRepository(Category::class);
        $categoryRecord = $categoryRepository->findOneBy(['name' => 'category testing']);

        $this->assertEquals('category testing', $categoryRecord->getName());

    }
 
}
