<?php

namespace App\Entity;

use App\Entity\Trait\CreatedDateTrait;
use App\Entity\Trait\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Post;

/**
 * @ORM\Entity()
 * @ORM\Table(name ="postlike")
 * @ORM\HasLifecycleCallbacks
 */
class PostLike
{
    use IdTrait;
    use CreatedDateTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="postLike")
     * @ORM\JoinColumn(name="post", referencedColumnName="id")
     */
    private $post;

    public function setPost(Post $post): void
    {
        $this->post=$post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
