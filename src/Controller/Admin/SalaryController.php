<?php

namespace App\Controller\Admin;

use App\Service\SalaryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SalaryController extends AbstractController
{
    private SalaryService $salaryService;

    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    /**
     * @Route("/admin/salary", name="admin.salary")
     */
    public function getSalaryByDateAction(Request $request)
    {
        $user = $this->getUser();
        $dateFromRequest = $request->get('date');
        $date = $dateFromRequest ? \DateTime::createFromFormat('Y-m-d', $dateFromRequest) : null;

        $salary = $date ? $this->salaryService->calculateSalaryByDishOrdersByDate($user->getId(), $date) : null;

        return $this->render('admin/salary.html.twig', [
            'salary' => $salary
        ]);
    }
}
