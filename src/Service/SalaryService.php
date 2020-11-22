<?php

namespace App\Service;

use App\Repository\EmployeeReportRepository;

class SalaryService
{
    private const SERVICE_SHARE = 0.1;

    private EmployeeReportRepository $employeeReportRepository;

    public function __construct(EmployeeReportRepository $employeeReportRepository)
    {
        $this->employeeReportRepository = $employeeReportRepository;
    }

    public function calculateSalaryByDishOrdersByDate(int $userId, \DateTime $date): int
    {
        $reports = $this->employeeReportRepository->findReportedDishOrdersByDate($userId, $date);

        $salary = 0;
        foreach ($reports as $report) {
            $salary += $report->getUserDish()->getDish()->getPrice() * self::SERVICE_SHARE;
        }

        return $salary;
    }
}
