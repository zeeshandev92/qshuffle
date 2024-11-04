<?php

namespace App\Interfaces;

interface AppStringRepositoryInterface
{
    public function list();

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function destroyById($id);

    public function translationsByLanguage($id);
}
