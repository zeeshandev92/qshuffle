<?php

namespace App\Repositories;

use App\Interfaces\RelationRepositoryInterface;
use App\Models\Relation;
use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RelationRepository implements RelationRepositoryInterface
{
    use TranslateTrait;

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
        return $this->model->latest()->get();
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
        $relation =  $this->model->updateOrCreate(
            ['id' => $id],
            $data
        );
        $response = $this->translateToAllLanguages([$relation->title]);
        $translations = $response->mapWithKeys(function ($item) {
            return [$item['language_id'] => ['translated_relation' => $item['text']]];
        })->toArray();
        $relation->languages()->sync($translations);
        return $relation;
    }

    /**
     * Find relation by id.
     */
    public function findById($id): array|Collection|Model|Relation|null
    {
        return $this->model->with('languages')->find($id);
    }

    /**
     * Delete relation by id.
     */
    public function destroyById($id): bool|null
    {
        return $this->findById($id)->delete();
    }
}
