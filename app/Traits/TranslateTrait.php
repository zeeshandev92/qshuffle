<?php

namespace App\Traits;

use App\Models\AppString;
use App\Models\Language;
use App\Models\TranslatedString;
use Google\Cloud\Translate\V2\TranslateClient;

trait TranslateTrait
{
    // Translate Strings
    public function translateText(string $locale, array $text)
    {
        try {
            $translate = new TranslateClient(['key' => config('app.google_translate_key')]);
            $response = $translate->translateBatch($text, ['target' => $locale]);
            return $response;
        } catch (\Throwable $th) {
            throw new \ErrorException(json_decode($th->getMessage())->error->message);
        }
    }

    // Translate Strings and Create Translations
    public function createTranslations(string $languageId, string $locale, array $text): array
    {
        $response = $this->translateText($locale, $text);
        $translations = [];
        foreach ($response as $value) {
            $translations[] = TranslatedString::updateOrCreate([
                'language_id' => $languageId,
                'app_string_id' => AppString::where('text', $value['input'])->value(column: 'id'),
            ], ['translated_text' => $value['text'],]);
        }
        return $translations;
    }

    // Translate single string to all languages and also create shop translations
    public function translateToAllLanguages(array $text)
    {

        $languages = Language::where('status', '1')->get();
        $translations = [];
        foreach ($languages as $language) {
            $response = $this->translateText($language->locale, $text);
            $translations[] = [
                'text' => $response[0]['text'],
                'language_id' => $language->id,
                'locale' => $language->locale,
            ];
            // $translations = $this->createTranslations($language->id, $language->locale, [$text]);
        }
        dd($translations);
        return collect($translations);
    }

    // Translate all strings to a single language
    public function translateAllStrings(string $locale, $languageId)
    {
        $appStrings = AppString::doesntHave('translations', 'and', function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        })->get();

        if (count($appStrings) > 0) {
            $text = $appStrings->pluck('text')->toArray();

            $translations = $this->createTranslations($languageId, $locale, $text);
        }
    }
}
