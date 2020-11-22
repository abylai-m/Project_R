<?php

namespace App\Service;

use App\Entity\EmployeeReport;
use App\Entity\User;
use App\Entity\UserDish;
use App\Repository\DishRepository;
use App\Repository\EmployeeReportRepository;
use App\Repository\UserDishRepository;

class EmployeeReportService
{
    private DishRepository $dishRepository;
    private UserDishRepository $userDishRepository;
    private EmployeeReportRepository $employeeReportRepository;

    public function __construct(
        DishRepository $dishRepository,
        UserDishRepository $userDishRepository,
        EmployeeReportRepository $employeeReportRepository
    ) {
        $this->dishRepository = $dishRepository;
        $this->userDishRepository = $userDishRepository;
        $this->employeeReportRepository = $employeeReportRepository;
    }

    public function addReport(User $user, \DateTime $date, int $dishId, int $count): void
    {
        $dish = $this->dishRepository->find($dishId);

        for ($i = 1; $i <= $count; $i++) {
            $userDish = $this->userDishRepository->create($dish, null, $date);
            $this->employeeReportRepository->addReport($user, $userDish, $date);
        }
    }
}
