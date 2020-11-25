<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\DishRepository;
use App\Repository\UserDishRepository;

class DishService
{
    private UserDishRepository $userDishRepository;
    /**
     * @var DishRepository
     */
    private DishRepository $dishRepository;

    public function __construct(
        DishRepository $dishRepository,
        UserDishRepository $userDishRepository
    ) {
        $this->userDishRepository = $userDishRepository;
        $this->dishRepository = $dishRepository;
    }

    public function orderDish(User $user, int $dishId): void
    {
        $dish = $this->dishRepository->find($dishId);
        $existedUserDish = $this->userDishRepository->findByDishAndUser($dish, $user);

        if ($existedUserDish) {
            return;
        }

        $this->userDishRepository->create($dish, $user, new \DateTime());
    }

    public function cancelOrderDish(User $user, int $dishId): void
    {
        $dish = $this->dishRepository->find($dishId);

        $this->userDishRepository->remove($dish, $user);
    }
}
