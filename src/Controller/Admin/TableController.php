<?php

namespace App\Controller\Admin;

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
     * @Route("/admin/table/list", name="admin.table.list")
     */
    public function tablesListAction()
    {
        $tables = $this->tableRepository->findAllOrderedByNumber();

        return $this->render('admin/tables.html.twig', [
            'tables' => $tables
        ]);
    }

    /**
     * @Route("/admin/table/cancel-reserve", name="admin.table.cancel-reserve", methods={"POST"})
     */
    public function cancelReservationAction(Request $request)
    {
        $tableId = (int) $request->request->get('tableId');

        $this->tableService->cancelReserve($tableId);

        return $this->redirectToRoute('admin.table.list');
    }
}
