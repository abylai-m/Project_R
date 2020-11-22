<?php

namespace App\Controller\Admin;

use App\Repository\DishRepository;
use App\Service\EmployeeReportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DishReportController extends AbstractController
{
    private DishRepository $dishRepository;
    private EmployeeReportService $employeeReportService;

    public function __construct(DishRepository $dishRepository, EmployeeReportService $employeeReportService)
    {
        $this->dishRepository = $dishRepository;
        $this->employeeReportService = $employeeReportService;
    }

    /**
     * @Route("/admin/dish/add-report", name="admin.dish.add-report.view", methods={"GET"})
     */
    public function addReportViewAction()
    {
        $dishes = $this->dishRepository->findAll();

        return $this->render('admin/dishes/report.html.twig', [
            'dishes' => $dishes
        ]);
    }

    /**
     * @Route("/admin/dish/add-report", name="admin.dish.add-report.action", methods={"POST"})
     */
    public function addReportAction(Request $request)
    {
        $user = $this->getUser();
        $date = \DateTime::createFromFormat('Y-m-d', $request->request->get('date'));
        $dish = $request->request->get('dishId');
        $count = $request->request->get('count');

        $this->employeeReportService->addReport($user, $date, $dish, $count);

        return $this->redirectToRoute('admin.dish.add-report.view');
    }
}
