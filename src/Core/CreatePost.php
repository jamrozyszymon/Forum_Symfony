<?php

namespace App\Core;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Core\ValidPostData;
use App\Entity\User;

class CreatePost
{
    /** @var EntityManagerInterface */
    private $entityManagerInterface;

    /** @var ValidPostData */
    private $validPostData;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->validPostData = new ValidPostData;
    }

    public function create(string $content, $user): Post
    {
        $this->validPostData->valid($content);
        $post = new Post();
        $post->setContent($content);
        $post->setUsers($user);
        $this->entityManagerInterface->persist($post);
        $this->entityManagerInterface->flush();
        return $post;
    }

}
