<?php

namespace App\Repositories;

use App\Interfaces\RelationRepositoryInterface;
use App\Models\Relation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RelationRepository implements RelationRepositoryInterface
{

    protected $model;

    public function __construct(Relation $model)
    {
        $this->model = $model;
    }

    /**
     * All relation list.
     */
    public function list($lang = 'en'): array|Collection
    {
        return $this->model->where('language', $lang)->latest()->get();
    }

    /**
     * Active relation list.
     */
    public function activeList(): Collection
    {
        return $this->model->where('status', 1)->get();
    }

    /**
     * Create & save relation.
     */
    public function storeOrUpdate(array $data, int $id = null): Relation
    {
        return $this->model->updateOrCreate(
            ['id' => $id],
            $data
        );
    }

    /**
     * Find relation by id.
     */
    public function findById($id): array|Collection|Model|Relation|null
    {
        return $this->model->find($id);
    }

    /**
     * Delete relation by id.
     */
    public function destroyById($id): bool|null
    {
        return $this->findById($id)->delete();
    }
}
