<?php

namespace App\Interfaces;

interface PlanRepositoryInterface
{
    public function list();

    public function storeOrUpdate(array $data, int $id = null);

    public function findById($id);

    public function destroyById($id);
}
