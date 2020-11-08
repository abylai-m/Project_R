<?php

namespace App\Repository;

use App\Entity\OrderDish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderDish|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDish|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDish[]    findAll()
 * @method OrderDish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDish::class);
    }
}
