<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\TableRepository;

class TableService
{
    private TableRepository $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function reserve(int $tableId, User $user): void
    {
        $table = $this->tableRepository->find($tableId);
        $this->tableRepository->setReservation($table, $user);
    }

    public function cancelReserve(int $tableId): void
    {
        $table = $this->tableRepository->find($tableId);
        $this->tableRepository->setReservation($table, null);
    }
}
