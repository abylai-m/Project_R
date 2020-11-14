<?php

namespace App\Repository;

use App\Entity\Dish;
use App\Entity\User;
use App\Entity\UserDish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method UserDish|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserDish|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserDish[]    findAll()
 * @method UserDish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserDishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDish::class);
    }

    public function findByDishAndUser(Dish $dish, User $user): ?UserDish
    {
        return $userDish = $this->findOneBy(['dish' => $dish, 'user' => $user]);
    }

    public function findByUser(User $user): array
    {
        return $this->findBy(['user' => $user]);
    }

    public function findDishesFilteredByUserDishes(array $userDishes): array
    {
        $dishIds = array_map(
            fn (UserDish $userDish) => $userDish->getDish()->getId(),
            $userDishes
        );

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('d')
            ->from(Dish::class, 'd');

        if (!empty($dishIds)) {
            $qb
                ->where($qb->expr()->notIn('d.id', ':dishIds'))
                ->setParameters([
                    'dishIds' => $dishIds
                ]);
        }

        return $qb->getQuery()->getResult();
    }

    public function create(Dish $dish, User $user): UserDish
    {
        $userDish = (new UserDish())
            ->setDish($dish)
            ->setUser($user);

        $this->getEntityManager()->persist($userDish);
        $this->getEntityManager()->flush();

        return $userDish;
    }

    public function remove(Dish $dish, User $user): void
    {
        $userDish = $this->findByDishAndUser($dish, $user);
        $this->getEntityManager()->remove($userDish);
        $this->getEntityManager()->flush();
    }
}
