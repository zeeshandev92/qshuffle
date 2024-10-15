<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Invitee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'relation_id',
        'code',
        'questions_length',
        'gender',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $id = static::max('id') + 1;
            $model->code = Str::uuid()->toString() . $id;
        });
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'invitee_questions', 'invitee_id', 'question_id')->withPivot('type');
    }
}
