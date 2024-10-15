<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteeQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitee_id',
        'question_id',
        'answer',
        'type'
    ];
}
