<?php

namespace App\Entity;

use App\Entity\Trait\CreatedDateTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\IdTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name ="post")
 * @ORM\HasLifecycleCallbacks
 */
class Post
{
    use IdTrait;
    use CreatedDateTrait;

    /**
     * 
     * @ORM\Column(name="content", type="string", length=1000)
     */
    private $content='';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="post")
     */
    private $postLike;


    public function getPostLike()
    {
        return $this->getPostlike;
    }

    public function setContent(string $content):void
    {
        $this->content=$content;
    }

    public function getContent():string
    {
        return $this->content;
    }
}
