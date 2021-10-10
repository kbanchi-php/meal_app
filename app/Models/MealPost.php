<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail'
    ];

    public function meal_category()
    {
        return $this->belongsTo(\App\Models\MealCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function meal_favorites()
    {
        return $this->hasMany(\App\Models\MealFavorite::class);
    }
}
