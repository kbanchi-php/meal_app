<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealFavorite extends Model
{
    use HasFactory;

    public function meal_post()
    {
        return $this->belongsTo(\App\Models\MealPost::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
