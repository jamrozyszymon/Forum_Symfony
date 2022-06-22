<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use DateTime;
use Doctrine\DBAL\Query\QueryBuilder;

class PostRepository extends EntityRepository
{
    public function getByDates(DateTime $startDate, DateTime $endDate)
    {
        $query = $this->createQueryBuilder('p')
        ->addSelect('pl')
        ->leftJoin('p.postLike', 'pl')
        ->where('(p.created > :startDate AND p.created < :endDate)')
        ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
        ->setPArameter('endDate', $endDate->format('Y-m-d H:i:s'))
        ->getQuery();
        return $query->getResult();
    }
}
