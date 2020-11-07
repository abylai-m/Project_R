<?php

namespace App\Controller;

use App\Repository\TableRepository;
use App\Service\TableService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    private TableRepository $tableRepository;

    private TableService $tableService;

    public function __construct(TableRepository $tableRepository, TableService $tableService)
    {
        $this->tableRepository = $tableRepository;
        $this->tableService = $tableService;
    }

    /**
     * @Route("/table/list", name="app_table_list")
     */
    public function freeTablesListAction()
    {
        $user = $this->getUser();
        $tables = $this->tableRepository->findFreeOrReservedByUserTables($user);

        return $this->render('customer/reserve-table/free-tables-list.html.twig', [
            'tables' => $tables
        ]);
    }

    /**
     * @Route("/table/reserve", name="app_table_reserve", methods={"POST"})
     */
    public function reserveAction(Request $request)
    {
        $user = $this->getUser();
        $tableId = (int) $request->request->get('tableId');

        $this->tableService->reserve($tableId, $user);

        return $this->redirectToRoute('app_table_list');
    }

    /**
     * @Route("/table/cancel-reserve", name="app_table_cancel_reserve", methods={"POST"})
     */
    public function cancelReservationAction(Request $request)
    {
        $tableId = (int) $request->request->get('tableId');

        $this->tableService->cancelReserve($tableId);

        return $this->redirectToRoute('app_table_list');
    }
}
