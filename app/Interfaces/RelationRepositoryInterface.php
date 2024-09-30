<?php

namespace App\Interfaces;

interface RelationRepositoryInterface
{
    public function list();

    public function activeList();

    public function storeOrUpdate(array $data, int $id = null);

    public function findById($id);

    public function destroyById($id);
}
