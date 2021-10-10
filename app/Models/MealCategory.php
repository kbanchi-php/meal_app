<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
    use HasFactory;

    public function meal_posts()
    {
        return $this->hasMany(\App\Models\MealPost::class);
    }
}
