<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;
use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class QuestionRepository implements QuestionRepositoryInterface
{
    use TranslateTrait;

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
        $question =  $this->model->updateOrCreate(
            ['id' => $id],
            $data
        );
        // $questions = $this->translateToAllLanguages([$question->question]);
        $choices = $this->translateToAllLanguages([json_encode($question->choices)]);
        dd($choices);
        $translations = $response->mapWithKeys(function ($item) {
            return [$item['language_id'] => ['translated_relation' => $item['text']]];
        })->toArray();
        $question->languages()->sync($translations);

        return $question;
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
