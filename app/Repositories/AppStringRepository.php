<?php

namespace App\Repositories;

use App\Models\AppString;
use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\AppStringRepositoryInterface;

class AppStringRepository implements AppStringRepositoryInterface
{
    use TranslateTrait;
    /**
     * All app strings list.
     */
    public function list(): Collection
    {
        return AppString::latest()->get();
    }

    /**
     * Create & save configuration Category.
     */
    public function storeOrUpdate(array $data, $id = null): AppString
    {
        $string = AppString::updateOrCreate(
            ['id' => $id],
            $data
        );
        $this->translateToAllLanguages($string->text, $string->id);
        return $string;
    }

    /**
     * Find app strings by id.
     */
    public function findById($id): AppString
    {
        return AppString::find($id);
    }

    /**
     * Delete app strings by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }

    public function translationsByLanguage($id): Collection
    {
        return AppString::with(['translations' => function ($query) use ($id) {
            $query->where('language_id', $id);
        }])->get();
    }
}
