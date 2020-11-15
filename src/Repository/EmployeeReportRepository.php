<?php

namespace App\Repository;

use App\Entity\EmployeeReport;
use App\Entity\User;
use App\Entity\UserDish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmployeeReport|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeReport|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeReport[]    findAll()
 * @method EmployeeReport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeReport::class);
    }

    public function addReport(User $user, UserDish $userDish, \DateTime $createdDate): void
    {
        $report = (new EmployeeReport())
            ->setUser($user)
            ->setUserDish($userDish)
            ->setCreatedAt($createdDate);

        $this->getEntityManager()->persist($report);
        $this->getEntityManager()->flush();
    }
}
