<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class QuestionRepository implements QuestionRepositoryInterface
{

    protected $model;

    public function __construct(Question $model)
    {
        $this->model = $model;
    }

    /**
     * All Question list.
     */
    public function list(): array|Collection
    {
        return $this->model->latest()->get();
    }

    /**
     * Create & save Question.
     */
    public function storeOrUpdate(array $data, int $id = null): Question
    {
        return $this->model->updateOrCreate(
            ['id' => $id],
            $data
        );
    }

    /**
     * Find Question by id.
     */
    public function findById($id): array|Collection|Model|Question|null
    {
        return $this->model->find($id);
    }

    /**
     * Delete Question by id.
     */
    public function destroyById($id): bool|null
    {
        return $this->findById($id)->delete();
    }
}
