<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslatedString extends Model
{
    use HasFactory;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['language_id', 'app_string_id', 'translated_text'];


    /**
     * Language
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     *App Strings
     */
    public function appString(): BelongsTo
    {
        return $this->belongsTo(AppString::class, 'app_string_id');
    }
}
