<?php

namespace App\Repositories;

use App\Interfaces\LanguageRepositoryInterface;
use App\Models\Language;
use App\Models\TranslatedString;
use App\Models\Translation;
use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository implements LanguageRepositoryInterface
{
    use TranslateTrait;
    /**
     * All language list.
     */
    public function list(): Collection
    {
        return Language::latest()->get();
    }

    /**
     * Active language list.
     */
    public function activeList(): Collection
    {
        return Language::where('status', 1)->get();
    }

    /**
     * Create & update Language.
     */
    public function storeOrUpdate(array $data, $id = null): Language
    {
        $language = Language::updateOrCreate(
            ['id' => $id],
            $data
        );
        $this->translateAllStrings($language->locale, $language->id);
        return $language;
    }

    /**
     * Find language by id.
     */
    public function findById($id): Language
    {
        return Language::find($id);
    }

    /**
     * Delete language by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }

    /**
     * Create & update translation.
     */
    public function storeOrUpdateTranslation(array $data, $id = null): TranslatedString
    {
        $translation = TranslatedString::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $translation;
    }
}
