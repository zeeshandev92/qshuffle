<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppString extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'text',
    ];


    /**
     * Strings with translations.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(TranslatedString::class, 'app_string_id');
    }
}
