<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Return date of creation
 */
trait CreatedDateTrait
{
    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new DateTime("now");
    }

    /**
     * @return DateTime $created
     */
    public function getCreatedDate(): DateTime
    {
        return $this->created;
    }
}
