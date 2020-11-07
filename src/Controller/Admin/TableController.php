<?php

namespace App\Controller\Admin;

use App\Repository\TableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    private TableRepository $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    /**
     * @Route("/admin/tables", name="admin.tables")
     */
    public function tablesListAction()
    {
        $tables = $this->tableRepository->findAll();

        return $this->render('admin/tables.html.twig', [
            'tables' => $tables
        ]);
    }
}
