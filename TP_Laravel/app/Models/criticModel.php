<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class criticModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'film_id',
        'score',
        'comment',
        'created_at',
        'updated_at'
    ];
}
