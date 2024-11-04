<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'translated_relations', 'relation_id', 'language_id')->withPivot('translated_relation');
    }
}
