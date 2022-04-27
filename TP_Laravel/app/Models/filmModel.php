<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filmModel extends Model
{
    use HasFactory;

    protected $filalble = [
        'id',
        'title',
        'release_year',
        'description',
        'rating',
        'language_id',
        'special_features',
        'image',
        'created_at'
    ];
}
