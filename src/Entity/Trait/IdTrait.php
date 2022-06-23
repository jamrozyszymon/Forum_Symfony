<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;


/**
 * Return Id for object in Database
 */
trait IdTrait
{
     /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @return int $id
     */
    public function getId():int
    {
        return $this->id;
    }
}
