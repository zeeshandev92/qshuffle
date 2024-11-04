<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'relation_id',
        'type',
        'choices',
        'gender',
        'is_required',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'choices' => 'array',
        ];
    }

    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'relation_id');
    }


    public function languages()
    {
        return $this->belongsToMany(Language::class, 'translated_questions', 'question_id', 'language_id')->withPivot('translated_question', 'choices');
    }
}
