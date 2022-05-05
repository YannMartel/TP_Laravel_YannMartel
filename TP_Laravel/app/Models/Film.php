<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $filalble = [
        'id',
        'title',
        'release_year',
        'length',
        'description',
        'rating',
        'language_id',
        'special_features',
        'image',
        'created_at'
    ];

    public function critics()
    {
        return $this->hasMany(Critic::class);
    }

    public function language()
    {
        return $this->hasOne(Language::class);
    }

    public function actors(){
        return $this->belongsToMany(actor::class);
    }
}
