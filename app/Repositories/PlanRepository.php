<?php

namespace App\Repositories;

use App\Interfaces\PlanRepositoryInterface;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PlanRepository implements PlanRepositoryInterface
{
    protected $model;

    public function __construct(Plan $model)
    {
        $this->model = $model;
    }

    /**
     * All Plan list.
     */
    public function list(): array|Collection
    {
        return $this->model->latest()->get();
    }

    /**
     * Create & save Plan.
     */
    public function storeOrUpdate(array $data, int $id = null): Plan
    {
        return $this->model->updateOrCreate(
            ['id' => $id],
            $data
        );
    }

    /**
     * Find Plan by id.
     */
    public function findById($id): array|Collection|Model|Plan|null
    {
        return $this->model->find($id);
    }

    /**
     * Delete Plan by id.
     */
    public function destroyById($id): bool|null
    {
        return $this->findById($id)->delete();
    }
}
