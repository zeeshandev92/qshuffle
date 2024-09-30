<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpetieRole;

class Role extends SpetieRole
{
    use HasFactory;

    protected $fillable = [
        'guard_name',
        'name'
    ];
}
