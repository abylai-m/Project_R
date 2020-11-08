<?php

namespace App\Repository;

use App\Entity\Table;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Table|null find($id, $lockMode = null, $lockVersion = null)
 * @method Table|null findOneBy(array $criteria, array $orderBy = null)
 * @method Table[]    findAll()
 * @method Table[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Table::class);
    }

    /**
     * @return Table[]
     */
    public function findFreeOrReservedByUserTables(User $user): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('t')
            ->from($this->getClassName(), 't')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('t.user', ':user'),
                $qb->expr()->isNull('t.user')
            ))
            ->setParameters(['user' => $user])
            ->orderBy('t.number', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAllOrderedByNumber(): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('t')
            ->from($this->getClassName(), 't')
            ->orderBy('t.number', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function setReservation(Table $table, ?User $user): void
    {
        $table->setUser($user);

        $this->getEntityManager()->flush();
    }

}
