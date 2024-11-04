<?php

namespace App\Interfaces;

interface LanguageRepositoryInterface
{
    public function list();

    public function activeList();

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function destroyById($id);

    public function storeOrUpdateTranslation(array $data, $id = null);
}
